
<!-- BLOCK HTML  -->

<div class="container ">
    <br/>
    <div class="whitebg">
		<h2>Mes Groupes</h2>
		<p>Toutes les entités groupés que je gere ou auquel je participe </p>
		
			<div class="row">
        
    			<div class="span6 " >
        		    <div class='panel panel-info col-md-6'>
                    <h2>Je participe</h2>
                    <ul>
                        <?php 
                        $groups = Yii::app()->mongodb->group->find(array('$or' => array( 
                                                                                    array("participants"=>new MongoId(Yii::app()->session["userId"])),
                                                                                    array("participants"=>Yii::app()->session["userId"]),
                                                                                    )
                                                                                ));
                        foreach ($groups as $g){
                        ?>
                        <li class="group"><a href="<?php echo Yii::app()->createUrl('group/view/id/'.$g["_id"])?>"><?php echo $g["name"]?></a></li>
                        <?php }?>
                    </ul>
                    </div>
                </div>
                
                <div class="span6 ">
                    <div class='panel panel-inverse col-md-6'>
                    <h2 class="white">J'anime</h2>
                    <ul > 
                    <?php 
                    $groups = Yii::app()->mongodb->group->find( array('$or' => array(
                                                                                array( "owner" => new MongoId( Yii::app()->session["userId"] ) ),
                                                                                array( "owner" => Yii::app()->session["userId"]  ),
                                                                                array( "organisateurs" => new MongoId( Yii::app()->session["userId"] ) ),
                                                                                array( "organisateurs" => Yii::app()->session["userId"]  )
                                                                                )
                                                                            ));
                    foreach ($groups as $g){
                    ?>
                    <li class="group"><a href="<?php echo Yii::app()->createUrl('group/view/id/'.$g["_id"])?>"><?php echo $g["name"]?></a></li>
                    <?php }?>
                    </ul>
                    </div>
    			</div>
				
			</div>
			<div class="clear"></div>
		
	</div>
</div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){

  
};
</script>