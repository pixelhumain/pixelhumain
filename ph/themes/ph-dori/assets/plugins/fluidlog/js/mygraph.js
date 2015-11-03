function menuInitialisation(myGraph) {

  if (myGraph.config.debug) console.log("checkboxInitialisation start");

  $('#focusContextNodeOff').hide();

  if (myGraph.config.curvesLinks == 'On')
    $('#curvesLinksCheckbox').checkbox('check');
  else
    $('#curvesLinksCheckbox').checkbox('uncheck');

  if (myGraph.config.openNodeOnHover == 'On')
    $('#openNodeOnHoverCheckbox').checkbox('check');
  else
    $('#openNodeOnHoverCheckbox').checkbox('uncheck');

  if (myGraph.config.force == 'On')
    $('#activeForceCheckbox').checkbox('check');
  else
    $('#activeForceCheckbox').checkbox('uncheck');

  if (myGraph.config.elastic == 'On')
    $('#activeElasticCheckbox').checkbox('check');
  else
    $('#activeElasticCheckbox').checkbox('uncheck');

  if (myGraph.config.displayId == 'On')
    $('#displayIdCheckbox').checkbox('check');
  else
    $('#displayIdCheckbox').checkbox('uncheck');

  if (myGraph.config.debug) console.log("checkboxInitialisation end");
}

// define graph object
var FluidGraph = function (firstBgElement,d3data){
  /*
  *
  *           Initialisation
  *
  ****************************/

  //Help to assure that it's the "this" of myGraph object
  var thisGraph = this;

  thisGraph.config = {
    backgroundColor : "#EEE",
    xNewNode : 200,
    yNewNode : 100,
    bgElementType : "panzoom", //choixe : "panzoom" or "simple"
    force : "Off",
    elastic : "Off",
    curvesLinks : "On",
    openNodeOnHover : "Off",
    displayId : "Off",
    proportionalNodeSize : "On",
    uriBase : "http://fluidlog.com/", //Warning : with LDP, no uriBase... :-)
    // Rwwplay : "https://localhost:8443/2013/fluidlog/",
    // SemForms : "http://localhost:9000/ldp/fluidlog/",
    uriExternalStore : "http://localhost:9000/ldp/fluidlog/",
    linkDistance : 100,
    charge : -1000,
    debug : false,
    version : "loglink46",
    newGraphName : "Untilted",
    bringNodeToFrontOnHover : false,
    repulseNeighbourOnHover : false,
    awsomeStrokeNode : true,
    remindSelectedNodeOnSave : true,
    editGraphMode : true, // default : true
  };

  thisGraph.customNodes = {
    strokeColor : "#CCC",
    strokeWidth : "10px",
    strokeOpacity : .5,
    listType : ["without", "project","actor","idea","ressource"],
    colorType : {"project" : "#89A5E5",
                  "actor" : "#F285B9",
                  "idea" : "#FFD98D",
                  "ressource" : "#CDF989",
                  "without" : "#999",
                  "gray" : "gray"},
    typeOfNewNode : "without",
  	colorTypeRgba : {"project" : "137,165,229",
                      "actor" : "242,133,185",
                      "idea" : "255,217,141",
                      "ressource" : "205,249,137",
                      "without" : "255,255,255",
                      "gray" : "200,200,200"},
    imageType : {"project" : "lab", "actor" : "user", "idea" : "idea", "ressource" : "tree", "without" : "circle thin"},
    displayType : true,
    displayText : true,
    cursor : "move", //Value : grab or move (default), pointer, context-menu, text, crosshair, default
    cursorOpen : "default", //Value : grab or move (default), pointer, context-menu, text, crosshair, default
    widthClosed : 50,
		heightClosed : 50,
    maxRadius : 40,
    widthOpened : 160,
    heightOpened : 230,
    heightOpenedNeighbour : 30,
    heightOpenedTopMax : 50,
    heightOpenedBottomMax : 25,
    heightOpenedNeighboursMax : 200,
    widthEdited : 200,
		heightEdited : 200,
    curvesCornersClosedNode : 50,
    curvesCornersOpenedNode : 20,
		widthStrokeHover : 20,
		transitionEasing : "elastic", //Values : linear (default), elastic
    transitionDurationOpen : 300,
    transitionDurationEdit : 1000,
		transitionDurationClose : 300,
		transitionDelay : 0,
    blankNodeLabel : "New...",
    blankNodeType : "without",
  }

  if (thisGraph.config.awsomeStrokeNode == true)
  {
    thisGraph.customNodes.strokeColorType = {"project" : "#CCC",
                  "actor" : "#CCC",
                  "idea" : "#CCC",
                  "ressource" : "#CCC",
                  "without" : "#CCC"}
  }
  else {
    thisGraph.customNodes.strokeColorType = {"project" : "#89A5E5",
                  "actor" : "#F285B9",
                  "idea" : "#FFD98D",
                  "ressource" : "#CDF989",
                  "without" : "#999"}
  }

  thisGraph.nodeTypeIcon = {
    r : 13,
    cxClosed : 0,
    cxEdited : 0,
    cyClosed : (thisGraph.customNodes.heightClosed/2)-10,
    cyEdited : (thisGraph.customNodes.heightEdited/2)-10,
    xClosed : -11,
    xOpened : -11,
    xEdited : -11,
    yClosed : (thisGraph.customNodes.heightClosed/2)-20,
    yEdited : (thisGraph.customNodes.heightEdited/2)-20,
  }

  thisGraph.nodeIdCircle = {
    r : 10,
    cxClosed : 0,
    cyClosed : -(thisGraph.customNodes.heightClosed/2)+6,
    cxEdited : 0,
    cyEdited : -(thisGraph.customNodes.heightOpened/2),
    dxClosed : 0,
    dyClosed : -(thisGraph.customNodes.heightClosed/2)+10,
    dxEdited : 0,
    dyEdited : -(thisGraph.customNodes.heightOpened/2)+5,
  }

  thisGraph.customNodesText = {
    fontSize : 14,
    FontFamily : "Helvetica Neue, Helvetica, Arial, sans-serif;",
    strokeOpacity : .5,
    widthMax : 160,
		heightMax : 60,
    curvesCorners : thisGraph.customNodes.curvesCornersOpenedNode,
  }

  thisGraph.customLinks = {
    strokeWidth: 7,
    strokeColor: "#DDD",
    strokeSelectedColor: "#999",
  }

  thisGraph.customLinksLabel = {
    width : 200,
    height : 80,
    fillColor : "#CCC",
    strokeColor : "#DDD",
    curvesCorners : 20,
    blankNodeLabel : "loglink:linkto",
  }

  thisGraph.graphName = thisGraph.config.newGraphName;
  thisGraph.listOfLocalGraphs = [];
  thisGraph.selectedGraphName = null;
  thisGraph.graphToDeleteName = null;
  thisGraph.firstBgElement = firstBgElement || [],
  thisGraph.d3data = d3data || [],
  thisGraph.bgElement = null,
  thisGraph.svgNodesEnter = [],
  thisGraph.svgLinksEnter = [],
  thisGraph.width = window.innerWidth - 30,
  thisGraph.height = window.innerHeight - 30,
  thisGraph.nodeidct = null,

  //mouse event vars
  thisGraph.state = {
    selectedNode : null,
    selectedLink : null,
    mouseDownNode : null,
    mouseDownLink : null,
    svgMouseDownNode : null,
    mouseUpNode : null,
    lastKeyDown : -1,
    editedNode : null,
    editedIndexNode : null,
    openedNode : null,
    editedLinkLabel : null,
  }
}

// Come from : https://github.com/cjrd/directed-graph-creator/blob/master/graph-creator.js
FluidGraph.prototype.consts =  {
  selectedClass: "selected",
  connectClass: "connect-node",
  circleGClass: "conceptG",
  graphClass: "graph",
  activeEditId: "active-editing",
  BACKSPACE_KEY: 8,
  DELETE_KEY: 46,
  ENTER_KEY: 13,
  nodeRadius: 50,
  OPENED_GRAPH_KEY: "openedGraph"
};

/*
*
*           functions
*
****************************/

//rescale g
FluidGraph.prototype.rescale = function(thisGraph){
  if (thisGraph.config.debug) console.log("rescale start");

  thisGraph.bgElement.attr("transform",
    "translate(" + d3.event.translate + ")"
    + " scale(" + d3.event.scale + ")");

  if (thisGraph.config.debug) console.log("rescale end");
}

//Create a balise SVG with events
FluidGraph.prototype.initSgvContainer = function(bgElementId){
  var thisGraph = this;

  if (thisGraph.config.debug) console.log("initSgvContainer start");

  // listen for key events
  d3.select(window).on("keydown", function(){
    thisGraph.bgKeyDown.call(thisGraph);
  })
  .on("keyup", function(){
    thisGraph.bgKeyUp.call(thisGraph);
  });

  var div = thisGraph.firstBgElement;
  var svg;

  if (thisGraph.config.bgElementType == "simple")  {
    svg = d3.select(div)
          .append("svg")
          .attr("width", thisGraph.width)
          .attr("height", thisGraph.height)
          .append('g')
          .attr('id', bgElementId)
  }
  else  {  //panzoom
    var outer = d3.select(div)
          .append("svg")
          .attr("width", thisGraph.width)
          .attr("height", thisGraph.height)

    svg = outer
      .append('g')
      .call(d3.behavior.zoom()
        // .scaleExtent([1, 10])
        .on("zoom", function(d){thisGraph.rescale.call(this, thisGraph, d)}))
      .on("dblclick.zoom", null)
      .on("click", null)
      .on("dblclick", function(d){
        if (thisGraph.config.editGraphMode == true)
          thisGraph.addNode.call(this, thisGraph, d)
        })
      .append('g')
      .attr('id', bgElementId)
      .on("mousedown", function(d){
        thisGraph.bgOnMouseDown.call(thisGraph, d)})
      .on("mousemove", function(d){
        thisGraph.bgOnMouseMove.call(thisGraph, d)})
	    .on("mouseup", function(d){
        thisGraph.bgOnMouseUp.call(thisGraph, d)})

    svg.append('rect')
          .attr('x', -thisGraph.width*3)
          .attr('y', -thisGraph.height*3)
          .attr('width', thisGraph.width*7)
          .attr('height', thisGraph.height*7)
          .attr('fill', thisGraph.config.backgroundColor)
  }

  thisGraph.bgElement = d3.select("#"+bgElementId);

  thisGraph.initDragLine();

  if (thisGraph.config.debug) console.log("initSgvContainer end");
}

FluidGraph.prototype.initDragLine = function(){
  var thisGraph = this;

  if (thisGraph.config.debug) console.log("initDragLine start");

  // line displayed when dragging new nodes
  if (thisGraph.config.curvesLinks == "On")
  {
    thisGraph.drag_line = thisGraph.bgElement.append("path")
                          .attr("id", "drag_line")
                          .attr("class", "drag_line")
                          .attr("stroke-dasharray", "5,5")
                          .attr("stroke", "#999")
                          .attr("stroke-width", "2")
                          .attr("d", "M0 0 L0 0")
                          .attr("visibility", "hidden");
  }
  else {
    thisGraph.drag_line = thisGraph.bgElement.append("line")
                          .attr("id", "drag_line")
                          .attr("class", "drag_line")
                          .attr("stroke-dasharray", "5,5")
                          .attr("stroke", "#999")
                          .attr("stroke-width", "2")
                          .attr("x1", 0)
                    	    .attr("y1", 0)
                    	    .attr("x2", 0)
                    	    .attr("y2", 0)
                          .attr("visibility", "hidden");
  }

  if (thisGraph.config.debug) console.log("initDragLine start");
}

FluidGraph.prototype.activateForce = function(){
  var thisGraph = this;

  if (thisGraph.config.debug) console.log("activateForce start");

  thisGraph.force = d3.layout.force()
                        .nodes(thisGraph.d3data.nodes)
                        .links(thisGraph.d3data.edges)
                        .size([thisGraph.width, thisGraph.height])
                        .linkDistance(thisGraph.config.linkDistance)
                        .charge(thisGraph.config.charge)

  if (thisGraph.config.elastic == "On")  {
    thisGraph.force.start()
    thisGraph.force.on("tick", function(args){
      thisGraph.movexy.call(thisGraph, args)})
  }  else { // Off
    // Run the layout a fixed number of times.
  	// The ideal number of times scales with graph complexity.
    thisGraph.force.start();
  	for (var t = 100; t > 0; --t) thisGraph.force.tick();
    thisGraph.force.stop();
  }

  if (thisGraph.config.debug) console.log("activateForce end");
}

FluidGraph.prototype.drawGraph = function(d3dataFc){
  var thisGraph = this;

  if (thisGraph.config.debug) console.log("drawGraph start");

  var dataToDraw = d3dataFc || thisGraph.d3data;

  if (typeof dataToDraw.nodes != "undefined")
  {
    //Update of the nodes
    thisGraph.nodeidct = 0;
    dataToDraw.nodes.forEach(function(node)
            {
              thisGraph.nodeidct++;
              if (typeof dataToDraw.nodes.px == "undefined")
              {
                node.px = node.x;
                node.py = node.y;
                node.weight = 1;
              }

            });

    thisGraph.svgNodesEnter = thisGraph.bgElement.selectAll("#node")
    				              .data(dataToDraw.nodes)

    thisGraph.svgNodes = thisGraph.svgNodesEnter
                                .enter()
                        				.append("g")
                        				.attr("id", "node")
                                .call(d3.behavior.drag()
                                          .on("dragstart", function(args){
                                            thisGraph.nodeOnDragStart.call(thisGraph, args)})
                                          .on("drag", function(args){
                                            thisGraph.nodeOnDragMove.call(thisGraph, args)})
                                          .on("dragend", function(args){
                                            thisGraph.nodeOnDragEnd.call(thisGraph, args)})
                                )

    if (thisGraph.config.force == "On" || thisGraph.config.elastic == "On")
    {
      thisGraph.svgNodes.attr("transform", function(d) {
        return "translate(" + d.x + "," + d.y + ")";
      })
    }

    thisGraph.drawNodes(thisGraph.svgNodes);

    //delete node if there's less object in svgNodes array than in DOM
    thisGraph.svgNodesEnter.exit().remove();

    //Update links
    // Without force :
    // once you have object nodes, you can create d3data.edges without force.links() function

    // From the second time, we check every edges to see if there are number to replace by nodes objects
    dataToDraw.edges.forEach(function(link)
            {
              if (typeof(link.source) == "number")
              {
                link.source = dataToDraw.nodes[link.source];
                link.target = dataToDraw.nodes[link.target];
              }
            });

    thisGraph.svgLinksEnter = thisGraph.bgElement.selectAll("#link")
                  			.data(dataToDraw.edges)

    if (thisGraph.config.curvesLinks == "On")
    {
      thisGraph.svgLinks = thisGraph.svgLinksEnter
                          .enter()
                          .insert("path", "#node")
    }
    else
    {
      thisGraph.svgLinks = thisGraph.svgLinksEnter
                          .enter()
                          .insert("line", "#node")
    }

    thisGraph.svgLinks.on("mousedown", function(d){
                          thisGraph.linkOnMouseDown.call(thisGraph, d3.select(this), d);
                        })
                        .on("mouseup", function(d){
                          thisGraph.state.mouseDownLink = null;
                        })
                        .on("dblclick", function(d){
                          thisGraph.linkEdit.call(thisGraph, d3.select(this), d);
                        })

    thisGraph.drawLinks(thisGraph.svgLinks);

    //delete link if there's less object in svgLinks array than in DOM
    thisGraph.svgLinksEnter.exit().remove();

    thisGraph.svgLinksLabelEnter = thisGraph.bgElement.selectAll("#linksLabel")
        .data(dataToDraw.edges)
        .enter()
    		.insert("text", "#node")
        .attr("class", "linksLabel")
        .attr("id", function(d) { return "edge" + d.source.id + "_" + d.target.id })
    		.attr("x", function(d) { return d.source.x + (d.target.x - d.source.x)/2; })
        .attr("y", function(d) { return d.source.y + (d.target.y - d.source.y)/2; })
        .attr("text-anchor", "middle")
        .attr("visibility", "hidden")
        .attr("cursor", "default")
    	  .style("fill", "#000")
        .text(function(d) {
          return d.type;
        });

    if (thisGraph.config.force == "Off")
    {
      thisGraph.movexy.call(thisGraph);
    }
  }

  if (thisGraph.config.debug) console.log("drawGraph end");
}

FluidGraph.prototype.movexy = function(d){
  thisGraph = this;

  if (thisGraph.config.debug) console.log("movexy start");

  if (isNaN(thisGraph.svgNodesEnter[0][0].__data__.x) || isNaN(thisGraph.svgNodesEnter[0][0].__data__.y))
  {
    console.log("movexy problem if tick...",thisGraph.svgNodesEnter[0][0].__data__.x)
    throw new Error("movexy still problem if tick :-)...");
  }

  if (thisGraph.config.curvesLinks == "On")
  {
    thisGraph.svgLinksEnter.attr("d", function(d) {
          var dx = d.target.x - d.source.x,
              dy = d.target.y - d.source.y,
              dr = Math.sqrt(dx * dx + dy * dy);
         return "M" +
              d.source.x + "," +
              d.source.y + "A" +
              dr + "," + dr + " 0 0,1 " +
              d.target.x + "," +
              d.target.y;
        })
  }
  else { //false
    thisGraph.svgLinksEnter.attr("x1", function(d) { return d.source.x; })
		      .attr("y1", function(d) { return d.source.y; })
		      .attr("x2", function(d) { return d.target.x; })
		      .attr("y2", function(d) { return d.target.y; });
  }

  thisGraph.svgLinksLabelEnter
      .attr("x", function(d) { return d.source.x + (d.target.x - d.source.x)/2; })
      .attr("y", function(d) { return d.source.y + (d.target.y - d.source.y)/2; })

  thisGraph.svgNodesEnter.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

  if (thisGraph.config.debug) console.log("movexy end");
}

FluidGraph.prototype.newGraph = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("newGraph start");

  thisGraph.clearGraph();
  thisGraph.changeGraphName();
  thisGraph.d3data.nodes = [{id:0, label: thisGraph.customNodes.blankNodeLabel, type: thisGraph.customNodes.blankNodeType, x:200, y:200, identifier:"http://fluidlog.com/0" }];
  thisGraph.initDragLine()
  localStorage.removeItem(thisGraph.config.version+"|"+thisGraph.consts.OPENED_GRAPH_KEY);
  thisGraph.drawGraph();

  if (thisGraph.config.debug) console.log("newGraph end");
}

FluidGraph.prototype.clearGraph = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("clearGraph start");

  thisGraph.resetMouseVars();
  thisGraph.resetStateNode();
  thisGraph.d3data.nodes = [];
  thisGraph.d3data.edges = [];
  thisGraph.graphName = thisGraph.config.newGraphName;
  thisGraph.removeSvgElements();

  if (thisGraph.config.debug) console.log("clearGraph end");
}

FluidGraph.prototype.resetStateNode = function() {
  thisGraph.state.selectedNode = null;
  thisGraph.state.openedNode = null;
  thisGraph.state.editedNode = null;
}

FluidGraph.prototype.refreshGraph = function() {
  var thisGraph = this;

  if (thisGraph.config.debug) console.log("refreshGraph start");

  thisGraph.resetMouseVars();
  if (thisGraph.config.force == "On")
    thisGraph.activateForce();

  thisGraph.resetStateNode();
  thisGraph.removeSvgElements();
  thisGraph.initDragLine();
  thisGraph.drawGraph();

  if (thisGraph.config.debug) console.log("refreshGraph end");
}

FluidGraph.prototype.downloadGraph = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("downloadGraph start");

  var blob = new Blob([thisGraph.d3DataToJsonD3()], {type: "text/plain;charset=utf-8"});
  var now = new Date();
  var date_now = now.getDate()+"-"+now.getMonth()+1+"-"+now.getFullYear()+"-"+now.getHours()+":"+now.getMinutes()+":"+now.getSeconds();
  saveAs(blob, "Carto-"+thisGraph.graphName+"-"+date_now+".d3json");

  if (thisGraph.config.debug) console.log("downloadGraph end");
}

FluidGraph.prototype.uploadGraph = function(input) {

thisGraph = this;

if (thisGraph.config.debug) console.log("uploadGraph start");

  if (window.File && window.FileReader && window.FileList && window.Blob) {
    var uploadFile = input[0].files[0];
    var filereader = new window.FileReader();

    filereader.onload = function(){
      var txtRes = filereader.result;
      // TODO better error handling
      try{
        thisGraph.clearGraph();
        thisGraph.d3data = thisGraph.jsonD3ToD3Data(txtRes);
        thisGraph.changeGraphName();
        thisGraph.initDragLine()
        thisGraph.drawGraph();
      }catch(err){
        window.alert("Error parsing uploaded file\nerror message: " + err.message);
        return;
      }
    };
    filereader.readAsText(uploadFile);
    $("#sidebarButton").click();

  } else {
    alert("Your browser won't let you save this graph -- try upgrading your browser to IE 10+ or Chrome or Firefox.");
  }

  if (thisGraph.config.debug) console.log("uploadGraph end");
}

FluidGraph.prototype.changeGraphName = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("changeGraphName start");

  $('#graphNameLabel').text(thisGraph.graphName);

  if (thisGraph.config.debug) console.log("changeGraphName end");
}

FluidGraph.prototype.getContentLocalStorage = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("getContentLocalStorage start");

  thisGraph.listOfLocalGraphs = [];
  Object.keys(localStorage)
      .forEach(function(key){
          var regexp = new RegExp(thisGraph.config.version);
           if (regexp.test(key)) {
             var keyvalue = [];
             keyvalue[0] = key.split("|").pop();
             keyvalue[1] = localStorage.getItem(key)

            if (keyvalue[0] != thisGraph.consts.OPENED_GRAPH_KEY)
             thisGraph.listOfLocalGraphs.push(keyvalue)
           }
       });

  if (thisGraph.config.debug) console.log("getContentLocalStorage end");
}

FluidGraph.prototype.displayContentOpenGraphModal = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("displayContentOpenGraphModal start");

  //Get index selected if selection change
  var openGraphModalSelection = d3.select('#openGraphModalSelection');
  if (openGraphModalSelection.node())
  {
    var selectedoption = openGraphModalSelection.node().selectedIndex;
    thisGraph.selectedGraphName = openGraphModalSelection.node().options[selectedoption].value;
  }

  d3.select('#openGraphModalSelection').remove();
  openGraphModalSelection = d3.select('#openGraphModalList')
        .append("select")
        .attr("id", "openGraphModalSelection")
        .attr("multiple", true)
        .attr("style","width:300px; height:100px")
        .on("change", function(d){
          thisGraph.displayContentOpenGraphModal.call(thisGraph)})

  thisGraph.listOfLocalGraphs.forEach(function(value, index) {
    var option = openGraphModalSelection
                .append("option")
                .attr("value", value[0])

                if (thisGraph.graphName == thisGraph.config.newGraphName) //Untilted
                {
                  if (index == 0)
                  {
                    option.attr("selected",true);
                    thisGraph.selectedGraphName = value[0];
                  }
                }
                else {
                  if (value[0] == thisGraph.selectedGraphName)
                  {
                    option.attr("selected",true);
                  }
                }

    option.text(value[0])
  });

  if (!thisGraph.selectedGraphName)
    thisGraph.selectedGraphName = thisGraph.graphName;

  thisGraph.loadGraph(thisGraph.selectedGraphName);

  d3.select("#contentOpenGraphModalPreview").remove();

  var contentOpenGraphModalPreview = d3.select("#openGraphModalPreview")
              .append("div")
              .attr("id", "contentOpenGraphModalPreview")
  var ul =  contentOpenGraphModalPreview
                .append("ul")

  //Use every instead of forEach to stop loop when you want
  thisGraph.d3data.nodes.every(function(node, index) {
    var li = ul
              .append("li")
              .text(node.label)
    if (index > 4)
      return false;
    else
      return true
  });

  var total = contentOpenGraphModalPreview
                .append("div")
                .attr("id","totalOpenGraphModalPreview")
                .html("<b>Total of nodes :</b> "+thisGraph.d3data.nodes.length+"<br> <b>Total of links :</b> "+thisGraph.d3data.edges.length);

  if (thisGraph.config.debug) console.log("displayContentOpenGraphModal end");

}

FluidGraph.prototype.loadGraph = function(graphName) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("loadGraph start");

  // https://ldp.openinitiative.com:8443/2013/people/
  // https://www.wikidata.org/wiki/
  // externalStoreSemForms = new MyStore({
  //     container: thisGraph.config.uriExternalStore,
  //     context: "http://owl.openinitiative.com/oicontext.jsonld",
  //     template: "",
  //     partials: "",
  // });

  var ExternalGraph;

  // With Rwwplay
  // externalStoreRwwplay.list(externalStoreRwwplay.container).then(function(list) {
  //   list.forEach(function(item) {
  //     externalStoreRwwplay.get(item,externalStoreRwwplay.container).then(function(graph) {
  //             console.log("graph : "+graph);
  //             ExternalGraph = graph;
  //     });
  //   });
  // });

//externalStoreSemForms.get("http://localhost:9000/ldp/fluidlog/unnamed").then(console.log.bind(console))
  // externalStoreSemForms.get(thisGraph.config.uriExternalStore+"unnamed").then(function(graph) {
  //             console.log("graph : "+graph);
  //             ExternalGraph = graph;
  // });

  var localGraph = localStorage.getItem(thisGraph.config.version+"|"+graphName);

  thisGraph.d3data = thisGraph.jsonD3ToD3Data(localGraph); //ExternalGraph

  thisGraph.graphName = graphName;
  thisGraph.changeGraphName();

  if (thisGraph.config.debug) console.log("loadGraph end");
}

FluidGraph.prototype.openGraph = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("openGraph start");

  thisGraph.resetMouseVars();
  thisGraph.removeSvgElements();
  thisGraph.initDragLine();
  thisGraph.drawGraph();
  thisGraph.rememberOpenedGraph();

  if (thisGraph.config.debug) console.log("openGraph end");
}

FluidGraph.prototype.removeSvgElements = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("removeSvgElements start");

  d3.selectAll("#node").remove();
  d3.selectAll("#link").remove();
  d3.selectAll(".linksLabel").remove();
  d3.selectAll("#drag_line").remove();

  if (thisGraph.config.debug) console.log("removeSvgElements end");
}

FluidGraph.prototype.rememberOpenedGraph = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("rememberGraphOpened start");

  localStorage.setItem(thisGraph.config.version+"|"+thisGraph.consts.OPENED_GRAPH_KEY,thisGraph.graphName)

  if (thisGraph.config.debug) console.log("rememberGraphOpened end");
}

FluidGraph.prototype.getOpenedGraph = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("rememberGraphOpened start");

  var openedGraph;
  openedGraph = localStorage.getItem(thisGraph.config.version+"|"+thisGraph.consts.OPENED_GRAPH_KEY);

  if (thisGraph.config.debug) console.log("rememberGraphOpened end");

  return openedGraph;
}

FluidGraph.prototype.displayContentManageGraphModal = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("displayContentManageGraphModal start");

  d3.select('#manageGraphModalTable').remove();
  var manageGraphModalTable = d3.select('#manageGraphModalDivTable')
                            .append("table")
                            .attr("id", "manageGraphModalTable")
                            .attr("class","ui celled table")

  var manageGraphModalThead = manageGraphModalTable
                            .append("thread")

  var manageGraphModalTrHead =  manageGraphModalTable
                          .append("tr")

  manageGraphModalTrHead.append("th")
                            .text("Name")
  manageGraphModalTrHead.append("th")
                            .text("Content")
  manageGraphModalTrHead.append("th")
                            .text("Action")

  var manageGraphModalTbody =  manageGraphModalTable.append("tbody")


  thisGraph.listOfLocalGraphs.forEach(function(value, index) {
    try{
      var data = JSON.parse(value[1]);
    }catch(err){
      var data = null;
    }

    if (data)
    {
      var nodesPreview = "(";
      data.nodes.every(function(node, index){
        if (index > 2)
        {
          nodesPreview += node.label.split(" ",2);
          return false;
        }
        else {
          if (index == data.nodes.length-1)
            nodesPreview += node.label.split(" ",2);
          else
            nodesPreview += node.label.split(" ",2) + ',';
          return true;
        }
      });
      nodesPreview += ")";
    }

    var manageGraphModalTrBody =  manageGraphModalTbody
                            .append("tr")

    manageGraphModalTrBody.append("td")
                            .text(value[0]);

    manageGraphModalTrBody.append("td")
                            .text(' ' + nodesPreview);

    manageGraphModalTrBody.append("td")
                          .append("button")
                          .attr("class", "ui mini labeled icon button")
                          .on("click", function (){
                            thisGraph.graphToDeleteName = value[0];
                            thisGraph.deleteGraph.call(thisGraph);
                            thisGraph.getContentLocalStorage.call(thisGraph);
                            thisGraph.displayContentManageGraphModal.call(thisGraph);
                          })
                          .text("Delete")
                          .append("i")
                          .attr("class", "delete small icon")
  });

  if (thisGraph.config.debug) console.log("displayContentManageGraphModal end");
}

FluidGraph.prototype.deleteGraph = function(skipPrompt) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("deleteGraph start");

  doDelete = true;
  if (!skipPrompt){
    doDelete = window.confirm("Press OK to delete the graph named " + thisGraph.graphToDeleteName);
  }
  if(doDelete){
    localStorage.removeItem(thisGraph.config.version+"|"+thisGraph.graphToDeleteName);
    if (thisGraph.graphToDeleteName == thisGraph.graphName)
      thisGraph.newGraph();
  }

  if (thisGraph.config.debug) console.log("deleteGraph end");
}

FluidGraph.prototype.resetMouseVars = function()
{
  if (thisGraph.config.debug) console.log("resetMouseVars start");

  thisGraph.state.mouseDownNode = null;
  thisGraph.state.mouseUpNode = null;
  thisGraph.state.mouseDownLink = null;

  if (thisGraph.config.debug) console.log("resetMouseVars end");
}

FluidGraph.prototype.saveGraphToExternalStore = function() {
  thisGraph = this;
  if (thisGraph.config.debug) console.log("saveGraphToExternalStore start");

  var jsonLd = thisGraph.d3DataToJsonLd();
  // localStorage.setItem(thisGraph.config.version+"|"+thisGraph.graphName+".json-ld",window.JSON.stringify(jsonLd));

  var myStore = new MyStore({ container : thisGraph.config.uriExternalStore,
                              context : "http://owl.openinitiative.com/oicontext.jsonld",
                              template : "",
                              partials : ""});

  myStore.save(jsonLd);

  console.log("jsonLd " + JSON.stringify(jsonLd));

  if (thisGraph.config.debug) console.log("saveGraphToExternalStore end");
}

FluidGraph.prototype.saveGraphToLocalStorage = function() {
  thisGraph = this;
  if (thisGraph.config.debug) console.log("saveGraphToLocalStorage start");

  thisGraph.changeGraphName();
  thisGraph.selectedGraphName = thisGraph.graphName;

  if (thisGraph.config.remindSelectedNodeOnSave == false)
  {
    thisGraph.d3data.nodes.forEach(function(node, i){
      if (node.fixed == true) node.fixed = false;
    });
  }

  localStorage.setItem(thisGraph.config.version+"|"+thisGraph.graphName,thisGraph.d3DataToJsonD3())

  if (thisGraph.config.debug) console.log("saveGraphToLocalStorage end");
}

FluidGraph.prototype.displayExternalGraph = function(d3node, d) {
  thisGraph = this;
  if (thisGraph.config.debug) console.log("displayExternGraph start");

  d3.event.stopPropagation();

  externalUri = d.identifier;

  var externalD3Data = thisGraph.getExternalD3Data(externalUri)

  if (externalD3Data)
  {
    thisGraph.d3data = externalD3Data;

    thisGraph.resetMouseVars();
    thisGraph.resetStateNode();
    thisGraph.removeSvgElements();
    thisGraph.initDragLine();
    thisGraph.drawGraph();
  }

  if (thisGraph.config.debug) console.log("displayExternGraph end");
}

FluidGraph.prototype.getExternalD3Data = function(externalUri) {
  var d3data;

  //Appelle main.php de manière synchrone. C'est à dire, attend la réponse avant de continuer
  $.ajax({
    type: 'GET',
    url: externalUri,
    dataType: 'json',
    success: function(t_data) {
      d3data = t_data;
      return false;
    },
    error: function(t_data) {
      console.log("Erreur Ajax : Message=" + t_data + " (Fonction getd3data()) !");
    },
    async: false
  });
  return d3data;
}
