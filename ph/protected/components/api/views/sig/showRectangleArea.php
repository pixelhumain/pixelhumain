	<div class="fss">
			<h4>Délimiter une zone de diffusion</h4>
	</div>
	
		<div class="apiForm login">
			<div id="mapCanvasBounds" class="mapCanvas1">
			</br>Chargement de la carte ...
			</div>	
			<a href="javascript:loadRectangleArea()">Afficher la zone</a><br/>		
			<a href="javascript:showBound()">Afficher les valeurs de la zone</a><br/>		
			<div id="showBoundsResult" class="result fss"></div>
			
			<script>
				
				var RectangleArea;
				
				//##
				//affiche un rectangle sur la carte
				function loadRectangleArea(mapZone = null)
				{
					if(mapZone == null) mapZone = loadMap("mapCanvasBounds");
					
					var bounds = mapZone.getBounds();
					RectangleArea = L.rectangle(bounds, {
												color: "yellow", 
												weight: 2,
												fillOpacity: 0.3,
												clickable: true
											}).addTo(mapZone);
											
					RectangleArea.editing.enable();						
					mapZone.setZoom(mapZone.getZoom()-1);
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
				
				function getBoundsValue(){
					return RectangleArea.getBounds();
				}
			</script>			
		</div>