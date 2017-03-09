<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/d3/3.3.10/d3.min.js' , CClientScript::POS_END); //for javascript external files onloading
//http://codepen.io/AmeliaBR/pen/Kvlxk
?>

<!-- BLOCK CSS -->
<style>

.link { 
    fill: none;
    stroke: #666;
    stroke-width: 1.5px;
}
circle {
    fill: #ccc;
    stroke: #333;
    stroke-width: 1.5px;
}
text {
    text-baseline:middle;
    text-anchor:middle;
    font: 10px sans-serif;
    /*pointer-events: none;*/
    text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, 0 -1px 0 #fff, -1px 0 0 #fff;
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

<!-- BLOCK HTML  -->

<div class="container graph">
    <br/>
    <div class="hero-unit">

<div id="graphBody"></div>


	</div>
</div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){
	var width = 1000,
    height = 1000;

var force = d3.layout.force()
    .size([width, height])
    .linkDistance(60)
    .charge(-300)
    .gravity(0.2)
    .on("tick", tick);

var svg = d3.select("graphBody").append("svg")
    .attr("width", width)
    .attr("height", height)
    .style("border", "1px solid black");

var path = svg.append("g").selectAll("path"),
    circle = svg.append("g").selectAll("circle"),
    text = svg.append("g").selectAll("text");

var marker = svg.append("defs").append("marker")
        .attr("id", "arrow")
        .attr("viewBox", "0 -5 10 10")
        .attr("refX", 15)
        .attr("refY", -1.5)
        .attr("markerWidth", 6)
        .attr("markerHeight", 6)
        .attr("orient", "auto")
     .append("path") 
        .attr("d", "M0,-5L10,0L0,5"); 

var data = getData();
var nodes = data.nodes;
var links = data.links;

update(links);

function update(links) {
    // Compute the distinct nodes from the links.
    links.forEach(function (link) {
        link.source = nodes[link.source];
        link.target = nodes[link.target];
    });

    force.nodes(nodes)
        .links(links)
        .start();

    // -------------------------------

    // Compute the data join. This returns the update selection.
    path = path.data(force.links());

    // Remove any outgoing/old paths.
    path.exit().remove();

    // Compute new attributes for entering and updating paths.
    path.enter().append("path")
        .attr("class", "link")
        .style("stroke", function (d) {
            return d3.rgb(5*d.value, 200+d.value, 127-2*d.value);
         })
        .attr("marker-end", "url(#arrow)");
  
    // -------------------------------

    // Compute the data join. This returns the update selection.
    circle = circle.data(force.nodes());

    // Add any incoming circles.
    circle.enter().append("circle");

    // Remove any outgoing/old circles.
    circle.exit().remove();

    // Compute new attributes for entering and updating circles.
    circle.attr("r", 6)
        .attr("title", function(d){return d.name})
        .call(force.drag);


    // Compute the data join. This returns the update selection.
    text = text.data(force.nodes());

    // Add any incoming texts.
    text.enter().append("text");

    // Remove any outgoing/old texts.
    text.exit().remove();

    // Compute new attributes for entering and updating texts.
    text.attr("x", 8)
        .attr("y", ".31em")
        .text(function (d) {
        return d.name;
    });
}

// Use elliptical arc path segments to doubly-encode directionality.
function tick() {
    path.attr("d", linkArc);
    circle.attr("transform", transform);
    text.attr("transform", transform);
}

function linkArc(d) {
    var dx = d.target.x - d.source.x,
        dy = d.target.y - d.source.y,
        dr = Math.sqrt(dx * dx + dy * dy);
    return "M" + d.source.x + "," + d.source.y + "A" + dr + "," + dr + " 0 0,1 " + d.target.x + "," + d.target.y;
}

function transform(d) {
    return "translate(" + d.x + "," + d.y + ")";
}


function getData() {
    return {"nodes":[{"name":"1011101"},{"name":"112176121201"},{"name":"112176121205"},{"name":"112176121207"},{"name":"112176121211"},{"name":"10111016"},{"name":"103715"},{"name":"1013112"},{"name":"2161977265"},{"name":"512512029"},{"name":"10131830"},{"name":"15755133206"},{"name":"15756107158"},{"name":"6555138158"},{"name":"1013228156"},{"name":"17325211027"},{"name":"101322881"},{"name":"51195213199"},{"name":"51217228210"},{"name":"1013232129"},{"name":"17631180173"},{"name":"51217211178"},{"name":"1013232220"},{"name":"161691320"},{"name":"655519293"},{"name":"8211616"},{"name":"10132329"},{"name":"10816817082"},{"name":"2062078167"},{"name":"101710921"},{"name":"10171615"},{"name":"7112522121"},{"name":"767112860"},{"name":"1017172"},{"name":"10171737"},{"name":"501820111"},{"name":"1017186"},{"name":"1017228203"},{"name":"51228210221"},{"name":"791257132"},{"name":"101723218"},{"name":"1731911337"},{"name":"1992776185"},{"name":"20712316126"},{"name":"6121525580"},{"name":"62212831"},{"name":"66251100192"},{"name":"6916120216"},{"name":"9318121690"},{"name":"10191119"},{"name":"1019228101"},{"name":"11217712"},{"name":"101922827"},{"name":"1019983"},{"name":"1021101"},{"name":"137135212181"},{"name":"7111911887"},{"name":"10211022"},{"name":"10211322"},{"name":"102123282"},{"name":"1072017223"},{"name":"10721121191"},{"name":"1072120695"},{"name":"10721237215"},{"name":"10722216218"},{"name":"232116135"},{"name":"232116820"},{"name":"232117911"},{"name":"232117980"},{"name":"232117998"},{"name":"232120365"},{"name":"2321213201"},{"name":"2321237118"},{"name":"232315971"},{"name":"501981226"},{"name":"10301026"},{"name":"1030981"},{"name":"15755133201"},{"name":"51209150252"},{"name":"103610323"},{"name":"1037228158"},{"name":"1037228182"},{"name":"1037228187"},{"name":"1111682183"},{"name":"237818179"},{"name":"1037228192"},{"name":"106910129"},{"name":"1069117"},{"name":"2085017021"},{"name":"31137133"},{"name":"692821350"},{"name":"10691222"},{"name":"106912330"},{"name":"2331197163"},{"name":"597200"},{"name":"10691311"},{"name":"6131231235"},{"name":"106913222"},{"name":"10691332"},{"name":"6275138232"},{"name":"9612611653"},{"name":"10691611"},{"name":"1069221100"},{"name":"13713516875"},{"name":"51228210163"},{"name":"1069221169"},{"name":"23231111"},{"name":"501718395"},{"name":"106922181"},{"name":"10720113205"},{"name":"107212027"},{"name":"10721225131"},{"name":"1072196207"},{"name":"1763128131"},{"name":"18173161236"},{"name":"18173193172"},{"name":"18173209155"},{"name":"2321170103"},{"name":"2321223235"},{"name":"2323129216"},{"name":"2323231103"},{"name":"232397189"},{"name":"5016192111"},{"name":"1069232138"},{"name":"10922861"},{"name":"176311873"},{"name":"5122820719"},{"name":"109232115"},{"name":"50112101217"},{"name":"51211213193"},{"name":"51211213202"},{"name":"109317"},{"name":"106912"},{"name":"109513"},{"name":"109325"},{"name":"20717911119"},{"name":"192168111"},{"name":"2131367010"},{"name":"192168110"},{"name":"216218117189"},{"name":"617058139"},{"name":"6323631225"},{"name":"68232199157"},{"name":"68232199158"},{"name":"68232199159"},{"name":"9319111798"}],"links":[{"source":0,"target":1,"value":1},{"source":0,"target":2,"value":1},{"source":0,"target":3,"value":1},{"source":0,"target":4,"value":1},{"source":5,"target":6,"value":4},{"source":7,"target":8,"value":1},{"source":7,"target":9,"value":1},{"source":10,"target":11,"value":1},{"source":10,"target":12,"value":1},{"source":10,"target":13,"value":1},{"source":14,"target":15,"value":1},{"source":16,"target":17,"value":1},{"source":16,"target":18,"value":1},{"source":19,"target":20,"value":1},{"source":19,"target":21,"value":1},{"source":22,"target":23,"value":1},{"source":22,"target":24,"value":1},{"source":22,"target":25,"value":1},{"source":26,"target":27,"value":1},{"source":26,"target":28,"value":1},{"source":29,"target":6,"value":17},{"source":30,"target":31,"value":1},{"source":30,"target":32,"value":1},{"source":33,"target":6,"value":8},{"source":34,"target":35,"value":1},{"source":36,"target":6,"value":1},{"source":37,"target":38,"value":1},{"source":37,"target":39,"value":1},{"source":40,"target":41,"value":1},{"source":40,"target":42,"value":1},{"source":40,"target":43,"value":1},{"source":40,"target":44,"value":1},{"source":40,"target":45,"value":2},{"source":40,"target":46,"value":1},{"source":40,"target":47,"value":1},{"source":40,"target":48,"value":5},{"source":49,"target":35,"value":1},{"source":50,"target":51,"value":2},{"source":52,"target":15,"value":1},{"source":53,"target":6,"value":3},{"source":54,"target":55,"value":1},{"source":54,"target":56,"value":1},{"source":57,"target":6,"value":2},{"source":58,"target":6,"value":183},{"source":59,"target":60,"value":1},{"source":59,"target":61,"value":1},{"source":59,"target":62,"value":1},{"source":59,"target":63,"value":1},{"source":59,"target":64,"value":1},{"source":59,"target":65,"value":1},{"source":59,"target":66,"value":1},{"source":59,"target":67,"value":1},{"source":59,"target":68,"value":1},{"source":59,"target":69,"value":1},{"source":59,"target":70,"value":1},{"source":59,"target":71,"value":1},{"source":59,"target":72,"value":1},{"source":59,"target":73,"value":1},{"source":59,"target":74,"value":1},{"source":75,"target":15,"value":1},{"source":76,"target":77,"value":1},{"source":76,"target":78,"value":1},{"source":79,"target":6,"value":2},{"source":80,"target":51,"value":2},{"source":81,"target":51,"value":2},{"source":82,"target":83,"value":1},{"source":82,"target":84,"value":1},{"source":85,"target":51,"value":1},{"source":86,"target":6,"value":76},{"source":87,"target":88,"value":1},{"source":87,"target":89,"value":1},{"source":87,"target":90,"value":3},{"source":91,"target":6,"value":5},{"source":92,"target":93,"value":1},{"source":92,"target":94,"value":1},{"source":95,"target":6,"value":3},{"source":95,"target":96,"value":1},{"source":97,"target":6,"value":3},{"source":98,"target":99,"value":1},{"source":98,"target":100,"value":1},{"source":101,"target":6,"value":1},{"source":102,"target":103,"value":1},{"source":102,"target":104,"value":1},{"source":105,"target":106,"value":1},{"source":105,"target":107,"value":1},{"source":108,"target":109,"value":1},{"source":108,"target":110,"value":1},{"source":108,"target":111,"value":1},{"source":108,"target":112,"value":1},{"source":108,"target":113,"value":1},{"source":108,"target":114,"value":1},{"source":108,"target":115,"value":1},{"source":108,"target":116,"value":1},{"source":108,"target":117,"value":1},{"source":108,"target":118,"value":1},{"source":108,"target":119,"value":1},{"source":108,"target":120,"value":1},{"source":108,"target":121,"value":1},{"source":108,"target":122,"value":1},{"source":123,"target":51,"value":2},{"source":124,"target":125,"value":1},{"source":124,"target":126,"value":1},{"source":127,"target":128,"value":1},{"source":127,"target":129,"value":1},{"source":127,"target":130,"value":1},{"source":131,"target":132,"value":1},{"source":131,"target":133,"value":1},{"source":134,"target":135,"value":4},{"source":136,"target":135,"value":1},{"source":135,"target":134,"value":4},{"source":135,"target":136,"value":1},{"source":137,"target":138,"value":9},{"source":139,"target":138,"value":2},{"source":140,"target":136,"value":1},{"source":141,"target":138,"value":1},{"source":142,"target":136,"value":1},{"source":143,"target":136,"value":1},{"source":144,"target":136,"value":1},{"source":145,"target":136,"value":1}],"records":119};
}
  
};
</script>