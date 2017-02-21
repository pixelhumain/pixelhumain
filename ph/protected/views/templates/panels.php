<?php 
$cs = Yii::app()->getClientScript();
//http://codepen.io/oceatoon/pen/kCjpD
$cs->registerScriptFile('http://' , CClientScript::POS_END); //for javascript external files onloading
?>

<!-- BLOCK CSS -->
<style>
@charset "UTF-8";
html {
  padding-top: 4em;
  min-width: 15em;
  text-align: center;
  background: url(http://www.louisdallaraphotography.com/wp-content/uploads/2012/01/cityscape-philadelphia-.jpg);
  font: 100% Trebuchet MS, Century Gothic, Verdana, sans-serif;
}

body {
  margin: 0;
}

p {
  margin: 0;
  padding: .5em;
  font-size: .8em;
}

.locator-box {
  position: relative;
  margin: 0 .5em;
  min-height: 3em;
  border-radius: .5em;
  background: white;
}
.locator-box:before, .locator-box:after {
  position: absolute;
  top: 50%;
  left: 50%;
  background: inherit;
  content: '';
}
.locator-box:before {
  margin: 0 -.125em;
  width: .25em;
  height: 8.1em;
}
.locator-box:after {
  margin: 8.1em -2.91667em;
  border: solid .25em white;
  padding: 1.33333em;
  width: 2.66667em;
  height: 2.66667em;
  border-radius: 50%;
  background-clip: content-box;
}

.blocks {
  margin: 0 auto;
  max-width: 75em;
}

.block {
  display: inline-block;
  overflow: hidden;
  margin: 1em;
  min-width: 15em;
  width: 35%;
  border-radius: .75em;
}

.block__head {
  color: white;
}

.block__details {
  text-align: left;
}

.block__element {
  overflow: hidden;
  position: relative;
  min-height: 3em;
}

.block__element--cut:before {
  position: absolute;
  z-index: -1;
  margin: -5em;
  width: 8em;
  height: 8em;
  border-radius: 50%;
  content: '';
}

.block:nth-child(1) .block__element--cut {
  padding-right: 3em;
}
.block:nth-child(1) .block__details {
  color: #79e9fd;
}
.block:nth-child(1) .block__element--cut:before {
  bottom: 0;
  right: 0;
  box-shadow: 0 0 0 40em #0f414c;
}
.block:nth-child(1) .block__element:not(.block__element--cut) {
  background: rgba(121, 233, 253, 0.65);
}

.block:nth-child(2) .block__element--cut {
  padding-left: 3em;
}
.block:nth-child(2) .block__details {
  color: #ddac43;
}
.block:nth-child(2) .block__element--cut:before {
  bottom: 0;
  left: 0;
  box-shadow: 0 0 0 40em #673a01;
}
.block:nth-child(2) .block__element:not(.block__element--cut) {
  background: rgba(221, 172, 67, 0.65);
}

.block:nth-child(3) .block__element--cut {
  padding-right: 3em;
}
.block:nth-child(3) .block__details {
  color: #bba9ff;
}
.block:nth-child(3) .block__element--cut:before {
  top: 0;
  right: 0;
  box-shadow: 0 0 0 40em rgba(187, 169, 255, 0.65);
}
.block:nth-child(3) .block__element:not(.block__element--cut) {
  background: #291c52;
}

.block:nth-child(4) .block__element--cut {
  padding-left: 3em;
}
.block:nth-child(4) .block__details {
  color: #b0d65f;
}
.block:nth-child(4) .block__element--cut:before {
  top: 0;
  left: 0;
  box-shadow: 0 0 0 40em rgba(176, 214, 95, 0.65);
}
.block:nth-child(4) .block__element:not(.block__element--cut) {
  background: #36480c;
}

.block__action {
  float: right;
  padding: .5em;
  height: 100%;
  color: inherit;
  text-decoration: none;
  text-transform: uppercase;
}
.block__action:after {
  display: inline-block;
  padding-left: .35em;
  content: '▶';
}

@media (max-width: 36em) {
  .locator-box:before, .locator-box:after {
    display: none;
  }

  .block {
    display: block;
    margin: 1em auto;
  }
  .block .block__element--cut:nth-child(n + 0) {
    padding: 0;
  }

  .block__element--cut:before {
    width: .125em;
    height: .125em;
  }
}
.bgc{background-color : #666;}
</style>

<!-- BLOCK HTML  -->

<div class="container graph">
    <br/>
    <div class="hero-unit bgc">

<section class='locator-box'>Resize the damn window.</section>
<section class='blocks'>
  <section class='block'>
    <header class='block__element block__head'>
      <h2>Yogi Bear</h2>
    </header>
    <section class='block__element block__element--cut block__details'>
      <a href='#' class='block__action'>go</a>
      <p>Smaaaarter than the average bear!</p>
    </section>
  </section><!--
--><section class='block'>
  <header class='block__element block__head'>
    <h2>Boo Boo</h2>
  </header>
  <section class='block__element block__element--cut block__details'>
    <a href='#' class='block__action'>go</a>
    <p>The ranger isn't going to like this...</p>
  </section>
  </section><!--
--><section class='block'>
  <header class='block__element block__element--cut block__head'>
    <h2>Cindy Bear</h2>
  </header>
  <section class='block__element block__details'>
    <a href='#' class='block__action'>go</a>
    <p>Oh, that's Yogi...</p>
  </section>
  </section><!--
--><section class='block'>
  <header class='block__element block__element--cut block__head'>
    <h2>Ranger Smith</h2>
  </header>
  <section class='block__element block__details'>
    <a href='#' class='block__action'>go</a>
    <p>Stole a picnic basket? Yogiii!!!</p>
  </section>
  </section>
</section>

	</div>
</div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){

  
};
</script>