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
    <div class="hero-unit">
    	
        <h2>TEST</h2>
        
        <?php 
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
    	<h2>TEST</h2><h2>TEST</h2>
    	<h2>TEST</h2>
    	<h2>TEST</h2>
    	<h2>TEST</h2>
    	<h2>TEST</h2>
    	v
	</div>
<script type="text/javascript"		>
initT['animInit'] = function(){
	
};
</script>			