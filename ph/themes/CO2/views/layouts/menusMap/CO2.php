<!-- Navigation -->
<nav class="navbar-custom navbar-map">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll pull-left">
            <a href="#page-top"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2G.png" class="nc_map pull-left" height=30></a>
            
            <a class="navbar-brand font-blackoutM hidden-xs  hidden-sm" href="#page-top">
                <small class="letter letter-red pastille font-blackoutT">map</small>
            </a>
        </div>
       
        <div class="hidden-xs col-sm-5 col-md-4 col-lg-4 no-padding">
            <input type="text" class="form-control" id="input-search-map" placeholder="Rechercher sur la carte">
        </div>

        <button class="btn btn-default hidden-xs" id="menu-map-btn-start-search"><i class="fa fa-search"></i></button>
        
        <button class="btn-show-map"  data-toggle="tooltip" data-placement="bottom" title="Fermer la carte"><i class="fa fa-times"></i></button>
        <!-- <button class="btn-show-mainmenu" onclick="showMap(false);" title="Menu principal" data-target="#modalMainMenu" data-toggle="modal">
            <i class="fa fa-th tooltips" data-toggle="tooltip" data-placement="bottom" title="Menu principal"></i>
        </button> -->
        <div class="dropdown pull-right">
            <button class="btn-show-mainmenu  dropdown-toggle" title="Menu principal" data-toggle="dropdown"  id="btn-main-menu">
                <i class="fa fa-th tooltips" data-toggle="tooltip" data-placement="bottom" title="Menu principal"></i>
            </button>
            <div class="dropdown-main-menu font-montserrat" aria-labelledby="btn-main-menu">
                <ul class="dropdown-menu arrow_box">
                    <?php foreach(array("web"=>"search", 
                                        "live"=>"newspaper-o", 
                                        "social"=>"user-circle-o", 
                                        //"freedom"=>"comments", 
                                        //"agenda"=>"calendar", 
                                        //"power"=>"hand-rock-o"
                                        ) as $link=>$icon){ ?>
                        <li class="text-left" style="font-size:25px; ">
                            <a href="#k.<?php echo $link; ?>" class="lbh bg-white">
                                <span class="font-blackoutM text-red">
                                    <i style="width:30px;" class="text-center text-red fa fa-<?php echo $icon; ?>"></i> 
                                    <?php echo $link; ?>
                                </span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="pull-right">
            <ul class="nav navbar-nav navbar-right">
                <?php 
                    if( isset( Yii::app()->session['userId']) ){
                      $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
                ?> 
                      <button class="dropdown-toggle menu-name-profil text-dark lbh" 
                              data-toggle="dropdown" data-hash="#element.detail.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>">
                                <small class="hidden-xs"><?php echo $me["username"]; ?></small> 
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