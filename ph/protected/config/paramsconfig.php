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
    //Beta Test ?
    'betaTest' => true,

    //By default controller
    'defaultController' => 'communecter',

    // Mail configuration
    'adminEmail'=>'testmail.pixelhumain@gmail.com',
    'forceMailSend' => true,

    //UPLOAD Management Configuration
    //upload url without the base URL
    'uploadUrl' => "upload/",
    //upload base directory
    'uploadDir' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR,
    'uploadComDir' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..'."\\..\\templates\\upload\\dir\\communecter\\collection\\person",
    
    //Captcha
    'captcha' => '6LdiygUTAAAAAEsbbK7LvMjJRt9PLP9lO-6QSM8K',
    'captcha-key' => '6LdiygUTAAAAAKZxZ0c9-G43Xqp9ZiedhWswto1s',
    
    //External API Key
    'facebook' => array('idAPP' => '974944225849158',
                        'secretAPP' => "3e485c0809b44e953963c778f5a3c2a0",
                        'required_scope' => 'public_profile, publish_actions, read_custom_friendlists, user_groups, user_likes, publish_pages'),
    'mandrill' => '4eD8BtmL5L_Z0E7Zz69Zlw',

    //Functionnal params
    //Is the organisation bellow an othe organization can be managed by her top organization
    'isParentOrganizationAdmin' => true,
  );

$modulesDir = '/../../../../modules/';