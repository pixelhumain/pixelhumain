// Prototypes concerning nodes

FluidGraph.prototype.drawNodes = function(svgNodes) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("drawNodes start");

  var rectCircle;
  rectCircle = svgNodes
    .append("rect")
    .attr("id", "nodecircle")
    .attr("class", "nodecircle")
    .attr("x", function (d){
      var radius = thisGraph.getProportionalRadius(d);
      var x = -radius;
      return x;
    })
    .attr("y", function (d){
      var radius = thisGraph.getProportionalRadius(d);
      var y = -radius;
      return y;
    })
    .attr("width", function (d){
      var radius = thisGraph.getProportionalRadius(d);
      var width = radius*2;
      return width;
    })
    .attr("height", function (d){
      var radius = thisGraph.getProportionalRadius(d);
      var height = radius*2;
      return height;
    })
    .attr("rx", thisGraph.customNodes.curvesCornersClosedNode)
    .attr("ry", thisGraph.customNodes.curvesCornersClosedNode)
    .style("fill", function(d) {
      return thisGraph.customNodes.colorType[d.type]
    })
    .style("stroke", function(d) {
      if (thisGraph.config.remindSelectedNodeOnSave == true)
        if (d.fixed == true)
          thisGraph.replaceSelectNode.call(thisGraph, d3.select(this), d);

      return thisGraph.customNodes.strokeColorType[d.type];
    })
    // .style("stroke-width", thisGraph.customNodes.strokeWidth)
    .style("stroke-opacity", thisGraph.customNodes.strokeOpacity)
    .style("cursor", thisGraph.customNodes.cursor)
    .style("opacity", 1)

  if (thisGraph.config.displayId == "On")
    thisGraph.displayId(svgNodes)

  if (thisGraph.customNodes.displayType)
    thisGraph.displayType(svgNodes)

  if (thisGraph.customNodes.displayText)
    thisGraph.displayText(svgNodes)

  if (thisGraph.config.debug) console.log("drawNodes end");
}

FluidGraph.prototype.getProportionalRadius = function(d) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("getProportionalRadius start");

  var radius;

  if (thisGraph.config.proportionalNodeSize == "On")
  {
    var neighbourNodesAndLinks = thisGraph.getNeighbourNodesAndLinks(d);
    var nbNeighbourNodes = neighbourNodesAndLinks.nodes.length;
    var indiceProp = 1;

    radius = (thisGraph.customNodes.widthClosed / 2) + (nbNeighbourNodes*indiceProp);
    if (radius > thisGraph.customNodes.maxRadius)
      radius = thisGraph.customNodes.maxRadius
  }
  else radius = thisGraph.customNodes.maxRadius

  if (thisGraph.config.debug) console.log("getProportionalRadius end");

  return radius
}

FluidGraph.prototype.displayText = function(svgNodes) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("displayText start");

  var fo_content_closed_node_label = svgNodes
    .append("foreignObject")
    .attr("id", "fo_content_closed_node_label")
    .attr("x", -thisGraph.customNodesText.widthMax / 2)
    .attr("y", -thisGraph.customNodesText.heightMax / 2)
    .attr("width", thisGraph.customNodesText.widthMax)
    .attr("height", thisGraph.customNodesText.heightMax)

  //fo xhtml
  var fo_xhtml_content_closed_node_label = fo_content_closed_node_label
    .append('xhtml:div')
    .attr("class", "fo_xhtml_content_closed_node_label")
    .attr("style", "width:"+thisGraph.customNodesText.widthMax+"px;"
                  +"height:"+thisGraph.customNodesText.heightMax+"px;")

  //label_closed_node
  var label_closed_node = fo_xhtml_content_closed_node_label
    .append("div")
    .attr("id", "label_closed_node")
    .attr("class", "label_closed_node")
    .attr("style", function(d) {
      return "background-color:rgba(" + thisGraph.customNodes.colorTypeRgba[d.type]
                                  + "," + thisGraph.customNodesText.strokeOpacity + ");"
                                  + "border: 1px solid rgba("
                                  + thisGraph.customNodes.colorTypeRgba[d.type] + ","
                                  + thisGraph.customNodesText.strokeOpacity + ");"
                                  + "cursor:" + thisGraph.customNodes.cursor + ";"
                                  + "-moz-border-radius:" + thisGraph.customNodesText.curvesCorners + "px;"
                                  + "-webkit-border-radius:" + thisGraph.customNodesText.curvesCorners + "px;"
                                  + "border-radius:" + thisGraph.customNodesText.curvesCorners + "px;"
    })
    .text(function(d, i) {
      return d.label;
    })
    .on("mousedown",function(d){
      thisGraph.nodeOnMouseDown.call(thisGraph, d3.select(this.parentNode.parentNode.parentNode), d)})
    .on("mouseup",function(d){
      thisGraph.nodeOnMouseUp.call(thisGraph, d3.select(this.parentNode.parentNode.parentNode), d)})
    .on("dblclick",function(d){
      if (thisGraph.config.editGraphMode == true)
        thisGraph.editNode.call(thisGraph, d3.select(this.parentNode.parentNode.parentNode), d);
      else
        thisGraph.displayExternalGraph.call(thisGraph, d3.select(this.parentNode.parentNode.parentNode), d);
    })

  //Rect to put events
  var fo_content_closed_node_events = svgNodes
    .append("foreignObject")
    .attr("id", "fo_content_closed_node_events")
    .attr("x", -thisGraph.customNodesText.widthMax / 2)
    .attr("y", -thisGraph.customNodesText.heightMax / 2)
    .attr("width", thisGraph.customNodesText.widthMax)
    .attr("height", thisGraph.customNodesText.heightMax)

  var fo_xhtml_content_closed_node_events = fo_content_closed_node_events
    .append('xhtml:div')
    .attr("class", "fo_xhtml_content_closed_node_events")
    .attr("style", function (d){
      var radius = thisGraph.getProportionalRadius(d);
      var marginLeft = (thisGraph.customNodesText.widthMax - radius*2)/2
      var style = "margin-left:" + marginLeft + "px;"
                  + "padding:" + radius + "px;"
                  + "width:"+ radius*2 + "px;"
                  + "height:"+ radius*2 + "px;position:static;"
                  + "cursor:" + thisGraph.customNodes.cursor + ";"
      return style;
    })

    .on("mousedown",function(d){
      thisGraph.nodeOnMouseDown.call(thisGraph, d3.select(this.parentNode.parentNode), d)})
    .on("mouseup",function(d){
      thisGraph.nodeOnMouseUp.call(thisGraph, d3.select(this.parentNode.parentNode), d)})
    .on("mouseover",function(d){
      thisGraph.nodeOnMouseOver.call(thisGraph, d3.select(this.parentNode.parentNode), d)})
    .on("dblclick",function(d){
      if (thisGraph.config.editGraphMode == true)
        thisGraph.editNode.call(thisGraph, d3.select(this.parentNode.parentNode), d);
      else
        thisGraph.displayExternalGraph.call(thisGraph, d3.select(this.parentNode.parentNode), d);
    })

  if (thisGraph.config.debug) console.log("displayText end");
}

FluidGraph.prototype.displayId = function(svgNodes) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("displayId start");

  /* id circle */
  svgNodes
    .append("circle")
    .attr("id", "circle_id")
    .attr("class", "circle_id")
    .attr("cx", thisGraph.nodeIdCircle.cxClosed)
    .attr("cy", thisGraph.nodeIdCircle.cyClosed)
    .attr("r", thisGraph.nodeIdCircle.r)
    .attr("fill", function(d) {
      return thisGraph.customNodes.colorType[d.type];
    })

  /* Text of id */
  svgNodes
    .append("text")
    .attr("id", "text_id")
    .attr("class", "text_id")
    .attr("dx", thisGraph.nodeIdCircle.dxClosed)
    .attr("dy", thisGraph.nodeIdCircle.dyClosed)
    .attr("fill", "#EEE")
    .attr("font-weight", "bold")
    .text(function(d) {
      return d.id;
    })

  if (thisGraph.config.debug) console.log("displayId end");
}

FluidGraph.prototype.displayType = function(svgNodes) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("displayType start");

  /* type circle*/
  svgNodes
    .append("circle")
    .attr("id", "circle_type")
    .attr("class", "circle_type")
    .attr("cx", 0)
    .attr("cy", thisGraph.nodeTypeIcon.cyClosed)
    .attr("r", thisGraph.nodeTypeIcon.r)

  /* Image of type */
  var fo_type_image = svgNodes
    .append("foreignObject")
    .attr("id", "fo_type_image")
    .attr('x', thisGraph.nodeTypeIcon.xClosed)
    .attr('y', thisGraph.nodeTypeIcon.yClosed)
    .attr('width', 25)
    .attr('height', 25)

  //xhtml div image
  var fo_xhtml_type_image = fo_type_image
    .append('xhtml:div')
    .attr("id", "fo_div_type_image")
    .attr("class", "fo_div_image")
    .append('i')
    .attr("id", "fo_i_type_image")
    .attr("class", function(d) {
      return "ui large " + thisGraph.customNodes.imageType[d.type] + " icon";
    })
    .attr("style", "display:inline")

  if (thisGraph.config.debug) console.log("displayType end");
}

FluidGraph.prototype.changeIdNode = function(node,id) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("changeIdNode start");

  var el = d3.select(node);
  var text_id = el.select("#text_id");
  text_id.text(id);

  if (thisGraph.config.debug) console.log("changeIdNode end");
}

FluidGraph.prototype.changeTypeNode = function(node,type) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("displayType start");

  var el = d3.select(node);

  var nodecircle = el.select("#nodecircle");
  nodecircle.style("fill", thisGraph.customNodes.colorType[type]);
  nodecircle.style("stroke", thisGraph.customNodes.strokeColorType[type]);

  var type_el = el.select("#fo_type_image");
  type_el.select('#fo_i_type_image').remove();
  type_el.select('#fo_div_type_image')
      .append('i')
        .attr("id", "fo_i_type_image")
        .attr("class", "ui large " + thisGraph.customNodes.imageType[type] + " icon")
      .attr("style", "display:inline")

  var circle_id_el = el.select("#circle_id");
  circle_id_el.style("fill", function(d) { return thisGraph.customNodes.colorType[type] } );

  if (thisGraph.config.debug) console.log("displayType end");
}

FluidGraph.prototype.editNode = function(d3node, d) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("editNode start");

  d3.event.stopPropagation();

  if (thisGraph.state.editedNode)
    thisGraph.closeNode.call(thisGraph, "edited");

  var el = d3node;
  var p_el = d3.select(d3node.node().parentNode); //p_el = g#node

  el.select("#fo_content_closed_node_label").remove();
  el.select("#fo_content_closed_node_events").remove();

  el
    .select("#circle_id")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationEdit)
    .delay(thisGraph.customNodes.transitionDelay)
    .ease(thisGraph.customNodes.transitionEasing)
    .attr("cx", thisGraph.nodeIdCircle.cxEdited)
    .attr("cy", thisGraph.nodeIdCircle.cyEdited)

  el
    .select("#text_id")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationEdit)
    .delay(thisGraph.customNodes.transitionDelay)
    .ease(thisGraph.customNodes.transitionEasing)
    .attr("dx", thisGraph.nodeIdCircle.dxEdited)
    .attr("dy", thisGraph.nodeIdCircle.dyEdited)

  el
    .select("#circle_type")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationEdit)
    .delay(thisGraph.customNodes.transitionDelay)
    .ease(thisGraph.customNodes.transitionEasing)
    .attr("cx", thisGraph.nodeTypeIcon.cxEdited)
    .attr("cy", thisGraph.nodeTypeIcon.cyEdited)

  el
    .select("#fo_type_image")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationEdit)
    .delay(thisGraph.customNodes.transitionDelay)
    .ease(thisGraph.customNodes.transitionEasing)
    .attr("x", thisGraph.nodeTypeIcon.xEdited)
    .attr("y", thisGraph.nodeTypeIcon.yEdited)

  el
    .select("#nodecircle")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationEdit)
    .delay(thisGraph.customNodes.transitionDelay)
    .ease(thisGraph.customNodes.transitionEasing)
    .attr("x", -thisGraph.customNodes.widthEdited / 2)
    .attr("y", -thisGraph.customNodes.heightEdited / 2)
    .attr("width", thisGraph.customNodes.widthEdited)
    .attr("height", thisGraph.customNodes.heightEdited)
    .each("end", function(d) {
      thisGraph.displayContentEditedNode.call(thisGraph, d3.select(this), d)
    })

  thisGraph.state.editedNode = d3node.node();
  thisGraph.state.editedIndexNode = thisGraph.d3data.nodes.indexOf(d);

  if (thisGraph.config.debug) console.log("editNode end");
}

FluidGraph.prototype.displayContentEditedNode = function(d3node, d) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("displayContentEditedNode start");

  var el = d3node.node();
  var p_el = d3.select(d3node.node().parentNode); //p_el = g#node

  /*
   *
   * Content of the node
   *
   * */

  var fo_content_edited_node_label = p_el
        .append("foreignObject")
        .attr("id","fo_content_edited_node_label")
        .attr("x", -thisGraph.customNodes.widthEdited/2)
        .attr("y", -thisGraph.customNodes.heightEdited/2)
        .attr("width", thisGraph.customNodes.widthEdited)
        .attr("height", thisGraph.customNodes.heightEdited)
        .on("mousedown",null)
        .on("mouseup",null)
        .on("mouseover",null)
        .on("dblclick",function(d){
          d3.event.stopPropagation();
        })

  var fo_xhtml_content_edited_node_label = fo_content_edited_node_label
        .append('xhtml:div')
        .attr("class", "fo_xhtml_content_edited_node_label")
        //Warning : using css doesn't work !
        .attr("style", "width:"+thisGraph.customNodes.widthEdited+"px;"
                      +"height:"+thisGraph.customNodes.heightEdited+"px;"
                      +"cursor:"+thisGraph.customNodes.cursor+";"
                      +"position:static;")

  //Node Segment
  var  node_segment = fo_xhtml_content_edited_node_label
        .append("div")
        .attr("class", "ui raised segment")
        .attr("style", "position:static;margin:0px;padding:10px")

  //Form Segment
  var form_segment = node_segment
        .append("div")
        .attr("class", "ui form top attached segment")
        .attr("style", "position:static;margin-top:0px;padding:0px")

      /*
       *
       * Id
       *
       * */

  if (thisGraph.config.displayId == "On")
  {
    var field_id = form_segment
           .append("div")
           .attr("class", "id")
           .attr("style", "margin:0px")

    //Node label Id
    var node_label_type = field_id
          .append("label")
          .attr("style", "margin:0;")
          .html("<b>Id</b>")

    //content Id
    var select_type = field_id
          .append("input")
          .attr("id", "input_id")
          .attr("style", "padding:0px; margin-left:20px; width:50px")
          .attr("value", function() {
              return d.id;
          })
  }

      /*
       *
       * Type
       *
       * */

   var field_type = form_segment
         .append("div")
         .attr("class", "field")
         .attr("style", "margin:0px")

  //Node label type
  var node_label_type = field_type
        .append("label")
        .attr("style", "margin:0;")
        .text("Type")

  //select type
  var select_type = field_type
        .append("select")
        .attr("id", "select_type")
        .attr("style", "padding:0px")

  thisGraph.customNodes.listType.forEach(function(type) {
    var option = select_type.append("option")

    option.attr("value", type)

    if (d.type === type)
      option.attr("selected",true)

    option.text(type)

  });

  /*
   *
   * Description
   *
   * */

var field_description = form_segment
  .append("div")
  .attr("class", "field")
  .attr("style", "margin:0px")

//Node label 1 (description)
var node_label_1 = field_description
  .append("label")
  .attr("style", "margin:0;")
  .text("Description")

//Node textarea
var textarea_label_open_flud = field_description
  .append("textarea")
  .attr("id", "textarea_label_edit_node")
  .attr("style", "padding:0;min-height:0;height:50px;width:140px;")
              .text(function() {
                this.focus();
                  return d.label;
              })


  if (thisGraph.config.debug) console.log("displayContentEditedNode end");
}

FluidGraph.prototype.openNode = function(d3node, d) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("openNodeOnHover start");

  if (thisGraph.state.openedNode)
    thisGraph.closeNode.call(thisGraph, "opened");

  var el = d3node;
  var p_el = d3.select(d3node.node().parentNode); //p_el = g#node

  // el.select("#fo_content_closed_node_label").remove();
  // el.select("#fo_content_closed_node_events").remove();

  var neighbours = thisGraph.getNeighbourNodesAndLinks(d);
  var nbNeighbours = neighbours.nodes.length-1;
  var heightNeighbours = nbNeighbours*thisGraph.customNodes.heightOpenedNeighbour;
  if (nbNeighbours*thisGraph.customNodes.heightOpenedNeighbour > thisGraph.customNodes.heightOpenedNeighboursMax)
    heightNeighbours = thisGraph.customNodes.heightOpenedNeighboursMax;

  // console.log("heightNeighbours : ", heightNeighbours, "heightOpenedNeighboursMax : ", thisGraph.customNodes.heightOpenedNeighboursMax);

  var totalHeight = thisGraph.customNodes.heightOpenedTopMax
                    + heightNeighbours
                    + thisGraph.customNodes.heightOpenedBottomMax;
  var yNodeCircle = -(totalHeight) / 2;
  var cyCircleId = -(totalHeight/2);
  var cyOpened = (totalHeight/2)-10;
  var yOpened = (totalHeight/2)-20;
  var dyOpened = -(totalHeight/2)+5;
  var ylabel = -15-totalHeight/2;

  el
    .select("#circle_id")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationOpen)
    .delay(thisGraph.customNodes.transitionDelay)
    .ease(thisGraph.customNodes.transitionEasing)
    .attr("cy", cyCircleId)

  el
    .select("#text_id")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationOpen)
    .delay(thisGraph.customNodes.transitionDelay)
    .ease(thisGraph.customNodes.transitionEasing)
    .attr("dy", dyOpened)

  el
    .select("#circle_type")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationOpen)
    .delay(thisGraph.customNodes.transitionDelay)
    .ease(thisGraph.customNodes.transitionEasing)
    .attr("cy", cyOpened)

  el
    .select("#fo_type_image")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationOpen)
    .delay(thisGraph.customNodes.transitionDelay)
    .ease(thisGraph.customNodes.transitionEasing)
    .attr("y", yOpened)

  el
    .select("#fo_content_closed_node_label")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationOpen)
    .delay(thisGraph.customNodes.transitionDelay)
    .ease(thisGraph.customNodes.transitionEasing)
    .attr("y", ylabel)

  el
    .select("#nodecircle")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationOpen)
    .delay(thisGraph.customNodes.transitionDelay)
    .ease(thisGraph.customNodes.transitionEasing)
    .attr("x", -thisGraph.customNodes.widthOpened / 2)
    .attr("y", yNodeCircle)
    .attr("width", thisGraph.customNodes.widthOpened)
    .attr("height", totalHeight)
    .attr("rx", thisGraph.customNodes.curvesCornersOpenedNode)
    .attr("ry", thisGraph.customNodes.curvesCornersOpenedNode)
    .each("end", function(d) {
      thisGraph.displayContentOpenedNode.call(thisGraph, d3.select(this), d, neighbours, heightNeighbours)
    })

  thisGraph.state.openedNode = d3node.node();

  if (thisGraph.config.debug) console.log("openNodeOnHover end");
}

FluidGraph.prototype.displayContentOpenedNode = function(d3node, d, neighbours, heightNeighbours) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("displayContentEditedNode start");

  var el = d3node.node();
  var p_el = d3.select(d3node.node().parentNode); //p_el = g#node

  var totalHeight = thisGraph.customNodes.heightOpenedTopMax
                    + heightNeighbours
                    + thisGraph.customNodes.heightOpenedBottomMax;

  var fo_content_opened_node = p_el
        .append("foreignObject")
        .attr("id","fo_content_opened_node")
        .attr("x", -thisGraph.customNodes.widthOpened/2)
        .attr("y", thisGraph.customNodes.heightOpenedTopMax - totalHeight/2)
        .attr("width", thisGraph.customNodes.widthOpened)
        .attr("height", totalHeight)

  var fo_xhtml_content_open_node = fo_content_opened_node
        .append('xhtml:div')
        .attr("class", "fo_xhtml_content_open_node")
        //Warning : using css doesn't work !?
        .attr("style", "width:"+thisGraph.customNodes.widthOpened+"px;"
                      +"height:"+totalHeight+"px;"
                      +"cursor:"+thisGraph.customNodes.cursor+";"
                      +"position:static;")

    /*
     *
     * neighbours
     *
     * */

  var open_node_neighbours = fo_xhtml_content_open_node
                            .append("div")
                            .attr("class", "open_node_neighbours")
                            .attr("id", "open_node_neighbours")
                            .attr("style","height:"+heightNeighbours+"px;")

  neighbours.nodes.sort(function(a, b){
    if (a.type < b.type)
      return -1;
    if (a.type > b.type)
      return 1;
    return 0;
  })

  neighbours.nodes.forEach(function(node,i){
    if (node.id != d.id)
    {
      if (node.type != "without")
      {
        open_node_neighbours
        .append("div")
        .attr("class", "open_node_neighbour")
        .attr("id", "open_node_neighbour")
        .attr("style", function(d) {
          return "background-color:rgba(" + thisGraph.customNodes.colorTypeRgba[node.type]
                                      + "," + thisGraph.customNodesText.strokeOpacity + ");"
                                      + "border: 1px solid rgba("
                                      + thisGraph.customNodes.colorTypeRgba[node.type] + ","
                                      + thisGraph.customNodesText.strokeOpacity + ");"
                                      + "cursor:" + thisGraph.customNodes.cursor + ";"
                                      + "-moz-border-radius:" + thisGraph.customNodesText.curvesCorners + "px;"
                                      + "-webkit-border-radius:" + thisGraph.customNodesText.curvesCorners + "px;"
                                      + "border-radius:" + thisGraph.customNodesText.curvesCorners + "px;"
        })
        .text(node.label)
      }
    }
  })

  //Rect to put events
  var fo_content_opened_node_events = p_el
    .append("foreignObject")
    .attr("id", "fo_content_opened_node_events")
    .attr("x", -thisGraph.customNodes.widthOpened / 2)
    .attr("y", -totalHeight/2)
    .attr("width", thisGraph.customNodes.widthOpened-15) // "15" = scroll access
    .attr("height", totalHeight)

  var fo_xhtml_content_opened_node_events = fo_content_opened_node_events
    .append('xhtml:div')
    .attr("class", "fo_xhtml_content_opened_node_events")
    .attr("style", "padding:" + (totalHeight/2) + "px;"
                  + "width:"+thisGraph.customNodes.widthOpened+"px;"
                  + "height:"+totalHeight+"px;position:static;"
                  + "cursor:" + thisGraph.customNodes.cursorOpen + ";"
                  // + "background-color: rgba(255,0,0,.3);"
                  )
    // .on("mouseout",function(d){
    //   thisGraph.nodeOnMouseOut.call(thisGraph, d3.select(this.parentNode), d)})
    .on("dblclick",function(d){
      thisGraph.editNode.call(thisGraph, d3.select(this.parentNode.parentNode), d)
      })
    .call(d3.behavior.zoom()
        .on("zoom", function(d) {
          d3.event.sourceEvent.stopPropagation();
          }))

  if (thisGraph.config.debug) console.log("displayContentEditedNode end");

}

FluidGraph.prototype.closeNode = function(typeOfNode) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("closeNode start");

  if (typeOfNode == "edited")
  {
    var el = d3.select(thisGraph.state.editedNode);
    var p_el = d3.select(thisGraph.state.editedNode.parentNode);

    var input_id = p_el.select("#input_id");
    var type_node_select = p_el.select("#select_type");
    var description_node_textarea = p_el.select("#textarea_label_edit_node");

    if (thisGraph.config.displayId == "On")
    {
      var interger_input_id = parseInt(input_id.node().value, 10);
      if (interger_input_id)
        thisGraph.state.editedNode.__data__.id = interger_input_id;
      else
        thisGraph.state.editedNode.__data__.id = thisGraph.state.editedIndexNode;
    }

    thisGraph.state.editedNode.__data__.type = type_node_select.node().value;

    if (description_node_textarea.node().value == "")
      thisGraph.state.editedNode.__data__.label = thisGraph.customNodes.blankNodeLabel;
    else
      thisGraph.state.editedNode.__data__.label = description_node_textarea.node().value;

    thisGraph.saveEditNode();

    el.select("#fo_content_edited_node_label").remove();
    thisGraph.displayText(el);

    thisGraph.state.editedNode = null;
  }
  else { //opened
      var el = d3.select(thisGraph.state.openedNode);

      el.select("#fo_content_opened_node").remove();
      el.select("#fo_content_opened_node_events").remove();

      el.select("#fo_content_closed_node_label")
        .transition()
        .duration(thisGraph.customNodes.transitionDurationClose)
        .attr("y", -thisGraph.customNodesText.heightMax / 2)

      // thisGraph.displayText(el);

      thisGraph.state.openedNode = null;
  }

  el
    .select("#circle_id")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationClose)
    .attr("cy", thisGraph.nodeIdCircle.cyClosed)

  el
    .select("#text_id")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationClose)
    .attr("dy", thisGraph.nodeIdCircle.dyClosed)

  el
    .select("#circle_type")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationClose)
    .attr("cy", thisGraph.nodeTypeIcon.cyClosed)

  el
    .select("#fo_type_image")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationClose)
    .attr("y", thisGraph.nodeTypeIcon.yClosed)

  el.select("#nodecircle")
    .transition()
    .duration(thisGraph.customNodes.transitionDurationClose)
    .attr("x", function (d){
      var radius = thisGraph.getProportionalRadius(d);
      var x = -radius;
      return x;
    })
    .attr("y", function (d){
      var radius = thisGraph.getProportionalRadius(d);
      var y= -radius;
      return y;
    })
    .attr("width", function (d){
      var radius = thisGraph.getProportionalRadius(d);
      var width = radius*2;
      return width;
    })
    .attr("height", function (d){
      var radius = thisGraph.getProportionalRadius(d);
      var height = radius*2;
      return height;
    })
    .attr("rx", thisGraph.customNodes.curvesCornersClosedNode)
    .attr("ry", thisGraph.customNodes.curvesCornersClosedNode)

  if (thisGraph.config.debug) console.log("closeNode end");
}

FluidGraph.prototype.saveEditNode = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("saveEditNode start");

  var editedNodeData = thisGraph.state.editedNode.__data__;
  thisGraph.changeIdNode(thisGraph.state.editedNode,editedNodeData.id);
  thisGraph.changeTypeNode(thisGraph.state.editedNode,editedNodeData.type);

  if (thisGraph.config.debug) console.log("saveEditNode end");
}

FluidGraph.prototype.nodeOnMouseOver = function(d3node, d) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("nodeOnMouseOver start");

  if (thisGraph.config.bringNodeToFrontOnHover) {
    var el = d3.select(d3node.node());
    el.moveToFront();
  }

  if (thisGraph.config.repulseNeighbourOnHover) {
    var el = d3.select(d3node.node());
    el.repulseNeighbour.call(thisGraph, d, 100);
  }

  if (thisGraph.config.openNodeOnHover == "On") {
    thisGraph.openNode.call(thisGraph, d3node, d);
  }

  if (thisGraph.config.debug) console.log("nodeOnMouseOver end");
}

FluidGraph.prototype.nodeOnMouseOut = function(d3node, d) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("nodeOnMouseOut start");

  if (thisGraph.config.repulseNeighbourOnHover) {
    var el = d3.select(d3node.node());
    el.repulseNeighbour.call(thisGraph, d, 1);
  }

  if (thisGraph.config.openNodeOnHover) {
    thisGraph.closeNode.call(thisGraph, "opened");
  }

  if (thisGraph.config.debug) console.log("nodeOnMouseOut end");
}

d3.selection.prototype.repulseNeighbour = function(d, weight) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("nodeOnMouseOver start");

  d.weight = weight;

  if (thisGraph.config.debug) console.log("nodeOnMouseOver end");
}

d3.selection.prototype.moveToFront = function() {
  return this.each(function() {
    this.parentNode.appendChild(this);
  });
};

FluidGraph.prototype.searchIndexOfNodeId = function(o, searchTerm) {
  for (var i = 0, len = o.length; i < len; i++) {
    if (o[i].identifier === searchTerm) return i;
  }
  return -1;
}

FluidGraph.prototype.getNeighbourNodesAndLinks = function(rootNode) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("getNeighbourNodesAndLinks start");

  var linkedByIndex = {};
  thisGraph.d3data.edges.forEach(function(d) {
    linkedByIndex[d.source.id + "," + d.target.id] = 1;
  });

  function isConnected(a, b) {
    return linkedByIndex[a.id + "," + b.id] || linkedByIndex[b.id + "," + a.id] || a.id == b.id;
  }

  var neighbours = {};
  neighbours.nodes = [];
  neighbours.edges = [];

  //First, the selected node
  neighbours.nodes.push(rootNode);

  thisGraph.d3data.nodes.forEach(function(node) {
    //Nodes
    if (isConnected(rootNode, node) && rootNode.id != node.id) {
      neighbours.nodes.push(node);
    }
    //links
    if (isConnected(rootNode, node) && rootNode.id != node.id) {
      neighbours.edges.push({
        source: thisGraph.searchIndexOfNodeId(neighbours.nodes, rootNode.identifier),
        target: thisGraph.searchIndexOfNodeId(neighbours.nodes, node.identifier)
      });
    }
  });

  if (thisGraph.config.debug) console.log("getNeighbourNodesAndLinks end");

  return neighbours;
}

FluidGraph.prototype.focusContextNode = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("focusContextNode start");

  if (thisGraph.state.selectedNode) {

    thisGraph.d3dataFc = thisGraph.getNeighbourNodesAndLinks(thisGraph.state.selectedNode);

    //If not, there are problems in movexy()...
    d3.selectAll("#node").remove();
    d3.selectAll("#path").remove();

    thisGraph.drawGraph(thisGraph.d3dataFc);
  } else alert("Please select a node :)")

  if (thisGraph.config.debug) console.log("focusContextNode end");
}

FluidGraph.prototype.focusContextNodeOff = function() {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("focusContextNodeOff start");

  //If not, there are problems in movexy()...
  d3.selectAll("#node").remove();
  d3.selectAll("#path").remove();
  thisGraph.drawGraph(thisGraph.d3data);

  if (thisGraph.config.debug) console.log("focusContextNodeOff end");
}

FluidGraph.prototype.fixUnfixNode = function(d3node, d) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("fixUnfixNode start");

  if (d3.event.defaultPrevented) return;

  var nodecircle = d3node.select("#nodecircle");
  var status;

  if (d.fixed == true) {
    thisGraph.removeSelectFromNode();
    status = "unfixed";
    return false;
  }
  else {
    thisGraph.replaceSelectNode(nodecircle, d);
    status = "fixed";
    return true;
  }

  if (thisGraph.config.debug) console.log("fixUnfixNode end");
  return status;
}

FluidGraph.prototype.replaceSelectNode = function(nodecircle, d) {
  var thisGraph = this;
  nodecircle.classed(thisGraph.consts.selectedClass, true);
  d.fixed = true;
  if (thisGraph.state.selectedNode) {
    thisGraph.removeSelectFromNode();
  }
  thisGraph.state.selectedNode = d;
};

FluidGraph.prototype.removeSelectFromNode = function() {
  var thisGraph = this;
  thisGraph.svgNodesEnter.filter(function(node) {
    if (node.id === thisGraph.state.selectedNode.id)
    {
      node.fixed = false;
      return true;
    }
  }).select("#nodecircle").classed(thisGraph.consts.selectedClass, false);
  thisGraph.state.selectedNode = null;
};

FluidGraph.prototype.addNode = function(thisGraph, newnode) {
  //Warning, here, we need "this" for mouse coord

  if (thisGraph.config.debug) console.log("addNode start");
  var xy = [];

  if (typeof this.__ondblclick != "undefined") //if after dblclick
  {
    xy = d3.mouse(this);
  } else {
    xy[0] = thisGraph.config.xNewNode;
    xy[1] = thisGraph.config.yNewNode;
  }

  if (typeof newnode == "undefined")
    var newnode = {}

  if (typeof newnode.label == "undefined")
    newnode.label = "new";
  if (typeof newnode.type == "undefined")
    newnode.type = thisGraph.customNodes.typeOfNewNode;
  if (typeof newnode.identifier == "undefined")
    newnode.identifier = thisGraph.config.uriBase + (thisGraph.d3data.nodes.length);
  if (typeof newnode.id == "undefined")
    newnode.id = thisGraph.nodeidct++;

  if (typeof newnode.px == "undefined")
    newnode.px = xy[0];
  if (typeof newnode.py == "undefined")
    newnode.py = xy[1];
  if (typeof newnode.x == "undefined")
    newnode.x = xy[0];
  if (typeof newnode.y == "undefined")
    newnode.y = xy[1];
  // if (typeof newnode.weight == "undefined")
  //   newnode.weight = 1;

  thisGraph.d3data.nodes.push(newnode)

  thisGraph.drawGraph();

  if (thisGraph.config.debug) console.log("addnode end");
  return newnode.identifier;
}

FluidGraph.prototype.nodeOnMouseDown = function(d3node, d) {
  thisGraph = this;

  if (thisGraph.config.debug) console.log("nodeOnMouseDown start");

  if (thisGraph.state.editedNode)
  {
    var editedNode = thisGraph.state.editedNode
  }

  if (d3node.node() != editedNode)
  {
    thisGraph.state.mouseDownNode = d;
    // thisGraph.state.selectedNode = d;
    thisGraph.state.svgMouseDownNode = d3node;

    //initialise drag_line position on this node
    thisGraph.drag_line.attr("d", "M" + thisGraph.state.mouseDownNode.x + " " + thisGraph.state.mouseDownNode.y + " L" + thisGraph.state.mouseDownNode.x + " " + thisGraph.state.mouseDownNode.y)
  }

  if (thisGraph.config.debug) console.log("nodeOnMouseDown end");
}

FluidGraph.prototype.nodeOnMouseUp = function(d3node, d) {
  //.on("mouseup",function(d){thisGraph.nodeOnMouseUp.call(thisGraph, d3.select(this), d)})
  // d3node = d3.select(this) = array[1].<g.node>

  thisGraph = this;

  if (thisGraph.config.debug) console.log("nodeOnMouseUp start");

  // if we clicked on an origin node
  if (thisGraph.state.mouseDownNode) {
    thisGraph.state.mouseUpNode = d;
    // thisGraph.state.selectedNode = d;
    // if we clicked on the same node, reset vars
    if (thisGraph.state.mouseUpNode.identifier == thisGraph.state.mouseDownNode.identifier) {
      if (thisGraph.config.editGraphMode == true)
        thisGraph.fixUnfixNode(d3node, d);

      thisGraph.resetMouseVars();
      return;
    }

    //Drop on an other node --> create a link
    if (thisGraph.config.editGraphMode == true)
    {
      thisGraph.fixUnfixNode(thisGraph.state.svgMouseDownNode, d);
      thisGraph.drag_line.attr("visibility", "hidden");
      thisGraph.addLink(thisGraph.state.mouseDownNode.identifier, thisGraph.state.mouseUpNode.identifier);
      thisGraph.resetMouseVars();
    }
  }

  if (thisGraph.config.debug) console.log("nodeOnMouseUp end");
}

FluidGraph.prototype.nodeOnDragStart = function(d, i) {
  //Here, "this" is the <g.node> where mouse drag
  thisGraph = this;

  if (thisGraph.config.debug) console.log("nodeOnDragStart start");

  d3.event.sourceEvent.stopPropagation();

  if (d.fixed != true) {
    thisGraph.drag_line.attr("visibility", "visible");
  }

  if (thisGraph.config.debug) console.log("nodeOnDragStart end");
}

FluidGraph.prototype.nodeOnDragMove = function(d, i) {
  //Here, "this" is the <g.node> where mouse drag
  thisGraph = this;

  if (thisGraph.config.debug) console.log("nodeOnDragMove start");

  if (thisGraph.state.editedNode)
  {
    if (thisGraph.state.editedNode.__data__.id === d.id)
      return;
    else thisGraph.closeNode.call(thisGraph, "edited");
  }

  if (thisGraph.state.openedNode)
  return;

  if (d.fixed != true) //false or undefined
  {
    //drag node
    d.px += d3.event.dx;
    d.py += d3.event.dy;
    d.x += d3.event.dx;
    d.y += d3.event.dy;
    thisGraph.movexy();
    thisGraph.drag_line.attr("visibility", "hidden");
    thisGraph.resetMouseVars();
  }

  if (thisGraph.config.debug) console.log("nodeOnDragMove end");
}

FluidGraph.prototype.nodeOnDragEnd = function(d, i) {
  //Here, "this" is the <g.node> where mouse drag
  thisGraph = this;

  if (thisGraph.config.debug) console.log("nodeOnDragEnd start");

  if (thisGraph.config.elastic == "On") {
    if (d.fixed != true) {
      thisGraph.movexy();
      thisGraph.force.start();

      if (thisGraph.state.selectedLink) {
        thisGraph.removeSelectFromLinks();
      }

      if (thisGraph.state.selectedNode) {
        thisGraph.removeSelectFromNode();
      }
    }
  }

  if (thisGraph.config.debug) console.log("nodeOnDragEnd end");
}

FluidGraph.prototype.deleteNode = function(nodeIdentifier) {
  var thisGraph = this;

  if (thisGraph.config.debug) console.log("deleteNode start");

  if (thisGraph.d3data.nodes.length > 0) {
    //delete args or the first if not arg.
    var nodeIdentifier = nodeIdentifier || thisGraph.d3data.nodes[0].identifier;
    index = thisGraph.searchIndexOfNodeId(thisGraph.d3data.nodes, nodeIdentifier);

    //delete node
    thisGraph.d3data.nodes.splice(index, 1);

    //delete edges linked to this (old) node
    thisGraph.spliceLinksForNode(index);

    thisGraph.removeSelectFromNode();
    thisGraph.state.selectedNode = null;
    thisGraph.drawGraph();
  } else {
    console.log("No node to delete !");
  }
  if (thisGraph.config.debug) console.log("deleteNode end");
}
