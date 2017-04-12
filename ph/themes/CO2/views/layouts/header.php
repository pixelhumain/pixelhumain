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
    a.link-submenu-header{
        padding: 5px;
    }
    a.link-submenu-header.active, 
    a.link-submenu-header:hover, 
    a.link-submenu-header:active{  
        border-bottom: 2px solid #ea4335;
        color:#ea4335 !important;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        #main-input-group{
            margin-top:10px;
        }
    }
</style>

    <?php 
        $params = CO2::getThemeParams();
        
        if(@$type=="cities")    { 
            $lblCreate = "";
            $params["pages"]["#".$page]["mainTitle"] = "Rechercher une commune"; 
            $params["pages"]["#".$page]["placeholderMainSearch"] = "Rechercher une commune"; 
        }

        $useHeader              = $params["pages"]["#".$page]["useHeader"];
        $subdomain              = $params["pages"]["#".$page]["subdomain"];
        $subdomainName          = $params["pages"]["#".$page]["subdomainName"];
        $icon                   = $params["pages"]["#".$page]["icon"];
        $mainTitle              = $params["pages"]["#".$page]["mainTitle"];
        $placeholderMainSearch  = $params["pages"]["#".$page]["placeholderMainSearch"];
    ?>

    <!-- Header -->
    <header>
        <?php if(@$useHeader != false){ ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-text">  

                        <div class="col-md-12 text-center main-menu-app" style="">
                            <?php //if($subdomainName != "web" && $subdomainName != "referencement") 
                                    foreach ($params["pages"] as $key => $value) {
                                        if(@$value["inMenu"]==true && @$value["open"]==true){ ?>
                                            <a  class="lbh text-red link-submenu-header margin-right-25 
                                                        <?php if("#".$subdomain == $key) echo "active"; ?>" 
                                                href="<?php echo $key; ?>">
                                                <i class="fa fa-<?php echo $value["icon"]; ?>"></i>
                                                <span class=""> <?php echo $value["subdomainName"]; ?></span>
                                            </a>    
                            <?php       }
                                    }  
                            ?>


                            <?php if(false && $subdomainName == "web") { ?>
                                    <a  class="lbh text-red font-blackoutM margin-right-25" target="_blank"
                                        href="#info.p.apropos">
                                        <span class="">c koissa ?!?</span>
                                    </a>    
                                    <a  class="lbh text-red font-blackoutM margin-right-25" target="_blank"
                                        href="#info.p.alphatango">
                                        <i class="fa fa-envelope"></i><span class=""> Contact</span>
                                    </a>    
                            <?php } ?>


                            <?php if($subdomainName == "referencement") { ?>
                                    <a  class="lbh text-red font-blackoutM margin-right-25" target="_blank"
                                        href="#web">
                                        <i class="fa fa-arrow-left"></i> <span class="">Retour a la recherche</span>
                                    </a>
                            <?php } ?>

                            <button type="button" class="btn btn-default bold letter-green" data-target="#selectCreate" data-toggle="modal">
                                <i class="fa fa-plus-circle fa-2x"></i>           
                            </button>
                            
                        </div>

                        
                        <?php $this->renderPartial($layoutPath.'headers/'.Yii::app()->params["CO2DomainName"], 
                                                    array("mainTitle"=>$mainTitle,
                                                          "icon"=>$icon,
                                                          "subdomainName"=>$subdomainName,
                                                          "subdomain"=>$subdomain,
                                                          "type"=>@$type,
                                                          "explain"=>@$explain)); ?>


                        <?php 

                        if($subdomain == "media"){ ?>
                            <div class="input-group col-md-6 col-md-offset-3" id="main-input-group"  style="margin-bottom:15px;">
                                <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
                                <span class="input-group-addon bg-white" id="main-search-bar-addon"><i class="fa fa-search"></i></span>
                            </div>

                            <button class="btn btn-default hidden-xs" id="main-btn-start-search">
                                <i class="fa fa-search"></i> Lancer la recherche
                            </button>

                        <?php  } elseif($subdomain == "search" ||
                                      $subdomain == "social" ||
                                      $subdomain == "agenda" ||
                                      $subdomain == "power" ||
                                      $subdomain == "annonces"){ ?>

                            <div class="input-group col-md-6 col-md-offset-3" id="main-input-group"  style="margin-bottom:15px;">
                                <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
                                <span class="input-group-addon bg-white" id="main-search-bar-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>

                            
                            <button class="btn btn-default btn-directory-type hidden-xs" id="main-btn-start-search" 
                                    data-type="<?php echo @$type; ?>">
                                <i class="fa fa-search"></i> Lancer la recherche
                            </button> 

                            <?php $lblC = @$params["pages"]["#".$page]["lblBtnCreate"]; ?>
                            <?php $colorC = @$params["pages"]["#".$page]["colorBtnCreate"]; ?>
                            <button class="btn btn-default letter-<?php echo @$colorC; ?> bold main-btn-create"
                                        data-type="<?php echo @$type; ?>">
                                    <i class="fa fa-plus-circle"></i> <?php echo @$lblC; ?>
                                </button>

                            <!-- <button class="btn btn-default btn-scroll" id="main-btn-start-search" data-targetid="#searchResults"><i class="fa fa-search"></i> Lancer la recherche</button> -->

                        <?php }elseif($subdomain == "web"){ ?>
                            <div class="input-group col-sm-6 col-sm-offset-3" id="main-input-group"  style="margin-bottom:15px;">
                                <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
                                <span class="input-group-addon bg-white" id="main-search-bar-addon"><i class="fa fa-search"></i></span>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-default btn-scroll" id="main-btn-start-search" data-targetid="#searchResults"><i class="fa fa-search"></i> Lancer la recherche</button>
                                <a href="#referencement" class="lbh btn btn-default hidden-xs main-btn-create" id="main-btn-referencement"><i class="fa fa-plus"></i> Référencer un site</a>
                            </div>
                        <?php }elseif($subdomain == "referencement"){ ?>
                            <p><br><small>
                                Vous souhaitez <span class="letter-blue">référencer une page web</span> ?<br>
                                Remplissez <span class="letter-green">gratuitement</span> le formulaire ci-dessous<br> 
                                C'est simple, et ça prend seulement <span class="text-red"> quelques secondes ...</span>
                                </small>
                            </p>
                        <?php// }elseif($subdomain == "annonces"){ ?>
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
                                <a href="#referencement" class="lbh btn btn-default letter-green hidden-xs bold" id="">
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
                                                            "type"=>@$type,
                                                            "me" => $me) ); ?>   

    
    <?php   if($subdomain != "referencement"){
                        $cities = CO2::getCitiesNewCaledonia();
                        $this->renderPartial($layoutPath.'scopes/'.$CO2DomainName.'/multi_scope', 
                                array(  "cities"=>$cities, "me"=>$me)); 
            }
    ?>