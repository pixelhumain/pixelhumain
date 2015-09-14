<style>
h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}
h3{
	font-family: "Homestead";
	}
.container ul{list-style:none}
.container li{float:left; 
text-align:center;
width:130px;
height:130px;
border:1px solid #666;
margin:10px;
}	
		
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2> Modélisons nos Communes</h2>
    <p> En analysant le conportement de nos communes, nous pourront alors produire un modèle communal interresant, fonctionnel et duplicable  
    <br/>Mais d'abord nousdevons nous regrouper, nous faire connaitre, et échanger.<br>
    Le PH repose sur l'activité de chacun d'entre nous, il prendra tous son sens  quand on arrivera a valorisé la somme de nos petites actions.
    </p>
    
    <?php 
        $ct = Yii::app()->mongodb->citoyens->find();
        $cps = array();
        $cpCt = array();
        $totalCount = 0;
        ?>
    	  
        <?php 
        foreach ($ct as $e){
            if(isset($e["cp"])) {
                if( !in_array($e["cp"],$cps)){
                    array_push($cps, $e["cp"]);
                    $cpCt[$e["cp"]] = 1;
                } else
                    $cpCt[$e["cp"]] = $cpCt[$e["cp"]]+1;
                $totalCount++;
            }   
        }?>
    <div>
    
    <div class="row-fluid">
		<div class="span6">
		<h2> <?php $citizenCount = Yii::app()->mongodb->citoyens->count(); echo $citizenCount?> Inscrits </h2>
		<p>Communectez Vous (préciser votre code postal)
		</p>
		</div>
		<div class="span6">
		<h3><?php echo $totalCount?> comptes communnectés :-(</h3>
        <p><div id="progressbar" style=" border:4px solid #324553; width:250px; height:30px;">
            	<div style="background-color:#324553;margin:3px;width:<?php echo ($totalCount * 235 / $citizenCount )?>px;height:15px"></div>
            </div>
            soit <?php echo ($totalCount * 100 / $citizenCount )?> %
        </p> 
        </div>
		</div>
	</div>
	 
    <ul class="slats">
    	<?php 
        foreach ($cps as $cp){
        ?>
        <li class="group"><h3><a href="<?php echo Yii::app()->createUrl('index.php/commune/view/cp/'.$cp)?>"><?php echo $cp?></a> <br/><?php echo $cpCt[$cp]?></h3></li>
        <?php }?>
        
    </ul>
    <canvas>
    	<?php 
        foreach ($cps as $cp){
        ?>
        <li class="group"><h3><a href="<?php echo Yii::app()->createUrl('index.php/commune/view/cp/'.$cp)?>"><?php echo $cp?></a> (<?php echo $cpCt[$cp]?>)</h3></li>
        <?php }?>
        
    </canvas>   	
</div></div>
<script type="text/javascript"		>
initT['animInit'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},0.3);
})();

  
};
</script>			