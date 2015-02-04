<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- PAGE TITLE -->
    <title>Juntos - Charity & Association Template</title>
    <!-- MAKE IT RESPONSIVE -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link href="<?php echo Yii::app()->theme->baseUrl;?>/js/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    
    <!-- MAIN STYLE -->
    <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/style.css" rel="stylesheet" media="screen">
    <!-- FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.js"></script>
  </head>
  <!-- START BODY -->
  <body>
	<div id="page">
		<!-- START MAIN CONTAINER -->
		<div id="main-container">
		
			<?php 
			    $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.nav');
			    echo $content;  
			  ?>
		
		<!-- PAGE LOADING-->
		<div id="loader"></div>
  	</div>
    <!-- SCRIPTS -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/underscore.js"></script>
    
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/d3.js"></script>
     <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/api.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/d3.tip.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/alert.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.sequence-min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.fancybox.pack.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.sticky.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.scrollUp.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.smoothscroll.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.meanmenu.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/pace.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.flexslider-min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/custom.js"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/bootstrap/js/bootstrap.js"></script>
  </body>
  <!-- END BODY -->
</html>