
<?php SIG::clientScripts(); ?>

<div class="fss">
	Si l'élément possède un CP => localisation à partir du CP + modification manuelle
	Sinon, localisation impossible
</div>

<div class="apiForm createUser">
	<div id="mapCanvasNewPosGroups"class="mapCanvas1"> </br>Chargement de la carte ... </div>	
	
	<select id="selectGroup">
		<option></option>
		<?php 
		$groups = Yii::app()->mongodb->groups->find();
		foreach ($groups as $value) {
			echo '<option value="'.$value["_id"].'">'.$value["name"].'</option>';
		}
		?>
		
	</select><br/>
	

	<a class="btn" href="javascript:showElement()">Afficher l'élément sélectionné sur la carte</a><br/>
	<a class="btn" href="javascript:saveElement()">Valider la position de l'élément</a><br/>
	
	<div id="savePosResult" class="result fss"></div>

	<script>
	var mapNewPosGroups;
	
	function showElement(){ //object = json		
		var _idElement = $('#selectGroup').val();
		initSaveNewPos("groups", _idElement, mapNewPosGroups);		
	}
	
	
	function saveElement(){
		var _idElement = $('#selectGroup').val();
		saveGeoposition("groups", _idElement, mapNewPosGroups);		
	}
	
	mapNewPosGroups = loadMap("mapCanvasNewPosGroups"); 
	</script>
</div>