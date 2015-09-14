<!-- Simple Node element requesting only a name to create a node  -->

<p> <?php if(isset($txt))echo $txt?></p>
<form id="flashForm" action="">
	<section>
		<p>TODO : Generic Form Text </p>
		<table>
    	<?php 
    	//pour remplir les valeur de l'element en cours d'upate
    	$entry = ( (!isset($isSub) || !$isSub) && isset($id) && $id != null && isset($collection)) ? PHDB::findOne($collection, array("_id"=>new MongoId($id)) ) : null;
    	$user = PHDB::findOne($collection, array("_id"=>new MongoId(Yii::app()->session["userId"])) );
    	if(isset($microformat))
    	{
    	    $hidden = "";
        	foreach ($microformat["formSchema"] as $k=>$v)
        	{
        	    /******************************
        	     * Draw or not draw an input line
        	     ******************************/
        	    $buildRow = ( !isset($v["type"]) || $v["type"] != "hidden" );
        	    if( $buildRow ){?>
        	    <tr>
        	    <td class="txtright"><?php echo ( isset($v["label"]) ) ? $v["label"] : $k?></td>
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
                
                if( !isset( $v["type"]) || $v["type"] == "text" ) {
                /******************************
        	     * INPUT TYPE TEXT
        	     ******************************/
                    ?>
                	<input type="text" name='<?php echo $k?>' value="<?php echo $value?>" />
                <?php } else if( $v["type"] == "textarea"){
                /******************************
        	     * INPUT TYPE TEXTAREA
        	     ******************************/
                    ?>
                	<textarea name='<?php echo $k?>'><?php echo $value?></textarea>
                <?php } else if( $v["type"] == "select") {
                 /******************************
        	     * INPUT TYPE DROPDOWN SELECT
        	     ******************************/
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
                } else if( $v["type"] == "checkbox") {
                /******************************
        	     * INPUT TYPE CHECKBOX
        	     ******************************/
                    if($value == "")
                        $value = 0; //preset to zero
                    ?>
                    <input type="checkbox" name="<?php echo $k?>" value="<?php echo $value?>" <?php if($value)echo "checked" ?>>
                <?php }else if( $v["type"] == "file") {
                /******************************
        	     * INPUT TYPE FILE
        	     ******************************/?>
                    <input type="file" name="<?php echo $k?>"/>
                <?php } else if( $v["type"] == "link") {
                /******************************
        	     * INPUT TYPE FILE
        	     ******************************/?>
                    <a class="btn btn-primary" href="<?php echo "http://".$v["url"]?>">Go There</a>
                <?php } else if( $v["type"] == "hidden" ) {
                /******************************
        	     * INPUT TYPE HIDDEN
        	     ******************************/
                    if(isset( $v["evalType"] ) && $v["evalType"] == "php" )
                        eval('$value = '.$value.';'); //value can be php and must be evaluated 
                    $hidden .= '<input type="hidden" name="'.$k.'" value="'.$value.'"/>';
                } else { 
                /******************************
        	     * DEFAULT TO A TEXT TYPE INPUT
        	     ******************************/
                    ?>
                	<input type="text" name='<?php echo $k?>' value="<?php echo $value?>" />
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
    	log($(this).serialize());
    	event.preventDefault();
    	toggleSpinner();

    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+path,
    	  data: $(this).serialize(),
    	  success: function(data){
    		  $("#flashInfoSaveBtn").html('');
    		  $("#flashInfoContent").html(data.msg);
    		  if(data.reload)
        		  window.location.reload();
    		  toggleSpinner();
    	  },
    	  dataType: "json"
    	});
    
    });
<?php if(isset( $microformat["formSchema"]["slug"]) && isset($microformat["formSchema"]["slug"])){?>
$("[name='name']").keyup(function(){
$("[name='slug']").val(_.str.slugify($("[name='name']").val()));
});
<?php }?>
    
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
      "type" : "text"
    },
"description" : {
      "label" : "Description",
      "type" : "hidden"
    },
"owner" : {
		"type" : "hidden",
		"value" : "userId"
    },
"description" : {
      "label" : "Description",
      "type" : "textarea"
    },
"public" : {
      "label" : "Publique",
	  "type" : "checkbox"
    },
"type" : {
      "label" : "Type",
      "type" : "select",
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
      "type" : "select",
      "options_type" : "db",
      "options" : "countries"
    }
"date" : {
      "label" : "Date",
      "type" : "date"
    },
*/?>
   

    