<?php //http://codepen.io/littlefishcreate/pen/odJip?>

<!-- BLOCK CSS -->
<style>
@import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css");
@import url("//fonts.googleapis.com/css?family=Droid+Sans");
html, body {
  background: #4d88e9;
  padding: 0;
  margin: 0;
}

button {
  -webkit-border-radius: 10px 10px;
  -moz-border-radius: 10px 10px / 10px 10px;
  border-radius: 10px 10px / 10px 10px;
  border: 1px solid #295aaa;
  padding: 10px 14px 10px 14px;
  background: #a7c6f9;
  text-shadow: rgba(0, 0, 0, 0.2) 1px 1px 0;
  -webkit-box-shadow: rgba(62, 106, 166, 0.6) 2px 2px 2px;
  -moz-box-shadow: rgba(62, 106, 166, 0.6) 2px 2px 2px;
  box-shadow: rgba(62, 106, 166, 0.6) 2px 2px 2px;
  background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #6592dc), color-stop(100%, #3064b8));
  background-image: -webkit-linear-gradient(#6592dc, #3064b8);
  background-image: -moz-linear-gradient(#6592dc, #3064b8);
  background-image: -o-linear-gradient(#6592dc, #3064b8);
  background-image: linear-gradient(#6592dc, #3064b8);
  font-weight: 100;
  color: #d2ddf0;
  font-size: 1em;
}
button:active {
  -webkit-box-shadow: rgba(62, 106, 166, 0.6) 2px 2px 2px inset;
  -moz-box-shadow: rgba(62, 106, 166, 0.6) 2px 2px 2px inset;
  box-shadow: rgba(62, 106, 166, 0.6) 2px 2px 2px inset;
}
button i {
  color: #fff;
}

#wrap {
  box-sizing: border-box;
  min-width: 320px;
  max-width: 600px;
  margin: 0 auto;
  overflow: visibe;
  text-align: center;
}
#wrap h2 {
  font-size: 2em;
  padding: 30px;
  font-family: 'Droid Sans', Arial, sans-serif;
  color: #fff;
  text-shadow: rgba(0, 0, 0, 0.2) 1px 1px 0;
}
#wrap #fullscreen {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #fff;
  z-index: 1000;
  padding: 0;
  margin: 0;
}
#wrap #fullscreen i {
  position: absolute;
  top: 20px;
  right: 20px;
  font-size: 1em;
  color: #c0c0c0;
}
#wrap #fullscreen .form-wrap {
  margin: 150px auto;
  min-height: 300px;
  max-width: 600px;
  min-width: 320px;
}
#wrap #fullscreen .form-wrap h1 {
  font-family: 'Droid Sans', Arial, sans-serif;
  color: #c0c0c0;
}
#wrap #fullscreen .form-wrap form label {
  display: none;
  width: 100%;
}
#wrap #fullscreen .form-wrap form input {
  margin: 0 auto;
  border: 1px solid #c0c0c0;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  display: block;
  width: 70%;
  padding: 10px;
  margin-bottom: 10px;
  -webkit-border-radius: 10px 10px;
  -moz-border-radius: 10px 10px / 10px 10px;
  border-radius: 10px 10px / 10px 10px;
  -webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 10px;
  -moz-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 10px;
  box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 10px;
  font-size: 0.875em;
  color: #444;
}
#wrap #fullscreen .form-wrap form input:hover {
  -webkit-box-shadow: rgba(0, 0, 0, 0.2) 1px 1px 1px inset;
  -moz-box-shadow: rgba(0, 0, 0, 0.2) 1px 1px 1px inset;
  box-shadow: rgba(0, 0, 0, 0.2) 1px 1px 1px inset;
}
#wrap #fullscreen .form-wrap form input:active {
  -webkit-box-shadow: rgba(0, 0, 0, 0.4) 1px 1px 1px inset;
  -moz-box-shadow: rgba(0, 0, 0, 0.4) 1px 1px 1px inset;
  box-shadow: rgba(0, 0, 0, 0.4) 1px 1px 1px inset;
}
#wrap #fullscreen .form-wrap button {
  float: right;
  margin-right: 90px;
  color: #fff;
}

</style>

<!-- BLOCK HTML  -->

<div class="container graph">
    <br/>
    <div class="hero-unit">

<!-- lets build a full screen login area! -->
<div id="wrap">
  <h2>Click the button below to see a super simple fullscreen login</h2>  
     <button class="clicky"><i class="fa  fa-external-link"></i> Go Fullscreen</button>
     <div id="fullscreen">
       <a href="#" class="close"><i class="fa fa-times"></i></a>
          <div class="form-wrap">
            <h1>Member Login</h1>
            <form action="" method="get">
              <label>Username</label><input type="text" name="input" value="Username">
             <label>Password</label><input type="text" name="input" value="Password">
              <button name="submit">Login</button> 
          </form>
       </div>
  </div>
</div>


     

	</div>
</div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){
	//Look out for this as a JQuery plugin => coming soon. 
	//Writing it for fun, so comments & suggestions welcome.
	$(document).ready(function($){
	   
	    var full = $('#fullscreen');
	    $(full).data('state','open');
	    $('button').click(function(){
	      if($(full).data('state') == 'open'){
	        $(full).fadeIn(300);
	        $(full).data('state','close');
	        //console.log($(full).data('state') );
	      }
	    });
	    $('.close').click(function(){
	      if($(full).data('state') == 'close'){
	        $(full).fadeOut();
	        $(full).data('state','open');
	       //console.log($(full).data('state') );
	      }
	    });  
	});
	  

  
};
</script>