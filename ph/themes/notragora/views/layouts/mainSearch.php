<!DOCTYPE html>
<?php

	/* COOKIE GEO POSITION */

 	/*	LISTE DES COOKIES
 		-----------------
		-user_geo_latitude
		-user_geo_longitude
		-insee
		-cityName
 	*/
	$user = "NOT_CONNECTED";
 	/*if(isset(Yii::app()->session['userId'])){
 		$user = Person::getById(Yii::app()->session['userId']);

		$user_geo_latitude = ""; $user_geo_longitude = "";
		$insee = ""; $cityName = "";

		if(isset($user["geo"]) &&
 		   isset($user["geo"]["latitude"]) && isset($user["geo"]["longitude"]))
		{
			$user_geo_latitude = $user["geo"]["latitude"];
			$user_geo_longitude = $user["geo"]["longitude"];
		}

		if(isset($user["address"]) && isset($user["address"]["codeInsee"]))
			$insee = $user["address"]["codeInsee"];

		if(isset($user["address"]) && isset($user["address"]["addressLocality"]))
			$cityName = $user["address"]["addressLocality"];

	}else{ //user not connected
		if(isset($cookies['user_geo_longitude'])){
				$sigParams["firstView"] = array(  "coordinates" => array( $cookies['user_geo_latitude']->value,
																		  $cookies['user_geo_longitude']->value),
											 	  "zoom" => 13);
		}else{
			//error_log("aucun cookie geopos trouvé");
		}
	}*/

?>
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD layout mainSearch.php -->
	<head>
		<?php


		$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
		$this->renderPartial($layoutPath.'metas');?>
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<?php

		$cs = Yii::app()->getClientScript();

		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/plugins/bootstrap-modal/js/bootstrap-modal.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/plugins/bootstrap-modal/js/bootstrap-modalmanager.js' , CClientScript::POS_END);
		$cs->registerCssFile(Yii::app()->request->baseUrl.'/plugins/bootstrap-modal/css/bootstrap-modal.css' , CClientScript::POS_END);

		$cs->registerScriptFile(Yii::app() -> createUrl($this->module->id."/default/view/page/trad/dir/..|translation/layout/empty"));
		?>
		<link rel='shortcut icon' type='image/x-icon' href="<?php echo (isset( $this->module->assetsUrl ) ) ? $this->module->assetsUrl : ""?>/images/LogoNotragoraMiniature.ico" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/themes/theme-simple.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/themes/theme-simple-login.css" type="text/css" id="skin_color">

		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
		<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />

		<script src="https://www.google.com/recaptcha/api.js"></script>

		<script src='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'></script>
        <link href='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css' rel='stylesheet' />

		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<script>
		   var initT = new Object();
		   var showDelaunay = true;
		   var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
		   var moduleUrl = "<?php echo Yii::app()->controller->module->assetsUrl;?>";
		   var themeUrl = "<?php echo Yii::app()->theme->baseUrl;?>";
		   var globalTheme = "<?php echo Yii::app()->theme->name;?>";
		   var moduleId = "<?php echo $this->module->id?>";
		   var userId = "<?php echo Yii::app()->session['userId']?>";
		   var debug = <?php echo (YII_DEBUG) ? "true" : "false" ?>;
		   var fileSizeMax = <?php echo Document::getFileSizeLimit(); ?>;
		   var currentUrl = "<?php echo "#".Yii::app()->controller->id.".".Yii::app()->controller->action->id ?>";
		   var debugMap = [
		    <?php if(YII_DEBUG) { ?>
		       { "userId":"<?php echo Yii::app()->session['userId']?>"},
		       { "userEmail":"<?php echo Yii::app()->session['userEmail']?>"}
	       <?php } ?>
	       ];
	       <?php if($user != "NOT_CONNECTED") { ?>
				var user_geo_latitude  = "<?php echo $user_geo_latitude; ?>";
	  			var user_geo_longitude = "<?php echo $user_geo_longitude; ?>";
	  			var insee 	 = "<?php echo $insee; ?>";
	  			var cityName = "<?php echo $cityName; ?>";
	 	   <?php } ?>
		   jQuery(document).ready(function() {
				toastr.options = {
				  "closeButton": false,
				  "positionClass": "toast-bottom-right",
				  "onclick": null,
				  "showDuration": "1000",
				  "hideDuration": "1000",
				  "timeOut": "5000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "fadeIn",
				  "hideMethod": "fadeOut"
				};

			});
		</script>
		<style type="text/css">
			.form-group label.error{ color:red; font-size:10px; }
		</style>
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="">
		<!-- **************************************
		INDEX structure
		******************************************* -->

	<?php

		$this->renderPartial( $layoutPath.'modals' );


	//si l'utilisateur n'est pas connecté
 	if(!isset(Yii::app()->session['userId'])){
		$inseeCommunexion 	 = isset( Yii::app()->request->cookies['inseeCommunexion'] ) ?
		   			    			  Yii::app()->request->cookies['inseeCommunexion']->value : "";

		$cpCommunexion 		 = isset( Yii::app()->request->cookies['cpCommunexion'] ) ?
		   			    			  Yii::app()->request->cookies['cpCommunexion']->value : "";

		$cityNameCommunexion = isset( Yii::app()->request->cookies['cityNameCommunexion'] ) ?
		   			    			  Yii::app()->request->cookies['cityNameCommunexion']->value : "";

		$regionNameCommunexion = isset( Yii::app()->request->cookies['regionNameCommunexion'] ) ?
		   			    			  Yii::app()->request->cookies['regionNameCommunexion']->value : "";

		$countryCommunexion = isset( Yii::app()->request->cookies['countryCommunexion'] ) ?
		   			    			  Yii::app()->request->cookies['countryCommunexion']->value : "";
	}
	//si l'utilisateur est connecté
	else{
		$me = Person::getById(Yii::app()->session['userId']);
		$inseeCommunexion 	 = isset( $me['address']['codeInsee'] ) ?
		   			    			  $me['address']['codeInsee'] : "";

		$cpCommunexion 		 = isset( $me['address']['postalCode'] ) ?
		   			    			  $me['address']['postalCode'] : "";

		$cityNameCommunexion = isset( $me['address']['addressLocality'] ) ?
		   			    			  $me['address']['addressLocality'] : "";

		$regionNameCommunexion = ""; /*not important now => multilevel is dead*/

		$countryCommunexion = isset( $me['address']['addressCountry'] ) ?
		   			    			 $me['address']['addressCountry'] : "";
	}

	if (@$inseeCommunexion){
		if(@$cpCommunexion){
			$city=City::getCityByInseeCp($inseeCommunexion, $cpCommunexion);
		}else{
			$city=SIG::getCityByCodeInsee($inseeCommunexion);
		}

		if(@$me)
		$regionNameCommunexion = @$city['regionName'] ?
			   			    	 $city['regionName'] : "";

		$nbCpByInsee=count(@$city["postalCodes"]);
		if($nbCpByInsee > 1){
			$cityInsee=$city["name"];
		}
	}else{
		$city = null;
	}

	?>

	<!-- **************************************
	MAP CONTAINER
	******************************************* -->
	<div id="mainMap">
		<?php $this->renderPartial($layoutPath.'mainMap'); ?>
	</div>

	<?php //get all my link to put in floopDrawer
		if(isset(Yii::app()->session['userId'])){
	      $myContacts = Person::getPersonLinksByPersonId(Yii::app()->session['userId']);
	      $myFormContact = $myContacts;
	      $getType = (isset($_GET["type"]) && $_GET["type"] != "citoyens") ? $_GET["type"] : "citoyens";
	    } else
	      $myFormContact = null;

	   // error_log("load IndexDefault");
	?>

	<?php $this->renderPartial($layoutPath.'.menu.menuCommunexion'); ?>

	<!-- **************************************
	MENUS TOP AND LEFT CONTAINER
	******************************************* -->
	<?php
	if(!isset($me))
		$me="";
	// $collectionsType=array(
	// 	"Où sont les femmes ?",
	// 	"Passeurs d'images",
	// 	"MHMQ",
	// 	"MIAA",
	// 	"Portrait citoyens",
	// 	"Parcours d'engagement"
	// );

	$genresType=array(
		"Documentaire",
		"Fiction",
		"Docu-fiction",
		"Films outils",
		"Films de commande"
	);
	$collectionsType = Lists::getListByName("collections");
	$topList = Poi::getPoiByTagsAndLimit();
	if (empty($topList)) $emptyTop=true;
	$this->renderPartial($layoutPath.'.menu.menuTop', array( "me" => $me , "topList" => $topList ));
	$this->renderPartial($layoutPath.'.menu.menuLeft', array("page" => "accueil", "myCity" => $city, "emptyTop"=>@$emptyTop)); ?>

	<!-- **************************************
	CENTER SECTION
	******************************************* -->
	<div class="col-xs-12 no-padding no-margin my-main-container" <?php if (@$emptyTop) { ?> style="top:50px !important;" <?php } ?>>

		<div class="footer-menu-left"></div>

		<!-- **************************************
		MAIN ACTIVE SECTION
		******************************************* -->
		<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 col-xs-12 main-col-search"></div>

		<!-- **************************************
		REPERTOIRE
		******************************************* -->
		<div id="floopDrawerDirectory" class="floopDrawer"></div>

		<!-- **************************************
		REGISTRATION PANELS
		******************************************* -->
		<?php $this->renderPartial($layoutPath."login_register"); ?>

	</div>

	<!-- **************************************
		NOTIFICATION PANELS
		******************************************* -->
	<?php
		if(isset(Yii::app()->session['userId']))
			$this->renderPartial($layoutPath.'notifications2');

		/* *****************************************
		Active Content from the controller
		******************************************* */
		echo $content;

		/* *************************************
		END structure
		*******************************************/

		  ?>
		<!-- start: MAIN JAVASCRIPTS -->

		<?php
		echo "<!-- start: MAIN JAVASCRIPTS -->";
		echo "<!--[if lt IE 9]>";
		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/plugins/respond.min.js' , CClientScript::POS_HEAD);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/excanvas.min.js' , CClientScript::POS_HEAD);
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jQuery/jquery-1.11.1.min.js' , CClientScript::POS_HEAD);
		echo "<![endif]-->";
		echo "<!--[if gte IE 9]><!-->";
		$cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jQuery/jquery-2.1.1.min.js' , CClientScript::POS_HEAD);
		echo "<!--<![endif]-->";

		//plugins shared by all themes
		$cssAnsScriptFilesModule = array(
			'/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js',
			'/plugins/bootstrap/js/bootstrap.min.js' ,
			'/plugins/bootstrap/css/bootstrap.min.css',
			'/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js' ,
			'/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css',
			'/plugins/velocity/jquery.velocity.min.js',
			'/plugins/ladda-bootstrap/dist/spin.min.js' ,
			'/plugins/ladda-bootstrap/dist/ladda.min.js' ,
			'/plugins/ladda-bootstrap/dist/ladda.min.css',
			'/plugins/ladda-bootstrap/dist/ladda-themeless.min.css',
			'/plugins/iCheck/jquery.icheck.min.js' ,
			'/plugins/iCheck/skins/all.css',
			'/plugins/jquery.transit/jquery.transit.js' ,
			'/plugins/TouchSwipe/jquery.touchSwipe.min.js' ,
			'/plugins/bootbox/bootbox.min.js' ,
			'/plugins/jquery-mockjax/jquery.mockjax.js' ,
			'/plugins/blockUI/jquery.blockUI.js' ,

			// '/plugins/toastr/toastr.js' ,
			// '/plugins/toastr/toastr.min.css',
			'/plugins/jquery-cookie/jquery.cookie.js' ,
			'/plugins/jquery-cookieDirective/jquery.cookiesdirective.js' ,
			'/plugins/jQuery-contextMenu/dist/jquery.contextMenu.min.js' ,
			'/plugins/jQuery-contextMenu/dist/jquery.contextMenu.min.css' ,
			'/plugins/jQuery-contextMenu/dist/jquery.ui.position.min.js' ,
			'/plugins/select2/select2.min.js' ,
			'/plugins/select2/select2.css',
			'/plugins/moment/min/moment.min.js' ,
			'/plugins/jquery-validation/dist/jquery.validate.min.js',
			'/plugins/jquery-validation/localization/messages_fr.js',
			'/plugins/lightbox2/css/lightbox.css',
			'/plugins/lightbox2/js/lightbox.min.js',
			'/plugins/animate.css/animate.min.css',
			'/plugins/font-awesome/css/font-awesome.min.css',
			'/plugins/font-awesome-custom/css/font-awesome.css',
			'/plugins/jquery.dynForm.js',
			'/plugins/jQuery-contextMenu/dist/jquery.contextMenu.min.js' ,
			'/plugins/jQuery-contextMenu/dist/jquery.contextMenu.min.css' ,
			'/plugins/jQuery-contextMenu/dist/jquery.ui.position.min.js' ,
			'/js/api.js',

		);
		HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->getRequest()->getBaseUrl(true));

		$cssAnsScriptFilesModule = array(
			'/assets/js/cookie.js' ,

			'/assets/js/sly/jquery.easing.1.3.js',
			'/assets/js/sly/sly.min.js',
			'/assets/css/styles.css',
			'/assets/css/styles-responsive.css',
			'/assets/css/plugins.css',

			'/assets/css/search.css',
			'/assets/css/default/directory.css',
			'/assets/css/floopDrawerRight.css',
			'/assets/css/sig/sig.css',
		);
		HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);



		//<!-- end: MAIN JAVASCRIPTS -->
		//<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		?>
		<script type="text/javascript">


		var mapIconTop = {
		    "default" : "fa-arrow-circle-right",
		    "citoyen":"<?php echo Person::ICON ?>",
		    "NGO":"<?php echo Organization::ICON ?>",
		    "LocalBusiness" :"<?php echo Organization::ICON_BIZ ?>",
		    "Group" : "<?php echo Organization::ICON_GROUP ?>",
		    "group" : "<?php echo Organization::ICON ?>",
		    "association" : "<?php echo Organization::ICON ?>",
		    "organization" : "<?php echo Organization::ICON ?>",
		    "organizations" : "<?php echo Organization::ICON ?>",
		    "GovernmentOrganization" : "<?php echo Organization::ICON_GOV ?>",
		    "event":"<?php echo Event::ICON ?>",
		    "project":"<?php echo Project::ICON ?>",
		    "projects":"<?php echo Project::ICON ?>",
		    "city": "<?php echo City::ICON ?>",
		    "entry": "fa-gavel",
		    "action": "fa-cogs",
		    "actions": "fa-cogs",
		    "poi": "fa-video-camera",
			"video": "fa-video-camera"
		  };
		var mapColorIconTop = {
		    "default" : "dark",
		    "citoyen":"yellow",
		    "NGO":"green",
		    "LocalBusiness" :"green",
		    "Group" : "green",
		    "group" : "green",
		    "association" : "green",
		    "organization" : "green",
		    "organizations" : "green",
		    "GovernmentOrganization" : "green",
		    "event":"orange",
		    "project":"purple",
		    "projects":"purple",
		    "city": "red",
		    "entry": "azure",
		    "action": "lightblue2",
		    "actions": "lightblue2",
		    "poi": "brown",
		    "video": "brown"
		  };

		 var classifiedTypes = "";

		var typesLabels = {
		  "<?php echo Organization::COLLECTION ?>":"Organization",
		  "<?php echo Event::COLLECTION ?>":"Event",
		  "<?php echo Project::COLLECTION ?>":"Project",
		};


		/* variables globales communexion */
		var inseeCommunexion = "<?php echo $inseeCommunexion; ?>";
		var cpCommunexion = "<?php echo $cpCommunexion; ?>";
		var cityNameCommunexion = "<?php echo $cityNameCommunexion; ?>";
		var regionNameCommunexion = "<?php echo $regionNameCommunexion; ?>";
		var countryCommunexion = "<?php echo $countryCommunexion; ?>";
		<?php if(@$nbCpByInsee && $nbCpByInsee > 1){ ?>
			nbCpbyInseeCommunexion = "<?php echo $nbCpByInsee; ?>";
			cityInseeCommunexion = "<?php echo $cityInsee; ?>";
		<?php } ?>
		var latCommunexion = 0;
		var lngCommunexion = 0;

		/* variables globales communexion */
		var myContacts = <?php echo ($myFormContact != null) ? json_encode($myFormContact) : "null"; ?>;
		var userConnected = <?php echo isset($me) ? json_encode($me) : "null"; ?>;

		var proverbs = <?php echo json_encode(random_pic()) ?>;

		var hideScrollTop = true;
		var lastUrl = null;
		var isMapEnd = <?php echo (isset( $_GET["map"])) ? "true" : "false" ?>;

		//used in communecter.js dynforms
		var tagsList = <?php echo json_encode(Tags::getActiveTags()) ?>;
		var eventTypes = <?php echo json_encode( Event::$types ) ?>;
		var organizationTypes = <?php echo json_encode( Organization::$types ) ?>;
		var currentUser = <?php echo isset($me) ? json_encode(Yii::app()->session["user"]) : null?>;
		var rawOrganizerList = <?php echo json_encode(Authorisation::listUserOrganizationAdmin(Yii::app() ->session["userId"])) ?>;
		var organizerList = {};
		var poiTypes = <?php echo json_encode( Poi::$types ) ?>;
		var collectionsType=<?php echo json_encode( $collectionsType ) ?>;
		var genresType=<?php echo json_encode( $genresType ) ?>;
		var searchType = [ "persons" ];
		var urlTypes = <?php asort(Element::$urlTypes); echo json_encode(Element::$urlTypes) ?>;
		var CoSigAllReadyLoad = true;

		//console.warn("isMapEnd 1",isMapEnd);
		jQuery(document).ready(function() {

			themeObj.init();
			/*if(typeof typeObj[key].dynForm.jsonSchema.properties.tags != "undefined"){
				typeObj[key].dynForm.jsonSchema.properties.tags.data=networkTags;
				if(typeof networkJson.request.mainTag != "undefined")
					typeObj[key].dynForm.jsonSchema.properties.tags.mainTag = networkJson.request.mainTag[0];
			}*/


			if(currentUser)
				organizerList["currentUser"] = currentUser.name + " (You)";

			$.each(rawOrganizerList, function(optKey, optVal) {
				organizerList[optKey] = optVal.name;
			});

			<?php if(isset(Yii::app()->session['userId']) && //et que le two_step est terminé
					(!isset($me["two_steps_register"]) || $me["two_steps_register"] != true)){ ?>

				//if(location.hostname.indexOf("localhost") >= 0) path = "/ph/";
				setCookies(location.pathname);

			<?php } ?>


		  	if(inseeCommunexion != "" && cpCommunexion != ""){
		  		$(".btn-menu2, .btn-menu3, .btn-menu4, .btn-menu9 ").show(400);
		  	}

		  	$('#btn-toogle-map').click(function(e){ showMap();  	});
		    $('.main-btn-toogle-map').click(function(e){ showMap(); });

		    $("#mapCanvasBg").show();

		    $(".my-main-container").bind("scroll", function(){
		    	//console.log("scrolling my-container");
		    	checkScroll();
		    	shadowOnHeader();
		    });

		    //alert("on ready 1");
		    $(".btn-scope").click(function(){
		    	var level = $(this).attr("level");
		    	selectScopeLevelCommunexion(level);
		    });
		    $(".btn-scope").mouseenter(function(){
		    	$(".btn-scope").removeClass("selected");
		    });
		    $(".btn-scope").mouseout(function(){
		    	$(".btn-scope-niv-"+levelCommunexion).addClass("selected");
		    });

		    initNotifications();
			initFloopDrawer();

		    $(window).resize(function(){
		      resizeInterface();
		    });

		    resizeInterface();
		    showFloopDrawer();

		    if(cityNameCommunexion != ""){
				$('#searchBarPostalCode').val(cityNameCommunexion);
				$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté à " + cityNameCommunexion + ', ' + cpCommunexion);
			}

			//alert("on ready 2");
		   // toogleCommunexion();


			//manages the back button state
			//every url change (loadByHash) is pushed into history.pushState
			//onclick back btn popstate is launched
			//
		    $(window).bind("popstate", function(e) {
		      //console.dir(e);
		      if( lastUrl && "onhashchange" in window && location.hash  ){
		        if( $.isEmptyObject( history.state ) && allReadyLoad == false ){
			        //console.warn("poped state",location.hash);
			        //alert("popstate");
			        loadByHash(location.hash,true);
			    }
			    allReadyLoad = false;
		      }

		      lastUrl = location.hash;
		    });


			//console.log("start timeout MAIN MAP LOOOOOL");
			//$("#btn-toogle-map").hide();



		    //console.log("hash", location.hash);
		    //console.warn("isMapEnd 3",isMapEnd);
		    //console.log("userConnected");
			//console.dir(userConnected);
			//si l'utilisateur doit passer par le two_step_register

			//alert("before loadByHash");
			if(userConnected != null && userConnected != "" && typeof userConnected != "undefined" && !location.hash){
				loadByHash("#person.detail.id."+userId);
				return;
			}
			else{ //si l'utilisateur est déjà passé par le two_step_register
		 		if(/*location.hash != "#default.live" &&*/ location.hash != "#" && location.hash != ""){

					loadByHash(location.hash);
					return;
				}
				else{
					//console.log("userConnected", userConnected);
					if(userConnected != null && userId != null  && userId != "" && typeof userId != "undefined")
						loadByHash("#default.home");//news.index.type.citoyens.id."+userId);
					else
						loadByHash("#default.home");
					//}

					//loadByHash("#default.home");
				}
			}
			checkScroll();

			//Sig.showMapElement(topList);
		});

		var themeObj = {
			headerParams : {
				organizations : { color: "green",   icon: "group",        name: "Groupes de travail" },
				projects      : { color: "purple",  icon: "lightbulb-o",  name: "Groupes de travail" },
				poi       	  : { color: "brown",   icon: "video-camera",   name: "Productions des groupes de travail" }
			},
			init : function(){

				genresTypeData=[];
				genresHtml="";
				$.each(genresType, function(i, tag) {
					val={id:tag,text:tag};
					genresTypeData.push(val);
					genresHtml+='<a href="javascript:addItemsToSly(\''+slugify(tag)+'\')" class="favElBtn '+slugify(tag)+'Btn" data-tag="'+slugify(tag)+'">'+tag+'</a><br>';
				});
				$(".genresList").append(genresHtml);

				collectionsTypeData=[];
				collectionsHtml="";
				$.each(collectionsType, function(i, tag2) {
					val2={id:tag2,text:tag2};
					collectionsTypeData.push(val2);
					collectionsHtml+='<a href="javascript:addItemsToSly(\''+slugify(tag2)+'\')" class="favElBtn '+slugify(tag2)+'Btn" data-tag="'+slugify(tag2)+'">'+tag2+'</a><br>';
				});
				
				$(".collectionsList").append(collectionsHtml);

				typeObjPoi = typeObj["poi"].dynForm.jsonSchema;
				typeObjPoi.title="Ajouter une réalisation";
				typeObjPoi.icon="video-camera";
				collectionForm = {
			                "inputType" : "tags",
			                "placeholder" : "Collections de la réalisation",
			                "values" : tagsList,
			                "data" : collectionsTypeData
			    };
			    var tagPoiDyn = typeObjPoi.properties.tags;
			    delete typeObjPoi.properties.tags;
			    //specific types as collections added to the atgs field
			    typeObjPoi.properties.collections={};
			    typeObjPoi.properties.collections=collectionForm;
				genreForm = {
			                "inputType" : "tags",
			                "placeholder" : "Genres de la réalisation",
			                "values" : tagsList,
			                "data" : genresTypeData
			    };

			    //specific types as genres added to the atgs field
			    typeObjPoi.properties.genres={};
			    typeObjPoi.properties.genres=genreForm;
			    typeObjPoi.properties.tags = tagPoiDyn;
				//types can only be videos and will be hidden
				typeObjPoi.properties.type={
					"value" : "video",
		            "inputType" : "hidden"
				};

				//remove image
				delete typeObjPoi.properties.image;
				delete typeObjPoi.afterSave;
				delete typeObjPoi.beforeBuild;
				delete typeObjPoi.urls;

				//urls are always shown
				poiFormUrls = {
		        	placeholder : "url",
		            "inputType" : "array",
		            "value" : [],
		            init:function(){
			            getMediaFromUrlContent(".addmultifield0", ".resultGetUrl0",0);
		            }
		        };

		        typeObjPoi.properties.urls=poiFormUrls;
				typeObjPoi.properties.info.html="<p><i class='fa fa-info-circle'></i> Rajouter une video en la chargeant l'url présente sur le compte vimeo de passeur d'image. Cette réalisation sera liée à votre groupe de travail</p>";
			},
			dynForm : {
            	editElementPOI : function(type,data){
            		if(type=="poi"){
						if(typeof data.map["tags"] != "undefined" && data.map["tags"].length > 0){
					  		$.each(data.map["tags"], function(i,e){
						  		if(jQuery.inArray( e, collectionsType ) >= 0){
							   		 data.map["collections"]=[];
							   		 data.map["collections"].push(e);
							   		 var i = data.map["tags"].indexOf(e);
									if(i != -1) {
										data.map["tags"].splice(i, 1);
									}
								}
								if(jQuery.inArray( e, genresType ) >= 0){
							   		 data.map["genres"]=[];
							   		 data.map["genres"].push(e);
							   		 var i = data.map["tags"].indexOf(e);
									if(i != -1) {
										data.map["tags"].splice(i, 1);
									}
								}

					  		});
			  			}
		  			}
            	}
            }
		}


		</script>

		<!-- Global Site Tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-25531131-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments)};
		  gtag('js', new Date());

		  gtag('config', 'UA-25531131-1');
		</script>
		
		
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	</body>
	<!-- end: BODY -->
</html>
