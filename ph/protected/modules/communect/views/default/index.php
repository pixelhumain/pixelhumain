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
		<h2>E.G.P.C API : List all URLs</h2>
		<ul>
			<!-- ////////////////////////////////////////////////////////////////////////////// -->
			<li ><h3 class="blockp">Scenario <a class="fa fa-eye" href="javascript:$('.scenario').slideToggle();"></a></h3></li>
			<li class="scenario hide">
				<h4 class="blocky">Inscription / Creation</h4>
				<ul class="blocki">
					<li>EGPC envoie une invitation par campagne mail contenant un lien d'inscription</li>
					<li>Le nouveau venu s'inscrit en citoyen : email + cp </li>
					<li>peut creer une association + mot clef</li>
					<li>peut creer une entreprise + mot clef</li>
					<li>peut creer un groupe + mot clef</li>
					<li>peut inviter qlq'un dans chacune de ces entités</li>
					<li>peut creer un evenement en tant que citoyen ou pour son entité</li>
					<li>peut inviter qlq'un à un evenement</li>
				</ul>
				<h4  class="blocky">Visualisation</h4>
				<ul class="blocki">
					<li>Tout le monde peut visualiser l'organisation de EGPC</li>
					<li>Voir un listing de chaque entité  (Gpe. , Ass. , Ent., Cit. )</li>
					<li>Voir tout les evenements</li>
					<li>Filtrer par mots clefs</li>
					<li>Ouvrir une entité (Gpe. , Ass. , Ent., Cit. )</li>
					<li>Ouvrir un evenement</li>
				</ul>
				<h4  class="blocky">Communication</h4>
				<ul class="blocki">
					<li>Send a message to list of people</li>
				</ul>
			</li>
			<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<li><h3 class="blockp">User</h3></li>

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


			<li class="block"><a href="/ph/egpc/default/getPeople">Get EGPC People</a><br/>
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
			<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<li><h3 class="blockp">Entities</h3></li>

			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')">Form</a>
				<a href="/ph/egpc/default/saveGroup">Create/Update Entité (Asso. , Entr. , Group, Events )</a>

				<div class="fss">
					url : /ph/egpc/default/saveGroup<br/>
					method type : POST <br/>
					Form inputs : email,postalcode,pwd,phoneNumber(is optional)type<br/>
					return json object {"result":true || false}
				</div>
				<div class="apiForm createUser">
					name : <input type="text" name="namesaveGroup" id="namesaveGroup" value="Asso1" /><br/>
					email* : <input type="text" name="emailsaveGroup" id="emailsaveGroup" value="egpc@egpc.com" /> (personne physique responsable )<br/>
					cp* : <input type="text" name="postalcodesaveGroup" id="postalcodesaveGroup" value="97421" /><br/>
					phoneNumber : <input type="text" name="phoneNumbersaveGroup" id="phoneNumbersaveGroup" value="1234" />(for SMS)<br/>
					type : <select name="typesaveGroup" id="typesaveGroup" onchange="typeChanged()">
								<option value="association">Association</option>
								<option value="entreprise">Entreprise</option>
								<option value="group">Groupe de personne</option>
								<option value="event">Evenement</option>
							</select><br/>
					<span class="whensaveGroup">
					when : <input type="text" name="whensaveGroup" id="whensaveGroup" value="" /><br/>
					where : <input  type="text" name="wheresaveGroup" id="wheresaveGroup" value="" /><br/>
					</span>
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
							
							testitpost("saveGroupResult",'/ph/egpc/default/saveGroup',params);
						}
						function typeChanged(){
							console.log( $("#typesaveGroup").val() );
							if ($("#typesaveGroup").val() == "event") {
								$(".whensaveGroup").show();
							} else {
								$(".whensaveGroup").hide();
							}
						}
						initT['datepickerInit'] = function(){
							$("#whensaveGroup").datepicker();
							typeChanged();
						};
					</script>
				</div>

			</li>
			
			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')">Get</a>
				<a href="/ph/egpc/default/getGroup">Get une Entité by email </a><br/>
				<div class="fss">
					url : /ph/egpc/default/getGroup/email/egpc@egpc.com<br/>
					method type : GET <br/>
					param : email<br/>
					email : <input type="text" name="getGroupemail" id="getGroupemail" value="egpc@egpc.com" /><br/>
					<a href="javascript:getGroup()">Test it</a><br/>
					<a href="javascript:confirmUserRegistration()">Confirm User Registration</a><br/>
					<div id="getGroupResult" class="result fss"></div>
					<script>
						function getGroup(){
							testitget("getGroupResult",'/ph/egpc/default/getGroup/email/'+$("#getGroupemail").val());
						}
						function confirmUserRegistration(){
							testitget("getGroupResult",'/ph/egpc/default/confirmGroupRegistration/email/'+$("#getGroupemail").val());
						}
					</script>
				</div>
			
			</li>
			
			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')">Link Form</a>
				<a href="/ph/egpc/default/linkUser2Group">Lié un User a une Entité</a><br/>
				<div class="fss">
					url : /ph/egpc/default/linkUser2Group/email/egpc@egpc.com<br/>
					method type : POST <br/>
					param : <br/>
					all egpc groups  : 
					<select id="linkUser2GroupGroup">
						<option></option>
						<?php 
						$groups = Yii::app()->mongodb->group->find( array( "applications.egpc.usertype" => Group::TYPE_ASSOCIATION ));
						foreach ($groups as $value) {
							echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
						}
						?>
						
					</select><br/>
					email(s) : <textarea type="text" name="linkUser2Groupemail" id="linkUser2Groupemail">egpc@egpc.com</textarea><br/>
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
							testitpost("linkUser2GroupResult",'/ph/egpc/default/linkUser2Group',params);
						}
						function unlinkUser2Group(){
							params = { 
					    	   "email" : $("#linkUser2Groupemail").val() , 
					    	   "name" : $("#linkUser2GroupGroup").val() 
					    	   };
							testitpost("linkUser2GroupResult",'/ph/egpc/default/unlinkUser2Group',params);
						}
					</script>
				</div>
			</li>
			
			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')">Get</a>
				<a href="/ph/egpc/default/getGroups">Get all EGPC Entités</a><br/>
				<div class="fss">
					url : /ph/egpc/default/getGroups<br/>
					method type : GET <br/>
					<a href="javascript:getGroups()">Test it</a><br/>
					<div id="getGroupsResult" class="result fss"></div>
					<script>
						function getGroups(){
							testitget("getGroupsResult",'/ph/egpc/default/getGroups');
						}
					</script>
				</div>
			</li>
			
			<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<li><h3 class="blockp">Communcation</h3></li>
			<li class="block">
				<a href="/ph/egpc/default/sendMessage">Send a Message to people</a><br/>
				<div class="fss">
					url : /ph/egpc/default/sendMessage<br/>
					method type : POST <br/>
					params : <br/>
					message  : <textarea name="sendMessagemsg" id="sendMessagemsg"></textarea> <br/>
					email(s) : <textarea type="text" name="sendMessageemail" id="sendMessageemail">egpc@egpc.com</textarea><br/>
					séparé par des virgules<br/>
					<a href="javascript:sendMessage()">Send it</a><br/>
					<select id="sendMessagePeople">
						<option></option>
						<?php 
						$groups = Yii::app()->mongodb->group->find( array( "applications.egpc.usertype" => Group::TYPE_ASSOCIATION ));
						foreach ($groups as $value) {
							echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
						}
						?>
						
					</select>
					<a href="javascript:setPeople()">Get People </a><br/>
					<div id="sendMessageResult" class="result fss"></div>
					<script>
						function sendMessage(){
							params = { 
					    	   "email" : $("#sendMessageemail").val() , 
					    	   "msg" : $("#sendMessagemsg").val() 
					    	   };
							testitpost("sendMessageResult",'/ph/egpc/default/sendMessage',params);
						}
						function setPeople(){
							$("#sendMessageemail").val("");
							$.ajax({
							    url:'/ph/egpc/default/getPeople',
							    type:"POST",
							    data:{ "name":$("#sendMessagePeople").val()},
							    datatype : "json",
							    success:function(data) {
							    	list = "";
								    $.each(data,function(k,v){
								      	list += (list == "") ? v.email : ","+v.email ;
								    })
							      	console.log(list);
							      	$("#sendMessageemail").val(list);
								      	
							    },
							    error:function (xhr, ajaxOptions, thrownError){
							      $("#"+id).html(data);
							    } 
							  });
						}
					</script>
				</div>
			</li>
		</ul>
	</div>
</div>

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