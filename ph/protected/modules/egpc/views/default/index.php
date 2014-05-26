<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/vis.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/vis.min.js' , CClientScript::POS_END);
$this->pageTitle=$this::moduleTitle;
?>
<style type="text/css">
  body {background: url("<?php echo Yii::app()->theme->baseUrl;?>/img/crowd.jpg") repeat;}
  #mygraph {
    width: 100%;
    height: 350px;
    border: 1px solid lightgray;
  }
  .vis.timeline .item {
    border-color: #F991A3;
    font-size: 15pt;
    box-shadow: 5px 5px 20px rgba(128,128,128, 0.5);
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
  a > i.fa{ 
    color: yellow;
    padding-right: 10px;
  }
  #notifications{
    padding: 10px;
  }
</style>
<section class="mt80 stepContainer">

    <div class="step home ">
      <div class="fr"><input type="text" id="search" placeholder="chercher"/> <a href="javascript:alert('TODO : connect to API')"><i class="fa fa-search"></i></a><a href="javascript:alert('TODO : connect to API')"><i class="fa fa-plus"></i></a> <a href="javascript:alert('TODO : connect to API')"><i class="fa fa-comment"></i></a> <a href="javascript:alert('TODO : connect to API')"><i class="fa fa-calendar"></i></a> </div>
      <div class="stepTitle">Reseau EGPC </div>
      
      <div id="mygraph"></div>
    
      <div id="tags" style="width:49%; float:left;border:1px solid #fff;margin-top:5px;"></div>
      <div id="notifications" style="width:49%;float:right;border:1px solid #fff;margin-top:5px;">
        <?php 
          foreach ($msgs as $key => $value) 
          {?>
                <div class="msg"><?php echo $value["msg"]?> ( <?php echo date("d M h:m",$value["created"])?> )</div>
        <?php } ?>  </div>
      <div id="info">
        
      </div>
      
      <div style="clear:both;"></div>
    </div>
    
    <div class="step when " >
      <div class="stepTitle">Quand ?</div>
      <div id="mytimeline" style="background-color: #FAFAFA;"></div>
      <div id="visualization"></div>
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

    

    
  </section>

<script type="text/javascript">

var nodecount = 0;
var nodes = [{id: 1, label: "Asso EGPC",color: 'yellow'}];
var edges = [];
var tags = [];
var activeTags = [];
$(document).ready( function() 
{ 
setTimeout(function () {
            getMessages();
        }, 5000);
var groups = new vis.DataSet([
    {id: 0, content: 'First', value: 1},
    {id: 1, content: 'Third', value: 3},
    {id: 2, content: 'Second', value: 2}
  ]);

var items = new vis.DataSet([
  <?php 
  $tags = array();
  foreach ($events as $key => $value) 
  {
    if( isset($value["date"]) ){
      $name = $value["name"];  
      $dateY = date("Y", strtotime($value["date"]));
      $dateM = date("n", strtotime($value["date"]))-1;
      $dated = date("j", strtotime($value["date"]));
      //echo "console.log('$name');";
      ?>
        {id: '<?php echo $key?>', group: 0, content: '<?php echo $name?>', start: new Date(<?php echo $dateY?>, <?php echo $dateM?>, <?php echo $dated?>)},
      <?php
    }
   }?>  
]);

  // create visualization
  var container = document.getElementById('visualization');
  var options = {
    // option groupOrder can be a property name or a sort function
    // the sort function must compare two groups and return a value
    //     > 0 when a > b
    //     < 0 when a < b
    //       0 when a == b
    groupOrder: function (a, b) {
      return a.value - b.value;
    },
    editable: true
  };

  var timeline = new vis.Timeline(container);
  timeline.setOptions(options);
  timeline.setGroups(groups);
  timeline.setItems(items);



  <?php 
  $tags = array();
  foreach ($groups as $key => $value) 
  {
    $name = $value["name"];
    $email = $value["email"];
    echo "nodes.push({id: '$key', label: '$name \\n $email',color: 'beige'});";
    echo "edges.push({from: 1, to: '$key'});";

    $people = Citoyen::getPeopleBy(array("groupname"=>$name,"fields"=>array("email",'name')));
    foreach ($people as $key2 => $value2) 
    {
      $name2 = $value2["name"];
      $email2 = $value2["email"];
      echo "nodes.push({id: '$key2-$key', label: '$name2 \\n $email2'});";
      echo "edges.push({from: '$key', to: '$key2-$key'});";
    }

   
  }
  foreach ($tagsall as $t) {
    $filtre = "";
      $onoff = "off";
      if( isset( $_GET['tags'] )){
        if( stripos($_GET['tags'], $t) === false){
          $filtre = $t.",".$_GET['tags'];
        }else{
          //remove active from url to desactivate a tag
          $filtre=str_replace( ( ( stripos( $_GET['tags'], $t."," ) === false ) ? $t : $t."," ) , "" , $_GET['tags'] );
          $onoff = "";
        }
      } else
        $filtre = $t;
      
      $tagHTML = " <a class='tag $t $onoff ' href='/ph/egpc?tags=$filtre'>$t</a>";
      echo "$('#tags').append(\"$tagHTML\");";
  }
  $onoff = ( isset( $_GET['tags'] )) ? "off" : "";
  $tagHTML = " <a class='tag $onoff' href='/ph/egpc'>Tous</a>";
  echo "$('#tags').append(\"$tagHTML\");";
  ?>
  drawGraph();
});

function getGroups(filterTag)
{
  console.log("getGroups",filterTag);
  var params = {"app":"<?php echo $this::$moduleKey?>"};
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

function getMessages(){
  $("#notifications").prepend("robit69");
}
</script>