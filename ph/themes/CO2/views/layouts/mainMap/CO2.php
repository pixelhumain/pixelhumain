
<?php 
	//modifier l'url relative si besoin pour trouver communecter/view/sig/
	$relativePath = "co2.views.sig.";

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
        "mapTop" => 20,
        "mapColor" => 'rgb(69, 96, 116)',  //ex : '#456074', //'#5F8295', //'#955F5F', rgba(69, 116, 88, 0.49)
        "mapOpacity" => 0.4, //ex : 0.4

        /* MAP LAYERS (FOND DE CARTE) */
        "mapTileLayer" 	  => '//stamen-tiles-{s}.a.ssl.fastly.net/toner/{z}/{x}/{y}.png', //'', //'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png'
        "mapAttributions" => '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'

        "mapProvider" => $mapProvider,

        //"mapTileLayer" 	  => '//{s}.tile.stamen.com/toner/{z}/{x}/{y}.png', //'//{s}.tile.thunderforest.com/landscape/{z}/{x}/{y}.png', //'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png'
        //"mapAttributions" => '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'

        /* MAP BUTTONS */
        "mapBtnBgColor" => '#2B3136', //'rgba(76, 114, 126, 0.65)', //'#E6D414',
        //"mapBtnColor" => 'rgba(76, 114, 126, 0.65)', //'#213042',
        "mapBtnBgColor_hover" => '#0095FF', //'#5896AB',

        /* USE */
        "titlePanel" 		 => '',
        "usePanel" 			 => true,
        "useFilterType" 	 => true,
        "useRightList" 		 => true,
        "useZoomButton" 	 => true,
        "useHomeButton" 	 => false,
        "useSatelliteTiles"	 => true,
        "useFullScreen" 	 => true,
        "useFullPage" 	 	 => true,
        "useBtnCloseMap"	 => false,
        "useResearchTools" 	 => true,
        "useChartsMarkers" 	 => false,
        "useHelpCoordinates" => false,
        
        "notClusteredTag" 	 => array(),
        "firstView"		  	 => array(  "coordinates" => array(36.59788913307022, 53.78906249999999), 
        //array(-21.156238366109417, 166.497802734375),//array(-1.4061088354351594, -26.015625),
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
	$this->renderPartial($relativePath.'generic.mapLibs', array("sigParams" => $sigParams)); 
	$moduleName = "sigModule".$sigParams['sigKey'];

	/* ***************** modifier l'url si besoin pour trouver ce fichier *******************/
   	//chargement de toutes les librairies css et js indispensable pour la carto
  	$this->renderPartial($relativePath.'generic.mapCss', array("sigParams" => $sigParams));
	$this->renderPartial($relativePath.'generic.mapView', array("sigParams" => $sigParams));
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
		top:70px !important;
		/*background-color: rgba(76, 114, 126, 0.65) !important;*/
	}
	.<?php echo $moduleName; ?> .btn-group-map.tools-btn.input-search-place{
		left: 90px !important;
		/*top:70px !important;*/
		/*background-color: rgba(76, 114, 126, 0.65) !important;*/
	}

	.<?php echo $moduleName; ?> .input-search-place{
		left:22%!important;
		bottom:25px;
		top:unset!important;
		width: 29% !important;
		max-width: 29% !important;
	}

	.<?php echo $moduleName; ?> .panel_map, .panel_filter{
		
	}
	.<?php echo $moduleName; ?> .item_panel_map{
	}
	.<?php echo $moduleName; ?> .item_panel_map:hover{
	}

	.<?php echo $moduleName; ?> #right_tool_map{
		top:60px!important;
		z-index: 0;
		display:none;
	}
	.<?php echo $moduleName; ?> #liste_map_element{}

	.<?php echo $moduleName; ?> #lbl-chk-scope{}

	.<?php echo $moduleName; ?> .bgpixeltree_sig{
		display: none;
	}

	.<?php echo $moduleName; ?> .input-search-place input.input-search-place-in-map{
		width:100%;
		background-color: rgba(38, 44, 50, 0.7) !important;
		border-color: rgba(255, 255, 255, 0.8) !important;
		font-size: 17px;
	}

	.<?php echo $moduleName; ?> .leaflet-popup{
		/*display:none;
		visibility: hidden;*/
	}

	.<?php echo $moduleName; ?> #mapLegende{
		left: 0px !important;
		font-size: 17px !important;
		color: white !important;
		top: 60px;
		border-radius: 0 0 4px 0;
	}


	.<?php echo $moduleName; ?> #dropdown-find-place{
		display: none;
	}

	/*.box-ajax{top:100px;}*/
	
	/* XS */
	@media screen and (max-width: 768px) {
		.<?php echo $moduleName; ?> .mapCanvas{}
		.<?php echo $moduleName; ?> .btn-group-map{}

		.<?php echo $moduleName; ?> .input-search-place{
			left:5%!important;
			width: 90% !important;
			max-width: 90% !important;
		}
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
	var mapBg = null;
	/**************************************************************************************************************/

	//mémorise l'url des assets (si besoin)
	var assetPath 	= "<?php echo $this->module->assetsUrl; ?>";
	var typeSearchInternational = "address";

	var CO2DomainName = "<?php echo @Yii::app()->params["CO2DomainName"]; ?>";

	var initSigParams =  <?php echo json_encode($sigParams); ?>;
	
	jQuery(document).ready(function()
	{
		//création de l'objet SIG
		Sig = SigLoader.getSig();

		//affiche l'icone de chargement
		Sig.showIcoLoading(true);
		//chargement des paramètres d'initialisation à partir des params PHP definis plus haut
		

		//chargement de la carte
		//mapBg = Sig.loadMap("mapCanvas", initSigParams);

		//Sig.showIcoLoading(false);

		$("#right_tool_map").hide('fast');
		
		//showMap(false);
		Sig.userData = <?php echo json_encode($myUser); ?>;


		var timeoutFindPlace;
		$(Sig.cssModuleName + ' .txt-find-place').off().keyup(function(event) { //alert("start custom recherche");
				clearTimeout(timeoutFindPlace);

				var country = CO2DomainName=="kgougle" ? "NC" : "FR";
				var thisInput = this;
				var action =  "";//"Sig.findPlace(1)";//"+$(thisSig.cssModuleName + " #txt-find-place").val()+"')";
				timeoutFindPlace = setTimeout(function(){
					var requestPart = $(thisInput).val();
					typeSearchInternational = "address";
					callNominatim(requestPart, country);
				}, 1000);
			//}
		});

		addResultsInForm = function(commonGeoObj, countryCode){ //surcharge pour la recherche d'addresse
			//success
			mylog.log("addResultsInForm success callGeoWebService CO2");
			//mylog.dir(objs);
			var res = commonGeoObj; //getCommonGeoObject(objs, providerName);
			mylog.dir(res);
			var html = "";
			var id = 0;
			$.each(res, function(key, value){ 
				mylog.log("resultat1 : ",value);
				id++;
				res[key]["id"] = id;
				res[key]["typeSig"] = "address";

				if(CO2DomainName=="kgougle"){ //pour kgougle on supprime tous les resultat en dehors de NC
					var state = typeof res[key]["state"] != "undefined" ? res[key]["state"] : "";
					var country = typeof res[key]["country"] != "undefined" ? res[key]["country"] : "";
					var resCountryCode = typeof res[key]["countryCode"] != "undefined" ? res[key]["countryCode"] : "";
					if(country != "Nouvelle-Calédonie" && state != "Nouvelle-Calédonie")//"NC" )
						res[key] = "";
				}
			});

			
			$.each(res, function(key, value){ 
				mylog.log("resultat2 : ",value);
				if(	notEmpty(value.countryCode) && 
					(	( !notEmpty(value.typeNom) && !notEmpty(value.classNom) ) ||
						( value.typeNom == "house" && value.classNom == "place" ) ||
						( value.typeNom == "residential" && value.classNom == "highway" ) ||
						( value.typeNom == "suburb" && value.classNom == "place" ) ) ){
					//mylog.log("Country Code",value.country.toLowerCase(), countryCode.toLowerCase());
					//if(value.country == "Nouvelle-Calédonie" || value.state == "Nouvelle-Calédonie"){ 
						html += 
						"<li><a href='javascript:' class='item-street-found' "+
								"data-lat='"+value.geo.latitude+"' "+
								"data-lng='"+value.geo.longitude+"'>"+
							 "<i class='fa fa-map-marker'></i> "+value.name+
							 "</a>"+
						"</li>";
					//}
				}
			});

			
			//else html = "";
			mylog.log("NORES", html, res.length);
			if($("#dropdown-newElement_streetAddress-found").length){ //si on a cet id = on est dans formInMap
				if(html=="") 
					html = "<span class='padding-15'><i class='fa fa-ban'></i> Aucun résultat</span>";
				
				$("#dropdown-newElement_streetAddress-found").html(html);
				$("#dropdown-newElement_streetAddress-found").show();			

				$(".item-street-found").click(function(){
					mylog.log(".item-street-found");

					Sig.markerFindPlace.setLatLng([$(this).data("lat"), $(this).data("lng")]);
					Sig.map.panTo([$(this).data("lat"), $(this).data("lng")]);
					Sig.map.setZoom(16);
					mylog.log("lat lon", $(this).data("lat"), $(this).data("lng"));
					$("#dropdown-newElement_streetAddress-found").hide();
					$('[name="newElement_lat"]').val($(this).data("lat"));
					$('[name="newElement_lng"]').val($(this).data("lng"));
					formInMap.NE_lat = $(this).data("lat");
					formInMap.NE_lng = $(this).data("lng");
					formInMap.showWarningGeo(false);
					formInMap.initHtml();
				});
			}else{
				if(html=="") html = "<span class='padding-15'><i class='fa fa-ban'></i> Aucun résultat</span>";
				else html = "";
				showMsgListRes(html);
				Sig.showMapElements(Sig.map, res);	
				
			}
			
		};

		showMsgListRes = function(msg){ mylog.log("showMsgListRes", msg);
			msg = msg != "" ? "<li class='padding-5'>" + msg + "</li>" : "";
			if($("#dropdown-newElement_streetAddress-found").length){ //si on a cet id = on est dans formInMap
				$("#dropdown-newElement_streetAddress-found").html(msg);
			}else{
				$("#liste_map_element").html(msg);
			}
			
		};
	 

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

	function showMapLegende(faIcon, msgText){ console.log("showMapLegende", msgText);

		if(typeof msgText == "undefined" || msgText == null){
			hideMapLegende();
			return;
		}
		if(msgText == ""){ return; }
		
		$("#mapLegende").html("<i class='fa fa-"+faIcon+"'></i> " + msgText);
		$("#mapLegende").show(300);
	}
	function hideMapLegende(){ 
		showMapLegende("", "");
		$("#mapLegende").hide();
	}

	function showIsLoading(show){
		if(show){
			$("#map-loading-data").removeClass("hidden");
		}else{
			$("#map-loading-data").addClass("hidden");
		}

		//setTimeout(function(){ $("#map-loading-data").addClass("hidden"); }, 6000);
	}


	/* affiche les résultat de la recherche dans la div #result (à placer dans l'interface au préalable) */
	var markerListEntity = null;
	
</script>