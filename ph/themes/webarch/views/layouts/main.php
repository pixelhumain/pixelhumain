<?php
	$cs = Yii::app()->getClientScript();
	$basePath = Yii::app()->getRequest()->getBaseUrl(true);
?>
<!DOCTYPE html>
<html>
<head>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="language" content="fr" />
	<meta name="keywords" lang="fr" content="initiative, citoyen, entreprise,association, collectivité, démocratie, participative, Réunion, discussion , actions et réseau local">
	<meta name="description" content="Un projet citoyen de Démocratie Participative. Une plateforme de discussions et d'actions citoyennes sur un réseau local. Une passerelle entre nous et avec l’État.">
	<meta name="publisher" content="Pixel Humain">
	<meta name="author" lang="fr" content="Pixel Humain" />
	<meta name="robots" content="Index,Follow" />
	<!-- NEED TO WORK ON -->

	<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
	
	<!-- END NEED TO WORK ON -->
	<?php //echo Yii::app()->createUrl('js/jquery-1.8.3.min.js')?>
   <script>
   var initT = new Object();
   var showDelaunay = true;
   var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
   </script>
</head>
<body class="">

<?php 
$account = (isset(Yii::app()->session["userId"])) ? Yii::app()->mongodb->citoyens->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"]))) : null;
$this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.header',array( "account" => $account));
?>	
	
<!-- BEGIN CONTENT -->
<div class="page-container row-fluid">
	<?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.sideMenu',array( "account" => $account)); ?>
	<!-- BEGIN PAGE CONTAINER-->
	<div class="page-content"> 
		<div class="content">  
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">	
				<?php echo $content;  ?>		
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PlACE PAGE CONTENT HERE -->
			
			<!-- END PLACE PAGE CONTENT HERE -->
		</div>
	</div>
	<!-- END PAGE CONTAINER -->
</div>
<!-- END CONTENT --> 
<?php 
$this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.modals',array( "account" => $account));
?>
<!-- BEGIN CORE JS FRAMEWORK--> 
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> 
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script> 
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script> 
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/breakpoints.js" type="text/javascript"></script> 
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script> 
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script> 
	<!-- END CORE JS FRAMEWORK --> 
	<!-- BEGIN PAGE LEVEL JS --> 	
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script> 	
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/pace/pace.min.js" type="text/javascript"></script>  
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS --> 	
	
	<!-- BEGIN CORE TEMPLATE JS --> 
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/core.js" type="text/javascript"></script> 
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/chat.js" type="text/javascript"></script> 
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/demo.js" type="text/javascript"></script> 
	<!-- END CORE TEMPLATE JS --> 
</body>
</html>