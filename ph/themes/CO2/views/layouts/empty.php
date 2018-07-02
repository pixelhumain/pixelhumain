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
    
  $cssJs = array(
    '/js/api.js',
    
    '/plugins/bootstrap/css/bootstrap.min.css',
    '/plugins/bootstrap/js/bootstrap.min.js' ,
    //'/plugins/font-awesome/css/font-awesome.min.css',
    //'/plugins/font-awesome-custom/css/font-awesome.css',
    '/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.css',
    '/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js' ,
    '/plugins/blockUI/jquery.blockUI.js' ,
    '/plugins/jquery-cookie/jquery.cookie.js' ,
    
    '/plugins/font-awesome/css/font-awesome.min.css',
    '/plugins/toastr/toastr.js' , 
    '/plugins/toastr/toastr.min.css',

    '/plugins/cryptoJS-v3.1.2/rollups/aes.js',
    '/plugins/fine-uploader/jquery.fine-uploader/fine-uploader-gallery.css',
    '/plugins/fine-uploader/jquery.fine-uploader/jquery.fine-uploader.js',
    '/plugins/fine-uploader/jquery.fine-uploader/fine-uploader-new.min.css'
  );
  HtmlHelper::registerCssAndScriptsFiles($cssJs, Yii::app()->request->baseUrl);
  
  $cssJs = array(
    '/assets/css/CO2/CO2-boot.css',
    '/assets/css/CO2/CO2-color.css',
    '/assets/css/CO2/CO2.css',
    '/assets/css/plugins.css',
    '/assets/css/default/dynForm.css',
    '/assets/css/freelancer.css',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssJs, Yii::app()->theme->baseUrl);

  $cssAnsScriptFilesModule = array( 
    '/assets/js/coController.js',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);

  
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile(Yii::app()->request->baseUrl. '/plugins/jQuery/jquery-2.1.1.min.js' );
  ?>
  
  <script type="text/javascript">
  // **************************************
  //THEME TEMPLATE : CO2 / EMPTY
  // **************************************
   var initT = new Object();
   var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
   var moduleId = "<?php echo $this->module->id?>";
   debug = false;
   </script>
</head>

<body class="body">
  <div class="main-container col-md-12 col-sm-12 col-xs-12 no-padding">

<?php 
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
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

     $this->renderPartial($layoutPath.'modals.'.$CO2DomainName.'.mainMenu', array("me"=>$me) );
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
