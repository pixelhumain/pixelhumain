<style>
	.apiList ul{list-style: none;}
	.apiList .block{ 
		border:1px solid #333; 
		background-color: beige; 
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
		<h2>List of all available API's</h2>
		<ul>
			
			<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<li><h3>User</h3></li>

			<li class="block">
				<a href="/ph/ext/watcher/login">Login</a><br/>
				<div class="fss">
					url : /ph/ext/watcher/login<br/>
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
							    url:'/ph/ext/watcher/login',
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

			<li class="block"><a href="/ph/ext/watcher/saveUser">Create/Update user</a><br/>
				<div class="fss">
					url : /ph/ext/watcher/saveUser<br/>
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
					<a href="javascript:addUser()">Test it</a><br/>
					<div id="createUserResult" class="result fss"></div>
					<script>
						function addUser(){
							$("#getUserResult").html("");
							$.ajax({
							    url:'/ph/ext/watcher/saveUser',
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
			
			<li class="block"><a href="/ph/ext/watcher/getUser/email/oceatoon@gmail.com">Get User</a><br/>
				<div class="fss">
					url : /ph/ext/watcher/getUser/email/oceatoon@gmail.com<br/>
					method type : GET <br/>
					param : email<br/>
					email : <input type="text" name="getUseremail" id="getUseremail" value="oceatoon@gmail.com" /><br/>
					<a href="javascript:getUser()">Test it</a><br/>
					<div id="getUserResult" class="result fss"></div>
					<script>
						function getUser(){
							$("#getUserResult").html("");
							$.ajax({
							    url:'/ph/ext/watcher/getUser/email/'+$("#getUseremail").val(),
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

			<li><h3>Observations</h3></li>
			
			<li class="block"><a href="/ph/ext/watcher/observations/type/sharkObservationReunion">Latest observations</a><br/>
				<div class="fss">
					url : /ph/ext/watcher/observations/type/sharkObservationReunion<br/>
					method : GET <br/>
					param : type<br/>
					type : <input type="text" name="typeObservations" id="typeObservations" value="sharkObservationReunion" /><br/>
					<a href="javascript:observations()">Test it</a><br/>
					<div id="observationsResult" class="result fss"></div>
					<script>
						function observations(){
							$("#observationsResult").html("");
							$.ajax({
							    url:'/ph/ext/watcher/observations/type/'+$("#typeObservations").val(),
							    type:"GET",
							    success:function(data) {
							      $("#observationsResult").html(JSON.stringify(data, null, 4));
							    },
							    error:function (xhr, ajaxOptions, thrownError){
							      $("#observationsResult").html(data);
							    } 
							  });
						}
					</script>
				</div>
			</li>
			
			<li class="block"><a href="/ph/ext/watcher/getObservation/id/xxx">Get an observation</a><br/>
				<div class="fss">
					url : /ph/ext/watcher/getObservation/id/xxx<br/>
					method type : GET <br/>
					id : <input type="text" name="getObservationid" id="getObservationid" value="534fad666803fa564e96277a" /><br/>
					<a href="javascript:getObservation()">Test it</a><br/>
					<div id="getObservationResult" class="result fss"></div>
					<script>
						function getObservation(){
							$("#getObservationResult").html("");
							$.ajax({
							    url:'/ph/ext/watcher/getObservation/id/'+$("#getObservationid").val(),
							    type:"GET",
							    success:function(data) {
							      $("#getObservationResult").html(JSON.stringify(data, null, 4));
							    },
							    error:function (xhr, ajaxOptions, thrownError){
							      $("#getObservationResult").html(data);
							    } 
							  });
						}
					</script>
				</div>
			</li>

			<li class="block"><a href="/ph/ext/watcher/myObservation/id/">My observations</a><br/>
				<div class="fss">
					url : /ph/ext/watcher/myObservation/id/xxx<br/>
					method type : GET <br/>
					id : <input type="text" name="myObservationid" id="myObservationid" value="520931e2f6b95c5cd3003d6c" /><br/>
					<a href="javascript:myObservation()">Test it</a><br/>
					<div id="myObservationResult" class="result fss"></div>
					<script>
						function myObservation(){
							$("#myObservationResult").html("");
							$.ajax({
							    url:'/ph/ext/watcher/myObservation/id/'+$("#myObservationid").val(),
							    type:"GET",
							    success:function(data) {
							      $("#myObservationResult").html(JSON.stringify(data, null, 4));
							    },
							    error:function (xhr, ajaxOptions, thrownError){
							      $("#myObservationResult").html(data);
							    } 
							  });
						}
					</script>
				</div>
			</li>
			
			<li class="block"><a href="/ph/ext/watcher/addObservation">Add an observations</a><br/>
				<div class="fss">
					url : /ph/ext/watcher/addObservation<br/>
					method type : POST <br/>
				</div>
				<div class="apiForm addObservation">
					type : <input type="text" name="typeaddObservation" id="typeaddObservation" value="sharkObservationReunion" /><br/>
					who : <input type="text" name="whoaddObservation" id="whoaddObservation" value="520931e2f6b95c5cd3003d6c" /><br/>
					when : <input type="text" name="addObservationwhen" id="addObservationwhen" value="" /><br/>
					where : <select name="addObservationwhere" id="addObservationwhere">
						<?php 
						$where = Yii::app()->mongodb->lists->findOne( array( "name" => "surfSpotReunion" ),array("list") ) ;
						foreach ($where["list"] as $key => $value) {
							echo '<option value="'.$key.'">'.$value.'</option>';
						}
						?>
					</select><br/>
					what : <select name="addObservationwhat" id="addObservationwhat">
						<?php 
						$what = Yii::app()->mongodb->lists->findOne( array( "name" => "typeObservationReunion" ),array("list") ) ;
						foreach ($what["list"] as $key => $value) {
							echo '<option value="'.$key.'">'.$value.'</option>';
						}
						?>
					</select><br/>
					description : <input type="text" name="addObservationdescription" id="addObservationdescription" value="" />(180 caracters)<br/>
					<a href="javascript:addObservation()">Test it</a><br/>
					<div id="addObservationResult" class="result fss"></div>
					<script>
						initT['datepickerInit'] = function(){
							$("#addObservationwhen").datepicker();
						};
						function addObservation(){
							$("#observationsResult").html("");
							$.ajax({
							    url:'/ph/ext/watcher/addObservation',
							    type:"POST",
							    data:{ "type" : $("#typeaddObservation").val() , 
							    	   "who" : $("#whoaddObservation").val() , 
							    	   "when" : $("#addObservationwhen").val() , 
							    	   "where" : $("#addObservationwhere").val(),
							    	   "what" : $("#addObservationwhat").val(),
							    	   "description" : $("#addObservationdescription").val()
							    	},
							    success:function(data) {
							      $("#addObservationResult").html(JSON.stringify(data, null, 4));
							    },
							    error:function (xhr, ajaxOptions, thrownError){
							      $("#addObservationResult").html(thrownError);
							    } 
							  });
						}
					</script>
				</div>
			</li>

			<li class="block"><a href="/ph/ext/watcher/getObservationForm/key/sharkObservationReunion">get observations Context = anything needed for the form</a><br/>
				<div class="fss">
					url : /ph/ext/watcher/getObservationForm/key/sharkObservationReunion<br/>
					method type : GET <br/>
					key : <input type="text" name="typeObservations" id="typeObservations" value="sharkObservationReunion" /><br/>
					<a href="javascript:getObservationForm()">Test it</a><br/>
					<div id="getObservationFormResult" class="result fss"></div>
					<script>
						function getObservationForm(){
							$("#getObservationFormResult").html("");
							$.ajax({
							    url:'/ph/ext/watcher/getObservationForm/key/'+$("#typeaddObservation").val(),
							    type:"GET",
							    success:function(data) {
							      $("#getObservationFormResult").html( JSON.stringify(data, null, 4) );
							    },
							    error:function (xhr, ajaxOptions, thrownError){
							      $("#getObservationFormResult").html(thrownError);
							    } 
							  });
						}
					</script>
				</div>
			</li>

			<!-- ////////////////////////////////////////////////////////////////////////////// -->


			<li><h3>Tools</h3></li>
			
			<li class="block"><a href="/ph/ext/watcher/getClosestLocation/type/surfspots974/lat/xxx/lon/xxx">Closest Where Location </a><br/>
				<div class="fss">
					url : /ph/ext/watcher/getClosestLocation/type/surfspots974/lat/xxx/lon/xxx<br/>
					method type : GET <br/>
					param : type,lat,lon<br/>
					return json object { location : xxx}
					<a href="javascript:getClosestLocation()">Test it</a><br/>
					<div id="getClosestLocationResult" class="result fss"></div>
				</div>
			</li>
		</ul>
	</div>
</div>