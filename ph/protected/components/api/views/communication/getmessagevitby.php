<div class="fss">
fields : <input type="text" name="getmessagevitbyFilter" id="getmessagevitbyFilter" value="comment" /><br/>
<a class="btn" href="javascript:getmessagevitby()">Test it</a><br/>
<div id="getmessagevitbyResult" class="result fss"></div>
<script>
	function getmessagevitby()
	{
		fields = $("#getmessagevitbyFilter").val(); 
		params = {"applications.<?php echo $this->module->id?>.usertype":"event","limit":30};
		if(fields) 
			params.fields = fields.split(",");
		ajaxPost("getmessagevitbyResult", baseUrl+'/<?php echo $this->module->id?>/api/getmessagevitby',params);
	}
</script> 
</div>