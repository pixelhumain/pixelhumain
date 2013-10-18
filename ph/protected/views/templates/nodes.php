<?php 
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile('http://d3js.org/d3.v3.min.js' , CClientScript::POS_END);
?>
<style>
body {
	overflow: hidden;
}

.node {
  stroke: #fff;
  stroke-width: 1.5px;
}

.link {
  stroke: #999;
  stroke-opacity: .6;
}
.graph{
z-index:0;
}
#graphSVG{
	position:relative;
	z-index:10000;
	height:1000px;
}
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    	<div id=graphSVG></div>
	</div>
</div>
    
<script type="text/javascript"		>
var miserables = {
		  "nodes":[
		    {"name":"Myriel","group":1},
		    {"name":"Napoleon","group":2},
		    {"name":"Mlle.Baptistine","group":3},
		    {"name":"Mlle.Baptistine","group":3},
		    {"name":"Mlle.Baptistine","group":3}
		     
		  ],
		  "links":[
		    {"source":1,"target":0,"value":10},
		    {"source":2,"target":1,"value":20},
		    {"source":2,"target":0,"value":20},
		    {"source":3,"target":0,"value":20},
		    {"source":3,"target":4,"value":20}
		  ]
		}
initT['animInit'] = function(){
	var width = 960,
	    height = 500;

	var color = d3.scale.category20();

	var force = d3.layout.force()
	    .charge(-600)
	    .linkDistance(200)
	    .size([width, height]);

	var svgTag = d3.select("#graphSVG").append("svg")
	    .attr("width", width)
	    .attr("height", height);


	  force.nodes(miserables.nodes)
	      .links(miserables.links)
	      .start();

	  var link = svgTag.selectAll(".link")
	      .data(miserables.links)
	    .enter().append("line")
	      .attr("class", "link")
	      .style("stroke-width", function(d) { return Math.sqrt(d.value); });
	 
	  var node = svgTag.selectAll(".node")
	      .data(miserables.nodes)
	    .enter().append("circle")
	      .attr({
	        "r": 30,
	        "class":"node"
	      })
	      .style("fill", function(d) { return color(d.group); })
	      .call(force.drag); 

	  node.append("text") 
	      .text(function(d) { return d.name; });
	 
	  force.on("tick", function() {
	    link.attr("x1", function(d) { return d.source.x; })
	        .attr("y1", function(d) { return d.source.y; })
	        .attr("x2", function(d) { return d.target.x; })
	        .attr("y2", function(d) { return d.target.y; });
	 
	    node.attr("cx", function(d) { return d.x; }) 
	        .attr("cy", function(d) { return d.y; }); 
	  });
	

  
};
</script>