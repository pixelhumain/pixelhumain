<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
  <head>
    <title><?php echo Yii::t(PTranslate::CAT_MAILS, 'Perfony Mail')?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">
      .ReadMsgBody {width: 100%;} 
      .ExternalClass {width: 100%;}  
      #fractal_70f {-webkit-text-size-adjust:none;} 
      body{background-color:#000000} 
    </style>
  </head>
  <body style="background-color:#000000;margin:0px" bgcolor="#000000">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:#000000">
      <tr>
        <td align="left" valign="top">
          <table cellpadding="0" cellspacing="0" border="0" width="620" align="center">
            <tbody>
              <tr>
                <td align="left" height="150" width="320" valign="middle">
                  <img src="<?php echo $imgPath?>/logo.png" width="315" height="165" alt="Perfony" title="Perfony" />
                </td>
                <td align="center" height="150" width="300" valign="middle">
                  <a href="<?php echo $basePath?>" title="<?php echo CHtml::encode(Yii::t('dashboard', 'Dashboard title'))?>"><img src="<?php echo $imgPath?>/dashboard_<?php echo strtolower(Yii::app()->language)?>.png" width="251" height="41" alt="<?php echo CHtml::encode(Yii::t('dashboard', 'Dashboard title'))?>" title="<?php echo CHtml::encode(Yii::t('dashboard', 'Dashboard title'))?>" /></a>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td align="left" valign="top">
          <table cellpadding="0" cellspacing="0" border="0" width="620" align="center" style="background-color:#ffffff" bgcolor="#FFFFFF">
            <tbody>
              <tr>
                <td align="left" height="30" width="320" valign="middle">
                  <img src="<?php echo $imgPath?>/x.gif" width="320" height="30" alt="" />
                </td>
                <td align="center" height="30" width="180" valign="middle" style="background-color:#009BE3;color:#ffffff" bgcolor="#009BE3">
                  <b><?php echo $sectionTitle?></b>
                </td>
                <td align="center" height="30" width="20" valign="middle">
                  <a href="#"><img src="<?php echo $imgPath?>/x.gif" width="20" height="30" alt="" /></a>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td align="left" valign="top">
          <table cellpadding="0" cellspacing="0" border="0" width="620" align="center" style="background-color:#ffffff" bgcolor="#FFFFFF">
            <tbody>
              <tr>
                <td align="left" height="30" width="30" valign="middle">
                  <img src="<?php echo $imgPath?>/x.gif" width="30" height="30" alt="" />
                </td>
                <td align="left" height="30" width="560" valign="top">
                  <img src="<?php echo $imgPath?>/x.gif" width="560" height="30" alt="" />
                  <div style="font-weight:bold;font-size:22px;"><?php echo $title?></div>
                  
                  <img src="<?php echo $imgPath?>/x.gif" width="560" height="25" alt="" />
                  <div style="font-weight:bold;font-size:13px;">
                    <?php echo $genericText?>
                  </div>
                  
                  <img src="<?php echo $imgPath?>/x.gif" width="560" height="25" alt="" />           
                  <div style="font-size:13px;">
                    <?php echo $body;?>
                  </div>                                    
                  <img src="<?php echo $imgPath?>/x.gif" width="560" height="45" alt="" />
                </td>
                <td align="center" height="30" width="30" valign="middle">
                  <img src="<?php echo $imgPath?>/x.gif" width="20" height="30" alt="" />
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>    
      <tr>
        <td align="left" valign="top">
          <table cellpadding="0" cellspacing="0" border="0" width="620" align="center" style="background-color:#ffffff" bgcolor="#FFFFFF">
            <tbody>
              <tr>
                <td align="left" height="30" width="30" valign="middle">
                  <img src="<?php echo $imgPath?>/x.gif" width="30" height="30" alt="" />
                </td>
                <td align="left" height="30" width="560" valign="top">
                  
                  <img src="<?php echo $imgPath?>/x.gif" width="560" height="20" alt="" />
                  <div style="font-size:11px;font-style:italic" id="fractal_70f">
                  	<i><?php echo Yii::t(PTranslate::CAT_MAILS, 'footer1')?></i><br/>
                    <i><?php echo Yii::t(PTranslate::CAT_MAILS, 'footer2')?></i>
                  </div>
                  
                  <img src="<?php echo $imgPath?>/x.gif" width="560" height="45" alt="" />
                </td>
                <td align="center" height="30" width="30" valign="middle">
                  <img src="<?php echo $imgPath?>/x.gif" width="20" height="30" alt="" />
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
      <tr>
        <td align="center" valign="top">
          <img src="<?php echo $imgPath?>/x.gif" width="620" height="40" alt="" />
        </td>
      </tr>      
    </table>
  </body>
</html>