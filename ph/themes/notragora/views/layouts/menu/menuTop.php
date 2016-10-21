<?php  HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/menuTop.css')); ?>

<div class="col-xs-12 main-top-menu no-padding"  data-tpl="default.menu.menuTop">
	<div class="col-xs-12 no-padding main-gallery-top">
		<div class="pull-left">
		<?php for($i=0;$i<12;$i++){ ?>
			<span class="item-galley-top">
				<img src="<?php echo $this->module->assetsUrl?>/images/NA.png" class="img-galley-top">
			</span>
		<?php } ?>
		</div>
	</div>
	
	<?php  //BTN NOTRAGORA // ?>
	<a class="pull-left tooltips hidden-xs lbh col-md-2" href="#default.live"  id="main-btn-co"
		data-toggle="tooltip" data-placement="bottom" 
		title="NotrAgora" 
		alt="NotrAgora">
		NotrAgora
		<!-- <img class="" id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/> -->
	</a>
	
	<?php // BTN Doc = Doc // ?>
	<button class="btn-menu-top tooltips pull-left" 
			id="" data-hash="#default.view.page.index.dir.docs"
			data-toggle="tooltip" data-placement="bottom" title="Accueil" alt="Accueil">
			<i class="fa fa-home"></i>
	</button>
	
	<?php // BTN Doc = Doc // ?>
	<button class="btn-menu-top tooltips pull-left" 
			id="" data-hash="#default.view.page.index.dir.docs"
			data-toggle="tooltip" data-placement="bottom" title="Groupe de travail" alt="Groupe de travail">
			<i class="fa fa-group"></i>
	</button>
	
	<?php // BTN Doc = Doc // ?>
	<button class="btn-menu-top tooltips pull-left" 
			id="" data-hash="#default.view.page.index.dir.docs"
			data-toggle="tooltip" data-placement="bottom" title="Productions" alt="Productions">
			<i class="fa fa-video-camera"></i>
	</button>
	
	<?php // BTN Doc = Doc // ?>
	<button class="btn-menu-top tooltips pull-left active" 
			id="" data-hash="#default.view.page.index.dir.docs"
			data-toggle="tooltip" data-placement="bottom" title="A propos" alt="A propos">
			<i class="fa fa-star"></i>
	</button>

	

	<?php // MAIN TITLE // ?>
	<!-- <h1 class="homestead text-dark no-padding moduleLabel hidden-xs	
			    <?php if(!isset(Yii::app()->session['userId'])) echo 'offline'; ?>" id="main-title"
		style="font-size:18px;margin-bottom: 0px; display: inline-block;">
	</h1> -->
	
	<?php // BTN MY COMMUNITY (ONLY LOGED) // ?>
	<?php if(isset(Yii::app()->session['userId'])){ ?>
	<!-- <button class="btn-menu btn-menu-top bg-white text-dark tooltips pull-right" id="btn-show-floopdrawer" 
			onclick="showFloopDrawer(true)"
			data-toggle="tooltip" data-placement="bottom" title="Communautés" alt="Afficher mon réseau">
			<i class="fa fa-group"></i>
	</button> -->
	<?php } ?>

	<?php $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.'; ?>
	<?php $this->renderPartial($layoutPath.'.menu.short_info_profil', array("me"=>$me)); ?> 

</div>
