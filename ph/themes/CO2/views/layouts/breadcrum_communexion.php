<?php
    $communexion = CO2::getCommunexionCookies();  
    if($communexion["state"] == false){
?>

<?php if($type != "cities"){ ?>            
    <h5 class="pull-left letter-red" style="margin-bottom: -8px;margin-top: 14px;">
            <button class="btn btn-default main-btn-scopes text-white tooltips margin-bottom-5 margin-left-10 margin-right-10" 
                data-target="#modalScopes" data-toggle="modal"
                data-toggle="tooltip" data-placement="top" 
                                    title="Sélectionner des lieux de recherche">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/cible3.png" height=25>
            </button> 
            recherche ciblée <i class="fa fa-angle-right"></i> 
    </h5>
 
    <div class="scope-min-header list_tags_scopes hidden-xs text-left">
    </div>
<?php } ?> 

<?php }else{ ?>
    <div class="breadcrum-communexion hidden-xs col-md-12">
        <button class="btn btn-link text-red btn-decommunecter tooltips"
                data-toggle="tooltip" data-placement="right" 
                title="Quitter la communexion">
            <i class="fa fa-times"></i>
        </button>

        <i class="fa fa-university fa-2x text-red"></i> 
        <button id="btn-region" data-toggle='dropdown' data-target='dropdown-multi-scope'
            class='btn btn-link text-red item-globalscope-checker homestead 
                  <?php if(@$communexion["currentName"]!=@$communexion["values"]["regionName"]) echo "inactive"; ?>' 
            data-scope-value='<?php echo @$communexion["values"]["regionName"]; ?>'
            data-scope-name='<?php echo @$communexion["values"]["regionName"]; ?>'
            data-scope-type='region'>
            <i class='fa fa-angle-right'></i>  <?php echo @$communexion["values"]["regionName"]; ?>
        </button> 
        <button id="btn-dep" data-toggle='dropdown' data-target='dropdown-multi-scope'
            class='btn btn-link text-red item-globalscope-checker homestead
                  <?php if(@$communexion["currentName"]!=@$communexion["values"]["depName"]) echo "inactive"; ?>' 
            data-scope-value='<?php echo @$communexion["values"]["depName"]; ?>'
            data-scope-name='<?php echo @$communexion["values"]["depName"]; ?>'
            data-scope-type='dep'>
            <i class='fa fa-angle-right'></i>  <?php echo @$communexion["values"]["depName"]; ?>
        </button> 
        <button id="btn-cp" data-toggle='dropdown' data-target='dropdown-multi-scope'
            class='btn btn-link text-red item-globalscope-checker homestead
                  <?php if(@$communexion["currentName"]!=@$communexion["values"]["cityCp"]) echo "inactive"; ?>' 
            data-scope-value='<?php echo @$communexion["values"]["cityCp"]; ?>'
            data-scope-name='<?php echo @$communexion["values"]["cityCp"]; ?>'
            data-scope-type='cp'>
            <i class='fa fa-angle-right'></i>  <?php echo @$communexion["values"]["cityCp"]; ?>
        </button> 
        <button id="btn-city" data-toggle='dropdown' data-target='dropdown-multi-scope'
            class='btn btn-link text-red item-globalscope-checker homestead
                  <?php if(@$communexion["currentName"]!=@$communexion["values"]["cityName"]) echo "inactive"; ?>'
            data-scope-value='<?php echo @$communexion["values"]["cityKey"]; ?>'
            data-scope-name='<?php echo @$communexion["values"]["cityName"]; ?>'
            data-scope-type='city'>
            <i class='fa fa-angle-right'></i>  <?php echo @$communexion["values"]["cityName"]; ?>
        </button> 
        <?php //echo @$communexion["currentName"]." != ".@$communexion["values"]["cityName"]; ?>
         
        <?php   //$icon = @$params["pages"]["#".$page]["icon"]; 
                //$subdomainName = $params["pages"]["#".$page]["subdomainName"];
        ?>
       <!--  <span class="pull-right">
            <span class="font-blackoutM text-red"> <?php //echo $subdomainName; ?></span>
            <i class="fa fa-<?php //echo $icon; ?> fa-2x text-red"></i> 
        </span> -->
        <a href="javascript:getDatasets('<?php echo @$communexion["values"]["insee"]; ?>')" style="margin-left:50px;" class="pull-right" >
          <img width=200 src="<?php echo $this->module->assetsUrl; ?>/images/logos/data-gouv-logo.png">
        </a>
        <a href="javascript:getWiki('<?php echo @$communexion["values"]["wikidataID"]; ?>')" class="pull-right">
          <img width=50 src="<?php echo $this->module->assetsUrl; ?>/images/logos/Wikipedia-logo-en-big.png">
        </a>
    </div>
    <script src="https://www.data.gouv.fr/static/widgets.js" id="udata"></script>
<?php } ?>

<script type="text/javascript" >

communexion = <?php echo json_encode(@$communexion) ?>;
var current_page = 0;
var offset = 0;
var limit = 4;
var type_page = '';

var wikipedia = {

    "prefixe" : { 
        "dbpedia" : "http://fr.dbpedia.org/",
        "dbpedia_resource" : "http://fr.dbpedia.org/resource",
        "dbpedia_owl" : "http://fr.dbpedia.org/ontology",
        "dbpedia_property" : "http://fr.dbpedia.org/property"
        },
    "fr" : { 
        "depiction" : { 
            "uri" : "",
            "property" : "dbpedia_property:depiction",  
            "source" : "dbpedia"
        },
        "item" : { 
            "uri" : "",
            "property" : "dbpedia_property:depiction",  
            "source" : "dbpedia"

        },
        "abstract" : { 
            "value" : "",
            "ontology" : "dbpedia_owl:abstract", 
            "source" : "dbpedia"
        },
        "country" : {
            "value" : "",
            "ontology" : "dbpedia_owl:country",
            "uri" : "",
            "property" : "dbpedia_property:country",
            "source" : "dbpedia"
        },
        "countryLabel" : {
            "value" : "",
            "uri" : "",
            "property" : "dbpedia_property:country",
            "source" : "dbpedia"
        },
        "region" :  { 
            "value" : "",
            "ontology" : "dbpedia_owl:region",
            "uri" : "",
            "source" : "dbpedia"
        },
        "regionLabel" :  { 
            "value" : "",
            "uri" : "",
            "source" : "dbpedia"
        },
        "department" : {
            "value ": "",
            "ontology" : "dbpedia_owl:department",
            "uri" : "",
            "source" : "dbpedia"
        },
        "departmentLabel" : {
            "value ": "",
            "uri" : "",
            "source" : "dbpedia"
        },
        "maire" : { 
            "value" : "",
            "uri" : "",
            "property" : "dbpedia_property:maire",
            "source" : "dbpedia"
        },
        "maireLabel" : { 
            "value" : "",
            "property" : "dbpedia_property:maire",
            "source" : "dbpedia"
        },
        "postalCode" : { 
            "value" : 97400,
            "ontology" : "dbpedia_owl:postalCode",
            "source" : "dbpedia"
        },
        "inseeCode" : { 
            "value" : 97411,
            "ontology" : "dbpedia_owl:inseeCode",
            "property" : "dbpedia_property:insee",
            "source" : "dbpedia"
        },
        "gentile": { 
            "value" : "",
            "property" : "dbpedia_property:gentilé",
            "source" : "dbpedia"
        },
        "populationAglomeration" : { 
            "value" : 197464,
            "property" : "dbpedia_property:populationAgglomération",
            "source" : "dbpedia"
        },
        "populationTotal" : { 
            "value" : 145238 ,
            "ontology" : "dbpedia_owl:populationTotal",
            "source" : "dbpedia"
        }, 
        "superficie" : {
            "value" : 142.790000,
            "property" : "dbpedia_property:superficie",
            "source" : "dbpedia"
        },  
        "siteweb" : { 
            "value": "",
            "property" : "dbpedia_resource:siteweb",
            "source" : "dbpedia"
        }
    }
}

jQuery(document).ready(function() {


});

function getWiki(q){

  url ="https://www.wikidata.org/wiki/Special:EntityData/"+q+".json" 
  $.ajax({
    url:url,
    type:"GET",
    dataType: "json",
    success:function(data) {
        if( notNull(data) ){
            mylog.log('First AJAX')
            console.dir(data);
            wikidata = data;

            label_dbpedia = wikidata.entities[q].sitelinks.frwiki.title;
            wikiID = q;
            wikipage_ville = wikidata.entities[q].sitelinks.frwiki.url;

            $.ajax({
                url: "http://fr.dbpedia.org/sparql?default-graph-uri=&query=prefix+dbo%3A+%3Chttp%3A%2F%2Fdbpedia.org%2Fontology%2F%3E%0D%0Aprefix+dbr%3A+%3Chttp%3A%2F%2Ffr.dbpedia.org%2Fresource%2F%3E%0D%0APREFIX+wikidb%3A+%3Chttp%3A%2F%2Fwikidata.dbpedia.org%2Fresource%2F%3E%0D%0APREFIX+dbp%3A+%3Chttp%3A%2F%2Ffr.dbpedia.org%2Fproperty%2F%3E%0D%0A+%0D%0A%0D%0ASELECT+DISTINCT+*+where+%7B%0D%0A%0D%0A%0D%0A%0D%0A++%3Fitem+a+dbo%3ASettlement+.+%0D%0A++%3Fitem+rdfs%3Alabel+%22"+label_dbpedia+"%22%40fr+.%0D%0A%0D%0A++%3Fitem+dbo%3Aabstract+%3Fabstract+.+%0D%0A%0D%0A+%3Fitem+dbo%3Acountry+%3Fcountry+.+%0D%0A++%3Fcountry+rdfs%3Alabel+%3FcountryLabel+.%0D%0A%0D%0A+%3Fitem+dbo%3Aregion+%3Fregion+.+%0D%0A+%3Fregion+rdfs%3Alabel+%3FregionLabel+.++%0D%0A%0D%0A++%3Fitem+dbo%3Adepartment+%3Fdepartment++.+%0D%0A+++%3Fdepartment+rdfs%3Alabel+%3FdepartmentLabel+.+%0D%0A%0D%0A+OPTIONAL+%7B%3Fitem+dbo%3ApostalCode+%3FpostalCode++.%7D%0D%0A+OPTIONAL+%7B%3Fitem+dbo%3AinseeCode+%3FinseeCode++.+%7D%0D%0A%0D%0A%0D%0A+OPTIONAL+%7B%3Fitem+dbp%3Agentil%C3%A9+%3Fgentile+.+%7D%0D%0A+OPTIONAL+%7B%3Fitem+dbo%3ApopulationTotal+%3FpopulationTotal+.%7D%0D%0A%0D%0A+OPTIONAL+%7B%3Fitem+dbp%3Asuperficie+%3Fsuperficie+.+%7D%0D%0A+OPTIONAL+%7B%3Fitem+dbp%3Asiteweb+%3Fsiteweb+.+%7D%0D%0A+OPTIONAL+%7B+%3Fitem+foaf%3Adepiction+%3Fpicture+.+%7D%0D%0A%0D%0A++OPTIONAL+%7B+%3Fitem+dbp%3Amaire+%3Fmaire++.+%7D%0D%0A++OPTIONAL+%7B+%3Fitem+rdfs%3Alabel+%3FmaireLabel+.+%7D%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0AFILTER%28LANG%28%3FcountryLabel%29+%3D%22fr%22%29%0D%0AFILTER%28LANG%28%3FregionLabel%29+%3D%22fr%22%29%0D%0AFILTER%28LANG%28%3FdepartmentLabel%29+%3D%22fr%22%29%0D%0AFILTER%28LANG%28%3Fabstract%29+%3D+%22fr%22%29+%0D%0A%0D%0A%0D%0A+%0D%0A++%0D%0A+%7D%0D%0A&format=application%2Fsparql-results%2Bjson&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=100000000&debug=on",
                type:"GET",
                dataType: "jsonp",
                success:function(data) {
                    mylog.log('Second AJAX')
                    console.dir(data)
                    data_dbpedia = data;
                    
                    var prefixe = data_dbpedia.results.bindings[0];

                    var test = ["item", "abstract", "country", "countryLabel", "region", "regionLabel", "department", "departmentLabel", "maire", "maireLabel", "postalCode", "inseeCode", "gentile", "populationTotal", "superficie", "siteweb"];

                    $.each(test, function( index, value ) {
                        if (typeof prefixe[value] == "undefined") {
                        wikipedia.fr[value].value = "Il manque cette information" ; 
                        } else { 
                        wikipedia.fr[value].value = prefixe[value].value;
                        }
                    }); 

                    if (data_dbpedia.results.bindings[0].picture !== undefined) {      
                        wikipedia.fr.depiction = data_dbpedia.results.bindings[0].picture.value;
                    } else {
                        wikipedia.fr.depiction = "/ph/assets/7d331fe5/images/thumbnail-default.jpg";
                    }

                    $("#ajax-modal-modal-title").html(
                        "<a style='margin-right: 50px;' href='"+wikipage_ville+"'><img width=40 src='<?php echo $this->module->assetsUrl; ?>/images/logos/Wikipedia-logo-en-big.png'>"+
                        "</a> "+
                        "<a class='btn btn-primary' onclick='getInfoboxWikipedia(wikipedia)' style='margin-right: 50px;'>Afficher l'infobox de Wikipédia"+
                        "</a>"+
                        "<a class='btn btn-primary' onclick='getWikipediaArticle(5, 0)' style='margin-right: 50px;'>Afficher les artices Wikipédia</a>"+
                        "<a class='btn btn-primary' onclick='getWikidataItem(5, 0)'>Afficher les éléments Wikidata</a>"+
                        "</a>"+
                        "<h1 align='center'>"+
                        "<a id='title_wiki' target='_blank' href='"+wikipedia.fr.item.value+"'> "+label_dbpedia+"</a></h1>"
                    );
                  
                    getInfoboxWikipedia(wikipedia);

                    $('.modal-footer').show();
                    $('#ajax-modal').modal("show");
                    $('#ajax-modal').show();
                },
                error:function (xhr, ajaxOptions, thrownError){
                    alert("error second AJAX");
                } 
            });               
          }
        },
    error:function (xhr, ajaxOptions, thrownError){
        alert("error first ajax");
    } 
  });
}

function displayMapWikilinks() {
  $( '#ajax-modal' ).hide();
  showMap(true);
}

function getInfoboxWikipedia(wikipedia) {

  $("#ajax-modal-modal-body").html( 

    "<div class='row bg-white'>"+
        "<div class='col-sm-10 col-sm-offset-1'> " +
            "<h2> Infobox Wikipédia </h2>"+
            "<div id='abstract'><h4><u><b>Abstract Wikipédia : </b></u></h4>"+wikipedia.fr.abstract.value+"</div> <br/>"+                                   
            "<div id='country'><u><b> Pays </b></u>: " +wikipedia.fr.countryLabel.value+" ===> URI de la ressource dbpédia : <a target='_blank' href='"+wikipedia.fr.country.value+"'> "+wikipedia.fr.country.value+"</a></div>"+
            "<div id='region'> <u><b>Région </b></u>: "+wikipedia.fr.regionLabel.value+" ===> URI vers la ressource dbpédia : <a target='_blank' href='"+wikipedia.fr.region.value+"'> "+wikipedia.fr.region.value+"</a></div>"+
            "<div id='department'><u><b> Département</b></u> : " +wikipedia.fr.departmentLabel.value+" ===> URI vers la ressource dbpédia : <a target='_blank' href='"+ wikipedia.fr.department.value+"'> "+ wikipedia.fr.department.value+"</a></div>"+ 
            "<div id='maire'> <u><b>Maire de la ville</b></u> : " +wikipedia.fr.maire.value+"</div>"+
            "<div id='postalCode'><u><b> Code postal </b></u>: " +wikipedia.fr.postalCode.value +"</div>"+
            "<div id='inseeCode'> <u><b>Code INSEE</b></u> : " +wikipedia.fr.inseeCode.value +"</div>"+
            "<div id='gentile'> <u><b>Gentilé</b></u> : " +wikipedia.fr.gentile.value +"</div>"+
            "<div id='populationTotal'><u><b> Population municipale </b></u>: " +wikipedia.fr.
populationTotal.value +"</div>"+
            "<div id='superficie'> <u><b>Superficie</b></u> : " +wikipedia.fr.superficie.value +"</div>"+
            "<div id='siteweb'><u><b> Site Web</b></u> : <a href='"+wikipedia.fr.siteweb.value+"'>" +wikipedia.fr.siteweb.value +"</a></div>"+
            "<div id='depiction'> " +
            "<div id='img_ville' align='center'><br/><img id='photo_ville' src="+ wikipedia.fr.depiction+" alt='Photo de la ville' title='Cliquez pour agrandir' width='40%' height='40%' /> </div>" + 
            "</div>"+
        "</div>"+
    "</div>");
}

function getWikipediaArticle(limit, offset) {

    limit = 4;
     type_page = "wikipedia_page";

    $.ajax({
        url:'http://fr.dbpedia.org/sparql?default-graph-uri=&query=prefix+dbo%3A+%3Chttp%3A%2F%2Fdbpedia.org%2Fontology%2F%3E%0D%0Aprefix+dbr%3A+%3Chttp%3A%2F%2Ffr.dbpedia.org%2Fresource%2F%3E%0D%0APREFIX+wikidb%3A+%3Chttp%3A%2F%2Fwikidata.dbpedia.org%2Fresource%2F%3E%0D%0APREFIX+dbp%3A+%3Chttp%3A%2F%2Ffr.dbpedia.org%2Fproperty%2F%3E%0D%0Aprefix+wiki-fr%3A+%3Chttp%3A%2F%2Ffr.wikipedia.org%2Fwiki%2F%3E%0D%0A%0D%0A+SELECT+DISTINCT+*+where+%7B%0D%0A%0D%0A++%3Fitem+a+dbo%3ASettlement+.%0D%0A++%3Fitem+rdfs%3Alabel+%22'+label_dbpedia+'%22%40fr+.%0D%0A++%3Fitem+dbp%3Alatitude+%3Flatitude.%0D%0A++%3Fitem+dbp%3Alongitude+%3Flongitude.%0D%0A++%3Fitem+dbo%3AwikiPageWikiLink+%3Fwikipage.%0D%0A++%3Fwikipage+dbo%3AwikiPageID+%3Fwikipedia_id+.%0D%0A++%0D%0A++OPTIONAL+%7B%3Fwikipage+foaf%3Adepiction+%3Fpicture_item+%7D.%0D%0A%0D%0A++OPTIONAL+%7B%3Fwikipage+foaf%3AisPrimaryTopicOf+%3Fpagewiki%7D.%0D%0A++OPTIONAL+%7B%3Fwikipage+rdfs%3Alabel+%3Flabel+%7D.%0D%0A%0D%0A++OPTIONAL+%7B%3Fwikipage+dbo%3Atype+%3Ftype_item+%7D.%0D%0A++OPTIONAL+%7B%3Fwikipage+dbp%3Ag%C3%A9olocalisation+%3Fgeo%7D.%0D%0A++OPTIONAL+%7B%3Fwikipage+dbp%3Alatitude+%3Flatitude_item%7D.%0D%0A++OPTIONAL+%7B%3Fwikipage+dbp%3Alongitude+%3Flongitude_item%7D.%0D%0A+%0D%0A++FILTER%28lang%28%3Flabel%29%3D%22fr%22%29.%0D%0A%0D%0A++FILTER+%28%3Flatitude_item+%3C+%28%3Flatitude%2B0.2%29%29.%0D%0A++FILTER+%28%3Flatitude_item+%3E+%28%3Flatitude-0.2%29%29.%0D%0A++FILTER+%28%3Flongitude_item+%3C+%28%3Flongitude%2B0.2%29%29.%0D%0A++FILTER+%28%3Flongitude_item+%3E+%28%3Flongitude-0.2%29%29%0D%0A%0D%0A++%0D%0A+%7D%0D%0ALIMIT+'+limit+'%0D%0AOFFSET+'+offset+'&format=application%2Fsparql-results%2Bjson&timeout=0&debug=on',
        type:"GET",
        dataType: "jsonp",
        async: false,
        success:function(data) {
            mylog.log('Third AJAX');
            mylog.dir(data);
            data_wikilinks = data;
            var contextWikipediaMap = [];
            $("#ajax-modal-modal-body").html(
                '<div>'+
                    '<h2 align="center">Articles Wikipédia en rapport avec la ville ' +
                    '<a onclick="displayMapWikilinks()" class="btn btn-primary" role="button">Sur la Map <i class="fa fa-map-marker"></i> '+ 
                    '</a>' +
                    '<a onclick="getAllWikipediaArticle()" class="btn btn-primary" style="margin-left:20px;" role="button">Afficher les TOUS ! <i class="fa fa-map-marker"></i> '+ 
                    '</a>' +
                    '</h2>' +
                    '<ul id="list_wiki_article" class="col-xs-12">'+
                    '</ul>' +  
                    '<div id="page_navigation_wikipedia"></div>'+
                '</div>'
            );

            data_length = data_wikilinks.results.bindings.length;
            nav = getPaginationStruc(limit, offset, type_page, data_length);

            $('#page_navigation_wikipedia').append(nav);

            if (offset == 0) {
                $('.btn-previous').hide();
            }

            if ((data_length == 0) || (data_length < 4)) {
                $('#ajax-modal-modal-body').append("Il n'y a plus d'élément, veuillez cliquez sur le bouton 'PREVIOUS'")
                $('.btn-next').hide();
            }

            $.each( data_wikilinks.results.bindings, function( index, value ) {

                if (value.picture_item !== undefined) {
                $("#list_wiki_article").append(
                    '<li class="wiki_article_element img-thumbnail col-sm-6 col-xs-12">'+
                        '<a class="wiki_article_links" target="_blank" href="'+value.pagewiki.value+'">'+value.label.value+
                        '<BR>' +
                        '<img class="img_wiki_element" id="photo_ville" src='+ value.picture_item.value+' title="Cliquez pour agrandir" width="100%" height="100%"/>'+
                        '</a>'+ 
                    '</li>'
                );
                } else if (value.pagewiki !== undefined) {      
                  $("#list_wiki_article").append(
                  '<li class="wiki_article_element img-thumbnail col-sm-6 col-xs-12">'+ 
                    '<a class="wiki_article_links" target="_blank" href="'+value.pagewiki.value+'">'+value.label.value+'<BR>' +
                    '<img class="img_wiki_element" src="/ph/assets/7d331fe5/images/thumbnail-default.jpg" title="Cliquez pour agrandir"/>'+
                    '</a>' +
                  '</li>'
                  );
                }
          
                var article_wikipedia_json = {
                    "_id": {
                        "$id" : value.wikipedia_id.value,
                    },
                    "geo": {
                        "@type": "GeoCoordinates",
                        "latitude": value.latitude_item.value,
                        "longitude": value.longitude_item.value,
                    },         
                    "name" :value.label.value,
                    "typeSig" : "poi",
                    //"profilMarkerImageUrl" : value.picture_item.value,
                };
                contextWikipediaMap.push(article_wikipedia_json);
            });

            Sig.showMapElements(Sig.map, contextWikipediaMap);

            if (data_wikilinks.results.bindings.length == 0) {
                $("#ajax-modal-modal-body").append('Aucun article correspondant à cette ville n\'a été trouvée ... <BR><BR>Vous aussi, contribuez à enrichir la page Wikipédia de cette ville en cliquant sur l\'icône de Wikipédia en haut à gauche de cette fenêtre');
            }
        }
  });
}   

function getWikidataItem(limit, offset) {

    limit = 5;
    type_page = "wikidata_page";

    $.ajax({
        url: 'https://query.wikidata.org/sparql?format=json&query=SELECT%20DISTINCT%20%3Fitem%20%3FitemLabel%20%3Fcoor%20%3Frange%20WHERE%20{%0A%20%3Fitem%20wdt%3AP131%20wd%3A'+wikiID+'.%0A%20%3Fitem%20%3Frange%20wd%3A'+wikiID+'.%0A%20%3Fitem%20wdt%3AP625%20%3Fcoor.%0A%20SERVICE%20wikibase%3Alabel%20{%20bd%3AserviceParam%20wikibase%3Alanguage%20%22fr%22.%20}%0A}%0ALIMIT%20'+limit+'%0AOFFSET%20'+offset,
        type:"GET",
        dataType: "json",
        success:function(data) {
            mylog.log('il rentre dans le quatrieme AJAX');
            wikidata_item = data;
            var contextWikidataMap = [];

            $("#ajax-modal-modal-body").html(
                '<div>'+
                    '<h2 style="margin-bottom: 50px;" align="center">Element Wikidata en rapport avec la ville '+
                    '<a onclick="displayMapWikilinks()" class="btn btn-primary" role="button">Sur la Map <i class="fa fa-map-marker"></i>'+
                    '</a>'+
                    '<a onclick="getAllWikidataItem()" class="btn btn-primary" style="margin-left:20px;" role="button">Afficher les TOUS ! <i class="fa fa-map-marker"></i>'+
                    '</a>'+
                    '</h2>'+
                    '<ul id="list_wikidata_item" class="col-xs-12">'+
                    '</ul>' +  
                    '<div id="page_navigation_wikidata"></div>'+
                '</div>'
            );

            data_length_wikidata = wikidata_item.results.bindings.length;         
            nav = getPaginationStruc(limit, offset, type_page, data_length_wikidata);

            $('#page_navigation_wikidata').append(nav);

            if (offset == 0) {
                $('.btn-previous').hide();
            }

            if ((data_length_wikidata == 0) || (data_length_wikidata < 5)) {
                $('#ajax-modal-modal-body').append("Il n'y a plus d'élément, veuillez cliquez sur le bouton PREVIOUS")
                $('.btn-next').hide();
            }

            $.each( wikidata_item.results.bindings, function( index, value ) {

                var coordonnees = getLatLongWikidataItem(value);

                $("#list_wikidata_item").append('<li class="wikidata_item col-xs-6"><a href="'+value.item.value+'">'+value.itemLabel.value+'</a></li>');

                var itemID = getItemWikidataID(value);

                getItemWikidataArticle(itemID);
                
                var item_wikidata_json = {
                    "_id": {
                        "$id" : coordonnees[0] + coordonnees[1],
                    },
                    "geo": {
                        "@type": "GeoCoordinates",
                        "latitude": coordonnees[1],
                        "longitude": coordonnees[0],
                    },
                    "name" :value.itemLabel.value,
                    "typeSig" : "poi",
                };
                contextWikidataMap.push(item_wikidata_json);
            });
          Sig.showMapElements(Sig.map, contextWikidataMap);
        }
    });
}

function getAllWikipediaArticle() {
  
    $.ajax({
        url: 'http://fr.dbpedia.org/sparql?default-graph-uri=&query=prefix+dbo%3A+%3Chttp%3A%2F%2Fdbpedia.org%2Fontology%2F%3E%0D%0Aprefix+dbr%3A+%3Chttp%3A%2F%2Ffr.dbpedia.org%2Fresource%2F%3E%0D%0APREFIX+wikidb%3A+%3Chttp%3A%2F%2Fwikidata.dbpedia.org%2Fresource%2F%3E%0D%0APREFIX+dbp%3A+%3Chttp%3A%2F%2Ffr.dbpedia.org%2Fproperty%2F%3E%0D%0Aprefix+wiki-fr%3A+%3Chttp%3A%2F%2Ffr.wikipedia.org%2Fwiki%2F%3E%0D%0A%0D%0A+SELECT+DISTINCT+*+where+%7B%0D%0A%0D%0A++%3Fitem+a+dbo%3ASettlement+.%0D%0A++%3Fitem+rdfs%3Alabel+%22'+label_dbpedia+'%22%40fr+.%0D%0A++%3Fitem+dbp%3Alatitude+%3Flatitude.%0D%0A++%3Fitem+dbp%3Alongitude+%3Flongitude.%0D%0A++%3Fitem+dbo%3AwikiPageWikiLink+%3Fwikipage.%0D%0A++%3Fwikipage+dbo%3AwikiPageID+%3Fwikipedia_id+.%0D%0A++%0D%0A++OPTIONAL+%7B%3Fwikipage+foaf%3Adepiction+%3Fpicture_item+%7D.%0D%0A%0D%0A++OPTIONAL+%7B%3Fwikipage+foaf%3AisPrimaryTopicOf+%3Fpagewiki%7D.%0D%0A++OPTIONAL+%7B%3Fwikipage+rdfs%3Alabel+%3Flabel+%7D.%0D%0A%0D%0A++OPTIONAL+%7B%3Fwikipage+dbo%3Atype+%3Ftype_item+%7D.%0D%0A++OPTIONAL+%7B%3Fwikipage+dbp%3Ag%C3%A9olocalisation+%3Fgeo%7D.%0D%0A++OPTIONAL+%7B%3Fwikipage+dbp%3Alatitude+%3Flatitude_item%7D.%0D%0A++OPTIONAL+%7B%3Fwikipage+dbp%3Alongitude+%3Flongitude_item%7D.%0D%0A+%0D%0A++FILTER%28lang%28%3Flabel%29%3D%22fr%22%29.%0D%0A%0D%0A++FILTER+%28%3Flatitude_item+%3C+%28%3Flatitude%2B0.1%29%29.%0D%0A++FILTER+%28%3Flatitude_item+%3E+%28%3Flatitude-0.1%29%29.%0D%0A++FILTER+%28%3Flongitude_item+%3C+%28%3Flongitude%2B0.1%29%29.%0D%0A++FILTER+%28%3Flongitude_item+%3E+%28%3Flongitude-0.1%29%29%0D%0A%0D%0A++%0D%0A+%7D&format=application%2Fsparql-results%2Bjson&timeout=0&debug=on',
        type:"GET",
        dataType: "jsonp",
        async: false,
        success:function(data) {
            all_wikilinks = data;
            var contextAllWikipediaMap = [];

            $.each( all_wikilinks.results.bindings, function( index, value ) {

                var all_article_wikipedia_json = {
                "_id": {
                  "$id" : value.wikipedia_id.value,
                },
              
                "geo": {
                  "@type": "GeoCoordinates",
                  "latitude": value.latitude_item.value,
                  "longitude": value.longitude_item.value,
                },
                "name" :value.label.value,
                "typeSig" : "poi",
            };
            contextAllWikipediaMap.push(all_article_wikipedia_json);
        });

        Sig.showMapElements(Sig.map, contextAllWikipediaMap);
        displayMapWikilinks();

        }
    });
}

function getAllWikidataItem() {

    $.ajax({
        url: 'https://query.wikidata.org/sparql?format=json&query=SELECT%20DISTINCT%20%3Fitem%20%3FitemLabel%20%3Fcoor%20%3Frange%0AWHERE%0A{%0A%0A%20%3Fitem%20wdt%3AP131%20wd%3A'+wikiID+'.%0A%20%3Fitem%20%3Frange%20wd%3A'+wikiID+'.%0A%20%3Fitem%20wdt%3AP625%20%3Fcoor.%0A%20%0A%20SERVICE%20wikibase%3Alabel%20{%0A%20bd%3AserviceParam%20wikibase%3Alanguage%20%22fr%22%20.%20%0A%20}%0A}',
        type:"GET",
        dataType: "json",
        success:function(data) {
            allWikidataItem = data;
            var contextAllWikidataMap = [];

            $.each( allWikidataItem.results.bindings, function( index, value ) {

                var coordonnees = getLatLongWikidataItem(value);
                
                var all_item_wikidata_json = {
                    "_id": {
                        "$id" : coordonnees[0] + coordonnees[1],
                    },
                
                    "geo": {
                        "@type": "GeoCoordinates",
                        "latitude": coordonnees[1],
                        "longitude": coordonnees[0],
                    },
                  
                    "name" :value.itemLabel.value,
                    "typeSig" : "poi",
                };
                contextAllWikidataMap.push(all_item_wikidata_json);
            });

            Sig.showMapElements(Sig.map, contextAllWikidataMap);
            displayMapWikilinks();
        }
    });
}

function getLatLongWikidataItem(wikidata_item) {

    if (wikidata_item.coor !== undefined) {

        var coordonnees = (wikidata_item.coor.value).split(' ')
        coordonnees[0] = coordonnees[0].slice(6);
        indexof = coordonnees[1].indexOf(")");
        coordonnees[1] = coordonnees[1].slice(0, indexof);

        return coordonnees;
    }
}

//Fonctions pour la pagination 

function previous(limit, theOffset, type, data_length){

    if (type == "wikipedia_page") {
        offset = offset - 4;
        theOffset = theOffset - 4;
        getWikipediaArticle(limit, theOffset);
    } else if (type == "wikidata_page") {
        offset = offset - 5;
        theOffset = theOffset - 5;
        getWikidataItem(limit, theOffset);
    }
}

function next(limit, theOffset, type, data_length){

    if (type == "wikipedia_page") {
        if (data_length == 4) {
            offset = offset + 4;
            theOffset = theOffset + 4;
            getWikipediaArticle(limit, theOffset);
        }
    } else if (type == "wikidata_page") {
        if (data_length == 5) {
            offset = offset + 5;
            theOffset = theOffset + 5;
            getWikidataItem(limit, theOffset);
        }
    } 
}

function getPaginationStruc(limit, offset,type_page, data_length) {

    wikidata_page = 'wikidata_page';
    wikipedia_page = 'wikipedia_page';   
    var nav = '<ul class="pagination"><li ><a class="btn-previous" align="center" href="javascript:previous('+limit+','+offset+','+type_page+','+data_length+');">&laquo; PREVIOUS</a></li>';

    nav += '<li ><a  class="btn-next" href="javascript:next('+limit+','+offset+','+type_page+','+data_length+');">NEXT &raquo;</a></li></ul>';

    return nav;
} 

function getItemWikidataID(data) {

    wikidataID = data.item.value;

    indexofQ = wikidataID.indexOf("Q");
    wikidataID = wikidataID.slice(indexofQ);

    return wikidataID;

}

function getItemWikidataArticle(id) {

    $.ajax({
        url: "https://www.wikidata.org/wiki/Special:EntityData/"+id+".json",
        type:"GET",
        dataType: "json",
        async: false,
        success:function(data) {
            data_item = data;

            if (data_item.entities[id].sitelinks.frwiki !== undefined) {
            wikipedia_item_url = data_item.entities[id].sitelinks.frwiki.url;

            $("#list_wikidata_item").append('<li class="wikidata_item col-xs-6"><a href="'+wikipedia_item_url+'">'+wikipedia_item_url+'</a></li>');
            } else {
            $("#list_wikidata_item").append('<li class="wikidata_item col-xs-6">Cet élémént ne possède pas de page Wikipédia</li>');
            }
        }
    });
}

function getDatasets(insee) {

    mylog.log('Click sur le bouton data.gouv');
    mylog.log('On fait passer l\'insee ' + insee);

    var button_breadcrum = document.getElementsByClassName("btn btn-link text-red item-globalscope-checker homestead");

    $.each(button_breadcrum, function( index, value ) {
        mylog.log('Les boutons du breadcrum');
        if ((value.getAttribute("class").search("inactive")) == -1) {
            data_scope_type = value.getAttribute("data-scope-type");
        }
    });

    if (data_scope_type == "region") {
        url = "https://www.data.gouv.fr/api/1/spatial/zone/fr/region/"+communexion.values.region+"/datasets";
        search_target = "de la Région : "+communexion.values.regionName;
    } else if (data_scope_type == "dep") {
        url = "https://www.data.gouv.fr/api/1/spatial/zone/fr/county/"+communexion.values.dep+"/datasets";
         search_target = "du Département : "+communexion.values.depName;
    } else if ((data_scope_type == "cp") || (data_scope_type == "city")) {
        url = "https://www.data.gouv.fr/api/1/spatial/zone/fr/county/"+insee+"/datasets";
        search_target = "de la Ville : "+communexion.values.cityName;
    } 

    // $('#ajax-modal').on('show.bs.modal', function () {

    var list_orga_id = [];

    $.ajax({
        url: url,
        type:"GET",
        dataType: "json",
        async: false,
        success:function(data) {
            mylog.log(data);
            $.getScript("https://unpkg.com/metaclic/dist/metaclic.js"); 
    
            $("#ajax-modal-modal-title").html(
                "<a style='margin-right: 50px;' href='https://www.data.gouv.fr/fr'><img width=200 src='<?php echo $this->module->assetsUrl; ?>/images/logos/data-gouv-logo.png'>"+
                "</a> "+
                "<h1 align='center'>"+
                "<a id='title_data_gouv' href=''>Jeux de données "+search_target+"</h1></a>"
            );

            $.each(data, function( index, value ) {

                $.ajax({
                    url : value.uri,
                    type: "GET",
                    dataType: "json",
                    async : false,
                    success:function(data2) {
                        mylog.log(data2);
                        if (jQuery.inArray( data2.organization.id, list_orga_id )) {
                            list_orga_id.push(data2.organization.id);
                        }
                    }
                });
            });
        },
        complete:function(data){
            mylog.log('When the AJAX is completed');

            if (list_orga_id.length > 0) {

                list_orga_id_join = list_orga_id.join();
                mylog.log(list_orga_id_join);

                $("#ajax-modal-modal-body").html('<h2>Utilisation de udata-js</h2>');

                $("#ajax-modal-modal-body").append(
                    '<div '+
                        'class="Metaclic-data"'+
                        'data-organizations="'+list_orga_id_join+'"'+
                        'data-facets="all"'+
                        'data-page_size="5"/>'+
                    '</div>'
                );
            } else {
                $("#ajax-modal-modal-body").html('<h2>Aucun jeu de données pour cette ville x(</h2>');
            }  
        }
    });
    // }); 

    $('#ajax-modal').modal("show");
    $('#ajax-modal').show();
}
</script>



        

