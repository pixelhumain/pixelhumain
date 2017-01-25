<?php 
class HtmlHelper {
    public static function random_color(){
        mt_srand((double)microtime()*1000000);
        $c = '';
        while(strlen($c)<6){
            $c .= sprintf("%02X", mt_rand(0, 255));
        }
        return $c;
    }

    public static function echoIfSetOr($var , $default = null) {
    	if (isset($var)) {
    		echo $var;
    	} elseif (isset($default)) {
    		echo $default;
    	}
    }

    /**
     * Register using yii methode the css and javascript files.
     * The helper will choose the way to register the file depending on :
     * 1. It's an ajax request or not
     * 2. It's a css or a javascript file
     * @param array $files an array with the file path of the css and js to register. 
     * The paths must be relative from the baseUrl. Ex : '/assets/plugins/bootstrap-datepicker/css/datepicker.css'
     * @return true if everything done right
     */
    public static function registerCssAndScriptsFiles($files,$path=null) {
        $cs = Yii::app()->getClientScript();
        if($path == null)
            $path = Yii::app()->request->baseUrl;
        $ajaxRequest = Yii::app()->request->isAjaxRequest;
        foreach ($files as $file) {
            $extention = pathinfo($file,PATHINFO_EXTENSION);
            if ($extention == "js" || $extention == "JS") {
                if($ajaxRequest){
                    echo CHtml::scriptFile($path.$file);
                } else {
                    $cs->registerScriptFile($path. $file , CClientScript::POS_END, array(), 2);
                }
            } else if ($extention == "css" || $extention == "CSS") {
                if($ajaxRequest){
                    echo CHtml::cssFile($path.$file);
                } else {
                    $cs->registerCssFile($path.$file);
                }
            } else {
                //unknown extension
                throw new InvalidArgumentException("unkonw file extension : ".$extention);
            }
        }
        return true;
    }
}
?>