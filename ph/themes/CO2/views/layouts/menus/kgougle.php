<style>
<?php if($subdomain == "page.type" || $subdomain == "freedom-"){ ?>    
.navbar-custom.affix #main-title-top{
    display: inline;
}

input#second-search-bar{
    display: inline;
    font-size:13px;
    margin-bottom: 4px;
}
.navbar-custom.affix-top .menu-btn-start-search{
    display: inline;
}
.navbar-custom.affix #small_profil{
    display: inline;
}
<?php } ?>

.btn-star-fav {
    font-size: 20px;
    margin-top: 2px;
}

#btn-sethome, #btn-apropos, #btn-radio{
    background-color: transparent !important;
    border:transparent;
}
#btn-sethome:hover, #btn-apropos:hover{
    color:white!important;
    background-color: #ea4335 !important;
    border:transparent;
}
.menu-btn-back-category{
    cursor:pointer;
}
</style>

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header pull-left">
           
            <?php if($subdomain == "web"){ ?>
                <a href="#web" class=" menu-btn-back-category">
            <?php } else { ?>
                <a href="#web" class="lbh menu-btn-back-category">
            <?php } ?>
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" 
                     class="nc_map pull-left show-top" height=20>
            </a>

            <span class="hidden-xs skills font-montserrat <?php if($subdomain == "page.type") echo 'hidden-sm'; ?>">
                <?php echo $mainTitle; ?>
            </span>
            
            

            <?php if($subdomain != "page.type"){ ?>
                <?php if($subdomain == "web"){ ?>
                    <a href="#web" class="navbar-brand font-blackoutM menu-btn-back-category">
                <?php } else { ?>
                    <a href="#web" class="lbh navbar-brand font-blackoutM menu-btn-back-category">
                <?php } ?>
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" 
                     class="nc_map pull-left" height=30>
                
                <!-- <small class="letter letter-red pastille font-blackoutT <?php if($subdomain == "page.type") echo 'hidden-sm'; ?>">
                    <?php //echo $subdomainName; ?>
                </small> -->
            </a>
            <?php }else{ ?>
                <div id="small_profil" class="hidden-top pull-left"></div>
            <?php } ?>
        </div>

        <?php if($subdomain == "live"){ ?>
            <div class="hidden-xs col-sm-5 col-md-4 col-lg-4" id="input-sec-search">
                <input type="text" class="form-control" id="second-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
            </div>
            <button class="btn btn-default hidden-xs pull-left menu-btn-start-search"><i class="fa fa-search"></i></button>
        
        <?php }elseif($subdomain == "web" || $subdomain == "media"){ ?>
            
            <div class="hidden-xs hidden-sm col-sm-5 col-md-4 col-lg-4" id="input-sec-search">
                <input type="text" class="form-control" id="second-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
            </div>
            <button class="btn btn-default hidden-xs hidden-sm pull-left menu-btn-start-search"><i class="fa fa-search"></i></button>

        <?php }elseif($subdomain == "social" || $subdomain == "page.type" || $subdomain == "freedom"){ ?>
            
            <div class="hidden-xs col-sm-5 col-md-4 col-lg-4" id="input-sec-search">
                <input type="text" class="form-control" id="second-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
            </div>
            <button class="btn btn-default hidden-xs pull-left menu-btn-start-search"><i class="fa fa-search"></i></button>

        <?php }elseif($subdomain == "page"){ ?>
            <div class="hidden-xs col-sm-5 col-md-4 col-lg-4" id="main-page-name"></div>
        <?php } ?>

        <button class="btn-show-map hidden-xs"  data-toggle="tooltip" data-placement="bottom" title="Afficher la carte">
            <i class="fa fa-map"></i>
        </button>

        <button class="btn-show-mainmenu hidden" title="Menu principal" data-target="#modalMainMenu" data-toggle="modal">
            <i class="fa fa-th tooltips" data-toggle="tooltip" data-placement="bottom" title="Menu principal"></i>
        </button>
        
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="pull-right navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php 
                    if( isset( Yii::app()->session['userId']) ){
                      $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
                ?> 
                     
                    <a  href="#page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>"
                        class="menu-name-profil text-dark pull-right"
                        data-toggle="dropdown">
                                <small class="hidden-xs" id="menu-name-profil"><?php echo $me["name"]; ?></small> 
                                <img class="img-circle" id="menu-thumb-profil" 
                                     width="40" height="40" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
                    </a>

                    <div class="dropdown pull-right" id="dropdown-user">
                        <div class="dropdown-main-menu">
                            <ul class="dropdown-menu arrow_box">
                                <li class="text-left">
                                    <a href="#page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>"
                                       target="_blank" class="lbh bg-white">
                                        <i class="fa fa-user-circle"></i> Ma page
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <!-- <li class="text-left">
                                    <a href="#social" target="_blank" class="lbh bg-white">
                                        <i class="fa fa-plus-circle"></i> Créer une page
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li> -->
                                <li class="text-left">
                                    <a href="#web" target="_blank" class="lbh bg-white">
                                        <i class="fa fa-search"></i> Rechercher sur le web
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li class="text-left">
                                    <a href="#social" target="_blank" class="lbh bg-white">
                                        <i class="fa fa-user-circle"></i> Rechercher des contacts
                                    </a>
                                </li>
                                <!-- <li role="separator" class="divider">
                                </li>
                                <li class="text-left">
                                    <a href="#" target="_blank" class="lbh bg-white">
                                        <i class="fa fa-crosshairs"></i> Autour de moi
                                    </a>
                                </li> -->
                                <li role="separator" class="divider">
                                </li>
                                <li class="text-left">
                                    <a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>" class="bg-white letter-red logout">
                                        <i class="fa fa-sign-out"></i> Déconnecter
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>



                    <button class="menu-button btn-menu btn-menu-notif tooltips text-dark pull-right" 
                          data-toggle="tooltip" data-placement="bottom" title="Notifications" alt="Notifications">
                      <i class="fa fa-bell"></i>
                      <span class="notifications-count topbar-badge badge badge-success animated bounceIn">
                        <?php count($this->notifications); ?>
                    </button>
                   
                <?php } else { ?>
                    <li class="page-scroll hidden">
                        <button class="letter-green font-montserrat btn-menu-connect" data-toggle="modal" data-target="#modalLogin">
                        <i class="fa fa-sign-in"></i> SE CONNECTER</button>
                    </li>
                <?php } ?>                
            </ul>
        </div>

        <?php if($subdomain == "web"){ ?>
            <button class="btn btn-link letter-yellow tooltips btn-star-fav pull-right font-montserrat"  
                    data-placement="bottom" title="Gérer vos favoris"
                    data-target="#modalFavorites" data-toggle="modal"><i class="fa fa-star"></i>
            </button>     
        <?php } ?>

        <a href="#info.p.sethome" class="btn btn-default btn-sm letter-red tooltips pull-right font-montserrat hidden-xs" 
            id="btn-sethome" style=" margin-top:6px;"  
            data-placement="bottom" title="Utiliser KGOUGLE en page d'accueil sur votre navigateur">
            <i class="fa fa-plus"></i> <i class="fa fa-home fa-2x"></i>
        </a>


        <a href="#info.p.apropos" class="btn btn-default btn-sm letter-red tooltips pull-right font-montserrat hidden-xs" 
            id="btn-apropos" style=" margin-top:6px;"  
            data-placement="bottom" title="A propos de KGOUGLE">
            <i class="fa fa-question-circle fa-2x"></i>
        </a>

        <button class="btn btn-default btn-sm letter-red tooltips pull-right font-montserrat" 
            id="btn-radio" style=" margin-top:6px;"  
            data-target="#modalRadioTool" data-toggle="modal"
            data-placement="bottom" title="Écouter la radio">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/radio-ico.png" height="25">
        </button>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->

</nav>


<?php if(isset(Yii::app()->session['userId'])) 
                $this->renderPartial($layoutPath.'notifications'); ?>


<?php $this->renderPartial($layoutPath.'formCreateElement'); ?>


 <?php $this->renderPartial($layoutPath.'modals.kgougle.mainMenu', array("me"=>$me) ); ?>


<?php $this->renderPartial($layoutPath.'loginRegister', array( ) ); ?>


