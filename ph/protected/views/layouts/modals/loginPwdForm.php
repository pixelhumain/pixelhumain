<div class="modal fade" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="loginFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="loginFormLabel">S'inscrire ou se Connecter :</h3>
      </div>
      <div class="modal-body">
      	<p> S'inscrire pour soutenir le projet ou simplement suivre son avancement
       	<br/>et si vous etes deja inscrit , connectez vous avec votre email d'inscription.</p>
        <form id="registerPwdForm" action="">
        	<section >
            	<table style="width:230px; float:left;margin-left:40px;">
            	
                  	<tr>
                      	<td><input type="text" id="registerPwdEmail" name="registerPwdEmail" placeholder="Email" ></td>
                  	</tr>
                  	<tr>
                      	<td><input type="password" id="registerPwd" name="registerPwd" placeholder="Mot de passe (si Login)" ></td>
                    </tr>
                  	<tr>	
                      	<td> <a class="btn btn-warning " href="javascript:;" onclick="$('#registerPwdForm').submit();return false;"  >S'inscrire  ou se Connecter</a></td>
                  	</tr>
                  	
                </table>
                
                <table style="width:210px;float:right;margin-right:40px;">
                
                  	<tr>
                      	<td> <a class="btn btn-primary btn-xs w100p" href="<?php echo Yii::app()->createUrl('opauth/facebook')?>" ><span class="icon-facebook-rect"></span> FaceBook</a></td>
                  	</tr>
                  	<tr>	
                      	<td> <a class="btn btn-primary btn-xs w100p" href="<?php echo Yii::app()->createUrl('opauth/linkedin')?>" ><span class="icon-linkedin-rect"></span> LinkedIn</a></td>
                  	</tr>
                  	<tr>	
                      	<td> <a class="btn btn-primary btn-xs w100p" href="<?php echo Yii::app()->createUrl('opauth/twitter')?>" ><span class="icon-twitter"></span> Twitter</a></td>
                  	</tr>
                  	<tr>	
                      	<td> <a class="btn btn-primary btn-xs w100p" href="<?php echo Yii::app()->createUrl('opauth/google')?>" ><span class="icon-googleplus-rect"></span> Google</a></td>
                  	</tr>
                  	
                </table>
                
            </section>
    	  </form>
        <div style="clear:both"></div>
      </div>
       <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
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
    	$("#loginPwdForm").modal('hide');
    	toggleSpinner();

    	method = "register";
    	extraParam = "";
    	var appKey = false;<?php //echo empty($this->appKey)?>;
    	var appType = false;<?php //echo empty($this->appType)?>;
    	<?php /*
    	if( appKey && appType  )
    		extraParam = "&appKey=<?php //echo $this->appKey?>&appType=<?php //echo $this->appType?>";
    		method = "registerAppPwd";
    	}*/?>
	
    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/index.php/citoyens/"+method,
    	  data: "registerEmail="+$("#registerPwdEmail").val()+"&registerPwd="+$("#registerPwd").val()+extraParam,
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