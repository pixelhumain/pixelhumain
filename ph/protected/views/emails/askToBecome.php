<?php 
  $this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.header');
	$type="";
	if (@$parentType){
		if($parentType == "organizations"){
			$type="organization";
		}
		else if ($parentType == "projects"){
			$type="project";
		} 
		else if ($parentType == "events"){
			$type="event";
		}
	} 
	if ($type == "") {
		error_log("Unkown type when sending a mail askToBecomeAdimin");
		$type = "Unknwon";
	}
	if (@$typeOfDemand){
		if($typeOfDemand == "admin"){
			$action = "administrate";
		}
		else if($typeOfDemand == "member"){
			$action ="join as member";
		}
		else if ($typeOfDemand == "contributor"){
			$action ="join as contributor";
		}
	}else{
		$action ="administrate";
		$typeOfDemand = "admin";
	}
  $subtitle = Yii::t("mail","Demand to {what} {where}",array("{what}"=> Yii::t("mail", $action), "{where}"=> Yii::t("mail","the ".$type)." ".@$parent["name"]));
  if($parentType==Project::COLLECTION)
    $dir="contributors";
  else if($parentType==Event::COLLECTION)
    $dir="attendees";
  else /*if($type==Organization::COLLECTION)*/
    $dir="members";

	$url=Yii::app()->getRequest()->getBaseUrl(true)."/#page.type.".$parentType.".id.".(String) $parent["id"].".view.directory.dir.".$dir;
?>
<table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;position: relative;display: table;">
	<tbody>
		<tr style="padding: 0;vertical-align: top;text-align: left;"> <!-- Horizontal Digest Content -->
			<th class="small-12 large-12 columns first" style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0 auto;text-align: left;line-height: 19px;font-size: 15px;padding-left: 16px;padding-bottom: 16px;width: 564px;padding-right: 8px;">
				<h1 class="text-center" style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 35px 0px 15px 0px;margin: 0;text-align: center;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 34px;"><?php echo $subtitle ?></h1>
				<table style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;">
					<tr style="padding: 0;vertical-align: top;text-align: left;">
						<th style="color: #3c5665;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 19px;font-size: 15px;">
							<a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true) ?>" style="color: #e33551;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;text-decoration: none;"><img align="right" width="200" src="<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/images/bdb.png"?>" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: auto;max-width: 100%;clear: both;display: block;border: none;" alt="Intelligence collective"></a>
							<b><h5 style="color: inherit;font-family: Helvetica, Arial, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;word-wrap: normal;margin-bottom: 10px;font-size: 20px;"></h5></b><br>
							<?php 
							echo Yii::t("mail","The user {who} asks to become {what} of {where}",array("{who}"=>'<a href="'.Yii::app()->getRequest()->getBaseUrl(true).'/'.$this->module->id.'#page.type.'.Person::COLLECTION.'.id.'.$newPendingAdmin["id"].'">'.@$newPendingAdmin["name"].'</a>',"{what}"=>Yii::t("common",$typeOfDemand) ,"{where}"=>'<a href="'.$url.'">'.@$parent["name"].'</a>')) ?>.
							<br><br>
							<?php echo Yii::t("mail","In order to validate this user as {what}, go to the community of {where}",array("{what}"=>yii::t("common",$typeOfDemand),"{where}"=>'<a href="'.$url.'">'.$parent["name"].'</a>')); ?>.
							<br><br>
							<?php echo Yii::t("mail","If the link doesn&apos;t work, you can copy it in your browser&apos;s address"); ?> :
							<br><div style="word-break: break-all;"><br><i><?php echo $url?></i></div>
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
   <!-- End main email content -->
  <?php //$this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.mail.footer'); ?>