<style>

/* ********************* */
/* Menu Fixe LEft */
/* ********************* */


.side-panel {
  padding: 30px 0;
  position:fixed;
  top:80px;
  left:0px;
  z-index:1000;
}
.side-panel:nth-child(2n) {
  /*background: #2d3e4a;*/
}
.side-panel ul {
  margin: 0;
  padding: 0;
  list-style: none;
  font-family:"Homestead";
}
.side-panel > ul > li:first-child {
  border-top-right-radius: 3px;
}
.side-panel > ul > li:first-child a {
  padding-top: 13px;
}
.side-panel > ul > li:last-child {
  border-bottom-right-radius: 3px;
}
.side-panel > ul > li:last-child a {
  padding-bottom: 13px;
}
.side-panel > ul ul {
  width: 150px;
  padding-left: 10px;
  display: none;
  position: absolute;
  top: 0;
  left: 100%;
}
.side-panel > ul ul li:first-child {
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
  border-right-color: #efefef;
}
.side-panel > ul ul li:first-child:before {
  position: absolute;
  content: "";
  width: 0;
  height: 0;
  top: 50%;
  right: 100%;
  margin-top: -5px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent;
  border-right: 5px solid #efefef;
  border-right-color: inherit;
}
.side-panel > ul ul li:first-child:hover {
  border-right-color: #fff;
}
.side-panel > ul ul li:last-child {
  border-bottom-left-radius: 3px;
  border-bottom-right-radius: 3px;
}
.side-panel li {
  position: relative;
  background: #efefef;
}
.side-panel li:hover {
  background: #fff;
}
.side-panel li:hover > ul {
  display: block;
}
.side-panel a {
  display: inline-block;
  padding: 8px 15px;
  cursor: pointer;
}

.b li [class*="entypo-"] {
  display: inline-block;
  position: relative;
  left: 145px;
  transform: translateX(0);
  transition: all .3s ease-in-out;
  transition-delay: .1s;
  font-size: x-large;
  color:#2d3e4a;
}
.b .menu-item {
  display: inline-block;
  opacity: 0;
  transition: opacity .3s ease-in-out;
  
}
.b > ul {
  position: relative;
  left: -150px;
  transform: translate(0) translateZ(0);
  width: 200px;
  transition: transform .3s .1s ease-in-out;
}
.b > ul:hover {
  transform: translateX(150px);
  transition: all .3s ease-in-out;
}
.b > ul:hover li [class*="entypo-"] {
  transform: translateX(-150px);
  transition-delay: 0;
}
.b > ul:hover .menu-item {
  opacity: 1;
  transition: opacity .3s .2s ease-in-out;
}
.b > ul ul {
  display: block;
  opacity: 0;
  transform: translate(-100%);
  transition: all .3s ease-in-out;
  z-index: -1;
}
.b li:hover ul {
  opacity: 1;
  transform: translate(0);
}
</style>
<div class="side-panel b">
  <ul>
  <?php /*
    <li><a><span class="entypo-plus-circled"></span><span class="menu-item">Quick Add</span></a>
      <ul>
        <li><a class="entypo-doc-text-inv">Post</a></li>
        <li><a class="entypo-layout">Template</a></li>
        <li><a class="entypo-rocket">Rocket</a></li>
      </ul>
    </li>
    */?>
        <li><a href="#loginForm"  target="_blank" role="button" data-toggle="modal"><span class="entypo-user"></span><span class="menu-item">s'Inscrire</span></a></li>
        <li><a href="#invitation"  role="button" data-toggle="modal"><span class="entypo-link"></span><span class="menu-item">Invitation</span></a></li>
        <li><a href="<?php echo Yii::app()->createUrl('index.php/thematique')?>"><span class="entypo-tag"></span><span class="menu-item">Thématique</span></a></li>
        <li><a href="<?php echo Yii::app()->createUrl('index.php/statistics')?>"><span class="entypo-area-graph">&#128200;</span><span class="menu-item">Statistique</span></a>
        	<ul>
                <li><a href="<?php echo Yii::app()->createUrl('/index.php/statistics/graph/type/metier')?>">Metier</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/index.php/statistics/graph/type/thematique')?>">Thématique</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/index.php/statistics/graph/type/cp')?>">Code Postaux</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/index.php/statistics/graph/type/cpCount')?>">Commune</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/index.php/statistics/graph/type/groups')?>">Association</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/index.php/statistics/graph/type/interactions')?>">Interaction</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('/index.php/statistics/graph/type/3dsurface')?>">Surface 3D</a></li>
              </ul>
        </li>
        <li><a href="<?php echo Yii::app()->createUrl('index.php/evenement')?>"><span class="entypo-signal"></span><span class="menu-item">Évènement</span></a></li>
        <li><a href="<?php echo Yii::app()->createUrl('index.php/association')?>"><span class="entypo-users"></span><span class="menu-item">Association</span></a></li>
        <li><a href="<?php echo Yii::app()->createUrl('index.php/opendata')?>"><span class="entypo-share"></span><span class="menu-item">Open Data</span></a></li>
        <li><a href="<?php echo Yii::app()->createUrl('index.php/annuaire')?>"><span class="entypo-network"></span><span class="menu-item">Annuaire</span></a></li>
        <li><a href="<?php echo Yii::app()->createUrl('index.php/geo')?>"><span class="entypo-map"></span><span class="menu-item">Carto</span></a></li>
        <li><a href="<?php echo Yii::app()->createUrl('index.php/decouvrir')?>"><span class="entypo-globe"></span><span class="menu-item">Découvrir</span></a></li>
        <li><a href="<?php echo Yii::app()->createUrl('index.php/discuter')?>" ><span class="entypo-chat"></span><span class="menu-item">Discuter</span></a></li>
        <li><a href="#boiteIdee" role="button" data-toggle="modal"><span class="entypo-light-bulb">&#128161;</span><span class="menu-item" >Idée ou Projet</span></a></li>
        
        <li><a href="<?php echo Yii::app()->createUrl('index.php/actualite')?>" ><span class="entypo-rss"></span><span class="menu-item">Actualité</span></a></li>
        <li><a href="<?php echo Yii::app()->createUrl('index.php/diffusion/hangout')?>" ><span class="entypo-mic"></span><span class="menu-item">Conseil Mun.</span></a></li>
        <li><a href="<?php echo Yii::app()->createUrl('index.php/covoiturage')?>"><span class="entypo-shareable"></span><span class="menu-item">Covoiturage</span></a></li>
        <li><a href="<?php echo Yii::app()->createUrl('index.php/statistics/graph/type/groups')?>"><span class="entypo-flow-tree"></span><span class="menu-item">se Regrouper</span></a></li>
        
        <li><a href="<?php echo Yii::app()->createUrl('index.php/site/page/id/opensource')?>"><span class="entypo-cc"></span><span class="menu-item">Libre de droit</span></a></li>
        <li><a href="<?php echo Yii::app()->createUrl('index.php/financement')?>"><span class="entypo-thumbs-up"></span><span class="menu-item">Soutenir</span></a></li>
  </ul>
</div>