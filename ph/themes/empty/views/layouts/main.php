<!DOCTYPE html>
<html>
<head>
  <?php 
  $cs = Yii::app()->getClientScript();

  $themeAssetsUrl = Yii::app()->theme->baseUrl.'../../ph-dori/assets';

  $cs->registerCssFile($themeAssetsUrl.'/plugins/bootstrap/css/bootstrap.min.css');
  $cs->registerCssFile($themeAssetsUrl.'/plugins/font-awesome/css/font-awesome.min.css');
  $cs->registerCssFile($themeAssetsUrl.'/plugins/font-awesome-custom/css/font-awesome.css');
  $cs->registerCssFile($themeAssetsUrl.'/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.css');
  $cs->registerCssFile(Yii::app()->theme->baseUrl."/css/style.css");

  $cs->registerScriptFile($themeAssetsUrl.'/plugins/jQuery/jquery-2.1.1.min.js' , CClientScript::POS_HEAD);
  $cs->registerScriptFile($themeAssetsUrl.'/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js' , CClientScript::POS_END);
  $cs->registerScriptFile($themeAssetsUrl.'/plugins/bootstrap/js/bootstrap.min.js' , CClientScript::POS_END);
  $cs->registerScriptFile($themeAssetsUrl.'/plugins/blockUI/jquery.blockUI.js' , CClientScript::POS_END);

  ?>
  
  <script type="text/javascript">
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