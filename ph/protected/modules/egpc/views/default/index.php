<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/vis.min.js' , CClientScript::POS_END);
$this->pageTitle=$this::moduleTitle;
?>
<style type="text/css">
  body {background: url("<?php echo Yii::app()->theme->baseUrl;?>/img/crowd.jpg") repeat;}
</style>
<section class="mt80 stepContainer">

    <div class="step home">
      <div class="fr"><input type="text" id="search" placeholder="chercher"/> <i class="fa fa-search"></i></div>
      <div class="stepTitle">Reseau EGPC </div>
      <style type="text/css">
        #mygraph {
          float:right;
          width: 100%;
          height: 350px;
          border: 1px solid lightgray;
          background-color: #000;
        }
        #tags{padding: 10px;}
        #tags a{
          display: block;
          float:left;
          background-color: yellow;
          padding:5px;
          border-radius: 3px;
          margin: 2px;
          text-decoration: none;
          color:#000;
          border:1px solid #000;
          font-weight:bold;
        }
        #tags a:hover{
          background-color: transparent;
          border-color:yellow; 
          color: yellow;
        }
        #tags a.off{
          background-color: grey;
        }
      </style>
      <div id="mygraph"></div>

      <div id="tags" style="width:49%; float:left;border:1px solid #fff;margin-top:5px;">tag cloud filter : one two three</div>
      <div id="notifications" style="width:49%;float:right;border:1px solid #fff;margin-top:5px;">notifications Panel</div>
      <div id="info"></div>
      
      <div style="clear:both;"></div>
    </div>
  
    <div class="step why hidden" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Pourquoi ?</div>
      Parce qu'il est temps<br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>

    <div class="step what hidden" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Quoi ?</div>
      De Réunir nos réfléxions individuelles au service de l'intelligence collective.<br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>

    <div class="step how hidden" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Comment ?</div>
      Ensemble !!<br>
      se communecter , c'est se connecter a sa commune <br>
      La plus petite unité de l'état la plus proche de chacun d'entre nous<br>
      La toile est l'outil qui portera la solution<br>
      mais seul la masse que nous pouvons etre en sera l'action.<br>
      <br>
      <br>
    </div>

    

    <div class="step when hidden" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Quand ?</div>
      Tous les évenements regroupé EGPC
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>
  </section>

<script type="text/javascript">

var nodecount = 0;
var nodes = [{id: 1, label: "Asso EGPC",color: 'yellow'}];
var edges = [];
var tags = [];
var activeTags = [];
$(document).ready( function() 
{ 
  getGroups();
  drawGraph();
});

function getGroups(filterTag)
{
  console.log("getGroups",filterTag);
  var params = {"app":"<?php echo $this::$moduleKey?>"};
  <?php if( isset($_GET['tags'])){
    $tags = array_unique (explode(",", $_GET['tags']));?>
    <?php $or = array();
    foreach ($tags as $key) {
      array_push($or, array("tags"=>$key));
    }
    ?>
  params.where = { "$or" : <?php echo json_encode($or)?> };
  <?php } ?>
  testitpost("info",'/ph/<?php echo $this::$moduleKey?>/api/getgroupsby/fields/email,name,tags',params,
            function(data)
            {
              $.each(data,function(k,v)
              {
                //console.log(k, v.name,v.tags);
                //build nodes for the graph
                nodes.push({id: k, label: v.name+"\n"+v.email,color: 'beige'});  
                edges.push({from: 1, to: k});

                //get people for each sub contents
                testitpost("info",'/ph/<?php echo $this::$moduleKey?>/api/getpeopleby/fields/email,name',{"groupname":v.name},
                                function(data)
                                { 
                                  $.each(data,function(kk,vv){
                                    console.log(kk, vv.name);
                                    nodes.push({id: kk+"-"+k, label: vv.name+"\n"+vv.email, value:8});  
                                    edges.push({from: k, to: kk+"-"+k});
                                  })
                                  drawGraph();
                                });
              });

              drawGraph();
              <?php if( isset( $_GET['tags'] ) ){?>
              filterByTag("<?php echo $_GET['tags']?>");
              <?php } ?>
            });
  testitpost("info",'/ph/<?php echo $this::$moduleKey?>/api/getgroupsby/fields/tags',{"app":"<?php echo $this::$moduleKey?>"},
            function(data)
            {
              $.each(data,function(k,v)
              {
                
                //gather all tags 
                if(v.tags != undefined)
                  tags = arrayUnique(tags.concat(v.tags));
                console.log(tags);
                //get people for each sub contents
                
              });

              drawTagCloud();
              <?php if( isset( $_GET['tags'] ) ){?>
              filterByTag("<?php echo $_GET['tags']?>");
              <?php } ?>
            });
}

function filterByTag(tag)
{
  console.log("filterByTag",tag);
  //$(".tag").addClass("off");
  <?php /*foreach ($tags as $key) {?>
      $("."+<?php echo $key?>).removeClass("off");
    <?php } */?>
  
}

function hideShow(ids)
{
  $(".step").slideUp();
  $(ids).slideDown();
}

function drawGraph()
{
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


function drawTagCloud()
{
  console.log("drawTagCloud",tags);
  var strHTML = "";
  $.each(tags,function(index,v){
    //TODO : url clean v 
    slug = convertToSlug(v);
    strHTML += " <a class='tag "+slug+" off ' href='/ph/egpc<?php echo '?tags=';if(isset($_GET['tags']))echo implode(',', $tags).","?>"+v+"'>"+v+"</a>";
  });
  strHTML += " <a class='tag' href='/ph/egpc'>Tous</a>";
  $("#tags").html(strHTML);
}

function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}
function arrayUnique(array) {
    var a = array.concat();
    for(var i=0; i<a.length; ++i) {
        for(var j=i+1; j<a.length; ++j) {
            if(a[i] === a[j])
                a.splice(j--, 1);
        }
    }

    return a;
};

</script>