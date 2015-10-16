<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
  <head>
    <title><?php echo $title?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
   

  </body>
  <body>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td align="left" valign="top">
          <img src='<?php echo Yii::app()->getRequest()->getBaseUrl(true).$logo ?>' alt="<?php echo $title?>" title="<?php echo $title?>"/>
        </td>
        <td align="left">
           <h3>Réinitialisez votre mot de passe‏ - <?php echo $title?></h3>
           Vous avez fait une demande de réinitialisation de votre mot de passe.
           Afin d'accéder à votre espace Azotlive, vous pouvez utiliser ce mot de passe :  <?php echo $pwd?> 
           
           Si le problème persiste, n’hésitez pas à nous contacter à l'aide du formulaire dans la partie "contact".
           L'équipe Azotlive
           <br/>
           <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>">Login</a>
        </td>
      </tr>
      </table>
  </body>
</html>