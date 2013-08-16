<?php
$this->pageTitle=Yii::app()->name . ' - Graph representation des pixels actifs distribué par Code Postal';
?>

<style>
.container{
font-family: "Homestead";
}
h2 {
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}
</style>


<div class="container">
    <br/>
    <div class="hero-unit">
        <h2>Graph des pixels actifs par Métier</h2>
        
  
        <div id="graphBody">
        </div>
        <br/><br/>
  </div>
</div>

<script type="text/javascript">
initT['animError'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
})();

var w = 500,
h = 500;

var vertices = d3.range(2000).map(function(d) {
  return [Math.random() * w, Math.random() * h];
});

var delaunay = d3.geom.delaunay(vertices);

var svg = d3.select("graphBody")
      //.attr("width", "100%")
      //.attr("height", "100%")
      .attr("preserveAspectRatio", "xMidYMid slice")
		//.attr("width", w)
		//.attr("height", h)
    .attr("viewBox", [0, 0, w, h].join(' '))

    svg.append("g")
  .selectAll("path")
    .data(delaunay)
  .enter().append("path")
    .attr("class", function(d, i) { return "q" + (i % 9) + "-9"; })
    .attr("d", function(d) { return "M" + d.join("L") + "Z"; });

};
</script>