<?php
require_once('./config/configDB.php');
include('./connect.php');

$title = "Your page title";
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
		
		<!-- BEGIN CONTENT -->
		
		<style>
    		.item { width: 25%; }
    		.item.w2 { width: 50%; }
		</style>
		
		<div id="container" class="js-masonry" data-masonry-options='{ "columnWidth": 200, "itemSelector": ".item" }'>
    		<div class="item">...</div>
          <div class="item w2">...</div>
          <div class="item">...</div>
        </div>
		<!-- END CONTENT -->
		
		<script>
		
		</script>
		
		
		<!-- END CONTENT -->
		
		</section>
		
		<?php include('struct_footer.php');?>
		
        <script type="text/javascript" src="js/vendor/jquery-ui.sortable.min.js"></script>
		

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
