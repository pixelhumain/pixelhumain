<?php 
/*$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://' , CClientScript::POS_END);*/
?>
<style>
p {  
  color: #fff;
  background: #222;
  padding: 75px;
  text-align: center;
}
.force {
  color: aqua;
}
.wrapper {
  width: 1000px;
  margin: auto;
}
h2 {
  color: #666;
  font-size: 3em;
  text-align: left;
  text-transform: uppercase;
  text-shadow: 1px 1px 0 rgba(0,0,0,0.3)
    -webkit-transition: all 0.45s ease;
  -moz-transition: all 0.45s ease;
  -o-transition: all 0.45s ease;
  transition: all 0.45s ease; 
}
h2:hover {
  color: aqua;
}
.hoverblock h2 {
  color: #fff;
  font-size: 3em;
  text-align: center;
  text-transform: uppercase;
  text-shadow: 1px 1px 0 rgba(0,0,0,0.3)
}
a {
  position: absolute;
  display: block;
  margin: auto;
  padding: 10px 0 0 0;
  width: 90%;
  height: 35px;
  outline: solid 5px #40eb95;
  color: #fff;
  background: #227d4f;
  text-decoration: none;
  text-transform: uppercase;
  text-align: center;
  bottom: 15px;
  left: 5%;
  -webkit-transition: all 0.45s ease;
  -moz-transition: all 0.45s ease;
  -o-transition: all 0.45s ease;
  transition: all 0.45s ease;
  
 /* -webkit-border-radius: 10px;
     -moz-border-radius: 10px;
          border-radius: 10px; */
}
a:hover {
  color: #fff;
  outline: solid 5px #fff;  
}
a:active {
  background: #333;
  -webkit-transition: all 0.1s ease;
  -moz-transition: all 0.1s ease;
  -o-transition: all 0.1s ease;
  transition: all 0.1s ease;
  
}
.container,
.hoverblock {
  width: 300px;
  height: 200px;
}
.container {
  position: relative;
  border: solid 3px #333;
  outline-right: solid 10px #333;  
  margin: 15px auto;
  overflow: hidden;
  float: left;
  margin-left: 10px;
}
.box {
  background: #000;
}
.hoverblock {
  position: absolute;
  background: #31b573;
  transition: all 0.5s ease-out;
  color: #fff;
}
.container:hover .hoverblock {
  top: 0;
  left: 0;
  transition: all 0.35s ease-out;
  -webkit-transition: all 0.35s ease-out;
    -moz-transition: all 0.35s ease-out;
    -o-transition: all 0.35s ease-out; 
}
.hoverblock.top {
  top: -200px;
  left: 0;
}
.hoverblock.bottom {
  top: 200px;
  left: 0;
}
.hoverblock.left {
  top: 0;
  left: -300px;
}
.hoverblock.right {
  top: 0;
  left: 300px;
}

.hoverblock.top-left {
  top: -200px;
  left: -300px;
}
.hoverblock.top-right {
  top: -200px;
  left: 300px;
}
.hoverblock.bottom-left {
  top: 200px;
  left: -300px;
}
.hoverblock.bottom-right {
  top: 200px;
  left: 300px;
}

@-webkit-keyframes Jump {
    from {-webkit-transform:translate(0, 0px);}
    50% {-webkit-transform:translate(0, 10px);}
    to {-webkit-transform: translate(0, -0px);}    
}
.jump {
  -webkit-animation-name: Jump;
    -webkit-animation-duration: 2s;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: ease-in-out;
}
</style>


<div class="wrapper">
  <h2 class>Awesome and simple hover effects</h2>
  
  <div class="container">
    <div class="box">
      <p>TOP</p>
    </div>
    <div class="hoverblock top">
      <h2 class="jump">Zombie?!</h2>
      <a href="#">Arghhhhhhhhhhh! Brainzzzz!</a>
    </div>
  </div>
  
  <div class="container">
    <div class="box">
      <p>BOTTOM</p>
    </div>
    <div class="hoverblock bottom">
      <h2 class="jump">Zombie?!</h2>
      <a href="#">Arghhhhhhhhhhh! Brainzzzz!</a>
    </div>
  </div>
  
  <div class="container">
    <div class="box">
      <p>LEFT</p>
    </div>
    <div class="hoverblock left">
      <h2 class="jump">Zombie?!</h2>
      <a href="#">Arghhhhhhhhhhh! Brainzzzz!</a>
    </div>
  </div>
  
  <div class="container">
    <div class="box">
      <p>RIGHT</p>
    </div>
    <div class="hoverblock right">
      <h2 class="jump">Zombie?!</h2>
      <a href="#">Arghhhhhhhhhhh! Brainzzzz!</a>
    </div>
  </div>
  
  <div class="container">
    <div class="box">
      <p>TOP-LEFT</p>
    </div>
    <div class="hoverblock top-left">
      <h2 class="jump">Zombie?!</h2>
      <a href="#">Arghhhhhhhhhhh! Brainzzzz!</a>
    </div>
  </div>
  
  <div class="container">
    <div class="box">
      <p>TOP-RIGHT</p>
    </div>
    <div class="hoverblock top-right">
      <h2 class="jump">Zombie?!</h2>
      <a href="#">Arghhhhhhhhhhh! Brainzzzz!</a>
    </div>
  </div>
  
  <div class="container">
    <div class="box">
      <p>BOTTOM-LEFT</p>
    </div>
    <div class="hoverblock bottom-left">
      <h2 class="jump">Zombie?!</h2>
      <a href="#">Arghhhhhhhhhhh! Brainzzzz!</a>
    </div>
  </div>
  
  <div class="container">
    <div class="box">
      <p>BOTTOM-RIGHT</p>
    </div>
    <div class="hoverblock bottom-right">
      <h2 class="jump">Zombie?!</h2>
      <a href="#">Arghhhhhhhhhhh! Brainzzzz!</a>
    </div>
  </div>
  
  <div class="container">
    <div class="box">
      <p class="force">May the Force be with you!</p>
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