<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header pull-left">
           
            <a href="#" class="btn btn-link menu-btn-back-category pull-left no-padding lbh" 
                <?php //if( $subdomain != "welcome" ) { echo 'data-target="#modalMainMenu" data-toggle="modal"' } ?>
            >
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGOS/<?php echo Yii::app()->params["CO2DomainName"]; ?>/logo-min.png" 
                     class="logo-menutop pull-left" height=30>
            </a>
            <span class="hidden-xs skills font-montserrat"><?php echo $mainTitle; ?></span>
            <?php 
                $params = CO2::getThemeParams(); 
            ?>
            
        </div>


        <button class="btn-show-map"  data-toggle="tooltip" data-placement="bottom" 
                title="<?php Yii::t("common", "Show the map") ?>">
            <i class="fa fa-map"></i>
        </button>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="pull-right navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="pull-right">
                    <button class="letter-orange font-montserrat" id="btn-open-search-bar">
                        <span><i class="fa fa-2x fa-search"></i></span>
                    </button>
                    <button class="letter-orange font-montserrat btn-menu-connect" 
                            data-toggle="modal" data-target="#modalLogin">
                        <span><i class="fa fa-2x fa-user-circle"></i></span>
                    </button>
                    <button class="letter-orange font-montserrat">
                        <span><i class="fa fa-2x fa-flag"></i> FR</span>
                    </button>
                </li>
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
                    </ul>
                </div>
            </div>
        <?php } ?>
        <!-- /.navbar-collapse -->
        <!-- <a type="button" class="lbh btn btn-link pull-right btn-menu-to-app hidden-top hidden-xs letter-green" data-target="#selectCreate" data-toggle="modal">
            <i class="fa fa-plus-circle"></i>           
        </a> -->
            
        <div class="pull-right hidden-xs col-sm-5 col-md-5 col-lg-5 hidden" id="input-search">
            <button class="btn btn-default hidden-xs pull-right menu-btn-start-search btn-directory-type" 
                    data-type="<?php echo @$type; ?>">
                    <i class="fa fa-search"></i>
            </button>
            <div id="input-sec-search" class="pull-right col-sm-10 col-md-10 col-lg-10 no-padding">
                <input type="text" class="form-control" id="second-search-bar" 
                       placeholder="<?php echo $placeholderMainSearch; ?>">
                <div class="dropdown-result-global-search hidden-xs col-sm-6 col-md-5 col-lg-5 no-padding"></div>
            </div>
            
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
    $("#input-search").hide();
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