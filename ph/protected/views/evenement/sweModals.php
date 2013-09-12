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
    <h3>Finaliser votre inscription</h3>
  </div>
  <div class="modal-body">
    <p> Merci de compléter vos donées . </p>
    <form class="sweInscriptionForm">
        
        <!-- Text input-->
        <div class="control-group">
          <label class="control-label" for="name">Nom</label>
          <div class="controls">
            <input id="name" name="name" type="text" placeholder="" class="input-large" required="">
            
          </div>
        </div>
        
        <!-- Text input-->
        <div class="control-group">
          <label class="control-label" for="firstname">Prénom</label>
          <div class="controls">
            <input id="firstname" name="firstname" type="text" placeholder="" class="input-large" required="">
            
          </div>
        </div>
   </form>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
  </div>
</div>
<!-- Modal -->
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