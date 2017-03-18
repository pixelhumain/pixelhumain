  <?php
  $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.header');
  $url = Yii::app()->getRequest()->getBaseUrl(true)."/#".Element::getControlerByCollection($parentType).".detail.id.".(string)$parent["_id"];
  $verbAction=$verb;
  if($verb=="contribute")
    $verbAction="contribute to";
  else if ($verb=="participate")
    $verbAction="participate to";
  ?>
    <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;position: relative;display: table;"><tbody><tr style="padding: 0;vertical-align: top;text-align: left;"> <!-- Horizontal Digest Content -->
      <th class="small-12 large-12 columns first" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 8px;">

              <h1 class="text-center" style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 35px 0px 15px 0px;margin: 0;text-align: center;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 34px;"><?php echo Yii::t("mail","Invitation to")." ".Yii::t("mail", $verbAction) ?> <?php echo $parent["name"] ?></h1>
            <table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
            <tr style="padding: 0;vertical-align: top;text-align: left;">
              <th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
                <!--http://localhost:8888/ph/images/betatest.png-->
              <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true) ?>" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;"><img align="right" width="200" src="<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/images/bdb.png"?>" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: auto;max-width: 100%;clear: both;display: block;border: none;" alt="Intelligence collective"></a>
              <b>
              <h5 style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 20px;"></h5></b><br>
              <?php echo Yii::t("mail","You have been invited on") ?> <?php echo Yii::t("common", "the ".Element::getControlerByCollection($parentType)) ?> <?php echo Yii::t("common", "by") ?> <b><a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true) ?>/#person.detail.id.<?php echo $invitorId ?>" target="_blank"><?php echo $invitorName ?></a>.</b><br>
              <br><br>
              <?php echo Yii::t("mail","Please connect you and go to the detail of")." ".Yii::t("common","this ".Element::getControlerByCollection($parentType))." ".Yii::t("mail", "following link under")." ".Yii::t("mail","to answer to the invitation").". ".Yii::t("mail","If you validate, you will be added as")." ".Yii::t("common", $typeOfDemand)." ".Yii::t("mail", "to the comminity else the link between you and")." ".Yii::t("common","the ".Element::getControlerByCollection($parentType))." ".Yii::t("mail", "will be destroyed")."." ?>
              <br>
              <br>
              <a href="<?php echo $url?>" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;"><?php echo Yii::t("mail","Answer to the invitation") ?></a>
              <br>
              <br>
              <?php echo Yii::t("mail","If the link doesn&apos;t work, you can copy it in your browser&apos;s address"); ?> :
              <br><div style="word-break: break-all;"><?php echo $url?></div>
              <br>
              <br>
              <p style="margin: 0;margin-bottom: 10px;color: #777777 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 15px;"><?php echo Yii::t("mail","See you soon on") ?> <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true) ?>" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;"><?php echo Yii::app()->getRequest()->getBaseUrl(true) ?></a></p>
              <p style="margin: 0;margin-bottom: 10px;color: #777777 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 15px;"><?php echo Yii::t("mail","The team of communecter") ?></p>
            </th>
            </tr>
          </table>
        </th>
        </tr></tbody></table>
    <hr style="max-width: 580px;height: 0;border-right: 0;border-top: 0;border-bottom: 1px solid #cacaca;border-left: 0;margin: 20px auto;clear: both;">
    <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;position: relative;display: table;"><tbody><tr style="padding: 0;vertical-align: top;text-align: left;"> <!-- CTA -->
      <th class="small-12 large-12 columns first last" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 16px;">
            <table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
              <tr style="padding: 0;vertical-align: top;text-align: left;">
                  <th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
                        <center style="width: 100%;min-width: 532px;">
                          <br align="center" class="text-center"><br align="center" class="text-center">
                          <h5 align="center" class="text-center" style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: center;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 20px;">Accepter l'invitation</h5>
                          <table class="button text-center" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: center;margin: 0 0 16px 0;width: auto !important;"><tr style="padding: 0;vertical-align: top;text-align: left;"><td style="word-wrap: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0;vertical-align: top;text-align: left;color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 15px;border-collapse: collapse !important;"><table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;"><tr style="padding: 0;vertical-align: top;text-align: left;"><td style="word-wrap: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0;vertical-align: top;text-align: left;color: #fefefe;font-family: Helvetica, Arial, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 15px;background: #e33551;border: 2px solid #e33551;border-collapse: collapse !important;width: auto !important;"><a href="<?php echo $url?>" style="color: #fefefe;font-family: Helvetica, Arial, sans-serif;font-weight: bold;padding: 8px 16px 8px 16px;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;font-size: 16px;display: inline-block;border: 0px solid #e33551;border-radius: 3px;">Go <?php echo $title ?></a></td></tr></table></td></tr></table>
                          <br align="center" class="text-center">
                        </center>
                    </th>
            <th class="expander" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0 !important;margin: 0;text-align: left;line-height: 19px;font-size: 15px;visibility: hidden;width: 0;"></th>
              </tr>
            </table>
        </th>
        </tr></tbody></table>
    </td></tr></tbody></table> <!-- End main email content -->
  <?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.footer'); ?>
