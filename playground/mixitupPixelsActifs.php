<?php
require_once('./config/configDB.php');
try
{
    $connection = new Mongoclient($dbconfig['connectionString']);
    $database   = $connection->pixelhumain;
    
}
catch(MongoConnectionException $e)
{
    die("Failed to connect to database ".$e->getMessage());
}

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
		<link rel="stylesheet" href="css/mixitup.css">
		<link rel="stylesheet" href="css/select2.css">
    </head>
    <body>
		<!-- Mutualisation de code entre 2 fichiers index4.php et listePixelActifs.html => crée un html à part qui garantie unicité du code et on transforme le html père en .php car on utilise des fonctionnalité php "include" -->
       <?php include('menuPH.html')?>
	   <?php include('modalPA.php')?>
		
		<div class="container hero-unit">
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
			$cursor = $database->pixelsactifs->find( $query );
			?>	
			<h1>VerMixel Actif (<?php echo $cursor->count()?>)</h1>
			
			<!-- FILTER CONTROLS -->
			
			<div class="controls">	
				<h3>Filter Controls</h3>
				<ul>					
					<li class="filter" data-filter="all">Show All</li>
					<?php
					$cursorTags = $database->tags->findOne( array(), array('list'));
					foreach ($cursorTags['list'] as $tag){
					?>
					<li class="filter" data-filter="<?php echo $tag ?>"><?php echo $tag ?></li>
					<?php } ?>
				</ul>
			</div>
			
			<!-- SORT CONTROLS -->
				
			<div class="controls">
				<h3>Sort Controls</h3>
				<ul>
					<li class="sort" data-sort="data-cat" data-order="desc">Descending</li>
					<li class="sort" data-sort="data-cat" data-order="asc">Ascending</li>
					<li class="sort active" data-sort="default" data-order="desc">Default</li>
				</ul>
			</div>
			
			<hr/>
			
			<!-- GRID -->
			
			<ul id="Grid">
				<?php 
				foreach ($cursor as $c=>$pixelactif){
					$tags = "";
					foreach ($pixelactif['actions'][0]['tags'] as $t)
						$tags .= " ".$t;
				?>
				<li class="mix <?php echo $tags?>" data-cat="1">
					<?php echo $pixelactif['name'].'<br/>'.$pixelactif['cp'].'<br/>'.$pixelactif['actions'][0]['area'] ?>
				</li>
				<?php }?>
				<li class="gap"></li> <!-- "gap" elements fill in the gaps in justified grid -->
			</ul>
			
		</div>
		
		
		
	    <script src="js/vendor/jquery-1.8.3.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/old/main_live.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/select2.js"></script>
		<script src="js/jquery.mixitup.min.js"></script>
		<script src="js/main.mixitup.js"></script>

        <script>
			$('#particpateTabs a').click(function (e) {
			  e.preventDefault();
			  $(this).tab('show');
			})
		
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
