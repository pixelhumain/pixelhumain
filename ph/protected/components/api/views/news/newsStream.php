
<?php SIG::clientScripts(); ?>

<div class="apiForm createNews">
					
	<div id="mapCanvasNewsStream" class="mapCanvas1">
		<br/>Chargement de la carte ...
	</div>	
	
	<div style="width:300px; float:left;">
		<b>Tags</b> : <input type="text" name="tagsStreamNews" id="tagsSaveNews" value="<?php echo $this->module->id?> Tags" /><br/>
		<b>Nature :</b>
		<select id="natureStreamNews">
			<?php 
			$natures = array( "free_msg", "help", "idea", "proposition", "rumor", "true_information", "question" );
			foreach ($natures as $value) {
				echo '<option value="'.$value.'">'.$value.'</option>';
			}
			?>
		
		</select></br>
		
<!-- 	Activer / Désactiver la reception des messages postés pour CP ou DEPARTEMENT ?

		<input type="checkbox" class="radioScope" name="scopeNewsStream" id="chkBoxCp" value="cp" checked> Mon code postal<br>
		<input type="checkbox" class="radioScope" name="scopeNewsStream" id="chkBoxDep" value="departement" checked>Mon département<br>
		

 		<input type="checkbox" class="radioScope" name="scopeNewsStream" id="chkBoxGroups" value="groups" checked><b>Mes groupes :</b>	
		<select id="groupsListScopeNewsStream">
			<option value="all">Tous mes groupes</option>
			<?php
					$groups = Group::getGroupsBy(array ( "email" => Yii::app()->session["userEmail"] ));
					foreach($groups as $group){
						echo '<option value="'.$group["_id"].'">'.$group["name"]."</option>";
					}			
			?>	
		</select>
-->
		<div id="scopeLoaderNewsStream"></div>
		<input type="checkbox" class="radioScope" name="scopeNewsStream" id="chkBoxGeoArea" checked><b> Syncroniser avec la carte</b>
		
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
			
			var params = { 	"tags" : $("#tagsStreamNews").val() ,
			    	  	 	"nature":$("#natureStreamNews").val(),
			    	   		"scopeType" : scopeTypeNewsStream
			    		 };
			    	
			if($('#chkBoxGeoArea').is(':checked')){
				var bounds = mapClusters.getBounds();
				params["geoAreaScope"] = true;
				params["latMinScope"] = bounds.getSouthWest().lat;
				params["lngMinScope"] = bounds.getSouthWest().lng;
				params["latMaxScope"] = bounds.getNorthEast().lat;
				params["lngMaxScope"] = bounds.getNorthEast().lng;
			} else { params["geoAreaScope"] = false; }
			
			params["cpScope"] = $('#chkBoxCp').is(':checked');			
			params["depScope"] = $('#chkBoxDep').is(':checked');		
			//params["groupScope"] = $('#chkBoxGroups').is(':checked');	
			
			//if($('#chkBoxGroups').is(':checked')){
			//	params["idGroupScope"] = $("#groupsListScopeNewsStream").val();
			//}
			
			//alert(JSON.stringify(params)); return;
		    ajaxPost("newsStreamResult",baseUrl+'/<?php echo $this->module->id?>/api/getNewsStream/', params);
		}
		
        
        initStreamMap();
    
	</script>
</div>