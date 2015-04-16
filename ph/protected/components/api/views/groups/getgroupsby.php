<div class="fss">
	email : <input type="text" name="getGroupemail" id="getGroupemail" value="<?php echo $this->module->id?>@<?php echo $this->module->id?>.com" /><br/>
	<a class="btn" href="javascript:getGroup()">Test it</a><br/>
	<a class="btn" href="javascript:confirmGroupRegistration()">Confirm Group Registration</a><br/>
	<div id="getGroupResult" class="result fss"></div>
	<script>
		function getGroup(){
			ajaxPost("getGroupResult", baseUrl+'/<?php echo $this->module->id?>/api/getgroupsby',{"email":$("#getGroupemail").val()});
		}
		function confirmGroupRegistration(){
			ajaxGet("getGroupResult", baseUrl+'/<?php echo $this->module->id?>/api/confirmGroupRegistration/email/'+$("#getGroupemail").val());
		}
	</script>
</div>

<div class="fss">
	url : /ph/<?php echo $this->module->id?>/api/getgroupsby<br/>
	method type : POST <br/>
	fields : <input type="text" name="getgroupsbyFilter" id="getgroupsbyFilter" value="email" />(comma seperated)<br/>
	tags : <input type="text" name="getgroupsbyTags" id="getgroupsbyTags" value="social" />(comma seperated)<br/>
	<a class="btn" href="javascript:getgroupsby()">Test it</a><br/>
	<div id="getgroupsbyResult" class="result fss"></div>
	<script>
		function getgroupsby(){
			fields = $("#getgroupsbyFilter").val(); 
			tags = $("#getgroupsbyTags").val(); 
			params = {"app":"<?php echo $this->module->id?>"};
			if(fields) 
				params.fields = fields.split(",");
			if(tags){
				//params.tags = "social";
				params.tags = {'$or':[{'tags':"social"},{'tags':"recherche"}]};
			}
			ajaxPost("getgroupsbyResult", baseUrl+'/<?php echo $this->module->id?>/api/getgroupsby',params);
		}
	</script>
</div>