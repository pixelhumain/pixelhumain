<?php 
/*$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://' , CClientScript::POS_END);*/
?>
<style>
@import url(http://fonts.googleapis.com/css?family=Lato:100,300,400,700,100italic,300italic,400italic,700italic);
*{-webkit-hyphens: auto;
-moz-hyphens: auto;
-ms-hyphens: auto;
hyphens: auto;}

body {
  margin-top: 50px;
}

header {
  position: fixed;
  top: 0;
  z-index: 5;
  background: #FFF;
  width: 80%;
  height: 50px;
  border-bottom: 2px solid #ACE;
}

nav ul { list-style: none;
  width: 30%;
  margin: auto;
}
nav li { float: left; margin: auto; display: block; width: 25%;}
nav a {
  display: block;
  text-align: center;
  line-height: 50px;
  text-decoration: none;
  color: #357;
}

nav a:hover {
  color: #ace;
  border-bottom: 2px solid #fff;
}

.wrapper {
  height: 3000px;
  font-family: 'Lato', sans-serif;
}

h1, h2, p {
  color: #468;
  width: 50%;
  margin: 10px auto;
  padding: 10px;
  text-align: center;
}

h1 {position: relative;}

h1:after,
h2:after{
  content:"";
  display: block;
  width: 25%;
  height: 3px;
  margin: 15px auto -20px;
  border-top: 1px solid #EEE;
}

h2 {
  color: #8AC;
  font-size: 1.2em;
  font-style: italic;
  font-weight: 300;
}

p{
  color: #777;
  padding-bottom: 50px;
  line-height: 1.6;
  font-size: 1em;
  font-weight: 300;
  
}

.outter {
  width: 100%;
  margin: auto;
  padding-bottom: 350px;
  background: url(http://www.marcogrill.com/wp-content/uploads/2013/10/marco-grill-tomahawk-steak-large.jpg) fixed center center no-repeat;
}

.inner {
  background: rgba(255,255,255,.95);
  padding: 25px 0;
  
  border-bottom: 5px solid #ACE;
}


.outter.two {
  background: url(http://www.marcogrill.com/wp-content/uploads/2013/10/marco-grill-roger-pizey-large.jpg) fixed right top no-repeat;
  -webkit-background-size: 100%;
  background-size: 100%;
}

.outter.three {
  background: url(http://www.marcogrill.com/wp-content/uploads/2013/10/steak-hero.jpg) fixed center top no-repeat;
}
</style>

<div class="container graph">
    <br/>
    <div class="hero-unit">

<div class="wrapper">
  
  <header>
    <nav role='navigation'>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Clients</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </nav>  
  </header>
  
  <div class="outter">
  
    <div class="inner">
      <h1>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae ad.</h1>
      <h2>Lorem ipsum dolor sit amet, consectetur Lorem ipsum dolor...</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore repellat ea impedit voluptatum consectetur voluptatem ratione natus at ut voluptate iure veniam. Officia cumque explicabo facere minus ab in porro maiores. Dignissimos est animi quisquam omnis odio harum quasi error facilis quae veritatis id quidem ab amet inventore soluta blanditiis autem ex aspernatur laudantium aut velit a architecto voluptatem tempore deleniti. Accusantium aut magni sunt esse saepe suscipit numquam ex voluptates aliquam ad neque vero amet unde alias libero quasi quaerat odit debitis quis earum! Nisi molestias quis adipisci ipsam ducimus ipsum minus quidem accusamus excepturi perferendis! Unde sed odit!</p>      
    </div>
  
    
  
  </div>
  
  <div class="outter two">
  
    <div class="inner">
      <h1>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae ad.</h1>
      <h2>Lorem ipsum dolor sit amet, consectetur.</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore repellat ea impedit voluptatum consectetur voluptatem ratione natus at ut voluptate iure veniam. Officia cumque explicabo facere minus ab in porro maiores. Dignissimos est animi quisquam omnis odio harum quasi error facilis quae veritatis id quidem ab amet inventore soluta blanditiis autem ex aspernatur laudantium aut velit a architecto voluptatem tempore deleniti. Accusantium aut magni sunt esse saepe suscipit numquam ex voluptates aliquam ad neque vero amet unde alias libero quasi quaerat odit debitis quis earum! Nisi molestias quis adipisci ipsam ducimus ipsum minus quidem accusamus excepturi perferendis! Unde sed odit!</p>
    </div>
  
 
  
  </div>
  
  <div class="outter three">
  
    <div class="inner">
      <h1>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae ad.</h1>
      <h2>Lorem ipsum dolor sit amet, consectetur.</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore repellat ea impedit voluptatum consectetur voluptatem ratione natus at ut voluptate iure veniam. Officia cumque explicabo facere minus ab in porro maiores. Dignissimos est animi quisquam omnis odio harum quasi error facilis quae veritatis id quidem ab amet inventore soluta blanditiis autem ex aspernatur laudantium aut velit a architecto voluptatem tempore deleniti. Accusantium aut magni sunt esse saepe suscipit numquam ex voluptates aliquam ad neque vero amet unde alias libero quasi quaerat odit debitis quis earum! Nisi molestias quis adipisci ipsam ducimus ipsum minus quidem accusamus excepturi perferendis! Unde sed odit!</p>
      
    </div>

  
  </div>
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