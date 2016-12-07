
<?php 
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath, 
                                "subdomain"=>$subdomain)); 
?>
    
<!-- Portfolio Grid Section -->
<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="text-blue">
                    <!-- <i class="fa fa-search"></i><br> -->
                    Recherche loisir
                </h2>
                <hr class="angle-down">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/cabin.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-newspaper-o fa-3x"></i>
                    <h3>Actualités</h3>
                </a>
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/cake.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-plane fa-3x"></i>
                    <h3>Tourisme</h3>
                </a>
                <!-- <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> -->
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/circus.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-ticket fa-3x"></i>
                    <h3>Sorties culturelles</h3>
                </a>
                <!-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p> -->

            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/circus.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-glass fa-3x"></i><i class="fa fa-cutlery fa-3x"></i>
                    <h3>Bars restaurants</h3>
                </a>
                <!-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p> -->

            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/circus.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-film fa-3x"></i>
                    <h3>Cinémas</h3>
                </a>
                <!-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p> -->
            </div>

            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/circus.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-tag fa-3x"></i>
                    <h3>E-boutiques</h3>
                </a>
                <!-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p> -->
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Grid Section -->
<section id="portfolio">
    <div class="container">
        <div class="row" style="margin-top:50px;">
            <div class="col-lg-12 text-center">
                <h2 class="text-blue">
                    <!-- <i class="fa fa-search"></i><br> -->
                    Recherche pratique
                </h2>
                <hr class="angle-down">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-pl<!-- u -->s fa-3x"></i>
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/game.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-graduation-cap fa-3x"></i>
                    <h3>Scolaire</h3>
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-pl<!-- u -->s fa-3x"></i>
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/game.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-building-o fa-3x"></i>
                    <h3>Logement</h3>
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/game.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-car fa-3x"></i>
                    <h3>Véhicule</h3>
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-pl<!-- u -->s fa-3x"></i>
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/game.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-handshake-o fa-3x"></i>
                    <h3>Social</h3>
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/safe.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-id-card fa-3x"></i>
                    <h3>Administratif</h3>
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/submarine.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-dollar fa-3x"></i>
                    <h3>Banques</h3>
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-pl<!-- u -->s fa-3x"></i>
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/game.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-medkit fa-3x"></i>
                    <h3>Santé</h3>
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/safe.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-industry fa-3x"></i>
                    <h3>Industries</h3>
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/submarine.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-globe fa-3x"></i>
                    <h3>Environnement</h3>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Grid Section -->
<section id="portfolio" class="search-eco">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="text-green">
                    <!-- <i class="fa fa-search"></i><br> -->
                    Recherche verte
                </h2>
                <hr class="angle-down">
            </div>
        </div>
        <div class="row text-green">
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/cabin.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-handshake-o fa-3x"></i>
                    <h3>Solidarité</h3>
                </a>
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> -->
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/cake.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-group fa-3x"></i>
                    <h3>Associations</h3>
                </a>
                <!-- <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> -->
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/circus.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-plane fa-3x"></i>
                    <h3>Eco-tourisme</h3>
                </a>
                <!-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p> -->

            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/circus.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-diamond fa-3x"></i>
                    <h3>Artistes</h3>
                </a>
                <!-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p> -->

            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/circus.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-tag fa-3x"></i>
                    <h3>Petites annonces</h3>
                </a>
                <!-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p> -->
            </div>

            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <!-- <i class="fa fa-search-plus fa-3x"></i> -->
                        </div>
                    </div>
                    <!-- <img src="img/portfolio/circus.png" class="img-responsive" alt=""> -->
                    <i class="fa fa-recycle fa-3x"></i>
                    <h3>Recyclage</h3>
                </a>
                <!-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p> -->

            </div>
        </div>
    </div>
</section>


<!-- Portfolio Grid Section -->
<section id="portfolio" class="hidden">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Suggestions</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="img/portfolio/cabin.png" class="img-responsive" alt="">
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="img/portfolio/cake.png" class="img-responsive" alt="">
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="img/portfolio/circus.png" class="img-responsive" alt="">
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="img/portfolio/game.png" class="img-responsive" alt="">
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="img/portfolio/safe.png" class="img-responsive" alt="">
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="img/portfolio/submarine.png" class="img-responsive" alt="">
                </a>
            </div>
        </div>
    </div>
</section>

<script>
jQuery(document).ready(function() {
    
});
</script>