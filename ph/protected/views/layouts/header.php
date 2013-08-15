<header>
    <div class="navbar navbar-inverse navbar-fixed-top">
    			
        <div class="navbar-inner">
            <div class="container">
                <div id="logo" class="pull-left brand title"><a id="logoLink" href="<?php echo Yii::app()->createUrl('')?>">Pixel Humain</a></div>
    			<div class="pull-left yellowph fss p20 ml50">Version 0.001 Lecture Seule</div>
                <div class="nav-collapse collapse pull-right">
                
                    <ul class="nav">
                        
                        <li><a href="<?php echo Yii::app()->createUrl('index.php#infographic')?>">Le Projet</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('index.php#contact')?>">Contact</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('index.php/pixelsActifs')?>">Réseau</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl('index.php/financement')?>">Pépète</a></li>
                        <?php if(!isset(Yii::app()->session["userId"])){?>
                        <li id="register">
                            <form id="registerForm" action="" class="navbar-form pull-right">
                                <input class="span2" type="text" id="registerEmail" name="registerEmail" placeholder="Email">
                                <a class="btn btn-warning" href="javascript:;" onclick="$('#registerForm').submit();return false;"  >S'inscrire </a>
                        	</form>
                        </li>
                        <?php } else {?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mon Compte <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <!-- li><a href="#">Thématique</a></li-->
								<li><a href="<?php echo Yii::app()->createUrl('index.php/statistics/graph')?>">Mon PH</a></li>
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