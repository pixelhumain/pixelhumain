<?php
require_once(dirname(__FILE__) . '/dbconfig.php');

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Pixel Humain Console',
	// preloading 'log' component
	'preload'=>array('log'),
	'aliases' => array(
		'vendor' => realpath(__DIR__ . '/../../vendor/'),
		'mongoYii' => realpath(__DIR__ . '/../../vendor/sammaye/mongoyii'),
	),
	// application components
	'components'=>array(
		'mongodb' => $dbconfig,
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
	// autoloading mongoYii database classes
	'import'=>array(
		'mongoYii.*',
		'mongoYii.util.*',
	),
	'commandMap' => array(
		// composer callback
		'migrate' => array(
			// alias of the path where you extracted the zip file
			//'class'                 => 'vendor.yiiext.migrate-command.EMigrateCommand',
			// Special command for mongo
			'class'                 => 'vendor.sammaye.mongoyii.util.EMigrateMongoCommand',
			// this is the path where you want your core application migrations to be created
			'migrationPath'         => 'application.migrations',
			// the name of the table created in your database to save versioning information
			'migrationTable'        => 'migration',
			// the application migrations are in a pseudo-module called "core" by default
			//'applicationModuleName' => 'core',
			// define all available modules (if you do not set this, modules will be set from yii app config)
			//'modulePaths'           => array(
			//	'activities'              => 'application.migrations.activities',
				//'user'                  => 'vendor.mishamx.yii-user.migrations',
			//),
			// you can customize the modules migrations subdirectory which is used when you are using yii module config
			//	'migrationSubPath'      => 'migrations',
			// here you can configure which modules should be active, you can disable a module by adding its name to this array
			//'disabledModules'       => array(),
			// the name of the application component that should be used to connect to the database
			'connectionID'          => 'mongodb',
			// alias of the template file used to create new migrations
			#'templateFile' => 'system.cli.migration_template',
		),
	),
	'params' => array(
		'composer.callbacks' => array(
			'post-install'=> array(
				array('yiic', 'migrate', '--interactive=1'),
            ),
			'post-update'    => array('yiic', 'migrate', '--interactive=1'),
		)
	)
);