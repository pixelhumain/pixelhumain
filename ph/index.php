<?php
// change the following paths if necessary
$yii=dirname(__FILE__).'/vendor/yiisoft/yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
if( stripos($_SERVER['SERVER_NAME'], "127.0.0.1") === false && 
	stripos($_SERVER['SERVER_NAME'], "localhost") === false && 
	stripos($_SERVER['SERVER_NAME'], "::1") === false && 
	stripos($_SERVER['SERVER_NAME'], "localhost:8080") === false && strpos($_SERVER['SERVER_NAME'], "local.")!==0 )
    defined('YII_DEBUG') or define('YII_DEBUG',false); // PROD
else {
	error_reporting(E_ALL);	
	ini_set('display_errors', 'On');
    defined('YII_DEBUG') or define('YII_DEBUG',true);//LOCAL DEV    
}
    
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();