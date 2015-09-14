<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://' , CClientScript::POS_END);
?>
<style>
* {
	margin: 0;
	padding: 0;
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", "Droid Sans", sans-serif;
}

body {
	background: #545454;
}

.bubble-left {
	float: left;
	clear: both;
	background: #B7CC90;
}

.bubble-left:hover {
	background: #A9C07F;
}

.bubble-left:before {
	content: " ";
	display: block;
	position: relative;
	top: 0px;
	left: -11px;
	height: 13px;
	width: 13px;
	background: inherit; /*#B7CC90*/
	z-index: 100;

	-webkit-transform: rotate(-45deg);
       -moz-transform: rotate(-45deg);
         -o-transform: rotate(-45deg);
            transform: rotate(-45deg);
}

.bubble-right {
	float: right;
	clear: both;
	text-align: right;
	background: #90B2CC;;
}

.bubble-right:hover {
	background: #82A6C1;
}

.bubble-right:before {
	content: " ";
	display: block;
	position: relative;
	top: 0px;
	right: -99.8%;
	height: 13px;
	width: 13px;
	background: inherit; /*#90B2CC*/

	-webkit-transform: rotate(-45deg);
       -moz-transform: rotate(-45deg);
         -o-transform: rotate(-45deg);
            transform: rotate(-45deg);
}

.message-container {
	display: block;
	margin: auto;
	margin-top: 2.5%;
	height: 620px; /*Global Height of Widget*/
	width: 80%; /*Global Width of Widget*/
	background: #E1E1E1;
	box-shadow: 0px 0px 50px #1E1E1E;
}

.message-container > .message-north {
	width: 100%;
	height: 80%;

	-webkit-box-sizing: border-box;
	   -moz-box-sizing: border-box;
	        box-sizing: border-box;
}

.message-container > .message-south {
	width: 100%;
	height: 20%;
	padding: 1%;

	-webkit-box-sizing: border-box;
	   -moz-box-sizing: border-box;
	        box-sizing: border-box;
}

.message-container > .message-north > .message-user-list {
	list-style-type: none;
	float: left;
	clear: left;
	width: 20%;
	height: 100%;
	overflow-x: hidden;
	overflow-y: scroll;
}

.message-container > .message-north > .message-user-list a {
	display: block;
	padding: 10px;
	height: 40px; /*Keep height same as img thumbnail height*/
	text-decoration: none;
	color: #313131;

	-webkit-transition: all ease .2s;
	   -moz-transition: all ease .2s;
	    -ms-transition: all ease .2s;
	     -o-transition: all ease .2s;
	        transition: all ease .2s;
}

.message-container > .message-north > .message-user-list a:hover {
	background: #9E9E9E;

	-webkit-transition: all ease .2s;
	   -moz-transition: all ease .2s;
	    -ms-transition: all ease .2s;
	     -o-transition: all ease .2s;
	        transition: all ease .2s;
}

.message-container > .message-north > .message-user-list a .user-img {
	display: block;
	float: left;
	height: 40px;
	width: 40px;
	background: #6A8BBA;
}

.message-container > .message-north > .message-user-list a .user-title {
	margin-left: 5px;
}

.message-container > .message-north > .message-user-list a .user-desc {
	padding-left: 5px;
	padding-top: 5px;
	font-size: 12px;
	color: #5A5A5A;
    white-space: nowrap;
	overflow: hidden;    
    text-overflow: ellipsis;
}

.message-container > .message-north > .message-user-list a.active {
	background: #BFBFBF;
}

.message-container > .message-north > .message-user-list a.highlight {
	background: #90B2CC;
}

.message-container > .message-north > .message-user-list a.highlight .user-title,
.message-container > .message-north > .message-user-list a.highlight .user-desc {
	font-weight: bold;
}

.message-container > .message-north > .message-thread {
	float: right;
	width: 75%;
	height: 100%;
	padding-left: 10px;
	padding-right: 10px;
	background: #F5F5F5;
	overflow-x: hidden;
	overflow-y: scroll;

	-webkit-box-sizing: border-box;
	   -moz-box-sizing: border-box;
	        box-sizing: border-box;
}

.message-container > .message-north > .message-thread > .message {
	min-width: 40%;
	max-width: 70%;
	margin: 5px;
	margin-bottom: 2%;
	padding: 3px 5px 3px 5px;
	cursor: pointer;
}

.message-container > .message-north > .message-thread > .message > p {
	display: block;
	clear: both;
	margin-left: 3px;
	margin-right: 3px;
	font-size: 15px;
}

.message-container > .message-north > .message-thread > .message label {
	margin-top: -13px;
	font-size: 13px;
	font-weight: bold;
	color: #5A5A5A;
	cursor: pointer;
}

.message-container > .message-north > .message-thread > .message .message-user {
	display: block;
	float: left;
	margin-left: 3px;
}

.message-container > .message-north > .message-thread > .message .message-timestamp {
	display: block;
	float: right;
	margin-right: 3px;
	text-align: right;
}

.message-container > .message-south > textarea {
	width: 100%;
	height: 65%;
	padding: 7px 10px;

	outline: none;
	resize: none;
	font-size: 13px;
	color: #666;
	background: #f6f6f6;
	border: 1px solid #b9b9b9;
	border-top-color: #a4a4a4;
	box-shadow: 0 1px 1px rgba(0,0,0,.17) inset;

	-webkit-box-sizing: border-box;
	   -moz-box-sizing: border-box;
	        box-sizing: border-box;
}

.message-container > .message-south > textarea:focus {
	background: #FFF;
}

.message-container > .message-south > button {
	display: block;
	float: right;
	margin-top: 5px;
	height: 35px;
	width: 80px;
	color: #000000;
	background: -webkit-linear-gradient(#F5F5F5, #E9E9E9);
	background:    -moz-linear-gradient(#F5F5F5, #E9E9E9);
	background:      -o-linear-gradient(#F5F5F5, #E9E9E9);
	background:         linear-gradient(#F5F5F5, #E9E9E9);
	border: 2px solid #CCC;
	box-shadow: 0px 1px 2px #C6C6C6;
	cursor: pointer;
}

.message-container > .message-south > button:hover {
	background: -webkit-linear-gradient(#FFFFFF, #DFDFDF);
	background:    -moz-linear-gradient(#FFFFFF, #DFDFDF);
	background:      -o-linear-gradient(#FFFFFF, #DFDFDF);
	background:         linear-gradient(#FFFFFF, #DFDFDF);
}

.message-container > .message-south > button:active {
	box-shadow: inset 0px 0px 10px #5A5A5A;
	background: -webkit-linear-gradient(#E9E9E9, #F5F5F5);
	background:    -moz-linear-gradient(#E9E9E9, #F5F5F5);
	background:      -o-linear-gradient(#E9E9E9, #F5F5F5);
	background:         linear-gradient(#E9E9E9, #F5F5F5);
}
</style>

<div id="wrapper">
			<div class="message-container">
				<div class="message-north">
					<ul class="message-user-list">
						<li>
							<a href="#">
								<span class="user-img"></span>
								<span class="user-title">Bryan Adams</span>
								<p class="user-desc">badams@music.com</p>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="user-img"></span>
								<span class="user-title">Enrique Iglesias</span>
								<p class="user-desc">enriqueiglesias@music.com</p>
							</a>
						</li>
						<li>
							<a class="active" href="#">
								<span class="user-img"></span>
								<span class="user-title">Jack Johnson</span>
								<p class="user-desc">jackjohnson@music.com</p>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="user-img"></span>
								<span class="user-title">Paul McCartney</span>
								<p class="user-desc">paulmccartney@music.com</p>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="user-img"></span>
								<span class="user-title">George Harrison</span>
								<p class="user-desc">georgeharrison@music.com</p>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="user-img"></span>
								<span class="user-title">Jason Mraz</span>
								<p class="user-desc">jasonmraz@music.com</p>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="user-img"></span>
								<span class="user-title">Louis Armstrong</span>
								<p class="user-desc">louisarmstrong@music.com</p>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="user-img"></span>
								<span class="user-title">Clinton Cerejo</span>
								<p class="user-desc">clintoncerejo@music.com</p>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="user-img"></span>
								<span class="user-title">John Lennon</span>
								<p class="user-desc">johnlennon@music.com</p>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="user-img"></span>
								<span class="user-title">Joseph Arthur</span>
								<p class="user-desc">josepharthur@music.com</p>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="user-img"></span>
								<span class="user-title">Bryan Adams</span>
								<p class="user-desc">badams@music.com</p>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="user-img"></span>
								<span class="user-title">Enrique Iglesias</span>
								<p class="user-desc">enriqueiglesias@music.com</p>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="user-img"></span>
								<span class="user-title">Jack Johnson</span>
								<p class="user-desc">jackjohnson@music.com</p>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="user-img"></span>
								<span class="user-title">Paul McCartney</span>
								<p class="user-desc">paulmccartney@music.com</p>
							</a>
						</li>
						<li>
							<a href="#">
								<span class="user-img"></span>
								<span class="user-title">George Harrison</span>
								<p class="user-desc">georgeharrison@music.com</p>
							</a>
						</li>
					</ul>
					<div class="message-thread">
						<div class="message bubble-left">
							<label class="message-user">Bryan Adams</label>
							<label class="message-timestamp">2 Hours Ago</label>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam feugiat nunc ut nibh interdum tempus. Donec at lorem eget sapien iaculis porttitor id quis ligula feugiat nunc ut nibh justo eget elit aliquet interdum tempus.</p>
						</div>
						<div class="message bubble-right">
							<label class="message-user">Jack Johnson</label>
							<label class="message-timestamp">2 Hours Ago</label>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam feugiat nunc ut nibh interdum tempus. Donec at lorem eget sapien iaculis porttitor id quis ligula feugiat nunc ut nibh justo eget elit aliquet interdum tempus.</p>
						</div>
						<div class="message bubble-left">
							<label class="message-user">Bryan Adams</label>
							<label class="message-timestamp">2 Hours Ago</label>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						</div>
						<div class="message bubble-right">
							<label class="message-user">Jack Johnson</label>
							<label class="message-timestamp">2 Hours Ago</label>
							<p>:-)</p>
						</div>
						<div class="message bubble-left">
							<label class="message-user">Bryan Adams</label>
							<label class="message-timestamp">2 Hours Ago</label>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						</div>
						<div class="message bubble-right">
							<label class="message-user">Jack Johnson</label>
							<label class="message-timestamp">2 Hours Ago</label>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam feugiat nunc ut nibh interdum tempus. Donec at lorem eget sapien iaculis porttitor id quis ligula feugiat nunc ut nibh justo eget elit aliquet interdum tempus.</p>
						</div>
						<div class="message bubble-right">
							<label class="message-user">Jack Johnson</label>
							<label class="message-timestamp">2 Hours Ago</label>
							<p>;-)</p>
						</div>
						<div class="message bubble-left">
							<label class="message-user">Bryan Adams</label>
							<label class="message-timestamp">2 Hours Ago</label>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam feugiat nunc ut nibh interdum tempus. Donec at lorem eget sapien iaculis porttitor id quis ligula feugiat nunc ut nibh justo eget elit aliquet interdum tempus.</p>
						</div>
						<div class="message bubble-left">
							<label class="message-user">Bryan Adams</label>
							<label class="message-timestamp">2 Hours Ago</label>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						</div>
					</div>
				</div>
				<div class="message-south">
					<textarea cols="20" rows="3"></textarea>
					<button>Send</button>
				</div>
			</div>
		</div>



<script type="text/javascript"		>
initT['animInit'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},0.3);
})();

  
};
</script>