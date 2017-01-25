<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css'); //for CSS external files onloading
$cs->registerScriptFile('http://' , CClientScript::POS_END); //for javascript external files onloading
?>

<!-- BLOCK CSS -->
<style>

	/** Inspired by: http://graphicburger.com/flat-design-ui-components/ **/


/************************************ FONTS ************************************/
@import url(http://fonts.googleapis.com/css?family=Ubuntu:400,700);
@import url(http://weloveiconfonts.com/api/?family=entypo|fontawesome|zocial);
/* entypo */
[class*="entypo-"]:before {
  font-family: 'entypo', sans-serif;
}
/* fontawesome */
[class*="fontawesome-"]:before {
  font-family: 'FontAwesome', sans-serif;
}
/* zocial */
[class*="zocial-"]:before {
  font-family: 'zocial', sans-serif;
}
@font-face {
	font-family: 'icomoon';
	src:url('http://jlalovi-cv.herokuapp.com/font/icomoon.eot');
	src:url('http://jlalovi-cv.herokuapp.com/font/icomoon.eot?#iefix') format('embedded-opentype'),
		url('http://jlalovi-cv.herokuapp.com/font/icomoon.ttf') format('truetype'),
		url('http://jlalovi-cv.herokuapp.com/font/icomoon.woff') format('woff'),
		url('http://jlalovi-cv.herokuapp.com/font/icomoon.svg#icomoon') format('svg');
	font-weight: normal;
	font-style: normal;
}

[class^="icon-"], [class*=" icon-"] {
	font-family: 'icomoon';
	speak: none;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	line-height: 1;

	/* Better Font Rendering =========== */
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}
.icon-cloudy:before {
	content: "\e60f";
}
.icon-sun:before {
	content: "\e610";
}
.icon-cloudy2:before {
	content: "\e611";
}
/************************************* END FONTS *************************************/

* {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;  
}

body {
	background: #1f253d;
}

ul {
	list-style-type: none;
	margin: 0;
	padding-left: 0;
}

h1 {
	font-size: 23px;
}

h2 {
	font-size: 17px;
}

p {
	font-size: 15px;
}

a {
	text-decoration: none;
	font-size: 15px;
}
	a:hover {
		text-decoration: underline;
	}

h1, h2, p, a, span{
	color: #fff;
}
	.scnd-font-color {
		color: #9099b7;
	}

.input-container {
	position: relative;
}
	input[type=text]{
		width: 260px;
		height: 50px;
		margin-left: 20px;
		margin-bottom: 20px;
		padding-left: 45px;
		background: #50597b;
		color: #fff;
		border: solid 1px #1f253d;
		border-radius: 5px;		
	}
		input[type=text]::-webkit-input-placeholder { /* WebKit browsers */
	   		color: #fff;	   		
	   	}
		input[type=text]:-moz-input-placeholder { /* Mozilla Firefox 4 to 18 */
	   		color: #fff;	   
	   	}
		input[type=text]::-moz-input-placeholder { /* Mozilla Firefox 19+ */
	   		color: #fff;
	   	}
		input[type=text]:-ms-input-placeholder { /* Internet Explorer 10+ */
	   		color: #fff;	   	
	   	}
	   	input[type=text]:focus {
	   		outline: none; /* removes the default orange border when focus */
	   		border: 1px solid #11a8ab;
	   	}
	.input-icon {
		font-size: 22px;
		position: absolute;
		left: 31px;
		top: 10px;
	}
		.input-icon.password-icon {
			left: 35px;
		}

.horizontal-list {
	margin: 0;
	padding: 0;
	list-style-type: none;
}
	.horizontal-list li {
		float: left;
	}

.clear {
	clear: both;
}

.icon {
	font-size: 25px;
}

.titular {
	display: block;
	line-height: 60px;
	margin: 0;
	text-align: center;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
}

.button {
	display: block;
	width: 175px;
	line-height: 50px;
	font-size: 16px;
	font-weight: 700;
	text-align: center;
	margin: 0 auto;
	border-radius: 5px;
	-webkit-transition: background .3s;
	transition: background .3s;
}
	.button:hover {
		text-decoration: none;
	}

.arrow-btn-container {
	position: relative;
}
	.arrow-btn {
		position: absolute;
		display: block;
		width: 60px;
		height: 60px;
		-webkit-transition: background .3s;
		transition: background .3s;
	}
		.arrow-btn:hover {
			text-decoration: none;
		}
		.arrow-btn.left {
			border-top-left-radius: 5px;
		}
		.arrow-btn.right {
			border-top-right-radius: 5px;
			right: 0;
			top: 0;
		}
		.arrow-btn .icon {
			display: block;
			font-size: 18px;
			border: 2px solid #fff;
			border-radius: 100%;
			line-height: 17px;
			width: 21px;
			margin: 20px auto;
			text-align: center;
		}
			.arrow-btn.left .icon {
				padding-right: 2px;
			}

.profile-picture {
	border-radius: 100%;
	overflow: hidden;
	-webkit-box-sizing: content-box;
  	-moz-box-sizing: content-box;
  	box-sizing: content-box;	
}
	.big-profile-picture {
		margin: 0 auto;		
		border: 5px solid #50597b;
		width: 150px;
		height: 150px;
	}
	.small-profile-picture {
		border: 2px solid #50597b;
		width: 40px;
		height: 40px;
	}


/** MAIN CONTAINER **/

.main-container {
	font-family: 'Ubuntu', sans-serif;
	width: 950px;
	height: 1725px;
	margin: 0 auto;
}	
	/*********************************************** HEADER ***********************************************/
	header {
		height: 80px;
	}
		.header-menu {
			font-size: 17px;
			line-height: 80px;
		}
			.header-menu li {
				position: relative;
        		-webkit-transform: translateZ(0); /** To avoid a flash when hover messages **/
			}
				.header-menu-tab {
					padding: 0 27px;
					display: block;
					line-height: 74px;
					font-size: 17px;
					-webkit-transition: background .3s;
					transition: background .3s;
				}
					.header-menu-tab:hover {
						background: #50597b;
						border-bottom: 4px solid #11a8ab;
						text-decoration: none;
					}
					.header-menu-tab .icon {
						padding-right: 15px;
					}
				.header-menu-number {
					position: absolute;
					line-height: 22px;
					padding: 0 6px;
					font-weight: 700;
					background: #e64c65;
					border-radius: 100%;
					top: 15px;
					right: 2px;
					-webkit-transition: all .3s linear;
					transition: all .3s linear;
				}
					.header-menu li:hover .header-menu-number {
						text-decoration: none;
						-webkit-transform: rotate(360deg);
						transform: rotate(360deg);

					}
		.profile-menu {
			float: right;
			height: 80px;
			padding-right: 20px;
		}
			.profile-menu p {
				font-size: 17px;
				display: inline-block;
				line-height: 76px;
				margin: 0;
				padding-right: 10px;
			}
				.profile-menu a {
					padding-left: 5px;
				}
					.profile-menu a:hover {
						text-decoration: none;
					}
			.small-profile-picture {
				display: inline-block;
				vertical-align: middle;				
			}
	/** CONTAINERS **/
	.container {
		float: left;
		width: 300px;
	}
		.block {
			margin-bottom: 25px;
			background: #394264;
			border-radius: 5px;
		}
		/******************************************** LEFT CONTAINER *****************************************/
		.left-container {}
			.menu-box {
				height: 360px;
			}
				.menu-box .titular {
					background: #11a8ab;
				}
				.menu-box-menu .icon {
					display: inline-block;
					vertical-align: top;
					width: 28px;
					margin-left: 20px;
					margin-right: 15px;
				}
				.menu-box-number {
					width: 36px;
					line-height: 22px;
					background: #50597b;
					text-align: center;
					border-radius: 15px;
					position: absolute;
					top: 15px;
					right: 15px;
					-webkit-transition: all .3s;
					transition: all .3s;
				}
				.menu-box-menu li{
					height: 60px;
					position: relative;										
				}
				.menu-box-tab {
					line-height: 60px;
					display: block;
					border-bottom: 1px solid #1f253d;
					-webkit-transition: background .2s;
					transition: background .2s;
				}
					.menu-box-tab:hover {
						background: #50597b;
						border-top: 1px solid #1f253d;
						text-decoration: none;
					}
					.menu-box-tab:hover .icon {
						color: #fff;
					}
					.menu-box-tab:hover .menu-box-number {
						background: #e64c65;
					}
			.donut-chart-block {
				height: 434px;
			}
				.donut-chart-block .titular {
					padding: 10px 0;
				}
				.donut-chart {
					height: 270px;
				}
					#donut-chart {
						position: relative;
						width: 205px;
						height: 205px;
						margin: 0 auto;
						border: 40px solid #11a8ab;
						border-radius: 100%
					}
						.center-date {
							position: absolute;
							text-align: center;
							font-size: 28px;
							top: 0px;
							right: 30px;
						}
				.os-percentages li {
					width: 75px;
					border-left: 1px solid #394264;
					text-align: center;					
					background: #50597b;
				}
					.os {
						margin: 0;
						padding: 10px 0 5px;
						font-size: 15px;		
					}
						.os.ios {
							border-top: 4px solid #e64c65;
						}
						.os.mac {
							border-top: 4px solid #11a8ab;
						}
						.os.linux {
							border-top: 4px solid #fcb150;
						}
						.os.win {
							border-top: 4px solid #4fc4f6;
						}
					.os-percentage {
						margin: 0;
						padding: 0 0 15px 10px;
						font-size: 25px;
					}
			.line-chart-block {
				height: 400px;
			}
				.line-chart {
					height: 200px;
					background: #11a8ab;
				}
				.time-lenght {
					padding-top: 22px;
					padding-left: 38px;
				}
					.time-lenght-btn {
						display: block;
						width: 70px;
						line-height: 32px;
						background: #50597b;
						border-radius: 5px;
						font-size: 14px;
						text-align: center;
						margin-right: 5px;
						-webkit-transition: background .3s;
						transition: background .3s;
					}
						.time-lenght-btn:hover {
							text-decoration: none;
							background: #e64c65;
						}
				.month-data {
					padding-top: 28px;
				}
					.month-data p {
						display: inline-block;
						margin: 0;
						padding: 0 25px 15px;            
						font-size: 16px;
					}
						.month-data p:last-child {
							padding: 0 25px;
              float: right;
							font-size: 15px;
						}
						.increment {
							color: #e64c65;
						}
			.media {
				height: 216px;
			}
				#media-display {
					position: relative;
					height: 180px;
					background: #787878;
				}
					#media-display .play {
						position: absolute;
						top: 75px;
						right: 40px;
						border: 2px solid #fff;
						border-radius: 100%;
						padding: 2px 5px 2px 9px;
					}
						#media-display .play:hover {
							border: 2px solid #e64c65;
					}
				.media-control-bar {
					padding: 6px 0 0 15px;
				}
					.media-btn, .time-passed {
						display: inline-block;
						margin: 0;					
					}
					.media-btn {
						font-size: 19px;						
					}
						.media-btn:hover, .media-btn:hover span {
							text-decoration: none;
							color: #e64c65;
						}
						.play {
							margin-right: 100px
						}
						.volume {
							margin-left: 30px;
						}
						.resize {
							margin-left: 12px;
						}
			.left-container .social {
				height: 110px;
			}
				.left-container .social li {
					width: 75px;
					height: 110px;										
				}
					.left-container .social li .icon {
						text-align: center;
						font-size: 20px;
						margin: 0;
						line-height: 75px;
					}
					.left-container .social li .number {
						text-align: center;
						margin: 0;
						line-height: 34px;
					}
					.left-container .social .facebook {
						background: #3468af;
						border-top-left-radius: 5px;
						border-bottom-left-radius: 5px;
					}
						.left-container .social .facebook .number {
							background: #1a4e95;
							border-bottom-left-radius: 5px;
						}
					.left-container .social .twitter {
						background: #4fc4f6;						
					}
						.left-container .social .twitter .icon {
							font-size: 18px;
						}
						.left-container .social .twitter .number {
							background: #35aadc;
						}
					.left-container .social .googleplus {
						background: #e64c65;						
					}
						.left-container .social .googleplus .number{
							background: #cc324b;
						}
					.left-container .social .mailbox {
						background: #50597b;						
						border-top-right-radius: 5px;
						border-bottom-right-radius: 5px;
					}
						.left-container .social .mailbox .number {
							background: #363f61;
							border-bottom-right-radius: 5px;
						}
		/************************************************** MIDDLE CONTAINER **********************************/
		.middle-container {
			margin: 0 25px;			
		}
			.profile {
				height: 410px;
			}
				.add-button .icon {
					float: right;
					line-height: 18px;
					width: 23px;					
					border: 2px solid;
					border-radius: 100%;
					font-size: 18px;
					text-align: center;
					margin: 10px;					
				}
					.add-button .icon:hover {
						color: #e64c65;
						border-color: #e64c65;
					}
				.user-name {
					margin: 25px 0 16px;
					text-align: center;
				}
				.profile-description {
					width: 210px;
					margin: 0 auto;
					text-align: center;
				}
				.profile-options {
					padding-top: 23px;
				}
					.profile-options li {
						border-left: 1px solid #1f253d;
					}
						.profile-options p {
							margin: 0;
						}
						.profile-options a {
							display: block;					
							width: 99px;
							line-height: 57px;
							text-align: center;
							-webkit-transition: background .3s;
							transition: background .3s;				
						}
							.profile-options a:hover {
								text-decoration: none;
								background: #50597b;
							}
							.profile-options a:hover.comments .icon {
								color: #fcb150;
							}
							.profile-options a:hover.views .icon {
								color: #11a8ab;
							}
							.profile-options a:hover.likes .icon {
								color: #e64c65;
							}
							.profile-options .icon {
								padding-right: 10px;
							}
							.profile-options .comments {
								border-top: 4px solid #fcb150;
							}
							.profile-options .views {
								border-top: 4px solid #11a8ab;
							}
							.profile-options .likes {
								border-top: 4px solid #e64c65;
							}
			.weather {
				height: 555px;
			}
				.weather .titular {
					background: #cc324b;
				}
					.weather .titular .icon {
						padding-right: 15px;
						font-size: 26px;
					}
				.weather .current-day {
					height: 135px;
					background: #e64c65;
				}
					.weather .current-day p {
						margin: 0;
						padding-left: 50px;					
					}
						.current-day-date {
							font-size: 16px;
							padding-top: 16px;
						}
						.current-day-temperature {
							font-size: 70px;
						}
							.current-day-temperature .icon-cloudy {
								padding-left: 20px;
							}
				.weather .next-days{}
				.weather .next-days p {
					margin: 0;
					display: inline-block;
					font-size: 16px;
				}
				.weather .next-days a {
					display: block;
					line-height: 58px;
					border-bottom: 1px solid #1f253d;
					-webkit-transition: background .3s;
					transition: background .3s;
				}
					.weather .next-days a:hover {
						background: #50597b;
					}
					.weather .next-days a:hover .day {
						color: #e64c65;
					}
					.weather .next-days-date {
						padding-left: 20px;
					}
					.weather .next-days-temperature {
						float: right;
						padding-right: 20px;
					}
						.weather .next-days-temperature .icon {
							padding-left: 10px;
						}
			.tweets {
				height: 375px;
			}
				.tweets .titular {
					background: #35aadc;
				}
					.tweets .titular .icon {
						font-size: 18px;
						padding-right: 20px;
					}
				.tweet.first {
					height: 150px;
					border-bottom: 1px solid #1f253d;
				}
					.tweet p:first-child {
						margin: 0;
						padding: 30px 30px 0;
					}
					.tweet p:last-child {
						margin: 0;
						padding: 15px 30px 0;
					}
					.tweet-link {
						color: #4fc4f6;
					}
			.middle-container .social {
				height: 205px;
				background: #1f253d;
			}
				.middle-container .social li {
					margin-bottom: 12px;
				}
				.middle-container .social a {
					line-height: 60px;			
				}
					.middle-container .social a:hover {
						text-decoration: none;
					}
					.middle-container .social .titular {
						border-radius: 5px;
					}
						.middle-container .social .facebook {
							background: #3468af;
							-webkit-transition: background .3s;
							transition: background .3s;
						}
							.middle-container .social a:hover .facebook {
								background: #1a4e95;
							}
							.middle-container .social a:hover .icon.facebook {
								background: #3468af;
							}
						.middle-container .social .twitter {
							background: #4fc4f6;
							-webkit-transition: background .3s;
							transition: background .3s;
						}
							.middle-container .social a:hover .twitter {
								background: #35aadc;
							}
							.middle-container .social a:hover .icon.twitter {
								background: #4fc4f6;
							}
						.middle-container .social .googleplus {
							background: #e64c65;
							-webkit-transition: background .3s;
							transition: background .3s;
						}
							.middle-container .social a:hover .googleplus {
								background: #cc324b;
							}
							.middle-container .social a:hover .icon.googleplus {
								background: #e64c65;
							}
				.middle-container .social .icon {
					float: left;
					width: 60px;
					height: 60px;
					text-align: center;
					font-size: 20px;
					border-bottom-left-radius: 5px;
					border-top-left-radius: 5px;
				}
					.middle-container .social .icon.facebook {
						background: #1a4e95;						
					}
					.middle-container .social .icon.twitter {
						background: #35aadc;						
					}
					.middle-container .social .icon.googleplus {
						background: #cc324b;						
					}
		/********************************************* RIGHT CONTAINER ****************************************/
		.right-container {}
			.join-newsletter {
				height: 230px;
			}
				.join-newsletter .titular {
					padding-top: 10px;
				}
				.subscribe.button {
					background: #11a8ab;
					margin-top: 10px;
				}
					.subscribe.button:hover {
						background: #0F9295;
					}
			.account {
				height: 390px;
			}
				.account .titular {
					padding: 10px 0;
				}
				.sign-in.button {
					background: #e64c65;
					margin: 10px auto;
				}
					.sign-in.button:hover {
						background: #cc324b;
					}
				.account p { 
					text-align: center;
				}
				.fb-sign-in {
					margin-top: 28px;
					display: block;
					line-height: 50px;
					background: #3468af;
					border-bottom-left-radius: 5px;
					border-bottom-right-radius: 5px;
					-webkit-transition: background .3s;
					transition: background .3s;
				}
					.fb-sign-in:hover {
						background: #1a4e95;
						text-decoration: none;
					}
				.fb-sign-in .icon {	
					line-height: 20px;
					font-size: 12px;
					padding-right: 3px;
				}
					.fb-border {
						display: inline-block;
						width: 23px;
						line-height: 20px;
						border: 2px solid #fff;
						border-radius: 100%;
						margin-right: 10px;
					}
			.loading {
				height: 200px;
				padding-top: 35px;
			}
				.loading p {
					display: inline-block;
					padding-left: 30px;
					margin: 5px 0 20px;
				}
					.loading .icon {
						padding-right: 15px;
					}
					.loading .percentage {
						float: right;
						padding: 6px 35px 0 0;
					}
				.loading .progress-bar {
					width: 250px;
					height: 20px;
					background: #50597b;
					border-radius: 5px;
					margin: 0 auto;
				}
					.progress-bar.downloading {
						background: -webkit-linear-gradient(left, #11a8ab 81%,#50597b 81%); /* Chrome10+,Safari5.1+ */
						background: -ms-linear-gradient(left, #11a8ab 81%,#50597b 81%); /* IE10+ */
						background: linear-gradient(to right, #11a8ab 81%,#50597b 81%); /* W3C */
					}
					.progress-bar.uploading {
						background: -webkit-linear-gradient(left, #4fc4f6 43%,#50597b 43%); /* Chrome10+,Safari5.1+ */
						background: -ms-linear-gradient(left, #4fc4f6 43%,#50597b 43%); /* IE10+ */
						background: linear-gradient(to right, #4fc4f6 43%,#50597b 43%); /* W3C */
					}
			.calendar-day {
				height: 320px;
				background: #3468af;
			}
				.calendar-day .titular {
					background: #1a4e95;
				}
					.calendar-day .arrow-btn:hover {
						background: #16417E;
					}
				.calendar-day .the-day {
					margin: 0;
					text-align: center;
					font-size: 146px;
				}
				.add-event.button {
					background: #4fc4f6;
				}
					.add-event.button:hover {
						background: #35aadc;
					}
			.calendar-month {
				height: 380px;
			}
				.calendar-month .titular {
					background: #3468af;
				}
					.calendar-month .arrow-btn:hover {
						background: #1a4e95;
					}
				.calendar {
					margin: 22px 15px;
					text-align: center;
				}
					.calendar a {
						font-size: 17px;
					}
					.calendar td, .calendar th {
						width: 40px;
						height: 38px;						
					}
					.calendar .days-week {
						color: #4fc4f6;
					}
					.calendar .today {
						display: block;
						width: 34px;
						line-height: 34px;
						background: #e64c65;
						border-radius: 100%;
					}

</style>

<!-- BLOCK HTML  -->



        <div class="main-container">

            <!-- HEADER -->
            <header class="block">
                <ul class="header-menu horizontal-list">
                    <li>
                        <a class="header-menu-tab" href="#1"><span class="icon entypo-cog scnd-font-color"></span>Settings</a>
                    </li>
                    <li>
                        <a class="header-menu-tab" href="#2"><span class="icon fontawesome-user scnd-font-color"></span>Account</a>
                    </li>
                    <li>
                        <a class="header-menu-tab" href="#3"><span class="icon fontawesome-envelope scnd-font-color"></span>Messages</a>
                        <a class="header-menu-number" href="#4">5</a>
                    </li>
                    <li>
                        <a class="header-menu-tab" href="#5"><span class="icon fontawesome-star-empty scnd-font-color"></span>Favorites</a>
                    </li>
                </ul>
                <div class="profile-menu">
                    <p>Me <a href="#26"><span class="entypo-down-open scnd-font-color"></span></a></p>
                    <div class="profile-picture small-profile-picture">
                        <img width="40px" alt="Anne Hathaway picture" src="http://upload.wikimedia.org/wikipedia/commons/e/e1/Anne_Hathaway_Face.jpg">
                    </div>
                </div>
            </header>

            <!-- LEFT-CONTAINER -->
            <div class="left-container container">
                <div class="menu-box block"> <!-- MENU BOX (LEFT-CONTAINER) -->
                    <h2 class="titular">MENU BOX</h2>
                    <ul class="menu-box-menu">
                        <li>
                            <a class="menu-box-tab" href="#6"><span class="icon fontawesome-envelope scnd-font-color"></span>Messages<div class="menu-box-number">24</div></a>                            
                        </li>
                        <li>
                            <a class="menu-box-tab" href="#8"><span class="icon entypo-paper-plane scnd-font-color"></span>Invites<div class="menu-box-number">3</div></a>                            
                        </li>
                        <li>
                            <a class="menu-box-tab" href="#10"><span class="icon entypo-calendar scnd-font-color"></span>Events<div class="menu-box-number">5</div></a>                            
                        </li>
                        <li>
                            <a class="menu-box-tab" href="#12"><span class="icon entypo-cog scnd-font-color"></span>Account Settings</a>
                        </li>
                        <li>
                            <a class="menu-box-tab" href="#13"><sapn class="icon entypo-chart-line scnd-font-color"></sapn>Statistics</a>
                        </li>                        
                    </ul>
                </div>
                <div class="donut-chart-block block"> <!-- DONUT CHART BLOCK (LEFT-CONTAINER) -->
                    <h2 class="titular">OS AUDIENCE STATS</h2>
                    <div class="donut-chart">
                        <div id="donut-chart">
                            <p class="center-date">JUNE<br/><span class="scnd-font-color">2013</span></p>
                        </div>
                    </div>
                    <ul class="os-percentages horizontal-list">
                        <li>
                            <p class="ios os scnd-font-color">iOS</p>
                            <p class="os-percentage">21<sup>%</sup></p>
                        </li>
                        <li>
                            <p class="mac os scnd-font-color">Mac</p>
                            <p class="os-percentage">48<sup>%</sup></p>
                        </li>
                        <li>
                            <p class="linux os scnd-font-color">Linux</p>
                            <p class="os-percentage">9<sup>%</sup></p>
                        </li>
                        <li>
                            <p class="win os scnd-font-color">Win</p>
                            <p class="os-percentage">32<sup>%</sup></p>
                        </li>
                    </ul>
                </div>
                <div class="line-chart-block block clear"> <!-- LINE CHART BLOCK (LEFT-CONTAINER) -->
                    <div class="line-chart"></div>
                    <ul class="time-lenght horizontal-list">
                        <li><a class="time-lenght-btn" href="#14">Week</a></li>
                        <li><a class="time-lenght-btn" href="#15">Month</a></li>
                        <li><a class="time-lenght-btn" href="#16">Year</a></li>
                    </ul>
                    <ul class="month-data clear">
                        <li>
                            <p>APR<span class="scnd-font-color"> 2013</span></p>
                            <p><span class="entypo-plus increment"> </span>21<sup>%</sup></p>
                        </li>
                        <li>
                            <p>MAY<span class="scnd-font-color"> 2013</span></p>
                            <p><span class="entypo-plus increment"> </span>48<sup>%</sup></p>
                        </li>
                        <li>
                            <p>JUN<span class="scnd-font-color"> 2013</span></p>
                            <p><span class="entypo-plus increment"> </span>35<sup>%</sup></p>
                        </li>
                    </ul>
                </div>
                <div class="media block"> <!-- MEDIA (LEFT-CONTAINER) -->
                    <div id="media-display">
                        <a class="media-btn play" href="#23"><span class="fontawesome-play"></span></a>
                    </div>
                    <div class="media-control-bar">
                        <a class="media-btn play" href="#23"><span class="fontawesome-play scnd-font-color"></span></a>
                        <p class="time-passed">4:15 <span class="time-duration scnd-font-color">/ 9:23</span></p>
                        <a class="media-btn volume" href="#24"><span class="fontawesome-volume-up scnd-font-color"></span></a>
                        <a class="media-btn resize" href="#25"><span class="fontawesome-resize-full scnd-font-color"></span></a>
                    </div>
                </div>
                <ul class="social horizontal-list block"> <!-- SOCIAL (LEFT-CONTAINER) -->
                    <li class="facebook"><p class="icon"><span class="zocial-facebook"></span></p><p class="number">248k</p></li>
                    <li class="twitter"><p class="icon"><span class="zocial-twitter"></span></p><p class="number">30k</p></li>
                    <li class="googleplus"><p class="icon"><span class="zocial-googleplus"></span></p><p class="number">124k</p></li>
                    <li class="mailbox"><p class="icon"><span class="fontawesome-envelope"></span></p><p class="number">89k</p></li>
                </ul>
            </div>

            <!-- MIDDLE-CONTAINER -->
            <div class="middle-container container">
                <div class="profile block"> <!-- PROFILE (MIDDLE-CONTAINER) -->
                    <a class="add-button" href="#28"><span class="icon entypo-plus scnd-font-color"></span></a>
                    <div class="profile-picture big-profile-picture clear">
                        <img width="150px" alt="Anne Hathaway picture" src="http://upload.wikimedia.org/wikipedia/commons/e/e1/Anne_Hathaway_Face.jpg" >
                    </div>
                    <h1 class="user-name">Anne Hathaway</h1>
                    <div class="profile-description">
                        <p class="scnd-font-color">Lorem ipsum dolor sit amet consectetuer adipiscing</p>
                    </div>
                    <ul class="profile-options horizontal-list">
                        <li><a class="comments" href="#40"><p><span class="icon fontawesome-comment-alt scnd-font-color"></span>23</li></p></a>
                        <li><a class="views" href="#41"><p><span class="icon fontawesome-eye-open scnd-font-color"></span>841</li></p></a>
                        <li><a class="likes" href="#42"><p><span class="icon fontawesome-heart-empty scnd-font-color"></span>49</li></p></a>
                    </ul>
                </div>
                <div class="weather block clear"> <!-- WEATHER (MIDDLE-CONTAINER) -->
                    <h2 class="titular"><span class="icon entypo-location"></span><strong>CLUJ-NAPOCA</strong>/RO</h2>
                    <div class="current-day">
                        <p class="current-day-date">FRI 29/06</p>
                        <p class="current-day-temperature">24�<span class="icon-cloudy"></span></p>
                    </div>
                    <ul class="next-days">
                        <li>
                            <a href="#43">
                                <p class="next-days-date"><span class="day">SAT</span> <span class="scnd-font-color">29/06</span></p>
                                <p class="next-days-temperature">25�<span class="icon icon-cloudy scnd-font-color"></span></p>
                            </a>
                        </li>
                        <li>
                            <a href="#44">
                                <p class="next-days-date"><span class="day">SUN</span> <span class="scnd-font-color">30/06</span></p>
                                <p class="next-days-temperature">22�<span class="icon icon-cloudy2 scnd-font-color"></span></p>
                            </a>
                        </li>
                        <li>
                            <a href="#45">
                                <p class="next-days-date"><span class="day">MON</span> <span class="scnd-font-color">01/07</span></p>
                                <p class="next-days-temperature">24�<span class="icon icon-cloudy2 scnd-font-color"></span></p>
                            </a>
                        </li>
                        <li>
                            <a href="#46">
                                <p class="next-days-date"><span class="day">TUE</span> <span class="scnd-font-color">02/07</span></p>
                                <p class="next-days-temperature">26�<span class="icon icon-cloudy scnd-font-color"></span></p>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <p class="next-days-date"><span class="day">WED</span> <span class="scnd-font-color">03/07</span></p>
                                <p class="next-days-temperature">27�<span class="icon icon-sun scnd-font-color"></span></p>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <p class="next-days-date"><span class="day">THU</span> <span class="scnd-font-color">04/07</span></p>
                                <p class="next-days-temperature">29�<span class="icon icon-sun scnd-font-color"></span></p>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tweets block"> <!-- TWEETS (MIDDLE-CONTAINER) -->
                    <h2 class="titular"><span class="icon zocial-twitter"></span>LATEST TWEETS</h2>
                    <div class="tweet first">
                        <p>Ice-cream trucks only play music when out of ice-cream. Well played dad. On <a class="tweet-link" href="#17">@Quora</a></p>
                        <p><a class="time-ago scnd-font-color" href="#18">3 minutes ago</a></p>
                    </div>
                    <div class="tweet">
                        <p>We are in the process of pushing out all of the new CC apps! We will tweet again once they are live <a class="tweet-link" href="#19">#CreativeCloud</a></p>
                        <p><a class="scnd-font-color" href="#20">6 hours ago</a></p>
                    </div>
                </div> 
                <ul class="social block"> <!-- SOCIAL (MIDDLE-CONTAINER) -->
                    <li><a href="#50"><div class="facebook icon"><span class="zocial-facebook"></span></div><h2 class="facebook titular">SHARE TO FACEBOOK</h2></li></a>
                    <li><a href="#51"><div class="twitter icon"><span class="zocial-twitter"></span></div><h2 class="twitter titular">SHARE TO TWITTER</h2></li></a>
                    <li><a href="#52"><div class="googleplus icon"><span class="zocial-googleplus"></span></div><h2 class="googleplus titular">SHARE TO GOOGLE+</h2></li></a>
                </ul>
            </div>

            <!-- RIGHT-CONTAINER -->
            <div class="right-container container">
                <div class="join-newsletter block"> <!-- JOIN NEWSLETTER (RIGHT-CONTAINER) -->
                    <h2 class="titular">JOIN THE NEWSLETTER</h2>
                    <div class="input-container">
                        <input type="text" placeholder="yourname@gmail.com" class="email text-input">
                        <div class="input-icon envelope-icon-newsletter"><span class="fontawesome-envelope scnd-font-color"></span></div>
                    </div>
                    <a class="subscribe button" href="#21">SUBSCRIBE</a>
                </div>
                <div class="account block"> <!-- ACCOUNT (RIGHT-CONTAINER) -->
                    <h2 class="titular">SIGN IN TO YOUR ACCOUNT</h2>
                    <div class="input-container">
                        <input type="text" placeholder="yourname@gmail.com" class="email text-input">
                        <div class="input-icon envelope-icon-acount"><span class="fontawesome-envelope scnd-font-color"></span></div>
                    </div>
                    <div class="input-container">
                        <input type="text" placeholder="Password" class="password text-input">
                        <div class="input-icon password-icon"><span class="fontawesome-lock scnd-font-color"></span></div>
                    </div>
                    <a class="sign-in button" href="#22">SIGN IN</a>
                    <p class="scnd-font-color">Forgot Password?</p>
                    <a class="fb-sign-in" href="58">
                        <p><span class="fb-border"><span class="icon zocial-facebook"></span></span>Sign in with Facebook</p>
                    </a>
                </div>
                <div class="loading block"> <!-- LOADING (RIGHT-CONTAINER) -->
                    <div class="progress-bar downloading"></div>
                    <p><span class="icon fontawesome-cloud-download scnd-font-color"></span>Downloading...</p>
                    <p class="percentage">81<sup>%</sup></p>
                    <div class="progress-bar uploading"></div>
                    <p><span class="icon fontawesome-cloud-upload scnd-font-color"></span>Uploading...</p>
                    <p class="percentage">43<sup>%</sup></p>
                </div>
                <div class="calendar-day block"> <!-- CALENDAR DAY (RIGHT-CONTAINER) -->
                    <div class="arrow-btn-container">
                        <a class="arrow-btn left" href="#200"><span class="icon fontawesome-angle-left"></span></a>
                        <h2 class="titular">WEDNESDAY</h2>
                        <a class="arrow-btn right" href="#201"><span class="icon fontawesome-angle-right"></span></a>
                    </div>
                        <p class="the-day">26</p>
                        <a class="add-event button" href="#27">ADD EVENT</a>
                </div>
                <div class="calendar-month block"> <!-- CALENDAR MONTH (RIGHT-CONTAINER) -->
                    <div class="arrow-btn-container">
                        <a class="arrow-btn left" href="#202"><span class="icon fontawesome-angle-left"></span></a>
                        <h2 class="titular">APRIL 2013</h2>
                        <a class="arrow-btn right" href="#203"><span class="icon fontawesome-angle-right"></span></a>
                    </div>
                    <table class="calendar">
                        <thead class="days-week">
                            <tr>
                                <th>S</th>
                                <th>M</th>
                                <th>T</th>
                                <th>W</th>
                                <th>R</th>
                                <th>F</th>
                                <th>S</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a class="scnd-font-color" href="#100">1</a></td>
                            </tr>
                            <tr>
                                <td><a class="scnd-font-color" href="#101">2</a></td>
                                <td><a class="scnd-font-color" href="#102">3</a></td>
                                <td><a class="scnd-font-color" href="#103">4</a></td>
                                <td><a class="scnd-font-color" href="#104">5</a></td>
                                <td><a class="scnd-font-color" href="#105">6</a></td>
                                <td><a class="scnd-font-color" href="#106">7</a></td>
                                <td><a class="scnd-font-color" href="#107">8</a></td>
                            </tr>
                            <tr>
                                <td><a class="scnd-font-color" href="#108">9</a></td>
                                <td><a class="scnd-font-color" href="#109">10</a></td>
                                <td><a class="scnd-font-color" href="#110">11</a></td>
                                <td><a class="scnd-font-color" href="#111">12</a></td>
                                <td><a class="scnd-font-color" href="#112">13</a></td>
                                <td><a class="scnd-font-color" href="#113">14</a></td>
                                <td><a class="scnd-font-color" href="#114">15</a></td>
                            </tr>
                            <tr>
                                <td><a class="scnd-font-color" href="#115">16</a></td>
                                <td><a class="scnd-font-color" href="#116">17</a></td>
                                <td><a class="scnd-font-color" href="#117">18</a></td>
                                <td><a class="scnd-font-color" href="#118">19</a></td>
                                <td><a class="scnd-font-color" href="#119">20</a></td>
                                <td><a class="scnd-font-color" href="#120">21</a></td>
                                <td><a class="scnd-font-color" href="#121">22</a></td>
                            </tr>
                            <tr>
                                <td><a class="scnd-font-color" href="#122">23</a></td>
                                <td><a class="scnd-font-color" href="#123">24</a></td>
                                <td><a class="scnd-font-color" href="#124">25</a></td>
                                <td><a class="today" href="#125">26</a></td>
                                <td><a href="#126">27</a></td>
                                <td><a href="#127">28</a></td>
                                <td><a href="#128">29</a></td>
                            </tr>
                            <tr>
                                <td><a href="#129">30</a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end calendar-month block --> 
            </div> <!-- end right-container -->
        </div> <!-- end main-container -->


<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){

  
};
</script>