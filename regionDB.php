<?php
require_once('./config/configDB.php');
try
{
    $connection = new Mongoclient($dbconfig['connectionString']);
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
		<link rel="stylesheet" href="css/region.css">
		<link rel="stylesheet" href="css/select2.css">
    </head>
    <body>
		<!-- Mutualisation de code entre 2 fichiers index4.php et listePixelActifs.html => crée un html à part qui garantie unicité du code et on transforme le html père en .php car on utilise des fonctionnalité php "include" -->
       <?php /*include('menuPH.html')?>
	   <?php include('modalPA.php')*/?>
		
		<body>
	<section>
		
		<!-- BEGIN HEADER -->
		<?php 
		
		$region = $connection->pixelhumain->france;
		$ct = $region->find();
		
		?>
		<header class="ns">
			<div class="wrapper just wf">
				<a id="logo" class="ib" href="./regionDB.php">
					<img src="img/logo/logo144.png"  onload="imgLoaded(this)"/>
					<h1 class="ib"><strong>Pixel Humain </strong>: Région Réunion (974 - <?php echo $ct->count();?> communes)</h1> 
				</a>
				
				<a href="#" onclick="page = prompt('wiki page name ?'); window.location.href='getWikipediaInfobox.php?page='+page">
					<div class="ib anim150 button">+ COMMUNE</div>
				</a>
			</div>
		</header>
		
		<!-- END HEADER -->
		
		<!-- BEGIN DEMO WRAPPER -->
		
		<div class="wrapper wf">
			
			<!-- BEGIN CONTROLS -->
			
			<nav class="controls just">
				<div class="group" id="Sorts">
					<div class="button active" id="ToList"><i></i>List View</div>
					<div class="button" id="ToGrid"><i></i>Grid View</div>
					<div class="button" id="ToMap"><i></i>Map View</div>
				</div>
				<div class="group" id="Filters">
					
					<div class="drop_down wf">
						<span class="anim150">Zoom Administratif </span>
						<ul class="anim250">
							<li class="active" data-filter="national" data-dimension="administration">Pays</li>
							<li data-filter="region" data-dimension="administration">Région</li>
							<li data-filter="departement" data-dimension="administration">Département</li>
							<li data-filter="commune" data-dimension="administration">Commune</li>
							<li data-filter="quartier" data-dimension="administration">Quartier</li>
							<li data-filter="citoyen" data-dimension="administration">Citoyen</li>
						</ul>
					</div>
					
					<div class="drop_down wf">
						<span class="anim150">Région</span>
						<ul class="anim250">
							<li class="active" data-filter="all" data-dimension="region">All</li>
							
							<li data-filter="northeast" data-dimension="region">Nord-Est</li>
							<li data-filter="northwest" data-dimension="region">Nord-Ouest</li>
							<li data-filter="center" data-dimension="region">Centre</li>
							<li data-filter="southeast" data-dimension="region">Sud-Est</li>
							<li data-filter="southwest" data-dimension="region">Sud-Ouest</li>
							
						</ul>
					</div>
					<div class="drop_down wf">
						<span class="anim150">Nature</span>
						<ul class="anim250">
							<li class="active" data-filter="all" data-dimension="nature">All</li>
							<li data-filter="mountains" data-dimension="nature">Montagne</li>
							<li data-filter="waterfalls" data-dimension="nature">Cascade</li>
							<li data-filter="river" data-dimension="nature">Rivière</li>
							<li data-filter="lagoon" data-dimension="nature">Lagon</li>
							<li data-filter="sea" data-dimension="nature">Mer</li>
						</ul>
					</div>
					<div class="drop_down wf">
						<span class="anim150">Activité</span>
						<ul class="anim250">
							<li class="active" data-filter="all" data-dimension="recreation">All</li>
							<li data-filter="camping" data-dimension="recreation">Camping</li>
							<li data-filter="climbing" data-dimension="recreation">Grimpe</li>
							<li data-filter="fishing" data-dimension="recreation">Peche</li>
							<li data-filter="swimming" data-dimension="recreation">PMT (Palme Masque Tuba)</li>
						</ul>
					</div>
				</div>
			</nav>
			
			<!-- END CONTROLS -->
			
			<!-- BEGIN PARKS -->
			
			<ul id="Parks" class="just">
				
				<!-- "TABLE" HEADER CONTAINING SORT BUTTONS (HIDDEN IN GRID MODE)-->
				
				<div class="list_header">
					<div class="meta name active desc" id="SortByName">
						Nom &nbsp;
						<span class="sort anim150 asc active" data-sort="data-name" data-order="desc"></span>
						<span class="sort anim150 desc" data-sort="data-name" data-order="asc"></span>	
					</div>
					<div class="meta region">Region</div>
					<div class="meta rec">Activité</div>
					<div class="meta area" id="SortByArea">
						Surface en km2 &nbsp;
						<span class="sort anim150 asc" data-sort="data-area" data-order="asc"></span>
						<span class="sort anim150 desc" data-sort="data-area" data-order="desc"></span>
					</div>
				</div>
				
				<!-- FAIL ELEMENT -->
				
				<div class="fail_element anim250">Aucune réponse ne correspond a vos critères.</div>
				
				<!-- BEGIN LIST OF PARKS (MANY OF THESE ELEMENTS ARE VISIBLE ONLY IN LIST MODE)-->
				<?php foreach ($ct as $commune){?>
				<li class="mix <?php echo $commune['geoPosition']?> <?php echo $commune['activity']?> " data-name="<?php echo $commune['name']?>" data-area="<?php echo $commune['superficie']?>">
					<div class="meta name">
						<div class="img_wrapper">
							<a href="./commune.php?cp=<?php echo $commune['codepostal']?>"><img src="<?php echo $commune['imgValo']?>" onload="imgLoaded(this)"/></a>
						</div>
						<div class="titles">
							<h2><?php echo $commune['name']?></h2>
							<p><em><?php echo $commune['codepostal']?></em></p>
						</div>
					</div>
					<div class="meta region">
						<p><?php echo $commune['geoPosition']?></p>
					</div>
					<div class="meta rec">
						<ul>
							<?php foreach(explode(",",$commune['activity']) as $a)
								echo '<li>'.$a.'</li>';
							?>
						</ul>
					</div>
					<div class="meta area">
						<p>Maire : <?php echo $commune['maire']?>
						<br/>
						<?php echo $commune['populationmunicipale']?>
						<br/>
						Altitude 	<?php echo $commune['altitude']?>
						<br/>
						Superficie 	<?php echo $commune['superficie']?></p>
					</div>
				</li>
				<?php } ?>
				
				
				<!-- END LIST OF PARKS -->
				
			</ul>

		</div>
		
		<!-- END DEMO WRAPPER -->
		
		</section>
		
		<!-- BEGIN FOOTER -->
		
		<footer class="wf">
				<div class="right">
					<p><strong>Pixel Humain</strong></p>
					<p class="small">Comment rétablir le PH d'une ville.</p>
				</div>
			<div class="clear"></div>
		</footer>
		
		<!-- END FOOTER -->
		
	    <script type="text/javascript" src="js/vendor/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/vendor/jquery-ui.sortable.min.js"></script>
		<script type="text/javascript" src="js/vendor/jquery.ui.touch-punch.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>

        <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/old/main_live.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="js/select2.js"></script>
		<script type="text/javascript" src="js/jquery.mixitup.min.js"></script>
		<script type="text/javascript" src="js/main.region.js"></script>

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
