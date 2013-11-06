<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.touch-punch.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.shapeshift.min.js' , CClientScript::POS_END);
?>
<style>
h2,h3 {
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
  height: 150px;
  width: 100px;
  color:#555;
  border:1px solid #666;
  text-align:center;
  padding:5px;
}

.grid > div[data-ss-colspan="2"] { width: 210px; }
.grid > div[data-ss-colspan="3"] { width: 320px; }

.grid > .ss-placeholder-child {
  background: transparent;
  border: 1px dashed blue;
}	
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
        <h2> Preuve de concept : Dataconnexion</h2>
        <p> 
        <br/>C'est Enocre tout frais et tout chaud quelques jours ne suffisent pas pour aller assez loin dans le POC
        <br/>Un des objectifs du PIxel Humain est de permettre un couplage entre opendata de divers source
        notament du crowd sourcing actif avec les 4 familles d'acteur représenté par le PH (citoyen, association, entreprise,collectivité).
        <br/>On decouvre avec ce projet que les données globalement ouverte concernant les communes sont assez limités, difficile à obtenir et personnes ne veut prendre le risque de le transmettre. 
        <br/>Un des objectifs du Pixel Humain est de motiver et outiller les communes à partager certaines données de bases de facon standardisé.
        <br/>C'est un squelette applicatif pour valoriser l'activté locale pour nos 4 familles.
        <br/>Fonctionnement d'une mairie, communcation bilaterale citoyen &lt;&gt; collectivité
        <br/>Contact par secteur en mairie (poste, nom, tel, email),
        <br/>Système de discussion démocratique,
    	<br/>Nous aimerions proposer un outil de classification et de recherche des opendatas ultra locales et travailler de facon privillégié avec data.gouv.fr
    	
       
    
        </p>
     	<h3>Quelques POC</h3>
     	 Pour la demo concours voici quelques données réutilisé dans le PH 
     	<div class="grid">
     		<div data-ss-colspan="2">Démo Commune<br/><a target="_blank" href="<?php echo Yii::app()->createUrl('index.php/commune/view/cp/97400')?>" >97400</a> <a  target="_blank" href="<?php echo Yii::app()->createUrl('index.php/commune/view/cp/97480')?>" >97480</a> </div>
            <div  data-ss-colspan="2"><a  target="_blank" href="<?php echo Yii::app()->createUrl('index.php/commune')?>">Distribution des Communectés</a>Inscrit connecté par departement</div>
            <div data-ss-colspan="2"><a target="_blank" href="<?php echo Yii::app()->createUrl('index.php/opendata/commune/ci/97411')?>" ><i class="entypo-plus"></i> Modèle Open Data Locales</a> une commune </div>
            <div data-ss-colspan="2"><a href="#loginForm"   target="_blank" role="button" data-toggle="modal"><i class="entypo-plus"></i> Inscrivez Vous</a> on vous tiendra informé </div>
       </div>
       
       <h3>Plus d'infos</h3>
       <ul>
       	<li><a target="_blank" href="http://www.pixelhumain.com/tmp/pptComplet.pdf">Présentation Power Point ( 23 Slides )</a></li>
       	<li><a target="_blank" href="http://www.pixelhumain.com/tmp/PRESENTATION_PH_02092013_BD.pdf">Présentation Détaillé ( 20 pages )</a></li>
       </ul>
   		
   
	</div>
</div>



<script type="text/javascript"		>
initT['animInit'] = function(){
	$(".grid").shapeshift({
	    minColumns: 3
	  });
        (function ani(){
        	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
        })();
};
</script>			