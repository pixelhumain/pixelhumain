<div class="modal fade" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="loginFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="loginFormLabel">S'inscrire ou se Connecter : </h3>
      </div>
      <div class="modal-body">
      	<p> Si vous voulez votez, il faut s'authentifier donc avoir un compte 
       	<br/>et si vous etes deja inscrit , connectez vous avec votre email d'inscription.</p>
        <form id="registerPwdForm" action="">
        	<section >
            	<table style="width:230px; float:left;margin-left:40px;">
            	
                  	<tr>
                      	<td><input type="text" id="registerPwdEmail" name="registerPwdEmail" placeholder="Email" value="survey1@survey.com" ></td>
                  	</tr>
                  	<tr>
                      	<td><input type="password" id="registerPwd" name="registerPwd" placeholder="Mot de passe (si Login)" ></td>
                    </tr>
                  	
                  	
                </table>
                
                <table style="width:210px;float:right;margin-right:40px;">
                
                  	<tr>
                      	<td style="font-weight: bold"> Si vous n'avez pas de compte ce même formulaire vous créera un compte, sinon vous logguera</td>
                  	</tr>
                  	
                </table>
                
            </section>
    	  </form>
        <div style="clear:both"></div>
      </div>
       <div class="modal-footer">
          <a class="btn btn-warning " href="javascript:;" onclick="$('#registerPwdForm').submit();return false;"  >S'inscrire  ou se Connecter</a>
          <a class="btn btn-warning " href="javascript:;" onclick="sendEmailPwd();"  >Regénéré mon mot de passe</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
<!-- Modal -->
<script type="text/javascript">
initT['loginModalsInit'] = function(){
    /* *************************** */
    /* resgistration Ajax Call*/
    /* *************************** */
    $('#registerPwd').bind("enterKey",function(e){
    	$('#registerPwdForm').submit();
    });
    $('#registerPwd').keyup(function(e){
        if(e.keyCode == 13)
        {
        	$('#registerPwdForm').submit();
        }
    });
    $("#registerPwdForm").submit( function(event){
    	log($(this).serialize());
    	event.preventDefault();
    	$("#loginForm").modal('hide');
    	toggleSpinner();

    	method = "login";
	    params = { "email" : $("#registerPwdEmail").val() , 
                   "pwd" : $("#registerPwd").val()
                };
      <?php if( isset( $this->module->id ) && $this->loginRegister ) { ?>
      params.loginRegister =1;
      params.app = "<?php echo $this->module->id?>";
      <?php } ?>
      log(params);
    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/<?php echo $this->module->id?>/api/"+method,
    	  data: params,
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

function sendEmailPwd(){
      $(".loginFormLabel").html('Patience : <div class="loader"></div>');
      if($("#registerPwdEmail").val()!=""){
        $("#loginForm").modal('hide');
        params = { "email" : $("#registerPwdEmail").val()};
        <?php if( isset( $this->module->id ) && $this->loginRegister ) { ?>
        params.app = "<?php echo $this->module->id?>";
        <?php } ?>
        $.ajax({
          type: "POST",
          url: baseUrl+"/<?php echo $this->module->id?>/api/sendemailpwd",
          data: params,
          success: function(data){
              $("#flashInfo .modal-body").html(data.msg);
              $("#flashInfo").modal('show');
              $(".loader").remove();
          },
          dataType: "json"
        });
      }else 
        alert("il faudrait peut etre mettre un email, non ?");
}
</script>