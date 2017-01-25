<?php 
/*$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://' , CClientScript::POS_END);*/
?>
<style>
body{
  margin: 0px;
  padding: 0px;
}

nav{ 
  -webkit-backface-visibility: hidden;
  z-index: 5; 
  position: fixed; 
  top: 10%; 
  left: 0px;
  right: 0px;
  /*margin: auto;*/
  width: 100px;
}

nav li{ 
  height: 20px;
  margin: 20px 0px;
  list-style: none;
}

nav a{ 
  display: block; 
  width: 25px; 
  height: 25px; 
  text-indent: -9999px;
  border-radius: 25px; 
  -moz-border-radius:25px; 
  -webkit-border-radius:25px; 
  background-color: transparent; 
  border: 3px solid #fff; 
  transition: all 0.3s ease; 
}
nav a:hover, nav a.active{ background-color: #fff; }

.red { background-color: #B23751; }
.blue { background-color: #346CA5; }
.green { background-color: #65B237; }
.pink { background-color: #c0392b; }
.black { background-color: #2c3e50; }

section{ height: 980px; }
</style>

<nav>
 <ul>
	<li><a href="#main">one</a></li>
	<li><a href="#secondary">two</a></li>
	<li><a href="#third">one</a></li>
	<li><a href="#fourth">two</a></li>
	<li><a href="#fifth">one</a></li>
	</ul>
</nav>	

<section id="main" class="blue full-height"></section>
	
<section id="secondary" class="red full-height"></section>
	
<section id="third" class="green full-height"></section>
	
<section id="fourth" class="pink full-height"></section>
	
<section id="fifth" class="black full-height"></section>


<script type="text/javascript"		>
initT['animInit'] = function(){
	$('a[href^="#"]').click(function(event) {
		var id = $(this).attr("href");
		var target = $(id).offset().top;
		$('html, body').animate({scrollTop:target}, 500);
		event.preventDefault();
	});

function getTargetTop(elem){
	var id = elem.attr("href");
	var offset = 60;
	return $(id).offset().top - offset;
}


	$(window).scroll(function(e){
		isSelected($(window).scrollTop())
	});

var sections = $('a[href^="#"]');

function isSelected(scrolledTo){
   
	var threshold = 100;
	var i;

	for (i = 0; i < sections.length; i++) {
		var section = $(sections[i]);
		var target = getTargetTop(section);
	   
		if (scrolledTo > target - threshold && scrolledTo < target + threshold) {
			sections.removeClass("active");
			section.addClass("active");
		}

	};
}
  
};
</script>