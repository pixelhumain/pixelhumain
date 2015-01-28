var link;
var vertices = [];
var linkValue;
var dataFile;
var tickNum;
var tabTick = [];
var tabId = [];
var objectTarget = null;
var width = $("#svg").width();
var height = 725;
var tipCirclePack = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0]);

var tipCirclePack1 = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0]);

var tipCirclePack2 = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0]);

var tipCirclePack3 = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0]);

var tipCirclePack4 = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0]);

var svg = d3.select("#svg").append("svg")
      .attr("width", width)
      .attr("height", height)
      .attr("xlink:href", "images/img3.png")
      .call(tipCirclePack1)
      .call(tipCirclePack2)
      .call(tipCirclePack3)
      .call(tipCirclePack4)
      .call(tipCirclePack);


function grapLinkBanner(datafile){

	d3.json(datafile, function(error, data) {
    dataFile=data;
		var circleRadius = 10;
		
    link = svg.selectAll("line");

    var t = [];
    var n = 0;
    var compt = 0;
    $.each(data, function (k, elem) {
      compt++;
    });
		$.each(data, function (k, elem) {
      if(n<compt/2){
        elem.x = _.random(0, width/4);
        elem.y = _.random(0, height);
      }else{
        elem.x = _.random((3/4)*width, width);
        elem.y = _.random(0, height);
      }
      t[n]= elem;
      vertices[n] = [elem.x, elem.y];
      n++;

		})

		var nodes = svg.selectAll("circle")
			.data(t);

    //nodes.call(tipCirclePack);
    var idCompt = 0;
		
    var vertices1 = [];
    var vertices2 = [];

    nodes.append("image")
      .attr("xlink:href", "images/img3.png")



    for (var i = 0; i<vertices.length; i ++){
      if(i<compt/2){
        vertices1[i] = vertices[i];
      }
      else{
        vertices2[i-compt/2] = vertices[i];
        }
    }
    for(var i=0; i<4; i++){
      vertices1[vertices1.length] = [0, _.random(0, height)];
      vertices1[vertices1.length] = [_.random(0, width/4), 0];
      vertices1[vertices1.length] = [_.random(0, width/4), height];
      vertices2[vertices2.length] = [width, _.random(0, height)];
      vertices2[vertices2.length] = [_.random(3/4*width, width), 0];
      vertices2[vertices2.length] = [_.random(3/4*width, width), height];
    }
    var linkValuePart1 = d3.geom.delaunay(vertices1);
    var linkValuePart2 = d3.geom.delaunay(vertices2);
   
    var linkValueR = [];
    
    for(var i= 0; i<(linkValuePart1.length+linkValuePart2.length); i++){
      if(i<linkValuePart1.length){
         linkValueR[i] = linkValuePart1[i];
       }else{
          linkValueR[i] = linkValuePart2[i-linkValuePart1.length];
       }
    }
    
    linkValue = [];
    var n = 0;
    for(var i = 0; i<linkValueR.length; i++){
      for(var j =0; j<linkValueR[i].length-1; j ++){
        linkValue[n]=[];
        linkValue[n][0] = linkValueR[i][j][0];
        linkValue[n][1] = linkValueR[i][j][1];
        linkValue[n][2] = linkValueR[i][j+1][0];
        linkValue[n][3] = linkValueR[i][j+1][1];
        n++;
        if(j+2<linkValueR[i].length){
          linkValue[n]=[];
          linkValue[n][0] = linkValueR[i][j][0];
          linkValue[n][1] = linkValueR[i][j][1];
          linkValue[n][2] = linkValueR[i][j+2][0];
          linkValue[n][3] = linkValueR[i][j+2][1];
          n++;
        }
      }    
    }
    link.data(linkValue).enter().append("line")
                .attr("class", "bindLine")
                .attr("x1", function(d){return d[0];})
                .attr("y1", function(d){return d[1];})
                .attr("x2", function(d){return d[2];})
                .attr("y2", function(d){return d[3];});

    nodes.enter().append("circle")
      .attr("class", "node")
      .attr("id", function(d, idCompt){idCompt++; return idCompt;})
      .attr("cy", function(d) {return d.y;})
      .attr("cx", function(d) {return d.x;})
      .attr("r", circleRadius)
      .on("mouseover", expandNode)
      .on("mouseout", contractNode);
    nodes.enter().append("image")
      .attr("xlink:href", "images/img3.png") 
    getTipsOpen(20);
    animateTips(20);          
})
}


function getTipsOpen(c){
  var id = [];
  for(var i=0; i<5; i++){
    var n = _.random(1, c)
    while($.inArray(n, id) != -1){
      n=_.random(1, c);
    }
    id[i] = n;
  }
  //console.log(id);
}

function animateTips(c){
  var id = _.random(1, c);
  $("#"+id).d3MouseOver();
  setTimeout(function(){
    animateTips(c);
  }, 5000); 
};


//Tooltips and the radius cercle transition on over/out

function getTips(object, id){
  var n = 1;
  var nameTips = "";
  var commentTips = "";
  var d = null;
  var returnObj = null;
  $.each(dataFile, function(key,obj){
      //console.log("n", n, "id", id);
       if(n == id){
        //console.log("------------------------", obj);
          d = obj;
          comment = obj.comment.comment;
          //console.log(obj.comment, obj["comment"]);
        }
        n++
    });
  var n = _.random(1, 5);
  tip = chooseTips(n);
  
  var index = $.inArray(n, tabTick);
  if(index !=-1){
    tabTick = $.grep(tabTick, function(value) {
      return value != n;
    });
    
    console.log(tabId[index]);
    var indexTab = tabId[index];
    if($.inArray(indexTab, tabId)==-1){
      $("#"+indexTab).d3MouseOut();
    }
    console.log(tabId);
    $("#"+indexTab).css("fill", "#ccc");
    tabId = $.grep(tabId, function(value) {
      return value != indexTab;
    });
    if($.inArray(indexTab, tabId)==-1){
      $("#"+indexTab).d3MouseOut();
    }
  }
  if($.inArray(id, tabId) ==-1){
    tabTick.push(n);
    tabId.push(id);
    $("#"+id).css("fill", "yellow");
  //console.log("tab", tabTick,"tabId", tabId);
    tip.html("<div id ='tool-d3'> <span><strong>"+ d.name+": </strong> </br>"+comment+"</span></div>")
    returnObj = tip.show(object); 
  }
  return returnObj;  
}

// Choose of the tooltip layout
function chooseTips(n){
  
  var tips;
  switch(n){
    case(1):
      tips= tipCirclePack;
    break;
    case(2):
      tips= tipCirclePack1;
    break;
    case(3):
      tips = tipCirclePack2;
    break;
    case(4):
      tips = tipCirclePack3;
    break;
    case(5):
      tips = tipCirclePack4;
    break;
  }
  return tips;
}

/*------------------------------------------------------
--- TRANSITIONS
-------------------------------------------------------*/

 // provides node animation for mouseover
function expandNode() {
    //console.log("expandNode");
    getTips(d3.select(this), d3.select(this).attr("id"));
    d3.select(this).transition()
        .duration(500)
        .attr("r",20)
};


// provides node animation for mouseout
function contractNode(){
    d3.select(this).transition()
        .duration(5000)
        .attr("r",10)

};


/*----------------------------------------------------
--- MOUSE EVENTS
-----------------------------------------------------*/

//launch mouseover event for the d3 graph
jQuery.fn.d3MouseOver = function () {
    this.each(function (i, e) {
      ////console.log("over");
      var evt = document.createEvent("MouseEvents");
      evt.initMouseEvent("mouseover", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);

      e.dispatchEvent(evt);
    });
  };

//launch mouseout event for the d3 graph
jQuery.fn.d3MouseOut = function () {
    this.each(function (i, e) {
      //console.log("out");
      var evt = document.createEvent("MouseEvents");
      evt.initMouseEvent("mouseout", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);

      e.dispatchEvent(evt);
    });
  };