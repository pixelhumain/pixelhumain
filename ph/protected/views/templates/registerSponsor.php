<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/upload/styles.css');
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' , CClientScript::POS_END);
?>
<style>
@import url(http://fonts.googleapis.com/css?family=Archivo+Narrow);
.graph {
  font-size: 800%;
  font-family: 'Archivo Narrow', sans-serif;
  font-weight: 700;
}

.graph a {
  text-decoration: none;
}

.graph .signup__container {
  width: 15em;
  height: 3em;
  margin-top: 1.5em;
  letter-spacing: -0.31em;
}

.graph .hacker,.graph .sponsor {
  letter-spacing: 0;
  display: inline;
  width: 50%;
}

.graph .hacker {
  background: #f33634;
  color: #750807;
  border-bottom: .2em solid #750807;
}
.graph .hacker:hover {
  background: #750807;
  color: #f33634;
  border-bottom: .2em solid #f33634;
}

.graph .sponsor {
  background: #38edfb;
  color: #026f78;
  border-bottom: .2em solid #026f78;
  margin-left: .5em;
}
.graph .sponsor:hover {
  background: #026f78;
  color: #38edfb;
  border-bottom: .2em solid #38edfb;
}

.graph .btn--sign-up {
  margin-top: 0;
  padding: 1em 1.5em;
  -webkit-border-radius: 0.3em;
  -moz-border-radius: 0.3em;
  -ms-border-radius: 0.3em;
  -o-border-radius: 0.3em;
  border-radius: 0.3em;
  box-shadow: 0 2px 1px rgba(0, 0, 0, 0.4);
}
.graph .btn--sign-up:active {
  padding: .8em 1.5em 1.2em 1.5em;
  margin-top: .5em;
  border-bottom: none;
}

.graph .sign-up--devider {
  display: inline-block;
  -webkit-border-radius: 100%;
  -moz-border-radius: 100%;
  -ms-border-radius: 100%;
  -o-border-radius: 100%;
  border-radius: 100%;
  padding: .4em;
  margin: -7.3em;
  letter-spacing: 0;
  background: #fff;
}

</style>

<div class="container graph">
    <br/>
    <div class="hero-unit">

<div class="signup__container">
	<a href="#" class="btn--sign-up hacker">Register</a>
	<a href="#" class="btn--sign-up sponsor">Sponsor</a>
  
  <span class="sign-up--devider">OR</span>
</div>
<small>font-size at 300%, change the value and see the magic of em!</small>

    </div></div>
<script type="text/javascript"		>
initT['animInit'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},0.3);
})();

  
};
</script>