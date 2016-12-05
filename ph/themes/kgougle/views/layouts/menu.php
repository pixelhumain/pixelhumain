<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button> -->

            <!-- <img src="img/NC_map.png" class="nc_map_min" height=30> -->
            <a href="#k.web" class="btn-scroll menu-btn-back-category" data-targetid="#page-top">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/logocagou-<?php echo $subdomain; ?>.png" 
                     class="nc_map pull-left" height=30>
            </a>
            <span class="hidden-xs skills font-montserrat"><?php echo $mainTitle; ?></span>

            <a class="navbar-brand font-blackoutM btn-scroll menu-btn-back-category" data-targetid="#page-top" href="#k.web">
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
            <div class="col-xs-8 col-sm-3 col-md-5 col-lg-4">
                <input type="text" class="form-control" id="second-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
            </div>
            <button class="btn btn-default pull-left menu-btn-start-search"><i class="fa fa-search"></i></button>
        <?php }elseif($subdomain == "web"){ ?>
            <div class="col-xs-8 col-sm-3 col-md-5 col-lg-4">
                <input type="text" class="form-control" id="second-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
            </div>
            <button class="btn btn-default pull-left menu-btn-start-search"><i class="fa fa-search"></i></button>

             <!-- <button class="btn btn-default pull-left menu-btn-back-category"><i class="fa fa-cubes"></i></button> -->
        <?php } ?>

        <button class="btn-show-map"  data-toggle="tooltip" data-placement="bottom" title="Afficher la carte">
            <i class="fa fa-map"></i>
        </button>

        <button class="btn-show-mainmenu " title="Menu principal" data-target="#modalMainMenu" data-toggle="modal">
            <i class="fa fa-th tooltips" data-toggle="tooltip" data-placement="bottom" title="Menu principal"></i>
        </button>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php 
                    if( isset( Yii::app()->session['userId']) ){
                      $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
                ?> 
                    <button class="menu-button btn-menu btn-menu-notif tooltips text-dark pull-right" 
                          data-toggle="tooltip" data-placement="left" title="Notifications" alt="Notifications">
                      <i class="fa fa-bell"></i>
                      <span class="notifications-count topbar-badge badge badge-success animated bounceIn">
                        <?php count($this->notifications); ?>
                      </button>
                    </a>

                    <a  href="#k.page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>"
                        class="dropdown-toggle menu-name-profil text-dark lbh pull-right" 
                        data-toggle="dropdown">
                                <small><?php echo $me["username"]; ?></small> 
                                <img class="img-circle" id="menu-thumb-profil" 
                                     width="40" height="40" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
                    </a>

                <?php } else { ?>
                    <li class="page-scroll">
                        <button class="text-red font-montserrat btn-menu-connect" data-toggle="modal" data-target="#modalLogin"><i class="fa fa-sign-in"></i> SE CONNECTER</button>
                    </li>
                <?php } ?>
            </ul>

            <?php // MULTITAG / MULTISCOPE / NOTIF // ?>
            <div class="pull-right margin-5 margin-right-15">
                <?php $this->renderPartial($layoutPath.'scopes/multi_tag_scope', array("me"=>$me, "layoutPath"=>$layoutPath)); ?>
            </div>
        </div>

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->


</nav>


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
                    <h3 class="letter-red no-margin" style="margin-top:-15px!important;">
                        Le web, en mieux
                    </h3><br>

                    <h5 class="text-dark no-margin" style="margin-top:-15px!important;">
                        Retrouvez l'ensemble des services <span class="letter-blue">Kgougle</span> en quelques clicks
                    </h5><br>

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
                        
                            <div class="col-md-12 no-padding text-center">
                                <h5>Un moteur de recherche simplifié
                                    <small><br>
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
                        
                        <div class="col-md-12 no-padding text-center">
                            <h5>Un espace d'information
                                <small><br>
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
                        
                        <div class="col-md-12 no-padding text-center">
                            <h5>Le réseau social du Caillou
                                <small><br>
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
                        
                        <div class="col-md-12 no-padding text-center">
                            <h5>Un espace d'expression libre
                                <small><br>
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
                        
                        <div class="col-md-12 no-padding text-center">
                            <h5>Un agenda commun
                                <small><br>
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
                        
                        <div class="col-md-12 no-padding text-center">
                            <h5>Un espace de participation citoyenne
                                <small><br>
                                    pour discuter, proposer, débattre,<br>et décider ensemble<br>avec tous les Cagous<br>
                                    (prochainement)
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>
                
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <hr>
                    <a href="javascript:" type="button" class="" data-dismiss="modal"><i class="fa fa-times"></i> Retour</a>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $this->renderPartial($layoutPath.'loginRegister', array( ) ); ?>
