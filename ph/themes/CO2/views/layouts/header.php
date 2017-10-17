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
            <div class="col-md-12 text-center main-menu-app" style="">
                <?php 
                    $this->renderPartial( $layoutPath.'menus.moduleMenu',array( "params" => $params , 
                                                                                "subdomain"  => $subdomain));
                ?>
            </div>
            
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="intro-text">  

                            <?php $this->renderPartial($layoutPath.'headers/'.Yii::app()->params["CO2DomainName"], 
                                                        array("mainTitle"=>$mainTitle,
                                                              "icon"=>$icon,
                                                              "subdomainName"=>$subdomainName,
                                                              "subdomain"=>$subdomain,
                                                              "type"=>@$type,
                                                              "explain"=>@$explain)); ?>

                        <div class="subModuleTitle">  
                            <?php 

                            if($subdomain == "actu"){ ?>
                                <div class="input-group col-md-6 col-md-offset-3" id="main-input-group"  style="margin-bottom:15px;">
                                    <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
                                    <span class="input-group-addon bg-white" id="main-search-bar-addon"><i class="fa fa-search"></i></span>
                                </div>

                                <button class="btn btn-default hidden-xs" id="main-btn-start-search">
                                    <i class="fa fa-search"></i> Lancer la recherche
                                </button>

                            <?php  } elseif(  $subdomain == "search" ||
                                              $subdomain == "social" ||
                                              $subdomain == "agenda" ||
                                              $subdomain == "power" ||
                                              $subdomain == "annonces"||
                                              $subdomain == "freedom"){ ?>

                            <div class="input-group col-md-6 col-md-offset-3" id="main-input-group"  style="margin-bottom:15px;">
                                <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo Yii::t("common", $placeholderMainSearch); ?>">
                                <span class="input-group-addon bg-white" id="main-search-bar-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>

                            
                            <button class="btn btn-default btn-directory-type hidden-xs" id="main-btn-start-search" 
                                    data-type="<?php echo @$type; ?>">
                                <i class="fa fa-search"></i> <?php echo Yii::t("common","Launch search") ?>
                            </button> 

                            <?php $lblC = Yii::t("common",@$params["pages"]["#".$page]["lblBtnCreate"]); ?>
                            <?php $colorC = @$params["pages"]["#".$page]["colorBtnCreate"]; ?>

                                <?php if(!empty(Yii::app()->session["userId"])){ ?>
                                    <button class="btn btn-default letter-<?php echo @$colorC; ?> bold main-btn-create"
                                            data-type="<?php echo @$type; ?>">
                                        <i class="fa fa-plus-circle"></i> <?php echo @$lblC; ?>
                                    </button>
                               <?php } ?>
                                

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
                            <?php }elseif($subdomain == "live"){ ?>
                                <!--<div class="input-group col-sm-6 col-sm-offset-3" id="main-input-group"  style="margin-bottom:15px;">
                                    <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
                                    <span class="input-group-addon bg-white" id="main-search-bar-addon"><i class="fa fa-search"></i></span>
                                </div>

                                <div class="col-md-12">
                                    <button class="btn btn-default btn-scroll" id="main-btn-start-search" data-targetid="#searchResults"><i class="fa fa-search"></i> Lancer la recherche</button>
                                </div>-->
                            <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
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