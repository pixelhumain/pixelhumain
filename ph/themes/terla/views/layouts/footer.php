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

<!-- <div class="scroll-top">
    <a class="btn btn-primary bg-blue" href="javascript:KScrollTo('.main-container');">
        <i class="fa fa-<?php echo $iconBtnRightBottom; ?>"></i>
    </a>
</div> -->


<?php

    $footer = array(array("title"=>"Info Pratiques",
                          "links"=>array(array( "label"=>"Comment ça marche ?",
                                                "link" => "#info.p.commentcamarche",
                                              ),
                                         array( "label"=>"Tuto bonne pratique",
                                                "link" => "#info.p.tuto",
                                              ),
                                         array( "label"=>"Nos brochures",
                                                "link" => "#info.p.brochures",
                                              ),
                                         array( "label"=>"FAQ",
                                                "link" => "#info.p.faq",
                                              ),
                                         array( "label"=>"Plan du site",
                                                "link" => "#info.p.plan",
                                              ),
                                        ),
                          ),
                    array("title"=>"A propos",
                          "links"=>array(array( "label"=>"A propos de cyberun",
                                                "link" => "#info.p.apropocyberun",
                                              ),
                                         array( "label"=>"A propos de BCH",
                                                "link" => "#info.p.apropobch",
                                              ),
                                         array( "label"=>"A propos de la réunion",
                                                "link" => "#info.p.aproporeu",
                                              ),
                                         array( "label"=>"Notre charte",
                                                "link" => "#info.p.charte",
                                              ),
                                         array( "label"=>"Nos partenaires",
                                                "link" => "#info.p.partenaires",
                                              ),
                                         array( "label"=>"Dossier de presse",
                                                "link" => "#info.p.presse",
                                              ),
                                         array( "label"=>"Nous contacter",
                                                "link" => "#info.p.contact",
                                              ),
                                        ),
                          ),
                    array("title"=>"Mentions Légales",
                          "links"=>array(array( "label"=>"Droit d'auteur",
                                                "link" => "#info.p.droitauteur",
                                              ),
                                         array( "label"=>"Mentions légales propre au tourisme",
                                                "link" => "#info.p.legaltourism",
                                              ),
                                         array( "label"=>"Conditions générales de ventes",
                                                "link" => "#info.p.cgv",
                                              ),
                                         array( "label"=>"FAQ",
                                                "link" => "#info.p.faq",
                                              ),
                                         array( "label"=>"Plan du site",
                                                "link" => "#info.p.plan",
                                              ),
                                        ),
                          ),
                   );

?>
<!-- Footer -->
<footer class="col-xs-12 pull-left no-padding">
    <div class="footer-below bg-orange-3">
        <div class="container">
            <div class="row">
                <?php foreach($footer as $k => $foot){ ?>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 text-left col-footer">
                        <h5><?php echo $foot["title"]; ?></h5>
                        <?php foreach($foot["links"] as $j => $link){ ?>
                            <a href="<?php echo $link["link"]; ?>" class="lbhp text-white">
                                <i class="fa fa-angle-right"></i> <?php echo $link["label"]; ?>
                            </a><br>
                        <?php } ?> 
                    </div>
                <?php } ?> 

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-footer hidden-xs">
                    <h5>Nous suivre</h5>
                    <small><small>Nous sommes présents sur ces réseaux sociaux :</small></small>
                    <ul class="list-inline">
                        <li>
                            <a href="https://www.facebook.com/communecter" target="_blank" 
                               class="btn-social btn-outline">
                                <i class="fa fa-fw fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://plus.google.com/communities/111483652487023091469" target="_blank" 
                               class="btn-social btn-outline">
                                <i class="fa fa-fw fa-google-plus"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com/communecter" target="_blank" 
                               class="btn-social btn-outline">
                                <i class="fa fa-fw fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/pixelhumain/co2" target="_blank" class="btn-social btn-outline">
                                <i class="fa fa-fw fa-rss"></i>
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
            <small>2017 Cyberun</small>
            </div>
        </div>
    </div>
</footer>
<?php //} ?>
    


