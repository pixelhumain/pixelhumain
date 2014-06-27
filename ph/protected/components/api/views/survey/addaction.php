<div class="fss">
	url : /ph/<?php echo $this::$moduleKey?>/api/addaction<br/>
	method type : POST <br/>
	param : <br/>
	all <?php echo $this::$moduleKey?> entries : 
	<select id="addactionSurvey">
		<option></option>
		<?php 
			$Surveys = Yii::app()->mongodb->surveys->find( array("type"=>"entry") );
			foreach ($Surveys as $value) {
				echo '<option value="'.$value["_id"].'">'.$value["name"]." ".$value["_id"].'</option>';
			}
		?>
	</select><br/>
	action : <select id="actionSurvey">
		<option></option>
		<?php 
		$actions = array(
			ActionType::ACTION_VOTE_UP,
			ActionType::ACTION_VOTE_DOWN,
			ActionType::ACTION_VOTE_ABSTAIN,
			ActionType::ACTION_FOLLOW
			);
		foreach ($actions as $value) {
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
		?>
	</select><br/>
	email : <input type="text" name="addactionemail" id="addactionemail" value="magninpierre@wanadoo.fr"/><br/>
	<a href="javascript:addaction()">Add Action</a><br/>
	<a href="javascript:unaddaction()">Remove Action</a><br/>
	<a href="javascript:getIncByAction()">Get Element Increment Value</a><br/>
	<div id="addactionResult" class="result fss"></div>
	<script>
		function addaction(){
			params = { 
	    	   "email" : $("#addactionemail").val() , 
	    	   "id" : $("#addactionSurvey").val() ,
	    	   "collection":"surveys",
	    	   "action" : $("#actionSurvey").val() 
	    	   };
			testitpost("addactionResult",baseUrl+'/<?php echo $this::$moduleKey?>/api/addaction',params);
		}

		function unaddaction(){
			params = { 
	    	   "email" : $("#addactionemail").val() , 
	    	   "id" : $("#addactionSurvey").val(),
	    	   "collection":"surveys",
	    	   "unset" : true,
	    	   "action" : $("#actionSurvey").val() 
	    	   };
			testitpost("addactionResult",baseUrl+'/<?php echo $this::$moduleKey?>/api/addaction',params);
		}

		function getIncByAction(){
			params = { 
	    	   "id" : $("#addactionSurvey").val() ,
	    	   "collection":"surveys",
	    	   "fields" : [$("#actionSurvey").val()] 
	    	   };
			testitpost("addactionResult",baseUrl+'/<?php echo $this::$moduleKey?>/api/getactionvalue',params);
		}

	</script>
</div>