<?php
  $logoHeader=(@$logoHeader) ? $logoHeader : "";
  $urlRedirect=Yii::app()->getRequest()->getBaseUrl(true);
  $urlValidation=Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id.'/person/activate/user/'.$user.'/validationKey/'.Person::getValidationKeyCheck($user);
  if(@$url){
    $urlRedirect=Yii::app()->getRequest()->getBaseUrl(true).$url;
    $keyOn=(strrpos($url, "survey") !== false) ? str_replace("/", ".", $url) : ltrim($url, '/');
    $urlValidation=Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id.'/person/activate/user/'.$user.'/validationKey/'.Person::getValidationKeyCheck($user)."/redirect/".$keyOn;
  }
  $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.header', array("logo"=>@$logoHeader, "url"=> $urlRedirect));
?>
   <table class="row masthead" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;background: white;width: 100%;position: relative;display: table;"><tbody><tr style="padding: 0;vertical-align: top;text-align: left;"> <!-- Masthead -->
      <th class="small-12 large-12 columns first last" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 16px;">
        <table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
          <tr style="padding: 0;vertical-align: top;text-align: left;">
            <th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
              <h1 class="text-center" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 35px 0px 15px 0px;margin: 0;text-align: center;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 34px;"><?php echo Yii::t("mail","Finalization of your registration") ?></h1>
              <center style="width: 100%;min-width: 532px;">
              <!--http://localhost:8888/ph/images/logoLTxt.jpg-->
              <?php if(@$logo2 && !empty($logo2)){ ?> 
              <img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true).$logo2 ?>" valign="bottom" alt="<?php echo Yii::app()->getRequest()->getBaseUrl(true).$logo2 ?>" align="center" class="text-center" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: auto;max-width: 100%;clear: both;display: block;margin: 0 auto;float: none;text-align: center;">
              <?php } ?>
              </center>
            </th>
            <th class="expander" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0 !important;margin: 0;text-align: left;line-height: 19px;font-size: 15px;visibility: hidden;width: 0;"></th>
              </tr>
            </table>
      </th>
    </tr></tbody></table>
    <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;position: relative;display: table;"><tbody><tr style="padding: 0;vertical-align: top;text-align: left;"> <!--This row adds the gap between masthead and digest content -->
      <th class="small-12 large-12 columns first last" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 16px;">
        <table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
          <tr style="padding: 0;vertical-align: top;text-align: left;">
            <th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
                        &#xA0; 
                    </th>
            <th class="expander" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0 !important;margin: 0;text-align: left;line-height: 19px;font-size: 15px;visibility: hidden;width: 0;"></th>
              </tr>
            </table>
      </th>
        </tr></tbody></table>
     <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;position: relative;display: table;"><tbody><tr style="padding: 0;vertical-align: top;text-align: left;"> <!-- Horizontal Digest Content -->
      <th class="small-12 large-12 columns first" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 8px;">
            <table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
            <tr style="padding: 0;vertical-align: top;text-align: left;">
              <th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
                <!--http://localhost:8888/ph/images/betatest.png-->
              <h3 style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 22px;"><?php echo Yii::t("mail","Welcome on {what}",array("{what}"=>$title)) ?></h3>
             <?php echo Yii::t("mail","Please click on the following link to confirm your account") ?>:<br>
           <a href="<?php echo $urlValidation ?>" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;"><?php echo Yii::t("mail","Validation of my account") ?></a>
           <br>
            <br>
            <?php echo Yii::t("mail","If the link doesn&apos;t work, you can copy it in your browser&apos;s address"); ?> :<br>  
           <div style="word-break: break-all;"><?php echo $urlValidation ?></div>
             
   <?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.footer', array("name"=>$title, "url"=>$urlRedirect)); ?>
