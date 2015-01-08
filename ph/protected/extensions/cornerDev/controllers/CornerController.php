<?php
class CornerController extends CExtController
{
    public $jsonFilePath = "/../../sitemap/scripts/sitemap2.json";
    private $_assetsBase;
    public function getAssetsBase()
        {
                if ($this->_assetsBase === null) {
                        $this->_assetsBase = Yii::app()->assetManager->publish(
                                Yii::getPathOfAlias('ext.cornerDev.assets'),
                                false,
                                -1,
                                YII_DEBUG
                        );
                }
                return $this->_assetsBase;
    }
    public function actionDetails($section,$id)
	{
	    $jsonA = $this->_getJson();
        $sections = $jsonA['sections'];
        
	    if($section != 'null'){
    	    
    	    //var_dump($sections[$section]['frames'][$id]);
    	    $params = $sections[$section]['frames'][$id];
	    } else {
	        $sectionList = array();
	        echo "count sections : ".count($section);
	        foreach ($sections as $key => $sectionMap )
	            $sectionList[$key] = $sectionMap['title'];
	        $parentid = (isset($_GET["parentid"])) ? $_GET["parentid"] : ''; 
	            
	        $params = array('sections'=>$sectionList,
	        				'title'=>'',
	                        'id'=>'',
	                        'link'=>'',
	                        'parentid'=>$parentid,
	        				'action'=>'dev',
	        				'state'=>'pending',
	                        'progress'=>'0',);
	    }
	    $this->renderPartial('ext.cornerDev.views.detailForm',$params);
	}
	
    public function actionComment($section,$id)
	{
	    $jsonA = $this->_getJson();
        $sections = $jsonA['sections'];
	    //var_dump($sections[$section]['frames'][$id]);
	    $this->renderPartial('ext.cornerDev.views.commentForm',$sections[$section]['frames'][$id]);
	}
	
    public function actionAddmultiple()
	{
	    $this->renderPartial('ext.cornerDev.views.multipleAdd');
	}
	
    public function actionGetJson()
	{
	    $jsonPath = Yii::app()->getBasePath().$this->jsonFilePath;
	    $jsonStr = file_get_contents($jsonPath);
	    echo $jsonStr;
	}
	
   
	
    public function actionSavesitemap()
	{
	    $jsonPath = Yii::app()->getBasePath().$this->jsonFilePath;
	    file_put_contents($jsonPath, json_encode($_POST['sitemap'])); 
	}
	
	private function _getJson(){
	    $jsonPath = Yii::app()->getBasePath().$this->jsonFilePath;
	    $jsonStr = file_get_contents($jsonPath);
	    return json_decode($jsonStr,true);
	}
     public function actionJsona($section,$id)
	{
	    $jsonA = $this->_getJson();
        $sections = $jsonA['sections'];
        //print_r($sections[$section]['frames'][$id]["zones"]);
        echo count($sections[$section]['frames'][$id]["zones"]);
	}
}