<div class="fss">
	email : <input type="text" name="getUseremail" id="getUseremail" value="t@azotlive.com" /><br/>
	<a class="btn" href="javascript:getUser()">Test it</a><br/>
	<a class="btn" href="javascript:confirmUserRegistration()">Confirm User Registration from Email </a><span style="color:red">(TODO add a key hash code)</span><br/>
	<br/><div id="getUserResult" class="result fss"></div>
	<script>
		function getUser() { 
			testitget("getUserResult", baseUrl+'/<?php echo $this->module->id?>/api/getUser/email/'+$("#getUseremail").val());
		}
		function confirmUserRegistration() { 
			testitget("getUserResult", baseUrl+'/<?php echo $this->module->id?>/api/validateAccount/email/'+$("#getUseremail").val()+'/app/<?php echo $this->module->id?>');
		}
	</script>
</div>