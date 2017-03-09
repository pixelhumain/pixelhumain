
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
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" style="margin-bottom:20px;" class="nc_map" height=50>
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
                        <a  href="#page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>" class="lbh">
                            <img class="img-circle" id="menu-thumb-profil" 
                                      src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
                        </a>
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
               
                <a href="#social" class="lbh btn-main-menu col-xs-3" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-red"><i class="fa fa-search fa-2x padding-bottom-10"></i><br>
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

                <a href="#annonces" class="lbh btn-main-menu col-xs-3" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-orange"><i class="fa fa-newspaper-o fa-2x padding-bottom-10"></i><br>
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
                           
                <a href="#agenda" class="lbh btn-main-menu col-xs-3" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-yellow"><i class="fa fa-calendar fa-2x padding-bottom-10"></i><br>
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
                
                <a href="#power" class="lbh btn-main-menu col-xs-3" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-transparent-yellow"><i class="fa fa-hand-rock-o fa-2x padding-bottom-10"></i><br>
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
                

                <div class="col-xs-12 text-center">
                <?php 
                        if( isset( Yii::app()->session['userId']) ){
                    ?> 
                    <a href="javascript:;" style="font-size:25px;" class="btn btn-default letter-green bold " 
                                        data-target="#dash-create-modal" data-toggle="modal" id="">
                                    <i class="fa fa-plus-circle"></i> CRÉER UNE PAGE
                                </a>
                    <?php } ?> 
                    <hr>
                    <a href="javascript:" style="font-size: 13px;" type="button" class="" data-dismiss="modal"><i class="fa fa-times"></i> Retour</a>
                </div>

            </div>
        </div>
    </div>
</div>
