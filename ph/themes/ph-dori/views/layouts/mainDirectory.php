<!DOCTYPE html>
<?php 
	$user = "NOT_CONNECTED";
?>	
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD layout mainDirectory.php -->
	<head>
		<?php 

		
		$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
		$this->renderPartial($layoutPath.'metas');?>
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<?php 
		$pluginsCssAndJs = array(
			'/plugins/bootstrap/css/bootstrap.min.css',
			'/plugins/ladda-bootstrap/dist/ladda.min.css',
			'/plugins/ladda-bootstrap/dist/ladda-themeless.min.css',
			'/plugins/font-awesome/css/font-awesome.min.css',
			'/plugins/font-awesome-custom/css/font-awesome.css',
			'/plugins/velocity/jquery.velocity.min.js',
			'/plugins/animate.css/animate.min.css',
			'/plugins/iCheck/skins/all.css',
			'/plugins/toastr/toastr.min.css',
			'/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css',
			'/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js',
			'/plugins/select2/select2.css'
			);
		HtmlHelper::registerCssAndScriptsFiles($pluginsCssAndJs, Yii::app()->request->baseUrl);

		$themesCssAndJs = array(
			'/assets/css/simply_styles.css',
			'/assets/css/styles-responsive.css',
			'/assets/css/plugins.css'
			);
		HtmlHelper::registerCssAndScriptsFiles($themesCssAndJs, Yii::app()->theme->baseUrl);
		
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile(Yii::app() -> createUrl($this->module->id."/default/view/page/trad/dir/..|translation/layout/empty"));
		?>

		<link rel='shortcut icon' type='image/x-icon' href="<?php echo (isset( $this->module->assetsUrl ) ) ? $this->module->assetsUrl : ""?>/images/favicon.ico" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/themes/theme-simple.css" type="text/css" id="skin_color">
		
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/themes/theme-simple-login.css" type="text/css" id="skin_color">
		
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<script type="text/javascript">
		   var initT = new Object();
		   var showDelaunay = true;
		   var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
		   var moduleUrl = "<?php echo Yii::app()->controller->module->assetsUrl;?>";
		   var themeUrl = "<?php echo Yii::app()->theme->baseUrl;?>";
		   var moduleId = "<?php echo $this->module->id?>";
		   var userId = "<?php echo Yii::app()->session['userId']?>";
		   var debug = <?php echo (YII_DEBUG) ? "true" : "false" ?>;
		   var debugMap = [
		    <?php if(YII_DEBUG) { ?>
		       { "userId":"<?php echo Yii::app()->session['userId']?>"},
		       { "userEmail":"<?php echo Yii::app()->session['userEmail']?>"}
	       <?php } ?>
	       ];
	       <?php if($user != "NOT_CONNECTED") { ?>
				var user_geo_latitude  = "<?php echo $user_geo_latitude; ?>";
	  			var user_geo_longitude = "<?php echo $user_geo_longitude; ?>";
	  			var insee 	 = "<?php echo $insee; ?>";
	  			var cityName = "<?php echo $cityName; ?>";
	 	   <?php } ?>
		   jQuery(document).ready(function() {
				toastr.options = {
				  "closeButton": false,
				  "positionClass": "toast-bottom-right",
				  "onclick": null,
				  "showDuration": "1000",
				  "hideDuration": "1000",
				  "timeOut": "5000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "fadeIn",
				  "hideMethod": "fadeOut"
				};
				<?php if($user != "NOT_CONNECTED") { ?>
					//updateCookieValues(user_geo_latitude, user_geo_longitude, insee, cityName);
				<?php } ?>
			});
		</script>
		<style type="text/css">
			.form-group label.error{ color:red; font-size:10px; }
		</style>
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="">
		<?php  
			echo $content;  ?>
		<!-- start: MAIN JAVASCRIPTS -->
		<?php
		echo "<!-- start: MAIN JAVASCRIPTS -->";
		echo "<!--[if lt IE 9]>";
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/respond.min.js' , CClientScript::POS_HEAD);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/excanvas.min.js' , CClientScript::POS_HEAD);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jQuery/jquery-1.11.1.min.js' , CClientScript::POS_HEAD);
		echo "<![endif]-->";
		echo "<!--[if gte IE 9]><!-->";
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jQuery/jquery-2.1.1.min.js' , CClientScript::POS_HEAD);
		echo "<!--<![endif]-->";
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/bootstrap/js/bootstrap.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/ladda-bootstrap/dist/spin.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/ladda-bootstrap/dist/ladda.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/iCheck/jquery.icheck.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jquery.transit/jquery.transit.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/TouchSwipe/jquery.touchSwipe.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/bootbox/bootbox.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jquery-mockjax/jquery.mockjax.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/blockUI/jquery.blockUI.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/toastr/toastr.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jquery-cookie/jquery.cookie.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jquery-cookieDirective/jquery.cookiesdirective.js' , CClientScript::POS_END);

		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/select2/select2.min.js' , CClientScript::POS_END);

		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jquery.dynForm.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/cookie.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl. '/js/network.js' , CClientScript::POS_END);

		
		//<!-- end: MAIN JAVASCRIPTS -->
		//<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		?>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	</body>
	<!-- end: BODY -->
</html>