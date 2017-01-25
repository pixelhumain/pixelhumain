<style>
h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}
ol.slats li {
	margin: 0 0 10px 0;
	padding: 0 0 10px 0;
	border-bottom: 1px solid #eee;
	}
ol.slats li:last-child {
	margin: 0;
	padding: 0;
	border-bottom: none;
	}
ol.slats li h3 {
	font-size: 18px;
	font-weight: bold;
	line-height: 1.1;
	}
ol.slats li h3 a img {
	float: left;
	margin: 0 10px 0 0;
	padding: 4px;
	border: 1px solid #eee;
	}
ol.slats li h3 a:hover img {
	background: #eee;
	}
ol.slats li p {
	margin: 0 0 0 76px;
	font-size: 14px;
	line-height: 1.4;
	}
ol.slats li p span.meta {
	display: block;
	font-size: 12px;
	color: #999;
	}		
		
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2>Agir Localement avec le PH</h2>
    <p>Actions Locales : toute initiatives locales ouvertes : qui peut interresser un petit ou gros groupe de personne dans votre commune. </p>
<ol class="slats">
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/actualite')?>">
				Se tenir informer 
			</a>
			<p>Tous ce qui se passe localement </p>
		</h3>
	</li>
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/diffusion/hangout')?>">
				Visioner le Conseil Municipal en direct
			</a>
		</h3>
	</li>
	<li>Proposer/Organiser des actions locales</li>
	<li>Donner votre avis sur des propositions d'actions locales</li>
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/projet')?>">
				Proposer/Organiser des projets locaux
			</a>
		</h3>
	</li>
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/discuter')?>">
				participer aux reflexions locale
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