<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/morris.js-0.4.3/morris.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/morris.js-0.4.3/morris.min.js' , CClientScript::POS_END);
$cs->registerScriptFile( 'http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js' , CClientScript::POS_END);
?>
<style>
#myfirstchart svg{z-index: 1000;}
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <div id="myfirstchart" style="height: 250px;"></div>
    
    </div></div>
<script type="text/javascript"		>
initT['animInit'] = function(){

	
	Morris.Bar({
	  element: 'myfirstchart',
	  data: [
	    { y: '2006', a: 100, b: 90 },
	    { y: '2007', a: 75,  b: 65 },
	    { y: '2008', a: 50,  b: 40 },
	    { y: '2009', a: 75,  b: 65 },
	    { y: '2010', a: 50,  b: 40 },
	    { y: '2011', a: 75,  b: 65 },
	    { y: '2012', a: 100, b: 90 }
	  ],
	  xkey: 'y',
	  ykeys: ['a', 'b'],
	  labels: ['Series A', 'Series B']
	});
  
};
</script>