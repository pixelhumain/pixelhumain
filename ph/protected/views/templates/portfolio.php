<?php 
/*$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://' , CClientScript::POS_END);*/
?>
<style>
/*  GENERAL  */

body {
  margin: 0;
  padding: 0;
	background-color: #efece7;
}
#wrapper {
  max-width: 1600px;
  min-width: 320px;
  margin: 0 auto;
  padding: 0;
  background: #ffffff;
}
#header {
  max-width: 1600px;
  min-width: 320px;
  margin: 30px auto;
  padding: 20px 10px 20px 10px;
  border-bottom: 4px double #000000;
}
#content {
  max-width: 1600px;
  min-width: 320px;
  margin: 0 auto;
  padding: 0 10px 0 10px;
  background: #ffffff;
  border-bottom: 1px solid #000000;
}
#footer {
  max-width: 1600px;
  min-width: 320px;
  height: 200px;
  margin: 0 auto 30px 0;
  padding: 0 10px 0 10px;
  border-bottom: 4px double #000000;
  border-bottom: 20px solid #000000;
}

/*  HEADER  */

#header h1 {
  margin: 0;
	padding: 0 0 20px 0 ;
  font-family: 'Abril Fatface', cursive;
	font-weight: 700;
	font-size: 80px;
  text-align: center;
	color: #000000;
}

/*  IMAGES  */

#content a img {
	border: 0;
  filter: url(filters.svg#grayscale); /* Firefox 3.5+ */
  filter: gray; /* IE6-9 */
  -webkit-filter: grayscale(1);
}
#content a:hover img {
	filter: none;
  -webkit-filter: grayscale(0);
}

/*  CONTENT  */

#content h2 {
	clear: left;
	margin: 0 0 10px 0;
	padding: 10px 0;
	font-family: 'Lato', sans-serif;
  font-weight: 900;
	font-size: 12px;
  text-transform: uppercase;
	color: #333333;
  border-top: 4px solid #000000;
  border-bottom: 1px solid #000000;
}
#content h3 {
	clear: left;
	margin: 0 0 8px 0;
	padding: 10px 0 20px 0;
	font-family: 'Vollkorn', serif;
  font-weight: 400;
	font-size: 12px;
	color: #999999;
  border-top: 1px solid #000000;
}
#content p {
  margin: 0;
  padding: 0;
  clear: left;
	font-weight: 400;
	font-size: 36px;
  line-height: 180%;
	color: #000000;
}
#content ul {
	margin: 0;
	padding: 0 0 0 24px;
}
#content ul li {
	margin: 0;
	padding: 0;
	font-size: 24px;
  line-height: 180%;
	color: #000000;
	list-style-type: circle;
	list-style-position: outside;
}

/*  SECTIONS  */

.section {
	clear: both;
	padding: 0;
	margin: 0;
}

/*  COLUMN SETUP  */
.col {
	display: block;
	float:left;
	margin: 1% 0 1% 1.6%;
}
.col:first-child { margin-left: 0; }


/*  GROUPING  */
.group:before,
.group:after {
	content:"";
	display:table;
}
.group:after {
	clear:both;
}

/*  GRID OF THREE  */
.span_3_of_3 {
	width: 100%;
}
.span_2_of_3 {
	width: 66.1%;
}
.span_1_of_3 {
	width: 32.2%;
}

/*  GO FULL WIDTH AT LESS THAN 400 PIXELS */

@media only screen and (max-width: 400px) {
	.col { 
		margin: 1% 0 1% 0;
	}
}

@media only screen and (max-width: 400px) {
	.span_3_of_3 {
		width: 100%; 
	}
	.span_2_of_3 {
		width: 100%; 
	}
	.span_1_of_3 {
		width: 100%;
}
</style>

<div class="container graph">
    <br/>
    <div class="hero-unit">

<link href='http://fonts.googleapis.com/css?family=Lato:400,900|Abril+Fatface|Vollkorn:400,700' rel='stylesheet' type='text/css'>

<div id="wrapper">

<div id="header">
  
<h1>Portfolio</h1>

<!-- End Header -->
</div>

<div id="content">
  
<div class="section group">

<div class="col span_1_of_3">
  
  <h2>Project Title</h2>
  <a href><img src="http://www.jschachterle.com/images/thumbnails/ifc.jpg" width="100%" /></a>
  <h3>Project Description</h3>
  
    <h2>Project Title</h2>
  <a href><img src="http://www.jschachterle.com/images/thumbnails/achievemint.jpg" width="100%" /></a>
  <h3>Project Description</h3>
  
    <h2>Project Title</h2>
  <a href><img src="http://www.jschachterle.com/images/thumbnails/biolite_holiday_poster.jpg" width="100%" /></a>
  <h3>Project Description</h3>
  
    <h2>Project Title</h2>
  <a href><img src="http://www.jschachterle.com/images/thumbnails/biolite_web_experience.jpg" width="100%" /></a>
  <h3>Project Description</h3>
  
</div>

<div class="col span_1_of_3">

    <h2>Project Title</h2>
  <a href><img src="http://www.jschachterle.com/images/thumbnails/techcrunch.jpg" width="100%" /></a>
  <h3>Project Description</h3>
  
    <h2>Project Title</h2>
  <a href><img src="http://www.jschachterle.com/images/thumbnails/bedo.jpg" width="100%" /></a>
  <h3>Project Description</h3>
  
    <h2>Project Title</h2>
  <a href><img src="http://www.jschachterle.com/images/thumbnails/90_percent.jpg" width="100%" /></a>
  <h3>Project Description</h3>
  
    <h2>Project Title</h2>
  <a href><img src="http://www.jschachterle.com/images/thumbnails/traditional_medicinals.jpg" width="100%" /></a>
  <h3>Project Description</h3>
  
</div>
  
<div class="col span_1_of_3">

    <h2>Project Title</h2>
  <a href><img src="http://www.jschachterle.com/images/thumbnails/legally_sauced.jpg" width="100%" /></a>
  <h3>Project Description</h3>
  
    <h2>Project Title</h2>
  <a href><img src="http://www.jschachterle.com/images/thumbnails/better_world_books.jpg" width="100%" /></a>
  <h3>Project Description</h3>
  
    <h2>Project Title</h2>
  <a href><img src="http://www.jschachterle.com/images/thumbnails/oruga.jpg" width="100%" /></a>
  <h3>Project Description</h3>
  
    <h2>Project Title</h2>
  <a href><img src="http://www.jschachterle.com/images/thumbnails/logo_design.jpg" width="100%" /></a>
  <h3>Project Description</h3>
  
</div>
  
</div>


<!-- End Content -->
</div>

<div id="footer">

<!-- End Footer -->
</div>
  
<!-- End Wrapper -->
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