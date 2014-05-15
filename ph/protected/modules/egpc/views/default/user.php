<ul>
	<li class="block" id="blockLogin">
		<a href="/ph/egpc/default/login">Login</a><br/>
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
					    	   "pwd" : $("#pwdLogin").val()};
					testitpost("loginResult",'/ph/egpc/default/login',params);
					
				}
			</script>
			
		</div>
	</li>

	<li class="block"><a href="/ph/egpc/default/saveUser"  id="blockSaveUser">Create/Update user</a><br/>
		<div class="fss">
			url : /ph/egpc/default/saveUser<br/>
			method type : POST <br/>
			Form inputs : email,postalcode,pwd,phoneNumber(is optional)<br/>
			return json object {"result":true || false}
		</div>
		<div class="apiForm createUser">
			name : <input type="text" name="nameSaveUser" id="nameSaveUser" value="EGPC User" /><br/>
			email* : <input type="text" name="emailSaveUser" id="emailSaveUser" value="egpc@egpc.com" /><br/>
			cp* : <input type="text" name="postalcodeSaveUser" id="postalcodeSaveUser" value="97421" /><br/>
			pwd* : <input type="text" name="pwdSaveUser" id="pwdSaveUser" value="1234" /><br/>
			phoneNumber : <input type="text" name="phoneNumberSaveUser" id="phoneNumberSaveUser" value="1234" />(for SMS)<br/>
			type : <select name="typeSaveUser" id="typeSaveUser">
						<option value="egpc">Participant</option>
						<option value="adminegpc">adminEGPC</option>
					</select><br/>
			<a href="javascript:addUser()">Test it</a><br/>
			<div id="createUserResult" class="result fss"></div>
			<script>
				function addUser(){
					params = { "email" : $("#emailSaveUser").val() , 
					    	   "name" : $("#nameSaveUser").val() , 
					    	   "cp" : $("#postalcodeSaveUser").val() , 
					    	   "type" : $("#typeSaveUser").val(),
					    	   "phoneNumber" : $("#phoneNumberSaveUser").val()};
					testitpost("createUserResult",'/ph/egpc/default/saveUser',params);
				}
			</script>
		</div>
	</li>
	
	<li class="block"><a href="/ph/egpc/default/getUser/email/oceatoon@gmail.com"  id="blockGetUser">Get User</a><br/>
		<div class="fss">
			url : /ph/egpc/default/getUser/email/oceatoon@gmail.com<br/>
			method type : GET <br/>
			param : email<br/>
			email : <input type="text" name="getUseremail" id="getUseremail" value="oceatoon@gmail.com" /><br/>
			<a href="javascript:getUser()">Test it</a><br/>
			<a href="javascript:confirmUserRegistration()">Confirm User Registration</a><br/>
			<div id="getUserResult" class="result fss"></div>
			<script>
				function getUser(){
					testitget("getUserResult",'/ph/egpc/default/getUser/email/'+$("#getUseremail").val());
				}
				function confirmUserRegistration(){
					testitget("getUserResult",'/ph/egpc/default/confirmUserRegistration/email/'+$("#getUseremail").val());
				}
			</script>
		</div>
	</li>


	<li class="block"><a href="/ph/egpc/default/getPeople"  id="blockgetPeople">Get EGPC People</a><br/>
		<div class="fss">
			url : /ph/egpc/default/getPeople<br/>
			method type : GET <br/>
			<a href="javascript:getPeople()">Test it</a><br/>
			<div id="getPeopleResult" class="result fss"></div>
			<script>
				function getPeople(){
					testitget("getPeopleResult",'/ph/egpc/default/getPeople');
				}
			</script>
		</div>

	</li>
</ul>	