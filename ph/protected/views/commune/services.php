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
.graph a {
color:#000;
}
.grid a{
display:block;
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
      position: absolute;
      min-height: 250px;
      width: 100px;
    }
    .people img {
      width: 60px;
      float:left;
      border-radius: 50%;
    }
.txt {font-size:small;color:black;line-height:18px;font-weight:bold;}
.grid > div[data-ss-colspan="2"] { width: 210px; }
.grid > div[data-ss-colspan="3"] { width: 320px; }

.grid > .ss-placeholder-child {
  background: transparent;
  border: 1px dashed blue;
}	

.graph div{border:1px solid #666;text-align:center}
.menu{paading:5px;font-family: "Homestead"}
a.tags{font-family: "Homestead";font-size:small;line-height:15px;}
</style>
<div class="container graph">
    
    
    
    <div class="hero-unit">
    
    <h2> Services Municipaux</h2>
 	<div class="grid">
 		<?php 
 		foreach($service["servicesMunicipaux"] as $line){
        ?>
        <div data-ss-colspan="2" class="people">
        	<img src="http://vwordpress.stmarys-ca.edu/maddyphenicie/files/2012/12/tools-24dqof6.png" />
        	<h4><?php echo $line['name']?></h4>
        	<span class="txt">Tel : <?php echo $line['tel']?></span>
        	<?php if(isset($line['fax'])){?>
        	<span class="txt">Fax : <?php echo $line['fax']?></span>
        	<?php } ?>
        	<span class="txt">Horaire : <?php echo $line['horaire']?></span>
        </div>
       <?php }?>
   </div>
</div></div>

<script type="text/javascript">
function filterType(type,color){
	$(".people ").hide();
	$("."+type).show();
	/*TweenLite.to(".people ", 1, { display: 'none', scale: 0 });
	TweenLite.to("."+type, 1, { display: 'block', scale: 1, backgroundColor: color });*/
	$(".grid").trigger("ss-rearrange");
}
initT['animInit'] = function(){
	/*TweenMax.set(".people ", {display:"block",scale:1});*/
	$(".grid").shapeshift({
	    minColumns: 3
	  });
	$(".grid").css("visibility","visible");
   /* (function ani(){
    	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
    })();*/
};
</script>	