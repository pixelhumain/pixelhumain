<div class="apiForm deleteEntry">
	<select id="sessiondeleteEntry">
		<option></option>
		<?php 
			$surveys = PHDB::find( PHType::TYPE_SURVEYS, array("type"=>Survey::TYPE_ENTRY));
			foreach ($surveys as $value) {
				echo '<option value="'.$value["_id"].'">'.$value["name"].' - '.$value["survey"].'</option>';
			}
		?>
	</select><br/>
	<a class="btn" href="javascript:deleteEntry()">Test it</a><br/>
	<div id="deleteEntryResult" class="result fss"></div>
	<script>
		function deleteEntry() {
			params = { "survey" : $("#sessiondeleteEntry").val() , 
			    		"app" : "<?php echo $this->module->id?>"};
			ajaxPost("deleteEntryResult",baseUrl+'/<?php echo $this->module->id?>/api/deletesurvey',params);
		}
	</script>
</div>