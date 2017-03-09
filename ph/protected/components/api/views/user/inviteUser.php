<div class="fss">
	email : <input type="text" name="inviteUseremail" id="inviteUseremail" value="<?php echo $this->module->id?>@<?php echo $this->module->id?>.com" /><br/>
	<a class="btn" href="javascript:inviteUser()">Test it</a><br/>
	<br/><div id="inviteUserResult" class="result fss"></div>
	<script>
		function inviteUser(){
			params = { "email" : $("#inviteUseremail").val() };
			ajaxPost("inviteUserResult",baseUrl+'/<?php echo $this->module->id?>/api/inviteUser',params);
		}
		
	</script>
</div>