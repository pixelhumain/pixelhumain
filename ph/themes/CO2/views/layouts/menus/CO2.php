<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header pull-left">
           
            <a href="#search" class="menu-btn-back-category" data-target="#modalMainMenu" data-toggle="modal">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" 
                     class="nc_map pull-left" height=30>
            </a>
            <span class="hidden-xs skills font-montserrat"><?php echo $mainTitle; ?></span>

        </div>

        <?php if( $subdomain == "search" ||
                  $subdomain == "agenda" ||
                  $subdomain == "power"  ||
                  $subdomain == "annonces"||
                  $subdomain == "page" ){ ?>
        
            <div id="input-sec-search" class="hidden-xs col-sm-3 col-md-4 col-lg-4">
                <input type="text" class="form-control" id="second-search-bar" 
                        placeholder="<?php echo $placeholderMainSearch; ?>">
                <?php if($subdomain == "page"){ ?>
                    <div class="dropdown-result-global-search hidden-xs col-sm-6 col-md-5 col-lg-5 no-padding"></div>
                <?php } ?>
            </div>
            <button class="btn btn-default hidden-xs pull-left menu-btn-start-search btn-directory-type" 
                    data-type="<?php echo @$type; ?>">
                    <i class="fa fa-search"></i>
            </button>

        <?php } ?>

        <button class="btn-show-map"  data-toggle="tooltip" data-placement="bottom" title="Afficher la carte">
            <i class="fa fa-map"></i>
        </button>

        <!-- <button class="btn-show-mainmenu" title="Menu principal" data-target="#modalMainMenu" data-toggle="modal">
            <i class="fa fa-th tooltips" data-toggle="tooltip" data-placement="bottom" title="Menu principal"></i>
        </button> -->

        <button class="btn-show-communexion lbh" data-hash="#search.type.cities" title="Communectez-vous">
            <i class="fa fa-university tooltips" data-toggle="tooltip" data-placement="bottom" title="Communectez-vous"></i>
        </button>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="pull-right navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php 
                    if( isset( Yii::app()->session['userId']) ){
                      $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
                      $countNotifElement = ActivityStream::countUnseenNotifications(Yii::app()->session["userId"], Person::COLLECTION, Yii::app()->session["userId"]);
                ?> 
                     <!-- #page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?> -->
                    <a  href="#page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>"
                        class="menu-name-profil text-dark pull-right" 
                        data-toggle="dropdown">
                            <small class="hidden-xs" id="menu-name-profil">
                                <?php echo @$me["name"] ? $me["name"] : @$me["username"]; ?>
                            </small> 
                            <img class="img-circle" id="menu-thumb-profil" 
                                 width="40" height="40" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
                    </a>

                    <div class="dropdown pull-right" id="dropdown-user">
                        <div class="dropdown-main-menu">
                            <ul class="dropdown-menu arrow_box">
                                    <li class="text-left">
                                        <a href="#page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>" 
                                            class="lbh bg-white">
                                            <i class="fa fa-user-circle"></i> Ma page
                                        </a>
                                    </li>
                                    </li>
                                    <!-- <li class="text-left">
                                        <a href="#social" class="lbh bg-white">
                                            <i class="fa fa-university"></i> Ma commune
                                        </a>
                                    </li> -->
                                    </li>
                                    <li class="text-left">
                                        <a href="#search" class="lbh bg-white">
                                            <i class="fa fa-connectdevelop"></i> Mon conseil citoyen
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li class="text-left">
                                        <a href="javascript:" class="bg-white" data-target="#dash-create-modal" data-toggle="modal">
                                            <i class="fa fa-plus-circle"></i> Créer une page
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li class="text-left">
                                        <a href="#search" class="lbh bg-white">
                                            <i class="fa fa-search"></i> Rechercher
                                        </a>
                                    </li>
                                    <li class="text-left">
                                        <a href="#annonces" class="lbh bg-white">
                                            <i class="fa fa-newspaper-o"></i> Petites annonces
                                        </a>
                                    </li>
                                    <li class="text-left">
                                        <a href="#agenda" class="lbh bg-white">
                                            <i class="fa fa-calendar"></i> Agenda
                                        </a>
                                    </li>
                                    <li class="text-power">
                                        <a href="#power" class="lbh bg-white">
                                            <i class="fa fa-hand-rock-o"></i> Power
                                        </a>
                                    </li>
                                    <li role="separator" class="divider">
                                    </li>
                                    <li class="text-left">
                                        <a href="<?php echo Yii::app()->createUrl('/co2/person/logout'); ?>" 
                                            class="bg-white letter-red logout">
                                            <i class="fa fa-sign-out"></i> Déconnecter
                                        </a>
                                    </li>

                            </ul>
                        </div>
                    </div>

                    <button class="menu-button btn-menu btn-menu-notif text-dark pull-right" 
                          data-toggle="tooltip" data-placement="bottom" title="Notifications" alt="Notifications">
                      <i class="fa fa-bell"></i>
                      <span class="notifications-count topbar-badge badge animated bounceIn 
                              <?php if(!@$countNotifElement || (@$countNotifElement && $countNotifElement=="0")) 
                              echo 'badge-transparent hide'; else echo 'badge-success'; ?>">
                            <?php echo @$countNotifElement ?>
                        </span>
                    </button>
                    
                <?php } else { ?>
                    <li class="page-scroll">
                        <button class="hidden-xs hidden-sm letter-green font-montserrat btn-menu-connect margin-left-10" 
                                data-toggle="modal" data-target="#modalLogin">
                            <span><i class="fa fa-sign-in"></i> SE CONNECTER</span>
                        </button>
                        <button class="visible-xs visible-sm letter-green font-montserrat btn-menu-connect margin-top-10" 
                                data-toggle="modal" data-target="#modalLogin" style="font-size:20px;">
                            <span><i class="fa fa-sign-in"></i></span>
                        </button>
                    </li>
                <?php } ?>
            </ul>

        </div>
        <!-- /.navbar-collapse -->
        <?php 
            $params = CO2::getThemeParams();
            if($subdomainName != "web") foreach (array_reverse($params["pages"]) as $key => $value) {
                if(@$value["inMenu"]==true){ ?>
                <a href="<?php echo $key; ?>" 
                    class="lbh btn btn-link letter-red pull-right btn-menu-to-app hidden-top 
                            <?php if($subdomainName==$value["subdomainName"]) echo 'active'; ?>"
                    data-toggle="tooltip" data-placement="bottom" title="<?php echo $value["subdomainName"]; ?>">
                    <i class="fa fa-<?php echo $value["icon"]; ?>"></i>
                </a>  
        <?php   }
            }  ?>
    </div>
    <!-- /.container-fluid -->

</nav>


<?php if(isset(Yii::app()->session['userId'])) 
        $this->renderPartial($layoutPath.'notifications'); ?>

<?php $this->renderPartial($layoutPath.'formCreateElement'); ?>

<?php $this->renderPartial($layoutPath.'modals.CO2.mainMenu', array("me"=>$me) ); ?>


<?php $this->renderPartial($layoutPath.'loginRegister', array( ) ); ?>

<script>
jQuery(document).ready(function() {    
    setTimeout(function(){ $(".tooltips").tooltip(); }, 3500);
    $('#modalMainMenu').on('show', function (e) {alert();
            $(".btn-main-menu").mouseenter(function(){
                
                if( $(this).data("type") ){
                    alert( $(this).data("type") );
                    $(".menuSection2").addClass("hidden");
                    $("."+$(this).data("type")+"Section2").removeClass("hidden");
                }
            });
        });
});
</script> 