<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header pull-left">
            <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button> -->

            <!-- <img src="img/NC_map.png" class="nc_map_min" height=30> -->
            <a href="#k.web" class="btn-scroll menu-btn-back-category" data-targetid="#page-top">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/logocagou-<?php echo $subdomain; ?>.png" 
                     class="nc_map pull-left" height=30>
            </a>
            <span class="hidden-xs skills font-montserrat"><?php echo $mainTitle; ?></span>

            <a class="navbar-brand font-blackoutM btn-scroll hidden-sm menu-btn-back-category" data-targetid="#page-top" href="#k.web">
                <span class="letter letter-blue font-ZILAP letter-k">K</span>
                <!-- <span class="letter letter-blue font-ZILAP">A</span> -->
                 <span class="letter letter-yellow">G</span>
                <span class="letter letter-yellow font-ZILAP">O</span>
                <span class="letter letter-yellow">U</span>
                <span class="letter letter-green">G</span>
                <span class="letter letter-green">L</span>
                <span class="letter letter-green">E</span>
                <small class="letter letter-red pastille font-blackoutT"><?php echo $subdomain; ?></small>
            </a>
        </div>

        <?php if($subdomain == "live"){ ?>
            <!-- <div class="col-xs-8 col-sm-5 col-md-7 col-lg-6 hidden-top scopes hidden">
                <input type="text" class="form-control" id="second-search-bar" placeholder="Que recherchez vous ?">
                <button class="btn text-red bg-white btn-scope"><i class="fa fa-circle-o"></i> Nouméa</button>
                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province Sud</button>
                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province Nord</button>
                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province des Îles</button>
                <button class="btn text-white bg-red btn-scope"><i class="fa fa-plus"></i></button>
            </div> -->
            <div class="hidden-xs col-sm-5 col-md-4 col-lg-4">
                <input type="text" class="form-control" id="second-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
            </div>
            <button class="btn btn-default hidden-xs pull-left menu-btn-start-search"><i class="fa fa-search"></i></button>
        
        <?php }elseif($subdomain == "web"){ ?>
            
            <div class="hidden-xs col-sm-5 col-md-4 col-lg-4">
                <input type="text" class="form-control" id="second-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
            </div>
            <button class="btn btn-default hidden-xs pull-left menu-btn-start-search"><i class="fa fa-search"></i></button>

            <!-- <button class="btn btn-default pull-left menu-btn-back-category"><i class="fa fa-cubes"></i></button> -->
        
        <?php }elseif($subdomain == "page"){ ?>
            <div class="hidden-xs col-sm-5 col-md-4 col-lg-4" id="main-page-name"></div>
        <?php } ?>

        <button class="btn-show-map"  data-toggle="tooltip" data-placement="bottom" title="Afficher la carte">
            <i class="fa fa-map"></i>
        </button>

        <button class="btn-show-mainmenu" title="Menu principal" data-target="#modalMainMenu" data-toggle="modal">
            <i class="fa fa-th tooltips" data-toggle="tooltip" data-placement="bottom" title="Menu principal"></i>
        </button>
        <style>
            .dropdown-main-menu h2{
                font-size:23px;
            }
        </style>
        <div class="dropdown hidden">
            <button class="btn-show-mainmenu  dropdown-toggle" title="Menu principal" data-toggle="dropdown"  id="btn-main-menu">
                <i class="fa fa-th tooltips" data-toggle="tooltip" data-placement="bottom" title="Menu principal"></i>
            </button>
            <div class="dropdown-main-menu font-montserrat" aria-labelledby="btn-main-menu">
                <ul class="dropdown-menu arrow_box" style="max-width: 390px; font-size:25px; display: inline;">
                    <div class="hidden">
                    <?php foreach(array("web"=>"search", 
                                        "live"=>"newspaper-o", 
                                        "social"=>"user-circle-o", 
                                        //"freedom"=>"comments", 
                                        //"agenda"=>"calendar", 
                                        //"power"=>"hand-rock-o"
                                        ) as $link=>$icon){ ?>
                        <li class="text-left">
                            <a href="#k.<?php echo $link; ?>" class="lbh bg-white">
                                <span class="font-blackoutM text-red">
                                    <i style="width:30px;" class="text-center text-red fa fa-<?php echo $icon; ?>"></i> 
                                    <?php echo $link; ?>
                                </span>
                            </a>
                        </li>
                    <?php } ?>
                    </div>
                     <div class="padding-15 links-main-menu ">
                        <a href="#k.web" class="lbh btn-main-menu  col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-left">
                                <h2 class="text-red"><i class="fa fa-search padding-bottom-10"></i><br>
                                    <span class="font-blackoutT">WEB</span>
                                </h2>                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5>Moteur de recherche</h5>
                                </div>                 
                            </div>
                        </a>
                        <a href="#k.live" class="lbh btn-main-menu  col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-left">
                                <h2 class="text-red"><i class="fa fa-newspaper-o padding-bottom-10"></i><br>
                                    <span class="font-blackoutT"> LIVE</span>
                                </h2>                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5>Espace d'information</h5>
                                </div>
                            </div>
                        </a>
                    
                        <a href="#k.social.type.persons" class="lbh btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-left">
                                <h2 class="text-orange"><i class="fa fa-user-circle padding-bottom-10"></i><br>
                                    <span class="font-blackoutT"> SOCIAL</span>
                                </h2>                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5>Réseau social</h5>
                                </div>
                            </div>
                        </a>

                        <a href="#k.freedom" class="btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-left">
                                <h2 class="text-yellow"><i class="fa fa-comments padding-bottom-10"></i><br>
                                    <span class="font-blackoutT"> FREEDOM</span>
                                </h2>                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5>Expression libre</h5>
                                </div>
                            </div>
                        </a>
                        
                        <a href="#k.freedom" class="btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-left">
                                <h2 class="text-transparent-yellow"><i class="fa fa-calendar padding-bottom-10"></i><br>
                                    <span class="font-blackoutT"> AGENDA</span>
                                </h2>                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5>Agenda commun</h5>
                                </div>
                            </div>
                        </a>
                        
                        <a href="#k.freedom" class="btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-left">
                                <h2 class="text-transparent-yellow"><i class="fa fa-hand-rock-o padding-bottom-10"></i><br>
                                    <span class="font-blackoutT"> POWER</span>
                                </h2>                                
                                <div class="col-md-12 no-padding text-center">
                                    <h5>Participation citoyenne</h5>
                                </div>
                            </div>
                        </a>
                        
                    </div>
                </ul>
            </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="pull-right navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php 
                    if( isset( Yii::app()->session['userId']) ){
                      $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
                ?> 
                     
                    <a  href="#k.page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>"
                        class="dropdown-toggle menu-name-profil text-dark lbh pull-right" 
                        data-toggle="dropdown">
                                <small class="hidden-xs"><?php echo $me["username"]; ?> <?php echo $me["username"]; ?></small> 
                                <img class="img-circle" id="menu-thumb-profil" 
                                     width="40" height="40" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
                    </a>
                    <button class="menu-button btn-menu btn-menu-notif tooltips text-dark pull-right" 
                          data-toggle="tooltip" data-placement="left" title="Notifications" alt="Notifications">
                      <i class="fa fa-bell"></i>
                      <span class="notifications-count topbar-badge badge badge-success animated bounceIn">
                        <?php count($this->notifications); ?>
                    </button>
                   
                <?php } else { ?>
                    <li class="page-scroll">
                        <button class="text-red font-montserrat btn-menu-connect" data-toggle="modal" data-target="#modalLogin"><i class="fa fa-sign-in"></i> SE CONNECTER</button>
                    </li>
                <?php } ?>
            </ul>

            <?php // MULTITAG / MULTISCOPE / NOTIF // ?>
            <div class="margin-5 margin-right-15">
                <?php $this->renderPartial($layoutPath.'scopes/multi_tag_scope', array("me"=>$me, "layoutPath"=>$layoutPath)); ?>
            </div>
        </div>

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->


</nav>
<?php if(isset(Yii::app()->session['userId'])) 
                $this->renderPartial($layoutPath.'notifications'); ?>

<div class="portfolio-modal modal fade" id="modalMainMenu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <span class="name font-blackoutM" >
                        <span class="letter letter-blue font-ZILAP letter-k">K</span>
                        <span class="letter letter-yellow">G</span>
                        <span class="letter letter-yellow font-ZILAP">O</span>
                        <span class="letter letter-yellow">U</span>
                        <span class="letter letter-green">G</span>
                        <span class="letter letter-green">L</span>
                        <span class="letter letter-green">E</span>
                    </span>
                    <h3 class="letter-red no-margin hidden-xs" style="margin-top:-15px!important;">
                        MENU PRINCIPAL<br>
                    </h3>
                    <h5 class="text-dark no-margin hidden" style="margin-top:-15px!important;">
                        Retrouvez l'ensemble des services <span class="letter-blue">Kgougle</span> en quelques clicks
                    </h5>
                    <br>
                    <?php 
                        if( isset( Yii::app()->session['userId']) ){
                          $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
                    ?>  
                        <a class="btn btn-default text-red btn-sm" href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>">
                            <i class="fa fa-sign-out"></i> Déconnecter
                        </a>
                    <?php }else{ ?>
                        <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalRegister"><i class="fa fa-plus-circle"></i> S'inscrire</button>
                        <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalLogin"><i class="fa fa-sign-in"></i> Se connecter</button>
                    <?php } ?>
                    <hr>
                </div>
               
            </div>

            <div class="row links-main-menu">
                <a href="#k.web" class="lbh btn-main-menu  col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-left">
                        
                            <h2 class="text-red"><i class="fa fa-search padding-bottom-10"></i><br>
                                <span class="font-blackoutT">WEB</span>
                            </h2>
                        
                            <div class="col-md-12 no-padding text-center hidden-xs">
                                <h5>Un moteur de recherche simplifié
                                    <small class="hidden-xs"><br>
                                        pour un accès rapide à tous les sites web<br>dont vous avez besoin<br>
                                        70%
                                    </small>
                                </h5>
                            </div>                 
                    </div>
                </a>
                <a href="#k.live" class="lbh btn-main-menu  col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-red"><i class="fa fa-newspaper-o padding-bottom-10"></i><br>
                            <span class="font-blackoutT"> LIVE</span>
                        </h2>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5>Un espace d'information
                                <small class="hidden-xs"><br>
                                    pour suivre en direct<br>toute l'actu des médias du pays<br>
                                    90%
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>
            
                <a href="#k.social.type.persons" class="lbh btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-orange"><i class="fa fa-user-circle padding-bottom-10"></i><br>
                            <span class="font-blackoutT"> SOCIAL</span>
                        </h2>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5>Le réseau social du Caillou
                                <small class="hidden-xs"><br>
                                    pour être connecté au territoire<br>à ses voisins, ses amis, sa tribue<br>
                                    30% (en cours)
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>

                <a href="#k.freedom" class=" btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-yellow"><i class="fa fa-comments padding-bottom-10"></i><br>
                            <span class="font-blackoutT"> FREEDOM</span>
                        </h2>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5>Un espace d'expression libre
                                <small class="hidden-xs"><br>
                                    pour discuter, échanger, partager<br>avec tous les Cagous<br>
                                    (prochainement)
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>
                
                <a href="#k.freedom" class=" btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-yellow"><i class="fa fa-calendar padding-bottom-10"></i><br>
                            <span class="font-blackoutT"> AGENDA</span>
                        </h2>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5>Un agenda commun
                                <small class="hidden-xs"><br>
                                    pour être informé en temps réel de toute l'activité locale<br>
                                    (prochainement)
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>
                
                <a href="#k.freedom" class="col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-transparent-yellow"><i class="fa fa-hand-rock-o padding-bottom-10"></i><br>
                            <span class="font-blackoutT"> POWER</span>
                        </h2>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5>Un espace de participation citoyenne
                                <small class="hidden-xs"><br>
                                    pour discuter, proposer, débattre,<br>et décider ensemble<br>avec tous les Cagous<br>
                                    (prochainement)
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>
                
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <hr>
                    <a href="javascript:" style="font-size: 13px;" type="button" class="" data-dismiss="modal"><i class="fa fa-times"></i> Retour</a>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $this->renderPartial($layoutPath.'loginRegister', array( ) ); ?>
