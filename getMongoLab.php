<?php
try
{
	echo "start";
    $connection = new Mongo('mongodb://pixelhumaindb:2210ph@ds049157.mongolab.com:49157/pixelhumain');
    $database   = $connection->selectDB('pixelhumain');
    
	echo "connected";
}
catch(MongoConnectionException $e)
{
    die("Failed to connect to database ".$e->getMessage());
}
echo "find";

?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Pixels Actifs</title>
    <link type="text/css" rel="stylesheet" href="" />
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<script src="../js/vendor/jquery-1.8.3.min.js"></script>
	<style>
	
	</style>
</head>
<body>

<?php 
$collection = $database->selectCollection('pixelsactifs');
$cursor = $collection->find();
?>
<h1><?php echo $collection->count()?> Pixels Actifs <?php echo "'".$_GET['find']."'";?></h1>
<table class="layout display responsive-table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Représentant</th>
			<th colspan="2">Objet</th>
        </tr>
    </thead>
    <tbody>
<?php
while ($cursor->hasNext()):
    $pixelactif = $cursor->getNext(); 
	?>
	<tr>
		<td class="organisationnumber"><?php echo $pixelactif['nom'] ?></td>
		<td class="organisationname"><?php echo $pixelactif['representant']?></td>
		<td class="organisationname"><?php echo $pixelactif['objet']?></td>
		<td class="actions">
			<a href="?" class="edit-item" title="Edit">Edit</a>
			<a href="?" class="remove-item" title="Remove">Remove</a>
		</td>
	</tr>
<?php endwhile;?>
</tbody>
</table>

<br/>
<br/>

<form id="newPA" action="save.php" method="POST">
nom <input name="nom"><br/>
representant<input name="representant"><br/>
objet<input name="objet">
<br/>
<button class="ladda-button green expand-right"><span class="label">Envoyer</span> <span class="spinner"></span></button>
</form>
<script>
$(document).ready(function() { 
	$("#newPA").submit(function(){
		alert("newPA");
		$.ajax({
		  type: "POST",
		  url: "save.php",
		  data: $("#newPA").serialize(),
		  success: function(data){
			if(data.result==true)
				window.location.reload();
			else
				alert("ERROR");
		  },
		  dataType: 'json'
		});
		return false;
	});
});
</script>
</body>
</html>