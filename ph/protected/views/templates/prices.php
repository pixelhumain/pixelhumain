<?php 
//http://codepen.io/oceatoon/pen/evigG
?>

<!-- BLOCK CSS -->
<style>
/* =====[ GOOGLE FONT "LATO" ]============================================================================== */
@import url(http://fonts.googleapis.com/css?family=Lato:400,100,900);

@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

/* =====[ BODY ]============================================================================== */

body {
background:#e7edde;
}

h1 {
font-family:Lato, sans-serif;
font-weight:100;
font-size:50px;
text-transform:uppercase;
text-align:center;
color:#444;
padding:30px;
}

.content_wrap {
width:100%;
margin:0 auto;
padding:0;
}

/* =====[ COLORS ]============================================================================== */

.color-1-bg {
background:#6baba1!important;
}

.color-1-font,.color1-price {
color:#6baba1!important;
}

.color-2-bg {
background:#e0a32e!important;
}

.color-2-font,.color-2-price {
color:#e0a32e!important;
}

.color-3-bg {
background:#e7603b!important;
}

.color-3-font,.color-3-price {
color:#e7603b!important;
}

.color-4-bg {
background:#9ca780!important;
}

.color-4-font,.color-4-price {
color:#9ca780!important;
}

.front,.back {
font-family:Lato, sans-serif;
float:left;
width:220px;
height:220px;
background:#FFF;
-webkit-border-radius:100%;
-moz-border-radius:100%;
border-radius:100%;
-webkit-box-shadow:0 0 10px 0 #dbdbdb;
box-shadow:0 0 10px 0 #dbdbdb;
-webkit-transition:all .3s ease-in-out;
-moz-transition:all .3s ease-in-out;
-o-transition:all .3s ease-in-out;
-ms-transition:all .3s ease-in-out;
transition:all .3s ease-in-out;
}



/* =====[ MAIN LIST ]============================================================================== */

.box {
list-style:none;
display:block;
text-align:center;
width:100%;
margin:20px 0 0;
padding:0;
}

.box i {
padding-right:5px;
}

.box > li {
width:220px;
height:220px;
display:inline-block;
margin:8px;
}

/* =====[ FRONT ELEMENTS ]============================================================================== */

.front > div {
text-align:center;
color:#60bad7;
}

.title {
font-size:25px;
text-transform:uppercase;
text-align:center;
padding:25px 10px 17px;
}

.price span {
font-weight:900;
vertical-align:top;
margin-top:-15px;
display:inline-block;
}

.price .total {
font-size:90px;
}

.currency,.end {
font-size:40px;
}

.description {
text-align:center;
}

.front .description {
color:#9b9b9b!important;
font-size:14px;
padding:4px 45px 0;
}

/* =====[ BACK ELEMENTS ]============================================================================== */

.back .title {
color:#FFF;
}

.back .description ul {
width:55%;
margin:auto;
}

.back .description ul li {
color:#FFF!important;
text-align:left;
list-style:none;
line-height:1.4;
}

.popular {
font-size:30px;
color:#60bad7;
position:absolute;
left:0;
top:0;
opacity:0;
}

/* =====[ CIRCLE ANIMATIONS ]============================================================================== */

.circle {
border-radius:150px;
-moz-border-radius: 150px;
-webkit-border-radius: 150px;
position:relative;
-webkit-transition:all .4s ease-in-out;
-moz-transition:all .4s ease-in-out;
-o-transition:all .4s ease-in-out;
-ms-transition:all .4s ease-in-out;
transition:all .4s ease-in-out;
position: absolute;
}

.info {
position:absolute;
border-radius:150px;
-moz-border-radius: 150px;
-webkit-border-radius: 150px;
opacity:0;
-moz-transform:scale(0) rotate(0deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
-webkit-transform:scale(0) rotate(0deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
-o-transform:scale(0) rotate(0deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
-ms-transform:scale(0) rotate(0deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
transform:scale(0) rotate(0deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
-webkit-backface-visibility:hidden;
}

.circle:hover .front {
-moz-transform:scale(1.1);
-webkit-transform:scale(1.1);
-o-transform:scale(1.1);
-ms-transform:scale(1.1);
transform:scale(1.1);
opacity:1;
}

.circle:hover .info {
-moz-transform:scale(1) rotate(360deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
-webkit-transform:scale(1) rotate(360deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
-o-transform:scale(1) rotate(360deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
-ms-transform:scale(1) rotate(360deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
transform:scale(1) rotate(360deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
opacity:1;
}

.circle:hover .front-popular {
border-radius:10% 50% 50% 50%!important;
}

.circle:hover .popular {
opacity:1;
animation:popularAnim 1s 1;
-webkit-animation:popularAnim 1s 1;
}

@keyframes popularAnim
{
from {opacity:0; left:40px;}
to {opacity:1; left:0;}
}

@-webkit-keyframes popularAnim /* Safari and Chrome */
{
from {opacity:0; left:40px;}
to {opacity:1; left:0;}
}

@-moz-keyframes popularAnim {
from {opacity:0; left:40px;}
to {opacity:1; left:0;}
}
		
@-ms-keyframes popularAnim {
from {opacity:0; left:40px;}
to {opacity:1; left:0;}
}

.box > li{
*float:left;
}

.circle .back{
*display:none;
}

.circle .back{
z-index:0;
}
.circle .front{
position:relative;
z-index:1;
}
.circle:hover .back{
z-index:1;
}
.circle:hover .front{
position:relative;
z-index:0;
}

.circle:hover .back{
*display:inline;
}
.circle:hover .front{
*display:none;
}
</style>

<!-- BLOCK HTML  -->

<div class="container graph">
    <br/>
    <div class="hero-unit">

<section class="content_wrap">
  <h1>Round Pricing Tables</h1>
  <!-- BEGIN LIST -->
  <ul class="box">
  <!-- BEGIN LIST ELEMENT -->
	<li>
      <div class="circle">
        <div class="front">
          <div class="title color-1-font">Basic</div>
          <div class="price color-1-font"><span class="currency">$</span><span class="total">9</span><span class="end">99</span></div>
          <div class="description">Great for small bussiness</div>
        </div><!-- end div .front -->
        <div class="back color-1-bg info">
          <div class="title">Basic</div>
          <div class="description">
            <ul>
              <li><i class="icon-ok-sign"></i>free setup</li>
              <li><i class="icon-remove-sign"></i>no support</li>
              <li><i class="icon-chevron-sign-right"></i>basic options</li>
              <li><i class="icon-exclamation-sign"></i>25 emails</li>
            </ul>
          </div><!-- end div .description -->
        </div><!-- end div .back color-1-bg info -->
      </div><!-- end div .circle -->
    </li>
  <!-- END LIST ELEMENT -->
  <!-- BEGIN LIST ELEMENT -->
    <li>
      <div class="circle">
        <div class="front">
          <div class="title color-2-font">Starter</div>
          <div class="price color-2-font"><span class="currency">$</span><span class="total">15</span><span class="end">99</span></div>
          <div class="description">Great for small bussiness</div>
        </div><!-- end div .front -->
        <div class="back color-2-bg info">
          <div class="title">Starter</div>
          <div class="description">
            <ul>
              <li><i class="icon-ok-sign"></i>free setup</li>
              <li><i class="icon-remove-sign"></i>no support</li>
              <li><i class="icon-chevron-sign-right"></i>basic options</li>
              <li><i class="icon-exclamation-sign"></i>25 emails</li>
            </ul>
          </div><!-- end div .description -->
        </div><!-- end div .back color-1-bg info -->
      </div><!-- end div .circle -->
    </li>
  <!-- END LIST ELEMENT -->
  <!-- BEGIN LIST ELEMENT -->
    <li>
      <div class="circle">
        <div class="front front-popular">
          <div class="title color-3-font">Premier</div>
          <div class="price color-3-font"><span class="currency">$</span><span class="total">25</span><span class="end">99</span></div>
          <div class="description">Great for small bussiness</div>
        </div><!-- end div .front front-popular -->
        <div class="popular color-3-font icon-star"></div>
        <div class="back color-3-bg info">
          <div class="title">Premier</div>
          <div class="description">
            <ul>
              <li><i class="icon-ok-sign"></i>free setup</li>
              <li><i class="icon-remove-sign"></i>no support</li>
              <li><i class="icon-chevron-sign-right"></i>basic options</li>
              <li><i class="icon-exclamation-sign"></i>25 emails</li>
            </ul>
          </div><!-- end div .description -->
        </div><!-- end div .back color-3-bg info -->
      </div><!-- end div .circle -->
    </li>
  <!-- END LIST ELEMENT -->
  <!-- BEGIN LIST ELEMENT -->
    <li>
      <div class="circle">
        <div class="front">
          <div class="title color-4-font">Deluxe</div>
          <div class="price color-4-font"><span class="currency">$</span><span class="total">39</span><span class="end">99</span></div>
          <div class="description">Great for small bussiness</div>
        </div><!-- end div .front -->
        <div class="back color-4-bg info">
          <div class="title">Deluxe</div>
          <div class="description">
            <ul>
              <li><i class="icon-ok-sign"></i>free setup</li>
              <li><i class="icon-remove-sign"></i>no support</li>
              <li><i class="icon-chevron-sign-right"></i>basic options</li>
              <li><i class="icon-exclamation-sign"></i>25 emails</li>
            </ul>
          </div><!-- end div .description -->
        </div><!-- end div .back color-4-bg info -->
      </div><!-- end div .circle -->
    </li>
  <!-- END LIST ELEMENT -->
  </ul>
<!--END LIST -->
</section>

	</div>
</div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){

  
};
</script>