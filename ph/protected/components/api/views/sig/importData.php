	
<?php SIG::clientScripts(); ?>


	<div class="apiForm importData">
			<h5>Nom de la base de données à utiliser pour insérer les données : par defaut "pixelhumain" </h5>
			<input type="text" id="dbName" name="dbName" value="pixelhumain"/>	<br/>
			<a href="javascript:importData()">Importer les données</a><br/>
			<div id="importDataResult" class="result fss"></div>

		<script>
			function importData(){ 
				params = { 	"dbName" : $("#dbName").val() ,
							"app":"<?php echo $this::$moduleKey?>"  };
				testitpost("importDataResult", baseUrl+'/sig/api/importData',params);
				$("#importDataResult").html("Le chargement des données est en cours, cela peut durer quelques minutes...");				
			}
			</script>
			
	</div>
	