
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