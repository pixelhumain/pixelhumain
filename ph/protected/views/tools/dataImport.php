<div class="col-md-12">
	<input type="hidden" id="post" value="<?php echo $result;?>"/>
	<form id="formfile" method="POST" action="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/tools/dataimport/';?>" enctype="multipart/form-data">
		<div class="row">
			<div class="form-group col-md-4">
				<label for="fileimport">Données à importer (csv) :</label><input type="file" id="fileimport" name="fileimport" accept=".csv">
			</div>
			<div class="form-group col-md-4 col-md-offset-1">
				<label for="mapping">Mapping (json) :</label><input type="file" id="mapping" name="mapping" accept=".json">
			</div>
		</div>
		<div class="row">	
			<div class="col-md-4">
				<label> Séparateur(csv) :</label>
				<div class="radio">
				  	<label>
				    	<input type="radio" name="optionsRadios" id="optionsRadios1" value=";" checked>
				    	point-virgule
				  	</label>
				</div>
				<div class="radio">
				  	<label>
				    	<input type="radio" name="optionsRadios" id="optionsRadios2" value=",">
				    	virgule
					</label>
				</div>
				<div class="radio">
				  	<label>
				    	<input type="radio" name="optionsRadios" id="optionsRadios2" value=" ">
				    	espace
					</label>
				</div>
				<div class="radio">
				  	<label>
				    	<input type="radio" name="optionsRadios" id="optionsRadios2" value=".">
				    	point
					</label>
				</div>
			</div>
			<div class="form-group col-md-4 col-md-offset-1">
				<input type="submit" class="btn btn-primary"id="sumitVerification" value="Vérification"/>
			</div>
		</div>
	</form>
	<form id="formjson" method="POST">
		<?php
		if(isset($json))
		{
			echo '<div class="col-md-12">

					</div>';
		}
		if(isset($json))
		{
			//var_dump($arrayCsvImport);
			echo '<h3 class="col-md-12">Vérification avant import</h3>
				<div class="col-md-12">
					<label>Données importé :</label>
					<ul class="nav nav-tabs">
					  <li role="presentation" class="active"><a href="#" id="linkInformationImport">Information</a></li>
					  <li role="presentation"><a href="#" id="linkJsonImport">JSON</a></li>
					  <li role="presentation"><a href="#" id="linkListImport">Liste des données</a></li>
					</ul>
					<div class="panel panel-default">
					  	<div class="panel-body">
					  		<div id="divInformationImport">
					  			<ul class="list-group">
								    <li class="list-group-item">'.count($json['codeInsee']).' communes auront de nouvelles données</li>
								    <li class="list-group-item">'.count($jsonmapping->cityDataSrc->fields).' données seront ajouter pour chaque communes</li>
								</ul>
					  		</div>
					  		<div id="divJsonImport">
					    		<textarea class="col-md-12 form-control" id="visualisationJSON" rows="10"  readonly>'. FileHelper::indent_json(json_encode($json)).'</textarea>
					  		</div>
					  		<div id="divListImport" class="table-responsive">
					    		<table class="table ">';
									foreach ($arrayCsvImport as $keyligne => $valueligne) 
									{
										echo '<tr class="active">';
										foreach ($valueligne as $keycolonne => $valuecolonne) 
										{
											if($keyligne == 0)
											{
												echo '<th>'.$valuecolonne.'</th>';
											}
											else
											{
												echo '<td>'.$valuecolonne.'</td>';
											}
										}
										echo '</tr>';
									}
						echo '  </table>
					  		</div>
					  	</div>
					</div>
				</div>
				
				<div class="col-md-8 col-md-offset-2">
					<label>Données rejetée :</label>
					<ul class="nav nav-tabs">
					  <li role="presentation" class="active"><a href="#" id="linkInformationRejet">Information</a></li>
					  <li role="presentation"><a href="#" id="linkJsonRejet">JSON</a></li>
					  <li role="presentation"><a href="#" id="linkListRejet">Liste des données</a></li>
					</ul>
					<div class="panel panel-default">
					  	<div class="panel-body">
					  		<div id="divInformationRejet">
					  			<ul class="list-group">
								    <li class="list-group-item">'.count($jsonrejet['codeInsee']).' communes qui sont rejeté </li>
								</ul>
					  		</div>
					  		<div id="divJsonRejet">
					    		<textarea class="col-md-12 form-control" id="rejet" rows="10"  readonly>'. FileHelper::indent_json(json_encode($jsonrejet)).'</textarea>
					  		</div>
					  		<div id="divListRejet" >
					    		<table class="table ">';
									foreach ($arrayCsvRejet as $keyligne => $valueligne) 
									{
										echo '<tr class="active">';
										foreach ($valueligne as $keycolonne => $valuecolonne) 
										{
											if($keyligne == 0)
											{
												echo '<th>'.$valuecolonne.'</th>';
											}
											else
											{
												echo '<td>'.$valuecolonne.'</td>';
											}
										}
										echo '</tr>';
									}
						echo '  </table>
					  		</div>
					  	</div>
					</div>
				</div>

				<div class="col-md-8 col-md-offset-2">
					<label>Mapping :</label>
					<ul class="nav nav-tabs">
					  <li role="presentation" class="active"><a href="#">JSON</a></li>
					</ul>
					<div class="panel panel-default">
					  	<div class="panel-body">
					  		<div id="divJsonRejet">
					    		<textarea class="col-md-12 form-control" id="rejet" rows="10" >'.FileHelper::indent_json(json_encode($jsonmapping)).'</textarea>
					  		</div>
					  	</div>
					</div>
				</div>
				<div class="col-md-5 col-md-offset-5">
					<a href="#" class="btn btn-primary col-md-3" type="submit" id="sumitImport">Import</a>
				</div>';
		}
		?>
	</br>
	</form>
</div>
<script type="text/javascript">
jQuery(document).ready(function() 
{
	resetDirectoryTable() ;
	$("#divJsonImport").hide();
	$("#divJsonRejet").hide();
	$("#divListImport").hide();
	$("#divListImport").css('overflow', 'auto');
	$("#divListRejet").hide();
	$("#divListRejet").css('overflow', 'auto');
    
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
  		$("#linkJsonRejet").parent().attr('class', 'active');
  		$("#linkInformationRejett").parent().attr('class', '');
  	});

  	$("#linkInformationRejet").off().on('click', function()
  	{
  		$("#divInformationRejet").show();
  		$("#divJsonRejet").hide();
  		$("#linkJsonRejet").parent().attr('class', '');
  		$("#linkInformationRejet").parent().attr('class', 'active');
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

	if($("#post").val() == true)
    {
    	toastr.success("Vos données ont été sauvegardés.");
    }

	$('#formfile').submit(function() 
	{
	    if($("#fileimport").val() == "" || $("#mapping").val() == "")
	   	{
	   		toastr.error("Vous devez sélectionner un fichier pour les données et un pour le mapping.");
	   		return false;
	   	}
	   	else
	   	{
	   		var extensionFileImport = $("#fileimport").val().split('.');
	   		var extensionMapping = $("#mapping").val().split('.');

	   		//alert(extensionFileImport[(extensionFileImport.length - 1)]);

	   		if(extensionFileImport[(extensionFileImport.length - 1)] != "csv" || extensionMapping[(extensionMapping.length - 1)] != "json" )
	   		{
		   		toastr.error("Vous devez sélectionner un fichier dans le bon format.");
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
	        data: {visualisationJSON : $('#visualisationJSON').val()},
	        url: baseUrl+'/tools/importmongo/',
	        dataType : 'json',
	        success: function(data)
	        {
	            console.dir(data);
	            if(data.result)
	              	toastr.success("Vos invitations ont été envoyées.");
	            else
	                toastr.error("error2"); 
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
</script>