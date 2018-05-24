


<div class="portfolio-modal modal fade" id="openModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="col-sm-12 container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="modal-header text-dark">
                        <h3 class="modal-title text-center" id="ajax-modal-modal-title">
                            <i class="fa fa-angle-down"></i> <i class="fa " id="ajax-modal-icon"></i> 
                        </h3>
                    </div>
                    
                    <div id="ajax-modal-modal-body" class="modal-body">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 text-center" style="margin-top:50px;margin-bottom:50px;">
            <hr>
            <a href="javascript:" style="font-size: 13px;" type="button" class="" data-dismiss="modal">
            <i class="fa fa-times"></i> <?php echo Yii::t("common","Back") ?>
            </a>
        </div>
    </div>
</div>



<style type="text/css">
.filterBtns{border-radius:0px; border-color: transparent; text-transform: uppercase;}
</style>
<div class="portfolio-modal modal fade" id="modalMainMenu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-lg-12 text-center">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" style="margin-bottom:20px;" class="nc_map" height=50>
                    <h3 class="letter-red no-margin hidden-xs" style="margin-top:5px!important;">
                        MENU PRINCIPAL<br>
                    </h3>
                    <br>
                    <?php 
                        if( isset( Yii::app()->session['userId']) ){
                          $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
                    ?>  
                        <a  href="#page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>" class="lbh">
                            <img class="img-circle" id="menu-thumb-profil" 
                                      src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
                        </a>
                        <a class="btn btn-default text-red btn-sm" href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>">
                            <i class="fa fa-sign-out"></i> Déconnecter
                        </a>
                    <?php }else{ ?>
                        <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalRegister"><i class="fa fa-plus-circle"></i> S'inscrire</button>
                        <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalLogin"><i class="fa fa-sign-in"></i> Se connecter</button>
                    <?php } ?>
                    <hr>
                </div>              
            </div>

            <div class="row links-main-menu text-center">
               
                <a href="#search" class=" btn-main-menu col-md-2 col-sm-4 col-xs-12" data-type="search" >    
                    <div class="modal-body text-center">
                        <h4 class="text-red no-margin"><i class="fa fa-search fa-2x padding-bottom-10"></i><br>
                            <span class="homestead"> <?php echo Yii::t("home","SEARCH") ?></span>
                        </h4>
                        
                        <div class="col-md-12 no-padding text-center">
                            <h5><?php echo Yii::t("home","The search engine") ?>
                                <small class=""><br>
                                    <?php echo Yii::t("home","To find easily local actors") ?>
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>

                <a href="#annonces" class=" btn-main-menu col-md-3 col-sm-4 col-xs-12" data-type="classified" >
                    <div class="modal-body text-center">
                        <h4 class="text-red no-margin"><i class="fa fa-bullhorn fa-2x padding-bottom-10"></i><br>
                            <span class="homestead"> <?php echo Yii::t("home","ADS") ?></span>
                        </h4>
                        
                        <div class="col-md-12 no-padding text-center">
                            <h5><?php echo Yii::t("home","Local ads") ?>
                                <small class=""><br>
                                    <?php echo Yii::t("home","To simplify goods and services exchanges")?>
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>
                           
                <a href="#agenda" class=" btn-main-menu col-md-2 col-sm-4 col-xs-12" data-type="agenda">
                    <div class="modal-body text-center">
                        <h4 class="text-red no-margin"><i class="fa fa-calendar fa-2x padding-bottom-10"></i><br>
                            <span class="homestead"> <?php echo Yii::t("home","AGENDA") ?></span>
                        </h4>
                        
                        <div class="col-md-12 no-padding text-center">
                            <h5><?php echo Yii::t("home","A common agenda") ?>
                                <small class=""><br>
                                    <?php echo Yii::t("home","to know in live all about local events") ?>
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>
                
                <a href="#live" class="btn-main-menu col-md-3 col-sm-6 col-xs-12" > 
                    <div class="modal-body text-center">
                        <h4 class="text-red no-margin"><i class="fa fa-newspaper-o fa-2x padding-bottom-10"></i><br>
                            <span class="homestead"> <?php echo Yii::t("home","LIVE") ?></span>
                        </h4>
                        
                        <div class="col-md-12 no-padding text-center">
                            <h5><?php echo Yii::t("home","A common news stream") ?>
                                <small class=""><br>
                                    <?php echo Yii::t("home","To diffuse your messages for your city")?>
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>
                <a href="#live" class="btn-main-menu col-md-2 col-sm-6 col-xs-12" > 
                    <div class="modal-body text-center">
                        <h4 class="text-red no-margin"><i class="fa fa-cubes fa-2x padding-bottom-10"></i><br>
                            <span class="homestead"> <?php echo Yii::t("home","SHARING") ?></span>
                        </h4>
                        
                        <div class="col-md-12 no-padding text-center">
                            <h5><?php echo Yii::t("home","Sharing ressources") ?>
                                <small class=""><br>
                                    <?php echo Yii::t("home","To find resource you need or help others")?>
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>
                    
            </div>
                <!-- <a href="#power" class="btn-main-menu col-xs-3" > 
                    <div class="modal-body text-center">
                        <h3 class="text-red no-margin"><i class="fa fa-hand-rock-o fa-2x padding-bottom-10"></i><br>
                            <span class="homestead"> DEMOCRATIE</span>
                        </h2>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5>Un espace de participation citoyenne
                                <small class="hidden-xs"><br>
                                    La démocratie participative / collaborative / en ligne / de demain
                                    10% (refonte à réaliser)
                                </small>
                            </h5>
                        </div>
                    </div>
                </a> -->
                
                <div class="margin-top-20 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center menuSection2 searchSection2" 
                     id="sub-menu-filliaire-menu">
                    <!-- <h5>Recherche thématique<br><i class='fa fa-chevron-down'></i></h5> -->
                    <?php 
                        $filliaireCategories = CO2::getContextList("filliaireCategories"); 
                        foreach ($filliaireCategories as $key => $cat) { 
                            if(is_array($cat)) { 
                    ?>
                                <div class="col-md-2 col-sm-3 col-sm-6 no-padding">
                                    <a href="" class="btn btn-default col-md-12 col-sm-12 padding-10 bold text-dark elipsis margin-bottom-5 filterBtns tagSearchBtn" data-tags="<?php echo implode(",",$cat["tags"]); ?>" data-type="persons,organizations,projects"  data-app="#search" >
                                        <i class="fa <?php echo $cat["icon"]; ?> fa-2x hidden-xs"></i><br>
                                        <?php echo $cat["name"]; ?>
                                    </a>
                                </div>
                    <?php   } 
                        } 
                    ?>
                    <hr class="col-md-12 col-sm-12 col-xs-12 no-padding" id="before-section-result">
                </div>

                <div class="margin-top-20 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center menuSection2 classifiedSection2 hidden">
                    <!-- <h5>Recherche thématique<br><i class='fa fa-chevron-down'></i></h5> -->
                    <?php $classified = CO2::getModuleContextList("eco","categories", "goods"); 
                        foreach ($classified['sections'] as $key => $cat) {   
                            if(is_array($cat)) { 
                    ?>
                                <div class="col-md-2 col-sm-3 col-sm-6 no-padding">
                                    <button class="btn btn-default col-md-12 col-sm-12 padding-10 bold text-dark elipsis margin-bottom-5 filterBtns tagSearchBtn" data-tags="<?php echo $cat["label"] ?>" data-type="classified" data-app="#annonces"  >
                                        <i class="fa fa-<?php echo $cat["icon"]; ?> fa-2x hidden-xs"></i><br>
                                        <?php echo $cat["label"]; ?> 
                                    </button>
                              </div>
                     <?php   } 
                        } 
                    ?>
                </div>

                <div class="margin-top-20 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center menuSection2 agendaSection2 hidden"> 
                <!-- <h5>Recherche thématique<br><i class='fa fa-chevron-down'></i></h5> --> 
                <?php $events = CO2::getContextList("event");  
                      //var_dump($categories); exit; 
                      foreach ($events['sections'] as $key => $cat) {   
                            if(is_array($cat)) { 
                    ?>
                                <div class="col-md-2 col-sm-3 col-sm-6 no-padding">
                                    <button class="btn btn-default col-md-12 col-sm-12 padding-10 bold text-dark elipsis margin-bottom-5 filterBtns tagSearchBtn" data-stype="<?php echo $cat["label"] ?>" data-type="events" data-app="#agenda">
                                        <i class="fa fa-<?php echo $cat["icon"]; ?> fa-2x hidden-xs"></i><br>
                                        <?php echo $cat["label"]; ?> 
                                    </button>
                              </div>
                     <?php   } 
                        } 
                    ?>
                  <hr class="col-md-12 col-sm-12 col-xs-12 no-padding" id="before-section-result"> 
                </div> 


                <!-- <div class="col-xs-12 text-center">
                <?php 
                        if( isset( Yii::app()->session['userId']) ){
                    ?> 
                    <a href="javascript:;" style="font-size:25px;" class="btn btn-default letter-green bold " 
                                        data-target="#selectCreate" data-toggle="modal" data-dismiss="modal" id="">
                                    <i class="fa fa-plus-circle"></i> CRÉER UNE PAGE </a>
                    <?php } ?> 
                    
                </div>   -->  

            <br/>

            <div class="col-xs-12 text-center">
                <hr>
                    <a href="javascript:" style="font-size: 13px;" type="button" class="" data-dismiss="modal"><i class="fa fa-times"></i> Retour</a>
                <br/><hr>    
                <a class="btn btn-default btn-sm" data-dismiss="modal" href="javascript:smallMenu.openAjaxHTML(baseUrl+'/'+moduleId+'/default/view/page/help')" style="font-size: 13px;"><i class="fa fa-keyboard-o"></i> ShortCuts</a>

                <a class="btn btn-default btn-sm" data-dismiss="modal" href="javascript:smallMenu.openAjaxHTML(baseUrl+'/'+moduleId+'/default/view/page/links')" style="font-size: 13px;"><i class="fa fa-link"></i> Links</a>

                <a class="btn btn-default btn-sm lbh" href="#default.view.page.index.dir.docs" data-dismiss="modal" style="font-size: 13px;"><i class="fa fa-book"></i> Docs</a>
            </div>
            
        </div>
    </div>
</div>




<?php   $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';

if(@Yii::app()->session["userId"])
    $this->renderPartial($layoutPath.'.rocketchat'); 

?>

<script type="text/javascript">
var searchObj = {};
jQuery(document).ready(function() { 

    $(".btn-main-menu").mouseenter(function(){ 
        $(".menuSection2").addClass("hidden"); 
        if( $(this).data("type") ) 
            $("."+$(this).data("type")+"Section2").removeClass("hidden");
    }).click(function(e) {  
        e.preventDefault(); 
        $('#modalMainMenu').modal("hide"); 
        mylog.warn("***************************************"); 
        mylog.warn("bindLBHLinks",$(this).attr("href")); 
        mylog.warn("***************************************"); 
        var h = ($(this).data("hash")) ? $(this).data("hash") : $(this).attr("href"); 
        urlCtrl.loadByHash( h ); 
    }); 

    $(".tagSearchBtn").click(function(e) {  
        e.preventDefault(); 
        $('#modalMainMenu').modal("hide"); 
        mylog.warn( ".tagSearchBtn",$(this).data("type"),$(this).data("stype"),$(this).data("tags") ); 

        searchObj.types = $(this).data("type").split(",");
        
        if( $(this).data("stype") )
            searchObj.stype = $(this).data("stype");
        else
            searchObj.tags = $(this).data("tags");
        
        urlCtrl.loadByHash($(this).data("app"));
        urlCtrl.afterLoad = function () {     
            //we have to pass by a variable to set the values         
            searchType = searchObj.types;
        
            if( $(this).data("stype") )
                $('#searchSType').val(searchObj.stype);
            else
                $('#searchTags').val(searchObj.tags);
            startSearch();
            searchObj = {};
        }
    }); 

});


</script>