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
padding:px;
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
		<h2><?php echo $user["name"]?></h2>
   		 <p> </p>
     	<div class="grid">
            <div data-ss-colspan="2"><a href="<?php echo Yii::app()->createUrl('index.php/commune/cp/'.$user["cp"])?>"  > Ma Commune </a></div>
            <div data-ss-colspan="2"><a href="#"  > + Association </a></div>
            <div data-ss-colspan="3"><a href="#">+ Société</a></div>
            <div data-ss-colspan="3"><a href="#">+ concitoyen</a> </div>
            <div data-ss-colspan="2"><a href="#"   target="_blank" role="button" data-toggle="modal"> Activité Citoyenne </a></div>
            <div data-ss-colspan="2"><a href="#"   target="_blank" role="button" data-toggle="modal"></a></div>
            <div></div>
            <div></div>
            <div></div>
       </div>
		
	</div>
</div>


<script type="text/javascript"		>
initT['animInit'] = function(){

	$(".grid").shapeshift({
	    minColumns: 3
	  });
	
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},0.3);
})();

  
};
</script>