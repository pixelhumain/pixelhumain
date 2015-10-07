<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- PAGE TITLE -->
    <title><?php echo ($this->pageTitle) ? CHtml::encode($this->pageTitle) : "set a pageTitle"; ?></title>
    <!-- MAKE IT RESPONSIVE -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <?php 
		$detect = new Mobile_Detect;
		$isMobile = $detect->isMobile();
		$cs = Yii::app()->getClientScript();
		//$cs->registerCssFile('http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,200,100,800');
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/css/bootstrap.min.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/plugins/font-awesome/css/font-awesome.min.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/plugins/font-awesome-custom/css/font-awesome.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/css/style.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl.'/plugins/animate.css/animate.min.css');
	?>
    <!--<link href="<?php echo Yii::app()->theme->baseUrl;?>/js/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen"> -->
    
    <!-- MAIN STYLE -->
    <!--<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/style.css" rel="stylesheet" media="screen"> -->
    <!-- FONTS -->
    <!--<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'> -->
    <!--<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'> -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    <!--<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.js"></script>-->
    <link rel='shortcut icon' type='image/x-icon' href="<?php echo $this->module->assetsUrl?>/images/favicon.ico" />
    <script>
		   var initT = new Object();
		   //var showDelaunay = true;
		   // A supprimer une fois le redirect corrigé 
		   var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
		   var themeUrl = "<?php echo Yii::app()->theme->baseUrl;?>";
		   var moduleId = "<?php echo $this->module->id?>";
	</script>
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
    <?php 
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/jquery.js' , CClientScript::POS_END);
    	
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/d3.js' , CClientScript::POS_END);
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/api.js' , CClientScript::POS_END);
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/d3.tip.js' , CClientScript::POS_END);
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/alert.js' , CClientScript::POS_END);
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/jquery.sequence-min.js' , CClientScript::POS_END);
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/jquery.fancybox.pack.js' , CClientScript::POS_END);
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/jquery.scrollUp.min.js' , CClientScript::POS_END);
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/jquery.smoothscroll.min.js' , CClientScript::POS_END);
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/jquery.meanmenu.min.js' , CClientScript::POS_END);
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/jquery.sticky.js' , CClientScript::POS_END);
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/pace.min.js' , CClientScript::POS_END);	
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/custom.js' , CClientScript::POS_END);
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/bootstrap/js/bootstrap.js' , CClientScript::POS_END);
    	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/js/jquery.flexslider-min.js' , CClientScript::POS_END);

    ?>
  </body>
  <!-- END BODY -->
</html>