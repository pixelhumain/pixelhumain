<!-- start: TOP NAVIGATION MENU -->
			
<header class="top-navbar collapse_list">

	<div class="navbar-logo collapse_wrap">

		<h1 class="trigger collapse_trigger hide_on_active">
			<i class="fa fa-logo"></i>
			<span class="fulltitle">full page title</span>
			<span class="notifications-count badge badge-danger animated bounceIn">97</span>
		</h1>

		<div class="inner collapse_box">

			<span class="trigger collapse_trigger">
				<i class="fa fa-logo"></i>
			</span>

			<a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person")?>" class="userlink">
				<i class="fa fa-user_circled"></i>
				<span class="username"><?php echo (isset(Yii::app()->session["user"]["name"])) ? Yii::app()->session["user"]["name"] : Yii::app()->session["user"]["firstName"]." ".Yii::app()->session["user"]["lastName"]?></span>
			</a>

			<a href="#">
				<i class="fa fa-comment"></i>
				<span class="notifications-count badge badge-danger animated bounceIn">97</span>
			</a>

			<a href="#" class="sb_toggle">
				<i class="fa fa-cog"></i>
			</a>
		</div>
	</div>
		
	<ul class="navbar-menu">

		<li class="collapse_wrap">
			
			<div class="trigger collapse_trigger hide_on_active">
				<i class="fa fa-tags"></i>
				<span class="notifications-count badge badge-warning animated bounceIn">3</span>
			</div>

			<div class="inner collapse_box">
				<span class="trigger collapse_trigger">
					<i class="fa fa-tags"></i>
				</span>

				<a href="#" class="sb_custom_toggle" data-target="#tags_slidingbar">
					Pseudo, saisissez ou modifiez ici vos tags !
				</a>
			</div>

		</li>

		<li class="collapse_wrap">
			
			<div class="trigger collapse_trigger hide_on_active">
				<i class="slider-sm-ico"></i>
			</div>

			<div class="inner slider-wrap collapse_box">
				
				<div class="slider slider-sm slider-green">
					<input type="text" class="slider-element form-control" value="" data-slider-max="70" data-slider-step="1" data-slider-value="30" data-slider-orientation="horizontal" data-slider-selection="after" data-slider-tooltip="hide">
				</div>

				<label class="slider_label">Zoom géographique</label>

			</div>

		</li>

		<li class="collapse_wrap">
			
			<div class="trigger collapse_trigger">
				<i class="fa fa-map-marker"></i>
			</div>

			<form class="inner collapse_box">
				<input class="wide" type="text" placeholder="Pseudo, passez votre interface en mode cartographie">
			</form>

		</li>

		<li class="collapse_wrap">
			
			<div class="trigger collapse_trigger">
				<i class="fa fa-search"></i>
			</div>

			<form class="inner collapse_box">
				<input type="text" placeholder="Que recherchez-vous ?">
			</form>

		</li>

		<li class="collapse_wrap">
			<a href="#" class="sb-toggle-right trigger">
				<i class="fa fa-globe toggle-icon"></i>
			</a>
		</li>

	</ul>

</header>

<!-- end: TOP NAVIGATION MENU -->