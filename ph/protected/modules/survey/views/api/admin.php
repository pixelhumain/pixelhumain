
<li class="block" id="blockModerationSettings">
	Moderation Settings
</li>
<li class="block" id="blockModerationSettings">
	Add as admi
</li>

<li class="block" id="blockModerate">
	Moderate
	<div class="apiForm moderateEntry">
			<select id="sessionmoderateEntry">
				<option></option>
				<?php 
					$Surveys = Yii::app()->mongodb->surveys->find( array("type"=>"entry",'$or'=>array( array( "applications.survey.cleared"=>false),array("applications.survey.cleared"=>"refused"))));
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
			Loggued in as admin ? <?php ?><br/>
			<a href="javascript:moderateEntry()">Moderate it</a><br/>
			<a href="javascript:getEntry()">Get it</a><br/>
			<div id="moderateEntryResult" class="result fss"></div>
			<script>
				function moderateEntry(){
					params = { "survey" : $("#sessionmoderateEntry").val() , 
								"action" : $("#moderateAction").val() , 
					    		"app" : "survey"};
					testitpost("moderateEntryResult",'/ph/<?php echo $this::$moduleKey?>/api/moderateentry',params);
				}
				function getEntry(){
					params = { "where" : { 
								   "email" : $("#emailmoderateEntry").val() , 
					    	   	   "name" : $("#namemoderateEntry").val() , 
						    	   "type" : "entry"
					    	   	},
					    	   	"collection":"surveys"
					    	};
					testitpost("moderateEntryResult",'/ph/<?php echo $this::$moduleKey?>/api/getby',params);
				}
			</script>
		</div>
</li>