<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
  <head>
    <title>PixelHumain</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
   

  </body>
  <body>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td align="left" valign="top">
          <img src='<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/logo/logo144.png' alt="PixelHumain" title="PixelHumain"/>
        </td>
        <td align="left">
           <h3>Bienvenue au Pixel Humain !! </h3>
           Utilisez ce mot de passe :  <?php echo $pwd?>
           <br/>
           <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/index.php?r=citoyens/activate/user/<?php echo $user?>">Login</a>
        </td>
      </tr>
      </table>
  </body>
</html>