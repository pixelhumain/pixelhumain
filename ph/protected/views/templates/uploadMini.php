<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/bootstrap/bootstrap-fileupload.min.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/bootstrap/bootstrap-fileupload.min.js' , CClientScript::POS_END);
?>
<style>
html{background-color:#2A2A2C}
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
		<?php
        $this->widget('yiiwheels.widgets.fineuploader.WhFineUploader', array(
                'name'          => 'fineuploadtest',
                'uploadAction'  => $this->createUrl('index.php/templates/upload', array('fine' => 1)),
                'pluginOptions' => array(
                    'validation'=>array(
                        'allowedExtensions' => array('jpg','jpeg','png','gif')
                    )
                )
            ));
        ?>
	</div>
</div>
<script type="text/javascript"		>
initT['animInit'] = function(){
	
};
</script>
