<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Multi-Level Push Menu - Demo 3</title>
		<meta name="description" content="Multi-Level Push Menu: Off-screen navigation with multiple levels" />
		<meta name="keywords" content="multi-level, menu, navigation, off-canvas, off-screen, mobile, levels, nested, transform" />
		<meta name="author" content="Codrops" />
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css">
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo/favicon.gif" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mainph.css">
		
		 <script src="<?php echo Yii::app()->createUrl('js/jquery.1.10.2.min.js')?>"></script>
		 <script>
           var initT = new Object();
           </script>
	</head>
	<body>
		<?php $this->renderPartial('application.views.layouts.header');?>
		<div class="containerMenu">
			<div class="mp-pusher" id="mp-pusher">

				<!-- mp-menu -->
				<?php $this->renderPartial('application.views.layouts.sideMenu2');?>
				<?php echo $content; ?>
				
			</div><!-- /pusher -->
		</div>
<script type="text/javascript">
initT['animInit'] = function(){
	NProgress.start();
	new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );
};
</script>	
<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/mainLight.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/nprogress/nprogress.js' , CClientScript::POS_END);
?>
	</body>
</html>