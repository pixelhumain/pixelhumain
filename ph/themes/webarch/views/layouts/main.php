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

<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/pace/pace-theme-flash.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-slider/css/jquery.sidr.light.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/boostrapv3/css/bootstrap.min.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/boostrapv3/css/bootstrap-theme.min.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/font-awesome/css/font-awesome.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/animate.min.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/style.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/responsive.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/custom-icon-set.css');
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/mainph.css');

/*
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/sig.css');
$cs->registerCssFile("http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css");
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/leaflet.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/leaflet.draw.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/leaflet.draw.ie.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/MarkerCluster.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/MarkerCluster.Default.css');
*/
//$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-1.8.3.min.js' , CClientScript::POS_HEAD); 
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js' , CClientScript::POS_END); 


//BEGIN CORE JS FRAMEWORK--> 
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/boostrapv3/js/bootstrap.min.js' , CClientScript::POS_END); 
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/breakpoints.js' , CClientScript::POS_END); 
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-unveil/jquery.unveil.min.js' , CClientScript::POS_END); 
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-block-ui/jqueryblockui.js' , CClientScript::POS_END); 
//	<!-- END CORE JS FRAMEWORK --> 
//	<!-- BEGIN PAGE LEVEL JS --> 	
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-slider/jquery.sidr.min.js' , CClientScript::POS_END); 	
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js' , CClientScript::POS_END); 
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/pace/pace.min.js' , CClientScript::POS_END);  
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js' , CClientScript::POS_END);
//	<!-- END PAGE LEVEL PLUGINS --> 	
	
//	<!-- BEGIN CORE TEMPLATE JS --> 
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/core.js' , CClientScript::POS_END); 
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/chat.js' , CClientScript::POS_END); 
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/demo.js' , CClientScript::POS_END); 
//	<!-- END CORE TEMPLATE JS --> 

$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/TweenMax.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/modernizr-2.6.2-respond-1.1.0.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/prefixfree.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/load-image.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/bootstrap-image-gallery.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/d3.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/spin.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/nprogress/nprogress.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/underscore.string.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/main.js' , CClientScript::POS_END);
?>

	
	<!-- END NEED TO WORK ON -->
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
</body>
</html>