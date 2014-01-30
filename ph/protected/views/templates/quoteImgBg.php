<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css'); //for CSS external files onloading
$cs->registerScriptFile('http://' , CClientScript::POS_END); //for javascript external files onloading
?>

<!-- BLOCK CSS -->
<style>
@import url(http://fonts.googleapis.com/css?family=Josefin+Slab);
body {
  background-color: black;
  background-image: url("http://indervilla.com/home/2012/12/Dark-City-Sunset-HD.jpg");
  background-size: cover;
  background-repeat: no-repeat;
}

/* The following is all you really need for the effect to work */
.backbox {
  font-family: "Josefin Slab";
  text-transform: uppercase;
  font-size: 3rem;
  color: white;
  width: 75%;
  height:500px;
  position: relative;
  left: 12.5%;
  top: 3rem;
  text-align: center;
  line-height:60px;
  padding: 50px;
  position: relative;
  background-image: -webkit-gradient(linear, 0% 50%, 100% 50%, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(40%, rgba(255, 255, 255, 0.3)), color-stop(60%, rgba(255, 255, 255, 0.3)), color-stop(100%, rgba(255, 255, 255, 0)));
  background-image: -webkit-linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.3) 40%, rgba(255, 255, 255, 0.3) 60%, rgba(255, 255, 255, 0));
  background-image: -moz-linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.3) 40%, rgba(255, 255, 255, 0.3) 60%, rgba(255, 255, 255, 0));
  background-image: -o-linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.3) 40%, rgba(255, 255, 255, 0.3) 60%, rgba(255, 255, 255, 0));
  background-image: linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.3) 40%, rgba(255, 255, 255, 0.3) 60%, rgba(255, 255, 255, 0));
}
.backbox:before {
  width: 100%;
  height: 0.125rem;
  position: absolute;
  left: 0;
  top: 0;
  content: "";
  background-image: -webkit-gradient(linear, 0% 50%, 100% 50%, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(40%, rgba(255, 255, 255, 0.8)), color-stop(60%, rgba(255, 255, 255, 0.8)), color-stop(100%, rgba(255, 255, 255, 0)));
  background-image: -webkit-linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.8) 40%, rgba(255, 255, 255, 0.8) 60%, rgba(255, 255, 255, 0));
  background-image: -moz-linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.8) 40%, rgba(255, 255, 255, 0.8) 60%, rgba(255, 255, 255, 0));
  background-image: -o-linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.8) 40%, rgba(255, 255, 255, 0.8) 60%, rgba(255, 255, 255, 0));
  background-image: linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.8) 40%, rgba(255, 255, 255, 0.8) 60%, rgba(255, 255, 255, 0));
}
.backbox:after {
  width: 100%;
  height: 0.125rem;
  position: absolute;
  left: 0;
  bottom: 0;
  content: "";
  background-image: -webkit-gradient(linear, 0% 50%, 100% 50%, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(40%, rgba(255, 255, 255, 0.8)), color-stop(60%, rgba(255, 255, 255, 0.8)), color-stop(100%, rgba(255, 255, 255, 0)));
  background-image: -webkit-linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.8) 40%, rgba(255, 255, 255, 0.8) 60%, rgba(255, 255, 255, 0));
  background-image: -moz-linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.8) 40%, rgba(255, 255, 255, 0.8) 60%, rgba(255, 255, 255, 0));
  background-image: -o-linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.8) 40%, rgba(255, 255, 255, 0.8) 60%, rgba(255, 255, 255, 0));
  background-image: linear-gradient(left, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.8) 40%, rgba(255, 255, 255, 0.8) 60%, rgba(255, 255, 255, 0));
}

</style>

<!-- BLOCK HTML  -->


<div class='backbox'>
  <p>You can only see <br>as far as you think.<br></p>
</div>


<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){

  
};
</script>