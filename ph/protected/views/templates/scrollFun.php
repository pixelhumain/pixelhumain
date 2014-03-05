<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css'); //for CSS external files onloading
$cs->registerScriptFile('http://' , CClientScript::POS_END); //for javascript external files onloading
?>

<!-- BLOCK CSS -->
<style>
@import url(http://fonts.googleapis.com/css?family=Roboto:400,300);
@import url(http://fonts.googleapis.com/css?family=Dosis:300,400,500,600);
body {
  font-family: 'Roboto', sans-serif;
  font-weight: 300;
  line-height: 1.6;
  color: #a7a7a7;
  font-size: 14px;
  position: relative;
}

a {
  color: #e9a892;
  text-decoration: none;
}

p {
  margin-bottom: 10px;
}

#hero {
  background-color: #87d3b7;
  display: table;
  position: relative;
  width: 100%;
  height: 100vh;
}
#hero h1 {
  color: #fff;
  font-size: 90px;
  line-height: 1;
  display: table-cell;
  vertical-align: middle;
  text-align: center;
  font-weight: 500;
}
#hero h1 span {
  font-size: 40px;
  opacity: .8;
}

.arow_down {
  display: block;
  position: absolute;
  bottom: 50px;
  left: 0;
  right: 0;
  height: 45px;
  width: 45px;
  margin: 0 auto;
  border-radius: 45px;
  -webkit-animation-duration: 1s;
  -moz-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  -moz-animation-fill-mode: both;
  animation-fill-mode: both;
  -webkit-animation-name: bounce;
  -moz-animation-name: bounce;
  animation-name: bounce;
}
.arow_down svg path {
  fill: #fff;
}

.nav {
  position: relative;
}
.nav a {
  position: absolute;
  display: inline-block;
  float: left;
  margin-bottom: 3px;
  left: -100px;
  font-weight: bold;
  margin-top: 20px;
}
.nav a:hover {
  opacity: .6;
}

.content {
  max-width: 940px;
  width: 100%;
  margin: 0 auto;
  padding: 60px 0 140px;
}

h1 {
  font-family: 'Dosis', sans-serif;
  color: #87d3b7;
  font-size: 40px;
  letter-spacing: 2px;
  line-height: 3;
  text-transform: uppercase;
  text-align: center;
  font-weight: 400;
}

.arow_top {
  width: 50px;
  height: 50px;
  position: absolute;
  display: block;
  bottom: 50px;
  right: 50px;
  padding: 0;
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  transform: rotate(180deg);
}
.arow_top svg path {
  fill: #87d3b7;
}

/*
CSS ANIMATE BY Daniel Eden
Animate.css - http://daneden.me/animate
Licensed under the MIT license
Copyright (c) 2013 Daniel Eden
*/
@-webkit-keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -webkit-transform: translateY(0);
  }

  40% {
    -webkit-transform: translateY(-30px);
  }

  60% {
    -webkit-transform: translateY(-15px);
  }
}

@-moz-keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -moz-transform: translateY(0);
  }

  40% {
    -moz-transform: translateY(-30px);
  }

  60% {
    -moz-transform: translateY(-15px);
  }
}

@-ms-keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -ms-transform: translateY(0);
  }

  40% {
    -ms-transform: translateY(-30px);
  }

  60% {
    -ms-transform: translateY(-15px);
  }
}

@-o-keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    -o-transform: translateY(0);
  }

  40% {
    -o-transform: translateY(-30px);
  }

  60% {
    -o-transform: translateY(-15px);
  }
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }

  40% {
    transform: translateY(-30px);
  }

  60% {
    transform: translateY(-15px);
  }
}

</style>

<!-- BLOCK HTML  -->

<div class="container graph">
    <br/>
    <div class="hero-unit">

<div id="hero">

	<h1>Mighty Scroll<br><span>with burek from Bosnia</span></h1>

	<a class="arow_down scroll" href="#item01">
		<svg version="1.2" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 400 200" xml:space="preserve">
				<g>
					<path d="M106.308,29.384c6.332,0,11.664,2.444,15.984,7.344c9.214,11.232,18.286,22.174,27.216,32.832l43.2,51.84
						c5.184-6.629,11.806-14.62,19.873-23.976c8.059-9.362,15.834-18.65,23.328-27.864c8.922-10.658,17.994-21.6,27.215-32.832
						c4.32-4.9,9.646-7.344,15.984-7.344c4.895,0,9.355,1.58,13.393,4.752c4.32,3.74,6.764,8.424,7.344,14.04
						c0.574,5.616-1.014,10.726-4.752,15.336l-86.4,103.68c-4.037,4.894-9.362,7.344-15.984,7.344c-6.628,0-11.954-2.45-15.984-7.344
						l-86.4-103.68c-3.747-4.61-5.333-9.72-4.752-15.336c0.574-5.616,3.024-10.3,7.344-14.04
						C96.945,30.964,101.407,29.384,106.308,29.384z"></path>
				</g>
			</svg>
	</a>
</div> <!-- / hero -->



<div class="content">
	
	<h1 id="item01">Mujo kuje konja po mjesecu</h1>
	<div class="nav">
		<a class="arow_prev scroll" href="#hero">prev</a>
		<br>
		<a class="arow_next scroll" href="#item02">next</a>
	</div>

	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi, doloribus, nemo excepturi possimus hic similique sunt! Eos, quidem, amet, ab non enim corrupti vitae adipisci vel quis facilis libero porro veritatis a minus necessitatibus cupiditate et ipsam debitis magni explicabo perspiciatis corporis velit est ullam possimus obcaecati eligendi ipsa eaque numquam deserunt esse modi sint pariatur quibusdam illo soluta ex! Eaque numquam atque commodi iusto magni magnam tempore minus iure! Possimus, illum asperiores doloremque fugit fugiat similique esse quo porro praesentium adipisci voluptatibus culpa unde ipsa quas animi blanditiis voluptate vel dolore delectus veritatis enim corporis architecto ut sint exercitationem deleniti sed eius aut recusandae repudiandae?</p>

	<p>Blanditiis, voluptatibus, nesciunt, libero reiciendis molestiae architecto maiores illum beatae culpa doloribus consectetur aliquid atque incidunt magni sed pariatur nobis quidem aut! Quis, porro, aperiam, fuga, ipsa deserunt pariatur esse illum quia vel tenetur ducimus enim rem quibusdam nesciunt velit assumenda dicta quisquam soluta molestias error voluptatem totam omnis doloremque fugit at est mollitia dolores quae architecto repudiandae laudantium voluptates earum numquam. Asperiores, labore veritatis quis officiis unde enim a quae rem dolor laboriosam quos dolorum magni tenetur? Velit, animi, architecto. Libero, cum molestias voluptas sunt doloribus at ratione magnam repudiandae quidem eligendi maiores optio eaque fuga atque non cupiditate harum. Expedita.</p>

	<h1 id="item02">deserunt pariatur</h1>
	<div class="nav">
		<a class="arow_prev scroll" href="#item01">prev</a>
		<br>
		<a class="arow_next scroll" href="#item03">next</a>
	</div>

	<p>Blanditiis, voluptatibus, nesciunt, libero reiciendis molestiae architecto maiores illum beatae culpa doloribus consectetur aliquid atque incidunt magni sed pariatur nobis quidem aut! Quis, porro, aperiam, fuga, ipsa deserunt pariatur esse illum quia vel tenetur ducimus enim rem quibusdam nesciunt velit assumenda dicta quisquam soluta molestias error voluptatem totam omnis doloremque fugit at est mollitia dolores quae architecto repudiandae laudantium voluptates earum numquam. Asperiores, labore veritatis quis officiis unde enim a quae rem dolor laboriosam quos dolorum magni tenetur? Velit, animi, architecto. Libero, cum molestias voluptas sunt doloribus at ratione magnam repudiandae quidem eligendi maiores optio eaque fuga atque non cupiditate harum. Expedita.</p>

	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi, doloribus, nemo excepturi possimus hic similique sunt! Eos, quidem, amet, ab non enim corrupti vitae adipisci vel quis facilis libero porro veritatis a minus necessitatibus cupiditate et ipsam debitis magni explicabo perspiciatis corporis velit est ullam possimus obcaecati eligendi ipsa eaque numquam deserunt esse modi sint pariatur quibusdam illo soluta ex! Eaque numquam atque commodi iusto magni magnam tempore minus iure! Possimus, illum asperiores doloremque speriores, labore veritatis quis officiis unde enim a quae rem dolor laboriosam quos dolorum magni tenetur? Velit, animi, architecto. Libero, cum molestias voluptas sunt doloribus at ratione magnam repudiandae quidem eligendi maiores optio eaque fuga atque non cupiditate harum. Expedita.</p>

	<h1 id="item03">voluptatibus culpa</h1>
	<div class="nav">
		<a class="arow_prev scroll" href="#item02">prev</a>
	</div>
	<p>Consectetur adipisicing elit. Sequi, doloribus, nemo excepturi possimus hic similique sunt! Eos, quidem, amet, ab non enim corrupti vitae adipisci vel quis facilis libero porro veritatis a minus necessitatibus cupiditate et ipsam debitis magni explicabo perspiciatis corporis velit est ullam possimus obcaecati eligendi ipsa eaque numquam deserunt esse modi sint pariatur quibusdam illo soluta ex! Eaque numquam atque commodi iusto magni magnam tempore minus iure! Possimus, illum asperiores doloremque speriores, labore veritatis quis officiis unde enim a quae rem dolor laboriosam quos dolorum magni tenetur? Velit, animi, architecto. Libero, cum molestias voluptas sunt doloribus at ratione magnam repudiandae quidem eligendi maiores optio eaque fuga atque non cupiditate harum. Expedita.</p>

	<p>Blanditiis, voluptatibus, nesciunt, libero reiciendis molestiae architecto maiores illum beatae culpa doloribus consectetur aliquid atque incidunt magni sed pariatur nobis quidem aut! Quis, porro, aperiam, fuga, ipsa deserunt pariatur esse illum quia vel tenetur ducimus enim rem quibusdam nesciunt velit assumenda dicta quisquam soluta molestias error voluptatem totam omnis doloremque fugit at est mollitia dolores quae architecto repudiandae laudantium voluptates earum numquam. Asperiores, labore veritatis quis officiis unde enim a quae rem dolor laboriosam quos dolorum magni tenetur? Velit, animi, architecto. Libero, cum molestias voluptas sunt doloribus at ratione magnam repudiandae quidem eligendi maiores optio eaque fuga atque non cupiditate harum. Expedita.</p>

</div> <!-- / content -->


<a class="arow_top scroll" href="#hero">
	<svg version="1.2" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 400 200" xml:space="preserve">
				<g>
					<path d="M106.308,29.384c6.332,0,11.664,2.444,15.984,7.344c9.214,11.232,18.286,22.174,27.216,32.832l43.2,51.84
						c5.184-6.629,11.806-14.62,19.873-23.976c8.059-9.362,15.834-18.65,23.328-27.864c8.922-10.658,17.994-21.6,27.215-32.832
						c4.32-4.9,9.646-7.344,15.984-7.344c4.895,0,9.355,1.58,13.393,4.752c4.32,3.74,6.764,8.424,7.344,14.04
						c0.574,5.616-1.014,10.726-4.752,15.336l-86.4,103.68c-4.037,4.894-9.362,7.344-15.984,7.344c-6.628,0-11.954-2.45-15.984-7.344
						l-86.4-103.68c-3.747-4.61-5.333-9.72-4.752-15.336c0.574-5.616,3.024-10.3,7.344-14.04
						C96.945,30.964,101.407,29.384,106.308,29.384z"></path>
				</g>
			</svg>
</a>


	</div>
</div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){

	// MightyScroll
	jQuery.fn.scrollFun = function() {
		$(this).click(function(e) {
			var h = $(this).attr('href'),
			target;

			if (h.charAt(0) == '#' && h.length > 1 && (target = $(h)).length > 0){
				var pos = Math.max(target.offset().top, 0);
				e.preventDefault();
				$('body,html').animate({
					scrollTop : pos
				}, 'slow', 'swing');
			}
		});
	};
	$('.scroll').scrollFun();
};
</script>