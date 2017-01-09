<?php $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.'; ?>
<style>
    .footer-above{
        background-color: #F2F2F2!important;
    }
    .btn-outline{
        background-color: rgba(255,255,255,0.5);
    }
    
</style>
<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="radio-tool">
    <a class="btn btn-primary" href="#page-top" data-target="#modalRadioTool" data-toggle="modal">
        <i class="fa fa-microphone"></i>
    </a>
</div>

<div class="scroll-top page-scroll">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>


<?php //if(@$subdomain == "web" || @$subdomain == "social"){ ?>
<!-- Footer -->
<footer class="text-center col-xs-12 pull-left no-padding">
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 text-left">
                    <h5><i class="fa fa-info-circle"></i> Informations générales</h5>
                    <a href="" class="text-white"><i class="fa fa-angle-right"></i> Conditions d'utilisations</a><br><br>
                    <a href="" class="text-white"><i class="fa fa-angle-right"></i> A propos</a><br>
                    <a href="" class="text-white"><i class="fa fa-angle-right"></i> PixelHumain</a><br>
                    <a href="" class="text-white"><i class="fa fa-angle-right"></i> Communecter</a><br>
                    <a href="" class="text-white"><i class="fa fa-angle-right"></i> Alpha Tango</a><br>
                    
                </div>
                <div class="col-lg-4">
                    <span class="font-blackoutT text-yellow-PH" style="font-size:20px;">by</span> 
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGO_PIXEL_HUMAIN.png" height=70>
                    
                </div>
                <div class="col-lg-4 text-right">
                    <h5>Contacts <i class="fa fa-address-card"></i></h5>
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
            </div>
        </div>
    </div>
</footer>
<?php //} ?>
    


