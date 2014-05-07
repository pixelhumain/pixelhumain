<!-- Modal -->
<div class="modal fade" id="invitation" tabindex="-1" role="dialog" aria-labelledby="invitationLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="invitationLabel">Parainer ou Inviter Quelqu'un</h3>
  </div>
  <div class="modal-body">
    <p> L'invité recevra un mail pour venir compléter sa fiche d'incription </p>
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