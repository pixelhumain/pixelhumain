<?php
  $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.header');
  $validationKey =Person::getValidationKeyCheck($invitedUserId);
  $url = Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id."/person/validateinvitation/user/".$invitedUserId.'/validationKey/'.$validationKey.'/invitation/1';
  ?>
    <table class="row masthead" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;background: #3c5665;width: 100%;position: relative;display: table;"><tbody><tr style="padding: 0;vertical-align: top;text-align: left;"> <!-- Masthead -->
      <th class="small-12 large-12 columns first last" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 16px;">
        <table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
          <tr style="padding: 0;vertical-align: top;text-align: left;">
            <th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
              <h1 class="text-center" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 35px 0px 15px 0px;margin: 0;text-align: center;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 34px;">Invitation en attente sur <?php echo $title ?></h1>
              <center style="width: 100%;min-width: 532px;">
              <!--http://localhost:8888/ph/images/logoLTxt.jpg-->
              <img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true).$logo2 ?>" valign="bottom" alt="Logo Communecter" align="center" class="text-center" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: auto;max-width: 100%;clear: both;display: block;margin: 0 auto;float: none;text-align: center;">
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
              <a href="http://www.communecter.org" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;"><img align="right" width="200" src="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/images/bdb.png' ?>" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: auto;max-width: 100%;clear: both;display: block;border: none;" alt="Intelligence collective"></a>
              <b><h5 style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 20px;">Invitation en attente pour rejoindre le r&eacute;seau <?php echo $title ?></h5></b><br>
              Vous avez &eacute;t&eacute; invit&eacute; au projet <?php echo $title ?> <?php if(@$invitorName && !empty($invitorName)){ ?>par <b><?php echo (empty($invitorUrl)?$invitorName:'<a href="'.$invitorUrl.'" target="_blank">'.$invitorName.'</a></b>'); } ?>, il y a quelque temps. Prenez le temps de finaliser votre inscription <?php if(@$invitorName && !empty($invitorName)){ ?>afin que vous puissiez échanger avec <?php echo $invitorName ?> sur <?php echo $title; } ?></b><br>
              <br><br>
              Veuillez cliquer sur ce lien pour rejoindre <?php echo $title ?> et ainsi participer a cette initiative locale pour am&eacute;liorer votre commune.<br>
              <br>
              <a href="<?php echo $url?>" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;">Confirmer l&apos;invitation</a>
              <br>
              <br>
              Si le lien ne fonctionne pas vous pouvez le copier dans l&apos;adresse de votre navigateur :
              <br><div style="word-break: break-all;"><?php echo $url?></div>
              <br>
              <br>
              <p style="margin: 0;margin-bottom: 10px;color: #777777 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 15px;">A tr&egrave;s bient&ocirc;t sur <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true) ?>" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;"><?php echo Yii::app()->getRequest()->getBaseUrl(true) ?></a></p>
              <p style="margin: 0;margin-bottom: 10px;color: #777777 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 15px;">L&apos;&eacute;quipe de <?php echo $title ?></p>
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
    
  <table class="container text-center" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: center;background: #fefefe;width: 580px;margin: 0 auto;"><tbody><tr style="padding: 0;vertical-align: top;text-align: left;"><td style="word-wrap: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0;vertical-align: top;text-align: left;color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 15px;border-collapse: collapse !important;"> <!-- Footer -->
    <table class="row grey" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;background: #f0f0f0;width: 100%;position: relative;display: table;"><tbody><tr style="padding: 0;vertical-align: top;text-align: left;">
      <th class="small-12 large-12 columns first last" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 16px;">
            <table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
              <tr style="padding: 0;vertical-align: top;text-align: left;">
                  <th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
              <p class="text-center footercopy" style="margin: 0;margin-bottom: 10px;color: #777777 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 20px 0px;text-align: center;line-height: 19px;font-size: 12px;">Mail envoyé depuis <?php echo Yii::app()->getRequest()->getBaseUrl(true) ?></p>
                    </th>
            <th class="expander" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0 !important;margin: 0;text-align: left;line-height: 19px;font-size: 15px;visibility: hidden;width: 0;"></th>
              </tr>
            </table>
        </th>
        </tr></tbody></table>
    </td></tr></tbody></table>


  </center></td></tr></table>
</body></html>