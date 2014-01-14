<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://' , CClientScript::POS_END);
?>

<!-- BLOCK CSS -->
<style>

</style>

<!-- BLOCK HTML  -->

<div class="container graph">
    <br/>
    <div class="hero-unit">



	</div>
</div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},0.3);
})();

  
};
</script>