<a href="/ph/site/logout">Logout</a><br/>
<div class="fss">
	Il faut etre loguer par email, cp, et mot de passe<br/>
	method type : POST <br/>
</div>
<div class="apiForm login">
	email : <input type="text" name="emailLogin" id="emailLogin" value="<?php echo $this->module->id?>@<?php echo $this->module->id?>.com" /><br/>
	pwd : <input type="password" name="pwdLogin" id="pwdLogin" value="1234" /><br/>
	<a href="javascript:login()">Test it</a><br/>
	<a href="javascript:sendEmailPwd()">Mot de passe oublié</a><br/>
	<div id="loginResult" class="result fss"></div>
	<script>
		function login(){
			params = { "email" : $("#emailLogin").val() , 
			    	   "pwd" : $("#pwdLogin").val(),
			    	   "loginRegister" :1,
			    	   "app":"<?php echo $this->module->id?>"
			    	};
			testitpost("loginResult",baseUrl+'/<?php echo $this->module->id?>/api/login',params);
			
		}
		function sendEmailPwd(){
		      if($("#emailLogin").val()!=""){
		        params = { "email" : $("#emailLogin").val()};
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
		          },
		          dataType: "json"
		        });
		      }else {
		        $("#flashInfo .modal-body").html("Merci compléter le champ Email pour recevoir votre mot de passe.");
		        $("#flashInfo").modal('show');
		      }
		}
	</script>
	
</div>