  <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
  <head>
    <title>PixelHumain</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
    <span style="text-align: left;"><?php echo Utils::getServerName()?></span>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td align="left" valign="top">
          <img src='<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/logo/logo144.png' alt="PixelHumain" title="PixelHumain"/>
        </td>
        <td align="left">
           <h3>Un nouveau post sur le fil de Pixel'humain "help and debug" de <?php echo $title; ?></h3>
           <i>"<?php echo $content ?>"</i>
           <br/>
           <p> Retrouver les news au lien suivant <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id."#news.index.type.pixels?isNotSV=1"?>" target="_blank">ici</a>
           <br/>
        </td>
      </tr>
      </table>
  </body>
</html>