<!DOCTYPE html>

<?php 

    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    $themeAssetsUrl = Yii::app()->theme->baseUrl. '/assets';
    $cs = Yii::app()->getClientScript();

    $CO2DomainName = isset(Yii::app()->params["CO2DomainName"]) ? Yii::app()->params["CO2DomainName"] : "CO2";

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

        <title><?php echo $CO2DomainName; ?></title>

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
            $cs->registerScriptFile(Yii::app() -> createUrl($this->module->id."/default/view/page/trad/dir/..|translation/layout/empty"));
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
            <?php $this->renderPartial($layoutPath.'mainMap'); ?>
        </div>

        <?php //get all my link to put in floopDrawer
            if(isset(Yii::app()->session['userId'])){
              $myContacts = Person::getPersonLinksByPersonId(Yii::app()->session['userId']);
              $myFormContact = $myContacts; 
              $getType = (isset($_GET["type"]) && $_GET["type"] != "citoyens") ? $_GET["type"] : "citoyens";
            }else{
              $myFormContact = null;

            }
           // error_log("load IndexDefault");
        ?>
        
        <?php $me = isset(Yii::app()->session['userId']) ? Person::getById(Yii::app()->session['userId']) : null;
              $this->renderPartial($layoutPath.'menusMap', array( "layoutPath"=>$layoutPath, "me" => $me ) ); 
        ?>   
        
        <?php //$this->renderPartial($layoutPath.'loginRegister', array()); ?>

        <?php  if( isset(Yii::app()->session["userId"]) )
                $this->renderPartial('../news/modalShare', array());
        ?>
 
        <div class="main-container">

            <?php 
                    $CO2DomainName = Yii::app()->params["CO2DomainName"];
                    $this->renderPartial( $layoutPath.'menus.'.$CO2DomainName, 
                                            array( "layoutPath"=>$layoutPath , 
                                                    "subdomain"=>"", //$subdomain,
                                                    "subdomainName"=>"", //$subdomainName,
                                                    "mainTitle"=>"", //$mainTitle,
                                                    "placeholderMainSearch"=>"", //$placeholderMainSearch,
                                                    "type"=>@$type,
                                                    "me" => $me) ); 
            ?>
            <header>
                <div class="col-md-12 text-center main-menu-app" style="">
                    <?php 
                        $this->renderPartial( $layoutPath.'menus.moduleMenu',array( "params" => $params , 
                                                                                    "subdomain"  => ""));
                    ?>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="intro-text">  

                                <?php $this->renderPartial($layoutPath.'headers/'.Yii::app()->params["CO2DomainName"]); ?>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="pageContent"></div>
        </div>
        
        
        <?php 
            echo "<!-- start: MAIN JAVASCRIPTS -->";
            echo "<!--[if lt IE 9]>";
            $cs->registerScriptFile(Yii::app()->request->baseUrl.'/plugins/respond.min.js' , CClientScript::POS_HEAD);
            $cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/excanvas.min.js' , CClientScript::POS_HEAD);
            $cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jQuery/jquery-1.11.1.min.js' , CClientScript::POS_HEAD);
            echo "<![endif]-->";
            echo "<!--[if gte IE 9]><!-->";
            $cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jQuery/jquery-2.1.1.min.js' , CClientScript::POS_HEAD);
            echo "<!--<![endif]-->";

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
                '/plugins/font-awesome-custom/css/font-awesome.css',
            );
            if(Yii::app()->language!="en")
                array_push($cssAnsScriptFilesModule,"/plugins/jquery-validation/localization/messages_".Yii::app()->language.".js");
            HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->getRequest()->getBaseUrl(true));
            HtmlHelper::registerCssAndScriptsFiles( array('/js/default/formInMap.js') , $this->module->assetsUrl);
            
            $cssAnsScriptFilesModule = array(
                '/assets/js/cookie.js' ,
                '/assets/js/jqBootstrapValidation.js' ,
                
                '/assets/data/mainCategories.js' ,
                
                '/assets/vendor/bootstrap/js/bootstrap.min.js',
                '/assets/vendor/bootstrap/css/bootstrap.min.css',
                '/assets/css/sig/sig.css',
                '/assets/css/freelancer.css',
                '/assets/css/default/dynForm.css',

                '/assets/css/CO2.css',
                '/assets/css/CO2-boot.css',
                '/assets/css/CO2-color.css',
                '/assets/css/terla/terla.css',
                '/assets/css/terla/terla-color.css',
                '/assets/css/plugins.css',
                 
                '/assets/css/floopDrawerRight.css',
                '/assets/js/editInPlace.js',
            );
            HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);

            $this->renderPartial($layoutPath.'initJs', 
                                 array( "me"=>$me, "myFormContact" => @$myFormContact));
            $cssAnsScriptFilesModule = array(
                '/js/default/shoppingCart.js',
                '/js/default/circuit.js'
                //'/js/news/autosize.js',
            );
            HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

        ?>

        <?php $this->renderPartial($layoutPath.'initCommunexion', array()); ?>
        <?php $this->renderPartial($layoutPath.'tradTerla', array()); ?>
        
         
        <script>

            //alert("theme : <?php echo Yii::app()->theme->name?>");      
            var CO2DomainName = "<?php echo $CO2DomainName; ?>";
            var memorySearch = "";
            jQuery(document).ready(function() { 
                if(typeof localStorage != "undefined" && typeof localStorage.shoppingCart != "undefined")
                    shopping.cart = JSON.parse(localStorage.getItem("shoppingCart"));
                if(typeof localStorage != "undefined" && typeof localStorage.circuit != "undefined")
                    circuit.obj = JSON.parse(localStorage.getItem("circuit"));
    
                $.blockUI({ message : themeObj.blockUi.processingMsg});
                
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
            console.warn("url","<?php echo $_SERVER["REQUEST_URI"] ;?>");
        </script>
    </body>

</html>