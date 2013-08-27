<style>
h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}

</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2>TEST</h2>
    
    <?php 
    $assoNames = array();
    $tmp = iterator_to_array(Yii::app()->mongodb->group->find( array("type"=>"association"), array("name" => 1) ));
    foreach($tmp as $a)
        $assoNames[$a['name']] = $a['name'] ;
    var_dump($assoNames);?>
</div></div>
<script type="text/javascript"		>
initT['animInit'] = function(){
	
};
</script>			