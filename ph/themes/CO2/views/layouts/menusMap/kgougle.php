<!-- Navigation -->
<nav class="navbar-custom navbar-map">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll pull-left">
            
            <a class="navbar-brand hidden-xs font-blackoutM" style="padding-right:20px;">
                 <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" 
                     class="nc_map pull-left" height=25>           
                <small class="letter letter-red pastille font-blackoutT" style="margin-top:32px;">map</small>
            </a>
            
        </div>
       
        <div class="col-sm-5 col-md-4 col-lg-4 col-xs-7 no-padding">
            <input type="text" class="form-control" id="input-search-map" placeholder="Rechercher...">
        </div>

        <button class="btn btn-default hidden-xs" id="menu-map-btn-start-search">
            <i class="fa fa-search"></i>
        </button>
        
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
                      <button class="dropdown-toggle menu-name-profil text-dark lbh" 
                              data-toggle="dropdown" data-hash="#app.page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>">
                                <small class="hidden-xs"><?php echo $me["name"]; ?></small> 
                                <img class="img-circle" id="menu-thumb-profil" 
                                     width="40" height="40" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
                      </button>

                <?php } ?>
            </ul>
        </div>

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->


</nav>
