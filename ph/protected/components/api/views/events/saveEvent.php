<?php /*
<div class="apiForm createUser">
	what : <input type="text" name="namesaveEvent" id="namesaveEvent" value="<?php echo $this->module->id?> User" /><br/>
	who email* : <input type="text" name="emailsaveEvent" id="emailsaveEvent" value="<?php echo $this->module->id?>@<?php echo $this->module->id?>.com" /><br/>
	cp* : <input type="text" name="postalcodesaveEvent" id="postalcodesaveEvent" value="97421" /><br/>
	when* : <input type="text" name="pwdsaveEvent" id="pwdsaveEvent" value="1234" /><br/>
	
	<a class="btn" href="javascript:saveEvent()">Test it</a><br/>
	<div id="createUserResult" class="result fss"></div>
	<script>
		function saveEvent(){
			params = { "email" : $("#emailsaveEvent").val() , 
			    	   "name" : $("#namesaveEvent").val() , 
			    	   "cp" : $("#postalcodesaveEvent").val() ,
			    	   "pwd":$("#pwdsaveEvent").val() ,
			    	   "phoneNumber" : $("#phoneNumbersaveEvent").val(),
			    		"app" : "<?php echo $this->module->id?>"};
			ajaxPost("createUserResult",baseUrl+'/<?php echo $this->module->id?>/api/saveEvent',params);
		}
	</script>
</div>
*/?>
TODO