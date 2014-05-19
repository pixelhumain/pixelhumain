<ul>
	<li class="block" id="blockCommunect">
		<a href="/ph/<?php echo $this::$moduleKey?>/default/communect">Login</a><br/>
		<div class="fss">
			se communecter c'est juste suivre l'activité d'un CP <br/>
			Il suffit d'un email et d'un CP<br/>
			method type : POST <br/>
		</div>
		<div class="apiForm communect">
			email : <input type="text" name="emailCommunect" id="emailCommunect" value="toto@toto.com" /><br/>
			code postal  : <input type="text" name="cpCommunect" id="cpCommunect" value="97421" /><br/>
			<a href="javascript:communect()">Communect</a><br/>
			<div id="communectResult" class="result fss"></div>
			<script>
				function communect(){
					params = { "email" : $("#emailCommunect").val() , 
					    	   "cp" : $("#cpCommunect").val()
					    	};
					testitpost("communectResult",'/ph/<?php echo $this::$moduleKey?>/default/communect',params);
				}
			</script>
			
		</div>
	</li>

	<li class="block" id="blockLogin">
		<a href="/ph/<?php echo $this::$moduleKey?>/default/login">Login</a><br/>
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
					params = { "email" : $("#emailLogin").val() , 
					    	   "pwd" : $("#pwdLogin").val()
					    	};
					testitpost("loginResult",'/ph/<?php echo $this::$moduleKey?>/default/login',params);
					
				}
			</script>
			
		</div>
	</li>

	<li class="block"><a href="/ph/<?php echo $this::$moduleKey?>/default/saveUser"  id="blockSaveUser">Create/Update user</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/default/saveUser<br/>
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
			
			<a href="javascript:addUser()">Test it</a><br/>
			<div id="createUserResult" class="result fss"></div>
			<script>
				function addUser(){
					params = { "email" : $("#emailSaveUser").val() , 
					    	   "name" : $("#nameSaveUser").val() , 
					    	   "cp" : $("#postalcodeSaveUser").val() ,
					    	   "pwd":$("#pwdSaveUser").val() ,
					    	   "phoneNumber" : $("#phoneNumberSaveUser").val()};
					testitpost("createUserResult",'/ph/<?php echo $this::$moduleKey?>/default/saveUser',params);
				}
			</script>
		</div>
	</li>
	
	<li class="block"><a href="/ph/<?php echo $this::$moduleKey?>/default/getUser/email/oceatoon@gmail.com"  id="blockGetUser">Get User</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/default/getUser/email/oceatoon@gmail.com<br/>
			method type : GET <br/>
			param : email<br/>
			email : <input type="text" name="getUseremail" id="getUseremail" value="oceatoon@gmail.com" /><br/>
			<a href="javascript:getUser()">Test it</a><br/>
			<div id="getUserResult" class="result fss"></div>
			<script>
				function getUser(){
					testitget("getUserResult",'/ph/<?php echo $this::$moduleKey?>/default/getUser/email/'+$("#getUseremail").val());
				}
				
			</script>
		</div>
	</li>


	<li class="block"><a href="/ph/<?php echo $this::$moduleKey?>/default/getPeople"  id="blockgetPeople">Get People by codepostal </a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/default/getPeople<br/>
			method type : POST <br/>
			cp* : <input type="text" name="postalcodegetPeople" id="postalcodegetPeople" value="97421" /><br/>
			<a href="javascript:getPeople()">Test it</a><br/>
			<div id="getPeopleResult" class="result fss"></div>
			<script>
				function getPeople(){
					params = { "cp" : $("#postalcodegetPeople").val() };
					testitpost("getPeopleResult",'/ph/<?php echo $this::$moduleKey?>/default/getpeopleby',params);
				}
			</script>
		</div>

	</li>
</ul>	