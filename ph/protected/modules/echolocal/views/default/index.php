<style>
	.apiList h2,.apiList h3,.apiList h4 { 
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
	.blocki{
		background-color: #324553;
		color: white;
		padding : 10px;
		border : 3px solid #666;
	}
	h4.blocky{
		background-color: #fff95e
	}
	h3.blockp{background-color: #ffd150}
</style>
<div class="containeri apiList">
	<div class="hero-uniti">
		<h2>Echolocal API : List all URLs</h2>
		<ul>
			<!-- ////////////////////////////////////////////////////////////////////////////// -->
			<li ><h3 class="blockp">Scenario</h3></li>
			<li>
				<h4 class="blocky">Inscription / Creation</h4>
				<ul class="blocki">
					<li></li>
					
				</ul>
				<h4  class="blocky">Visualisation</h4>
				<ul class="blocki">
					<li></li>
				</ul>
			</li>
			<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<li><h3 class="blockp">User</h3></li>

			<li class="block" id="blockLogin">
				<a href="/ph/echolocal/default/login">Login</a><br/>
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
							testitpost("loginResult",'/ph/echolocal/default/login',params);
							
						}
					</script>
					
				</div>
			</li>

			<li class="block"><a href="/ph/echolocal/default/saveUser"  id="blockSaveUser">Create/Update user</a><br/>
				<div class="fss">
					url : /ph/echolocal/default/saveUser<br/>
					method type : POST <br/>
					Form inputs : email,postalcode,pwd,phoneNumber(is optional)<br/>
					return json object {"result":true || false}
				</div>
				<div class="apiForm createUser">
					name : <input type="text" name="nameSaveUser" id="nameSaveUser" value="echolocal User" /><br/>
					email* : <input type="text" name="emailSaveUser" id="emailSaveUser" value="echolocal@echolocal.com" /><br/>
					cp* : <input type="text" name="postalcodeSaveUser" id="postalcodeSaveUser" value="97421" /><br/>
					pwd* : <input type="text" name="pwdSaveUser" id="pwdSaveUser" value="1234" /><br/>
					phoneNumber : <input type="text" name="phoneNumberSaveUser" id="phoneNumberSaveUser" value="1234" />(for SMS)<br/>
					type : <select name="typeSaveUser" id="typeSaveUser">
								<option value="echolocal">Participant</option>
								<option value="adminecholocal">adminecholocal</option>
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
							testitpost("createUserResult",'/ph/echolocal/default/saveUser',params);
						}
					</script>
				</div>
			</li>
			
			<li class="block"><a href="/ph/echolocal/default/getUser/email/oceatoon@gmail.com"  id="blockGetUser">Get User</a><br/>
				<div class="fss">
					url : /ph/echolocal/default/getUser/email/oceatoon@gmail.com<br/>
					method type : GET <br/>
					param : email<br/>
					email : <input type="text" name="getUseremail" id="getUseremail" value="oceatoon@gmail.com" /><br/>
					<a href="javascript:getUser()">Test it</a><br/>
					<a href="javascript:confirmUserRegistration()">Confirm User Registration</a><br/>
					<div id="getUserResult" class="result fss"></div>
					<script>
						function getUser(){
							testitget("getUserResult",'/ph/echolocal/default/getUser/email/'+$("#getUseremail").val());
						}
						function confirmUserRegistration(){
							testitget("getUserResult",'/ph/echolocal/default/confirmUserRegistration/email/'+$("#getUseremail").val());
						}
					</script>
				</div>
			</li>


			<li class="block"><a href="/ph/echolocal/default/getPeople">Get echolocal People</a><br/>
				<div class="fss">
					url : /ph/echolocal/default/getPeople<br/>
					method type : GET <br/>
					<a href="javascript:getPeople()">Test it</a><br/>
					<div id="getPeopleResult" class="result fss"></div>
					<script>
						function getPeople(){
							testitget("getPeopleResult",'/ph/echolocal/default/getPeople');
						}
					</script>
				</div>

			</li>
			<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<li><h3 class="blockp">Entities</h3></li>

			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')">Form</a>
				<a href="/ph/echolocal/default/saveGroup">Create/Update Entité (Asso. , Entr. , Group )</a>

				<div class="fss">
					url : /ph/echolocal/default/saveGroup<br/>
					method type : POST <br/>
					Form inputs : email,postalcode,pwd,phoneNumber(is optional)type<br/>
					return json object {"result":true || false}
				</div>
				<div class="apiForm createUser">
					name : <input type="text" name="namesaveGroup" id="namesaveGroup" value="Asso1" /><br/>
					email* : <input type="text" name="emailsaveGroup" id="emailsaveGroup" value="echolocal@echolocal.com" /> (personne physique responsable )<br/>
					cp* : <input type="text" name="postalcodesaveGroup" id="postalcodesaveGroup" value="97421" /><br/>
					phoneNumber : <input type="text" name="phoneNumbersaveGroup" id="phoneNumbersaveGroup" value="1234" />(for SMS)<br/>
					type : <select name="typesaveGroup" id="typesaveGroup" onchange="typeChanged()">
								<option value="association">Association</option>
								<option value="entreprise">Entreprise</option>
								<option value="group">Groupe de personne</option>
								<option value="event">Evenement</option>
							</select><br/>
					<span class="hide whensaveGroup">
						when : <input type="text" name="whensaveGroup" id="whensaveGroup" value="" />
						where : <input type="text" name="wheresaveGroup" id="wheresaveGroup" value="" />
					</span><br/>
					<a href="javascript:addUser()">Test it</a><br/>
					<div id="saveGroupResult" class="result fss"></div>
					<script>
						function addUser(){
							params = { "email" : $("#emailsaveGroup").val() , 
							    	   "name" : $("#namesaveGroup").val() , 
							    	   "cp" : $("#postalcodesaveGroup").val() , 
							    	   "pwd" : $("#pwdsaveGroup").val(),
							    	   "type" : $("#typesaveGroup").val(),
							    	   "phoneNumber" : $("#phoneNumbersaveGroup").val()};
							if( $("#whensaveGroup").val() )
								paramas["when"] = $("#whensaveGroup").val();
							if( $("#wheresaveGroup").val() )
								paramas["where"] = $("#wheresaveGroup").val();
							
							testitpost("saveGroupResult",'/ph/echolocal/default/saveGroup',params);
						}
						function typeChanged(){
							console.log( $("#typesaveGroup").val() );
							if ($("#typesaveGroup").val() == "event") {
								$(".whensaveGroup").show();
							} else {
								$(".whensaveGroup").hide();
							}
						}
					</script>
				</div>

			</li>
			
			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')">Get</a>
				<a href="/ph/echolocal/default/getGroup">Get une Entité by email </a><br/>
				<div class="fss">
					url : /ph/echolocal/default/getGroup/email/echolocal@echolocal.com<br/>
					method type : GET <br/>
					param : email<br/>
					email : <input type="text" name="getGroupemail" id="getGroupemail" value="echolocal@echolocal.com" /><br/>
					<a href="javascript:getGroup()">Test it</a><br/>
					<a href="javascript:confirmUserRegistration()">Confirm User Registration</a><br/>
					<div id="getGroupResult" class="result fss"></div>
					<script>
						function getGroup(){
							testitget("getGroupResult",'/ph/echolocal/default/getGroup/email/'+$("#getGroupemail").val());
						}
						function confirmUserRegistration(){
							testitget("getGroupResult",'/ph/echolocal/default/confirmGroupRegistration/email/'+$("#getGroupemail").val());
						}
					</script>
				</div>
			
			</li>
			
			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')">Link Form</a>
				<a href="/ph/echolocal/default/linkUser2Group">Lié un User a une Entité</a><br/>
				<div class="fss">
					url : /ph/echolocal/default/linkUser2Group/email/echolocal@echolocal.com<br/>
					method type : GET <br/>
					param : email<br/>
					all echolocal groups  : <input type="text" name="linkUser2GroupGroup" id="linkUser2GroupGroup" value="Asso1" />(auto-complete)<br/>
					email(s) : <textarea type="text" name="linkUser2Groupemail" id="linkUser2Groupemail">echolocal@echolocal.com</textarea><br/>
					séparé par des virgules<br/>
					<a href="javascript:linkUser2Group()">Link it</a><br/>
					<a href="javascript:unlinkUser2Group()">Unlink it</a><br/>
					<div id="linkUser2GroupResult" class="result fss"></div>
					<script>
						function linkUser2Group(){
							params = { 
					    	   "email" : $("#linkUser2Groupemail").val() , 
					    	   "name" : $("#linkUser2GroupGroup").val() 
					    	   };
							testitpost("linkUser2GroupResult",'/ph/echolocal/default/linkUser2Group',params);
						}
						function unlinkUser2Group(){
							params = { 
					    	   "email" : $("#linkUser2Groupemail").val() , 
					    	   "name" : $("#linkUser2GroupGroup").val() 
					    	   };
							testitpost("linkUser2GroupResult",'/ph/echolocal/default/unlinkUser2Group',params);
						}
					</script>
				</div>
			</li>
			
			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')">Get</a>
				<a href="/ph/echolocal/default/getGroups">Get all echolocal Entités</a><br/>
				<div class="fss">
					url : /ph/echolocal/default/getGroups<br/>
					method type : GET <br/>
					<a href="javascript:getGroups()">Test it</a><br/>
					<div id="getGroupsResult" class="result fss"></div>
					<script>
						function getGroups(){
							testitget("getGroupsResult",'/ph/echolocal/default/getGroups');
						}
					</script>
				</div>
			</li>
			

		</ul>
	</div>
</div>
div.toto*2>ul>li*4>a
<script type="text/javascript">
function testitpost(id,url,params){
	console.log(id,url,params);
	$("#"+id).html("");
	$.ajax({
	    url:url,
	    data:params,
	    type:"POST",
	    success:function(data) {
	      $("#"+id).html(JSON.stringify(data, null, 4));
	    },
	    error:function (xhr, ajaxOptions, thrownError){
	      $("#"+id).html(data);
	    } 
	  });
}
function testitget(id,url){
	$("#"+id).html("");
	$.ajax({
	    url:url,
	    type:"GET",
	    success:function(data) {
	      $("#"+id).html(JSON.stringify(data, null, 4));
	    },
	    error:function (xhr, ajaxOptions, thrownError){
	      $("#"+id).html(data);
	    } 
	  });
}
</script>