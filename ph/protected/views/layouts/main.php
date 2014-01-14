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
    <script src="<?php echo Yii::app()->createUrl('js/jquery.1.10.2.min.js')?>"></script>    
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
   <script>
   var initT = new Object();
   var showDelaunay = true;
   var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
   </script>
       <?php //Yii::app()->bootstrap->register(); ?>
</head>

<body  class="clear-outline" data-target=".bs-docs-sidebar" data-spy="scroll">
<?php $account = (isset(Yii::app()->session["userId"])) ? Yii::app()->mongodb->citoyens->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"]))) : null;?>
<?php $this->renderPartial('application.views.layouts.header2',array( "account" => $account));?>
<?php if(isset($this->showSidebar1) && $this->showSidebar1)$this->renderPartial('application.views.layouts.sideMenu1');?>

<?php echo $content; ?>

<?php $this->renderPartial('application.views.layouts.modals',array( "account" => $account));?>	
<div class="clear"></div>
<?php $this->renderPartial('application.views.layouts.footer');?>

<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/TweenMax.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/modernizr-2.6.2-respond-1.1.0.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/prefixfree.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/bootstrap.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/load-image.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/bootstrap-image-gallery.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/d3.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/spin.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/nprogress/nprogress.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/main.js' , CClientScript::POS_END);

?>		
        
        <script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-42883170-1', 'pixelhumain.com');
			  ga('send', 'pageview');

			
			 /*var uvOptions = {};
			  (function() {
				var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
				uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/YmmyBM5muP7JoGkF31YDg.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
			  })();*/
        </script>



</body>
</html>
