<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jsonview/jquery.jsonview.js' , CClientScript::POS_END);
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/jsonview/jquery.jsonview.css');
?>

<div class="col-md-12">
	<form id="formfile" method="POST" action="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/tools/traitercsv/';?>" enctype="multipart/form-data">
		<input type="hidden" id="result" value="<?php echo $result ; ?>"/>
		
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
				<label> Séparateur de données :</label>
				<select id="separateurDonnees" name="separateurDonnees">
					<option value=";">point-virgule</option>
				  	<option value=",">virgule</option>
				  	<option value=".">point</option>
				  	<option value=" ">espace</option>
				</select>
			</div>
			<div class="col-md-4">
				<label> Séparateur de texte :</label>
				<select id="separateurTexte" name="separateurTexte">
					<option value='"'>guillemet</option>
				  	<option value="'">cote</option>
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
							echo '<option value="'.$key .'">'.$value["nameFile"].'</option>';

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
	<div id="divmapping">
	<?php
		
		if(isset($chooseMapping))
			$oneMapping = PHDB::findOne(City::COLLECTION_IMPORTHISTORY, array("_id"=>new MongoId($chooseMapping)));
	?>
	
		<div class="form-group col-md-12">
			<h3 class="col-md-12">Mapping</h3>
			<div class="form-group col-md-4">
				<label for="source">Source : </label>
				<?php
					if(isset($oneMapping))
						echo '<input type="text" id="source" name="source" value="'.$oneMapping["src"].'">';
					else
						echo '<input type="text" id="source" name="source" value="">';
									
					if($result == true)
					{
						echo '<input type="hidden" id="chooseSelected" value="'.$choose.'">
									<input type="hidden" id="nameFile" value="'.$nameFile.'">
									<input type="hidden" id="separateurMapping" value="'.$separateur.'">';
						if($choose == "modify")
						{	
							echo '<input type="hidden" id="mappingSelected" value="'.$chooseMapping.'">';
						}
					}
				?>
										
			</div>
			<div class="form-group col-md-4">
				<label for="url">URL : </label>
				<?php
					if(isset($oneMapping))
						echo '<input type="text" id="url" name="url" value="'.$oneMapping["url"].'">';
					else
						echo '<input type="text" id="url" name="url" value="">';
				?>
			</div>
			
		</div>

		<div class="form-group col-md-12">
			<div class="form-group col-md-4">
				<label for="lien">Lien : </label>
				<select id="lien">
					<?php
						//if(isset(Yii::app()->session["tabCSV"]))
						if(isset($tabCSV))
						{
		    				foreach ($tabCSV[0] as $key => $value) 
							{
								echo '<option value="'.$key.'">'.$value.'</option>';
							}
						}
					?>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label for="subfile">Fichier : </label>
				<select id="subfile">
					<?php
						if($result == true)
						{
							$arrayNameFile = explode(".", $nameFile);
							$subfiles = scandir("../../modules/cityData/filesCityData/".$arrayNameFile[0]);
							foreach ($subfiles as $key => $value){
				                if(strpos($value, $arrayNameFile[0]) !== false) 
				                	echo '<option value="'.$value.'">'.$value.'</option>';
				            }
				        }
					?>
				</select>
			</div>
		</div>

		<div class="form-group col-md-12">

			<div id="divtab" class="table-responsive">
		    	<table id="tabcreatemapping" class="table table-striped table-bordered table-hover">
		    		<thead>
			    		<tr>
			    			<th>Colonne CSV</th>
			    			<th>Mapping</th>
			    			<th>Type</th>
			    			<th>Libellé</th>
			    			<th>Ajouter/Supprimer</th>
			    		</tr>
		    		</thead>
			    	<tbody class="directoryLines" id="bodyCreateMapping">
				    	<?php
				    		$nbligne = 0 ;
				    		if($choose == "modify")
				    		{
				    			
				    			foreach ($oneMapping["fields"] as $key => $value) 
				    			{
				    				
				    				$nbligne++;
				    				$i = 0;
				    				$trouver = false ;
				    				while($trouver == false && $i < count($tabCSV[0]))
				    				{
				    					if($tabCSV[0][$i] == $key)
				    					{
				    						$trouver = true;
				    					}
				    					else	
				    						$i++;
				    				}
				    				echo '<tr  id="lineMapping'.$nbligne.'">
				    						<td id="valueheadCSVMapping'.$nbligne.'">'.$key .'</td>
				    						<td id="labelMapping'.$nbligne.'">'.$value.'</td>
				    						<td id="typeMapping'.$nbligne.'">'.$oneMapping["type"][$key].'</td>
				    						<td id="libelleMapping'.$nbligne.'">'.$oneMapping["labels"][$key].'</td>
				    						<td>
				    							<input type="hidden" id="keyheadCSVMapping'.$nbligne.'" value="'.$i.'">
				    							<a href="#" class="deleteLineMapping btn btn-primary">X</a></td>
				    					</tr>';
				    				
				    			}
				    		}
				    	?>
						<tr id="LineAddMapping">
			    			<td>
			    				<input type="hidden" id="nbligne" value="<?php echo $nbligne ; ?>"/>
			    				<select id="selectHeadCSV">
			    				<?php
				    				if(isset($tabCSV))
									{
					    				foreach ($tabCSV[0] as $key => $value) 
										{
											echo '<option value="'.$key.'">'.$value.'</option>';
										}
									}
								?>
								</select>
			    			</td>
			    			<td><input type="text" id="textMapping" value=""/></td>
			    			<td>
			    				<select id="typeMapping">
			    					<option value="INT">INT</option>
			    					<option value="STRING">STRING</option>
			    					<option value="FLOAT">FLOAT</option>
			    					<option value="JSON">JSON</option>
								</select>
			    			</td>
			    			<td><input type="text" id="libelleMapping" value=""/></td>
			    			<td><input type="submit" id="addMapping" class="btn btn-primary" value="Ajouter"/>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="form-group col-md-12">
			<div class="form-group col-md-4 col-md-offset-4">
				<a href="#" id="sumitMapping" class="btn btn-primary">Visualisation</a>
			</div>
		</div>

		
		<div id="visualisationGlobal">
			<h3 class="col-md-12">Vérification avant import</h3>
			<div class="col-xs-12 col-sm-4">
				<input type="hidden" id="typeData" value=""/>
				<label>Données importé :</label>
					<div class="panel panel-default">
						<div class="panel-body">
							<div id="divJsonImport" class="panel-scroll height-230">
								<input type="hidden" id="jsonimport" value="">
							    <div class="col-md-12" id="divjsonimport"></div>
							</div>
						</div>
					</div>
			</div>
						
			<div class="col-xs-12 col-sm-4">
				<label>Données rejetée :</label>
				<div class="panel panel-default">
				  	<div class="panel-body ">
				  		<div id="divJsonRejet" class="panel-scroll height-230">
				  			<input type="hidden" id="jsonrejet" value="">
				    		<div class="col-md-12" id="divjsonrejet" ></div>
				  		</div>
				  	</div>
				</div>
			</div>

			<div class="col-xs-12 col-sm-4">
				<label>Mapping :</label>
				<div class="panel panel-default">
				  	<div class="panel-body">
				  		<div id="divJsonMapping" class="panel-scroll height-230">
				  			<input type="hidden" id="jsonmapping" value="">
				    		<div class="col-md-12" id="divjsonmapping"></div>
				  		</div>
				  	</div>
				</div>
			</div>
			<div class="col-md-5 col-md-offset-5">
				<a href="#" class="btn btn-primary col-md-3" type="submit" id="sumitImport">Import</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() 
{
	bindMappingEvents();

	$("#divChooseMapping").hide();
	$("#visualisationGlobal").hide();

	if($("#result").val() == false)
		$("#divmapping").hide();
	
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
  		inc = 1;
  		deja = false ;

  		while(deja == false && inc <= nbligne)
  		{
  			if($("#valueheadCSVMapping"+inc).text() == $("#selectHeadCSV option:selected").text() || $("#labelMapping"+inc).text() == $("#textMapping").val())
  				deja = true;
  			inc++;
  		}

  		if(deja == false)
  		{
	  		ligne = '<tr id="lineMapping'+nbligne+'"> ';
	  		ligne =	 ligne + '<td id="valueheadCSVMapping'+nbligne+'">' + $("#selectHeadCSV option:selected").text() + '</td>';
	  		ligne =	 ligne + '<td id="labelMapping'+nbligne+'">' + $("#textMapping").val() + '</td>';
	  		ligne =	 ligne + '<td id="typeMapping'+nbligne+'">' + $("#typeMapping").val() + '</td>';
	  		ligne =	 ligne + '<td id="libelleMapping'+nbligne+'">' + $("#libelleMapping").val() + '</td>';
	  		ligne =	 ligne + '<td><input type="hidden" id="keyheadCSVMapping'+nbligne+'" value="'+$("#selectHeadCSV").val()+'">';
	  		ligne =	 ligne + '<a href="#" class="deleteLineMapping btn btn-primary">X</a></td></tr>';
	  		$("#nbligne").val(nbligne);
	  		$("#LineAddMapping").before(ligne);
	  		bindMappingEvents();

	  	}
	  	else
	  	{
	  		toastr.error("Une des deux infomations sont déja utilisée.");
	  	}

  		return false;
  		
  	});


  	


	$("#sumitMapping").off().on('click', function()
  	{
  		

		/*$.blockUI({
		message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
		           '<blockquote>'+
		             '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
		             '<cite title="Hegel">Hegel</cite>'+
		           '</blockquote> '
		});*/


  		var tabmapping = [];
  		var tabIDmapping = [];
  		var tabTypeMapping = [];
  		var tabLibelleMapping = [];
  		nbligne = $("#nbligne").val();
  		for (i = 0; i < nbligne; i++) 
  		{
  			tabmapping[i] = $("#labelMapping"+(i+1)).text();
  			tabIDmapping[i] = $("#keyheadCSVMapping"+(i+1)).val();
  			tabTypeMapping[i] = $("#typeMapping"+(i+1)).text();
  			tabLibelleMapping[i] = $("#libelleMapping"+(i+1)).text();
		}

		if(tabmapping != "")
  		{
	  		$.ajax({
		        type: 'POST',
		        data: {
		        		tabidmapping : tabIDmapping, 
		        		mappingSelected : $("#mappingSelected").val(), 
		        		chooseSelected : $("#chooseSelected").val(), 
		        		separateur : $("#separateurMapping").val(), 
		        		nameFile : $("#nameFile").val(), 
		        		source : $("#source").val(), 
		        		url : $("#url").val(), 
		        		tabmapping : tabmapping, 
		        		tabCSV : $("#tabCSV").val(), 
		        		lien : $('#lien').val(),
		        		subfile : $('#subfile').val(),
		        		tabTypeMapping : tabTypeMapping,
		        		tabLibelleMapping : tabLibelleMapping
		        	},
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
						
						$("#jsonmapping").val(data.jsonmapping);
						$("#jsonimport").val(data.jsonimport);
						$("#jsonrejet").val(data.jsonrejet);

						$("#divjsonmapping").JSONView(data.jsonmapping);
		      			$('#divjsonmapping').JSONView('toggle', 1);
		      			$("#divjsonimport").JSONView(data.jsonimport);
		      			$('#divjsonimport').JSONView('toggle', 1);	
		      			$("#divjsonrejet").JSONView(data.jsonrejet);
		      			$('#divjsonrejet').JSONView('toggle', 1);	
		       		}
		       		//$.unblockUI();
		       	}
		    });

			
		}
		else
		{
			toastr.error("Vous devez ajouter des éléments au mapping.");
		}

		
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
  		/*$.blockUI({
		message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
  	            '<blockquote>'+
  	              "<p>Rien n'est plus proche du vrai que le faux</p>"+
  	              '<cite title="Einstein">Einstein</cite>'+
  	            '</blockquote> '
		});*/
  		$.ajax({
	        type: 'POST',
	        data: { typeData : $('#typeData').val(), 
	        		jsonrejet : $('#jsonrejet').val(), 
			        mappingSelected : $("#mappingSelected").val(), 
			        chooseSelected : $("#chooseSelected").val(), 
			        jsonimport : $('#jsonimport').val(), 
			        jsonmapping : $('#jsonmapping').val()},
	        url: baseUrl+'/tools/importmongo/',
	        dataType : 'json',
	        success: function(data)
	        {
	            console.dir(data);
	            if(data.result)
	              	toastr.success("Les données ont été ajouté.");
	            else
	                toastr.error("Erreur");
	           	//$.unblockUI();
	        }
	    });
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

function bindMappingEvents()
{
	$(".deleteLineMapping").off().on('click', function()
  	{
  		$(this).parent().parent().remove();
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

}
</script>