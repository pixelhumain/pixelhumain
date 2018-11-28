<!doctype html>
<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		  <meta name="language" content="<?php echo Yii::app()->language; ?>" />

		  <title>
    <?php 
    $title = "";
    if(isset($this->pageTitle)) $title = $this->pageTitle;
    else if(isset($this->module->pageTitle)) $title = $this->module->pageTitle;
    echo CHtml::encode( $title )?>
  </title>
  <?php 
    $desc = "";
    if(isset($this->desc)) $desc = $this->description;
    else if(isset($this->module->description)) $desc = $this->module->description; ?>
  <meta content="<?php echo CHtml::encode($title." , ".$desc); ?>" name="description" />
  <?php 
    $keywords = "";
    if(isset($this->keywords)) $keywords = $this->keywords;
    else if(isset($this->module->keywords)) $keywords = $this->module->keywords;?>
  <meta name="keywords" lang="<?php echo Yii::app()->language; ?>" content="<?php echo CHtml::encode($keywords); ?>"> 
		  
		  <meta name="publisher" content="Pixel Humain on Github">
		  <meta name="author" lang="<?php echo Yii::app()->language; ?>" content="Pixel Humain" />
		  <meta name="robots" content="Index,Follow" />

		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<?php $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jQuery/jquery-2.1.1.min.js' );
  ?>
<script type="text/javascript">
  
   var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
   
   </script>
	</head>

	<body>

		<?php echo $content; ?> 

	</body>
</html>
