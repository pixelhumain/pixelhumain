<!-- Navigation -->
<nav class="navbar-custom navbar-map">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll pull-left">
            <a href="#" class="lbh">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGOS/<?php echo Yii::app()->params["CO2DomainName"]; ?>/logo-min.png" style="padding-right:20px;" class="logo-menutop pull-left" height=30>
            </a>
        </div>

        <span id="map-loading-data">Chargement en cours...</span>


        <button class="btn-show-map"  data-toggle="tooltip" data-placement="bottom" title="Fermer la carte">
            <i class="fa fa-times"></i>
        </button>
        
       
        <button class="btn btn-default hidden-xs pull-right shadow2 letter-orange" id="menu-map-btn-start-search">
            <i class="fa fa-search"></i>
        </button>
        <div class="hidden-xs col-sm-5 col-md-4 col-lg-3 pull-right no-padding">
            <input type="text" class="form-control shadow2 text-dark" id="input-search-map" placeholder="Rechercher sur la carte">
        </div>

        <div class="pull-right navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="pull-right">
                    
                    <a href="#activities" class="lbh letter-orange font-montserrat">
                        <span>Our circuits</span>
                    </a>
                 
                    <button class="letter-orange font-montserrat" id="btn-open-search-bar">
                        <span>On the map</span>
                    </button>

                    <a href="#agenda" class="lbh letter-orange font-montserrat">
                        <span>Agenda</span>
                    </a>

                    <a href="#store" class="lbh letter-orange font-montserrat">
                        <span>Store</span>
                    </a>
                    <button class="letter-orange font-montserrat" id="btn-open-search-bar">
                        <span>Community</span>
                    </button>
                    
                    <button class="letter-orange font-montserrat" id="btn-open-search-bar">
                        <span>Contribute</span>
                    </button>
                </li>
            </ul>
        </div>
        

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->


</nav>