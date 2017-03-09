<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://' , CClientScript::POS_END);
?>
<style>
@import url(http://fonts.googleapis.com/css?family=Roboto|Oswald);
html {
  margin: 0 20%;
  color: #000;
  font-family: "Roboto";
}
#controlpanel {
  width: 400px;
  border-top: 5px solid #000;
  border-bottom: 5px solid #000;
}
#controlpanel > header {
  border-bottom: 1px solid black;
}
#controlpanel > header h1 {
  font-size: 35px;
  color:#000;
  margin-bottom:10px;
  font-family: "Oswald";
  text-transform: uppercase;
}
#controlpanel > header p {
  font-size: 18px;
  line-height: 18px;
}
#controlpanel input[type=text] {
  border: 1px solid transparent;
  font-size: 18px;
}
#controlpanel input[type=password] {
  border: 1px solid transparent;
  font-size: 18px;
}
#controlpanel input {
  border-radius: 2px;
  font-family: "Roboto";
}
#controlpanel div{
  margin : 10px 0px;
}
#controlpanel div p b{
  font-weight:bold;
  color:#000;
}
#controlpanel input:focus {
  border: 1px solid black;
  outline: 0;
}
#controlpanel .border {
  border-bottom: 1px solid black;
}
#controlpanel button {
  border: 1px solid black;
  color: black;
  background: white;
  border-radius: 4px;
  padding: .5em 1em;
  font-size: 18px;
  margin: .5em 0;
  transition: .5s all;
  font-family: "Roboto";
}
#controlpanel button:hover {
  background: black;
  color: white;
}
#controlpanel hr {
  border: 0;
  border-top: 5px solid black;
  border-bottom: 1px solid black;
  padding: 5px 0;
}
</style>

<div class="container graph">
    <br/>
    <div class="hero-unit">

        <div id="controlpanel">
          <header>
            <h1>Control Panel</h1>
          </header>
          <div id="accountusernameandpassword" class="border">
            <p><b>Username</b> <input type="text" placeholder="billisamazing"></p>
            <p><b>Password</b> <input type="password" placeholder="***************">
          </div>
          <div id="email" class="border">
            <p><b>Email</b> <input type="text" placeholder="bill@gmail.com"></p>
          </div>
          <div id="subscribe" class="border">
            <p><input type="checkbox"> Suscribe to our Newsletter</p>
            <p><input type="checkbox"> Notify me when someone reads my post</p>
          </div>
          
          
          <div id="submit">
            <button>Save Changes</button>
          </div>
        </div>
        
        <hr />

	</div>
</div>


<script type="text/javascript"		>
initT['animInit'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},0.3);
})();

  
};
</script>