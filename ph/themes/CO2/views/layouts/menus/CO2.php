<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header pull-left">
           
            <button class="btn btn-link menu-btn-back-category pull-left no-padding" 
                <?php if( $subdomain != "welcome" ) { ?>data-target="#modalMainMenu" data-toggle="modal"<?php } ?>
            >
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" 
                     class="nc_map pull-left" height=30>
            </button>
            <span class="hidden-xs skills font-montserrat"><?php echo $mainTitle; ?></span>
            <?php 
                $params = CO2::getThemeParams();  
                $icon = "";
                // echo "params : "; var_dump($params);// exit; 
                foreach ($params["pages"] as $key => $value) {
                    if($subdomain==@$value["subdomain"]) {
                        $icon = @$value["icon"];
                    } 
                }
            ?>
            <i class="fa fa-<?php echo $icon; ?> hidden-top margin-top-15 margin-right-5 margin-left-10 pull-left text-red" 
                style="font-size:20px;"></i>
        </div>

        <?php if( $subdomain == "search" ||
                  $subdomain == "agenda" ||
                  $subdomain == "power"  ||
                  $subdomain == "annonces"||
                  $subdomain == "admin"||
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

        <?php if( $subdomain == "welcome" ){ ?>
        
            <!-- <div id="input-sec-search" class="hidden-xs col-sm-2 col-md-2 col-lg-2">
                <input type="text" class="form-control" id="second-search-bar" 
                        placeholder="<?php echo $placeholderMainSearch; ?>">
                <?php if($subdomain == "page"){ ?>
                    <div class="dropdown-result-global-search hidden-xs col-sm-6 col-md-5 col-lg-5 no-padding"></div>
                <?php } ?>
            </div>
            <button class="btn btn-default hidden-xs pull-left menu-btn-start-search btn-directory-type" 
                    data-type="<?php echo @$type; ?>">
                    <i class="fa fa-search"></i>
            </button> -->

        <?php } ?>

        <button class="btn-show-map"  data-toggle="tooltip" data-placement="bottom" title="Afficher la carte">
            <i class="fa fa-map"></i>
        </button>

        <!-- <button class="btn-show-mainmenu" title="Menu principal" data-target="#modalMainMenu" data-toggle="modal">
            <i class="fa fa-th tooltips" data-toggle="tooltip" data-placement="bottom" title="Menu principal"></i>
        </button> -->

        <?php if( isset( Yii::app()->session['userId']) ){ ?>
            
            <button class="menu-button btn btn-link btn-open-floopdrawer text-dark" 
                  data-dismiss="tooltip" data-placement="left" title="Mon réseau" alt="Mon réseau">
              <i class="fa fa-link"></i>
            </button>
            <button class="btn-show-mainmenu btn btn-link" 
                    data-toggle="tooltip" data-placement="left" title="Menu">
                <i class="fa fa-bars tooltips" ></i>
            </button>
        <?php } ?>
        


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
                        class="menu-name-profil lbh text-dark pull-right" 
                        data-toggle="dropdown">
                            <small class="hidden-xs hidden-sm margin-left-10" id="menu-name-profil">
                                <?php echo @$me["name"] ? $me["name"] : @$me["username"]; ?>
                            </small> 
                            <img class="img-circle" id="menu-thumb-profil" 
                                 width="40" height="40" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
                    </a>

                    <div class="dropdown pull-right" id="dropdown-user">
                        <div class="dropdown-main-menu">
                            <ul class="dropdown-menu arrow_box">
                                <!-- <li class="text-left">
                                    <a href="#page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>" 
                                        class="lbh bg-white">
                                        <i class="fa fa-user-circle"></i> Ma page
                                    </a>
                                </li> -->
                                <!-- <li class="text-left">
                                    <a href="#social" class="lbh bg-white">
                                        <i class="fa fa-university"></i> Ma commune
                                    </a>
                                </li> -->
                                <!-- </li> -->
                                <!-- <li class="text-left">
                                    <a href="#search" class="lbh bg-white">
                                        <i class="fa fa-connectdevelop"></i> Mon conseil citoyen
                                    </a>
                                </li> -->
                                <li class="text-left">
                                    <a href="#" class="lbh bg-white">
                                        <i class="fa fa-home"></i> Accueil
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                  <?php 
                                $class = "hidden" ;
                                if( empty($me) || empty($me["address"]) || empty($me["address"]["codeInsee"]))
                                    $class = ""
                                ?>
                                <li class="text-left">
                                    <a href="" class="communecter-btn bg-white <?php echo $class ; ?>" onclick="communecterUser();">
                                        <i class="fa fa-university"></i> <?php echo Yii::t("common", "Connect to your city");?>
                                    </a>
                                </li>
                                <li class="text-admin visible-xs">
                                    <a href="#page.type.<?php echo Person::COLLECTION ?>.id.<?php echo Yii::app()->session["userId"] ?>.view.notifications" class="lbh bg-white">
                                        <i class="fa fa-bell"></i> <?php echo Yii::t("common", "My notifications") ; ?>
                                        <span class="notifications-count topbar-badge badge animated bounceIn 
                                            <?php if(!@$countNotifElement || (@$countNotifElement && $countNotifElement=="0")) 
                                            echo 'badge-transparent hide'; else echo 'badge-success'; ?>"
                                        >
                                        <?php echo @$countNotifElement ?>
                                        </span>
                                    </a>
                                </li>
                                
                                <li class="text-admin">
                                    <a href="#params" class="lbh bg-white">
                                        <i class="fa fa-cogs"></i> <?php echo Yii::t("common", "My parameters") ; ?>
                                    </a>
                                </li>
                                <?php if( Yii::app()->session["userIsAdmin"] ) { ?>
                                    <li class="text-admin">
                                        <a href="#admin" class="lbh bg-white">
                                            <i class="fa fa-user-secret"></i> <?php echo Yii::t("common", "Admin") ; ?>
                                        </a>
                                    </li>
                                <?php }else if( Yii::app()->session[ "userIsAdminPublic" ] ) { ?>
                                    <li class="text-admin">
                                        <a href="#adminpublic" class="lbh bg-white">
                                            <i class="fa fa-user-secret"></i> <?php echo Yii::t("common", "Admin public") ; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li role="separator" class="divider">
                                 <li class="text-left visible-xs">
                                    <a href="#search" class="lbh bg-white">
                                        <i class="fa fa-search"></i> Rechercher
                                    </a>
                                </li>
                                <li class="text-left visible-xs">
                                    <a href="#annonces" class="lbh bg-white">
                                        <i class="fa fa-bullhorn"></i> Annonces
                                    </a>
                                </li>
                                <li class="text-left visible-xs">
                                    <a href="#agenda" class="lbh bg-white">
                                        <i class="fa fa-calendar"></i> Agenda
                                    </a>
                                </li>
                                <li class="text-left visible-xs">
                                    <a href="#live" class="lbh bg-white">
                                        <i class="fa fa-calendar"></i> Live
                                    </a>
                                </li>
                                <li class="text-left visible-xs">
                                    <a href="#default.view.page.links" class="lbhp bg-right">
                                        <i class="fa fa-life-ring"></i> Aide
                                    </a>
                                </li>
                                <li role="separator" class="divider visible-xs"></li>
                                <!--<li class="text-power">
                                    <a href="#power" class="bg-white disabled">
                                        <i class="fa fa-comments"></i> Démocratie
                                    </a>
                                </li> -->
                                </li>
                                <li class="text-left">
                                    <a href="<?php echo Yii::app()->createUrl('/co2/person/logout'); ?>" 
                                        class="bg-white letter-red logout">
                                        <i class="fa fa-sign-out"></i> <?php echo Yii::t("common", "Log Out") ; ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <button class="menu-button btn-menu btn-menu-notif text-dark pull-right hidden-xs" 
                          data-toggle="tooltip" data-placement="bottom" title="Notifications" alt="Notifications">
                      <i class="fa fa-bell"></i>
                      <span class="notifications-count topbar-badge badge animated bounceIn 
                              <?php if(!@$countNotifElement || (@$countNotifElement && $countNotifElement=="0")) 
                              echo 'badge-transparent hide'; else echo 'badge-success'; ?>">
                            <?php echo @$countNotifElement ?>
                        </span>
                    </button>
                    
                <?php } else { ?>
                    
                    <li class="pull-right">
                        <?php if($subdomain != "welcome"){ ?>
                            <button class="hidden-xs hidden-sm letter-green font-montserrat btn-menu-connect margin-left-10" 
                                    data-toggle="modal" data-target="#modalLogin">
                                <span><i class="fa fa-sign-in"></i> SE CONNECTER</span>
                            </button>
                            <button class="visible-xs visible-sm letter-green font-montserrat btn-menu-connect margin-top-10" 
                                    data-toggle="modal" data-target="#modalLogin" style="font-size:20px;">
                                <span><i class="fa fa-sign-in"></i></span>
                            </button>
                        <?php } else { ?>
                            <?php   $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
                                    $this->renderPartial($layoutPath.'forms.'.Yii::app()->params["CO2DomainName"].'.login'); 
                            ?>
                        <?php } ?>
                    </li>

                <?php } ?>
            </ul>
        </div>
        <?php if (!@Yii::app()->session["userId"]){ ?>
            <button class="btn-show-mainmenu btn btn-link visible-xs pull-right" 
                    data-toggle="tooltip" data-placement="left" title="Menu" style="padding: 4px 10px;">
                <i class="fa fa-bars tooltips" ></i>
            </button>
            <div class="dropdown pull-right" id="dropdown-user">
                <div class="dropdown-main-menu" style="right:50px !important;">
                    <ul class="dropdown-menu arrow_box">
                         <li class="text-left visible-xs">
                            <a href="#search" class="lbh bg-white text-red">
                                <i class="fa fa-search"></i> Rechercher
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#annonces" class="lbh bg-white text-red">
                                <i class="fa fa-bullhorn"></i> Annonces
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#agenda" class="lbh bg-white text-red">
                                <i class="fa fa-calendar"></i> Agenda
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#live" class="lbh bg-white text-red">
                                <i class="fa fa-calendar"></i> Live
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#default.view.page.links" class="lbhp text-red bg-right">
                                <i class="fa fa-life-ring"></i> Aide
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php } ?>
        <!-- /.navbar-collapse -->
        <!-- <a type="button" class="lbh btn btn-link pull-right btn-menu-to-app hidden-top hidden-xs letter-green" data-target="#selectCreate" data-toggle="modal">
            <i class="fa fa-plus-circle"></i>           
        </a> -->
        <?php 
            if($subdomainName != "web") foreach (array_reverse($params["pages"]) as $key => $value) {
                if(@$value["inMenu"]==true){ ?>
                <a href="<?php echo $key; ?>" 
                    class="lbh btn btn-link letter-red pull-right btn-menu-to-app hidden-top hidden-xs
                            <?php if($subdomainName==$value["subdomainName"]) echo 'active'; ?>"
                    data-toggle="tooltip" data-placement="bottom" title="<?php echo $value["subdomainName"]; ?>">
                    <i class="fa fa-<?php echo $value["icon"]; ?>"></i>
                    <!-- <span class=""><?php echo $value["subdomainName"]; ?></span> -->
                </a>  
        <?php   }
            }  ?>
            
    </div>
    <!-- /.container-fluid -->

</nav>

<?php if($subdomain != "welcome"){ 
        $this->renderPartial($layoutPath.'loginRegister', array()); 
      } 
?>

<?php if(isset(Yii::app()->session['userId'])) {
        $CO2DomainName = isset(Yii::app()->params["CO2DomainName"]) ? Yii::app()->params["CO2DomainName"] : "CO2";
        $this->renderPartial($layoutPath.'modals.'.$CO2DomainName.'.selectCreate',  array( ) ); 
     }
?>

<?php if(isset(Yii::app()->session['userId'])) 
        $this->renderPartial($layoutPath.'notifications'); ?>

<?php $this->renderPartial($layoutPath.'formCreateElement'); ?>


<script>
// jQuery(document).ready(function() {    
//     setTimeout(function(){ $(".tooltips").tooltip(); }, 3500);
// });
</script> 