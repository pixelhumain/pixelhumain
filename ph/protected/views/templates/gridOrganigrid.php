<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.touch-punch.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.shapeshift.min.js' , CClientScript::POS_END);
?>
<style>
h2,h3,h4 {
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
  visibility:hidden;
  border: 1px dashed #CCC;
  position: relative;
}

.grid > div {
  padding:8px;
  background-color:#F5E424;
  /*position: absolute;*/
  min-height: 230px;
  width: 100px;
}
.txt {font-size:small;color:black;line-height:18px;}
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
    
    <h2> Grid Organigram Sample</h2>
    <a href="#" onclick="filterType('people','#F5E424')">All</a> <a href="#" onclick="filterType('graphiste','#df354c')">Grapohiste</a>  <a href="#" onclick="filterType('dev','#3399FF')">Dev</a> 
 	<div class="grid">
        <div data-ss-colspan="2" class="people graphiste">
        	<img src="http://placehold.it/240x100"/>
        	<h4>Stéphanie Lorente</h4>
        	<span class="txt">Directrice Artistique, Aime les animaux et rendre les choses SEXY</span>
        </div>
        
        <div data-ss-colspan="2" class="people dev">
        	<img src="http://placehold.it/240x100"/>
        	<h4>Stéphanie Lorente</h4>
        	<span class="txt">Directrice Artistique, Aime les animaux et rendre les choses SEXY</span>
        </div>
        
        <div data-ss-colspan="2" class="people dev">
        	<img src="http://placehold.it/240x100"/>
        	<h4>Stéphanie Lorente</h4>
        	<span class="txt">Directrice Artistique, Aime les animaux et rendre les choses SEXY</span>
        </div>
        
        <div data-ss-colspan="2" class="people">
        	<img src="http://placehold.it/240x100"/>
        	<h4>Stéphanie Lorente</h4>
        	<span class="txt">Directrice Artistique, Aime les animaux et rendre les choses SEXY</span>
        </div>
        
        <div data-ss-colspan="2" class="people">
        	<img src="http://placehold.it/240x100"/>
        	<h4>Stéphanie Lorente</h4>
        	<span class="txt">Directrice Artistique, Aime les animaux et rendre les choses SEXY</span>
        </div>
        
        <div data-ss-colspan="2" class="people">
        	<img src="http://placehold.it/240x100"/>
        	<h4>Stéphanie Lorente</h4>
        	<span class="txt">Directrice Artistique, Aime les animaux et rendre les choses SEXY</span>
        </div>
        
        <div data-ss-colspan="2" class="people dev">
        	<img src="http://placehold.it/240x100"/>
        	<h4>Stéphanie Lorente</h4>
        	<span class="txt">Directrice Artistique, Aime les animaux et rendre les choses SEXY</span>
        </div>
   </div>
   
</div></div>

<script type="text/javascript">
function filterType(type,color){
	/*$(".people ").hide();
	$("."+type).show();*/
	TweenLite.to(".people ", 1, {scaleY:0});
	TweenLite.to("."+type, 1, {scaleY:1,backgroundColor:color});
}
initT['animInit'] = function(){
	/*$(".grid").shapeshift({
	    minColumns: 3
	  });*/
	$(".grid").css("visibility","visible");
    (function ani(){
    	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
    })();
};
</script>	