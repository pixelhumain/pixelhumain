<?php   HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/multi_tags_scopes.css'), Yii::app()->theme->baseUrl); 
    $themeParams = CO2::getThemeParams();    
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
                <span class="dropdown dropdownApps" id="dropdown-apps">
                    <button class="dropdown-toggle" type="button" id="dropdownApps" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-placement="bottom" title="Applications" alt="Applications">
                          <i class="fa fa-th"></i>
                        </button>
                    </span>
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
                    
                    $this->renderPartial($layoutPath.'menus/'.$menuApp, array("params"=>$themeParams, "subdomainName"=>$subdomainName, "useFilter"=>@$useFilter )); 
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
        $(".btn-menu-vertical").mouseenter(function(){
            $(this).find(".tooltips-menu-btn").show();
        }).mouseleave(function(){
            $(this).find(".tooltips-menu-btn").hide();
        });
        $(".btn-menu-tooltips").mouseenter(function(){
            $(this).find(".tooltips-top-menu-btn").show();
        }).mouseleave(function(){
            $(this).find(".tooltips-top-menu-btn").hide();
        });
        $("#filters-nav a.dropdown-toggle").click(function(){
            filterContain=$(this).data("label-xs");
            $(".dropdown-xs-view .dropdown").removeClass("open");
            $(".dropdown-xs-view .dropdown-"+filterContain).addClass("open");
        });
        $(".tagsFilterInput").select2({tags:[]});
        $(".tooltips").tooltip();
        $(".btn-show-filters").click(function(){
            if(!$("#filters-nav").is(":visible")){
                $("#vertical .btn-show-filters.hidden-xs").hide(350);
                $("#filters-nav").show(200);
            }else{
                $("#filters-nav").hide(350);
                $("#vertical .btn-show-filters.hidden-xs").show(200);
            }
            headerHeightPos(true);
        });
        $(".menu-btn-scope-filter").click(function(){
            if($("#filter-scopes-menu").is(":visible")){
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
            $("#filter-scopes-menu").hide(300);
            headerHeightPos(true);
        }else{
            $(".menu-btn-scope-filter").addClass("visible");
            $("#filter-scopes-menu").show(400);
            headerHeightPos(true);
        }
    }


    function headerHeightPos(bool){
        setTimeout(function(){     
            headerScaling=bool; 
            $("header").height($("#affix-sub-menu").height());
            setTimeout(function(){headerScaling=false;},300);
        }, 350);
    }
    function initScopeMenu(type){   
        bindSearchCity();
        bindScopesInputEvent();
        countFavoriteScope();
        getCommunexionLabel();
    }
</script>