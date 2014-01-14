<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js' , CClientScript::POS_END); //for javascript external files onloading
?>
<!-- BLOCK CSS -->
<style>
*, *:before, *:after {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  list-style: none;
}

nav, aside, header, footer, aside, section, main, footer, aside, section, article {
  display: block;
}

body {
  background: #fcfcfc;
}

body > div {
  margin: 0 auto;
  max-width: 800px;
}

nav {
  background: #999;
  position: fixed;
  width: 140px;
  -webkit-box-shadow: -4px 4px 8px 0px rgba(0, 0, 0, 0.2);
  box-shadow: -4px 4px 8px 0px rgba(0, 0, 0, 0.2);
  padding: 1px;
  padding-top: 0;
  top: 20px;
}

header, footer, aside, section {
  float: left;
  clear: left;
  width: calc(100% - 180px);
  padding: 20px;
  margin-left: 140px;
  max-width: 640px;
  background: white;
  -webkit-box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.3);
}

footer, aside {
  background: #f1f1f1;
  border-top: 1px solid #ccc;
  border-bottom: 1px solid #ccc;
  padding: 40px;
}

aside {
  padding: 20px 0;
  background-color: #fafafa;
  background-image: repeating-linear-gradient(-45deg, transparent, transparent 35px, white 35px, white 50px);
}

section {
  background: white;
}

article {
  float: left;
  width: 100%;
  padding: 20px;
  margin-bottom: 20px;
  min-height: 300px;
}
article:after {
  content: '';
  display: block;
  position: relative;
  height: 4px;
  width: 100%;
  background-color: #fafafa;
  background-image: repeating-linear-gradient(-45deg, transparent, transparent 35px, white 35px, white 40px);
}

h1 {
  font: 300 2.9em/120% 'Raleway', sans-serif;
  margin-bottom: 10px;
  color: purple;
}

h1 + p {
  font: 500 14px/22px 'Raleway', sans-serif;
  margin-bottom: 0;
  margin-left: 20px;
  color: purple;
}
h1 + p:before {
  content: '- ';
  position: absolute;
  margin-left: -10px;
}

h2 {
  font: 300 36px/30px 'Raleway', sans-serif;
  margin-bottom: 20px;
  color: purple;
}

h3 {
  font: 400 24px/30px 'Raleway', sans-serif;
  margin-bottom: 20px;
  color: purple;
}

p {
  font: 14px/22px helvetica,arial,sans-serif;
  margin-bottom: 20px;
}

img {
  width: 100%;
  height: auto;
  margin-bottom: 20px;
}

a {
  display: block;
  font: 14px/22px helvetica,arial,sans-serif;
  color: purple;
  text-decoration: none;
  padding: 2px 20px;
}

a[href="#top"] {
  background: #340033;
  color: white;
  padding: 20px;
  text-align: center;
  font-size: 18px;
}

a[href="#bot"] {
  background: #670066;
  color: white;
  padding: 10px 20px;
  text-align: center;
}

nav > ul li a {
  background: #a6a6a6;
  color: white;
}
nav > ul li a.active, nav > ul li a:hover {
  background: purple;
  color: white;
}

nav > ul li ul li a {
  background: #fafafa;
  color: gray;
}
nav > ul li ul li a.active, nav > ul li ul li a:hover {
  background: #ffb3ff;
  color: purple;
}

ul li ul {
  text-indent: 20px;
}

a {
  -webkit-transition: all 0.5s ease-out;
  -moz-transition: all 0.5s ease-out;
  -o-transition: all 0.5s ease-out;
  transition: all 0.5s ease-out;
}

@media (max-width: 200px) {
  .responsive-fonts {
    font-size: 25%;
  }
}
@media (min-width: 208px) {
  .responsive-fonts {
    font-size: 26%;
  }
}
@media (min-width: 216px) {
  .responsive-fonts {
    font-size: 27%;
  }
}
@media (min-width: 224px) {
  .responsive-fonts {
    font-size: 28%;
  }
}
@media (min-width: 232px) {
  .responsive-fonts {
    font-size: 29%;
  }
}
@media (min-width: 240px) {
  .responsive-fonts {
    font-size: 30%;
  }
}
@media (min-width: 248px) {
  .responsive-fonts {
    font-size: 31%;
  }
}
@media (min-width: 256px) {
  .responsive-fonts {
    font-size: 32%;
  }
}
@media (min-width: 264px) {
  .responsive-fonts {
    font-size: 33%;
  }
}
@media (min-width: 272px) {
  .responsive-fonts {
    font-size: 34%;
  }
}
@media (min-width: 280px) {
  .responsive-fonts {
    font-size: 35%;
  }
}
@media (min-width: 288px) {
  .responsive-fonts {
    font-size: 36%;
  }
}
@media (min-width: 296px) {
  .responsive-fonts {
    font-size: 37%;
  }
}
@media (min-width: 304px) {
  .responsive-fonts {
    font-size: 38%;
  }
}
@media (min-width: 312px) {
  .responsive-fonts {
    font-size: 39%;
  }
}
@media (min-width: 320px) {
  .responsive-fonts {
    font-size: 40%;
  }
}
@media (min-width: 328px) {
  .responsive-fonts {
    font-size: 41%;
  }
}
@media (min-width: 336px) {
  .responsive-fonts {
    font-size: 42%;
  }
}
@media (min-width: 344px) {
  .responsive-fonts {
    font-size: 43%;
  }
}
@media (min-width: 352px) {
  .responsive-fonts {
    font-size: 44%;
  }
}
@media (min-width: 360px) {
  .responsive-fonts {
    font-size: 45%;
  }
}
@media (min-width: 368px) {
  .responsive-fonts {
    font-size: 46%;
  }
}
@media (min-width: 376px) {
  .responsive-fonts {
    font-size: 47%;
  }
}
@media (min-width: 384px) {
  .responsive-fonts {
    font-size: 48%;
  }
}
@media (min-width: 392px) {
  .responsive-fonts {
    font-size: 49%;
  }
}
@media (min-width: 400px) {
  .responsive-fonts {
    font-size: 50%;
  }
}
@media (min-width: 408px) {
  .responsive-fonts {
    font-size: 51%;
  }
}
@media (min-width: 416px) {
  .responsive-fonts {
    font-size: 52%;
  }
}
@media (min-width: 424px) {
  .responsive-fonts {
    font-size: 53%;
  }
}
@media (min-width: 432px) {
  .responsive-fonts {
    font-size: 54%;
  }
}
@media (min-width: 440px) {
  .responsive-fonts {
    font-size: 55%;
  }
}
@media (min-width: 448px) {
  .responsive-fonts {
    font-size: 56%;
  }
}
@media (min-width: 456px) {
  .responsive-fonts {
    font-size: 57%;
  }
}
@media (min-width: 464px) {
  .responsive-fonts {
    font-size: 58%;
  }
}
@media (min-width: 472px) {
  .responsive-fonts {
    font-size: 59%;
  }
}
@media (min-width: 480px) {
  .responsive-fonts {
    font-size: 60%;
  }
}
@media (min-width: 488px) {
  .responsive-fonts {
    font-size: 61%;
  }
}
@media (min-width: 496px) {
  .responsive-fonts {
    font-size: 62%;
  }
}
@media (min-width: 504px) {
  .responsive-fonts {
    font-size: 63%;
  }
}
@media (min-width: 512px) {
  .responsive-fonts {
    font-size: 64%;
  }
}
@media (min-width: 520px) {
  .responsive-fonts {
    font-size: 65%;
  }
}
@media (min-width: 528px) {
  .responsive-fonts {
    font-size: 66%;
  }
}
@media (min-width: 536px) {
  .responsive-fonts {
    font-size: 67%;
  }
}
@media (min-width: 544px) {
  .responsive-fonts {
    font-size: 68%;
  }
}
@media (min-width: 552px) {
  .responsive-fonts {
    font-size: 69%;
  }
}
@media (min-width: 560px) {
  .responsive-fonts {
    font-size: 70%;
  }
}
@media (min-width: 568px) {
  .responsive-fonts {
    font-size: 71%;
  }
}
@media (min-width: 576px) {
  .responsive-fonts {
    font-size: 72%;
  }
}
@media (min-width: 584px) {
  .responsive-fonts {
    font-size: 73%;
  }
}
@media (min-width: 592px) {
  .responsive-fonts {
    font-size: 74%;
  }
}
@media (min-width: 600px) {
  .responsive-fonts {
    font-size: 75%;
  }
}
@media (min-width: 608px) {
  .responsive-fonts {
    font-size: 76%;
  }
}
@media (min-width: 616px) {
  .responsive-fonts {
    font-size: 77%;
  }
}
@media (min-width: 624px) {
  .responsive-fonts {
    font-size: 78%;
  }
}
@media (min-width: 632px) {
  .responsive-fonts {
    font-size: 79%;
  }
}
@media (min-width: 640px) {
  .responsive-fonts {
    font-size: 80%;
  }
}
@media (min-width: 648px) {
  .responsive-fonts {
    font-size: 81%;
  }
}
@media (min-width: 656px) {
  .responsive-fonts {
    font-size: 82%;
  }
}
@media (min-width: 664px) {
  .responsive-fonts {
    font-size: 83%;
  }
}
@media (min-width: 672px) {
  .responsive-fonts {
    font-size: 84%;
  }
}
@media (min-width: 680px) {
  .responsive-fonts {
    font-size: 85%;
  }
}
@media (min-width: 688px) {
  .responsive-fonts {
    font-size: 86%;
  }
}
@media (min-width: 696px) {
  .responsive-fonts {
    font-size: 87%;
  }
}
@media (min-width: 704px) {
  .responsive-fonts {
    font-size: 88%;
  }
}
@media (min-width: 712px) {
  .responsive-fonts {
    font-size: 89%;
  }
}
@media (min-width: 720px) {
  .responsive-fonts {
    font-size: 90%;
  }
}
@media (min-width: 728px) {
  .responsive-fonts {
    font-size: 91%;
  }
}
@media (min-width: 736px) {
  .responsive-fonts {
    font-size: 92%;
  }
}
@media (min-width: 744px) {
  .responsive-fonts {
    font-size: 93%;
  }
}
@media (min-width: 752px) {
  .responsive-fonts {
    font-size: 94%;
  }
}
@media (min-width: 760px) {
  .responsive-fonts {
    font-size: 95%;
  }
}
@media (min-width: 768px) {
  .responsive-fonts {
    font-size: 96%;
  }
}
@media (min-width: 776px) {
  .responsive-fonts {
    font-size: 97%;
  }
}
@media (min-width: 784px) {
  .responsive-fonts {
    font-size: 98%;
  }
}
@media (min-width: 792px) {
  .responsive-fonts {
    font-size: 99%;
  }
}


</style>

<!-- BLOCK HTML  -->

<div class="container graph">
    <br/>
    <div class="hero-unit">
	<div>
  <nav role="navigation" id="nav">
	  <ul>
      <li><a href="#top">Header</a></li>
	    <li>
	      <a href="#food" class="active">Food</a>
	      <ul>
	        <li><a href="#A1" class="active">Article A1</a></li>
	        <li><a href="#A2">Aritcle A2</a></li>
	        <li><a href="#A3">Aritcle A3</a></li>
	        <li><a href="#A4">Aritcle A4</a></li>
	      </ul>
	    </li>
	    <li>
	      <a href="#fashion">Fashion</a>
	      <ul>
	        <li><a href="#B1">Aritcle B1</a></li>
	        <li><a href="#B2">Aritcle B2</a></li>
	        <li><a href="#B3">Aritcle B3</a></li>
	        <li><a href="#B4">Aritcle B4</a></li>
	        <li><a href="#B5">Aritcle B5</a></li>
	        <li><a href="#B6">Aritcle B6</a></li>
	        <li><a href="#B7">Aritcle B7</a></li>
	      </ul>
	    </li>
	    <li>
	      <a href="#abstract">Abstract</a>
	      <ul>
	        <li><a href="#C1">Aritcle C1</a></li>
	        <li><a href="#C2">Aritcle C2</a></li>
	        <li><a href="#C3">Aritcle C3</a></li>
	      </ul>
	    </li>
      <li><a href="#bot">Footer</a></li>
	  </ul>
	</nav>  
  
  
  <header id="top" class="responsive-fonts">
	<h1>Navigation highlighting using waypoints</h1>
	<p>marking sections and articles in view (click or scroll to test)<p>
  </header>  
  
  <aside>
	<a href="http://imakewebthings.com/jquery-waypoints">Build using jquery-waypoints</a>
  </aside>

  <main>
	  <section id="food">
		<article id="A1"></article>
		<article id="A2"></article>
		<article id="A3"></article>
		<article id="A4"></article>
	  </section>  
	    
	  <section id="fashion">
	    <article id="B1"></article>
	    <article id="B2"></article>
	    <article id="B3"></article>
	    <article id="B4"></article>
	    <article id="B5"></article>
	    <article id="B6"></article>
	    <article id="B7"></article>
	  </section> 
	    
	  <section id="abstract">
	    <article id="C1"></article>
	    <article id="C2"></article>
	    <article id="C3"></article>
	  </section> 
    
  </main>

  <footer id="bot">
    <p>Footer stuff</p>
  </footer>
</div>


	</div>
</div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){
	function getRelatedContent(el){
  return $($(el).attr('href'));
}
// Get link by section or article id
function getRelatedNavigation(el){
  return $('nav a[href=#'+$(el).attr('id')+']');
}


// ======================================
// Smooth scroll to content
// ======================================
$('nav a').on('click',function(e){
  e.preventDefault();
  $('html,body').animate({scrollTop:getRelatedContent(this).offset().top - 20})
});

// ======================================
// Waypoints
// ======================================
// Default cwaypoint settings
// - just showing
var wpDefaults={
  context: window,
  continuous: true,
  enabled: true,
  horizontal: false,
  offset: 0,
  triggerOnce: false
};

$('section,article')
   .waypoint(function(direction) {
     // Highlight element when related content
     // is 10% percent from the bottom... 
     // remove if below
     getRelatedNavigation(this).toggleClass('active', direction === 'down');
   }, {
     offset: '90%' // 
   })
   .waypoint(function(direction) {
     // Highlight element when bottom of related content
     // is 100px from the top - remove if less
     // TODO - make function for this
     getRelatedNavigation(this).toggleClass('active', direction === 'up');
   }, {
     offset: function() {  return -$(this).height() + 100; }
   });


// ======================================
// Random content and navigation headers
// ======================================
$('section').each(function(){
  var cap=getRelatedNavigation(this).text();
  $(this).prepend('<h2>'+cap+'</h2>')
})
$('article').each(function(){
  var cap=getRelatedNavigation(this).text();
  var w=Math.ceil(Math.random()*200)+400;
  var h=w-200;
  var c=$(this).closest('section').attr('id');
  $(this).html('<h3>'+cap+'</h3><img src="http://lorempixel.com/g/'+w+'/'+h+'/'+c+'">'+lipsum(5));
})

function lipsum(p){
  var words='Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod';
      words+='tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam';
      words+='quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo';
      words+='consequat duis aute irure dolor in reprehenderit in voluptate velit esse';
      words+='cillum dolore eu fugiat nulla pariatur excepteur sint occaecat cupidatat non';
      words+='proident, sunt in culpa qui officia deserunt mollit anim id est laborum';
      words=words.split(' ');
  lorem=''; for(var i=0;i<p;++i){ 
    var w=Math.ceil( Math.random() * words.length -10 ) + 10;
    lorem+='<p>'+words.slice(0,w).join(' ')+'.</p>'; 
  }
  return lorem;
}
  
};
</script>