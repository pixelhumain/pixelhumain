
<div class="modal fade" id="proposerloiForm" tabindex="-1" role="dialog" aria-labelledby="proposerloiFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="proposerloiFormLabel" >Faites une Proposition :</h3>
      </div>
      <div class="modal-body">
      	<p> S'inscrire pour soutenir le projet ou simplement suivre son avancement
       	<br/>et si vous etes deja inscrit , connectez vous avec votre email d'inscription.</p>
        name 
        <br/>
        <input type="text" name="nameaddEntry" id="nameaddEntry" value="test1" />
        <br/><br/>
        message
        <textarea id="message" style="width:100%;height:30px;vertical-align: middle" onkeyup="AutoGrowTextArea(this);$('#message1').val($('#message').val())"></textarea>
        <br/><br/>
        tags<br/>
        <input type="text" name="tagsaddEntry" id="tagsaddEntry" value="" placeholder="ex:social,solidaire...etc"/><br/>
        <div style="clear:both"></div>
      </div>
       <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
