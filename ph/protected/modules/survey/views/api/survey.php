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
			scope* : cp ou quartier : <input type="text" name="postalcodesaveSession" id="postalcodesaveSession" value="97421" /><br/>
				
			<a href="javascript:saveSession()">Test it</a><br/>
			<a href="javascript:getSession()">Get it</a><br/>
			<div id="saveSessionResult" class="result fss"></div>
			<script>
				function saveSession(){
					params = { "email" : $("#emailsaveSession").val() , 
					    	   "name" : $("#namesaveSession").val() , 
					    	   "tags" : $("#tagssaveSession").val(),
					    	   "cp" : $("#postalcodesaveSession").val(),
					    	   "type" : "survey",
					    	   "app" : "survey" };
					testitpost("saveSessionResult",'/ph/<?php echo $this::$moduleKey?>/api/saveSession',params);
				}
				function getSession(){
					params = { "where" : { 
								   "email" : $("#emailsaveSession").val() , 
						    	   "name" : $("#namesaveSession").val() ,
						    	   "type" : "survey"
					    	   	},
					    	   	"collection":"surveys"
					    	};
					testitpost("saveSessionResult",'/ph/<?php echo $this::$moduleKey?>/api/getby',params);
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
					$Surveys = Yii::app()->mongodb->surveys->find( array("type"=>"survey") );
					foreach ($Surveys as $value) {
						echo '<option value="'.$value["_id"].'">'.$value["name"]." ".$value["_id"].'</option>';
					}
				?>
			</select><br/>
			name : <input type="text" name="nameaddEntry" id="nameaddEntry" value="test1" /><br/>
			message  : <textarea name="entryaddEntry" id="entryaddEntry">this is test</textarea> <br/>
			tags : <input type="text" name="tagsaddEntry" id="tagsaddEntry" value="" placeholder="ex:social,solidaire...etc"/><br/>
			admin email* : <input type="text" name="emailaddEntry" id="emailaddEntry" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /><br/>
			<a href="javascript:addEntry()">Test it</a><br/>
			<a href="javascript:getEntry()">Get it</a><br/>
			<div id="addEntryResult" class="result fss"></div>
			<script>
				function addEntry(){
					params = { "survey" : $("#sessionaddEntry").val() , 
							   "email" : $("#emailaddEntry").val() , 
					    	   "name" : $("#nameaddEntry").val() , 
					    	   "tags" : $("#tagsaddEntry").val() ,
					    	   "message":$("#entryaddEntry").val(),
					    	   "cp" : $("#postalcodesaveGroup").val() , 
					    	   "type" : "entry",
					    		"app" : "survey"};
					testitpost("addEntryResult",'/ph/<?php echo $this::$moduleKey?>/api/saveSession',params);
				}
				function getEntry(){
					params = { "where" : { 
								   "email" : $("#emailaddEntry").val() , 
					    	   	   "name" : $("#nameaddEntry").val() , 
						    	   "type" : "entry"
					    	   	},
					    	   	"collection":"surveys"
					    	};
					testitpost("addEntryResult",'/ph/<?php echo $this::$moduleKey?>/api/getby',params);
				}
			</script>
		</div>
	</li>

	<li class="block">
		<a href="javascript:;" class="btn btn-primary" onclick="openModal('SurveyCreerForm','data',null,'dynamicallyBuild')" id="blockgetby">Get</a>
		<a href="/ph/<?php echo $this::$moduleKey?>/api/getby">Get all <?php echo $this::$moduleKey?> Types</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/getby<br/>
			method type : POST <br/>
			type : <select id="getbyType">
				<option value="survey">Surveys</option>
				<option value="entry">Entries</option>
			</select><br/>
			fields : <input type="text" name="getbyFilter" id="getbyFilter" value="email" />(comma seperated)<br/>
			tags : <input type="text" name="getbyTags" id="getbyTags" value="social" />(comma seperated)<br/>
			<a href="javascript:getby()">Test it</a><br/>
			<div id="getbyResult" class="result fss"></div>
			<script>
				function getby(){
					fields = $("#getbyFilter").val(); 
					tags = $("#getbyTags").val(); 
					type = $("#getbyType").val(); 
					params = {"collection":"surveys","where":{}}; 
					params.fields = fields.split(",");
					if(tags){
						tagList = [];
						sep = ",";
						op = "$or"
						if(tags.indexOf("+")>0){
							sep = "+";
							op = "$and"
						}
						$.each(tags.split(sep), function(i,v){7
							tagList.push({'tags':v});
						});
						params.where[op] = tagList;
						params.where["$and"] = [{"type":type}];
					}
					testitpost("getbyResult",'/ph/<?php echo $this::$moduleKey?>/api/getby',params);
				}
			</script>
		</div>
	</li>

	<li class="block">
		<a href="/ph/<?php echo $this::$moduleKey?>/api/addaction" id="blockaddaction">User Vote on Survey Entry  </a><br/>
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
					Action::ACTION_VOTE_UP,
					Action::ACTION_VOTE_DOWN,
					Action::ACTION_VOTE_ABSTAIN,
					Action::ACTION_FOLLOW
					);
				foreach ($actions as $value) {
					echo '<option value="'.$value.'">'.$value.'</option>';
				}
				?>
			</select><br/>
			email : <input type="text" name="addactionemail" id="addactionemail" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com"/><br/>
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
					testitpost("addactionResult",'/ph/<?php echo $this::$moduleKey?>/api/addaction',params);
				}

				function unaddaction(){
					params = { 
			    	   "email" : $("#addactionemail").val() , 
			    	   "id" : $("#addactionSurvey").val(),
			    	   "collection":"surveys",
			    	   "unset" : true,
			    	   "action" : $("#actionSurvey").val() 
			    	   };
					testitpost("addactionResult",'/ph/<?php echo $this::$moduleKey?>/api/addaction',params);
				}

				function getIncByAction(){
					params = { 
			    	   "id" : $("#addactionSurvey").val() ,
			    	   "collection":"surveys",
			    	   "fields" : [$("#actionSurvey").val()] 
			    	   };
					testitpost("addactionResult",'/ph/<?php echo $this::$moduleKey?>/api/getactionvalue',params);
				}

			</script>
		</div>
	</li>


	</ul>