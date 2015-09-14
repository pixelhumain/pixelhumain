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
</style>
<div class="container graph">
    
    
    
    <div class="hero-unit">
    
    <h2>Commune <?php echo $service["name"] ?></h2>
    <h3> Budget <?php echo $service["budget"]["year"] ?> pour <?php echo $service["budget"]["population"] ?> habitant</h3>
 	
 	
 	
 		<?php 
 		foreach($service["budget"] as $b => $val){
 		    if(is_array($val)){?>
     		<table class="table table-striped">
     			<thead>
     				<tr>
     					<td>Titre </td>
     					<td>Cout</td>
     				</tr>
     			</thead>
         		<?php 
         		
             		foreach($val as $line=>$live){ ?>
             			<tr>
                    	<td><?php echo $line ?></td>
                    	<td><?php echo $live?>€</td>
                    	</tr>
                    <?php }
             		}?>
            </table>
 		<?php    }?>
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