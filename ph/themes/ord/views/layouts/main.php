<!DOCTYPE html>
<html>
<head>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="language" content="fr" />
	<meta name="keywords" lang="fr" content="">
	<meta name="description" content="">
	<meta name="publisher" content="O.R.D - Eau Air Dés">
	<meta name="author" lang="fr" content="O.R.D - Eau Air Dés" />
	<meta name="robots" content="Index,Follow" />
	<!-- NEED TO WORK ON -->

	<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/style.css" rel="stylesheet" type="text/css"/>
	<!-- END NEED TO WORK ON -->
   <script>
   var initT = new Object();
   var showDelaunay = true;
   var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
   </script>
</head>
<body class="">

<?php 
$this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.header');
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

<!-- BEGIN CORE JS FRAMEWORK--> 
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> 
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script> 
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script> 
	
	
	<!-- END CORE TEMPLATE JS --> 
	<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/TweenMax.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/modernizr-2.6.2-respond-1.1.0.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/prefixfree.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/load-image.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/d3.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/nprogress/nprogress.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/underscore.string.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/main.js' , CClientScript::POS_END);

?>	
</body>
</html>