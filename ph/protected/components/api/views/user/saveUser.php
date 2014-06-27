<a href="/ph/<?php echo $this->module->id?>/api/saveUser">Create/Update user</a><br/>
<div class="fss">
	url : /ph/<?php echo $this->module->id?>/api/saveUser<br/>
	method type : POST <br/>
	Form inputs : email,postalcode,pwd,phoneNumber(is optional)<br/>
	return json object {"result":true || false}
</div>
<div class="apiForm createUser">
	name : <input type="text" name="nameSaveUser" id="nameSaveUser" value="<?php echo $this->module->id?> User" /><br/>
	email* : <input type="text" name="emailSaveUser" id="emailSaveUser" value="<?php echo $this->module->id?>@<?php echo $this->module->id?>.com" /><br/>
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
			    	   "phoneNumber" : $("#phoneNumberSaveUser").val(),
			    		"app" : "<?php echo $this->module->id?>"};
			testitpost("createUserResult",baseUrl+'/<?php echo $this->module->id?>/api/saveUser',params);
		}
	</script>
</div>