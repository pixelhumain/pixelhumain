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

.red {
  background: red;
}

.white {
  background: white;
}
</style>


<div class="container graph">
    <br/>
	<div class="hero-unit">
		<div class="grid">
		<?php 
		$ct = 0;
		foreach( Yii::app()->mongodb->data->find(array( "key" => "templates" , 
														"type" => "template")) as $d)
		{?>
			<div  data-ss-colspan="2" class="<?php if(strlen($d["name"]) >6 ) echo "red"; else echo "white"; ?>">
				<a href="<?php echo Yii::app()->createUrl("index.php/templates?name=".$d["name"]);?>"><?php echo $d["name"];?></a>
				<img src="<?php echo Yii::app()->createUrl('images/templates/'.$d["name"].'.png');?>" width=50/>
			</div>	
			
		<?php  
			$ct++;
		}?>
		<div   data-ss-colspan="2"> Hello </div>
		</div>
	</div>
</div>

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