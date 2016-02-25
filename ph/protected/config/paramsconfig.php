<?php 
$mailConfig = array(
	'class' => 'ext.mail.YiiMail',
	'transportType' => 'smtp',
    'transportOptions'=>array(
	  'host'=>'smtp.gmail.com',
      'username'=>'testmail.pixelhumain',
      'password'=>'$pixelhumain974$',
      'port'=>'465',
      'encryption'=>'tls',
    ),
	'viewPath' => 'application.views.emails',
	'logging' => true,
	'dryRun' => false
);



$params = array(

    //By default controller
    'defaultController' => 'azotlive',

    // Mail configuration
    'adminEmail'=>'contact@azotlive.com',

    //UPLOAD Management Configuration
    //upload url without the base URL
    'uploadUrl' => "upload/",
    'uploadDir' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR

    //External API Key
    // 'facebook' => array('idAPP' => '974944225849158',
    //                     'secretAPP' => "3e485c0809b44e953963c778f5a3c2a0",
    //                     'required_scope' => 'public_profile, publish_actions, read_custom_friendlists, user_groups, user_likes, publish_pages'),
  );

$modulesDir = '/../../../../modules/';