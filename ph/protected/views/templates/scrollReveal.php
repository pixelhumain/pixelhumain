<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://julianlloyd.me/scrollreveal/js/scrollReveal.js' , CClientScript::POS_END); //for javascript external files onloading
?>

<!-- BLOCK CSS -->
<style>
/* http://meyerweb.com/eric/tools/css/reset/
   v2.0 | 20110126
   License: none (public domain)
*/
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
  font-size: 100%;
  font: inherit;
  vertical-align: baseline;
}

/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
  display: block;
}

body {
  line-height: 1;
}

ol, ul {
  list-style: none;
}

blockquote, q {
  quotes: none;
}

blockquote:before, blockquote:after,
q:before, q:after {
  content: '';
  content: none;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
}

a {
  cursor: pointer;
}

* {
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

html {
  overflow: -moz-scrollbars-vertical;
  overflow-y: scroll;
}

h1, .h1 {
  font-family: "proxima-nova", sams-serif;
  font-weight: 100;
}

html, body {
  font-family: "proxima-nova", sans-serif;
  font-weight: 300;
}

.clearfix:before,
.clearfix:after {
  content: " ";
  display: table;
}

.clearfix:after {
  clear: both;
}

html, body {
  color: white;
  text-align: center;
}
@media screen and (min-width: 300px) {
  html, body {
    font-size: 14px;
  }
}
@media screen and (min-width: 460px) {
  html, body {
    font-size: 20px;
  }
}
@media screen and (min-width: 900px) {
  html, body {
    font-size: 24px;
  }
}

h1, .h1 {
  line-height: 1.166;
  margin: .66em 0;
}

@media screen and (min-width: 300px) {
  h1, .h1 {
    font-size: 2.33em;
  }
}
@media screen and (min-width: 460px) {
  h1, .h1 {
    font-size: 2.66em;
  }
}
@media screen and (min-width: 720px) {
  h1, .h1 {
    font-size: 3.33em;
  }
}

p {
  color: #616c84;
  margin: 0.33em 0;
}

a.inline:link,
a.inline:visited {
  color: #35ff99;
  text-decoration: none;
  border-radius: 5px;
  padding: 2px;
}

a.inline:hover,
a.inline:active {
  background: #35ff99;
  color: #202a39;
}

small {
  font-size: .75em;
}

em {
  font-style: italic;
}

.text-left {
  text-align: left;
}

.text-right {
  text-align: right;
}

.text-center {
  text-align: center;
}

html, body {
  height: 100%;
  background: #202a39;
}

.column-container {
  width: 80%;
  max-width: 1000px;
  margin: 0 auto;
  overflow: hidden;
  height: 250%;
  text-align: center;
}
@media screen and (min-width: 300px) {
  .column-container {
    padding-top: 20%;
    margin-bottom: -125px;
  }
}
@media screen and (min-width: 720px) {
  .column-container {
    padding-top: 10%;
  }
}

.column {
  width: 3%;
  height: 100%;
  margin: 0 2%;
  display: inline-block;
}

.block {
  border-radius: 5px;
  margin-bottom: 150%;
}

.block-1x {
  height: 10%;
}

.block-2x {
  height: 15%;
}

.block-3x {
  height: 20%;
}

.block-blueberry {
  background: #008597;
}

.block-slate {
  background: #2d3443;
}

.block-grape {
  background: #4d407c;
}

.block-raspberry {
  background: #ff005d;
}

.block-mango {
  background: #ffcc00;
}

.block-orange {
  background: #ff7c35;
}

.block-kiwi {
  background: #35ff99;
}

.withLove {
  overflow: hidden;
  text-align: center;
  padding-bottom: 2em;
  cursor: default;
  color: #616c84;
}
@media screen and (min-width: 900px) {
  .withLove {
    margin-top: 125px;
  }
}
.withLove * {
  display: inline-block;
}
.withLove .alpha,
.withLove .omega {
  width: 40%;
}
.withLove .alpha {
  text-align: right;
}
.withLove .omega {
  text-align: left;
}
.withLove .heart {
  margin: 0 -2px;
  position: relative;
  z-index: 3;
  -webkit-animation: throb 1.33s ease-in-out infinite;
  animation: throb 1.33s ease-in-out infinite;
}
.withLove .heart path {
  fill: #ff005d;
}
@media screen and (min-width: 300px) {
  .withLove .heart {
    width: 30px;
    height: 30px;
    top: .66em;
  }
}
@media screen and (min-width: 460px) {
  .withLove .heart {
    top: .8em;
    width: 50px;
    height: 50px;
  }
}

@-webkit-keyframes throb {
  0% {
    -webkit-transform: scale(1);
  }

  50% {
    -webkit-transform: scale(0.8);
  }

  100% {
    -webkit-transform: scale(1);
  }
}

@keyframes throb {
  0% {
    transform: scale(1);
  }

  50% {
    transform: scale(0.8);
  }

  100% {
    transform: scale(1);
  }
}
</style>

<!-- BLOCK HTML  -->

 <h1 data-scrollreveal="enter from the top over 1.5s">scrollReveal.js</h1>
  <p data-scrollreveal="enter bottom but wait 1s">Declarative on-scroll reveal animations.</p>
  <p data-scrollreveal="enter bottom but wait 1.3s">An open-source project by <a class="inline" href="https://twitter.com/julianlloyd" title="Julian Lloyd on Twitter">@JulianLloyd</a></p>

  <div class="column-container clearfix">

    <!-- col 1 -->
    <div class="column">
      <div class="block block-1x block-slate" data-scrollreveal="enter top over 3s after 0.5s"></div>
      <div class="block block-2x block-mango" data-scrollreveal="enter right after 0.5s"></div>
      <div class="block block-1x block-kiwi" data-scrollreveal="enter bottom over 1s and move 300px after 0.3s"></div>
      <div class="block block-3x block-blueberry" data-scrollreveal="enter top over 0.5s and move 200px"></div>
      <div class="block block-2x block-raspberry" data-scrollreveal="enter bottom over 1s and move 100px"></div>
      <div class="block block-1x block-grape" data-scrollreveal="enter top"></div>
    </div>

    <!-- col 2 -->
    <div class="column">
      <div class="block block-3x block-kiwi" data-scrollreveal="enter bottom over 1s and move 300px after 0.3s"></div>
      <div class="block block-1x block-orange" data-scrollreveal="enter left"></div>
      <div class="block block-2x block-grape" data-scrollreveal="enter top"></div>
      <div class="block block-1x block-orange" data-scrollreveal="enter left"></div>
      <div class="block block-1x block-grape" data-scrollreveal="enter top"></div>
      <div class="block block-2x block-slate" data-scrollreveal="enter top over 3s after 0.5s"></div>
    </div>

    <!-- col 3 -->
    <div class="column">
      <div class="block block-2x block-raspberry" data-scrollreveal="enter bottom over 1s and move 100px"></div>
      <div class="block block-1x block-blueberry" data-scrollreveal="enter top over 0.5s and move 200px"></div>
      <div class="block block-2x block-slate" data-scrollreveal="enter top over 3s after 0.5s"></div>
      <div class="block block-1x block-mango" data-scrollreveal="enter right after 0.5s"></div>
      <div class="block block-1x block-slate" data-scrollreveal="enter top over 3s after 0.5s"></div>
      <div class="block block-3x block-orange" data-scrollreveal="enter left"></div>
    </div>

    <!-- col 4 -->
    <div class="column">
      <div class="block block-1x block-orange" data-scrollreveal="enter left"></div>
      <div class="block block-2x block-grape" data-scrollreveal="enter top"></div>
      <div class="block block-3x block-raspberry" data-scrollreveal="enter bottom over 1s and move 100px"></div>
      <div class="block block-1x block-blueberry" data-scrollreveal="enter top over 0.5s and move 200px"></div>
      <div class="block block-2x block-kiwi" data-scrollreveal="enter bottom over 1s and move 300px after 0.3s"></div>
      <div class="block block-1x block-mango" data-scrollreveal="enter right after 0.5s"></div>
    </div>

    <!-- col 5 -->
    <div class="column">
      <div class="block block-3x block-mango" data-scrollreveal="enter right after 0.5s"></div>
      <div class="block block-1x block-kiwi" data-scrollreveal="enter bottom over 1s and move 300px after 0.3s"></div>
      <div class="block block-2x block-orange" data-scrollreveal="enter left"></div>
      <div class="block block-1x block-grape" data-scrollreveal="enter top"></div>
      <div class="block block-1x block-slate" data-scrollreveal="enter top over 3s after 0.5s"></div>
      <div class="block block-2x block-raspberry" data-scrollreveal="enter bottom over 1s and move 100px"></div>
    </div>

    <!-- col 6 -->
    <div class="column">
      <div class="block block-1x block-kiwi" data-scrollreveal="enter bottom over 1s and move 300px after 0.3s"></div>
      <div class="block block-3x block-slate" data-scrollreveal="enter top over 3s after 0.5s"></div>
      <div class="block block-1x block-blueberry" data-scrollreveal="enter top over 0.5s and move 200px"></div>
      <div class="block block-3x block-kiwi" data-scrollreveal="enter bottom over 1s and move 300px after 0.3s"></div>
      <div class="block block-1x block-orange" data-scrollreveal="enter left"></div>
      <div class="block block-1x block-blueberry" data-scrollreveal="enter top over 0.5s and move 200px"></div>
    </div>

    <!-- col 7 -->
    <div class="column">
      <div class="block block-2x block-blueberry" data-scrollreveal="enter top over 0.5s and move 200px"></div>
      <div class="block block-1x block-raspberry" data-scrollreveal="enter bottom over 1s and move 100px"></div>
      <div class="block block-1x block-mango" data-scrollreveal="enter right after 0.5s"></div>
      <div class="block block-3x block-raspberry" data-scrollreveal="enter bottom over 1s and move 100px"></div>
      <div class="block block-2x block-mango" data-scrollreveal="enter right after 0.5s"></div>
      <div class="block block-1x block-slate" data-scrollreveal="enter top over 3s after 0.5s"></div>
    </div>

    <!-- col 8 -->
    <div class="column">
      <div class="block block-1x block-grape" data-scrollreveal="enter top"></div>
      <div class="block block-2x block-orange" data-scrollreveal="enter left"></div>
      <div class="block block-1x block-grape" data-scrollreveal="enter top"></div>
      <div class="block block-3x block-slate" data-scrollreveal="enter top over 3s after 0.5s"></div>
      <div class="block block-1x block-blueberry" data-scrollreveal="enter top over 0.5s and move 200px"></div>
      <div class="block block-2x block-kiwi" data-scrollreveal="enter bottom over 1s and move 300px after 0.3s"></div>
    </div>

  </div>

  <div class="withLove">
    <span class="alpha" data-scrollreveal="move 50px enter left over 1s">Made with</span>

    <svg class="heart" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="92.515px" height="73.161px" viewBox="0 0 92.515 73.161" enable-background="new 0 0 92.515 73.161" xml:space="preserve">
      <g>
        <path fill="#010101" d="M82.32,7.888c-8.359-7.671-21.91-7.671-30.271,0l-5.676,5.21l-5.678-5.21c-8.357-7.671-21.91-7.671-30.27,0
          c-9.404,8.631-9.404,22.624,0,31.255l35.947,32.991L82.32,39.144C91.724,30.512,91.724,16.52,82.32,7.888z"/>
      </g>
    </svg>

    <span class="omega" data-scrollreveal="move 50px enter right over 1s">in California</span>
  </div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){

  
};
</script>