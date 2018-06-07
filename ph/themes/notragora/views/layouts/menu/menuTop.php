<style>
	.searchPoiContainer{
		position:relative;
		display: inline;
		display: -webkit-inline-box;
		display: -moz-inline-box;
	}

	#poiSelectedHead {
		font-size: 18px;
		height: 50px;
		padding: 12px;
		display : none;
	}
</style>
<?php  HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/menuTop.css'), Yii::app()->theme->baseUrl);
	$topList = Poi::getPoiByTagsAndLimit();
	$tagsPoiList = array();

	shuffle($topList);
	foreach ($topList as $key => $elem)
	{
		if(@$elem["tags"]){
			foreach($elem["tags"] as $tagKey => $val){
				$topList[$key]["tags"][$tagKey] = strtolower( InflectorHelper::slugify2( $val ));
				if(!in_array($val,Poi::$collectionsList) && !in_array($val,Poi::$genresList)){
					$found = false;
					foreach ($tagsPoiList as $ix => $value) {
						if($value["text"] == $val)
							$found = $ix;
					}
					if ( !$found )
						array_push($tagsPoiList,array(
								"text"=>$val,
								"weight"=>1,
								"link"=>array(
									"href" => 'javascript:addItemsToSly("'.InflectorHelper::slugify2($val).'")',
									"class" => "favElBtn ".InflectorHelper::slugify2($val)."Btn",
									"data-tag" => InflectorHelper::slugify2($val)
								)
							)
						);
					else
						$tagsPoiList[$found]["weight"]++;
				}
			}
		}
		if(@$elem["medias"] && @$elem["medias"][0]["content"]["image"] && !empty($elem["medias"][0]["content"]["image"])){
			$topList[$key]["profilExternImageUrl"] = str_replace("1280x720","720x720",$elem["medias"][0]["content"]["image"]);
		}	else {
			$topList[$key]["profilExternImageUrl"] = $this->module->assetsUrl."/images/thumbnail-default.jpg";
		}

		$topList[$key]["typeSig"] = "poi";
		$topList[$key]["href"] = "#element.detail.type.".Poi::COLLECTION.".id.".(string)$elem["_id"];
		if (@$elem["description"]){
			$topList[$key]["description"]=strip_tags($elem["description"]);
		} else
			$topList[$key]["description"]= "<i>Pas de description sur cette production</i>";
	}
?>

<div class="col-xs-12 main-top-menu no-padding"  data-tpl="default.menu.menuTop" <?php if (empty($topList)) { ?> style="height:50px !important;" <?php } ?>>
	<?php if (!empty($topList)) { ?>
	<div class="col-xs-12 no-padding main-gallery-top" >
		<div class="pull-left frame" id="cycleitems" >
			<ul class="slidee">

			</ul>
		</div>
	</div>
	<?php } ?>

	<?php  //BTN NOTRAGORA // ?>
	<a class="pull-left tooltips hidden-xs lbh col-md-2" href="#default.home"  id="main-btn-co"
		data-toggle="tooltip" data-placement="bottom"
		title="NotrAgora"
		alt="NotrAgora">
		<img class="" id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/logoNotragoraMenu.png"/>
	</a>

	<?php // BTN Doc = Doc // ?>
	<button class="btn-menu-top tooltips pull-left lbh"  onclick="activeMenuTop($(this))"
			id="" data-hash="#default.home"
			data-toggle="tooltip" data-placement="bottom" title="Accueil" alt="Accueil">
			<i class="fa fa-home"></i>
	</button>

	<?php // BTN Doc = Doc // ?>
	<button class="btn-menu-top tooltips pull-left lbh"  onclick="activeMenuTop($(this))"
			id="" data-hash="#default.directoryjs?type=organizations"
			data-toggle="tooltip" data-placement="bottom" title="Groupe de travail" alt="Groupe de travail">
			<i class="fa fa-group"></i>
	</button>

	<?php // BTN Doc = Doc // ?>
	<button class="btn-menu-top tooltips pull-left lbh"
			id="" data-hash="#default.directoryjs?type=poi" onclick="activeMenuTop($(this))"
			data-toggle="tooltip" data-placement="bottom" title="Productions" alt="Productions">
			<i class="fa fa-video-camera"></i>
	</button>
	
	<button class="btn-menu-top tooltips pull-left" 
	        id="btn-toogle-map"
	        data-toggle="tooltip" data-placement="bottom" title="Carte" alt="Carte">
	      <i class="fa fa-map"></i>
	</button>

	<?php // BTN Doc = Doc // ?>
	<button class="btn-menu-top tooltips pull-left lbh"  onclick="activeMenuTop($(this))"
			id="" data-hash="#default.apropos"
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
	<span class="btn-menu-top tooltips pull-right"  id="poiSelectedHead">
		<span id="tagSelectedHead" class="text-red"></span> 
		Vous avez selectionnés <span id="countPoiHead" class="text-green"></span>
		<button class="btn-menu-top tooltips text-red"  onclick="addItemsToSly()"
				data-toggle="tooltip" data-placement="bottom" title="Supprimer le tag sélectionné" alt="Supprimer le tag sélectionné">
				<i class="fa fa-trash"></i>
		</button>
	</span>
</div>
<script>
	var poiListTags = <?php echo json_encode($tagsPoiList) ?>;
	var topList = <?php echo json_encode($topList) ?>;

	function activeMenuTop(thisJQ){
		$(".btn-menu-top").removeClass("active");
		thisJQ.addClass("active");
	}
	var slyOptions = {
		slidee : '.slidee',
		horizontal: 1,
		itemNav: 'centered',
		smart: 1,
		activateOn: 'click',
		mouseDragging: 1,
		touchDragging: 1,
		releaseSwing: 1,
		startAt: 0,
		//scrollBar: $wrap.find('.scrollbar'),
		scrollBy: 1,
		speed: 1000,
		elasticBounds: 1,
		easing: 'linear',
		dragHandle: 1,
		dynamicHandle: 1,
		clickBar: 1,

		// Cycling
		cycleBy: 'items',
		cycleInterval: 2500,
		pauseOnHover: 1,
	}
	
	function addItemsToSly(tagFilter){

		console.log("addItemsToSly", tagFilter, topList);
		//removeAll
		$(".slidee .searchPoiContainer").remove();
		//filter topList
		if(tagFilter){
			var filteredTopList = topList.filter(item => ( typeof item.tags != "undefined" ? item.tags.includes(tagFilter) : null ) );
		}
		else {
			var filteredTopList = topList;
		}
		var count = 0;
		for (var topElem of filteredTopList) {
			var elem = '<li class="searchPoiContainer">' +
				'<span class="item-galley-top">' +
					'<a href="'+ topElem.href +'" class="lbh">' +
						'<img src="'+ topElem.profilExternImageUrl +'" class="img-galley-top">' +
					'</a>' +
				'</span>' +
				'<span class="description-poi" style="display: none;">' +
					'<div>' +
						'<h3>'+ topElem.name + '</h3>' +
						'<span class="poiTopDescription">' + topElem.description +'</span>' +
					'</div>' +
					'<a href="' + topElem.href +' " class="btn btn-dark-grey lbh"> Voir la réalisation </a>' +
				'</span>' +
			'</li>';
			count++;
			sly.add(elem);
		}

		sly.activate(5);

		if(typeof tagFilter != "undefined"){
			$("#tagSelectedHead").html("#" + tagFilter);
			$("#countPoiHead").html(count + " productions");
			$("#poiSelectedHead").show();
		}else{
			$("#poiSelectedHead").hide();
		}
		
		$(".searchPoiContainer").mouseenter(function(){
			$(this).find(".description-poi").show();
		}).mouseleave(function(){
			$(this).find(".description-poi").hide();
		});

		bindLBHLinks();
	}

	jQuery(document).ready(function() {
		sly = new Sly('#cycleitems', slyOptions).init(); 
		addItemsToSly();
		
		Sig.showMapElements(Sig.map, topList);
	});
</script>
