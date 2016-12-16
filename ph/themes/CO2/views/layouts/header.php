    <style>
        .pastille-subdomain {
            font-size: 20px;
            float: left;
            margin-left: 55.3%;
            margin-top: -41px;
        }
        .pastille-subdomain-icon {
            font-size: 34px;
            float: right;
            margin-right: 57%;
            margin-top: -73px;
        }
    </style>

    <?php 
        $params = CO2::getThemeParams();
       //var_dump($params["pages"]); exit;
        $subdomain              = $params["pages"]["#co2.".$page]["subdomain"];
        $subdomainName          = $params["pages"]["#co2.".$page]["subdomainName"];
        $icon                   = $params["pages"]["#co2.".$page]["icon"];
        $mainTitle              = $params["pages"]["#co2.".$page]["mainTitle"];
        $placeholderMainSearch  = $params["pages"]["#co2.".$page]["placeholderMainSearch"];
    ?>

    <!-- Header -->
    <header>
        <?php if($subdomain != "page"){ ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-text">  

                        <div class="col-md-12 text-center " style="margin-bottom:110px;">
                            <?php foreach ($params["pages"] as $key => $value) {
                                    if(@$value["inMenu"]==true){ ?>
                                    <a  class="lbh letter-red font-blackoutM margin-right-25" 
                                        href="<?php echo $key; ?>">
                                        <i class="fa fa-<?php echo $value["icon"]; ?>"></i> <?php echo $value["subdomain"]; ?>
                                    </a>    
                            <?php   }
                                 }  ?>

                            <!-- <a class="lbh text-dark homestead margin-right-25" href="#k.web"><i class="fa fa-search"></i> WEB</a>
                            <a class="lbh text-dark homestead margin-right-25" href="#k.live"><i class="fa fa-newspaper-o"></i> MEDIA</a>
                            <a class="lbh text-dark homestead margin-right-25" href="#k.social"><i class="fa fa-user-circle"></i> NETWORK</a>
                            <a class="lbh text-dark homestead margin-right-25" href="#k.web"><i class="fa fa-rss"></i> LIVE</a>
                            <a class="lbh text-dark homestead margin-right-25" href="#k.web"><i class="fa fa-calendar"></i> AGENDA</a>
                            <a class="lbh text-dark homestead margin-right-25" href="#k.social.type.surveys"><i class="fa fa-hand-rock-o"></i> POWER</a>
                            <a class="lbh text-dark homestead margin-right-25" href="#k.power"><i class="fa fa-microphone"></i> RADIO</a> -->
                        </div>
                        
                        <?php $this->renderPartial($layoutPath.'headers/'.Yii::app()->params["CO2DomainName"], 
                                                    array("mainTitle"=>$mainTitle,
                                                          "subdomainName"=>$subdomainName,
                                                          "subdomain"=>$subdomain)); ?>


                       
                        <?php if($subdomain == "live"){ ?>
                            <div class="input-group col-md-8 col-md-offset-2" id="main-input-group"  style="margin-top:0px;margin-bottom:15px;">
                                <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
                                <span class="input-group-addon bg-white" id="main-search-bar-addon"><i class="fa fa-search"></i></span>
                            </div>

                            <!-- <div class="col-md-12 hidden-top scopes hidden">
                                <button class="btn text-red bg-white btn-scope"><i class="fa fa-circle-o"></i> Nouméa</button>
                                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province Sud</button>
                                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province Nord</button>
                                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province des Îles</button>
                                <button class="btn text-white bg-red btn-scope"><i class="fa fa-plus"></i></button>
                            </div> -->

                            <button class="btn btn-default btn-scroll" id="main-btn-start-search" data-targetid="#searchResults">
                                <i class="fa fa-search"></i> Lancer la recherche
                            </button>

                        <?php }elseif($subdomain == "social"){ ?>
                            <div class="input-group col-md-8 col-md-offset-2" id="main-input-group"  style="margin-top:0px;margin-bottom:15px;">
                                <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
                                <span class="input-group-addon bg-white" id="main-search-bar-addon"><i class="fa fa-search"></i></span>
                            </div>

                            <div class="col-md-12 hidden-top scopes">
                                <button class="btn text-black bg-white btn-directory-type" data-type="all">
                                    <i class="fa fa-search"></i> 
                                    <span class="hidden-xs">Tous</span>
                                </button>
                                <button class="btn text-white bg-yellow btn-directory-type" data-type="persons">
                                    <i class="fa fa-user"></i> 
                                    <span class="hidden-xs">Citoyens</span>
                                </button>
                                <button class="btn text-white bg-green  btn-directory-type" data-type="NGO">
                                    <i class="fa fa-group"></i> 
                                    <span class="hidden-xs">Associations</span>
                                </button>
                                <button class="btn text-white bg-azure  btn-directory-type" data-type="LocalBusiness">
                                    <i class="fa fa-industry"></i> 
                                    <span class="hidden-xs">Entreprises</span>
                                </button>
                                <button class="btn text-white bg-purple btn-directory-type" data-type="projects">
                                    <i class="fa fa-lightbulb-o"></i> 
                                    <span class="hidden-xs">Projets</span>
                                </button>
                                <button class="btn text-white bg-red  btn-directory-type" data-type="cities">
                                    <i class="fa fa-university"></i> 
                                    <span class="hidden-xs">Communes</span>
                                </button>
                                <button class="btn text-black bg-white  btn-directory-type" data-type="Group">
                                    <i class="fa fa-circle-o"></i> 
                                    <span class="hidden-xs">Groupes</span>
                                </button><br><br>
                                <!-- <span>Rechercher parmis toutes les pages du réseau COMMUNECTER</span> -->
                            </div>

                            <!-- <button class="btn btn-default btn-scroll" id="main-btn-start-search" data-targetid="#searchResults"><i class="fa fa-search"></i> Lancer la recherche</button> -->

                        <?php }elseif($subdomain == "web"){ ?>
                            <div class="input-group col-md-8 col-md-offset-2" id="main-input-group"  style="margin-top:0px;margin-bottom:15px;">
                                <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
                                <span class="input-group-addon bg-white" id="main-search-bar-addon"><i class="fa fa-search"></i></span>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-default btn-scroll" id="main-btn-start-search" data-targetid="#searchResults"><i class="fa fa-search"></i> Lancer la recherche</button>
                                <a href="#k.referencement" class="lbh btn btn-default hidden-xs" id="main-btn-referencement"><i class="fa fa-plus"></i> Référencer mon site</a>
                            </div>
                        <?php }elseif($subdomain == "referencement"){ ?>
                            <p><br><small>
                                Vous souhaitez <span class="letter-blue">référencer une page web</span> sur notre moteur de recherche ?<br>
                                Remplissez <span class="text-green">gratuitement</span> le formulaire ci-dessous<br> 
                                et rejoignez-nous <span class="text-red">en quelques minutes ...</span>
                                </small>
                            </p>
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
                                                            "mainTitle"=>$mainTitle,
                                                            "placeholderMainSearch"=>$placeholderMainSearch,
                                                            "me" => $me) ); ?>   

    <?php //$this->renderPartial($layoutPath.'menu'); ?>    