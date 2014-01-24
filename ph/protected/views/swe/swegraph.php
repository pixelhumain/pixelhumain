<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.scrollbox.js' , CClientScript::POS_END);

$graph = 0;

$cs->registerScriptFile('http://code.highcharts.com/highcharts.js' , CClientScript::POS_END);
$cs->registerScriptFile('http://code.highcharts.com/modules/exporting.js' , CClientScript::POS_END);
$cs->registerScriptFile('http://code.highcharts.com/highcharts-more.js' , CClientScript::POS_END);
?>
<style>
body {	/*overflow: hidden;*/}

canvas{position:absolute;top:0px;left:0px;}

.appMenuContainer{background-color:rgba(59, 120, 163, 0.7);width:100%;height:55px;position:absolute;top:61px;left:0px;z-index:1000;}
.appMenu{position:absolute;top:5px;right:30px;z-index:1051;}
.appMenu li{padding:5px;margin:5px;border:2px solid #666;display:inline;float:left;background-color:#F5E414;}
.appMenu a{color:#324553;font-weight:bold;}

#appPanel{float:right;border:2px solid #000;background-color:#FFF;width:500px;margin-right:100px;padding:5px;
  height: 6em;
  overflow: hidden;
}
#appPanel ul{list-style:none}

.appContent{position:absolute;top:120px;left:120px;z-index:1000;width:90%;display:none}
.appContent h1{margin-left:0px;text-decoration:underline;font-family: "Homestead";color: #fff;}
.appContent ul.people li{cursor:pointer;position:relative;width:190px;height:100px;padding:5px;margin:5px;display:block;float:left;background-color:#FFF;-webkit-border-radius: 5px;-moz-border-radius: 5px;-o-border-radius: 5px;-ms-border-radius: 5px;border-radius: 5px;}
.appContent ul.people li.me{background-color:#F5E414;}
.appContent ul.people li.me img{cursor:pointer}
.appContent ul.people li.descL {height:200px; }
.appContent li.participant{border:2px solid yellow;background-url:#fff url('<?php echo Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png')?>') no-repeat bottom left;}
.appContent li.projet{border:2px solid orange;}
.appContent li.coach{border:2px solid purple;}

.appContent li.jury{border:2px solid red;}
.appContent li.organisateur{border:2px solid blue;}
.sponsor {list-style:none}
.sponsor img{width:100px;margin-bottom:20px;}
.appContent div.infos{word-wrap:break-word;text-align:right}
.appContent div.type {display:block;float:right;font-size:x-small;clear:both;}
.appContent div.name {font-family: "Homestead";color: #324553;font-size:medium; margin-left:10px;display:block;position:absolute;bottom:5px;right:5px; }
.appContent div.desc {position:absolute;width:100%;bottom:0px; margin:5px;text-align:left;word-wrap: break-word;width:180px;padding-right:5px;position:absolute;top:50px;left:5px;}
.appContent div.desc span.txt{font-size:small;}
.appContent div.desc a.btn-ph{display:inline-block;float:left;margin-right:5px;position:absolute;bottom:5px;left:5px;}
.appContent div.thumb{position:absolute;height:40px;width:40px;top:5px;left:5px;}
.appContent .metier{width:20px;height:20px;background-color:red;position:relative; top:0px; right:0px;-webkit-border-radius: 20px;-moz-border-radius: 20px;-o-border-radius: 20px;-ms-border-radius: 20px;border-radius: 20px;border:1px solid #000;}

.appFooter{position:fixed;bottom:0px;right:0px;width:70px;z-index:2000;margin:15px;}

.bgRed{background-color:red;}
.cRed{color:red;}
.coachRequestedColor{border:5px solid red;}

</style>

    
<div class="appMenuContainer">
    <ul class="appMenu">
    	<?php if( in_array( Yii::app()->session["userEmail"], $event["adminEmail"]) ){ ?>
    		<li><a href="<?php echo Yii::app()->createUrl('index.php/ext/startupweekend/sweadmin/id/'.$key)?>"><i class="icon-wrench"></i> Admin</a></li>
    		<li><a href="javascript:statnum=1;filterType('statistics')">Stats</a></li>
    	<?php } ?>
    	<?php /*?><li><a href="#sweInscription" id="mesInfos" role="button" data-toggle="modal"><i class="icon-user"></i> Mes Infos</a></li>
    	<li><a href="#coaching" role="button" data-toggle="modal"><i class="icon-bell"></i> APPEL UN COACH !! </a><a href="#coaching" role="button" data-toggle="modal"><span id="coachingCount" class="badge bgRed" ></span></a></li>*/?>
        <li><a href="javascript:filterType('participant')">Inscrits <span class="badge"><?php echo count($event["participants"])?></span></a></li>
        <li><a href="javascript:filterType('projet')">Projets <span class="badge"><?php echo count($event["projects"])-2?></span></a></li>
        <li><a href="javascript:filterType('coach')">Coachs <span class="badge"><?php echo count($event["coaches"])?></span></a></li>
        <li><a href="javascript:filterType('jury')">Jurys <span class="badge"><?php echo count($event["jurys"])?></span></a></li>
        <li><a href="javascript:filterType('organisateur')">Organisateurs <span class="badge"><?php echo count($event["organisateurs"])?></span></a></li>
    </ul>
</div>

<div class="appContent">

    <div id="appPanel" class="hidden">
    	<ul id="appPanelList"></ul>
    </div>
    
	<h1><?php echo $event["name"]?><br/><span class="appTitle"></span></h1>
	
	<br/>
	
	<ul class="people">
    	<?php
    	
    	$row = 1;
    	$coaches = array();
    	$myproject = '';
    	$projects = array();
    	$meType = '';
    	
    	//statistics
    	$projectMap = array();
    	$teamTypeMap = array();
    	$cpMap = array( "Unknown" => array() );
    	$newsMap = array("N"=>0,"E"=>0,"S"=>0,"O"=>0);
    	$objectifMap = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
    	$expertiseMap = array(0,0,0,0,0,0,0,0,0);
    	$formationMap = array(0,0,0,0,0,0,0,0,0);
    	$etudiantCount = 0;
    	$professionMap = array(0,0,0,0,0,0,0);
    	$commentConnuSWEMap = array(0,0,0,0,0,0,0,0,0);
    	$moyenDage = 0;
    	$nbDage = 0 ;
    	$contactMembresProlonge = Array();
    	$objectifsAtteint = array("toutafait"=>0,"enPartie"=>0,"pasdutout"=>0); ;
    	$concretisation = array("ouiRapidement"=>0,"OuiMaisPlusTard"=>0,"ouiSousUneAutreForme"=>0,"non"=>0);
    	$recommandation = array("oui"=>"Oui, oui et oui !","pourquoiPas"=>"Pourquoi pas","non"=>"Non");
    	$amerlioration = array("déroulement"=>"Déroulement","explications"=>"Explications","coaching"=>"coaching","orgaGenerale"=>"organisation en général");
        foreach ($sweThings as $line) 
        {
            if(in_array($event['_id'],$line['events']) && !in_array( $line["_id"], array("52904262e9ce27f504cffd46","52904512e9ce27f504cffd48") ) )
            {    
                $name = (isset($line["name"])) ? $line["name"]: null;
                $type = (isset($line["type"])) ? $line["type"] : null;
                $email = (isset($line["email"])) ? $line["email"]:null;
                $desc = (isset($line["desc"])) ? $line["desc"]:null;
                
                $project = "";
                
                //statistics
                if(isset($type) && in_array($type, array('participant'))){
                    if(isset($line["codepostal"]) ){
                        if( !isset( $cpMap[ $line["codepostal"] ] ) )
                            $cpMap[ $line["codepostal"] ] = array();
                        array_push( $cpMap[ $line["codepostal"] ], $email );
                        $newsMap[OpenData::$communeMap["974"][$line["codepostal"]]["news"]] += 1; 
                    }else
                        array_push( $cpMap[ "Unknown" ], $email );
                
                    if(isset($line["objectif"]) ){
                        $objectifMap[ $line["objectif"] ] += 1;
                    }else
                        $objectifMap[ 0 ] += 1;
                        
                    if(isset($line["expertise"]) ){
                        $expertiseMap[ $line["expertise"] ] += 1;
                    }else
                        $expertiseMap[ 0 ] += 1;

                    if(isset($line["formation"]) && !empty($line["formation"])){
                        $formationMap[ $line["formation"] ] += 1;
                        $etudiantCount++;
                    } /*else
                        $formationMap[ 0 ] += 1;*/
                        
                    if(isset($line["profession"]) ){
                        $professionMap[ $line["profession"] ] += 1;
                    }else
                        $professionMap[ 0 ] += 1;
                        
                    if(isset($line["commentConnuSWE"]) ){
                        $commentConnuSWEMap[ $line["commentConnuSWE"] ] += 1;
                    }else
                        $commentConnuSWEMap[ 0 ] += 1;
                    
                    $age = (isset($line["age"])) ? $line["age"]:null;
                    if($age){
                       $nbDage++;
                       $moyenDage += $age;
                    }
                    if(isset($line["objectifsAtteint"]) && !empty($line["objectifsAtteint"]) )
                        $objectifsAtteint[ $line["objectifsAtteint"] ] += 1;
                    
                    
                    if(isset($line["concretisation"]) && !empty($line["concretisation"]) )
                        $concretisation[ $line["concretisation"] ] += 1;
                    
                        
                    if(isset($line["recommandation"]) && !empty($line["recommandation"]) )
                        $recommandation[ $line["recommandation"] ] += 1;
                    
                    if(isset($line["amerlioration"]) && !empty($line["amerlioration"]) )
                        $amerlioration[ $line["amerlioration"] ] += 1;
                    
                    /*if(isset($line["contactMembresProlonge"]) ){
                        $contactMembresProlonge[ $line["contactMembresProlonge"] ] += 1;
                    }else
                        $contactMembresProlonge[ 0 ] += 1;*/
                }
                    
                //un user peut etre associer a un projet 2012 et 13
                //lorsqu'en 2012 projet = projectName
                // 2013 projet13 = projectName
                if( $key == "StartupWeekEnd2012" && isset($line["projet"])) 
                    $project = str_replace(' ', '', $line["projet"]);
                else if( $key == "StartupWeekEnd2013" && isset( $line["projet13"] )) 
                    $project = str_replace(' ', '', $line["projet13"]);
                    
                $img = (isset($line["image"]))? $line["image"]:"";
                
                //some panels will have more information than others
                $classDesc = (isset($type) && in_array($type, array('jury','coach','projet'))) ? 'descL' : '';
                //only show people panels on load 
                $classHide = (isset($type) && in_array($type, array('participant'))) ? 'hide' : '';
                //connected users panel will be different
                $classMe = (Yii::app()->session["userEmail"] == $email && $type!='projet') ? 'me' : '';
                if(!empty($classMe))$meType = $type;
                if(!empty($classMe) && !empty($project) ){
                    $myproject = $project;
                }
    
                //desc content
                $xtra = '<div class="xtra clear"></div><div class="desc">';
                if( isset( $desc) && $desc == strip_tags($desc) )
                    $xtra .= '<span class="txt">';
                $xtra .= (isset($desc)) ? $desc : '';
                if( isset( $desc) && $desc == strip_tags($desc) )
                    $xtra .= '</span><div class="clear"></div>';
                    
                $classProjet = ''; 
                if(!empty($project))
                {
                    $classProjet = $project;
                    //adds show team on project panel
                    if(isset($type) && ( $type=='projet' || $type=='participant')) 
                    {
                        $xtra .= "<a  class='btn-ph' href='#' onclick='filterType(\"".$project."\")' title='Project Team'><span class='icon-users'></span></a>";
                    }
                    
                    //statistics
                    if( !isset( $projectMap[ $project ] ) ){
                        $projectMap[ $project ] = array();
                        $teamTypeMap[$project ] = array(0,0,0,0,0,0,0,0,0);
                    }
                    if( $type!='projet' ){
                        array_push( $projectMap[ $project ], $email );
                        if(isset($line["expertise"]) ){
                            if(!isset( $teamTypeMap[ $project ][ $line["expertise"] ] ))
                                $teamTypeMap[ $project ][ $line["expertise"] ] = 0;
                            $teamTypeMap[ $project ][ $line["expertise"] ] += 1;
                        }
                    }
                } 
                 
                //join Btn on project panel
                if(isset($type) && $type=='projet'){
                    /*if(in_array( Yii::app()->session["userEmail"], $event["adminEmail"]))
                        $xtra .= "<a class='btn-ph' href='javascript:userJoinProject(\"".$project."\")' title='Rejoindre ce projet'><span class='icon-share'></span></a>";*/
                    array_push($projects, $project );
                }
                else if(isset($type) && $type=='coach')
                {
                    $coachRequestBadge =  '<span id="'.(str_replace(' ', '', $name)).'RequestBadge" class="badge bgRed coachBadges" ></span>';
                    $xtra .= "<a class='btn-ph' href='#coaching' onclick='$(\"#coachRequested\").select2(\"val\",\"".(str_replace(' ', '', $name))."\")'  role='button' data-toggle='modal' title='Appeler ce coach'><span class='icon-megaphone'></span></a>".$coachRequestBadge;
                }
                $xtra .= '</div>';
                
                $img = (!empty($img) ) ? Yii::app()->createUrl('upload/swe/'.$img) : Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png'); 
                $canView = ( in_array( Yii::app()->session["userEmail"], $event["adminEmail"]) ) ? 'onclick="showPerson(\''.$email.'\')"' : "";   
                if(!empty($name) && isset($type))
                {
                    $names = explode(" ", $name);
                    $strNames = "";
                    /*if( count($names) > 2 )
                        $strNames = $names[0]."<br/>".str_replace($names[0], '', $name);
                    else*/
                        $strNames = str_replace( ' ', '<br/>', $name );
    
                    $coachClass = "";
                    if(isset($type) && $type=='coach'){
                        $coaches[str_replace(' ', '', $name)] = $name;
                        $coachClass = str_replace(' ', '', $name);
                    }     
                    echo '<li class="'.$type.' '.$classDesc.' hide '.$classProjet.' '.$classMe.' '.$coachClass.'" >'.
                    		'
                    		<div class="infos">
                    			<div class="type">'.((isset($type)) ?$type:"").'</div>
                    			<div class="name " >'.$strNames.'</div>
                    			<div class="thumb" ><img src="'.$img.'" '.$canView.' /></div>'.
                                $xtra.'
                    		</div>
                    	 </li>';
                    
            }
            }
        }?>
	</ul>
	
	<style>
		.statistics { width:80%; }
		.statistics ul { list-style:none; }
		.statistics li div { border:2px solid #666; background:white;  }
		.statistics a.btn{font-size:30px;margin-bottom:8px;} 
		.statistics a.icon-right{margin-left:30px}
		.statistics h1{text-decoration:none;color: #324553;}
	</style>
	
	<div class="statistics">
		<ul>
			<a class="icon-left btn nextStat" href="javascript:statPanelIndex (-1)"></a>
			<a class="icon-right  btn prevStat" href="javascript:statPanelIndex (1)"></a>
    		<li id="stats1" class="hide chart">
    			
    			<h1>Participants  <br/><?php echo count($event["participants"])?> Inscrits</h1>
    			<h1>98 sont venus</h1>
    			<h1>46 ont pitchés</h1>
    			<h1><?php echo count($event["projects"])?> Projets Retenus</h1>
    			<h1>56 sont restés</h1>
    			<h1>Moyenne d'age <?php echo floor($moyenDage/$nbDage)?> ans</h1>
    			<h1>54h de dure labeur</h1> 
    			<h1>C'etait Grand et Raide</h1>
    		</li>
    		<li id="stats2" class="hide chart">
    			<div id="container14" style=" width:800px;margin: 0 auto"></div>
    		</li>
    		<li id="stats3" class="hide chart">
    			<div id="container4" style="width:800px;margin: 0 auto"></div>
    		</li>
    		<li id="stats4" class="hide chart">
    			<div id="container2" style="width:800px;margin: 0 auto"></div>
    			<div id="container5" style=" width:800px;margin: 0 auto"></div>
    		</li>
    		<li id="stats5" class="hide chart">
    			<div id="container12" style="width:800px;margin: 0 auto"></div>
    		</li>
    		<li id="stats6" class="hide chart">
    			<div id="container8" style="width:800px;margin: 0 auto"></div>
    		</li>
    		<li id="stats7" class="hide chart">
    			<div id="container11" style="width:800px;margin: 0 auto"></div>
    		</li>
    		<li id="stats8" class="hide chart">
    			<div id="container9" style="width:800px;margin: 0 auto"></div>
    		</li>
    		<li id="stats9" class="hide chart">
    			<div id="container10" style="width:800px;margin: 0 auto"></div>
    		</li>
    		
    		<li id="stats10" class="hide chart">
    			<div id="container7" style="width:800px;margin: 0 auto"></div>
    		</li>
    		
    		<li id="stats11" class="hide chart">
    			<div id="container3" style="width:800px;margin: 0 auto"></div>
    		</li>
    		
    		<li id="stats12" class="hide chart">
    			<div id="container16" style="width:800px;margin: 0 auto"></div>
    		</li>
    		
    		<li id="stats13" class="hide chart">
    			<div id="container17" style="width:800px;margin: 0 auto"></div>
    		</li>
		</ul>
	</div>
	
</div>

<?php $this->renderPartial('application.views.swe.sweSponsor');?>

<canvas id="canvas"></canvas>

<?php $this->renderPartial('application.views.swe.sweModals',array('coaches'=>$coaches,
    																		 'myproject'=>$myproject,
                                                                             'projects'=>$projects,
                                                                             'event'=>$event,
                                                                             'meType'=>$meType
                                                                            ));?>


<script type="text/javascript">

function showPerson(email){
	$.ajax({
  	  type: "POST",
  	  url: baseUrl+"/index.php/ext/startupweekend/sweGetPerson",
  	  data: {"email":email},
  	  success: function(data){
  			  $("#flashInfo .modal-body").html(data.msg);
  			  $("#flashInfo").modal('show');
  	  },
  	  dataType: "json"
  	});
}
var previousDataCoach = {"count":0};
function getCoachCount(){
    $.getJSON(baseUrl+"/index.php/ext/startupweekend/sweNotifications/id/<?php echo $event["_id"]?>", function(data) {
        // console.log(previousDataCoach);
        // console.log(data);
		if( previousDataCoach.count != data.count  )
		{	
			console.log("entered");
            if(data.count > 0){
            	$("#appPanel").show();
            	$("#coachingCount").html(data.count);
            }
            else {
            	$("#appPanel").hide();
            	$("#coachingCount").html('');
            }
        	var coaches = data.coaches;
        	var projects= data.projects;
        	var ids= data.ids;
        	$(".coachRequestedColor").removeClass("coachRequestedColor");
        	$(".coachBadges").html("");
        	$("#appPanelList").html("");
        	$(".coach").css("border","2px solid purple");
        	for(var ix = 0; ix < coaches.length; ix++){
            	/*console.log(coaches[ix]);
            	console.log(projects[ix]);*/
    			$("."+coaches[ix]).addClass("coachRequestedColor");//marche pas 
    			$("."+coaches[ix]).css("border","5px solid red");
    			if( $("#"+coaches[ix]+"RequestBadge").html() != "" )
    	  			$("#"+coaches[ix]+"RequestBadge").html( parseInt( $("#"+coaches[ix]+"RequestBadge").html() ) + 1 );
        	    else	  
        			$("#"+coaches[ix]+"RequestBadge").html("1");
    			var remove = "";
    			<?php if(in_array($user["type"], array('coach','organisateur')) || in_array(Yii::app()->session["userEmail"], $event["adminEmail"])) { ?>
    				remove = "<span class='icon-squarred-cross cRed'><a href='#' onclick='sweCoachingDone(\""+ids[ix]+"\")'>&#10062;</a></span>";
    			<?php }?>
    			$("#appPanelList").append("<li><span class='icon-megaphone cRed'></span>"+coaches[ix]+" : "+projects[ix]+" "+remove+" </li>");
        	}
		}
		previousDataCoach = data;
        setTimeout(getCoachCount,5000);
    });
}
function sweCoachingDone(id){
	NProgress.start();
	$.ajax({
	  type: "POST",
	  url: baseUrl+"/index.php/ext/startupweekend/sweCoachingDone",
	  data: {"id":id},
	  success: function(data){
		  	  $("#flashInfo .modal-body").html(data.msg);
			  $("#flashInfo").modal('show');
			  NProgress.done();
	  },
	  dataType: "json"
	});
	console.log("sweCoachingDone "+id);
}
function userJoinProject(project){
	$("li.projet.me").removeClass('me');
	NProgress.start();
	$.ajax({
	  type: "POST",
	  url: baseUrl+"/index.php/ext/startupweekend/sweRejoindreProjet",
	  data: {"projet":project},
	  success: function(data){
		  	  $("li.projet."+project).addClass('me');
			  $("#flashInfo .modal-body").html(data.msg);
			  $("#flashInfo").modal('show');
			  NProgress.done();
	  },
	  dataType: "json"
	});
}

var statnum = 1;
var statsPanelCount = $(".chart").length;
function statPanelIndex (step){
	$("#stats"+statnum).slideUp();
	$(".nextStat,.prevStat").show();
	if(statnum == statsPanelCount && step == 1)
		statnum = 1;
	else if ( statnum == 1 && step == -1 )
		statnum = statsPanelCount;
	else
		statnum = statnum + step;	
	filterType( "statistics" );	
}

$(".nextStat,.prevStat").click(function(){
lockInterval = true;
console.log("set lockInterval ",lockInterval);
});

function filterType(type){
	$(".appContent ul.people li").slideUp();
	$(".nextStat,.prevStat").hide();
	$("#stats"+statnum).hide();
	if(type == "statistics")
	{
		$(".nextStat,.prevStat").show();
		$("#stats"+statnum).slideDown();
	}
	else 
	{
    	$(".appContent ul.people li."+type).slideDown();
    	if(type=="projet")
    		$(".appTitle").html("Les projets");
    	else if(type=="jury")
    		$(".appTitle").html("Le jury");
    	else if(type=="coach")
    		$(".appTitle").html("Les Coachs");
    	else if(type=="organisateur")
    		$(".appTitle").html("Les organisateurs");
    	else if(type=="me")
    		$(".appTitle").html("Mon compte");
    	else
    		$(".appTitle").html("Les inscrits");
	}
	
}
var lockInterval = false;
function stopStatsInterval(){
	console.log("lockInterval ",lockInterval);
	if( !lockInterval )
		statPanelIndex(1);
}
initT['sweGraphInit'] = function(){
	
	<?php if($myproject){?>
	$("li.projet.<?php echo $myproject?>").addClass('me');
	<?php }?>
	filterType("statistics");
	//setInterval("stopStatsInterval()",5000);
	//appear after loading
	$(".appContent").slideDown();
	$('#appPanel').scrollbox();
	$('#mesInfos').click(function(){filterType('me')});
	//getCoachCount();
	//Code by: Kushagra Agarwal
	//http://cssdeck.com/item/602/html5-canvas-particles-web-matrix
	// RequestAnimFrame: a browser API for getting smooth animations
	window.requestAnimFrame = (function(){
	  return  window.requestAnimationFrame       || 
			  window.webkitRequestAnimationFrame || 
			  window.mozRequestAnimationFrame    || 
			  window.oRequestAnimationFrame      || 
			  window.msRequestAnimationFrame     ||  
			  function( callback ){
				window.setTimeout(callback, 1000 / 60);
			  };
	})();

	// Initializing the canvas
	// I am using native JS here, but you can use jQuery, 
	// Mootools or anything you want
	var canvas = document.getElementById("canvas");

	// Initialize the context of the canvas
	var ctx = canvas.getContext("2d");

	// Set the canvas width and height to occupy full window
	var W = window.innerWidth, H = window.innerHeight*5;
	canvas.width = W;
	canvas.height = H;

	// Some variables for later use
	var particleCount = 20,
		particles = [],
		minDist = 70,
		dist;

	// Function to paint the canvas black
	function paintCanvas() {
		// Set the fill color to black
		ctx.fillStyle = "rgba(51,153,225,1)";
		
		// This will create a rectangle of white color from the 
		// top left (0,0) to the bottom right corner (W,H)
		ctx.fillRect(0,0,W,H);
	}

	// Now the idea is to create some particles that will attract
	// each other when they come close. We will set a minimum
	// distance for it and also draw a line when they come
	// close to each other.

	// The attraction can be done by increasing their velocity as 
	// they reach closer to each other

	// Let's make a function that will act as a class for
	// our particles.

	function Particle() {
		// Position them randomly on the canvas
		// Math.random() generates a random value between 0
		// and 1 so we will need to multiply that with the
		// canvas width and height.
		this.x = Math.random() * W;
		this.y = Math.random() * H;
		
		
		// We would also need some velocity for the particles
		// so that they can move freely across the space
		this.vx = -1 + Math.random() * 2;
		this.vy = -1 + Math.random() * 2;

		// Now the radius of the particles. I want all of 
		// them to be equal in size so no Math.random() here..
		this.radius = 5;
		
		// This is the method that will draw the Particle on the
		// canvas. It is using the basic fillStyle, then we start
		// the path and after we use the `arc` function to 
		// draw our circle. The `arc` function accepts four
		// parameters in which first two depicts the position
		// of the center point of our arc as x and y coordinates.
		// The third value is for radius, then start angle, 
		// end angle and finally a boolean value which decides
		// whether the arc is to be drawn in counter clockwise or 
		// in a clockwise direction. False for clockwise.
		this.draw = function() {
			ctx.fillStyle = "#324553";
			ctx.beginPath();
			ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
			
			// Fill the color to the arc that we just created
			ctx.fill();
		}
	}

	// Time to push the particles into an array
	for(var i = 0; i < particleCount; i++) {
		particles.push(new Particle());
	}

	// Function to draw everything on the canvas that we'll use when 
	// animating the whole scene.
	function draw() {
		
		// Call the paintCanvas function here so that our canvas
		// will get re-painted in each next frame
		paintCanvas();
		
		// Call the function that will draw the balls using a loop
		for (var i = 0; i < particles.length; i++) {
			p = particles[i];
			p.draw();
		}
		
		//Finally call the update function
		update();
	}

	// Give every particle some life
	function update() {
		
		// In this function, we are first going to update every
		// particle's position according to their velocities
		for (var i = 0; i < particles.length; i++) {
			p = particles[i];
			
			// Change the velocities
			p.x += p.vx;
			p.y += p.vy
				
			// We don't want to make the particles leave the
			// area, so just change their position when they
			// touch the walls of the window
			if(p.x + p.radius > W) 
				p.x = p.radius;
			
			else if(p.x - p.radius < 0) {
				p.x = W - p.radius;
			}
			
			if(p.y + p.radius > H) 
				p.y = p.radius;
			
			else if(p.y - p.radius < 0) {
				p.y = H - p.radius;
			}
			
			// Now we need to make them attract each other
			// so first, we'll check the distance between
			// them and compare it to the minDist we have
			// already set
			
			// We will need another loop so that each
			// particle can be compared to every other particle
			// except itself
			for(var j = i + 1; j < particles.length; j++) {
				p2 = particles[j];
				distance(p, p2);
			}
		
		}
	}

	// Distance calculator between two particles
	function distance(p1, p2) {
		var dist,
			dx = p1.x - p2.x;
			dy = p1.y - p2.y;
		
		dist = Math.sqrt(dx*dx + dy*dy);
				
		// Draw the line when distance is smaller
		// then the minimum distance
		if(dist <= minDist) {
			
			// Draw the line
			ctx.beginPath();
			ctx.strokeStyle = "rgba(255,255,255,"+ (1.2-dist/minDist) +")";
			ctx.moveTo(p.x, p.y);
			ctx.lineTo(p2.x, p2.y);
			ctx.stroke();
			
			// Some acceleration for the partcles 
			// depending upon their distance
			var ax = dx/2000,
				ay = dy/2000;
			
			// Apply the acceleration on the particles
			p1.vx -= ax;
			p1.vy -= ay;
			
			p2.vx += ax;
			p2.vy += ay;
		}
	}

	// Start the main animation loop using requestAnimFrame
	function animloop() {
		draw();
		//requestAnimFrame(animloop);
	}

	animloop();

	$('#container14').highcharts({
        chart: {
            type: 'column',
            margin: [ 50, 50, 100, 80]
        },
        title: {
            text: '<?php echo count($projectMap,COUNT_RECURSIVE)-count($projectMap)?> Participants sont Resté sur <?php echo count($event["projects"])?> projets'
        },
        xAxis: {
            categories: [
                
    			<?php 
    			$ct=0;
    			foreach ($projectMap as $p=>$team) {
    			    if($ct>0)echo ",";    
    			    echo "'".strtoupper($p)."'";
    			    $ct++;
    			      } 
    			?>
            ],
            labels: {
                rotation: -45,
                align: 'right',
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Membres de Projets'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<b>{point.y:.1f} Personnes</b>',
        },
        series: [{
            name: 'Participants',
            data: [<?php $ct = 0; foreach ( $projectMap as $p=>$team ){
                        if($ct>0)echo ",";     
                        echo count($team);
                        $ct++;
                    }
                    ?>],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                x: 4,
                y: 10,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif',
                    textShadow: '0 0 3px black'
                }
            }
        }]
    });

	$('#container5').highcharts({
        chart: {
            type: 'column',
            margin: [ 50, 50, 100, 80]
        },
        title: {
            text: 'Distribution par Ville'
        },
        xAxis: {
            categories: [
                <?php $ct = 0; foreach ($cpMap as $cp=>$people){
                     if($ct>0)echo ",";       
                     if($cp == "Unknown")
                         echo "'Inconnue'";
                     else
                        echo "'".OpenData::$commune['974'][$cp]."'";
                    $ct++;
                }
                ?>
            ],
            labels: {
                rotation: -45,
                align: 'right',
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Membres de Projets'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<b>{point.y:.1f} Personnes</b>',
        },
        series: [{
            name: 'Participants',
            data: [<?php $ct = 0; foreach ( $cpMap as $cp=>$people ){
                        if($ct>0)echo ",";     
                        echo count( $people );
                        $ct++;
                    }
                    ?>],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                x: 4,
                y: 10,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif',
                    textShadow: '0 0 3px black'
                }
            }
        }]
    });

	$('#container4').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Compétence des participants par projet'
        },
        xAxis: {
            categories: [
        <?php 
		$ct=0;
		foreach ($teamTypeMap as $p=>$team) {
		    if($ct>0)echo ",";    
		    echo "'".strtoupper($p)."'";
		    $ct++;
		      } 
		?>
			]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Participant par Projet'
            }
        },
        legend: {
            backgroundColor: '#FFFFFF',
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
            series: [
                     
<?php 

$ct = 0; 
foreach ( SWE::$profession as $pro ){
    //if(!empty($pro)){
        if($ct>0)echo ",";
        echo '{"name":"'.$pro.'","data":[';
        $ctt =0;
        $vals = "";
        foreach ( $teamTypeMap as $p=>$teamTypes ){
            if($ctt>0)$vals .= ",";     
            $vals .= $teamTypes[$ct];
            $ctt++;
        }
        echo $vals."]}";
    //}
    $ct++;
}
?> 
             
             ]
    });
	
	$('#container2').highcharts({
	     chart: {
	         plotBackgroundColor: null,
	         plotBorderWidth: null,
	         plotShadow: false
	     },
	     title: {
	         text: 'N.E.W.S : Nord Est Ouest Sud '
	     },
	     tooltip: {
	 	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	     },
	     plotOptions: {
	         pie: {
	             allowPointSelect: true,
	             cursor: 'pointer',
	             dataLabels: {
	                 enabled: true,
	                 color: '#000000',
	                 connectorColor: '#000000',
	                 format: '<b>{point.name}</b>: {point.percentage:.1f} %'
	             }
	         }
	     },
	     series: [{
	         type: 'pie',
	         name: 'Cumulé',
	         data: [
	            <?php $ct = 0; 
	                $newsLabel = array("N"=>"Nord","E"=>"Est","O"=>"Ouest","S"=>"Sud");
	                foreach ( $newsMap as $t => $v )
	                {
	                    if($t){
	                        if($ct>0)echo ",";     
	                        $titre = ($t) ? $newsLabel[$t] : "Inconnue" ;
	                        echo "[\"".$titre."\",$v]";
	                        $ct++;
	                    }
	                }
	            ?>
	         ]
	     }]
	 });


 $('#container7').highcharts({
	 chart: {
         plotBackgroundColor: null,
         plotBorderWidth: 0,
         plotShadow: false
     },
     title: {
         text: "Pensez vous concrétiser votre projet ?",
         align: 'center',
         verticalAlign: 'middle',
         y: 120
     },
     tooltip: {
         pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
     },
     plotOptions: {
         pie: {
             dataLabels: {
                 enabled: true,
                 distance: -50,
                 style: {
                     fontWeight: 'bold',
                     color: 'white',
                     textShadow: '0px 1px 2px black'
                 }
             },
             startAngle: -90,
             endAngle: 90,
             center: ['50%', '75%']
         }
     },
     series: [{
         type: 'pie',
         name: 'Browser share',
         innerSize: '50%',
         data: [
<?php $ct = 0; 
foreach ( $concretisation as $t => $v )
{
    if($t){
        if($ct>0)echo ",";     
        $titre = ($t) ? SWE::$concretisation[$t] : "Inconnue" ;
        echo "[\"".$titre."\",$v]";
        $ct++;
    }
}
?>
         ]
     }]
	    
	});

 $('#container3').highcharts({
 	chart: {
         plotBackgroundColor: null,
         plotBorderWidth: 0,
         plotShadow: false
     },
     title: {
         text: "Quels points sont à améliorer selon vous ?",
         align: 'center',
         verticalAlign: 'middle',
         y: 120
     },
     tooltip: {
         pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
     },
     plotOptions: {
         pie: {
             dataLabels: {
                 enabled: true,
                 distance: -50,
                 style: {
                     fontWeight: 'bold',
                     color: 'white',
                     textShadow: '0px 1px 2px black'
                 }
             },
             startAngle: -90,
             endAngle: 90,
             center: ['50%', '75%']
         }
     },
     series: [{
         type: 'pie',
         name: 'Browser share',
         innerSize: '50%',
         data: [
<?php $ct = 0; 
foreach ( $amerlioration as $t => $v )
{
    if($t){
        if($ct>0)echo ",";     
        $titre = ($t) ? SWE::$amerlioration[$t] : "Inconnue" ;
        echo "[\"".$titre."\",$v]";
        $ct++;
    }
}
?>
         ]
     }]
 });
 $('#container16').highcharts({
	 chart: {
         plotBackgroundColor: null,
         plotBorderWidth: 0,
         plotShadow: false
     },
     title: {
         text: "Vos attentes ont-elles était comblées ?",
         align: 'center',
         verticalAlign: 'middle',
         y: 120
     },
     tooltip: {
         pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
     },
     plotOptions: {
         pie: {
             dataLabels: {
                 enabled: true,
                 distance: -50,
                 style: {
                     fontWeight: 'bold',
                     color: 'white',
                     textShadow: '0px 1px 2px black'
                 }
             },
             startAngle: -90,
             endAngle: 90,
             center: ['50%', '75%']
         }
     },
     series: [{
         type: 'pie',
         name: 'Browser share',
         innerSize: '50%',
         data: [
<?php $ct = 0; 
foreach ( $objectifsAtteint as $t => $v )
{
    if($t){
        if($ct>0)echo ",";     
        $titre = ($t) ? SWE::$objectifsAtteint[$t] : "Inconnue" ;
        echo "[\"".$titre."\",$v]";
        $ct++;
    }
}
?>
         ]
     }]
	    
	});
 $('#container17').highcharts({
	 chart: {
         plotBackgroundColor: null,
         plotBorderWidth: 0,
         plotShadow: false
     },
     title: {
         text: "Recommanderiez vous le StartUpWeekEnd à des proches ?",
         align: 'center',
         verticalAlign: 'middle',
         y: 120
     },
     tooltip: {
         pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
     },
     plotOptions: {
         pie: {
             dataLabels: {
                 enabled: true,
                 distance: -50,
                 style: {
                     fontWeight: 'bold',
                     color: 'white',
                     textShadow: '0px 1px 2px black'
                 }
             },
             startAngle: -90,
             endAngle: 90,
             center: ['50%', '75%']
         }
     },
     series: [{
         type: 'pie',
         name: 'Browser share',
         innerSize: '50%',
         data: [
			["Oui",90],
			["Non",10]
         ]
     }]
	    
	});


 $('#container8').highcharts({
     chart: {
         plotBackgroundColor: null,
         plotBorderWidth: null,
         plotShadow: false
     },
     title: {
         text: 'Les Objectifs des participants'
     },
     tooltip: {
 	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
     },
     plotOptions: {
         pie: {
             allowPointSelect: true,
             cursor: 'pointer',
             dataLabels: {
                 enabled: true,
                 color: '#000000',
                 connectorColor: '#000000',
                 format: '<b>{point.name}</b>: {point.percentage:.1f} %'
             }
         }
     },
     series: [{
         type: 'pie',
         name: 'Cumulé',
         data: [
            <?php $ct = 0; 
                foreach ( $objectifMap as $t => $v )
                {
                    if($t){
                        if($ct>0)echo ",";     
                        $titre = ($t) ? SWE::$objectif[$t] : "Inconnue" ;
                        echo "[\"".$titre."\",$v]";
                        $ct++;
                    }
                }
            ?>
         ]
     }]
 });
 
 $('#container9').highcharts({
     chart: {
         plotBackgroundColor: null,
         plotBorderWidth: null,
         plotShadow: false
     },
     title: {
         text: 'Expertise des participants'
     },
     tooltip: {
 	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
     },
     plotOptions: {
         pie: {
             allowPointSelect: true,
             cursor: 'pointer',
             dataLabels: {
                 enabled: true,
                 color: '#000000',
                 connectorColor: '#000000',
                 format: '<b>{point.name}</b>: {point.percentage:.1f} %'
             }
         }
     },
     series: [{
         type: 'pie',
         name: 'Cumulé',
         data: [
            <?php $ct = 0; 
                foreach ( $expertiseMap as $t => $v )
                {
                    if($t){
                        if($ct>0)echo ",";     
                        $titre = ($t) ? SWE::$expertise[$t] : "Inconnue" ;
                        echo "[\"".$titre."\",$v]";
                        $ct++;
                    }
                }
            ?>
         ]
     }]
 });
 
 $('#container10').highcharts({
     chart: {
         plotBackgroundColor: null,
         //backgroundColor: '#FCFFC5',
         plotBorderWidth: null,
         plotShadow: false
     },
     
     title: {
         text: 'Répartition des <?php echo $etudiantCount?> étudiants '
     },
     tooltip: {
 	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
     },
     plotOptions: {
         pie: {
             allowPointSelect: true,
             cursor: 'pointer',
             dataLabels: {
                 enabled: true,
                 color: '#000000',
                 connectorColor: '#000000',
                 format: '<b>{point.name}</b>: {point.percentage:.1f} %'
             }
         }
     },
     series: [{
         type: 'pie',
         name: 'Cumulé',
         data: [
            <?php $ct = 0; 
                foreach ( $formationMap as $t => $v )
                {
                    if($t){
                        if($ct>0)echo ",";     
                        $titre = ($t) ? SWE::$formation[$t] : "Inconnue" ;
                        echo "[\"".$titre."\",$v]";
                        $ct++;
                    }
                }
            ?>
         ]
     }]
 });
 
 $('#container11').highcharts({
     chart: {
         plotBackgroundColor: null,
         plotBorderWidth: null,
         plotShadow: false
     },
     title: {
         text: 'Professions des participants'
     },
     tooltip: {
 	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
     },
     plotOptions: {
         pie: {
             allowPointSelect: true,
             cursor: 'pointer',
             dataLabels: {
                 enabled: true,
                 color: '#000000',
                 connectorColor: '#000000',
                 format: '<b>{point.name}</b>: {point.percentage:.1f} %'
             }
         }
     },
     series: [{
         type: 'pie',
         name: 'Cumulé',
         data: [
            <?php $ct = 0; 
                foreach ( $professionMap as $t => $v )
                {
                    if($t){
                        if($ct>0)echo ",";     
                        $titre = ($t) ? SWE::$profession[$t] : "Inconnue" ;
                        echo "[\"".$titre."\",$v]";
                        $ct++;
                    }
                }
            ?>
         ]
     }]
 });
 
 $('#container12').highcharts({
     chart: {
         plotBackgroundColor: null,
         plotBorderWidth: null,
         plotShadow: false
     },
     title: {
         text: 'Comment ils ont Decouvert le SWE'
     },
     tooltip: {
 	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
     },
     plotOptions: {
         pie: {
             allowPointSelect: true,
             cursor: 'pointer',
             dataLabels: {
                 enabled: true,
                 color: '#000000',
                 connectorColor: '#000000',
                 format: '<b>{point.name}</b>: {point.percentage:.1f} %'
             }
         }
     },
     series: [{
         type: 'pie',
         name: 'Cumulé',
         data: [
            <?php $ct = 0; 
                foreach ( $commentConnuSWEMap as $t => $v )
                {
                    if($ct>0)echo ",";     
                    $titre = ($t) ? SWE::$commentConnuSWE[$t] : "Inconnue" ;
                    echo "[\"".$titre."\",$v]";
                    $ct++;
                }
            ?>
         ]
     }]
 });
 

	
};

</script>	

