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
    #filters-container ul{
        list-style: none;
        margin-bottom: 0px
    }

    #filters-container ul li{
        display: inline-block;
        float: left;
        padding: 5px 15px;
    }
    #filters-container ul li.active{
        background-color: white;
    }
    #filters-container .filters-type-container{
        background-color: white;
    }
    #filters-container #sub-menu-filliaire, #filters-container #container-scope-filter{
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
        box-shadow: azure;
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
        $cities = CO2::getCitiesNewCaledonia();
                        $this->renderPartial($layoutPath.'scopes/'.$CO2DomainName.'/multi_scope', 
                                array(  "cities"=>$cities, "me"=>$me));
    ?>

    <!-- Header -->

    <header>
        <?php if(@$useHeader != false){ ?>
            <!--<div class="col-md-12 text-center main-menu-app" style="">
                <?php 
                    $this->renderPartial( $layoutPath.'menus.moduleMenu',array( "params" => $params , 
                                                                                "subdomain"  => $subdomain));
                ?>
            </div>-->
            
            <div class="">
                <div class="row">
                    <div class="col-lg-12">
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
        <div class="input-group col-md-10 col-md-10 col-md-offset-1 col-md-offset-1 col-xs-10" id="main-input-group"  style="width:80%;">
                        
            <input type="text" class="form-control" id="main-search-bar" 
                            placeholder="search by name or by #tag, ex: 'commun' or '#commun'">
        <span class="bg-white input-group-addon" id="main-search-bar-addon">
            <i class="fa fa-search"></i>
        </span>
        </div>
    </div>
    <div id="filters-container" class="col-md-12 col-sm-12 col-xs-12 no-padding margin-top-10">
        <ul class="filters-menu col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1 col-xs-12">
            <li class="scope-header-filter">
             <i class="fa fa-globe"></i> 
                <span class="hidden-xs"><?php echo Yii::t("common","Geographical") ?></span>
            </li>
            <li class="btn-open-filliaire">
             <i class="fa fa-th"></i> 
                <span class="hidden-xs"><?php echo Yii::t("common","Themes") ?></span>
            </li>
            
        </ul> 
        <div class="filters-type-container col-md-12 col-sm-12 col-xs-12 padding-10">
            <div id="container-scope-filter"  class="col-md-12 col-sm-12 col-xs-12">
                <div id="input-sec-search" class="hidden-xs col-sm-4 col-md-4 col-lg-6">
                    <a href="javascript:;" class="activateOpenScope btn-scope-menu tooltips col-md-1 col-sm-1 col-xs-4"
                        data-toggle="tooltip" data-placement="bottom" title="Searching on all cities">
                        <i class="fa fa-search"></i>
                    </a>
                    <div id="opensearch-scope-container" class="col-md-10 col-sm-10 col-xs-10">
                        <input type="text" class="form-control input-global-search" id="searchOnCity" placeholder="Go to city ?">
                        <div class="dropdown-result-global-search hidden-xs col-sm-6 col-md-5 col-lg-5 no-padding" style="max-height: 70%; display: none;"><div class="text-center" id="footerDropdownGS"><label class="text-dark"><i class="fa fa-ban"></i> Aucun résultat</label><br></div></div>
                        </div>
                    </div>
                    <a href="javascript:;" class="activateCommunexion btn-scope-menu tooltips col-md-1 col-sm-1 col-xs-4"
                        data-toggle="tooltip" data-placement="top" title="">
                        <i class="fa fa-university"></i>
                    </a>
                    <div id="breacrum-container" class="col-md-10 col-sm-10 col-xs-10">
                        <?php //$this->renderPartial($layoutPath.'breadcrum_communexion', array("type"=>@$type)); ?>
                    </div>
                    <a href="javascript:;" class="actiavteMultiscope btn-scope-menu tooltips col-md-1 col-sm-1 col-xs-4">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/cible3.png" height=25>
                    </a>
                    <div id="multiscope-container" class="col-md-10 col-sm-10 col-xs-10"></div>
            </div>
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
    </div>
    <div id="affix-territorial-menu" class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1 col-xs-12 margin-bottom-10">
        <a href="#search" class="#liveModBtn lbh btn btn-link letter-red btn-menu-to-app hidden-top pull-left hidden-xs
                             tooltips" data-placement="bottom" data-original-title="Live">
            <i class="fa fa-search"></i>
            <span class="">All</span> 
        </a>

        <a href="#live" class="#liveModBtn lbh btn btn-link letter-red btn-menu-to-app pull-left  hidden-top hidden-xs
                             tooltips" data-placement="bottom" data-original-title="Live">
                    <i class="fa fa-connectdevelop"></i>

                     <span class="">Acteurs et initiaves</span> 
                                    </a>
        <a href="#live" class="#liveModBtn lbh btn btn-link letter-red btn-menu-to-app pull-left hidden-top hidden-xs
                             tooltips" data-placement="bottom" data-original-title="Live">
                    <i class="fa fa-newspaper-o"></i>

                     <span class="">Live</span> 
                                    </a>
        <a href="#agenda" class="#agendaModBtn lbh btn btn-link letter-red btn-menu-to-app pull-left hidden-top hidden-xs
                             tooltips" data-placement="bottom" data-original-title="Agenda">
                    <i class="fa fa-calendar"></i>

                    <span class="">Agenda</span> 
                                    </a>
        <a href="#annonces" class="#agendaModBtn lbh btn btn-link letter-red btn-menu-to-app  pull-left hidden-top hidden-xs
                             tooltips" data-placement="bottom" data-original-title="Agenda">
                    <i class="fa fa-bullhorn"></i>

                    <span class="">Entraide</span>
                                    </a>
        <a href="#annonces" class="#agendaModBtn lbh btn btn-link letter-red btn-menu-to-app pull-left  hidden-top hidden-xs
                             tooltips" data-placement="bottom" data-original-title="Agenda">
                    <i class="fa fa-money"></i>

                    <span class="">Market</span>
                                    </a>
    </div>
    
    
    <div class="panel-heading border-light text-center col-md-12 col-sm-12 col-xs-12 margin-top-10">
        <a href="javascript:;" onclick="applyStateFilter('<?php echo Person::COLLECTION ?>')" class="filter<?php echo Person::COLLECTION ?> btn btn-xs btn-default active btncountsearch"> People <span class="badge badge-warning countPeople" id="countcitoyens"></span></a>
        <a href="javascript:;" onclick="applyStateFilter('<?php echo Organization::COLLECTION ?>')" class="filter<?php echo Organization::COLLECTION ?> btn btn-xs btn-default btncountsearch"> Organizations <span class="badge badge-warning countOrganizations" id="countorganizations"></span></a> 
        <a href="javascript:;" onclick="applyStateFilter('<?php echo Event::COLLECTION ?>')" class="filter<?php echo Event::COLLECTION ?> btn btn-xs btn-default btncountsearch"> Events <span class="badge badge-warning countEvents" id="countevents"></span></a> 
        <a href="javascript:;" onclick="applyStateFilter('<?php echo Project::COLLECTION ?>')" class="filter<?php echo Project::COLLECTION ?> btn btn-xs btn-default btncountsearch"> Projects <span class="badge badge-warning countProjects" id="countprojects"></span></a>
        <a href="javascript:;" onclick="applyStateFilter('<?php echo Place::COLLECTION ?>')" class="filter<?php echo Place::COLLECTION ?> btn btn-xs btn-default btncountsearch"> Place <span class="badge badge-warning countPlaces" id="countplace"></span></a>
        <a href="javascript:;" onclick="applyStateFilter('<?php echo Poi::COLLECTION ?>')" class="filter<?php echo Poi::COLLECTION ?> btn btn-xs btn-default btncountsearch"> Pois <span class="badge badge-warning countPoi" id="countpoi"></span></a>
        <a href="javascript:;" onclick="applyStateFilter('<?php echo Classified::COLLECTION ?>')" class="filter<?php echo Classified::COLLECTION ?> btn btn-xs btn-default btncountsearch"> Classifieds <span class="badge badge-warning countClassified" id="countclassified"></span></a>
        <a href="javascript:;" onclick="applyStateFilter('<?php echo News::COLLECTION ?>')" class="filter<?php echo News::COLLECTION ?> btn btn-xs btn-default btncountsearch"> News <span class="badge badge-warning countNews" id="countnews"></span></a>
        <!--<a href="javascript:;" onclick="clearAllFilters('')" class="btn btn-xs btn-default"> All</a></h4>-->
    </div>
    
                      
        <?php } ?>

        <?php 
            if($subdomain == "freedom"){ 
                $this->renderPartial($layoutPath.'headers/dayQuestion', array());
            } 
        ?>

    </header>

    <?php
            
             ?>   
<script type="text/javascript">
    var filliaireCategories = <?php echo json_encode($filliaireCategories); ?>;
    jQuery(document).ready(function() {
        $(".btn-open-filliaire").click(function(){
            $("#filters-container ul li").removeClass("active");
            $(this).addClass("active");
            $("#container-scope-filter").hide(700);
            $("#sub-menu-filliaire").show(700);
            /*if($("#sub-menu-filliaire").hasClass("hidden"))
                $("#sub-menu-filliaire").removeClass("hidden");
            else{
                $("#sub-menu-filliaire").addClass("hidden");
                resetMyTags();
            }*/
        });
        $(".scope-header-filter").click(function(){
            $("#filters-container ul li").removeClass("active");
            $(this).addClass("active");
            $("#sub-menu-filliaire").hide(700);
            $("#container-scope-filter").show(700);

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
            bindCommunexionScopeEvents();
            //KScrollTo("#before-section-result");
            });

        loadMultiScopes();
        mylog.log("communexionActivated ok", communexion, communexion.state);
        initScopeMenu(myScopes);
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
</script>
    
    <?php   //if($subdomain != "referencement"){
                         
            //}
    ?>