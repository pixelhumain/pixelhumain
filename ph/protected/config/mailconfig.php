<?php 
$mailConfig = array(
	'class' => 'ext.mail.YiiMail',
	'transportType' => 'smtp',
    'transportOptions'=>array(
      //'host'=>'smtp.googlemail.com',
	  'host'=>'smtp.perfony.com',
      //'port_secure'=>true,
      //'enc_tls'=>true,
	  'encryption'=>'ssl',
      'username'=>'no-reply@perfony.com',
      'password'=>'EpEjl1Y',
      'port'=>465,
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
      /*'username'=>'contact@pixelhumain.com',
      'password'=>'2210pixel_$$',*/
      'username'=>'oceatoon@gmail.com',
      'password'=>'2210vaia',
      'port'=>'465',
      'encryption'=>'ssl',
    ),
	'viewPath' => 'application.views.emails',
	'logging' => true,
	'dryRun' => false
);