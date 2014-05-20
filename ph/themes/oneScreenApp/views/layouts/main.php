<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Communecter : Connecter a sa commune, reseau societal, le citoyen au centre de la société.</title>
  <meta name="language" content="fr" />
  <meta name="keywords" lang="fr" content="connecter, réseau, sociétal, citoyen, société, regrouper, commune, communecter, social">
  <meta name="description" content="Communecter : Connecter a sa commune, reseau societal, le citoyen au centre de la société.">
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