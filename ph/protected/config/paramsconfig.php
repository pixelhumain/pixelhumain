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
    'betaTest' => false,
    //By default controller
    'defaultController' => 'communecter',
    // Mail configuration
    'adminEmail'=>'testmail.pixelhumain@gmail.com',
    'forceMailSend' => true,

    //UPLOAD Management Configuration
    //upload url without the base URL
    'uploadUrl' => "upload/",
    'communeventBaseUrl' => "https://communevent.communecter.org",
    //upload base directory
    'uploadDir' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR,
    'uploadComDir' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..'."\\..\\templates\\upload\\dir\\communecter\\collection\\person",

    //S3 configs
    "access_key"=>"",
    "secret"=> "",
    "region"=> "eu-west-1",
    "bucket.large"=> "pixelphotos.large",
    "bucket.thumb"=>"pixelphotos.thumb",
    
    //Captcha 
    'captcha' => '6LdiygUTAAAAAEsbbK7LvMjJRt9PLP9lO-6QSM8K',
    'captcha-key' => '6LdiygUTAAAAAKZxZ0c9-G43Xqp9ZiedhWswto1s',

    'idOpenAgenda' => '57220015dd0452ed27d58c84',

    'google' => array('client_id' => '991320747617-dnqguopevn9bn3mg21nm1k12gj305anv.apps.googleusercontent.com',
                        'keyAPP' => "iStMgQekGCuepkvAWUc-BfkJ",
                        'keyMaps' => "AIzaSyAzq8kVDH_-L---FPUSHfaKnz73wH9Prds"),

    'mandrill' => '4eD8BtmL5L_Z0E7Zz69Zlw',

    //Functionnal params
    //Is the organisation bellow an othe organization can be managed by her top organization
    'isParentOrganizationAdmin' => false,
    "openatlasId" => "54eed904a1aa1958b70041ef",
    "communecterId" => "56c1a474f6ca47a8378b45ef",

    //Code d'invitation
    'validInviteCodes' => array("communs59", "communs31", "polder", "detakbaro", "kisskiss"),
    //Number of invitation by default for a person (us only on beta test)
    'numberOfInvitByPerson' => 10,
    
    //URL of logos used by mail
    "logoUrl" => "/images/logo-communecter.png",
    "logoUrl2" => "/images/logoLTxt.jpg",
    
    //map box params
    'mapboxActive' => false, //to activate mabox Prod
    'forceMapboxActive' => false, //to force mabox localhost
    'mapboxToken' => 'pk.eyJ1IjoiY29tbXVuZWN0ZXIiLCJhIjoiY2lreWRkNzNrMDA0dXc3bTA1MHkwbXdscCJ9.NbvsJ14y2bMWWdGqucR_EQ',
    /*"front" => array (
        "organization" => true,
        "project" => true,
        "event" => false,
        "person" => true,
        "dda" => false,
        "live" => false,
        "search" => false, //reanme search
        "need" => false,
        "poi" => true
    )*/
  );


$modulesDir = '/../../../../modules/';