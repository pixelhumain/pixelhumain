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
			<li ><h3 class="blockp">Scenario</h3></li>
			<li>
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
							    	   "phoneNumber" : $("#phoneNumberSaveUser").val()},
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
			
			<li class="block"><a href="/ph/egpc/default/getUser/email/oceatoon@gmail.com"  id="blockGetUser">Get User</a><br/>
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

			<li class="block"><a href="/ph/egpc/default/getPeople">Get EGPC People</a><br/>
			</li>
			<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<li><h3 class="blockp">Entities</h3></li>

			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')">Form</a>
				<a href="/ph/egpc/default/saveAssociation">Create/Update Entité (Asso. , Entr. , Group )</a>
			</li>
			
			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')">Get</a>
				<a href="/ph/egpc/default/getAssociation">Get une Entité</a><br/>
			</li>
			
			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')">Link Form</a>
				<a href="/ph/egpc/default/linkUserAssociation">Lié un User a une Entité</a><br/>
			</li>
			
			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')">Get</a>
				<a href="/ph/egpc/default/getEntities">Get all EGPC Entités</a><br/>
			</li>
			<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<li><h3 class="blockp">Evenement</h3></li>

			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')">Get</a>
				<a href="/ph/egpc/default/getEvents">Liste des evenements (tag filtrable) </a><br/>
			</li>

			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('eventForm','data',null,'dynamicallyBuild')">Form</a>
				<a href="/ph/egpc/default/saveEvent">Create/Update evenement</a><br/>
			</li>

			<li class="block">
				<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')">Get</a>
				<a href="/ph/egpc/default/getEvent">Get un evenement</a><br/>
			</li>

		</ul>
	</div>
</div>