//var loadableUrls = {};
// var loadableUrls = {

// 	"#k.web"			: {title:'', icon : "share-search"},
// 	"#k.live" 			: {title:"", icon : "rss"},
// 	"#k.referencement" 	: {title:"", icon : "plus"},
// 	"#k.agenda" 		: {title:"", icon : ""},
// 	"#k.page.type"		: {title:"", icon : ""},
// 	"#k.social"			: {title:"", icon : ""},
// 	"#k.freedom"		: {title:"", icon : ""},
// 	"#k.power"			: {title:"", icon : ""},
// 	"#element.detail"	: {title:"", icon : ""},
// 	//"": {title:'INVITE SOMEONE', icon : "share-search"},
// }

var CoAllReadyLoad = false;
var CoSigAllReadyLoad = false;
//back sert juste a differencier un load avec le back btn
//ne sert plus, juste a savoir d'ou vient drait l'appel
function loadByHash( hash , back ) { //alert("loadByHash");

	currentUrl = hash;
	allReadyLoad = true;
	CoAllReadyLoad = true;
	contextData = null;
	
	
    mylog.warn("loadByHash",hash,back);
    if( jsController(hash) ){
    	mylog.log("loadByHash",hash,back);
    	//mylog.log("loadByHash >>> jsController",hash);
    }
    else {
    	mylog.log("loadByHash",hash,back);    	
        showAjaxPanel( '/co2/index', 'Home','home' );
    }

    location.hash = hash;

    if(!back){
    	history.replaceState( { "hash" :location.hash} , null, location.hash ); //changes the history.state
	    mylog.warn("replaceState history.state",history.state);
	}
}


function showAjaxPanel (url,title,icon, mapEnd) { 
	//$(".main-main-col-search").css("opacity", 0);
	mylog.log("showAjaxPanel",url,"TITLE",title);
	//hideScrollTop = false;

	//showNotif(false);
			
	setTimeout(function(){
		$(".main-container").html("");
		$(".hover-info,.hover-info2").hide();
		processingBlockUi();
		//setTitle("Chargement en cours ...", "spin fa-circle-o-notch");
		showMap(false);
	}, 200);

	//$(".box").hide(200);
	//showPanel('box-ajax');
	//icon = (icon) ? " <i class='fa fa-"+icon+"'></i> " : "";
	//$(".panelTitle").html(icon+title).fadeIn();
	mylog.log("GETAJAX",icon+title);
	
	showTopMenu(true);
	userIdBefore = userId;
	setTimeout(function(){
		 getAjax('.main-container', baseUrl+'/'+moduleId+url, function(data){ 
			/*if(!userId && userIdBefore != userId )
				window.location.reload();*/

			//initNotifications(); 
			$(".modal-backdrop").hide();
			bindExplainLinks();
			bindTags();
			bindLBHLinks();

			$.unblockUI();

			if(mapEnd)
				showMap(true);
			
		},"html");
	}, 400);
}

function  processingBlockUi() { 
	var imgLoad = "CO2r.png";
	if(typeof CO2DomainName != "undefined")
		if(CO2DomainName=="kgougle")
			imgLoad = "logocagou-loader.png";


	var msgBlock = '<img src="'+themeUrl+'/assets/img/'+imgLoad+'" class="nc_map" height=80>'+
	 			  '<i class="fa fa-spin fa-circle-o-notch"></i>'+
	 			  '<h4 style="font-weight:300" class=" text-dark padding-10">'+
	 				'Chargement en cours...'+
	 			  '</h4>'+
	 			  '<span style="font-weight:300" class=" text-dark">'+
	 				'Merci de patienter quelques instants'+
	 			  '</span>'+
	 			  '<br><br><br>'+
	 			  '<a href="#" class="btn btn-default btn-sm lbh">'+
	 			  	"c'est trop long !"+
	 			  '</a>';

	if(CO2DomainName=="CO2" && false) msgBlock +=
	'<h4 class="text-dark no-margin" style="margin-top:5px!important;">'+
        'VERSION DE TEST EN COURS DE DÉVELOPPEMENT !!!'+
        '<br>'+
        '<span class="letter-red"></span>'+
    '</h4>'+
	'<p class="letter-red no-margin" style="font-size:13px; margin-top:5px!important;">'+
        'Cette nouvelle interface est en cours de développement, Merci de ne pas tenir compte des bug.<br>'+
        'Nous sommes en train de basculer les fonctionnalités de communecter.org sur cette interface, '+
        'afin de rendre la navigation plus simple et compréhensible pour tous.<br>'+
        'L\'objectif est de proposer une page/interface pour chaque grande fonctionnalité de communecter, '+
        'afin de créer des portes d\'entrées indépendantes sur le réseau, en fonction des besoins de chacun.<br><br>'+
        '<b>Vos remarques et idées à ce propos sont les bienvenues.<br>'+
        'Merci de nous en faire part sur le channel dédié <a href="https://chat.initiative.place/channel/co2_brainstorm" class="letter-blue">#CO2_brainstorm</a></b>'+
    '</p>';

	$.blockUI({
	 	message : msgBlock
	 });
	bindLBHLinks();
}


function getAjax(id,url,callback,datatype,blockUI)
{
  $.ajaxSetup({ cache: true});
  mylog.log("getAjax",id,url,callback,datatype,blockUI)
    if(blockUI)
        $.blockUI({
            message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
                      '<blockquote>'+
                        '<p>Art is the heart of our culture.</p>'+
                      '</blockquote> '
        });
  
    if(datatype != "html" )
        $(id).html( "<div class='cblock'><div class='centered'><i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading</div></div>" );
  
    $.ajax({
        url:url,
        type:"GET",
        cache: true,
        success:function(data) {
          if (data.error) {
            mylog.warn(data.error);
            toastr.error(data.error.msg);
          } else if(datatype === "html" )
            $(id).html(data);
          else if(datatype === "norender" )
            mylog.log("no render",url)
          else if( typeof data === "string" )
            toastr.success(data);
          else
              $(id).html( JSON.stringify(data, null, 4) );
  
          if( typeof callback === "function")
            callback(data,id);
          if(blockUI)
            $.unblockUI();
        },
        error:function (xhr, ajaxOptions, thrownError){
          //mylog.error(thrownError);
          $.blockUI({
              message : '<img src="'+themeUrl+'/assets/img/CO2r.png" class="nc_map pull-" height=80>'+
			 			  '<i class="fa fa-times"></i>'+
			 			   '<span class="col-md-12 text-center font-blackoutM text-left">'+
			 			    '<span class="letter letter-red font-blackoutT" style="font-size:40px;">404</span>'+
		                   '</span>'+

			 			  '<h4 style="font-weight:300" class=" text-dark padding-10">'+
			 				'Oups ! Une erreur s\'est produite'+
			 			  '</h4>'+
			 			  '<span style="font-weight:300" class=" text-dark">'+
			 				'Vous allez être redirigé vers la page d\'accueil'+
			 			  '</span>',
              timeout: 3000 
          });
          setTimeout(function(){loadByHash('#')},3000);
          if(blockUI)
            $.unblockUI();
        } 
    });
}

function initNotifications(){
	mylog.log("initNotifications");
	$('.btn-menu-notif').off().click(function(){
	  mylog.log("click notification main-top-menu");
      showNotif();
    });
    $('.btn-menu-notif').off().click(function(){
	  mylog.log("click notification my-main-container");
      showNotif();
    });
}
function showNotif(show){
	if(typeof show == "undefined"){
		if($("#notificationPanelSearch").css("display") == "none") show = true; 
    	else show = false;
    }

    if(show) $('#notificationPanelSearch').show("fast");
	else 	 $('#notificationPanelSearch').hide("fast");
}

function KScrollTo(target){ 
	mylog.log("target", target);
	if(!$(target)) return;

	$('html, body').stop().animate({
        scrollTop: $(target).offset().top - 70
    }, 800, '');
}

var timerCloseDropdownUser = false;
function initKInterface(params){

	$(window).off();

    //jQuery for page scrolling feature - requires jQuery Easing plugin
    $('.page-scroll a').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('.btn-scroll').bind('click', function(event) {
        var target = $(this).data('targetid');
        KScrollTo(target);
        event.preventDefault();
    });



    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function(){ 
            $('.navbar-toggle:visible').click();
    });

    $(".logout").click(function(){
    	document.location.href="/ph/co2/person/logout";
    });

    var affixTop = 400;
    if(notEmpty(params)){
    	if(typeof params["affixTop"] != "undefined") affixTop = params["affixTop"];
    }
    console.log("affixTop", affixTop);
    if(affixTop > 0){
      // Offset for Main Navigation
      $('#mainNav').affix({
          offset: {
              top: affixTop
          }
      });
    }

    // Floating label headings for the contact form
    $(function() {
        $("body").on("input propertychange", ".floating-label-form-group", function(e) {
            $(this).toggleClass("floating-label-form-group-with-value", !!$(e.target).val());
        }).on("focus", ".floating-label-form-group", function() {
            $(this).addClass("floating-label-form-group-with-focus");
        }).on("blur", ".floating-label-form-group", function() {
            $(this).removeClass("floating-label-form-group-with-focus");
        });
    });


    $(".btn-show-map").off().click(function(){
    	showMap();
    });

    bindLBHLinks();

    $(".menu-name-profil #menu-thumb-profil, "+
      ".menu-name-profil #menu-name-profil").mouseenter(function(){
        $("#dropdown-user").addClass("open");
        clearTimeout(timerCloseDropdownUser);
    });
    $(".menu-name-profil #menu-thumb-profil, "+
      ".menu-name-profil #menu-name-profil").mouseleave(function(){
      	timerCloseDropdownUser=true;
        setTimeout(function(){
        	if(timerCloseDropdownUser==true)
        	$("#dropdown-user").removeClass("open");
        },1000);
    });
    $("#dropdown-user").mouseenter(function(){
    	timerCloseDropdownUser = false;
    });
    $("#dropdown-user").mouseleave(function(){
        $("#dropdown-user").removeClass("open");
    });

    setTimeout(function(){ 
      $(".tooltips").tooltip();
      mapBg = Sig.loadMap("mapCanvas", initSigParams);
      Sig.showIcoLoading(false);
      CoSigAllReadyLoad = true;
    }, 3000);

    KScrollTo(".main-container");

}

var currentScrollTop = 0;
var isMapEnd = false;
function showMap(show)
{

  if(mapBg == null) return;

	//if(typeof Sig == "undefined") { alert("Pas de SIG"); return; } 
	mylog.log("typeof SIG : ", typeof Sig);
	if(typeof Sig == "undefined") show = false;

  //chargement de la carte



	mylog.log("showMap");
	if(show === undefined) show = !isMapEnd;
	if(show){
		isMapEnd =true;
		showNotif(false);

		currentScrollTop = $('html').scrollTop();
		

		//$("#mapLegende").html("");
		//$("#mapLegende").hide();

		showTopMenu(true);
		if(Sig.currentMarkerPopupOpen != null){
			Sig.currentMarkerPopupOpen.fire('click');
		}
		
		$(".btn-group-map").show( 700 );
		$("#right_tool_map").show(700);
		// $(".btn-menu5, .btn-menu6, .btn-menu7, .btn-menu8, .btn-menu9, .btn-menu10, .btn-menu-add").hide();
		// $("#btn-toogle-map").html("<i class='fa fa-th-large'></i>");
		// $("#btn-toogle-map").attr("data-original-title", "Tableau de bord");
		// $("#btn-toogle-map").css("display","inline !important");
		// $("#btn-toogle-map").show();
		//$(".lbl-btn-menu").hide(400);
		//$(".fa-angle-right").hide(400);
		//$(".menu-left-container hr").css({opacity:0});
		$(".main-menu-left").hide(); //addClass("inSig");
		$("body").addClass("inSig");

		$(".main-container").animate({
     							//top: -1000,
     							opacity:0,
						      }, 'slow' );

		setTimeout(function(){ $(".main-container").hide(); }, 100);
		var timer = setTimeout("Sig.constructUI()", 1000);
		
	}else{
		isMapEnd = false;
		hideMapLegende();

		var iconMap = "map-marker";
		if(typeof ICON_MAP_MENU_TOP != "undefined") iconMap = ICON_MAP_MENU_TOP;
		//mylog.log(ICON_MAP_MENU_TOP);
		// $(".btn-group-map").hide( 700 );
		// $("#right_tool_map").hide(700);
		// $(".btn-menu5, .btn-menu6, .btn-menu7, .btn-menu8, .btn-menu9, .btn-menu10, .btn-menu-add").show();
		// $(".panel_map").hide(1);
		// $("#btn-toogle-map").html("<i class='fa fa-"+iconMap+"'></i>");
		// $("#btn-toogle-map").attr("data-original-title", "Carte");
		//$(".main-col-search").animate({ top: 0, opacity:1 }, 800 );
		//$(".lbl-btn-menu").show(400);
		//$(".fa-angle-right").show(400);		
		//$(".menu-left-container hr").css({opacity:1} );
		//$(".main-menu-left").removeClass("inSig");
		$("body").removeClass("inSig");
		$(".main-container").animate({
     							//top: 50,
     							opacity:1
						      }, 'slow' );
		setTimeout(function(){ 
			$(".main-container").show();
			$('html, body').stop().animate({
	            scrollTop: currentScrollTop
	        }, 500, ''); 
		}, 100);

		//hideFormInMap();

		// if(typeof Sig != "undefined")
		// if(Sig.currentMarkerPopupOpen != null){
		// 	Sig.currentMarkerPopupOpen.closePopup();
		// }

		//if($(".box-add").css("display") == "none" && notEmpty(userId))
		//	$("#ajaxSV").show( 700 );

		//showTopMenu(true);	
		//checkScroll();
	}
		
}


function initToastr(){
	toastr.options = {
      "closeButton": false,
      "positionClass": "toast-bottom-left",
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
}