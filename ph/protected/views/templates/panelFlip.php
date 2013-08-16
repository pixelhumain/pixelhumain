<style>
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font: inherit;
  font-size: 100%;
  vertical-align: baseline;
}

html {
  line-height: 1;
}

ol, ul {
  list-style: none;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
}

caption, th, td {
  text-align: left;
  font-weight: normal;
  vertical-align: middle;
}

q, blockquote {
  quotes: none;
}
q:before, q:after, blockquote:before, blockquote:after {
  content: "";
  content: none;
}

a img {
  border: none;
}

article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summary {
  display: block;
}

body, html {
  height: 100%;
}

body {
  background: #212121;
  color: #fff;
  font-family: 'Homestead', sans-serif;
}

/**
*
* Responsive list
*
**/
.responsive {
  width: 100%;
  height: 100%;
}

.content {
  float: left;
  width: 100%;
  height: 100%;
}
.content img {
  width: 100%;
  height: 101%;
}
.content li {
  float: left;
  border-bottom: 1px solid #2c2c2c;
  border-left: 1px solid #2c2c2c;
  width: 33.2%;
  height: 33%;
  position: relative;
  /* Colors Hover */
}
.content li:hover {
  cursor: pointer;
}
.content li:hover .card-front {
  -webkit-transform: rotateX(50deg);
  -moz-transform: rotateX(50deg);
  -ms-transform: rotateX(50deg);
  -o-transform: rotateX(50deg);
  transform: rotateX(50deg);
  -webkit-transform: perspective(1000) rotateX(50deg);
  -moz-transform: perspective(1000) rotateX(50deg);
  -ms-transform: perspective(1000) rotateX(50deg);
  -o-transform: perspective(1000) rotateX(50deg);
  transform: perspective(1000) rotateX(50deg);
}
.content li:hover .card-back {
  z-index: 950;
  -webkit-transform: rotateX(0deg);
  -moz-transform: rotateX(0deg);
  -ms-transform: rotateX(0deg);
  -o-transform: rotateX(0deg);
  transform: rotateX(0deg);
  -webkit-transform: perspective(1000) rotateX(0deg);
  -moz-transform: perspective(1000) rotateX(0deg);
  -ms-transform: perspective(1000) rotateX(0deg);
  -o-transform: perspective(1000) rotateX(0deg);
  transform: perspective(1000) rotateX(0deg);
}
.content li:nth-child(1) .card-back, .content li:nth-child(9) .card-back {
  background: #6b6b6b;
}
.content li:nth-child(2) .card-back {
  background: #22cfda;
}
.content li:nth-child(3) .card-back {
  background: #162b53;
}
.content li:nth-child(4) .card-back {
  background: #ee2ca3;
}
.content li:nth-child(5) .card-back {
  background: #d0ce06;
}
.content li:nth-child(6) .card-back {
  background: #7381a8;
}
.content li:nth-child(7) .card-back {
  background: #da222b;
}
.content li:nth-child(8) .card-back {
  background: #f07938;
}
.content li:first-child, .content li:last-child {
  background-color: #151515;
}
.content .card-front,
.content .card-back {
  text-align: right;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  -o-backface-visibility: hidden;
  backface-visibility: hidden;
  -webkit-transition: -webkit-transform 400ms;
  -moz-transition: -moz-transform 400ms;
  -o-transition: -o-transform 400ms;
  transition: transform 400ms;
  display: block;
  height: 100%;
  position: absolute;
  width: 100%;
}
.content .card-front {
  -webkit-transform: perspective(1000) rotateX(0);
  -moz-transform: perspective(1000) rotateX(0);
  -ms-transform: perspective(1000) rotateX(0);
  -o-transform: perspective(1000) rotateX(0);
  transform: perspective(1000) rotateX(0);
  z-index: 900;
}
.content .card-back {
  -webkit-transform: rotateX(-180deg);
  -moz-transform: rotateX(-180deg);
  -ms-transform: rotateX(-180deg);
  -o-transform: rotateX(-180deg);
  transform: rotateX(-180deg);
  z-index: 800;
}
.content h2 {
  font-size: 28px;
  float: right;
  width: 100%;
  margin-bottom: 10px;
  text-transform: uppercase;
  margin-right: 20px;
  margin-top: 20px;
}
.content h2 b {
  float: right;
  width: 55%;
}
.content p {
  line-height: 1.3em;
  color: #3d3d3d;
  width: 90%;
  float: right;
  margin-right: 20px;
}

.close {
  cursor: pointer;
  position: absolute;
  right: 0;
  top: 0;
  background: #fff;
  color: #111;
  text-decoration: none;
  font-size: 20px;
  padding: 10px 20px;
}

.active {
  width: 100% !important;
  height: 100% !important;
}
.active .all-content {
  position: absolute;
  left: 10px;
  top: 20px;
}
.active .all-content h1 {
  font-size: 80px;
  width: 50%;
}

@media (min-width: 440px) and (max-width: 750px) {
  .content h2 {
    font-size: 22px;
  }
  .content p {
    font-size: 13px;
  }
  .content li {
    width: 33.1%;
  }
}
@media (max-width: 439px) {
  .content h2 {
    font-size: 15px;
  }
  .content p {
    font-size: 13px;
  }
  .content li {
    width: 33%;
  }
}
@media (max-height: 450px) {
  .content h2 {
    font-size: 22px;
  }
  .content h2 b {
    width: 100%;
  }
  .content li {
    width: 33%;
  }
}
/**
*
* Animate.css
* From : http://daneden.me/animate/
*
**/
.animated {
  -webkit-animation-fill-mode: both;
  -moz-animation-fill-mode: both;
  -ms-animation-fill-mode: both;
  -o-animation-fill-mode: both;
  animation-fill-mode: both;
  -webkit-animation-duration: 1s;
  -moz-animation-duration: 1s;
  -ms-animation-duration: 1s;
  -o-animation-duration: 1s;
  animation-duration: 1s;
}

.animated.hinge {
  -webkit-animation-duration: 2s;
  -moz-animation-duration: 2s;
  -ms-animation-duration: 2s;
  -o-animation-duration: 2s;
  animation-duration: 2s;
}

@-webkit-keyframes bounceIn {
  0% {
    opacity: 0;
    -webkit-transform: scale(0.3);
  }

  50% {
    opacity: 1;
    -webkit-transform: scale(1.05);
  }

  70% {
    -webkit-transform: scale(0.9);
  }

  100% {
    -webkit-transform: scale(1);
  }
}

@-moz-keyframes bounceIn {
  0% {
    opacity: 0;
    -moz-transform: scale(0.3);
  }

  50% {
    opacity: 1;
    -moz-transform: scale(1.05);
  }

  70% {
    -moz-transform: scale(0.9);
  }

  100% {
    -moz-transform: scale(1);
  }
}

@-o-keyframes bounceIn {
  0% {
    opacity: 0;
    -o-transform: scale(0.3);
  }

  50% {
    opacity: 1;
    -o-transform: scale(1.05);
  }

  70% {
    -o-transform: scale(0.9);
  }

  100% {
    -o-transform: scale(1);
  }
}

@keyframes bounceIn {
  0% {
    opacity: 0;
    transform: scale(0.3);
  }

  50% {
    opacity: 1;
    transform: scale(1.05);
  }

  70% {
    transform: scale(0.9);
  }

  100% {
    transform: scale(1);
  }
}

.bounceIn {
  -webkit-animation-name: bounceIn;
  -moz-animation-name: bounceIn;
  -o-animation-name: bounceIn;
  animation-name: bounceIn;
}

@-webkit-keyframes bounceInUp {
  0% {
    opacity: 0;
    -webkit-transform: translateY(2000px);
  }

  60% {
    opacity: 1;
    -webkit-transform: translateY(-30px);
  }

  80% {
    -webkit-transform: translateY(10px);
  }

  100% {
    -webkit-transform: translateY(0);
  }
}

@-moz-keyframes bounceInUp {
  0% {
    opacity: 0;
    -moz-transform: translateY(2000px);
  }

  60% {
    opacity: 1;
    -moz-transform: translateY(-30px);
  }

  80% {
    -moz-transform: translateY(10px);
  }

  100% {
    -moz-transform: translateY(0);
  }
}

@-o-keyframes bounceInUp {
  0% {
    opacity: 0;
    -o-transform: translateY(2000px);
  }

  60% {
    opacity: 1;
    -o-transform: translateY(-30px);
  }

  80% {
    -o-transform: translateY(10px);
  }

  100% {
    -o-transform: translateY(0);
  }
}

@keyframes bounceInUp {
  0% {
    opacity: 0;
    transform: translateY(2000px);
  }

  60% {
    opacity: 1;
    transform: translateY(-30px);
  }

  80% {
    transform: translateY(10px);
  }

  100% {
    transform: translateY(0);
  }
}

.bounceInUp {
  -webkit-animation-name: bounceInUp;
  -moz-animation-name: bounceInUp;
  -o-animation-name: bounceInUp;
  animation-name: bounceInUp;
}

@-webkit-keyframes bounceInDown {
  0% {
    opacity: 0;
    -webkit-transform: translateY(-2000px);
  }

  60% {
    opacity: 1;
    -webkit-transform: translateY(30px);
  }

  80% {
    -webkit-transform: translateY(-10px);
  }

  100% {
    -webkit-transform: translateY(0);
  }
}

@-moz-keyframes bounceInDown {
  0% {
    opacity: 0;
    -moz-transform: translateY(-2000px);
  }

  60% {
    opacity: 1;
    -moz-transform: translateY(30px);
  }

  80% {
    -moz-transform: translateY(-10px);
  }

  100% {
    -moz-transform: translateY(0);
  }
}

@-o-keyframes bounceInDown {
  0% {
    opacity: 0;
    -o-transform: translateY(-2000px);
  }

  60% {
    opacity: 1;
    -o-transform: translateY(30px);
  }

  80% {
    -o-transform: translateY(-10px);
  }

  100% {
    -o-transform: translateY(0);
  }
}

@keyframes bounceInDown {
  0% {
    opacity: 0;
    transform: translateY(-2000px);
  }

  60% {
    opacity: 1;
    transform: translateY(30px);
  }

  80% {
    transform: translateY(-10px);
  }

  100% {
    transform: translateY(0);
  }
}

.bounceInDown {
  -webkit-animation-name: bounceInDown;
  -moz-animation-name: bounceInDown;
  -o-animation-name: bounceInDown;
  animation-name: bounceInDown;
}

@-webkit-keyframes bounceInLeft {
  0% {
    opacity: 0;
    -webkit-transform: translateX(-2000px);
  }

  60% {
    opacity: 1;
    -webkit-transform: translateX(30px);
  }

  80% {
    -webkit-transform: translateX(-10px);
  }

  100% {
    -webkit-transform: translateX(0);
  }
}

@-moz-keyframes bounceInLeft {
  0% {
    opacity: 0;
    -moz-transform: translateX(-2000px);
  }

  60% {
    opacity: 1;
    -moz-transform: translateX(30px);
  }

  80% {
    -moz-transform: translateX(-10px);
  }

  100% {
    -moz-transform: translateX(0);
  }
}

@-o-keyframes bounceInLeft {
  0% {
    opacity: 0;
    -o-transform: translateX(-2000px);
  }

  60% {
    opacity: 1;
    -o-transform: translateX(30px);
  }

  80% {
    -o-transform: translateX(-10px);
  }

  100% {
    -o-transform: translateX(0);
  }
}

@keyframes bounceInLeft {
  0% {
    opacity: 0;
    transform: translateX(-2000px);
  }

  60% {
    opacity: 1;
    transform: translateX(30px);
  }

  80% {
    transform: translateX(-10px);
  }

  100% {
    transform: translateX(0);
  }
}

.bounceInLeft {
  -webkit-animation-name: bounceInLeft;
  -moz-animation-name: bounceInLeft;
  -o-animation-name: bounceInLeft;
  animation-name: bounceInLeft;
}

@-webkit-keyframes bounceInRight {
  0% {
    opacity: 0;
    -webkit-transform: translateX(2000px);
  }

  60% {
    opacity: 1;
    -webkit-transform: translateX(-30px);
  }

  80% {
    -webkit-transform: translateX(10px);
  }

  100% {
    -webkit-transform: translateX(0);
  }
}

@-moz-keyframes bounceInRight {
  0% {
    opacity: 0;
    -moz-transform: translateX(2000px);
  }

  60% {
    opacity: 1;
    -moz-transform: translateX(-30px);
  }

  80% {
    -moz-transform: translateX(10px);
  }

  100% {
    -moz-transform: translateX(0);
  }
}

@-o-keyframes bounceInRight {
  0% {
    opacity: 0;
    -o-transform: translateX(2000px);
  }

  60% {
    opacity: 1;
    -o-transform: translateX(-30px);
  }

  80% {
    -o-transform: translateX(10px);
  }

  100% {
    -o-transform: translateX(0);
  }
}

@keyframes bounceInRight {
  0% {
    opacity: 0;
    transform: translateX(2000px);
  }

  60% {
    opacity: 1;
    transform: translateX(-30px);
  }

  80% {
    transform: translateX(10px);
  }

  100% {
    transform: translateX(0);
  }
}

.bounceInRight {
  -webkit-animation-name: bounceInRight;
  -moz-animation-name: bounceInRight;
  -o-animation-name: bounceInRight;
  animation-name: bounceInRight;
}

@-webkit-keyframes rotateIn {
  0% {
    -webkit-transform-origin: center center;
    -webkit-transform: rotate(-200deg);
    opacity: 0;
  }

  100% {
    -webkit-transform-origin: center center;
    -webkit-transform: rotate(0);
    opacity: 1;
  }
}

@-moz-keyframes rotateIn {
  0% {
    -moz-transform-origin: center center;
    -moz-transform: rotate(-200deg);
    opacity: 0;
  }

  100% {
    -moz-transform-origin: center center;
    -moz-transform: rotate(0);
    opacity: 1;
  }
}

@-o-keyframes rotateIn {
  0% {
    -o-transform-origin: center center;
    -o-transform: rotate(-200deg);
    opacity: 0;
  }

  100% {
    -o-transform-origin: center center;
    -o-transform: rotate(0);
    opacity: 1;
  }
}

@keyframes rotateIn {
  0% {
    transform-origin: center center;
    transform: rotate(-200deg);
    opacity: 0;
  }

  100% {
    transform-origin: center center;
    transform: rotate(0);
    opacity: 1;
  }
}

.rotateIn {
  -webkit-animation-name: rotateIn;
  -moz-animation-name: rotateIn;
  -o-animation-name: rotateIn;
  animation-name: rotateIn;
}

@-webkit-keyframes rotateInUpLeft {
  0% {
    -webkit-transform-origin: left bottom;
    -webkit-transform: rotate(90deg);
    opacity: 0;
  }

  100% {
    -webkit-transform-origin: left bottom;
    -webkit-transform: rotate(0);
    opacity: 1;
  }
}

@-moz-keyframes rotateInUpLeft {
  0% {
    -moz-transform-origin: left bottom;
    -moz-transform: rotate(90deg);
    opacity: 0;
  }

  100% {
    -moz-transform-origin: left bottom;
    -moz-transform: rotate(0);
    opacity: 1;
  }
}

@-o-keyframes rotateInUpLeft {
  0% {
    -o-transform-origin: left bottom;
    -o-transform: rotate(90deg);
    opacity: 0;
  }

  100% {
    -o-transform-origin: left bottom;
    -o-transform: rotate(0);
    opacity: 1;
  }
}

@keyframes rotateInUpLeft {
  0% {
    transform-origin: left bottom;
    transform: rotate(90deg);
    opacity: 0;
  }

  100% {
    transform-origin: left bottom;
    transform: rotate(0);
    opacity: 1;
  }
}

.rotateInUpLeft {
  -webkit-animation-name: rotateInUpLeft;
  -moz-animation-name: rotateInUpLeft;
  -o-animation-name: rotateInUpLeft;
  animation-name: rotateInUpLeft;
}

@-webkit-keyframes rotateInDownLeft {
  0% {
    -webkit-transform-origin: left bottom;
    -webkit-transform: rotate(-90deg);
    opacity: 0;
  }

  100% {
    -webkit-transform-origin: left bottom;
    -webkit-transform: rotate(0);
    opacity: 1;
  }
}

@-moz-keyframes rotateInDownLeft {
  0% {
    -moz-transform-origin: left bottom;
    -moz-transform: rotate(-90deg);
    opacity: 0;
  }

  100% {
    -moz-transform-origin: left bottom;
    -moz-transform: rotate(0);
    opacity: 1;
  }
}

@-o-keyframes rotateInDownLeft {
  0% {
    -o-transform-origin: left bottom;
    -o-transform: rotate(-90deg);
    opacity: 0;
  }

  100% {
    -o-transform-origin: left bottom;
    -o-transform: rotate(0);
    opacity: 1;
  }
}

@keyframes rotateInDownLeft {
  0% {
    transform-origin: left bottom;
    transform: rotate(-90deg);
    opacity: 0;
  }

  100% {
    transform-origin: left bottom;
    transform: rotate(0);
    opacity: 1;
  }
}

.rotateInDownLeft {
  -webkit-animation-name: rotateInDownLeft;
  -moz-animation-name: rotateInDownLeft;
  -o-animation-name: rotateInDownLeft;
  animation-name: rotateInDownLeft;
}

@-webkit-keyframes rotateInUpRight {
  0% {
    -webkit-transform-origin: right bottom;
    -webkit-transform: rotate(-90deg);
    opacity: 0;
  }

  100% {
    -webkit-transform-origin: right bottom;
    -webkit-transform: rotate(0);
    opacity: 1;
  }
}

@-moz-keyframes rotateInUpRight {
  0% {
    -moz-transform-origin: right bottom;
    -moz-transform: rotate(-90deg);
    opacity: 0;
  }

  100% {
    -moz-transform-origin: right bottom;
    -moz-transform: rotate(0);
    opacity: 1;
  }
}

@-o-keyframes rotateInUpRight {
  0% {
    -o-transform-origin: right bottom;
    -o-transform: rotate(-90deg);
    opacity: 0;
  }

  100% {
    -o-transform-origin: right bottom;
    -o-transform: rotate(0);
    opacity: 1;
  }
}

@keyframes rotateInUpRight {
  0% {
    transform-origin: right bottom;
    transform: rotate(-90deg);
    opacity: 0;
  }

  100% {
    transform-origin: right bottom;
    transform: rotate(0);
    opacity: 1;
  }
}

.rotateInUpRight {
  -webkit-animation-name: rotateInUpRight;
  -moz-animation-name: rotateInUpRight;
  -o-animation-name: rotateInUpRight;
  animation-name: rotateInUpRight;
}

@-webkit-keyframes rotateInDownRight {
  0% {
    -webkit-transform-origin: right bottom;
    -webkit-transform: rotate(90deg);
    opacity: 0;
  }

  100% {
    -webkit-transform-origin: right bottom;
    -webkit-transform: rotate(0);
    opacity: 1;
  }
}

@-moz-keyframes rotateInDownRight {
  0% {
    -moz-transform-origin: right bottom;
    -moz-transform: rotate(90deg);
    opacity: 0;
  }

  100% {
    -moz-transform-origin: right bottom;
    -moz-transform: rotate(0);
    opacity: 1;
  }
}

@-o-keyframes rotateInDownRight {
  0% {
    -o-transform-origin: right bottom;
    -o-transform: rotate(90deg);
    opacity: 0;
  }

  100% {
    -o-transform-origin: right bottom;
    -o-transform: rotate(0);
    opacity: 1;
  }
}

@keyframes rotateInDownRight {
  0% {
    transform-origin: right bottom;
    transform: rotate(90deg);
    opacity: 0;
  }

  100% {
    transform-origin: right bottom;
    transform: rotate(0);
    opacity: 1;
  }
}

.rotateInDownRight {
  -webkit-animation-name: rotateInDownRight;
  -moz-animation-name: rotateInDownRight;
  -o-animation-name: rotateInDownRight;
  animation-name: rotateInDownRight;
}

/* End animate.css*/

</style>

<br/><br/><br/><br/>

<div class="responsive">
<ul class="content">

	<!-- 1 -->
	<li>
		<div class="card-front">
			<h2><b>What is Lorem ipsum?</b></h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis condimentum.</p>
		</div>
		<div class="card-back">
      <h2><b>Click here</b></h2>
		</div>

		<!-- Content -->
		<div class="all-content">
			<h1>What is Lorem ipsum?</h1>
		</div>
	</li>

	<li>
		<div class="card-front">
			<h2><b>Contrary to popular belief</b></h2>
			<p>Aenean imperdiet odio id dictum elementum. Donec vitae.</p>
		</div>
		<div class="card-back">
			<h2><b>Click here</b></h2>
		</div>

		<!-- Content -->
		<div class="all-content">
			<h1>Contrary to popular belief</h1>
		</div>
	</li>

	<li>
		<div class="card-front">
			<h2><b>In vulputate sem a arcu semper</b></h2>
			<p>Donec ac ipsum quis arcu sagittis placerat. Etiam augue felis.</p>
		</div>
		<div class="card-back">
			<h2><b>Click here</b></h2>
		</div>

		<!-- Content -->
		<div class="all-content">
			<h1>In vulputate sem a arcu semper</h1>
		</div>
	</li>


	<!-- 2 -->
	<li>
		<div class="card-front">
			<h2><b>Etiam quis sapien interdum</b></h2>
			<p>Praesent sodales et tellus eu euismod. Suspendisse lobortis.</p>
		</div>
		<div class="card-back">
			<h2><b>Click here</b></h2>
		</div>

		<!-- Content -->
		<div class="all-content">
			<h1>Etiam quis sapien interdum</h1>
		</div>
	</li>

	<li>
		<div class="card-front">
			<h2><b>Vivamus metus massa</b></h2>
			<p> Phasellus vel nulla bibendum dolor pellentesque lacinia</p>
		</div>
		<div class="card-back">
			<h2><b>Click here</b></h2>
		</div>

		<!-- Content -->
		<div class="all-content">
			<h1>Vivamus metus massa</h1>
		</div>
	</li>
	<li>
		<div class="card-front">
			<h2><b>Integer consequat vitae turpis</b></h2>
			<p>  Nam id pretium arcu, at vestibulum mauris. Curabitur.</p>
		</div>
		<div class="card-back">
			<h2><b>Click here</b></h2>
		</div>

		<!-- Content -->
		<div class="all-content">
			<h1>Integer consequat vitae</h1>
		</div>
	</li>


	<!-- 3 -->
	<li>
		<div class="card-front">
			<h2><b>Duis tellus dui vehicula</b></h2>
			<p>Morbi ac scelerisque magna, at tincidunt est vivamus</p>
		</div>
		<div class="card-back">
			<h2><b>Click here</b></h2>
		</div>
		
		<!-- Content -->
		<div class="all-content">
			<h1>Duis tellus dui vehicula</h1>
		</div>
	</li>

	<li>
		<div class="card-front">
			<h2><b>Ligula nulla tempus sem</b></h2>
			<p>In iaculis purus sit amet auctor mollis, lorem ipsum dolor sit</p>
		</div>
		<div class="card-back">
			<h2><b>Click here</b></h2>
		</div>

		<!-- Content -->
		<div class="all-content">
			<h1>Ligula nulla tempus sem</h1>
		</div>
	</li>

	<li>
		<div class="card-front">
			<h2><b>Class aptent taciti sociosqu</b></h2>
			<p>Cultrices posuere cubilia Curae; Quisque consectetur tortor</p>
		</div>
		<div class="card-back">
			<h2><b>Click here</b></h2>
		</div>

		<!-- Content -->
		<div class="all-content">
			<h1>Class aptent taciti sociosqu</h1>
		</div>
	</li>

</ul>
</div>

<script type="text/javascript">
initT['initScript'] = function(){
    var bgColor;
    var effect = 'animated bounceInLeft'; /* bounceIn, bounceInUp, bounceInDown, bounceInLeft,
    										 bounceInRight, rotateIn, rotateInUpLeft, rotateInDownLeft,
    										 rotateInUpRight, rotateInDownRight  */
    
    $('.all-content').hide();
    
    $('.content li').click(function(){
    	$('.card-front, .card-back').hide();
    	$('.content li').removeClass('active').hide().css('border','none');
    	$(this).addClass('active').show();
    	bgColor = $('.active .card-back').css('background-color');
    	$('.content').css('background-color',bgColor);
    	$('.close, .all-content').show();
    	$('.responsive').append('<span class="close">close</span>').addClass(effect);
    });
    
    
    $('.responsive').on('click', '.close', function(){
    
    	$('.close').remove();
    	bgColor = $('.active .card-front').css('background-color');
    	$('.responsive').removeClass(effect);
    	$('.all-content').hide();
    	$('.content li').removeClass('active').show().css({ 'border-bottom':'1px solid #2c2c2c',
    													    'border-left':'1px solid #2c2c2c' });
    	$('.card-front, .card-back').show();
    	$('.content').css('background-color',bgColor);
    });
}
</script>