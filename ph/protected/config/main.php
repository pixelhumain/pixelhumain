<?php
require_once(dirname(__FILE__) . '/dbconfig.php');
require_once(dirname(__FILE__) . '/mailconfig.php');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Pixel Humain',

	// preloading 'log' component
	'preload'=>array('log'),
    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/yiistrap'),
		'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'), 
    ),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'bootstrap.helpers.TbHtml',
    	'application.extensions..MongoYii.*',
        'application.extensions..MongoYii.validators.*',
        'application.extensions..MongoYii.behaviors.*',
    	'ext.mail.YiiMailMessage',
        'ext.helpers.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
        	'generatorPaths' => array('bootstrap.gii'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'caseSensitive'=>false, 
			'rules'=>array(
				'<action>'=>'site/<action>',
               '<controller:\w+>/<id:\d+>' => '<controller>/view',
               '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
               '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			),
		),
		/*'db' => array(
			'connectionString' => $dbconfig['db.connectionString'],
			'username' => $dbconfig['db.username'],
			'password' => $dbconfig['db.password'],
			'schemaCachingDuration' => YII_DEBUG ? 0 : 86400000, // 1000 days
			'enableParamLogging' => YII_DEBUG,
			'charset' => 'utf8'
		),*/
		'mongodb' => $dbconfig,
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'mail' => $mailConfigTest, 
		'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',   
        ),
        'yiiwheels' => array(
            'class' => 'yiiwheels.YiiWheels',   
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'contact@pixelhumain.com',
	),
);