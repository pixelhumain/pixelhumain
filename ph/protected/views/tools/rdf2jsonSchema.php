<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
$this->pageTitle= "Convert RDF instance to Formatted Json Schema" ;
?>
<h1> Convert RDF instance to Formatted Json Schema  </h1>

<div class="fl col-md-6">
	Get Existing Microformats 
	<select id="getMicroformat">
		<option></option>
		<?php 
			$microformats = PHDB::find( PHType::TYPE_MICROFORMATS, array(), array( "key") );
			foreach ($microformats as $u) {
				echo '<option value="'.$u["_id"].'">'.$u["key"].'</option>';
			}
		?>
	</select>
	<br/>
	<a class="btn btn-primary " href="javascript:getMicroformat()">Get Json</a>
	<a class="btn btn-primary hide showBtn" href="javascript:showForm()">Show Form</a>
</div>

<div class="fl  col-md-6" id="getMicroformatSection">
	Get An Ontology<br/>
	TODO : import all schemas <br/>
	TODO : list all ontologies in select <br/>
	TODO : and build a sample instance <br/>
	TODO : microformat builder checkbox interface of all field of an ontology<br/>
	<select id="getOntology"></select>
	<a class="btn btn-primary " href="javascript:getOntology()">Get Ontology and Build JSON</a>
</div>

<div class="fl clear w100p convertBtn">
<a class="btn btn-primary " href="javascript:buildJsonSchema()">Convert</a>
<br/>TODO : Add JSON Editor
</div>

<div style="float:left;padding:20px;" class="convertSrc col-md-6">
	<textarea id="rdfinstance"  class="w100p" style="height:400px;color:white;background-color: #000;" placeholder="RDF instance JSON">
<?php if(isset($_GET["src"]) && $_GET["src"]==1)
{
?>
{
  "@context": "http://schema.org",
  "@type": "MusicGroup",
  "event": [
    {
      "@type": "Event",
      "location": "Memphis, TN, US",
      "offers": "ticketmaster.com/foofighters/may20-2011",
      "startDate": "2011-05-20",
      "url": "foo-fighters-may20-fedexforum"
    },
    {
      "@type": "Event",
      "location": "Council Bluffs, IA, US",
      "offers": "ticketmaster.com/foofighters/may23-2011",
      "startDate": "2011-05-23",
      "url": "foo-fighters-may23-midamericacenter"
    }
  ],
  "image": [
    "foofighters-1.jpg",
    "foofighters-2.jpg",
    "foofighters-3.jpg"
  ],
  "interactionCount": "UserComments:18",
  "name": "Foo Fighters",
  "track": [
    {
      "@type": "MusicRecording",
      "audio": "foo-fighters-rope-play.html",
      "duration": "PT4M5S",
      "inAlbum": "foo-fighters-wasting-light.html",
      "interactionCount": "UserPlays:14300",
      "name": "Rope",
      "offers": "foo-fighters-rope-buy.html",
      "url": "foo-fighters-rope.html"
    },
    {
      "@type": "MusicRecording",
      "audio": "foo-fighters-everlong-play.html",
      "duration": "PT6M33S",
      "inAlbum": "foo-fighters-color-and-shape.html",
      "name": "Everlong",
      "offers": "foo-fighters-everlong-buy.html",
      "playCount": "11700",
      "url": "foo-fighters-everlong.html"
    }
  ],
  "video": {
    "@type": "VideoObject",
    "description": "Catch this exclusive interview with Dave Grohl and the Food Fighters about their new album, Rope.",
    "duration": "T1M33S",
    "name": "Interview with the Foo Fighters",
    "thumbnail": "foo-fighters-interview-thumb.jpg"
  }
}
<?php } else {?>
{
"@context": "http://schema.org",
"@type": "Event",
"name": "Miami Heat at Philadelphia 76ers - Game 3 (Home Game 1)",
"location": {
"@type": "Place",
"address": {
"@type": "PostalAddress",
"addressLocality": "Philadelphia",
"addressRegion": "PA"
},
"url": "wells-fargo-center.html"
},
"offers": {
"@type": "AggregateOffer",
"lowPrice": "$35",
"offerCount": "1938"
},
"startDate": "2016-04-21T20:00",
"url": "nba-miami-philidelphia-game3.html"
}
<?php } ?>
	</textarea>
</div>
<div style="float:left;padding:20px;" class=" col-md-6">
	<textarea id="jsonSchema" class="w100p" style="overflow:auto;height:400px;background-color: #1B1E24;color:white;" placeholder="JSON Schema"></textarea>
</div>

<div style="float:left;padding:20px;">
	<input type="text" name="microformatName" id="microformatName" placeholder="microformat Name"/>
	<input type="text" name="microformatCollection" id="microformatCollection" placeholder="microformat Collection"/>
	<input type="text" name="microformatTemplate" id="microformatTemplate" placeholder="microformat Template" value="dynamicallyBuild"/>
	<br/>
	<a class="btn btn-primary hide saveMFBtn" href="javascript:saveMicroformat()">Save Microformat</a>
	<a class="btn btn-primary hide showBtn" href="javascript:showForm()">Show Form</a>
</div>

<script type="text/javascript">
	initT['initPage'] = function(){
		<?php
		if(isset($_GET["microformat"]))
		{
			$microformat = PHDB::findOne(PHType::TYPE_MICROFORMATS, array('key' => $_GET["microformat"] ));
			echo "$('#getMicroformat').val('".(string)$microformat["_id"]."');";
			echo "getMicroformat();";
		}
		?>
	};

	jsonSchema = {
		title:"",
		type:"object",
		properties:{}
	};
	function buildJsonSchema()
	{
		convert( $.parseJSON( $("#rdfinstance").val() ) , null );
		$("#jsonSchema").val( JSON.stringify(jsonSchema, null, 4) );
		$(".saveMFBtn").removeClass("hide");
	}
	function convert(jsonSrc,prefix)
	{
		$.each(jsonSrc , function(k,v){
			key = ( prefix != null ) ?  (k==0) ? prefix+'[array]' : prefix+'['+k+']' : k;
			console.log(typeof v,key,k, typeof k);
			if( typeof k != "number" && k.indexOf("@") >= 0 )
				jsonSchema.properties[key] = { "value" : v,"inputType" : "hidden" };
			else if(typeof k == "number" && k > 0)
				console.warn(key+" not rendered");
			else if(typeof v == "object"){
				console.info("build an object definition : "+key)
				convert(v,key);
			} else if(typeof v == "array"){
				console.info("build an array definition"+key+'[list]');
				convert(v[0],key+'[list]');
			} else
				jsonSchema.properties[key] = { "inputType" : "text","i18n":k };
		});
	}var currentMF = null;
	function showForm(){
		openModal(currentMF.key,currentMF.collection,null,currentMF.template);
	}
	function getMicroformat(){
		if($("#getMicroformat").val()!=""){
			params = {
				"collection":"<?php echo PHType::TYPE_MICROFORMATS?>",
				"where":{ 
					"_id" : $("#getMicroformat").val()
				} 
			}; 
			testitpost(null,baseUrl+'/tools/getby',params,function(data){
				currentMF = data[$("#getMicroformat").val()];
				if(currentMF && currentMF.jsonSchema){
					$("#jsonSchema").val( JSON.stringify(currentMF.jsonSchema, null, 4) );
					$("#microformatName").val( currentMF.key);
					$("#microformatCollection").val( currentMF.collection);
					$("#microformatTemplate").val( currentMF.template);
					$(".convertBtn").fadeOut();
					$(".convertSrc").fadeOut();
					$("#getMicroformatSection").fadeOut();
					$(".showBtn").removeClass("hide");
					$(".saveMFBtn").removeClass("hide");
				} else
					alert("Microformat is empty");
				
			});
		} else 
			alert("you must choose a microformat key");
	}
	function getOntology(){
		alert("TODO ROODOOODOO");
	}
	function saveMicroformat()
	{
		if( $("#microformatName").val()!="" && $("#microformatCollection").val()!="" && $("#microformatTemplate").val()!="" )
		{
			params = {
				"collection":"<?php echo PHType::TYPE_MICROFORMATS?>",
				"key":$("#microformatName").val(),
				"MFcollection":$("#microformatCollection").val(),
				"template":$("#microformatTemplate").val(),
				"jsonSchema":$.parseJSON($("#jsonSchema").val())
			}; 
			testitpost(null,baseUrl+'/common/save',params,function(data){
				if(data.result){
					$("#flashInfoSaveBtn").html('');
        		  	$("#flashInfoContent").html(data.msg);
        		  	$("#flashInfo").modal('show');
        		  	$(".showBtn").removeClass("hide");
        		  	$("#getMicroformat").append("<option value='"+data.map["_id"]["$id"]+"'>"+$("#microformatName").val()+"</option>");
        		  	alert(data.map["_id"]["$id"]);
        		  	
				} else
					alert("Something went wrong.");
			});
		} else 
			alert("you must choose a microformat key");

	}
</script>
