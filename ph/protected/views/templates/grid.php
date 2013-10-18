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
  min-height: 50px;
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
    
    <h2> Grid Sample</h2>
    <p> Un condenser de votre commune, contribuez à l'action locale. 
    <br/>La 1ere etape est de connecter un maximum de citoyen a l'initiative.
    </p>
 	<div class="grid">
        <div></div>
        <div  data-ss-colspan="2">
            <a href="<?php echo Yii::app()->createUrl('index.php/projet/list/ownerId/')?>">Projet(s)</a>
            <p> Un condenser de votre commune, contribuez à l'action locale. 
            	<br/>La 1ere etape est de connecter un maximum de citoyen a l'initiative.
            </p>
        </div>
        <div></div>
        <div data-ss-colspan="2">
        <a href="#"   target="_blank" role="button" data-toggle="modal"><i class="icon-plus"></i> Membres</a>
        <img src="http://placehold.it/350x150"/>
        </div>
        <div data-ss-colspan="2"><a href="#"   target="_blank" role="button" data-toggle="modal"><i class="icon-plus"></i> Bureau</a></div>
        <div data-ss-colspan="3"><a href="#"   target="_blank" role="button" data-toggle="modal">Statistic </a></div>
        <div></div>
        <div data-ss-colspan="3">
        	<a href="#"   target="_blank" role="button" data-toggle="modal">Évènement </a>
        	<p> Un condenser de votre commune, contribuez à l'action locale. 
            <br/>La 1ere etape est de connecter un maximum de citoyen a l'initiative.
            </p>
        </div>
        <div></div>
        <div></div>
        <div></div>
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