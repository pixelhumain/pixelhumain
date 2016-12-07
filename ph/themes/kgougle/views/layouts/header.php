    
    <!-- Header -->
    <header>
        <?php if($subdomain != "page"){ ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-text">    
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/logocagou-<?php echo $subdomain; ?>.png" class="nc_map"><br>
                        <span class="name font-blackoutM">
                            <span class="letter letter-blue font-ZILAP letter-k">K</span>
                            <span class="letter letter-yellow">G</span>
                            <span class="letter letter-yellow font-ZILAP">O</span>
                            <span class="letter letter-yellow">U</span>
                            <span class="letter letter-green">G</span>
                            <span class="letter letter-green">L</span>
                            <span class="letter letter-green">E</span><br>
                            <small class="letter letter-red pastille font-blackoutT"><?php echo $subdomain; ?></small>
                        </span>

                        <div class="col-md-12 hidden-xs" id="subtitle">
                            <span class="skills font-montserrat "><?php echo $mainTitle; ?></span>
                        </div>      

                        <?php if($subdomain == "live"){ ?>
                            <div class="input-group col-md-8 col-md-offset-2" id="main-input-group"  style="margin-top:0px;margin-bottom:15px;">
                                <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
                                <span class="input-group-addon bg-white" id="main-search-bar-addon"><i class="fa fa-search"></i></span>
                            </div>

                            <div class="col-md-12 hidden-top scopes hidden">
                                <button class="btn text-red bg-white btn-scope"><i class="fa fa-circle-o"></i> Nouméa</button>
                                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province Sud</button>
                                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province Nord</button>
                                <button class="btn text-white bg-red btn-scope"><i class="fa fa-bullseye"></i> Province des Îles</button>
                                <button class="btn text-white bg-red btn-scope"><i class="fa fa-plus"></i></button>
                            </div>

                            <button class="btn btn-default btn-scroll" id="main-btn-start-search" data-targetid="#searchResults"><i class="fa fa-search"></i> Lancer la recherche</button>

                        <?php }elseif($subdomain == "web"){ ?>
                            <div class="input-group col-md-8 col-md-offset-2" id="main-input-group"  style="margin-top:0px;margin-bottom:15px;">
                                <input type="text" class="form-control" id="main-search-bar" placeholder="<?php echo $placeholderMainSearch; ?>">
                                <span class="input-group-addon bg-white" id="main-search-bar-addon"><i class="fa fa-search"></i></span>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-default btn-scroll" id="main-btn-start-search" data-targetid="#searchResults"><i class="fa fa-search"></i> Lancer la recherche</button>
                                <a href="#k.referencement" class="lbh btn btn-default" id="main-btn-referencement"><i class="fa fa-plus"></i> Référencer mon site</a>
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
            $me = isset(Yii::app()->session['userId']) ? Person::getById(Yii::app()->session['userId']) : null;
            $this->renderPartial($layoutPath.'menu', array( "layoutPath"=>$layoutPath , 
                                                            "subdomain"=>$subdomain,
                                                            "mainTitle"=>$mainTitle,
                                                            "placeholderMainSearch"=>$placeholderMainSearch,
                                                            "me" => $me) ); ?>   

    <?php //$this->renderPartial($layoutPath.'menu'); ?>    