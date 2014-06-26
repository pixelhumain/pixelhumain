<?php 
$cs = Yii::app()->getClientScript();

/*$cs->registerCssFile(Yii::app()->theme->baseUrl."../../webarch/assets/plugins/boostrapv3/css/bootstrap.min.css");
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.v1.11.0.js' , CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'../../webarch/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js' , CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'../../webarch/assets/plugins/boostrapv3/js/bootstrap.min.js' , CClientScript::POS_END);

$cs->registerCssFile(Yii::app()->theme->baseUrl."/css/style.css");
$cs->registerCssFile(Yii::app()->theme->baseUrl."/css/font-awesome.min.css");
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/nprogress/nprogress.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/mainLight.js' , CClientScript::POS_HEAD);*/

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <meta name="language" content="fr" />
  <meta name="keywords" lang="fr" content="<?php echo CHtml::encode($this->keywords); ?>">
  <meta name="description" content="<?php echo CHtml::encode($this->description); ?>">
  <meta name="publisher" content="Pixel Humain">
  <meta name="author" lang="fr" content="Pixel Humain" />
  <meta name="robots" content="Index,Follow" />
  <link rel='shortcut icon' type='image/x-icon' href="<?php echo $this->module->assetsUrl?>/img/favicon.ico" />
  <script>
   var initT = new Object();
   var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
   </script>
</head>

<body>
<?php 
  echo $content;  
?>

</body>
</html>