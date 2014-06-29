<div class="fss">
	url : /ph/<?php echo $this::$moduleKey?>/api/getUser/email/t@azotlive.com<br/>
	method type : GET <br/>
	param : email<br/>
	email : <input type="text" name="getUseremail" id="getUseremail" value="t@azotlive.com" /><br/>
	<a href="javascript:getUser()">Test it</a><br/>
	<a href="javascript:confirmUserRegistration()">Confirm User Registration from Email </a><span style="color:red">(TODO add a key hash code)</span><br/>
	<div id="getUserResult" class="result fss"></div>
	<script>
		function getUser() { 
			testitget("getUserResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/getUser/email/'+$("#getUseremail").val());
		}
		function confirmUserRegistration() { 
			testitget("getUserResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/validateAccount/email/'+$("#getUseremail").val()+'/app/<?php echo $this::$moduleKey?>');
		}
	</script>
</div>