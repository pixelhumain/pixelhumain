<?php
//$communexion = CO2::getCommunexionCookies(); 
?>
<style>
	.contact-map {	
		background:url(<?php echo $this->module->assetsUrl; ?>/images/people.jpg) bottom center repeat-x; 
		background-size: 60%;
		background-color:#DFE7E9;  
	}
	.headSection {	
		background:url(<?php echo $this->module->assetsUrl; ?>/images/1+1=3.jpg?c=c) bottom center no-repeat; 
		background-size: 80%;
		background-color:#fff;  
	}
	/*#mainNav .dropdown-result-global-search{
        top:56px !important;
        left:83px !important;
    }*/
    @media (min-width: 767px) and (max-width: 992px) {
        #mainNav .dropdown-result-global-search{
            width:40% !important;
        }
    } 
    .videoWrapper{
	   	display: none;
   	    background: black;
   }
.videoWrapper         {height:100%;}
.h_iframe        {position:relative;}
.h_iframe .ratio {display:block;width:100%;height:auto;}
.h_iframe iframe {position:absolute;top:0;left:0;width:100%; height:100%;background-color: white;}
.videoSignal{
	position: absolute;
    width: 100%;
    line-height: 100px;
    height: 100%;
    top: 0px;
    background-color: rgba(0,0,0,0.0);
    left: 0px;
}
.videoSignal:hover{
	background-color: rgba(0,0,0,0.0);
}
#videoDocsImg img{
	margin:	auto; 
}
/*.videoSignal a {
	
}*/
.videoSignal:hover span{
background-color: #09adef;
}
.videoSignal:hover span > i{
	color: white;
}
.videoSignal span{
 	width: 130px;
    margin: auto;
    height: 75px;
    background-color: rgba(0,0,0,0.6);
    bottom: 0;
    padding: 20px 40px;
    left: 0;
    text-align: center;
    position: absolute;
    right: 0;
    font-size: 100px;
    top: 0%;
    border-radius: 13px;
}
.videoSignal span > i  { 
	color: white;
    font-size: 50%;
    position: relative;
    margin: auto;
    bottom: 0;
    left: 0;
    position: absolute;
    right: 0;
    font-size: 37px;
    padding: 20px 40px;
    top: 0px;
}
.ahover {
	border: 1px solid #fff;
}
.ahover:hover{
	border: 1px solid #666;
}
</style>

<div class="pageContent">

	<!-- <div class="col-md-12 col-lg-12 col-sm-12">
		<?php 	$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
	  			//$this->renderPartial($layoutPath.'forms.'.Yii::app()->params["CO2DomainName"].'.login'); 
	  	?>
	</div> -->
	<div class="col-md-12 col-lg-12 col-sm-12 imageSection no-padding" 
		 style="margin-top: 30px; position:relative;">

		<div class="col-md-12">
			
			<?php if(!isset(Yii::app()->session['userId'])) { ?>
				<div id="videoDocsImg" class="col-md-7 col-sm-7 col-xs-12 margin-top-25">
			    	<img class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/<?php echo Yii::app()->language ?>/1+1=3empty.jpg"/>
			    	<a href="javascript:;" class="videoSignal text-white center"><span><i class="fa fa-3x fa-play"></i></span></a>
				</div>
				<div class="videoWrapper margin-top-25 col-md-6 col-md-offset-1 col-sm-7 col-xs-12 no-padding">
			    	<div class="h_iframe">
			        <!-- a transparent image is preferable -->
			        <img class="ratio" src="http://placehold.it/16x9"/>
			        <iframe id="autoPlayVideo" src="https://player.vimeo.com/video/133636468?api=1&title=0&amp;byline=0&amp;portrait=0&amp;color=57c0d4" frameborder="0" allowfullscreen></iframe>
			    	</div>
				</div>
			<!--<div class="col-md-7 col-sm-7 text-center">
				<div id="homeImg">
					<img id="img-header" class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/<?php echo Yii::app()->language ?>/1+1=3empty.jpg"/>
				</div>
			</div>-->

			<div id="form-home-subscribe" class="col-md-4 col-sm-5 col-xs-12 margin-top-25 padding-bottom-15 margin-right-50" 
				 style="border:1px solid #DDD; background-color: #F9F9F9; border-radius:4px;">
				<?php 	$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
			  			$this->renderPartial($layoutPath.'forms.'.Yii::app()->params["CO2DomainName"].'.register'); 
			  			$this->renderPartial($layoutPath.'forms.'.Yii::app()->params["CO2DomainName"].'.modalRegisterSuccess')
			  	?>
			</div>
			<?php } else { ?>
			<div id="videoDocsImg" class="col-xs-12 no-padding">
			    	<img class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/<?php echo Yii::app()->language ?>/1+1=3empty.jpg"/>
			    	<a href="javascript:;" class="videoSignal text-white center"><span><i class="fa fa-3x fa-play"></i></span></a>
				</div>
				<div class="videoWrapper col-xs-12 no-padding">
			    	<div class="h_iframe">
			        <!-- a transparent image is preferable -->
			        <img class="ratio" src="http://placehold.it/16x9"/>
			        <iframe id="autoPlayVideo" src="https://player.vimeo.com/video/133636468?api=1&title=0&amp;byline=0&amp;portrait=0&amp;color=57c0d4" frameborder="0" allowfullscreen></iframe>
			    	</div>
			    	
				</div>
			<!--<div class="col-md-12 text-center">
				<div id="homeImg">
					<img id="img-header" class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/<?php echo Yii::app()->language ?>/1+1=3empty.jpg"/>
				</div>
			</div>-->
			<?php } ?>
		</div>


		<!-- <div class="col-md-12 no-padding margin-top-25"><hr></div> -->


		<!-- <div class="col-md-12">
			<h3 class="text-red text-center"><i class="fa fa-hand-up"></i><br>parcourir les applications</h3>
			<hr class="angle-down">
		</div> -->
		<!--<div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12 shadow2 padding-15 margin-top-25">
			<div class="mainmenu"></div>
		</div>-->


		<div class="col-xs-12  margin-top-50 hidden">
			<?php $isEmptyCo = empty($communexion["values"]["cityName"]); ?>
			
			<h3 class="text-red text-center">
				<i class="fa fa-home fa-2x"></i><br>
				Communexion<br>
				<small>
					<i class="fa fa-cross"></i> 
					<span id="communexionNameHome">
					<?php if($isEmptyCo){ ?>
						<?php echo Yii::t("home","You're not <span class='text-dark'>communected</span>") ?>
					<?php }else{ ?>
						<?php echo Yii::t("home","You are") ?> <span class="text-dark"><?php echo Yii::t("home","communected to") ?> 
						<span class="text-red"><?php echo $communexion["values"]["cityName"];?></span>
					<?php } ?>
					</span><br>
					<small class="text-dark inline-block margin-top-5 info_co
						 <?php if(!$isEmptyCo) echo "hidden"; ?>" 
						 style="line-height: 15px;">
						<i class="fa fa-signal"></i> 
						<?php echo Yii::t("home","Be communected permits you to get smart informations<br>localy performed.") ?>
					</small>
				</small>
			</h3>

			<hr class="angle-down">

			<h5 class="text-center info_co <?php if(!$isEmptyCo) echo 'hidden'; ?>">
				<?php echo Yii::t("home","Be communected") ?> !
			</h5>
			<div class="col-md-12 text-center">
				<button class="btn btn-default <?php if($isEmptyCo) echo 'hidden'; ?>" id="change_co">
					<?php echo Yii::t("home","Test a other communexion") ?>
				</button>
			</div>
			<input class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 form-input text-center input_co 
						 <?php if(!$isEmptyCo) echo "hidden"; ?>" 
				   id="main-search-bar" type="text" 
				   style="border-radius:50px; height:40px; border: 2px solid red; color:red; margin-bottom:15px;"
				   placeholder="<?php echo Yii::t("home", "communect you : London, Paris, Brussels ?") ?>">

			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 info_co
						 <?php if(!$isEmptyCo) echo "hidden"; ?>" 
						 style="font-family: 11px;" id="info_co">
	            <i class="fa fa-signal"></i> <?php echo Yii::t("home","To use the network efficiently, we advice you to be <i><b>communected</b></i>") ?>.<br><br>
	            <i class="fa fa-magic"></i> <?php echo Yii::t("home","Indicate your <b>living place</b>, to keep informed about what's happened around you automatically.") ?><br>
	        </div>
	        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12" style="font-family: 11px;" 
	        	 id="dropdown_search">
	        </div>
		</div>

		
		<div class="col-xs-12 no-padding margin-top-25 hidden"><hr></div>
		
		<div class="col-xs-12 hidden">
			<h3 class="text-red text-center">
				<i class="fa fa-clock-o fa-2x"></i><br>
				<?php echo Yii::t("home", "An the moment") ?><br>
				<small id="liveNowCoName">
					<?php if($isEmptyCo){ ?>
					<?php echo Yii::t("home","on the network") ?>
					<?php }else{ ?>
					<span class='text-red'><?php echo Yii::t("home","in") ?> <?php echo $communexion["values"]["cityName"];?></span>
					<?php } ?>
				</small>
			</h3>
			<div class="text-left" id="nowList"></div>
		</div>
		
		<!-- <a href="https://www.helloasso.com/associations/open-atlas/collectes/communecter/don" target="_blank" class="col-xs-12 text-red margin-top-20 no-padding" style="width:100%;text-decoration: none;">
			<h3 class="text-center">
				<?php //echo Yii::t("home","Devenez l'un des piliers de COmmunecter en faisant un don régulier !") ?>
			</h3>
		</a> -->
		
		<!--<div class="col-md-12" style="background-color:#E33551;width:100%;padding:8px 0px 8px 0%;margin-top: 15px">
			<h1 class="homestead text-center text-white">
				<?php echo Yii::t("home","Campagne de Don !") ?>
			</h1>
		</div>
		<center class="col-xs-12" style="z-index:1;">
			<i class="fa fa-caret-down text-red" style="z-index:1000;"></i><br/>
		</center>-->
		<!-- <a href="https://www.helloasso.com/associations/open-atlas/collectes/communecter/don" target="_blank" class="col-xs-12 text-red margin-top-20 no-padding" style="width:100%;text-decoration: none;">
			<h3 class="text-center">
				<?php //echo Yii::t("home","Devenez l'un des piliers de COmmunecter en faisant un don régulier !") ?>
			</h3>
		</a> -->
		<div class="col-xs-12 no-padding" style="text-align:center;">
				<div class="col-xs-12 padding-20 margin-top-10 center" style="background-color: #f6f6f6;">
					<h4 class="text-center text-red"><?php echo Yii::t("home", "Be a pillar of Communecter, make a donation !") ?></h4>
					<hr style="width:40%; margin:20px auto;">
					<h5 class="no-margin">
                        <span class=""> <?php echo Yii::t("home", "No advertisement, no premium, only Openness and Passion") ?></span>
                    </h5>
                   	<span>
					<?php /*echo Yii::t("home", "Communecter est soutenu par une association non profit et est développé sous licence libre et données ouvertes. Nous croyons dans des plateformes libres, accessibles gratuitement pour tous. 
						Nous avons besoin de personnes comme vous, soutiens, utilisateurs ou futures utilisateurs de la plateforme pour rendre cela possible.
						Nous sommes une petite équipe avec peu de moyens, votre soutien fera une grande différence !")*/ ?><br/>
					</span>
					<a href="https://www.helloasso.com/associations/open-atlas/collectes/communecter/don" target="_blank" class="btn col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2 uppercase" style="background-color:#E33551; color:white;">
						<img src="<?php echo $this->module->assetsUrl; ?>/images/home/helloasso-icon.png"" height="20" width="20"/> <?php echo Yii::t("home", "Make it last longer") ?>
					</a>
				</div>
				<!--<div class="col-md-6 col-sm-6 col-xs-12 padding-20" style="background-color: white; text-align:center;min-height:400px;">
					Image , Design avec boutton pour aller sur le don <br/><br/>
					<a href="https://www.helloasso.com/associations/open-atlas/collectes/communecter/don" target="_blank" class="margin-top-20 no-padding" style="width:100%;text-decoration: none;">
						<h3 class="text-center">
							<?php echo Yii::t("home","Don récurant") ?>
						</h3>
					</a>
				</div>-->
		</div>
		<div class="col-sm-12 col-md-12 col-xs-12 no-padding" style="background-color:#fff; max-width:100%; float:left;">
		<!--<div class="col-md-12" style="width:100%;padding:8px 0px 8px 0%;">
			<h1 class="text-center text">
				<?php echo Yii::t("home","A connected territorial search engine") ?>
			</h1>
		</div>-->
		<div class="col-xs-12 margin-top-50 margin-bottom-25 text-center" >
			<h2 class="text-red text-center"><?php echo Yii::t("home","A connected territorial search engine") ?></h2>
			<h5 class=" col-xs-12 text-center" style="font-style:italic;"><?php echo Yii::t("home","Collective intelligence at service for citizens") ?></span>
			<br/>
			<h2 class="text-red text-center homestead">1 + 1 = 3</h2>
			<h5 class=" col-xs-12 text-center" style="font-style:italic;">
			Wikipedia <i class="fa fa-plus text-red"></i> Open Street Maps <i class="fa fa-plus  text-red"></i> Open source Society
			</h5>
			<br/>
			<div class="center"  >
				<div  style="position:absolute; transform: rotate(60deg);margin:0 47%;" >
					<img class="img-responsive" width=50 src="<?php echo $this->module->assetsUrl; ?>/images/home/triangle.png" />
				</div>
			</div>
		</div>
		<!--<center class="col-xs-12" style="z-index:1;">
			<i class="fa fa-caret-down text-red" style="z-index:1000;"></i><br/>
		</center>-->
		<div class="col-xs-12 margin-top-50" >
			<h3 class="text-red text-center"><?php echo Yii::t("home","For Whom ?") ?></h3>
			<hr class="angle-down">
		</div>
		
		<div class="col-xs-12" style="text-align:center;padding:40px;">
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="keylist panel panel-white" style="box-shadow: inherit;">
					<div class="panel-heading border-light ">
						<span class="panel-title"> 
							<i class="fa fa-street-view fa-2x"></i>
							<br/>
							<span class="uppercase text-red" style="font-size: 18px;"><?php echo Yii::t("home", "For me") ?></span><br/>
							<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "I learn about my territory") ?> <br/></span>
							<br>
							<?php echo Yii::t("home", "I know what's happened around me") ?>
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="keylist panel panel-white" style="box-shadow: inherit;">
					<div class="panel-heading border-light ">
						<span class="panel-title"> 
							<i class="fa fa-users fa-2x"></i>
							<br/>
							<span class="uppercase text-red" style="font-size: 18px;"><?php echo Yii::t("home", "For my community") ?></span><br/>
							<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "I am connected to my community") ?> <br/></span>
							<br>
							<?php echo Yii::t("home", "I can promote ideas and activities and enjoy organization helping tools") ?>
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="keylist panel panel-white" style="box-shadow: inherit;">
					<div class="panel-heading border-light">
						<span class="panel-title"> 
							<i class="fa fa-globe fa-2x"></i>
							<br/>
							<span class="uppercase text-red" style="font-size: 18px;"><?php echo Yii::t("home", "For commons") ?></span><br/>
							<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "A smart collective intelligence") ?><br/></span>
							<br>
							<?php echo Yii::t("home", "I take part to the building of territorial knowledge base") ?>
						</span>
						
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12">
			<h3 class="text-red text-center"><?php echo Yii::t("home","What ?") ?></h3>
			<hr class="angle-down">
		</div>
		<div class="col-xs-12 no-padding" style="text-align:center;margin-bottom:24px;">
			<div class="col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-12 padding-20" style="background-color: #f6f6f6; text-align:center;min-height:400px;">
					<h4> <i class="fa fa-th"></i> <?php echo Yii::t("home", "5 main applications") ?></h4>
					<hr style="width:40%; margin:10px auto;">
					<a href="#search" class=" btn-main-menu col-xs-12" data-type="search" >    
	                    <div class="modal-body text-left">
	                        <!-- <h4 class="text-red no-margin "><i class="fa fa-search"></i>
	                            <span class="homestead"> <?php //echo Yii::t("home","SEARCH") ?></span>
	                        </h4><br/> -->
	                        <div class="col-md-12 no-padding text-left">
	                            <h4 class="no-margin text-red">
	                            	<i class="fa fa-search"></i>
	                            	<?php echo Yii::t("home","Search engine") ?>
	                                <br>
	                                <small class="text-dark">
	                                    <?php echo Yii::t("home","Find & connect with local actors") ?>
	                                </small>
	                            </h4>
	                        </div>
	                    </div>
	                </a>
	                
	                           
	                <a href="#agenda" class=" btn-main-menu col-xs-12" data-type="agenda">
	                    <div class="modal-body text-left">
	                       <!--  <h4 class="text-red no-margin"><i class="fa fa-calendar"></i>
	                            <span class="homestead"> <?php //echo Yii::t("home","AGENDA") ?></span>
	                        </h4><br/> -->
	                        
	                        <div class="col-md-12 no-padding text-left">
	                            <h4 class="no-margin text-red">
	                            	<i class="fa fa-calendar"></i>
	                            	<?php echo Yii::t("home","A common agenda") ?>
	                                <br><small class="text-dark">
	                                    <?php echo Yii::t("home","All local events in a click away") ?>
	                                </small>
	                            </h4>
	                        </div>
	                    </div>
	                </a>
	                
	                <a href="#live" class="btn-main-menu col-xs-12" > 
	                    <div class="modal-body text-left">
	                        <!-- <h4 class="text-red no-margin"><i class="fa fa-newspaper-o"></i>
	                            <span class="homestead"> <?php //echo Yii::t("home","LIVE") ?></span>
	                        </h4><br/> -->
	                        
	                        <div class="col-md-12 no-padding text-left">
	                            <h4 class="no-margin text-red">
	                            	<i class="fa fa-newspaper-o"></i>
	                            	<?php echo Yii::t("home","A common news stream") ?>
	                                <br><small class="text-dark">
	                                    <?php echo Yii::t("home","Local Message sharing and group communication")?>
	                                </small>
	                            </h4>
	                        </div>
	                    </div>
	                </a>
	                <a href="#live" class="btn-main-menu col-xs-12" > 
	                    <div class="modal-body text-left">
	                        <!-- <h4 class="text-red no-margin"><i class="fa fa-cubes"></i>
	                            <span class="homestead"> <?php //echo Yii::t("home","SHARING") ?></span>
	                        </h4><br/> -->
	                        
	                        <div class="col-md-12 no-padding text-left">
	                            <h4 class="no-margin text-red">
	                            	<i class="fa fa-cubes"></i>
	                            	<?php echo Yii::t("home","Exchanges of ressources") ?>
	                                <br><small class="text-dark">
	                                    <?php echo Yii::t("home","To share needs, offers, services, competences for more efficiency")?>
	                                </small>
	                            </h4>
	                        </div>
	                    </div>
	                </a>
	                <a href="#annonces" class=" btn-main-menu col-xs-12" data-type="classified" >
	                    <div class="modal-body text-left">
	                        <!-- <h4 class="text-red no-margin">
	                            <span class="homestead"> <?php echo Yii::t("home","Market place") ?></span>
	                        </h4><br/>
	                         -->
	                        <div class="col-md-12 no-padding text-left">
	                            <h4 class="no-margin text-red">
	                            	<i class="fa fa-bullhorn"></i>
	                            	<?php echo Yii::t("home","A market place") ?>
	                                <br><small class="text-dark">
	                                    <?php echo Yii::t("home","For local and community exchanges")?>
	                                </small>
	                            </h4>
	                        </div>
	                    </div>
	                </a>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 padding-20" style="text-align:center;min-height:400px;">
					<img class="img-responsive" style="margin:0 auto;margin-top: 50px;max-height: 300px" src="<?php echo $this->module->assetsUrl; ?>/images/home/modules_screen.png"/>
				</div>
			</div>
			<div class="col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 hidden-xs padding-20" style="text-align:center;min-height:400px;">
					<img class="img-responsive" style="margin:0 auto;margin-top: 20px; max-height:360px;" src="<?php echo $this->module->assetsUrl; ?>/images/home/espaceco-1.png"/>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 padding-20" style="background-color: #f6f6f6; text-align:center;min-height:400px;">
					<h4 class="margin-top-50"><i class="fa fa-group"></i> <?php echo Yii::t("home","Cooperative space") ?></h4>
					<hr style="width:40%; margin:30px auto;">    
	                    <div class="col-md-12 col-xs-12 text-center padding-20">
	                        <h5 class=""><?php echo Yii::t("home","Use Cooperative spaces for decision making, tasking, and experiment transparency and horizontality") ?>
	                            <small class="margin-top-20">
	                                <br/><br/><i class="fa fa-check"></i><?php echo Yii::t("home","Voting system with or whitout amendment") ?>
	                                <br/><br/><i class="fa fa-check"></i><?php echo Yii::t("home","Task assignment") ?><br/>
	                            </small>
	                        </h5>
	                    </div>
	                    <a href="https://wiki.communecter.org/fr/espace-coop%C3%A9ratif.html" target="_blank" class="text-red col-xs-12 uppercase margin-top-50">
	                    	<?php echo Yii::t("home","+ More infos") ?>    
	                	</a>
	             </div>
	            <div class="visible-xs col-xs-12 padding-20" style="text-align:center;min-height:400px;">
					<img class="img-responsive" style="margin:0 auto;margin-top: 10px;" src="<?php echo $this->module->assetsUrl; ?>/images/home/espaceco-1.png"/>
				</div>
			</div>
			<div class="col-xs-12 no-padding">
	            <div class="col-md-6 col-sm-6 col-xs-12" style="background-color: #f6f6f6; text-align:center;min-height:400px;">
					<h4 class="margin-top-50"><i class="fa fa-map-marker"></i> <?php echo Yii::t("home","Geolocation") ?></h4>
					<hr style="width:40%; margin:30px auto;">    
	                    <div class="col-md-12 text-center">
	                        <h5 class=""><?php echo Yii::t("home","Wherever you are on Communecter, you can consult informations on the map") ?>
	                            <br/><br/><small class="margin-top-20">
	                                <?php echo Yii::t("home", "Searching results, upcoming events, local initiaves, community members...") ?>.
	                            </small>
	                        </h5>
	                    </div>
	                    <a href="https://wiki.communecter.org/fr/espace-coop%C3%A9ratif.html" target="_blank" class="text-red col-xs-12 uppercase margin-top-50">
	                    	<?php echo Yii::t("home","+ More infos") ?>    
	                	</a>
	            </div>
	            <div class="col-md-6 col-sm-6 col-xs-12" style="text-align:center; min-height:400px;">
					<img class="img-responsive" style="margin:auto; margin-top: 10px; max-height:380px;" src="<?php echo $this->module->assetsUrl; ?>/images/home/carto_home.png"/>
				</div>
			</div>
		</div>
		<div class="col-xs-12" >
			<h3 class="text-red text-center"><?php echo Yii::t("home","Why ?") ?></h3>
			<hr class="angle-down">
		</div>
		 <div class="col-xs-12 homestead" style="text-align:center; margin-bottom:24px;">
                <div class="col-md-1 col-sm-1 hidden-xs"></div>
                <div class=" col-md-2 col-sm-2 col-xs-4" style="text-align:center;"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur01.png"/><?php echo Yii::t("home","Open Source") ?></div>
                <div class=" col-md-2 col-sm-2 col-xs-4"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur02.png"/><?php echo Yii::t("home","No advertisement") ?></div>
                <div class=" col-md-2 col-sm-2 col-xs-4"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur03.png"/><?php echo Yii::t("home","Protected data") ?></div>
                <div class=" col-md-2 col-sm-2 col-xs-4"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur04.png"/><?php echo Yii::t("home","Shared Informations") ?></div>
                <div class=" col-md-2 col-sm-2 col-xs-4"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur05.png"/><?php echo Yii::t("home","Linked Data") ?></div>
                <div class="visible-xs col-xs-4"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur06.png"/><?php echo Yii::t("home","Connected territory") ?></div>
            </div>
            <div class="col-xs-12 homestead" style="text-align:center;">
                 <div class=" col-md-1 col-sm-1 hidden-xs"></div>
                <div class=" col-md-2 col-sm-2 hidden-xs"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur06.png"/><?php echo Yii::t("home","Connected territory") ?></div>
                <div class=" col-md-2 col-sm-2 col-xs-4"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur07.png"/><?php echo Yii::t("home","Collective intelligence") ?></div>
                <div class=" col-md-2 col-sm-2 col-xs-4"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur08.png"/><?php echo Yii::t("home","Open") ?></div>
                <div class=" col-md-2 col-sm-2 col-xs-4"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur09.png"/><?php echo Yii::t("home","Society 2.2.main") ?></div>
                <div class=" col-md-2 col-sm-2 col-xs-4"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur10.png"/><?php echo Yii::t("home","Commons") ?></div>
            </div>
        
		<!--<div class="videoWrapper col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
			<<a href="javascript:;" onclick="" class="btn-show-video"><i class="fa fa-youtube-play fa-5x"></i></a> 
			<iframe class="col-md-12 col-xs-12 no-padding" height="480" 
					src="https://player.vimeo.com/video/133636468?api=1&title=0&amp;byline=0&amp;portrait=0&amp;color=57c0d4" 
					frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen class="video" 
					aria-hidden="true" tabindex="-1" style="border:10px solid black;">
			</iframe>
		</div>-->
		<!-- <div class="col-md-6 text-left margin-top-25" style="background-color:#fffff;color:#293A46;padding-bottom:40px; float:left;">
			
			<h4 class="text-dark homestead">Un réseau sociétal, territorial, citoyen, libre, gratuit et ouvert</h4>
			<!-- En s'appuyant sur un <a href="javascript:;" data-id="explainSocietyNetwork" class="explainLink">réseau sociétal</a> (au service de la société) regroupant les acteurs d'un territoire, - ->
			<a href="javascript:;" data-id="explainCommunecter" class="explainLink">"Communecter"</a> propose des outils numériques innovants et accessibles à tous, afin de créer ensemble
			un <a href="javascript:;" data-id="explainConnectedTerritory" class="explainLink">territoire connecté</a> qui nous ressemble.
			<br/><br/>Tout cela gratuitement, dans le respect des données de chacun, car Communecter est un <a href="javascript:;" data-id="explainCommuns" class="explainLink">bien commun</a>
			fait pour et par chacun d’entre nous, porté par une association à but non lucratif.
			<br/><br/>
			Plus qu'une simple application, <span class="text-red">Communecter</span> c'est aussi :
			<ul class="information" style="font-weight: normal;">
			<li>Une projet <a href="javascript:;" data-id="explainOpenSource" class="explainLink">open source</a></li>
			<li>Une communauté riche et diversifiée</li>
			<li>Un site web qui vous tend les bras</li>
			<li>Une application mobile (en cours de développement) </li>
			<li>Des interfaces tierces contribuant à une base de donnée commune</li>
			<!-- <li>Des instances indépendantes mais inter-opérantes par leurs <a href="javascript:;" data-id="explainOpenSource" class="explainLink">sémantiques</a> communes </li> *termes trop techniques pour user lambda => complique - ->
			</ul>
			
		</div> -->
	</div>
	
	
	<div class="col-sm-12 col-md-12 col-xs-12 no-padding margin-top-50 bg-black" style=" max-width:100%; float:left;" id="teamSection">
		
		<center>
			<i class="fa fa-caret-down" style="color:#fff"></i><br/>
			<!-- <img style="height:80px" src="<?php echo $this->module->assetsUrl; ?>/images/home/coop.png?t=111"/> -->
			
			<h1 class="homestead" style="color:#fff">
				<!-- <i class="fa fa-line-chart headerIcon"></i>  -->
				<?php echo Yii::t("home","Cooperative") ?>.<small>soon</small>
			</h1>
			
			<div class="col-sm-12 text-white padding-bottom-15">
				<?php echo Yii::t("home","We all believe in something better and building it together") ?>.
			</div>
		</center>
		<div class="space20"></div>
	</div>
	<div class="col-md-12" style="color:#293A46; float:left; width:100%;">
		<center>
			<i class="fa fa-caret-down" style="color:#000"></i>
			<div class="col-xs-12 margin-top-10">
				<?php 
					$list = PHDB::findAndSort(Person::COLLECTION, array(
						"profilThumbImageUrl" => array( '$exists' => 1,'$ne' => "")
						),array("updated"),"100",array("profilThumbImageUrl","name") );
				foreach ($list as $key => $value) {
					echo '<img title="'.@$value["name"].'" src="'.@$value["profilThumbImageUrl"].'" height="50"/>';
				} ?>
			</div>
		</center>
	</div>
	<div class="col-sm-12 col-md-12 col-xs-12 no-padding margin-top-10" style="background-color:#E33551; max-width:100%; float:left;" id="teamSection">
		
		<center>
			<i class="fa fa-caret-down" style="color:#fff"></i><br/>
			<!-- <img style="height:80px" src="<?php echo $this->module->assetsUrl; ?>/images/home/yoda.png?t=111"/> -->
		
			<h1 class="homestead" style="color:#fff">
				<!-- <i class="fa fa-line-chart headerIcon"></i>  -->
				<?php echo Yii::t("home","We are all Open") ?>
			</h1>
			
			<div class="col-sm-12 text-white padding-bottom-15">
				<?php echo Yii::t("home","Everything we do is open source and built in collaborative way") ?>.<br/>
				<?php echo Yii::t("home","We are experimenting new ways of gouvernance, managing territory, implicating local actor into everything and everywhere") ?>.
				<!-- <i>"EN AMÉLIORATION CONTINUE"</i> -->
				<h3 class=""><?php echo Yii::t("home","Join us") ?> </h3>
				
			</div>
		</center>
		<div class="space20"></div>
	</div>
	<div class="col-md-12  padding-bottom-50" style="color:#293A46; float:left; width:100%;">
		<center>
			<i class="fa fa-caret-down" style="color:#E33551"></i>
			<br/>
			
			<a class="lbh"  href="#co-communication">
				<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
					<i class="fa fa-bullhorn fa-2x"></i>
					<br/>
					<span class="uppercase text-red" style="font-size: 18px;"> #Communication </span><br/>
					<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "Share and imagine great ideas") ?> <br/></span>
				</div>	
			</a>
			<a class="lbh"  href="#codesign">
				<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
					<i class="fa fa-coffee fa-2x"></i>
					<br/>
					<span class="uppercase text-red" style="font-size: 18px;"> #CoDesign </span><br/>
					<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "Ideas Design Graphics Video") ?> <br/></span>
				</div>	
			</a>
			
			<a class="lbh"  href="#codev">
				<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
					<i class="fa fa-code fa-2x"></i>
					<br/>
					<span class="uppercase text-red" style="font-size: 18px;"> #COdev </span><br/>
					<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "Core Development team") ?> <br/></span>
				</div>
			</a>
			<a class="lbh"  href="#communecter">
				<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
					<i class="fa fa-lightbulb-o fa-2x"></i>
					<br/>
					<span class="uppercase text-red" style="font-size: 18px;"> #communecter </span><br/>
					<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "Project Management") ?> <br/></span>
				</div>	
			</a>
			<a class="lbh"  href="#openatlas">
				<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
					<i class="fa fa-group fa-2x"></i>
					<br/>
					<span class="uppercase text-red" style="font-size: 18px;"> #Open Atlas </span><br/>
					<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "Non Governmental Organization") ?> <br/></span>
				</div>	
			</a>
			<a class="lbh"  href="#pixelhumain">
				<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
					<i class="fa fa-circle-thin fa-2x"></i>
					<br/>
					<span class="uppercase text-red" style="font-size: 18px;"> #COOP Pixel Humain</span><br/>
					<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "Active contributors and soon a cooperative") ?> <br/></span>
				</div>	
			</a>
			<a class="lbh"  href="#connections">
				<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
					<i class="fa fa-connectdevelop fa-2x"></i>
					<br/>
					<span class="uppercase text-red" style="font-size: 18px;"> #Connections </span><br/>
					<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "All people we meet.") ?> <br/></span>
				</div>	
			</a>
			
			<a class="lbh"  href="#cofinanceur">
				<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
					<i class="fa fa-heart fa-2x"></i>
					<br/>
					<span class="uppercase text-red" style="font-size: 18px;"> #Contributors</span><br/>
					<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "Money for bills & Love to live.") ?> <br/></span>
				</div>
			</a>
			<a class="lbh"  href="#cotest">
				<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
					<i class="fa fa-child fa-2x"></i>
					<br/>
					<span class="uppercase text-red" style="font-size: 18px;"> #CoTesting</span><br/>
					<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "Good tools have great testers") ?> <br/></span>
				</div>
			</a>
			<a class="lbh"  href="#cobugs">
				<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
					<i class="fa fa-bug fa-2x"></i>
					<br/>
					<span class="uppercase text-red" style="font-size: 18px;"> #CoBugs </span><br/>
					<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "Help share & destroy bugs") ?> <br/></span>
				</div>	
			</a>
			<a class="lbh"  href="#cointerop">
				<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
					<i class="fa fa-usb fa-2x"></i>
					<br/>
					<span class="uppercase text-red" style="font-size: 18px;"> #Interoperabilty</span><br/>
					<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "Connecting Systems together") ?> <br/></span>
				</div>
			</a>
			
			<a class="lbh"  href="#cotools">
				<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
					<i class="fa fa-cubes fa-2x"></i>
					<br/>
					<span class="uppercase text-red" style="font-size: 18px;"> #CO Tools</span><br/>
					<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "Open Source Tools For Communities") ?> <br/></span>
				</div>
			</a>
	</center>
	</div>
	<div class="col-xs-12" >
		<h3 class="text-red text-center"><?php echo Yii::t("home","Read Us") ?></h3>
		<hr class="angle-down">
	</div>
	<div class="col-md-12  padding-bottom-50" style="color:#293A46; float:left; width:100%;">
		<center>
			
			<a class="lbh"  href="#codocwiki">
				<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
					<i class="fa fa-group fa-2x"></i>
					<br/>
					<span class="uppercase text-red" style="font-size: 18px;"> #Team</span><br/>
					<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "Top Level Sharing process") ?> <br/></span>
				</div>
			</a>
			<a class="lbh"  href="#docs">
				<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
					<i class="fa fa-book fa-2x"></i>
					<br/>
					<span class="uppercase text-red" style="font-size: 18px;"> #Online Doc</span><br/>
					<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "5 year Thinking Process") ?> <br/></span>
				</div>
			</a>
		<a href="http://wiki.communecter.org" >
			<div class="ahover bg-white padding-10 col-sm-12 col-md-4">
				<i class="fa fa-briefcase fa-2x"></i>
				<br/>
				<span class="uppercase text-red" style="font-size: 18px;"> #Doc Kit</span><br/>
				<span style="font-size: 16px;font-style:italic"> <?php echo Yii::t("home", "Goodies we can pass around") ?> <br/></span>
			</div>
		</a>
	</center>
	</div>
	<div class="col-md-12 padding-bottom-50" style="color:#293A46; float:left; width:100%;" id="partenerSection">
		<center>
			<hr class="angle-down">
			<a href="https://www.infomaniak.com/fr" target="_blank" class="">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/logo-infomaniak.png" height=20 style="margin-top: -10px;border-radius: 3px;">
            </a>
            <?php echo Yii::t("home", "helps us to host our tools") ?>
		<center>
	</div>
	<div class="col-md-12 contact-map padding-bottom-50" style="color:#293A46; float:left; width:100%;" id="contactSection">
		<center>
			<i class="fa fa-caret-down" style="color:#FFF"></i>
			<br/>
			<br/>
			<h1 class="homestead">
			<a target="_blank" href="https://github.com/pixelhumain/communecter" class="btn btn-github btn-social"><span class="fa fa-github"></span> </a><br/>
			<?php echo Yii::t("home","CONTACT") ?>
			</h1>
			+ 262 262 34 36 86<br><img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/contactCO_footer_welcome.png" height="15"/>
			<br/><a href="#docs.page.openatlas.dir.<?php echo Yii::app()->language ?>" data-id="explainOpenAtlas" class="lbh"><?php echo Yii::t("home","Open Atlas NGO") ?></a>
			<br/><a href="#docs.page.mention.dir.<?php echo Yii::app()->language ?>" class="lbh" ><?php echo Yii::t("home","Legal notice") ?></a>
			<br/><a href="#docs.page.partners.dir.panels" class="lbh"><?php echo Yii::t("home","Partners") ?></a>
		<center>
	</div>
</div>
<div class="portfolio-modal modal fade" id="modalForgot" tabindex="-1" role="dialog" aria-hidden="true">
    <form class="modal-content form-email box-email padding-top-15"  >
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="name" >
                        <?php if(Yii::app()->params["CO2DomainName"] == "kgougle"){ ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" height="60" class="inline margin-bottom-15">
                       <?php } else { ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="100" class="inline margin-bottom-15">
                        <?php } ?>
                    </span>
                    <h4 class="letter-red no-margin" style="margin-top:-5px!important;">Mot de passe oublié ?</h4><br>
                    <hr>
                    <p><small>Indiquez votre addresse e-mail, vous recevrez un e-mail contenant votre mot de passe.</small></p>
                    <hr>
                    
                </div>
            </div>
            <div class="col-md-4 col-md-offset-4 text-left">
                
                <label class="letter-black"><i class="fa fa-envelope"></i> E-mail</label><br>
                <input class="form-control" id="email2" name="email2" type="text" placeholder="E-mail"><br/>
                
                <hr>
                <div class="pull-left form-actions no-margin" style="width:100%; padding:10px;">
                    <div class="errorHandler alert alert-danger no-display registerResult pull-left " style="width:100%;">
                        <i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
                    </div>
                </div>
                <!-- <div class="form-actions">
                     <button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="forgotBtn ladda-button center center-block">
                        <span class="ladda-label">XXXXXXXX</span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
                    </button>
                </div> -->
                <a href="javascript:" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo Yii::t("common","Back") ?></a>
                <button class="btn btn-success text-white pull-right forgotBtn"><i class="fa fa-sign-in"></i> Envoyer</button>
                
                
                <div class="col-md-12 margin-top-50 margin-bottom-50"></div>
            </div>      
        </div>
    </form>
</div>
<script type="text/javascript">
<?php $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
	  $this->renderPartial($layoutPath.'home.peopleTalk'); ?>
var peopleTalkCt = 0;
jQuery(document).ready(function() {
	setTimeout(function(){
		$("#videoDocsImg img").css({"max-height":$("#form-home-subscribe").outerHeight()});
	},300);
	topMenuActivated = false;
	hideScrollTop = true;
	checkScroll();
	loadLiveNow();
	$(".videoSignal").click(function(){
		openVideo();
	});
	peopleTalkCt = getRandomInt(0,peopleTalk.length);
	showPeopleTalk();
    $("#map-loading-data").hide();
	$(".mainmenu").html($("#modalMainMenu .links-main-menu").html());
	//$("#modalMainMenu .links-main-menu").html("");
	//setTimeout(function(){ $("#input-communexion").hide(300); }, 300);
	var timerCo = false;
			
	$("#main-search-bar").keyup(function(){
		if($("#main-search-bar").val().length > 2){
			if(timerCo != false) clearTimeout(timerCo);
			timerCo = setTimeout(function(){ 
				//$("#info_co").html("");
				$(".info_co").addClass("hidden");
				$("#change_co").addClass("hidden");
				searchType = ["cities"];
				loadingData=false;
				scrollEnd=false;
				totalData = 0;
				communexion.state = false ; 
				startSearch(0, 20);
			}, 500);
		}else{
			$(".info_co").removeClass("hidden");
			$("#dropdown_search").html("");
		}
	});
    $("#change_co").click(function(){
    	$(".info_co, .input_co").removeClass("hidden");
		$("#change_co").addClass("hidden");
    });
	setTitle("<?php echo Yii::t("home","Welcome on") ?> <span class='text-red'>commune</span>cter","home","<?php echo Yii::t("home","Welcome on Communecter") ?>");
	$('.tooltips').tooltip();

	$("#btn-param-postal-code").click(function(){
		$("#div-param-postal-code").show(400);
	});

	// $('#searchBarPostalCode').keyup(function(e){
 //        clearTimeout(timeoutSearchHome);
 //        timeoutSearchHome = setTimeout(function(){ startSearch(); }, 800);
 //    });


    $(".explainLink").click(function() {
		showDefinition( $(this).data("id") );
		return false;
	});
    $(".keyword").click(function() {
    	$(".keysUsages").hide();
    	link = "<br/><a href='javascript:;' class='showUsage homestead yellow'><i class='fa fa-toggle-up' style='color:#fff'></i> Usages</a>";
    	$(".keywordExplain").html( $("."+$(this).data("id")).html()+link ).fadeIn(400);
    	 $(".showUsage").off().on("click",function() { $(".keywordExplain").slideUp(); $(".keysUsages").slideDown();});
    });

    $(".keyword1").click(function() {
    	$(".keysKeyWords").hide();
    	link = "<br/><a href='javascript:;' class='showKeywords homestead yellow'><i class='fa fa-toggle-up' style='color:#fff'></i> Mots Clefs</a>";
    	$(".usageExplain").html( $("."+$(this).data("id")).html()+link ).slideDown();
    	 $(".showKeywords").off().on("click",function() { $(".usageExplain").slideUp(); $(".keysKeyWords").slideDown();});
    });


    $(".btn-main-menu").mouseenter(function(){ 
        $(".menuSection2").addClass("hidden"); 
        if( $(this).data("type") ) 
            $("."+$(this).data("type")+"Section2").removeClass("hidden");
    }).click(function(e) {  
        e.preventDefault(); 
        $('#modalMainMenu').modal("hide"); 
        mylog.warn("***************************************"); 
        mylog.warn("bindLBHLinks",$(this).attr("href")); 
        mylog.warn("***************************************"); 
        var h = ($(this).data("hash")) ? $(this).data("hash") : $(this).attr("href"); 
        urlCtrl.loadByHash( h ); 
    }); 

    $(".tagSearchBtn").click(function(e) {  
        e.preventDefault(); 
        $('#modalMainMenu').modal("hide"); 
        mylog.warn( ".tagSearchBtn",$(this).data("type"),$(this).data("stype"),$(this).data("tags") ); 

        searchObj.types = $(this).data("type").split(",");
        
        if( $(this).data("stype") )
            searchObj.stype = $(this).data("stype");
        else
            searchObj.tags = $(this).data("tags");
        
        urlCtrl.loadByHash($(this).data("app"));
        urlCtrl.afterLoad = function () {     
            //we have to pass by a variable to set the values         
            searchType = searchObj.types;
        
            if( $(this).data("stype") )
                $('#searchSType').val(searchObj.stype);
            else
                $('#searchTags').val(searchObj.tags);
            startSearch();
            searchObj = {};
        }
    }); 

});
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
function showPeopleTalk(step)
{
	// if(!step)
	// 	step = 1;
	// peopleTalkCt = peopleTalkCt+step;
	// if( undefined == peopleTalk[ peopleTalkCt ]  )
	// 	peopleTalkCt = 0;
	// person = peopleTalk[ peopleTalkCt ];

	var html = "";
	$.each(peopleTalk, function(key, person){
	html += '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6 padding-5" style="min-height:430px;max-height:430px;">' +
				'<div class="" style="max-height:240px; overflow:hidden; max-width:100%;">' +
				'<img class="img-responsive img-thumbnail peopleTalkImg" src="'+person.image+'"><br>' +
				'</div>' +
				'<span class="peopleTalkName">'+person.name+'</span><br>' +
				'<span class="peopleTalkProject">'+person.project+'</span><br>' +
				'<span class="peopleTalkComment inline-block">'+person.comment+'</span>' +
			'</div>';
	});

	$("#co-friends").html( html );
	// $(".peopleTalkName").html( person.name );
	// $(".peopleTalkImg").attr("src",person.image);
	// $(".peopleTalkComment").html("<i class='fa fa-quote-left'></i> "+person.comment+"<i class='fa fa-quote-right'></i> ");
	// $(".peopleTalkProject").html( "<a target='_blank' href='"+person.url+"'>"+person.project+"</a>" );

}

function openVideo(){
	$("#videoDocsImg").fadeOut("slow",function() {
		heightCont=$("#form-home-subscribe").outerHeight();
		$(".videoWrapper").height(heightCont);
		$(".videoWrapper").fadeIn('slow');
		 var symbol = $("#autoPlayVideo")[0].src.indexOf("?") > -1 ? "&" : "?";
  		//modify source to autoplay and start video
  		$("#autoPlayVideo")[0].src += symbol + "autoplay=1";
  		if($("#form-home-subscribe").length)
  			$(".videoWrapper .h_iframe").css({"margin-top": ((heightCont-$(".videoWrapper .h_iframe").height())/2)+"px"});
	});
}

var timeoutSearchHome = null;

function showTagOnMap (tag) {

	mylog.log("showTagOnMap",tag);

	var data = { 	 "name" : tag,
		 			 "locality" : "",
		 			 "searchType" : [ "persons" ],
		 			 //"searchBy" : "INSEE",
            		 "indexMin" : 0,
            		 "indexMax" : 500
            		};

        //setTitle("","");$(".moduleLabel").html("<i class='fa fa-spin fa-circle-o-notch'></i> Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>");

		$.blockUI({
			message : "<h1 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i> Recherches des collaborateurs ...</h1>"
		});

		showMap(true);

		$.ajax({
	      type: "POST",
	          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
	          data: data,
	          dataType: "json",
	          error: function (data){
	             mylog.log("error"); mylog.dir(data);
	          },
	          success: function(data){
	            if(!data){ toastr.error(data.content); }
	            else{
	            	mylog.dir(data);
	            	Sig.showMapElements(Sig.map, data);
	            	$.unblockUI();
	            }
	          }
	 	});

	//loadByHash('#project.detail.id.56c1a474f6ca47a8378b45ef',null,true);
	//Sig.showFilterOnMap(tag);
}



function loadLiveNow () {
	mylog.log("loadLiveNow CO2.php");
	var searchParams = {
		"tpl":"/pod/nowList",
		"searchLocalityCITYKEY" : new Array(""),
		"indexMin" : 0, 
		"indexMax" : 30 
	};

    //console.log("communexion : ", communexion);
	if($("#searchLocalityCITYKEY").val() != ""){
		searchParams.searchLocalityCITYKEY = new Array($("#searchLocalityCITYKEY").val());
	}else if(myScopes.communexion.values != null){
		if(typeof myScopes.communexion.values.cityKey != "undefined"){
			searchParams.searchLocalityCITYKEY = new Array(myScopes.communexion.values.cityKey);
		}
	}

	var searchParams = {
		"tpl":"/pod/nowList",
		"searchLocality" : getSearchLocalityObject(true),
		"indexMin" : 0, 
		"indexMax" : 30 
	};
   	
    //console.log("communexion ?", communexion);

    ajaxPost( "#nowList", baseUrl+'/'+moduleId+'/element/getdatadetail/type/0/id/0/dataName/liveNow?tpl=nowList',
					searchParams, function(data) {
					bindLBHLinks();
	} , "html" );
}


</script>