<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="fr" />
	<meta name="keywords" lang="fr" content="initiative, citoyen, entreprise,association, collectivité, démocratie, participative, Réunion, discussion , actions et réseau local">
	<meta name="description" content="Un projet citoyen de Démocratie Participative. Une plateforme de discussions et d'actions citoyennes sur un réseau local. Une passerelle entre nous et avec l’État.">
	<meta name="publisher" content="Pixel Humain">
	<meta name="author" lang="fr" content="Pixel Humain" />
	<meta name="robots" content="Index,Follow" />
	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<!--  link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" /-->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css">
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo/favicon.gif" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mainph.css">

   <title><?php echo CHtml::encode($this->pageTitle); ?></title>
   <?php //echo Yii::app()->createUrl('js/jquery-1.8.3.min.js')?>
   <script src="<?php echo Yii::app()->createUrl('js/jquery.1.10.2.min.js')?>"></script>
   <script>
   var initT = new Object();
   </script>
       <?php //Yii::app()->bootstrap->register(); ?>
</head>

<body>
<?php $this->renderPartial('application.views.layouts.sideMenu2');?>
<?php echo $content; 

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/mainLight.js' , CClientScript::POS_END);
?>		
     
</body>
</html>
