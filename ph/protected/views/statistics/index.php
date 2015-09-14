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
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2>Quelques rendus de statistic</h2>
    
<ol class="slats">
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/statistics/graph/type/metier')?>">
				Graph des pixels actifs par Métier
			</a>
		</h3>
	</li>
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/statistics/graph/type/thematique')?>">
				Graph des pixels actifs par Thematique
			</a>
		</h3>
	</li>
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/statistics/graph/type/cp')?>">
				Graph des pixels actifs par Code Postal
			</a>
		</h3>
	</li>
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/statistics/graph/type/cpCount')?>">
				Graph des pixels actifs par Code Postal
			</a>
		</h3>
	</li>
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/statistics/graph/type/groups')?>">
				Activité de groupes
			</a>
		</h3>
	</li>
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/statistics/graph/type/interactions')?>">
				Interactions Locales 
			</a>
		</h3>
	</li>
	<li class="group">
		<h3>
			<a href="<?php echo Yii::app()->createUrl('/index.php/statistics/graph/type/3dsurface')?>">
				simulation 3d
			</a>
		</h3>
	</li>
</ol>	
</div></div>		
				