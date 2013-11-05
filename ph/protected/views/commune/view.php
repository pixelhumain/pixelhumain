<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.touch-punch.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.shapeshift.min.js' , CClientScript::POS_END);

$cs->registerCssFile(Yii::app()->request->baseUrl. '/js/morris.js-0.4.3/morris.css');
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/morris.js-0.4.3/morris.min.js' , CClientScript::POS_END);
$cs->registerScriptFile( 'http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js' , CClientScript::POS_END);

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
  height: 50px;
  width: 100px;
  padding:5px;
}

.grid > div[data-ss-colspan="2"] { width: 210px; }
.grid > div[data-ss-colspan="3"] { width: 320px; }

.grid > .ss-placeholder-child {
  background: transparent;
  border: 1px dashed blue;
}	
.graph div.block{border:1px solid #666;text-align:center; padding:5px;}
#myfirstchart svg{z-index: 1000;}
.actu ul{text-align:left;font-size:small}
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2> Commune <?php echo OpenData::$commune["974"][$cp]." ( ".$cp.", ".$communcted." communectés ) "?></h2>
    <p> Commencons par définir un format standard et ouvert(opendata) decrivant une commune.
    <br/>Pour faciliter la tache pour toutes les communes interressées par l'initiative.
    <br/>Il est important de *communecter un maximum de citoyen.
    <br/>*se communecter : Un citoyen connecté à sa commune grace a son code postal. 
    </p>
 	<div class="grid">
        <div data-ss-colspan="2"><a href="<?php echo Yii::app()->createUrl('index.php/commune/annuaireElus/ci/'.OpenData::$codePostalToCodeInsee["974"][$cp])?>"  > Annuaire des élus </a></div>
        <div data-ss-colspan="3"><a href="<?php echo Yii::app()->createUrl('index.php/commune/servicesMunicipaux/ci/'.OpenData::$codePostalToCodeInsee["974"][$cp])?>">Services Municipaux</a></div>
        <div data-ss-colspan="3"><a href="<?php echo Yii::app()->createUrl('index.php/opendata/commune/ci/'.OpenData::$codePostalToCodeInsee["974"][$cp])?>">Open Data Commune</a> </div>
        
        <div data-ss-colspan="2"><a href="<?php echo Yii::app()->createUrl('index.php/templates?name=nodesLabels&cp='.$cp)?>"   target="_blank" role="button" data-toggle="modal">Connected</a></div>
        <div data-ss-colspan="2"><a href="#"   target="_blank" role="button" data-toggle="modal">Quartiers, Agglo</a></div>
        <div data-ss-colspan="2"><a href="#"   target="_blank" role="button" data-toggle="modal">Budget</a></div>
        <div></div>
        <div></div>
        <div></div>
   </div>
</div></div>

<div class="container graph">
<div class="hero-unit">
	<div class="row-fluid">
		<div class="span4 block">
			<h2>Évolution population</h2>
			<script>var population = [];
			<?php 
			$cpdb = Yii::app()->mongodb->codespostaux->findOne(array("codeinsee"=>OpenData::$codePostalToCodeInsee[$dep][$cp],"type"=>"commune"));
			foreach($cpdb["demographie"] as $an=>$pop)
			    echo "population.unshift({y:'$an',a:$pop,b:10000});";
			?>
			    </script>
			<div id="myfirstchart" style="height: 250px;"></div>
		</div>
		<div class=" actu span4 block">
			<h2>Informations / Activité</h2>
			
			<?php
			 $rss = Yii::app()->mongodb->data->find(array("cp"=>$cp,"type"=>"rss"));
			if( Yii::app()->mongodb->data->count(array("cp"=>$cp,"type"=>"rss")) ){
			    foreach($rss as $r){
        			echo $r["title"]."<br/>";
			        $content = file_get_contents($r['url']);  
                    $x = new SimpleXmlElement($content);  
                    echo "<ul>";  
                    foreach($x->channel->item as $entry) {  
                        echo "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a></li>";  
                    }  
                    echo "</ul>";
			    }
			}  else
			    echo "il n'y a pas de RSS Locale pour ce code postal <br/> <a class='btn btn-primary' href=\"javascript('bientot')\">Ajoutez en un</a>"
			?>
			
		</div>
		<div class="span4 block">
			<h2>Associations </h2>
			<?php 
			$assos = Yii::app()->mongodb->group->find(array("cp"=>$cp,"type"=>"association"));
			foreach($assos as $a)
			    echo $a["name"]."<br/>";?>
			<small>Annuaire  des Associations locales.
			<br/>Aucune données opendata organisé n'existe à l'heure actuelle<br/> <a class='btn btn-primary' href=\"javascript('bientot')\">Ajoutez votre Association</a>.
			</small>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span8 block">
		<h2>Photographies / Vidéos</h2>
		<div id="myCarousel" class="carousel slide">
            
              <div class="space20px;"></div>
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>
              <!-- Carousel nav -->
              <div class="carousel-controls">
                  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
              </div>
              <!-- Carousel items -->
              <div class="carousel-inner" style="width:85%;margin-left:60px">
              	
              	<?php 
              	function get_url_contents($url) {
                    $crl = curl_init();
                
                    curl_setopt($crl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
                    curl_setopt($crl, CURLOPT_URL, $url);
                    curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 5);
                
                    $ret = curl_exec($crl);
                    curl_close($crl);
                    return $ret;
                }
                $q = urlencode(OpenData::$commune["974"][$cp]." réunion");
                $json = get_url_contents('http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q='.$q);
                
                $data = json_decode($json);
                
                if(isset($data->responseData->results)){
                    foreach ($data->responseData->results as $result) {
                        $results[] = array('url' => $result->url, 'alt' => $result->title);
                        
                    }
                    $ct = "active";
                    foreach($results as $r){
                        
                        echo '<div class="'.$ct.' item p40" >';
                        echo "<img width=500 src='".$r["url"]."'/>";
                        
                        echo '<div class="clear"></div></div>';
                        $ct = "";
                    }
                }
              	?>
              	
              		<br/> <a class='btn btn-primary' href=\"javascript('bientot')\">Ajoutez une photo Locale</a>
               </div> 
              
    		<div class="clear"></div>
        </div>
        
		</div>
		<div class="span4 block">
		<h2>Entreprises </h2>
		<?php 
			$assos = Yii::app()->mongodb->group->find(array("cp"=>$cp,"type"=>"entreprise"));
			foreach($assos as $a)
			    echo $a["name"]."<br/>";?>
			<small>Annuaire Entreprise locales.
			<br/>Aucune données opendata organisé n'existe à l'heure actuelle.
			<br/> <a class='btn btn-primary' href=\"javascript('bientot')\">Ajoutez votre Entreprise</a>
			</small>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span4  block">
		<h2>Agenda</h2>
		<small>flux Daté de divers source locale.
			<br/>Aucune données opendata organisé n'existe à l'heure actuelle.
			<br/> <a class='btn btn-primary' href=\"javascript('bientot')\">Ajoutez un Evenement</a>
		</small>
		</div>
		<div class="span4 block">
		<h2>Découvrez</h2>
		<small>Ceux qui connaissent le mieux leur region sont les habitants locaux.
			<br/>Aucune données opendata organisé n'existe à l'heure actuelle.
			<br/> <a class='btn btn-primary' href=\"javascript('bientot')\">Ajoutez une Lieu</a>
		</small>
		</div>
		<div class="span4 block">
		<h2>Participez</h2>
		<small>La Participation citoyenne, rend la commune plus interactive, donc plus riche.
		<br/>Discussion et Proposition de projet locaux
		</small>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span6 block">
		<h2>Interrogez</h2>
		<small>Il existera un jour un lien direct entre citoyen organisé et collectivité.</small>
		</div>
		<div class="span6 block ">
		<h2>Rézoté</h2>
		<small>Des outils pour mieux collaborer, s'organiser et avancer.</small>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span4 block">
		<h2>Petites Annonces Locales</h2>
		<small>Le Recyclage, donner une deuxième vie au objet de la consommation </small>
		<br/> <a class='btn btn-primary' href=\"javascript('bientot')\">Mon Annonce</a>
		</div>
		<div class="span4 block">
		<h2>Covoiturez</h2>
		<small>Les départs organisés d'une meme commune peuvent fortement diminuer le traffic de voiture.</small>
		<br/> <a class='btn btn-primary' href=\"javascript('bientot')\">Nouveau Trajet</a>
		</div>
		<div class="span4 block">
		<h2>Rencontrez</h2>
		<small>Tout thématisé, facilite les rencontres et les echanges</small>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span6 block">
		<h2>Aide Participative</h2>
		<small>Inicidant, Perte, Déménagement, </small>
		</div>
		<div class="span6 block">
		<h2>--------------</h2>
		</div>
	</div>
	
</div></div>

<script type="text/javascript"		>
initT['animInit'] = function(){
	Morris.Bar({
		  element: 'myfirstchart',
		  data: population,
		  xkey: 'y',
		  ykeys: ['a', 'b'],
		  labels: ['Series A', 'Series B']
		});
	$(".grid").shapeshift({
	    minColumns: 3
	  });
        (function ani(){
        	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
        })();
};
</script>			