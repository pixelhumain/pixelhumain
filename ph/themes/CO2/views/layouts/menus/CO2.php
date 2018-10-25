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

/*    .dropdown-menu.arrow_box{
        position: absolute !important;
        top: 51px;
        right: -65px;
        left: inherit;
        background-color: white;
        border: 1px solid transparent;
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
    }*/

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
    #mainNav.vertical{
        box-shadow: 0px 2px 3px -3px rgba(0,0,0,0.5);
        border-bottom: 1px solid #dadada;
    }
</style>
<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom <?php echo $menuApp ?>">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header pull-left">
           
            <a href="#welcome" class="btn btn-link menu-btn-back-category pull-left no-padding lbh" >
    
                <?php 
                $logo = (@Yii::app()->session['custom']["logo"]) ? Yii::app()->session['custom']["logo"] : Yii::app()->theme->baseUrl."/assets/img/LOGOS/CO2/logo-min.png";
                ?>
                <img src="<?php echo $logo;?>" class="logo-menutop pull-left" height=25>
            </a>
        </div>
        <?php if( $subdomain == "search" ||
                $subdomain == "ressource" ||
                $subdomain == "web" ||
                $subdomain == "territorial" ||
                  $subdomain == "agenda" ||
                  $subdomain == "live" ||
                  $subdomain == "power"  ||
                  $subdomain == "interop"  ||
                  $subdomain == "annonces"//||
                  //$subdomain == "admin"
                  //$subdomain == "page"
                 ){ ?>
            <div class="hidden-xs col-sm-4 col-md-4 col-lg-4 margin-top-5" style="padding: 0px 10px;">
                <input type="text" class="form-control pull-left main-search-bar" id="main-search-bar" placeholder="<?php echo Yii::t("common", "What are you looking for")." ?"; ?>">
                <span class="text-white input-group-addon pull-left main-search-bar-addon" id="main-search-bar-addon">
                    <i class="fa fa-arrow-circle-right"></i>
                </span>
            </div>
            <button class="btn hidden-xs pull-left menu-btn-scope-filter text-red elipsis margin-right-10"
                    data-type="<?php echo @$type; ?>">
                    <i class="fa fa-map-marker"></i> <span class="header-label-scope"><?php echo Yii::t("common","where ?") ?></span>
            </button>
             <button class="btn btn-show-filters hidden-xs"> <i class="fa fa-filter visible-sm pull-left" style="font-size:18px;"></i><span class="hidden-sm"><?php echo Yii::t("common", "Filters") ?></span> <span class="topbar-badge badge animated bounceIn badge-warning"></span> <i class="fa fa-angle-down"></i></button>
        <?php } ?>

        <?php if( $subdomain == "welcome" || $subdomain=="page" ){ ?>
        
            <div id="input-sec-search" class="hidden-xs col-sm-3 col-md-3 col-lg-4">
                <input type="text" class="form-control" id="second-search-bar" 
                        placeholder="<?php echo Yii::t("common", $placeholderMainSearch); ?>">
                    <div class="dropdown-result-global-search hidden-xs col-sm-6 col-md-5 col-lg-5 no-padding"></div>
            </div>
        <?php } ?>
        <!--Button to whow the map on horizontal map -->
        <button class="btn-show-map" style=""
                title="<?php echo Yii::t("common", "Show the map"); ?>"
                alt="<?php echo Yii::t("common", "Show the map"); ?>"
                >
            <i class="fa fa-map-marker"></i>
        </button>
        <!-- button of languages selection if not connected -->
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
                            <li><a href="javascript:;" onclick="setLanguage('it')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/it.png" width="25"/> <?php echo Yii::t("common","Italian") ?></a></li>
                        </ul>
                    </li>
                </ul>
            </div> 
        <?php } if( isset( Yii::app()->session['userId']) ){ ?>
            <button class="btn-show-mainmenu btn btn-link" 
                    data-toggle="tooltip" data-placement="top" title="<?php echo Yii::t("common","Menu") ?>">
                <i class="fa fa-bars tooltips" ></i>
            </button>


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

                    <button class="menu-button btn-menu btn-menu-chat text-dark pull-right hidden-xs" 
                          onClick='rcObj.loadChat("","citoyens", true, true)' data-toggle="tooltip" data-placement="bottom" 
                          title="<?php echo Yii::t("common","Messaging") ?>" alt="<?php echo Yii::t("common","Messaging") ?>">
                      <i class="fa fa-comments"></i>
                      <span class="chatNotifs topbar-badge badge animated bounceIn badge-warning"></span>
                    </button>
                    <a href="#myhome" class="lbh menu-button btn-menu btn-menu-chat text-dark pull-right " 
                           data-toggle="tooltip" data-placement="bottom" 
                          title="<?php echo Yii::t("common","Home") ?>" alt="<?php echo Yii::t("common","Home") ?>" style="width: inherit !important;text-transform: capitalize;">
                      <i class="fa fa-home"></i> <span class="hidden-xs hidden-sm" style="font-size: 16px;"><?php echo Yii::t("common","Home") ?></span>
                    </a>


                    
                    <span class="dropdown dropdownApps" id="dropdown-apps">
                        <button class="dropdown-toggle menu-button btn-menu btn-menu-apps text-dark pull-right"  type="button" id="dropdownApps" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" data-placement="bottom" 
                              title="<?php echo Yii::t("common","Applications") ?>" alt="<?php echo Yii::t("common","Applications") ?>">
                          <i class="fa <?php echo Application::ICON ?> letter-red"></i>
                        </button>
                    </span>


                <?php } else { ?>
                    <li class="pull-right">
                            <button class="letter-green font-montserrat btn-menu-connect margin-left-10 margin-right-10" 
                                    data-toggle="modal" data-target="#modalLogin" style="font-size: 17px; margin-top:12px;">
                                    <i class="fa fa-sign-in"></i> 
                                    <span class="hidden-xs"><small style="width:70%;"><?php echo Yii::t("login", "LOG IN") ?></small></span>
                            </button>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <?php if($subdomain == "web"){ ?>
            <button class="btn btn-link letter-yellow tooltips btn-star-fav pull-right font-montserrat"  
                    data-placement="bottom" title="Gérer vos favoris"
                    data-target="#modalFavorites" data-toggle="modal"><i class="fa fa-star"></i>
            </button>   
        <?php }
        if (!@Yii::app()->session["userId"]){ ?>
            <button class="btn-show-mainmenu btn btn-link visible-xs pull-right" 
                    data-toggle="tooltip" data-placement="left" title="Menu" style="padding: 4px 10px;">
                <i class="fa fa-bars tooltips" ></i>
            </button>
            <div class="dropdown pull-right" id="dropdown-user">
                <div class="dropdown-main-menu" style="right:50px !important;">
                    <ul class="dropdown-menu arrow_box">
                         <li class="text-left visible-xs">
                            <a href="javascript:;" data-hash="#search" class="lbh-menu-app bg-white text-red">
                                <i class="fa fa-search"></i> <?php echo Yii::t("common", "Search") ?>
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="javascript:;" data-hash="#live" class="lbh-menu-app bg-white text-red">
                                <i class="fa fa-calendar"></i> <?php echo Yii::t("common", "Live") ?>
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="javascript:;" data-hash="#agenda" class="lbh-menu-app bg-white text-red">
                                <i class="fa fa-calendar"></i> <?php echo Yii::t("common", "Agenda") ?>
                            </a>
                        </li>
                         <li class="text-left visible-xs">
                            <a href="javascript:;" data-hash="#annonces" class="lbh-menu-app bg-white text-red">
                                <i class="fa fa-bullhorn"></i> <?php echo Yii::t("common", "Ads") ?>
                            </a>
                        </li>
                       
                        <li class="text-left visible-xs">
                            <a href="#default.view.page.links" class="lbhp text-red bg-right">
                                <i class="fa fa-life-ring"></i> <?php echo Yii::t("common", "Help") ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php } ?>
        <!-- /.navbar-collapse -->            
    </div>
    <!-- /.container-fluid -->
</nav>
<!-- DROPDOWNS OF MENUTOP -->
<div class="dropdown dropdownApps-menuTop" aria-labelledby="dropdownApps">
    <div class="dropdown-main-menu">
        <div class="dropdown-menu arrow_box">
            <a class="dropdown-item padding-5 text-center col-xs-6 lbh-menu-app" href="javascript:;" data-hash="#search" data-toggle="tooltip" data-placement="bottom" ><i class="fa <?php echo Search::ICON ?> fa-2x"></i><br/><span class="searchModSpan"><?php echo Yii::t("common","All") ?></span></a>
            <a class="dropdown-item padding-5 text-center col-xs-6 lbh-menu-app" href="javascript:;" data-hash="#live" data-toggle="tooltip" data-placement="bottom" ><i class="fa <?php echo News::ICON2 ?> fa-2x"></i><br/><span class="liveModSpan"><?php echo Yii::t("common","News feed") ?></span></a>
            <a class="dropdown-item padding-5 text-center col-xs-6 lbh-menu-app" href="javascript:;" data-hash="#agenda" data-toggle="tooltip" data-placement="bottom"><i class="fa <?php echo Event::ICON ?> fa-2x"></i><br/><span class="agendaModSpan"><?php echo Yii::t("common","Events") ?></span></a>
            <a class="dropdown-item padding-5 text-center col-xs-6 lbh-menu-app" href="javascript:;" data-hash="#annonces" data-toggle="tooltip" data-placement="bottom"><i class="fa <?php echo Classified::ICON ?> fa-2x"></i><br/><span class="annoncesModSpan"><?php echo Yii::t("common","Classifieds") ?></span></a>
        </div>
    </div>
</div>
 <div class="dropdown pull-right" id="dropdown-dda">
    <div class="dropdown-main-menu">
        <ul class="dropdown-menu arrow_box menuCoop" id="list-dashboard-dda">
            
        </ul>
    </div>
</div>
<?php if(@Yii::app()->session["userId"]){ ?>
 <div class="dropdown pull-right" id="dropdown-user">
    <div class="dropdown-main-menu">
        <ul class="dropdown-menu arrow_box">
            <li class="text-admin menu-lang dropdown-submenu dropdown-menu-left">
                <a href="javascript:;" class="bg-white">
                    <i class="fa fa-language"></i> <?php echo Yii::t("common", "Languages") ; ?>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="javascript:;" onclick="setLanguage('en')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/en.png"/><span class="hidden-xs"><?php echo Yii::t("common","English") ?></span></a></li>
                  <li><a href="javascript:;" onclick="setLanguage('fr')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/fr.png"/><span class="hidden-xs"><?php echo Yii::t("common","French") ?></span></a></li>
                  <li><a href="javascript:;" onclick="setLanguage('de')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/de.png"/><span class="hidden-xs"><?php echo Yii::t("common","German") ?></span></a></li>
                  <li><a href="javascript:;" onclick="setLanguage('it')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/it.png"/><span class="hidden-xs"><?php echo Yii::t("common","Italian") ?></span></a></li>
                </ul>
            </li>

              <?php 
                $class = "hidden" ;
                if( empty($me) || empty($me["address"]) || empty($me["address"]["codeInsee"]))
                    $class = "";
            ?>
            <li role="separator" class="divider communexion-btn <?php echo $class ; ?>"></li>
            <li class="text-left communexion-btn">
                <a href="" class="communecter-btn bg-white <?php echo $class ; ?>" onclick="communecterUser();">
                    <i class="fa fa-university"></i> <?php echo Yii::t("common", "Connect to your city");?>
                </a>
            </li>
            

            <li role="separator" class="divider visible-xs"></li>
            
             <li class="text-left visible-xs">
                <a href="#search" class="lbh bg-white letter-red">
                    <i class="fa fa-search"></i> <span class="searchModSpan"><?php echo Yii::t("common", "All") ?></span>
                </a>
            </li>
            <li class="text-left visible-xs">
                <a href="#live" class="lbh bg-white letter-red">
                    <i class="fa fa-calendar"></i> <span class="liveModSpan"><?php echo Yii::t("common", "News feed") ?></span>
                </a>
            </li>
            <li class="text-left visible-xs">
                <a href="#agenda" class="lbh bg-white letter-red">
                    <i class="fa fa-calendar"></i> <span class="agendaModSpan"><?php echo Yii::t("common", "Events") ?></span>
                </a>
            </li>
            <li class="text-left visible-xs">
                <a href="#annonces" class="lbh bg-white letter-red">
                    <i class="fa fa-bullhorn"></i> <span class="annoncesModSpan"><?php echo Yii::t("common", "Classifieds") ?></span>
                </a>
            </li>

            <li role="separator" class="divider statistics-btn"></li>
            <li class="statistics-btn">
                <a href="#info.p.stats" class="bg-white disabled lbh">
                    <i class="fa fa-bar-chart"></i> <?php echo Yii::t("common","Statistics"); ?>
                </a>
            </li> 

            <li role="separator" class="divider documentation-btn"></li>
            <li class="text-left documentation-btn">
                <!--#default.view.page.links-->
                <a href="#docs.page.welcome.dir.<?php echo Yii::app()->language ?>" class="lbh bg-right">
                    <i class="fa fa-book"></i> <?php echo Yii::t("common", "Documentation") ?>
                </a>
            </li>

            <li role="separator" class="divider donation-btn"></li>
            <li class="text-left donation-btn">
                
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
                <a href="#page.type.<?php echo Person::COLLECTION ?>.id.<?php echo Yii::app()->session["userId"] ?>.view.settings" class="lbh bg-white">
                    <i class="fa fa-cogs"></i> <?php echo Yii::t("common", "My parameters") ; ?>
                </a>
            </li>

            <li role="separator" class="divider"></li>
            <li class="text-left">
                <?php 
                    $url = '/co2/person/logout';
                ?>
                <a href="<?php echo Yii::app()->createUrl($url); ?>" 
                    class="bg-white letter-red logout">
                    <i class="fa fa-sign-out"></i> <?php echo Yii::t("common", "Log Out") ; ?>
                </a>
            </li>


        </ul>
    </div>
</div>
<?php } 

$this->renderPartial($layoutPath.'loginRegister', array("subdomain" => $subdomain)); 

if(isset(Yii::app()->session['userId'])) 
    $this->renderPartial($layoutPath.'notifications'); 

$this->renderPartial($layoutPath.'formCreateElement'); ?>

