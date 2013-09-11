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
<script type="text/javascript">
initT['loginModalsInit'] = function(){
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