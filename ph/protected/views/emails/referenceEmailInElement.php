<?php
$this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.header');
$url = Yii::app()->getRequest()->getBaseUrl(true)."/#page.type.".$collection.".id.".$id;
Yii::app()->language = $language;
?>
<table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;position: relative;display: table;">
	<tbody>
		<tr style="padding: 0;vertical-align: top;text-align: left;"> <!-- Horizontal Digest Content -->
			<th class="small-12 large-12 columns first" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 8px;">

				<h1 class="text-center" style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 35px 0px 15px 0px;margin: 0;text-align: center;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 34px;"><?php echo Yii::t("mail","Your email has been referenced on {website}",array("{website}"=>$title)); ?></h1>
				<table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
					<tr style="padding: 0;vertical-align: top;text-align: left;">
						<th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
		<!--http://localhost:8888/ph/images/betatest.png-->
							<a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true) ?>" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;"><img align="right" width="200" src="<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/images/bdb.png"?>" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: auto;max-width: 100%;clear: both;display: block;border: none;" alt="Intelligence collective"></a>
							<b>
							<h5 style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 20px;"></h5></b><br>
							<?php echo Yii::t("mail", "{who} indicated your email as contact on {what}", array("{what}"=> Yii::t("common", "the ".Element::getControlerByCollection($collection))." <a href='".$url."' target='_blank'>".$name."</a>", "{who}"=>"<b><a href='".Yii::app()->getRequest()->getBaseUrl(true)."/#page.type.".Person::COLLECTION.".id.".$invitorId."' target='_blank'>".$invitorName."</a></b>")) ?><br>
							<br><br>
							<?php echo Yii::t("mail","If you don't know Communecter, it is this territorial search engine and social network respectful of your data. In this open source website, every body can contribute and enrich common knowledge")."." ?>
							<br><br>
							<?php echo Yii::t("mail","If you do not have an account yet, come to discover this tools made for you and your community")."." ?>
							<br><br>
							<?php echo Yii::t("mail","You will enjoy to communicate about the projects, the events of {what} in your territory. You will have the chance to express your needs and search actors around you. You will also be able to discuss and organize your community...", array("{what}" => "<a href='".$url."' target='_blank'>".$name."</a>"))."." ?>
							<br>
							<?php echo Yii::t("mail","And all of this into an <b>ethical</b> and <b>responsible</b> environment") ?>
							<br><br>
							<a href="<?php echo $url?>" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;"><?php echo Yii::t("mail","Don't wait anymore and join us !!") ?></a>

						</th>
					</tr>
				</table>
			</th>
		</tr>
		<tr style="padding: 0;vertical-align: top;text-align: left;">
			<td style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
				<?php $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.footer'); ?>
			</td>
		</tr>
	</tbody>
</table>