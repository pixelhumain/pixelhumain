	
<?php SIG::clientScripts(); ?>



		<div class="fss">
			Afficher les villes de la BD<br/>
			+ Afficher les villes<br/>
		</div>
		<div class="apiForm login">
			<div id="mapCanvasCitoyens" class="mapCanvas1">
			</br>Chargement de la carte ...
			</div>	
			<a href="javascript:showCities()">Afficher les villes</a><br/>		
			<div id="showCitiesResult" class="result fss"></div>
			
			<script>
				var mapCitoyens = loadMap("mapCanvasCitoyens");
				var listCities = new Array();
							
				//##
				//affiche les villes qui possèdent des attributs lat, lng, depuis la BD
				function showCities(){ 
					testitget("showInsertMuserResult", baseUrl+'/sig/api/showCities/', 
						function (data){
							var nbCities=0;
						 	$.each(data, function() {
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
	