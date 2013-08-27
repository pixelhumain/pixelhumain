<?php
require_once('./config/configDB.php');
include('./connect.php');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
        <title>Liste des Pixels Actifs</title>
        <meta name="keywords" lang="fr" content="pixel actif">
		<meta name="description" content="Liste des Pixels Actifs">
		<meta name="publisher" content="Pixel Humain">
		<meta name="author" lang="fr" content="Pixel Humain" />
		<meta name="robots" content="Index,Follow" />
		
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
		<link rel="stylesheet" href="css/bootstrap-image-gallery.min.css">
		<link rel="shortcut icon" href="img/logo/favicon.gif" />
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/mainPixelActif.css">
		<link rel="stylesheet" href="css/select2.css">
    </head>
    <body>
		<!-- Mutualisation de code entre 2 fichiers index4.php et listePixelActifs.html => crée un html à part qui garantie unicité du code et on transforme le html père en .php car on utilise des fonctionnalité php "include" -->
       <?php include('./menuPH.html');?>
	   <?php include('./modalPA.php');?>
		
        <div class="container" id="accueil">
			<?php 
			$query = array();
			if(isset($_GET['cp']))
				$query['cp'] = new MongoRegex('/'.$_GET['cp'].'/i');
			if(isset($_GET['type']))
				$query['type'] = new MongoRegex('/'.$_GET['type'].'/i');
			if(isset($_GET['tags'])){
				// multisélection de tags => il faut pouvoir décomposer ma multisélection en plusieurs sélections élémentaires
				$tagsT = explode(",",$_GET['tags']);
				$tagsSelected = array();
				foreach($tagsT as $t)
					array_push($tagsSelected,new MongoRegex('/'.$t.'/i'));
				$query['actions.tags'] = array('$in' => $tagsSelected);
			}
			/// affichage de la valeur d'un objet  var_dump( $query);	d'une variable echo $var
			
			$cursor = $connection->pixelhumain->citoyens->find( $query );
			?>	
            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit">
				
               <h1> Liste des Pixels Actifs  (<?php echo $cursor->count()?>)</h1> 
				<p class="fss">
					Vous pouvez filtrer les Pixels Actifs par localité, thématique et/ou type
				</p>
				<div class="controls controls-row">
					<input type="text" class="span1" id="cpFilter" placeholder="CP" value="<?php if( isset($_GET['cp']) && is_numeric($_GET['cp'])) echo $_GET['cp'];?>" />
					<!-- $collection_tags = $connection->pixelhumain->->selectCollection('tags'); 	-->
					<select id="tags" class="span4" multiple  placeholder="Sélectionner une ou plusieurs thématique(s)">
						<?php
						// curseur de type tableau de valeurs avec 1 clé (findOne)  where array() (je prends tout) qui a plusieurs valeurs array('list')
						$cursorTags = $connection->pixelhumain->tags->findOne( array(), array('list'));
						
						// Affichage d'un curseur de type tableau de valeurs. Je parcours le cursor, la clé est $c et la valeur est $tag
						foreach ($cursorTags['list'] as $tag):
						?>
							<option value="<?php echo $tag ?>" <?php if( isset($_GET['tags']) && $_GET['tags'] == $tag) echo "selected";?>  ><?php echo $tag ?></option>
						<?php endforeach;?>
					</select>
					
					<select id="type" class="span3" >
						<option value="">Sélectionner un type</option>
						<?php
						// curseur de type tableau de valeurs avec 1 clé (findOne)  where array() (je prends tout) qui a plusieurs valeurs array('list')
						$cursorTypes = $connection->pixelhumain->types->findOne( array(), array('list'));
						
						// Affichage d'un curseur de type tableau de valeurs. Je parcours le cursor, la clé est $c et la valeur est $pixelactif
						foreach ($cursorTypes['list'] as $c=>$type):
						?>
							<option value="<?php echo $c ?>" <?php if( isset($_GET['type']) && $_GET['type'] == $c ) echo "selected";?> ><?php echo $type ?></option>
						<?php endforeach;?>
					</select>
					<!-- Il ne faut pas laisser href vide sinon la page se recharge à l'identique -->
					<span class="m15 span2"> <a href="javascript:;" id="filtrer" class="btn btn-primary"  >Filtrer</a></span> 
				</div>
						
				
				<table class="layout display responsive-table">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Représentant</th>
							<th>Code postal</th>
							<th>zone</th>
							<th colspan="2">Objet</th>
						</tr>
					</thead>
					<tbody>
						
						<?php 
						// Affichage d'un curseur de type clé : valeur. Je parcours le cursor, la clé est $c et la valeur est $pixelactif
						foreach ($cursor as $c=>$pixelactif):
							?>
							<tr>
								<td class="organisationnumber"><?php echo $pixelactif['name'] ?></td>
								<td class="organisationname"><?php echo $pixelactif['manager']?></td>
								<td class="organisationname"><?php echo $pixelactif['cp']?></td>
								<td class="organisationname"><?php echo $pixelactif['actions'][0]['area']?></td>
								<td class="organisationname"><?php echo $pixelactif['description']?></td>
								<td class="actions">
									<a href="?" class="edit-item" title="Edit">Edit</a>
									<a href="?" class="remove-item" title="Remove">Remove</a>
								</td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				
				
			</div>
        </div> <!-- /container -->
		
		
		
		
	    <script type="text/javascript" src="js/vendor/jquery-1.9.1.min.js"></script>
        <script>window.jQuery || document.write('<script type="text/javascript" src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
		 <script type="text/javascript"  src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript"  src="js/main.js"></script>
        
		<script type="text/javascript"  src="js/jquery.validate.min.js"></script>
		<script type="text/javascript"  src="js/select2.js"></script>
		<script type="text/javascript"  src="js/main.pixelActif.js"></script>

        <script>
			
            /*var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));*/
			
			 var uvOptions = {};
			  (function() {
				var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
				uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/YmmyBM5muP7JoGkF31YDg.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
			  })();
        </script>
    </body>
</html>
