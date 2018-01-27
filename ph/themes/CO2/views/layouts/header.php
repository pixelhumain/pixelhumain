<?php   HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/multi_tags_scopes.css'), Yii::app()->theme->baseUrl); ?>
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
        margin-left:5%;
        margin-top:17px!important;
    }
    .filters-type-container #sub-menu-filliaire{
        display:none;
        padding: 5px 0 0 5px;
    }
    .filters-type-container #container-scope-filter{
        display:none;
        max-height: 50px !important;
        overflow: hidden;
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
        margin-top:9px;
        text-align: left;
    }
    .btn-scope-menu{
        height: 50px;
        font-size: 17px;
        border: 1px solid rgba(0,0,0,.1);
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 0px 1px rgba(0,0,0,.1);
        line-height: 40px;
        padding-top: 4px;
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
        color: #666F78 !important;
        font-size: 13px;
        padding: 10px 15px 10px 15px;
        border-radius: 0px;
        font-weight: 100;
        font-family: montserrat;
        margin: 10px 0 0 -1px;
        border-bottom: 1px solid transparent;
    }
    .btn-menu-to-app.active, .btn-menu-to-app:hover, .btn-menu-to-app:focus{
        border-bottom: 1px solid #e43636;
        color: #ea4335!important;
    }
    #filter-scopes-menu{
        margin-left: 5%;
    }
    #filter-scopes-menu #input-sec-search{
        display:inline-block;
        display:-webkit-inline-box;
    }
    #filter-scopes-menu #input-sec-search .input-group-addon{
        background-color: rgba(255,255,255,0.9) !important;
    }
   
   .scopes-container{
    text-align: left;
    line-height: 30px;
   }
   #multisopes-btn, #communexion-btn{
        float: left;
        margin-left: 10px;
        line-height: 32px;
        padding: 0px 5px;
    }

    #main-input-group{
        float: left;
        margin-left: 5%;
    }

    #multisopes-btn:hover, #communexion-btn:hover{
        text-decoration: none;
        font-weight:bold;
    }
    #multisopes-btn:focus, #communexion-btn:focus{
        text-decoration: none;
        font-weight:200;
    }
    .manageMultiscopes{
        cursor: pointer;
    }
    header{
        padding-bottom: 15px;
        padding-top: 30px;
    }

    header #footerDropdownGS.text-center{
        display: none;
    }

    #filters-container ul li{
        cursor: pointer;
    }


    @media (max-width: 768px) {
        .filters-type-container{
            margin-left:2% !important;
        }

        .btn-menu-to-app{
            font-size:15px!important;
        }
        .link-submenu-header span{
            display: none;
            /*font-size:11px;*/
        }
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
   // $this->renderPartial($layoutPath.'scopes/'.$CO2DomainName.'/multi_scope', 
     //       array(  "cities"=>$cities, "me"=>$me));
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
                        <div class="input-group col-xs-7 col-sm-8 col-md-8" id="main-input-group"  style="">
                            <input type="text" class="form-control" id="main-search-bar" 
                                placeholder="<?php echo Yii::t("common", $params["pages"]["#".$page]["placeholderMainSearch"]); ?>">
                            <span class="bg-white input-group-addon" id="main-search-bar-addon">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                        <div id="filters-container" class="no-padding">
                            <ul class="filters-menu">
                                <!-- <li class="scope-header-filter tooltips" data-placement="bottom" data-original-title="Geographic filter">
                                 <i class="fa fa-globe"></i> 
                                 <span class="scope-filters-badge topbar-badge animated bounceIn hide badge-tranparent"></span>
                                    <!--<span class="hidden-xs"><?php echo Yii::t("common","Geographical") ?></span>- ->
                                </li> -->
                                <li class="btn-open-filliaire tooltips" data-placement="bottom" data-original-title="Themes filter">
                                 <i class="fa fa-th"></i> 
                                    <!--<span class="hidden-xs"><?php echo Yii::t("common","Themes") ?></span>-->
                                </li>
                                
                            </ul> 
                        </div>
                    </div>
                        <div id="filter-scopes-menu" class="col-md-12 col-sm-12 col-xs-12 margin-top-10">
                            <div id="scope-container" class="scope-menu no-padding">
                                <div id="input-sec-search" class="col-xs-10 col-md-6 col-sm-6 col-lg-6">
                                    <div class="input-group shadow-input-header">
                                          <span class="input-group-addon">
                                            <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>
                                          </span>
                                          <input type="text" class="form-control input-global-search" autocomplete="off"
                                                 id="searchOnCity" placeholder="<?php echo Yii::t("common","where ?") ?> ...">
                                    </div>
                                    <div class="dropdown-result-global-search col-xs-12 col-sm-5 col-md-5 col-lg-5 no-padding" 
                                        style="max-height: 70%; display: none;">
                                        <div class="text-center" id="footerDropdownGS">
                                        <label class="text-dark"><i class="fa fa-ban"></i> Aucun résultat</label>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <button id="multisopes-btn" class="btn btn-link letter-red btn-menu-scopes" data-type="multiscopes">
                                    <i class="fa fa-angle-down"></i> 
                                    <i class="fa fa-map-marker"></i> 
                                    <?php echo Yii::t("common","My favorites places"); ?> 
                                    (<span class="count-favorite"></span>)
                                </button>
                                <button id="communexion-btn" class="btn btn-link letter-red btn-menu-scopes" data-type="communexion">
                                    <i class="fa fa-angle-down"></i> 
                                    <i class="fa fa-home"></i> 
                                    <span class="communexion-btn-label">
                                    </span> 
                                </button>
                                <div class="scopes-container col-md-12 col-sm-12 col-xs-12 no-padding margin-top-5">
                                </div>
                            </div>
                        </div>
                        <div id="filters-menu" class="filters-type-container col-md-9 col-sm-9 col-xs-12 no-padding margin-top-5">
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
                                        </div>
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
                                      <div class="col-md-2 col-sm-3 col-sm-6 col-xs-6 no-padding">
                                        <button class="btn btn-default col-md-12 col-sm-12 col-xs-12 padding-10 bold text-dark elipsis margin-bottom-5 btn-select-filliaire" 
                                                data-fkey="<?php echo $key; ?>"
                                                style="border-radius:0px; border-color: transparent; text-transform: uppercase;" 
                                                data-keycat="<?php echo $cat["name"]; ?>">
                                          <i class="fa <?php echo $cat["icon"]; ?> fa-2x"></i><br>
                                          <?php echo Yii::t("category", $cat["name"]); ?>
                                        </button>
                                      </div>
                              <?php } 
                          //          <!--</button>-->
                                } ?>
                            </div>
                        </div>
                    <div id="affix-sub-menu">
                        <div id="territorial-menu" class="col-md-10 col-sm-10 col-xs-12 margin-bottom-10 no-padding">
                            <?php //if(false){
                                $params = CO2::getThemeParams();
                                foreach ($params["pages"] as $key => $value) {
                                    if(@$value["inMenu"]==true && @$value["open"]==true){ ?>
                                        <a href="<?php echo $key; ?>" 
                                        class="<?php echo $key; ?>ModBtn lbh btn btn-link pull-left btn-menu-to-app hidden-top link-submenu-header tooltips <?php if($subdomainName==$value["subdomainName"]) echo 'active'; ?>" data-placement="bottom" title="<?php echo Yii::t("common",$value["subdomainName"]); ?>">
                                                
                                        <i class="fa fa-<?php echo $value["icon"]; ?>"></i>
                                        <span class=""><?php echo Yii::t("common", $value["subdomainName"]); ?></span>
                                        <span class="<?php echo @$value["notif"]; ?> topbar-badge badge animated bounceIn badge-warning"></span>
                                        <?php if(@$value["notif"]){ ?>
                                        <?php } ?>
                                    </a>  
                                <?php   }
                                } ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>    
    <?php } ?>

    

</header>
     
<script type="text/javascript">
    var filliaireCategories = <?php echo json_encode(@$filliaireCategories); ?>;
    var page="<?php echo $page ?>";
    jQuery(document).ready(function() {
        searchInitApp(search);
        //$("."+page+"-menu-btn").addClass("active");

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
        });

        initScopeMenu();
        $(".tooltips").tooltip();
    });
    function searchInitApp(src){
        search.app=page;
        if(search.value != "")
            $("#main-search-bar, #second-search-bar").val(search.value);
    }
    function initScopeMenu(type){
        if(typeof myScopes.type != "undefined")
            activateScope=myScopes.type;
        else
            activateScope="open";
        activateScopeMenu(activateScope,true);
        bindSearchCity();
        headerActive=true;
        bindScopesInputEvent();
        countFavoriteScope();
        getCommunexionLabel();
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
        }else if(type=="open")
            myScopes.state=false;
        if(myScopes.state){
            $('.scope-filters-badge').removeClass('hide');
            $('.scope-filters-badge').addClass('animated bounceIn');
            $('.scope-filters-badge').addClass('badge-success');
            $('.scope-filters-badge').removeClass('badge-tranparent');
        }

    }
</script>