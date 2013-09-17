<!-- Modal -->
<div id="coaching" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Demande de Coaching</h3>
  </div>
  <div class="modal-body">
    <p> Les Coachs sont là pour vous orienter, n'hésitez pas à les soliciter. <br/>
    En remplissant ce formulaire vous n'aurez pas à vous déplacer, Le coach recevra votre demande. </p>
    <form id="coachForm" style="line-height:40px;">
        <section>
        	<table>
        		<tr>
                  	<td class="txtright">Projet : </td>
                  	<td>
                  	<?php 
                  	if(!empty($myproject)){
                  	    echo $myproject?><input type="hidden" name="coachProject"/>
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
initT['invitationModalsInit'] = function(){
    
    $("#coachForm").submit( function(event){
    	event.preventDefault();
    	$("#coaching").modal('hide');
    	NProgress.start();
    	/*$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/index.php/citoyens/invitation",
    	  data: $("#inviteForm").serialize(),
    	  success: function(data){
    			  $("#flashInfo .modal-body").html(data.msg);
    			  $("#flashInfo").modal('show');
    			  NProgress.done();
    	  },
    	  dataType: "json"
    	});*/
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
  <div class="modal-body">
    <p> Merci de compléter vos donées . </p>
        <form id="sweInscriptionForm" class="form-horizontal">
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
            
            <!-- Select Basic -->
            <div class="control-group">
              <label class="control-label" for="commentConnuSWE">Comment avez-vous connu le Startupweekend ?</label>
              <div class="controls">
                <?php 
                $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'asDropDownList' => false,
                            'name' => 'commentConnuSWE',
                          	'id' => 'commentConnuSWE',
                            'value'=> (isset($me["commentConnuSWE"])) ? $me["commentConnuSWE"] : "",
                            'pluginOptions' => array(
                                'tags' => array(
                                              "Présentation des organisateurs",
                                              "Internet",
                                              "Facebook ou Twitter",
                                              "Presse",
                                              "Autre média (radio, TV)",
                                              "Newsletter ou mailing",
                                              "Pôle Emploi",
                                              "Ancien participant"
                                            ),
                                'placeholder' => "",
                                'width' => '100%',
                                'tokenSeparators' => array(',', ' ')
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
                            'asDropDownList' => false,
                            'name' => 'profession',
                          	'id' => 'profession',
                            'value'=> (isset($me["profession"])) ? $me["profession"] : "",
                            'pluginOptions' => array(
                                'tags' => array(
                                              "salarié",
                                              "demandeur d'emploi",
                                              "étudiant",
                                              "chef d'entreprise",
                                              "travailleur indépendant",
                                            ),
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
                            'asDropDownList' => false,
                            'name' => 'formation',
                          	'id' => 'formation',
                            'value'=> (isset($me["formation"])) ? $me["formation"] : "",
                            'pluginOptions' => array(
                                'tags' => array(
                                            "ILOI",
                                              "ESIROI",
                                              "IUT",
                                              "BTS",
                                              "IAE",
                                              "EGC",
                                            ),
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
                            'asDropDownList' => false,
                            'name' => 'expertise',
                          	'id' => 'expertise',
                            'value'=> (isset($me["expertise"])) ? $me["expertise"] : "",
                            'pluginOptions' => array(
                                'tags' => array(
                                            "entrepreneur",
                                              "gestion / comptabilité",
                                              "Commerce",
                                              "Marketing / Communication",
                                              "Design / graphisme",
                                              "Développeur informatique",
                                              "Expert / ingénieur",
                                            ),
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
                            'asDropDownList' => false,
                            'name' => 'codepostal',
                          	'id' => 'codepostal',
                            'value'=> (isset($me["codepostal"])) ? $me["codepostal"] : "",
                            'pluginOptions' => array(
                                'tags' => array(
                                            'ST DENIS',
                                            'ST PIERRE',
                                            'BOIS DE NEFLES ST PAUL',
                                            'BRAS PANON',
                                            'CILAOS',
                                            'ENTRE DEUX',
                                            'LA CHALOUPE',
                                            'LA MONTAGNE',
                                            'LA PLAINE DES CAFRES',
                                            'LA POSSESSION',
                                            'LE PORT',
                                            'LA RIVIERE',
                                            'LA SALINE',
                                            'LE GUILLAUME',
                                            'LE PITON ST LEU',
                                            'LES AVIRONS',
                                            'LES TROIS BASSINS',
                                            'L ETANG SALE',
                                            'PETITE ILE',
                                            'LE TAMPON',
                                            'LA PLAINE DES PALMISTES',
                                            'RAVINE DES CABRIS',
                                            'SALAZIE',
                                            'LES TROIS BASSINS',
                                            'ST GILLES LES BAINS' ,
                                            'ST GILLES LES HAUTS',
                                            'ST LEU',
                                            'STE ANNE',
                                            'STE MARIE',
                                            'STE ROSE',
                                            'ST ANDRE',
                                            'STE SUZANNE',
                                            'ST PHILIPPE',
                                            'ST LOUIS',
                                            'ST PAUL',
                                            'ST BENOIT',
                                            'ST JOSEPH',
                                            'STE CLOTILDE'
                                            ),
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
                            'asDropDownList' => false,
                            'name' => 'objectif',
                          	'id' => 'objectif',
                            'value'=> (isset($me["objectif"])) ? $me["objectif"] : "",
                            'pluginOptions' => array(
                                'tags' => array(
                                              "Présenter votre idée nouvelle",
                                              "Présenter votre idée pour l'améliorer",
                                              "Présenter votre idée pour la faire évaluer",
                                              "Trouver une idée pour m'associer à un projet",
                                              "faire avancer mon projet",
                                              "trouver des associés / partenaires",
                                              "rencontrer des nouvelles personnes",
                                              "satisfaire votre curiosité",
                                              "vous former (en accéléré) à la création d'entreprise",
                                              "recevoir des conseils d'experts",
                                              "répondre à un 'besoin' précis",
                                              "le challenge, le 'fun'",
                                            ),
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
    $("#sweInscriptionForm").submit( function(event){
    	event.preventDefault();
    	$("#sweInscription").modal('hide');
    	NProgress.start();
    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/index.php/evenement/sweInfos",
    	  data: $("#sweInscriptionForm").serialize(),
    	  success: function(data){
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
<div id="sweInvitation" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"> Inviter Quelqu'un au Start Up Week End</h3>
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

