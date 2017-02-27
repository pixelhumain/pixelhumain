
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
                     class="nc_map" height=50>
                    <h3 class="letter-red no-margin hidden-xs" style="margin-top:5px!important;">
                        MENU PRINCIPAL<br>
                    </h3>
                    <!-- <h4 class="text-dark no-margin" style="margin-top:5px!important;">
                        <i class="fa fa-exclamation-circle letter-red fa-2x"></i> VERSION DE TEST EN COURS DE DÉVELOPPEMENT
                        <i class="fa fa-exclamation-circle letter-red fa-2x"></i> <br>
                        <span class="letter-red"></span>
                    </h4>
                    <p class="letter-red no-margin" style="font-size:13px; margin-top:5px!important;">
                        Cette nouvelle interface est en cours de développement, Merci de ne pas tenir compte des bug.<br>
                        Nous sommes en train de basculer les fonctionnalités de communecter.org sur cette interface, afin de rendre la navigation plus simple et compréhensible pour tous.<br>
                        L'objectif est de proposer une page/interface pour chaque grande fonctionnalité de communecter, afin de créer des portes d'entrées indépendantes sur le réseau, en fonction des besoins de chacun.<br><br>
                        <b>Vos remarques et idées à ce propos sont les bienvenues.<br>
                        Merci de nous en faire part sur le channel dédié <a href="https://chat.initiative.place/channel/co2_brainstorm" class="letter-blue">#app_brainstorm</a></b>
                    </p> -->
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
               
                <a href="#app.social.type.persons" class="lbh btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
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

                <a href="#app.freedom" class="lbh btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
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
                           
                <a href="#app.agenda" class="lbh btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
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
                
                <a href="#app.power" class="lbh btn-main-menu col-lg-6 col-sm-6 col-xs-6" date-target="#modalMainMenu" data-dismiss="modal">
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
