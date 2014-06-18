<?php 
$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->theme->baseUrl."../../webarch/assets/plugins/boostrapv3/css/bootstrap.min.css");
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.v1.11.0.js' , CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'../../webarch/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js' , CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'../../webarch/assets/plugins/boostrapv3/js/bootstrap.min.js' , CClientScript::POS_END);

$cs->registerCssFile(Yii::app()->theme->baseUrl."/css/style.css");
$cs->registerCssFile(Yii::app()->theme->baseUrl."/css/font-awesome.min.css");
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/index.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/mainLight.js' , CClientScript::POS_HEAD);
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
  $account = (isset(Yii::app()->session["userId"])) ? Yii::app()->mongodb->citoyens->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"]))) : null;

  $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.header');
  echo $content;  
  if(!$this->hasSocial)
    $this->renderPartial('application.views.layouts.modals.loginPwdFormNoSocial');
  else
    $this->renderPartial('application.views.layouts.modals.loginPwdFormNoSocial');
  $this->renderPartial('application.views.layouts.modals.participerSimple',array( "account" => $account));
  $this->renderPartial('application.views.layouts.modals.flashInfo');
?>
<footer class="site-footer">
  <a href="http://pixelhumain.com" target="_blank">
  <img src='<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/logo/logo144.png' alt="PIXELHUMAIN: TOOLKIT CITOYEN LIBRE" title="PIXELHUMAIN: TOOLKIT CITOYEN LIBRE"/>
  </a>
</footer>
</body>
</html>