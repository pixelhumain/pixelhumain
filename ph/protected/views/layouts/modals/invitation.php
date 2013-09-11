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

<script type="text/javascript">
initT['invitationModalsInit'] = function(){
    
    $("#inviteForm").submit( function(event){
    	event.preventDefault();
    	$("#invitation").modal('hide');
    	toggleSpinner();
    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/index.php/citoyens/invitation",
    	  data: $("#inviteForm").serialize(),
    	  success: function(data){
    			  $("#flashInfo .modal-body").html(data.msg);
    			  $("#flashInfo").modal('show');
    		  	  toggleSpinner();
    	  },
    	  dataType: "json"
    	});
    });
};
</script>