//Carto focus + Context with autonome functions

function getD3Data() {
  var d3data;
  //Appelle main.php de manière synchrone. C'est à dire, attend la réponse avant de continuer
  $.ajax({
    type: 'GET',
    url: '/data/d3data',
    dataType: 'json',
    success: function(t_data) {
      d3data = t_data;
      return false;
    },
    error: function(t_data) {
      console.log("Erreur Ajax : Message=" + t_data + " (Fonction getd3data()) !");
    },
    async: false
  });
  return d3data;
}

$(document).ready()
{
  var d3data = getD3Data();

//  console.log(JSON.stringify(d3data));
  var myGraph = new FluidGraph("#chart", d3data)

  myGraph.initSgvContainer("bgElement");

  var openedGraph = myGraph.getOpenedGraph();
  if (openedGraph)
    myGraph.loadGraph(openedGraph);
  else {
    myGraph.newGraph();
  }

  var checkboxIsInitialized = false;
  menuInitialisation(myGraph);

  if (myGraph.config.force == "On") {
    myGraph.activateForce();
  } else {
    $('#activeElasticCheckbox').addClass('disabled');
  }

  checkboxIsInitialized = true;

  myGraph.drawGraph();

  var rwwplay = "https://localhost:8443/2013/fluidlog/";
  var sf = "http://localhost:9000/ldp/fluidlog/"
  // dbpedia : http://dbpedia.org/resource/ (John_Lennon)

  var serverUri = rwwplay;
  var contextmap = {
    "@context":{
      "av" : "http://www.assemblee-virtuelle.org/ontologies/v1.owl#"
    }}

  var store = new MyStore({ container : serverUri,
                            context : contextmap,
                            template : "",
                            partials : ""})

  var jsonLd = {"@type" : "av:Organization"}

  // store.save(jsonLd);

  // store.get("https://localhost:8443/2013/fluidlog/").then(function(object){
  //   console.log("object : "+object);
  // });

}
