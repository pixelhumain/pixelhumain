	<div class="fss">
	</div>
	
		<div class="apiForm login">
			<div id="mapCanvasBounds" class="mapCanvas1">
			</br>Chargement de la carte ...
			</div>	
			<a href="javascript:loadRectangleArea('mapCanvasBounds')">Afficher la zone</a><br/>		
			<a href="javascript:showBound()">Afficher les valeurs de la zone</a><br/>		
			<div id="showBoundsResult" class="result fss"></div>
			
			<script>			
				var RectangleArea = null;
				var mapZoneArea = null;
				
				//##
				//affiche un rectangle sur la carte
				function loadRectangleArea(canvas)
				{
					//si le rectangle existe deja on le supprime	
					if(RectangleArea != null) { mapZoneArea.removeLayer(RectangleArea); RectangleArea = null; }
					//si la map existe deja, on la supprime
					if(mapZoneArea != null) { mapZoneArea.remove(); mapZoneArea = null; }
					
					//charge la carte
					mapZoneArea = loadMap(canvas);
					//creation du rectangle a partir des bounds de la carte
					var bounds = mapZoneArea.getBounds();
					RectangleArea = L.rectangle(bounds, {
												color: "yellow", 
												weight: 2,
												fillOpacity: 0.3,
												clickable: true
											}).addTo(mapZoneArea);
					//autorise l'edition de la zone par l'utilisateur						
					RectangleArea.editing.enable();	
					//recule la carte (zoom - 1) pour rendre le rectangle visible					
					mapZoneArea.setZoom(mapZoneArea.getZoom()-1);
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
				
			
			</script>			
		</div>