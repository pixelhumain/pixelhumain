<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD layout mainSearch.php -->
	<head>
		
		<?php 
		$themeAssetsUrl = Yii::app()->theme->baseUrl. '/assets';

		$cs = Yii::app()->getClientScript();
		?>
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="swagger-section">

	<?php 

		echo $content;
	
		  ?>



		<!-- start: MAIN JAVASCRIPTS -->
		<?php
			$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jQuery/jquery-2.1.1.min.js' , CClientScript::POS_HEAD);
		?>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	</body>
	<!-- end: BODY -->
</html>