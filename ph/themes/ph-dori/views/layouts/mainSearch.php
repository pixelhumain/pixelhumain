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
		$themeAssetsUrl = Yii::app()->theme->baseUrl. '/assets';

		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.css');

		$cs->registerCssFile($themeAssetsUrl.'/plugins/bootstrap-modal/css/bootstrap-modal.css' , CClientScript::POS_END);
		
		$cs->registerScriptFile(Yii::app() -> createUrl($this->module->id."/default/view/page/trad/dir/..|translation/layout/empty"));
		
		
		?>
		<link rel='shortcut icon' type='image/x-icon' href="<?php echo (isset( $this->module->assetsUrl ) ) ? $this->module->assetsUrl : ""?>/images/favicon.ico" />
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/themes/theme-simple.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/css/themes/theme-simple-login.css" type="text/css" id="skin_color">

		<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
		<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />
		
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<script>
		   var initT = new Object();
		   var showDelaunay = true;
		   var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
		   var moduleUrl = "<?php echo Yii::app()->controller->module->assetsUrl;?>";
		   var themeUrl = "<?php echo Yii::app()->theme->baseUrl;?>";
		   var moduleId = "<?php echo $this->module->id?>";
		   var userId = "<?php echo Yii::app()->session['userId']?>";
		   var debug = <?php echo (YII_DEBUG) ? "true" : "false" ?>;
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
				<?php if($user != "NOT_CONNECTED") { ?>
					//updateCookieValues(user_geo_latitude, user_geo_longitude, insee, cityName);
				<?php } ?>

				//Start of Rocket.Chat Livechat Script -->
				
				(function(w, d, s, u) {
				    w.RocketChat = function(c) { w.RocketChat._.push(c) }; w.RocketChat._ = []; w.RocketChat.url = u;
				    var h = d.getElementsByTagName(s)[0], j = d.createElement(s);
				    j.async = true; j.src = 'https://chat.initiative.place/packages/rocketchat_livechat/assets/rocket-livechat.js';
				    h.parentNode.insertBefore(j, h);
				})(window, document, 'script', 'https://chat.initiative.place/livechat');
				//End of Rocket.Chat Livechat Script -->
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
	    }else{
	      $myFormContact = null;

	    }

	   // error_log("load IndexDefault");
	?>

	<?php $this->renderPartial($layoutPath.'.menu.menuCommunexion'); ?>

	<!-- **************************************
	MENUS TOP AND LEFT CONTAINER
	******************************************* -->
	<?php 
	if(!isset($me)) 
		$me=""; 
		  
	$this->renderPartial($layoutPath.'.menu.menuTop', array("me" => $me)); 
	$this->renderPartial($layoutPath.'.menu.menuLeft', array("page" => "accueil", "myCity" => $city)); ?>

	<!-- **************************************
	CENTER SECTION
	******************************************* -->
	<div class="col-xs-12 no-padding no-margin my-main-container">

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

		$this->renderPartial( $layoutPath.'modals' );
		  ?>
		<!-- start: MAIN JAVASCRIPTS -->
		
		<?php
		echo "<!-- start: MAIN JAVASCRIPTS -->";
		echo "<!--[if lt IE 9]>";
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/plugins/respond.min.js' , CClientScript::POS_HEAD);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/excanvas.min.js' , CClientScript::POS_HEAD);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jQuery/jquery-1.11.1.min.js' , CClientScript::POS_HEAD);
		echo "<![endif]-->";
		echo "<!--[if gte IE 9]><!-->";
		$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jQuery/jquery-2.1.1.min.js' , CClientScript::POS_HEAD);
		echo "<!--<![endif]-->";

		$cssAnsScriptFilesModule = array(
			'/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js',
			'/assets/plugins/bootstrap/js/bootstrap.min.js' , 
			'/assets/plugins/bootstrap/css/bootstrap.min.css',
			'/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js' , 
			'/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css',
			'/assets/plugins/bootstrap-modal/js/bootstrap-modal.js' , 
			'/assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js' , 
			'/assets/plugins/velocity/jquery.velocity.min.js',
			'/assets/plugins/ladda-bootstrap/dist/spin.min.js' , 
			'/assets/plugins/ladda-bootstrap/dist/ladda.min.js' , 
			'/assets/plugins/ladda-bootstrap/dist/ladda.min.css',
			'/assets/plugins/ladda-bootstrap/dist/ladda-themeless.min.css',
			'/assets/plugins/iCheck/jquery.icheck.min.js' , 
			'/assets/plugins/iCheck/skins/all.css',
			'/assets/plugins/jquery.transit/jquery.transit.js' , 
			'/assets/plugins/TouchSwipe/jquery.touchSwipe.min.js' , 
			'/assets/plugins/bootbox/bootbox.min.js' , 
			'/assets/plugins/jquery-mockjax/jquery.mockjax.js' , 
			'/assets/plugins/blockUI/jquery.blockUI.js' , 
			'/assets/plugins/toastr/toastr.js' , 
			'/assets/plugins/toastr/toastr.min.css',
			'/assets/plugins/jquery-cookie/jquery.cookie.js' , 
			'/assets/plugins/jquery-cookieDirective/jquery.cookiesdirective.js' , 

			'/assets/plugins/select2/select2.min.js' , 
			'/assets/plugins/moment/min/moment.min.js' ,
			'/assets/js/cookie.js' ,
			
			'/assets/js/jquery.dynForm.js' , 

			'/assets/plugins/jquery-validation/dist/jquery.validate.min.js',
			'/assets/plugins/jquery-validation/localization/messages_fr.js',
			'/assets/plugins/lightbox2/css/lightbox.css',
			'/assets/plugins/lightbox2/js/lightbox.min.js',

			'/assets/plugins/animate.css/animate.min.css',
			'/assets/plugins/font-awesome/css/font-awesome.min.css',
			'/assets/plugins/font-awesome-custom/css/font-awesome.css',
			
			'/assets/css/styles.css',
			'/assets/css/styles-responsive.css',
			'/assets/css/plugins.css',
			
			'/assets/css/search.css',
			'/assets/css/floopDrawerRight.css',
			'/assets/css/sig/sig.css',
		);
		HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);

		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);

		
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
		    "actions": "fa-cogs"
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
		    "actions": "lightblue2"
		  };


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

		//console.warn("isMapEnd 1",isMapEnd);
		jQuery(document).ready(function() {

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

		    console.log("INIT scroll shadows!");
		    $(".my-main-container").bind("scroll", function(){
		    	//console.log("scrolling my-container");
		    	checkScroll();
		    	shadowOnHeader()
		    });


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

			toogleCommunexion();


			//manages the back button state 
			//every url change (loadByHash) is pushed into history.pushState 
			//onclick back btn popstate is launched
			//
		    $(window).bind("popstate", function(e) {
		      //console.dir(e);
		      console.log("history.state",$.isEmptyObject(history.state),location.hash);
		      console.warn("popstate history.state",history.state);
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
		    console.log("userConnected");
			console.dir(userConnected);
			//si l'utilisateur doit passer par le two_step_register

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
						loadByHash("#default.live");//news.index.type.citoyens.id."+userId);
					else
						loadByHash("#default.live");
					//}

					//loadByHash("#default.home");
				}
			}
			checkScroll();
		});

		</script>

		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	</body>
	<!-- end: BODY -->
</html>