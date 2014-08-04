<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/jqTree/jqtree.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/underscore.min.1.3.3.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/backbone.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/vie-2.1.0.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/vie-widgets.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/jqTree/tree.jquery.js' , CClientScript::POS_END);
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
    <div class="results"></div>
    <div id="tree" data-url=""></div>
    <div id="formBtn" class="hide" ><a class="btn btn-primary" href="javascript:buildForm()">Show Form</a></div>
  </div>
  <div  class="col-md-6">
    <div id="form"></div>
    <textarea id="jsonSchema" class="w100p " style="height:400px;background-color: #1B1E24;color:white;" placeholder="json Schema"></textarea>
  	<textarea id="jsonRDFInstance" class="w100p" style="height:400px;background-color: #1B1E24;color:white;" placeholder="json RDF Instance"></textarea>
    <textarea id="jsonData" class="w100p hide" style="height:400px;background-color: #1B1E24;color:white;" placeholder="json Data"></textarea>
  </div>
</div>


<script type="text/javascript">

var jsonRDFInstance = {"@context": "http://schema.org"};
var jsonSchema = { title:"TEST 123", type:"object", properties:{} };
var jsonData = null;
var jsonDataId = 0;
var schema = null;
var selectedNodes = [];
var rootType = null;

$(document).ready( function() { 
	console.clear();
  $("#jsonRDFInstance").val("");
  $("#jsonSchema").val("");
  $("#jsonData").val("");
  fetchRDF();
  
} );

function fetchRDF(){
  var vie = new VIE();
  $(".results").html("");
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
            $(".results").append('<div class="msg">Something went wrong with loading the ontology!</div>');
        }
    });
  } 
  else
    drawJson(ontology);
}

function drawJson ( ontology ) 
{
  rootType = ontology;
  jsonRDFInstance = {"@context": "http://schema.org","@Type" : ontology};
  jsonData = {id : jsonDataId++, label : ontology, children: buildData( ontology ) };
  
  //buildRDFInstance( ontology,true );
  buildTree();
  $("#jsonData").val( JSON.stringify(jsonData, null, 4) ); 
  applyChanges();
  $("#formBtn").removeClass("hide");
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
	    //selectedNodes.push(id);
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
//in case we want to fill all properties onload of the Type
/*function buildRDFInstance(key, build){
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
		//console.log("buildRDFInstance",key);
		for (var attrname in json) 
		{ 
      //fill RDF instance onclick
			//jsonRDFInstance[attrname] = json[attrname]; 
		}
	}
  }
}*/

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
            //console.log('tree.click',selected_node.name,$('#tree').tree('isNodeSelected', selected_node) );
            if ( $('#tree').tree('isNodeSelected', selected_node) ) 
            {
              //select an element in the jqtree
            	if(selected_node.name.indexOf("Type::")<0)
            	{
            		$('#tree').tree( 'removeFromSelection' , selected_node );
                removejsonRDFInstance(selected_node);
	              applyChanges();
	            }
            }
            else 
            {
              //select an element in the jqtree
              //exception for subTypes
            	if(selected_node.name.indexOf("Type::")<0)
            	{

	                console.log('addToSelection',
                              selected_node.name,
                              selected_node.parent.parent.name,
                              "lvl = "+selected_node.getLevel());
	                $('#tree').tree('addToSelection', selected_node);
                  //exception needed when the select Node is in depth
                  add2jsonRDFInstance(selected_node);
                  applyChanges();
            	} 
            	else 
            	{
            		//subtypes are not loaded at first 
            		//this is a hack because the on-demand open event doesn't work
            		//so we are using the click and selected element to fetch the subtype definition 
            		//and build the corresponding tree
            		type = selected_node.name.substring(6,selected_node.name.length);
            		var data = buildData(type);
			          $('#tree').tree('loadData', data, selected_node );
					      $('#tree').tree('openNode', selected_node );
            	}
            }
        }
    );

    /*$('#tree').bind(
	    'tree.open',
	    function(e) {
	    	e.preventDefault();
	    	var selected_node = e.node;
	    	//console.log("open Node Event",selected_node.name);
	    }
	);*/

	$('#tree').on('tree.open', function(e) {
    console.log('tree.open',e);
  });
}

function add2jsonRDFInstance(node)
{
  parents = [];
  parenttypes = [];
  selectedNodeName = node.name;
  while (node.parent.name != undefined) {
      if(node.parent.name != rootType)
      {
        if(node.parent.name.indexOf("Type::")<0 )
        {
          parents.unshift(node.parent.name);
        }else{
          parenttypes.unshift(node.parent.name.substring(6,node.parent.name.length));
        }
      }
      node = node.parent;
  }
  //console.log(parents);
  //console.log(parenttypes);
  //console.log("build parents");
  parentNode = jsonRDFInstance;
  
  while(parents.length > 0)
  {
    parentName = parents.shift();
    parentType = parenttypes.shift();
    //console.log("build parents",parentName,parentType);
    if(typeof parentNode[parentName] != "object")
    {
      parentNode[parentName]={};
      parentNode[parentName]["@Type"]=parentType;
    }
    parentNode = parentNode[parentName];
  } 
  parentNode[selectedNodeName]="";
}

function removejsonRDFInstance(node)
{
  if(node.parent.parent.name != undefined)
  {
      delete jsonRDFInstance[node.parent.parent.name][node.name];
      if( Object.keys( jsonRDFInstance[node.parent.parent.name] ).length == 1)
        jsonRDFInstance[node.parent.parent.name] = "";
  } 
  else
      delete jsonRDFInstance[node.name];
}
function applyChanges()
{
  $("#jsonRDFInstance").val( JSON.stringify(jsonRDFInstance, null, 4) ); 
  buildJsonSchema();
}
function buildJsonSchema()
{
    convert( $.parseJSON( $("#jsonRDFInstance").val() ) , null );
    $("#jsonSchema").val( JSON.stringify(jsonSchema, null, 4) );
}
function convert(jsonSrc,prefix)
{
    //jsonSchema = { title:rootType, type:"object", properties:{} };
    $.each(jsonSrc , function(k,v){
      key = ( prefix != null ) ?  (k==0) ? prefix+'(array)' : prefix+'('+k+')' : k;
      //console.log(typeof v,key,k, typeof k);
      if( typeof k != "number" && k.indexOf("@") >= 0 )
        jsonSchema.properties[key] = { "value" : v,"inputType" : "hidden" };
      else if(typeof k == "number" && k > 0)
        console.warn(key+" not rendered");
      else if(typeof v == "object"){
        console.info("build an object definition : "+key)
        convert(v,key);
      } else if(typeof v == "array"){
        console.info("build an array definition"+key+'(list)');
        convert(v[0],key+'(list)');
      } else
        jsonSchema.properties[key] = { "inputType" : "text" };
    });
  }
  function buildForm(){
    $("#form").html("");
    $.ajax({
        url:baseUrl+"/common/GetMicroformatHTML",
        type:"POST",
        data : { 
          "key" : rootType.toLowerCase(),
          "collection" : null,
          "id" : null,
          "microformat" : { "jsonSchema" : $.parseJSON( $("#jsonSchema").val() ) } },
        dataType:"json",
        success:function(data) 
        {
          $("#flashInfoLabel").html(data.title);
          $("#flashInfoContent").html(data.content);
          $("#flashInfoSaveBtn").html('<a class="btn btn-warning " href="javascript:;" onclick="$(\'#flashForm\').submit(); return false;"  >Enregistrer</a>'); 
          $("#flashInfo").modal('show');
        },
        error:function (xhr, ajaxOptions, thrownError)
        {
          $("#flashInfoContent").html(data.content);
        } 
    });
  }
</script>