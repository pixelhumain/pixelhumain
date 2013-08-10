<header>
    <div class="navbar navbar-inverse navbar-fixed-top">
    			
        <div class="navbar-inner">
            <div class="container">
                <div class="pull-left brand title"><a href="index.php">Pixel Humain</a></div>
    			<div class="pull-left yellowph fss p20 ml50">Version 0.001 Lecture Seule</div>
                <div class="nav-collapse collapse pull-right">
                    <ul class="nav">
                        
                        <li><a href="index.php#infographic">Le Projet</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
                        <li><a href="index.php?r=pixelsActifs">Réseau</a></li>
                        <li><a href="index.php?r=financement">Pépète</a></li>
                        <?php if(!isset(Yii::app()->session["userId"])){?>
                        <li id="register">
                            <form id="registerForm" action="" class="navbar-form pull-right">
                                <input class="span2" type="text" id="registerEmail" placeholder="Email">
                                <a class="btn btn-warning" href="javascript:;" onclick="$('#registerForm').submit();return false;"  >S'inscrire </a>
                        	</form>
                        </li>
                        <?php } else {?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mon Compte <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <!-- li><a href="#">Thématique</a></li-->
								<li><a href="#">Mon Graph</a></li>
                                <li class="divider"></li>
                                <li><a href="#participer"  target="_blank" role="button" data-toggle="modal">Mon compte</a></li>
                                <li><a href="index.php?r=site/logout"  role="button" data-toggle="modal">Logout</a></li>
                                
                            </ul>
                        </li>
                        <?php }?>
                    </ul>
    				
                </div><!--/.nav-collapse -->
    			
            </div>
        </div>
    </div>
</header>