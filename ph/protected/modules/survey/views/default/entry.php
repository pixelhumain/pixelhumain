<span style="color:red">A designer :</span>
<br/>
<?php 
echo $survey["message"];
?>
<br/>
<?php 
if(isset( Yii::app()->session["userId"]) && Yii::app()->session["userEmail"] != $survey["email"]){
	if(!(isset($survey[ActionType::ACTION_FOLLOW]) 
	    && is_array($survey[ActionType::ACTION_FOLLOW]) 
	    && in_array(Yii::app()->session["userId"], $survey[ActionType::ACTION_FOLLOW]))) {
	    	?>
	<br/><a class="btn" href="javascript:addaction('<?php echo (string)$survey["_id"]?>','<?php echo ActionType::ACTION_FOLLOW ?>')"><i class='fa fa-rss' ></i> Suivre cette loi</a>
	<?php } else {?>
	<br/>Vous suivez actuellement cette loi. <i class='fa fa-rss' ></i>
	<?php } 
} else {?>
	Vous etes a l'origine de cette loi.
	<br/><a class="btn" onclick="entryDetail('<?php echo Yii::app()->createUrl("/survey/default/entry/surveyId/".(string)$survey["_id"])?>','edit')" href="javascript:;"><i class='fa fa-pencil' ></i> Editer votre loi</a>

<?php } ?>