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
  height: 50px;
  width: 100px;
}

.grid > div[data-ss-colspan="2"] { width: 210px; }
.grid > div[data-ss-colspan="3"] { width: 320px; }

.grid > .ss-placeholder-child {
  background: transparent;
  border: 1px dashed blue;
}	
.graph div.block{border:1px solid #666;text-align:center}
#myfirstchart svg{z-index: 1000;}
.actu ul{text-align:left;font-size:small}
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2> Commune <?php echo $cp?></h2>
    <p> Un condenser de votre commune, contribuez à l'action locale. 
    <br/>Commencons par définir un canevas en format ouvert(opendata) decrivant une commune.
    <br/>Pour faciliter la tache pour toute les commune interressé par l'initiative.
    <br/>A tout moment il est important de communecter un maximum de citoyen.
    <br/>*se communecter : Un citoyen connecté à sa commune. 
    </p>
 	<div class="grid">
        <div data-ss-colspan="2"><a href="<?php echo Yii::app()->createUrl('index.php/commune/annuaireElus/ci/'.OpenData::$codePostalToCodeInsee["974"][$cp])?>"  > Annuaire des élus </a></div>
        <div data-ss-colspan="3"><a href="<?php echo Yii::app()->createUrl('index.php/commune/servicesMunicipaux/ci/'.OpenData::$codePostalToCodeInsee["974"][$cp])?>">Services Municipaux</a></div>
        <div data-ss-colspan="3"><a href="<?php echo Yii::app()->createUrl('index.php/opendata/commune/ci/'.OpenData::$codePostalToCodeInsee["974"][$cp])?>">Open Data Commune</a> </div>
        <div data-ss-colspan="2"><a href="#"   target="_blank" role="button" data-toggle="modal">Quartiers, Agglo</a></div>
        <div data-ss-colspan="2"><a href="#"   target="_blank" role="button" data-toggle="modal">Budget</a></div>
        <div></div>
        <div></div>
        <div></div>
   </div>
</div></div>


<script type="text/javascript"		>
initT['animInit'] = function(){
	Morris.Bar({
		  element: 'myfirstchart',
		  data: population,
		  xkey: 'y',
		  ykeys: ['a', 'b'],
		  labels: ['Series A', 'Series B']
		});
	$(".grid").shapeshift({
	    minColumns: 3
	  });
        (function ani(){
        	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
        })();
};
</script>			