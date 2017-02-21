<!DOCTYPE html>

<?php 
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    $themeAssetsUrl = Yii::app()->theme->baseUrl. '/assets';
    $cs = Yii::app()->getClientScript();

    $CO2DomainName = isset(Yii::app()->params["CO2DomainName"]) ? Yii::app()->params["CO2DomainName"] : "CO2";
?>

<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $CO2DomainName; ?></title>

        <!-- <link rel='shortcut icon' type='image/x-icon' href="<?php //echo (isset( $this->module->assetsUrl ) ) ? $this->module->assetsUrl : ""?>/images/favicon.ico" /> -->

        <!-- <script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
        <link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' /> -->

        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

        <script src='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'></script>
        <link href='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css' rel='stylesheet' />
        
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
        
        <?php $me = isset(Yii::app()->session['userId']) ? Person::getById(Yii::app()->session['userId']) : null;
              $this->renderPartial($layoutPath.'menusMap/'.$CO2DomainName, array( "layoutPath"=>$layoutPath, "me" => $me ) ); ?>   
        
        <div class="main-container"></div>

        <div id="floopDrawerDirectory" class="floopDrawer"></div>


        <?php $this->renderPartial($layoutPath.'radioplayermodal', array( "layoutPath"=>$layoutPath ) ); ?> 

        

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
                '/plugins/jquery-validation/dist/jquery.validate.min.js',
                '/plugins/jquery-validation/localization/messages_fr.js',
                '/plugins/bootbox/bootbox.min.js' , 
                '/plugins/blockUI/jquery.blockUI.js' , 
                '/plugins/toastr/toastr.js' , 
                '/plugins/toastr/toastr.min.css',
                '/plugins/jquery.ajax-cross-origin.min.js',
                '/plugins/jquery-cookie/jquery.cookie.js' , 
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
                '/plugins/jquery.dynForm.js',
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
                '/assets/js/CO2.js' ,
                
                '/assets/vendor/bootstrap/css/bootstrap.min.css',
                '/assets/css/sig/sig.css',
                '/assets/css/freelancer.css',

                '/assets/css/CO2/CO2-boot.css',
                '/assets/css/CO2/CO2-color.css',
                '/assets/css/CO2/CO2.css',
                 
                '/assets/vendor/jPlayer-2.9.2/dist/skin/blue.monday/css/jplayer.blue.monday.min.css',
                '/assets/vendor/jPlayer-2.9.2/dist/jplayer/jquery.jplayer.min.js',
                '/assets/js/radioplayer.js' ,
                '/assets/js/KDynForm.js' ,
                                                  
            );
            HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);

            //inclue le css & js du theme si != de CO2 (surcharge du code commun du theme si besoin)
            if($CO2DomainName != "CO2"){
                $cssAnsScriptFilesModule = array(
                    '/assets/css/'.$CO2DomainName.'/'.$CO2DomainName.'.css',
                    '/assets/css/'.$CO2DomainName.'/'.$CO2DomainName.'-color.css',
                    '/assets/js/themes/'.$CO2DomainName.'.js',
                );
                HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);
            }
        ?>

        <?php $this->renderPartial($layoutPath.'initJs', 
                                    array("me"=>$me, "myFormContact" => @$myFormContact)); ?>

        <?php $params = CO2::getThemeParams(); ?>

        <script>          
            var CO2DomainName = "<?php echo $CO2DomainName; ?>";
            jQuery(document).ready(function() {
                loadableUrls = <?php echo json_encode($params["pages"]); ?>;
                initToastr();
                loadByHash(location.hash,true);
            });
        </script>

    </body>

</html>