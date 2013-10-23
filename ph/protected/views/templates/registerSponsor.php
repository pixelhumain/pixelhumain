<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/upload/styles.css');
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' , CClientScript::POS_END);
?>
<style>

</style>

<div class="container graph">
    <br/>
    <div class="hero-unit">

<div class="signup__container">
	<a href="#" class="btn--sign-up hacker">Register</a>
	<a href="#" class="btn--sign-up sponsor">Sponsor</a>
  
  <span class="sign-up--devider">OR</span>
</div>
<small>font-size at 300%, change the value and see the magic of em!</small>

    </div></div>
<script type="text/javascript"		>
initT['animInit'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},0.3);
})();

  
};
</script>