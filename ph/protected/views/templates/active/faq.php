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
	<div class="span3 bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav affix-top">
          <li class="active"><a href="#dropdowns"><i class="icon-chevron-right"></i> Dropdowns</a></li>
          <li class=""><a href="#buttonGroups"><i class="icon-chevron-right"></i> Button groups</a></li>
          <li class=""><a href="#buttonDropdowns"><i class="icon-chevron-right"></i> Button dropdowns</a></li>
          <li class=""><a href="#navs"><i class="icon-chevron-right"></i> Navs</a></li>
          <li class=""><a href="#navbar"><i class="icon-chevron-right"></i> Navbar</a></li>
          <li class=""><a href="#breadcrumbs"><i class="icon-chevron-right"></i> Breadcrumbs</a></li>
          <li class=""><a href="#pagination"><i class="icon-chevron-right"></i> Pagination</a></li>
          <li class=""><a href="#labels-badges"><i class="icon-chevron-right"></i> Labels and badges</a></li>
          <li class=""><a href="#typography"><i class="icon-chevron-right"></i> Typography</a></li>
          <li class=""><a href="#thumbnails"><i class="icon-chevron-right"></i> Thumbnails</a></li>
          <li class=""><a href="#alerts"><i class="icon-chevron-right"></i> Alerts</a></li>
          <li class=""><a href="#progress"><i class="icon-chevron-right"></i> Progress bars</a></li>
          <li><a href="#media"><i class="icon-chevron-right"></i> Media object</a></li>
          <li><a href="#misc"><i class="icon-chevron-right"></i> Misc</a></li>
        </ul>
      </div>	
    <div class="acc-container">
    	<?php 
    	$ct = 0;
    	foreach( Yii::app()->mongodb->data->find(array( "key" => $name , 
    																  "type" => "qa")) as $qa)
    	{?>
    																  
            <div class="acc-btn"><h1 class="selected"> <?php echo $qa["question"]?></h1></div>
            <div class="acc-content <?php if(!$ct)echo "open"?>">
              <div class="acc-content-inner">
                <p> <?php echo $qa["answer"]?></p>
              </div>
            </div>
        <?php 
            $ct++;
    	}?>
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