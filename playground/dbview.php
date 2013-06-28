<?php
require_once('./config/configDB.php');
include('./connect.php');

$title = "DB View";
$keywords = "keywords";
$description = "description";
include('struct_header.php');
?>

		<link rel="stylesheet" href="css/region.css">
		<link rel="stylesheet" href="css/select2.css">
    </head>
    <body>
		
	<section>
		
		<!-- BEGIN HEADER -->
		
		<header class="ns">
			<div class="wrapper just wf">
				<a id="logo" class="ib" href="./region.php">
					<img src="img/logo/logo144.png"  onload="imgLoaded(this)"/>
					<h1 class="ib"><strong>Pixel Humain </strong>: <?php echo $title?></h1> 
				</a>
				
				<a href="#addCommune" data-toggle="modal">
					<div class="ib anim150 button">+ Kicker </div>
				</a>
				
			</div>
		</header>
		
		<!-- END HEADER -->
		
		<ul>
			<li><a href="https://api.mongolab.com/api/1/databases/pixelhumain/collections?apiKey=50df35b6e4b00041a25dc111<?php echo $dbconfig['MONGOLAB_API_KEY']?>">Collections</a></li>
			
			<li><a href="https://api.mongolab.com/api/1/databases/pixelhumain/collections/france?apiKey=<?php echo $dbconfig['MONGOLAB_API_KEY']?>">France</a></li>
			<li><a href="https://api.mongolab.com/api/1/databases/pixelhumain/collections/activities?apiKey=<?php echo $dbconfig['MONGOLAB_API_KEY']?>">activities</a></li>
			<li><a href="https://api.mongolab.com/api/1/databases/pixelhumain/collections/natures?apiKey=<?php echo $dbconfig['MONGOLAB_API_KEY']?>">natures</a></li>
			<li><a href="https://api.mongolab.com/api/1/databases/pixelhumain/collections/pixelsactifs?apiKey=<?php echo $dbconfig['MONGOLAB_API_KEY']?>">pixelsactifs</a></li>
			<li><a href="https://api.mongolab.com/api/1/databases/pixelhumain/collections/tags?apiKey=<?php echo $dbconfig['MONGOLAB_API_KEY']?>">tags</a></li>
			<li><a href="https://api.mongolab.com/api/1/databases/pixelhumain/collections/types?apiKey=<?php echo $dbconfig['MONGOLAB_API_KEY']?>">types</a></li>
			

			<li><a href='https://api.mongolab.com/api/1/databases/pixelhumain/collections/france?q={"codepostal":"97412"}&apiKey=<?php echo $dbconfig['MONGOLAB_API_KEY']?>'>france query</a></li>
		</ul>
		
		API REST Mongolab : https://support.mongolab.com/entries/20433053-rest-api-for-mongodb
		</section>
		
		<?php include('struct_footer.php');?>
		
        <script type="text/javascript" src="js/vendor/masonry.pkgd.min.js"></script>
        <script type="text/javascript" src="js/dbview.js"></script>
		

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
