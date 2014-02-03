<!-- Simple Node element requesting only a name to create a node  -->
<p> <?php if(isset($txt))echo $txt?></p>
<form id="flashForm" action="">
	<section>
		<p>TODO : Generic Form Event Text </p>
		<table>
    	<?php 
    	//pour remplir les valeur de l'element en cours d'upate
    	$entry = (isset($id) && isset($collection)) ? Yii::app()->mongodb->selectCollection($collection)->findOne( array("_id"=>new MongoId($id)) ) : null;
    	$user = Yii::app()->mongodb->selectCollection($collection)->findOne( array("_id"=>new MongoId(Yii::app()->session["userId"])) );
    	if(isset($microformat))
    	{
        	foreach ($microformat["formSchema"] as $k=>$v)
        	{
        	    ?>
        	    <tr>
        	    <td class="txtright"><?php echo $v["label"]?></td>
        	    <td>
        	    <?php 
                $value = ($entry && isset($entry[$k]) ) ? $entry[$k]: "";
                
                if( !isset($v["type"]) || $v["type"] == "text" ){?>
                	<input type="text" name='<?php echo $k?>' value="<?php echo $value?>" />
                <?php } else if($v["type"] == "textarea"){?>
                	<textarea name='<?php echo $k?>'><?php echo $value?></textarea>
                <?php } else if($v["type"] == "select"){
                    $default = "";
                    if( isset($v["default"]) ) 
                        $default = $v["default"];
                    else if( isset($user["country"]) )
                        $default = $user["country"];
                    $options = $v["options"];
                    if( isset( $v["options_type"] ))
                    {
                        if( $v["options_type"] == "php" ) 
                            $options =  eval( $options.';' );//BUG : bugs with OpenData::$phCountries doesn't evaluate
                        else if( $v["options_type"] == "db" ){
                            $list = Yii::app()->mongodb->lists->findOne( array("name"=>$options ) );
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
                } else { ?>
                	<input type="text" name='<?php echo $k?>' value="" />
                <?php } ?>
                
                </td>
                </tr>
                        
                <?php } 
    	} else {
    	    $value = ($entry && isset($entry[$key]) ) ? $entry[$key]: "";
    	    ?>
    	    <input type="hidden" name='<?php echo $key?>' value="<?php echo $value?>"/>
    	<?php }?>
            
            <input type="hidden" name='key' value="<?php echo $key?>"/>
            <input type="hidden" name='collection' value="<?php echo $collection?>"/>
            <input type="hidden" name='id' value="<?php echo $id?>"/>
            
        </table>
	</section>
</form>
<script type="text/javascript">

	$("#flashForm").submit( function(event){
    	log($(this).serialize());
    	event.preventDefault();
    	toggleSpinner();

    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/common/save/",
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
</script>  

<?php /*

tous les champs possible 

"description" : {
      "label" : "Description",
      "type" : "text"
    },
"description" : {
      "label" : "Description",
      "type" : "hidden"
    },
"description" : {
      "label" : "Description",
      "type" : "textarea"
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

*/?>
   

    