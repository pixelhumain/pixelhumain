<!DOCTYPE html>
<?php 
	
	/* COOKIE GEO POSITION */

 	/*	LISTE DES COOKIES
 		-----------------
		-user_geo_latitude
		-user_geo_longitude
		-insee
		-cityName
 	*/
	$user = "NOT_CONNECTED";
 	/*if(isset(Yii::app()->session['userId'])){
 		$user = Person::getById(Yii::app()->session['userId']);
		
		$user_geo_latitude = ""; $user_geo_longitude = "";
		$insee = ""; $cityName = "";

		if(isset($user["geo"]) && 
 		   isset($user["geo"]["latitude"]) && isset($user["geo"]["longitude"]))
		{
			$user_geo_latitude = $user["geo"]["latitude"];
			$user_geo_longitude = $user["geo"]["longitude"];
		}

		if(isset($user["address"]) && isset($user["address"]["codeInsee"]))
			$insee = $user["address"]["codeInsee"];
			
		if(isset($user["address"]) && isset($user["address"]["addressLocality"]))
			$cityName = $user["address"]["addressLocality"];
			
	}else{ //user not connected
		if(isset($cookies['user_geo_longitude'])){
				$sigParams["firstView"] = array(  "coordinates" => array( $cookies['user_geo_latitude']->value, 
																		  $cookies['user_geo_longitude']->value),
											 	  "zoom" => 13);		
		}else{
			//error_log("aucun cookie geopos trouvé");
		}
	}*/

?>	
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD layout mainSearch.php -->
	<head>
		<?php 

		
		$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
		$this->renderPartial($layoutPath.'metas');?>
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<?php 
		$themeAssetsUrl = Yii::app()->theme->baseUrl. '/assets';

		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($themeAssetsUrl. '/plugins/bootstrap/css/bootstrap.min.css');
		$cs->registerCssFile($themeAssetsUrl. '/plugins/ladda-bootstrap/dist/ladda.min.css');
		$cs->registerCssFile($themeAssetsUrl. '/plugins/ladda-bootstrap/dist/ladda-themeless.min.css');
		$cs->registerCssFile($themeAssetsUrl. '/plugins/font-awesome/css/font-awesome.min.css');
		$cs->registerCssFile($themeAssetsUrl. '/plugins/font-awesome-custom/css/font-awesome.css');
		$cs->registerScriptFile($themeAssetsUrl. '/plugins/velocity/jquery.velocity.min.js' , CClientScript::POS_END);
		$cs->registerCssFile($themeAssetsUrl. '/plugins/animate.css/animate.min.css');
		$cs->registerCssFile($themeAssetsUrl. '/plugins/iCheck/skins/all.css');
		$cs->registerCssFile($themeAssetsUrl. '/css/styles.css');
		$cs->registerCssFile($themeAssetsUrl. '/css/styles-responsive.css');
		$cs->registerCssFile($themeAssetsUrl. '/css/plugins.css');
		$cs->registerCssFile($themeAssetsUrl. '/plugins/iCheck/skins/all.css');
		$cs->registerCssFile($themeAssetsUrl. '/plugins/toastr/toastr.min.css');
		$cs->registerCssFile($themeAssetsUrl.'/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css');
		$cs->registerScriptFile($themeAssetsUrl.'/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app() -> createUrl($this->module->id."/default/view/page/trad/dir/..|translation/layout/empty"));
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.css');
		
		?>
		<link rel='shortcut icon' type='image/x-icon' href="<?php echo (isset( $this->module->assetsUrl ) ) ? $this->module->assetsUrl : ""?>/images/favicon.ico" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/themes/theme-simple.css" type="text/css" id="skin_color">
		
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/themes/theme-simple-login.css" type="text/css" id="skin_color">
		
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<script>
		   var initT = new Object();
		   var showDelaunay = true;
		   var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
		   var moduleUrl = "<?php echo Yii::app()->controller->module->assetsUrl;?>";
		   var themeUrl = "<?php echo Yii::app()->theme->baseUrl;?>";
		   var moduleId = "<?php echo $this->module->id?>";
		   var userId = "<?php echo Yii::app()->session['userId']?>";
		   var debug = <?php echo (YII_DEBUG) ? "true" : "false" ?>;
		   var currentUrl = "<?php echo "#".Yii::app()->controller->id.".".Yii::app()->controller->action->id ?>";
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
		<?php echo $content;  ?>
		<!-- start: MAIN JAVASCRIPTS -->
		<?php
		echo "<!-- start: MAIN JAVASCRIPTS -->";
		echo "<!--[if lt IE 9]>";
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/respond.min.js' , CClientScript::POS_HEAD);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/excanvas.min.js' , CClientScript::POS_HEAD);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jQuery/jquery-1.11.1.min.js' , CClientScript::POS_HEAD);
		echo "<![endif]-->";
		echo "<!--[if gte IE 9]><!-->";
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jQuery/jquery-2.1.1.min.js' , CClientScript::POS_HEAD);
		echo "<!--<![endif]-->";
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap/js/bootstrap.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/ladda-bootstrap/dist/spin.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/ladda-bootstrap/dist/ladda.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/iCheck/jquery.icheck.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery.transit/jquery.transit.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/TouchSwipe/jquery.touchSwipe.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootbox/bootbox.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-mockjax/jquery.mockjax.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/blockUI/jquery.blockUI.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/toastr/toastr.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-cookie/jquery.cookie.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-cookieDirective/jquery.cookiesdirective.js' , CClientScript::POS_END);

		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.min.js' , CClientScript::POS_END);

		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/jquery.dynForm.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/cookie.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl. '/js/communecter.js' , CClientScript::POS_END);

		
		//<!-- end: MAIN JAVASCRIPTS -->
		//<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		?>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	</body>
	<!-- end: BODY -->
</html>