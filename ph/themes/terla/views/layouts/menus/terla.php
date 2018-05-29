<!-- Navigation -->
<style>
    #mainNav a.text-white{
        color:#ddd !important;
    }
    #mainNav a.text-white:hover{
        color:#ff7e00 !important;
    }

    #mainNav.navbar-default .navbar-nav > .open > a, 
    #mainNav.navbar-default .navbar-nav > .open > a:focus, 
    #mainNav.navbar-default .navbar-nav > .open > a:hover{
        background-color: transparent;
    }

    #mainNav .dropdown-menu > li > a:focus, 
    #mainNav .dropdown-menu > li > a:hover{
        background-color: #ff7e00;
    }

    .navbar-right li{
        display: inline-block;
    }
</style>
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom no-padding">
    <div class="container bg-black">            
        <ul class="nav navbar-nav navbar-right">
            <?php if (@Yii::app()->session["userIsAdmin"]){ ?>
                <li>
                    <a href='#pod.circuit'  data-modalshow="" class="text-white padding-10 btn-circuit lbhp hide">
                        <span>
                            <i class="fa fa-ravelry fa-2x letter-lightgrey"></i>
                            <span class="circuit-count topbar-badge badge animated bounceIn badge-transparent hide">
                            </span>
                        </span>
                    </a>
                </li>
            <?php } ?>
                <li>
                    <a href='#person.shoppingcart'  data-modalshow="" class="text-white padding-10 btn-shoppingCart lbhp">
                        <span>
                            <i class="fa fa-shopping-cart fa-2x letter-lightgrey"></i>
                            <span class="shoppingCart-count topbar-badge badge animated bounceIn badge-transparent hide">
                            </span>
                        </span>
                    </a>
                </li>
            <?php if (!@Yii::app()->session["userId"]){ ?>
                <li>
                    <a href="#register" class="text-white btn-menu-connect padding-10" style="margin-top: 1px;" 
                        data-toggle="modal" data-target="#modalRegister">
                        <span><i class="fa fa-2x fa-user-circle"></i></span>
                    </a>
                </li>
            <?php }else{ 
                $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl); ?>
                <li>
                    <a href="#page.type.<?php echo Person::COLLECTION ?>.id.<?php echo Yii::app()->session["userId"]?>" 
                        class="letter-orange font-montserrat padding-10 lbh"> 
                            <img class="img-circle" id="menu-thumb-profil" 
                                 width="30" height="30" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
                    </a>
                    <div class="dropdown pull-right" id="dropdown-user">
                        <div class="dropdown-main-menu">
                            <ul class="dropdown-menu arrow_box">
                                <li class="text-left">
                                    <a href="<?php echo Yii::app()->createUrl('/co2/person/logout'); ?>" 
                                        class="bg-white letter-red logout">
                                        <i class="fa fa-sign-out"></i> <?php echo Yii::t("common", "Log Out") ; ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <li>
            <?php } ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle padding-10 text-white margin-top-5 margin-left-5" 
                    data-toggle="dropdown" role="button" style="height: 35px;">
                    <img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/<?php echo Yii::app()->language ?>.png" width="22"/> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu arrow_box" role="menu" style="position: absolute !important;
                    top: 45px;
                    right: -65px;
                    left: inherit;
                    background-color: white;
                    border: 1px solid transparent;
                    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
                    box-shadow: 0 6px 12px rgba(0,0,0,.175);">
                    <li><a href="javascript:;" class="col-xs-12" onclick="setLanguage('en')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/en.png" width="25"/> <?php echo Yii::t("common","English") ?></a></li>
                    <li><a href="javascript:;" class="col-xs-12" onclick="setLanguage('fr')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/fr.png" width="25"/> <?php echo Yii::t("common","French") ?></a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header pull-left">
           
            <a href="#" class="btn btn-link menu-btn-back-category pull-left no-padding lbh" 
                <?php //if( $subdomain != "welcome" ) { echo 'data-target="#modalMainMenu" data-toggle="modal"' } ?>
            >
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGOS/<?php echo Yii::app()->params["CO2DomainName"]; ?>/logo.png" 
                     class="pull-left" height=45>
            </a>
            <?php 
                $params = CO2::getThemeParams(); 
            ?>
        </div>

       <div class="pull-right hidden-xs col-sm-3 col-md-3 col-lg-3 padding-5" id="input-search">
            <button class="btn btn-default hidden-xs pull-right menu-btn-start-search btn-directory-type letter-orange" 
                    data-type="<?php echo @$type; ?>">
                    <i class="fa fa-search"></i>
            </button>
            <div id="input-sec-search" class="pull-right col-sm-10 col-md-10 col-lg-10 no-padding">
                <input type="text" class="form-control padding-5" id="second-search-bar" 
                       placeholder="<?php echo $placeholderMainSearch; ?>">
                <div class="dropdown-result-global-search hidden-xs col-sm-6 col-md-5 col-lg-5 no-padding"></div>
            </div>
            
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="pull-right navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="pull-right">
                    
                    <a href="#circuits" class="lbh letter-orange font-montserrat">
                        <span><?php echo Yii::t("terla","Our circuits"); ?></span>
                    </a>
                 
                    <button class="letter-orange font-montserrat btn-show-map" id="btn-open-search-bar">
                        <span><?php echo Yii::t("common","On the map"); ?></span>
                    </button>

                    <a href="#agenda" class="lbh letter-orange font-montserrat">
                        <span><?php echo Yii::t("common","Agenda"); ?></span>
                    </a>

                    <!-- <a href="#store" class="lbh letter-orange font-montserrat">
                        <span>Store</span>
                    </a> -->
                    
                    <button class="letter-orange font-montserrat" id="btn-open-search-bar">
                        <span><?php echo Yii::t("common","Community"); ?></span>
                    </button>
                    
                    <button class="letter-orange font-montserrat" id="btn-open-search-bar">
                        <span><?php echo Yii::t("common","Contribute"); ?></span>
                    </button>

                    <a href="#info.p.contact" class="letter-orange font-montserrat lbh">
                        <span><i class="fa fa-envelope" style="font-size: 16px;"></i></span>
                    </a>
                </li>
            </ul>
        </div>
        
            
        
            
    </div>
    <!-- /.container-fluid -->

</nav>
<?php $this->renderPartial($layoutPath.'modals.'.Yii::app()->params["CO2DomainName"].'.loginRegister', 
                            array("subdomain" => $subdomain)); ?>

<?php if(isset(Yii::app()->session['userId'])) 
        $this->renderPartial($layoutPath.'notifications'); ?>

<?php $this->renderPartial($layoutPath.'formCreateElement'); ?>


<script>
jQuery(document).ready(function() {    
   // $("#input-search").hide();
    $("#btn-open-search-bar").click(function(){ 
        if($("#input-search").hasClass("hidden")){
            $("#input-search").removeClass("hidden");
            $("#input-search").show(500);
        }
        else {
            $("#input-search").hide(500);
            setTimeout(function(){
                $("#input-search").addClass("hidden");
            }, 600);
        }
    });
    shopping.countShoppingCart("init");
    circuit.countCircuit("init");
});


function addBtnSwitch(){ 

    $(".addBtnFoot").addClass("hidden");
    $(".addBtnAll").removeClass("hidden");
    

    var fname = "<?php echo Yii::t("common", "as") ?> ";
    if ( contextData != null && contextData.type && inArray( contextData.type,[ "organizations","citoyens","events","projects" ] ) )
        fname += contextData.name;
    else 
        fname += userConnected.name;

    $("#addFootTitle").html('<i class="fa fa-plus-circle"></i> <?php echo Yii::t("common", "Add something") ?> '+fname);

    if(contextData != null && contextData.type == "citoyens" || contextData == null){
        $(".addBtnFoot").removeClass("hidden");
    }
    else if(contextData.type == "organizations")
        $(".addBtnFoot_orga").removeClass("hidden");
    else if(contextData.type == "projects")
        $(".addBtnFoot_project").removeClass("hidden");
    else if(contextData.type == "events")
        $(".addBtnFoot_event").removeClass("hidden");

    
}
</script> 