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

circle {
  fill: rgb(31, 119, 180);
  fill-opacity: .25;
  stroke: rgb(31, 119, 180);
  stroke-width: 1px;
}

.leaf circle {
  fill: #ff7f0e;
  fill-opacity: 1;
}

text {
  font: 10px sans-serif;
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
var diameter = 960,
format = d3.format(",d");

var pack = d3.layout.pack()
.size([diameter - 4, diameter - 4])
.value(function(d) { return d.size; });

var svgraph = d3.select("body").append("svg")
.attr("width", diameter)
.attr("height", diameter)
.append("g")
.attr("transform", "translate(2,2)");

d3.json("/ph/js/flare.json", function(error, root) {
var node = svgraph.datum(root).selectAll(".node")
  .data(pack.nodes)
.enter().append("g")
  .attr("class", function(d) { return d.children ? "node" : "leaf node"; })
  .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

node.append("title")
  .text(function(d) { return d.name + (d.children ? "" : ": " + format(d.size)); });

node.append("circle")
  .attr("r", function(d) { return d.r; });

node.filter(function(d) { return !d.children; }).append("text")
  .attr("dy", ".3em")
  .style("text-anchor", "middle")
  .text(function(d) { return d.name.substring(0, d.r / 3); });
});

d3.select(self.frameElement).style("height", diameter + "px");

};
</script>