
<div class="apiForm createNews">
					
	<div id="mapCanvasNewsStream" class="mapCanvas1">
		<br/>Chargement de la carte ...
	</div>	
	
	<div style="width:300px; float:left;">
		<b>tags</b> : <input type="text" name="tagsSaveNews" id="tagsSaveNews" value="<?php echo $this->module->id?> Tags" /><br/>
		<b>nature :</b>
		<select id="natureSaveNews">
			<?php 
			$natures = array( "free_msg", "help", "idea", "proposition", "rumor", "true_information", "question" );
			foreach ($natures as $value) {
				echo '<option value="'.$value.'">'.$value.'</option>';
			}
			?>
		
		</select>
	</div>

	<div style="float:left;"><b>Scope :</b><br>
		<input type="radio" class="radioScope" name="scopeNewsStream" value="cp">Postal Code<br>
		<input type="radio" class="radioScope" name="scopeNewsStream" value="departement">Departement<br>
		<input type="radio" class="radioScope" name="scopeNewsStream" value="groups">Groups<br>
		<input type="radio" class="radioScope" name="scopeNewsStream" value="geoArea">Geo Area<br>

		<select id="groupsListScopeNewsStream" style="visibility:hidden;">
			<?php
					$groups = Group::getGroupsBy(array ( "email" => Yii::app()->session["userEmail"] ));
					foreach($groups as $group){
						echo '<option value="'.$group["_id"].'">'.$group["name"]."</option>";
					}			
			?>	
		</select>
	
		<div id="scopeLoaderNewsStream">
		</div>
	</div>
			
	<a class="btn" href="javascript:initStreamMap()">Init Stream Map</a> 
	<a class="btn" href="javascript:showNewsStream()">Show Stream</a><br/>
	<br/><div id="newsStreamResult"  style="float:left;" class="result fss"></div>
	<script>
	
		var scopeTypeNewsStream;
		
		function initStreamMap(){
        	initClusterMap("mapCanvasNewsStream");
        	showCitoyensClusters();
        }
        
		function showNewsStream(){
			
		var params = { "tags" : $("#tagsSaveNews").val() ,
			    	   "nature":$("#natureSaveNews").val(),
			    	   "scopeType" : scopeTypeNewsStream
			    	};
			    	
			if(scopeTypeNewsStream == "geoArea"){
				var bounds = mapClusters.getBounds();
				params["latMinScope"] = bounds.getSouthWest().lat;
				params["lngMinScope"] = bounds.getSouthWest().lng;
				params["latMaxScope"] = bounds.getNorthEast().lat;
				params["lngMaxScope"] = bounds.getNorthEast().lng;
			}
			if(scopeTypeNewsStream == "cp")			{ params["cpScope"] = $("#cpScopeNewsStream").val(); }
			if(scopeTypeNewsStream == "departement"){ params["depScope"] = $("#depScopeNewsStream").val(); }
			if(scopeTypeNewsStream == "groups")		{ params["groupScope"] = $("#groupsListScopeNewsStream").val(); }
			
			//alert(JSON.stringify(params)); return;
		
			testitpost("newsStreamResult",baseUrl+'/<?php echo $this->module->id?>/api/getNewsStream/', params);//, 
			/*			function (data){ //alert(data);
							var listItemMap = "";
						 	$.each(data, function() {
						 	alert(JSON.stringify(data));
								/*if(this['geo'] != null){
				 					var content = "";
				 					if(this['name'] != null)  content += 	"<b>" + this['name'] + "</b><br/>";
				 					if(this['email'] != null)  content += 	this['email'] + "<br/>";
				 					if(this['cp'] != null)     content += 	this['cp'] + "<br/>";
				 					if(this['phoneNumber'] != null)     content += 	this['phoneNumber'] + "<br/>";
				 					if(this['geo'] != null)     content += 	this['geo']['latitude'] + " - " + this['geo']['longitude'] + "<br/>";
				 					
				 					var properties = { 	title : this['name'], 
				 										icon : getIcoMarker("citoyens"),
				 										content: content };
				 					
				 					var marker = getGeoJsonMarker(properties, new Array(this['geo']['longitude'], this['geo']['latitude']));
				 					geoJsonCollection['features'].push(marker);	
				 					
				 					//crée la liste à afficher à droite de la carte
				 					listItemMap += "<div class='itemMapList'>" + this['name'] + "</div>";	 								 					
				 				}
				 				* /
							});
							
											
						});*/
		}
        $('input[type=radio][name=scopeNewsStream]').change(function() {
			$("#scopeLoader").html("");
			
        	if (this.value == "groups") { $("#groupsListScopeNewsStream").css("visibility", "visible"); }
        	else  						{ $("#groupsListScopeNewsStream").css("visibility", "hidden"); }
        	scopeTypeNewsStream = this.value;  	
        });
        
        
    
	</script>
</div>