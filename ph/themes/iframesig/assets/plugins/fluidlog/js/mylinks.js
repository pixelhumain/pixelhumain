FluidGraph.prototype.drawLinks = function(svgLinks){
  thisGraph = this;

  if (thisGraph.config.debug) console.log("drawLinks start");

  if (thisGraph.config.curvesLinks == "On")
  {
    svgLinks.attr("id", "link")
            .attr("class", "link")
            .attr("stroke", thisGraph.customLinks.strokeColor)
            .attr("stroke-width", thisGraph.customLinks.strokeWidth)
            .attr("d", function(d) {
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
            .style("fill", "none")
  }
  else { //Off
    svgLinks.attr("id", "link")
            .attr("class", "link")
            .attr("stroke", thisGraph.customLinks.strokeColor)
            .attr("stroke-width", thisGraph.customLinks.strokeWidth)
            .attr("x1", function(d) { return d.source.x; })
    		  	.attr("y1", function(d) { return d.source.y; })
    		  	.attr("x2", function(d) { return d.target.x; })
    		  	.attr("y2", function(d) { return d.target.y; })     
  }

  if (thisGraph.config.debug) console.log("drawLinks end");
}

FluidGraph.prototype.linkEdit = function(d3Edge, edgeData){
  thisGraph = this;

  if (thisGraph.config.debug) console.log("linkEdit start");

  d3.event.stopPropagation();

  var el = d3Edge;
  var p_el = d3.select(d3Edge.node().parentNode);

  var searchLabelId = "#edge" + edgeData.source.id + "_" + edgeData.target.id;
  d3.select(searchLabelId).attr("visibility", "hidden");

  thisGraph.state.editedLinkLabel = d3Edge.node();

  p_el.append("rect")
      .attr("id", "linkEditBox")
      .attr("class", "linkEditBox")
      .attr("x", edgeData.source.x + (edgeData.target.x - edgeData.source.x)/3 )
      .attr("y", edgeData.source.y + (edgeData.target.y - edgeData.source.y)/2 )
      .attr("width", thisGraph.customLinksLabel.width)
      .attr("height", thisGraph.customLinksLabel.height)
      .attr("rx", thisGraph.customLinksLabel.curvesCorners)
      .attr("ry", thisGraph.customLinksLabel.curvesCorners)
      .style("fill", thisGraph.customLinksLabel.fillColor)
      .style("stroke", thisGraph.customLinksLabel.strokeColor)
      .style("stroke-width", 2)
      .style("stroke-opacity", .5)
      .style("cursor", thisGraph.customNodes.cursor)
      .style("opacity", .8)

  /*
   *
   * Content of the linklabel
   *
   * */

  var fo_content_edited_linklabel = p_el
        .append("foreignObject")
        .attr("id","fo_content_edited_linklabel")
        .attr("x", edgeData.source.x + (edgeData.target.x - edgeData.source.x)/3)
        .attr("y", edgeData.source.y + (edgeData.target.y - edgeData.source.y)/2)
        .attr("width", thisGraph.customLinksLabel.width)
        .attr("height", thisGraph.customLinksLabel.height)
        .on("mousedown",null)
        .on("mouseup",null)
        .on("mouseover",null)
        .on("mousedown",function(d){
          d3.event.stopPropagation();
        })
        .on("dblclick",function(d){
          d3.event.stopPropagation();
        })
        .on("click",function(d){
          d3.event.stopPropagation();
        })

  var fo_xhtml_content_edited_linklabel = fo_content_edited_linklabel
        .append('xhtml:div')
        .attr("class", "fo_xhtml_content_edited_linklabel")
        //Warning : using css doesn't work !
        .attr("style", "width:"+thisGraph.customLinksLabel.width+"px;"
                      +"height:"+thisGraph.customLinksLabel.height+"px;"
                      +"cursor:"+thisGraph.customNodes.cursor+";"
                      +"position:static;padding:10px")

  //linklabel Segment
  var  linklabel_segment = fo_xhtml_content_edited_linklabel
        .append("div")
        .attr("class", "ui raised segment")
        .attr("style", "position:static;margin:0px;padding:2px")

  //Form Segment
  var form_segment = linklabel_segment
        .append("div")
        .attr("class", "ui form top attached segment")
        .attr("style", "position:static;margin-top:0px;padding:0px")

    /*
     *
     * Description
     *
     * */

  //Node label 1 (description)
  var field_type = form_segment
        .append("div")
        .attr("class", "field")
        .attr("style", "margin:0px")

  var text_edited_linklabel = field_type
    .append("label")
    .attr("style", "margin:0;")
    .text("Predicat")

  //Node textarea
  var textarea_edited_linklabel = form_segment
    .append("textarea")
    .attr("id", "textarea_edited_linklabel")
    .attr("style", "padding:0;min-height:0;height:30px;width:170px;")
                .text(function() {
                  this.focus();
                    return edgeData.type;
                })


  if (thisGraph.config.debug) console.log("linkEdit end");
}

FluidGraph.prototype.spliceLinksForNode = function (nodeid) {
  var thisGraph = this;

  var toSplice = thisGraph.d3data.edges.filter(
    function(l) {
      return (l.source.id === nodeid) || (l.target.id === nodeid); });

  toSplice.map(
    function(l) {
      thisGraph.d3data.edges.splice(thisGraph.d3data.edges.indexOf(l), 1); });
}

FluidGraph.prototype.replaceSelectLinks = function(d3Edge, edgeData){
  var thisGraph = this;
  d3Edge.classed(thisGraph.consts.selectedClass, true);

  var searchLabelId = "#edge" + edgeData.source.id + "_" + edgeData.target.id;
  d3.select(searchLabelId).attr("visibility", "visible");

  if (thisGraph.state.selectedLink){
    thisGraph.removeSelectFromLinks();
  }
  thisGraph.state.selectedLink = edgeData;
};

FluidGraph.prototype.removeSelectFromLinks = function(){
  var thisGraph = this;
  thisGraph.svgLinksEnter.filter(function(link){
    return link === thisGraph.state.selectedLink;
  }).classed(thisGraph.consts.selectedClass, false);

  thisGraph.svgLinksLabelEnter[0].forEach(function (link){
    var d3link = d3.select(link);
    d3link.attr("visibility", "hidden");
  })

  thisGraph.state.selectedLink = null;
};

FluidGraph.prototype.addLink = function(sourceid, targetid)
{
  var thisGraph = this;

  if (thisGraph.config.debug) console.log("addLink start");

  // draw link between mouseDownNode and this new node
  var sourceObj = thisGraph.d3data.nodes[thisGraph.searchIndexOfNodeId(thisGraph.d3data.nodes,sourceid)];
  var targetObj = thisGraph.d3data.nodes[thisGraph.searchIndexOfNodeId(thisGraph.d3data.nodes,targetid)];
  var newlink = { source: sourceObj,
                  target: targetObj,
                  type : "loglink:linkedto"};

  thisGraph.d3data.edges.push(newlink);

  thisGraph.drawGraph();

  if (thisGraph.config.debug) console.log("addLink end");
}

FluidGraph.prototype.linkOnMouseDown = function(d3path, d){
  var thisGraph = this;

  if (thisGraph.config.debug) console.log("linkOnMouseDown start");

  d3.event.stopPropagation();
  thisGraph.state.mouseDownLink = d;

  if (thisGraph.state.selectedNode){
    thisGraph.removeSelectFromNode();
  }

  var prevEdge = thisGraph.state.selectedLink;
  if (!prevEdge || prevEdge !== d){
    thisGraph.replaceSelectLinks(d3path, d);
  } else{
    thisGraph.removeSelectFromLinks();
  }

  if (thisGraph.config.debug) console.log("linkOnMouseDown end");
}

FluidGraph.prototype.deleteLink = function() {
  var thisGraph = this;

  if (thisGraph.config.debug) console.log("deleteLink start");

  if (thisGraph.d3data.edges.length > 0)
  {
    thisGraph.d3data.edges.splice(thisGraph.d3data.edges.indexOf(thisGraph.state.selectedLink), 1);
    thisGraph.state.selectedLink = null;
    thisGraph.drawGraph();
  }
  else {
    console.log("No link to delete !");
  }

  if (thisGraph.config.debug) console.log("deleteLink end");
}

FluidGraph.prototype.saveEditedLinkLabel = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("saveEditedLinkLabel start");

  var el = d3.select(thisGraph.state.editedLinkLabel);
  var p_el = d3.select(thisGraph.state.editedLinkLabel.parentNode);

  var linkLabelNewText;
  var textarea_edited_linklabel = p_el.select("#textarea_edited_linklabel");

  // thisGraph.state.editedLinkLabel = thisGraph.d3data.edges[...]
  if (textarea_edited_linklabel.node().value == "")
    linkLabelNewText = thisGraph.customLinksLabel.blankNodeLabel;
  else
    linkLabelNewText = textarea_edited_linklabel.node().value;

  thisGraph.state.editedLinkLabel.__data__.type = linkLabelNewText;

  //Modification of linklabel
  var searchLabelId = "#edge" + thisGraph.state.editedLinkLabel.__data__.source.id + "_" + thisGraph.state.editedLinkLabel.__data__.target.id;
  d3.select(searchLabelId).text(linkLabelNewText);

  d3.select("#linkEditBox").remove();
  d3.select("#fo_content_edited_linklabel").remove();

  thisGraph.state.editedLinkLabel = null;

  if (thisGraph.config.debug) console.log("saveEditNode end");
}
