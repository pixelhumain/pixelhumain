<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/TweenMax.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/d3.min.js' , CClientScript::POS_END);
$this->pageTitle=Yii::app()->name . ' - Graph representation des pixels actifs distribué par Code Postal';
?>

<style>
.graph{
font-family: "Homestead";
}
h2 {
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}

.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

.bar {
  fill: steelblue;
}

.x.axis path {
  display: none;
}
.graph{
z-index:0;
}
#graphBody{
	position:relative;
	z-index:10000;
	height:500px;
}
</style>


<div class="container graph">
    <br/>
    <div class="hero-unit">
        <h2>Graph des pixels actifs par Code Postal(974) </h2>
        
		<p>Simulation de l'activité Pixel Humain Local</p>
		
		<div id="graphBody"></div>
		
		<div class="clear"></div>
  </div>
</div>


<script type="text/javascript">
initT['animError'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
})();

var margin = {top: 20, right: 20, bottom: 30, left: 40},
width = 960 - margin.left - margin.right,
height = 500 - margin.top - margin.bottom;

var formatPercent = d3.format(".0%");

var x = d3.scale.ordinal()
.rangeRoundBands([0, width], .1);

var y = d3.scale.linear()
.range([height, 0]);

var xAxis = d3.svg.axis()
.scale(x)
.orient("bottom");

var yAxis = d3.svg.axis()
.scale(y)
.orient("left")
.tickFormat(formatPercent);

var svg = d3.select("#graphBody").append("svg")
.attr("width", width + margin.left + margin.right)
.attr("height", height + margin.top + margin.bottom)
.append("g")
.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

d3.tsv("/ph/js/data.tsv", type, function(error, data) {
x.domain(data.map(function(d) { return d.letter; }));
y.domain([0, d3.max(data, function(d) { return d.frequency; })]);

svg.append("g")
  .attr("class", "x axis")
  .attr("transform", "translate(0," + height + ")")
  .call(xAxis);

svg.append("g")
  .attr("class", "y axis")
  .call(yAxis)
.append("text")
  .attr("transform", "rotate(-90)")
  .attr("y", 6)
  .attr("dy", ".71em")
  .style("text-anchor", "end")
  .text("Nombres Pixel Actifs");

svg.selectAll(".bar")
  .data(data)
.enter().append("rect")
  .attr("class", "bar")
  .attr("x", function(d) { return x(d.letter); })
  .attr("width", x.rangeBand())
  .attr("y", function(d) { return y(d.frequency); })
  .attr("height", function(d) { return height - y(d.frequency); });

});


};
function type(d) {
d.frequency = +d.frequency;
return d;
}
</script>