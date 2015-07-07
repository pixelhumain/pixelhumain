<div class="col-md-12">
	<form id="formfile" method="POST" action="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/tools/importjson/';?>" enctype="multipart/form-data">
		<input type="hidden" id="result" value="<?php echo $result ; ?>"/>
		<div class="row">
			<div class="form-group col-md-4">
				<select id="choose" name="choose">
					<option value="new">Nouvelles données</option>
				  	<option value="modify">Modifier une donnée</option>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label for="fileimport">Données à importer (JSON) :</label><input type="file" id="fileimport" name="fileimport" accept=".json">
			</div>
		</div>
		<div class="row">
			<div id="divChooseMapping" class="form-group col-md-4">
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

		echo ' 	
				<div class="form-group col-md-12">
					<h3 class="col-md-12">Mapping</h3>
					<div class="form-group col-md-4">
						<label for="source">Source : </label>';
						if(isset($oneMapping))
							echo '<input type="text" id="source" name="source" value="'.$oneMapping["src"].'">';
						else
							echo '<input type="text" id="source" name="source" value="">';

						if(isset($json_origine))
							echo '<textarea id="json_origine" name="json_origine" >'.$json_origine.'</textarea>';
						if(isset($nameFile))
							echo '<input type="hidden" id="nameFile" value="'.$nameFile.'">';

						if(isset($nameFile))
							echo '<input type="hidden" id="chooseSelected" value="'.$choose.'">';
	
					
						
									
		echo'		</div>
					<div class="form-group col-md-4">
						<label for="url">URL : </label>';
						if(isset($oneMapping))
							echo '<input type="text" id="url" name="url" value="'.$oneMapping["url"].'">';
						else
							echo '<input type="text" id="url" name="url" value="">';

						
		echo'		</div>
					<div class="form-group col-md-4">
						<label for="lien">Lien : </label>
						<select id="lien">';
		    				if(isset($arbre))
							{
								foreach ($arbre as $key => $value) 
								{
									echo '<option value="'.$value.'">'.$value.'</option>';
								}
							}
	echo '				</select>
					</div>
				</div>

				<div class="form-group col-md-12">

					<div id="divtab" class="table-responsive">
				    	<table id="tabcreatemapping" class="table table-striped table-bordered table-hover">
				    		<thead>
					    		<tr>
					    			<th>Colonne CSV</th>
					    			<th>Mapping</th>
					    			<th>Ajouter/Supprimer</th>
					    		</tr>
				    		</thead>
					    	<tbody class="directoryLines" id="bodyCreateMapping">
					    		<tr id="LineAddMapping">
					    			<td>
					    				<input type="hidden" id="nbligne" value="0"/>
					    				<select id="selectHeadCSV">';
					    				if(isset($arbre))
										{
											foreach ($arbre as $key => $value) 
											{
												echo '<option value="'.$value.'">'.$value.'</option>';
											}
										}
	echo '								</select>
					    			</td>
					    			<td><input type="text" id="textMapping" value=""/></td>
					    			<td><input type="submit" id="addMapping" class="btn btn-primary" value="Ajouter"/>
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

	?>
	</div>

	<div id="visualisationGlobal">
		<div class="col-md-12">
			<h3 class="col-md-12">Vérification avant import</h3>
			<label>Données importé :</label>
				<ul class="nav nav-tabs">
					<li role="presentation" class="active"><a href="#" id="linkJsonImport">JSON</a></li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-body">
						<div id="divJsonImport">
						    <textarea class="col-md-12 form-control" id="jsonimport" rows="10"  readonly></textarea>
						</div>
					</div>
				</div>
		</div>
					
		<div class="col-md-12">
			<label>Données rejetée :</label>
			<ul class="nav nav-tabs">
			  <li role="presentation" class="active"><a href="#" id="linkJsonRejet">JSON</a></li>
			</ul>
			<div class="panel panel-default">
			  	<div class="panel-body">
			  		<div id="divJsonRejet">
			    		<textarea class="col-md-12 form-control" id="jsonrejet" rows="10"  readonly></textarea>
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
	
	bindMappingEvents();

	mappingCodeMiror =  useCodeMirror("jsonmapping");
	importCodeMiror = useCodeMirror("jsonimport");
	rejetCodeMiror = useCodeMirror("jsonrejet");

	$("#json_origine").hide();
	$("#divChooseMapping").hide();
	$("#visualisationGlobal").hide();
	$("#divInformationImport").hide();
	$("#divInformationRejet").hide();
	$("#divListImport").hide();
	$("#divListImport").css('overflow', 'auto');
	$("#divListRejet").hide();
	$("#divListRejet").css('overflow', 'auto');

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
  		
  		var tabmapping = [];
  		var tabIDMapping = [];
  		nbligne = $("#nbligne").val();
  		for (i = 1; i <= nbligne; i++) 
  		{
  			tabmapping[i] = $("#labelMapping"+i).text();
  			tabIDMapping[i] = $("#valueheadCSVMapping"+i).text();
		}

		if(tabmapping != "")
  		{
	  		$.ajax({
		        type: 'POST',
		        data: {json_origine: $("#json_origine").val(), tabidmapping : tabIDMapping, chooseSelected : $("#chooseSelected").val(), mappingSelected : $("#mappingSelected").val(), chooseSelected : $("#chooseSelected").val(), separateur : $("#separateurMapping").val(), nameFile : $("#nameFile").val(), source : $("#source").val(), url : $("#url").val(), tabmapping : tabmapping, tabCSV : $("#tabCSV").val(), lien : $('#lien').val()},
		        url: baseUrl+'/tools/traitermappingjson/',
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

						changeCode(mappingCodeMiror, data.jsonmapping);
						changeCode(importCodeMiror, data.jsonimport) ;
						changeCode(rejetCodeMiror, data.jsonrejet);

						
		       		}
		       	}
		    });

			
		}
		else
		{
			toastr.error("Vous devez ajouter des éléments au mapping.");
		}
		
  		return false;
  	});

	$("#sumitImport").off().on('click', function()
  	{
  		$.ajax({
	        type: 'POST',
	        data: {jsonrejet : $('#jsonrejet').val(), mappingSelected : $("#mappingSelected").val(), chooseSelected : $("#chooseSelected").val(), jsonimport : $('#jsonimport').val(), jsonmapping : $('#jsonmapping').val()},
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


 
});

function bindMappingEvents()
{
	$(".deleteLineMapping").off().on('click', function()
  	{
  		$(this).parent().parent().remove();
  	});
}

	function useCodeMirror(element) 
{ 
	editor = CodeMirror.fromTextArea(document.getElementById(element), {
						    lineNumbers: true,
						    mode:  {name: "javascript", json: true}
						  });

	return editor;
}

function changeCode(editor, text) 
{
  // editor = document.getElementById(element);

   editor.setValue(text);
   editor.getDoc().clearHistory();
}

</script>