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
           <h3>Un nouvel évennment créé <?php echo $title?> par <?php echo $creatorName?>!! </h3>
           suivez le lien pour découvrir<br/>
           ou copier le directement dans votre navigateur 
           <br/>
           <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true).$this->module->id; ?>/<?php echo $url?>">Découvrir</a>
        </td>
      </tr>
      </table>
  </body>
</html>