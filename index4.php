<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
        <title>Pixel Humain, démocratie participative Réunion, discussion , actions et réseau local</title>
        <meta name="keywords" lang="fr" content="démocratie participative Réunion, discussion , actions et réseau local">
		<meta name="description" content="Un projet citoyen de Démocratie Participative qui prend racine à la Réunion portée par l'association Open Atlas (loi 1901 , à but non lucratif). 
								Une plateforme de discussions et actions citoyennes sur un réseau local (en cours construction). 
								Une passerelle entre nous et entre l’État.
								Objectifs de livraison (février - mars 2013)">
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
		
    </head>
    <body>
	   <!-- Mutualisation de code entre 2 fichiers index4.php et listePixelActifs.html => crée un html à part qui garantie unicité du code et on transforme le html père en .php car on utilise des fonctionnalité php "include" -->
       <?php include('menuPH.html')?>
	   <?php include('modalPA.php')?>
	   
		<!-- Modal Gallery fancy Box Like -->
		<div id="modal-gallery" class="modal modal-gallery hide fade" tabindex="-1">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">&times;</a>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body"><div class="modal-image"></div></div>
			<div class="modal-footer">
				<a class="btn btn-primary modal-next">Next <i class="icon-arrow-right icon-white"></i></a>
				<a class="btn btn-info modal-prev"><i class="icon-arrow-left icon-white"></i> Previous</a>
				<a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> Slideshow</a>
				<a class="btn modal-download" target="_blank"><i class="icon-download"></i> Download</a>
			</div>
		</div>
		<!-- /Modal Gallery fancy Box Like -->
		
	    <script src="js/vendor/jquery-1.8.3.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/old/main_live.js"></script>
		<script src="js/jquery.validate.min.js"></script>

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
