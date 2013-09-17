<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/magic.css');
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
    	<div  id="coco" style="display:block">
        	<h2>TEST</h2>    	
        	    <div id="disqus_thread"></div>
                <script type="text/javascript">
                    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                    var disqus_shortname = 'pixelhumain'; // required: replace example with your forum shortname
            
                    /* * * DON'T EDIT BELOW THIS LINE * * */
                    (function() {
                        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
                	
        </div>
    	<a href="#" onclick="javascript:$('#coco').addClass('magictime tinRightOut');">Hide Magic</a>
	</div>
<script type="text/javascript"		>
initT['animInit'] = function(){
	setTimeout( function() { $('#coco').addClass('tinRightIn'); } , 2000);
};
</script>			