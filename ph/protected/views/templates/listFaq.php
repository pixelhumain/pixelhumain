<?php 
/*$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://' , CClientScript::POS_END);*/
?>
<style>
@import url(http://fonts.googleapis.com/css?family=Oswald:400,700);
@import url(http://fonts.googleapis.com/css?family=Droid+Sans:400,700);
* {box-sizing: border-box;}

body {
  font-family: "Droid Sans", sans-serif;
  text-align: center;
}
h1, h2, .h2 {
  font-family: Oswald, sans-serif;
  text-transform: uppercase;
}

p {
  line-height: 2;
}

h1 {
  font-size: 2em;
}

h2, .h2 {
  font-size: 1.5em;
}
.wrap {
  width: 90%;
  margin: 0em auto;
  padding-bottom: 2em;
}

.b-w {
  margin: 2em 0;
  padding: 0.1em 0;
  color: white;
}
.b-w:first-child {
  margin-top: 0;
}

.b-w-1 {
  background: #7290E8;
  box-shadow: -10rem 0 0 #7290E8, 10rem 0 0 #7290E8;
}
.b-w-2 {
  background: #7DC1FF;
  box-shadow: -10rem 0 0 #7DC1FF, 10rem 0 0 #7DC1FF;
}
.b-w-3 {
  background: #C57DFF;
  box-shadow: -10rem 0 0 #C57DFF, 10rem 0 0 #C57DFF;
}
.b-w-4 {
  background: #8A8AFF;
  box-shadow: -10rem 0 0 #8A8AFF, 10rem 0 0 #8A8AFF;
}
.b-w-5 {
  background: #9372E8;
  box-shadow: -10rem 0 0 #9372E8, 10rem 0 0 #9372E8;
}

@media screen and (min-width: 400px) {
  .wrap {
    width: 80%;
  }
p {
  line-height: 2;
  font-size: 1.2em;
}
h1 {
  font-size: 3em;
}

h2, .h2 {
  font-size: 2em;
}
}

/*
pink - C57DFF
purple - 9372E8
violet - 8A8AFF
blue - 7290E8
sky - 7DC1FF
*/
</style>

<div class="container graph">
    <br/>
    <div class="hero-unit">

<div class="wrap">
  <div class="b-w b-w-1">
    <h1>What Should They Teach?</h1>
    <h2 class="sub">Help me improve learning for the next generation of web creators.</h2>
  </div>
  <p>On December 11, 2013 I will have the opportunity to sit on a focus group whose main purpose is to influence the web development and web design degree curriculum for a local technical college.</p>
  <div class="b-w b-w-2">
    <h2>Why?</h2>
  </div>
  <p>I graduated from this technical college with their AAS web design and development degree 5 years ago, and I've had a job in this field since before I graduated. Back then, I did tons of extra-curricular learning to catch up where the degree program lacked. They're looking for where they can improve based on skills I've actually been using on the job.</p>
  <div class="b-w b-w-3">
    <h2>So, what?</h2>
  </div>
  <p>I've got some ideas for suggestions, but I'm just one guy, in one employment situation. I'm reaching out to you, the web community, to pitch in and influence the <strong>next generation of people who make the web</strong>.</p>
  <div class="b-w b-w-4">
    <h2>Designer? Developer? Big Company? Small Agency? Freelance? Contractor?</h2>
  </div>
  <p>If you make stuff on the web, I want your opinion. Self-taught to certificate to cap-and-gown-with-honors. What do you think should be <strong>front and center</strong> in the web development and web design learning of today? What should be the foundation? How far does a college need to go to prepare the student for real-world web working? Do you have an idea for what order classes should be taken?</p>
  <div class="b-w b-w-5">
    <h2>Gimme, Gimme, Gimme!</h2>
  </div>
  <p>So, if you've got something to share with me on this, comment on this codepen or tweet me <a href="https://twitter.com/keithwyland">@keithwyland</a>! Got a book's worth to share? keithfvtc[at]gmail[dot]com. Your idea has already been shared? I don't care! Please repeat it anyway!</p> 
  <p><strong>Please comment by December 10!</strong></p>
  <p class="h2">THANK YOU!</p>
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