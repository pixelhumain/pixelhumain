<div class="fss">
	url : /ph/<?php echo $this::$moduleKey?>/api/getGroup/email/<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com<br/>
	method type : GET <br/>
	param : email<br/>
	email : <input type="text" name="getGroupemail" id="getGroupemail" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /><br/>
	<a href="javascript:getGroup()">Test it</a><br/>
	<a href="javascript:confirmGroupRegistration()">Confirm Group Registration</a><br/>
	<div id="getGroupResult" class="result fss"></div>
	<script>
		function getGroup(){
			testitpost("getGroupResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/getgroupsby',{"email":$("#getGroupemail").val()});
		}
		function confirmGroupRegistration(){
			testitget("getGroupResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/confirmGroupRegistration/email/'+$("#getGroupemail").val());
		}
	</script>
</div>

<div class="fss">
	url : /ph/<?php echo $this::$moduleKey?>/api/getgroupsby<br/>
	method type : POST <br/>
	fields : <input type="text" name="getgroupsbyFilter" id="getgroupsbyFilter" value="email" />(comma seperated)<br/>
	tags : <input type="text" name="getgroupsbyTags" id="getgroupsbyTags" value="social" />(comma seperated)<br/>
	<a href="javascript:getgroupsby()">Test it</a><br/>
	<div id="getgroupsbyResult" class="result fss"></div>
	<script>
		function getgroupsby(){
			fields = $("#getgroupsbyFilter").val(); 
			tags = $("#getgroupsbyTags").val(); 
			params = {"app":"<?php echo $this::$moduleKey?>"};
			if(fields) 
				params.fields = fields.split(",");
			if(tags){
				//params.tags = "social";
				params.tags = {'$or':[{'tags':"social"},{'tags':"recherche"}]};
			}
			testitpost("getgroupsbyResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/getgroupsby',params);
		}
	</script>
</div>