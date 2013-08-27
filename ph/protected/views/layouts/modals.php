<!-- Modal -->
<div id="loginForm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">S'inscrire ou se Connecter :</h3>
  </div>
  <div class="modal-body">
  	<p> S'inscrire pour soutenir le projet ou simplement suivre son avancement
   	<br/>et si vous etes deja inscrit , connectez vous avec votre email d'inscription.</p>
    <form id="registerForm" action="">
    	<section>
        	<table>
              	<tr>
                  	<td class="txtright"><input class="span2" type="text" id="registerEmail" name="registerEmail" placeholder="Email" ></td>
                  	<td> <a class="btn btn-warning" href="javascript:;" onclick="$('#registerForm').submit();return false;"  >S'inscrire  ou se Connecter</a></td>
              	</tr>
            </table>
        </section>
	</form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
  </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div id="participer" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Inscription Réussit, Étape suivante ?</h3>
  </div>
  <div class="modal-body" style="max-height:550px" >
  <p> Un mail de validation vous a été envoyé
   <br/>En attendant vous pouvez compléter votre inscription ci-dessous</p>
    <form id="register2" style="line-height:40px;">
        <section>
          
          	<?php 
          	    $account = (isset(Yii::app()->session["userId"])) ? Yii::app()->mongodb->citoyens->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"]))) : null;
          	?>
          	<table>
              	<tr>
                  	<td class="txtright"></td>
                  	<td> <?php if($account && isset($account['email']) )echo $account['email'] ?></td>
              	</tr>
              	<tr>
                  	<td class="txtright">Je m'appel</td>
                  	<td> <input id="registerName" name="registerName" value="<?php if($account && isset($account['name']) )echo $account['name'] ?>"/></td>
              	</tr>
              	<tr>
                  	<td class="txtright">Je m'inscrit en tant que  </td>
                  	<td>
                  	<?php 
                          $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => array("citoyen"=>"citoyen","association"=>"association","entreprise"=>"entreprise","collectivité"=>"collectivité"), 
                            'name' => 'typePA',
                          	'id' => 'typePA',
                            'value'=>($account && isset($account['type']) ) ? $account['type'] : "citoyen",
                            'pluginOptions' => array('width' => '150px')
                          ));
            		    ?></td>
        		</tr>   
        		<tr>
                  	<td class="txtright">j'habite en  </td>
                  	<td>
        		<?php 
                          $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => OpenData::$phCountries, 
                            'name' => 'countryPA',
                          	'id' => 'countryPA',
                            'value'=>($account && isset($account['country']) ) ? $account['country'] : "Réunion",
                            'pluginOptions' => array('width' => '150px')
                          ));
            		    ?></td>
            	</tr> 
        		<tr>
            		<td class="txtright">au code postal</td>  
            		<td><input id="registerCP" name="registerCP" class="span2" value="<?php if($account && isset($account['cp']) )echo $account['cp'] ?>"></td>
        		</tr>
        		
        		<tr> 
                    <td class="txtright">J'aimerais aider le projet</td>
                    <td> <input type="checkbox" id="registerHelpout" name="registerHelpout" <?php if($account && isset($account['activeOnProject']) )echo "checked" ?>></td>
                </tr>
                <tr <?php if($account && (!isset($account['activeOnProject']) || !$account['activeOnProject']) ){ ?>class="hidden" <?php }?> id="registerHelpoutWhat">
                    <td class="txtright">en tant que </td>
                    <td>
                        <?php 
                          $cursor = Yii::app()->mongodb->jobTypes->findOne( array(), array('list'));
                          $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'asDropDownList' => false,
                            'name' => 'helpJob',
                          	'id' => 'helpJob',
                            'value'=>($account && isset($account['positions']) ) ? implode(",", $account['positions']) : "",
                            'pluginOptions' => array(
                                'tags' => $cursor['list'],
                                'placeholder' => "Qu'aimeriez vous faire ?",
                                'width' => '100%',
                                'tokenSeparators' => array(',', ' ')
                            )));
            		    ?>
        		    </td>
    		    </tr>
    		    <tr> 
                    <td class="txtright">J'ai une vie associative</td>
                    <td> <input type="checkbox" id="registerVieAssociative" name="registerVieAssociative" <?php if($account && isset($account['associations']) )echo "checked" ?>></td>
                </tr>
                <tr <?php if($account && (!isset($account['associations']) || !$account['associations']) ){ ?>class="hidden"  <?php }?>  id="registerVieAssociativeWhat">
                    <td class="txtright">La(Les)quelle(s) </td>
                    <td>
                        <?php 
                        //TODO ajax request as you type
                          $names = array();
                          foreach(iterator_to_array(Yii::app()->mongodb->group->find( array("type"=>"association"), array("name" => 1) )) as $a)
                              array_push($names, $a['name']);
                              //$assoNames[$a['name']] = $a['name'] ;
                          
                          $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'asDropDownList' => false,
                            'name' => 'listAssociation',
                          	'id' => 'listAssociation',
                            'value'=>($account && isset($account['associations']) ) ? implode(",", $account['associations']) : "",
                            'pluginOptions' => array(
                                'tags' => $names,
                                'placeholder' => "Nom(s) d'association(s)",
                                'width' => '100%',
                                'tokenSeparators' => array(',', ' ')
                            )));
            		    ?>
        		    </td>
    		    </tr>
               
    		    <tr >
                    <td class="txtright">Centre d'interet </td>
                    <td>
                        <?php 
                          $cursor = Yii::app()->mongodb->tags->findOne( array(), array('list'));
                          $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'asDropDownList' => false,
                            'name' => 'tagsPA',
                          	'id' => 'tagsPA',
                            'value'=>($account && isset($account['tags']) ) ? implode(",", $account['tags']) : "",
                            'pluginOptions' => array(
                                'tags' => $cursor['list'],
                                'placeholder' => "Mots clefs vous décrivant",
                                'width' => '100%',
                                'tokenSeparators' => array(',', ' ')
                            )));
            		    ?>
        		    </td>
    		    </tr>
          </table>
             
        </section>
        
    </form>
    <p>Toute l'équipe du Pixel Humain vous remercie et vous souhaites la bienvenue.</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button class="btn btn-primary" id="submitAccount" onclick="$('#register2').submit();">Enregistrer</button>
  </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div id="invitation" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Parainer ou Inviter Quelqu'un</h3>
  </div>
  <div class="modal-body">
    <p> Un mail d'invitation sera envoyé a votre filleul.<br/>
    Le parainage renforce les objectifs du Pixel Humain qui sont d'impliquer la population locale dans l'activité et la communication locale.<br/>
    En parainant vous 
    </p>
    <form id="inviteForm" style="line-height:40px;">
        <section>
          	<input type="hidden" id="sponsorPA" name="sponsorPA" value="<?php echo Yii::app()->session["userId"]; ?>"/>
          	<table>
          	<tr>
              	<td class="txtright">Un Email</td>
              	<td> <input id="inviteEmail" name="inviteEmail" value=""/></td>
          	</tr>
          	<tr>
              	<td class="txtright">Un nom </td>
              	<td> <input id="inviteName" name="inviteName" value=""/></td>
          	</tr>
          	<tr>
              	<td class="txtright">sera inscrit en tant que  </td>
              	<td>
              	<?php 
                      $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                        'data' => array("citoyen"=>"citoyen","association"=>"association","entreprise"=>"entreprise","collectivité"=>"collectivité"), 
                        'name' => 'typeInvite',
                      	'id' => 'typeInvite',
                        'pluginOptions' => array('width' => '150px')
                      ));
        		    ?></td>
    		</tr>
          </table>
             
        </section>
        
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button class="btn btn-primary" id="submitInvite" onclick="$('#inviteForm').submit();">Enregistrer</button>
  </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div id="boiteIdee" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Proposer votre idée</h3>
  </div>
  <div class="modal-body">
    <p> Ce projet est un réseau social ouvert, un squelette de module d'interet general, qui accueillera </p>
    <form id="ideaForm" style="line-height:40px;">
        <section>
        	<table>
              	<tr>
                  	<td class="txtright">Sujet</td>
                  	<td> <input id="titleIdea" name="titleIdea" value=""/></td>
              	</tr>
          	</table>
          	<textarea name="yourIdea" style="width:95%" rows=9></textarea>
             
        </section>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button class="btn btn-primary" id="submitInvite" onclick="$('#inviteForm').submit();">Enregistrer</button>
  </div>
</div>
<!-- Modal -->


<!-- Modal -->
<div id="flashInfo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Flash information :</h3>
  </div>
  <div class="modal-body">
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
  </div>
</div>
<!-- Modal -->

<!-- Modal Gallery fancy Box Like -->
<div id="modal-gallery" class="modal modal-gallery hide fade" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn btn-primary modal-next">Next <i class="icon-arrow-right icon-white"></i></a>
        <a class="btn btn-info modal-prev"><i class="icon-arrow-left icon-white"></i> Previous</a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> Slideshow</a>
        <a class="btn modal-download" target="_blank"><i class="icon-download"></i> Download</a>
    </div>
</div>
<!-- /Modal Gallery fancy Box Like -->

<script>
initT['modalsInit'] = function(){
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
    	  url: "index.php/citoyens/register",
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
    $("#register2").submit( function(event){
    	event.preventDefault();
    	$("#participer").modal('hide');
    	toggleSpinner();
    	$.ajax({
    	  type: "POST",
    	  url: "index.php/citoyens/register2",
    	  data: $("#register2").serialize(),
    	  success: function(data){
    			  $("#flashInfo .modal-body").html(data.msg);
    			  
    		  	  toggleSpinner();
    		  	  if(data.newAsso){
        		  	  alert("L'association "+data.newAsso+" a été créé pour vous, merci d'inviter le président pour confirmer.");
    		  		  $("#invitation").modal('show');
    		  	  } else
    		  		$("#flashInfo").modal('show');
    	  },
    	  dataType: "json"
    	});
    });
    $("#inviteForm").submit( function(event){
    	event.preventDefault();
    	$("#invitation").modal('hide');
    	toggleSpinner();
    	$.ajax({
    	  type: "POST",
    	  url: "index.php/citoyens/invitation",
    	  data: $("#inviteForm").serialize(),
    	  success: function(data){
    			  $("#flashInfo .modal-body").html(data.msg);
    			  $("#flashInfo").modal('show');
    		  	  toggleSpinner();
    	  },
    	  dataType: "json"
    	});
    });
    showEvent("registerHelpout");
    showEvent("registerVieAssociative");
    
    /*$("#registerCP").blur(function(){
    	alert("#registerCP");
    });*/
    
};
function showEvent(id){
	$("#"+id).click(function(){
    	if($("#"+id).prop("checked"))
    		$("#"+id+"What").removeClass("hidden");
    	else
    		$("#"+id+"What").addClass("hidden");
    });
}
</script>