<?php $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.'; ?>

<style>
    .footer-above{
        background-color: #F2F2F2!important;
    }
    .btn-outline{
        background-color: rgba(255,255,255,0.5);
    }

@media screen and (max-width: 1024px) {
    
    .col-footer a.lbh{
        padding: 4px;
        display: inline-block;
    }
}

@media (max-width: 768px) {

    .col-footer-ph{
        text-align: right!important
    }
}

    
</style>

<?php
    $iconBtnRightBottom = "chevron-up";
    if(Yii::app()->params["CO2DomainName"] == "kgougle" && false)//{ 
        $iconBtnRightBottom = "search";
?>
    <!-- <div class="radio-tool tooltips" data-toggle="tooltip" data-placement="right" title="Écouter la radio">
        <a class="btn btn-primary" href="#page-top" data-target="#modalRadioTool" data-toggle="modal">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/radio-icon-2.png" height="30">
        </a>
    </div> -->
<?php //} ?>

<div class="scroll-top">
    <a class="btn btn-primary bg-blue" href="javascript:KScrollTo('.main-container');">
        <i class="fa fa-<?php echo $iconBtnRightBottom; ?>"></i>
    </a>
</div>


<?php //if(@$subdomain == "web" || @$subdomain == "social"){ ?>
<!-- Footer -->
<footer class="col-xs-12 pull-left no-padding">
    <div class="footer-below bg-orange-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 text-left col-footer">
                    <h5>Informations pratiques</h5>
                    <a href="default/view/page/openatlas/dir/docs|panels" class="lbhp text-white"><i class="fa fa-angle-right"></i> A propos</a><br>
                    <a href="default/view/page/mention/dir/docs|panels" class="text-white lbhp">
                        <i class="fa fa-angle-right"></i> Mentions légales
                    </a><br>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/doc/Conditions Générales d'Utilisation.pdf" target="_blank" class="text-white">
                        <i class="fa fa-angle-right"></i> Conditions d'utilisations
                    </a><br><br>
                    <!-- <a href="#info.p.communecter" target="_blank" class="margin-right-10 hidden-xs">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/Logo_Licence_Ouverte_noir_avec_texte.gif" height=30>
                    </a> -->
                    
                    <a href="https://fr.wikipedia.org/wiki/Open_source" target="_blank" class=" hidden-xs">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/opensource.gif" height=40 
                            style="margin-top: -10px;border-radius: 3px;">
                    </a>
                    <a href="https://github.com/pixelhumain" target="_blank" 
                        class=" hidden-xs">
                        <i class="fa fa-github fa-2x bg-white img-circle padding-5 margin-5"></i>
                    </a>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-footer-ph">
                    <h5>A propos</h5>
                    <a href="default/view/page/openatlas/dir/docs|panels" class="lbhp text-white">
                        <i class="fa fa-angle-right"></i> A propos de cyberun
                    </a><br>
                    <a href="default/view/page/mention/dir/docs|panels" class="text-white lbhp">
                        <i class="fa fa-angle-right"></i> ...
                    </a><br>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/doc/Conditions Générales d'Utilisation.pdf" target="_blank" class="text-white">
                        <i class="fa fa-angle-right"></i> ...
                    </a><br><br>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-footer-ph">
                    <h5>Mentions légales</h5>
                    <a href="default/view/page/openatlas/dir/docs|panels" class="lbhp text-white">
                        <i class="fa fa-angle-right"></i> ...
                    </a><br>
                    <a href="default/view/page/mention/dir/docs|panels" class="text-white lbhp">
                        <i class="fa fa-angle-right"></i> ...
                    </a><br>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/doc/Conditions Générales d'Utilisation.pdf" target="_blank" class="text-white">
                        <i class="fa fa-angle-right"></i> ...
                    </a><br><br>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 text-right col-footer hidden-xs">
                    <h5>
                        <i class="fa fa-envelope"></i> Social<br>
                        <span class="letter-white">contact@bch.com</span>
                    </h5>
                    <ul class="list-inline">
                        <li>
                            <a href="https://github.com/pixelhumain/co2" target="_blank" class="btn-social btn-outline text-dark">
                                <i class="fa fa-fw fa-github"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/communecter" target="_blank" 
                               class="btn-social btn-outline text-dark">
                                <i class="fa fa-fw fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com/communecter" target="_blank" 
                               class="btn-social btn-outline text-dark">
                                <i class="fa fa-fw fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://plus.google.com/communities/111483652487023091469" target="_blank" 
                               class="btn-social btn-outline text-dark">
                                <i class="fa fa-fw fa-google-plus"></i>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="#" class="btn-social btn-outline text-dark">
                                <i class="fa fa-fw fa-facebook"></i>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-below bg-orange-4">
        <div class="container">
            <div class="row">
            COPYRIGHT
            </div>
        </div>
    </div>
</footer>
<?php //} ?>
    


