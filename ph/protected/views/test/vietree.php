<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/test/jqtree/jqtree.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/underscore.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/backbone.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/vie-2.1.0.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/vie-widgets.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/jqtree/tree.jquery.js' , CClientScript::POS_END);
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
    <div id="tree"  data-url=""></div>
  </div>

</div>

<script type="text/javascript">

var jsonSchema = {"@context": "http://schema.org"};
var jsonData = null;
var jsonDataId = 0;
var schema = null;
var selectedNodes = [];

$(document).ready( function() { 
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
  jsonSchema = {
  	"@context": "http://schema.org",
  	"@Type" : ontology
  };
  jsonData = {
  	id : jsonDataId++,
  	label : ontology,
  	children: buildData( ontology )
  };
  buildTree();
  $("#jsonData").val( JSON.stringify(jsonData, null, 4) ); 
  $("#jsonSchema").val( JSON.stringify(jsonSchema, null, 4) ); 
}

function buildData(key){
	log(key);
  children = [];
  var onto = schema.get(key);
  if( onto != undefined && onto.attributes.list()){
  $.each( onto.attributes.list(), function(k,v)
  {
    ontology = v.id.substring(18,v.id.length-1);
    id = jsonDataId++;
    selectedNodes.push(id);
    jsonDataOnto = {
		  	id : id,
		  	label :  ontology 
		  };
	jsonSchema[ontology] = "";
    if(v.range.length > 0)
    {
      jsonDataOnto.children = [];
      //jsonSchema[ontology] = {};
      jsonSchema[ontology] = "";
      $.each(v.range, function(i,v2)
      {
        if( v2 != "Text" && v2 != "Thing" && v2 != "Number"  && v2 != "Integer" )
        {
        	
		  // ontoChildren = buildData( v2 );
		  /*if(ontoChildren.length > 0 )
		  	jsonDataOnto.children = ontoChildren;
		  else*/
		  	id = jsonDataId++;
			jsonDataOnto.children.push({
			  	id : id,
			  	label :  v2,
			  	load_on_demand:1 
			});
			jsonSchema[ontology]["@Type"] = v2;
        }
      });
    } 
    children.push(jsonDataOnto);
  });
}
  return children;
}

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
            if ($('#tree').tree('isNodeSelected', selected_node)) 
            {
            	$('#tree').tree('removeFromSelection', selected_node);
            	delete jsonSchema[selected_node.name];
                $("#jsonSchema").val( JSON.stringify(jsonSchema, null, 4) ); 
            }
            else 
            {
                console.log('addToSelection',selected_node.name);
                $('#tree').tree('addToSelection', selected_node);
                jsonSchema[selected_node.name]="";
                $("#jsonSchema").val( JSON.stringify(jsonSchema, null, 4) ); 
            }
        }
    );

    $('#tree').bind(
	    'tree.select',
	    function(e) {
	    	e.preventDefault();
	    	var selected_node = e.node;
	    	alert(selected_node.name);
	        var node = $('#tree').tree('getNodeById', 2);
			var data = [
			    { label: 'new node' },
			    { label: 'another new node' }
			];
			$('#tree').tree('loadData', data, node);
	    }
	);
	
}
</script>