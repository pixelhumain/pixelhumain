<?php
$this->pageTitle=Yii::app()->name . ' - Graph representation des pixels actifs distribué par Code Postal';
?>

<style>
.graph{

}
h2 {
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}

.pixel {
  border: solid 1px #999;
  color:#000;
  float:left;
  width:10px;
  height:10px;
  margin:2px;
  background-color:#f5e414;
  font-size:x-small
}
.pixelactif{
background-color:#374A55;
}
.graph ul{list-style:none}
.graph li{
display:inline;
margin-left:12px;
padding : 8px;
border:1px solid #000;
wrap-text:none;
font-size : 15px;
font-weight:bold;
-webkit-border-radius: 5px;
border-radius:5px ; 
}
</style>


<div class="container graph">
    <br/>
    <div class="hero-unit">
        <h2>Pixel Funding : 1 pixel = 1€</h2>
        <ul>
        	<li> <a href="javascript:buy(1)">citoyen 1€</a> </li>
        	<li> <a href="javascript:buy(10)">famille 10€</a> </li>
        	<li> <a href="javascript:buy(100)">généreux 100€</a> </li>
        	<li> <a href="javascript:buy(200)">conscient 200€</a> </li>
        	<li> <a href="javascript:buy(500)">spirituel 500€</a> </li>
        	<li> <a href="javascript:buy(1000)">visionnaire 1000€</a> </li>
        	<li> <a href="javascript:buy(10000)">avengardiste 10000€</a> </li>
        </ul>
        <div id="graphBody"></div>
        <div class="clear"></div>
  </div>
</div>

<script type="text/javascript">
initT['animError'] = function(){
    (function ani(){
    	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
    })();
    str = "";
    for (var ix=0;ix<100;ix++)
    	str += '<div class="pixel"></div>';
    	
    for (var i=0;i<100;i++)
    	$("#graphBody").append(str);
};
function buy(x){
	$(".pixelactif").removeClass("pixelactif");
	for (var ix=0;ix<=x;ix++)
		$("#graphBody div:nth-child("+ix+")").addClass("pixelactif");
}
</script>