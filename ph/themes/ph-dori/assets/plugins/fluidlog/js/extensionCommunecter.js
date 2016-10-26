//wrap the first function defined in mygraph.js  displayExternalGraph... for communecter

FluidGraph.prototype.displayExternalGraph = function(d3node, d) {
  thisGraph = this;
  if (thisGraph.config.debug) console.log("displayExternGraph start");

  d3.event.stopPropagation();

  externalUri = baseUrl+"/communecter/graph/viewer/id/"+d.identifier+"/type/"+d.type+"/data/1";

  thisGraph.phData = thisGraph.getExternalD3Data(externalUri);

  thisGraph.d3data = createFluidGraph(d.type, d.identifier, thisGraph.phData);
  thisGraph.resetMouseVars();
  thisGraph.removeSvgElements();
  thisGraph.initDragLine();
  thisGraph.activateForce();
  thisGraph.drawGraph();

  if (thisGraph.config.debug) console.log("displayExternGraph end");
}
