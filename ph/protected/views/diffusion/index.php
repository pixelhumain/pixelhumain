<style>
h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}

		
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2>Flux Diffusable</h2>
<ol class="slats">
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/diffusion/hangout')?>">
				Conseil Municipale
			</a>
			<p>Tous ce qui se passe localement </p>
		</h3>
	</li>
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/diffusion/audio')?>">
				Audio
			</a>
		</h3>
	</li>
	
</ol>	
</div></div>
<script type="text/javascript"		>
initT['animInit'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
})();
};
</script>			