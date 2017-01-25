<div class="fss">
	email : <input type="text" name="getUseremail" id="getUseremail" value="<?php echo $this->module->id?>@<?php echo $this->module->id?>.com" /><br/>
	<a class="btn" href="javascript:getUser()">Test it</a><br/>
	<br/><div id="getUserResult" class="result fss"></div>
	<script>
		function getUser(){
			ajaxGet("getUserResult",baseUrl+'/<?php echo $this->module->id?>/api/getUser/email/'+$("#getUseremail").val());
		}
		
	</script>
</div>