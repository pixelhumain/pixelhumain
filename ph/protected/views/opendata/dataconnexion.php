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
  height: 150px;
  width: 100px;
  color:#555;
}

.grid > div[data-ss-colspan="2"] { width: 210px; }
.grid > div[data-ss-colspan="3"] { width: 320px; }

.grid > .ss-placeholder-child {
  background: transparent;
  border: 1px dashed blue;
}	
.graph div{border:1px solid #666;text-align:center}
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2> Preuve de concept : Dataconnexion</h2>
    <p> Nous avons voulu ici regrouper quelques interprétations
    <br/>et exemple de visualisations des données disponible sur Data.gouv.fr, Insee, etc
    
    <br/>Un des objectifs du PIxel Humain est de permettre un couplage entre opendata de divers autre source
    notament du crowd sourcing actif avec les 4 familles d'acteur représenté par le PH (citoyen, association, entreprise,collectivité).
    <br/>On decouvre avec ce projet que les données globalement ouverte concernant les communes sont assez limités. 
    <br/>Un des objectifs du Pixel Humain est de motiver et outiller les communes à partager certaines données de bases de facon standardisé.
    <br/>C'est un squelette applicatif pour valoriser l'activté locale pour les 4 familles représenté.
    <br/>Hiérarchie de la mairie,
    <br/>Contact par secteur en mairie (poste, nom, tel, email),
    <br/>Structure et découpage de la Commune,
	<br/>Proposer un outil de classification et de recherche des opendatas ultra locale et travailler de facon privillégié avec data.gouv.fr
	
    <br/>Pour la demo concours voici quelques données réutilisé dans le PH 
    <ul>
    <li><a href="http://www.data.gouv.fr/DataSet/550652" target="_blank">ASSOCIATIONS RECONNUES D'UTILITÉ PUBLIQUE </a></li>
    <li><a href="http://www.data.gouv.fr/DataSet/550653?xtmc=association&xtcr=1" target="_blank">FONDATIONS RECONNUES D'UTILITÉ PUBLIQUE  </a></li>
    </ul>
    </p>
 	<div class="grid">
        <div></div>
        <div  data-ss-colspan="2">
        <a href="<?php echo Yii::app()->createUrl('index.php/commune')?>">Distribution des Communectés</a>
        Inscrit connecté par departement
        </div>
        <div data-ss-colspan="2"><a href="<?php echo Yii::app()->createUrl('index.php/opendata/commune/ci/97411')?>" ><i class="icon-plus"></i> Open Data Locales</a></div>
        <div data-ss-colspan="2"><a href="<?php echo Yii::app()->createUrl('index.php/commune/view/cp/97400')?>" ><i class="icon-plus"></i> Démo Commune</a> 97400</div>
        <div data-ss-colspan="2"><a href="#"   target="_blank" role="button" data-toggle="modal"><i class="icon-plus"></i> Bureau</a></div>
        <div data-ss-colspan="3"><a href="#"   target="_blank" role="button" data-toggle="modal">Statistic </a></div>
        <div></div>
        <div data-ss-colspan="3"><a href="#"   target="_blank" role="button" data-toggle="modal">Évènement </a></div>
        <div></div>
        <div></div>
        <div></div>
        <div data-ss-colspan="2"><a href="#loginForm"   target="_blank" role="button" data-toggle="modal"><i class="icon-plus"></i> Inscrivez Vous</a></div>
   </div>
</div></div>


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