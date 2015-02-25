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
}
?>