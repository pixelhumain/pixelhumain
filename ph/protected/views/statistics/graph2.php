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

.node {
  border: solid 1px white;
  font: 10px sans-serif;
  line-height: 12px;
  overflow: hidden;
  position: absolute;
  text-indent: 2px;
}

</style>


<div class="container">
    <br/>
    <div class="hero-unit">
        <h2>Graph des pixels actifs par Code Postal</h2>
        
  
        <div id="graphBody">
        </div>
<form>
  <label><input type="radio" name="mode" value="size" checked> Size</label>
  <label><input type="radio" name="mode" value="count"> Count</label>
</form>
        <br/><br/>
  </div>
</div>

<script type="text/javascript">
initT['animError'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
})();
var margin = {top: 40, right: 10, bottom: 10, left: 10},
width = 960 - margin.left - margin.right,
height = 500 - margin.top - margin.bottom;

var color = d3.scale.category20c();

var treemap = d3.layout.treemap()
.size([width, height])
.sticky(true)
.value(function(d) { return d.size; });

var div = d3.select("#graphBody").append("div")
.style("position", "relative")
.style("width", (width + margin.left + margin.right) + "px")
.style("height", (height + margin.top + margin.bottom) + "px")
.style("left", margin.left + "px")
.style("top", margin.top + "px");

d3.json("/ph/js/flare.json", function(error, root) {
var node = div.datum(root).selectAll(".node")
  .data(treemap.nodes)
.enter().append("div")
  .attr("class", "node")
  .call(position)
  .style("background", function(d) { return d.children ? color(d.name) : null; })
  .text(function(d) { return d.children ? null : d.name; });

d3.selectAll("input").on("change", function change() {
var value = this.value === "count"
    ? function() { return 1; }
    : function(d) { return d.size; };

node
    .data(treemap.value(value).nodes)
  .transition()
    .duration(1500)
    .call(position);
});
});

function position() {
this.style("left", function(d) { return d.x + "px"; })
  .style("top", function(d) { return d.y + "px"; })
  .style("width", function(d) { return Math.max(0, d.dx - 1) + "px"; })
  .style("height", function(d) { return Math.max(0, d.dy - 1) + "px"; });
}
};
</script>