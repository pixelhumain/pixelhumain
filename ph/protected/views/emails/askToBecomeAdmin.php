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
        <td align="left">
           <h3>Demande d'ajout d'administrateur sur l'organisation <?php echo @$organization["name"]?>. </h3>
           L'utilisateur <?php echo @$newPendingAdmin["username"]?> demande à devenir administrateur de l'organisation <?php echo @$organization["name"]?>.<br/>
           Pour plus de détail sur l'utilisateur <?php echo @$newPendingAdmin["username"]?>, vous pouvez visiter <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id."/default/simple/#person.detail.id.".(String) @$newPendingAdmin["_id"]."?tpl=directory2&isNotSV=1"?>">sa fiche profil</a>.<br/>
           Afin de valider cet utilisateur en tant qu'administrateur rendez vous sur la liste des membres de votre 
           <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id."/default/simple/#organization.directory.id.".(String) $organization["_id"]."?tpl=directory2&isNotSV=1"?>">organisation</a>.
        </td>
      </tr>
      </table>
  </body>
</html>