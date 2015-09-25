
<?php 
	//modifier l'url relative si besoin pour trouver communecter/view/sig/
	$relativePath = "../sig/";
	
   	//modifier les parametre en fonction des besoins de la carte
	$sigParams = array(
        "sigKey" => "Bg",

        /* MAP */
        "mapHeight" => 235,
        "mapTop" => 0,
        "mapColor" => '',  //ex : '#456074', //'#5F8295', //'#955F5F', rgba(69, 116, 88, 0.49)
        "mapOpacity" => 1, //ex : 0.4

        /* MAP LAYERS (FOND DE CARTE) */
        "mapTileLayer" 	  => 'http://{s}.tile.thunderforest.com/landscape/{z}/{x}/{y}.png', //'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png'
        "mapAttributions" => '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'

        /* MAP BUTTONS */
        "mapBtnBgColor" => 'rgba(76, 114, 126, 0.65)', //'#E6D414',
        //"mapBtnColor" => 'rgba(76, 114, 126, 0.65)', //'#213042',
        //"mapBtnBgColor_hover" => 'rgba(76, 114, 126, 0.65)', //'#5896AB',

        /* USE */
        "titlePanel" 		 => '',
        "usePanel" 			 => false,
        "useFilterType" 	 => false,
        "useRightList" 		 => true,
        "useZoomButton" 	 => true,
        "useHomeButton" 	 => true,
        "useFullScreen" 	 => true,
        "useFullPage" 	 	 => true,
        "useResearchTools" 	 => true,
        "useChartsMarkers" 	 => false,
        "useHelpCoordinates" => true,
        
        "notClusteredTag" 	 => array(),
        "firstView"		  	 => array(  "coordinates" => array(-21.219343584637794, 55.54756164550781),
									 	"zoom"		  => 11),
    );
 
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

	.<?php echo $moduleName; ?> .mapCanvas{
		position:relative !important;
		width:100% !important;
		height:100% !important;
	}
	.<?php echo $moduleName; ?>{
		width: 100% !important;
		height: 100% !important;
		position: fixed;
		top:0px;
		left:0px;
	}
	.<?php echo $moduleName; ?> .input-search-place{
		right:unset;
		left:100px !important;
		margin-right: 30px !important;
		max-width: 254px !important;
		z-index:100!important;
	}
	.<?php echo $moduleName; ?> .input-search-place input.input-search-place-in-map{
		background-color: rgba(111, 161, 177, 0.74) !important;
	}
	.<?php echo $moduleName; ?> .btn-group-map		{
		left: unset;
		top:50px !important;
		right:30px;
		/*background-color: rgba(76, 114, 126, 0.65) !important;*/
	}
	.<?php echo $moduleName; ?> .item_panel_map			{
	}
	.<?php echo $moduleName; ?> .item_panel_map:hover	{
	}

	.<?php echo $moduleName; ?> #right_tool_map		{

	}
	.<?php echo $moduleName; ?> #liste_map_element	{}

	.<?php echo $moduleName; ?> #lbl-chk-scope		{}

	li.mix{
		background:rgba(255, 255, 255, 0.3) !important;
	}
	
	.box-ajax{
		top:100px !important;
	}

	.leaflet-popup{
		display:none;
		visibility: hidden;
	}

	/* XS */
	@media screen and (max-width: 768px) {
		.<?php echo $moduleName; ?> .mapCanvas{}
		.<?php echo $moduleName; ?> .btn-group-map{}
	}
</style>
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
		//$(".sigModuleBg").addClass("hidden");
		//$(".sigModuleBg").css({"display" : "none"});
		
		//création de l'objet SIG
		Sig = SigLoader.getSig();

		//surcharge la fonction getMarkerSingle pour ouvrir le panel au click sur le marker
		Sig.getMarkerSingle = function(thisMap, options, coordinates)
		{
			console.warn("--------------- getMarkerSingle ---------------------");
			var contentString = options.content;
			if(options.content == null) contentString = "info window";

			var markerOptions = { icon : options.icon };

			var marker = L.marker(coordinates, markerOptions)
							.addTo(thisMap)
							.bindPopup(contentString);

			this.markerSingleList.push(marker);

			marker.on('click', function(e) {
					marker.openPopup();
					//url = "showAjaxPanel( baseUrl+'/'+moduleId+'/".$type."/detail/id/".$id."', '".$type." : ".$name."','".$icon."' )";
					alert(option.id);
					if("undefined" != options.type) {
						var type = options.type;
						//showAjaxPanel( baseUrl+'/'+moduleId+'/' + type + '/detail/id/' + options.id, type + ' : ' + options.name, '' );
					}
			});
			return marker;
		};

		Sig.showMapElements = function(thisMap, data)
		{
			console.warn("--------------- showMapElements ---------------------");

			if(data == null) return;

			var filterPanelValue = "citoyens";
			//enregistre les dernières données dans une variable locale
			this.dataMap = data;
			//alert("datas : " + JSON.stringify(this.dataMap));
			//efface les elements de la carte si elle n'est pas vide
			if(this.markersLayer != "") this.clearMap(thisMap);

			//conteneur de marker cluster
			this.markersLayer = new L.MarkerClusterGroup({"maxClusterRadius" : 40});
			thisMap.addLayer(this.markersLayer);

			//collection de marker geojson
			this.geoJsonCollection = { type: 'FeatureCollection', features: new Array() };

			this.showIcoLoading(true);

			//on affiche les data filtre par filtre
			var thisSig = this;
			//var array = new Array();

			var len = 0;
			$.each(data, function (key, value){ len++; });//alert("len : " + len);
			if(len > 1){
				$.each(data, function (key, value){
					console.warn("key");
					console.log(key);
					//console.log(value);

					thisSig.showFilterOnMap(data, key, thisMap);
				});
			}else{
				thisSig.showOneElementOnMap(data, thisMap);
			}

			var points = L.geoJson(this.geoJsonCollection, {				//Pour les clusters seulement :
					onEachFeature: function (feature, layer) {				//sur chaque marker
						var id = feature.properties.id;
						console.dir(feature);
						layer.setIcon(feature["properties"]["icon"]);	   	//affiche l'icon demandé
						layer.on('click', function(e) {							
							$("a[data-id='"+id+"']").click();
						});
						
						//au click sur un element de la liste de droite, on zoom pour déclusturiser, et on ouvre la bulle
						$(thisSig.cssModuleName + " .item_map_list_" + feature.properties.id).click(function(){
							thisMap.setView([	feature.geometry.coordinates[1],
										  		feature.geometry.coordinates[0]],
										  		13, {"animate" : true });

							var onclick = getActionsById(id); //$("a[data-id='"+id+"']").attr('onclick');
							console.log(onclick);
							//showAjaxPanel( baseUrl+'/'+moduleId+'/organization/detail/id/54eed32ca1aa143e020041c4', 'organization : TEEO','fa-users' );
							setTimeout(onclick, 1);
							$("#right_tool_map").hide('fast');

							finalShowMarker();
							thisSig.checkListElementMap(thisMap);
						});
						//console.warn("--------------- showMapElements click OK  ---------------------");

					}
				});
				//console.warn("--------------- showMapElements  onEachFeature OK ---------------------");

				this.markersLayer.addLayer(points); 		// add it to the cluster group
				thisMap.addLayer(this.markersLayer);		// add it to the map

				$('#ico_reload').removeClass("fa-spin");
				$('#ico_reload').css({"display":"none"});

				if(this.initParameters.usePanel)
					this.updatePanel(thisMap);

				this.checkListElementMap(thisMap); 
				
				if("undefined" != typeof this.markersLayer.getBounds()._northEast )
					thisMap.fitBounds(this.markersLayer.getBounds(), { 'maxZoom' : 14 });

				thisSig.constructUI();

				this.showIcoLoading(false);
		};

		//affiche l'icone de chargement
		Sig.showIcoLoading(true);

		//chargement des paramètres d'initialisation à partir des params PHP definis plus haut
		var initParams =  <?php echo json_encode($sigParams); ?>;

		//chargement de la carte
		mapBg = Sig.loadMap("mapCanvas", initParams);

		Sig.showIcoLoading(false);

		var mapHeight = $("#mapCanvasBg").height();
		var rightPanelHeight = mapHeight - 190;
		$("#right_tool_map").css({"top":"120px"});
		$("#right_tool_map").css({"height":rightPanelHeight});
		$("#liste_map_element").css({"height":rightPanelHeight-50});

		$("#right_tool_map").hide('fast');
		$(".sigModuleBg").css("display","none");
		showMap();
	});


	function showMap(show){
		show = $(".sigModuleBg").css("display") == "none";
		if(show){
			//$("#right_tool_map").addClass("hidden");
			
			$(".sigModuleBg").show( 1000 );
			$(".box-ajax").css({backgroundColor:'rgba(255, 255, 255, 0.5)'});
			$(".box-ajax .mix").css({backgroundColor:'rgba(255, 255, 255, 0.5)'});
			$("a.text-white").css({color:'#58879B'});
			$('#btn-close-panel').show("fast");
			
		}else{
			$(".sigModuleBg").hide( 1000 );
			$(".box-ajax").css({backgroundColor:'rgba(255, 255, 255, 1)'});
			$(".box-ajax .mix").css({backgroundColor:'rgba(255, 255, 255, 1)'});
			$("a.text-white").css({color:'#FFF'});
			$('#btn-close-panel').hide("fast");
		}
	}

</script>