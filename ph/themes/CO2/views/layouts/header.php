    <style>
        .pastille-subdomain {
            font-size: 20px;
            float: left;
            margin-left: 55.3%;
            margin-top: -41px;
        }
        .pastille-subdomain-icon {
            font-size: 24px;
            float: right;
            margin-right: 57%;
            margin-top: -73px;
        }

@media (max-width: 768px) {
    #main-input-group{
        margin-top:10px;
    }
}

    </style>

    <?php 
        $params = CO2::getThemeParams();
       
        $useHeader              = $params["pages"]["#co2.".$page]["useHeader"];
        $subdomain              = $params["pages"]["#co2.".$page]["subdomain"];
        $subdomainName          = $params["pages"]["#co2.".$page]["subdomainName"];
        $icon                   = $params["pages"]["#co2.".$page]["icon"];
        $mainTitle              = $params["pages"]["#co2.".$page]["mainTitle"];
        $placeholderMainSearch  = $params["pages"]["#co2.".$page]["placeholderMainSearch"];
    ?>

    <!-- Header -->
    <header>
        <?php if(@$useHeader != false){ ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-text">  

                        <div class="col-md-12 text-center main-menu-app" style="">
                            <?php if($subdomainName != "web") foreach ($params["pages"] as $key => $value) {
                                    if(@$value["inMenu"]==true){ ?>
                                    <a  class="lbh letter-red font-blackoutM margin-right-25" 
                                        href="<?php echo $key; ?>">
                                        <i class="fa fa-<?php echo $value["icon"]; ?>"></i><span class="hidden-xs"> <?php echo $value["subdomainName"]; ?></span>
                                    </a>    
                            <?php   }
                                 }  ?>


                            <?php if($subdomainName == "web") { ?>
                                
                                    <a  class="lbh letter-red font-blackoutM margin-right-25" target="_blank"
                                        href="#co2.info.p.apropos">
                                        <span class="">c koissa ?!?</span>
                                    </a>    
                                    <a  class="lbh letter-red font-blackoutM margin-right-25" target="_blank"
                                        href="#co2.info.p.alphatango">
                                        <i class="fa fa-envelope"></i><span class=""> Contact</span>
                                    </a>    
                            <?php } ?>
                            
                        </div>

                        
                        <?php $this->renderPartial($layoutPath.'headers/'.Yii::app()->params["CO2DomainName"], 
                                                    array("mainTitle"=>$mainTitle,
                                                          "icon"=>$icon,
                                                          "subdomainName"=>$subdomainName,
                                                          "subdomain"=>$subdomain)); ?>


                        <?php if($subdomain == "media"){ ?>
                            <div class="input-group col-md-6 col-md-offset-3" id="main-input-group"  style="margin-bottom:15px;">
                                <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
                                <span class="input-group-addon bg-white" id="main-search-bar-addon"><i class="fa fa-search"></i></span>
                            </div>

                            <button class="btn btn-default btn-scroll" id="main-btn-start-search" data-targetid="#searchResults">
                                <i class="fa fa-search"></i> Lancer la recherche
                            </button>

                        <?php }elseif($subdomain == "social" ||
                                      $subdomain == "agenda" ||
                                      $subdomain == "power" ||
                                      $subdomain == "freedom"){ ?>

                            <div class="input-group col-md-6 col-md-offset-3" id="main-input-group"  style="margin-bottom:15px;">
                                <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
                                <span class="input-group-addon bg-white" id="main-search-bar-addon"><i class="fa fa-search"></i></span>
                            </div>

                            
                            <button class="btn btn-default btn-scroll btn-directory-type" id="main-btn-start-search" data-type="<?php echo @$type; ?>" data-targetid="#page">
                                <i class="fa fa-search"></i> Lancer la recherche
                            </button> 
                            <?php if($subdomain == "agenda"){ ?>                  
                                <button class="btn btn-default text-orange bold main-btn-create" id="">
                                    <i class="fa fa-plus-circle"></i> Créer un événement
                                </button>
                            <?php }elseif($subdomain == "social"){ ?>                  
                                <button class="btn btn-default letter-green bold main-btn-create" 
                                        data-target="#dash-create-modal" data-toggle="modal" id="">
                                    <i class="fa fa-plus-circle"></i> Créer une page
                                </button>
                            <?php }elseif($subdomain == "freedom"){ ?>
                                <button class="btn btn-default letter-green bold main-btn-create" id="">
                                    <i class="fa fa-plus-circle"></i> Publier une annonce
                                </button>
                            <?php }elseif($subdomain == "power"){ ?>
                                <button class="btn btn-default text-azure bold main-btn-create" id="">
                                    <i class="fa fa-plus-circle"></i> Faire une proposition
                                </button>
                            <?php } ?>

                            <!-- <button class="btn btn-default btn-scroll" id="main-btn-start-search" data-targetid="#searchResults"><i class="fa fa-search"></i> Lancer la recherche</button> -->

                        <?php }elseif($subdomain == "web"){ ?>
                            <div class="input-group col-sm-6 col-sm-offset-3" id="main-input-group"  style="margin-bottom:15px;">
                                <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
                                <span class="input-group-addon bg-white" id="main-search-bar-addon"><i class="fa fa-search"></i></span>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-default btn-scroll" id="main-btn-start-search" data-targetid="#searchResults"><i class="fa fa-search"></i> Lancer la recherche</button>
                                <a href="#co2.referencement" class="lbh btn btn-default hidden-xs main-btn-create" id="main-btn-referencement"><i class="fa fa-plus"></i> Référencer un site</a>
                            </div>
                        <?php }elseif($subdomain == "referencement"){ ?>
                            <p><br><small>
                                Vous souhaitez <span class="letter-blue">référencer une page web</span> ?<br>
                                Remplissez <span class="letter-green">gratuitement</span> le formulaire ci-dessous<br> 
                                C'est simple, et ça prend seulement <span class="text-red"> quelques secondes ...</span>
                                </small>
                            </p>
                        <?php// }elseif($subdomain == "freedom"){ ?>
                            <!-- <div class="input-group col-sm-6 col-sm-offset-3" id="main-input-group"  style="margin-bottom:15px;">
                                <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
                                <span class="input-group-addon bg-white" id="main-search-bar-addon"><i class="fa fa-search"></i></span>
                            </div>
                             <hr>
                            <div class="col-md-12 col-sm-12 no-padding" id="sub-menu-left">
                                <div class="col-md-2 col-sm-2 padding-5"></div>
                                <div class="col-md-2 col-sm-2 col-xs-12 text-center padding-5">
                                <?php 
                                        $freedomSections = CO2::getContextList("freedomSections");
                                        $currentSection = 1;
                                        $align="right";
                                        foreach ($freedomSections as $key => $section) { ?>
                                            <?php if($currentSection > 1){ ?>
                                                <?php if($section["section"] > $currentSection){ 
                                                        $currentSection++; 
                                                        $align = "center"; //$align=="left"?"left":"left";
                                                ?>
                                                </div>
                                                <div class="col-sm-2 col-xs-12 col-md-2 text-<?php echo $align; ?> padding-5">
                                                <?php } ?>
                                                <button class="col-xs-5 col-sm-12 col-md-12 btn btn-default margin-bottom-5 margin-left-5 btn-select-type-anc btn-anc-color-<?php echo @$section["color"]; ?>"  
                                                        data-type-anc="<?php echo @$section["key"]; ?>">
                                                    <i class="fa fa-<?php echo @$section["icon"]; ?> hidden-xs hidden-sm"></i> <?php echo @$section["label"]; ?>
                                                </button><br class="hidden-xs hidden-sm">
                                            
                                            <?php   }else{ $currentSection++; } ?>
                                <?php   } ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                            <hr>
                                <button class="btn btn-default btn-scroll" id="main-btn-start-search" data-targetid="#searchResults">
                                    <i class="fa fa-angle-down"></i> Lire les annonces
                                </button>
                                <a href="#co2.referencement" class="lbh btn btn-default letter-green hidden-xs bold" id="">
                                    <i class="fa fa-plus-circle"></i> Publier une annonce
                                </a>
                            </div> -->

                        <?php } ?>

                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </header>

    <?php
            $CO2DomainName = Yii::app()->params["CO2DomainName"];
            $me = isset(Yii::app()->session['userId']) ? Person::getById(Yii::app()->session['userId']) : null;
            $this->renderPartial($layoutPath.'menus/'.$CO2DomainName, 
                                                    array( "layoutPath"=>$layoutPath , 
                                                            "subdomain"=>$subdomain,
                                                            "subdomainName"=>$subdomainName,
                                                            "mainTitle"=>$mainTitle,
                                                            "placeholderMainSearch"=>$placeholderMainSearch,
                                                            "me" => $me) ); ?>   

    
    <?php   if($subdomain != "referencement"){
                        $cities = CO2::getCitiesNewCaledonia();
                        $this->renderPartial($layoutPath.'scopes/'.$CO2DomainName.'/multi_scope', 
                                array(  "cities"=>$cities, "me"=>$me)); 
            }
    ?>