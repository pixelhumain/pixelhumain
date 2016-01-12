<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<?php 
	if (@$parentType){
		if($parentType == "organizations"){
			$type="organization";
		}
		else if ($parentType == "projects"){
			$type="project";
		}
	}
	else{
		$type="organization";
	}
	$subtitle = yii::t("email","Demand to")." ";
	if (@$typeOfDemand){
		if($typeOfDemand == "admin"){
			$subtitle .= yii::t("email","administrate");
		}
		else if($typeOfDemand == "member"){
			$subtitle .= yii::t("email","join as member");
		}
		else if ($typeOfDemand == "contributor"){
			$subtitle .= yii::t("email","join as contributor");
		}
	}else{
		$subtitle .= yii::t("email","administrate");
		$typeOfDemand = "admin";
	}
	$subtitle .= " ".yii::t("email","the ".$type);
?>
<html>
  <head>
    <title><?php echo $title ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
    <span style="text-align: left;"><?php echo Utils::getServerName()?></span>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td align="left">
           <h3><?php echo $subtitle ?> <?php echo @$parent["name"]?>. </h3>
           <?php echo yii::t("email","The user")." ".@$newPendingAdmin["username"]." ".Yii::t("email","asks to become")." ".yii::t("common",$typeOfDemand)." ".yii::t("email", "of")." ".@$parent["name"]?>.<br/>
           <?php echo yii::t("email", "For more details on the user")." ".@$newPendingAdmin["username"]?>, <?php echo yii::t("email","you can visit") ?> <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id."/default/simple/#person.detail.id.".(String) @$newPendingAdmin["_id"]."?tpl=directory2&isNotSV=1"?>"><?php echo yii::t("email","sa fiche profil")?></a>.<br/>
           <?php echo yii::t("email","In order to validate this user as")." ".yii::t("common",$typeOfDemand).", ".yii::t("email","go to the members' list of your")." "; ?>
           <a href="<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id."/default/simple/#organization.directory.id.".(String) $parent["_id"]."?tpl=directory2&isNotSV=1"?>"><?php echo yii::t("common",$type) ?></a>.
        </td>
      </tr>
      </table>
  </body>
</html>