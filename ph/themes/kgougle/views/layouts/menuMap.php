<!-- Navigation -->
<nav class="navbar-custom navbar-map">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll pull-left">

            <a href="#page-top"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/logocagou-map.png" class="nc_map pull-left" height=30></a>
            
            <a class="navbar-brand font-blackoutM hidden-xs" href="#page-top">
                <span class="letter letter-blue font-ZILAP letter-k">K</span>
                <!-- <span class="letter letter-blue font-ZILAP">A</span> -->
                 <span class="letter letter-yellow">G</span>
                <span class="letter letter-yellow font-ZILAP">O</span>
                <span class="letter letter-yellow">U</span>
                <span class="letter letter-green">G</span>
                <span class="letter letter-green">L</span>
                <span class="letter letter-green">E</span>
                <small class="letter letter-red pastille font-blackoutT">map</small>
            </a>
        </div>
       
        <div class="col-xs-7 col-sm-5 col-md-5 col-lg-4 no-padding">
            <input type="text" class="form-control" id="input-search-map" placeholder="Rechercher sur la carte">
        </div>

        <button class="btn btn-default" id="menu-map-btn-start-search"><i class="fa fa-search"></i></button>
        
        <button class="btn-show-map"  data-toggle="tooltip" data-placement="bottom" title="Fermer la carte"><i class="fa fa-times"></i></button>
        <button class="btn-show-mainmenu" onclick="showMap(false);" title="Menu principal" data-target="#modalMainMenu" data-toggle="modal">
            <i class="fa fa-th tooltips" data-toggle="tooltip" data-placement="bottom" title="Menu principal"></i>
        </button>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="pull-right">
            <ul class="nav navbar-nav navbar-right">
                <?php 
                    if( isset( Yii::app()->session['userId']) ){
                      $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
                ?> 
                      <button class="dropdown-toggle menu-name-profil text-dark lbh" 
                              data-toggle="dropdown" data-hash="#element.detail.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>">
                                <small><?php echo $me["username"]; ?></small> 
                                <img class="img-circle" id="menu-thumb-profil" 
                                     width="40" height="40" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
                      </button>

                <?php } else { ?>
                    <li class="page-scroll">
                        <button class="text-red font-montserrat" data-toggle="modal" data-target="#modalLogin"><i class="fa fa-sign-in"></i> SE CONNECTER</button>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->


</nav>