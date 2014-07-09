<div class="apiForm deleteSurvey">
	<select id="sessiondeleteSurvey">
		<option></option>
		<?php 
			$surveys = PHDB::find( PHType::TYPE_SURVEYS, array("type"=>Survey::TYPE_SURVEY));
			foreach ($surveys as $value) {
				echo '<option value="'.$value["_id"].'">'.$value["name"]." ".'</option>';
			}
		?>
	</select><br/>
	<a class="btn" href="javascript:deleteSurvey()">Test it</a><br/>
	<div id="deleteSurveyResult" class="result fss"></div>
	<script>
		function deleteSurvey() {
			params = { "survey" : $("#sessiondeleteSurvey").val() , 
			    		"app" : "<?php echo $this->module->id?>"};
			testitpost("deleteSurveyResult",baseUrl+'/<?php echo $this->module->id?>/api/deletesurvey',params);
		}
	</script>
</div>