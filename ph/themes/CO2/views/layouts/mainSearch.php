<!DOCTYPE html>

<!-- ****************************** THEME CO2 ******************************-->
<?php 

    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    $themeAssetsUrl = Yii::app()->theme->baseUrl. '/assets';
    $parentModuleId = ( @Yii::app()->params["module"]["parent"] ) ?  Yii::app()->params["module"]["parent"] : $this->module->id;
    $modulePath = ( @Yii::app()->params["module"]["parent"] ) ?  "../../../".$parentModuleId."/views"  : "..";

    $cs = Yii::app()->getClientScript();

    $CO2DomainName = isset(Yii::app()->params["CO2DomainName"]) ? Yii::app()->params["CO2DomainName"] : "CO2";

    //Network::getNetworkJson(Yii::app()->params['networkParams']);

    $params = CO2::getThemeParams();
    $metaTitle = @$params["metaTitle"];
    $metaDesc = @$params["metaDesc"]; 
    $metaImg = Yii::app()->getRequest()->getBaseUrl(true)."/themes/CO2".@$params["metaImg"];
    
?>

<html lang="en" class="no-js">   

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="title" content="<?php echo $metaTitle; ?>">
        <meta name="description" content="<?php echo $metaDesc; ?>">
        <meta name="author" content="pixelhumain">

        <meta property="og:image" content="<?php echo $metaImg; ?>"/>
        <meta property="og:description" content="<?php echo $metaDesc; ?>"/>
        <meta property="og:title" content="<?php echo $metaTitle; ?>"/>
        <?php 
        $keywords = "";
        if(isset($this->keywords)) $keywords = $this->keywords;
        else if(isset($this->module->keywords)) $keywords = $this->module->keywords;?>
        <meta name="keywords" lang="<?php echo Yii::app()->language; ?>" content="<?php echo CHtml::encode($keywords); ?>" > 

        <title><?php echo ( @Yii::app()->params["module"]["name"] ) ? Yii::app()->params["module"]["name"] :  $CO2DomainName; ?></title>

        

        <link rel='shortcut icon' type='image/x-icon' href="<?php echo (isset( $this->module->assetsUrl ) ) ? $this->module->assetsUrl : ""?>/images/favicon.ico" /> 

<?php if( Yii::app()->params["forceMapboxActive"]==true &&  Yii::app()->params["mapboxActive"]==true ){ ?>
    <script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css"> 

    <script src='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'></script>
    <link href='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css' rel='stylesheet' />
<?php } ?>

    <?php 
    if(isset(Yii::app()->session['userId'])){
      $myContacts = Person::getPersonLinksByPersonId(Yii::app()->session['userId']);
      $myFormContact = $myContacts; 
      $getType = (isset($_GET["type"]) && $_GET["type"] != "citoyens") ? $_GET["type"] : "citoyens";
    }else{
      $myFormContact = null;

    }
    $communexion = CO2::getCommunexionCookies();
            
    $me = isset(Yii::app()->session['userId']) ? Person::getById(Yii::app()->session['userId']) : null;
     $this->renderPartial($layoutPath.'initJs', 
                                 array( "me"=>$me, "parentModuleId" => $parentModuleId, "myFormContact" => @$myFormContact, "communexion" => $communexion));
    if($this->module->id == "custom"){
        $this->renderPartial( 'co2.views.custom.init' ); 
    }else 
        Yii::app()->session["custom"]=null;
        ?>



        <?php 
            $cs->registerScriptFile(Yii::app() -> createUrl($parentModuleId."/default/view/page/trad/dir/..|translation/layout/empty"));
        ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body id="page-top" class="index" style="display: none;">

        <!-- **************************************
        MAP CONTAINER
        ******************************************* -->
        <progress class="progressTop" max="100" value="20"></progress>   
        <div id="mainMap">
            <?php 
            $this->renderPartial( $layoutPath.'mainMap.'.Yii::app()->params["CO2DomainName"], array("modulePath"=>$modulePath )); ?>
        </div>

        <?php 
              $this->renderPartial($layoutPath.'menusMap/'.$CO2DomainName, array( "layoutPath"=>$layoutPath, "me" => $me ) ); 
              ?>   
        
        <?php  if( isset(Yii::app()->session["userId"]) )
                $this->renderPartial($modulePath.'/news/modalShare', array()); 
        ?>
        <div class="main-container col-md-12 col-sm-12 col-xs-12 no-padding <?php echo @$params["appRendering"] ?>">

            <?php 
                  /*  $CO2DomainName = Yii::app()->params["CO2DomainName"];
                    $this->renderPartial( $layoutPath.'menus/'.$CO2DomainName, 
                                            array( "layoutPath"=>$layoutPath , 
                                                    "subdomain"=>"", //$subdomain,
                                                    "subdomainName"=>"", //$subdomainName,
                                                    "mainTitle"=>"", //$mainTitle,
                                                    "placeholderMainSearch"=>"", //$placeholderMainSearch,
                                                    "type"=>@$type,
                                                    "me" => $me,
                                                    "themeParams"=>$params) );*/
               
               
            ?>
            <!--<header>
                <div class="col-md-12 text-center main-menu-app" style="">
                    <?php 
                        $CO2DomainName = Yii::app()->params["CO2DomainName"];
                        $this->renderPartial( $layoutPath.'menus.moduleMenu',array( "params" => $params , 
                                                                                    "subdomain"  => ""));
                    ?>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="intro-text">  

                                <?php $this->renderPartial($layoutPath.'headers/'.Yii::app()->params["CO2DomainName"],
                                array("themeParams"=>$params)); ?>

                                    
                            </div>
                        </div>
                    </div>
                </div>
            </header>-->
            <div class="pageContent"></div>
        </div>
        

        <div id="modal-preview-coop" class="shadow2 hidden"></div>
        <div id="modal-settings" class="shadow2"></div>
        <div id="floopDrawerDirectory" class="floopDrawer"></div>
    
        

        <?php // BOUBOULE NOT USE FOR MOMENT =>if($CO2DomainName == "kgougle" || $CO2DomainName == "CO2")
            //    $this->renderPartial($layoutPath."modals/".$CO2DomainName.'/radioplayermodal', array( "layoutPath"=>$layoutPath ) ); 
        ?> 
        
        <?php 

            /* ***********************
            add to HEAD
            ************************ */
            echo "<!-- start: MAIN JAVASCRIPTS -->";
            echo "<!--[if lt IE 9]>";
            $cs->registerScriptFile(Yii::app()->request->baseUrl.'/plugins/respond.min.js' , CClientScript::POS_HEAD);
            $cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/excanvas.min.js' , CClientScript::POS_HEAD);
            $cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jQuery/jquery-1.11.1.min.js' , CClientScript::POS_HEAD);
            echo "<![endif]-->";
            echo "<!--[if gte IE 9]><!-->";
            $cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jQuery/jquery-2.1.1.min.js' , CClientScript::POS_HEAD);
            echo "<!--<![endif]-->";
            /* ***********************
            add to HEAD
            ************************ */

            /* ***********************
            ph core stuff
            ************************ */
            $cssAnsScriptFilesModule = array(
                '/plugins/jquery-ui-1.12.1/jquery-ui.min.js',
                '/plugins/jquery-ui-1.12.1/jquery-ui.min.css',
                
                '/plugins/jquery-validation/dist/jquery.validate.min.js',
                '/plugins/bootbox/bootbox.min.js' , 
                '/plugins/blockUI/jquery.blockUI.js' , 
                '/plugins/toastr/toastr.js' , 
                '/plugins/toastr/toastr.min.css',
                '/plugins/jquery.ajax-cross-origin.min.js',
                '/plugins/jquery-cookie/jquery.cookie.js' , 
                '/plugins/lightbox2/css/lightbox.css',
                '/plugins/lightbox2/js/lightbox.min.js',
                '/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js' , 
                '/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css',
                '/plugins/jquery-cookieDirective/jquery.cookiesdirective.js' , 
                '/plugins/ladda-bootstrap/dist/spin.min.js' , 
                '/plugins/ladda-bootstrap/dist/ladda.min.js' , 
                '/plugins/ladda-bootstrap/dist/ladda.min.css',
                '/plugins/ladda-bootstrap/dist/ladda-themeless.min.css',
                '/plugins/animate.css/animate.min.css',
                '/plugins/jQuery-contextMenu/dist/jquery.contextMenu.min.js' , 
                '/plugins/jQuery-contextMenu/dist/jquery.contextMenu.min.css' , 
                '/plugins/jQuery-contextMenu/dist/jquery.ui.position.min.js' , 
                
                '/plugins/select2/select2.min.js' , 
                '/plugins/moment/min/moment.min.js' ,
                '/plugins/moment/min/moment-with-locales.min.js',
                '/plugins/jquery.dynForm.js',
                
                '/plugins/jquery.elastic/elastic.js',
                '/plugins/underscore-master/underscore.js',
                '/plugins/jquery-mentions-input-master/jquery.mentionsInput.js',
                '/plugins/jquery-mentions-input-master/jquery.mentionsInput.css',
                //'/js/cookie.js' ,
                '/js/api.js',
                //'/plugins/animate.css/animate.min.css',
                '/plugins/font-awesome/css/font-awesome.min.css',
                //'/plugins/font-awesome-custom/css/font-awesome.css',

                '/plugins/cryptoJS-v3.1.2/rollups/aes.js',
                //FineUplaoder (called in jquery.dynform.js)
                '/plugins/fine-uploader/jquery.fine-uploader/fine-uploader-gallery.css',
                '/plugins/fine-uploader/jquery.fine-uploader/jquery.fine-uploader.js',
                '/plugins/fine-uploader/jquery.fine-uploader/fine-uploader-new.min.css'
            );
            if(Yii::app()->language!="en")
                array_push($cssAnsScriptFilesModule,"/plugins/jquery-validation/localization/messages_".Yii::app()->language.".js");
            HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->getRequest()->getBaseUrl(true));
            /* ***********************
            END ph core stuff
            ************************ */

            /* ***********************
            module stuff
            ************************ */
            $moduleAssets = ( @Yii::app()->params["module"]["parent"] ) ?  Yii::app()->getModule( Yii::app()->params["module"]["parent"] )->getAssetsUrl()  : $this->module->assetsUrl;
            HtmlHelper::registerCssAndScriptsFiles( 
                array('/js/default/formInMap.js', 
                    '/js/cooperation/uiCoop.js'
                ), 
                $moduleAssets
            );
            /* ***********************
            END module stuff
            ************************ */

            /* ***********************
            theme stuff
            ************************ */
            $cssAnsScriptFilesModule = array(
                '/assets/js/cookie.js' ,
                '/assets/js/jqBootstrapValidation.js' ,
                
                '/assets/data/mainCategories.js' ,
                
                '/assets/vendor/bootstrap/js/bootstrap.min.js',
                '/assets/vendor/bootstrap/css/bootstrap.min.css',
                '/assets/css/sig/sig.css',
                '/assets/css/freelancer.css',
                '/assets/css/default/dynForm.css',

                '/assets/css/CO2/CO2-boot.css',
                '/assets/css/CO2/CO2-color.css',
                '/assets/css/CO2/CO2.css',
                '/assets/css/plugins.css',
                 // TODO BOUBOULE - Radio à ne pas appeler pour CO2
                '/assets/vendor/jPlayer-2.9.2/dist/skin/blue.monday/css/jplayer.blue.monday.min.css',
                '/assets/vendor/jPlayer-2.9.2/dist/jplayer/jquery.jplayer.min.js',
                '/assets/js/radioplayer.js',
    
                '/assets/css/floopDrawerRight.css',
                '/assets/css/cooperation.css'
            );
            HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);

            /* ***********************
            END theme stuff
            ************************ */
            

            //inclue le css & js du theme si != de CO2 (surcharge du code commun du theme si besoin) ex : kgougle
            //if($CO2DomainName != "CO2"){

                $cssAnsScriptFilesModule = array(
                    '/assets/css/themes/'.$CO2DomainName.'/'.$CO2DomainName.'.css',
                    '/assets/js/comments.js',
                    //'/assets/css/themes/'.$CO2DomainName.'/'.$CO2DomainName.'-color.css',
                    //'/assets/js/themes/'.$CO2DomainName.'.js',
                );
                HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);
            //}

            if($CO2DomainName != "CO2"){
                $cssAnsScriptFilesModule = array(
                    //'/assets/css/themes/'.$CO2DomainName.'/'.$CO2DomainName.'.css',
                    '/assets/css/themes/'.$CO2DomainName.'/'.$CO2DomainName.'-color.css',
                    '/assets/js/themes/'.$CO2DomainName.'.js',
                );
                HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);
            }
        ?>

        <?php //$this->renderPartial($layoutPath.'initCommunexion', array()); ?>
        
        <?php $this->renderPartial('../cooperation/pod/modalCommon', array()); ?>

        <?php // BOUBOULE NOT USE FOR MOMENT $this->renderPartial($layoutPath.'modals.'.$CO2DomainName.'.mainMenu', array("me"=>$me) ); ?>
        <?php $this->renderPartial( $layoutPath.'menuBottom.'.Yii::app()->params["CO2DomainName"]); ?>
        <?php 
            if(false && (($CO2DomainName == "CO2" &&
                !@Yii::app()->session["userId"] && 
                !@Yii::app()->session["user"]["preferences"]) || 
                ($CO2DomainName == "CO2" &&
                @Yii::app()->session["user"]["preferences"] && 
                !@Yii::app()->session["user"]["preferences"]["unseenHelpCo"])) &&
                !@Yii::app()->request->cookies['unseenHelpCo'])
                $this->renderPartial($layoutPath.'footer.donation'); 

        ?>
        
        <script>        
            var CO2DomainName = "<?php echo $CO2DomainName; ?>";
            var CO2params = <?php echo json_encode($params); ?>;
            
            
            jQuery(document).ready(function() { 
                $.blockUI({ message : themeObj.blockUi.processingMsg});                
                if( typeof custom != "undefined" && custom.logo ){
                    custom.init("mainSearch");
                }
                var pageUrls = <?php echo json_encode($params["pages"]); ?>;
                $.each( pageUrls ,function(k , v){ 
                    if(typeof urlCtrl.loadableUrls[k] == "undefined")
                        urlCtrl.loadableUrls[k] = v;
                    else {
                        $.each( v ,function(ki , vi){ 
                            urlCtrl.loadableUrls[k][ki] = vi;
                        });
                    }
                });

                themeObj.init();
                //Login.init();
                $.each(modules,function(k,v) { 
                    if(v.init){
                        mylog.log("init.js for module : ",k);
                        lazyLoad( v.init , null,null);
                    }
                });
                
                if(themeObj.firstLoad){
                    themeObj.firstLoad=false;
                    urlCtrl.loadByHash(location.hash,true);
                }
                setTimeout(function(){
                    $("#page-top").show();
                }, 500);
                $(".close-footer-help").click(function(){
                    $("#footer-help").remove();
                    if(typeof userId != "undefined" && userId != ""){
                        $.ajax({
                            type: "POST",
                            url: baseUrl+"/"+moduleId+"/person/removehelpblock/id/"+userId,
                            dataType: "json",
                            success: function(data){
                                    toastr.success("Ce bandeau ne s'affichera plus lorsque vous êtes connecté(e) !");
                                }
                            });
                    }
                });
                $(".add-cookie-close-footer").click(function(){
                    $.cookie('unseenHelpCo', true, { expires: 365, path: "/" });
                    $("#footer-help").fadeOut();
                    toastr.success("Ce bandeau ne s'affichera plus sur ce navigateur !");
                });
            });
        </script>

    </body>

</html>