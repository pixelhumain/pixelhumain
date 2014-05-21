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
  <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/css/style.css" media="screen" type="text/css" />
  
  <script src='<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.v1.11.0.js'></script>
</head>

<body>
  <?php 
    $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.header');
    echo $content;  
  ?>
  
  <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/index.js"></script>
</body>
</html>