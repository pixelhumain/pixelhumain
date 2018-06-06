<style>
    a.link-submenu-header{
        /*background-color: rgba(255, 255, 255, 0.8);
        border-radius: 10px;*/
        padding: 11px 10px;
        font-size: 12px;
        font-weight: bold;
    }
    a.link-submenu-header.active, 
    a.link-submenu-header:hover, 
    a.link-submenu-header:active{  
        border-bottom: 2px solid #ea4335;
        /*background-color: rgba(255, 255, 255, 1);*/
        color:#ea4335 !important;
        text-decoration: none;
    }

    .dropdown-menu.arrow_box{
        position: absolute !important;
        top: 51px;
        right: -65px;
        left: inherit;
        background-color: white;
        border: 1px solid transparent;
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
    }

    .btn-language{
        height: 35px;
        /*border-radius: 0% 50%;*/
        border:none;
        width: 50px;
    }


    .btn-star-fav {
        font-size: 18px;
        margin-top: 5px;
    }

    .menu-name-profil{
        margin-left:10px;
    }

    .navbar-nav .menu-button{
        width: 45px !important;
        margin-right: 0px;
        height: 30px;
        margin-top: 10px;
        font-size: 18px !important;
        padding:5px;
        position: relative;
    }
    .navbar-nav .menu-button:hover{
        color:grey !important;
    }
</style>
<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header pull-left">
           
            <a href="#welcome" class="btn btn-link menu-btn-back-category pull-left no-padding lbh" 
                <?php //if( $subdomain != "welcome" ) { echo 'data-target="#modalMainMenu" data-toggle="modal"' } ?>
            >
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGOS/CO2/logo-head-search.png" 
                     class="logo-menutop main pull-left hidden-xs hidden-sm" height=17>

                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGOS/CO2/logo-min.png" 
                     class="logo-menutop pull-left hidden-xs hidden-sm hidden-top" style="display: none!important;" height=20>

                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGOS/CO2/logo-min.png" 
                     class="logo-menutop pull-left visible-xs visible-sm" height=25>
            </a>
            <span class="hidden-xs skills font-montserrat"><?php echo Yii::t("common",$mainTitle); ?></span>
            <?php 
                //$params = CO2::getThemeParams();  
                /*$icon = "";
                // echo "params : "; var_dump($params);// exit; 
                foreach ($params["pages"] as $key => $value) {
                    if($subdomain==@$value["subdomain"]) {
                        $icon = @$value["icon"];
                    } 
                }
            <!--<i class="fa fa-<?php echo $icon; ?> hidden-top margin-top-15 margin-right-5 margin-left-10 pull-left text-red" 
                style="font-size:20px;"></i>-->
                */
            ?>
        </div>

        <?php if( $subdomain == "search" ||
                $subdomain == "ressource" ||
                $subdomain == "web" ||
                $subdomain == "territorial" ||
                  $subdomain == "agenda" ||
                  $subdomain == "live" ||
                  $subdomain == "power"  ||
                  $subdomain == "annonces"//||
                  //$subdomain == "admin"
                  //$subdomain == "page"
                 ){ ?>
        
            <div id="input-sec-search" class="hidden-xs col-sm-3 col-md-4 col-lg-4" style="display:none;">
                <input type="text" class="form-control" id="second-search-bar" 
                        placeholder="<?php echo Yii::t("common", "What are you looking for")." ?"; ?>">
                <?php //echo Yii::t("common", "search by name or by #tag, ex: 'commun' or '#commun"); ?>
                <?php if($subdomain == "page"){ ?>
                    <div class="dropdown-result-global-search hidden-xs col-sm-6 col-md-5 col-lg-5 no-padding"></div>
                <?php } ?>
            </div>
            <button class="btn btn-default hidden-xs pull-left menu-btn-start-search" style="display:none;" 
                    data-type="<?php echo @$type; ?>">
                    <i class="fa fa-search"></i>
            </button>
            <div id="filters-container-menu" class="no-padding hidden-xs">
                <ul class="filters-menu">
                    <li class="scope-header-filter tooltips" data-placement="bottom" data-original-title="<?php echo Yii::t("common", "Up for filters") ?>">
                     <i class="fa fa-angle-double-up"></i> 
                    </li>
                    <!--<li class="theme-header-filter tooltips" data-placement="bottom" data-original-title="<?php echo Yii::t("common", "Theme filter") ?>">
                     <i class="fa fa-tags"></i> 
                    </li>-->
                    
                </ul> 
            </div>
        <?php } ?>

        <?php if( $subdomain == "welcome" || $subdomain=="page" ){ ?>
        
            <div id="input-sec-search" class="hidden-xs col-sm-3 col-md-3 col-lg-4">
                <input type="text" class="form-control" id="second-search-bar" 
                        placeholder="<?php echo Yii::t("common", $placeholderMainSearch); ?>">
                    <div class="dropdown-result-global-search hidden-xs col-sm-6 col-md-5 col-lg-5 no-padding"></div>
            </div>
            <button class="btn btn-default hidden-xs pull-left menu-btn-start-search btn-directory-type" 
                    data-type="<?php echo @$type; ?>">
                    <i class="fa fa-search"></i>
            </button>

        <?php } ?>
        <button class="btn-show-map" style=""
                title="<?php echo Yii::t("common", "Show the map"); ?>"
                alt="<?php echo Yii::t("common", "Show the map"); ?>"
                >
            <i class="fa fa-map-marker"></i>
        </button>
        <?php if( !@Yii::app()->session['userId'] ){ ?>
            <div id="navbar" class="navbar-collapse pull-right navbar-right" style="margin-top: 8px;   margin-bottom: 5px;">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle btn btn-default btn-language padding-5" data-toggle="dropdown" role="button">
                    <img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/<?php echo Yii::app()->language ?>.png" width="22"/> <span class="caret"></span></a>
                    <ul class="dropdown-menu arrow_box" role="menu" style="">
                        <li><a href="javascript:;" onclick="setLanguage('en')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/en.png" width="25"/> <?php echo Yii::t("common","English") ?></a></li>
                        <li><a href="javascript:;" onclick="setLanguage('fr')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/fr.png" width="25"/> <?php echo Yii::t("common","French") ?></a></li>
                        <li><a href="javascript:;" onclick="setLanguage('de')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/de.png" width="25"/> <?php echo Yii::t("common","German") ?></a></li>
                    </ul>
                </li>
            </ul>
        </div> 
        <?php } ?>
        
        <!-- <button class="btn-show-mainmenu" title="Menu principal" data-target="#modalMainMenu" data-toggle="modal">
            <i class="fa fa-th tooltips" data-toggle="tooltip" data-placement="bottom" title="Menu principal"></i>
        </button> -->

        <?php if( isset( Yii::app()->session['userId']) ){ ?>
            <button class="btn-show-mainmenu btn btn-link" 
                    data-toggle="tooltip" data-placement="top" title="<?php echo Yii::t("common","Menu") ?>">
                <i class="fa fa-bars tooltips" ></i>
            </button>

             <div class="dropdown pull-right" id="dropdown-user">
                <div class="dropdown-main-menu">
                    <ul class="dropdown-menu arrow_box">
                        <!-- <li class="text-left">
                            <a href="#page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>" 
                                class="lbh bg-white">
                                <i class="fa fa-user-circle"></i> Ma page
                            </a>
                        </li> -->
                        <!-- <li class="text-left">
                            <a href="#social" class="lbh bg-white">
                                <i class="fa fa-university"></i> Ma commune
                            </a>
                        </li> -->
                        <!-- </li> -->
                        <!-- <li class="text-left">
                            <a href="#search" class="lbh bg-white">
                                <i class="fa fa-connectdevelop"></i> Mon conseil citoyen
                            </a>
                        </li> -->
                         <!-- <li class="text-admin visible-xs">
                            <a href="#page.type.<?php echo Person::COLLECTION ?>.id.<?php echo Yii::app()->session["userId"] ?>.view.notifications" class="lbh bg-white">
                                <i class="fa fa-bell"></i> <?php echo Yii::t("common", "My notifications") ; ?>
                                <span class="notifications-count topbar-badge badge animated bounceIn 
                                    <?php if(!@$countNotifElement || (@$countNotifElement && $countNotifElement=="0")) 
                                    echo 'badge-transparent hide'; else echo 'badge-success'; ?>"
                                >
                                <?php echo @$countNotifElement ?>
                                </span>
                            </a>
                        </li>
                       
                        <li role="separator" class="divider visible-xs"></li> -->
                        <li class="text-admin menu-lang dropdown-submenu dropdown-menu-left">
                            <a href="javascript:;" class="bg-white">
                                <i class="fa fa-language"></i> <?php echo Yii::t("common", "Languages") ; ?>
                            </a>
                            <ul class="dropdown-menu">
                              <li><a href="javascript:;" onclick="setLanguage('en')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/en.png"/><span class="hidden-xs"><?php echo Yii::t("common","English") ?></span></a></li>
                              <li><a href="javascript:;" onclick="setLanguage('fr')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/fr.png"/><span class="hidden-xs"><?php echo Yii::t("common","French") ?></span></a></li>
                              <li><a href="javascript:;" onclick="setLanguage('de')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/de.png"/><span class="hidden-xs"><?php echo Yii::t("common","German") ?></span></a></li>
                            </ul>
                        </li>

                        <!-- <li role="separator" class="divider"></li>
                        <li class="text-left">
                            <a href="#page.type.<?php echo Person::COLLECTION ?>.id.<?php echo Yii::app()->session["userId"] ?>" class="lbh bg-white">
                                <i class="fa fa-user-circle"></i> <?php echo Yii::t("common","My page") ?>
                            </a>
                        </li> -->

                          <?php 
                            $class = "hidden" ;
                            if( empty($me) || empty($me["address"]) || empty($me["address"]["codeInsee"]))
                                $class = "";
                        ?>
                        <li role="separator" class="divider <?php echo $class ; ?>"></li>
                        <li class="text-left">
                            <a href="" class="communecter-btn bg-white <?php echo $class ; ?>" onclick="communecterUser();">
                                <i class="fa fa-university"></i> <?php echo Yii::t("common", "Connect to your city");?>
                            </a>
                        </li>
                        

                        <li role="separator" class="divider visible-xs"></li>
                        
                         <li class="text-left visible-xs">
                            <a href="#search" class="lbh bg-white letter-red">
                                <i class="fa fa-search"></i> <?php echo Yii::t("common", "Search") ?>
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#live" class="lbh bg-white letter-red">
                                <i class="fa fa-calendar"></i> <?php echo Yii::t("common", "In live") ?>
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#agenda" class="lbh bg-white letter-red">
                                <i class="fa fa-calendar"></i> <?php echo Yii::t("common", "Agenda") ?>
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#annonces" class="lbh bg-white letter-red">
                                <i class="fa fa-bullhorn"></i> <?php echo Yii::t("common", "Market place") ?>
                            </a>
                        </li>
                        
                        <li class="text-left visible-xs">
                            <a href="#ressources" class="lbh bg-white letter-red">
                                <i class="fa fa-cubes"></i> <?php echo Yii::t("common", "Sharing") ?>
                            </a>
                        </li>

                        <!--<li role="separator" class="divider"></li>
                        <li class="text-left">
                            <a href="#default.view.page.links" class="lbhp bg-right">
                                <i class="fa fa-life-ring"></i> <?php echo Yii::t("common", "Help") ?>
                            </a>
                        </li>-->

                        <li role="separator" class="divider"></li>
                        <li class="">
                            <a href="#info.p.stats" class="bg-white disabled lbh">
                                <i class="fa fa-bar-chart"></i> <?php echo Yii::t("common","Statistics"); ?>
                            </a>
                        </li> 

                        <li role="separator" class="divider"></li>
                        <li class="text-left">
                            <!--#default.view.page.links-->
                            <a href="#docs.page.welcome.dir.<?php echo Yii::app()->language ?>" class="lbh bg-right">
                                <i class="fa fa-book"></i> <?php echo Yii::t("common", "Documentation") ?>
                            </a>
                        </li>

                        <li role="separator" class="divider"></li>
                        <li class="text-left">
                            
                            <a href="https://www.helloasso.com/associations/open-atlas/collectes/communecter/don" target="_blank" class="bg-right">
                                <i class="fa fa-heart"></i> <?php echo Yii::t("common", "Recurring donation") ?>
                            </a>
                        </li>
                       

                        
                        <?php if( Yii::app()->session["userIsAdmin"] || Yii::app()->session[ "userIsAdminPublic" ]) { 
                            $label=(Yii::app()->session["userIsAdmin"]) ? Yii::t("common", "Admin") : Yii::t("common", "Admin public");  
                            ?>
                            <li role="separator" class="divider"></li>
                            <li class="text-admin">
                                <a href="#admin" class="lbh bg-white">
                                    <i class="fa fa-user-secret"></i> <?php echo $label ; ?>
                                </a>
                            </li>
                        <?php } ?>


                        <li role="separator" class="divider"></li>
                        <li class="text-admin">
                            <a href="#settings" class="lbh bg-white">
                                <i class="fa fa-cogs"></i> <?php echo Yii::t("common", "My parameters") ; ?>
                            </a>
                        </li>

                        <li role="separator" class="divider"></li>
                        <li class="text-left">
                            <a href="<?php echo Yii::app()->createUrl('/co2/person/logout'); ?>" 
                                class="bg-white letter-red logout">
                                <i class="fa fa-sign-out"></i> <?php echo Yii::t("common", "Log Out") ; ?>
                            </a>
                        </li>


                    </ul>
                </div>
            </div>



        <?php } ?>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="pull-right navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php 
                    if( isset( Yii::app()->session['userId']) ){
                      $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->getParentAssetsUrl());
                      $countNotifElement = ActivityStream::countUnseenNotifications(Yii::app()->session["userId"], Person::COLLECTION, Yii::app()->session["userId"]);
                ?> 
                     <!-- #page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?> -->
                    <a  href="#page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>"
                        class="menu-name-profil lbh text-dark pull-right shadow2" 
                        data-toggle="dropdown">
                            <small class="hidden-xs hidden-sm margin-left-10" id="menu-name-profil">
                                <?php echo @$me["name"] ? $me["name"] : @$me["username"]; ?>
                            </small> 
                            <img class="img-circle" id="menu-thumb-profil" 
                                 width="40" height="40" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
                    </a>
                    <!--<a href="https://www.helloasso.com/associations/open-atlas/collectes/communecter/don" target="_blank" class="menu-button btn-menu btn-link pull-right hidden-xs" style="color : #E5344D;"
                          data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("common","Recurring donation") ?>" 
                          alt="<?php echo Yii::t("common","Recurring donation") ?>">
                      <i class="fa fa-heart "></i>
                    </a>-->
                   <button class="menu-button btn-menu btn-link btn-open-floopdrawer text-dark pull-right hidden-xs" 
                          data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("common","My network") ?>" 
                          alt="<?php echo Yii::t("common","My network") ?>">
                      <i class="fa fa-users"></i>
                    </button>
                    <button class="menu-button btn-menu btn-menu-notif text-dark pull-right" 
                          data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("common","Notifications") ?>" alt="<?php echo Yii::t("common","Notifications") ?>">
                      <i class="fa fa-bell"></i>
                      <span class="notifications-count topbar-badge badge animated bounceIn 
                              <?php if(!@$countNotifElement || (@$countNotifElement && $countNotifElement=="0")) 
                              echo 'badge-transparent hide'; else echo 'badge-success'; ?>">
                            <?php echo @$countNotifElement ?>
                        </span>
                    </button>
                    <?php if(@$me && @$me["links"] && (@$me["links"]["memberOf"] || @$me["links"]["contributors"])){ ?>
                    <button class="menu-button btn-menu btn-dashboard-dda text-dark pull-right hidden-xs" 
                          data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("common","Cooperation") ?>" 
                          alt="<?php echo Yii::t("common","Cooperation") ?>">
                      <i class="fa fa-inbox"></i>
                      <span class="coopNotifs topbar-badge badge animated bounceIn badge-warning"></span>
                    </button>
                    <?php } ?>

                     <div class="dropdown pull-right" id="dropdown-dda">
                        <div class="dropdown-main-menu">
                            <ul class="dropdown-menu arrow_box menuCoop" id="list-dashboard-dda">
                                
                            </ul>
                        </div>
                    </div>
                    
                    

                    <button class="menu-button btn-menu btn-menu-chat text-dark pull-right hidden-xs" 
                          onClick='rcObj.loadChat("","citoyens", true, true)' data-toggle="tooltip" data-placement="bottom" 
                          title="<?php echo Yii::t("common","Messaging") ?>" alt="<?php echo Yii::t("common","Messaging") ?>">
                      <i class="fa fa-comments"></i>
                      <span class="chatNotifs topbar-badge badge animated bounceIn badge-warning"></span>
                    </button>


                    
                    <span class="dropdown" id="dropdown-apps">
                        <button class="dropdown-toggle menu-button btn-menu btn-menu-apps text-dark pull-right hidden-xs"  type="button" id="dropdownApps" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                              title="<?php echo Yii::t("common","Applications") ?>" alt="<?php echo Yii::t("common","Applications") ?>">
                          <i class="fa <?php echo Application::ICON ?> letter-red"></i>
                        </button>
                        <div class="dropdown-menu arrow_box" aria-labelledby="dropdownApps">
                            <a class="dropdown-item padding-5 text-center col-xs-6 lbh" href="#search" data-toggle="tooltip" data-placement="bottom" ><i class="fa <?php echo Search::ICON ?> fa-2x"></i><br/><?php echo Yii::t("common","Search") ?></a>
                            <a class="dropdown-item padding-5 text-center col-xs-6 lbh" href="#live" data-toggle="tooltip" data-placement="bottom" ><i class="fa <?php echo News::ICON2 ?> fa-2x"></i><br/><?php echo Yii::t("common","In live") ?></a>
                            <a class="dropdown-item padding-5 text-center col-xs-6 lbh" href="#agenda" data-toggle="tooltip" data-placement="bottom"><i class="fa <?php echo Event::ICON ?> fa-2x"></i><br/><?php echo Yii::t("common","Agenda") ?></a>
                            <a class="dropdown-item padding-5 text-center col-xs-6 lbh" href="#annonces" data-toggle="tooltip" data-placement="bottom"><i class="fa <?php echo Classified::ICON ?> fa-2x"></i><br/><?php echo Yii::t("common","Market place") ?></a>
                            <a class="dropdown-item padding-5 text-center col-xs-6 lbh" href="#ressources" data-toggle="tooltip" data-placement="bottom"><i class="fa <?php echo Ressource::ICON ?> fa-2x"></i><br/><?php echo Yii::t("common","Sharing") ?></a>
                        </div>
                    </span>


                <?php } else { ?>

                 <!-- <span class="dropdown pull-left" id="dropdown-apps">
                        <button class="dropdown-toggle menu-button btn-menu btn-menu-apps text-dark pull-right hidden-xs"  type="button" id="dropdownApps" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                              title="<?php echo Yii::t("common","Applications") ?>" alt="<?php echo Yii::t("common","Applications") ?>" style="margin-top: 8px;">
                          <i class="fa <?php echo Application::ICON ?> letter-red"></i>
                        </button>
                        <div class="dropdown-menu arrow_box" aria-labelledby="dropdownApps" style="top: 55px;right: -101px;">
                            <a class="dropdown-item padding-5 text-center col-xs-6 lbh" href="#search" data-toggle="tooltip" data-placement="bottom" ><i class="fa <?php echo Search::ICON ?> fa-2x"></i><br/><?php echo Yii::t("common","Search") ?></a>
                            <a class="dropdown-item padding-5 text-center col-xs-6 lbh" href="#live" data-toggle="tooltip" data-placement="bottom" ><i class="fa <?php echo News::ICON2 ?> fa-2x"></i><br/><?php echo Yii::t("common","In live") ?></a>
                            <a class="dropdown-item padding-5 text-center col-xs-6 lbh" href="#agenda" data-toggle="tooltip" data-placement="bottom"><i class="fa <?php echo Event::ICON ?> fa-2x"></i><br/><?php echo Yii::t("common","Agenda") ?></a>
                            <a class="dropdown-item padding-5 text-center col-xs-6 lbh" href="#annonces" data-toggle="tooltip" data-placement="bottom"><i class="fa <?php echo Classified::ICON ?> fa-2x"></i><br/><?php echo Yii::t("common","Market place") ?></a>
                            <a class="dropdown-item padding-5 text-center col-xs-6 lbh" href="#ressources" data-toggle="tooltip" data-placement="bottom"><i class="fa <?php echo Ressource::ICON ?> fa-2x"></i><br/><?php echo Yii::t("common","Sharing") ?></a>
                        </div>
                    </span> -->

                    <li class="pull-right">
                        <?php //if($subdomain != "welcome"){ ?>
                            <button class="letter-green font-montserrat btn-menu-connect margin-left-10 margin-right-10" 
                                    data-toggle="modal" data-target="#modalLogin" style="font-size: 19px; margin-top:11px;">
                                    <i class="fa fa-sign-in"></i> 
                                    <span class="hidden-xs"><small style="width:70%;"><?php echo Yii::t("login", "LOG IN") ?></small></span>
                            </button>
                        <?php //} else { ?>
                            <!-- <div class="hidden-xs hidden-sm append-md-login"> -->
                            <?php   //$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
                                    //$this->renderPartial($layoutPath.'forms.'.Yii::app()->params["CO2DomainName"].'.login'); 
                            ?>
                            <!-- </div> -->
                        <?php //} ?>
                    </li>


                   <!--  <button class="btn btn-default btn-sm letter-red tooltips pull-right font-montserrat" 
                        id="btn-radio" style=" margin-top:10px;"  
                        data-target="#modalRadioTool" data-toggle="modal"
                        data-placement="bottom" title="Radio Pixel-Humain">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/radio-ico.png" height="25">
                    </button> -->
                    
                    <!--<li class="pull-right">
                        <a href="#info.p.stats" class="lbh padding-5" style="margin-top:8px;">
                            <i class="fa fa-bar-chart"></i> stat
                        </a>
                    </li>--> 
                <?php } ?>
            </ul>
            <?php if (!@Yii::app()->session["userId"] && $subdomain == "welcome"){ ?>
                <!--<button class="visible-xs visible-sm letter-green font-montserrat btn-menu-connect margin-top-10" 
                        data-toggle="modal" id="open-login-xs" style="font-size:20px;">
                    <span><i class="fa fa-sign-in"></i></span>
                </button>
                <div class="visible-xs visible-sm append-small-login hidden"></div>-->
            <?php } ?>
        </div>

        <?php if($subdomain == "web"){ ?>
            <button class="btn btn-link letter-yellow tooltips btn-star-fav pull-right font-montserrat"  
                    data-placement="bottom" title="Gérer vos favoris"
                    data-target="#modalFavorites" data-toggle="modal"><i class="fa fa-star"></i>
            </button>   
        <?php }//else{ ?>



        <?php //if( $subdomain == "welcome" || $subdomain=="page" ){ ?>
        <!-- <a href="#search" class="lbh text-red bg-white padding-5 pull-right" id="btn-territorial-modules">
         <i class="fa fa-search"></i> <?php echo Yii::t("common", "Co.<span class='text-dark'>search</span> Engine") ?>
         </a> -->
        <?php //} ?>
        <?php if (!@Yii::app()->session["userId"]){ ?>
            <button class="btn-show-mainmenu btn btn-link visible-xs pull-right" 
                    data-toggle="tooltip" data-placement="left" title="Menu" style="padding: 4px 10px;">
                <i class="fa fa-bars tooltips" ></i>
            </button>
            <div class="dropdown pull-right" id="dropdown-user">
                <div class="dropdown-main-menu" style="right:50px !important;">
                    <ul class="dropdown-menu arrow_box">
                         <li class="text-left visible-xs">
                            <a href="#search" class="lbh bg-white text-red">
                                <i class="fa fa-search"></i> <?php echo Yii::t("common", "Search") ?>
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#annonces" class="lbh bg-white text-red">
                                <i class="fa fa-bullhorn"></i> <?php echo Yii::t("common", "Ads") ?>
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#agenda" class="lbh bg-white text-red">
                                <i class="fa fa-calendar"></i> <?php echo Yii::t("common", "Agenda") ?>
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#live" class="lbh bg-white text-red">
                                <i class="fa fa-calendar"></i> <?php echo Yii::t("common", "Live") ?>
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#default.view.page.links" class="lbhp text-red bg-right">
                                <i class="fa fa-life-ring"></i> <?php echo Yii::t("common", "Help") ?>
                            </a>
                        </li>
                        <!--<li role="separator" class="divider"></li>
                        <li class="text-admin dropdown-submenu dropdown-menu-left">
                            <a href="javascript:;" class="bg-white">
                                <i class="fa fa-language"></i> <?php echo Yii::t("common", "Languages") ; ?>
                            </a>
                            <ul class="dropdown-menu">
                              <li><a href="javascript:;" onclick="setLanguage('en')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/en.png"/><?php echo Yii::t("common","English") ?></a></li>
                              <li><a href="javascript:;" onclick="setLanguage('fr')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/fr.png"/><?php echo Yii::t("common","French") ?></a></li>
                            </ul>
                        </li>-->
                    </ul>
                </div>
            </div>
        <?php } ?>
        <!-- /.navbar-collapse -->
        
        <?php 
           /* if($subdomainName != "web") foreach (array_reverse($params["pages"]) as $key => $value) {
                if(@$value["inMenu"]==true && @$value["open"]==true){ ?>
                <a href="<?php echo $key; ?>" 
                    class="<?php echo $key; ?>ModBtn lbh btn btn-link letter-red pull-right btn-menu-to-app hidden-top hidden-xs
                            <?php if($subdomainName==$value["subdomainName"]) echo 'active'; ?> tooltips"
                    data-placement="bottom" data-original-title="<?php echo Yii::t("common",$value["subdomainName"]); ?>">
                    <i class="fa fa-<?php echo $value["icon"]; ?>"></i>

                    <!-- <span class=""><?php echo $value["subdomainName"]; ?></span> -->
                    <?php if(@$value["notif"]){ ?>
                    <span class="<?php echo $value["notif"]; ?> topbar-badge badge animated bounceIn badge-warning"></span>
                    <?php } ?>
                </a>  
        <?php   }
            } */ ?>
            
    </div>
    <!-- /.container-fluid -->

</nav>
<?php   $this->renderPartial($layoutPath.'loginRegister', array("subdomain" => $subdomain)); 
       ?>

<?php if(isset(Yii::app()->session['userId'])) 
        $this->renderPartial($layoutPath.'notifications'); ?>

<?php $this->renderPartial($layoutPath.'formCreateElement'); ?>

