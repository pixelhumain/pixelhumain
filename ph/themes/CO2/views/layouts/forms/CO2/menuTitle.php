<script type="text/javascript">
	var  activePanel = "box-login";
	var  bgcolorClass = "bgblack";
	var navHistory = null;
	var prevNav = null;

	function showPanel(box,bgStyle,title,icon){
	mylog.log("showPanel", box,bgStyle,title,icon);
	lastUrl = null;
	$("body.login").removeClass("bgred bggreen bgblack bgblue");
	mylog.log("showPanel",box, bgcolorClass );
	$('.'+activePanel+", .panelTitle, .box-ajax").hide();
	$(".byPHRight").fadeOut();
	$("body.login").removeClass("bgred bggreen bgblack bgblue");

	if( !box || box == "box-login" || box == "box-forget" || box == "box-register" || box == "box-add" ){
		$(".byPHRight").fadeIn();
		$(".connectMarker").fadeOut();
		$("body.login").addClass("bgCity");
		bgcolorClass = "bgCity";
		mylog.log("showPanel2");
		if(box == "box-add"){
			Sig.clearMap();
			Sig.map.setView([23.32517767999296, -31.9921875], 2);
		}
	}
	else{
		bgcolorClass = (bgStyle) ? bgStyle : "bgblack";
		//commenté pour ne pas changer la couleur de fond
		//$("body.login").removeClass("bgCity").addClass(bgcolorClass);
		$(".connectMarker").fadeIn();
	}
	if( icon || title ){
		icon = (icon) ? " <i class='fa fa-"+icon+"'></i> " : "";
		setTitle(title,icon);
	}
	if(!box)
		box = "box-login";
	//$('.box-menu').slideUp();
	$('.'+box).show().addClass("animated bounceInRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
		$(this).show().removeClass("animated bounceInRight");
	});
	activePanel = box;
	if( box != "box-ph" && box != "box-who" )
	{
		$(".partnerLogosUp,.partnerLogosDown,.partnerLogosRight,.partnerLogosLeft").hide();
		$(".eventMarker").show().addClass("animated slideInDown");
		$(".cityMarker").show().addClass("animated slideInUp");
		$(".projectMarker").show().addClass("animated zoomInRight");
		$(".assoMarker").show().addClass("animated zoomInLeft");
		$(".userMarker").show().addClass("animated zoomInLeft");
	}
	else
	{
		$(".eventMarker, .cityMarker, .projectMarker, .assoMarker, .userMarker").fadeOut();
		$(".partnerLogosLeft").show().addClass("animated zoomInLeft");
		$(".partnerLogosRight").show().addClass("animated zoomInRight");
		$(".partnerLogosDown").show().addClass("animated zoomInDown");
		$(".partnerLogosUp").show().addClass("animated zoomInUp");
	}
}
var hashUrl = null
function openAjaxPanel (url,title,icon)  { 
	
}
function showResPanel (url,title,icon) 
{ 
	mylog.log("MDR showAjaxPanel",baseUrl+'/'+moduleId+url,title,icon);
	rand = Math.floor((Math.random() * 8) + 1);
	
	if(typeof showFloopDrawer != "undefined")
		showFloopDrawer(false);
	
	if(typeof proverbs != "undefined"){
		$.blockUI({message : '<div class="title-processing homestead"><i class="fa fa-spinner fa-spin"></i> Processing... </div>'
			+'<a class="thumb-info" href="'+proverbs[rand]+'" data-title="Proverbs, Culture, Art, Thoughts"  data-lightbox="all">'
			+ '<img src="'+proverbs[rand]+'" style="border:0px solid #666; border-radius:3px;"/></a><br/><br/>'
			});
	}
	$(".ajaxForm").hide();
	$("#main-title-public2").hide(400);
	$("#main-title-public1").html("<i class='fa fa-refresh fa-spin'></i> Chargement en cours");
	$("#main-title-public1").show(400);
	$(".box").hide(400);
	$(".box-ajax").show(600);
	//$(".box-ajax").html("<i class='fa fa-refresh fa-2x fa-spin'></i>");
	$(".ajaxForm").html('<form class="form-login ajaxForm" style="display:none" action="" method="POST"></form>');
	$(".box-ajaxTools").html("");

	getAjax('.ajaxForm',baseUrl+'/'+moduleId+url,function(){ 
		/*if(!userId){
			window.location.href = baseUrl+'/'+moduleId+"/person/login";
		} else{*/
			//if( icon && icon != "" && icon.indexOf('fa-') != 0) icon = "fa-"+icon;
			//icon = (icon) ? " <i class='fa "+icon+"'></i> " : "";
			//$(".panelLabel").html( icon+title );
			$(".ajaxForm").slideDown(); 
			$.unblockUI();
			$("#main-title-public1").html("");
			$("#main-title-public1").hide(400);
	
		//}
	},"html");

	showPanel('box-ajax');
	if( icon && icon != "" && icon.indexOf('fa-') < 0) icon = "fa-"+icon;
	icon = (icon) ? " <i class='fa "+icon+"'></i> " : "";
	setTitle(title,icon);
	showMap(false);
	//$(".box-ajaxTitle").html( icon + title );
}
function gotToPrevNav()
{
	mylog.dir( prevNav );
	if(prevNav != null)
	{
		if( prevNav.func == "showAjaxPanel" )
			showResPanel( prevNav.url, prevNav.title, prevNav.icon );
		else if( prevNav.func == "showPanel" )
			showPanel( prevNav.box, prevNav.bgStyle, prevNav.title, prevNav.icon );
	}
}
	function showHideMenu () { 
		mylog.log("open showHideMenu" );
		$("body.login").removeClass("bggreen bgblack bgblue bgyellow bgCity").addClass(bgcolorClass);
		//$(".menuBtn").removeClass("fa-bars").addClass("fa-times");
		$('.'+activePanel).hide();
		$('.box-menu').slideDown();
		$(".byPHRight").fadeOut();
		$(".partnerLogosUp,.partnerLogosDown,.partnerLogosRight,.partnerLogosLeft").hide();
		$(".eventMarker").show().addClass("animated slideInDown");
		$(".cityMarker").show().addClass("animated slideInUp");
		$(".projectMarker").show().addClass("animated zoomInRight");
		$(".assoMarker").show().addClass("animated zoomInLeft");
		$(".userMarker").show().addClass("animated zoomInLeft");
	}

	function showVideo(id) { 
		$('.'+activePanel+",.byPHRight, .eventMarker, .cityMarker, .projectMarker, .assoMarker, .userMarker,.partnerLogos ").fadeOut();
		$(".menuBtn").removeClass("fa-times").addClass("fa-bars");
		$("body.login").removeClass("bggreen bgblack bgblue bgyellow");
		$('.box-menu,.topLogoAnim').slideUp();
		$.okvideo({ source: id,
                    volume: 100,
                    loop: true,
                    disablekeyControl : false,
                    controls : true,
                    //hd:true,
                    //adproof: true,
                    //annotations: false,
                    onFinished: function() { 
                    	$('.topLogoAnim').slideDown();
                    	showPanel("box-login");
                    },
                    /*unstarted: function() { mylog.log('unstarted') },
                    onReady: function() { mylog.log('onready') },
                    onPlay: function() { mylog.log('onplay') },
                    onPause: function() { mylog.log('pause') },
                    buffering: function() { mylog.log('buffering') },
                    cued: function() { mylog.log('cued') },*/
                 });
	}
	var titleMapIndex = 1;
	var titleMap = [
		{titleRed:"CO",titleWhite:"MMU",titleWhite2:"NECTER",subTitle:"Se connecter à sa commune"},
		{titleRed:"COMMUNE",titleWhite:"CTER",subTitle:"Se connecter à sa commune"},
		{titleRed:"CO",titleWhite:"MMUNECTER",subTitle:"Coopérer et Collaborer"},
		{titleRed:"COMM",titleWhite:"UNECTER",subTitle:"Communiquons mieux localement"},
		{titleRed:"COMMU",titleWhite:"NECTER",subTitle:"Communautés qui travaillent ensemble"},
		{titleRed:"COMMUN",titleWhite:"ECTER",subTitle:"Pour le bien commun"},
		{titleRed:"COMMUNE",titleWhite:"CTER",subTitle:"Pour améliorer la ville 2.2.main"}
		
	];
	var timeoutanim = false;
	function titleAnim () 
	{ 
		if(timeoutanim!=false) clearTimeout(timeoutanim);
		timeoutanim = setTimeout(function()
		{
			//mylog.log("titleAnim",titleMapIndex);
			var map = titleMap[titleMapIndex];
			$(".titleRed").html(map.titleRed);
			$(".titleWhite").html(map.titleWhite);
			if(map.titleWhite2){
				$(".titleWhite2").html(map.titleWhite2);
				//toggleTitle ();
			}
			else
				$(".titleWhite2").html("");
			$(".subTitle").html(map.subTitle);
			titleMapIndex = ( titleMapIndex == titleMap.length-1 ) ? 0 : titleMapIndex+1;
			titleAnim ();
		},2000);
	}
</script>
<?php if(!isset($topTitleExists)){ ?>
<div class="">
	<div class="text-white text-extra-large text-bold center topLogoAnim " style="cursor: pointer" onclick="showPanel('box-communecter')">
		<span class="titleRed text-red homestead" style="">CO</span><span  style="" class="titleWhite homestead">MMU</span><span  style="" class="titleWhite2 text-red homestead">NECTER</span>

		<div class="subTitle" style="margin-top:-13px;">Se connecter à sa commune.</div>
	</div>
</div>
<?php } ?>
<style type="text/css">
	.nextBtns{color:#E33551; font-size:2.5em;}
	.nextBtns:hover{color:white; }
</style>






















