
<style>
    .footer-above{
        background-color: #F2F2F2!important;
    }
    #sectionSearchResults{
        min-height:200px!important;
    }
    .btn-outline{
        background-color: rgba(255,255,255,0.5);
    }
</style>
<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

<!-- Footer -->
<footer class="text-center col-xs-12 pull-left no-padding">
    <?php if($subdomain == "web"){ ?>
    <div class="footer-above">
        <div class="container">
            <div class="row text-dark">
                <div class="footer-col col-md-6">
                    <h5><i class="fa fa-fw fa-angle-right"></i> continuer la recherche sur</h5>
                    <h4><img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/google.png" height=50></h4>
                </div>
                <div class="footer-col col-md-6">
                    <h5><i class="fa fa-fw fa-angle-right"></i> continuer la recherche sur</h5>              
                    <h4><img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/kgougle_social.png" height=50></h4>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 text-right">
                    <ul class="list-inline">
                        <li>
                            <a href="#" class="btn-social btn-outline text-dark"><i class="fa fa-fw fa-github"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline text-dark"><i class="fa fa-fw fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline text-dark"><i class="fa fa-fw fa-envelope-o"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <span class="font-blackoutT text-yellow-PH" style="font-size:20px;">by</span> 
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGO_PIXEL_HUMAIN.png" height=70>
                </div>
                <div class="col-lg-4 text-right">
                    <h5>Informations générales  <i class="fa fa-info-circle"></i></h5>
                    <a href="" class="text-white">Conditions d'utilisations</a> <i class="fa fa-angle-left"></i><br><br>
                    <a href="" class="text-white">Le concept KGOUGLE</a> <i class="fa fa-angle-left"></i><br>
                    <a href="" class="text-white">PH : PixelHumain</a> <i class="fa fa-angle-left"></i><br>
                    <a href="" class="text-white">Communecter</a> <i class="fa fa-angle-left"></i><br>
                    <a href="" class="text-white">Alpha Tango</a> <i class="fa fa-angle-left"></i><br>
                </div>
            </div>
        </div>
    </div>
</footer>