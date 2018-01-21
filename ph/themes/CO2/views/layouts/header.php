<style>
    .pastille-subdomain {
        font-size: 20px;
        float: left;
        margin-left: 55.3%;
        margin-top: -41px;
    }
    .pastille-subdomain-icon {
        font-size: 24px;
        float: right;
        margin-right: 57%;
        margin-top: -73px;
    }
    
    .filters-type-container{
        background-color: white;
    }
    .filters-type-container #sub-menu-filliaire, .filters-type-container #container-scope-filter{
        display:none;
    }
    #container-scope-filter .dropdown-result-global-search{
        position: absolute;
        max-height: 300px !important;
        z-index: 100;
        background-color: white;
        width: 100%;
        float: left;
        overflow-y: auto;
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
    }
    #sub-menu-filliaire {
    /* background-image: url(../../img/background-onepage/pattern/white_brick_wall.png); */
    margin-bottom: 0px; 
     border-bottom: none;
     padding: 0px; 
    /* padding-top: 0px; */
    }
    #communexion-container, #multiscope-container, #opensearch-scope-container{
        display:none;
    }
    .btn-scope-menu{
        height: 40px;
        font-size: 15px;
        border: 1px solid rgba(0,0,0,.1);
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 0px 1px rgba(0,0,0,.1);
        line-height: 40px;
    }
    .btn-scope-menu.active{
        color:white;
        background-color: #ea4335;
    }
    #open-scope-container #searchOnCity{
        height: 30px;
        border-radius: 0px !important;
        border: none;
    }
    #open-scope-container .shadow-input-header{
         -webkit-box-shadow: 0px 0px 4px -1px rgba(0,0,0,0.5);
        -moz-box-shadow: 0px 0px 4px -1px rgba(0,0,0,0.5);
        box-shadow: 0px 0px 4px -1px rgba(0,0,0,0.5);
       
    }
    .btn-menu-to-app{
        color: #2C3E50 !important;
        font-size: 16px;
        padding: 6px 5px 5px 5px;
        border-radius: 0px;
    }
    .btn-menu-to-app.active, .btn-menu-to-app:hover{
        border-bottom: 2px solid #e43636;
        color: #ea4335!important;
    }
    #filters-menu-new{
        margin-left: 5%;
    }
    #filters-menu-new #input-sec-search{
        display:inline-block;
        display:-webkit-inline-box;
    }
    #filters-menu-new #input-sec-search .input-group-addon{
        background-color: #eee !important;
        border: none;
    }
    #filters-menu-new .dropdown-result-global-search{
        position: absolute;
        max-height: 250px !important;
        top: 35px;
        z-index: 100;
        background-color: white;
        width: 100%;
        float: left;
        overflow-y: auto;
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
        left: 0px;
    }
   #open-breacrum-container{
    text-align: left;
    line-height: 30px;
   }
</style>

    <?php 
        $params = CO2::getThemeParams();
        
        if(@$type=="cities")    { 
            $lblCreate = "";
            $params["pages"]["#".$page]["mainTitle"] = "Rechercher une commune"; 
            $params["pages"]["#".$page]["placeholderMainSearch"] = "Rechercher une commune"; 
        }

        $useHeader              = $params["pages"]["#".$page]["useHeader"];
        $subdomain              = $params["pages"]["#".$page]["subdomain"];
        $subdomainName          = $params["pages"]["#".$page]["subdomainName"];
        $icon                   = $params["pages"]["#".$page]["icon"];
        $mainTitle              = $params["pages"]["#".$page]["mainTitle"];
        $placeholderMainSearch  = $params["pages"]["#".$page]["placeholderMainSearch"];
        $CO2DomainName = Yii::app()->params["CO2DomainName"];
        $me = isset(Yii::app()->session['userId']) ? Person::getById(Yii::app()->session['userId']) : null;
            $this->renderPartial($layoutPath.'menus/'.$CO2DomainName, 
                                                    array( "layoutPath"=>$layoutPath , 
                                                            "subdomain"=>$subdomain,
                                                            "subdomainName"=>$subdomainName,
                                                            "mainTitle"=>$mainTitle,
                                                            "placeholderMainSearch"=>$placeholderMainSearch,
                                                            "type"=>@$type,
                                                            "me" => $me) );
        $cities = [];//CO2::getCitiesNewCaledonia();
                        $this->renderPartial($layoutPath.'scopes/'.$CO2DomainName.'/multi_scope', 
                                array(  "cities"=>$cities, "me"=>$me));
    ?>

    <!-- Header -->

    <header>
        <?php if(@$useHeader != false){ ?>
            <!--<div class="col-md-12 text-center main-menu-app" style="">-->
                <?php 
                    /*$this->renderPartial( $layoutPath.'menus.moduleMenu',array( "params" => $params , 
                                                                                "subdomain"  => $subdomain));*/
                ?>
            <!--</div>-->
            <div class="">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="intro-text">  

                            <?php $this->renderPartial($layoutPath.'headers/'.Yii::app()->params["CO2DomainName"], 
                                                        array("mainTitle"=>$mainTitle,
                                                              "icon"=>$icon,
                                                              "subdomainName"=>$subdomainName,
                                                              "subdomain"=>$subdomain,
                                                              "type"=>@$type,
                                                              "explain"=>@$explain)); ?>

                            <div class="subModuleTitle">  
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <div class="input-group" id="main-input-group"  style="width:80%;float: left;margin-left: 5%;">
                                <input type="text" class="form-control" id="main-search-bar" 
                                    placeholder="Search by name or by #tag, ex: 'commun' or '#commun'">
                                <span class="bg-white input-group-addon" id="main-search-bar-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
        <div id="filters-container" class="no-padding">
        <ul class="filters-menu">
            <li class="scope-header-filter tooltips" data-placement="bottom" data-original-title="Geographic filter">
             <i class="fa fa-globe"></i> 
             <span class="scope-filters-badge topbar-badge animated bounceIn hide badge-tranparent"></span>
                <!--<span class="hidden-xs"><?php echo Yii::t("common","Geographical") ?></span>-->
            </li>
            <li class="btn-open-filliaire tooltips" data-placement="bottom" data-original-title="Themes filter">
             <i class="fa fa-th"></i> 
                <!--<span class="hidden-xs"><?php echo Yii::t("common","Themes") ?></span>-->
            </li>
            
        </ul> 
        </div>
    </div>
        <div id="affix-sub-menu">
            <div id="filters-menu-new" class="col-md-12 col-sm-12 col-xs-12 margin-top-5">
                <div id="open-scope-container" class="container-scope-menu no-padding">
                    <div id="input-sec-search" class="hidden-xs col-xs-12 col-md-4 col-sm-4 col-lg-4">
                        <div class="input-group shadow-input-header">
                              <span class="input-group-addon"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i></span>
                              <input type="text" class="form-control input-global-search" id="searchOnCity" placeholder="<?php echo Yii::t("common","Search a city") ?> ...">
                        </div>
                        <div class="dropdown-result-global-search col-xs-12 col-sm-5 col-md-5 col-lg-5 no-padding" style="max-height: 70%; display: none;"><div class="text-center" id="footerDropdownGS"><label class="text-dark"><i class="fa fa-ban"></i> Aucun résultat</label><br></div></div>
                        </div>
                    <div id="open-breacrum-container" class="col-md-8 col-sm-8 col-xs-12">
                        <?php echo Yii::t("common", "Search a city to find all zones corresponding and add to favorites") ?>
                    <?php //$this->renderPartial($layoutPath.'breadcrum_communexion', array("type"=>@$type)); ?>
                    </div>
                </div>
            </div>
            <div id="filters-menu" class="filters-type-container col-md-12 col-sm-12 col-xs-12 no-padding margin-top-5">
                <?php if(@Yii::app()->session["userId"]) $containerClass="col-md-9 col-sm-9 col-xs-12";  else $containerClass="col-md-10 col-sm-10 col-xs-12"; ?>
               <!-- <div id="container-scope-filter"  class="col-md-12 col-sm-12 col-xs-12 no-padding">
                    <a href="javascript:;" class="activate-open-scope btn-scope-menu tooltips col-md-1 col-sm-1 col-xs-1"
                        data-toggle="tooltip" data-placement="bottom" title="Searching on all cities" onclick="activateScopeMenu('open-scope');">
                        <i class="fa fa-search"></i>
                    </a>
                     <div id="open-scope-container" class="container-scope-menu  <?php echo $containerClass ?> no-padding">
                        <div id="input-sec-search" class="hidden-xs col-xs-12 col-md-4 col-lg-4">
                            <input type="text" class="form-control input-global-search" id="searchOnCity" placeholder="Go to city ?">
                            <div class="dropdown-result-global-search col-xs-12 col-sm-5 col-md-5 col-lg-5 no-padding" style="max-height: 70%; display: none;"><div class="text-center" id="footerDropdownGS"><label class="text-dark"><i class="fa fa-ban"></i> Aucun résultat</label><br></div></div>
                            </div>
                        <div id="open-breacrum-container" class="col-md-8 col-sm-8 col-xs-12">
                        <?php //$this->renderPartial($layoutPath.'breadcrum_communexion', array("type"=>@$type)); ?>
                        </div>
                    </div>
                   
                    <?php if(@Yii::app()->session["userId"]){ ?>
                    <a href="javascript:;" class="activate-communexion btn-scope-menu tooltips col-md-1 col-sm-1 col-xs-1"
                        data-toggle="tooltip" data-placement="top" title="" onclick="activateScopeMenu('communexion');">
                        <i class="fa fa-university"></i>
                    </a>
                    <div id="communexion-container" class="container-scope-menu col-md-9 col-sm-9 col-xs-9">
                        <?php //$this->renderPartial($layoutPath.'breadcrum_communexion', array("type"=>@$type)); ?>
                    </div>
                    
                    <?php } ?>
                    <a href="javascript:;" class="activate-multiscope btn-scope-menu tooltips col-md-1 col-sm-1 col-xs-1"
                        data-toggle="tooltip" data-placement="top" title="My multiscope" onclick="activateScopeMenu('multiscope');">
                        <i class="fa fa-map-signs"></i>
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/cible3.png" height=25>
                    </a>
                    
                    <div id="multiscope-container" class="container-scope-menu <?php echo $containerClass ?>"></div>
                </div>-->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center subsub" id="sub-menu-filliaire">
                    <?php $filliaireCategories = CO2::getContextList("filliaireCategories"); 
                    foreach ($filliaireCategories as $key => $cat) { 
                        if(is_array($cat)) { ?>
                          <div class="col-md-2 col-sm-3 col-sm-6 no-padding">
                            <button class="btn btn-default col-md-12 col-sm-12 padding-10 bold text-dark elipsis margin-bottom-5 btn-select-filliaire" 
                                    data-fkey="<?php echo $key; ?>"
                                    style="border-radius:0px; border-color: transparent; text-transform: uppercase;" 
                                    data-keycat="<?php echo $cat["name"]; ?>">
                              <i class="fa <?php echo $cat["icon"]; ?> fa-2x hidden-xs"></i><br><?php echo $cat["name"]; ?>
                            </button>
                          </div>
                  <?php } 
              //          <!--</button>-->
                    } ?>
                </div>
        </div>
        <div id="territorial-menu" class="col-md-10 col-sm-10 col-xs-12 margin-bottom-10 no-padding">
            <a href="#territorial" class="territorial-menu-btn lbh btn-menu-to-app hidden-top pull-left
                                 tooltips" data-placement="bottom" data-original-title="Territorial engine">
                <i class="fa fa-search"></i>
                <span class="hidden-xs">All</span> 
            </a>
            <a href="#search" class="search-menu-btn lbh btn-menu-to-app pull-left hidden-top 
                                 tooltips" data-placement="bottom" data-original-title="Social connect">
                        <i class="fa fa-connectdevelop"></i>
                         <span class="hidden-xs">Social</span>
                         <span class="badge badge-warning count-badge-menu count-badge-social"></span> 
            </a>
            <a href="#live" class="live-menu-btn lbh btn-menu-to-app pull-left hidden-top 
                                 tooltips" data-placement="bottom" data-original-title="Live">
                        <i class="fa fa-newspaper-o"></i>
                         <span class="hidden-xs">Live</span>
                         <span class="badge badge-warning count-badge-menu count-badge-live"></span> 
                                        </a>
            <a href="#agenda" class="agenda-menu-btn lbh btn-menu-to-app pull-left hidden-top
                                 tooltips" data-placement="bottom" data-original-title="Agenda">
                        <i class="fa fa-calendar"></i>
                        <span class="hidden-xs">Agenda</span> 
                        <span class="badge badge-warning count-badge-menu count-badge-agenda"></span>
                                        </a>
            <!--<a href="#place" class="#agendaModBtn lbh btn btn-link letter-red btn-menu-to-app  pull-left hidden-top hidden-xs
                                 tooltips" data-placement="bottom" data-original-title="Agenda">
                        <i class="fa fa-bullhorn"></i>

                        <span class="">Lieux et intérêts</span>
                                        </a>-->
            <a href="#ressource" class="ressource-menu-btn lbh btn-top-menu btn-menu-to-app pull-left hidden-top
                                 tooltips" data-placement="bottom" data-original-title="Agenda">
                <i class="fa fa-cubes"></i>

                <span class="hidden-xs">Entraide</span>
                <span class="badge badge-warning count-badge-menu count-badge-ressources"></span>
            </a>
            <a href="#annonces" class="annonces-menu-btn lbh btn-top-menu btn-menu-to-app pull-left hidden-top
                         tooltips" data-placement="bottom" data-original-title="Agenda">
                <i class="fa fa-money"></i>
                <span class="hidden-xs">Market</span>
                <span class="badge badge-warning count-badge-menu count-badge-classifieds"></span>
            </a>
        </div>
    </div>
    
    
    
                      
        <?php } ?>

        <?php 
            $CO2DomainName = Yii::app()->params["CO2DomainName"];
            if($subdomain == "freedom"){ 
                $this->renderPartial($layoutPath.'headers/pod/'.$CO2DomainName.'/dayQuestion', array());
            } 
        ?>

    </header>
     
   
    <?php
            
             ?>   
<script type="text/javascript">
    var filliaireCategories = <?php echo json_encode(@$filliaireCategories); ?>;
    var page="<?php echo $page ?>";
    jQuery(document).ready(function() {
        searchInitApp(search);
        $("."+page+"-menu-btn").addClass("active");
        $(".btn-open-filliaire").click(function(){
            if($(".scope-header-filter").hasClass("active")){
                $("#container-scope-filter").hide(700);
                $(".scope-header-filter").removeClass("active");
                $("#sub-menu-filliaire").show(700);
            }
            if($("#filters-menu").is(":visible") && $(this).hasClass("active")){
                $("#filters-menu").hide(700);
                $(this).removeClass("active");
                $("#sub-menu-filliaire").hide(700);
            }else if(!$("#filters-menu").is(":visible") && !$(this).hasClass("active")){
                $("#filters-menu").show(700);
                $("#sub-menu-filliaire").show(700);
                $(this).addClass("active");
            }else if($("#filters-menu").is(":visible") && !$(this).hasClass("active")){
                $(this).addClass("active");
            }
            /*$("#filters-container ul li").removeClass("active");
            $(this).addClass("active");
            $("#container-scope-filter").hide(700);
            $("#sub-menu-filliaire").show(700);*/
            /*if($("#sub-menu-filliaire").hasClass("hidden"))
                $("#sub-menu-filliaire").removeClass("hidden");
            else{
                $("#sub-menu-filliaire").addClass("hidden");
                resetMyTags();
            }*/
        });
        $(".scope-header-filter").click(function(){
            if($(".btn-open-filliaire").hasClass("active")){
                $("#sub-menu-filliaire").hide(700);
                $(".btn-open-filliaire").removeClass("active");
                $("#container-scope-filter").show(700);
            }
            if($("#filters-menu").is(":visible") && $(this).hasClass("active")){
                $("#filters-menu").hide(700);
                $(this).removeClass("active");
                $("#container-scope-filter").hide(700);
            }else if(!$("#filters-menu").is(":visible") && !$(this).hasClass("active")){
                $("#filters-menu").show(700);
                $(this).addClass("active");
                $("#container-scope-filter").show(700);
            }else if($("#filters-menu").is(":visible") && !$(this).hasClass("active")){
                $(this).addClass("active");
            }
            //$("#filters-container ul li").removeClass("active");
            

        });
        $(".btn-select-filliaire").click(function(){
            mylog.log(".btn-select-filliaire");
            var fKey = $(this).data("fkey");
            myMultiTags = {};
            $.each(filliaireCategories[fKey]["tags"], function(key, tag){
                addTagToMultitag(tag);
            });
            mylog.log("myMultiTags", myMultiTags);
              
            startSearch(0, indexStepInit, searchCallback);
            //KScrollTo("#content-social");
            //bindCommunexionScopeEvents();
            //KScrollTo("#before-section-result");
            });

        //loadMultiScopes();
        mylog.log("communexionActivated ok", myScopes.communexion, myScopes.communexion.state);
        initScopeMenu();
        //if(communexion.value == null){
          //  communexion.state = false;
            //$.cookie("communexionActivated", false, { expires: 365, path : "/" });
        //}

        //if(communexion.state){
            //mylog.log("communexionActivated ok", communexion);
          //  activateGlobalCommunexion(true);
        //}else{
          //  activateGlobalCommunexion(false,true);
        //}
        $(".tooltips").tooltip();
    });
    function searchInitApp(src){
        search.app=page;
        if(search.value != "")
            $("#main-search-bar, #second-search-bar").val(search.value);
       //console.log("iciiiiii src",src);
    }
    function initScopeMenu(type){
        if(typeof myScopes.type != "undefined")
            activateScope=myScopes.type;
        else
            activateScope="open";
        myScopes.type="open";
        activateScopeMenu(activateScope,true);
        bindSearchCity();
        headerActive=true;
        /*if(myScopes.type=="multiscope")
            headerActive=false;*/
            bindScopesInputEvent();
        //activateGlobalCommunexion(headerActive, true);
        //bindCommunexionScopeEvents();
        /*if(userId!="")
            $("#communexion-container").html(getBreadcrumCommunexion(myScopes.communexion));
        if(typeof myScopes.open.currentValues != "undefined")
            $("#open-scope-container").html(getBreadcrumCommunexion(myScopes.open));*/
        //showTagsScopesMin();
        //bindScopeMenu();
    }
    function activateScopeMenu(type,init){
        $(".container-scope-menu").hide(700);
        $(".btn-scope-menu").removeClass("active");
        $("#"+type+"-container").show(700);
        $(".activate-"+type).addClass("active");
        myScopes.type=type;
        if(init==null){
            myScopes.state=true;
            //if(type!="open-scope"){
            localStorage.setItem("myScopes",JSON.stringify(myScopes));
            //}
        }else if(type=="open-scope")
            myScopes.state=false;
        if(myScopes.state){
            $('.scope-filters-badge').removeClass('hide');
            $('.scope-filters-badge').addClass('animated bounceIn');
            $('.scope-filters-badge').addClass('badge-success');
            $('.scope-filters-badge').removeClass('badge-tranparent');
        }

    }
   // function activeOpen(){
     //   $("")
    //}
</script>
    
    <?php   //if($subdomain != "referencement"){
                         
            //}
    ?>