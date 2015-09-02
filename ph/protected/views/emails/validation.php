<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
  <head>
    <title><?php echo $title?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
    <span style="text-align: left;"><?php echo Utils::getServerName()?></span>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td align="left" valign="top">
          <img src='<?php echo Yii::app()->getRequest()->getBaseUrl(true).$this->module->assetsUrl.$logo ?>' alt="<?php echo $title?>" title="<?php echo $title?>"/>
        </td>
        <td align="left">
           <h3>Bienvenue au <?php echo $title?> !! </h3>
           veuillez clicker sur le lien pour confirmer votre compte<br/>
           ou copier le directement dans votre navigateur 
           <br/>
           <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id; ?>/person/activate/user/<?php echo $user.'/validationKey/'.Person::getValidationKeyCheck($user)?>">Validation</a>
        </td>
      </tr>
      </table>
  </body>
</html>