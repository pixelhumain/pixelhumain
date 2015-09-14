<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/vex/vex.css');
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/vex/vex-theme-os.css');
$cs->registerScriptFile('https://togetherjs.com/togetherjs-min.js' , CClientScript::POS_END);
?>

</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
		<button onclick="TogetherJS(this); return false;">Start TogetherJS</button>
		
</div></div>
<script type="text/javascript">
initT['uploadInit'] = function(){
	
	
};
</script>