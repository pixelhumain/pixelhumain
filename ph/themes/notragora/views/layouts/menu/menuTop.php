<style>
	.searchPoiContainer{
		position:relative;
		display: inline;
		display: -webkit-inline-box;
		display: -moz-inline-box;
	}
</style>
<?php  HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/menuTop.css'), Yii::app()->theme->baseUrl); 
	$topList = Poi::getPoiByTagsAndLimit();
	$tagsPoiList = array();
?>

<div class="col-xs-12 main-top-menu no-padding"  data-tpl="default.menu.menuTop">
	
	<?php if (!empty($topList)) { ?>
	<div class="col-xs-12 no-padding main-gallery-top" >
		<div class="pull-left">
		<?php foreach ($topList as $data) { 
			if(@$data["tags"]){
				foreach($data["tags"] as $val){
					if (!in_array($val, $tagsPoiList)) 
						array_push($tagsPoiList,$val);
				}
			}
			if(@$data["medias"] && @$data["medias"][0]["content"]["image"] && !empty($data["medias"][0]["content"]["image"]))
				$src = str_replace("1280x720","720x720",$data["medias"][0]["content"]["image"]);
			else 
				$src = $this->module->assetsUrl."/images/thumbnail-default.jpg";
			$name = $data["name"];
			$tags = "";
			if (@$data["tags"])
				$tags = strtolower(implode(" ", $data["tags"]));
			$href = "#element.detail.type.".Poi::COLLECTION.".id.".(string)$data["_id"];
		?>
			<div class="searchPoiContainer <?php echo $tags ?>">
				<span class="item-galley-top">
					<a href="<?php echo $href ?>" class="lbh">
						<img src="<?php echo $src ?>" class="img-galley-top">
					</a>
				</span>
				<span class="description-poi" style="display:none;">
					<h3><?php echo $data["name"]; ?></h3>
					<?php if (@$data["description"]){ 
						$description=strip_tags($data["description"]);
						if(strlen ( $description) > 140)
							$description=substr($description, 0, 140)."[...]";
						} else
							$description= "Pas de description sur cette production";
					?>
					<span class="poiTopDescription"><?php echo $description ?></span>
					<a href="<?php echo $href ?>" class="btn btn-dark-grey lbh">
						Voir la réalisation
					</a>
				</span>
			</div>
		<?php } ?>
		</div>
	</div>
	<?php } ?>

	<?php  //BTN NOTRAGORA // ?>
	<a class="pull-left tooltips hidden-xs lbh col-md-2" href="#default.home"  id="main-btn-co"
		data-toggle="tooltip" data-placement="bottom" 
		title="NotrAgora" 
		alt="NotrAgora">
		NotrAgora
		<!-- <img class="" id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/> -->
	</a>
	
	<?php // BTN Doc = Doc // ?>
	<button class="btn-menu-top tooltips pull-left lbh"  onclick="activeMenuTop($(this))"
			id="" data-hash="#default.home"
			data-toggle="tooltip" data-placement="bottom" title="Accueil" alt="Accueil">
			<i class="fa fa-home"></i>
	</button>
	
	<?php // BTN Doc = Doc // ?>
	<button class="btn-menu-top tooltips pull-left lbh"  onclick="activeMenuTop($(this))"
			id="" data-hash="#default.directoryjs?type=projects"
			data-toggle="tooltip" data-placement="bottom" title="Groupe de travail" alt="Groupe de travail">
			<i class="fa fa-group"></i>
	</button>
	
	<?php // BTN Doc = Doc // ?>
	<button class="btn-menu-top tooltips pull-left lbh" 
			id="" data-hash="#default.directoryjs?type=poi" onclick="activeMenuTop($(this))"
			data-toggle="tooltip" data-placement="bottom" title="Productions" alt="Productions">
			<i class="fa fa-video-camera"></i>
	</button>
	
	<?php // BTN Doc = Doc // ?>
	<button class="btn-menu-top tooltips pull-left active lbh"  onclick="activeMenuTop($(this))"
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
<script>
	var poiListTags = <?php echo json_encode($tagsPoiList) ?>;
	
	function activeMenuTop(thisJQ){
		$(".btn-menu-top").removeClass("active");
		thisJQ.addClass("active");
	}
	jQuery(document).ready(function() {
		$(".searchPoiContainer").mouseenter(function(){
			$(this).find(".description-poi").show();
		}).mouseleave(function(){
			$(this).find(".description-poi").hide();
		});
	});
</script>