
<?php SIG::clientScripts(); ?>


<div class="fss">
		</div>
		<div class="apiForm login">
			<div id="mapCanvas" class="mapCanvas1" >
			</br>Chargement de la carte ...
			</div>						
			<a href="javascript:addMarkerList()">Ajouter une liste de marker</a><br/>	
			<div id="loadResult" class="result fss"></div>
			<script>							
				//##
				function loadMap(canvasId){
					//initialisation des variables de départ de la carte
  					var map = L.map(canvasId).setView([51.505, -0.09], 4);
    		
    				L.tileLayer('http://otile{s}.mqcdn.com/tiles/1.0.0/osm/{z}/{x}/{y}.png', {
    					subdomains: "1234",
    					attribution: "&copy; <a href='http://www.openstreetmap.org/'>OpenStreetMap</a> and contributors, under an <a href='http://www.openstreetmap.org/copyright' title='ODbL'>open license</a>. Tiles Courtesy of <a href='http://www.mapquest.com/'>MapQuest</a> <img src='http://developer.mapquest.com/content/osm/mq_logo.png'>"
         			}).addTo(map);
         		
         			return map;
				}								
				//##
				//créer un marker sur la carte, en fonction de sa position géographique
				function addMarker(thisMap, options){ //ex : lat = -34.397; lng = 150.644;
				
					var contentString = options.contentInfoWin;
					if(options.contentInfoWin == null) contentString = "info window"; 
					
					var markerOptions = { icon : getIcoMarker(options.type),
										  draggable : true };
					
					var marker = L.marker([options.lat, options.lng], markerOptions).addTo(thisMap)
    				.bindPopup(contentString)
    				.openPopup();
    	
    				return marker;
				}							
				//##
				//récupère le nom de l'icon en fonction du type de marker souhaité
				function getIcoMarker(type){
					if(type == "citoyens") 	return L.icon({ iconUrl: "/ph/images/sig/markers/user_h_black.png",
															iconSize: 		[19, 40],
										  					iconAnchor: 	[10, 40],
    									  					popupAnchor: 	[0, -40] });
    									  					
					
					if(type == "city") 		return L.icon({ iconUrl: "/ph/images/sig/markers/city.png",
															iconSize: 		[32, 32],
										  					iconAnchor: 	[16, 32],
    									  					popupAnchor: 	[0, -32] });	
    									  					
    				if(type == "groups") 	return L.icon({ iconUrl: "/ph/images/sig/markers/groups.png",
															iconSize: 		[32, 32],
										  					iconAnchor: 	[16, 32],
    									  					popupAnchor: 	[0, -32] });						  						
				}
													
				//##
				//ajouter une liste de marker sur la carte
				function addMarkerList(markerList){
					/*test*/
					var lat = 47; var lng = 3;
					var markerList = [	{ "lat" : lat,   "lng" : lng  , "type" : "citoyens", "contentInfoWin" : "N°1" }, 
										{ "lat" : lat+1, "lng" : lng+1, "type" : "citoyens", "contentInfoWin" : "N°2" }, 
										{ "lat" : lat+2, "lng" : lng+2, "type" : "citoyens", "contentInfoWin" : "N°3" }, 
										{ "lat" : lat+3, "lng" : lng+3, "type" : "citoyens", "contentInfoWin" : "N°4" }, 
										{ "lat" : lat+4, "lng" : lng+4, "type" : "citoyens", "contentInfoWin" : "N°5" } ];
					/*test*/	
					for(var i=0; i<markerList.length; i++){
						addMarker(laMap, markerList[i]);
					}
				}
				
				var laMap = loadMap("mapCanvas");
				
			</script>			
		</div>