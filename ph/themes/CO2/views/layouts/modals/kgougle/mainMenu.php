

<div class="portfolio-modal modal fade" id="openModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="col-sm-12 container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="modal-header text-dark">
                        <h3 class="modal-title text-center" id="ajax-modal-modal-title">
                            <i class="fa fa-angle-down"></i> <i class="fa " id="ajax-modal-icon"></i> 
                        </h3>
                    </div>
                    
                    <div id="ajax-modal-modal-body" class="modal-body">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 text-center" style="margin-top:50px;margin-bottom:50px;">
            <hr>
            <a href="javascript:" style="font-size: 13px;" type="button" class="" data-dismiss="modal">
            <i class="fa fa-times"></i> <?php echo Yii::t("common","Back") ?>
            </a>
        </div>
    </div>
</div>

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
                    <!-- <span class="name font-blackoutM" >
                        <span class="letter letter-blue font-ZILAP letter-k">K</span>
                        <span class="letter letter-yellow">G</span>
                        <span class="letter letter-yellow font-ZILAP">O</span>
                        <span class="letter letter-yellow">U</span>
                        <span class="letter letter-green">G</span>
                        <span class="letter letter-green">L</span>
                        <span class="letter letter-green">E</span>
                    </span> -->
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" height="50" class="inline margin-top-25 margin-bottom-5"><br>
                    <h3 class="letter-red no-margin hidden-xs" style="">
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

                <div class="hidden-sm hidden-xs col-lg-1 col-md-1"></div>

                <a href="#web" class="lbh btn-main-menu  col-lg-2 col-md-2 col-sm-6 col-xs-12" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-center">
                        
                            <h2 class="text-red"><i class="fa fa-search padding-bottom-10"></i><br>
                                <span class="font-blackoutT">WEB</span>
                            </h2>
                        
                            <div class="col-md-12 no-padding text-center hidden-xs">
                                <h5>Un moteur de recherche simplifié
                                    <small class="hidden-xs"><br>
                                        pour un accès rapide à tous les sites internet de Nouvelle-Calédonie
                                    </small>
                                </h5>
                            </div>                 
                    </div>
                </a>
                <a href="#live" class="lbh btn-main-menu  col-lg-2 col-md-2 col-sm-6 col-xs-12" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-center">
                        <h2 class="text-red"><i class="fa fa-newspaper-o padding-bottom-10"></i><br>
                            <span class="font-blackoutT"> ACTUS</span>
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
            
                <a href="#social.type.persons" class="lbh btn-main-menu col-lg-2 col-md-2 col-sm-6 col-xs-12" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-center">
                        <h2 class="text-red"><i class="fa fa-user-circle padding-bottom-10"></i><br>
                            <span class="font-blackoutT"> SOCIAL</span>
                        </h2>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5>Le réseau social du Caillou
                                <small class="hidden-xs"><br>
                                    pour être connecté au territoire<br>à ses voisins, ses amis, sa famille<br>
                                    30% (en cours)
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>

                <a href="#freedom" class=" btn-main-menu col-lg-2 col-md-2 col-sm-6 col-xs-12" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-center">
                        <h2 class="text-red"><i class="fa fa-comments padding-bottom-10"></i><br>
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
                
                <a href="#agenda" class=" btn-main-menu col-lg-2 col-md-2 col-sm-6 col-xs-12" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-center">
                        <h2 class="text-red"><i class="fa fa-calendar padding-bottom-10"></i><br>
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
                
                <!-- <a href="#power" class="col-lg-2 col-md-2 col-sm-6 col-xs-12" date-target="#modalMainMenu" data-dismiss="modal">
                    <div class="modal-body text-center">
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
                </a> -->
                
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <hr>
                    <a href="javascript:" style="font-size: 13px;" type="button" class="" data-dismiss="modal"><i class="fa fa-times"></i> Retour</a>
                </div>

            </div>
        </div>
    </div>
</div>


<?php   $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
        $this->renderPartial($layoutPath.'.rocketchat'); 
?>