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
					echo '<option value="'.$value["_id"].'">'.$value["name"].$value["_id"].'</option>';
				}
				?>
			</select><br/>
			action : <select id="actionGroup">
				<option></option>
				<?php 
				$actions = array(
					"voteUp",
					"voteDown",
					"voteAbstain",
					"voteBlock"
					);
				foreach ($actions as $value) {
					echo '<option value="'.$value.'">'.$value.'</option>';
				}
				?>
			</select><br/>
			email : <input type="text" name="addactionemail" id="addactionemail" value="@azotlive.com"/><br/>
			<span style="color:red">(TODO : link as followers)</span><br/>

			<a href="javascript:addaction()">Add Action</a><br/>
			<a href="javascript:unaddaction()">Remove Action</a><br/>
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
			</script>
		</div>
	</li>

	<li class="block">
		<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')" id="blockgetGroups">Get</a>
		<a href="/ph/<?php echo $this::$moduleKey?>/api/getgroupsby">Get Votes By</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/getgroupsby<br/>
			method type : POST <br/>
			fields : <input type="text" name="getgroupsbyFilter" id="getgroupsbyFilter" value="name" />(comma seperated)<br/>
			tags : <input type="text" name="getgroupsbyTags" id="getgroupsbyTags" value="reggae" />(comma seperated)<br/>
			TODO : events I follow<br/>
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
						tagList = []
						$.each(tags.split(","),function(i,v){
							tagList.push({'tags':v});
						});
						params.tags = {'$or':tagList};
					}
					testitpost("getgroupsbyResult",'/ph/<?php echo $this::$moduleKey?>/api/getgroupsby',params);
				}
			</script>
		</div>
	</li>

	</ul>