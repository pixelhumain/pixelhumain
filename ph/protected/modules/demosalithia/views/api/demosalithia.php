<ul>
	<li class="block" id="blockLogin">
		<a href="/ph/<?php echo $this::$moduleKey?>/default/login">Initialisation</a><br/>
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
				//variables "globale"
				//var map;
				
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
      							draggable:true
      							//icon:ico,
								//shadow:shadow
      							});
      				
      				//par défault ajoute une bulle lorsqu'on clique sur le marker		
      				google.maps.event.addListener(marker, 'click', 
					function(event){	
						var contentString = options.contentInfoWin;
						if(options.contentInfoWin == null) 
							contentString = "info window"; 		
      					openInfoWindow(this, contentString);
      				});
      				
      				return marker;
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
					var markerList = [	{ "lat" : lat,   "lng" : lng  , "contentInfoWin" : "N°1" }, 
										{ "lat" : lat+1, "lng" : lng+1, "contentInfoWin" : "N°2" }, 
										{ "lat" : lat+2, "lng" : lng+2, "contentInfoWin" : "N°3" }, 
										{ "lat" : lat+3, "lng" : lng+3, "contentInfoWin" : "N°4" }, 
										{ "lat" : lat+4, "lng" : lng+4, "contentInfoWin" : "N°5" } ];
					/*test*/	
					laMap = loadMap("mapCanvas");				
					for(var i=0; i<markerList.length; i++){
						addMarker(laMap, markerList[i]);
					}
				}
				
				var laMap = loadMap("mapCanvas");
				//var fstMarker = addMarker(laMap, {"lat":47 , "lng":3, "contentInfoWin":"enregistrer cette position" }); //ex : lat = 47; lng = 3;
				
			</script>
			
		</div>
	</li>

</ul>	


<ul>
	<li class="block" id="blockLogin">
		<a href="/ph/<?php echo $this::$moduleKey?>/api/savePositionUser">Enregistrer une positition (email par defaut)</a><br/>
		<div class="fss">
			Enregistrement de la position d'un marker en BD<br/>
		</div>
		<div class="apiForm login">
			<div id="mapCanvasSavePosition" style="width:500px; height:250px; background-color:grey; text-align:center; font-size:20px;">
			</br>Chargement de la carte ...
			</div>	
			<a href="javascript:savePositionUser()">Enregistrer position</a><br/>			
			<div id="addPositionUserResult" class="result fss"></div>
			
			<script>
				var mapSavePosition = loadMap("mapCanvasSavePosition");
				var newMarker = addMarker(mapSavePosition, {"lat":47 , "lng":3, "contentInfoWin":"enregistrer cette position" });
				
				function savePositionUser(){					
					var params = { "email" : "tristan.goguet@gmail.com" , //email par default - voir saveThisPosition(email)
					    	   		"lat" : newMarker.getPosition().lat() , 
					    	   		"lng" : newMarker.getPosition().lng() //,
					    	   		//"app" : "<?php echo $this::$moduleKey?>" 
					    	   		};
					testitpost("addPositionUserResult",'/ph/<?php echo $this::$moduleKey?>/api/savePositionUser', params);
				}
			</script>
			
		</div>
	</li>

</ul>	


<ul>
	<li class="block" id="blockLogin">
		<a href="/ph/<?php echo $this::$moduleKey?>/api/showCitoyens/">Afficher les citoyens</a><br/>
		<div class="fss">
			Afficher les citoyens inscrits en BD, et modifier leurs positions<br/>
		</div>
		<div class="apiForm login">
			<div id="mapCanvasCitoyens" style="width:500px; height:250px; background-color:grey; text-align:center; font-size:20px;"
				 >
			</br>Chargement de la carte ...
			</div>	
			<a href="javascript:showCitoyens()">Afficher les citoyens</a><br/>		
			<div id="showInsertMuserResult" class="result fss"></div>
			
			<script>
				var mapCitoyens = loadMap("mapCanvasCitoyens");
				var listMarkersCitoyens = new Array();
				
				function showCitoyens(){ //affiche les citoyens qui possèdent des attributs lat, lng, depuis la BD
					mapCitoyens = loadMap("mapCanvasCitoyens");
					listMarkersCitoyens = new Array();
					testitget("showInsertMuserResult",'/ph/<?php echo $this::$moduleKey?>/api/showCitoyens/', 
						function (data){
						 	$.each(data, function()
							{
								if(this['lat'] != null){
				 					var content = "";
				 					if(this['name'] != null)  content += 	"<b>" + this['name'] + "</b><br/>";
				 					if(this['email'] != null)  content += 	this['email'] + "<br/>";
				 					if(this['cp'] != null)     content += 	this['cp'] + "<br/>";
				 					if(this['phoneNumber'] != null)     content += 	this['phoneNumber'] + "<br/>";
				 									
				 				content += "<a id='' style='width:200px; float:left;' href='javascript:saveThisPosition(\"" + this['email'] + "\")'>Enregistrer cette position</a><br/>";
				 					
				 					//récupère un nouveau marker
				 					var leMarker = addMarker(mapCitoyens, { "lat" : this['lat'],   "lng" : this['lng']  , "contentInfoWin" : content });
				 					//garde ce marker en mémoire, avec le mail correspondant
				 					listMarkersCitoyens.push( { "email" : this['email'], "marker" : leMarker } );
				 				}
							});
						});
				}
				
				function saveThisPosition(email) //enregistre la position du marker correspondant au mail
				{
					for (var i=0; i<listMarkersCitoyens.length; i++) {
					  	if(listMarkersCitoyens[i].email == email) {
					  		var marker = listMarkersCitoyens[i].marker;
							var params = { 	"email" : email , 
					    	   				"lat" : marker.getPosition().lat() , 
					    	   				"lng" : marker.getPosition().lng() };
					    	   			
							testitpost("showInsertMuserResult",'/ph/<?php echo $this::$moduleKey?>/api/savePositionUser', params);
							break;
							return;
						}
					}	
				}
				
			
			</script>
			
		</div>
	</li>

</ul>	


