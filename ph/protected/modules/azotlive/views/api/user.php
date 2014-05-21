<ul>
	<li><h3>User</h3></li>

			<li class="block">
				<a href="/ph/azotlive/default/login">Login</a><br/>
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
							$.ajax({
							    url:'/ph/azotlive/default/login',
							    type:"POST",
							    data:{ "email" : $("#emailLogin").val() , 
							    	   "pwd" : $("#pwdLogin").val()},
							    success:function(data) {
							      $("#loginResult").html(data);
							    },
							    error:function (xhr, ajaxOptions, thrownError){
							      $("#loginResult").html(data);
							    } 
							  });
						}
					</script>
					
				</div>
			</li>

			<li class="block"><a href="/ph/azotlive/default/saveUser">Create/Update user</a><br/>
				<div class="fss">
					url : /ph/azotlive/default/saveUser<br/>
					method type : POST <br/>
					Form inputs : email,postalcode,pwd,phoneNumber(is optional)<br/>
					return json object {"result":true || false}
				</div>
				<div class="apiForm createUser">
					name : <input type="text" name="nameSaveUser" id="nameSaveUser" value="New User" /><br/>
					email* : <input type="text" name="emailSaveUser" id="emailSaveUser" value="new@new.com" /><br/>
					cp* : <input type="text" name="postalcodeSaveUser" id="postalcodeSaveUser" value="97421" /><br/>
					pwd* : <input type="text" name="pwdSaveUser" id="pwdSaveUser" value="1234" /><br/>
					phoneNumber : <input type="text" name="phoneNumberSaveUser" id="phoneNumberSaveUser" value="1234" />(for SMS)<br/>
					type : <select name="typeSaveUser" id="typeSaveUser">
								<?php 
								$tor = Yii::app()->mongodb->lists->findOne( array( "name" => "typeObservaterReunion" ),array("list") ) ;
								foreach ($tor["list"] as $key => $value) {
									echo '<option value="'.$key.'">'.$value.'</option>';
								}
								?>
							</select><br/>
					<a href="javascript:addUser()">Test it</a><br/>
					<div id="createUserResult" class="result fss"></div>
					<script>
						function addUser(){
							$("#getUserResult").html("");
							$.ajax({
							    url:'/ph/azotlive/default/saveUser',
							    data:{ "email" : $("#emailSaveUser").val() , 
							    	   "name" : $("#nameSaveUser").val() , 
							    	   "cp" : $("#postalcodeSaveUser").val() , 
							    	   "pwd" : $("#pwdSaveUser").val(),
							    	   "phoneNumber" : $("#phoneNumberSaveUser").val(),
							    		//"lang" : $("#langSaveUser").val(),
							    		"type" : $("#typeSaveUser").val()},
							    type:"POST",
							    success:function(data) {
							      $("#createUserResult").html(JSON.stringify(data, null, 4));
							    },
							    error:function (xhr, ajaxOptions, thrownError){
							      $("#createUserResult").html(data);
							    } 
							  });
						}
					</script>
				</div>
			</li>
			
			<li class="block"><a href="/ph/azotlive/default/getUser/email/oceatoon@gmail.com">Get User</a><br/>
				<div class="fss">
					url : /ph/azotlive/default/getUser/email/oceatoon@gmail.com<br/>
					method type : GET <br/>
					param : email<br/>
					email : <input type="text" name="getUseremail" id="getUseremail" value="oceatoon@gmail.com" /><br/>
					<a href="javascript:getUser()">Test it</a><br/>
					<div id="getUserResult" class="result fss"></div>
					<script>
						function getUser(){
							$("#getUserResult").html("");
							$.ajax({
							    url:'/ph/azotlive/default/getUser/email/'+$("#getUseremail").val(),
							    type:"GET",
							    success:function(data) {
							      $("#getUserResult").html(JSON.stringify(data, null, 4));
							    },
							    error:function (xhr, ajaxOptions, thrownError){
							      $("#getUserResult").html(data);
							    } 
							  });
						}
					</script>
				</div>
			</li>
</ul>	