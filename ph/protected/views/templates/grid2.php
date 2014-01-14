<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://' , CClientScript::POS_END);
?>
<style>
 @import url(http://fonts.googleapis.com/css?family=Roboto+Slab:100);
body{width:100%;height:auto; background: url('http://multisonusaudio.com/assets/images/noise_pattern_9.jpg') repeat;
}
h1{
  max-width:90%;
  font-family: 'Roboto Slab', serif;
  color:rgba(255,255,255,.8);
  margin:0 10%; padding:50px 0;
  font-weight:100;
  font-size:2rem;
}
#big_box{
   max-width:100%;
   background:#fff;
   margin:0 auto;
   height:auto;  
  -webkit-box-shadow: 0 2px 5px rgba(0,0,0,.25);
}
#big_box > img:hover{-webkit-box-shadow:0 2px 8px rgba(0,0,0,.75);}
.box-1, .box-2, .box-3, .box-4{ 
  position:relative;
	float:left;
	transition: all 0.4s ease-in-out;
  -webkit-transition: all 0.4s ease-in-out;
  max-width:100%; 
	max-height:100%;
  -webkit-box-shadow: 0 2px 5px rgba(0,0,0,.25);
}

</style>

<div class="container graph">
    <br/>
    <div class="hero-unit">
<body>
    <!--NOT WORKING PROPERLY AT THE MOMENT-->
  <h1> Resize window to see the effect</h1>
    <div id="big_box">
      <img class="box-2" src="http://placehold.it/620x300/A7DBD8/fff/&text=2"/>
      <img class="box-3" src="http://placehold.it/300x620/69D2E7/161f29/&text=3"/>
        <img class="box-1" src="http://placehold.it/460x460/E0E4CC/fff/&text=1"/>
      <img class="box-1" src="http://placehold.it/460x460/F38630/fff/&text=1"/>
      <img class="box-4" src="http://placehold.it/460x460/db3e3e/fff/&text=4"/>
        
      <img class="box-1" src="http://placehold.it/460x460/ECD078/fff/&text=1"/>
        <img class="box-1" src="http://placehold.it/460x460/D95B43/fff/&text=1"/>
        <img class="box-2" src="http://placehold.it/620x300/C02942/fff/&text=2"/>
        <img class="box-1" src="http://placehold.it/460x460/542437/fff/&text=1"/>
      <img class="box-1" src="http://placehold.it/460x460/53777A/fff/&text=1"/>
        <img class="box-2" src="http://placehold.it/620x300/F38630/fff/&text=2"/>
      
      <img class="box-2" src="http://placehold.it/620x300/A7DBD8/fff/&text=2"/>
      <img class="box-3" src="http://placehold.it/300x620/69D2E7/161f29/&text=3"/>
        <img class="box-1" src="http://placehold.it/460x460/E0E4CC/fff/&text=1"/>
      <img class="box-1" src="http://placehold.it/460x460/F38630/fff/&text=1"/>
      <img class="box-4" src="http://placehold.it/460x460/db3e3e/fff/&text=4"/>
        
      <img class="box-1" src="http://placehold.it/460x460/ECD078/fff/&text=1"/>
        <img class="box-1" src="http://placehold.it/460x460/D95B43/fff/&text=1"/>
        <img class="box-2" src="http://placehold.it/620x300/C02942/fff/&text=2"/>
        <img class="box-1" src="http://placehold.it/460x460/542437/fff/&text=1"/>
      <img class="box-1" src="http://placehold.it/460x460/53777A/fff/&text=1"/>
        <img class="box-2" src="http://placehold.it/620x300/F38630/fff/&text=2"/>
      
      <img class="box-2" src="http://placehold.it/620x300/A7DBD8/fff/&text=2"/>
      <img class="box-3" src="http://placehold.it/300x620/69D2E7/161f29/&text=3"/>
        <img class="box-1" src="http://placehold.it/460x460/E0E4CC/fff/&text=1"/>
      <img class="box-1" src="http://placehold.it/460x460/F38630/fff/&text=1"/>
      <img class="box-4" src="http://placehold.it/460x460/db3e3e/fff/&text=4"/>
        
      <img class="box-1" src="http://placehold.it/460x460/ECD078/fff/&text=1"/>
        <img class="box-1" src="http://placehold.it/460x460/D95B43/fff/&text=1"/>
        <img class="box-2" src="http://placehold.it/620x300/C02942/fff/&text=2"/>
        <img class="box-1" src="http://placehold.it/460x460/542437/fff/&text=1"/>
      <img class="box-1" src="http://placehold.it/460x460/53777A/fff/&text=1"/>
        <img class="box-2" src="http://placehold.it/620x300/F38630/fff/&text=2"/>
   
        <div style="clear:both;"></div>
                </div>
  </body>
  


	</div>
</div>


<script type="text/javascript"		>
initT['animInit'] = function(){

$(document).ready(function() {
        $(window).resize(function() {
                var winWidth = $(window).width();
                var parentWidth = $('#big_box').innerWidth();
                 var divider = parentWidth /96 ; 
                   
                    $('#big_box img').css( "margin", divider );
                
            
                if(winWidth < 321) {
                parentWidth = 320;
               $('#big_box').innerWidth('100%');
                $('.box-1').width( divider * 94) ;        //1 column
                $('.box-2').width( divider * 94) ;
                $('.box-3').width( divider * 94) ;
                $('.box-4').width( divider * 94) ;
                } 
                    else if(winWidth < 480) {
                parentWidth = 480;
                      $('#big_box').innerWidth('100%');
                $('.box-1').width(divider * 46).height(divider * 46) ;        //2 col
                $('.box-2').width(divider * 94).height(divider * 46) ;
                $('.box-3').width(divider * 46).height(divider * 94) ;
                $('.box-3').css( "float","left" ) ;
                $('.box-4').width(divider * 94).height(divider * 94) ;
                } 
                    else if(winWidth < 768) {
                parentWidth = 768;
                       $('#big_box').innerWidth(480);
                $('.box-1').width(divider * 30).height(divider * 30) ;        //3 col
                $('.box-2').width(divider * 62).height(divider * 30);
                $('.box-3').width(divider * 30).height(divider * 62);
                $('.box-3:first').css( "float","right" ) ;
                $('.box-4').width(divider * 62).height(divider * 62) ;
                } 
                    else if(winWidth < 1024) {
                parentWidth = 1024;
                      $('#big_box').innerWidth(720);
                $('.box-1').width(divider * 22).height(divider * 22) ;        //4 col
                $('.box-2').width(divider * 46).height(divider * 22) ;
                $('.box-3').width(divider * 46).height(divider * 94) ;
                $('.box-3').css( "float","right" ) ;
                $('.box-4').width(divider * 46).height(divider * 46) ;
                        
                }
                    else if(winWidth < 1224) {
                parentWidth = 1224;
                      $('#big_box').innerWidth(960);
                $('.box-1').width(divider * 14).height(divider * 14);        //6 col
                $('.box-2').width(divider * 30).height(divider * 14) ;
                $('.box-2:first').width(divider * 62).height(divider * 30) ;
                $('#big_box img:nth-child(12)').width(divider * 62).height(divider * 30) ;
                $('#big_box img:nth-child(23)').width(divider * 62).height(divider * 30) ;
                $('.box-3').width(divider * 14).height(divider * 30) ;
                $('.box-3').css( "float","left" ) ;
                $('.box-4').width(divider * 30).height(divider * 30) ;
                }
                    else {
				parentWidth = 1824;
                             
				};
            });
	$(window).trigger('resize');
});


  
};
</script>