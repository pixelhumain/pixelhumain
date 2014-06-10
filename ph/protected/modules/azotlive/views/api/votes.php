	<ul>
	<li class="block">
		<a href="/ph/<?php echo $this::$moduleKey?>/api/addaction" id="blockaddaction">User Vote for Event  </a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/addaction<br/>
			method type : POST <br/>
			param : <br/>
			all <?php echo $this::$moduleKey?> groups  : 
			<select id="addactionGroup">
				<option></option>
				<?php 
				$groups = Yii::app()->mongodb->groups->find( array( "applications.".$this::$moduleKey.".usertype" => Group::TYPE_EVENT ));
				foreach ($groups as $value) {
					echo '<option value="'.$value["_id"].'">'.$value["name"]." ".$value["_id"].'</option>';
				}
				?>
			</select><br/>
			action : <select id="actionGroup">
				<option></option>
				<?php 
				$actions = array(
					ActionType::ACTION_VOTE_UP,
					ActionType::ACTION_VOTE_DOWN,
					ActionType::ACTION_VOTE_ABSTAIN,
					ActionType::ACTION_PURCHASE
					);
				foreach ($actions as $value) {
					echo '<option value="'.$value.'">'.$value.'</option>';
				}
				?>
			</select><br/>
			email : <input type="text" name="addactionemail" id="addactionemail" value="@azotlive.com"/><br/>
			<a href="javascript:addaction()">Add Action</a><br/>
			<a href="javascript:unaddaction()">Remove Action</a><br/>
			<a href="javascript:getIncByAction()">Get Element Increment Value</a><br/>
			<div id="addactionResult" class="result fss"></div>
			<script>
				function addaction(){
					params = { 
			    	   "email" : $("#addactionemail").val() , 
			    	   "id" : $("#addactionGroup").val() ,
			    	   "collection":"groups",
			    	   "action" : $("#actionGroup").val() 
			    	   };
					testitpost("addactionResult",'/ph/<?php echo $this::$moduleKey?>/api/addaction',params);
				}

				function unaddaction(){
					params = { 
			    	   "email" : $("#addactionemail").val() , 
			    	   "id" : $("#addactionGroup").val(),
			    	   "collection":"groups",
			    	   "unset" : true,
			    	   "action" : $("#actionGroup").val() 
			    	   };
					testitpost("addactionResult",'/ph/<?php echo $this::$moduleKey?>/api/addaction',params);
				}

				function getIncByAction(){
					params = { 
			    	   "id" : $("#addactionGroup").val() ,
			    	   "collection":"groups",
			    	   "fields" : [$("#actionGroup").val()] 
			    	   };
					testitpost("addactionResult",'/ph/<?php echo $this::$moduleKey?>/api/getactionvalue',params);
				}

			</script>
		</div>
	</li>


	</ul>