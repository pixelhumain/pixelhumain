<?php
	$cs = Yii::app()->getClientScript();
	$basePath = Yii::app()->getRequest()->getBaseUrl(true);
	$baseTheme = Yii::app()->theme->baseUrl;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Title Goes Here</title>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- NEED TO WORK ON -->

	<link href="<?php echo $baseTheme;?>/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo $baseTheme;?>/assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo $baseTheme;?>/assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo $baseTheme;?>/assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo $baseTheme;?>/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo $baseTheme;?>/assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo $baseTheme;?>/assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo $baseTheme;?>/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo $baseTheme;?>/assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>

	<!-- BEGIN CORE JS FRAMEWORK--> 
	<script src="<?php echo $baseTheme;?>/assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script> 
	<script src="<?php echo $baseTheme;?>/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script> 
	<script src="<?php echo $baseTheme;?>/assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script> 
	<script src="<?php echo $baseTheme;?>/assets/plugins/breakpoints.js" type="text/javascript"></script> 
	<script src="<?php echo $baseTheme;?>/assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script> 
	<script src="<?php echo $baseTheme;?>/assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script> 
	<!-- END CORE JS FRAMEWORK --> 
	<!-- BEGIN PAGE LEVEL JS --> 	
	<script src="<?php echo $baseTheme;?>/assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script> 	
	<script src="<?php echo $baseTheme;?>/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script> 
	<script src="<?php echo $baseTheme;?>/assets/plugins/pace/pace.min.js" type="text/javascript"></script>  
	<script src="<?php echo $baseTheme;?>/assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS --> 	
	
	<!-- BEGIN CORE TEMPLATE JS --> 
	<script src="<?php echo $baseTheme;?>/assets/js/core.js" type="text/javascript"></script> 
	<script src="<?php echo $baseTheme;?>/assets/js/chat.js" type="text/javascript"></script> 
	<script src="<?php echo $baseTheme;?>/assets/js/demo.js" type="text/javascript"></script> 
	<!-- END CORE TEMPLATE JS --> 

	<!-- END NEED TO WORK ON -->

</head>
<body class="">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse"> 
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="navbar-inner">
		<!-- BEGIN NAVIGATION HEADER -->
		<div class="header-seperation"> 
			<!-- BEGIN MOBILE HEADER -->
			<ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">	
				<li class="dropdown">
					<a id="main-menu-toggle" href="#main-menu" class="">
						<div class="iconset top-menu-toggle-white"></div>
					</a>
				</li>		 
			</ul>
			<!-- END MOBILE HEADER -->
			<!-- BEGIN LOGO -->	
			<a href="#">
				<img src="<?php echo $baseTheme;?>/assets/img/logo.png" class="logo" alt="" data-src="<?php echo $baseTheme;?>/assets/img/logo.png" data-src-retina="<?php echo $baseTheme;?>/assets/img/logo2x.png" width="106" height="21"/>
			</a>
			<!-- END LOGO --> 
			<!-- BEGIN LOGO NAV BUTTONS -->
			<ul class="nav pull-right notifcation-center">	
				<li class="dropdown" id="header_task_bar">
					<a href="#" class="dropdown-toggle active" data-toggle="">
						<div class="iconset top-home"></div>
					</a>
				</li>
				<li class="dropdown" id="header_inbox_bar">
					<a href="#" class="dropdown-toggle">
						<div class="iconset top-messages"></div>
						<span class="badge" id="msgs-badge">2</span>
						</a>
				</li>
				<!-- BEGIN MOBILE CHAT TOGGLER -->
				<li class="dropdown" id="portrait-chat-toggler" style="display:none">
					<a href="#sidr" class="chat-menu-toggle">
						<div class="iconset top-chat-white"></div>
					</a>
				</li>
				<!-- END MOBILE CHAT TOGGLER -->				        
			</ul>
			<!-- END LOGO NAV BUTTONS -->
		</div>
		<!-- END NAVIGATION HEADER -->
		<!-- BEGIN CONTENT HEADER -->
		<div class="header-quick-nav"> 
			<!-- BEGIN HEADER LEFT SIDE SECTION -->
			<div class="pull-left"> 
				<!-- BEGIN SLIM NAVIGATION TOGGLE -->
				<ul class="nav quick-section">
					<li class="quicklinks">
						<a href="#" class="" id="layout-condensed-toggle">
							<div class="iconset top-menu-toggle-dark"></div>
						</a>
					</li>
				</ul>
				<!-- END SLIM NAVIGATION TOGGLE -->				
				<!-- BEGIN HEADER QUICK LINKS -->
				<ul class="nav quick-section">
					<li class="quicklinks"><a href="#" class=""><div class="iconset top-reload"></div></a></li>
					<li class="quicklinks"><span class="h-seperate"></span></li>
					<li class="quicklinks"><a href="#" class=""><div class="iconset top-tiles"></div></a></li>
					<!-- BEGIN SEARCH BOX -->
					<li class="m-r-10 input-prepend inside search-form no-boarder">
						<span class="add-on"><span class="iconset top-search"></span></span>
						<input name="" type="text" class="no-boarder" placeholder="Search Dashboard" style="width:250px;">
					</li>
					<!-- END SEARCH BOX -->
				</ul>
				<!-- BEGIN HEADER QUICK LINKS -->				
			</div>
			<!-- END HEADER LEFT SIDE SECTION -->
			<!-- BEGIN HEADER RIGHT SIDE SECTION -->
			<div class="pull-right"> 
				<div class="chat-toggler">	
					<!-- BEGIN NOTIFICATION CENTER -->
					<a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom" data-content="" data-toggle="dropdown" data-original-title="Notifications">
						<div class="user-details"> 
							<div class="username">
								<span class="badge badge-important">3</span>&nbsp;John<span class="bold">&nbsp;Smith</span>									
							</div>						
						</div> 
						<div class="iconset top-down-arrow"></div>
					</a>	
					<div id="notification-list" style="display:none">
						<div style="width:300px">
							<!-- BEGIN NOTIFICATION MESSAGE -->
							<div class="notification-messages info">
								<div class="user-profile">
									<img src="<?php echo $baseTheme;?>/assets/img/profiles/d.jpg" alt="" data-src="<?php echo $baseTheme;?>/assets/img/profiles/d.jpg" data-src-retina="<?php echo $baseTheme;?>/assets/img/profiles/d2x.jpg" width="35" height="35">
								</div>
								<div class="message-wrapper">
									<div class="heading">Title of Notification</div>
									<div class="description">Description...</div>
									<div class="date pull-left">A min ago</div>										
								</div>
								<div class="clearfix"></div>									
							</div>
							<!-- END NOTIFICATION MESSAGE -->	
						</div>				
					</div>
					<!-- END NOTIFICATION CENTER -->
					<!-- BEGIN PROFILE PICTURE -->
					<div class="profile-pic"> 
						<img src="<?php echo $baseTheme;?>/assets/img/profiles/avatar_small.jpg" alt="" data-src="<?php echo $baseTheme;?>/assets/img/profiles/avatar_small.jpg" data-src-retina="<?php echo $baseTheme;?>/assets/img/profiles/avatar_small2x.jpg" width="35" height="35" /> 
					</div>  
					<!-- END PROFILE PICTURE -->     			
				</div>
				<!-- BEGIN HEADER NAV BUTTONS -->
				<ul class="nav quick-section">
					<!-- BEGIN SETTINGS -->
					<li class="quicklinks"> 
						<a data-toggle="dropdown" class="dropdown-toggle pull-right" href="#" id="user-options">						
							<div class="iconset top-settings-dark"></div> 	
						</a>
						<ul class="dropdown-menu pull-right" role="menu" aria-labelledby="user-options">
							<li><a href="#">Normal Link</a></li>
							<li><a href="#">Badge Link&nbsp;&nbsp;<span class="badge badge-important animated bounceIn">2</span></a></li>
							<li class="divider"></li>                
							<li><a href="#"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Separated Link</a></li>
						</ul>
					</li>
					<!-- END SETTINGS -->
					<li class="quicklinks"><span class="h-seperate"></span></li> 
					<!-- BEGIN CHAT SIDEBAR TOGGLE -->
					<li class="quicklinks"> 	
						<a id="chat-menu-toggle" href="#sidr" class="chat-menu-toggle">
							<div class="iconset top-chat-dark"><span class="badge badge-important hide" id="chat-message-count">1</span></div>
						</a> 
						<!-- BEGIN OPTIONAL RECENT CHAT POP UP NOTIFICATION -->
						<div class="simple-chat-popup chat-menu-toggle hide">
							<div class="simple-chat-popup-arrow"></div>
							<div class="simple-chat-popup-inner">
								<div style="width:100px">
									<div class="semi-bold">Name</div>
									<div class="message">Message...</div>
								</div>
							</div>
						</div>
						<!-- END OPTIONAL RECENT CHAT POP UP NOTIFICATION -->
					</li>
					<!-- END CHAT SIDEBAR TOGGLE --> 
				</ul>
				<!-- END HEADER NAV BUTTONS -->
			</div>
			<!-- END HEADER RIGHT SIDE SECTION -->
		</div> 
		<!-- END CONTENT HEADER --> 
	</div>
	<!-- END TOP NAVIGATION BAR --> 
</div>
<!-- END HEADER -->
	
<!-- BEGIN CONTENT -->
<div class="page-container row-fluid">
	<!-- BEGIN SIDEBAR -->
	<!-- BEGIN MENU -->
	<div class="page-sidebar" id="main-menu"> 
		  <div class="page-sidebar-wrapper" id="main-menu-wrapper">
		<!-- BEGIN MINI-PROFILE -->
		<div class="user-info-wrapper">	
			<div class="profile-wrapper">
				<img src="<?php echo $baseTheme;?>/assets/img/profiles/avatar.jpg" alt="" data-src="<?php echo $baseTheme;?>/assets/img/profiles/avatar.jpg" data-src-retina="<?php echo $baseTheme;?>/assets/img/profiles/avatar2x.jpg" width="69" height="69" />
			</div>
			<div class="user-info">
				<div class="greeting">Welcome</div>
				<div class="username">John <span class="semi-bold">Smith</span></div>
				<div class="status">Status<a href="#"><div class="status-icon green"></div>Online</a></div>
			</div>
		</div>
		<!-- END MINI-PROFILE -->
		<!-- BEGIN SIDEBAR MENU -->	
		<p class="menu-title">BROWSE<span class="pull-right"><a href="javascript:;"><i class="fa fa-refresh"></i></a></span></p>
		<ul>	
			<!-- BEGIN SELECTED LINK -->
			<li class="start active">
				<a href="#">
					<i class="icon-custom-home"></i>
					<span class="title">Link 1</span>
					<span class="selected"></span>
					<span class="badge badge-important pull-right">5</span>
				</a>
			</li>
			<!-- END SELECTED LINK -->
			<!-- BEGIN BADGE LINK -->
			<li class="">
				<a href="#">
					<i class="fa fa-envelope"></i>
					<span class="title">Link 2</span>
					<span class="badge badge-disable pull-right">203</span>
				</a>
			</li>
			<!-- END BADGE LINK -->     
			<!-- BEGIN SINGLE LINK -->
			<li class="">
				<a href="#">
					<i class="fa fa-flag"></i>
					<span class="title">Link 3</span>
				</a>
			</li>
			<!-- END SINGLE LINK -->    
			<!-- BEGIN ONE LEVEL MENU -->
			<li class="">
				<a href="javascript:;">
					<i class="icon-custom-ui"></i>
					<span class="title">Link 4</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub-menu">
					<li><a href="#">Sub Link 1</a></li>
				</ul>
			</li>
			<!-- END ONE LEVEL MENU -->
			<!-- BEGIN TWO LEVEL MENU -->
			<li class="">
				<a href="javascript:;">
					<i class="fa fa-folder-open"></i>
					<span class="title">Link 5</span>
					<span class="arrow"></span>
				</a>
				<ul class="sub-menu">
					<li><a href="javascript:;">Sub Link 1</a></li>
					<li>
						<a href="javascript:;"><span class="title">Sub Link 2</span><span class="arrow "></span></a>
						<ul class="sub-menu">
							<li><a href="javascript:;">Sub Link 1</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<!-- END TWO LEVEL MENU -->			
		</ul>
		<!-- END SIDEBAR MENU -->
		<!-- BEGIN SIDEBAR WIDGETS -->
		<div class="side-bar-widgets">
			<!-- BEGIN FOLDER WIDGET -->
			<p class="menu-title">FOLDER<span class="pull-right"><a href="#" class="create-folder"><i class="icon-plus"></i></a></span></p>
			<ul class="folders">
				<li><a href="#"><div class="status-icon green"></div>Task 1</a></li>
				<!-- BEGIN HIDDEN INPUT BOX (FOR ADD FOLDER LINK) -->
				<li class="folder-input" style="display:none">
					<input type="text" placeholder="Name of folder" class="no-boarder folder-name" name="" id="folder-name">
				</li>
				<!-- END HIDDEN INPUT BOX (FOR ADD FOLDER LINK) -->
			</ul>
			<!-- END FOLDER WIDGET -->
			<!-- BEGIN PROJECTS WIDGET -->
			<p class="menu-title">PROJECTS</p>
			<!-- BEGIN EXAMPLE 1 -->
			<div class="status-widget">
				<div class="status-widget-wrapper">
					<div class="title">Project Title<a href="#" class="remove-widget"><i class="icon-custom-cross"></i></a></div>
					<p>Project Description</p>
				</div>
			</div>
			<!-- END EXAMPLE 1 -->
			<!-- END PROJECTS WIDGET -->
		</div>
		<div class="clearfix"></div>
		<!-- END SIDEBAR WIDGETS --> 
	</div>
	</div>
	<!-- BEGIN SCROLL UP HOVER -->
	<a href="#" class="scrollup">Scroll</a>
	<!-- END SCROLL UP HOVER -->
	<!-- END MENU -->
	<!-- BEGIN SIDEBAR FOOTER WIDGET -->
	<div class="footer-widget">		
		<div class="progress transparent progress-small no-radius no-margin">
			<div data-percentage="79%" class="progress-bar progress-bar-success animate-progress-bar"></div>		
		</div>
		<div class="pull-right">
			<div class="details-status">
				<span data-animation-duration="560" data-value="86" class="animate-number"></span>%
			</div>	
			<a href="#"><i class="fa fa-power-off"></i></a>
		</div>
	</div>
	<!-- END SIDEBAR FOOTER WIDGET -->
	<!-- END SIDEBAR --> 
	<!-- BEGIN PAGE CONTAINER-->
	<div class="page-content"> 
		<div class="content">  
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">	
				<h3>Master Page</h3>		
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PlACE PAGE CONTENT HERE -->
			
			<!-- END PLACE PAGE CONTENT HERE -->
		</div>
	</div>
	<!-- END PAGE CONTAINER -->
</div>
<!-- END CONTENT --> 

<!-- BEGIN CHAT --> 
<div id="sidr" class="chat-window-wrapper">
	<div id="main-chat-wrapper">
		<div class="chat-window-wrapper fadeIn" id="chat-users">
			<!-- BEGIN CHAT HEADER -->
			<div class="chat-header">	
				<!-- BEGIN CHAT SEARCH BAR -->
				<div class="pull-left">
					<input type="text" placeholder="search">
				</div>
				<!-- END CHAT SEARCH BAR -->
				<!-- BEGIN CHAT QUICKLINKS -->		
				<div class="pull-right">
					<a href="#" class=""><div class="iconset top-settings-dark"></div></a>
				</div>
				<!-- END CHAT QUICKLINKS -->			
			</div>
			<!-- END CHAT HEADER -->	
			<!-- BEGIN GROUP WIDGET -->
			<div class="side-widget">
				<div class="side-widget-title">group chats</div>
				<div class="side-widget-content">
					<div id="groups-list">
						<ul class="groups">
							<li><a href="#"><div class="status-icon green"></div>Group Chat 1</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- END GROUP WIDGET -->
			<!-- BEGIN FAVORITES WIDGET -->
			<div class="side-widget fadeIn">
				<div class="side-widget-title">favorites</div>
				<div class="side-widget-content">
					<!-- BEGIN SAMPLE CHAT -->
					<div class="user-details-wrapper active" data-chat-status="online" data-chat-user-pic="<?php echo $baseTheme;?>/assets/img/profiles/d.jpg" data-chat-user-pic-retina="<?php echo $baseTheme;?>/assets/img/profiles/d2x.jpg" data-user-name="Jane Smith">
						<!-- BEGIN PROFILE PIC -->
						<div class="user-profile">
								<img src="<?php echo $baseTheme;?>/assets/img/profiles/d.jpg" alt="" data-src="<?php echo $baseTheme;?>/assets/img/profiles/d.jpg" data-src-retina="<?php echo $baseTheme;?>/assets/img/profiles/d2x.jpg" width="35" height="35">
							</div>
						<!-- END PROFILE PIC -->
						<!-- BEGIN MESSAGE -->
						<div class="user-details">
								<div class="user-name">Jane Smith</div>
								<div class="user-more">Message...</div>
							</div>
						<!-- END MESSAGE -->
						<!-- BEGIN MESSAGES BADGE -->
						<div class="user-details-status-wrapper">
								<span class="badge badge-important">3</span>
							</div>
						<!-- END MESSAGES BADGE -->
						<!-- BEGIN STATUS -->
						<div class="user-details-count-wrapper">
								<div class="status-icon green"></div>
							</div>
						<!-- END STATUS -->
						<div class="clearfix"></div>
					</div>
					<!-- END SAMPLE CHAT -->	
				</div>
			</div>
			<!-- END FAVORITES WIDGET -->
			<!-- BEGIN MORE FRIENDS WIDGET -->
			<div class="side-widget">
				<div class="side-widget-title">more friends</div>
				<div class="side-widget-content" id="friends-list">
					<!-- BEGIN SAMPLE CHAT -->
					<div class="user-details-wrapper" data-chat-status="online" data-chat-user-pic="<?php echo $baseTheme;?>/assets/img/profiles/d.jpg" data-chat-user-pic-retina="<?php echo $baseTheme;?>/assets/img/profiles/d2x.jpg" data-user-name="Jane Smith">
						<!-- BEGIN PROFILE PIC -->
						<div class="user-profile">
							<img src="<?php echo $baseTheme;?>/assets/img/profiles/d.jpg" alt="" data-src="<?php echo $baseTheme;?>/assets/img/profiles/d.jpg" data-src-retina="<?php echo $baseTheme;?>/assets/img/profiles/d2x.jpg" width="35" height="35">
						</div>
						<!-- END PROFILE PIC -->
						<!-- BEGIN MESSAGE -->
						<div class="user-details">
							<div class="user-name">Jane Smith</div>
							<div class="user-more">Message...</div>
						</div>
						<!-- END MESSAGE -->
						<!-- BEGIN MESSAGES BADGE -->
						<div class="user-details-status-wrapper">
							<span class="badge badge-important">3</span>
						</div>
						<!-- END MESSAGES BADGE -->
						<!-- BEGIN STATUS -->
						<div class="user-details-count-wrapper">
							<div class="status-icon green"></div>
						</div>
						<!-- END STATUS -->
						<div class="clearfix"></div>
					</div>
					<!-- END SAMPLE CHAT -->
				</div>		
			</div>
			<!-- END MORE FRIENDS WIDGET -->
		</div>		
		<!-- BEGIN DUMMY CHAT CONVERSATION -->
		<div class="chat-window-wrapper fadeIn" id="messages-wrapper" style="display:none">
			<!-- BEGIN CHAT HEADER BAR -->
			<div class="chat-header">	
				<!-- BEGIN SEARCH BAR -->
				<div class="pull-left">
					<input type="text" placeholder="search">
				</div>		
				<!-- END SEARCH BAR -->
				<!-- BEGIN CLOSE TOGGLE -->
				<div class="pull-right">
					<a href="#" class=""><div class="iconset top-settings-dark"></div></a>
				</div>	
				<!-- END CLOSE TOGGLE -->				
			</div>
			<div class="clearfix"></div>
			<!-- END CHAT HEADER BAR -->
			<!-- BEGIN CHAT BODY -->
			<div class="chat-messages-header">
				<div class="status online"></div>
				<span class="semi-bold">Jane Smith(Typing..)</span>
				<a href="#" class="chat-back"><i class="icon-custom-cross"></i></a>
			</div>
			<!-- BEGIN CHAT MESSAGES CONTAINER -->
			<div class="chat-messages">
				<!-- BEGIN TIME STAMP EXAMPLE -->
				<div class="sent_time">Yesterday 11:25pm</div>
				<!-- END TIME STAMP EXAMPLE -->
				<!-- BEGIN EXAMPLE CHAT MESSAGE -->
				<div class="user-details-wrapper">
					<!-- BEGIN MESSENGER PROFILE -->
					<div class="user-profile">
						<img src="<?php echo $baseTheme;?>/assets/img/profiles/d.jpg" alt="" data-src="<?php echo $baseTheme;?>/assets/img/profiles/d.jpg" data-src-retina="<?php echo $baseTheme;?>/assets/img/profiles/d2x.jpg" width="35" height="35">
					</div>
					<!-- END MESSENGER PROFILE -->
					<!-- BEGIN MESSENGER MESSAGE -->
					<div class="user-details">
						<div class="bubble">Hello, You there?</div>
					</div>
					<!-- END MESSENGER MESSAGE -->					
					<div class="clearfix"></div>
					<!-- BEGIN TIMESTAMP ON CLICK TOGGLE -->
					<div class="sent_time off">Yesterday 11:25pm</div>
					<!-- END TIMESTAMP ON CLICK TOGGLE -->
				</div>
				<!-- END EXAMPLE CHAT MESSAGE -->
				<!-- BEGIN TIME STAMP EXAMPLE -->
				<div class="sent_time">Today 11:25pm</div>
				<!-- BEGIN TIME STAMP EXAMPLE -->				
				<!-- BEGIN EXAMPLE CHAT MESSAGE (FROM SELF) -->
				<div class="user-details-wrapper pull-right">
					<!-- BEGIN MESSENGER MESSAGE -->
					<div class="user-details">
						<div class="bubble sender">Let me know when you free</div>
					</div>					
					<!-- END MESSENGER MESSAGE -->
					<div class="clearfix"></div>
					<!-- BEGIN TIMESTAMP ON CLICK TOGGLE -->
					<div class="sent_time off">Sent On Tue, 2:45pm</div>
					<!-- END TIMESTAMP ON CLICK TOGGLE -->
				</div>	
				<!-- END EXAMPLE CHAT MESSAGE (FROM SELF) -->	
			</div>
			<!-- END CHAT MESSAGES CONTAINER -->
		</div>
		<div class="chat-input-wrapper" style="display:none">
			<textarea id="chat-message-input" rows="1" placeholder="Type your message"></textarea>
		</div>
		<div class="clearfix"></div>
		<!-- END DUMMY CHAT CONVERSATION -->
	</div>
</div>
<!-- END CHAT --> 
</body>
</html>