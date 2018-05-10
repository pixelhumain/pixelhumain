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

<div class="scroll-top hidden">
    <a class="btn btn-primary" href="javascript:KScrollTo('.main-container');">
        <i class="fa fa-<?php echo $iconBtnRightBottom; ?>"></i>
    </a>
</div>


<?php //if(@$subdomain == "web" || @$subdomain == "social"){ ?>
<!-- Footer -->
<footer class="text-center col-xs-12 pull-left no-padding">
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-left col-footer">
                    <h5><i class="fa fa-info-circle hidden-xs"></i> <?php echo Yii::t("home", "General information"); ?></h5>
                    <a href="#docs.page.openatlas.dir.<?php echo Yii::app()->language ?>" class="lbh text-white"><i class="fa fa-angle-right"></i> <?php echo Yii::t("common","About") ?></a><br>
                    <a href="#docs.page.mention.dir.<?php echo Yii::app()->language ?>" class="text-white lbh">
                        <i class="fa fa-angle-right"></i> <?php echo Yii::t("home","Legal notice") ?>
                    </a><br>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/doc/Conditions Générales d'Utilisation.pdf" target="_blank" class="text-white">
                        <i class="fa fa-angle-right"></i> <?php echo Yii::t("home","Terms and conditions of use") ?>
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
                    <a href="https://www.infomaniak.com/fr" target="_blank" class="">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/logo-infomaniak.png" height=20 style="margin-top: -10px;border-radius: 3px;">
                    </a>
                    
                    
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-footer-ph">
                    <span class="font-blackoutT text-yellow-PH" style="font-size:20px;">by</span> 
                    <a href="https://www.communecter.org/#@pixelhumain" target="_blank">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGO_PIXEL_HUMAIN.png" height=70>
                    </a><br><br>

                    <a href="https://github.com/pixelhumain/co2" target="_blank" class=" hidden-xs">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height=30>
                    </a>


                    <!-- <h5 class="homestead letter-red">COMMUNECTER</h5> -->
                    
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 text-right col-footer hidden-xs">
                    <h5><i class="fa fa-envelope"></i> <?php echo Yii::t("home","CONTACT") ?> <br>+ 262 262 34 36 86<br>
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/contactCO_footer.png" height="17"/></h5>
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
</footer>
<?php //} ?>
    


