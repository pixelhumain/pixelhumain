<header>
    <div class="navbar navbar-inverse navbar-fixed-top">
    			
        <div class="navbar-inner">
            <div class="container">
                <div id="logo" class="pull-left brand title"><a id="logoLink" href="<?php echo Yii::app()->createUrl('')?>">Pixel Humain</a></div>
    			<div class="pull-left yellowph fss p20 ml50">V.0.001 Lecture Seule</div>
                <div class="nav-collapse collapse pull-right">
                
                    <ul class="nav">
                        
                        <li><a href="<?php echo Yii::app()->createUrl('index.php#infographic')?>">Le Projet</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('index.php#contact')?>">Contact</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('index.php/financement')?>">Soutien</a></li>
                        <?php if(!isset(Yii::app()->session["userId"])){?>
                        <li id="register"><a href="#loginForm"  target="_blank" role="button" data-toggle="modal"  >S'inscrire </a></li>
                        <?php } else {?>
                        <li class="dropdown">
                            <a href="<?php echo Yii::app()->createUrl('index.php/citoyens')?>" class="dropdown-toggle" data-toggle="dropdown">Mon Compte <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            	<?php /*
                                <li><a href="<?php echo Yii::app()->createUrl('index.php/thematique')?>">Thématique</a></li>
								<li><a href="<?php echo Yii::app()->createUrl('index.php/statistics')?>">Statistique</a></li>
								<li><a href="<?php echo Yii::app()->createUrl('index.php/opendata')?>">Open Data</a></li>
								<li><a href="<?php echo Yii::app()->createUrl('index.php/annuaire')?>">Annuaire</a></li>
								<li><a href="<?php echo Yii::app()->createUrl('index.php/covoiturage')?>">Covoiturage</a></li>
								<li><a href="<?php echo Yii::app()->createUrl('index.php/decouvrir')?>">Découvrir</a></li>
								<li><a href="<?php echo Yii::app()->createUrl('index.php/discuter')?>" >Discuter</a></li>
								<li><a href="<?php echo Yii::app()->createUrl('index.php/actualite')?>" >Actualité</a></li>
								<li><a href="<?php echo Yii::app()->createUrl('index.php/diffusion/hangout')?>" >Conseil Mun. Live</a></li>
                                <li class="divider"></li>
                                */?>
                                <li><a href="#participer"  target="_blank" role="button" data-toggle="modal">Citoyen</a></li>
                                <li><a href="#association"  target="_blank" role="button" data-toggle="modal">Associations</a></li>
                                <li><a href="#entreprise"  target="_blank" role="button" data-toggle="modal">Entreprise</a></li>
                                <li><a href="#evennement"  target="_blank" role="button" data-toggle="modal">Evennement</a></li>
                                <li><a href="#invitation"  target="_blank" role="button" data-toggle="modal">Invitation</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('index.php/site/logout')?>"  role="button" data-toggle="modal">Logout</a></li>
                            </ul>
                        </li>
                        <?php }?>
                    </ul>
    				
                </div><!--/.nav-collapse -->
    			
            </div>
        </div>
    </div>
</header>
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
<script>
function showInputLogin(){
	/*alert((!$('#registerEmail').is(':visible')) );
	if($('#registerEmail').is(':visible')) 
		$('#registerEmail').css('display',"block"); 
	else */
		$('#registerForm').submit();return false;
}
</script>