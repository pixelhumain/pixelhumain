<?php
$communexion = CO2::getCommunexionCookies(); 
?>
<style>
	.contact-map {	
		background:url(<?php echo $this->module->assetsUrl; ?>/images/people.jpg) bottom center repeat-x; 
		background-size: 60%;
		background-color:#DFE7E9;  
	}

    @media (min-width: 767px) and (max-width: 992px) {
        #mainNav .dropdown-result-global-search{
            width:40% !important;
        }
    } 
</style>

<div class="pageContent">

	<div class="col-md-12 col-lg-12 col-sm-12 imageSection" 
		 style="margin-top: 30px; position:relative;">

		<div class="col-md-12 no-padding">
			
			<?php if(!isset(Yii::app()->session['userId'])) { ?>
			<div class="col-md-7 col-sm-7 text-center">
				<div id="homeImg">
					<img id="img-header" class="img-responsive" 
						 src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/FI-logo.png"/>
				</div>
			</div>

			<div class="col-md-4 col-sm-5 margin-top-25 padding-bottom-15 margin-right-50" 
				 style="border:1px solid #DDD; background-color: #F9F9F9; border-radius:4px;">
				<?php 	$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
			  			$this->renderPartial($layoutPath.'forms.'.Yii::app()->params["CO2DomainName"].'.register'); 
			  			$this->renderPartial($layoutPath.'forms.'.Yii::app()->params["CO2DomainName"].'.modalRegisterSuccess')
			  	?>
			</div>
			<?php } else { ?>
			<div class="col-md-12 text-center">
				<div id="homeImg">
					<img id="img-header" class="img-responsive" 
						 src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/FI-logo.png"/>
				</div>
			</div>
			<?php } ?>
		</div>


		<div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 shadow2 padding-15 margin-top-25">
			<div class="mainmenu"></div>
		</div>


		<div class="col-md-12 col-sm-12 col-xs-12  margin-top-50">
			<?php $isEmptyCo = empty($communexion["values"]["cityName"]); 
				//var_dump($communexion);
			?>
			
			<h3 class="text-red text-center">
				<i class="fa fa-home fa-2x"></i><br>
				Communexion<br>
				<small>
				<i class="fa fa-cross"></i> 
				<span id="communexionNameHome">
				<?php if($isEmptyCo){ ?>
					Vous n'êtes pas <span class="text-dark">communecté</span>
				<?php }else{ ?>
					Vous êtes <span class="text-dark">communecté à 
					<span class="text-red"><?php echo $communexion["values"]["cityName"];?></span> </span>
				<?php } ?>
				</span><br>
					<small class="text-dark inline-block margin-top-5 info_co
						 <?php if(!$isEmptyCo) echo "hidden"; ?>" 
						 style="line-height: 15px;">
						<i class="fa fa-signal"></i> 
						Être communecté vous permet de capter en direct les informations pertinentes<br>
						qui se trouvent autour de vous.
					</small>
				</small>
			</h3>

			<hr class="angle-down">

			<h5 class="text-center info_co <?php if(!$isEmptyCo) echo 'hidden'; ?>">
				communectez-vous !
			</h5>
			<div class="col-md-12 text-center">
				<button class="btn btn-default <?php if($isEmptyCo) echo 'hidden'; ?>" id="change_co">
				Changer de communexion
				</button>
			</div>
			
			<input class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 form-input text-center input_co 
						 <?php if(!$isEmptyCo) echo "hidden"; ?>" 
				   id="main-search-bar" type="text" 
				   style="border-radius:50px; height:40px; border: 2px solid red; color:red; margin-bottom:15px;"
				   placeholder="communectez-vous : Nantes, Strasbourg, Avignon ?"></div>

			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 info_co
						 <?php if(!$isEmptyCo) echo "hidden"; ?>" 
						 style="font-family: 11px;" id="info_co">
	            <i class="fa fa-signal"></i> Pour utiliser le réseau à pleine puissance, nous vous conseillons de vous 
	            <i><b>communecter</b></i>.<br><br>
	            <i class="fa fa-magic"></i> Indiquez de préférence votre <b>commune de résidence</b>, 
	            pour garder un œil sur ce qui se passe près de chez vous, de façon automatique.<br>
	        </div>
	        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12" style="font-family: 11px;" id="dropdown_search">
	        </div>
		</div>

		
		<div class="col-md-12 col-sm-12 col-xs-12 no-padding margin-top-25"><hr></div>
		
		<div class="col-md-12 col-sm-12 col-xs-12">
			<h3 class="text-red text-center">
				<i class="fa fa-clock-o fa-2x"></i><br>
				En ce moment<br>
				<small id="liveNowCoName">
					<?php if($isEmptyCo){ ?>
					sur le réseau
					<?php }else{ ?>
					<span class='text-red'>à <?php echo $communexion["values"]["cityName"];?></span>
					<?php } ?>
				</small>
			</h3>
			<div class="text-left" id="nowList"></div>
		</div>

	</div>
	
	<div class="col-sm-12 col-md-12 col-xs-12 no-padding margin-top-50" style="background-color:#fff; max-width:100%; float:left;">
		<div class="col-md-12" style="background-color:#E33551;width:100%;padding:8px 0px 8px 0%;">
			<h1 class="homestead text-center text-white">
				<i class="fa fa-user-circle"></i><br>Les amis des Insoumis
			</h1>
		</div>
		<center>
			<i class="fa fa-caret-down text-red"></i><br/>
		</center>

		<div id="co-friends" class="hidden padding-15"></div>
	</div>

	<div class="col-sm-12 col-md-12 col-xs-12 no-padding margin-top-50" style="background-color:#E33551; max-width:100%; float:left;" id="teamSection">
		

		<center>
			<i class="fa fa-caret-down" style="color:#fff"></i><br/>
			<h1 class="homestead" style="color:#fff">
				<!-- <i class="fa fa-line-chart headerIcon"></i>  -->
				LOREM IPSUM
			</h1>
			
			<div class="col-sm-12 text-white padding-bottom-15">
				LOREM IPSUM
			</div>
		</center>
		<div class="space20"></div>
	</div>

	<div class="col-md-12 contact-map padding-bottom-50" style="color:#293A46; float:left; width:100%;" id="contactSection">
		<center>
			<i class="fa fa-caret-down" style="color:#E33551"></i><br/>
			<h1 class="homestead">
			<i class="fa fa-envelope headerIcon"></i><br/>
			CONTACT
			</h1>
			+ 123456<br><a href="#">contact@fi.fi</a>

			<ul class="social-list">
				<li><a target="_blank" href="https://www.facebook.com/" class="btn btn-facebook btn-social"><span class="fa fa-facebook"></span></a></li>
				<li><a target="_blank" href="https://twitter.com/" class="btn btn-twitter btn-social"><span class="fa fa-twitter"></span></a></li>
				<li><a target="_blank" href="https://plus.google.com/communities/" class="btn btn-google btn-social"><span class="fa fa-google-plus"></span> </a></li>
				<li><a target="_blank" href="https://github.com/pixelhumain/communecter" class="btn btn-github btn-social"><span class="fa fa-github"></span> </a></li>
			</ul>

			<br/><a href="default/view/page/mention/dir/docs|panels" class="lbhp" >Mentions Légales</a>
			<br/><a href="default/view/page/partners/dir/docs|panels?type=partner" class="lbhp">Partenaires</a>
		<center>
	</div>
</div>


<div class="portfolio-modal modal fade" id="modalForgot" tabindex="-1" role="dialog" aria-hidden="true">
    <form class="modal-content form-email box-email padding-top-15"  >
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="name" >
                        <?php if(Yii::app()->params["CO2DomainName"] == "kgougle"){ ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" height="60" class="inline margin-bottom-15">
                       <?php } else if(Yii::app()->params["CO2DomainName"] == "FI"){ ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/FI-logo-min.png" height="100" class="inline margin-bottom-15">
                        <?php } else { ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="100" class="inline margin-bottom-15">
                        <?php } ?>
                    </span>
                    <h4 class="letter-red no-margin" style="margin-top:-5px!important;">Mot de passe oublié ?</h4><br>
                    <hr>
                    <p><small>Indiquez votre addresse e-mail, vous recevrez un e-mail contenant votre mot de passe.</small></p>
                    <hr>
                    
                </div>
            </div>
            <div class="col-md-4 col-md-offset-4 text-left">
                
                <label class="letter-black"><i class="fa fa-envelope"></i> E-mail</label><br>
                <input class="form-control" id="email2" name="email2" type="text" placeholder="E-mail"><br/>
                
                <hr>

                <div class="pull-left form-actions no-margin" style="width:100%; padding:10px;">
                    <div class="errorHandler alert alert-danger no-display registerResult pull-left " style="width:100%;">
                        <i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
                    </div>
                </div>

                <!-- <div class="form-actions">
                     <button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="forgotBtn ladda-button center center-block">
                        <span class="ladda-label">XXXXXXXX</span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
                    </button>
                </div> -->

                <a href="javascript:" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Retour</a>
                <button class="btn btn-success text-white pull-right forgotBtn"><i class="fa fa-sign-in"></i> Envoyer</button>
                
                
                <div class="col-md-12 margin-top-50 margin-bottom-50"></div>
            </div>      
        </div>
    </form>
</div>


<script type="text/javascript">

<?php $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
	  $this->renderPartial($layoutPath.'home.peopleTalk'); ?>
var peopleTalkCt = 0;
var communexion=<?php echo json_encode($communexion) ?>;
jQuery(document).ready(function() {

	topMenuActivated = false;
	hideScrollTop = true;
	checkScroll();

	loadLiveNow();
	openVideo();

	peopleTalkCt = getRandomInt(0,peopleTalk.length);
	showPeopleTalk();


    $("#map-loading-data").hide();
	$(".mainmenu").html($("#modalMainMenu .links-main-menu").html());
	//$("#modalMainMenu .links-main-menu").html("");

	//setTimeout(function(){ $("#input-communexion").hide(300); }, 300);

	var timerCo = false;
			
	$("#main-search-bar").keyup(function(){
		if($("#main-search-bar").val().length > 2){
			if(timerCo != false) clearTimeout(timerCo);
			timerCo = setTimeout(function(){ 
				//$("#info_co").html("");
				$(".info_co").addClass("hidden");
				$("#change_co").addClass("hidden");
				searchType = ["cities"];
				loadingData=false;
				scrollEnd=false;
				totalData = 0;
				startSearch(0, 20);
			}, 500);
		}else{
			$(".info_co").removeClass("hidden");
			$("#dropdown_search").html("");
		}
	});


    $("#change_co").click(function(){
    	$(".info_co, .input_co").removeClass("hidden");
		$("#change_co").addClass("hidden");

    });


	setTitle("","home","Réseau France Insoumise");
	$('.tooltips').tooltip();

	$("#btn-param-postal-code").click(function(){
		$("#div-param-postal-code").show(400);
	});


    $(".explainLink").click(function() {
		showDefinition( $(this).data("id") );
		return false;
	});
    $(".keyword").click(function() {
    	$(".keysUsages").hide();
    	link = "<br/><a href='javascript:;' class='showUsage homestead yellow'><i class='fa fa-toggle-up' style='color:#fff'></i> Usages</a>";
    	$(".keywordExplain").html( $("."+$(this).data("id")).html()+link ).fadeIn(400);
    	 $(".showUsage").off().on("click",function() { $(".keywordExplain").slideUp(); $(".keysUsages").slideDown();});
    });

    $(".keyword1").click(function() {
    	$(".keysKeyWords").hide();
    	link = "<br/><a href='javascript:;' class='showKeywords homestead yellow'><i class='fa fa-toggle-up' style='color:#fff'></i> Mots Clefs</a>";
    	$(".usageExplain").html( $("."+$(this).data("id")).html()+link ).slideDown();
    	 $(".showKeywords").off().on("click",function() { $(".usageExplain").slideUp(); $(".keysKeyWords").slideDown();});
    });


    $(".btn-main-menu").mouseenter(function(){ 
        $(".menuSection2").addClass("hidden"); 
        if( $(this).data("type") ) 
            $("."+$(this).data("type")+"Section2").removeClass("hidden");
    }).click(function(e) {  
        e.preventDefault(); 
        $('#modalMainMenu').modal("hide"); 
        mylog.warn("***************************************"); 
        mylog.warn("bindLBHLinks",$(this).attr("href")); 
        mylog.warn("***************************************"); 
        var h = ($(this).data("hash")) ? $(this).data("hash") : $(this).attr("href"); 
        urlCtrl.loadByHash( h ); 
    }); 

    $(".tagSearchBtn").click(function(e) {  
        e.preventDefault(); 
        $('#modalMainMenu').modal("hide"); 
        mylog.warn( ".tagSearchBtn",$(this).data("type"),$(this).data("stype"),$(this).data("tags") ); 

        searchObj.types = $(this).data("type").split(",");
        
        if( $(this).data("stype") )
            searchObj.stype = $(this).data("stype");
        else
            searchObj.tags = $(this).data("tags");
        
        urlCtrl.loadByHash($(this).data("app"));
        urlCtrl.afterLoad = function () {     
            //we have to pass by a variable to set the values         
            searchType = searchObj.types;
        
            if( $(this).data("stype") )
                $('#searchSType').val(searchObj.stype);
            else
                $('#searchTags').val(searchObj.tags);
            startSearch();
            searchObj = {};
        }
    }); 

});
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
function showPeopleTalk(step)
{
	var html = "";
	$.each(peopleTalk, function(key, person){
	html += '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 padding-5" style="min-height:430px;max-height:430px;">' +
				'<div class="" style="max-height:240px; overflow:hidden; max-width:100%;">' +
				'<img class="img-responsive img-thumbnail peopleTalkImg" src="'+person.image+'"><br>' +
				'</div>' +
				'<span class="peopleTalkName">'+person.name+'</span><br>' +
				'<span class="peopleTalkProject">'+person.project+'</span><br>' +
				'<span class="peopleTalkComment inline-block">'+person.comment+'</span>' +
			'</div>';
	});

	$("#co-friends").html( html );
}

function openVideo(){
	//$("#homeImg").fadeOut("slow",function() {
		$(".videoWrapper").fadeIn('slow');
	//});
}

var timeoutSearchHome = null;

function showTagOnMap (tag) {

	mylog.log("showTagOnMap",tag);

	var data = { 	 "name" : tag,
		 			 "locality" : "",
		 			 "searchType" : [ "persons" ],
		 			 //"searchBy" : "INSEE",
            		 "indexMin" : 0,
            		 "indexMax" : 500
            		};

		$.blockUI({
			message : "<h1 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i> Recherches des collaborateurs ...</h1>"
		});

		showMap(true);

		$.ajax({
	      type: "POST",
	          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
	          data: data,
	          dataType: "json",
	          error: function (data){
	             mylog.log("error"); mylog.dir(data);
	          },
	          success: function(data){
	            if(!data){ toastr.error(data.content); }
	            else{
	            	mylog.dir(data);
	            	Sig.showMapElements(Sig.map, data);
	            	$.unblockUI();
	            }
	          }
	 	});
}



function loadLiveNow () {
	mylog.log("loadLiveNow", communexion);
	
	var searchParams = {
      "tpl":"/pod/nowList",//"json", //
      "searchLocalityCITYKEY" : new Array(""),
      "indexMin" : 0, 
      "indexMax" : 30 
    };

    console.log("communexion : ", communexion);
	if($("#searchLocalityCITYKEY").val() != ""){
		searchParams.searchLocalityCITYKEY = new Array($("#searchLocalityCITYKEY").val());
	}else if(typeof communexion.values.cityKey != "undefined"){
		searchParams.searchLocalityCITYKEY = new Array(communexion.values.cityKey);
	}
   		
    ajaxPost( "#nowList", baseUrl+'/'+moduleId+'/element/getdatadetail/type/0/id/0/dataName/liveNow?tpl=nowList',
					searchParams, function(data) {
					bindLBHLinks();
     } , "html" );
}


</script>
