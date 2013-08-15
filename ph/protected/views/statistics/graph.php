<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/d3.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/d3.layout.js' , CClientScript::POS_END);
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

.chart {
  position : relative;
  top:0px;
  left:0px;
  display: block;
  margin: auto;
  margin-top: 60px;
  font-size: 11px;
}

rect {
  stroke: #eee;
  fill: #aaa;
  fill-opacity: .8;
}

rect.parent {
  cursor: pointer;
  fill: steelblue;
}

text {
  pointer-events: none;
}
</style>

<div class="container">
    <br/>
    <!-- Main hero unit for a primary marketing message or call to action -->
    
        <h2>Graph des pixels actifs par Code Postal</h2>
        
  
        <div id="graphBody">
          <div id="footer">
            d3.layout.partition
            <div class="hint">click or option-click to descend or ascend</div>
          </div>
        </div>

        <br/><br/>
  
</div>

<script type="text/javascript">
initT['animError'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);

	  var w = 1120,
	      h = 600,
	      x = d3.scale.linear().range([0, w]),
	      y = d3.scale.linear().range([0, h]);

	  var vis = d3.select("#graphBody").append("div")
	      .attr("class", "chart")
	      .style("width", w + "px")
	      .style("height", h + "px")
	    .append("svg:svg")
	      .attr("width", w)
	      .attr("height", h);

	  var partition = d3.layout.partition()
	      .value(function(d) { return d.size; });

	  d3.json("/ph/js/flare.json", function(root) {
	    var g = vis.selectAll("g")
	        .data(partition.nodes(root))
	      .enter().append("svg:g")
	        .attr("transform", function(d) { return "translate(" + x(d.y) + "," + y(d.x) + ")"; })
	        .on("click", click);

	    var kx = w / root.dx,
	        ky = h / 1;

	    g.append("svg:rect")
	        .attr("width", root.dy * kx)
	        .attr("height", function(d) { return d.dx * ky; })
	        .attr("class", function(d) { return d.children ? "parent" : "child"; });

	    g.append("svg:text")
	        .attr("transform", transform)
	        .attr("dy", ".35em")
	        .style("opacity", function(d) { return d.dx * ky > 12 ? 1 : 0; })
	        .text(function(d) { return d.name; })

	    d3.select(window)
	        .on("click", function() { click(root); })

	    function click(d) {
	      if (!d.children) return;

	      kx = (d.y ? w - 40 : w) / (1 - d.y);
	      ky = h / d.dx;
	      x.domain([d.y, 1]).range([d.y ? 40 : 0, w]);
	      y.domain([d.x, d.x + d.dx]);

	      var t = g.transition()
	          .duration(d3.event.altKey ? 7500 : 750)
	          .attr("transform", function(d) { return "translate(" + x(d.y) + "," + y(d.x) + ")"; });

	      t.select("rect")
	          .attr("width", d.dy * kx)
	          .attr("height", function(d) { return d.dx * ky; });

	      t.select("text")
	          .attr("transform", transform)
	          .style("opacity", function(d) { return d.dx * ky > 12 ? 1 : 0; });

	      d3.event.stopPropagation();
	    }

	    function transform(d) {
	      return "translate(8," + d.dx * ky / 2 + ")";
	    }
	  });
	})();
};
</script>