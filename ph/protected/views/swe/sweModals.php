<!-- Modal -->
<div id="coaching" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Demande de Coaching</h3>
  </div>
  <div class="modal-body">
    <p> Les Coachs sont là pour vous orienter, n'hésitez pas à les solliciter. 
        En remplissant ce formulaire vous n'aurez pas à vous déplacer, le coach recevra votre demande. 
        </p>
    <strong>Cette fonctionnalité  ne sera disponible que le jour de l'événement</strong>
  
    <form id="coachForm" style="line-height:40px;">
        <section>
        	<table>
        		<tr>
                  	<td class="txtright">Projet : </td>
                  	<td>
                  	<?php 
                  	if(!empty($myproject)){
                  	    echo $myproject?><input type="hidden" name="coachProject" id="coachProject" value="<?php echo $myproject?>" />
                  	<?php } else {
                  	    $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => $projects, 
                            'name' => 'coachProject',
                          	'id' => 'coachProject',
                            'pluginOptions' => array('width' => '250px')
                          ));
                  	    }?>
                  	</td>
                </tr>
        		<tr>
                  	<td class="txtright">Qui : </td>
                  	<td>
                  	<?php 
                          $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => $coaches, 
                            'name' => 'coachRequested',
                          	'id' => 'coachRequested',
                            'pluginOptions' => array('width' => '250px')
                          ));
            		    ?></td>
        		</tr>
        		<input type="hidden" id="eventId" name="eventId" value="<?php echo $event["_id"]?>"/>
              	<tr>
                  	<td class="txtright">Question</td>
                  	<td> <input name="coachQuestion"/></td>
              	</tr>
          	</table>
        </section>
    </form>
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button class="btn btn-primary" id="submitCoaching" onclick="$('#coachForm').submit();">Enregistrer</button>
  </div>
</div>
<!-- Modal -->
<script type="text/javascript">
initT['coachFormModalsInit'] = function(){
    
    $("#coachForm").submit( function(event){
    	event.preventDefault();
    	$("#coaching").modal('hide');
    	NProgress.start();
    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/index.php/ext/startupweekend/sweCoachRequest",
    	  data: $("#coachForm").serialize(),
    	  success: function(data){
        	  	  if($("#coachingCount").html() != "")
        	  		$("#coachingCount").html(parseInt($("#coachingCount").html())+1);
            	  else	  
            		  $("#coachingCount").html("1");
    			  $("#flashInfo .modal-body").html(data.msg);
    			  $("#flashInfo").modal('show');
    			  NProgress.done();
    	  },
    	  dataType: "json"
    	});
    });
};
</script>



<!-- Modal -->
<div id="sweFeedBack" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Feedback pour un meilleur Week End</h3>
  </div>
  <div class="modal-body">
    <p> Merci de compléter ce formulaire qui nous permettra de gagner en experience sur vos avis.  </p>
    <form id="coachForm" style="line-height:40px;">
        <section>
        	<table>
        		<tr>
                  	<td class="txtright">Qui : </td>
                  	<td>
                  	<?php 
                          $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => $coaches, 
                            'name' => 'typeInvite',
                          	'id' => 'typeInvite',
                            'pluginOptions' => array('width' => '250px')
                          ));
            		    ?></td>
        		</tr>
              	<tr>
                  	<td class="txtright">Sujet</td>
                  	<td> <input name="titleIdea"/></td>
              	</tr>
          	</table>
          	<textarea name="yourIdea" style="width:95%" rows=5></textarea>
             
        </section>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
  </div>
</div>
<!-- Modal -->




<!-- Modal -->
<div id="sweInscription" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Startupweekend III : Inscription</h3>
  </div>
  <div class="modal-body" style="height:600px;">
    <p> Merci de compléter vos donées . </p>
        <form id="sweInscriptionForm" class="form-horizontal" enctype="multipart/form-data">
            <?php $me = Yii::app()->mongodb->startupweekend->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"])));?>
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="NOM">Votre Nom Prénom</label>
              <div class="controls">
                <input id="name" name="name" type="text" value="<?php echo $me["name"]?>" class="input-medium" required="">
              </div>
            </div>
            
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="EMAIL">Votre email</label>
              <div class="controls">
                <input id="email" name="email" type="text" value="<?php echo $me["email"]?>" class="input-large" required="">
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="NOM">Photo</label>
              <div class="controls">
                <?php
                    $this->widget('yiiwheels.widgets.fineuploader.WhFineUploader', array(
                            'name'          => 'imageFile',
                            'uploadAction'  => $this->createUrl('index.php/templates/upload/dir/swe/input/imageFile', array('fine' => 1)),
                            'pluginOptions' => array(
                                'validation'=>array(
                                    'allowedExtensions' => array('jpg','jpeg','png','gif'),
                                    'itemLimit'=>1
                                )
                            ),
                            'events' => array(
                                'complete'=>"function( id,  name,  responseJSON,  xhr){
                                	console.log('".Yii::app()->createUrl('upload/swe/')."/'+xhr.name+'?d='+ new Date().getTime());
                                	$('#image').val(xhr.name);
                                	$('li.$meType.me img').attr('src','".Yii::app()->createUrl('upload/swe/')."/'+xhr.name+'?d='+ new Date().getTime());
                                	
                                }"
                            ),
                        ));
                    ?>
                    <input type="hidden" id="image" name="image" value="<?php if(isset($me["image"]))echo $me["image"]?>"/>
              </div>
            </div>
            
            <!-- Select Basic -->
            <div class="control-group">
              <label class="control-label" for="commentConnuSWE">Comment avez-vous connu le Startupweekend ?</label>
              <div class="controls">
                <?php 
                $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => SWE::$commentConnuSWE,
                            'name' => 'commentConnuSWE',
                          	'id' => 'commentConnuSWE',
                            'value'=> (isset($me["commentConnuSWE"])) ? $me["commentConnuSWE"] : "",
                            'pluginOptions' => array(
                                'width' => '100%'
                            )));
                ?>
                
                
              </div>
            </div>
            
            <!-- Select Basic -->
            <div class="control-group">
              <label class="control-label" for="profession">Vous êtes ?</label>
              <div class="controls">
              	<?php 
                $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => SWE::$profession,
                            'name' => 'profession',
                          	'id' => 'profession',
                            'value'=> (isset($me["profession"])) ? $me["profession"] : "",
                            'pluginOptions' => array(
                                
                                'placeholder' => "Profession",
                                'width' => '100%',
                                'tokenSeparators' => array(',', ' ')
                            )));
                ?>
              </div>
            </div>
            
            <!-- Select Basic -->
            <div class="control-group">
              <label class="control-label" for="formation">Si vous êtes étudiant, quelle est votre formation actuelle :</label>
              <div class="controls">
              <?php 
                $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => SWE::$formation,
                            'name' => 'formation',
                          	'id' => 'formation',
                            'value'=> (isset($me["formation"])) ? $me["formation"] : "",
                            'pluginOptions' => array(
                                
                                'placeholder' => "",
                                'width' => '100%',
                                'tokenSeparators' => array(',', ' ')
                            )));
                ?>
                
              </div>
            </div>
            
            <!-- Select Basic -->
            <div class="control-group">
              <label class="control-label" for="expertise">Si vous n'êtes pas étudiant, quelle est votre 'spécialité' :</label>
              <div class="controls">
              <?php 
                $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => SWE::$expertise,
                            'name' => 'expertise',
                          	'id' => 'expertise',
                            'value'=> (isset($me["expertise"])) ? $me["expertise"] : "",
                            'pluginOptions' => array(
                                
                                'placeholder' => "",
                                'width' => '100%',
                                'tokenSeparators' => array(',', ' ')
                            )));
                ?>
                
              </div>
            </div>
            
            
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="age">Quel est votre âge ?</label>
              <div class="controls">
                <input id="age" name="age" type="text" value="<?php if(isset($me["age"]))echo $me["age"]?>" class="input-medium">
                
              </div>
            </div>
            
            <!-- Select Basic -->
            <div class="control-group">
              <label class="control-label" for="codepostal">De quelle région de la Réunion venez-vous ?</label>
              <div class="controls">
              <?php 
                $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => OpenData::$commune["974"],
                            'name' => 'codepostal',
                          	'id' => 'codepostal',
                            'value'=> (isset($me["codepostal"])) ? $me["codepostal"] : "",
                            'pluginOptions' => array(
                                
                                'placeholder' => "",
                                'width' => '100%',
                                'tokenSeparators' => array(',', ' ')
                            )));
                ?>
               
              </div>
            </div>
            
            <!-- Select Multiple -->
            <div class="control-group">
              <label class="control-label" for="objectif">Avez vous des objectifs particuliers en venant au Startupweekend ?</label>
              <div class="controls">
              <?php 
                $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => SWE::$objectif,
                            'name' => 'objectif',
                          	'id' => 'objectif',
                            'value'=> (isset($me["objectif"])) ? $me["objectif"] : "",
                            'pluginOptions' => array(
                                
                                'placeholder' => "",
                                'width' => '100%',
                                'tokenSeparators' => array(',', ' ')
                            )));
                ?>
                
              </div>
            </div>
            <div class="clear"></div>
        </form>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button class="btn btn-primary" id="submitsweInscriptionForm" onclick="$('#sweInscriptionForm').submit();">Enregistrer</button>
  </div>
</div>
<!-- Modal -->

<script type="text/javascript">
initT['sweInscriptionModalsInit'] = function(){
	
	$('input[type=file]').change(function (e) {
	    $('#customfileupload').html($(this).val());
	});
    $("#sweInscriptionForm").submit( function(event){
    	if($('.error').length){
    		alert('Veuillez remplir les champs obligatoires.');
    	}else{
        	event.preventDefault();
        	$("#sweInscription").modal('hide');
        	NProgress.start();
        	$.ajax({
        	  type: "POST",
        	  url: baseUrl+"/index.php/ext/startupweekend/sweInfos",
        	  data: $("#sweInscriptionForm").serialize(),
        	  success: function(data){
        			  $("#flashInfo .modal-body").html(data.msg);
        			  $("#flashInfo").modal('show');
        			  NProgress.done();
        	  },
        	  dataType: "json"
        	});
    	}
    });
};
</script>


