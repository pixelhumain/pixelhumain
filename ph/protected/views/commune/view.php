<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.touch-punch.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.shapeshift.min.js' , CClientScript::POS_END);
?>
<style>
h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}
.grid a{
display:block;
font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
}
.grid {
      border: 1px dashed #CCC;
      position: relative;
    }

    .grid > div {
      background: #AAA;
      position: absolute;
      height: 100px;
      width: 100px;
    }

    .grid > div[data-ss-colspan="2"] { width: 210px; }
    .grid > div[data-ss-colspan="3"] { width: 320px; }

    .grid > .ss-placeholder-child {
      background: transparent;
      border: 1px dashed blue;
    }	
.graph div{border:1px solid #666;text-align:center}
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2> Commune <?php echo $cp?></h2>
    <p> Valorisation l'information locale, les actions... </p>
 	<div class="grid">
        <div></div>
        <div  data-ss-colspan="2"><a href="<?php echo Yii::app()->createUrl('index.php/projet/list/ownerId/')?>">Projet(s)</a></div>
        <div></div>
        <div data-ss-colspan="2"><a href="#"   target="_blank" role="button" data-toggle="modal"><i class="icon-plus"></i> Membres</a></div>
        <div data-ss-colspan="2"><a href="#"   target="_blank" role="button" data-toggle="modal"><i class="icon-plus"></i> Bureau</a></div>
        <div data-ss-colspan="3"><a href="#"   target="_blank" role="button" data-toggle="modal">Statistic </a></div>
        <div></div>
        <div data-ss-colspan="3"><a href="#"   target="_blank" role="button" data-toggle="modal">Évènement </a></div>
        <div></div>
        <div></div>
        <div></div>
   </div>
   
   
   
</div></div>

<div class="container graph">
<div class="hero-unit">
	<div class="row-fluid">
		<div class="span4">
			<h2>Habitants</h2>
			<?php 
			$citoyens = Yii::app()->mongodb->citoyens->find(array("cp"=>$cp));
			foreach($citoyens as $c)
			    echo $c["name"]."<br/>";?>
			
		</div>
		<div class="span4">
			<h2>Informations / Activité</h2>
			
		</div>
		<div class="span4">
			<h2>Associations </h2>
			<?php 
			$assos = Yii::app()->mongodb->group->find(array("cp"=>$cp,"type"=>"association"));
			foreach($assos as $a)
			    echo $a["name"]."<br/>";?>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span8">
		<h2>Photographies / Vidéos</h2>
		</div>
		<div class="span4">
		<h2>Entreprises </h2>
		<?php 
			$assos = Yii::app()->mongodb->group->find(array("cp"=>$cp,"type"=>"entreprise"));
			foreach($assos as $a)
			    echo $a["name"]."<br/>";?>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span4">
		<h2>Concerts</h2>
		</div>
		<div class="span4">
		<h2>Découvrez</h2>
		</div>
		<div class="span4">
		<h2>Participez</h2>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span6">
		<h2>Interrogez</h2>
		</div>
		<div class="span6">
		<h2>Recommendez</h2>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span4">
		<h2>Petites Annonces</h2>
		</div>
		<div class="span4">
		<h2>Covoiturez</h2>
		</div>
		<div class="span4">
		<h2>Rézoté</h2>
		</div>
	</div>
	
</div></div>

<script type="text/javascript"		>
initT['animInit'] = function(){
	$(".grid").shapeshift({
	    minColumns: 3
	  });
        (function ani(){
        	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
        })();
};
</script>			