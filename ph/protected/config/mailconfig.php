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