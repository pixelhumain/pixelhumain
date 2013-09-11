
<!-- Modal -->
<div id="event" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Créer un évennement ?</h3>
  </div>
  <div class="modal-body" style="max-height:550px" >
  <p>
  Tous le monde peut déposé un évennement local si celui ci est d'interet général
  </p>
    <form id="eventForm" style="line-height:40px;">
        <section>
        	<?php 
        	$event = (isset(Yii::app()->session["userId"])) ? Yii::app()->mongodb->group->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"]))) : null;
        	?>
          	<table>
              	<tr>
                  	<td class="txtright">Nom </td>
                  	<td> <input id="eventName" name="eventName" value="<?php if($event && isset($event['name']) )echo $event['name'] ?>"/></td>
              	</tr>
              	<tr>
                  	<td class="txtright">Contact </td>
                  	<td> <input id="eventContact" name="eventContact" value="<?php if($event && isset($event['contact']) )echo $event['contact'] ?>"/></td>
              	</tr>
        		<tr>
                  	<td class="txtright">Quand </td>
                  	<td> 
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
                  	</td>
              	</tr>
              	<tr>
                  	<td class="txtright">Où </td>
                  	<td> <input id="eventWhere" name="eventWhere" value="<?php if($event && isset($event['where']) )echo $event['where'] ?>"/></td>
              	</tr>
        		<tr>
            		<td class="txtright">au code postal</td>  
            		<td><input id="eventCP" name="eventCP" class="span2" value="<?php if($event && isset($event['cp']) )echo $event['cp'] ?>"></td>
        		</tr>
        		<tr>
                  	<td class="txtright">Pays  </td>
                  	<td>
        		<?php 
                          $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => OpenData::$phCountries, 
                            'name' => 'countryEvent',
                          	'id' => 'countryEvent',
                            'value'=>($event && isset($event['country']) ) ? $event['country'] : "Réunion",
                            'pluginOptions' => array('width' => '150px')
                          ));
            		    ?></td>
            	</tr> 
    		    <tr >
                    <td class="txtright">Centre d'interet </td>
                    <td>
                        <?php 
                          $cursor = Yii::app()->mongodb->tags->findOne( array(), array('list'));
                          $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'asDropDownList' => false,
                            'name' => 'tagsEvent',
                          	'id' => 'tagsEvent',
                            'value'=>($event && isset($event['tags']) ) ? implode(",", $event['tags']) : "",
                            'pluginOptions' => array(
                                'tags' => $cursor['list'],
                                'placeholder' => "Mots clefs descriptifs",
                                'width' => '100%',
                                'tokenSeparators' => array(',', ' ')
                            )));
            		    ?>
        		    </td>
    		    </tr>
    		    
    		    <tr>
            		<td class="txtright">Envoyer des invitations</td>  
            		<td>
            		<?php $this->widget('yiiwheels.widgets.switch.WhSwitch', array(
                        'name' => 'eventMembers',
            		    //'value'=>true
                    ));?>
            		</td>
        		</tr>
          </table>
             
        </section>
        
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button class="btn btn-primary" id="submitAccount" onclick="$('#register2').submit();">Enregistrer</button>
  </div>
</div>
<!-- Modal -->

<script type="text/javascript">
initT['eventModalsInit'] = function(){
    /* *************************** */
    /* resgistration Ajax Call*/
    /* *************************** */
    $("#registerForm").submit( function(event){
    	log($(this).serialize());
    	event.preventDefault();
    	$("#loginForm").modal('hide');
    	toggleSpinner();
    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/index.php/citoyens/register",
    	  data: "registerEmail="+$("#registerEmail").val(),
    	  success: function(data){
    		  if(data.result){
        		  window.location.reload();
    		  }
    		  else {
				  if(data.id == "accountExist")
					  window.location.reload();
				  else {
        			  $("#flashInfo .modal-body").html(data.msg);
        			  $("#flashInfo").modal('show');
				  }
    		  }
    		  toggleSpinner();
    	  },
    	  dataType: "json"
    	});
    
    });
};
</script>