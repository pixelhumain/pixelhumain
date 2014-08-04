<div class="fss">
			
		<div class="apiForm login">
			
			<div class="div_right_tool_map">
				<div class="titleMapListItems">
					<h4>Liste des citoyens :</h4>
				</div>
				<div id="mapListItems" class="mapListItems"></div>
			</div>
			
			<div id="mapCanvasClusters" class="mapCanvas1">
			<br/>Chargement de la carte ...
			</div>	
			<a href="javascript:initClusterMap('mapCanvasClusters')">Init map</a><br/>		
			<a href="javascript:showCitoyensClusters()">Afficher les citoyens avec cluster</a><br/>		
			<div id="showCitoyensResult" class="result fss"></div>

		<script>				
				var mapClusters = null;
				var markersLayer;
				var geoJsonCollection;
				
				function initClusterMap(canvas){
					if(mapClusters != null) mapClusters.remove();
					
					mapClusters = loadMap(canvas);
					markersLayer = new L.MarkerClusterGroup();
					mapClusters.addLayer(markersLayer);// add it to the map
					geoJsonCollection = { type: 'FeatureCollection', features: new Array() };
				}
				
				
				//##
				//affiche les citoyens qui possèdent des attributs geo.latitude, geo.longitude, depuis la BD
				function showCitoyensClusters(){ 
					
					geoJsonCollection = { type: 'FeatureCollection', features: new Array() };
					markersLayer.clearLayers();			
					
					testitget("showCitoyensResult", baseUrl+'/sig/api/showCitoyens/', 
						function (data){
							var listItemMap = "";
						 	$.each(data, function() {
								if(this['geo'] != null){
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
							});
							
							//affiche la liste d'éléments
							$('#mapListItems').html(listItemMap);
							
							var points_rand = L.geoJson(geoJsonCollection, {
							onEachFeature: function (feature, layer) {				   //Sur chaque marker
									layer.bindPopup(feature["properties"]["content"]); //ajoute la bulle d'info avec les données
									layer.setIcon(feature["properties"]["icon"]);	   //et affiche l'icon demandé
								}
							});
						
							markersLayer.addLayer(points_rand); 	// add it to the cluster group
							mapClusters.addLayer(markersLayer);		// add it to the map
							mapClusters.fitBounds(markersLayer.getBounds()); //set view on the cluster extend					
						});
				}
				
				
				//##
				//créer un marker sur la carte, en fonction de sa position géographique
				function addMarkersCluster(thisMap, options){ //ex : lat = -34.397; lng = 150.644;			
					var contentString = options.contentInfoWin;
					if(options.contentInfoWin == null) contentString = "info window"; 
					
					var markerOptions = { icon : getIcoMarker(options.type),
										  draggable : true };
					
    				var geoJson = getGeoJsonMarker(markerOptions, [options.lat, options.lng]);
    				markersLayer.addLayer(geoJson);
    				return geoJson;
				}
								
				//##
				//créé une donnée geoJson
				function getGeoJsonMarker(properties/*json*/, coordinates/*array[lat, lng]*/) {
					return { "type": 'Feature',
							 "properties": properties,
							 "geometry": { type: 'Point',
							 			 coordinates: coordinates } };
				}
				
				
			</script>		
		</div>