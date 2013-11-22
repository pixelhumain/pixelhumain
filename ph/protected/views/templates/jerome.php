<style>
@import url(http://fonts.googleapis.com/css?family=Lato:400,700);

* { 
  -webkit-box-sizing:border-box;
  -moz-box-sizing:border-box;
  -o-box-sizing:border-box;
  box-sizing:border-box;
}

html, body {
  background:#FFFFFF;
}

.acc-container {
  width:90%;
  margin:30px auto 0 auto;
  -webkit-border-radius:8px;
  -moz-border-radius:8px;
  -o-border-radius:8px;
  border-radius:8px;
  overflow:hidden;
}

.acc-btn { 
  width:100%;
  margin:0 auto;
  padding:20px 25px;
  cursor:pointer;
  background:#34495E;
  border-bottom:1px solid #2C3E50;
}

.acc-content {
  height:0px;
  width:100%;
  margin:0 auto;
  overflow:hidden;
  background:#2C3E50;
}

.acc-content-inner {
  padding:30px;
}

.open {
  height: auto;
}

h1 {
  font:700 20px/26px 'Lato', sans-serif;
  color:#ffffff;
}

p { 
  font:400 16px/24px 'Lato', sans-serif;
  color:#798795;
}

.selected {
  color:#1ABC9C;
}
</style>

<div class="container">
	
        <div class="acc-container">
        <div class="acc-btn"><h1 class="selected">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h1></div>
        <div class="acc-content open">
          <div class="acc-content-inner">
            <p>Proin sodales, nibh eget sollicitudin consectetur, elit nisl malesuada urna, ac fermentum turpis urna id augue. Vestibulum eu consectetur nunc. In ultricies erat nisl, a fringilla risus viverra sed. Phasellus vel sodales elit. Morbi nec adipiscing dolor. Vivamus volutpat vitae velit vel sagittis.</p>
          </div>
        </div>
        
        <div class="acc-btn"><h1>Curabitur et diam vitae dolor accumsan aliquet et in massa.</h1></div>
        <div class="acc-content">
          <div class="acc-content-inner">
            <p>Nulla facilisi. Proin sodales dolor in odio lacinia, ut venenatis massa lobortis. Morbi congue dignissim nisi gravida consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sed egestas diam. Nunc ut mauris tempus, rutrum massa vel, pellentesque velit. Nullam eget diam sit amet diam pretium scelerisque. Nunc sed odio nisi. Nunc odio est, rhoncus vitae risus a, sagittis ultrices mauris. Fusce scelerisque posuere pulvinar.</p>
          </div>
        </div>
        
        <div class="acc-btn"><h1>Proin faucibus sem sed dapibus dapibus.</h1></div>
        <div class="acc-content">
          <div class="acc-content-inner">
            <p>Praesent ultricies risus quis magna convallis, ac condimentum tellus laoreet. Donec dictum velit enim, nec hendrerit leo mattis sit amet.</p>
          </div>
        </div>
        
        <div class="acc-btn"><h1>Praesent lobortis urna non est faucibus, vestibulum mattis diam sollicitudin.</h1></div>
        <div class="acc-content">
          <div class="acc-content-inner">
            <p>Fusce eget ultricies ante. In augue urna, rhoncus ac tellus non, porta malesuada magna. Nulla tincidunt orci in metus rhoncus, at malesuada quam varius. Mauris sed tincidunt massa, ut cursus magna. Pellentesque cursus sapien turpis, id blandit magna tempus at.</p>
          </div>
        </div>
        </div>
        
 </div> 
 <br/>
<script>
$(document).ready(function(){
	  var animTime = 300,
	      clickPolice = false;
	  
	  $(document).on('touchstart click', '.acc-btn', function(){
	    if(!clickPolice){
	       clickPolice = true;
	      
	      var currIndex = $(this).index('.acc-btn'),
	          targetHeight = $('.acc-content-inner').eq(currIndex).outerHeight();
	   
	      $('.acc-btn h1').removeClass('selected');
	      $(this).find('h1').addClass('selected');
	      
	      $('.acc-content').stop().animate({ height: 0 }, animTime);
	      $('.acc-content').eq(currIndex).stop().animate({ height: targetHeight }, animTime);

	      setTimeout(function(){ clickPolice = false; }, animTime);
	    }
	    
	  });
	  
	});
</script>