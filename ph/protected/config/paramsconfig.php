<?php 
$mailConfig = array(
	'class' => 'ext.mail.YiiMail',
	'transportType' => 'smtp',
    'transportOptions'=>array(
	  'host'=>'smtp.gmail.com',
      'username'=>'',
      'password'=>'',
      'port'=>'465',
      'encryption'=>'ssl',
    ),
	'viewPath' => 'application.views.emails',
	'logging' => true,
	'dryRun' => false
);

$mailConfigTest = array(
	'class' => 'ext.mail.YiiMail',
	'transportType' => 'smtp',
    'transportOptions'=>array(
      'host'=>'smtp.gmail.com',
      'username'=>'contact@pixelhumain.com',
      'password'=>'2210pixel_$$',
      'port'=>'465',
      'encryption'=>'ssl',
    ),
	'viewPath' => 'application.views.emails',
	'logging' => true,
	'dryRun' => false
);

$params = array(
    // this is used in contact page
    'adminEmail'=>'contact@pixelhumain.com',
    //upload base directory
    'uploadURL' => "/upload/",
    'uploadDir' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR,
    'uploadComDir' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..'."\\..\\templates\\upload\\dir\\communecter\\collection\\person",
    'captcha' => '6LdiygUTAAAAAEsbbK7LvMjJRt9PLP9lO-6QSM8K'
  );

$modulesDir = '/../../../../modules/';