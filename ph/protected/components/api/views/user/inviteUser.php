<div class="fss">
	url : /ph/<?php echo $this->module->id?>/api/inviteUser<br/>
	method type : POST <br/>
	param : email<br/>
	email : <input type="text" name="inviteUseremail" id="inviteUseremail" value="<?php echo $this->module->id?>@<?php echo $this->module->id?>.com" /><br/>
	<a href="javascript:inviteUser()">Test it</a><br/>
	<div id="inviteUserResult" class="result fss"></div>
	<script>
		function inviteUser(){
			params = { "email" : $("#inviteUseremail").val() };
			testitpost("inviteUserResult",baseUrl+'/<?php echo $this->module->id?>/api/inviteUser',params);
		}
		
	</script>
</div>