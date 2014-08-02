<div class="fss">
	<?php

	//TODO make generic maybe as Widget with parameters
	//params : 
	// module : ex : azotlive
	// collection : type folder
	$collection = PHType::TYPE_CITOYEN;
	$srcModule = (isset($this->module) && isset($this->module->id)) ? $this->module->id : "global";

	$element = PHDB::findOne($collection , array("_id"=>new MongoId(Yii::app()->session["userId"])) );
	
    echo "saved to : /ph/upload/".$srcModule."/".$collection."<br/>";
	?>
	<div class="controls">
    <img width=50 class="imageThumb" src="<?php echo ( $element && isset($element['image']) ) ? Yii::app()->createUrl($element['image']) : Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png'); ?>"/></td>
    <?php
        $this->widget('yiiwheels.widgets.fineuploader.WhFineUploader', array(
                'name'          => 'imageFile',
                'uploadAction'  => $this->createUrl('/templates/upload/dir/'.$srcModule.'/collection/'.$collection.'/input/imageFile', array('fine' => 1)),
                'pluginOptions' => array(
                    'validation'=>array(
                        'allowedExtensions' => array('jpg','jpeg','png','gif'),
                        'itemLimit'=>1
                    )
                ),
                'events' => array(
                    'complete'=>"function( id,  name,  responseJSON,  xhr){
                        console.log('".Yii::app()->createUrl('upload/'.$srcModule.'/'.$collection.'/')."/'+xhr.name+'?d='+ new Date().getTime());
                        $('#image').val('".Yii::app()->createUrl('upload/'.$srcModule.'/'.$collection.'/')."/'+xhr.name);
                        $('.imageThumb').attr('src','".Yii::app()->createUrl('upload/'.$srcModule.'/'.$collection.'/')."/'+xhr.name+'?d='+ new Date().getTime());
                        
                    }"
                ),
            ));
        ?>
        <input type="hidden" id="image" name="image" value="<?php if(isset($element["image"]))echo $element["image"]?>"/>
    </div>
	
</div>