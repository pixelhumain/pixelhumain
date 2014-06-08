On peut designer comme on veut:
<br/>
<?php 
echo $survey["message"];
?>
<br/>
<?php 
if(isset( Yii::app()->session["userId"]) && Yii::app()->session["userEmail"] != $survey["email"]){
	if(!(isset($survey[Action::ACTION_FOLLOW]) 
	    && is_array($survey[Action::ACTION_FOLLOW]) 
	    && in_array(Yii::app()->session["userId"], $survey[Action::ACTION_FOLLOW]))) {
	    	?>
	<a class="btn" href="javascript:addaction('<?php echo (string)$survey["_id"]?>','<?php echo Action::ACTION_FOLLOW ?>')"><i class='fa fa-rss' ></i> Suivre cette loi</a>
	<?php } else {?>
	Vous suivez actuellement cette loi. <i class='fa fa-rss' ></i>
	<?php } 
} else {?>
	Vous etes a l'origine de cette loi.
<?php } ?>