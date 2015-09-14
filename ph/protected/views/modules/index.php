<style>
ol.slats li {
	margin: 0 0 10px 50px;
	padding: 0 0 10px 0;
	border-bottom: 1px solid #eee;
	width:150px;
	float:left;
	}
ol.slats li:last-child {
	margin: 0;
	padding: 0;
	border-bottom: none;
	}
ol.slats li h3 {
	font-size: 18px;
	font-weight: bold;
	line-height: 1.1;
	}
ol.slats li h3 a img {
	float: left;
	margin: 0 10px 0 0;
	padding: 4px;
	border: 1px solid #eee;
	}
ol.slats li h3 a:hover img {
	background: #eee;
	}
ol.slats li p {
	margin: 0 0 0 76px;
	font-size: 14px;
	line-height: 1.4;
	}
ol.slats li p span.meta {
	display: block;
	font-size: 12px;
	color: #999;
	}				
</style>

<h2>List All existing Modules of modules/ folder</h2>
<div class="container" id="accueil">
    <br/>
    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit">
		<ol class="slats">
			<?php 
			//Yii::getPathOfAlias("webroot.images")
			foreach( CFileHelper::findFiles('protected/modules/', array( "exclude"=>array("index.php"),"level"=>1 ) ) as $f){?>
				<li class="group">
					<h3>
					    <?php 
					    $name = substr ( pathinfo($f, PATHINFO_DIRNAME) , 19);
					    ?>
						<a href="<?php echo Yii::app()->createUrl( $name)?>">
							<?php echo $name?>
						</a>
					</h3>
				</li>
			<?php }

			?>
		</ol>	
	<div class="clear"></div>		
</div></div>	