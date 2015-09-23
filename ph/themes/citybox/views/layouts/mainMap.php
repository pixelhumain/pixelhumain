
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
        "mapOpacity" => 0.6, //ex : 0.4

        /* MAP LAYERS (FOND DE CARTE) */
        "mapTileLayer" 	  => 'http://{s}.tile.thunderforest.com/landscape/{z}/{x}/{y}.png', //'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png'
        "mapAttributions" => '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'

        /* MAP BUTTONS */
        //"mapBtnBgColor" => '#E6D414',
        //"mapBtnColor" => '#213042',
        //"mapBtnBgColor_hover" => '#5896AB',

        /* USE */
        "titlePanel" 		 => '',
        "usePanel" 			 => false,
        "useFilterType" 	 => false,
        "useRightList" 		 => false,
        "useZoomButton" 	 => true,
        "useHomeButton" 	 => false,
        "useHelpCoordinates" => false,
        "useFullScreen" 	 => true,
        "useFullPage" 	 	 => true,
        "useResearchTools" 	 => true,
        "useChartsMarkers" 	 => false,

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
		position: absolute;
	}

	.<?php echo $moduleName; ?> .input-search-place{
		top:100px;
		margin-right: 30px;
	}
	.<?php echo $moduleName; ?> .item_panel_map			{
	}
	.<?php echo $moduleName; ?> .item_panel_map:hover	{
	}

	.<?php echo $moduleName; ?> #right_tool_map		{}
	.<?php echo $moduleName; ?> #liste_map_element	{}

	.<?php echo $moduleName; ?> #lbl-chk-scope		{}

	.<?php echo $moduleName; ?> .btn-group-map		{
		left: unset;
		right:30px;
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
		//création de l'objet SIG
		Sig = SigLoader.getSig();

		//affiche l'icone de chargement
		Sig.showIcoLoading(true);

		//chargement des paramètres d'initialisation à partir des params PHP definis plus haut
		var initParams =  <?php echo json_encode($sigParams); ?>;

		//chargement de la carte
		mapBg = Sig.loadMap("mapCanvas", initParams);
		/**************************** CHANGER LA SOURCE DES DONNEES EN FONCTION DU CONTEXTE ***************************/
		//var mapData = contextMap;

		//var mapData = <?php //echo json_encode($contextMap) ?>;
		//console.log("contextMap");
		//console.dir(mapData);
		/**************************************************************************************************************/
		
		//console.dir(mapData);
		//affichage des éléments sur la carte
		//Sig.showMapElements(mapCity, mapData);//, elementsMap); 
		
		//mapBg.panTo([-21.06912308335471, 55.34912109375]);
		//masque l'icone de chargement
		Sig.showIcoLoading(false);

		var mapHeight = $("#mapBgContainer").height();
		mapHeight = mapHeight + (1.2 * mapHeight);		
		//$("#mapCanvas" + initParams.sigKey).css({"height":mapHeight});
	});

</script>