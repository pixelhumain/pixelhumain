<style>
@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700,800);

html, body
{
  height: 100%;
  margin: 0;
}
.img
{
  position: relative;
  height: 100%;
  /* attr data-type doesn't work anywhere for the moment :( */
  /* Even in chrome canary */
  /* So we do it the JS way */
  background-image: attr(data-img url); /* Keep it anyway */
  background-attachment: fixed;
  background-size: cover;
  background-position: center;
  border-bottom: 3px solid white;
  text-align: center;
  font-family: 'Open Sans', sans-serif;
  font-size: 28px;
  font-weight: bold;
  letter-spacing: -2px;
  color: rgba(255,255,255,0.7);
  text-stroke: 2px rgba(0,0,0,0.7);
  cursor: default;
}
.img:last-of-type
{
  border-bottom: none;
}
.img:before
{
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
}
.multiline
{
  display: inline-block;
}
.max
{
  display: block;
  font-size: 60px;
  letter-spacing: 1px;
}
.img .permalink
{
  position: absolute;
  right: 0;
  top: 0;
  width: 16px;
  height: 16px;
  background: url(http://i.imgur.com/wdQCy4F.png) center no-repeat;
  opacity: .2;
  transition: opacity .5s;
}
.img .permalink:hover
{
  opacity: 1;
}
</style>

<div id="image1" class="img" data-img="http://25.media.tumblr.com/tumblr_mef6quv5pq1qi1a91o1_1280.jpg"><span class="multiline"><span class="max">SCROLL DOWN</span>Or just use the left and right arrows</span></div>
<div id="image2" class="img" data-img="http://25.media.tumblr.com/tumblr_mef66y4dyg1qi1a91o1_1280.jpg"></div>
<div id="image3" class="img" data-img="http://24.media.tumblr.com/tumblr_mef649hlGH1qi1a91o1_1280.jpg"></div>
<div id="image4" class="img" data-img="http://24.media.tumblr.com/tumblr_mdji3d4gz01qi1a91o1_1280.jpg">dghdfghdh</div>
<div id="image5" class="img" data-img="http://25.media.tumblr.com/tumblr_m8wu1hCEFE1qi1a91o1_1280.jpg">gdhfghdfghdfghdfgh</div>
<div id="image6" class="img" data-img="http://24.media.tumblr.com/tumblr_m7x6dwKcdy1qi1a91o1_1280.jpg">
  jdfjdofjdfojdfoj
  
</div>
<div id="image7" class="img" data-img="http://24.media.tumblr.com/tumblr_macu73Re0K1qi1a91o1_1280.jpg"></div>
<div id="image8" class="img" data-img="http://24.media.tumblr.com/tumblr_m5978ffta31qi1a91o1_1280.jpg"></div>
<div id="image9" class="img" data-img="http://25.media.tumblr.com/tumblr_m3yu2f2rld1qi1a91o1_1280.jpg"></div>

<script type="text/javascript"		>
initT['animInit'] = function(){

	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//
//  Inspired by http://codepen.io/dropside/pen/bxhke  //
//  Images from http://certaine.tumblr.com/           //
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//

$(document).ready(function(){
  var isWebkit = navigator && navigator.userAgent.match(/webkit/i);
  var $root = $(isWebkit ? 'body' : 'html');
  var elements = $('div'), elcount = elements.length;
  var scrolling = false;
  // Replacing the CSS attr(... url)
  elements.css('background-image', function(i){
    return 'url('+$(this).data('img')+')';
  });
  //Add permalinks
  elements.each(function(i){
    var $t = $(this);
    var id = $t.attr('id');
    if(!id) return;
    $('<a>').addClass('permalink')
            .attr('href', '#'+id)
            .appendTo($t);
  });
  $root.keydown(function(e){
    if(e.keyCode != 37 && e.keyCode != 39) return;
    var current = scrolling || 0;
    if(scrolling === false)
    {
      var bsT = $root.scrollTop(), t;
      while(current < elcount && (t = elements.eq(current).offset().top) < bsT)
        current++;
    }
    if(e.keyCode == 37) current--;
    else if(scrolling !== false || t == bsT) current++;
    current = (current + elcount) % elcount;
    $root.stop().animate({scrollTop: elements.eq(current).offset().top}, function(){scrolling = false;});
    scrolling = current;
  });
});
	
};
</script>