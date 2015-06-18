<div class="col-md-12">
	<input type="hidden" id="post" value="<?php echo $result;?>"/>
    <form id="formfile" method="POST" action="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/tools/dataimport/';?>" enctype="multipart/form-data">
		<div class="form-group col-md-4">
			<label for="fileimport">Données à importer (csv) :</label><input type="file" id="fileimport" name="fileimport" accept=".csv">
		</div>
		<div class="form-group col-md-4">
			<label for="mapping">Mapping (json) :</label><input type="file" id="mapping" name="mapping" accept=".json">
		</div>
		<div class="form-group col-md-4">
			<input type="submit" class="btn btn-primary"id="sumitVerification" value="Vérification"/>
		</div>
	</form>
	<form id="formjson" method="POST" action="<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/tools/importmongo/';?>">
		<?php
		if(isset($json))
		{
			echo '<h3 class="col-md-12">Version JSON</h3>';
			echo '<div class="form-group col-md-12">';
				echo '<div class="form-group col-md-5">';
					echo '<label class="col-md-12" for="visualisationJSON">Données à importer</label><textarea class="col-md-12" id="visualisationJSON" rows="10"  readonly>'.$json.'</textarea>';
				echo '</div>';
				echo '<div class="col-md-5 col-md-offset-2">';
					echo '<label class="col-md-12" for="rejet">Données rejetés</label><textarea class="col-md-12" id="rejet" rows="10"  readonly>'.$jsonrejet.'</textarea>';
				echo '</div>';
			echo '</div>';
			echo '<div class="col-md-5 col-md-offset-5">';
				echo  '<a href="#" class="btn btn-primary col-md-3" type="submit" id="sumitImport">Import</a>';
			echo '</div>';
		}
		?>
	</br>
	</form>
</div>
<script type="text/javascript">
 jQuery(document).ready(function() 
{

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
</script>