<a href="/ph/<?php echo $this->module->id?>/api/login">Login</a><br/>
<a href="/ph/site/logout">Logout</a><br/>
<div class="fss">
	Il faut etre loguer par email, cp, et mot de passe<br/>
	method type : POST <br/>
</div>
<div class="apiForm login">
	email : <input type="text" name="emailLogin" id="emailLogin" value="<?php echo $this->module->id?>@<?php echo $this->module->id?>.com" /><br/>
	pwd : <input type="password" name="pwdLogin" id="pwdLogin" value="1234" /><br/>
	<a href="javascript:login()">Test it</a><br/>
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
	</script>
	
</div>