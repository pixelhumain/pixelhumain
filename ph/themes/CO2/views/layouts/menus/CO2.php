<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header pull-left">
           
            <a href="#co2.web" class="menu-btn-back-category" data-target="#modalMainMenu" data-toggle="modal">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" 
                     class="nc_map pull-left" height=30>
            </a>
            <span class="hidden-xs skills font-montserrat"><?php echo $mainTitle; ?></span>

        </div>

        <?php if($subdomain == "live"){ ?>
        
            <div class="hidden-xs col-sm-5 col-md-4 col-lg-4">
                <input type="text" class="form-control" id="second-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
            </div>
            <button class="btn btn-default hidden-xs pull-left menu-btn-start-search"><i class="fa fa-search"></i></button>
        
        <?php }elseif($subdomain == "web"){ ?>
            
            <div class="hidden-xs col-sm-5 col-md-4 col-lg-4">
                <input type="text" class="form-control" id="second-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
            </div>
            <button class="btn btn-default hidden-xs pull-left menu-btn-start-search"><i class="fa fa-search"></i></button>
        
        <?php }elseif($subdomain == "social" || $subdomain == "page.type"){ ?>
            
            <div class="hidden-xs col-sm-5 col-md-4 col-lg-4">
                <input type="text" class="form-control" id="second-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
            </div>
            <button class="btn btn-default hidden-xs pull-left menu-btn-start-search"><i class="fa fa-search"></i></button>

        <?php }elseif($subdomain == "page"){ ?>
            <div class="hidden-xs col-sm-5 col-md-4 col-lg-4" id="main-page-name"></div>
        <?php } ?>

        <button class="btn-show-map"  data-toggle="tooltip" data-placement="bottom" title="Afficher la carte">
            <i class="fa fa-map"></i>
        </button>

        <button class="btn-show-mainmenu" title="Menu principal" data-target="#modalMainMenu" data-toggle="modal">
            <i class="fa fa-th tooltips" data-toggle="tooltip" data-placement="bottom" title="Menu principal"></i>
        </button>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="pull-right navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php 
                    if( isset( Yii::app()->session['userId']) ){
                      $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
                ?> 
                     
                    <a  href="#co2.page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>"
                        class="menu-name-profil text-dark lbh pull-right" 
                        data-toggle="dropdown">
                                <small class="hidden-xs" id="menu-name-profil"><?php echo $me["username"]; ?> <?php echo $me["username"]; ?></small> 
                                <img class="img-circle" id="menu-thumb-profil" 
                                     width="40" height="40" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
                    </a>

                    <div class="dropdown pull-right" id="dropdown-user">
                        <div class="dropdown-main-menu">
                            <ul class="dropdown-menu arrow_box">
                                <li class="text-left">
                                    <a href="#co2.social" target="_blank" class="lbh bg-white">
                                        <i class="fa fa-user-circle"></i> Ma page
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <!-- <li class="text-left">
                                    <a href="" data-target="#dash-create-modal" data-toggle="modal" class="bg-white">
                                        <i class="fa fa-plus-circle"></i> Créer une page
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li> -->
                                <li class="text-left">
                                    <a href="#co2.social" target="_blank" class="lbh bg-white">
                                        <i class="fa fa-search"></i> Rechercher des contacts
                                    </a>
                                </li>
                                <li role="separator" class="divider">
                                </li>
                                <!-- <li class="text-left">
                                    <a href="#co2.social" target="_blank" class="lbh bg-white">
                                        <i class="fa fa-crosshairs"></i> Autour de moi
                                    </a>
                                </li>
                                <li role="separator" class="divider"> -->
                                </li>
                                <li class="text-left">
                                    <a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>" class="logout bg-white letter-red">
                                        <i class="fa fa-sign-out"></i> Déconnecter
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <button class="menu-button btn-menu btn-menu-notif tooltips text-dark pull-right" 
                          data-toggle="tooltip" data-placement="left" title="Notifications" alt="Notifications">
                      <i class="fa fa-bell"></i>
                      <span class="notifications-count topbar-badge badge badge-success animated bounceIn">
                        <?php count($this->notifications); ?>
                    </button>
                   
                <?php } else { ?>
                    <li class="page-scroll">
                        <button class="letter-green font-montserrat btn-menu-connect" data-toggle="modal" data-target="#modalLogin"><i class="fa fa-sign-in"></i> SE CONNECTER</button>
                    </li>
                <?php } ?>
                
            </ul>

            <?php // MULTITAG / MULTISCOPE / NOTIF // ?>
            <div class="margin-5 margin-right-15 hidden">
                <?php //$this->renderPartial($layoutPath.'scopes/multi_tag_scope', array("me"=>$me, "layoutPath"=>$layoutPath)); ?>
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
                <div class="col-lg-12 text-center">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" 
                     class="nc_map" height=130>
                    <h3 class="letter-red no-margin hidden-xs" style="margin-top:5px!important;">
                        MENU PRINCIPAL<br>
                    </h3>
                    <h4 class="text-dark no-margin" style="margin-top:5px!important;">
                        <i class="fa fa-exclamation-circle letter-red fa-2x"></i> VERSION DE TEST EN COURS DE DÉVELOPPEMENT
                        <i class="fa fa-exclamation-circle letter-red fa-2x"></i> <br>
                        <span class="letter-red"></span>
                    </h4>
                    <p class="letter-red no-margin" style="font-size:13px; margin-top:5px!important;">
                        Cette nouvelle interface est en cours de développement, Merci de ne pas tenir compte des bug.<br>
                        Nous sommes en train de basculer les fonctionnalités de communecter.org sur cette interface, afin de rendre la navigation plus simple et compréhensible pour tous.<br>
                        L'objectif est de proposer une page/interface pour chaque grande fonctionnalité de communecter, afin de créer des portes d'entrées indépendantes sur le réseau, en fonction des besoins de chacun.<br><br>
                        <b>Vos remarques et idées à ce propos sont les bienvenues.<br>
                        Merci de nous en faire part sur le channel dédié <a href="https://chat.initiative.place/channel/co2_brainstorm" class="letter-blue">#CO2_brainstorm</a></b>
                    </p>
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
                <!-- <a href="#k.web" class="lbh btn-main-menu  col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
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
                </a> -->

                <a href="#co2.social.type.persons" class="lbh btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-red"><i class="fa fa-user-circle padding-bottom-10"></i><br>
                            <span class="font-blackoutT"> RECHERCHE</span>
                        </h2>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5>Le moteur de recherche
                                <small class="hidden-xs"><br>
                                    pour être connecté au territoire<br>à ses voisins, ses amis, sa tribue<br>
                                    80% (en cours)
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>

                <a href="#co2.freedom" class="lbh btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-orange"><i class="fa fa-newspaper-o padding-bottom-10"></i><br>
                            <span class="font-blackoutT"> ANNONCES</span>
                        </h2>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5>Un espace d'information
                                <small class="hidden-xs"><br>
                                    Un système de petites annonces révolutionnaire<br><br>
                                    50% (en cours)
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>
            
                

                <!-- <a href="#co2.freedom" class=" btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
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
                </a> -->
                
                <a href="#co2.agenda" class="lbh btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-yellow"><i class="fa fa-calendar padding-bottom-10"></i><br>
                            <span class="font-blackoutT"> AGENDA</span>
                        </h2>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5>Un agenda commun
                                <small class="hidden-xs"><br>
                                    pour être informé en temps réel de toute l'activité locale<br>
                                    50% (en cours)
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>
                
                <a href="#co2.power" class="lbh btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-transparent-yellow"><i class="fa fa-hand-rock-o padding-bottom-10"></i><br>
                            <span class="font-blackoutT"> POWER</span>
                        </h2>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5>Un espace de participation citoyenne
                                <small class="hidden-xs"><br>
                                    La démocratie participative / collaborative / en ligne / de demain
                                    10% (refonte à réaliser)
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
