<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button> -->

            <!-- <img src="img/NC_map.png" class="nc_map_min" height=30> -->
            <a href="#page-top"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/logocagou-<?php echo $subdomain; ?>.png" class="nc_map pull-left" height=30></a>
            <span class="skills font-montserrat"><?php echo $mainTitle; ?></span>

            <a class="navbar-brand font-blackoutM" href="#page-top">
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
            <div class="col-xs-8 col-sm-5 col-md-7 col-lg-6 hidden-top scopes">
                <!-- <input type="text" class="form-control" id="second-search-bar" placeholder="Que recherchez vous ?"> -->
                <button class="btn text-red bg-white btn-scope"><i class="fa fa-circle-o"></i> Nouméa</button>
                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province Sud</button>
                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province Nord</button>
                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province des Îles</button>
                <button class="btn text-white bg-red btn-scope"><i class="fa fa-plus"></i></button>
            </div>
        <?php }elseif($subdomain == "web"){ ?>
            <div class="col-xs-8 col-sm-5 col-md-8 col-lg-4">
                <input type="text" class="form-control" id="second-search-bar" placeholder="<?php echo $mainTitle; ?>">
            </div>
        <?php } ?>
       
       <!--  <h3 class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="main-title-top">
            <i class="fa fa-angle-right"></i> Calédoogle
        </h3> -->

        <button class="btn-show-map"><i class="fa fa-map"></i></button>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll">
                    <a href="#k.web" class="lbh text-red"><i class="fa fa-search"></i> <span class="font-">Web</span></a>
                </li>
                <li class="page-scroll">
                    <a href="#k.live" class="lbh text-red"><i class="fa fa-rss"></i>  <span class="font-">Live</span></a>
                </li>
                <li class="page-scroll">
                    <a href="#contact" class="text-dark font-montserrat"><i class="fa fa-sign-in"></i></a>
                </li>
            </ul>
        </div>

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->


</nav>