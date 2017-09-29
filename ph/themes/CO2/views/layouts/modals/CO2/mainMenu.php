


<div class="portfolio-modal modal fade" id="openModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="col-sm-12 container"></div>
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

            <div class="row links-main-menu">
               
                <a href="#search" class=" btn-main-menu col-xs-3"  data-type="search" >    
                    <div class="modal-body text-center">
                        <h4 class="text-red no-margin"><i class="fa fa-search fa-2x padding-bottom-10"></i><br>
                            <span class="homestead"> <?php echo Yii::t("home","SEARCH") ?></span>
                        </h4>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5><?php echo Yii::t("home","The search engine") ?>
                                <small class="hidden-xs"><br>
                                    <?php echo Yii::t("home","To find easily local actors") ?>
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>

                <a href="#annonces" class=" btn-main-menu col-xs-3" data-type="classified" >
                    <div class="modal-body text-center">
                        <h4 class="text-red no-margin"><i class="fa fa-bullhorn fa-2x padding-bottom-10"></i><br>
                            <span class="homestead"> <?php echo Yii::t("home","ADS") ?></span>
                        </h4>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5><?php echo Yii::t("home","Local ads") ?>
                                <small class="hidden-xs"><br>
                                    <?php echo Yii::t("home","To simplify goods and services exchanges")?>
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>
                           
                <a href="#agenda" class=" btn-main-menu col-xs-3" data-type="agenda">
                    <div class="modal-body text-center">
                        <h4 class="text-red no-margin"><i class="fa fa-calendar fa-2x padding-bottom-10"></i><br>
                            <span class="homestead"> <?php echo Yii::t("home","AGENDA") ?></span>
                        </h4>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5><?php echo Yii::t("home","A common agenda") ?>
                                <small class="hidden-xs"><br>
                                    <?php echo Yii::t("home","to know in live all about local events") ?>
                                </small>
                            </h5>
                        </div>
                    </div>
                </a>
                
                <a href="#live" class="btn-main-menu col-xs-3" > 
                    <div class="modal-body text-center">
                        <h4 class="text-red no-margin"><i class="fa fa-newspaper-o fa-2x padding-bottom-10"></i><br>
                            <span class="homestead"> <?php echo Yii::t("home","LIVE") ?></span>
                        </h4>
                        
                        <div class="col-md-12 no-padding text-center hidden-xs">
                            <h5><?php echo Yii::t("home","A common news stream") ?>
                                <small class="hidden-xs"><br>
                                    <?php echo Yii::t("home","To diffuse your messages for your city")?>
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
                    <?php $classified = CO2::getContextList("classified"); 
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




<style type="text/css">
#rocketchatModal.modal {   
    margin:0; 
    padding:0; 
    overflow: hidden;
    width: 100%; 
    height: 100%;
    background-color:rgb(0,0,0,0.5); 
    border-left:3px solid #333;
}
#rocketchatModal .modal-content {
    position: fixed;
    top: 10%;
    right: 5%;
    left: 5%;
    bottom: 10%;
    border-radius: 0;
    box-shadow: none;
    height: auto;
    padding-top:10px !important;
    width: auto !important;
    -webkit-box-shadow: 0px 0px 5px -2px rgba(0,0,0,0.5) !important;
    -moz-box-shadow: 0px 0px 5px -2px rgba(0,0,0,0.5) !important;
    box-shadow: 0px 0px 5px -2px rgba(0,0,0,0.5) !important;
}
.rocketchatTitle{
    color:#333;
    font-size: 20px;
}
.RCcontainerSpinner{
    height:40px;
}
.RCcontainer{
    border-top: 1px solid #c9c8c8;
}
</style>
<div class="rocketchat-modal modal fade" id="rocketchatModal" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-content shadow2">
        <div class="col-sm-12 RCcontainerSpinner">
                <a href="javascript:rcObj.sizeChat('')">
                    <i class="hide fa btnExpand fa-expand fa-2x"  style="float:left;color:#C5203B;margin-right:20px;"></i>
                </a>
                <a href="javascript:rcObj.sizeChat('')">
                    <i class="hide fa fa-external-link fa-2x"  style="float:left;color:#C5203B;margin-right:20px;"></i>
                </a>
                <h5 class="letter-red pull-left">
                    <i class='fa fa-comments'></i> Messagerie instantanée
                </h5><!-- <span class='rocketchatTitle'></span> -->
                <button class="btn btn-default btn-sm text-dark pull-right close-modal" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
                
        </div>
        <div class="col-sm-12 RCcontainer" style="background-color:white"></div>
    </div>
</div>



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

    //preload in background the rocket iframe
    <?php if(@Yii::app()->session["userId"] && Yii::app()->params['rocketchatEnabled'] ){?>
    if( userId ){
        //preload the iframe 
        getAjax('.RCcontainer', baseUrl+'/'+moduleId+'/rocketchat',null,"html");
        //get all users Lsit of channels
        getAjax(null, baseUrl+'/'+moduleId+'/rocketchat/list',function(data) {  
            mylog.log("rcObj.list : ",data);
            rcObj.list = data;  
        },"json");
    }
    <?php } ?>
});

<?php if(@Yii::app()->session["userId"] && Yii::app()->params['rocketchatEnabled'] )
{
    //sets all the global params for the usage of the chat
    Yii::app()->session["adminLoginToken"] = Yii::app()->params["adminLoginToken"];
    Yii::app()->session["adminRocketUserId"] = Yii::app()->params["adminRocketUserId"];
    if(!@Yii::app()->session["loginToken"] && !@Yii::app()->session["rocketUserId"])
    {
        $rocket = RocketChat::getToken(Yii::app()->session["userEmail"],Yii::app()->session["pwd"]);
        Yii::app()->session["loginToken"] = $rocket["loginToken"];
        Yii::app()->session["rocketUserId"] = $rocket["rocketUserId"];
    }
?>
var rcObj = {

    lastOpenChat : null,
    debugChat : false,
    loginToken : '<?php echo @Yii::app()->session["loginToken"]; ?>',
    rocketUserId : '<?php echo @Yii::app()->session["rocketUserId"]; ?>',
    list : null,

    login : function () 
    { 
        if(rcObj.debugChat)alert("rcObj.login");
        document.querySelector('iframe').contentWindow.postMessage({
              externalCommand: 'login-with-token',
              token: '<?php echo @Yii::app()->session["loginToken"]; ?>' }, '*');
    },

    loadChat : function (name,type,isOpen,hasRC){ 
        
        rcObj.loadedIframe (name) ;
        //if iframe deosn't exist
        //element has an RC channel 
        //not a citizen
        if( contextData && typeof contextData.slug == "undefined" )
            contextData.slug = slugify(contextData.name);
        
        var checkGroupMember = ( contextData ) ? $.inArray( contextData.slug , rcObj.list ) : true ; 
        
        if(rcObj.debugChat)alert( "name:"+name+", type:"+type+", isOpen : "+isOpen+", hasRC : "+hasRC+",checkGroupMember:"+checkGroupMember );

        if( $('.RCcontainer').html() == "" || 
            ( hasRC && type != "citoyens" && rcObj.lastOpenChat != name && checkGroupMember < 0 ) ||
            (!hasRC && type != "citoyens" && rcObj.lastOpenChat != name) )
        {  
            rcObj.lastOpenChat = name;
            var extra = (isOpen) ? "/roomType/channel" : "/roomType/group";

            iframeUrl = (name!="") ? baseUrl+'/'+moduleId+'/rocketchat/chat/name/'+contextData.slug+'/type/'+contextData.type+'/id/'+contextData.id+extra
                                   : baseUrl+'/'+moduleId+'/rocketchat';
            
            if(rcObj.debugChat)alert( iframeUrl );

            getAjax(null, iframeUrl, function(data){ 
                        $('.btnChatColor').addClass("text-red");
                        rcObj.goto(name,isOpen);
                    } ,"json");
            
        }  else {

            //todo : pb sur les nouvelles creations en passant par ici
            if(rcObj.debugChat)alert( rcObj.lastOpenChat+" | "+name );
            
            rcObj.goto(name,isOpen);
        }

        rcObj.lastOpenChat = name;
    },
    goto : function (name,isOpen) { 
        pathChannel = "/";
        if( name != "" ){
            if( contextData.type == "citoyens" ) 
                pathChannel = "/direct/"+contextData.username ;
            else {
                pathChannel = (isOpen) ? "/channel/"+contextData.slug 
                                       : "/group/"+contextData.slug;
            }
        }else {
            setTimeout( function () { history.pushState('', document.title, window.location.pathname);}, 1000);

        }
        if(rcObj.debugChat)alert( "RC goto : "+pathChannel );

        setTimeout( function () { 
            document.querySelector('iframe').contentWindow.postMessage({
                externalCommand: 'go',
                path: pathChannel }, '*');
         }, 1000);
        
    },
    settings : function () { 
        rcObj.loadChat("","citoyens", true, true);
        setTimeout( function () { 
            document.querySelector('iframe').contentWindow.postMessage({
                externalCommand: 'go',
                path: "/account/preferences" }, '*');
         }, 1000);

    },

    loadedIframe : function  (name) { 
        rcObj.login();
        //$('.RCcontainerSpinner').addClass('hide');
        $('.RCcontainer').css("height","100%");
        $('#rocketchatModal').modal("show"); 
        rcObj.sizeChat(name);
    },

    sizeChat : function (name) { 
        if( name == "" ){
            $('#rocketchatModal .modal-content, #rocketchatModal .modal ').css("width","100%");
            $(".btnExpand").removeClass('fa-expand').addClass('fa-compress');
        }
        else {
            $('#rocketchatModal .modal-content, #rocketchatModal .modal ').css("width","50%");
            $(".btnExpand").removeClass('fa-compress').addClass('fa-expand');
        }
    }

};

<?php } ?>

</script>