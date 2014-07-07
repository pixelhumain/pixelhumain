<div class="apiForm moderateEntry">
	<select id="sessionmoderateEntry">
		<option></option>
		<?php 
			$Surveys = PHDB::find( PHType::TYPE_SURVEYS, array("type"=>"entry",'$or'=>array( array( "applications.survey.cleared"=>false),array("applications.survey.cleared"=>"refused"))));
			foreach ($Surveys as $value) {
				echo '<option value="'.$value["_id"].'">'.$value["name"]." ".'</option>';
			}
		?>
	</select><br/>
	<select id="moderateAction">
		<option></option>
		<option value=1>accept</option>
		<option value=0>refuse</option>
	</select><br/>
	<a href="javascript:moderateEntry()">Moderate it</a><br/>
	<a href="javascript:getEntry()">Get it</a><br/>
	<div id="moderateEntryResult" class="result fss"></div>
	<script>
		function moderateEntry(){
			params = { "survey" : $("#sessionmoderateEntry").val() , 
						"action" : $("#moderateAction").val() , 
			    		"app" : "<?php echo $this->module->id?>"};
			testitpost("moderateEntryResult",baseUrl+'/<?php echo $this->module->id?>/api/moderateentry',params);
		}
		function getEntry(){
			params = { "where" : { 
						   "email" : $("#emailmoderateEntry").val() , 
			    	   	   "name" : $("#namemoderateEntry").val() , 
				    	   "type" : "entry"
			    	   	},
			    	   	"collection":"surveys"
			    	};
			testitpost("moderateEntryResult",baseUrl+'/<?php echo $this->module->id?>/api/getby',params);
		}
	</script>
</div>