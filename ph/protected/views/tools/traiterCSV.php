<div class="col-md-12">
	<?php //var_dump($tabCSV) ?>
	<form id="formfile" method="POST" action="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/tools/traitercsv/';?>" enctype="multipart/form-data">
		<div class="row">
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
			<div class="form-group col-md-4">
				<input type="submit" class="btn btn-primary" id="sumitVerification" value="Vérification"/>
			</div>
		</div>
	</form>
	<form id="formmapping">

	<?php
		if($result == true)
		{
			//var_dump($separateur);
			echo ' 	<div class="form-group col-md-12">
						<h3 class="col-md-12">Mapping</h3>
						<div class="form-group col-md-4">
							<label for="source">Source : </label><input type="text" id="source" name="source">
						</div>
						<div class="form-group col-md-4">
							<label for="url">URL : </label><input type="text" id="url" name="url">
						</div>	
					</div>';
			echo '	<div class="form-group col-md-12">
						<div id="divtab" class="table-responsive">
					    	<table id="tabcreatemapping" class="table table-striped table-bordered table-hover  directoryTable ">
					    		<thead>
						    		<tr class="active">
						    			<th>Colonne CSV</th>
						    			<th>Mapping</th>
						    			<th>Lien</th>
						    		</tr>
					    		</thead>
						    	<tbody class="directoryLines">';
									foreach (Yii::app()->session["tabCSV"][0] as $key => $value) 
									{
										echo '<tr class="active">';
											echo '<td>'.$value.'</td>';
											echo '<td><input type="text" id="'.$key.'" value=""/></td>';
											echo '<td><input type="radio" name="lien" value="'.$value.'"></td>';
										echo '</tr>';
									}
			echo '  			</tbody>
							</table>
							
					  	</div>
					</div>';

			echo ' <div class="form-group col-md-12">
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
					<li role="presentation" class="active"><a href="#" id="linkInformationImport">Information</a></li>
					<li role="presentation"><a href="#" id="linkJsonImport">JSON</a></li>
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
						    	<thead>
						    		<tr class="active">
						    			<?php
						    			if(isset(Yii::app()->session["tabCSV"][0]))
						    			{
							    			foreach (Yii::app()->session["tabCSV"][0] as $key => $value) 
											{
												echo '<th>'.$value.'</th>';
											}
										}
										?>
						    		</tr>
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
			  <li role="presentation" class="active"><a href="#" id="linkInformationRejet">Information</a></li>
			  <li role="presentation"><a href="#" id="linkJsonRejet">JSON</a></li>
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
			    		<table class="table table-striped table-bordered table-hover ">
			    			<thead>
					    		<tr class="active">
					    			<?php
					    			if(isset(Yii::app()->session["tabCSV"][0]))
						    		{
						    			foreach (Yii::app()->session["tabCSV"][0] as $key => $value) 
										{
											echo '<th>'.$value.'</th>';
										}
									}
									?>
					    		</tr>
				    		</thead>
				    		<tbody id="tableBodyRejet">
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
	$("#visualisationGlobal").hide();
	$("#divJsonImport").hide();
	$("#divJsonRejet").hide();
	$("#divListImport").hide();
	$("#divListImport").css('overflow', 'auto');
	$("#divListRejet").hide();
	$("#divListRejet").css('overflow', 'auto');
	

	$("#sumitMapping").off().on('click', function()
  	{

  		selection = $("#tabcreatemapping input:text");
  		var tabmapping = [];
  		//tabmapping = jQuery.makeArray( selection );
  		selection.each(function () 
  		{
    		if($(this).val() != '') 
    		{
		       tabmapping[$(this).attr("id")] = $(this).val();
		    }
		});
  		if($('input[type=radio][name=lien]:checked').length > 0)
		{
			$.ajax({
		        type: 'POST',
		        data: {source : $("#source").val(), url : $("#url").val(), tabmapping : tabmapping, tabCSV : $("#tabCSV").val(), lien : $('input[type=radio][name=lien]:checked').val()},
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
						//useCodeMirror("jsonmapping", data.jsonmapping);
						$("#jsonimport").html(data.jsonimport);
						$("#jsonmapping").html(data.jsonmapping);
						$("#jsonrejet").html(data.jsonrejet);
						
						console.dir();
						
						$("#listeInformationImport").html('<li class="list-group-item">'+ data.nbcommunemodif +' communes mis à jours</li>');
						$("#listeInformationImport").append('<li class="list-group-item">'+ data.nbinfoparcommune +' informations seront ajouté par communes</li>');
						$("#listeInformationRejet").html('<li class="list-group-item">'+ data.nbcommunerejet +' communes mis à jours</li>');

						ligne ="";
						$.each(data.arrayCsvImport, function( keyRows, valueRows )
						{
							ligne = ligne + "<tr>" ;
						    $.each(valueRows, function( keyCols, valueCols )
							{
							    ligne = ligne + "<td>"+ valueCols +"</td>";
							    
							});
							ligne = ligne + "</tr>" ;
						});
						$("#tableBodyImport").html(ligne);

						ligne ="";
						$.each(data.arrayCsvRejet, function( keyRows, valueRows )
						{
							ligne = ligne + "<tr>" ;
						    $.each(valueRows, function( keyCols, valueCols )
							{
							    ligne = ligne + "<td>"+ valueCols +"</td>";
							});
							ligne = ligne + "</tr>" ;
						});
						$("#tableBodyRejet").html(ligne);
		       		}
		       	}
		    });
		}
		else
		{
			toastr.error("Vous devez sélectionner un lien.");
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
  		$.ajax({
	        type: 'POST',
	        data: {jsonimport : $('#jsonimport').val()},
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

/*function useCodeMirror(element, json ) 
{ 
	editor = CodeMirror.fromTextArea(document.getElementById(element), {
						    lineNumbers: true,
						    value : json
						  });
}*/
</script>