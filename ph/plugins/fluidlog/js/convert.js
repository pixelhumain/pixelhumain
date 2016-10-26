FluidGraph.prototype.d3DataToJsonD3 = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("d3DataToJsonD3 start");

  var saveEdges = [];
  thisGraph.d3data.edges.forEach(function(edge, i){
    saveEdges.push({source: edge.source.id, target: edge.target.id, type: edge.type});
  });

  var jsonD3Object = {"name" : thisGraph.graphName, "nodes": thisGraph.d3data.nodes, "edges": saveEdges};
  var jsonD3 = window.JSON.stringify(jsonD3Object);

  if (thisGraph.config.debug) console.log("d3DataToJsonD3 end");

  return jsonD3;
}

FluidGraph.prototype.d3DataToJsonLd = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("d3DataToJsonLd start");

  var saveNodes = [];
  var saveEdges = [];
  thisGraph.d3data.nodes.forEach(function(node, i){
    var nodeObject = {"@id": node.identifier,
                      "@type": "av:"+node.type,
                      "index": node.id.toString(),
                      "label": node.label,
                      "x": node.x.toString(),
                      "y": node.y.toString()}
    saveNodes.push(nodeObject);
  });
  thisGraph.d3data.edges.forEach(function(edge, i){
    var edgeObject = {  source: saveNodes[edge.source.id]["@id"],
                        target: saveNodes[edge.target.id]["@id"]};
    saveEdges.push(edgeObject);
  });

  var urlNameGraph = encodeURIComponent(thisGraph.graphName)
  var jsonD3Object = { // "@id" : thisGraph.config.uriSemFormsBase+urlNameGraph,
                "@context" : "http://owl.openinitiative.com/oicontext.jsonld",
                "nodes": saveNodes,
                "edges": saveEdges};

  // var jsonLd = window.JSON.stringify(jsonD3Object);
  var jsonLd = jsonD3Object;

  if (thisGraph.config.debug) console.log("d3DataToJsonLd end");

  return jsonLd;
}

FluidGraph.prototype.jsonD3ToD3Data = function(jsonInput) {
  thisGraph = this;
  if (thisGraph.config.debug) console.log("jsonGraphToData start");

  var d3data = {};
  var jsonObj = JSON.parse(jsonInput);
  thisGraph.GraphName = jsonObj.name;
  d3data.nodes = jsonObj.nodes;

  var newEdges = jsonObj.edges;
  newEdges.forEach(function(e, i){
    newEdges[i] = {source: d3data.nodes.filter(function(n){return n.id == e.source;})[0],
                target: d3data.nodes.filter(function(n){return n.id == e.target;})[0],
                type: e.type
              };
  });
  d3data.edges = newEdges;

  if (thisGraph.config.debug) console.log("jsonGraphToData end");

  return d3data;
}
