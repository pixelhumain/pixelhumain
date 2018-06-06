<!-- Navigation -->
<nav class="navbar-custom navbar-map">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll pull-left">
            <a href="#" class="lbh">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGOS/<?php echo Yii::app()->params["CO2DomainName"]; ?>/logo-min.png" style="padding-right:20px;" class="logo-menutop pull-left" height=30>
            </a>
        </div>
       
        <div class="hidden-xs col-sm-5 col-md-4 col-lg-4 no-padding">
            <input type="text" class="form-control" id="input-search-map" placeholder="<?php echo Yii::t('common', 'Search on map'); ?>">
        </div>

        <button class="btn btn-default hidden-xs" id="menu-map-btn-start-search">
            <i class="fa fa-search"></i>
        </button>
        <span id="map-loading-data">Chargement en cours...</span>
        <button class="btn-show-map"  data-toggle="tooltip" data-placement="bottom" title="Fermer la carte">
            <i class="fa fa-times"></i>
        </button>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="pull-right">
            <ul class="nav navbar-nav navbar-right">
                <?php 
                    if( isset( Yii::app()->session['userId']) ){
                      $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
                ?> 
                      <a class="menu-name-profil text-dark lbh" 
                              data-toggle="dropdown" href="#page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>">
                                <small class="hidden-xs"><?php echo @$me["name"]; ?></small> 
                                <img class="img-circle" id="menu-thumb-profil" 
                                     width="40" height="40" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
                      </a>

                <?php } else { ?>
                    <!-- <li class="page-scroll">
                        <button class="text-red font-montserrat" data-toggle="modal" data-target="#modalLogin"><i class="fa fa-sign-in"></i> SE CONNECTER</button>
                    </li> -->
                <?php } ?>
            </ul>
        </div>

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->


</nav>