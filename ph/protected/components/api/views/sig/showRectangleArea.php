
<?php SIG::clientScripts(); ?>

	<div class="fss">
	</div>
	
		<div class="apiForm login">
			<div id="mapCanvasBounds" class="mapCanvas1">
			</br>Chargement de la carte ...
			</div>	
			<a href="javascript:initMapRectangleArea('mapCanvasBounds')">Afficher la zone</a><br/>		
			<a href="javascript:showBound()">Afficher les valeurs de la zone</a><br/>		
			<div id="showBoundsResult" class="result fss"></div>
			
			<script>			
				var RectangleArea = null;
				var mapZoneArea = null;
				
				function initMapRectangleArea(){
					RectangleArea = loadRectangleArea(mapZoneArea);
				}
				
				
				//##
				//affiche un rectangle sur la carte
				function loadRectangleArea(theMap)
				{
					//si le rectangle existe deja on le supprime	
					//creation du rectangle a partir des bounds de la carte
					var bounds = theMap.getBounds();
					var theRectangleArea = L.rectangle(bounds, {
												color: "yellow", 
												weight: 2,
												fillOpacity: 0.3,
												clickable: true
											}).addTo(theMap);
											
					L.circleMarker([51.508, -0.11], 50000, {
						color: 'red',
						fillColor: '#f03',
						fillOpacity: 0.5,
    					stroke: false
					}).addTo(theMap);
					
					//autorise l'edition de la zone par l'utilisateur						
					theRectangleArea.editing.enable();	
					//recule la carte (zoom - 1) pour rendre le rectangle visible					
					theMap.setZoom(theMap.getZoom()-1);
					return theRectangleArea;
				}
				
			
				//##
				//affiche les coordonnées correspondant aux limites du rectangle
				function showBound(){
					var bounds = RectangleArea.getBounds();
												  
					$("#showBoundsResult").html ( "latMin : " + bounds.getSouthWest().lat + "<br/>" +
												  "lngMin : " + bounds.getSouthWest().lng + "<br/>" +
												  "latMax : " + bounds.getNorthEast().lat + "<br/>" +
												  "lngMax : " + bounds.getNorthEast().lng + "<br/>" );
				}
				
				mapZoneArea = loadMap('mapCanvasBounds');
					
			</script>			
		</div>