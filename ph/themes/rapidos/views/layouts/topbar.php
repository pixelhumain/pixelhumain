<!-- start: TOPBAR -->
<header class="topbar navbar navbar-inverse navbar-fixed-top inner">
	<!-- start: TOPBAR CONTAINER -->
	<div class="container">
		<div class="navbar-header">
			<a class="sb-toggle-left hidden-md hidden-lg" href="#main-navbar">
				<i class="fa fa-bars"></i>
			</a>
			<!-- start: LOGO -->
			<a class="navbar-brand" href="<?php echo Yii::app()->createUrl("/".$this->module->id)?>">
				<?php echo (isset($this->projectImage)) ? '<img height="30" src="'.$this->module->assetsUrl.$this->projectImage.'"/>' : "<i class='fa fa-close'>/i>"; echo (isset($this->projectName)) ? $this->projectName : "Page subTitle";?>
			</a>
			<!-- end: LOGO -->
		</div>
		<div class="topbar-tools">
			<!-- start: TOP NAVIGATION MENU -->
			<ul class="nav navbar-right">
				<!-- start: USER DROPDOWN -->
				<li class="dropdown current-user">
					<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
						<img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-1-small.jpg" class="img-circle" alt=""> <span class="username hidden-xs"><?php echo (isset(Yii::app()->session["user"]["name"])) ? Yii::app()->session["user"]["name"] : Yii::app()->session["user"]["firstName"]." ".Yii::app()->session["user"]["lastName"]?></span> <i class="fa fa-caret-down "></i>
					</a>
					<ul class="dropdown-menu dropdown-dark">
						<li>
							<a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/profile")?>">
								My Profile
							</a>
						</li>
						<li>
							<a href="pages_calendar.html">
								My Calendar
							</a>
						</li>
						<li>
							<a href="pages_messages.html">
								My Messages (3)
							</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/logout")?>">
								Log Out
							</a>
						</li>
					</ul>
				</li>
				<!-- end: USER DROPDOWN -->
				<li class="right-menu-toggle">
					<a href="#" class="sb-toggle-right">
						<i class="fa fa-globe toggle-icon"></i> <i class="fa fa-caret-right"></i> <span class="notifications-count badge badge-default hide"> 3</span>
					</a>
				</li>
			</ul>
			<!-- end: TOP NAVIGATION MENU -->
		</div>
	</div>
	<!-- end: TOPBAR CONTAINER -->
</header>
<!-- end: TOPBAR -->