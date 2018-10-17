<!DOCTYPE html>
<?php 
	
	$user = "NOT_CONNECTED";

	$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';

	$parentModuleId = ( @Yii::app()->params["module"]["parent"] ) ?  Yii::app()->params["module"]["parent"] : $this->module->id;
    $modulePath = ( @Yii::app()->params["module"]["parent"] ) ?  "../../../".$parentModuleId."/views"  : "..";

	$cs = Yii::app()->getClientScript();

	$CO2DomainName = isset(Yii::app()->params["CO2DomainName"]) ? Yii::app()->params["CO2DomainName"] : "CO2";

	$networkJson = Network::getNetworkJson(Yii::app()->params['networkParams']);

	$params = CO2::getThemeParams();
    $metaTitle = @$params["metaTitle"];
    $metaDesc = @$params["metaDesc"]; 
    $metaImg = Yii::app()->getRequest()->getBaseUrl(true)."/themes/CO2".@$params["metaImg"];
    $me = isset(Yii::app()->session['userId']) ? Person::getById(Yii::app()->session['userId']) : null;

    if(@$_GET["el"])
        $this->renderPartial( 'co2.views.custom.init' ); 
    
?>	
<html lang="en" class="no-js">
	
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="title" content="<?php echo $metaTitle; ?>">
		<meta name="description" content="<?php echo $metaDesc; ?>">
		<meta name="author" content="pixelhumain">

		<meta property="og:image" content="<?php echo $metaImg; ?>"/>
		<meta property="og:description" content="<?php echo $metaDesc; ?>"/>
		<meta property="og:title" content="<?php echo $metaTitle; ?>"/>

		<title><?php echo $CO2DomainName; ?></title>

		<link rel='shortcut icon' type='image/x-icon' href="<?php echo (isset( $this->module->assetsUrl ) ) ? $this->module->assetsUrl : ""?>/images/favicon.ico" />

		<?php if( Yii::app()->params["forceMapboxActive"]==true &&  Yii::app()->params["mapboxActive"]==true ){ ?>
			<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
			<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />

			<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
			<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css"> 

			<script src='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'></script>
			<link href='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css' rel='stylesheet' />

		<?php }

			$cs->registerScriptFile(Yii::app() -> createUrl($this->module->id."/default/view/page/trad/dir/..|translation/layout/empty"));
		?>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- <style type="text/css">
			.form-group label.error{ color:red; font-size:10px; }
		</style> -->
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<!-- <body id="page-top" class="index" style="display: none;"> -->
	<body class="">
		 <!-- **************************************
        MAP CONTAINER
        ******************************************* -->
        <!--<progress class="progressTop" max="100" value="20"></progress>-->
		<div id="mainMap">
			<?php $this->renderPartial($layoutPath.'mainMap'); ?>
		</div>

	<?php
		$this->renderPartial( $layoutPath.'modals' );
		
		//get all my link to put in floopDrawer
		if(isset(Yii::app()->session['userId'])){
	      $myContacts = Person::getPersonLinksByPersonId(Yii::app()->session['userId']);
	      $myFormContact = $myContacts; 
	      $getType = (isset($_GET["type"]) && $_GET["type"] != "citoyens") ? $_GET["type"] : "citoyens";
	    }else
	      $myFormContact = null;
	    

	   // error_log("load IndexDefault");
	?>
	<!-- **************************************
	MENUS TOP AND LEFT CONTAINER
	******************************************* -->
	<?php $this->renderPartial($layoutPath.'menu.menuTop', array("params" => $networkJson, "me" => $me)); ?>
	<?php $this->renderPartial($layoutPath."menu.menuLeft", array("params" => $networkJson, "me" => $me)); ?>
		
		<?php /*if(@Yii::app()->session['custom']){ ?>
		<div class="col-xs-12">
			<img src="<?php echo Yii::app()->session['custom']['logo'] ?>">
		</div>
		<?php } */?>

		<div class="col-xs-12 my-main-container no-padding" style="top: 50px; display: none;">

			<?php $classMaincontener = ( empty($networkJson['filter']) ? "col-xs-12" : "col-md-10 col-md-offset-2 col-sm-9 col-sm-offset-3 col-xs-12" ); ?>
			<div class="<?php echo $classMaincontener ;?> main-col-search no-padding" style="min-height: 490px; opacity: 1;">
			<?php $this->renderPartial("../network/simplyDirectory",array("params" => $networkJson)); ?>
			</div>
		</div>
	
	
		<?php //if(!isset(Yii::app()->session['userId']))
		$this->renderPartial($layoutPath."simply_login_register", array("params" => $networkJson));
		?>

	<!-- **************************************
		NOTIFICATION PANELS
		******************************************* -->
	<?php  
		//if(isset(Yii::app()->session['userId'])) 
			//$this->renderPartial($layoutPath.'notifications2');
		
		/* *****************************************
		Active Content from the controller
		******************************************* */

		/* *************************************
		END structure 
		*******************************************/

	?>
	<?php $this->renderPartial($layoutPath.'menu.menuBottom', array("params" => $networkJson)); ?>

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
			'/plugins/toastr/toastr.js' , 
			'/plugins/toastr/toastr.min.css',
			'/plugins/jquery-cookie/jquery.cookie.js' , 
			'/plugins/jquery-cookieDirective/jquery.cookiesdirective.js' , 
			'/plugins/jQuery-contextMenu/dist/jquery.contextMenu.min.js' , 
			'/plugins/jQuery-contextMenu/dist/jquery.contextMenu.min.css' , 
			'/plugins/jQuery-contextMenu/dist/jquery.ui.position.min.js' , 
			'/plugins/select2/select2.min.js' , 
			'/plugins/select2/select2.css',
			'/plugins/jquery-validation/dist/jquery.validate.min.js',
			'/plugins/jquery-validation/localization/messages_fr.js',
			'/plugins/lightbox2/css/lightbox.css',
			'/plugins/lightbox2/js/lightbox.min.js',
			'/plugins/animate.css/animate.min.css',
			'/plugins/font-awesome/css/font-awesome.min.css',
			'/plugins/font-awesome-custom/css/font-awesome.css',
			'/plugins/jquery.dynForm.js',
			'/js/api.js',

			'/plugins/fine-uploader/jquery.fine-uploader/fine-uploader-gallery.css',
		    '/plugins/fine-uploader/jquery.fine-uploader/jquery.fine-uploader.js',
		    '/plugins/fine-uploader/jquery.fine-uploader/fine-uploader-new.min.css'
		);
		if(Yii::app()->language!="en")
                array_push($cssAnsScriptFilesModule,"/plugins/jquery-validation/localization/messages_".Yii::app()->language.".js");
		HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->getRequest()->getBaseUrl(true));
		HtmlHelper::registerCssAndScriptsFiles( array('/js/default/formInMap.js') , $this->module->assetsUrl);

		$cssAnsScriptFilesModule = array(
			'/assets/css/themes/theme-simple-login.css',
			'/assets/css/styles.css',
			'/assets/js/cookie.js' ,
            '/assets/css/sig/sig.css',
			'/assets/css/freelancer.css',
			'/assets/css/default/dynForm.css',
			'/assets/css/CO2/CO2-boot.css',
			'/assets/css/CO2/CO2-color.css',
			'/assets/css/CO2/CO2.css',
			'/assets/css/plugins.css',
			'/assets/css/search.css',
			// '/assets/css/styles-responsive.css',
			'/assets/css/default/directory.css',
			'/assets/css/floopDrawerRight.css',
			'/assets/css/news/index.css',
			'/assets/js/comments.js',
			'/assets/css/search_simply.css',
					
		);
		HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);
		$this->renderPartial($layoutPath.'initJs', 
                                 array( "me"=>@$me, "parentModuleId" => $parentModuleId, "myFormContact" => @$myFormContact));

		$this->renderPartial($layoutPath.'initCommunexion', array());


        $this->renderPartial($layoutPath.'modals.'.$CO2DomainName.'.invite');
		//<!-- end: MAIN JAVASCRIPTS -->
		//<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		?>
		<script type="text/javascript">
		console.log("MainSearch2");
		var networkParams = "<?php echo Yii::app()->params['networkParams'] ?>";
		var networkJson = <?php echo json_encode($networkJson)?>;
		var globalTheme = "network";
		var CO2DomainName = "<?php echo $CO2DomainName; ?>";
		var CO2params = <?php echo json_encode($params); ?>;


		var lastUrl = null;
		var isMapEnd = <?php echo (isset( $_GET["map"])) ? "true" : "false" ?>;
		var allReadyLoad=false;

		var urlTypes = <?php asort(Element::$urlTypes); echo json_encode(Element::$urlTypes) ?>;

		
		// GET LIST OF NETWORK'S TAGS
		// if(networkJson != null && typeof networkJson.filter != "undefined" && typeof networkJson.filter.linksTag != "undefined" && typeof networkJson.request.searchTag != "undefined"){
		if(networkJson != null){
			var networkTags = [];
			//var networkTags2 = {};
			var networkTagsCategory = {};
			//var optgroupArray = {};
			tagsList = [];
			if(typeof networkJson.request != "undefined"){
				if(typeof networkJson.request.mainTag != "undefined")
					networkTags.push({id:networkJson.request.mainTag[0],text:networkJson.request.mainTag[0]});

				if(typeof networkJson.request.searchTag != "undefined"){
					console.log("NETWORK searchTag", networkTags);
					networkTags = $.merge(networkTags, networkJson.request.searchTag);
					console.log("NETWORK searchTag", networkTags);
				}
			}
			

			if(typeof networkJson.filter != "undefined" && typeof networkJson.filter.linksTag != "undefined"){
				$.each(networkJson.filter.linksTag, function(category, properties) {
					optgroupObject=new Object;
					optgroupObject.text=category;
					optgroupObject.children=[];
					networkTagsCategory[category]=[];
					$.each(properties.tags, function(i, tag) {
						if($.isArray(tag)){
							$.each(tag, function(keyTag, textTag) {
								val={id:textTag,text:textTag};
								if(jQuery.inArray( textTag, tagsList ) == -1 ){
									optgroupObject.children.push(val);
									tagsList.push(textTag);
								}
							});
						}else{
							val={id:tag,text:tag};
							if(jQuery.inArray( tag, tagsList ) == -1 ){
								optgroupObject.children.push(val);
								tagsList.push(tag);
							}
						}
					});
					networkTags.push(optgroupObject);
					networkTagsCategory[category].push(optgroupObject);
				});
			}
		}


		//console.warn("isMapEnd 1",isMapEnd);
		jQuery(document).ready(function() {
			setTitle(networkJson.skin.title , "", networkJson.skin.title, networkJson.skin.title, networkJson.skin.shortDescription);

			$.each(modules,function(k,v) { 
                if(v.init){
                    mylog.log("init.js for module : ",k);
                    lazyLoad( v.init , null,null);
                }
            });
			// Initialize tags list for network in form of element
			urlCtrl.loadByHash(location.hash,true);
			//$(".bg-main-menu.bgpixeltree_sig").remove();
			$("#mapCanvasBg").show();

		    console.log("INIT scroll shadows!");
		    $(".my-main-container").bind("scroll", function(){
		    	//console.log("scrolling my-container");
		    	checkScroll();
		    	shadowOnHeader()
		    });


		    // $(".btn-scope").click(function(){
		    // 	var level = $(this).attr("level");
		    // 	selectScopeLevelCommunexion(level);
		    // });
		    // $(".btn-scope").mouseenter(function(){
		    // 	$(".btn-scope").removeClass("selected");
		    // });
		    // $(".btn-scope").mouseout(function(){
		    // 	$(".btn-scope-niv-"+levelCommunexion).addClass("selected");
		    // });
		    
		 //    initNotifications();
			// initFloopDrawer();
		    
		    // $(window).resize(function(){
		    //   resizeInterface();
		    // });

		    // resizeInterface();
		    // showFloopDrawer();
			
			//manages the back button state 
			//every url change (urlCtrl.loadByHash) is pushed into history.pushState 
			//onclick back btn popstate is launched
			//
		    // $(window).bind("popstate", function(e) {
		    //   //console.dir(e);
		    //   console.log("history.state",$.isEmptyObject(history.state),location.hash);
		    //   console.warn("popstate history.state",history.state);
		    //   if( lastUrl && "onhashchange" in window && location.hash  ){
		    //     if( $.isEmptyObject( history.state ) && allReadyLoad == false ){
			   //      //console.warn("poped state",location.hash);
			   //      //lastUrl = location.hash;
			   //      urlCtrl.loadByHash(location.hash,true);
			   //  } 
			   //  allReadyLoad = false;
		    //   }
			  
		    //   lastUrl = location.hash;
		    // });

			// if(userConnected != null && userConnected != "" && typeof userConnected != "undefined" && !location.hash){
			// 	//location.search="?network="+networkParams
			// 	//console.warn("hash 1", location.hash);
			// 	//urlCtrl.loadByHash("#network.simplydirectory");
			// 	return;
			// } 
			// else{ //si l'utilisateur est déjà passé par le two_step_register
		 // 		if(location.hash != "#network.simplydirectory" && location.hash != "#" && location.hash != ""){
		 // 			console.warn("hash 2", location.hash);
		 // 			urlCtrl.loadByHash(location.hash);
			// 		return;
			// 	}
			// 	else{ 
			// 		return;
			// 		if(userConnected != null && userId != null  && userId != "" && typeof userId != "undefined")
			// 			urlCtrl.loadByHash("#default.live");
			// 		else
			// 			urlCtrl.loadByHash("#default.live");
			// 	}
			// }
			//checkScroll();
		});

		
		</script>

		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	</body>
	<!-- end: BODY -->
</html>