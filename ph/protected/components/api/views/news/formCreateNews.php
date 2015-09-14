
<?php SIG::clientScripts(); ?>



<div class="apiForm createNews">
				
<div style="width:300px; float:left;">
	title : <input type="text" name="titleSaveNews" id="titleSaveNews" value="<?php echo $this->module->id?> Title" /><br/>
	message : <textarea name="contentSaveNews" id="contentSaveNews" value="<?php echo $this->module->id?> Content" /></textarea><br/>
	tags : <input type="text" name="tagsSaveNews" id="tagsSaveNews" value="<?php echo $this->module->id?> Tags" /><br/>
	nature :
	<select id="natureSaveNews">
		<?php 
		$natures = array( "free_msg", "help", "idea", "proposition", "rumor", "true_information", "question" );
		foreach ($natures as $value) {
			echo '<option value="'.$value.'">'.$value.'</option>';
		}
		?>
		
	</select><br/>
</div>
<div style="width:600px; min-height:300px; float:left;">
	<input type="radio" class="radioScope" name="scope" value="cp">Postal Code<br>
	<input type="radio" class="radioScope" name="scope" value="departement">Departement<br>
	<input type="radio" class="radioScope" name="scope" value="groups">Groups<br>
	<input type="radio" class="radioScope" name="scope" value="geoArea">Geo Area<br>

	<select id="groupsListScope" style="visibility:hidden;">
		<?php
		      	$groups = Group::getGroupsBy(array ( "email" => Yii::app()->session["userEmail"] ));
        		foreach($groups as $group){
        			echo '<option value="'.$group["_id"].'">'.$group["name"]."</option>";
        		}
        		
		?>	
	</select>
	
	<div id="scopeLoader">
	</div>
	<div id="mapNewsCanvas" class="mapCanvas1"> </br>Chargement de la carte ... </div>
</div>	
	<a class="btn" href="javascript:showArea()">Show Area</a><br/>
	<a class="btn" href="javascript:saveNews()">Test it</a><br/>
	<br/><div id="createNewsResult" class="result fss"></div>
	<script>
		var mapCreateNews;
		var rectangleScope = null;
		
		var scopeType;
		
		function showArea(){
			if(rectangleScope == null)
			rectangleScope = loadRectangleArea(mapCreateNews);
			$("#mapNewsCanvas").css("visibility", "visible");
		}
		
		function showGroupsListScope(){
			$("#groupsListScope").css("visibility", "visible");
		}
		
		function saveNews(){
			
		var params = { "title" : $("#titleSaveNews").val() , 
			    	   "msg" : $("#contentSaveNews").val() , 
			    	   "tags" : $("#tagsSaveNews").val() ,
			    	   "nature":$("#natureSaveNews").val(),
			    	   "scopeType" : scopeType
			    	};
			    	
			if(scopeType == "geoArea"){
				var bounds = rectangleScope.getBounds();
				params["latMinScope"] = bounds.getSouthWest().lat;
				params["lngMinScope"] = bounds.getSouthWest().lng;
				params["latMaxScope"] = bounds.getNorthEast().lat;
				params["lngMaxScope"] = bounds.getNorthEast().lng;
			}
			
			if(scopeType == "cp")			{ params["cpScope"] = $("#cpScope").val(); }
			if(scopeType == "departement")	{ params["depScope"] = $("#depScope").val(); }
			if(scopeType == "groups")		{ params["groupScope"] = $("#groupsListScope").val(); }
			
			//alert(JSON.stringify(params));
			testitpost("createNewsResult",baseUrl+'/news/api/saveNews', params);
		}
		
		
		$('input[type=radio][name=scope]').change(function() {
			$("#scopeLoader").html("");
			
        	if (this.value == "cp") 		{ $("#scopeLoader").html("<input type='text' name='cpScope' id='cpScope' value='75000'>"); }
        	if (this.value == "groups") 	{ showGroupsListScope(); }
        	if (this.value == "departement"){ $("#scopeLoader").html("<input type='text' name='depScope' id='depScope' value='75'>"); }
        	if (this.value == "geoArea") 	{ showArea(); }
        	
        	if (this.value != "groups") { $("#groupsListScope").css("visibility", "hidden"); }
        	if (this.value != "geoArea") { $("#mapNewsCanvas").css("visibility", "hidden"); }
        	
        	scopeType = this.value;
        	
        });
        
        mapCreateNews = loadMap("mapNewsCanvas");
	</script>
</div>