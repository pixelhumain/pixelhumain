<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/jqtree/jqtree.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/underscore.min.1.3.3.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/backbone.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/vie-2.1.0.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/vie-widgets.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jqtree/tree.jquery.js' , CClientScript::POS_END);
//$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/jqtree/extra/bower_components/jquery-mockjax/jquery.mockjax.js' , CClientScript::POS_END);
?>

<div class="row mb20">
  Choose a Type (Ontology)
  <select id="ontologies" onchange="drawJson($(this).val())" >
    <option value=""></option>
    <option value="Event">Event</option>
  </select>
  Microformat from DB
  <select id="microformat" onchange="" >
    <option value=""></option>
    <option value="Event">Event</option>
  </select>
</div>

<div class="row">
  
  <div  class="col-md-6">
  	<textarea id="jsonSchema" class="w100p" style="height:400px;background-color: #1B1E24;color:white;" ></textarea>
    <textarea id="jsonData" class="w100p" style="height:400px;background-color: #1B1E24;color:white;" ></textarea>
  </div>

  <div  class="col-md-6">
    <div class="results"></div>
    <div id="tree" data-url=""></div>
  </div>

</div>

<script type="text/javascript">

var jsonSchema = {"@context": "http://schema.org"};
var jsonData = null;
var jsonDataId = 0;
var schema = null;
var selectedNodes = [];
var rootType = null;

$(document).ready( function() { 
	console.clear();
  $("#jsonSchema").val("");
  $("#jsonData").val("");
  results = $(".results");
  
  fetchRDF('.results');
  
} );

function fetchRDF(id, ontology){
  var vie = new VIE();
  results.html("");
  if( schema == null )
  {
    vie.loadSchema(baseUrl+"/data/all.json",//"http://schema.rdfs.org/all.json", 
    {
        baseNS : "http://schema.org",
        success: function () 
        {
            //schema carries the retreived all.json file 
            //once it's fetched never fetch again in one session
          schema = this.types; 
            
          $.each(this.types.list(), function(k,v)
          {
            if(v.metadata.label != undefined)
            {
              //log(v);
              ontology = v.id.substring(18,v.id.length-1);
              $("#ontologies").append("<option value='"+ontology+"'>"+v.metadata.label+"</option>");
            }
          });
        },
        error: function () {
            results.append('<div class="msg">Something went wrong with loading the ontology!</div>');
        }
    });
  } 
  else
    drawJson(ontology);
}

function drawJson ( ontology ) 
{
  rootType = ontology;
  jsonSchema = {
  	"@context": "http://schema.org",
  	"@Type" : ontology
  };
  jsonData = {
  	id : jsonDataId++,
  	label : ontology,
  	children: buildData( ontology )
  };
  buildSchema( ontology,true );
  buildTree();
  $("#jsonData").val( JSON.stringify(jsonData, null, 4) ); 
  $("#jsonSchema").val( JSON.stringify(jsonSchema, null, 4) ); 
}

function buildData(key){
  children = [];
  var onto = schema.get(key);
  if( onto != undefined && onto.attributes.list())
  {
	  $.each( onto.attributes.list(), function(k,v)
	  {
	    ontology = v.id.substring(18,v.id.length-1);
	    id = jsonDataId++;
	    selectedNodes.push(id);
	    jsonDataOnto = {
		  	id : id,
		  	label :  ontology
		};
	    if(v.range.length > 0)
	    {
	      jsonDataOnto.children = [];
	      $.each(v.range, function(i,v2)
	      {
	        if( v2 != "Text" && v2 != "Thing" && v2 != "Number" && v2 != "Integer" && v2 != "URL"
	         && v2 != "DateTime" && v2 != "Date" )
	        {
			  	id = jsonDataId++;
				jsonDataOnto.children.push({
				  	id : id,
				  	label :  "Type::"+v2,
				  	load_on_demand:1 
				});
	        }
	      });
	    } 
	    children.push(jsonDataOnto);
	  });
	}
  return children;
}
function buildSchema(key, build){
  var onto = schema.get(key);
  var json = {};
  if( onto != undefined && onto.attributes.list())
  {
	  $.each( onto.attributes.list(), function(k,v)
	  {
	    ontology = v.id.substring(18,v.id.length-1);
		json[ontology] = "";
	  });
	
	if(build)
	{
		console.log("buildSchema",key);
		for (var attrname in json) 
		{ 
			jsonSchema[attrname] = json[attrname]; 
		}
	}
  }
}

var activeNode = null;
function buildTree()
{
	console.dir(jsonData);
	$(".results").html("");
	$('#tree').tree({autoOpen: true});
	$('#tree').tree('loadData', [jsonData]);
	
	$.each(selectedNodes, function(i,v){
		var node = $('#tree').tree('getNodeById', v);
		$('#tree').tree('addToSelection', node);
	});

    $('#tree').bind(
        'tree.click',
        function(e) 
        {
            // Disable single selection
            e.preventDefault();
            var selected_node = e.node;
            if (selected_node.id == undefined) 
                console.log('The multiple selection functions require that nodes have an id');
            console.log('tree.click',selected_node.name,$('#tree').tree('isNodeSelected', selected_node) );
            if ( $('#tree').tree('isNodeSelected', selected_node) ) 
            {
            	if(selected_node.name.indexOf("Type::")<0)
            	{
            		$('#tree').tree('removeFromSelection', selected_node);
            		if(selected_node.parent.parent.name != undefined){
	                	delete jsonSchema[selected_node.parent.parent.name][selected_node.name];
	                	if( Object.keys( jsonSchema[selected_node.parent.parent.name] ).length == 1)
	                		jsonSchema[selected_node.parent.parent.name] = "";
	                } else
	            		delete jsonSchema[selected_node.name];
	                $("#jsonSchema").val( JSON.stringify(jsonSchema, null, 4) ); 
	            } else 
	            {
            		alert("open Node Type del");
            	}
            }
            else 
            {
            	if(selected_node.name.indexOf("Type::")<0)
            	{

	                console.log('addToSelection',selected_node.name,selected_node.parent.parent.name);
	                $('#tree').tree('addToSelection', selected_node);
	                if(selected_node.parent.parent.name != undefined){
	                	if(typeof jsonSchema[selected_node.parent.parent.name] != "object"){
	                		jsonSchema[selected_node.parent.parent.name]={};
	                		jsonSchema[selected_node.parent.parent.name]["@Type"]=selected_node.parent.name.substring(6,selected_node.parent.name.length);
	                	}
	                	jsonSchema[selected_node.parent.parent.name][selected_node.name]="";
	                } else
	                	jsonSchema[selected_node.name]="";
	                $("#jsonSchema").val( JSON.stringify(jsonSchema, null, 4) ); 
            	} 
            	else 
            	{
            		//subtypes are not loaded at first 
            		//this is a hack because the on-demand open event doesn't work
            		//so we are using the click and selected element to fetch the subtype definition 
            		//and build the corresponding tree
            		type = selected_node.name.substring(6,selected_node.name.length);
            		var data = buildData(type);
			        $('#tree').tree('loadData', data, selected_node);
					$('#tree').tree('openNode', selected_node);
					
            	}
            }
        }
    );

    $('#tree').bind(
	    'tree.open',
	    function(e) {
	    	e.preventDefault();
	    	var selected_node = e.node;
	    	console.log("open Node Event",selected_node.name);
	    }
	);
	
}
</script>