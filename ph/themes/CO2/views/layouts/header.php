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
        margin-top: 5px !important;
        padding: 3px 15px;
        border: 1px solid rgba(0,0,0,0.1);
        background-color: white;
    }
    #filters-nav-list .dropdown .dropdown-menu{
        left: 5%;
        width: 90%;
        top: 135px;
        position: fixed !important;
    }
    #filters-nav-list .dropdown .dropdown-menu:after, #filters-nav-list .dropdown .dropdown-menu:before{
        left: 5%;
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
    <!--<div class="col-md-12 text-center main-menu-app" style="">-->
        <?php 
            /*$this->renderPartial( $layoutPath.'menus.moduleMenu',array( "params" => $params , 
                                                                        "subdomain"  => $subdomain));*/
        ?>
    <!--</div>-->
    <div class="row">
        <div class="col-xs-12">
            <div class="intro-text">  
                <?php /*$this->renderPartial($layoutPath.'headers/'.Yii::app()->params["CO2DomainName"], 
                                            array("mainTitle"=>$mainTitle,
                                                  "icon"=>$icon,
                                                  "subdomainName"=>$subdomainName,
                                                  "subdomain"=>$subdomain,
                                                  "type"=>@$type,
                                                  "explain"=>@$explain));*/ ?>
                <!--<div class="subModuleTitle">  
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <div class="input-group col-xs-10 col-sm-8 col-md-8" id="main-input-group"  style="">
                            <input type="text" class="form-control" id="main-search-bar" 
                                placeholder="<?php echo Yii::t("common", $params["pages"]["#".$page]["placeholderMainSearch"]); ?>">
                            <span class="bg-white input-group-addon" id="main-search-bar-addon">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                        <div id="filters-container" class="no-padding">
                            <ul class="filters-menu">-->
                                <!--<li class="scope-header-filter tooltips visible-xs" data-placement="bottom" data-original-title="Geographic filter">
                                 <i class="fa fa-globe"></i> 
                                 <span class="scope-filters-badge topbar-badge animated bounceIn hide badge-tranparent"></span>                                </li>--> 
                                <!--<li class="theme-header-filter toogle-filter tooltips" data-placement="bottom" data-original-title="Themes filter">
                                 <i class="fa fa-tags"></i> 
                                </li>
                                
                            </ul> 
                        </div>
                    </div>-->
                  <!--  <div id="menu-filter" class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <div id="filter-thematic-menu" class="col-lg-10 col-md-12 col-sm-12 col-xs-12 text-center margin-top-10">
                            <?php 
                           // if($page == "annonces"){ 
                             //   $this->renderPartial("classifieds.views.co.header", array( "typeSelected" => $type ));
                            //} else { ?>
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
                          
                              //  } ?>
                          <?php } ?>
                        </div>
                        

                        
                    </div>-->
                    <div id="affix-sub-menu" class="affix">
                        <div id="filter-scopes-menu" class="col-lg-10 col-md-12 col-sm-12 col-xs-12 no-padding margin-top-10">
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
                                <button id="multiscopes-btn" class="btn btn-link letter-red btn-menu-scopes" data-type="multiscopes">
                                    <!-- <i class="fa fa-angle-down"></i>  -->
                                    <i class="fa fa-star"></i> 
                                    <span class="hidden-xs">
                                        <?php echo Yii::t("common","My favorites places"); ?> 
                                        (<span class="count-favorite"></span>)
                                    </span>
                                </button>
                                <button id="communexion-btn" class="btn btn-link letter-red btn-menu-scopes" data-type="communexion">
                                    <!-- <i class="fa fa-angle-down"></i>  -->
                                    <i class="fa fa-home"></i> 
                                    <span class="communexion-btn-label hidden-xs">
                                    </span> 
                                </button>
                                <div class="scopes-container col-md-12 col-sm-12 col-xs-12 no-padding margin-top-5">
                                </div>
                            </div>
                        </div>
                        <div id="territorial-menu" class="col-md-12 col-sm-12 col-xs-12 margin-bottom-10">
                            <?php //if(false){
                                $params = CO2::getThemeParams();
                                foreach ($params["pages"] as $key => $value) {
                                    if(@$value["inMenu"]==true && @$value["open"]==true){ ?>
                                        <a href="javascript:;" data-hash="<?php echo $key; ?>" 
                                        class="<?php echo $key; ?>ModBtn lbh-menu-app btn btn-link pull-left btn-menu-to-app hidden-top link-submenu-header <?php if($subdomainName==$value["subdomainName"]) echo 'active'; ?>">
                                                
                                        <i class="fa fa-<?php echo $value["icon"]; ?>"></i>
                                        <span class=""><?php echo Yii::t("common", $value["subdomainName"]); ?></span>
                                        <span class="<?php echo @$value["notif"]; ?> topbar-badge badge animated bounceIn badge-warning"></span>
                                    </a>  
                                <?php   }
                                } ?>
                                <button class="btn btn-show-filters"><?php echo Yii::t("common", "Filters") ?> <i class="fa fa-angle-down"></i></button>
                        </div>
                        <div id="filters-nav" class="col-xs-12">
                            <ul id="filters-nav-list" class="no-padding no-margin">
                                <li class="dropdown dropdown-tags">
                                    <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left hidden-xs"  type="button" id="dropdownTags" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                                  title="<?php echo Yii::t("common","Tags") ?>" alt="<?php echo Yii::t("common","Tags") ?>"><?php echo Yii::t("common","Tags") ?> <i class="fa fa-angle-down"></i></a>
                                    <div class="dropdown-menu arrow_box" aria-labelledby="dropdownTags">
                                        <div class="form-group filterstags col-md-12 col-sm-12 col-xs-12 margin-top-20 no-padding">
                                            <input id="tags" type="" data-type="select2" name="tags" placeholder="#Tags" value="" style="width:100%;">       
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
                                    <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left hidden-xs"  type="button" id="dropdownThematics" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                                  title="<?php echo Yii::t("common","Choose a type") ?>" alt="<?php echo Yii::t("common","type") ?>"><?php echo Yii::t("common","Type") ?> <i class="fa fa-angle-down"></i></a>
                                    <div class="dropdown-menu arrow_box" aria-labelledby="dropdownTypes">
                                    </div>
                                </li>
                                <li class="dropdown dropdown-section">
                                    <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left hidden-xs"  type="button" id="dropdownSection" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                                  title="<?php echo Yii::t("common","Choose a section") ?>" alt="<?php echo Yii::t("common","Choose a section") ?>"><?php echo Yii::t("common","Sections") ?> <i class="fa fa-angle-down"></i></a>
                                    <div class="dropdown-menu arrow_box" aria-labelledby="dropdownSections">
                                    </div>
                                </li>
                                <li class="dropdown dropdown-category">
                                    <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left hidden-xs"  type="button" id="dropdownCategory" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                                  title="<?php echo Yii::t("common","Choose a category") ?>" alt="<?php echo Yii::t("common","Choose a category") ?>"><?php echo Yii::t("common","Category") ?> <i class="fa fa-angle-down"></i></a>
                                    <div class="dropdown-menu arrow_box" aria-labelledby="dropdownCategory">
                                    </div>
                                </li>
                                <li class="dropdown dropdown-subType">
                                    <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left hidden-xs"  type="button" id="dropdownSubType" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                                  title="<?php echo Yii::t("common","Choose a subcategory") ?>" alt="<?php echo Yii::t("common","Choose a subcategory") ?>"><?php echo Yii::t("common","Subcategory") ?> <i class="fa fa-angle-down"></i></a>
                                    <div class="dropdown-menu arrow_box" aria-labelledby="dropdownSubType">
                                    </div>
                                </li>
                                <li class="dropdown dropdown-price">
                                    <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left hidden-xs"  type="button" id="dropdownPrice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                                  title="<?php echo Yii::t("common","Range prices") ?>" alt="<?php echo Yii::t("common","Range prices") ?>"><?php echo Yii::t("common","Price") ?> <i class="fa fa-angle-down"></i></a>
                                    <div class="dropdown-menu arrow_box" aria-labelledby="dropdownPrice">
                                         <div class="form-group col-md-4 col-sm-4 col-xs-6">
                                            <label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="sectionBtn">
                                              <i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Min price") ?>
                                            </label>
                                            <input type="text" id="priceMin" name="priceMin" class="form-control" 
                                                   placeholder="<?php echo Yii::t("common","Max Min") ?>"/>
                                        </div>

                                          <div class="form-group col-md-4 col-sm-4 col-xs-6">
                                            <label class="col-md-12 col-sm-12 col-xs-12 text-left control-label no-padding" for="sectionBtn">
                                              <i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Max price") ?>
                                            </label>
                                            <input type="text" id="priceMax" name="priceMax" class="form-control col-md-5" 
                                                   placeholder="<?php echo Yii::t("common","Max price") ?>"/>
                                          </div>
                                            
                                          <div class="form-group col-md-2 col-sm-2 col-xs-12">
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
                                        <div class="form-group col-md-2 col-sm-2 col-xs-12 margin-top-10">
                                          <button class="btn btn-link bg-azure margin-top-15 btn-directory-type font-montserrat" data-type="classified">
                                            <i class="fa fa-search"></i> <span class="hidden-xs hidden-sm"><?php echo Yii::t("common","Search") ?></span>
                                          </button>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown dropdown-sources">
                                    <a href="javascript:;" class="dropdown-toggle menu-button btn-menu text-dark pull-left hidden-xs"  type="button" id="dropdownSources" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                                  title="<?php echo Yii::t("common","Select a source of data") ?>" alt="<?php echo Yii::t("common","Select a source of data") ?>"><?php echo Yii::t("common","Source data") ?> <i class="fa fa-angle-down"></i></a>
                                    <div class="dropdown-menu arrow_box" aria-labelledby="dropdownSources">
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    
                <!--</div>-->
            <!--</div>-->
        </div>
    </div>      

</header>
  
<?php } ?>
     
<script type="text/javascript">
    var filliaireCategories = <?php echo json_encode(@$filliaireCategories); ?>;
    var page="<?php echo $page ?>";
    jQuery(document).ready(function() {
        initScopeMenu();
        $(".tooltips").tooltip();
        $("#filters-nav-list .dropdown .dropdown-toggle").click(function(){
            offset=$(this).offset();
            addRule("#filters-nav-list .dropdown .dropdown-menu:after, #filters-nav-list .dropdown .dropdown-menu:before", "left:"+(offset.left-20)+"px !important");//.css({"left":offset.left+"px"});

        });
    });
    function initScopeMenu(type){   
        bindSearchCity();
        bindScopesInputEvent();
        countFavoriteScope();
        getCommunexionLabel();
    }
    (function ($) {
        window.addRule = function (selector, styles, sheet) {
          if (typeof styles !== "string") {
            var clone = "";
            for (var style in styles) {
              var val = styles[style];
              style = style.replace(/([A-Z])/g, "-$1").toLowerCase(); // convert to dash-case
              clone += style + ":" + (style === "content" ? '"' + val + '"' : val) + "; ";
            }
            styles = clone;
          }
          sheet = sheet || document.styleSheets[0];
          sheet.addRule(selector, styles);
          return this;
        };
        if ($) {
          $.fn.addRule = function (styles, sheet) {
            addRule(this.selector, styles, sheet);
            return this;
          };
        }
  }(window.jQuery));
</script>