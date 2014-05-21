<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
$cs->registerScriptFile('http://visjs.org/dist/vis.js' , CClientScript::POS_END);
$this->pageTitle=$this::moduleTitle;
?>
<style type="text/css">
  body {background: url("<?php echo Yii::app()->theme->baseUrl;?>/img/crowd.jpg") repeat;}
</style>
<section class="mt80 stepContainer">

    <div class="step">
      <div class="stepTitle">Reseau EGPC</div>
      <style type="text/css">
        #mygraph {
          float:right;
          width: 100%;
          height: 700px;
          border: 1px solid lightgray;
        }
      </style>
      <div id="mygraph"></div>
      <div id="info"></div>
      
      
      <div style="clear:both;"></div>
    </div>

    <div class="step why hidden" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Pourquoi ?</div>
      Parce qu'il est temps<br>
    </div>

    <div class="step what hidden" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Quoi ?</div>
      De Réunir nos réfléxions individuelles au service de l'intelligence collective.<br>
    </div>

    <div class="step how hidden" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Comment ?</div>
      Ensemble !!<br>
      se communecter , c'est se connecter a sa commune <br>
      La plus petite unité de l'état la plus proche de chacun d'entre nous<br>
      La toile est l'outil qui portera la solution<br>
      mais seul la masse que nous pouvons etre en sera l'action.<br>
    </div>

    <div class="step who hidden" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Qui ?</div>
      Nous devons tous nous réunir pour essayer<br>
      C'est le minimum demandé<br>
    </div>

    <div class="step when hidden" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Quand ?</div>
      De suite, si vous etes là , c'est un des endroit parmis d'autre<br>
      c'est maintement et pour le future<br>
    </div>
  </section>

<script type="text/javascript">

function hideShow(ids){
  $(".step").slideUp();
  $(ids).slideDown();
}
var nodecount = 0;
var nodes = [];
var edges = [];
function drawGraph(){
        // create a graph
        var container = document.getElementById('mygraph');
        var data = {
          nodes: nodes,
          edges: edges
        };
        var options = {
          nodes: {
            shape: 'box'
          }
        };
        graph = new vis.Graph(container, data, options);

        // add event listener
        /*graph.on('select', function(properties) {
          document.getElementById('info').innerHTML += 'selection: ' + JSON.stringify(properties) + '<br>';
        });*/

        // set initial selection (id's of some nodes)
        //graph.setSelection([3, 4, 5]);
}
$(document).ready(function() { 
  nodes.push({id: 1, label: "Asso EGPC",color: 'yellow'});
  
  testitpost("info",'/ph/<?php echo $this::$moduleKey?>/api/getgroupsby/filter/email,name',{"app":"<?php echo $this::$moduleKey?>"},
            function(data){
              $.each(data,function(k,v){
                console.log(k, v.name);
                nodes.push({id: k, label: v.name+"\n"+v.email,color: 'beige'});  
                edges.push({from: 1, to: k});
                testitpost("info",'/ph/<?php echo $this::$moduleKey?>/api/getpeopleby/filter/email,name',{"groupname":v.name},
                                function(data){
                                  
                                  $.each(data,function(kk,vv){
                                    console.log(kk, vv.name);
                                    nodes.push({id: kk+"-"+k, label: vv.name+"\n"+vv.email});  
                                    edges.push({from: k, to: kk+"-"+k});
                                  })
                                  drawGraph();
                                });
              });
              drawGraph();
            });
  drawGraph();
});
</script>