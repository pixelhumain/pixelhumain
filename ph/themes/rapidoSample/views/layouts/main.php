<!DOCTYPE html>
<!-- Template Name: Rapido - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.0 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<?php 
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile('http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,200,100,800');
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap/css/bootstrap.min.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/font-awesome/css/font-awesome.min.css');
		
		//<!-- end: CSS REQUIRED FOR THIS SUBVIEW CONTENTS-->
		//<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		//<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		//<!-- start: CORE CSS -->
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/styles.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/styles-responsive.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/plugins.css');
		?>
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/themes/theme-default.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/print.css" type="text/css" media="print"/>
		<!-- end: CORE CSS -->
		<link rel='shortcut icon' type='image/x-icon' href="<?php echo $this->module->assetsUrl?>/images/favicon.ico" />
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body>
		<!-- start: SLIDING BAR (SB) -->
		<div id="slidingbar-area">
			<div id="slidingbar">
				<div class="row">
					<!-- start: SLIDING BAR FIRST COLUMN -->
					<div class="col-md-4 col-sm-4">
						<h2>My Options</h2>
						<div class="row">
							<div class="col-xs-6 col-lg-3">
								<button class="btn btn-icon btn-block space10">
									<i class="fa fa-folder-open-o"></i>
									Projects <span class="badge badge-info partition-red"> 4 </span>
								</button>
							</div>
							<div class="col-xs-6 col-lg-3">
								<button class="btn btn-icon btn-block space10">
									<i class="fa fa-envelope-o"></i>
									Messages <span class="badge badge-info partition-red"> 23 </span>
								</button>
							</div>
							<div class="col-xs-6 col-lg-3">
								<button class="btn btn-icon btn-block space10">
									<i class="fa fa-calendar-o"></i>
									Calendar <span class="badge badge-info partition-blue"> 5 </span>
								</button>
							</div>
							<div class="col-xs-6 col-lg-3">
								<button class="btn btn-icon btn-block space10">
									<i class="fa fa-bell-o"></i>
									Notifications <span class="badge badge-info partition-red"> 9 </span>
								</button>
							</div>
						</div>
					</div>
					<!-- end: SLIDING BAR FIRST COLUMN -->
					<!-- start: SLIDING BAR SECOND COLUMN -->
					<div class="col-md-4 col-sm-4">
						<h2>My Recent Works</h2>
						<div class="blog-photo-stream margin-bottom-30">
							<ul class="list-unstyled">
								<li>
									<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image01_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image02_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image03_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image04_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image05_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image06_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image07_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image08_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image09_th.jpg"></a>
								</li>
								<li>
									<a href="#"><img alt="" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image10_th.jpg"></a>
								</li>
							</ul>
						</div>
					</div>
					<!-- end: SLIDING BAR SECOND COLUMN -->
					<!-- start: SLIDING BAR THIRD COLUMN -->
					<div class="col-md-4 col-sm-4">
						<h2>My Info</h2>
						<address class="margin-bottom-40">
							Peter Clark
							<br>
							12345 Street Name, City Name, United States
							<br>
							P: (641)-734-4763
							<br>
							Email:
							<a href="#">
								peter.clark@example.com
							</a>
						</address>
						<a class="btn btn-transparent-white" href="#">
							<i class="fa fa-pencil"></i> Edit
						</a>
					</div>
					<!-- end: SLIDING BAR THIRD COLUMN -->
				</div>
				<div class="row">
					<!-- start: SLIDING BAR TOGGLE BUTTON -->
					<div class="col-md-12 text-center">
						<a href="#" class="sb_toggle"><i class="fa fa-chevron-up"></i></a>
					</div>
					<!-- end: SLIDING BAR TOGGLE BUTTON -->
				</div>
			</div>
		</div>
		<!-- end: SLIDING BAR -->
		<div class="main-wrapper">
			<?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.topbar');?>
			<?php 
			$sidemenuL = ($this->sidebar1) ? $this->sidebar1 : 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.sideMenuL';
			$this->renderPartial($sidemenuL);
			?>
			<?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.sideMenuR');?>

			<!-- start: MAIN CONTAINER -->
			<div class="main-container inner">
				<!-- start: PAGE -->
				<div class="main-content">
					<!-- start: PANEL CONFIGURATION MODAL FORM -->
					<div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
										&times;
									</button>
									<h4 class="modal-title">Panel Configuration</h4>
								</div>
								<div class="modal-body">
									Here will be a configuration form
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">
										Close
									</button>
									<button type="button" class="btn btn-primary">
										Save changes
									</button>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
					<!-- end: SPANEL CONFIGURATION MODAL FORM -->
					<div class="container">
						<!-- start: PAGE HEADER -->
						<?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.toolbar');?>
						<!-- end: PAGE HEADER -->
						<?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.breadcrumb');?>
						<!-- start: PAGE CONTENT -->
						<?php echo $content;  ?>
						<!-- end: PAGE CONTENT-->
					</div>
					<div class="subviews">
						<div class="subviews-container"></div>
					</div>
				</div>
				<!-- end: PAGE -->
			</div>
			<!-- end: MAIN CONTAINER -->
			<?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.footer');?>
			<?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.subview');?>
		</div>
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
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/blockUI/jquery.blockUI.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/iCheck/jquery.icheck.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/moment/min/moment.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootbox/bootbox.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery.scrollTo/jquery.scrollTo.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery.appear/jquery.appear.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-cookie/jquery.cookie.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/velocity/jquery.velocity.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/TouchSwipe/jquery.touchSwipe.min.js' , CClientScript::POS_END);
		//<!-- end: MAIN JAVASCRIPTS -->
		//<!-- start: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-mockjax/jquery.mockjax.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/toastr/toastr.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-modal/js/bootstrap-modal.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-select/bootstrap-select.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/DataTables/media/js/jquery.dataTables.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/DataTables/media/js/DT_bootstrap.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/truncate/jquery.truncate.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/summernote/dist/summernote.min.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-daterangepicker/daterangepicker.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/subview.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/subview-examples.js' , CClientScript::POS_END);
		//<!-- end: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
		//<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		//<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		//<!-- start: CORE JAVASCRIPTS  -->
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/main.js' , CClientScript::POS_END);
		?>
		<!-- end: CORE JAVASCRIPTS  -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				SVExamples.init();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>