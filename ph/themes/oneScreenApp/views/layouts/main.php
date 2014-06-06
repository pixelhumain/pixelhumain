<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->theme->baseUrl."/css/style.css");
$cs->registerCssFile(Yii::app()->theme->baseUrl."/css/font-awesome.min.css");
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.v1.11.0.js' , CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery-ui/jquery-ui-1.10.1.custom.min.js' , CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/js/index.js' , CClientScript::POS_END);
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
</head>

<body>
  <?php 
    $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.header');
    echo $content;  
  ?>
</body>
</html>