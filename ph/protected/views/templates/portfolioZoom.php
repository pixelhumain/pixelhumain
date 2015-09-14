<?php 
//http://codepen.io/oceatoon/pen/Cazhs
?>

<!-- BLOCK CSS -->
<style>
@import url(http://fonts.googleapis.com/css?family=Open+Sans);

h1, h2, h3, h4, h5 {
margin-top: 5px;
text-shadow: none;
font-weight: normal !important;
font-family: 'Open Sans', sans-serif;
}
.view p {
font-family: Georgia, serif;
font-style: italic;
font-size: 12px;
position: relative;
color: #fff;
padding: 10px 20px 10px;
text-align: center;
}

.view-tenth p {
color: #333;
-ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=0)";
filter: alpha(opacity=0);
opacity: 0;
-webkit-transform: scale(0);
-moz-transform: scale(0);
-o-transform: scale(0);
-ms-transform: scale(0);
transform: scale(0);
-webkit-transition: all 0.5s linear;
-moz-transition: all 0.5s linear;
-o-transition: all 0.5s linear;
-ms-transition: all 0.5s linear;
transition: all 0.5s linear;
}

.view {
z-index: 9;
cursor: default;
overflow: hidden;
text-align: center;
position: relative;
margin-bottom: 30px;
box-shadow: 0 0 3px #ddd;
}

.view .mask, .view .content {
width: 100%;
height: 100%;
position: absolute;
overflow: hidden;
top: 0;
left: 0;
}

.view img {
display: block;
position: relative;
}

.view-tenth img {
left: 10px;
margin-left: -10px;
position: relative;
-webkit-transition: all 0.6s ease-in-out;
-moz-transition: all 0.6s ease-in-out;
-o-transition: all 0.6s ease-in-out;
-ms-transition: all 0.6s ease-in-out;
transition: all 0.6s ease-in-out;
}

.view-tenth:hover > img {
-webkit-transform: scale(2) rotate(10deg);
-moz-transform: scale(2) rotate(10deg);
-o-transform: scale(2) rotate(10deg);
-ms-transform: scale(2) rotate(10deg);
transform: scale(2) rotate(10deg);
-ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=30)";
filter: alpha(opacity=30);
opacity: 0.3;
}

.view h2 {
text-transform: uppercase;
color: #fff;
text-align: center;
position: relative;
font-size: 22px;
padding: 10px;
background: rgba(0, 0, 0, 0.8);
margin: 20px 0 0 0;
text-shadow: none;
}

.view-tenth h2 {
color: #333;
margin: 20px 40px 0;
background: transparent;
border-bottom: 1px solid rgba(0, 0, 0, 0.3);
-webkit-transform: scale(0);
-moz-transform: scale(0);
-o-transform: scale(0);
-ms-transform: scale(0);
transform: scale(0);
-webkit-transition: all 0.5s linear;
-moz-transition: all 0.5s linear;
-o-transition: all 0.5s linear;
-ms-transition: all 0.5s linear;
transition: all 0.5s linear;
-ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=0)";
filter: alpha(opacity=0);
opacity: 0;
}

.view a.info {
color: #fff;
background: #000;
padding: 5px 12px;
text-decoration: none;
margin-top: 10px;
display: inline-block;
overflow: hidden;
text-transform: uppercase;
}

.view a.info:hover {
background: #72c02c;
}

.view-tenth a.info {
-ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=0)";
filter: alpha(opacity=0);
opacity: 0;
-webkit-transform: scale(0);
-moz-transform: scale(0);
-o-transform: scale(0);
-ms-transform: scale(0);
transform: scale(0);
-webkit-transition: all 0.5s linear;
-moz-transition: all 0.5s linear;
-o-transition: all 0.5s linear;
-ms-transition: all 0.5s linear;
transition: all 0.5s linear;
}

.view-tenth:hover h2,
.view-tenth:hover p,
.view-tenth:hover a.info {
-webkit-transform: scale(1);
-moz-transform: scale(1);
-o-transform: scale(1);
-ms-transform: scale(1);
transform: scale(1);
-ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=100)";
filter: alpha(opacity=100);
opacity: 1;
}
</style>

<!-- BLOCK HTML  -->

<div class="container graph">
    <br/>
    <div class="hero-unit">

<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <div class="view view-tenth">
        <img class="img-responsive" src="http://htmlstream.com/preview/unify/assets/img/main/2.jpg">
        <div class="mask">
          <h2>Portfolio item</h2>
          <p>Lorem ipsum dolor asit amet</p>
          <a href="" class="info">Read more</a>
        </div>
      </div>
    </div>
    <!-- /.col-lg-6 -->
     <div class="col-lg-6">
      <div class="view view-tenth">
        <img class="img-responsive" src="http://htmlstream.com/preview/unify/assets/img/main/1.jpg">
        <div class="mask">
          <h2>Portfolio item</h2>
          <p>Lorem ipsum dolor asit amet</p>
          <a href="" class="info">Read more</a>
        </div>
      </div>
    </div>
    <!-- /.col-lg-6 -->     
  </div>
</div>

	</div>
</div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){

  
};
</script>