<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/upload/styles.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/upload/jquery.filedrop.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/upload/script.js' , CClientScript::POS_END);
?>
<style>

</style>

		<div id="dropbox">
			<span class="message">Drop images here to upload. <br /><i>(they will only be visible to you)</i></span>
		</div>
<script type="text/javascript">
initT['uploadInit'] = function(){
	
};
</script>