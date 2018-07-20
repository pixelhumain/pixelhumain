<?php
$logoHeader=(@$logoHeader) ? $logoHeader : "";
$urlRedirect=Yii::app()->getRequest()->getBaseUrl(true);
$validationKey =Person::getValidationKeyCheck($invitedUserId);
//$url = Yii::app()->getRequest()->getBaseUrl(true).(empty($url) ? "/".$this->module->id : $url)."/person/validateinvitation/user/".$invitedUserId.'/validationKey/'.$validationKey.'/invitation/1';

$urlValidation = Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id."/person/validateinvitation/user/".$invitedUserId.'/validationKey/'.$validationKey.'/invitation/1';
Yii::app()->language = $language;

if(!empty($invitorUrl))
	$invitorName='<a href="'.$invitorUrl.'" target="_blank">'.$invitorName.'</a>';
if(@$url){
    $urlRedirect=Yii::app()->getRequest()->getBaseUrl(true).$url;
    $keyOn=(strrpos($url, "survey") !== false) ? str_replace("/", ".", $url) : ltrim($url, '/');
    $urlValidation=Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id."/person/validateinvitation/user/".$invitedUserId.'/validationKey/'.$validationKey.'/invitation/1/redirect/'.$keyOn;
}
$this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.header', array("logo"=>@$logoHeader, "url"=> $urlRedirect));
 ?>
<table class="row masthead" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;background: white;width: 100%;position: relative;display: table;">
	<tbody>
		<tr style="padding: 0;vertical-align: top;text-align: left;"> <!-- Masthead -->
			<th class="small-12 large-12 columns first last" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 16px;">
				<table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
					<tr style="padding: 0;vertical-align: top;text-align: left;">
						<th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
							<center style="width: 100%;min-width: 532px;">
							<!--http://localhost:8888/ph/images/logoLTxt.jpg-->
							<?php if(!empty($logo2)){ ?> 
								<img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true).$logo2 ?>" valign="bottom" alt="Logo Communecter" align="center" class="text-center" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: auto;max-width: 100%;clear: both;display: block;margin: 0 auto;float: none;text-align: center;">
							<?php } ?>
							</center>
						</th>
						<th class="expander" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0 !important;margin: 0;text-align: left;line-height: 19px;font-size: 15px;visibility: hidden;width: 0;"></th>
					</tr>
				</table>
			</th>
		</tr>
	</tbody>
</table>
<table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;position: relative;display: table;">
	<tbody>
		<tr style="padding: 0;vertical-align: top;text-align: left;"> <!-- Horizontal Digest Content -->
			<th class="small-12 large-12 columns first" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 8px;">
				<table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
					<tr style="padding: 0;vertical-align: top;text-align: left;">
						<th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
							<!--http://localhost:8888/ph/images/betatest.png-->
							<!-- <a href="http://www.communecter.org" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;"><img align="right" width="200" src="<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/images/bdb.png"?>" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: auto;max-width: 100%;clear: both;display: block;border: none;" alt="Intelligence collective"></a> -->
							<b>
								<h5 style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: center;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 20px;">
									<!-- Aussi connecté que Facebook et aussi ouvert que Wikipédia, rejoignez le mouvement ! -->
									<?php echo Yii::t("mail","Connected like Facebook and open like Wikipedia join the movement!") ?>
								</h5>
							</b><br/>
							<?php echo Yii::t("mail","You have been inviting on {what} by {who}",array("{what}"=>$title,"{who}"=>"<b>".$invitorName."</b>")) ?>.
							<br/><br/>
							<?php if(!empty($message)){
								echo Yii::t("mail","His message for you") ?> : <br/>
							<p style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 10px;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;"><i><?php echo nl2br(htmlentities($message)); ?></i></p>
							<br/>
							<?php } else { 

									if(!empty($msg))
										echo nl2br(htmlentities($msg));
									else
										echo Yii::t("mail","In just a few clicks discover local activity on CO and use tools for your own organization : news feeds, agendas, classified ads, directories of initiatives towards a more sustainable world !") ?>.
								<br/><br/>
								<?php if(!empty($invitorName)){
									echo Yii::t("mail","{who} started without you, but you can join him at any time by clicking here", array("{who}"=>$invitorName));
								}
							} ?>
						</th>
					</tr>
					<tr style="padding: 0;vertical-align: top;text-align: center;">
						<th style="color: #728289;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: center;line-height: 19px;">
							<h6 style="text-align: center;">
								<a href="<?php echo $urlValidation ?>" style="color: #728289;font-family: Helvetica, Arial, sans-serif;font-weight: bold;padding: 0;margin: 0;text-align: center;line-height: 1.3;text-decoration: none;">
									<?php echo Yii::t("mail","Confirm the invitation") ?>
								</a>
							</h6>
						</th>
					</tr>
					<tr style="padding: 0;vertical-align: top;text-align: left;">
						<th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;">
							<br/><br/>
							<p style="margin: 0;margin-bottom: 10px;color: #3c5665 !important;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;font-size: 12px;">
							<?php echo Yii::t("mail","If the link doesn&apos;t work, you can copy it in your browser&apos;s address") ?>
							<div style="word-break: break-all;font-size: 12px;"><?php echo $urlValidation ?></div></p>
	
	<?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.footer', array("name"=>$title, "url"=>$urlRedirect)); ?>

