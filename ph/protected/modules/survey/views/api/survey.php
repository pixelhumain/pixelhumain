	<ul>

	<li class="block"><a href="/ph/<?php echo $this::$moduleKey?>/api/saveSession"  id="blocksaveSession">Create/Update Survey Session</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/saveSession<br/>
			method type : POST <br/>
			Form inputs : email,postalcode,pwd,phoneNumber(is optional)<br/>
			return json object {"result":true || false}
		</div>
		<div class="apiForm saveSession">
			name : <input type="text" name="namesaveSession" id="namesaveSession" value="<?php echo $this::$moduleKey?>1" /><br/>
			admin email* : <input type="text" name="emailsaveSession" id="emailsaveSession" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /><br/>
			tags : <input type="text" name="tagssaveSession" id="tagssaveSession" value="lois,anonymat,vote" placeholder="ex:social,solidaire...etc"/><br/>
			scope* : <span style="color:red">(TODO : a session can be link to a zone, group...etc)</span><br>
				
			<a href="javascript:saveSession()">Test it</a><br/>
			<div id="createUserResult" class="result fss"></div>
			<script>
				function saveSession(){
					params = { "email" : $("#emailsaveSession").val() , 
					    	   "name" : $("#namesaveSession").val() , 
					    	   "tags" : $("#tagssaveSession").val() };
					testitpost("createUserResult",'/ph/<?php echo $this::$moduleKey?>/api/saveSession',params);
				}
			</script>
		</div>
	</li>

	<li class="block"><a href="/ph/<?php echo $this::$moduleKey?>/api/addEntry"  id="blockaddEntry">add an Entry to a Survey Session</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/addEntry<br/>
			method type : POST <br/>
			Form inputs : email,postalcode,pwd,phoneNumber(is optional)<br/>
			return json object {"result":true || false}
		</div>
		<div class="apiForm addEntry">
			<select id="sessionaddEntry">
				<option></option>
				<?php 
					$groups = Yii::app()->mongodb->surveys->find( );
					foreach ($groups as $value) {
						echo '<option value="'.$value["_id"].'">'.$value["name"]." ".$value["_id"].'</option>';
					}
				?>
			</select><br/>
			title : <input type="text" name="titleaddEntry" id="titleaddEntry" value="" /><br/>
			message  : <textarea name="entryaddEntry" id="entryaddEntry"></textarea> <br/>
			tags : <input type="text" name="tagsaddEntry" id="tagsaddEntry" value="" placeholder="ex:social,solidaire...etc"/><br/>
			admin email* : <input type="text" name="emailaddEntry" id="emailaddEntry" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /><br/>
			<a href="javascript:addEntry()">Test it</a><br/>
			<div id="createUserResult" class="result fss"></div>
			<script>
				function addEntry(){
					params = { "email" : $("#emailaddEntry").val() , 
					    	   "name" : $("#nameaddEntry").val() , 
					    	   "cp" : $("#postalcodeaddEntry").val() ,
					    	   "pwd":$("#pwdaddEntry").val() ,
					    	   "phoneNumber" : $("#phoneNumberaddEntry").val()};
					testitpost("createUserResult",'/ph/<?php echo $this::$moduleKey?>/api/addEntry',params);
				}
			</script>
		</div>
	</li>

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
					"voteUp",
					"voteDown",
					"voteAbstain",
					"voteBlock",
					"purchase"
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