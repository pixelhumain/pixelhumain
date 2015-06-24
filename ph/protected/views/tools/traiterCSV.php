<div class="col-md-12">
	<form id="formfile" method="POST" action="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/tools/traitercsv/';?>" enctype="multipart/form-data">
		
		<div class="row">
			<div class="col-md-4">
				<select id="choose" name="choose">
					<option value="new">Nouvelles données</option>
				  	<option value="modify">Modifier une donnée</option>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label for="fileimport">Données à importer (csv) :</label><input type="file" id="fileimport" name="fileimport" accept=".csv">
			</div>
			<div class="col-md-4">
				<label> Séparateur(csv) :</label>
				<select id="separateur" name="separateur">
					<option value=";">point-virgule</option>
				  	<option value=",">virgule</option>
				  	<option value=".">point</option>
				  	<option value=" ">espace</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div id="divChooseMapping" class="col-md-4">
				<label> Mapping :</label>
				<select id="chooseMapping" name="chooseMapping">
				<?php
						$allMapping = PHDB::find (City::COLLECTION_IMPORTHISTORY);
						foreach ($allMapping as $key => $value) 
						{
							echo '<option value="'.$key .'">'.$value["cityDataSrc"]["nameFile"].'</option>';

						}
				?>
				</select>
				<?php //var_dump($allMapping) ?>
			</div>
			<div class="form-group col-md-4">
				<input type="submit" class="btn btn-primary" id="sumitVerification" value="Vérification"/>
			</div>
		</div>

	</form>
	<form id="formmapping">
	<?php
		if($result == true)
		{
			if($choose == "modify")
			{
				$oneMapping = PHDB::findOne(City::COLLECTION_IMPORTHISTORY, array("_id"=>new MongoId($chooseMapping)));
				var_dump($oneMapping['cityDataSrc']["fields"]);
					echo ' 	<div class="form-group col-md-12">
								<h3 class="col-md-12">Mapping</h3>
								<div class="form-group col-md-4">
									<label for="source">Source : </label><input type="text" id="source" name="source" value="'.$oneMapping['cityDataSrc']["src"].'">
									<input type="hidden" id="chooseSelected" value="'.$choose.'">
									<input type="hidden" id="mappingSelected" value="'.$chooseMapping.'">
									<input type="hidden" id="nameFile" value="'.$nameFile.'">
									<input type="hidden" id="separateurMapping" value="'.$separateur.'">
								</div>
								<div class="form-group col-md-4">
									<label for="url">URL : </label><input type="text" id="url" name="url" value="'.$oneMapping['cityDataSrc']["url"].'">
								</div>
								<div class="form-group col-md-4">
									<label for="lien">Lien : </label>
									<select id="lien">';
					    				foreach (Yii::app()->session["tabCSV"][0] as $key => $value) 
										{
											echo '<option value="'.$value.'">'.$value.'</option>';
										}
				echo '				</select>
								</div>
							</div>';
			}
			else
			{
				echo ' 	<div class="form-group col-md-12">
						<h3 class="col-md-12">Mapping</h3>
						<div class="form-group col-md-4">
							<label for="source">Source : </label><input type="text" id="source" name="source">
							<input type="hidden" id="chooseSelected" value="'.$choose.'">
							<input type="hidden" id="nameFile" value="'.$nameFile.'">
							<input type="hidden" id="separateurMapping" value="'.$separateur.'">
						</div>
						<div class="form-group col-md-4">
							<label for="url">URL : </label><input type="text" id="url" name="url">
						</div>
						<div class="form-group col-md-4">
							<label for="lien">Lien : </label>
							<select id="lien">';
			    				foreach (Yii::app()->session["tabCSV"][0] as $key => $value) 
								{
									echo '<option value="'.$value.'">'.$value.'</option>';
								}
		echo '				</select>
						</div>
					</div>';
			}
			
		echo '		<div class="form-group col-md-12">

						<div id="divtab" class="table-responsive">
					    	<table id="tabcreatemapping" class="table table-striped table-bordered table-hover ">
					    		<thead>
						    		<tr>
						    			<th>Colonne CSV</th>
						    			<th>Mapping</th>
						    			<th>Ajouter/Supprimer</th>
						    		</tr>
					    		</thead>
						    	<tbody class="directoryLines" id="bodyCreateMapping">';
						    		$nbligne = 0 ;
						    		if($choose == "modify")
						    		{
						    			
						    			foreach ($oneMapping['cityDataSrc']["fields"] as $key => $value) 
						    			{
						    				$nbligne++;
						    				$i = 0;
						    				$trouver = false ;
						    				while($trouver == false && $i < count(Yii::app()->session["tabCSV"]))
						    				{
						    					if(Yii::app()->session["tabCSV"][$i] == $key)
						    						$trouver = true;
						    					else
						    						$i++;
						    				}
						    				echo '<tr  id="lineMapping'.$nbligne.'">
						    						<td id="valueheadCSVMapping'.$nbligne.'">'.$key .'</td>
						    						<td id="labelMapping'.$nbligne.'">'.$value.'</td>
						    						<td>
						    							<input type="hidden" id="keyheadCSVMapping'.$nbligne.'" value="'.$i.'">
						    							<a href="#" class="btn btn-primary">X</a></td>
						    					</tr>';
						    				
						    			}
						    		}
		echo '			    		<tr id="LineAddMapping">
						    			<td>
						    				<input type="hidden" id="nbligne" value="'.$nbligne.'"/>
						    				<select id="selectHeadCSV">';
						    				foreach (Yii::app()->session["tabCSV"][0] as $key => $value) 
											{
												echo '<option value="'.$key.'">'.$value.'</option>';
											}
		echo '								</select>
						    			</td>
						    			<td><input type="text" id="textMapping" value=""/></td>
						    			<td><a href="#" id="addMapping" class="btn btn-primary">Ajouter</a></td>
						    		</tr>';
		echo '  				</tbody>
							</table>
						</div>
					</div>';
		echo ' 		<div class="form-group col-md-12">
						<div class="form-group col-md-4 col-md-offset-4">
							<a href="#" id="sumitMapping" class="btn btn-primary">Visualisation</a>
						</div>
					</div>';
		}

	?>
	</form>
	<div id="visualisationGlobal">
		<div class="col-md-12">
			<h3 class="col-md-12">Vérification avant import</h3>
			<label>Données importé :</label>
				<ul class="nav nav-tabs">
					<li role="presentation" ><a href="#" id="linkInformationImport">Information</a></li>
					<li role="presentation" class="active"><a href="#" id="linkJsonImport">JSON</a></li>
					<li role="presentation"><a href="#" id="linkListImport">Liste des données</a></li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-body">
						<div id="divInformationImport">
						  	<ul class="list-group" id="listeInformationImport">
								<li class="list-group-item"></li>
								<li class="list-group-item"></li>
							</ul>
						</div>
						<div id="divJsonImport">
						    <textarea class="col-md-12 form-control" id="jsonimport" rows="10"  readonly></textarea>
						</div>
						<div id="divListImport" class="table-responsive">
						    <table class="table table-striped table-bordered table-hover">
						    	<thead id="tableHeadImport">
						    	</thead>
					    		<tbody id="tableBodyImport">
					    		</tbody>
							</table>
						</div>
					</div>
				</div>
		</div>
					
		<div class="col-md-12">
			<label>Données rejetée :</label>
			<ul class="nav nav-tabs">
			  <li role="presentation" ><a href="#" id="linkInformationRejet">Information</a></li>
			  <li role="presentation" class="active"><a href="#" id="linkJsonRejet">JSON</a></li>
			  <li role="presentation"><a href="#" id="linkListRejet">Liste des données</a></li>
			</ul>
			<div class="panel panel-default">
			  	<div class="panel-body">
			  		<div id="divInformationRejet">
			  			<ul class="list-group" id="listeInformationRejet">
						    <li class="list-group-item"></li>
						</ul>
			  		</div>
			  		<div id="divJsonRejet">
			    		<textarea class="col-md-12 form-control" id="jsonrejet" rows="10"  readonly></textarea>
			  		</div>
			  		<div id="divListRejet" >
			    		<table class="table table-striped table-bordered table-hover">
			    			<thead id="tableHeadRejet">
			    			</thead>
				    		<tbody id="tableBodyRejet" class="directoryLines">
				    		</tbody>
						</table>
			  		</div>
			  	</div>
			</div>
		</div>

		<div class="col-md-12">
			<label>Mapping :</label>
			<ul class="nav nav-tabs">
			  <li role="presentation" class="active"><a href="#">JSON</a></li>
			</ul>
			<div class="panel panel-default">
			  	<div class="panel-body">
			  		<div id="divJsonMapping">
			    		<textarea class="col-md-12 form-control" id="jsonmapping" rows="10" ></textarea>
			  		</div>
			  	</div>
			</div>
		</div>
		<div class="col-md-5 col-md-offset-5">
			<a href="#" class="btn btn-primary col-md-3" type="submit" id="sumitImport">Import</a>
		</div>
	</div>

	
</div>
<link rel="stylesheet" href="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/vendor/codemirror/codemirror.css'; ?>">
<script src="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/vendor/codemirror/codemirror.js'; ?>"></script>
<script type="text/javascript">
jQuery(document).ready(function() 
{

	
	resetDirectoryTable() ;
	$("#divChooseMapping").hide();
	$("#visualisationGlobal").hide();
	$("#divInformationImport").hide();
	$("#divInformationRejet").hide();
	$("#divListImport").hide();
	$("#divListImport").css('overflow', 'auto');
	$("#divListRejet").hide();
	$("#divListRejet").css('overflow', 'auto');
	
	$("#choose").change(function() 
	{
	  	if($("#choose").val() == "new")
	  		$("#divChooseMapping").hide();
	  	else
	  		$("#divChooseMapping").show();
		
	});


	$("#addMapping").off().on('click', function()
  	{
  		nbligne = parseInt($("#nbligne").val())+ 1;
  		ligne = '<tr id="lineMapping'+nbligne+'"> ';
  		ligne =	 ligne + '<td id="valueheadCSVMapping'+nbligne+'">' + $("#selectHeadCSV option:selected").text() + '</td>';
  		ligne =	 ligne + '<td id="labelMapping'+nbligne+'">' + $("#textMapping").val() + '</td>';
  		ligne =	 ligne + '<td><input type="hidden" id="keyheadCSVMapping'+nbligne+'" value="'+$("#selectHeadCSV").val()+'"><a href="#" class="btn btn-primary">X</a></td></tr>';
  		alert($("#selectHeadCSV").val());
  		$("#nbligne").val(nbligne);
  		$("#LineAddMapping").before(ligne);
  		
  	});

  	/*$("#tabcreatemapping a").off().on('click', function()
  	{
  		$(this).parent().parent().remove();

  	});*/

	$("#sumitMapping").off().on('click', function()
  	{
  		var tabmapping = [];
  		nbligne = $("#nbligne").val();
  		for (i = 1; i <= nbligne; i++) 
  		{
  			tabmapping[$("#keyheadCSVMapping"+i).val()] = $("#labelMapping"+i).text();
		}

  	
  		$.ajax({
	        type: 'POST',
	        data: {mappingSelected : $("#mappingSelected").val(), chooseSelected : $("#chooseSelected").val(), separateur : $("#separateurMapping").val(), nameFile : $("#nameFile").val(), source : $("#source").val(), url : $("#url").val(), tabmapping : tabmapping, tabCSV : $("#tabCSV").val(), lien : $('#lien option:selected').val()},
	        url: baseUrl+'/tools/traitermapping/',
	        dataType : 'json',
	        success: function(data)
	        {

				console.dir(data);
				if(data.result == "mappingempty")
				{
					toastr.error("Vous devez remplir les informations du mapping.");
				}
				else
				{
					$("#visualisationGlobal").show();
					
					$("#jsonimport").html(data.jsonimport);
					$("#jsonmapping").html(data.jsonmapping);
					$("#jsonrejet").html(data.jsonrejet);
					
					useCodeMirror("jsonmapping");
					useCodeMirror("jsonimport");
					useCodeMirror("jsonrejet");
					
					console.dir();
					
					$("#listeInformationImport").html('<li class="list-group-item">'+ data.nbcommunemodif +' communes mis à jours</li>');
					$("#listeInformationImport").append('<li class="list-group-item">'+ data.nbinfoparcommune +' informations seront ajouté par communes</li>');
					$("#listeInformationRejet").html('<li class="list-group-item">'+ data.nbcommunerejet +' communes mis à jours</li>');

					colimport = [];
					entete = "<tr>";
					$.each(data.tabCode, function( keyRows, valueRows )
					{
						$.each(data.arraymappingfields, function( keyFields, valueFields )
						{
						   	if(valueRows == keyFields || valueRows == data.lien)
						   	{
						   		colimport.push(keyRows);
						   		entete = entete + "<th>"+ valueRows +"</th>";
						   	}
						});
					});
					entete = entete + "</tr>";

					$("#tableHeadImport").html(entete);
					$("#tableHeadRejet").html(entete);

					ligne ="";
					$.each(data.arrayCsvImport, function( keyRows, valueRows )
					{
						ligne = ligne + "<tr>" ;
					    $.each(valueRows, function( keyCols, valueCols )
						{
							if(jQuery.inArray(keyCols, colimport) != -1)
						    	ligne = ligne + "<td>"+ valueCols +"</td>";
						    
						});
						ligne = ligne + "</tr>" ;
					});
					$("#tableBodyImport").append(ligne);

					ligne ="";
					$.each(data.arrayCsvRejet, function( keyRows, valueRows )
					{
						ligne = ligne + "<tr>" ;
					    $.each(valueRows, function( keyCols, valueCols )
						{
							if(jQuery.inArray(keyCols, colimport) != -1)
						    	ligne = ligne + "<td>"+ valueCols +"</td>";
						});
						ligne = ligne + "</tr>" ;
					});
					$("#tableBodyRejet").append(ligne);
	       		}
	       	}
	    });
		
  		return false;
  	});


	$('#formfile').submit(function() 
	{
	    if($("#fileimport").val() == "")
	   	{
	   		toastr.error("Vous devez sélectionner un fichier.");
	   		return false;
	   	}
	   	else
	   	{
	   		var extensionFileImport = $("#fileimport").val().split('.');
	   		if(extensionFileImport[(extensionFileImport.length - 1)] != "csv")
	   		{
		   		toastr.error("Vous devez sélectionner un fichier au format .csv .");
		   		return false;
		   	}
		   	else
		   	{
		   		return true;
		   	}
	   	}
  	});

  	$("#sumitImport").off().on('click', function()
  	{
  		$.ajax({
	        type: 'POST',
	        data: {mappingSelected : $("#mappingSelected").val(), chooseSelected : $("#chooseSelected").val(), jsonimport : $('#jsonimport').val(), jsonmapping : $('#jsonmapping').val()},
	        url: baseUrl+'/tools/importmongo/',
	        dataType : 'json',
	        success: function(data)
	        {
	            console.dir(data);
	            if(data.result)
	              	toastr.success("Les données ont été ajouté.");
	            else
	                toastr.error("Erreur"); 
	        }
	    });
  	});

	$("#linkJsonImport").off().on('click', function()
  	{
  		$("#divInformationImport").hide()
  		$("#divJsonImport").show();
  		$("#divListImport").hide();
  		$("#linkJsonImport").parent().attr('class', 'active');
  		$("#linkInformationImport").parent().attr('class', '');
  		$("#linkListImport").parent().attr('class', '');
  	});

  	$("#linkInformationImport").off().on('click', function()
  	{
  		$("#divInformationImport").show()
  		$("#divJsonImport").hide();
  		$("#divListImport").hide();
  		$("#linkJsonImport").parent().attr('class', '');
  		$("#linkInformationImport").parent().attr('class', 'active');
  		$("#linkListImport").parent().attr('class', '');
  	});

  	$("#linkListImport").off().on('click', function()
  	{
  		$("#divInformationImport").hide();
  		$("#divJsonImport").hide();
  		$("#divListImport").show();
  		$("#linkJsonImport").parent().attr('class', '');
  		$("#linkInformationImport").parent().attr('class', '');
  		$("#linkListImport").parent().attr('class', 'active');
  	});

  	$("#linkJsonRejet").off().on('click', function()
  	{
  		$("#divInformationRejet").hide();
  		$("#divJsonRejet").show();
  		$("#divListRejet").hide();
  		$("#linkJsonRejet").parent().attr('class', 'active');
  		$("#linkInformationRejet").parent().attr('class', '');
  		$("#linkListRejet").parent().attr('class', '');
  	});

  	$("#linkInformationRejet").off().on('click', function()
  	{
  		$("#divInformationRejet").show();
  		$("#divJsonRejet").hide();
  		$("#divListRejet").hide();
  		$("#linkJsonRejet").parent().attr('class', '');
  		$("#linkInformationRejet").parent().attr('class', 'active');
  		$("#linkListRejet").parent().attr('class', '');
  	});

  	$("#linkListRejet").off().on('click', function()
  	{
  		$("#divInformationRejet").hide();
  		$("#divJsonRejet").hide();
  		$("#divListRejet").show();
  		$("#linkJsonRejet").parent().attr('class', '');
  		$("#linkInformationRejet").parent().attr('class', '');
  		$("#linkListRejet").parent().attr('class', 'active');
  	});


});	

var directoryTable = null;
function resetDirectoryTable() 
{ 
	console.log("resetDirectoryTable");

	if( !$('.directoryTable').hasClass("dataTable") )
	{
		directoryTable = $('.directoryTable').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				"sLengthMenu" : "Show _MENU_ Rows",
				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[1, 'asc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] ],
			"iDisplayLength" : 10,
			"destroy": true
		});
	} 
	else 
	{
		if( $(".directoryLines").children('tr').length > 0 )
		{
			directoryTable.dataTable().fnDestroy();
			directoryTable.dataTable().fnDraw();
		} else {
			console.log(" directoryTable fnClearTable");
			directoryTable.dataTable().fnClearTable();
		}
	}
}

function useCodeMirror(element) 
{ 
	editor = CodeMirror.fromTextArea(document.getElementById(element), {
						    lineNumbers: true,
						  });
}
</script>