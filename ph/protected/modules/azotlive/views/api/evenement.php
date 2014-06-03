<ul>
	<li class="block">
		<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')" id="blocksaveGroup">Form</a>
		<a href="/ph/<?php echo $this::$moduleKey?>/api/saveGroup">Create/Update Events </a>

		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/saveGroup<br/>
			method type : POST <br/>
			Form inputs : email,postalcode,pwd,phoneNumber(is optional)type<br/>
			return json object {"result":true || false}
		</div>
		<div class="apiForm saveGroup">
			name : <input type="text" name="namesaveGroup" id="namesaveGroup" value="Event1" /><br/>
			email* : <input type="text" name="emailsaveGroup" id="emailsaveGroup" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /> <span style="color:red">(TODO : restriction userType : producteur,admin)</span>(personne physique responsable )<br/>
			cp* : <input type="text" name="postalcodesaveGroup" id="postalcodesaveGroup" value="97421" /><br/>
			phoneNumber : <input type="text" name="phoneNumbersaveGroup" id="phoneNumbersaveGroup" value="1234" />(for SMS)<br/>
			tags : <input type="text" name="tagssaveGroup" id="tagssaveGroup" value="" placeholder="ex:social,solidaire...etc"/><br/>
			type : <input type="text" name="typesaveGroup" id="typesaveGroup" value="event" disabled/><br/>
			
			when : <input type="text" name="whensaveGroup" id="whensaveGroup" value="" /><br/>
			where : <input  type="text" name="wheresaveGroup" id="wheresaveGroup" value="" /><span style="color:red">(TODO : list des emplacements)</span><br/>
			status : <select id="statussaveGroup">
						<option></option>
						<option value="vote">En Vote</option>
						<option value="purchase">En Vente</option>
					</select>
			participant : <input  type="text" name="whosaveGroup" id="whosaveGroup" value="5370b477f6b95c280a00390c" /><br/>
			
			<a href="javascript:saveGroup()">Test it</a><br/>
			<div id="saveGroupResult" class="result fss"></div>
			<script>
				function saveGroup(){
					params = { "email" : $("#emailsaveGroup").val() , 
					    	   "name" : $("#namesaveGroup").val() , 
					    	   "cp" : $("#postalcodesaveGroup").val() , 
					    	   "pwd" : $("#pwdsaveGroup").val(),
					    	   "type" : $("#typesaveGroup").val(),
					    	   "phoneNumber" : $("#phoneNumbersaveGroup").val(),
					    	   "tags" : $("#tagssaveGroup").val(),
					    	   "app":"<?php echo $this::$moduleKey?>",
					    	};
					if( $("#whensaveGroup").val() )
						params["when"] = $("#whensaveGroup").val();
					if( $("#wheresaveGroup").val() )
						params["where"] = $("#wheresaveGroup").val();
					if( $("#whosaveGroup").val() )
						params["group"] = $("#whosaveGroup").val();
					
					testitpost("saveGroupResult",'/ph/<?php echo $this::$moduleKey?>/api/saveGroup',params);
				}
				function typeChanged(){
					console.log( $("#typesaveGroup").val() );
					if ($("#typesaveGroup").val() == "event") {
						$(".whensaveGroup").show();
					} else {
						$(".whensaveGroup").hide();
					}
				}
				initT['datepickerInit'] = function(){
					$("#whensaveGroup").datepicker();
					typeChanged();
				};
			</script>
		</div>

	</li>
	
	
	<li class="block">
		<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')"  id="blocklinkUser2Group">Link Form</a>
		<a href="/ph/<?php echo $this::$moduleKey?>/api/linkUser2Group">Lié un User a un Event (Follow, or Going, votedFor) </a><br/>
		<div class="fss">
			
			url : /ph/<?php echo $this::$moduleKey?>/api/linkUser2Group/email/<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com<br/>
			method type : POST <br/>
			param : <br/>
			all <?php echo $this::$moduleKey?> groups  : 
			<select id="linkUser2GroupGroup">
				<option></option>
				<?php 
				$groups = Yii::app()->mongodb->groups->find( array( "applications.".$this::$moduleKey.".usertype" => Group::TYPE_EVENT ));
				foreach ($groups as $value) {
					echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
				}
				?>
				
			</select><br/>
			email(s) : <textarea type="text" name="linkUser2Groupemail" id="linkUser2Groupemail"><?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com</textarea><br/>
			séparé par des virgules<br/>
			<span style="color:red">(TODO : link as followers)</span>
			<a href="javascript:linkUser2Group()">Link it</a><br/>
			<a href="javascript:unlinkUser2Group()">Unlink it</a><br/>
			<div id="linkUser2GroupResult" class="result fss"></div>
			<script>
				function linkUser2Group(){
					params = { 
			    	   "email" : $("#linkUser2Groupemail").val() , 
			    	   "name" : $("#linkUser2GroupGroup").val() ,
			    	   "type":"<?php echo Group::TYPE_EVENT?>"
			    	   };
					testitpost("linkUser2GroupResult",'/ph/<?php echo $this::$moduleKey?>/api/linkUser2Group',params);
				}
				function unlinkUser2Group(){
					params = { 
			    	   "email" : $("#linkUser2Groupemail").val() , 
			    	   "name" : $("#linkUser2GroupGroup").val(),
			    	   "type":"<?php echo Group::TYPE_EVENT?>",
			    	   "unlink" : true,
			    	   };
					testitpost("linkUser2GroupResult",'/ph/<?php echo $this::$moduleKey?>/api/linkUser2Group',params);
				}
			</script>
		</div>
	</li>
	
	<li class="block">
		<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')" id="blockgetGroups">Get</a>
		<a href="/ph/<?php echo $this::$moduleKey?>/api/getgroupsby">Get all <?php echo $this::$moduleKey?> Events</a><br/>
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