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
  .tags a, a.btn{
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
  .tags a:hover{
    background-color: transparent;
    border-color:yellow; 
    color: yellow;
  }
  .tags a.off{
    background-color: grey;
  }
  a > i.fa{ 
    color: yellow;
    padding-right: 10px;
  }
  #notifications{
    padding: 10px;
  }
  .tar{text-align: right}
  .yellow{color: yellow}
  .cadre{border:1px solid yellow;margin-bottom:10px;width:60%;padding:10px;min-height:110px;}
  label {display:inline-block;width:120px;color:yellow;text-align: right;padding:3px;}
</style>
<section class="mt80 stepContainer">

    <div class="step home ">
      <div class="fr">
        <input type="text" id="search" placeholder="chercher"/> 
        <a href="javascript:alert('TODO : connect to API')"><i class="fa fa-search"></i></a>
        <?php $this->renderPartial( "tools" ); ?>
      </div>
      <div class="stepTitle">Reseau EGPC </div>
      
      <div id="mygraph"></div>
    
      <div class="tags" style="width:49%; float:left;border:1px solid #fff;margin-top:5px;"></div>
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

    <div class="step what " >
      <div class="fr">
        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
        <?php $this->renderPartial( "tools" ); ?>
      </div>
      <div class="stepTitle">Qui fait quoi ?</div>
      <script type="text/javascript">
<?php 
      echo "console.log('group count : ".count($groups)."');";?>
      </script>
      <?php 
        foreach ($groups as $key => $value) 
        {
          $name = $value["name"];
          $email =  (isset($value["email"])) ? $value["email"] : "";
          $tagBlock = "";
          $taglist = "";
          if(isset($value["tags"]))
          {
            $tagBlock .= "<div class='fr tar'>";
            foreach ($value["tags"] as $value3) 
            {
              $taglist .= $value3." ";
              $tagBlock .= "<a class='yellow' href='javascript:hideShow(\".$value3\",\".cadre\")'>$value3</a><br/>";       
            }
            $tagBlock .= "<div style='clear:both'>&nbsp;</div></div>";
          }
          echo "<div class='cadre $taglist' >";
          echo $tagBlock;
          echo "$name $email 
                  <div>Inscrit : <br/>";

          $people = Citoyen::getPeopleBy(array("groupname"=>$name,"fields"=>array("email",'name')));
          foreach ($people as $key2 => $value2) 
          {
            $name2 = ( isset($value2["name"]) ) ? $value2["name"] : "";  
            $email2 = $value2["email"];
            echo "$name2 $email2 <br/>";
          }
          echo "</div>

          </div>";
        }
        ?>
        <div style="clear:both"></div>
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

    <div class="step newAsso hidden" >
      <div class="fr">
        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
        <?php $this->renderPartial( "tools" ); ?>
      </div>
      
      <div class="stepTitle">Ajouter une Asso ?</div>
      
      <div class="apiForm saveGroup">
        <label for="">name : </label><input type="text" name="namesaveGroup" id="namesaveGroup" value="Asso1" /><br/>
        <label for="">email* :</label> <input type="text" name="emailsaveGroup" id="emailsaveGroup" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /> (personne physique responsable )<br/>
        <label for="">cp* : </label><input type="text" name="postalcodesaveGroup" id="postalcodesaveGroup" value="97421" /><br/>
        <label for="">phoneNumber : </label><input type="text" name="phoneNumbersaveGroup" id="phoneNumbersaveGroup" value="1234" />(for SMS)<br/>
        <label for="">tags : </label><input type="text" name="tagssaveGroup" id="tagssaveGroup" value="" placeholder="ex:social,solidaire...etc"/><br/>
        <label for="">type : </label><select name="typesaveGroup" id="typesaveGroup" onchange="typeChanged()">
              <option value="association">Association</option>
              <option value="entreprise">Entreprise</option>
              <option value="group">Groupe de personne</option>
              <option value="event">Evenement</option>
            </select><br/>
        <br/>
        <a class="btn" href="javascript:saveGroup()">ENREGISTRER</a><br/>
        <div id="saveGroupResult" class="result fss"></div>
        <script>
          function saveGroup(){
            params = { "email" : $("#emailsaveGroup").val() , 
                     "name" : $("#namesaveGroup").val() , 
                     "cp" : $("#postalcodesaveGroup").val() , 
                     "pwd" : $("#pwdsaveGroup").val(),
                     "type" : $("#typesaveGroup").val(),
                     "phoneNumber" : $("#phoneNumbersaveGroup").val(),
                     "tags" : $("#tagssaveGroup").val(),
                     "app":"<?php echo $this::$moduleKey?>",
                  };
            if( $("#whensaveGroup").val() )
              params["when"] = $("#whensaveGroup").val();
            if( $("#wheresaveGroup").val() )
              params["where"] = $("#wheresaveGroup").val();
            if( $("#whosaveGroup").val() )
              params["group"] = $("#whosaveGroup").val();
            
            testitpost("saveGroupResult",'/ph/<?php echo $this::$moduleKey?>/api/saveGroup',params);
          }
        </script>
    </div>
    </div>
    
    <div class="step newDate hidden" >
      <div class="fr">
        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
        <?php $this->renderPartial( "tools" ); ?>
      </div>
      <div class="stepTitle">Ajouter une Date à l'agenda EGPC ?</div>
      <div class="apiForm addEvent">
      <label for="nameaddEvent">name : </label><input type="text" name="nameaddEvent" id="nameaddEvent" value="Asso1" /><br/>
      <label for="">email* : </label><input type="text" name="emailaddEvent" id="emailaddEvent" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /> (personne physique responsable )<br/>
      <label for="">when : </label><input type="text" name="whenaddEvent" id="whenaddEvent" value="" /><br/>
      <label for="">where : </label><input  type="text" name="whereaddEvent" id="whereaddEvent" value="" /><br/>
      <label for="">cp* : </label><input type="text" name="postalcodeaddEvent" id="postalcodeaddEvent" value="97421" /><br/>
      <label for="">phoneNumber : </label><input type="text" name="phoneNumberaddEvent" id="phoneNumberaddEvent" value="1234" />(for SMS)<br/>
      <label for="">tags : </label><input type="text" name="tagsaddEvent" id="tagsaddEvent" value="" placeholder="ex:social,solidaire...etc"/><br/>
      <label for="">participant : </label><input  type="text" name="whoaddEvent" id="whoaddEvent" value="5370b477f6b95c280a00390c" /><br/>
      <br/>
      <a class="btn" href="javascript:addEvent()">ENREGISTRER</a><br/>
      <div id="addEventResult" class="result fss"></div>
      <script>
        function addEvent(){
          params = { "email" : $("#emailaddEvent").val() , 
                   "name" : $("#nameaddEvent").val() , 
                   "cp" : $("#postalcodeaddEvent").val() , 
                   "pwd" : $("#pwdaddEvent").val(),
                   "type" : "event",
                   "phoneNumber" : $("#phoneNumberaddEvent").val(),
                   "tags" : $("#tagsaddEvent").val(),
                   "app":"<?php echo $this::$moduleKey?>",
                   "when":$("#whenaddEvent").val(),
                   "where":$("#whereaddEvent").val(),
                   "group":$("#whoaddEvent").val()
                };
          testitpost("addEventResult",'/ph/<?php echo $this::$moduleKey?>/api/saveGroup',params);
        }
        
      </script>
    </div>
      
    </div>

    <div class="step newMessage hidden" >
      <div class="fr">
        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
        <?php $this->renderPartial( "tools" ); ?>
      </div>
      <div class="stepTitle">Transmettre un message ?</div>
      <div class="fss">
      <label for="">message  : </label><textarea name="sendMessagemsg" id="sendMessagemsg"></textarea> <br/>
      <label for="">email(s) : </label><textarea type="text" name="sendMessageemail" id="sendMessageemail"><?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com</textarea><br/>
      séparé par des virgules<br/>
      <br/>
      <a class="btn"  href="javascript:sendMessage()">ENVOYER</a><br/>
      <select id="sendMessagePeople">
        <option></option>
        <?php 
        //$groups = Yii::app()->mongodb->groups->find( array( "applications.".$this::$moduleKey.".usertype" => Group::TYPE_ASSOCIATION ));
        foreach ($groups as $value) {
          echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
        }
        ?>
      </select>
      <a class="btn" href="javascript:setPeople()">Get People </a><br/>
      <div id="sendMessageResult" class="result fss"></div>
      <script>
        function sendMessage(){
          params = { 
               "email" : $("#sendMessageemail").val() , 
               "msg" : $("#sendMessagemsg").val(),
               "app":"<?php echo $this::$moduleKey?>"
               };
          testitpost("sendMessageResult",'/ph/<?php echo $this::$moduleKey?>/api/sendMessage',params);
        }
        function setPeople(){
          $("#sendMessageemail").val("");
          $.ajax({
              url:'/ph/<?php echo $this::$moduleKey?>/api/getPeopleBy',
              type:"POST",
              data:{ "groupname":$("#sendMessagePeople").val()},
              datatype : "json",
              success:function(data) {
                list = "";
                $.each(data,function(k,v){
                    list += (list == "") ? v.email : ","+v.email ;
                })
                  console.log(list);
                  $("#sendMessageemail").val(list);
                    
              },
              error:function (xhr, ajaxOptions, thrownError){
                $("#"+id).html(data);
              } 
            });
        }
      </script>
    </div>
      
    </div>
    
    <div class="step linkPeople hidden" >
      <div class="fr">
        <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
        <?php $this->renderPartial( "tools" ); ?>
      </div>
      <div class="stepTitle">Connecter Acteur et Groupe</div>
      
      <div class="fss">
      
      all <?php echo $this::$moduleKey?> groups  : 
      <select id="linkUser2GroupGroup">
        <option></option>
        <?php 
        //$groups = Yii::app()->mongodb->groups->find( array( "applications.".$this::$moduleKey.".usertype" => Group::TYPE_ASSOCIATION ));
        foreach ($groups as $value) {
          echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
        }
        ?>
        
      </select><br/>
      <label for="">email(s) : </label><textarea type="text" name="linkUser2Groupemail" id="linkUser2Groupemail"><?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com</textarea><br/>
      séparé par des virgules<br/>
      <a class="btn" href="javascript:linkUser2Group()">Link it</a>
      <a class="btn" href="javascript:unlinkUser2Group()">Unlink it</a><br/>
      <br/>
      <div id="linkUser2GroupResult" class="result fss"></div>
      <script>
        function linkUser2Group(){
          params = { 
               "email" : $("#linkUser2Groupemail").val() , 
               "name" : $("#linkUser2GroupGroup").val() 
               };
          testitpost("linkUser2GroupResult",'/ph/<?php echo $this::$moduleKey?>/api/linkUser2Group',params);
        }
        function unlinkUser2Group(){
          params = { 
               "email" : $("#linkUser2Groupemail").val() , 
               "name" : $("#linkUser2GroupGroup").val() 
               };
          testitpost("linkUser2GroupResult",'/ph/<?php echo $this::$moduleKey?>/api/unlinkUser2Group',params);
        }
      </script>
    </div>
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

  $("#whenaddEvent").datepicker();
/*setTimeout(function () {
            getMessages();
        }, 5000);*/
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
      $name = ( isset($value["name"]) ) ? $value["name"] : "";  
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
  //init js for the graph nodes
  echo "console.log('group count : ".count($groups)."');";
  foreach ($groups as $key => $value) 
  {
    $name = $value["name"];
    $email = $value["email"];
    echo "nodes.push({id: '$key', label: '$name \\n $email',color: 'beige'});";
    echo "edges.push({from: 1, to: '$key'});";

    $people = Citoyen::getPeopleBy(array("groupname"=>$name,"fields"=>array("email",'name')));
    foreach ($people as $key2 => $value2) 
    {
      $name2 = ( isset($value2["name"]) ) ? $value2["name"] : "";  
      $email2 = $value2["email"];
      if( isset( $_GET['people'] )){
        echo "nodes.push({id: '$key2-$key', label: '$name2 \\n $email2'});";
        echo "edges.push({from: '$key', to: '$key2-$key'});";
      }
    }
  }
  //preparing data for the tags filter
  foreach ($tagsall as $t) 
  {
    $filtre = "";
      $onoff = "off";
      if( isset( $_GET['tags'] )){
        if( stripos($_GET['tags'], $t) === false)
        {
          $filtre = $t.",".$_GET['tags'];
        }
        else
        {
          //remove active from url to desactivate a tag
          $filtre=str_replace( ( ( stripos( $_GET['tags'], $t."," ) === false ) ? $t : $t."," ) , "" , $_GET['tags'] );
          $onoff = "";
        }
      } else
        $filtre = $t;
      
      $tagHTML = " <a class='tag $t $onoff ' href='/ph/egpc?tags=$filtre'>$t</a>";
      echo "$('.tags').append(\"$tagHTML\");";
  }
  $onoff = ( isset( $_GET['tags'] )) ? "off" : "";
  $tagHTML = " <a class='tag $onoff' href='/ph/egpc'>Tous</a>";
  echo "$('.tags').append(\"$tagHTML\");";
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

function hideShow(ids,parent=".step")
{
  $(parent).slideUp();
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