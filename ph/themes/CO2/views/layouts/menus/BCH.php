<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom no-padding">
    <div class="container bg-black">
                
        <ul class="nav navbar-nav navbar-right">
                    <li>
                    <a class="font-montserrat text-white padding-10" id="btn-open-search-bar">
                        <span><i class="fa fa-shopping-cart"></i></span>
                    </a>
                    </li>
                    <?php if (!@Yii::app()->session["userId"]){ ?>
                        <li>
                        <a class="letter-orange font-montserrat btn-menu-connect padding-10" 
                            data-toggle="modal" data-target="#modalLogin">
                            <span><i class="fa fa-2x fa-user-circle"></i></span>
                        </a>
                        </li>
                    <?php }else{ 
                        $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl); ?>
                        <li>
                        <a class="letter-orange font-montserrat padding-10"> 
                                <img class="img-circle" id="menu-thumb-profil" style="margin-top:-5px;" 
                                     width="25" height="25" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
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
                            <a href="#" class="dropdown-toggle padding-10 text-white" data-toggle="dropdown" role="button" style="height: 35px;">
                        <img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/<?php echo Yii::app()->language ?>.png" width="22"/> <span class="caret"></span></a>
                            <ul class="dropdown-menu arrow_box" role="menu" style="position: absolute !important;
                                top: 45px;
                                right: -65px;
                                left: inherit;
                                background-color: white;
                                border: 1px solid transparent;
                                -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
                                box-shadow: 0 6px 12px rgba(0,0,0,.175);">
                                <li><a href="javascript:;" onclick="setLanguage('en')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/en.png" width="25"/> <?php echo Yii::t("common","English") ?></a></li>
                                <li><a href="javascript:;" onclick="setLanguage('fr')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/fr.png" width="25"/> <?php echo Yii::t("common","French") ?></a></li>
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
            <span class="hidden-xs skills font-montserrat"><?php echo $mainTitle; ?></span>
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
                    <button class="letter-orange font-montserrat" id="btn-open-search-bar">
                        <span>Our circuits</span>
                    </button>

                    <button class="letter-orange font-montserrat" id="btn-open-search-bar">
                        <span>On the map</span>
                    </button>

                    <button class="letter-orange font-montserrat" id="btn-open-search-bar">
                        <span>Agenda</span>
                    </button>

                    <button class="letter-orange font-montserrat" id="btn-open-search-bar">
                        <span>Store</span>
                    </button>
                    <button class="letter-orange font-montserrat" id="btn-open-search-bar">
                        <span>Community</span>
                    </button>
                    
                    <button class="letter-orange font-montserrat" id="btn-open-search-bar">
                        <span>Contribute</span>
                    </button>
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
});
</script> 