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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mon Compte <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            
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
                                
                                <li><a href="#participer"  target="_blank" role="button" data-toggle="modal">Mon compte</a></li>
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
<script>
function showInputLogin(){
	/*alert((!$('#registerEmail').is(':visible')) );
	if($('#registerEmail').is(':visible')) 
		$('#registerEmail').css('display',"block"); 
	else */
		$('#registerForm').submit();return false;
}
</script>