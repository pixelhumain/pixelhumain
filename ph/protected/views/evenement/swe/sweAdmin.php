<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.touch-punch.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.shapeshift.min.js' , CClientScript::POS_END);
?>
<style>
h2 {
    font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}
.grid a{
display:block;
font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
}
.grid {
      border: 1px dashed #CCC;
      position: relative;
    }

    .grid > div {
      background: #AAA;
      position: absolute;
      height: 100px;
      width: 100px;
    }

    .grid > div[data-ss-colspan="2"] { width: 210px; }
    .grid > div[data-ss-colspan="3"] { width: 320px; }

    .grid > .ss-placeholder-child {
      background: transparent;
      border: 1px dashed blue;
    }
body {	/*overflow: hidden;*/}

canvas{position:absolute;top:0px;left:0px;}

.appMenuContainer{background-color:rgba(59, 120, 163, 0.7);width:100%;height:55px;position:absolute;top:57px;left:0px;z-index:1000;}
.appMenu{position:absolute;top:5px;right:30px;z-index:1051;}
.appMenu li{padding:5px;margin:5px;border:2px solid #666;display:inline;float:left;background-color:#F5E414;}
.appMenu a{color:#324553;font-weight:bold;}

#appPanel{float:right;border:2px solid #000;background-color:#FFF;width:500px;margin-right:100px;padding:5px;
  height: 6em;
  overflow: hidden;
}
#appPanel ul{list-style:none}

.appContent{position:absolute;top:120px;left:120px;z-index:1000;width:90%;}
.appContent ul.people li{position:relative;width:190px;height:100px;padding:5px;margin:5px;
display:block;float:left;
background-color:#FFF;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
-o-border-radius: 5px;
-ms-border-radius: 5px;
border-radius: 5px;}
.appContent ul.people li.descL {height:150px; }
.appContent h1{margin-left:0px;text-decoration:underline;font-family: "Homestead";color: #fff;}
.appContent div.infos{word-wrap:break-word;text-align:right}
.appContent div.type {display:block;float:right;font-size:x-small;}
.appContent div.name {font-family: "Homestead";color: #324553;font-size:medium; margin-left:10px;display:block;float:right; }
.appContent div.desc {position:absolute;width:100%;bottom:0px; margin:5px;}
.appContent div.desc a.btn-ph{display:inline-block;float:left;margin-right:5px;}

.appContent div.thumb{height:40px;width:40px;float:left;}
.appContent .metier{width:20px;height:20px;background-color:red;
position:relative; 
top:0px; right:0px;
-webkit-border-radius: 20px;
-moz-border-radius: 20px;
-o-border-radius: 20px;
-ms-border-radius: 20px;
border-radius: 20px;
border:1px solid #000;}
.participant{border:2px solid yellow;
background-url:#fff url('<?php echo Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png')?>') no-repeat bottom left;}
.projet{border:2px solid orange;}
.coach{border:2px solid purple;}
.jury{border:2px solid red;}
.organisateur{border:2px solid blue;}
.sponsor {list-style:none}
.sponsor img{width:100px;margin-bottom:20px;}

.appFooter{position:fixed;bottom:0px;right:0px;width:100px;z-index:2000;margin:15px;}
</style>

<div class="appContent">

	<h1><?php echo $event["name"]?></h1>
	
	<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2>Administration</h2>
    <p>C'est Raid, c'est grand, 54h pour Pitcher, Rézoter, Contribuer, Développer, Finaliser votre projet.</p>
    <div class="grid">
        <div></div>
        <div  data-ss-colspan="2">
        <a href="<?php echo Yii::app()->createUrl('index.php/evenement/key/id/'.$key)?>">Panel Participant</a>
        </div>
        <div></div>
        <div data-ss-colspan="2"><a href="#sweAddPerson"   target="_blank" role="button" data-toggle="modal"><i class="icon-plus"></i> Participant</a></div>
        <div data-ss-colspan="2">
            <a href="#sweAddProject"   target="_blank" role="button" data-toggle="modal"><i class="icon-plus"></i> Projet</a>
            <?php ?>
        </div>
        <div data-ss-colspan="3"><a href="#sweHelp"   target="_blank" role="button" data-toggle="modal">Statistic </a></div>
        <div></div>
        <?php 
        $ct = 0;
        foreach (Yii::app()->mongodb->startupweekend->find(array("type"=>"participant","events"=>$event["_id"])) as $line) 
        {
            if(count($line)*100/16 < 50)
               $ct++;
        } 
            ?>
        <div data-ss-colspan="3"><a href="<?php echo Yii::app()->createUrl('index.php/evenement/sweCompteRempli/id/'.$key)?>">Compte incomplet (<?php echo $ct?>)</a></div>
        <div></div>
        <div></div>
        <div></div>
   </div>
      
</div></div>

</div>

<?php $this->renderPartial('application.views.evenement.swe.sweSponsor');?>

<canvas id="canvas"></canvas>


<!-- Modal -->
<div id="sweAddPerson" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"> Ajouter un nouveau participant</h3>
  </div>
  <div class="modal-body">
    <p> Un mail d'invitation sera envoyé a ce participant pour remplir sa fiche perso 
    </p>
	<form id="sweAddPersonForm" style="line-height:40px;">
        <section>
          	<table>
          	<tr>
              	<td class="txtright">Email</td>
              	<td> <input id="personEmail" name="personEmail" value=""/></td>
          	</tr>
          	<tr>
              	<td class="txtright">Nom </td>
              	<td> <input id="personName" name="personName" value=""/></td>
          	</tr>
          	<tr>
              	<td class="txtright">type</td>
              	<td> 
              	<?php 
					
					$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
							'data' => array("participant"=>"participant",
											"coach"=>"coach",
											"jury"=>"jury",
											"organisateur"=>"organisateur"), 
                            'name' => 'personType',
                          	'id' => 'personType',
                          	'pluginOptions' => array(
                               'width' => '128px'
                            )
                          ));
					?>
              	</td>
          	</tr>
          	
          	<input type="hidden" id="eventId" name="eventId" value="<?php echo $event["_id"]?>"/>
          </table>
        </section>
        
    </form>
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button class="btn btn-primary" id="submitInvite" onclick="$('#sweAddPersonForm').submit();">Enregistrer</button>
  </div>
</div>
<!-- Modal -->

<script type="text/javascript">
initT['swePersonModalsInit'] = function(){
	$('input[type=file]').change(function (e) {
	    $('#customfileupload').html($(this).val());
	});
    $("#sweAddPersonForm").submit( function(event){
    	event.preventDefault();
    	$("#sweAddPerson").modal('hide');
    	NProgress.start();
    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/index.php/evenement/swePerson",
    	  data: $("#sweAddPersonForm").serialize(),
    	  success: function(data){
    			  $("#flashInfo .modal-body").html(data.msg);
    			  $("#flashInfo").modal('show');
    			  NProgress.done();
    	  },
    	  dataType: "json"
    	});
    });
};
</script>

<!-- Modal -->
<div id="sweAddProject" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"> Ajouter un nouveau projet</h3>
  </div>
  <div class="modal-body">
    <p> Creer un nouveau projet ,vous connecterez ensuite son equipe.</p>
<form id="sweAddProjectForm" style="line-height:40px;">
        <section>
          	<table>
          	
              	<tr>
                  	<td class="txtright">Nom du Projet</td>
                  	<td> <input id="projectName" name="projectName" value=""/></td>
              	</tr>
              	
              	
                  	<?php 
                  	echo $event["_id"];
    					$participants = iterator_to_array(Yii::app()->mongodb->startupweekend->find());
    					$particpantsOptions = array();
    					$projectKey = "projet";
                        if( $event["_id"] == "523321c7c073ef2b380a231c")
                            $projectKey = "projet13"; 
    					foreach($participants as $p){
    					    if(isset($p["type"]) && $p["type"] == "participant" )
    					        $particpantsOptions[$p["email"]] = $p["email"];
    					}
    					
    					?>
              	
              	<tr>
                  	<td class="txtright">Description</td>
                  	<td> <textarea id="projectDesc" name="projectDesc"></textarea></td>
              	</tr>
              	
              	<tr>
                  	<td class="txtright">Équipe</td>
                  	<td> 
    					<?php 
    					$particpantsOptions = array();
    					foreach($participants as $p){
    					    if(isset($p["type"]) && $p["type"] == "participant" && !isset($p[$projectKey]))
    					        array_push($particpantsOptions, $p["email"]);
    					}
    					    
    					$this->widget('yiiwheels.widgets.select2.WhSelect2', array(
    							'name' => 'projectTeam',
                              	'id' => 'projectTeam',
    							'asDropDownList' => false,
    							'value'=> "",
                                'pluginOptions' => array(
                                   'tags' => $particpantsOptions,
    								'placeholder' => "",
                                    'width' => '100%',
                                )
                              ));
    					?>
    				</td>
              	</tr>
              	<input type="hidden" id="eventId" name="eventId" value="<?php echo $event["_id"]?>"/>
          </table>
        </section>
    </form>
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button class="btn btn-primary" id="submitInvite" onclick="$('#sweAddProjectForm').submit();">Enregistrer</button>
  </div>
</div>
<!-- Modal -->


<script type="text/javascript">
initT['sweProjectModalsInit'] = function(){
	$('input[type=file]').change(function (e) {
	    $('#customfileupload').html($(this).val());
	});
    $("#sweAddProjectForm").submit( function(event){
    	event.preventDefault();
    	$("#sweAddProject").modal('hide');
    	NProgress.start();
    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/index.php/evenement/sweProject",
    	  data: $("#sweAddProjectForm").serialize(),
    	  success: function(data){
    			  $("#flashInfo .modal-body").html(data.msg);
    			  $("#flashInfo").modal('show');
    			  NProgress.done();
    	  },
    	  dataType: "json"
    	});
    });
};
</script>


<script type="text/javascript">

initT['sweGraphInit'] = function(){
	(function ani(){
	      TweenMax.staggerFromTo(".grid a",2, {scaleX:0.4, scaleY:0.4}, {scaleX:0.8, scaleY:0.8});
	})();

	$(".grid").shapeshift({
	    minColumns: 3
	  });
};

</script>	

