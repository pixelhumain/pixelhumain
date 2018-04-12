<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- ****************************** THEME CO2 : cotools ******************************-->
<?php 

    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    $themeAssetsUrl = Yii::app()->theme->baseUrl. '/assets';
    $parentModuleId = ( @Yii::app()->params["module"]["parent"] ) ?  Yii::app()->params["module"]["parent"] : $this->module->id;
    $modulePath = ( @Yii::app()->params["module"]["parent"] ) ?  "../../../".$parentModuleId."/views"  : "..";

    $cs = Yii::app()->getClientScript();

    $CO2DomainName = isset(Yii::app()->params["CO2DomainName"]) ? Yii::app()->params["CO2DomainName"] : "CO2";

    $params = CO2::getThemeParams();
    $metaTitle = @$params["metaTitle"];
    $metaDesc = @$params["metaDesc"]; 
    $metaImg = Yii::app()->getRequest()->getBaseUrl(true)."/themes/CO2".@$params["metaImg"];
    
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo Yii::app()->language; ?>" lang="<?php echo Yii::app()->language; ?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="language" content="<?php echo Yii::app()->language; ?>" />
  <meta name="keywords" lang="<?php echo Yii::app()->language; ?>" content="<?php echo (isset($this->module->keywords)) ? CHtml::encode($this->module->keywords) : ""; ?>">
  <meta name="description" content="<?php echo CHtml::encode ( (@isset($this->module->description))?$this->module->description:""); ?>">
  <meta name="publisher" content="Pixel Humain on Github">
  <meta name="author" lang="<?php echo Yii::app()->language; ?>" content="Pixel Humain" />
  <meta name="robots" content="Index,Follow" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo $this->module->assetsUrl?>/images/logo.png"/>

  <?php if( Yii::app()->params["forceMapboxActive"]==true &&  Yii::app()->params["mapboxActive"]==true ){ ?>
    <script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css"> 

    <script src='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'></script>
    <link href='//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css' rel='stylesheet' />
<?php } ?>

  <title><?php echo CHtml::encode( (isset($this->module->pageTitle))?$this->module->pageTitle:""); ?></title>
   
 <?php  
  $cssAnsScriptFilesModule = array(
    '/plugins/bootstrap/css/bootstrap.min.css',
    '/plugins/font-awesome/css/font-awesome.min.css',
    '/plugins/font-awesome-custom/css/font-awesome.css',
    '/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.css',
    '/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js' ,
    '/plugins/bootstrap/js/bootstrap.min.js' ,
    '/plugins/blockUI/jquery.blockUI.js' ,
    '/plugins/font-awesome/css/font-awesome.min.css',
    '/plugins/font-awesome-custom/css/font-awesome.css',
    '/js/api.js'
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->request->baseUrl);
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile( Yii::app()->request->baseUrl. '/plugins/jQuery/jquery-2.1.1.min.js' );



  ?>
  
  <script type="text/javascript">
   var initT = new Object();
   var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
   var moduleId = "<?php echo $this->module->id?>";
   debug = false;
   </script>
  
  <?php
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
                

                '/plugins/cryptoJS-v3.1.2/rollups/aes.js'
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
            HtmlHelper::registerCssAndScriptsFiles( array('/js/default/formInMap.js') , $moduleAssets);
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
            );
            HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);

            /* ***********************
            END theme stuff
            ************************ */


            if($CO2DomainName != "CO2"){
                $cssAnsScriptFilesModule = array(
                    //'/assets/css/themes/'.$CO2DomainName.'/'.$CO2DomainName.'.css',
                    '/assets/css/themes/'.$CO2DomainName.'/'.$CO2DomainName.'-color.css',
                    '/assets/js/themes/'.$CO2DomainName.'.js',
                );
                HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);
            }
        ?>


</head>

<body>
  
  <progress class="progressTop" max="100" value="20"></progress>   

  <div class="main-container col-md-12 col-sm-12 col-xs-12 no-padding">

<?php 
    $me = isset(Yii::app()->session['userId']) ? Person::getById(Yii::app()->session['userId']) : null;
    $CO2DomainName = Yii::app()->params["CO2DomainName"];
    $this->renderPartial( $layoutPath.'menus/'.$CO2DomainName, 
                            array( "layoutPath"=>$layoutPath , 
                                    "subdomain"=>"", //$subdomain,
                                    "subdomainName"=>"", //$subdomainName,
                                    "mainTitle"=>"", //$mainTitle,
                                    "placeholderMainSearch"=>"", //$placeholderMainSearch,
                                    "type"=>@$type,
                                    "me" => $me) );
    echo $content; ?> 
  </div>



</body>
</html>