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
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2>Start Up Week End 2013</h2>
    <p>C'est Raid, c'est grand, 54h pour Pitcher, Rézoter, Contribuer, Développer, Finaliser votre projet.</p>
    <div class="grid">
        <div></div>
        <div  data-ss-colspan="2">
        <a href="<?php echo Yii::app()->createUrl('index.php/evenement/swegraph')?>">Panel/ Graph</a>
        </div>
        <div></div>
        <div data-ss-colspan="2"><a href="#sweInscription"   target="_blank" role="button" data-toggle="modal">Inscription</a></div>
        <div data-ss-colspan="2"><a href="#sweProjet"   target="_blank" role="button" data-toggle="modal">Projet / Equipe</a></div>
        
        <div data-ss-colspan="3"><a href="#sweHelp"   target="_blank" role="button" data-toggle="modal">Help / Coach </a></div>
        <div></div>
        <div data-ss-colspan="3"><a href="#sweFeedback"   target="_blank" role="button" data-toggle="modal">Feedback / Experience</a></div>
        <div></div>
        <div></div>
        <div></div>
   </div>
      
</div></div>
<script type="text/javascript"        >
initT['animInit'] = function(){
(function ani(){
      TweenMax.staggerFromTo(".grid a",2, {scaleX:0.4, scaleY:0.4}, {scaleX:0.8, scaleY:0.8});
})();

$(".grid").shapeshift({
    minColumns: 3
  });

};
</script>