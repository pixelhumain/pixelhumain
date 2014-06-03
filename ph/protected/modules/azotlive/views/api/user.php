<ul>
	
	<li class="block">
		<a href="/ph/<?php echo $this::$moduleKey?>/api/login">Login</a><br/>
		<div class="fss">
			Il faut etre loguer par email, cp, et mot de passe<br/>
			method type : POST <br/>
		</div>
		<div class="apiForm login">
			email : <input type="text" name="emailLogin" id="emailLogin" value="t@azotlive.com" /><br/>
			pwd : <input type="password" name="pwdLogin" id="pwdLogin" value="1234" /><br/>
			<a href="javascript:login()">Test it</a><br/>
			<div id="loginResult" class="result fss"></div>
			<script>
				function login(){
					params = { "email" : $("#emailLogin").val() , 
					    	   "pwd" : $("#pwdLogin").val(),
					    	   "app" : "<?php echo $this::$moduleKey?>"};
					testitpost("loginResult",'/ph/<?php echo $this::$moduleKey?>/api/login',params);

				}
			</script>
			
		</div>
	</li>

	<li class="block"><a href="/ph/<?php echo $this::$moduleKey?>/api/saveUser">Create/Update user</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/saveUser<br/>
			method type : POST <br/>
			Form inputs : email,postalcode,pwd,phoneNumber(is optional)<br/>
			return json object {"result":true || false}
		</div>
		<div class="apiForm createUser">
			name : <input type="text" name="nameSaveUser" id="nameSaveUser" value="New User" /><br/>
			email* : <input type="text" name="emailSaveUser" id="emailSaveUser" value="new@azotlive.com" /><br/>
			cp* : <input type="text" name="postalcodeSaveUser" id="postalcodeSaveUser" value="97421" /><br/>
			pwd* : <input type="text" name="pwdSaveUser" id="pwdSaveUser" value="1234" /><br/>
			phoneNumber : <input type="text" name="phoneNumberSaveUser" id="phoneNumberSaveUser" value="1234" />(for SMS)<br/>
			type : <select name="typeSaveUser" id="typeSaveUser">
						<option value="azotlive">Azot Live User</option>
						<option value="azotliveProducer">Azot Live Producer</option>
						<option value="azotliveAdmin">Azot Live Admin</option>
					</select><br/>
			<span style="color:red">TODO : add captcha</span><br/>
			<a href="javascript:addUser()">Test it</a><br/>
			<div id="createUserResult" class="result fss"></div>
			<script>
				function addUser(){
					params = { "email" : $("#emailSaveUser").val() , 
			    	   "name" : $("#nameSaveUser").val() , 
			    	   "cp" : $("#postalcodeSaveUser").val() ,
			    	   "pwd":$("#pwdSaveUser").val() , 
			    	   "type" : $("#typeSaveUser").val(),
			    	   "phoneNumber" : $("#phoneNumberSaveUser").val(),
			    	   "app":"<?php echo $this::$moduleKey?>" };
					testitpost("createUserResult",'/ph/<?php echo $this::$moduleKey?>/api/saveUser',params);
				}
			</script>
		</div>
	</li>
	
	<li class="block"><a href="/ph/<?php echo $this::$moduleKey?>/api/getUser/email/t@azotlive.com">Get User</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/getUser/email/t@azotlive.com<br/>
			method type : GET <br/>
			param : email<br/>
			email : <input type="text" name="getUseremail" id="getUseremail" value="t@azotlive.com" /><br/>
			<a href="javascript:getUser()">Test it</a><br/>
			<a href="javascript:confirmUserRegistration()">Confirm User Registration from Email </a><span style="color:red">(TODO add a key hash code)</span><br/>
			<div id="getUserResult" class="result fss"></div>
			<script>
				function getUser() { 
					testitget("getUserResult",'/ph/<?php echo $this::$moduleKey?>/api/getUser/email/'+$("#getUseremail").val());
				}
				function confirmUserRegistration() { 
					testitget("getUserResult",'/ph/<?php echo $this::$moduleKey?>/api/validateAccount/email/'+$("#getUseremail").val()+'/app/<?php echo $this::$moduleKey?>');
				}
			</script>
		</div>
	</li>
</ul>	