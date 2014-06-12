<ul>
	<li class="block" id="blockLogin">
		<div class="fss">
			Test d'affichage de la carte<br/>
		</div>
		<div class="apiForm login">
			<div id="mapCanvas" style="width:500px; height:250px; background-color:grey; text-align:center; font-size:20px;"
				 >
			</br>Chargement de la carte ...
			</div>	
						
			<a href="javascript:addMarkerList()">Ajouter une liste de marker</a><br/>
		
			<div id="loadResult" class="result fss"></div>
			
			<script src="http://maps.google.com/maps/api/js?sensor=false" language="JavaScript" type="text/javascript" ></script>

			<script>
				
				//##
				function loadMap(canvasId){
				//initialisation des variables de départ de la carte
  				var mapOptions = {
					zoom: 4,
					center: new google.maps.LatLng(47, 3),
					mapTypeId: google.maps.MapTypeId.TERRAIN,
					mapTypeControl: false,
					mapTypeControlOptions: {
						style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
						position: google.maps.ControlPosition.BOTTOM_CENTER
					},
					zoomControl: false,
					zoomControlOptions: {
						style: google.maps.ZoomControlStyle.SMALL,
						position: google.maps.ControlPosition.RIGHT_BOTTOM
					},
					scaleControl: true,
					scaleControlOptions: {
						position: google.maps.ControlPosition.BOTTOM_CENTER
					},
					streetViewControl: false,
					panControl: false
				}

				//crée la carte
				return new google.maps.Map(document.getElementById(canvasId), mapOptions);
				}
				
				
				
				//##
				//créer un marker sur la carte, en fonction de sa position géographique
				function addMarker(thisMap, options){ //ex : lat = -34.397; lng = 150.644;
				var marker = new google.maps.Marker	({	
  								position: new google.maps.LatLng(options.lat, options.lng), 
      							map: thisMap,
      							draggable:true,
      							icon:getIcoMarker(options.type)
								//shadow:shadow
      							});
      				
      				//par défault ajoute une bulle lorsqu'on clique sur le marker		
      				google.maps.event.addListener(marker, 'click', 
					function(event){	
						var contentString = options.contentInfoWin;
						if(options.contentInfoWin == null) contentString = "info window"; 		
      					openInfoWindow(this, contentString);
      				});
      				
      				return marker;
				}
				
				//##
				//récupère le nom de l'icon en fonction du type de marker souhaité
				function getIcoMarker(type){
					if(type == "citoyen") 	return "/ph/images/map/markers/user_h_black.png";
					if(type == "city") 		return "/ph/images/map/markers/city.png";
				
				}
								
				//##
				//ouvrir une bulle sur un marker, avec le contenu a afficher
				function openInfoWindow(marker, content){
					var infoWin = new google.maps.InfoWindow({   content: content	});	//crée la bulle
      				infoWin.open(marker.getMap(), marker); //ouvre la bulle
				}
				
				//##
				//ajouter une liste de marker sur la carte
				function addMarkerList(markerList){
					/*test*/
					var lat = 47; var lng = 3;
					var markerList = [	{ "lat" : lat,   "lng" : lng  , "type" : "citoyen", "contentInfoWin" : "N°1" }, 
										{ "lat" : lat+1, "lng" : lng+1, "type" : "citoyen", "contentInfoWin" : "N°2" }, 
										{ "lat" : lat+2, "lng" : lng+2, "type" : "citoyen", "contentInfoWin" : "N°3" }, 
										{ "lat" : lat+3, "lng" : lng+3, "type" : "citoyen", "contentInfoWin" : "N°4" }, 
										{ "lat" : lat+4, "lng" : lng+4, "type" : "citoyen", "contentInfoWin" : "N°5" } ];
					/*test*/	
					laMap = loadMap("mapCanvas");				
					for(var i=0; i<markerList.length; i++){
						addMarker(laMap, markerList[i]);
					}
				}
				
				var laMap = loadMap("mapCanvas");
				
			</script>
			
		</div>
	</li>

	<li class="block" id="blockLogin">
		<a href="/ph/<?php echo $this::$moduleKey?>/api/getCitoyenConnected">Afficher la position de l'utilisateur connecté</a><br/>
		<div class="fss">
			Enregistrement de ma position en BD<br/>
		</div>
		<div class="apiForm login">
			<div id="mapCanvasSavePosition" style="width:500px; height:250px; background-color:grey; text-align:center; font-size:20px;">
			</br>Chargement de la carte ...
			</div>	
			<a href="javascript:initMapSavePos()">Afficher ma position</a><br/>			
			<a href="javascript:savePositionUser()">Enregistrer cette position</a><br/>			
			<div id="addPositionUserResult" class="result fss"></div>
			
			<script>
				var mapSavePosition;
				var newMarker;
					
				//##
				//initialise la carte qui sert à enregistrer la position de l'utilisateur connecté
				function initMapSavePos(){
					mapSavePosition = loadMap("mapCanvasSavePosition");
					//recupere les données du citoyen connecté
					testitget("addPositionUserResult",'/ph/<?php echo $this::$moduleKey?>/api/getCitoyenConnected/', 	
					function (data){
							if(data == null) { $("#addPositionUserResult").html ( "Vous devez être connecté pour enregistrer votre position"); }
							else 
							{
								var user = data['user'];      var city = data['city'];      var lat, lng = 0;
								
								var content = "<span style='text-align:center'>Votre code postal : " + user['cp']  + "<br/>";
								var position = null;
								
								if(user['geo'] != null) { //si l'utilisateur a deja enregistré sa position
								 content +=  "Pour modifier votre position, déplacez le curseur et cliquez sur :<br/>";
								 content += "<a id='' href='javascript:savePositionUser()'>> Enregistrer cette position</a></span>";
								
								lat = user['geo']['latitude'];
								lng = user['geo']['longitude'];
								} 
								else { //s'il n'a pas encore enregistré sa position, on affiche son marker aux coordonnées de sa ville
								 content += "Merci de placer votre silhouette à l'endroit où vous souhaitez apparaître, et cliquez sur :<br/>";
							 	 content += "<a id='' href='javascript:savePositionUser()'>Enregistrer cette position</a></span>";
							 	 
							 	 lat = city['geo']['latitude'];
								 lng = city['geo']['longitude'];
							 	}
							 	
							 	//crée le marker sur la carte
								newMarker = addMarker(mapSavePosition, { 	"lat":lat , 
																		    "lng":lng, 
																		    "type" : "citoyen", 
																		    "contentInfoWin":content });
								//centre la carte sur le nouveau marker
								mapSavePosition.setCenter(new google.maps.LatLng(lat, lng));
								mapSavePosition.setZoom(11);		
								google.maps.event.trigger(newMarker, 'click');
				 			}
					});
						
				}
				
				//##
				//enregistre la position du marker
				function savePositionUser(){
					if(newMarker != null) {					
						var params = {  "lat" : newMarker.getPosition().lat() ,  "lng" : newMarker.getPosition().lng() };
						testitpost("addPositionUserResult",'/ph/<?php echo $this::$moduleKey?>/api/savePositionUser', params);
						$("#addPositionUserResult").html("votre position a bien été enregistrée");
					}
				}
				
				mapSavePosition = loadMap("mapCanvasSavePosition");
				initMapSavePos();
			</script>
			
		</div>
	</li>

	<li class="block" id="blockLogin">
		<a href="/ph/<?php echo $this::$moduleKey?>/api/showCitoyens/">Afficher les citoyens</a><br/>
		<div class="fss">
			Afficher les citoyens inscrits en BD, et modifier leurs positions<br/>
			+ Afficher les villes<br/>
		</div>
		<div class="apiForm login">
			<div id="mapCanvasCitoyens" style="width:500px; height:250px; background-color:grey; text-align:center; font-size:20px;"
				 >
			</br>Chargement de la carte ...
			</div>	
			<a href="javascript:showCitoyens()">Afficher les citoyens</a><br/>		
			<a href="javascript:showCities()">Afficher les villes</a><br/>		
			<div id="showCitiesResult" class="result fss"></div>
			
			<script>
				var mapCitoyens = loadMap("mapCanvasCitoyens");
				var listMarkersCitoyens = new Array();
				var listCities = new Array();
				
				//##
				//affiche les citoyens qui possèdent des attributs geo.latitude, geo.longitude, depuis la BD
				function showCitoyens(){ 
					mapCitoyens = loadMap("mapCanvasCitoyens");
					listMarkersCitoyens = new Array();
					testitget("showInsertMuserResult",'/ph/<?php echo $this::$moduleKey?>/api/showCitoyens/', 
						function (data){
						 	$.each(data, function()
							{
								if(this['geo'] != null){
				 					var content = "";
				 					if(this['name'] != null)  content += 	"<b>" + this['name'] + "</b><br/>";
				 					if(this['email'] != null)  content += 	this['email'] + "<br/>";
				 					if(this['cp'] != null)     content += 	this['cp'] + "<br/>";
				 					if(this['phoneNumber'] != null)     content += 	this['phoneNumber'] + "<br/>";
				 					
				 					//récupère un nouveau marker
				 					var leMarker = addMarker(mapCitoyens, { "lat" : this['geo']['latitude'],   
				 															"lng" : this['geo']['longitude']  , 
				 															"type" : "citoyen", 
				 															"contentInfoWin" : content });
				 					//garde ce marker en mémoire, avec le mail correspondant
				 					listMarkersCitoyens.push( { "email" : this['email'], "marker" : leMarker } );
				 				}
							});
						});
				}
				
				//##
				//affiche les villes qui possèdent des attributs lat, lng, depuis la BD
				function showCities(){ 
					mapCitoyens = loadMap("mapCanvasCitoyens");
					
					testitget("showInsertMuserResult",'/ph/<?php echo $this::$moduleKey?>/api/showCities/', 
						function (data){
							var nbCities=0;
						 	$.each(data, function()
							{
								//vérifie qu'on a bien les positions géographiques
								if(this['geo'] != null && 
									//et que la ville n'a pas déjà été affichée (pb CP grand villes avec des arrondissements)
									listCities[this["name"]] != this["habitants"]){	
				 					
				 					//crée le contenu de la bulle
				 					var content = "";
				 					if(this['name'] != null)  		content += 	"<b>" + this['name'] + "</b><br/>";
				 					if(this['cp'] != null)  		content += 	this['cp'] + "<br/>";
				 					if(this['habitants'] != null)  	content += 	"Nombre d'habitants : " + this['habitants'] + "<br/>";
				 					if(this['densite'] != null)  	content += 	"Densité : " + this['densite'] + "<br/>";
				 									
				 					var leMarker = addMarker(mapCitoyens, { "lat" : this['geo']['latitude'],   
				 															"lng" : this['geo']['longitude']  ,
				 															"type" : "city", 
				 															"contentInfoWin" : content });
				 					nbCities++;
				 					//garde le nom de la ville et le nb habitant en mémoire, pour n'afficher qu'une fois les villes qui ont plusieurs arrondissements
				 					listCities[this["name"]] = this['habitants'];
				 				}
							});
							$("#showCitiesResult").html(nbCities + " villes de plus de 100 000 habitants sur la carte");
						});
				}
			</script>	
		</div>
	</li>

	<li class="block" id="blockLogin">
		<div class="fss">
			Délimiter une zone de diffusion<br/>
		</div>
		<div class="apiForm login">
			<div id="mapCanvasBounds" style="width:500px; height:250px; background-color:grey; text-align:center; font-size:20px;">
			</br>Chargement de la carte ...
			</div>	
			<a href="javascript:loadRectangleArea()">Afficher la zone</a><br/>		
			<a href="javascript:showBound()">Afficher les valeurs de la zone</a><br/>		
			<div id="showBoundsResult" class="result fss"></div>
			
			<script>
				var mapZone = loadMap("mapCanvasBounds");
				var RectangleArea;
				
				//##
				//affiche un rectangle sur la carte
				function loadRectangleArea()
				{
					var rectangleOptions = {   
						editable: true,
						bounds: mapZone.getBounds(),
						map: mapZone,
						fillColor: 'yellow',
						fillOpacity: 0.3,
						visible: true }
					
					RectangleArea = new google.maps.Rectangle(rectangleOptions);
					mapZone.setZoom(mapZone.getZoom()-1);
				}
			
				//##
				//affiche les coordonnées correspondant aux limites du rectangle
				function showBound(){
					var bounds = RectangleArea.getBounds();
					$("#showBoundsResult").html ( "latMax : " + bounds.getNorthEast().lat() + "<br/>" +
												  "lngMax : " + bounds.getNorthEast().lng() + "<br/>" +
												  "latMin : " + bounds.getSouthWest().lat() + "<br/>" +
												  "lngMin : " + bounds.getSouthWest().lng() + "<br/>" );
				}
			</script>
			
		</div>
	</li>



