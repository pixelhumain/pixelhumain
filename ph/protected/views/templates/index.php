<style>
ol.slats li {
	margin: 0 0 10px 0;
	padding: 0 0 10px 0;
	border-bottom: 1px solid #eee;
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

<h2>Should Render directly by reading content of views/templates/ folder</h2>

<ol class="slats">
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/templates?name=dashboard')?>">
				DashBoard Template
			</a>
		</h3>
	</li>
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/templates?name=panelFlip')?>">
				panelFlip
			</a>
		</h3>
	</li>
	
</ol>			
				