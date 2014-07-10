<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/test/$-ui-1.8.16.custom.css'); 
$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/test/backbone-forms-default.css'); 

$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/$.min.js' , CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/underscore.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/backbone.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/$.rdfquery.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/backbone-forms.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/backbone-forms-list.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/vie-2.1.0.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/test/vie-widgets.js' , CClientScript::POS_END);
?>
<div class="results"></div>
<script type="text/javascript">
$(document).ready(function() { 
  results = $(".results");
var vie = new VIE();
vie.loadSchema("http://schema.rdfs.org/all.json", 
{
    baseNS : "http://schema.org",
    success: function () {
         results.append('<div class="msg">Successfully loaded the schema ontology!</di>');
         results.append('<div class="msg">We now have ' + this.types.list().length + ' classes loaded!</di>');
        var Thing = this.types.get("Thing");
        var Event = this.types.get("Event");
        var Person = this.types.get("Person");
        results.append('<div class="msg">BTW (1): A schema:Event is <b>' + 
                ((Event.isof(Thing))? ' ' : 'not ') + 
                '</b>of type schema:Thing, but <b>' + 
                ((Event.isof(Person))? ' ' : 'not ') + 
                '</b>of schema:Person!</div>');
        results.append('<div class="msg">BTW (2): A schema:Event has <b>' + Event.attributes.list().length + 
          ' attributes, including all inherited!</div>');
        $.each(Event.attributes.list().length, function(k,v){
          results.append(k+"<br/>");
        });
    },
    error: function () {
        results.append('<div class="msg">Something went wrong with loading the ontology!</di>');
    }
});
});
</script>