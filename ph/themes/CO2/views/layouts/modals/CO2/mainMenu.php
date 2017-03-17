
<div class="portfolio-modal modal fade" id="openModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="col-sm-12 container"></div>
        <div class="col-xs-12 text-center" style="margin-top:50px;">
        <?php 
                if( isset( Yii::app()->session['userId']) ){
            ?> 
            <a href="javascript:;" style="font-size:25px;" class="btn btn-default letter-green bold " 
                                data-target="#dash-create-modal" data-toggle="modal" id="">
                            <i class="fa fa-arrow-circle-right"></i> Savoir plus
                        </a>
            <?php } ?> 
            <hr>
            <a href="javascript:" style="font-size: 13px;" type="button" class="" data-dismiss="modal">
            <i class="fa fa-times"></i> Retour</a>
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
                            <span class="font-blackoutT"> DEMOCRATIE</span>
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
                

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center subsub" id="sub-menu-filliaire-menu">
                <!-- <h5>Recherche thématique<br><i class='fa fa-chevron-down'></i></h5> -->
                <?php $filliaireCategories = CO2::getContextList("filliaireCategories"); 
                      //var_dump($categories); exit;
                      foreach ($filliaireCategories as $key => $cat) { 
                  ?>
                      <?php if(is_array($cat)) { ?>
                      <div class="col-md-2 col-sm-3 col-sm-6 no-padding">
                        <button class="btn btn-default col-md-12 col-sm-12 padding-10 bold text-dark elipsis margin-bottom-5 btn-select-filliaire" 
                                data-fkey="<?php echo $key; ?>"
                                style="border-radius:0px; border-color: transparent; text-transform: uppercase;" 
                                data-keycat="<?php echo $cat["name"]; ?>">
                          <i class="fa <?php echo $cat["icon"]; ?> fa-2x hidden-xs"></i><br><?php echo $cat["name"]; ?>
                        </button>
                      </div>
                        <?php //foreach ($cat as $key2 => $cat2) { ?>
                          <!-- <button class="btn btn-default text-dark margin-bottom-5 margin-left-15 hidden keycat keycat-<?php //echo $key; ?>">
                            <i class="fa fa-angle-right"></i> <?php //echo $cat2; ?>
                          </button><br class="hidden"> -->
                        <?php //} ?>
                      <?php } ?>
                    </button>
                  <?php } ?>
                  <hr class="col-md-12 col-sm-12 col-xs-12 no-padding" id="before-section-result">
                </div>

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
