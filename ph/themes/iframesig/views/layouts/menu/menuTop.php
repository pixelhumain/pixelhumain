<?php  HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/menuTop.css')); ?>
<div class="col-xs-12 main-top-menu no-padding"  style="top:0px!important; bottom:unset!important;" data-tpl="default.menu.menuTop">
	
	<?php // BTN CO = Live // ?>
	<center><a class="tooltips" href="https://communecter.org"  target="_blank"
		data-toggle="tooltip" data-placement="top" 
		title="Afficher les détails"
		alt="Afficher les détails" id="menuParentName">
		
	</a></center>
	

	<?php $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
		  $this->renderPartial($layoutPath."./menu/short_info_profil", array("me"=>$me)); ?> 

</div>

<div class="col-xs-12 main-top-menu no-padding"  data-tpl="default.menu.menuTop">
	
	<?php // BTN CO = Live // ?>
	<center><a class="tooltips" href="https://communecter.org"  target="_blank"
		data-toggle="tooltip" data-placement="bottom" 
		title="Aller sur communecter.org" 
		alt="Aller sur communecter.org">
		<img class="" id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/>
	</a></center>
	

	<?php $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
		  $this->renderPartial($layoutPath."./menu/short_info_profil", array("me"=>$me)); ?> 

</div>
