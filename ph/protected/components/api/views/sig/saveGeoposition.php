
<?php SIG::clientScripts(); ?>

<div class="fss">
	!! >> UTILISER UN _id EXISTANT EN BDD >> javascript:initSaveNewPos('citoyens', =>_id : '53c55520c0461fd7030496b3')<br>
	Si l'élément possède un CP => localisation à partir du CP + modification manuelle<br>
	Sinon, localisation impossible
</div>

<div class="apiForm createUser">
	<div id="mapCanvasNewPos"class="mapCanvas1"> </br>Chargement de la carte ... </div>	
	<a class="btn" href="javascript:initSaveNewPos('citoyens' , '538c56dfc0461f5a307a5dff')">Initialiser la carte</a><br/>
	<a class="btn" href="javascript:saveGeoposition('citoyens', '538c56dfc0461f5a307a5dff')">Valider la position de l'élément</a><br/>
	
	<div id="savePosGroupsResult" class="result fss"></div>

	<script>
	var mapNewPos;
	var markerNewPos;
	var object = false;
	function initSaveNewPos(typePH, object_id, map = null){ //object = json
		if(map == null) map = mapNewPos;
		$('#mapCanvasSavePosLoader').html('<div id="mapCanvasNewPos" class="mapCanvas1"> </br>Chargement de la carte ... </div>');
	
		//récupère l'objet demandé
		testitget("savePosGroupsResult", baseUrl+'/sig/api/getCpObject/typePH/'+typePH+'/object_id/'+object_id, 	
				function (object){
					if(object['geo'] != null) { //si l'élément a déjà été localisé
						showGeoposOnMap(object['geo']['latitude'], object['geo']['longitude'], typePH, map)
					}
					else if(object['cp'] != null) { //si l'objet n'a pas de GEO, on position par le CP
					 	testitget("savePosGroupsResult", baseUrl+'/sig/api/getPositionCp/cp/'+object['cp'], 	
							function (position){
								if(position == null) { $("#savePosGroupsResult").html ( "pas de position trouvée pour ce CP"); }
								else { 
									showGeoposOnMap(position['lat'], position['lng'], typePH, map)
								}							
						    });
					} else {	$('#savePosGroupsResult').html("Cet élément n'a pas de code postal, impossible de le localiser"); }
				});
	}
	
	function showGeoposOnMap(lat, lng, typePH, map){
		var options = { 	"lat":lat , 
							"lng":lng, 
							"type" : typePH, 
							"contentInfoWin": "Déplacez le curseur pour indiquer une autre position si vous le souhaitez."  };
		if(markerNewPos != null) map.removeLayer(markerNewPos); //un seul marker affiché sur la carte					
		markerNewPos = addMarker(map, options);	
		//centre la carte sur le nouveau marker
		mapNewPos.panTo([lat, lng]);
	}
		
	function saveGeoposition(typePH, object_id){
		var params = new Array();

		if(markerNewPos != null)
		params = { 		  "_id": object_id, 
						  "type" : typePH,
						  "geo": { "latitude" : markerNewPos.getLatLng().lat ,  "longitude" : markerNewPos.getLatLng().lng }
				 };
		testitpost("savePosGroupsResult", baseUrl+'/sig/api/saveGeoposition',params);
	}
	
	mapNewPos = loadMap("mapCanvasNewPos"); 
	</script>
</div>