<!DOCTYPE html>
<html>
<head>
  <?php 
  $cs = Yii::app()->getClientScript();
  $themeAssetsUrl = Yii::app()->theme->baseUrl.'../../co2/assets';
  $cs->registerCssFile(Yii::app()->theme->baseUrl."/css/style.css");
  $cs->registerCssFile(Yii::app()->theme->baseUrl."/css/style.css");

  $cssAnsScriptFilesModule = array(
    '/js/coController.js',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);
  $cssAnsScriptFilesModule = array(
    '/plugins/bootstrap/css/bootstrap.min.css',
    '/plugins/font-awesome/css/font-awesome.min.css',
    '/plugins/font-awesome-custom/css/font-awesome.css',
    '/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.css',
    
    '/plugins/jQuery/jquery-2.1.1.min.js' , 
    '/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js' ,
    '/plugins/bootstrap/js/bootstrap.min.js' ,
    '/plugins/blockUI/jquery.blockUI.js' ,
    '/js/api.js',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
  ?>
  
  <script type="text/javascript">
  alert("empty")
   var initT = new Object();
   var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
   debug = false;
   </script>
</head>

<body>
<?php 
  echo $content;  
?>
</body>
</html>