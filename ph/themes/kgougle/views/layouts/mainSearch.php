<!DOCTYPE html>

<?php 
    $user = "NOT_CONNECTED";
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    $themeAssetsUrl = Yii::app()->theme->baseUrl. '/assets';
    $cs = Yii::app()->getClientScript();
?>

<?php $subdomain = "live" ?>

<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Kgougle</title>

        <!-- <link rel='shortcut icon' type='image/x-icon' href="<?php //echo (isset( $this->module->assetsUrl ) ) ? $this->module->assetsUrl : ""?>/images/favicon.ico" /> -->

        <!-- <script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
        <link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' /> -->

        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

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


    <body id="page-top" class="index">

        <!-- **************************************
        MAP CONTAINER
        ******************************************* -->
        <div id="mainMap">
            <?php $this->renderPartial($layoutPath.'mainMap'); ?>
        </div>
        
        <?php $this->renderPartial($layoutPath.'menuMap', array( "layoutPath"=>$layoutPath ) ); ?>   
        
        <div class="main-container"></div>
        <?php //$this->renderPartial($layoutPath.$subdomain, array("subdomain" => $subdomain)); ?>


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
                '/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js',
                // '/plugins/bootstrap/js/bootstrap.min.js' , 
                // '/plugins/bootstrap/css/bootstrap.min.css',
                // '/plugins/velocity/jquery.velocity.min.js',
                '/plugins/jquery-validation/dist/jquery.validate.min.js',
                '/plugins/blockUI/jquery.blockUI.js' , 
                '/plugins/jquery.dynForm.js',
                '/plugins/jquery.ajax-cross-origin.min.js',
                '/plugins/toastr/toastr.js' , 
                '/plugins/toastr/toastr.min.css',
                '/plugins/jquery-cookie/jquery.cookie.js' , 
                '/plugins/jquery-cookieDirective/jquery.cookiesdirective.js' , 

                '/plugins/select2/select2.min.js' , 
                //'/plugins/moment/min/moment.min.js' ,
                //'/js/cookie.js' ,
                '/js/api.js',
                
                //'/plugins/animate.css/animate.min.css',
                '/plugins/font-awesome/css/font-awesome.min.css',
                '/plugins/font-awesome-custom/css/font-awesome.css',
            );
            HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->getRequest()->getBaseUrl(true));
            
            $cssAnsScriptFilesModule = array(
                '/assets/js/cookie.js' ,
                '/assets/js/jqBootstrapValidation.js' ,
                
                '/assets/data/mainCategories.js' ,
                
                '/assets/vendor/bootstrap/js/bootstrap.min.js',
                '/assets/js/kgougle.js' ,
                
                '/assets/vendor/bootstrap/css/bootstrap.min.css',
                '/assets/css/freelancer.css',
                '/assets/css/kgougle.css',
                '/assets/css/kgougle-color.css',
                '/assets/css/kgougle-boot.css',
                '/assets/css/timeline.css',
                '/assets/css/sig/sig.css',
            );
            HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);
        ?>

        <!-- Plugin JavaScript -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script> -->
        <!-- <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script> -->

        <script>
            //used in communecter.js dynforms
            var tagsList = <?php echo json_encode(Tags::getActiveTags()) ?>;
            var eventTypes = <?php asort(Event::$types); echo json_encode(Event::$types) ?>;
            var organizationTypes = <?php echo json_encode( Organization::$types ) ?>;
            var currentUser = <?php echo isset($me) ? json_encode(Yii::app()->session["user"]) : "null"?>;
            var rawOrganizerList = <?php echo json_encode(Authorisation::listUserOrganizationAdmin(Yii::app() ->session["userId"])) ?>;
            var organizerList = {}; 
            var poiTypes = <?php echo json_encode( Poi::$types ) ?>;

            var proverbs = new Array();
            var initT = new Object();
            var showDelaunay = true;
            var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
            var moduleUrl = "<?php echo Yii::app()->controller->module->assetsUrl;?>";
            var themeUrl = "<?php echo Yii::app()->theme->baseUrl;?>";
            var moduleId = "<?php echo $this->module->id?>";
            var userId = "<?php echo Yii::app()->session['userId']?>";
            var debug = <?php echo (YII_DEBUG) ? "true" : "false" ?>;
            var currentUrl = "<?php echo "#".Yii::app()->controller->id.".".Yii::app()->controller->action->id ?>";
            var debugMap = [
                <?php if(YII_DEBUG) { ?>
                   { "userId":"<?php echo Yii::app()->session['userId']?>"},
                   { "userEmail":"<?php echo Yii::app()->session['userEmail']?>"}
                <?php } ?>
                ];

            /* variables globales communexion */    
            var myContacts = <?php echo (@$myFormContact != null) ? json_encode($myFormContact) : "null"; ?>;
            var myContactsById =<?php echo (@$myFormContact != null) ? json_encode($myFormContact) : "null"; ?>;
            var userConnected = <?php echo isset($me) ? json_encode($me) : "null"; ?>;

            jQuery(document).ready(function() {
                loadByHash(location.hash,true);
            });
        </script>

    </body>

</html>