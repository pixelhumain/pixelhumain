<?php if( isset( Yii::app()->session['userId']) )
      {
      	$me = Person::getById(Yii::app()->session['userId']);
	  	$profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
       /* if(isset($me['profilImageUrl']) && $me['profilImageUrl'] != "")
          $urlPhotoProfil = Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$me['profilImageUrl']);
        else
          $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';*/
      }

    ?>
  <style>

  .add-title{
    margin-left:20px;
  }

  .menu-info-simply{
    /*margin-top: 8px;*/
    padding-right: 0px;
    position: relative;
    float: right;
    width:100%;
    margin-right: 5px;
  }

  .menu-info-simply.main{
    right:60px;
    top:10px;
    position: absolute;

    width: 100%;
  }
  /*.menu-info-simply.main{
    right:65px;
  }*/
  .menu-icon-profil{
    padding: 2px 15px 0px 7px;
  }
  .menu-name-profil{
    font-size: 15px;
    font-weight: 300;
    background: transparent;
    border: none;
    height:40px;
  }

  .main-top-menu .menu-info-simply{
    margin-top: 8px;
    padding-right: 0px;
    position: relative;
    float: right;
  }

  .menu-info-simply .dropdown-menu{
    top: 114%;
    margin-right: -15px;
    border-radius: 0px 0px 4px 4px;
    /*border-top-color: transparent;*/
  }
  .menu-info-simply.main .dropdown-menu{
    top: 114%;
    margin-right: -5px;
    border-radius: 0px 0px 4px 4px;
    /*border-top-color: transparent;*/
  }

  .main-top-menu .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus{
    background-color: #d2e7f2;
  }
  .main-top-menu .dropdown-menu .fa{
    width:20px;
    text-align: center;
  }

  .main-top-menu .notifications-count{
    position: absolute;
    left: 46%;
    top: 0px;
    background-color: rgb(217, 83, 79);
  }

  .main-top-menu .input-global-search{
    /*float: right;*/
    margin-top: -2px;
    margin-right: 9px;
    width: 240px;
    height: 38px;
    border: 1px solid rgba(128, 128, 128, 0.46) !important;
    /*box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    -webkit-box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    -o-box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    box-shadow: 0px 3px 10px 0px rgba(66, 66, 66, 0.37) !important;*/
    padding: 3px 20px;
    font-size: 16px;
    border-radius: 0px !important;
    background-color: #FFF;
  }
  .main-top-menu .input-global-search:focus{
    box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    -webkit-box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    -o-box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    box-shadow: 0px 3px 10px 0px rgba(66, 66, 66, 0.37) !important;
  } 

  .main-top-menu .dropdown-result-global-search{
    position: fixed;
    top: 51px;
    right: 9.2%;
    width: 350px;
    max-height: 80%;
    overflow-y: auto;
    background-color: white;
    padding-top:10px;
    padding-bottom:10px;
    border-radius: 0px 0px 10px 10px;
    box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    -webkit-box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    -o-box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    box-shadow: 0px 9px 12px 3px rgba(66, 66, 66, 0.37) !important;
    /*overflow-x: hidden;*/
  }

  .main-top-menu .dropdown-result-global-search #footerDropdownGS{
    padding-bottom:10px;
  }


@media screen and (max-width: 767px) {
  .main-top-menu .input-global-search{
    width: 50px;
    padding-left:10px;
    font-size:13px;
  }

  .dropdown-result-global-search .entityRight{
    text-align: left !important;
  }
}

.row-height {
  display: table;
  table-layout: fixed;
  height: 100%;
  width: 100%;
}
.col-height {
  display: table-cell;
  float: none;
  height: 100%;
}

.dropdown-toggle i{
  padding-right:10px;
  padding-left:10px;
}
.contentTitleMap{
	width: 500px;
    border-radius: 0px 0px 50px 50px;
    color: white;
    background-color: rgba(40,40,40,0.9)!important;
}
#titleMapTop{
	position: fixed;
    top: -20px;
    right: 0px;
    left: 0px;
    height: 50px;
    text-align: center;
    text-align: -webkit-center;
    text-align: -moz-center;
}
.showHideMoreTitleMap{	
	color: white;
    position: relative;
    bottom: 0px;
    left:-5px;
    width: 55px;
    height: 25px;
    font-size: 35px;
    /* padding-top: 10px; */
    border-radius: 0px 0px 70px 70px;
    background-color: rgba(40,40,40,0.9) !important;
}
.showHideMoreTitleMap i{
    position: relative;
    top: -15px;	
}
.contentTitleMap h1{
	font-size: 20px;
}
.contentShortInformationMap{
	display:none;
}
#menuTopList{
	display:none;
}
#breadcrum{
	height: 50px;
    line-height: 30px;
    padding: 10px;
}
.breadcrumAnchor{
	font-size: 16px;
}
</style>
  <div class="col-xs-12 main-top-menu no-padding"  data-tpl="default.menu.menuTop">

<!--<div class="col-md-12 col-sm-12 col-xs-12 menu-info-simply row <?php echo isset($type) ? $type : ''; ?> no-padding">-->
    <!-- <input type="text" class="text-dark input-global-search hidden-xs" placeholder="rechercher ..."/>-->
    <div class="dropdown-result-global-search"></div>
	<a class="pull-left text-white"  id="btn-menu-launch">
		<i class="fa fa-filter firstIcon"></i>
		<span style="display:none;float:right;"> <i class="fa fa-filter"></i> Filtres</span>
	</a>
    <?php if(@$params['skin']["logo"]){ ?>

<!--	<a class="pull-left tooltips" href="javascript:loadByHash('#default.view.page.index.dir.docs')"  id="main-btn-co"
		data-toggle="tooltip" data-placement="bottom" 
		title="Lire la documentation" 
		alt="Lire la documentation">
    	<img src="<?php echo $this->module->assetsUrl.'/images/'.$params['skin']["logo"] ?>" />
    </a>  -->
    <?php } ?>
    <?php if(@$params['skin']["title"]){ ?>
	<div id="titleMapTop">
		<div class="contentTitleMap padding-10">
			<h1><?php echo $params['skin']["title"] ?></h1>
			<?php if(@$params['skin']["shortDescription"] || (@$params['skin']["displayCommunexion"] && $params['skin']["displayCommunexion"])){ ?>
				<div class="contentShortInformationMap">
					<?php if(@$params['skin']["shortDescription"]){ ?>
					<span class="shortDescriptionMap padding-10"> 
						<?php echo $params['skin']["shortDescription"]; ?>
					</span>
					<?php } ?>
					<?php if (@$params['skin']["docs"] && $params['skin']["docs"]){ ?>
						<br/>
						<a href="#default.view.page.index.dir.docs?network=<?php echo $params["name"]; ?>" class="tooltips lbh" id="btn-documentation"	data-toggle="tooltip" data-placement="bottom" title="Lire la documentation" alt="Lire la documentation" style="color:lightblue;"> 
							<i class="fa fa-info-circle"></i> En savoir plus
						</a>
					<?php } ?>
					<?php if (@$params['skin']["displayCommunexion"] && $params['skin']["displayCommunexion"]){ ?>
					<br/>
					<div class="centerButton">
						<?php if (!@Yii::app()->session["userId"]){ ?>
						<button class="btn-top btn btn-default hidden-xs" onclick="showPanel('box-register');">
				        	<i class="fa fa-plus-circle"></i> 
							<span class="hidden-sm hidden-md hidden-xs">S'inscrire</span>
						</button>
						<button class="btn-top btn btn-success hidden-xs" style="margin-right:10px;" onclick="showPanel('box-login');">
							<i class="fa fa-sign-in"></i> 
							<span class="hidden-sm hidden-md hidden-xs">Se connecter</span>
						</button>
						<?php } else { ?>
							<a class="btn-top btn bg-red hidden-xs" href="/pixelhumain/ph/communecter/person/logout" style="margin-right:10px;" onclick="">
							<i class="fa fa-sign-out"></i> 
							<span class="hidden-sm hidden-md hidden-xs">Déconnexion</span>
						</a>

						<?php } ?>
					</div>
			      <?php } ?>
				</div>
			<?php } ?>
		</div> 
		<div class="showHideMoreTitleMap"><i class="fa fa-angle-down"></i></div> 
    </div>
	<!--<h1 class="homestead text-dark no-padding pull-left" id="main-title" style="font-size:18px;margin-bottom: 0px; display: inline-block;margin-top:15px;margin-left:10px;">
			<?php echo $params['skin']["title"] ?>
	</h1>-->
    <?php } ?>
    <button class="btn-menu btn-menu-top bg-white text-azure tooltips pull-right" id="btn-toogle-map"
      data-toggle="tooltip" data-placement="bottom" title="Carte" alt="Carte">
      <i class="fa fa-map-marker"></i>
	</button>
    <div id="menuTopList">
	    <div class="pull-left" style="display:inline-block;">
		  <?php if(@$params['skin']["title"]) { ?>
		  		<!-- <h1><?php echo $params['skin']["title"] ?></h1> -->
		  <?php } ?> 
		  <?php if(isset($params['skin']['breadcrumb']) && $params['skin']['breadcrumb']) { ?>
	      <!--<label class="menu-button btn-menu btn-default btn-menu-global-search tooltips text-dark" id="breadcum" style="cursor:pointer;">
	      
	        <i class="breadcum_search fa fa-search fa-2x" style="padding-top: 10px;padding-left: 20px;"></i>
	      </label>-->
	      <div id="breadcrum">
		  	<a href="#network.simplydirectory" onclick="breadcrumGuide(0)" class="breadcrumAnchor text-dark" style="font-size:20px !important;">Liste</a>
	      </div>
		  <?php } ?>
	      <div class="dropdown pull-right hidden-xs">
	        <?php if(isset($params['skin']['displayButtonGridList']) && $params['skin']['displayButtonGridList']) { ?>
	           <button id="grid" class="dropdown-toggle menu-name-profil text-dark" style="display:none">
	             <i class="fa fa-th-large fa-2x"></i>
	          </button>
	           <button id="list" class="dropdown-toggle menu-name-profil text-dark">
	             <i class="fa fa-align-justify fa-2x"></i>
	          </button>
	        <?php } ?>
	      </div>
	    </div>
	    <div class="menu-info-profil">
			<div class="topMenuButtons pull-right">
			<?php if(isset($params["skin"]['displayCommunexion']) && $params["skin"]['displayCommunexion']){ ?>
				<?php if( isset( Yii::app()->session['userId']) ){ ?>
				<div class="dropdown pull-right hidden-xs">
					<button class="dropdown-toggle menu-name-profil text-dark" data-toggle="dropdown" onclick="javascript:openMenuSmall();">
						<img class="img-circle" id="menu-thumb-profil" width="34" height="34" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
					</button>
				</div>          
				<?php }
				else{ ?>
				<button class="btn-top btn btn-success  hidden-xs" onclick="showPanel('box-register');"><i class="fa fa-plus-circle"></i> <span class="hidden-sm hidden-md hidden-xs">S'inscrire</span></button>
				<button class="btn-top btn bg-red  hidden-xs" style="margin-right:15px;" onclick="showPanel('box-login');"><i class="fa fa-sign-in"></i> <span class="hidden-sm hidden-md hidden-xs">Se connecter</span></button> 
				<?php } ?>
			<?php } ?>
			<?php if(isset($params["skin"]['displayNotifications']) && $params["skin"]['displayNotifications'] && @Yii::app()->session['userId']){ ?>
				<button class="menu-button btn-menu btn-menu-notif tooltips text-dark hidden-xs" 
		                data-toggle="tooltip" data-placement="left" title="Notifications" alt="Notifications">
		            <i class="fa fa-bell"></i>
		            <span class="notifications-count topbar-badge badge badge-danger animated bounceIn"><?php count($this->notifications); ?></span>
		        </button>
			<?php } ?>
    		</div>
  		</div>
    </div>
    <div class="pull-left">
      <div class="dropdown pull-right hidden-xs">
         <?php if(isset($params['skin']['iconeSearchPlus']) && $params['skin']['iconeSearchPlus']) { ?>
           <button id="dropdown_paramsBtn hide" class="menu-name-profil text-dark">
              <i class="fa fa-search-plus fa-2x"></i>
            </button>
           <?php } ?>
           <?php if(isset($params['skin']['iconeAdd']) && $params['skin']['iconeAdd']) { ?>
<!--             <div class="pull-left">
              <div class="dropdown pull-right hidden-xs"> -->
                <button class="dropdown-toggle menu-name-profil btn-menu-global-search text-dark" data-toggle="dropdown">
                   <i class="fa fa-plus fa-2x"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                  <?php if(isset($params['add']['organization']) && $params['add']['organization']) { ?>
                 <li>
                  <a onclick="loadByHash('#organization.addorganizationform');">
                    <i class="fa fa-group fa-2x text-green"></i>
                    <span class="add-title">une organisation</span>
                  </a>
                </li>
                <?php } ?>
                <?php if(isset($params['add']['project']) && $params['add']['project']) { ?>
                <li>
                  <a onclick="loadByHash('#project.projectsv');">
                    <i class="fa fa-lightbulb-o fa-2x text-purple"></i>
                    <span class="add-title">un projet</span>
                  </a>
                </li>
                <?php } ?>
                <?php if(isset($params['add']['event']) && $params['add']['event']) { ?>
                <li>
                  <a onclick="loadByHash('#event.eventsv');">
                    <i class="fa fa-calendar fa-2x text-orange"></i>
                    <span class="add-title">un événement</span>
                  </a>
                </li>
                <?php } ?>
                </ul>
              <!-- </div> -->
            <?php } ?>
      </div>
    </div>
   
      <!--<div class="dropdown pull-left hidden-xs">
       <form class="Filters filter-group search" role="recherche">-->
          <!-- <div class="form-group" style="display:inline;"> -->
            <!-- <div class="input-group filter-group search" style="display:table;"> -->
              <!-- <span class="input-group-addon" style="width:1% ;background-color:#999"></span> -->
              <!-- <input id="searchBarText" type="text" placeholder="Que recherchez-vous ?" class="form-control"> -->
            <!-- </div> -->
          <!-- </div> -->
      <!--</form>
    </div>-->
    
    <div class="dropdown pull-left hidden-xs">
      <!-- <button id="btn-start-search" class="menu-button btn-menu btn-default btn-menu-global-search tooltips text-dark" 
          data-toggle="tooltip" data-placement="left" title="Rechercher quelque chose" alt="Rechercher quelque chose">
       <i class="fa fa-search fa-2x"></i>
      </button> -->
    </div>

    
  </div>

 </div>

<script>
  var timeoutGS = setTimeout(function(){ }, 100);
  var timeoutDropdownGS = setTimeout(function(){ }, 100);
  jQuery(document).ready(function() {
    $('#btn-start-search').click(function(e){
      console.log("#btn-start-search");
      if(window.location.hash == "#default.simplyDirectory") {
        // Fragment exists
        loadingData = false;
        startSearch(0, 100);
      } else {
        // Fragment doesn't exist
        loadByHash("#default.simplydirectory");
        startSearch(0, 100);
      }
       
    });


    // $('#dropdownMenuinMenu').dropdown();
    // $('#dropdownMenumain').dropdown();
    $('.dropdown-toggle').dropdown();
    $(".menu-name-profil").click(function(){
      showNotif(false);
    });

    $('.input-global-search').keyup(function(e){
        clearTimeout(timeoutGS);
        timeoutGS = setTimeout(function(){ startGlobalSearch(0, indexStepGS); }, 800);
    });

    $('.input-global-search').click(function(e){
        if($(".dropdown-result-global-search").html() != ""){
          showDropDownGS(true);
        }

    });

    $('.dropdown-result-global-search').mouseenter(function(e){
        clearTimeout(timeoutDropdownGS);
    });
    $('.main-col-search, .mapCanvas, .main-menu-top').mouseenter(function(e){
        clearTimeout(timeoutDropdownGS);
        timeoutDropdownGS = setTimeout(function(){ 
            showDropDownGS(false);
        }, 300);
    });

    $('.moduleLabel').click(function(e){
        clearTimeout(timeoutDropdownGS);
        timeoutDropdownGS = setTimeout(function(){ 
            showDropDownGS(false);
        }, 300);
    });

    showDropDownGS(false);
  });

/* GLOBAL SEARCH JS */
function showDropDownGS(show){
  if(typeof show == "undefined") show = true;

  if(show){
    if($(".dropdown-result-global-search").css("display") == "none"){
      $(".dropdown-result-global-search").css("maxHeight", "0px");
      $(".dropdown-result-global-search").show();
      $(".dropdown-result-global-search").animate({"maxHeight" : "80%"}, 300);
    }
  }else{
    if(!loadingDataGS){
      $(".dropdown-result-global-search").animate({"maxHeight" : "0%"}, 300);
      $(".dropdown-result-global-search").hide(300);
    }
  }
}

var searchTypeGS = [ "persons", "organizations", "projects", "events", "cities" ];
var allSearchTypeGS = [ "persons", "organizations", "projects", "events" ];

var loadingDataGS = false;
var indexStepGS = 50;
var currentIndexMinGS = 0;
var currentIndexMaxGS = indexStepGS;
var scrollEndGS = false;
var totalDataGS = 0;
var mapElementsGS = new Array(); 

function startGlobalSearch(indexMin, indexMax){
    console.log("startGlobalSearch", indexMin, indexMax, indexStepGS, loadingDataGS);

    if(loadingDataGS) return;

    setTimeout(function(){ loadingDataGS = false; }, 10000);

    console.log("loadingDataGS true");
    loadingDataGS = true;
    
    var search = $('.input-global-search').val();
    if(search == "") search = $('#input-global-search-xs').val();
      
    if(typeof indexMin == "undefined") indexMin = 0;
    if(typeof indexMax == "undefined") indexMax = indexStepGS;

    currentIndexMinGS = indexMin;
    currentIndexMaxGS = indexMax;

    if(indexMin == 0) {
      totalDataGS = 0;
      mapElementsGS = new Array(); 
    }
    else{ console.log("scrollEndGS ? ", scrollEndGS); if(scrollEndGS) return; }
    
    if(search.length>=3){
      autoCompleteSearchGS(search, indexMin, indexMax);
    }else{
      var str = '<div class="center" id="footerDropdownGS">';
      str += "<hr style='float:left; width:100%;'/><label style='margin-bottom:10px; margin-left:15px;' class='text-dark'>Aucun résultat</label><br/>";
      str += "</div>";
      $(".dropdown-result-global-search").html(str);
      loadingDataGS = false;
      scrollEndGS = false;
    }   
}


function autoCompleteSearchGS(search, indexMin, indexMax){
    console.log("autoCompleteSearchGS");

    var data = {"name" : search, "locality" : "", "searchType" : searchTypeGS, "searchBy" : "ALL",
                "indexMin" : indexMin, "indexMax" : indexMax  };


    //str = "<i class='fa fa-circle-o-notch fa-spin'></i>";
    //$(".btn-start-search").html(str);
    //$(".btn-start-search").addClass("bg-azure");
    //$(".btn-start-search").removeClass("bg-dark");
    showDropDownGS(true);

    if(indexMin > 0)
    $("#btnShowMoreResultGS").html("<i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...");
    else
    $(".dropdown-result-global-search").html("<h3 class='text-dark center'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...</h3>");
      

    $.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
          data: data,
          dataType: "json",
          error: function (data){
             console.log("error"); console.dir(data);          
          },
          success: function(data){
            if(!data){ toastr.error(data.content); }
            else
            {
              console.log("DATA GS");
              console.dir(data);

              var countData = 0;
              $.each(data, function(i, v) { if(v.length!=0){ countData++; } });
              
              totalDataGS += countData;
            
              str = "";
              var city, postalCode = "";
              
              //parcours la liste des résultats de la recherche
              $.each(data, function(i, o) {
                  var typeIco = i;
                  var ico = mapIconTop["default"];
                  var color = mapColorIconTop["default"];

                  mapElementsGS.push(o);

                  typeIco = o.type;
                  ico = ("undefined" != typeof mapIconTop[typeIco]) ? mapIconTop[typeIco] : mapIconTop["default"];
                  color = ("undefined" != typeof mapColorIconTop[typeIco]) ? mapColorIconTop[typeIco] : mapColorIconTop["default"];
                  
                  htmlIco ="<i class='fa "+ ico +" fa-2x bg-"+color+"'></i>";
                  if("undefined" != typeof o.profilThumbImageUrl && o.profilThumbImageUrl != ""){
                    var htmlIco= "<img width='80' height='80' alt='' class='img-circle bg-"+color+"' src='"+baseUrl+o.profilThumbImageUrl+"'/>"
                  }

                  city="";

                  var postalCode = o.cp
                  if (o.address != null) {
                    city = o.address.addressLocality;
                    postalCode = o.cp ? o.cp : o.address.postalCode ? o.address.postalCode : "";
                  }
                  
                  var id = getObjectId(o);
                  var insee = o.insee ? o.insee : "";
                  type = o.type;
                  if(type=="citoyen") type = "person";
                  var url = "javascript:"; //baseUrl+'/'+moduleId+ "/default/simple#" + o.type + ".detail.id." + id;
                  var onclick = 'loadByHash("#' + type + '.detail.id.' + id + '");';
                  var onclickCp = "";
                  var target = " target='_blank'";
                  var dataId = "";
                  if(type == "city"){
                    url = "javascript:"; //#main-col-search";
                    onclick = 'loadByHash("#city.detail.insee.' + insee + '");'; //"'+o.name.replace("'", "\'")+'");';
                    onclickCp = 'loadByHash("#city.detail.insee.' + insee + '");';
                    target = "";
                    dataId = o.name; //.replace("'", "\'");
                  }

                  var tags = "";
                  if(typeof o.tags != "undefined" && o.tags != null){
                    $.each(o.tags, function(key, value){
                      if(value != "")
                      tags +=   "<a href='javascript:' class='badge bg-red btn-tag'>#" + value + "</a>";
                    });
                  }

                  var name = typeof o.name != "undefined" ? o.name : "";
                  var postalCode = (typeof o.address != "undefined" &&
                            typeof o.address.postalCode != "undefined") ? o.address.postalCode : "";
                  
                  if(postalCode == "") postalCode = typeof o.cp != "undefined" ? o.cp : "";
                  var cityName = (typeof o.address != "undefined" &&
                          typeof o.address.addressLocality != "undefined") ? o.address.addressLocality : "";
                  
                  var fullLocality = postalCode + " " + cityName;

                  var description = (typeof o.shortDescription != "undefined" &&
                            o.shortDescription != null) ? o.shortDescription : "";
                  if(description == "") description = (typeof o.description != "undefined" &&
                                     o.description != null) ? o.description : "";
           
                  var startDate = (typeof o.startDate != "undefined") ? "Du "+dateToStr(o.startDate, "fr", true, true) : null;
                  var endDate   = (typeof o.endDate   != "undefined") ? "Au "+dateToStr(o.endDate, "fr", true, true)   : null;

                  //template principal
                  //str += "<div class='col-md-12 searchEntity'>";
                    /*str += "<div class='col-md-5 entityLeft'>";
                      
                      <?php if( isset( Yii::app()->session['userId']) ) { ?>
                      if(type!="city")
                      str += "<a href='javascript:' class='followBtn btn btn-sm btn-add-to-directory bg-white tooltips'" + 
                            'data-toggle="tooltip" data-placement="left" title="Ajouter dans votre répertoire"'+
                            " data-ownerlink='knows' data-id='"+id+"' data-type='"+type+"' data-name='"+name+"'>"+
                                "<i class='fa fa-chain'></i>"+ //fa-bookmark fa-rotate-270
                              "</a>";
                      <?php } ?>
                      str += tags;
              
                    str += "</div>";*/

                    target = "";

                    str += "<div class='col-md-12 col-sm-12 col-xs-12 no-padding searchEntity'>";
                    str += "<div class='col-md-2 col-sm-2 col-xs-2 no-padding entityCenter'>";
                    str +=   "<a href='"+url+"' onclick='"+onclick+"'>" + htmlIco + "</a>";
                    str += "</div>";
                    str += "<div class='col-md-10 col-sm-10 col-xs-10 entityRight'>";
                    //str += "</div>";
                    //str +=  "<div class='col-md-5 entityRight no-padding'>";
                      str += "<a href='"+url+"' onclick='"+onclick+"'"+target+" class='entityName text-dark'>" + name + "</a>";
                      if(fullLocality != "" && fullLocality != " ")
                      str += "<a href='"+url+"' onclick='"+onclickCp+"'"+target+ ' data-id="' + dataId + '"' + "  class='entityLocality'><i class='fa fa-home'></i> " + fullLocality + "</a>";
                      //if(startDate != null)
                      //str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + startDate + "</a>";
                      //if(endDate != null)
                      //str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + endDate + "</a>";
                      //if(description != "")
                      //str += "<div onclick='"+onclick+"'"+target+"  class='entityDescription'>" + description + "</div>";
                    str += "</div>";
                    str += "</div>";
                              
                  //str += "</div>";
              }); //end each

              if(str == "") { 
                  if(indexMin == 0){
                    //ajout du footer       
                    str += '<div class="center" id="footerDropdownGS">';
                    str += "<hr style='float:left; width:100%;'/><label style='margin-bottom:10px; margin-left:15px;' class='text-dark'>Aucun résultat</label><br/>";
                    str += "</div>";
                    $(".dropdown-result-global-search").html(str);
                  }
              }
              else
              {       
                //ajout du footer   
                if(!scrollEndGS){    
                  //var nbRes = '<div class="center" id="footerDropdownGS">';
                  //nbRes    += "</div>";
                  
                  //str = nbRes + str;
                  str += '<div class="center" id="footerDropdownGS">';
                  str += "<hr style='margin-top: 5px; margin-top: 10px; float:left; width:100%;'/><label style='margin-top:0px; margin-bottom:5px;' class='text-dark'>" + totalDataGS + " résultats</label><br/>";
                  str += '<button class="btn btn-default" id="btnShowMoreResultGS"><i class="fa fa-angle-down"></i> Afficher plus de résultat</div></center>';
                  str += '</div>';
                }
                //si on n'est pas sur une première recherche (chargement de la suite des résultat)
                if(indexMin > 0){
                  //on supprime l'ancien bouton "afficher plus de résultat"
                  $("#btnShowMoreResultGS").remove();
                  //on supprimer le footer (avec nb résultats)
                  $("#footerDropdownGS").remove();

                  //on calcul la valeur du nouveau scrollTop
                  var heightContainer = $(".dropdown-result-global-search")[0].scrollHeight - 140;
                  //on affiche le résultat à l'écran
                  $(".dropdown-result-global-search").append(str);
                  //on scroll pour afficher le premier résultat de la dernière recherche
                  $(".dropdown-result-global-search").animate({"scrollTop" : heightContainer}, 1000);
                  
                  
                //si on est sur une première recherche
                }else{
                  //on ajoute le texte dans le html
                  $(".dropdown-result-global-search").html(str);
                  //on scroll pour coller le haut de l'arbre au menuTop
                  $(".dropdown-result-global-search").scrollTop(0);
                  //on affiche la dropdown
                  showDropDownGS(true);
                }
                //remet l'icon "loupe" du bouton search
                //$(".btn-start-search").html("<i class='fa fa-search'></i>");
                //affiche la dropdown
                //$(".dropdown-result-global-search").css({"display" : "inline" });

                //active le chargement de la suite des résultat au survol du bouton "afficher plus de résultats"
                //(au cas où le scroll n'ait pas lancé le chargement comme prévu)
                $("#btnShowMoreResultGS").click(function(){
                  if(!loadingDataGS){
                    startGlobalSearch(indexMin+indexStepGS, indexMax+indexStepGS);
                  }
                });
                
                //initialise les boutons pour garder une entité dans Mon répertoire (boutons links)
                //initBtnLinkGS();

              } //end else (str=="")

              //signal que le chargement est terminé
              console.log("loadingDataGS false");
              loadingDataGS = false;

              //quand la recherche est terminé, on remet la couleur normal du bouton search
              //$(".btn-start-search").removeClass("bg-azure");
            }

            //console.log("scrollEndGS ? ", scrollEnd, indexMax, countData , indexMin);
            //si le nombre de résultat obtenu est inférieur au indexStep => tous les éléments ont été chargé et affiché
            if(indexMax - countData > indexMin){
              $("#btnShowMoreResultGS").remove(); 
              scrollEndGS = true;
            }else{
              scrollEndGS = false;
            }

            if(isMapEnd){
              //affiche les éléments sur la carte
              showDropDownGS(false);
              Sig.showMapElements(Sig.map, mapElementsGS);
            }
          }
    });

                    
  }




  </script>

