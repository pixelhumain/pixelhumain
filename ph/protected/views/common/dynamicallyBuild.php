<!-- Simple Node element requesting only a name to create a node  -->

<script type="text/javascript">
requiredFields = [];
</script>
<p> <?php if(isset($txt))echo $txt?></p>
<form id="flashForm" action="">
	<section>
		<p></p>
		<table style="width:100%;margin:auto;" >
    	<?php 
        $hidden = "";
    	//pour remplir les valeur de l'element en cours d'upate
    	$entry = ( (!isset($isSub) || !$isSub) && isset($id) && $id != null && isset($collection)) ? PHDB::findOne($collection, array("_id"=>new MongoId($id)) ) : null;
    	$user = (isset($collection) && $collection!=null) ? PHDB::findOne($collection, array("_id"=>new MongoId(Yii::app()->session["userId"])) ) : array();
    	//var_dump($microformat["jsonSchema"]["properties"]);
        if(isset($microformat))
    	{
    	    $hidden = "";
            $required = array();
            foreach ($microformat["jsonSchema"]["properties"] as $k=>$v)
        	{
                $k = str_replace("(", "[", $k);
                $k = str_replace(")", "]", $k);
                /******************************
                 * Gather all required fields
                 ******************************/
                if(isset($v["required"]) && $v["required"])
                    echo "<script>requiredFields.push('".$k."')</script>";
        	    /******************************
        	     * Draw or not draw an input line
        	     ******************************/
        	    $buildRow = ( !isset($v["inputType"]) || $v["inputType"] != "hidden" );
        	    if( $buildRow )
                {?>
        	    <tr>
        	    <td class="txtright " style="padding-right:15px;"><label for="<?php echo $k?>"><?php echo ( isset($v["label"]) ) ? Translate::key($v["label"]) : Translate::key($k)?> <?php echo ( isset($v["required"]) ) ? "*" : ""?></label> </td>
        	    <td>
        	    <?php 
        	    }
        	    /******************************
        	     * Manage the input's value
        	     ******************************/
                $value = "";
                if($entry && isset( $entry[$k] ) ) 
                    $value = $entry[$k];
                else if(isset( $v["value"] ))
                    $value = $v["value"];
                
                /******************************
                 * INPUT TYPE TEXT
                 ******************************/
                if( !isset( $v["inputType"]) || $v["inputType"] == "text" ) { ?>
                	<input type="text" class="<?php echo ( isset($v["required"]) ) ? "debug" : ""?>" name='<?php echo $k?>' id='<?php echo $k?>' value="<?php echo $value?>" placeholder="<?php echo ( isset($v["label"]) ) ? Translate::key($v["label"]) : Translate::key($k)?>"/>
                <?php } 
                /******************************
                 * INPUT TYPE TEXTAREA
                 ******************************/
                else if( $v["inputType"] == "textarea")
                {
                ?>
                	<textarea id='<?php echo $k?>' name='<?php echo $k?>'><?php echo $value?></textarea>
                <?php } 
                /******************************
                 * INPUT TYPE DROPDOWN SELECT
                 ******************************/
                else if( $v["inputType"] == "select") {
                 
                    $default = "";
                    if( isset( $v["default"]) ) 
                        $default = $v["default"];
                    else if( isset($user["country"]) )
                        $default = $user["country"];

                    $options = $v["options"];
                    if( isset( $v["options_type"] ))
                    {
                        if( $v["options_type"] == "php" ) 
                            eval( '$options ='.$options.';' );//BUG : bugs with OpenData::$phCountries doesn't evaluate
                        //data can come fron a DB collection
                        else if( $v["options_type"] == "db" ){
                            $list = PHDB::findOne(PHType::TYPE_LISTS, array("name"=>$options ) );
                            $options = $list["list"];
                        }
                    }
                    $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                        'data' => $options, 
                        'name' => $k,
                      	'id' => $k,
                        'value'=> ($entry && isset($entry[$k]) ) ? $value : $default,
                        'pluginOptions' => array('width' => '150px')
                      ) );
                } 
                else if( $v["inputType"] == "enum") {
                    $options = $v["values"];
                    if( isset( $v["source"] ))
                    {
                        if( $v["source"] == "php" ) 
                            eval( '$options ='.$options.';' );//BUG : bugs with OpenData::$phCountries doesn't evaluate
                        //data can come fron a DB collection
                        else if( $v["source"] == "db" ){
                            $list = PHDB::findOne(PHType::TYPE_LISTS, array("name"=>$options ) );
                            $options = $list["list"];
                        }
                    }
                    $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                        'data' => $options, 
                        'name' => $k,
                        'id' => $k,
                        'value'=> ($entry && isset($entry[$k]) ) ? $value : "",
                        'pluginOptions' => array('width' => '150px')
                      ) );
                } 
                /******************************
                 * INPUT TYPE CHECKBOX
                 ******************************/
                else if( $v["inputType"] == "checkbox") {
                    if($value == "")
                        $value = 0; //preset to zero
                    ?>
                    <input type="checkbox" id='<?php echo $k?>' name="<?php echo $k?>" value="<?php echo $value?>" <?php if($value)echo "checked" ?>>
                <?php }
                /******************************
                 * INPUT TYPE FILE
                 ******************************/
                else if( $v["inputType"] == "image") {?>
                    
                    <div class="controls">
                        <img width=50 class="imageThumb" src="<?php echo ( $user && isset($user['image']) ) ? Yii::app()->createUrl($user['image']) : Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png'); ?>"/></td>
                        <?php
                        $srcModule = (isset($this->module) && isset($this->module->id)) ? $this->module->id : "azotlive";
                        $this->widget('yiiwheels.widgets.fineuploader.WhFineUploader', array(
                                'name'          => 'fineUploader',
                                'uploadAction'  => $this->createUrl('/templates/upload/dir/'.$srcModule.'/collection/'.$collection.'/input/fineUploader', array('fine' => 1)),
                                'pluginOptions' => array(
                                    'validation'=>array(
                                        'allowedExtensions' => array('jpg','jpeg','png','gif'),
                                        'itemLimit'=>1
                                    )
                                ),
                                'events' => array(
                                    'complete'=>"function( id,  name,  responseJSON,  xhr){
                                        console.log('".Yii::app()->createUrl('upload/'.$srcModule.'/collection/'.$collection.'/')."/'+xhr.name+'?d='+ new Date().getTime());
                                        $('#image').val(xhr.name);
                                        $('.imageThumb').attr('src','".Yii::app()->createUrl('upload/'.$srcModule.'/collection/'.$collection.'/')."/'+xhr.name+'?d='+ new Date().getTime());
                                        
                                    }"
                                ),
                            ));
                        ?>
                        <input type="hidden" id="image" name="image" value="<?php if(isset($user["image"]))echo $user["image"]?>"/>
                    </div>

                <?php } 
                /******************************
                 * INPUT TYPE DATE
                 ******************************/
                else if( $v["inputType"] == "date") {?>
                    <input type="text" class="dateInput" name="<?php echo $k?>" id='<?php echo $k?>' placeholder="22/10/2014" />
                <?php } 
                /******************************
                 * INPUT TYPE TIME
                 ******************************/
                else if( $v["inputType"] == "time") {?>
                    <input type="text" class="timeInput" name="<?php echo $k?>" id='<?php echo $k?>' placeholder="20:30" />
                <?php } 
                /******************************
                 * INPUT TYPE FILE
                 ******************************/
                else if( $v["inputType"] == "link") {?>
                    <a class="btn btn-primary" href="<?php echo "http://".$v["url"]?>">Go There</a>
                <?php } 
                /* *****************************
                 * INPUT TYPE HIDDEN
                 ******************************/
                else if( $v["inputType"] == "hidden" ) {
                    if(isset( $v["evalType"] ) && $v["evalType"] == "php" )
                        eval('$value = '.$value.';'); //value can be php and must be evaluated 
                    $hidden .= '<input type="hidden" name="'.$k.'" id="'.$k.'" value="'.$value.'"/>';
                } 
                /******************************
                 * DEFAULT TO A TEXT TYPE INPUT
                 ******************************/
                else { ?>
                	<input type="text"  class="<?php echo ( isset($v["required"]) ) ? "debug" : ""?>" id='<?php echo $k?>' name='<?php echo $k?>' value="<?php echo $value?>" />
                <?php } 
                
                if( $buildRow ){?>
                </td>
                </tr>
                <?php }
        	     } 
    	} else {
    	 /******************************
	     * EDITING WITHOUT microformat
	     * example change an entries value
	     * still only works for one key value updates
	     * example modify email or CP for user account
	     ******************************/   
    	    $value = ($entry && isset($entry[$key]) ) ? $entry[$key]: "";
    	    ?>
    	    <input type="hidden" name='<?php echo $key?>' value="<?php echo $value?>"/>
    	<?php } ?>    
            
        </table>
        <?php 
        /******************************
	     * RENDER at the end any hidden inputs gather above in the hidden string
	     ******************************/
    	echo $hidden;
    	
    	/******************************
	     * hidden inputs below are essential parameters
	     * for saving to the right place collection or ID
	     ******************************/
    	?>
        <input type="hidden" name='key' value="<?php echo $key?>"/>
        <input type="hidden" name='collection' value="<?php echo $collection?>"/>
        <input type="hidden" name='id' value="<?php echo $id?>"/>
        
        <?php if(empty($id)){
        /******************************
	     * creation date is mandatory 
	     ******************************/
        ?>
        	<input type="hidden" name='created' value="<?php echo time()?>"/>
        <?php }?>
        
	</section>
</form>
<script type="text/javascript">

	//generic ajax saving process
	var path = "<?php echo (isset($savePath)) ? $savePath : '/common/save/' ?>";
	$("#flashForm").submit( function(event){
    	//log($(this).serialize());
    	event.preventDefault();
        requiredTest = true;
        /*$.each(requiredFields, function(i,v){
            //log(v);
            if($("#"+v).val() == "")
                requiredTest = false;
        });*/
    	toggleSpinner();
        
        if(requiredTest)
        {
        	$.ajax({
        	  type: "POST",
        	  url: baseUrl+path,
        	  data: $(this).serialize(),
        	  success: function(data){
        		  $("#flashInfoSaveBtn").html('');
        		  $("#flashInfoContent").html(data.msg);
        		  /*if( data.reload )
            		  window.location.reload();*/
        		  toggleSpinner();
        	  },
        	  dataType: "json"
        	});
        }else{
            alert("Please fill required fields.");
        }
    });

<?php if(isset( $microformat["formSchema"]["slug"]) && isset($microformat["formSchema"]["slug"])){?>
$("[name='name']").keyup(function(){
$("[name='slug']").val(_.str.slugify($("[name='name']").val()));
});
<?php }?>

$(document).ready(function() { 
    //init Input type 
    $(".dateInput").datepicker({ 
        language: "fr",
        format: "dd/mm/yy"
    });

    $("#fineUploader").fineUploader({
            debug: true,
            allowedExtensions: ['jpeg', 'jpg', 'gif', 'png'],
            //sizeLimit: 204800, // 200 kB = 200 * 1024 bytes
            request: {
                endpoint: "<?php echo $this->createUrl('/templates/upload/dir/'.$srcModule.'/collection/'.$collection.'/input/qqfile', array('fine' => 1));?>"
            },
            retry: {
               enableAuto: true
            }
        })
        .on("submit",function(event,id, fileName){
            console.log("on sutmit", id, fileName);
        })
        .on("upload",function(event,id, fileName){
            console.log("on upload", id, fileName);
        })
        .on("complete",function(event, id, fileName, responseJSON) {
            if (responseJSON.success) {
              console.log("on complete", id, responseJSON.name);
               $('#image').val('<?php echo Yii::app()->createUrl('upload/'.$srcModule.'/'.$collection.'/')?>/'+responseJSON.name);
               $('.imageThumb').attr('src','<?php echo Yii::app()->createUrl('upload/'.$srcModule.'/'.$collection.'/')?>/'+responseJSON.name+'?d='+ new Date().getTime());
                                    
            } else {
              console.log("on sutmit", id, fileName,responseJSON.error);
            }
          });

});

</script>  

<?php /*
microformats are descrived in the microformat collection 
opening a dynamicallyBuild

openModal(key,collection,id,template = 'dynamicallyBuild')
"key" is the corresponding identifier in the microformat collection 
"colelction" is where the element created od modified by this form will be saved 
"id" if modifying we need an id to fill and to save 
"template" mainly dynamicallyBuild will be used but for specific use cases we could use a specific Form template

available fields 

"description" : {
      "label" : "Description",
      "inputType" : "text"
    },
"description" : {
      "label" : "Description",
      "inputType" : "hidden"
    },
"owner" : {
		"inputType" : "hidden",
		"value" : "userId"
    },
"description" : {
      "label" : "Description",
      "inputType" : "textarea"
    },
"public" : {
      "label" : "Publique",
	  "inputType" : "checkbox"
    },
"inputType" : {
      "label" : "inputType",
      "inputType" : "select",
	  "options" :{
	  	"meeting" : "Réunion",
		 "festival" : "Festival",
		 "concert" : "Concert",
		 "getTotgether" : "Rassemblement",
		 "market" : "Marché",
		 "concours" : "Concours",
		 "competition" : "Compétition"
	  }
    },
"country" : {
      "label" : "Pays",
      "inputType" : "select",
      "options_type" : "db",
      "options" : "countries"
    }
"date" : {
      "label" : "Date",
      "inputType" : "date"
    },
*/?>
   

    