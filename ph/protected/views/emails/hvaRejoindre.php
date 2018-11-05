<?php
$logoHeader=(@$logoHeader) ? $logoHeader : "";
$urlRedirect=Yii::app()->getRequest()->getBaseUrl(true);

//Yii::app()->language = $language;


// if(@$url){
//     $urlRedirect=Yii::app()->getRequest()->getBaseUrl(true).$url;
//     $keyOn=(strrpos($url, "survey") !== false) ? str_replace("/", ".", $url) : ltrim($url, '/');
//     $urlValidation=Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id."/person/validateinvitation/user/".$invitedUserId.'/validationKey/'.$validationKey.'/invitation/1/redirect/'.$keyOn;
// }

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
									<?php echo Yii::t("mail","Quelqu'un veut nous rejoindre") ?>
								</h5>
							</b><br/>
							<?php
							echo $name." veut rejoindre le portail HVA avec son organisation : ".$orga."</br> Dont voici les coordonnées : </br></br>";

							echo "Téléphone : ".$tel."</br></br>";
							echo "Email : ".$email."</br></br>";
							echo "Ville : ".$ville."</br></br>";

							?>
							
						</th>
					</tr>
					<tr style="padding: 0;vertical-align: top;text-align: left;">
						<th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;">
							<br/><br/>
	
	<?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.footer', array("name"=>$title, "url"=>$urlRedirect)); ?>

