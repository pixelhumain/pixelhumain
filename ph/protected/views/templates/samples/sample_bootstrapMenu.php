<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/styles.css');
$cs->registerScriptFile('http://' , CClientScript::POS_END);
?>
<style>

</style>
<div class="span3 bs-docs-sidebar pull-left" >
<ul class="nav nav-list bs-docs-sidenav affix-top">
  <li class="active"><a href="#faq1"><i class="icon-chevron-right"></i> Dropdowns</a></li>
  <li class=""><a href="#faq2"><i class="icon-chevron-right"></i> Button groups</a></li>
  <li class=""><a href="#faq8"><i class="icon-chevron-right"></i> Button dropdowns</a></li>
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
<div class="container graph">
    <br/>
    <div class="hero-unit">



	</div>
</div>


<script type="text/javascript"		>
initT['animInit'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},0.3);
})();

  
};
</script>