<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header pull-left">
           
            <a href="#" class="btn btn-link menu-btn-back-category pull-left no-padding lbh" 
                <?php //if( $subdomain != "welcome" ) { echo 'data-target="#modalMainMenu" data-toggle="modal"' } ?>
            >
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" 
                     class="logo-menutop pull-left" height=30>
            </a>
            <span class="hidden-xs skills font-montserrat"><?php echo Yii::t("common",$mainTitle); ?></span>
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
                        placeholder="<?php echo Yii::t("common", $placeholderMainSearch); ?>">
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
        
            <div id="input-sec-search" class="hidden-xs col-sm-2 col-md-3 col-lg-3">
                <input type="text" class="form-control" id="second-search-bar" 
                        placeholder="<?php echo Yii::t("common", $placeholderMainSearch); ?>">
                    <div class="dropdown-result-global-search hidden-xs col-sm-6 col-md-5 col-lg-5 no-padding"></div>
            </div>
            <button class="btn btn-default hidden-xs pull-left menu-btn-start-search btn-directory-type" 
                    data-type="<?php echo @$type; ?>">
                    <i class="fa fa-search"></i>
            </button>

        <?php } ?>

        <button class="btn-show-map"
                title="<?php echo Yii::t("common", "Show the map"); ?>"
                alt="<?php echo Yii::t("common", "Show the map"); ?>"
                >
            <i class="fa fa-map-marker"></i>
        </button>
        <?php if( !@Yii::app()->session['userId'] ){ ?>
            <div id="navbar" class="navbar-collapse pull-right navbar-right" style="    margin-top: 5px;   margin-bottom: 5px;">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle btn btn-default padding-5" data-toggle="dropdown" role="button" style="
    height: 35px;
    border-radius: 0% 50%;
    width: 50px;
">
                <img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/<?php echo Yii::app()->language ?>.png" width="22"/> <span class="caret"></span></a>
                    <ul class="dropdown-menu arrow_box" role="menu" style="    position: absolute !important;
    top: 45px;
    right: -65px;
    left: inherit;
    background-color: white;
    border: 1px solid transparent;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);">
                        <li><a href="javascript:;" onclick="setLanguage('en')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/en.png" width="25"/> <?php echo Yii::t("common","English") ?></a></li>
                        <li><a href="javascript:;" onclick="setLanguage('fr')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/fr.png" width="25"/> <?php echo Yii::t("common","French") ?></a></li>
                        <li><a href="javascript:;" onclick="setLanguage('de')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/de.png" width="25"/> <?php echo Yii::t("common","German") ?></a></li>
                    </ul>
                </li>
            </ul>
        </div> 
        <?php } ?>
        
        <!-- <button class="btn-show-mainmenu" title="Menu principal" data-target="#modalMainMenu" data-toggle="modal">
            <i class="fa fa-th tooltips" data-toggle="tooltip" data-placement="bottom" title="Menu principal"></i>
        </button> -->

        <?php if( isset( Yii::app()->session['userId']) ){ ?>
            
            <button class="menu-button btn btn-link btn-open-floopdrawer text-dark" 
                  data-toggle="tooltip" data-placement="top" title="Mon réseau" alt="<?php echo Yii::t("common","My network") ?>">
              <i class="fa fa-link"></i>
            </button>
            <button class="btn-show-mainmenu btn btn-link" 
                    data-toggle="tooltip" data-placement="top" title="Menu">
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
                        class="menu-name-profil lbh text-dark pull-right shadow2" 
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
                                    <a href="#page.type.<?php echo Person::COLLECTION ?>.id.<?php echo Yii::app()->session["userId"] ?>" class="lbh bg-white">
                                        <i class="fa fa-home"></i> <?php echo Yii::t("common","My page") ?>
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
                                    <a href="#page.type.<?php echo Person::COLLECTION ?>.id.<?php echo Yii::app()->session["userId"] ?>.view.settings" class="lbh bg-white">
                                        <i class="fa fa-cogs"></i> <?php echo Yii::t("common", "My parameters") ; ?>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li class="text-admin dropdown-submenu dropdown-menu-left">
                                    <a href="javascript:;" class="bg-white">
                                        <i class="fa fa-language"></i> <?php echo Yii::t("common", "Languages") ; ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                      <li><a href="javascript:;" onclick="setLanguage('en')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/en.png"/><?php echo Yii::t("common","English") ?></a></li>
                                      <li><a href="javascript:;" onclick="setLanguage('fr')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/fr.png"/><?php echo Yii::t("common","French") ?></a></li>
                                      <li><a href="javascript:;" onclick="setLanguage('de')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/de.png"/><?php echo Yii::t("common","German") ?></a></li>
                                    </ul>
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
                                        <i class="fa fa-search"></i> <?php echo Yii::t("common", "Search") ?>
                                    </a>
                                </li>
                                <li class="text-left visible-xs">
                                    <a href="#annonces" class="lbh bg-white">
                                        <i class="fa fa-bullhorn"></i> <?php echo Yii::t("common", "Ads") ?>
                                    </a>
                                </li>
                                <li class="text-left visible-xs">
                                    <a href="#agenda" class="lbh bg-white">
                                        <i class="fa fa-calendar"></i> <?php echo Yii::t("common", "Agenda") ?>
                                    </a>
                                </li>
                                <li class="text-left visible-xs">
                                    <a href="#live" class="lbh bg-white">
                                        <i class="fa fa-calendar"></i> <?php echo Yii::t("common", "Live") ?>
                                    </a>
                                </li>
                                <li class="text-left visible-xs">
                                    <a href="#default.view.page.links" class="lbhp bg-right">
                                        <i class="fa fa-life-ring"></i> <?php echo Yii::t("common", "Help") ?>
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
                          data-toggle="tooltip" data-placement="bottom" title="Notifications" alt="Notifications" style="border-left:none !important;">
                      <i class="fa fa-bell"></i>
                      <span class="notifications-count topbar-badge badge animated bounceIn 
                              <?php if(!@$countNotifElement || (@$countNotifElement && $countNotifElement=="0")) 
                              echo 'badge-transparent hide'; else echo 'badge-success'; ?>">
                            <?php echo @$countNotifElement ?>
                        </span>
                    </button>
                    
                    <button class="menu-button btn-menu btn-menu-chat text-dark pull-right hidden-xs" 
                          onClick='rcObj.loadChat("","citoyens", true, true)' data-toggle="tooltip" data-placement="bottom" title="Messagerie" alt="Messagerie">
                      <i class="fa fa-comments"></i>
                      <span class="chatNotifs topbar-badge badge animated bounceIn badge-warning"></span>
                    </button>

                <?php } else { ?>
                    
                    <li class="pull-right">
                        <?php if($subdomain != "welcome"){ ?>
                            <button class="letter-green font-montserrat btn-menu-connect margin-left-10" 
                                    data-toggle="modal" data-target="#modalLogin">
                                <span><i class="fa fa-sign-in"></i> <span class="hidden-xs hidden-sm"><?php echo Yii::t("login", "LOG IN") ?></span>
                            </button>
                        <?php } else { ?>
                            <div class="hidden-xs hidden-sm append-md-login">
                            <?php   $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
                                    $this->renderPartial($layoutPath.'forms.'.Yii::app()->params["CO2DomainName"].'.login'); 
                            ?>
                            </div>
                        <?php } ?>
                    </li>

                <?php } ?>
            </ul>
            <?php if (!@Yii::app()->session["userId"] && $subdomain == "welcome"){ ?>
                <button class="visible-xs visible-sm letter-green font-montserrat btn-menu-connect margin-top-10" 
                        data-toggle="modal" id="open-login-xs" style="font-size:20px;">
                    <span><i class="fa fa-sign-in"></i></span>
                </button>
                <div class="visible-xs visible-sm append-small-login hidden"></div>
            <?php } ?>
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
                                <i class="fa fa-search"></i> <?php echo Yii::t("common", "Search") ?>
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#annonces" class="lbh bg-white text-red">
                                <i class="fa fa-bullhorn"></i> <?php echo Yii::t("common", "Ads") ?>
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#agenda" class="lbh bg-white text-red">
                                <i class="fa fa-calendar"></i> <?php echo Yii::t("common", "Agenda") ?>
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#live" class="lbh bg-white text-red">
                                <i class="fa fa-calendar"></i> <?php echo Yii::t("common", "Live") ?>
                            </a>
                        </li>
                        <li class="text-left visible-xs">
                            <a href="#default.view.page.links" class="lbhp text-red bg-right">
                                <i class="fa fa-life-ring"></i> <?php echo Yii::t("common", "Help") ?>
                            </a>
                        </li>
                        <!--<li role="separator" class="divider"></li>
                        <li class="text-admin dropdown-submenu dropdown-menu-left">
                            <a href="javascript:;" class="bg-white">
                                <i class="fa fa-language"></i> <?php echo Yii::t("common", "Languages") ; ?>
                            </a>
                            <ul class="dropdown-menu">
                              <li><a href="javascript:;" onclick="setLanguage('en')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/en.png"/><?php echo Yii::t("common","English") ?></a></li>
                              <li><a href="javascript:;" onclick="setLanguage('fr')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/fr.png"/><?php echo Yii::t("common","French") ?></a></li>
                            </ul>
                        </li>-->
                    </ul>
                </div>
            </div>
        <?php } ?>
        <!-- /.navbar-collapse -->
        <a type="button" class="lbh btn btn-link pull-right btn-menu-to-app hidden-top hidden-xs letter-green" data-target="#chat" data-toggle="modal">
            <i class="fa fa-plus-comments"></i>           
        </a>
        <?php 
            if($subdomainName != "web") foreach (array_reverse($params["pages"]) as $key => $value) {
                if(@$value["inMenu"]==true){ ?>
                <a href="<?php echo $key; ?>" 
                    class="<?php echo $key; ?>ModBtn lbh btn btn-link letter-red pull-right btn-menu-to-app hidden-top hidden-xs
                            <?php if($subdomainName==$value["subdomainName"]) echo 'active'; ?> tooltips"
                    data-placement="bottom" data-original-title="<?php echo Yii::t("common",$value["subdomainName"]); ?>">
                    <i class="fa fa-<?php echo $value["icon"]; ?>"></i>

                    <!-- <span class=""><?php echo $value["subdomainName"]; ?></span> -->
                    <?php if(@$value["notif"]){ ?>
                    <span class="<?php echo $value["notif"]; ?> topbar-badge badge animated bounceIn badge-warning"></span>
                    <?php } ?>
                </a>  
        <?php   }
            }  ?>
            
    </div>
    <!-- /.container-fluid -->

</nav>
<?php //if($subdomain != "welcome"){ 
        $this->renderPartial($layoutPath.'loginRegister', array("subdomain" => $subdomain)); 
      //} else{ ?>
        <!--<div class="modal fade" role="dialog" id="modalRegisterSuccess">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-green-k text-white">
                        <h4 class="modal-title"><i class="fa fa-check"></i> <?php echo Yii::t("login","Account Created!!") ?></h4>
                    </div>
                    <div class="modal-body center text-dark hidden" id="modalRegisterSuccessContent"></div>
                    <div class="modal-body center text-dark">
                        
                        <h4 class="letter-green no-margin"><i class="fa fa-check-circle"></i> Confirmez votre adresse e-mail</h4>
                        <h4 class="no-margin">
                            <small>afin d'accéder à votre compte</small>
                        </h4>
                        <small class="no-margin">
                            <i class="fa fa-lock"></i> Pour des raisons de sécurité, vous devez confirmer votre adresse e-mail avant de pouvoir vous connecter.
                        </small>
                        <br><br>
                        <h5><i class="fa fa-angle-down"></i> Comment faire ?</h5>
                        <i class="fa fa-envelope-open" style="width:20px;"></i> <b>Vérifiez votre boîte e-mails</b><br>
                        <i class="fa fa-hand-o-up" style="width:20px;"></i> <b>Cliquez sur le lien d'activation</b> que nous vous avons envoyé.</br>
                        <hr>
                        <i class="fa fa-unlock" style="width:20px;"></i> Vous serez <b class="letter-green">connecté automatiquement</b> et redirigé vers votre page perso.
                            
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-default letter-green" data-dismiss="modal"><i class="fa fa-check"></i> J'ai compris</button>
                    </div>
                </div>
            </div>
        </div>-->
      <?php //}
?>

<?php /*if(isset(Yii::app()->session['userId'])) {
        $CO2DomainName = isset(Yii::app()->params["CO2DomainName"]) ? Yii::app()->params["CO2DomainName"] : "CO2";
        $this->renderPartial($layoutPath.'modals.'.$CO2DomainName.'.selectCreate',  array( ) ); 
     }*/
?>

<?php if(isset(Yii::app()->session['userId'])) 
        $this->renderPartial($layoutPath.'notifications'); ?>

<?php $this->renderPartial($layoutPath.'formCreateElement'); ?>


<script>
 // jQuery(document).ready(function() {    
 //     setTimeout(function(){ $(".tooltips").tooltip(); }, 3500);
 // });
</script> 