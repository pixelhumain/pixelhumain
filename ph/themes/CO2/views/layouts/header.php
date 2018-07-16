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
    /*#filters-nav-list .dropdown .dropdown-menu:after{
        width: inherit;
        right: inherit;
    }*/
    @media (max-width: 767px) {
        
    }
</style>

<?php 
    $params = CO2::getThemeParams();
    $devises = $params["devises"];
    
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
    //if( @$dontShowMenu && $dontShowMenu ) 
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

<?php if(@$useHeader != false){ ?>
<header>
    <div class="row">
        <div class="col-xs-12">
            <div class="intro-text">  
                <div id="affix-sub-menu" class="affix">
                    <div id="text-search-menu" class="col-md-12 col-sm-12 col-xs-12 no-padding">
                            <input type="text" class="form-control main-search-bar pull-left" id="main-search-bar" placeholder="<?php echo Yii::t("common", "What are you looking for")." ?"; ?>">
                            <span class="text-white input-group-addon pull-left main-search-bar-addon" id="main-search-bar-addon" style="border-radius:0px !important;">
                                <i class="fa fa-arrow-circle-right"></i>
                            </span>
            
                    </div>
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
                    <div id="territorial-menu" class="col-md-12 col-sm-12 col-xs-12 margin-bottom-10">
                        <button class="btn visible-xs pull-left menu-btn-scope-filter text-red elipsis"
                            data-type="<?php echo @$type; ?>">
                            <i class="fa fa-map-marker"></i> <span class="header-label-scope"><?php echo Yii::t("common","where ?") ?></span>
                        </button>
                        <?php //if(false){
                            $params = CO2::getThemeParams();
                            foreach ($params["pages"] as $key => $value) {
                                if(@$value["inMenu"]==true && @$value["open"]==true){ ?>
                                    <a href="javascript:;" data-hash="<?php echo $key; ?>" 
                                    class="<?php echo $key; ?>ModBtn lbh-menu-app btn btn-link pull-left btn-menu-to-app hidden-xs hidden-top link-submenu-header <?php if($subdomainName==$value["subdomainName"]) echo 'active'; ?>">
                                            
                                    <i class="fa fa-<?php echo $value["icon"]; ?>"></i>
                                    <span class="<?php echo str_replace("#","",$key); ?>ModSpan"><?php echo Yii::t("common", $value["subdomainName"]); ?></span>
                                    <span class="<?php echo @$value["notif"]; ?> topbar-badge badge animated bounceIn badge-warning"></span>
                                </a>  
                            <?php   }
                            } ?>
                            <button class="btn btn-show-filters"><?php echo Yii::t("common", "Filters") ?> <span class="topbar-badge badge animated bounceIn badge-warning bg-green"></span> <i class="fa fa-angle-down"></i></button>
                    </div>
                    <div id="filters-nav" class="col-xs-12">
                        <ul id="filters-nav-list" class="no-padding no-margin">
                            <li class="dropdown dropdown-tags">
                                <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left" data-label-xs="tags" type="button" id="dropdownTags" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                              title="<?php echo Yii::t("common","Tags") ?>" alt="<?php echo Yii::t("common","Tags") ?>"><?php echo Yii::t("common","Tags") ?> <i class="fa fa-angle-down"></i></a>
                                <div class="dropdown-menu arrow_box hidden-xs" aria-labelledby="dropdownTags">
                                    <div class="col-xs-12 no-padding margin-bottom-5">
                                        <div class="form-group filterstags col-md-8 col-sm-8 col-xs-10 no-margin no-padding">
                                            <input id="tagsFilterInput" type="" data-type="select2" name="tags" placeholder="#Tags" value="" style="width:100%;">       
                                        </div>
                                        <button class="btn btn-default letter-green col-md-2 col-sm-2 col-xs-1 btn-tags-start-search no-margin padding-10"><i class="fa fa-arrow-circle-right"></i> <span class="hidden-xs"><?php echo Yii::t("common", "Validate") ?></span></button>
                                        <button class="btn btn-default letter-blue col-md-2 col-sm-2 btn-tags-refresh no-margin padding-10"><i class="fa fa-refresh"></i> <span class="hidden-xs"><?php echo Yii::t("common", "Refresh") ?></span></button>
                                    </div>
                                     <?php $filliaireCategories = CO2::getContextList("filliaireCategories"); 
                                    foreach ($filliaireCategories as $key => $cat) { 
                                        if(is_array($cat)) { ?>
                                          <div class="col-md-2 col-sm-2 col-xs-3 no-padding">
                                            <button class="btn btn-default col-md-12 col-sm-12 col-xs-12 padding-10 bold text-dark elipsis margin-bottom-5 btn-select-filliaire" 
                                                    data-fkey="<?php echo $key; ?>"
                                                    style="border-radius:0px; border-color: transparent; text-transform: uppercase;" 
                                                    data-keycat="<?php echo $cat["name"]; ?>">
                                              <i class="fa <?php echo $cat["icon"]; ?> fa-2x"></i><br>
                                              <?php echo Yii::t("category", $cat["name"]); ?>
                                            </button>
                                          </div>
                                    <?php } 
                                    } ?>
                                </div>
                            </li>
                            <li class="dropdown dropdown-types">
                                <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left"  type="button" id="dropdownThematics" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-label-xs="types" data-toggle="tooltip" data-placement="bottom" 
                              title="<?php echo Yii::t("common","Choose a type") ?>" alt="<?php echo Yii::t("common","type") ?>"><?php echo Yii::t("common","Type") ?> <i class="fa fa-angle-down"></i></a>
                                <div class="dropdown-menu arrow_box hidden-xs" aria-labelledby="dropdownTypes">
                                </div>
                            </li>
                            <li class="dropdown dropdown-sources">
                                <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left"  data-label-xs="sources" type="button" id="dropdownSources" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                              title="<?php echo Yii::t("common","Select a source of data") ?>" alt="<?php echo Yii::t("common","Select a source of data") ?>"><?php echo Yii::t("common","Source data") ?> <i class="fa fa-angle-down"></i></a>
                                <div class="dropdown-menu arrow_box hidden-xs" aria-labelledby="dropdownSources">
                                </div>
                            </li>
                            <li class="dropdown dropdown-section">
                                <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left"  data-label-xs="section" type="button" id="dropdownSection" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                              title="<?php echo Yii::t("common","Choose a section") ?>" alt="<?php echo Yii::t("common","Choose a section") ?>"><?php echo Yii::t("common","Section") ?> <i class="fa fa-angle-down"></i></a>
                                <div class="dropdown-menu arrow_box hidden-xs" aria-labelledby="dropdownSections">
                                </div>
                            </li>
                            <li class="dropdown dropdown-category">
                                <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left" data-label-xs="category" type="button" id="dropdownCategory" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                              title="<?php echo Yii::t("common","Choose a category") ?>" alt="<?php echo Yii::t("common","Choose a category") ?>"><?php echo Yii::t("common","Category") ?> <i class="fa fa-angle-down"></i></a>
                                <div class="dropdown-menu arrow_box hidden-xs" aria-labelledby="dropdownCategory">
                                </div>
                            </li>
                            <li class="dropdown dropdown-price">
                                <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left" data-label-xs="price" type="button" id="dropdownPrice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                              title="<?php echo Yii::t("common","Range prices") ?>" alt="<?php echo Yii::t("common","Range prices") ?>"><?php echo Yii::t("common","Price") ?> <i class="fa fa-angle-down"></i></a>
                                <div class="dropdown-menu arrow_box hidden-xs" aria-labelledby="dropdownPrice">
                                     <div class="form-group col-md-4 col-sm-4 col-xs-6 divPriceMin">
                                        <label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="sectionBtn">
                                          <i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Min price") ?>
                                        </label>
                                        <input type="text" id="priceMin" name="priceMin" class="form-control" 
                                               placeholder="<?php echo Yii::t("common","Min price") ?>"/>
                                    </div>

                                      <div class="form-group col-md-4 col-sm-4 col-xs-6 divPriceMax">
                                        <label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="sectionBtn">
                                            <i class="fa fa-angle-down"></i>
                                            <?php echo Yii::t("common","Max price") ?>
                                        </label>
                                        <input type="text" id="priceMax" name="priceMax" class="form-control col-md-5" placeholder="<?php echo Yii::t("common","Max price") ?>"/>
                                      </div>
                                      <div class="form-group col-md-4 col-sm-4 col-xs-12 divMoney">
                                        <label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="sectionBtn">
                                          <i class="fa fa-money"></i> <span class="hidden-xs hidden-sm"><?php echo Yii::t("common","Money"); ?></span>
                                        </label>
                                        <select class="form-control" name="devise" id="devise" style="">
                                        <?php 
                                          $params = CO2::getThemeParams();
                                          $devises = $params["devises"]; ?>
                                          <?php if(@$devises){ 
                                            foreach($devises as $key => $devise){ ?>
                                            <option class="bold" value="<?php echo $key; ?>"><?php echo Yii::t("common",$devise); ?></option>
                                          <?php } } ?>
                                        </select>
                                      </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 margin-top-10 text-center">
                                    <button class="btn btn-link bg-white text-azure margin-top-15 btn-price-filter font-montserrat" data-key="reset" data-type="classifieds">
                                        <i class="fa fa-refresh"></i> <span class=""><?php echo Yii::t("common","Refresh") ?></span>
                                      </button>
                                      <button class="btn btn-link bg-azure margin-top-15 btn-price-filter font-montserrat" data-type="classifieds">
                                        <i class="fa fa-search"></i> <span class=""><?php echo Yii::t("common","Search") ?></span>
                                      </button>
                                    </div>
                                </div>
                            </li>
                           
                        </ul>
                        <div class="visible-xs dropdown-xs-view">
                            <div class="dropdown dropdown-tags">
                                <div class="dropdown-menu arrow_box" aria-labelledby="dropdownTags">
                                    <div class="col-xs-12 no-padding margin-bottom-5">
                                        <div class="form-group filterstags col-md-8 col-sm-8 col-xs-10 no-margin no-padding">
                                            <input id="tagsFilterInput" type="" data-type="select2" name="tags" placeholder="#Tags" value="" style="width:100%;">       
                                        </div>
                                        <button class="btn btn-default letter-green col-md-2 col-sm-2 col-xs-1 btn-tags-start-search no-margin padding-10"><i class="fa fa-arrow-circle-right"></i> <span class="hidden-xs"><?php echo Yii::t("common", "Validate") ?></span></button>
                                        <button class="btn btn-default letter-blue col-md-2 col-sm-2 btn-tags-refresh no-margin padding-10"><i class="fa fa-refresh"></i> <span class="hidden-xs"><?php echo Yii::t("common", "Refresh") ?></span></button>
                                    </div>
                                     <?php $filliaireCategories = CO2::getContextList("filliaireCategories"); 
                                    foreach ($filliaireCategories as $key => $cat) { 
                                        if(is_array($cat)) { ?>
                                          <div class="col-md-2 col-sm-2 col-xs-3 no-padding">
                                            <button class="btn btn-default col-md-12 col-sm-12 col-xs-12 padding-10 bold text-dark elipsis margin-bottom-5 btn-select-filliaire" 
                                                    data-fkey="<?php echo $key; ?>"
                                                    style="border-radius:0px; border-color: transparent; text-transform: uppercase;" 
                                                    data-keycat="<?php echo $cat["name"]; ?>">
                                              <i class="fa <?php echo $cat["icon"]; ?> fa-2x"></i><br>
                                              <?php echo Yii::t("category", $cat["name"]); ?>
                                            </button>
                                          </div>
                                    <?php } 
                                    } ?>
                                </div>
                            </div>
                            <div class="dropdown dropdown-types">
                                <div class="dropdown-menu arrow_box" aria-labelledby="dropdownTypes">
                                </div>
                            </div>
                            <div class="dropdown dropdown-sources">
                                <div class="dropdown-menu arrow_box" aria-labelledby="dropdownSources">
                                </div>
                            </div>
                            <div class="dropdown dropdown-section">
                                <div class="dropdown-menu arrow_box" aria-labelledby="dropdownSections">
                                </div>
                            </div>
                            <div class="dropdown dropdown-category">
                                <div class="dropdown-menu arrow_box" aria-labelledby="dropdownCategory">
                                </div>
                            </div>
                            <div class="dropdown dropdown-price">
                                <div class="dropdown-menu arrow_box" aria-labelledby="dropdownPrice">
                                     <div class="form-group col-md-4 col-sm-4 col-xs-6 divPriceMin">
                                        <label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="sectionBtn">
                                          <i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Min price") ?>
                                        </label>
                                        <input type="text" id="priceMin" name="priceMin" class="form-control" 
                                               placeholder="<?php echo Yii::t("common","Min price") ?>"/>
                                    </div>

                                      <div class="form-group col-md-4 col-sm-4 col-xs-6 divPriceMax">
                                        <label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="sectionBtn">
                                            <i class="fa fa-angle-down"></i>
                                            <?php echo Yii::t("common","Max price") ?>
                                        </label>
                                        <input type="text" id="priceMax" name="priceMax" class="form-control col-md-5" placeholder="<?php echo Yii::t("common","Max price") ?>"/>
                                      </div>
                                      <div class="form-group col-md-4 col-sm-4 col-xs-12 divMoney">
                                        <label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="sectionBtn">
                                          <i class="fa fa-money"></i> <span class="hidden-xs hidden-sm"><?php echo Yii::t("common","Money"); ?></span>
                                        </label>
                                        <select class="form-control" name="devise" id="devise" style="">
                                        <?php 
                                          $params = CO2::getThemeParams();
                                          $devises = $params["devises"]; ?>
                                          <?php if(@$devises){ 
                                            foreach($devises as $key => $devise){ ?>
                                            <option class="bold" value="<?php echo $key; ?>"><?php echo Yii::t("common",$devise); ?></option>
                                          <?php } } ?>
                                        </select>
                                      </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 margin-top-10 text-center">
                                    <button class="btn btn-link bg-white text-azure margin-top-15 btn-price-filter font-montserrat" data-key="reset" data-type="classifieds">
                                        <i class="fa fa-refresh"></i> <span class=""><?php echo Yii::t("common","Refresh") ?></span>
                                      </button>
                                      <button class="btn btn-link bg-azure margin-top-15 btn-price-filter font-montserrat" data-type="classifieds">
                                        <i class="fa fa-search"></i> <span class=""><?php echo Yii::t("common","Search") ?></span>
                                      </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>      

</header>
  
<?php } ?>
     
<script type="text/javascript">
    var filliaireCategories = <?php echo json_encode(@$filliaireCategories); ?>;
    var page="<?php echo $page ?>";
    var headerScaling=false;
    jQuery(document).ready(function() {
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