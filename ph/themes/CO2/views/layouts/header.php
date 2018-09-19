<?php   HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/multi_tags_scopes.css'), Yii::app()->theme->baseUrl); ?>
<style>
    #filters-nav-list > li > a.dropdown-toggle:hover, #filters-nav-list > li > a.dropdown-toggle.active{
        color:#2BB0C6 !important;
        font-weight: bold;
        text-decoration: none;
    }
    #filters-nav-list > li{
        position: relative;
        float: left;
        margin-right: 10px;
        display: inline-block;
        padding: 10px 5px;
    }
    .btn-show-filters{
        margin-top: 5px;
        padding: 3px 15px;
        border: 1px solid rgba(0,0,0,0.1);
        background-color: white;
    }
    #filters-nav-list .dropdown .dropdown-menu{
        left: -2px;
        /*width: 90%;*/
        top: 40px;
        position: absolute !important;
    }
    #filters-nav-list .dropdown .dropdown-menu:after, #filters-nav-list .dropdown .dropdown-menu:before{
        left: 5%;
    }
    #filters-nav-list .dropdown .btn-news-type-filters {
        border:inherit;
    }
    #filters-nav-list .dropdown .dropdown-menu{
        max-height: 400px;
        max-width: 700px;
        min-width: 300px;
        overflow-y: overlay;
    }
     #filters-nav-list .dropdown-tags .btn-tags-start-search,  #filters-nav-list .dropdown-tags  .btn-tags-refresh{
        border-radius: 3px;
        border: 1px solid #aaa;
        padding-bottom: 9px !important;
    }
    #filters-nav-list .dropdown-tags .dropdown-menu, #filters-nav-list .dropdown-price .dropdown-menu{
        width: 600px;
    }
    #filters-nav-list .dropdown{
        display:none;
        list-style: none;
    }
    #vertical  #territorial-menu{
        position: fixed;
        bottom: 0px;
        top: 67px;
        left: 0px;
        width: 52px;
        padding: 0px !important;
        box-shadow: 0px 1px 6px -1px rgba(0,0,0,0.5);
    }
    #vertical  #territorial-menu .btn-menu-to-app{
        width: 100%;
        font-size: 15px;
    }
    #vertical{
        min-height: 0px;
    }
    #vertical #affix-sub-menu{
            padding-left: 52px;
            top: 68px;
            box-shadow: none;
    }
    #vertical #filters-nav{
        padding-left: 1% !important;
        box-shadow: 0px 1px 3px -1px rgba(0,0,0,0.5);
    }
    /*#filters-nav-list .dropdown .dropdown-menu:after{
        width: inherit;
        right: inherit;
    }*/
    @media (max-width: 767px) {
        
    }
</style>

<?php 
    $themeParams = CO2::getThemeParams();
    /*$url = $_SERVER["REQUEST_URI"];
    echo "ouiiiiiiiiiiii";
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    var_dump($actual_link);
    var_dump($url);
    var_dump(strrpos($url, '/'));
    $page=substr($url, strrpos($url, '/') + 1);
    var_dump($page);
    if($page=="index")
        $page = (@Yii::app()->session["userId"] ) ? $themeParams["pages"]["#app.index"]["redirect"]["logged"] : $themeParams["pages"]["#app.index"]["redirect"]["unlogged"];
    $page="search";*/
    //=$hash;
    //$devises = $themeParams["devises"];
    
    if(@$type=="cities")    { 
        $lblCreate = "";
        $themeParams["pages"]["#".$page]["mainTitle"] = "Rechercher une commune"; 
        $themeParams["pages"]["#".$page]["placeholderMainSearch"] = "Rechercher une commune"; 
    }

    $useHeader              = $themeParams["pages"]["#".$page]["useHeader"];
    $useFilter              = $themeParams["pages"]["#".$page]["useFilter"];
    $subdomain              = $themeParams["pages"]["#".$page]["subdomain"];
    $subdomainName          = $themeParams["pages"]["#".$page]["subdomainName"];
    $icon                   = $themeParams["pages"]["#".$page]["icon"];
    $mainTitle              = $themeParams["pages"]["#".$page]["mainTitle"];
    $placeholderMainSearch  = $themeParams["pages"]["#".$page]["placeholderMainSearch"];
    $type = @$themeParams["pages"]["#".$page]["type"];
    $menuApp=(@$themeParams["appRendering"]) ? $themeParams["appRendering"] : "horizontal";
    $CO2DomainName = Yii::app()->params["CO2DomainName"];
    $me = isset(Yii::app()->session['userId']) ? Person::getById(Yii::app()->session['userId']) : null;
   $this->renderPartial($layoutPath.'menus/'.$CO2DomainName, 
            array( "layoutPath"=>$layoutPath , 
                    "subdomain"=>$subdomain,
                    "subdomainName"=>$subdomainName,
                    "mainTitle"=>$mainTitle,
                    "placeholderMainSearch"=>$placeholderMainSearch,
                    "menuApp"=>$menuApp,
                    "type"=>@$type,
                    "me" => $me) );
    $cities = [];
?>

<!-- Header -->

<?php if(@$useHeader != false){ ?>
<header id="<?php echo $menuApp; ?>">
            <div id="affix-sub-menu" class="affix">
                <div id="text-search-menu" class="col-md-12 col-sm-12 col-xs-12 no-padding">
                    <input type="text" class="form-control main-search-bar pull-left" id="main-search-xs-bar" placeholder="<?php echo Yii::t("common", "What are you looking for")." ?"; ?>">
                    <span class="text-white input-group-addon input-group-addon-xs pull-left main-search-bar-addon" id="main-search-xs-bar-addon" style="border-radius:0px !important;">
                        <i class="fa fa-arrow-circle-right"></i>
                    </span>
        
                </div>
                <?php if(@$useFilter != false){ ?>
                <div id="filter-scopes-menu" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: none;">
                    <div id="scope-container" class="scope-menu no-padding">
                        <div id="input-sec-search" class="col-xs-8 col-md-6 col-sm-6 col-lg-6">
                            <div class="input-group shadow-input-header">
                                  <span class="input-group-addon">
                                    <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>
                                  </span>
                                  <input type="text" class="form-control input-global-search" autocomplete="off"
                                         id="searchOnCity" placeholder="<?php echo Yii::t("common","where ?") ?> ...">
                                    <input id="searchTags" type="hidden" />
                            </div>
                            <div class="dropdown-result-global-search col-xs-12 col-sm-5 col-md-5 col-lg-5 no-padding" 
                                style="max-height: 70%; display: none;">
                                <div class="text-center" id="footerDropdownGS">
                                <label class="text-dark"><i class="fa fa-ban"></i> Aucun résultat</label>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <button id="multiscopes-btn" class="btn btn-link letter-red btn-menu-scopes pull-left" data-type="multiscopes">
                            <i class="fa fa-star"></i> 
                            <span class="hidden-xs">
                                <?php echo Yii::t("common","My favorites places"); ?> 
                                (<span class="count-favorite"></span>)
                            </span>
                        </button>
                        <button id="communexion-btn" class="btn btn-link letter-red btn-menu-scopes pull-left" data-type="communexion">
                            <i class="fa fa-home"></i> 
                            <span class="communexion-btn-label hidden-xs">
                            </span> 
                        </button>
                        <div class="scopes-container col-md-12 col-sm-12 col-xs-12 no-padding margin-top-5">
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php 
                    
                    $this->renderPartial($layoutPath.'menus/'.$menuApp, array("params"=>$themeParams, "subdomainName"=>$subdomainName )); 
                    if(@$useFilter != false)
                        $this->renderPartial($layoutPath.'menus/filtersApp', array("params"=>$themeParams)); 
                ?>
                
    </div>      

</header>
  
<?php } ?>
     
<script type="text/javascript">
    var filliaireCategories = <?php echo json_encode(@$filliaireCategories); ?>;
    var page="<?php echo $page ?>";
    var headerScaling=false;
    var titlePage = "<?php echo Yii::t("common",@$themeParams["pages"]["#".$page]["subdomainName"]); ?>";

    jQuery(document).ready(function() {
        setTitle(titlePage, "", titlePage);
        initScopeMenu();
        if( typeof custom != "undefined" && custom.logo ){
            custom.initMenu("mainSearch");
        }
        $("#filters-nav a.dropdown-toggle").click(function(){
            filterContain=$(this).data("label-xs");
            $(".dropdown-xs-view .dropdown").removeClass("open");
            $(".dropdown-xs-view .dropdown-"+filterContain).addClass("open");
        });
        $("#tagsFilterInput").select2({tags:[]});
        $(".tooltips").tooltip();
        $(".btn-show-filters").click(function(){
            if(!$("#filters-nav").is(":visible"))
                $("#filters-nav").show(200);
            else
                $("#filters-nav").hide(200);
            headerHeightPos(true);
        });
        $(".menu-btn-scope-filter").click(function(){
            if($(".menu-btn-scope-filter").hasClass("visible")){
                showWhere(false);
            }else{

                showWhere(true);
            }
        });
        headerHeightPos(true);

    });


    function showWhere(show){
        mylog.log("showWhere", show);
        if(show == false){
            $(".menu-btn-scope-filter").removeClass("visible");
            //$("#text-search-menu").hide();
            $("#filter-scopes-menu").hide(400);
            //headerHeightPos(true);
        }else{
            $(".menu-btn-scope-filter").addClass("visible");
            $("#text-search-menu").hide();
            $("#filter-scopes-menu").show(400);
            headerHeightPos(true);
        }
    }


    function headerHeightPos(bool){
        setTimeout(function(){     
            headerScaling=bool; 
            $("header").height($("#affix-sub-menu").height());
            setTimeout(function(){headerScaling=false;},300);
        }, 400);
    }
    function initScopeMenu(type){   
        bindSearchCity();
        bindScopesInputEvent();
        countFavoriteScope();
        getCommunexionLabel();
    }
</script>