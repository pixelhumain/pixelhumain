<?php 
$cs = Yii::app()->getClientScript();


$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/underscore.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/backbone.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/vie-2.1.0.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/vie-widgets.js' , CClientScript::POS_END);
/*
?>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="dist/jquery.bootstrap-duallistbox.min.js"></script>
<link rel="stylesheet" type="text/css" href="../src/bootstrap-duallistbox.css">
*/?>

<div class="row mb20">
  Choose a Type (Ontology)
  <select id="ontologies" onchange="drawJson('.results',$(this).val())" >
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
    <textarea id="sampleJson" class="w100p" style="height:400px;background-color: #1B1E24;color:white;" ></textarea>
  </div>

  <div  class="col-md-6">
    <div class="results" class="debug"></div>
  </div>

</div>

<script type="text/javascript">

var jsonSample = {"@context": "http://schema.org","toto":{"titi":"cococ"}};
var schema = null;

$(document).ready( function() { 
  results = $(".results");
  $("#sampleJson").html("");
  fetchRDF('.results');
  fetchRDF('.results',"Thing");
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
            if(ontology)
            {
              //alert(ontology);
              drawJson(id,ontology);
            } 
            else
            {
              $.each(this.types.list(), function(k,v)
              {
                if(v.metadata.label != undefined)
                {
                  //log(v);
                  ontology = v.id.substring(18,v.id.length-1);
                  $("#ontologies").append("<option value='"+ontology+"'>"+v.metadata.label+"</option>");
                }
              });
            }
        },
        error: function () {
            results.append('<div class="msg">Something went wrong with loading the ontology!</div>');
        }
    });
  } 
  else
    drawJson(ontology);
}

function drawJson ( id, ontology ) 
{
  jsonSample = {"@context":"http://schema.org"};
  $(id).html("");
  $(id).append('<h1> ' + ontology + '</h1>classes loaded!<br/>');
  var Onto = schema.get(ontology);
  log(Onto,"dir");
  //$(id).append(" <input type='checkbox' value='toto.titi' onclick='toggleJsonSampleField ($(this).val() )'  checked/> toto titi<br/>");
  draw( id, Onto.attributes.list() );  
  $("#sampleJson").val( JSON.stringify(jsonSample, null, 4) ); 
}


function draw(id, list){
  log(id)
  dest = $(id);
  $.each( list, function(k,v)
  {
    //log(v);
    ontology = v.id.substring(18,v.id.length-1);
    if(v.range.length > 0)
    {
      $.each(v.range, function(i,v2)
      {
        if( v2 != "Text" && v2 != "Thing" && v2 != "Number"  && v2 != "Integer" )
        {
          blockId = ( id != ".results" ) ? id+"."+ontology : ontology;
          dest.append("<div id='"+blockId+"'><input type='checkbox'  value='"+ontology+"' onclick='toggleJsonSampleField ($(this).val() )' checked/> "+ontology+" ( <a href='javascript:;' onclick='slideDown(\"#sub_"+blockId+"\")'>"+v2+"</a> )</div>");
          //build sub properties for subType
          $("#"+blockId).append("<div class='w300 pl20 debug mb20 hide' id='sub_"+blockId+"'> building : "+v2+"</div>");
          jsonSample[ontology] = drawSub( blockId, v2 );
        }
      });
    } 
    else 
    {
      dest.append(" <input type='checkbox' name='"+ontology+"' checked/> "+ontology+"<br/>");
      jsonSample[ontology] = "";
    }
  });
}
function drawSub(id, ontology)
{
  console.log("drawSub",id,ontology);
  var Onto = schema.get(ontology);
  list = Onto.attributes.list();
  destsub = $("#sub_"+id);
  json = {};
  json["@Type"] = ontology;
  $.each(list, function(k,v)
  {
      //log(v);
      ontology = v.id.substring(18,v.id.length-1);
      if(v.range.length > 0)
      {
        $.each(v.range, function(i,v2)
        {
          if( v2 != "Text" && v2 != "Thing" && v2 != "Number"  && v2 != "Integer" )
          {
            destsub.append("<div><input type='checkbox'  value='"+ontology+"' onclick='toggleJsonSampleField ($(this).val() )' checked/> "+ontology+" ( <a href='getSub('"+v2+"')'>"+v2+"</a> )</div>");
            if(schema.get(ontology)){
              json[ontology] = drawSub( blockId, ontology );
            }
          }

        });
      } 
      else 
      {
        destsub.append(" <input type='checkbox' name='"+ontology+"' checked/> "+ontology+"<br/>");
        jsonSample[ontology] = "";
      }
    });
  return json;
}



function toggleJsonSampleField(id)
{
  //if( !$("#"+id).prop('checked'))
  alert(id);
  if(id.indexOf(".") > 0)
  {
    ids = id.split(".");
    delete jsonSample[ ids[0] ][ ids[1] ];
    //TODO : if parent is empty delete it 
  } else
    delete jsonSample[id];
  /*else
    jsonSample[id] = {};*/
  $("#sampleJson").val( JSON.stringify(jsonSample, null, 4) );  
}

</script>