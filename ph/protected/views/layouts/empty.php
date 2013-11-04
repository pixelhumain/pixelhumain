<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="fr" />
	<meta name="keywords" lang="fr" content="initiative, citoyen, entreprise,association, collectivité, démocratie, participative, Réunion, discussion , actions et réseau local">
	<meta name="description" content="Un projet citoyen de Démocratie Participative. Une plateforme de discussions et d'actions citoyennes sur un réseau local. Une passerelle entre nous et avec l’État.">
	<meta name="publisher" content="Pixel Humain">
	<meta name="author" lang="fr" content="Pixel Humain" />
	<meta name="robots" content="Index,Follow" />
	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/logo/favicon.gif" />
   <title><?php echo CHtml::encode($this->pageTitle); ?></title>
   
   <script>
   var initT = new Object();
   </script>
</head>

<body>

<?php echo $content; ?>
	
<?php 
$cs = Yii::app()->getClientScript();
//$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/mainLight.js' , CClientScript::POS_END);
?>	        

</body>
</html>
