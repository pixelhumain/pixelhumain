<?php
/**
 * CornerDev class file.
 *
 * @author Tibor Katelbach <tibor@oceatoon.org>
 * @version 0.1
 * @license BSD
 */

/** 
 *
 * Adds a development follow up tool 
 * - declare bugs 
 * - create a sitemap 
 * @author Tibor Katelbach <tibor@oceatoon.org>
 */

class CornerDev extends CWidget
{
	/**
	 * @var mixed the CSS file used for the widget.
	 * If false, the default CSS file will be used. Otherwise, the specified CSS file
	 * will be included when using this widget.
	 */
    public $htm='';
	public $cssFile=false;
	public $baseUrl='';
	public $jsonFilePath = "/../../sitemap/scripts/sitemap2.json";
	public $sitemapUrl = 'http://127.0.0.1:8080/perfony/sitemap';
	public $postionCssClass = "bottomLeft";

	/**
	 * Initializes the widget.
	 * This method registers all needed client scripts 
	 */
	public function init()
	{
      	$this->baseUrl = CHtml::asset(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets');                
        $url = ($this->cssFile!==false)
             ? $this->cssFile
             : $this->baseUrl.'/CornerDev.css';

        $jsCode = "";
        
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile( $url );
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile( $this->baseUrl.'/common.js',CClientScript::POS_END );
        $cs->registerScriptFile( $this->baseUrl.'/cornerDev.js',CClientScript::POS_END );
        // ->registerScript(__CLASS__,$jsCode,CClientScript::POS_HEAD);
	}

	/**
	 * Renders the close tag of the element.
	 */
	public function run()
	{
	    $moduleId = ($this->owner->getModule() !== null) ? $this->owner->getModule()->getId().'/':'';
        //good use case for multiple results 
	    //$pathKey = "dashboard";
	    $pathKey = $moduleId.Yii::app()->controller->id."/".Yii::app()->controller->action->id;
	    $params = array('pathKey'=>$pathKey);
	    
	    $this->render('cornerDev',CMap::mergeArray(self::exists($pathKey,$this->jsonFilePath), $params));
	}
	public static function exists($pathKey,$jsonFilePath)
	{
	    //load json in array parse to check existence
	    $jsonPath = Yii::app()->getBasePath().$jsonFilePath;
	    $result = array();
	    $exist = file_exists($jsonPath);
	    $activeSection = null;
    	$activeFrame = null;
    	$inprogress = array();
    	$tobetested = array();
	    if($exist)
	    {
	        $jsonStr = file_get_contents($jsonPath);
	        $exist = strstr($jsonStr, str_replace('/', '\/',$pathKey));
	        if($exist !== false)
	        {
	            
	            $jsonA = json_decode($jsonStr,true);
	            $sections = $jsonA['sections'];
	            var_dump($sections);
	            
	            foreach ($sections as $key=>$sectionMap )
	            {
	                if(isset($sectionMap['frames']))
	                {
    	                $frames = $sectionMap['frames'];
    	                if(strstr(json_encode($frames) , str_replace('/', '\/',$pathKey)) !== false){
    	                    
        	                foreach ($frames as $key2=>$frameMap )
        	                {  // var_dump($frameMap);
        	                    if( isset($frameMap['link']) && strstr($frameMap['link'], $pathKey) !== false )
        	                    {
        	                        $activeSection = $sectionMap;
        	                        $activeFrame = $frameMap;
        	                    }
        	                    
        	                    if(isset($frameMap['state']) )
        	                    {
        	                        if($frameMap['state'] == 'inprogress')
        	                            array_push($inprogress, array('id'=>$frameMap['id'],
        	                                                          'link'=>$frameMap['link'],
        	                        		    					  'progress'=>$frameMap['progress']));
        	                        else if($frameMap['state'] == 'test')
        	                            array_push($tobetested, array('id'=>$frameMap['id'],
        	                                                          'link'=>$frameMap['link'],
        	                        		    					  'progress'=>$frameMap['progress']));
        	                    }
    	                    }
    	                    //var_dump($sectionMap);
    	                }
	                }
	            }
	        }
	    }
	    $result['exists']=$exist;
	    $result['activeSection']=$activeSection;
	    $result['activeFrame']=$activeFrame;
	    $result['inprogress']=$inprogress;
	    $result['tobetested']=$tobetested;
	    return $result;
	}
}