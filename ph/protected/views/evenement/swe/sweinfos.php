<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.scrollbox.js' , CClientScript::POS_END);
?>
<style>
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
.appContent h3,.appContent h2{margin-left:0px;font-family: "Homestead";color: #324553;}
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

.control-group{margin-bottom:5px;float:left;min-width:450px;width:45%;}
.control-label{width:250px;}
.controls {margin-left:260px;}
.form-horizontal .control-group {   margin-bottom:5px;}
</style>

<div class="container appContent">

	<h1><?php echo $event["name"]?> </h1>
    	

    <div class="hero-unit">
    	<h2>Fiche D'inscription</h2>
    	<h3> Merci de compléter vos données. </h3>
        <form id="sweInscriptionForm" class="form-horizontal" enctype="multipart/form-data">
            <?php $me = Yii::app()->mongodb->startupweekend->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"])));?>
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="NOM">Votre Prénom Nom</label>
              <div class="controls">
                <input id="name" name="name" type="text" value="<?php echo $me["name"]?>" class="input-medium" required="">
              </div>
            </div>
            
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="EMAIL">Votre email</label>
              <div class="controls">
                <?php echo $me["email"]?><input id="email" name="email" type="hidden" value="<?php echo $me["email"]?>" class="input-large" required="">
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label" for="NOM"><img width=50 class="citizenThumb" src="<?php echo ( $me && isset($me['image']) ) ? Yii::app()->createUrl('upload/swe/'.$me['image']) : Yii::app()->createUrl('images/PHOTO_ANONYMOUS.png'); ?>"/></label>
              <div class="controls">
                <?php
                    $this->widget('yiiwheels.widgets.fineuploader.WhFineUploader', array(
                            'name'          => 'imageFile',
                            'uploadAction'  => $this->createUrl('index.php/templates/upload/dir/swe/input/imageFile', array('fine' => 1)),
                            'pluginOptions' => array(
                                'validation'=>array(
                                    'allowedExtensions' => array('jpg','jpeg','png','gif'),
                                    'itemLimit'=>1
                                )
                            ),
                            'events' => array(
                                'complete'=>"function( id,  name,  responseJSON,  xhr){
                                	console.log('".Yii::app()->createUrl('upload/swe/')."/'+xhr.name+'?d='+ new Date().getTime());
                                	$('#image').val(xhr.name);
                                	$('img.citizenThumb').attr('src','".Yii::app()->createUrl('upload/swe/')."/'+xhr.name+'?d='+ new Date().getTime());
                                	
                                }"
                            ),
                        ));
                    ?>
                    <input type="hidden" id="image" name="image" value="<?php if(isset($me["image"]))echo $me["image"]?>"/>
              </div>
            </div>
            
            <!-- Select Basic -->
            <div class="control-group">
              <label class="control-label" for="commentConnuSWE">Comment avez-vous connu le Startupweekend ?</label>
              <div class="controls">
                <?php 
                $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => array(
                                              "",
                                              "Présentation des organisateurs",
                                              "Internet",
                                              "Facebook ou Twitter",
                                              "Presse",
                                              "Autre média (radio, TV)",
                                              "Newsletter ou mailing",
                                              "Pôle Emploi",
                                              "Ancien participant"
                                            ),
                            'name' => 'commentConnuSWE',
                          	'id' => 'commentConnuSWE',
                            'value'=> (isset($me["commentConnuSWE"])) ? $me["commentConnuSWE"] : "",
                            'pluginOptions' => array(
                                'width' => '250px',
                            )));
                ?>
                
                
              </div>
            </div>
            
            <!-- Select Basic -->
            <div class="control-group">
              <label class="control-label" for="profession">Vous êtes ?</label>
              <div class="controls">
              	<?php 
                $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => array(
                                              "","salarié",
                                              "demandeur d'emploi",
                                              "étudiant",
                                              "chef d'entreprise",
                                              "travailleur indépendant",
                                              "expert / spécialiste"
                                            ),
                            'name' => 'profession',
                          	'id' => 'profession',
                            'value'=> (isset($me["profession"])) ? $me["profession"] : "",
                            'pluginOptions' => array(
                                
                                'placeholder' => "Profession",
                                'width' => '250px',
                                'tokenSeparators' => array(',', ' ')
                            )));
                ?>
              </div>
            </div>
            
            <!-- Select Basic -->
            <div class="control-group">
              <label class="control-label" for="formation">Si vous êtes étudiant, quelle est votre formation actuelle :</label>
              <div class="controls">
              <?php 
                $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => array(
                                            "","ILOI",
                                              "ESIROI",
                                              "IUT",
                                              "BTS",
                                              "IAE",
                                              "EGC",
                                              "Beaux Arts"
                                            ),
                            'name' => 'formation',
                          	'id' => 'formation',
                            'value'=> (isset($me["formation"])) ? $me["formation"] : "",
                            'pluginOptions' => array(
                                
                                'placeholder' => "",
                                'width' => '250px',
                                'tokenSeparators' => array(',', ' ')
                            )));
                ?>
                
              </div>
            </div>
            
            <!-- Select Basic -->
            <div class="control-group">
              <label class="control-label" for="expertise">Si vous n'êtes pas étudiant, quelle est votre 'spécialité' :</label>
              <div class="controls">
              <?php 
                $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => array(
                                            "","Entrepreneur",
                                              "Gestion / comptabilité",
                                              "Commerce",
                                              "Marketing / Communication",
                                              "Design / graphisme",
                                              "Développeur informatique",
                                              "Expert / ingénieur",
                                              "Informaticien / ingénieur"
                                            ),
                            'name' => 'expertise',
                          	'id' => 'expertise',
                            'value'=> (isset($me["expertise"])) ? $me["expertise"] : "",
                            'pluginOptions' => array(
                                
                                'placeholder' => "",
                                'width' => '250px',
                                'tokenSeparators' => array(',', ' ')
                            )));
                ?>
                
              </div>
            </div>
            
            
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="age">Quel est votre âge ?</label>
              <div class="controls">
                <input id="age" name="age" type="text" value="<?php if(isset($me["age"]))echo $me["age"]?>" class="input-medium">
                
              </div>
            </div>
            
            <!-- Select Basic -->
            <div class="control-group">
              <label class="control-label" for="codepostal">De quelle région venez-vous ?</label>
              <div class="controls">
              <?php 
                $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => array(
                                            ""=>"",'97400'=> 'ST DENIS',
                                            '97410'=> 'ST PIERRE',
                                            '97411'=> 'BOIS DE NEFLES ST PAUL',
                                            '97412'=> 'BRAS PANON',
                                            '97413'=> 'CILAOS',
                                            '97414'=> 'ENTRE DEUX',
                                            '97416'=> 'LA CHALOUPE',
                                            '97417'=> 'LA MONTAGNE',
                                            '97418'=> 'LA PLAINE DES CAFRES',
                                            '97419'=> 'LA POSSESSION',
                                            '97420'=> 'LE PORT',
                                            '97421'=> 'LA RIVIERE',
                                            '97422'=> 'LA SALINE',
                                            '97423'=> 'LE GUILLAUME',
                                            '97424'=> 'LE PITON ST LEU',
                                            '97425'=> 'LES AVIRONS',
                                            '97426'=> 'LES TROIS BASSINS',
                                            '97427'=> 'L ETANG SALE',
                                            '97429'=> 'PETITE ILE',
                                            '97430'=> 'LE TAMPON',
                                            '97431'=> 'LA PLAINE DES PALMISTES',
                                            '97432'=> 'RAVINE DES CABRIS',
                                            '97433'=> 'SALAZIE',
                                            '97434'=> 'LES TROIS BASSINS',
                                            '97434'=> 'ST GILLES LES BAINS' ,
                                            '97435'=> 'ST GILLES LES HAUTS',
                                            '97436'=> 'ST LEU',
                                            '97437'=> 'STE ANNE',
                                            '97438'=> 'STE MARIE',
                                            '97439'=> 'STE ROSE',
                                            '97440'=> 'ST ANDRE',
                                            '97441'=> 'STE SUZANNE',
                                            '97442'=> 'ST PHILIPPE',
                                            '97450'=> 'ST LOUIS',
                                            '97460'=> 'ST PAUL',
                                            '97470'=> 'ST BENOIT',
                                            '97480'=> 'ST JOSEPH',
                                            '97490'=> 'STE CLOTILDE'
                                            ),
                            'name' => 'codepostal',
                          	'id' => 'codepostal',
                            'value'=> (isset($me["codepostal"])) ? $me["codepostal"] : "",
                            'pluginOptions' => array(
                                
                                'placeholder' => "",
                                'width' => '250px',
                                'tokenSeparators' => array(',', ' ')
                            )));
                ?>
               
              </div>
            </div>
            
            <!-- Select Multiple -->
            <div class="control-group">
              <label class="control-label" for="objectif">Avez vous des objectifs particuliers en venant au Startupweekend ?</label>
              <div class="controls">
              <?php 
                $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => array(
                                              "","Présenter votre idée nouvelle",
                                              "Présenter votre idée pour l'améliorer",
                                              "Présenter votre idée pour la faire évaluer",
                                              "Trouver une idée pour m'associer à un projet",
                                              "faire avancer mon projet",
                                              "trouver des associés / partenaires",
                                              "rencontrer des nouvelles personnes",
                                              "satisfaire votre curiosité",
                                              "vous former (en accéléré) à la création d'entreprise",
                                              "recevoir des conseils d'experts",
                                              "répondre à un 'besoin' précis",
                                              "le challenge, le 'fun'",
                                            ),
                            'name' => 'objectif',
                          	'id' => 'objectif',
                            'value'=> (isset($me["objectif"])) ? $me["objectif"] : "",
                            'pluginOptions' => array(
                                
                                'placeholder' => "",
                                'width' => '250px',
                                'tokenSeparators' => array(',', ' ')
                            )));
                ?>
                
              </div>
            </div>
            <div class="clear"></div>
        </form>
		<div class="modal-footer pull-left">
            <button class="btn btn-primary" id="submitsweInscriptionForm" onclick="$('#sweInscriptionForm').submit();">Enregistrer</button>
          </div>
    </div>
</div>

<?php $this->renderPartial('application.views.evenement.swe.sweSponsor');?>

<canvas id="canvas"></canvas>

<script type="text/javascript">
function filterType(type){
	$(".appContent ul.people li").slideUp();
	$(".appContent ul.people li."+type).slideDown();
	if(type=="projet")
		$(".appTitle").html("Les projets");
	else if(type=="projet")
		$(".appTitle").html("Les projets");
	else if(type=="jury")
		$(".appTitle").html("Le jury");
	else if(type=="coach")
		$(".appTitle").html("Les Coachs");
	else if(type=="organisateur")
		$(".appTitle").html("Les organisateurs");
	else
		$(".appTitle").html("Les inscrits");
	
}
initT['sweGraphInit'] = function(){

	$('input[type=file]').change(function (e) {
	    $('#customfileupload').html($(this).val());
	});
    $("#sweInscriptionForm").submit( function(event){
    	if($('.error').length){
    		alert('Veuillez remplir les champs obligatoires.');
    	}else{
        	event.preventDefault();
        	$("#sweInscription").modal('hide');
        	NProgress.start();
        	$.ajax({
        	  type: "POST",
        	  url: baseUrl+"/index.php/evenement/sweInfos",
        	  data: $("#sweInscriptionForm").serialize(),
        	  success: function(data){
        			  $("#flashInfo .modal-body").html(data.msg);
        			  $("#flashInfo").modal('show');
        			  NProgress.done();
        	  },
        	  dataType: "json"
        	});
    	}
    });
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
	var W = window.innerWidth, H = window.innerHeight;
	canvas.width = W;
	canvas.height = H;

	// Some variables for later use
	var particleCount = 200,
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
		requestAnimFrame(animloop);
	}

	animloop();
};

</script>	

