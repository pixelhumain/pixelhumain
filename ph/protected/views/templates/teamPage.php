
<style>
@import url(http://fonts.googleapis.com/css?family=Metrophobic|Alike);


#wrap {
  position: absolute;
  left: 0;
  width: 100%;
  top: 50%;
  margin-top: -150px;
}
#wrap:after {
  content: ".";
  display: block;
  clear: both;
  visibility: hidden;
  line-height: 0;
  height: 0;
}
@media screen and (max-width: 1300px) {
  #wrap {
    top: 0;
    margin: 0;
  }
}

.col_3 {
  width: 31.33333%;
  margin: 0 1%;
  float: left;
  box-sizing: border-box;
  cursor: pointer;
  background: #FFF;
}
@media screen and (max-width: 1300px) {
  .col_3 {
    float: none;
    width: 100%;
    padding-bottom: 20px;
    margin: 0;
  }
}
.col_3 h1 {
  padding-top: 40px;
  font-family: Alike,serif;
  display: block;
  margin: 0 auto;
  text-align: center;
  padding-bottom: 40px;
  color: #FFF;
  font-size: 2em;
}
.col_3 h1#one {
  background: #333;
  box-shadow: 0 -5px 0 #262626, 0 5px 0 #cccccc;
}
.col_3 h1#two {
  background: #ae4029;
  box-shadow: 0 -5px 0 #993824, 0 5px 0 #cccccc;
  margin-top: -15px;
}
.col_3 h1#three {
  background: #149da1;
  box-shadow: 0 -5px 0 #11878a, 0 5px 0 #cccccc;
}
.col_3 img {
  display: block;
  margin: -25px auto;
  border-radius: 50%;
  border: 5px solid #FFF;
  box-shadow: 0 3px 0 #DDD;
}
.col_3 p {
  margin: 44px auto;
  display: block;
  width: 70%;
  text-align: center;
  font-family: Metrophobic,sans-serif;
  color: #333;
  font-size: 1em;
  line-height: 1.2em;
}

</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <div id="wrap">
  <div class="col_3" >
    
    <h1 id="one">John Doe</h1>
    <img src="http://lorempixel.com/100/100" />
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </p>
    
  </div>
    <div class="col_3">
    
    <h1  id="two">John Deer</h1>
      <img src="http://lorempixel.com/100/100/people" />
      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. 

 </p>
  </div>
    <div class="col_3" >
    
    <h1 id="three">John Beer</h1>
      <img src="http://lorempixel.com/100/100/sports" />
      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </p>
  </div>
  
</div>
    
    </div></div>
<script type="text/javascript"		>
initT['animInit'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},0.3);
})();

  
};
</script>