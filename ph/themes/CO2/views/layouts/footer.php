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
                    <h5><i class="fa fa-info-circle hidden-xs"></i> Informations générales</h5>
                    <a href="#info.p.apropos" class="lbh text-white"><i class="fa fa-angle-right"></i> A propos</a><br>
                    <a href="#info.p.mention" class="text-white">
                        <i class="fa fa-angle-right"></i> Mentions légales
                    </a><br>
                    <a href="../doc/Conditions Générales d'Utilisation.pdf" class="text-white">
                        <i class="fa fa-angle-right"></i> Conditions d'utilisations
                    </a><br><br>
                    <a href="#info.p.communecter" target="_blank" class="margin-right-10 hidden-xs">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/Logo_Licence_Ouverte_noir_avec_texte.gif" height=30>
                    </a>
                    
                    <a href="#info.p.communecter" target="_blank" class=" hidden-xs">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/opensource.gif" height=30>
                    </a>
                    
                    
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-footer-ph">
                    <span class="font-blackoutT text-yellow-PH" style="font-size:20px;">by</span> 
                    <a href="#info.p.ph" target="_blank">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGO_PIXEL_HUMAIN.png" height=70>
                    </a><br><br>

                    <a href="#info.p.communecter" target="_blank" class=" hidden-xs">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height=30>
                    </a>


                    <!-- <h5 class="homestead letter-red">COMMUNECTER</h5> -->
                    
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 text-right col-footer hidden-xs">
                    <h5>Contacter <a href="#info.p.alphatango" class="lbh text-azure">@Alpha_Tango</a></h5>
                    <ul class="list-inline">
                        <li>
                            <a href="https://github.com/Kgneo" target="_blank" class="btn-social btn-outline text-dark">
                                <i class="fa fa-fw fa-github"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/kgouglenc-131036664103754/" target="_blank" 
                               class="btn-social btn-outline text-dark">
                                <i class="fa fa-fw fa-facebook"></i>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="#" class="btn-social btn-outline text-dark">
                                <i class="fa fa-fw fa-facebook"></i>
                            </a>
                        </li> -->
                        <li>
                            <a href="#info.p.alphatango" class="btn-social btn-outline text-dark lbh">
                                <i class="fa fa-fw fa-envelope-o"></i>
                            </a>
                        </li>
                    </ul>
                    <button class="btn btn-link text-white no-padding"  
                        data-toggle="modal" data-target="#modalLogin">
                        <i class="fa fa-lock"></i> Admin
                    </button><br>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php //} ?>
    


