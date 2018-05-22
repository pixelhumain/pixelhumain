<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
  <title><?php echo CHtml::encode( (isset($this->module->pageTitle))?$this->module->pageTitle:""); ?></title>
   
 <?php  
 $cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app() -> createUrl(Yii::app()->params["module"]["parent"]."/default/view/page/trad/dir/..|translation/layout/empty"));

//tka todo : objective to not do this 
//empty shouldnt carry all variables of all apps 
$parentModuleId = ( @Yii::app()->params["module"]["parent"] ) ?  Yii::app()->params["module"]["parent"] : $this->module->id;
$me = isset(Yii::app()->session['userId']) ? Person::getById(Yii::app()->session['userId']) : null;
$communexion = CO2::getCommunexionCookies();
        
echo $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.initJs', 
                                 array( "me"=>$me, "parentModuleId" => $parentModuleId, "myFormContact" => @$myFormContact, "communexion" => $communexion));
       
  $cssJs = array(
    '/js/api.js',
    
    '/plugins/bootstrap/css/bootstrap.min.css',
    '/plugins/bootstrap/js/bootstrap.min.js' ,
    //'/plugins/font-awesome/css/font-awesome.min.css',
    //'/plugins/font-awesome-custom/css/font-awesome.css',
    '/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.css',
    '/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js' ,
    '/plugins/blockUI/jquery.blockUI.js' ,
    
    '/plugins/font-awesome/css/font-awesome.min.css',
    '/plugins/toastr/toastr.js' , 
    '/plugins/toastr/toastr.min.css',

    '/plugins/cryptoJS-v3.1.2/rollups/aes.js',


//tka todo : should be loaded on demand
'/plugins/jquery.dynForm.js',
'/plugins/jquery-validation/dist/jquery.validate.min.js',
'/plugins/jQuery-Knob/js/jquery.knob.js',
'/plugins/jQuery-Smart-Wizard/js/jquery.smartWizard.js',
'/plugins/jquery.dynSurvey/jquery.dynSurvey.js',

'/plugins/select2/select2.min.js' , 
'/plugins/moment/min/moment.min.js' ,
'/plugins/moment/min/moment-with-locales.min.js',

// '/plugins/bootbox/bootbox.min.js' , 
// '/plugins/blockUI/jquery.blockUI.js' , 

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


  );
  HtmlHelper::registerCssAndScriptsFiles($cssJs, Yii::app()->request->baseUrl);
  
  $cssJS = array(
    '/js/dataHelpers.js',
//tka refactor : should be loaded on demand
    '/js/scopes/scopes.js',
    '/js/co.js',
    '/js/default/index.js',
    '/js/default/directory.js',
    '/js/jquery.filter_input.js'
  );

  HtmlHelper::registerCssAndScriptsFiles($cssJS, Yii::app()->getModule( Yii::app()->params["module"]["parent"] )->getAssetsUrl() );

  $cssJs = array(
    '/assets/css/CO2/CO2-boot.css',
    '/assets/css/CO2/CO2-color.css',
    '/assets/css/CO2/CO2.css',
    '/assets/css/plugins.css',
    '/assets/css/default/dynForm.css',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssJs, Yii::app()->theme->baseUrl);


  
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jQuery/jquery-2.1.1.min.js' );
  ?>
  
  <script type="text/javascript">
   // var initT = new Object();
   // var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
   // var moduleId = "<?php echo $this->module->id?>";
   // debug = false;
   </script>
</head>

<body class="body">
  <progress class="progressTop" max="100" value="20"></progress>   
  <div id="mainMap">
      <?php 
      $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
      $parentModuleId = ( @Yii::app()->params["module"]["parent"] ) ?  Yii::app()->params["module"]["parent"] : $this->module->id;
      $modulePath = ( @Yii::app()->params["module"]["parent"] ) ?  "../../".$parentModuleId."/views"  : "..";
      $this->renderPartial( $layoutPath.'mainMap.'.Yii::app()->params["CO2DomainName"], array("modulePath"=>$modulePath )); ?>
  </div>
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

<?php 
  $parentModuleId = ( @Yii::app()->params["module"]["parent"] ) ?  Yii::app()->params["module"]["parent"] : $this->module->id;

  $this->renderPartial($layoutPath.'initJs', 
                                 array( "me"=>$me, "parentModuleId" => $parentModuleId, "myFormContact" => @$myFormContact, "communexion" => CO2::getCommunexionCookies()));
?>
<script type="text/javascript">

  jQuery(document).ready(function() {
      $(".btn-show-mainmenu").click(function(){
          $("#dropdown-user").addClass("open");
      });
      themeObj.init();
  });
 
  function initNotifications(){
  
    $('.btn-menu-notif').off().click(function(){
      mylog.log("click notification main-top-menu");
        showNotif();
      });

  } 
</script>

</body>
</html>
