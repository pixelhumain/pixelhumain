<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
  <head>
    <title>Nouveau Message depuis le site internet :</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td align="left" valign="top">
          <img src='<?php echo Yii::app()->createAbsoluteUrl("themes/theme-granddir/assets".$logo) ?>' alt="Granddir" title="Granddir"/>
        </td>
        <td align="left">
           <span>Nom : </span><?php echo $name?><br/>
           <span>Email : </span><?php echo $email?><br/>
           <span>Sujet : </span><?php echo $subject?><br/>
           <span>Message : </span><?php echo $message?><br/>
        </td>
      </tr>
    </table>
  </body>
</html>