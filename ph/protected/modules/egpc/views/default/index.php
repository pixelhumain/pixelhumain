<style>
	.apiList h2,.apiList h3 { 
		font-family: "Homestead";
		position:relative;
		top:0px;
		left:0px;
		color: #324553;
		background-color: white;
		padding : 10px;
		border : 3px solid #666;
	}
	.apiList ul{list-style: none;}
	.apiList .block{ 
		border:1px solid #333; 
		background-color: #ededed; 
		margin:10px; 
		padding:10px;
	}
	 .fss{
		line-height: 20px; 
	}
	 .result{
		color: red; 
	}
</style>
<div class="containeri apiList">
	<div class="hero-uniti">
		<h2>E.G.P.C API : List all URLs</h2>
		<ul>
			
			<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<li><h3>User</h3></li>

			<li class="block">
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
							$.ajax({
							    url:'/ph/egpc/default/login',
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

			<li class="block"><a href="/ph/egpc/default/saveUser">Create/Update user</a><br/>
				<div class="fss">
					url : /ph/egpc/default/saveUser<br/>
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
							    url:'/ph/egpc/default/saveUser',
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
			
			<li class="block"><a href="/ph/egpc/default/getUser/email/oceatoon@gmail.com">Get User</a><br/>
				<div class="fss">
					url : /ph/egpc/default/getUser/email/oceatoon@gmail.com<br/>
					method type : GET <br/>
					param : email<br/>
					email : <input type="text" name="getUseremail" id="getUseremail" value="oceatoon@gmail.com" /><br/>
					<a href="javascript:getUser()">Test it</a><br/>
					<div id="getUserResult" class="result fss"></div>
					<script>
						function getUser(){
							$("#getUserResult").html("");
							$.ajax({
							    url:'/ph/egpc/default/getUser/email/'+$("#getUseremail").val(),
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

			<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<li><h3>Association</h3></li>

			<li class="block"><a href="/ph/egpc/default/saveAssociation">Create/Update Associations</a><br/>
			</li>

			<li class="block"><a href="/ph/egpc/default/getAssociation">Get une Associations</a><br/>
			</li>

			<li class="block"><a href="/ph/egpc/default/linkUserAssociation">Lié un User a une Association</a><br/>
			</li>

			<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<li><h3>Groupes</h3></li>

			<li class="block"><a href="/ph/egpc/default/saveGroup">Create/Update Groupe</a><br/>
			</li>

			<li class="block"><a href="/ph/egpc/default/linkUserAssociation">Link un User or an Association to a group</a><br/>
			</li>

			<li class="block"><a href="/ph/egpc/default/getGroup">Get une Group</a><br/>
			</li>

			<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<li><h3>Evenement</h3></li>

			<li class="block"><a href="/ph/egpc/default/getEvents">Liste des evenements (tag filtrable) </a><br/>
			</li>

			<li class="block"><a href="/ph/egpc/default/saveEvent">Create/Update evenement</a><br/>
			</li>

			<li class="block"><a href="/ph/egpc/default/getEvent">Get un evenement</a><br/>
			</li>

		</ul>
	</div>
</div>