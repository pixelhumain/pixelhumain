<style>
    a.link-submenu-header{
        /*background-color: rgba(255, 255, 255, 0.8);
        border-radius: 10px;*/
        padding: 11px 10px;
        font-size: 12px;
        font-weight: bold;
    }
    a.link-submenu-header.active, 
    a.link-submenu-header:hover, 
    a.link-submenu-header:active{  
        border-bottom: 2px solid #ea4335;
        /*background-color: rgba(255, 255, 255, 1);*/
        color:#ea4335 !important;
        text-decoration: none;
    }

    .dropdown-menu.arrow_box{
        position: absolute !important;
        top: 51px;
        right: -65px;
        left: inherit;
        background-color: white;
        border: 1px solid transparent;
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
    }

    .btn-language{
        height: 35px;
        /*border-radius: 0% 50%;*/
        border:none;
        width: 50px;
    }


    .btn-star-fav {
        font-size: 18px;
        margin-top: 5px;
    }

    .menu-name-profil{
        margin-left:10px;
    }

    .navbar-nav .menu-button{
        width: 45px !important;
        margin-right: 0px;
        height: 30px;
        margin-top: 10px;
        font-size: 18px !important;
        padding:5px;
        position: relative;
    }
    .navbar-nav .menu-button:hover{
        color:grey !important;
    }
</style>
<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header pull-left">
            
            <a href="<?php echo Yii::app()->createUrl('/survey/co/index/id/cte'); ?>" class="btn btn-link menu-btn-back-category pull-left no-padding" >
                <img src="<?php echo Yii::app()->getModule("survey")->assetsUrl; ?>/images/custom/cte/TCO-LOGO-WEB.png" class="logo-menutop pull-left" height=35 style="vertical-align: middle"/> <span style="display:block" class="padding-15 hidden-xs">TCO : 1er CONTRAT DE TRANSITION ÉCOLOGIQUE</span>
            </a>
           
        </div>

        

        <?php if( isset( Yii::app()->session['userId']) ){ ?>
            <button class="btn-show-mainmenu btn btn-link" 
                    data-toggle="tooltip" data-placement="top" title="<?php echo Yii::t("common","Menu") ?>">
                <i class="fa fa-bars tooltips" ></i>
            </button>

        <?php } ?>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="pull-right navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php 
                    if( isset( Yii::app()->session['userId']) ){
                      $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->getParentAssetsUrl());
                      $countNotifElement = ActivityStream::countUnseenNotifications(Yii::app()->session["userId"], Person::COLLECTION, Yii::app()->session["userId"]);
                ?> 
                    <a  href="<?php echo Yii::app()->createUrl('/#page.type.'.Person::COLLECTION.'.id.'.Yii::app()->session['userId']); ?>"
                        class="menu-name-profil text-dark pull-right shadow2"
                        target="_blanck"
                        data-toggle="dropdown">
                            <small class="hidden-xs hidden-sm margin-left-10" id="menu-name-profil">
                                <?php echo @$me["name"] ? $me["name"] : @$me["username"]; ?>
                            </small> 
                            <img class="img-circle" id="menu-thumb-profil" 
                                 width="40" height="40" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >

                    </a>
                </a>
                <?php } else { ?>
                    <li class="pull-right">
                        <?php //if($subdomain != "welcome"){ ?>
                            <button class="letter-green font-montserrat btn-menu-connect margin-left-10 margin-right-10" 
                                    data-toggle="modal" data-target="#modalLogin" style="font-size: 17px; margin-top:12px;">
                                    <i class="fa fa-sign-in"></i> 
                                    <span class="hidden-xs"><small style="width:70%;"><?php echo Yii::t("login", "LOG IN") ?></small></span>
                            </button>
                        
                    </li>
                <?php } ?>
            </ul>
        </div>

        <?php if($subdomain == "web"){ ?>
            <button class="btn btn-link letter-yellow tooltips btn-star-fav pull-right font-montserrat"  
                    data-placement="bottom" title="Gérer vos favoris"
                    data-target="#modalFavorites" data-toggle="modal"><i class="fa fa-star"></i>
            </button>   
        <?php }?>
            
    </div>

</nav>

<?php if(@Yii::app()->session["userId"]){ ?>
 <div class="dropdown pull-right" id="dropdown-user">
    <div class="dropdown-main-menu">
        <ul class="dropdown-menu arrow_box">
            
            <li class="text-admin">
                <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true) ?>/survey/co/index/id/cte" class="lbh bg-white">
                    <i class="fa fa-home"></i> Accueil
                </a>
            </li>

            <li class="text-admin">
                <a href="https://www.communecter.org/#@cteTco" class=" bg-white">
                    <i class="fa fa-university"></i> Organisation CTE TCO 
                </a>
            </li>

              <?php 
                $class = "hidden" ;
                if( empty($me) || empty($me["address"]) || empty($me["address"]["codeInsee"]))
                    $class = "";
             if( Form::canAdmin("cte") ) { 
                ?>
                <li role="separator" class="divider"></li>
                <li class="text-admin">
                    <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true) ?>/survey/co/answers/id/cte" class="bg-white">
                        <i class="fa fa-bars"></i> Projets
                    </a>
                </li>
                <li class="text-admin">
                    <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true) ?>/survey/co/members/id/cte" class="bg-white">
                        <i class="fa fa-users"></i> Membres
                    </a>
                </li>
                <li class="text-admin">
                    <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true) ?>/survey/co/roles/id/cte" class="bg-white">
                        <i class="fa fa-file-text"></i> Fiches Actions
                    </a>
                </li>
            <?php } ?>


            <li role="separator" class="divider"></li>
            <li class="text-admin">
                <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/#page.type.".Person::COLLECTION.".id.".Yii::app()->session["userId"].".view.settings" ; ?>" target="_blanck" lass="lbh bg-white">
                    <i class="fa fa-cogs"></i> <?php echo Yii::t("common", "My parameters") ; ?>
                </a>
            </li>

            <li role="separator" class="divider"></li>
            <li class="text-left">
                <a href="<?php echo Yii::app()->createUrl('/co2/person/logout'); ?>" 
                    class="bg-white letter-red logout">
                    <i class="fa fa-sign-out"></i> <?php echo Yii::t("common", "Log Out") ; ?>
                </a>
            </li>


        </ul>
    </div>
</div>
<?php /* ?>
<div id="affix-sub-menu" class="hidden-xs affix">
    <div id="territorial-menu" class="col-md-10 col-sm-10 col-xs-12 margin-bottom-10">
                            
<a href="<?php echo Yii::app()->createUrl('/survey/co/index/id/cte'); ?>" class="#home btn btn-link pull-left btn-menu-to-app hidden-top link-submenu-header lbh-menu-app">
<i class="fa fa-home"></i>
<span class="searchModSpan">Accueil</span>
<span class=" topbar-badge badge animated bounceIn badge-warning"></span>
</a>  

<a href="<?php echo Yii::app()->createUrl('/survey/co/admin/id/cte'); ?>" class="#liveModBtn btn btn-link pull-left btn-menu-to-app hidden-top link-submenu-header lbh-menu-app">
<i class="fa fa-cogs"></i>
<span class="liveModSpan">Admin</span>
<span class=" topbar-badge badge animated bounceIn badge-warning"></span>
</a>  

<a href="<?php echo Yii::app()->createUrl('/survey/co/roles/id/cte'); ?>" class="#agendaModBtn btn btn-link pull-left btn-menu-to-app hidden-top link-submenu-header lbh-menu-app">
<i class="fa fa-file-text"></i>
<span class="agendaModSpan">Fiches Actions</span>
<span class=" topbar-badge badge animated bounceIn badge-warning"></span>
</a>  
 
                </div>
</div>

<?php */
    
} 

$this->renderPartial($layoutPath.'loginRegister', array("subdomain" => $subdomain)); 

if(isset(Yii::app()->session['userId'])) 
    $this->renderPartial($layoutPath.'notifications'); 

$this->renderPartial($layoutPath.'formCreateElement'); ?>


<script>
    
    $(".logout").click(function(){ 
        $.cookie("lyame", "null", { expires: 180, path : "/" });
        $.cookie("drowsp", "null", { expires: 180, path : "/" });
        $.cookie("remember", false, { expires: 180, path : "/" });
        window.location.href=baseUrl+"/survey/co/index/id/cte";
    });
    
</script>
