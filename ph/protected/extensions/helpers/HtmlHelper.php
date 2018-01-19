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
        if(!empty(Yii::app()->params["overWrite"]))
            $pathOverwrite = Yii::app()->getModule(Yii::app()->theme->name)->getAssetsUrl()."/";

        foreach ($files as $file) {
            $extention = pathinfo($file,PATHINFO_EXTENSION);
            if ($extention == "js" || $extention == "JS") {
                $fileVersion = $file."?v=".Yii::app()->params["version"] ;
                self::scriptFile($ajaxRequest, $path.$fileVersion);
                if( !empty($pathOverwrite) && in_array(substr($file, 1), Yii::app()->params["overWrite"]["assets"])  ) {
                    $file = substr($file, 1)."?v=".Yii::app()->params["version"] ;
                    self::scriptFile($ajaxRequest, $pathOverwrite.$file);
                }

            } else if ($extention == "css" || $extention == "CSS") {
                self::cssFile($ajaxRequest, $path.$file);
                if( !empty($pathOverwrite) && in_array(substr($file, 1), Yii::app()->params["overWrite"]["assets"])  ) {
                    $file = substr($file, 1) ;
                    self::cssFile($ajaxRequest, $pathOverwrite.$file);
                }
            } else {
                //unknown extension
                throw new InvalidArgumentException("unkonw file extension : ".$extention);
            }
        }
        
        return true;
       
    }


    public static function scriptFile($ajaxRequest, $path) {
        $cs = Yii::app()->getClientScript();
         if($ajaxRequest){
            echo CHtml::scriptFile($path);
        } else {
            $cs->registerScriptFile($path, CClientScript::POS_END, array(), 2);
        }
    }

    public static function cssFile($ajaxRequest, $path) {
        $cs = Yii::app()->getClientScript();
        if($ajaxRequest){
            echo CHtml::cssFile($path);
        } else {
            $cs->registerCssFile($path);
        }
    }
   

    // public static function registerCssAndScriptsFilesOverwrite() {
    //     if(!empty(Yii::app()->params["overWrite"])){
    //         $cs = Yii::app()->getClientScript();
    //         $path = Yii::app()->getModule('terla')->getAssetsUrl()."/";
    //         $ajaxRequest = Yii::app()->request->isAjaxRequest;
    //         foreach (Yii::app()->params["overWrite"]["assets"] as $key => $file) {
                
    //             $extention = pathinfo($file,PATHINFO_EXTENSION);
    //             if ($extention == "js" || $extention == "JS") {
    //                 $file = $file."?v=".Yii::app()->params["version"] ;
    //                 if($ajaxRequest){
    //                     echo CHtml::scriptFile($path.$file);
    //                 } else {
    //                     $cs->registerScriptFile($path. $file , CClientScript::POS_END, array(), 2);
    //                 }
    //             }
    //             else if ($extention == "css" || $extention == "CSS") {
    //                 if(file_exists ( $path.$file ) ) {
    //                     if($ajaxRequest){
    //                         echo CHtml::cssFile($path.$file);
    //                     } else {
    //                         $cs->registerCssFile($path.$file);
    //                     }
    //                 }
    //             } else {
    //                 throw new InvalidArgumentException("unkonw file extension : ".$extention);
    //             }
    //         } 
    //     }
    //     //exit;
    //     return true;
    // }
}
?>