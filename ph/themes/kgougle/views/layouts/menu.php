<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button> -->

            <!-- <img src="img/NC_map.png" class="nc_map_min" height=30> -->
            <a href="#k.web" class="btn-scroll menu-btn-back-category" data-targetid="#page-top">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/logocagou-<?php echo $subdomain; ?>.png" 
                     class="nc_map pull-left" height=30>
            </a>
            <span class="hidden-xs skills font-montserrat"><?php echo $mainTitle; ?></span>

            <a class="navbar-brand font-blackoutM btn-scroll menu-btn-back-category" data-targetid="#page-top" href="#k.web">
                <span class="letter letter-blue font-ZILAP letter-k">K</span>
                <!-- <span class="letter letter-blue font-ZILAP">A</span> -->
                 <span class="letter letter-yellow">G</span>
                <span class="letter letter-yellow font-ZILAP">O</span>
                <span class="letter letter-yellow">U</span>
                <span class="letter letter-green">G</span>
                <span class="letter letter-green">L</span>
                <span class="letter letter-green">E</span>
                <small class="letter letter-red pastille font-blackoutT"><?php echo $subdomain; ?></small>
            </a>
        </div>

        <?php if($subdomain == "live"){ ?>
            <!-- <div class="col-xs-8 col-sm-5 col-md-7 col-lg-6 hidden-top scopes hidden">
                <input type="text" class="form-control" id="second-search-bar" placeholder="Que recherchez vous ?">
                <button class="btn text-red bg-white btn-scope"><i class="fa fa-circle-o"></i> Nouméa</button>
                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province Sud</button>
                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province Nord</button>
                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province des Îles</button>
                <button class="btn text-white bg-red btn-scope"><i class="fa fa-plus"></i></button>
            </div> -->
            <div class="col-xs-8 col-sm-3 col-md-5 col-lg-4">
                <input type="text" class="form-control" id="second-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
            </div>
            <button class="btn btn-default pull-left menu-btn-start-search"><i class="fa fa-search"></i></button>
        <?php }elseif($subdomain == "web"){ ?>
            <div class="col-xs-8 col-sm-3 col-md-5 col-lg-4">
                <input type="text" class="form-control" id="second-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
            </div>
            <button class="btn btn-default pull-left menu-btn-start-search"><i class="fa fa-search"></i></button>

             <!-- <button class="btn btn-default pull-left menu-btn-back-category"><i class="fa fa-cubes"></i></button> -->
        <?php } ?>
       
       <!--  <h3 class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="main-title-top">
            <i class="fa fa-angle-right"></i> Calédoogle
        </h3> -->

        <button class="btn-show-map"  data-toggle="tooltip" data-placement="bottom" title="Afficher la carte"><i class="fa fa-map"></i></button>
        <button class="btn-show-mainmenu " title="Menu principal" data-target="#modalMainMenu" data-toggle="modal">
            <i class="fa fa-th tooltips" data-toggle="tooltip" data-placement="bottom" title="Menu principal"></i>
        </button>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll hidden">
                    <a href="#k.web" class="lbh text-red"><i class="fa fa-search"></i> <span class="font-">Web</span></a>
                </li>
                <li class="page-scroll hidden">
                    <a href="#k.live" class="lbh text-red"><i class="fa fa-rss"></i>  <span class="font-">Live</span></a>
                </li>
                <li class="page-scroll">
                    <a href="#contact" class="text-red font-montserrat"><i class="fa fa-sign-in"></i> Se connecter</a>
                </li>
            </ul>
        </div>

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->


</nav>


<div class="portfolio-modal modal fade" id="modalMainMenu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="name font-blackoutM" >
                        <span class="letter letter-blue font-ZILAP letter-k">K</span>
                        <span class="letter letter-yellow">G</span>
                        <span class="letter letter-yellow font-ZILAP">O</span>
                        <span class="letter letter-yellow">U</span>
                        <span class="letter letter-green">G</span>
                        <span class="letter letter-green">L</span>
                        <span class="letter letter-green">E</span>
                    </span>
                    <h3 class="letter-red no-margin">Le web, en mieux</h3>
                </div>
                <div class="col-lg-12">
                    <p></p>
                </div>
            </div>
            <div class="row">
                <a href="#k.web" class="lbh col-lg-6" data-dismiss="modal">
                    <div class="modal-body text-left">
                        
                            <h2 class="text-red"><i class="fa fa-tv padding-bottom-10"></i><br>
                                <span class="font-blackoutT">WEB</span>
                            </h2>
                        
                            <div class="col-md-12 text-center">
                                <h5>Un moteur de recherche simplifié<small><br>pour un accès rapide<br>à tous sites web dont vous avez besoin</small></h5>
                            </div>
                        
                    </div>
                </a>
                <a href="#k.social" class="col-lg-6" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-red"><i class="fa fa-user-circle padding-bottom-10"></i><br><span class="font-blackoutT"> SOCIAL</span></h2>
                        
                        <div class="col-md-12 text-center">
                            <h5>Un réseau social local<small><br>pour être connecté à son territoire<br>et à ses amis</small></h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="row margin-top-50">    
                <a href="#k.live" class="lbh col-lg-6" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-red"><i class="fa fa-newspaper-o"></i><br><span class="font-blackoutT"> LIVE</span></h2>
                        
                        <div class="col-md-12 text-center">
                            <h5>Un espace d'information<small><br>pour suivre en direct<br>toute l'actualité du pays</small></h5>
                        </div>
                    </div>
                </a>

                <a href="#k.freedom" class="col-lg-6" data-dismiss="modal">
                    <div class="modal-body text-left">
                        <h2 class="text-red"><i class="fa fa-comments"></i><br><span class="font-blackoutT"> FREEDOM</span></h2>
                        
                        <div class="col-md-12 text-center">
                            <h5>Un espace d'expression libre<small><br>pour discuter, échanger, partager<br>avec tous les Cagous</small></h5>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 text-center">
                    <hr>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class=""></i> Retour</button>
                </div>
            </a>
        </div>
    </div>
</div>
