<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo Yii::app()->language; ?>" lang="<?php echo Yii::app()->language; ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="<?php echo Yii::app()->language; ?>" />
	<meta name="keywords" lang="<?php echo Yii::app()->language; ?>" content="<?php echo (isset($this->module->keywords)) ? CHtml::encode($this->module->keywords) : ""; ?>">
	<meta name="description" content="<?php echo CHtml::encode ( (@isset($this->module->description))?$this->module->description:""); ?>">
	<meta name="publisher" content="Pixel Humain on Github">
	<meta name="author" lang="<?php echo Yii::app()->language; ?>" content="Pixel Humain" />
	<meta name="robots" content="Index,Follow" />
	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--	<link rel="shortcut icon" href="<?php echo $this->module->assetsUrl?>/images/logo.png"/>-->
    <title><?php echo CHtml::encode( (isset($this->module->pageTitle))?$this->module->pageTitle:""); ?></title>
   
 <?php  
  $cssAnsScriptFilesModule = array(
    '/plugins/bootstrap/css/bootstrap.min.css',
    '/plugins/font-awesome/css/font-awesome.min.css',
    '/plugins/font-awesome-custom/css/font-awesome.css',
    '/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.css',
    '/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js' ,
    '/plugins/bootstrap/js/bootstrap.min.js' ,
    '/plugins/blockUI/jquery.blockUI.js' ,
    '/js/api.js'
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->request->baseUrl);
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jQuery/jquery-2.1.1.min.js' );
  ?>
  
  <script type="text/javascript">
   var initT = new Object();
   var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
//   var moduleId = "<?php echo $this->module->id?>";
   debug = false;
   </script>
</head>

<body>

<?php echo $content; ?> 

</body>
</html>
