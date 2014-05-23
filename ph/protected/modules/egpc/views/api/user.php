<ul>
	<li class="block" id="blockLogin">
		<a href="/ph/<?php echo $this::$moduleKey?>/api/login">Login</a><br/>
		<div class="fss">
			Il faut etre loguer par email, cp, et mot de passe<br/>
			method type : POST <br/>
		</div>
		<div class="apiForm login">
			email : <input type="text" name="emailLogin" id="emailLogin" value="oceatoon@gmail.com" /><br/>
			pwd : <input type="password" name="pwdLogin" id="pwdLogin" value="2210" /><br/>
			<a href="javascript:login()">Test it</a><br/>
			<div id="loginResult" class="result fss"></div>
			<script>
				function login(){
					$("#loginResult").html("");
					params = { "email" : $("#emailLogin").val() , 
					    	   "pwd" : $("#pwdLogin").val(),
					    	   "app" : "<?php echo $this::$moduleKey?>"};
					testitpost("loginResult",'/ph/<?php echo $this::$moduleKey?>/api/login',params);
					
				}
			</script>
			
		</div>
	</li>

	<li class="block"><a href="/ph/<?php echo $this::$moduleKey?>/api/saveUser"  id="blockSaveUser">Create/Update user</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/saveUser<br/>
			method type : POST <br/>
			Form inputs : email,postalcode,pwd,phoneNumber(is optional)<br/>
			return json object {"result":true || false}
		</div>
		<div class="apiForm createUser">
			name : <input type="text" name="nameSaveUser" id="nameSaveUser" value="<?php echo $this::$moduleKey?> User" /><br/>
			email* : <input type="text" name="emailSaveUser" id="emailSaveUser" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /><br/>
			cp* : <input type="text" name="postalcodeSaveUser" id="postalcodeSaveUser" value="97421" /><br/>
			pwd* : <input type="text" name="pwdSaveUser" id="pwdSaveUser" value="1234" /><br/>
			phoneNumber : <input type="text" name="phoneNumberSaveUser" id="phoneNumberSaveUser" value="1234" />(for SMS)<br/>
			type : <select name="typeSaveUser" id="typeSaveUser">
						<option value="<?php echo $this::$moduleKey?>">Participant</option>
						<option value="admin<?php echo $this::$moduleKey?>">admin<?php echo $this::$moduleKey?></option>
					</select><br/>
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
	
	<li class="block"><a href="/ph/<?php echo $this::$moduleKey?>/api/getUser/email/oceatoon@gmail.com"  id="blockGetUser">Get User</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/getUser/email/oceatoon@gmail.com<br/>
			method type : GET <br/>
			param : email<br/>
			email : <input type="text" name="getUseremail" id="getUseremail" value="oceatoon@gmail.com" /><br/>
			<a href="javascript:getUser()">Test it</a><br/>
			<a href="javascript:confirmUserRegistration()">Confirm User Registration</a><br/>
			<div id="getUserResult" class="result fss"></div>
			<script>
				function getUser() { 
					testitget("getUserResult",'/ph/<?php echo $this::$moduleKey?>/api/getUser/email/'+$("#getUseremail").val());
				}
				function confirmUserRegistration() { 
					testitget("getUserResult",'/ph/<?php echo $this::$moduleKey?>/api/confirmgroupregistration/email/'+$("#getUseremail").val()+'/app/<?php echo $this::$moduleKey?>');
				}
			</script>
		</div>
	</li>


	<li class="block"><a href="/ph/<?php echo $this::$moduleKey?>/api/getpeopleby"  id="blockgetPeople">Get <?php echo $this::$moduleKey?> People</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/getpeopleby<br/>
			method type : POST <br/>
			fields : <input type="text" name="getpeoplebyFilter" id="getpeoplebyFilter" value="email" />(comma seperated)<br/>
			<a href="javascript:getpeopleby()">Test it</a><br/>
			<div id="getpeoplebyResult" class="result fss"></div>
			<script>
				function getpeopleby(){
					fields = $("#getpeoplebyFilter").val(); 
					params = {"app":"<?php echo $this::$moduleKey?>"};
					if(fields) 
						params.fields = fields.split(",");
					testitpost("getpeoplebyResult",'/ph/<?php echo $this::$moduleKey?>/api/getpeopleby',params);
				}
			</script>
		</div>

	</li>
</ul>	