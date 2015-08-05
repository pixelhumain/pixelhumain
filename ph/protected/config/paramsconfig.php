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
    'uploadUrl' => "upload/",
    'uploadDir' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR,
    'uploadComDir' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..'."\\..\\templates\\upload\\dir\\communecter\\collection\\person",
    'captcha' => '6LdiygUTAAAAAEsbbK7LvMjJRt9PLP9lO-6QSM8K',
    'captcha-key' => '6LdiygUTAAAAAKZxZ0c9-G43Xqp9ZiedhWswto1s',
    'facebook' => array('idAPP' => '974944225849158',
                        'secretAPP' => "3e485c0809b44e953963c778f5a3c2a0",
                        'required_scope' => 'public_profile, publish_actions, read_custom_friendlists, user_groups, user_likes, publish_pages'),
    'mandrill' => '4eD8BtmL5L_Z0E7Zz69Zlw',
    'defaultController' => 'communecter',
    'betaTest' => false
  );

$modulesDir = '/../../../../modules/';