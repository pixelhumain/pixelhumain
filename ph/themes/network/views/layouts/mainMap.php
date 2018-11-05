
<?php 
	//modifier l'url relative si besoin pour trouver communecter/view/sig/
	$relativePath = "../sig/";

	$mapProvider = "OSM";
	if(PH::notlocalServer()){
		//error_log("NOT LOCAL");
		if(Yii::app()->params["mapboxActive"]==true)
		$mapProvider = "mapbox";
	}else{
		//error_log("LOCAL");
		$mapProvider = "OSM";
		if(Yii::app()->params["forceMapboxActive"]==true)
			$mapProvider = "mapbox";
	}

	//modifier les parametre en fonction des besoins de la carte
	$sigParams = array(
        "sigKey" => "Bg",

        /* MAP */
        "mapHeight" => 235,
        "mapTop" => 0,
        "mapColor" => 'rgb(69, 96, 116)',  //ex : '#456074', //'#5F8295', //'#955F5F', rgba(69, 116, 88, 0.49)
        "mapOpacity" => 0.4, //ex : 0.4

        /* MAP LAYERS (FOND DE CARTE) */
        "mapTileLayer" 	  => '//stamen-tiles-{s}.a.ssl.fastly.net/toner/{z}/{x}/{y}.png', //'', //'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png'
        "mapAttributions" => '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'

        "mapProvider" => $mapProvider,

        //"mapTileLayer" 	  => '//{s}.tile.stamen.com/toner/{z}/{x}/{y}.png', //'//{s}.tile.thunderforest.com/landscape/{z}/{x}/{y}.png', //'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png'
        //"mapAttributions" => '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'

        /* MAP BUTTONS */
        //"mapBtnBgColor" => '#4C727E', //'rgba(76, 114, 126, 0.65)', //'#E6D414',
        //"mapBtnColor" => 'rgba(76, 114, 126, 0.65)', //'#213042',
        //"mapBtnBgColor_hover" => 'rgba(76, 114, 126, 0.65)', //'#5896AB',

        /* USE */
        "titlePanel" 		 => '',
        "usePanel" 			 => true,
        "useFilterType" 	 => true,
        "useRightList" 		 => true,
        "useZoomButton" 	 => true,
        "useHomeButton" 	 => true,
        "useSatelliteTiles"	 => true,
        "useFullScreen" 	 => true,
        "useFullPage" 	 	 => true,
        "useResearchTools" 	 => false,
        "useChartsMarkers" 	 => false,
        "useHelpCoordinates" => false,
        
        "notClusteredTag" 	 => array(),
        "firstView"		  	 => array(  "coordinates" => array(23.725011735951796, 71.3671875),//array(-1.4061088354351594, -26.015625),
									 	"zoom"		  => 3),
    );
 
 	
	if(!isset(Yii::app()->session['userId'])){
		$sigParams["useHomeButton"] = false;
	}

	if(@Yii::app()->params["forceMapboxActive"] == true || @Yii::app()->params["mapboxActive"] == true){
		if(@Yii::app()->params["mapboxToken"])
			$sigParams["mapboxToken"] = Yii::app()->params["mapboxToken"];
	}

	
	
	/* ***********************************************************************************/
	//chargement de toutes les librairies css et js indispensable pour la carto
	$this->renderPartial($relativePath.'generic/mapLibs', array("sigParams" => $sigParams)); 
	$moduleName = "sigModule".$sigParams['sigKey'];

	/* ***************** modifier l'url si besoin pour trouver ce fichier *******************/
   	//chargement de toutes les librairies css et js indispensable pour la carto
  	$this->renderPartial($relativePath.'generic/mapCss', array("sigParams" => $sigParams));
	$this->renderPartial($relativePath.'generic/mapView', array("sigParams" => $sigParams));
	//$this->renderPartial('addOrganizationMap'); var_dump($sigParams); die();

	
?>
<style>


	.<?php echo $moduleName; ?>{
		/*z-index:-5;*/
	}

	.<?php echo $moduleName; ?> .mapCanvas{
		position:relative !important;
		width:100% !important;
		height:100% !important;
		background-color: <?php echo $sigParams["mapColor"]; ?> !important; 
	}
	.<?php echo $moduleName; ?>{
		width: 100% !important;
		height: 100% !important;
		position: fixed;
		top:0px;
		left:0px;
	}
	.<?php echo $moduleName; ?> .input-search-place{
	/*	right:unset;
		left:100px !important;
		margin-right: 30px !important;
		max-width: 254px !important;
		z-index:100!important;*/
	}
	.<?php echo $moduleName; ?> .input-search-place input.input-search-place-in-map{
		background-color: rgba(42, 57, 69, 0.7) !important; /*rgba(111, 161, 177, 0.74) !important;*/
	}
	.<?php echo $moduleName; ?> .btn-group-map{
		top:70px !important;
		display:none;
	}
	.<?php echo $moduleName; ?> .btn-group-map.tools-btn{
		left: unset; /*90px !important;*/
		top:100px !important;
		right:35px !important;
		width:50px;
		/*background-color: rgba(76, 114, 126, 0.65) !important;*/
	}
	.<?php echo $moduleName; ?> .btn-group-map.tools-btn.input-search-place{
		left: 90px !important;
		top:70px !important;
		/*background-color: rgba(76, 114, 126, 0.65) !important;*/
	}

	.<?php echo $moduleName; ?> .panel_map, .panel_filter{
		
	}
	.<?php echo $moduleName; ?> .item_panel_map{
	}
	.<?php echo $moduleName; ?> .item_panel_map:hover{
	}

	.<?php echo $moduleName; ?> #right_tool_map{
		top:70px;
		z-index: 0;
		display:none;
		margin-right: 45px;
		margin-top: 70px;
	}
	.<?php echo $moduleName; ?> #liste_map_element{}

	.<?php echo $moduleName; ?> #lbl-chk-scope{}


	.leaflet-popup{
		/*display:none;
		visibility: hidden;*/
	}

	/*.box-ajax{top:100px;}*/
	
	/* XS */
	@media screen and (max-width: 768px) {
		.<?php echo $moduleName; ?> .mapCanvas{}
		.<?php echo $moduleName; ?> .btn-group-map{}
	}
</style>
<?php 
	$myId = Yii::app()->session['userId'];
	$myUser = Person::getById($myId);
?>
<script type="text/javascript">

	var Sig;
		
	/**************************** DONNER UN NOM DIFFERENT A LA MAP POUR CHAQUE CARTE ******************************/
	//le nom de cette variable doit changer dans chaque vue pour éviter les conflits (+ vérifier dans la suite du script)
	var mapBg;
	/**************************************************************************************************************/

	//mémorise l'url des assets (si besoin)
	var assetPath 	= "<?php echo $this->module->assetsUrl; ?>";

	jQuery(document).ready(function()
	{
		//création de l'objet SIG
		Sig = SigLoader.getSig();

		//affiche l'icone de chargement
		Sig.showIcoLoading(true);
		//chargement des paramètres d'initialisation à partir des params PHP definis plus haut
		var initParams =  <?php echo json_encode($sigParams); ?>;
	

		//chargement de la carte
		mapBg = Sig.loadMap("mapCanvas", initParams);

		Sig.showIcoLoading(false);

		$("#right_tool_map").hide('fast');
		
		//showMap(false);
		Sig.userData = <?php echo json_encode($myUser); ?>;

	});

	function openMainPanelFromPanel(url, title, icon, id){
		$(Sig.cssModuleName + " .item_map_list_" + id).click();
		openMainPanel(url, title, icon, id);
	}

	function openMainPanel(url, title, icon, id){
		showAjaxPanel(url, title, icon);
		showMap(false);
		
		if(Sig.currentMarkerPopupOpen == null) return;
		var latlng = Sig.currentMarkerPopupOpen.getLatLng();
		
		Sig.centerSimple(latlng, 14);
		
		Sig.hidePopupContent(id);
	}

	function showMapLegende(faIcon, msgText){
		$("#mapLegende").html("<i class='fa fa-"+faIcon+"'></i> " + msgText);
		$("#mapLegende").show(300);
	}
	function hideMapLegende(){
		showMapLegende("", "");
		$("#mapLegende").hide();
	}

	function showIsLoading(show){
		/*if(show){
			$("#map-loading-data").removeClass("hidden");
		}else{
			$("#map-loading-data").addClass("hidden");
		}*/

		$("#map-loading-data").addClass("hidden");

		//setTimeout(function(){ $("#map-loading-data").addClass("hidden"); }, 6000);
	}

	// function showMap(show){
		
	// 	if(show === undefined) show = $("#right_tool_map").css("display") == "none";
	// 	if(show){
			
	// 		if(Sig.currentMarkerPopupOpen != null){
	// 			Sig.currentMarkerPopupOpen.fire('click');
	// 		}

	// 		$(".sigModuleBg").show( 700 );
	// 		$(".btn-group-map").show( 700 );
	// 		$("#right_tool_map").show(700);
	// 		$("#btn-show-map").html("<i class='fa fa-list'></i>");

	// 		if($(".box-add").css("display") == "block"){
	// 			$(".box-add").hide(700);
	// 		}
	// 		else if($(".box-communecter").css("display") == "block"){
	// 			$(".box-communecter").hide(700);
	// 		}else{
	// 			$("#ajaxSV").hide( 700 );
	// 		}
	// 		var timer = setTimeout("Sig.constructUI()", 1000);
			
	// 	}else{
			
	// 		$(".btn-group-map").hide( 700 );
	// 		$("#right_tool_map").hide(700);
	// 		$(".panel_map").hide(1);
	// 		$("#btn-show-map").html("<i class='fa fa-map'></i>");
			
	// 		if(Sig.currentMarkerPopupOpen != null){
	// 			Sig.currentMarkerPopupOpen.closePopup();
	// 		}

	// 		if($(".box-add").css("display") == "none" && <?php echo isset(Yii::app()->session['userId']) ? "true" : "false"; ?>)
	// 			$("#ajaxSV").show( 700 );
	// 	}
		
	// }

</script>


<style type="text/css">
<?php /*if(@Yii::app()->session['custom']){ ?>
.sigModuleBg {
	top:300px;
}
<?php } */?>
</style>