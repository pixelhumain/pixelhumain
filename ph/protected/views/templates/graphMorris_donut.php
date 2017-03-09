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

	/*
	 * Play with this code and it'll update in the panel opposite.
	 *
	 * Why not try some of the options above?
	 */
	Morris.Donut({
	  element: 'myfirstchart',
	  data: [
	    {label: "Download Sales", value: 12},
	    {label: "In-Store Sales", value: 30},
	    {label: "Mail-Order Sales", value: 20}
	  ]
	});
  
};
</script>