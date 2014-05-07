<?php 
/*$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/magic.css');*/
?>
<style>
h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}

</style>
<div style="width:50px;height:50px;background-color: #324553; padding:3px;float:left;"><a href="#" id="trigger" class="menu-trigger"></a></div>
    <div class="hero-unit " id="">
    	
        <h2>TEST</h2>
        
        <?php 

        // connect
$m = new MongoClient();

// select a database
$db = $m->pixelhumain;

// select a collection (analogous to a relational database's table)
$collection = $db->lists;

$cursor = $collection->find();

// iterate through the results
foreach ($cursor as $document) {
    echo $document["name"] . "<br/>";
}

        $assoNames = array();
        $tmp = iterator_to_array(Yii::app()->mongodb->group->find( array("type"=>"association"), array("name" => 1) ));
        foreach($tmp as $a)
            $assoNames[$a['name']] = $a['name'] ;
        var_dump($assoNames);?>
        
        <div class="input-append">
            <?php $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
                    'name' => 'eventWhen',
                    'pluginOptions' => array(
                        'format' => 'mm/dd/yyyy'
                    )
                ));
            ?>
            <span class="add-on" style="color:black"><icon class="icon-calendar"></icon></span>
    	</div>
    	
    	<div class="input-append">
           <?php $this->widget(
                'yiiwheels.widgets.daterangepicker.WhDateRangePicker',
                array(
                    'name' => 'daterangepickertest',
                    'htmlOptions' => array(
                        'placeholder' => 'Select date'
                    )
                )
            );
            ?>
            <span class="add-on" style="color:black"><icon class="icon-calendar"></icon></span>
    	</div>
    	
    	<?php
                    $this->widget('yiiwheels.widgets.fineuploader.WhFineUploader', array(
                            'name'          => 'photo',
                            'uploadAction'  => $this->createUrl('index.php/templates/upload', array('fine' => 1)),
                            'pluginOptions' => array(
                                'validation'=>array(
                                    'allowedExtensions' => array('jpeg', 'jpg','png','gif')
                                )
                            )
                        ));
                    ?>
    	
    	<div  id="coco" style="display:block">
        	<h2>TEST</h2>    	
        	  <?php 
                $test = Yii::app()->mongodb->test->findOne(array("ki"=>"lo"));
                $test["ki"] = "ki";
                Yii::app()->mongodb->test->save($test);
                ?>  
        </div>
	</div>
<script type="text/javascript"		>
initT['animInit'] = function(){
	setTimeout( function() { $('#coco').addClass('tinRightIn'); } , 2000);
};
</script>			