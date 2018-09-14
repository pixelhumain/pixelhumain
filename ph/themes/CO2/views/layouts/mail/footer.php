<?php 
  $nameTeam=(@$name && !empty($name)) ? $name : "COmmunecter" ;
  $urlRedirect=(@$url && !empty($url)) ? $url : Yii::app()->getRequest()->getBaseUrl(true) ;
?>
<br>
<br>
              <p style="margin: 0;margin-bottom: 10px;color: #777777 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 15px;"><?php echo Yii::t("mail","See you soon on {what}",array("{what}"=>'<a href="'.$urlRedirect.'" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;">'.$urlRedirect.'</a>')) ?>, </p>
              <p style="margin: 0;margin-bottom: 10px;color: #777777 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 15px;"><?php echo Yii::t("mail","The team of {what}", array("{what}"=>$nameTeam)) ?>.</p>
            </th>
            </tr>
          </table>
        </th>
        </tr></tbody></table>
          <?php if($nameTeam== "COmmunecter"){ ?> 
            <table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
            <tr style="padding: 0;vertical-align: top;text-align: left;">
              <th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
                <center style="width: 100%;min-width: 532px;">
                <!--http://localhost:8888/ph/images/logoLTxt.jpg-->
                <a href="https://www.helloasso.com/associations/open-atlas/collectes/communecter" target="_blank">
                <img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/images/banniere-campagne-acoeur.jpg" ?>" valign="bottom" alt="Logo Communecter" align="center" class="text-center" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: auto;max-width: 100%;clear: both;display: block;margin: 0 auto;float: none;text-align: center;">
                </a>
                </center>
              </th>
              <th class="expander" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0 !important;margin: 0;text-align: left;line-height: 19px;font-size: 15px;visibility: hidden;width: 0;"></th>
            </tr>
          </table>
        <?php } ?>

   <!-- End main email content -->

 <table class="container text-center" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: center;background: #fefefe;width: 580px;margin: 0 auto;"><tbody><tr style="padding: 0;vertical-align: top;text-align: left;"><td style="word-wrap: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0;vertical-align: top;text-align: left;color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 15px;border-collapse: collapse !important;"> <!-- Footer -->
    <table class="row grey" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;background: #f0f0f0;width: 100%;position: relative;display: table;"><tbody><tr style="padding: 0;vertical-align: top;text-align: left;">
      <th class="small-12 large-12 columns first last" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 16px;">
            <table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
              <tr style="padding: 0;vertical-align: top;text-align: left;">

                  <th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
                  <p class="text-center footercopy" style="margin: 0;margin-bottom: 10px;color: #777777 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 20px 0px;text-align: center;line-height: 19px;font-size: 12px;font-style: italic;">
                    <?php echo Yii::t("mail","You can unsubscribe on mail received on turn off mail notication on your settings or you can choose parameters of mail notifications in the same space") ?> <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true) ?>"><?php echo Yii::t("mail","here") ?></a></p>
                  </th>
                </tr>
                <tr style="padding: 0;vertical-align: top;text-align: left;">
                  <th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
              <p class="text-center footercopy" style="margin: 0;margin-bottom: 10px;color: #777777 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 20px 0px;text-align: center;line-height: 19px;font-size: 12px;font-style: italic;"><?php echo Yii::t("mail","Mail send from") ?> <?php echo Yii::app()->getRequest()->getBaseUrl(true) ?></p>
                    </th>
            <th class="expander" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0 !important;margin: 0;text-align: left;line-height: 19px;font-size: 15px;visibility: hidden;width: 0;"></th>
              </tr>
            </table>
        </th>
        </tr></tbody></table>
    </td></tr></tbody></table>


  </center></td></tr></table>
</body></html>