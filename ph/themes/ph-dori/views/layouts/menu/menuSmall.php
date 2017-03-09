

<?php  
HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/menuSmall.css'), Yii::app()->theme->baseUrl); 

if (isset(Yii::app()->session['userId']) && !empty($me)) {
  $profilMediumImageUrl = Element::getImgProfil($me, "profilMediumImageUrl", $this->module->assetsUrl);
}
?>

<div class="hide menuSmall">
	<div class="menuSmallMenu">
		<?php if(!isset(Yii::app()->session['userId'])){ ?>
		<div class="col-md-3 col-sm-3 col-xs-12 center no-padding margin-bottom-15">
			<div class="col-xs-12 visible-xs margin-top-15"> </div>
			<div class="col-md-12 col-sm-12 col-xs-6">
				<a class="btn bg-green" href="javascript:;" onclick="showPanel('box-login');$.unblockUI();">
					<i class="fa fa-sign-in"></i>
					</br>Se Connecter
				</a>
			</div> 
			<div class="col-md-12 col-sm-12 col-xs-6">
				<a class="btn bg-grey" href="javascript:;" onclick="showPanel('box-register');$.unblockUI();">
					<i class="fa fa-plus-circle"></i>
					</br>S'inscrire
				</a>
			</div> 
		</div> 
		<?php }  else { ?>

		

		<div class="col-md-3 col-sm-3 col-xs-12 center margin-top-15 margin-bottom-5">
			<div class="col-md-12 col-sm-12 no-padding" id="menu-my-profil">
				<!-- <span class="text-white label text-bold" style="font-size:16px !important;"></span> -->
				<div id="img-my-profil">
					<a class="no-border lbh" href="#person.detail.id.<?php echo Yii::app()->session['userId']?>" >
						<img class="img-responsive thumbnail" id="menu-small-thumb-profil" 
						src="<?php echo $profilMediumImageUrl; ?>" alt="image">
						<span id="menu-my-profil-text"><?php echo $me["name"]; ?></span>
					</a>
				</div>
			</div>

			<div class="col-xs-12 center no-padding">
			    <a class="btn bg-dark lbh padding-5" href="#element.aroundme.type.person.id.<?php echo Yii::app()->session['userId'] ?>.radius.5000">
			        <i class="fa fa-crosshairs" style="font-size: 1em!important;"></i> 
			        Autour de moi
			    </a>
		    </div>
			
		    <?php if(isset($me)) if(Role::isSuperAdmin($me['roles'])){?>
			<div class="col-xs-12 center no-padding">
			    <a class="btn bg-dark-red lbh padding-5" href="#admin.index">
			        <i class="fa fa-user-secret" style="font-size: 1em!important;"></i> 
			        Admin
			    </a>
		    </div>
			<?php } ?>
			<?php if(isset($me)) if(Role::isSourceAdmin($me['roles']) || Role::isSuperAdmin($me['roles'])){?>
			<div class="col-xs-12 center no-padding">
			    <a class="btn bg-dark-red lbh padding-5" href="#adminpublic.index">
			        <i class="fa fa-user-secret" style="font-size: 1em!important;"></i> 
			        Admin Public
			    </a>
		    </div>
			<?php } ?>		
			<div class="col-xs-6 col-sm-12 center padding-5 visible-xs">
				<a class="btn bg-dark padding-5" href="javascript:$('.btn-menu-notif').trigger('click');$.unblockUI();">
			        <i class="fa fa-bell" style="font-size: 1em!important; margin-right: -10px;"></i> 
			        <span class="notifications-count topbar-badge badge badge-danger animated bounceIn" 
		        		  style="position:relative; top:-2px; left:unset;">
		        		<?php count($this->notifications); ?>
			        </span>
			        Notifications
			    </a>
			</div>
		    <div class="col-xs-6 col-sm-12 center padding-5">
			    <a class="btn bg-dark lbh padding-5" href="#news.index.type.citoyens.id.<?php echo Yii::app()->session['userId'] ?>.viewer.<?php echo Yii::app()->session['userId']?>"  >
			        <i class="fa fa-newspaper-o" style="font-size: 1em!important;"></i> 
			        Mon journal
			    </a>
		    </div>
		    <div class="col-xs-12 center no-padding hidden-xs">
			    <a class="btn bg-dark padding-5" href="javascript:smallMenu.openAjax(baseUrl+'/'+moduleId+'/person/directory?tpl=json','Mon répertoire','fa-book','red')">
			        <i class="fa fa-book" style="font-size: 1em!important;"></i> 
			        Mon répertoire
			    </a>
		    </div>
		    <div class="col-xs-12 center no-padding hidden-xs">
			    <a class="btn bg-dark lbh padding-5" 
			    	href="#rooms.index.type.citoyens.id.<?php echo Yii::app()->session['userId']?>">
			        <i class="fa fa-comments" style="font-size: 1em!important;"></i> 
			        <i class="fa fa-gavel" style="font-size: 1em!important;"></i> 
			        <i class="fa fa-cogs" style="font-size: 1em!important;"></i> 
			        <br>Coopération
			    </a>
		    </div>


		    <div class="col-xs-12 hidden-xs center no-padding">
			    <a class="btn bg-red padding-5" 
			    	href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>">
			        <i class="fa fa-sign-out"></i>
			        <br><?php echo Yii::t("person","Sign out"); ?>
			    </a>
		    </div>
<!-- 
		    <?php if(isset(Yii::app()->session['userId']) && isset($me["geo"])){ ?>
				<?php // AROUND ME // ?>
				<a href="#element.aroundme.type.person.id.<?php echo Yii::app()->session['userId'] ?>.radius.5000" id="menu-btn-around-me"
						class="lbh menu-button-left glass-hover">
						<i class="fa fa-crosshairs tooltips"
							data-toggle="tooltip" data-placement="right" title="Autour de moi"></i> 
						<span class="lbl-btn-menu">Autour de moi</span>
				</a>
				<hr>
			<?php } ?> -->
			   
		</div>
		<?php } ?>	
		

	  	<div class="col-md-9 col-sm-9 col-xs-12 no-padding">

	  		<div class="col-md-12 col-sm-12">
				<div class="col-md-4 col-sm-4 padding-5 center">
					<a class="btn bg-azure lbh " href="#default.live" >
					<i class="fa fa-heartbeat tooltips" data-toggle="tooltip" data-placement="bottom" alt="Toutes l'actualités"></i> <br class="hidden-xs">Live</a>
				</div>
				<div class="col-md-8 center hide-communected padding-5">
					<a class="btn bg-red" href="javascript:;" onclick="communecterUser()">
						<i class="fa fa-university"></i>
						</br>Communectez-moi
					</a>
				</div> 
				<div class="col-md-4 col-sm-4 col-xs-6 padding-5 center visible-communected">
					<a class="btn bg-red lbh padding-5" 
						href="#city.detail.insee.<?php 
							 if(@$myCity) echo $myCity["insee"]; ?>.postalCode.<?php  if(@$myCity) echo $myCity["cp"]; 
							?>" id="btn-menuSmall-mycity">
						<i class="fa fa-university"></i> <br class="hidden-xs">Ma commune
					</a>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-6 padding-5 center visible-communected">
					<a class="btn bg-red lbh padding-5" 
						href="#rooms.index.type.cities.id.<?php if(@$myCity) echo City::getUnikey($myCity); ?>" 
						id="btn-menuSmall-citizenCouncil">
						<i class="fa fa-connectdevelop"></i><br class="hidden-xs">
						<span class="hidden-xs">Mon c</span><span class="hidden-sm hidden-md hidden-lg">C</span>onseil citoyen
					</a>
				</div>
				<div class="col-xs-12 padding-5 center no-padding visible-xs">
				    <a class="btn bg-dark lbh padding-5" 
				    	href="#rooms.index.type.citoyens.id.<?php echo Yii::app()->session['userId']?>">
				        <i class="fa fa-comments" style="font-size: 1em!important;"></i> 
				        <i class="fa fa-gavel" style="font-size: 1em!important;"></i> 
				        <i class="fa fa-cogs" style="font-size: 1em!important;"></i> 
				        <br>Coopération
				    </a>
			    </div>
				<div class="col-xs-12 padding-5 center no-padding visible-xs">
				    <a class="btn bg-red lbh padding-5" 
				    	href="#default.directory?type=cities">
				        <i class="fa fa-search" style="font-size: 1em!important;"></i> 
				        <br>Rechercher une commune
				    </a>
			    </div>
				<!-- <div class="col-md-4 col-sm-4 center">
			    	<a class="btn bg-azure lbh" href="#default.directory" >
			    	<i class="fa fa-search"></i> <br class="hidden-xs">Recherche</a>
			    </div>
				<div class="col-md-4 col-sm-4 center">
					<a class="btn bg-azure lbh" href="#default.agenda"  >
					<i class="fa fa-calendar"></i> <br class="hidden-xs">Agenda</a>
				</div> -->
			</div>
			

			<div class="col-md-12 col-sm-12 padding-15 menuSmallBtns">
				

				<!-- <div class="col-md-6 col-sm-6 col-xs-12 center visible-communected">
					<a class="btn bg-red lbh" 
						href="#city.detail.insee.<?php 
							 if(@$myCity) echo $myCity["insee"]; ?>.postalCode.<?php  if(@$myCity) echo $myCity["cp"]; 
							?>" id="btn-menuSmall-mycity">
						<i class="fa fa-university"></i> <br class="hidden-xs">Ma commune
					</a>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 center visible-communected">
					<a class="btn bg-red lbh" 
						href="#rooms.index.type.cities.id.<?php if(@$myCity) echo City::getUnikey($myCity); ?>" 
						id="btn-menuSmall-citizenCouncil">
						<i class="fa fa-connectdevelop"></i><br class="hidden-xs">
						<span class="hidden-xs">Mon c</span><span class="hidden-sm hidden-md hidden-lg">C</span>onseil citoyen
					</a>
				</div> -->

				<?php $col = "6"; if(isset(Yii::app()->session['userId'])) $col="4"; ?>

					<div class="col-md-12 col-sm-12  col-xs-12 no-padding">
						<hr style="border-top: 1px solid transparent; margin:7px;">
						<h2 class="homestead text-white">
							<!-- <i class="fa fa-plus-circle"></i>  -->Explorer et contribuer 
							<i class="fa fa-angle-down"></i> 
						</h2>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-<?php echo $col; ?> center padding-5">
						<a href="#default.directory?type=persons" class="lbh btn bg-yellow btn-element">

							<i class="fa fa-user"></i><br>
							<span class="lbl-btn-menu-name-add">Citoyens</span>
						</a>
						<?php if(@Yii::app()->session['userId']){ ?>
						<a href="#person.invite" class="lbh badge btn-add bg-yellow"><i class="fa fa-plus-circle"></i></a>
						<?php } ?>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-<?php echo $col; ?> center padding-5">

						<a href="#default.directory?type=organizations" class="lbh btn bg-green btn-element">

							<i class="fa fa-group"></i><br>
							<span class="lbl-btn-menu-name-add">
								Organisations
								<!-- <span class="hidden-xs">Une o</span><span class="hidden-sm hidden-md hidden-lg">O</span>rganisation -->
							</span>
						</a>
						<?php if(@Yii::app()->session['userId']){ ?>
						<a href="javascript:elementLib.openForm('organization')" class="badge btn-add bg-green"><i class="fa fa-plus-circle"></i></a>
						<?php } ?>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-<?php echo $col; ?> center padding-5">

						<a href="#default.directory?type=projects" class="lbh btn bg-purple btn-element">

							<i class="fa fa-lightbulb-o"></i><br>
							<span class="lbl-btn-menu-name-add">
								<!-- <span class="hidden-xs">Un p</span><span class="hidden-sm hidden-md hidden-lg">P</span>rojet -->
								Projets
							</span>
						</a>
						<?php if(@Yii::app()->session['userId']){ ?>
						<a href="javascript:elementLib.openForm('project')" class="badge btn-add bg-purple"><i class="fa fa-plus-circle"></i></a>
						<?php } ?>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-<?php echo $col; ?> center padding-5">

						<a href="#default.directory?type=events" class="lbh btn bg-orange btn-element">

							<i class="fa fa-calendar"></i><br>
							<span class="lbl-btn-menu-name-add">
								<!-- <span class="hidden-xs">Un é</span><span class="hidden-sm hidden-md hidden-lg">É</span>vénement -->
								Événements
							</span>
						</a>
						<?php if(@Yii::app()->session['userId']){ ?>
						<a href="javascript:elementLib.openForm('event')" class="badge btn-add bg-orange"><i class="fa fa-plus-circle"></i></a>
						<?php } ?>
					</div>

					<?php if(isset(Yii::app()->session['userId'])){ ?>
						<div class="col-xs-6 col-sm-6 col-md-4 center padding-5 showIfCommucted <?php if(!@Yii::app()->session['user'] || !@Yii::app()->session['user']['postalCode'] )echo "hidden"; ?>">

							<a href="#default.directory?type=vote" class="lbh btn bg-azure btn-element">

								<i class="fa fa-lightbulb-o"></i><br>
								<span class="lbl-btn-menu-name-add">
									<!-- <span class="hidden-xs">Un p</span><span class="hidden-sm hidden-md hidden-lg">P</span>rojet -->
									Propositions
								</span>
							</a>
							<a href="javascript:elementLib.openForm('entry')" class="badge btn-add bg-azure"><i class="fa fa-plus-circle"></i></a>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-4 center padding-5 showIfCommucted <?php if(!@Yii::app()->session['user'] || !@Yii::app()->session['user']['postalCode'] )echo "hidden"; ?>">

							<a href="#default.directory?type=actions" class="lbh btn bg-lightblue2 btn-element">

								<i class="fa fa-calendar"></i><br>
								<span class="lbl-btn-menu-name-add">
									<!-- <span class="hidden-xs">Un é</span><span class="hidden-sm hidden-md hidden-lg">É</span>vénement -->
									Actions
								</span>
							</a>
							<a href="javascript:elementLib.openForm('action')" class="badge btn-add bg-lightblue2"><i class="fa fa-plus-circle"></i></a>
						</div>
						<div class="col-xs-12 padding-5 center no-padding hidden-xs">
						    <a class="btn bg-red lbh padding-5" 
						    	href="#default.directory?type=cities">
						        <i class="fa fa-search" style="font-size: 1em!important;"></i> 
						         Rechercher une commune
						    </a>
					    </div>
					<?php } ?>

				<div class="col-xs-12  no-padding">
					<hr style="border-top: 1px solid transparent; margin:7px;">
					<h2 class="homestead text-white">
						Comprendre<?php if(isset(Yii::app()->session['userId'])) echo " et aider"; ?>
						<i class="fa fa-angle-down"></i> 
					</h2>
				</div>
				<?php if(isset(Yii::app()->session['userId'])) $colDoc="6"; else $colDoc="6"; ?>
				<div class="col-xs-<?php echo $colDoc;?> col-sm-<?php echo $colDoc;?> col-md-<?php echo $colDoc;?> center padding-5">
					<a href="#default.view.page.index.dir.docs" 
						class="btn bg-grey lbh menu-button btn-menu btn-menu-notif tooltips text-white" 
			            data-toggle="tooltip" data-placement="left" title="Documentation">
				        <i class="fa fa-file"></i> 
				        <br/>Documentation
				    </a>
			    </div>
			   <?php //if(isset(Yii::app()->session['userId'])){ ?>
			    <div class="col-xs-6 center padding-5">
					<a  href="#news.index.type.pixels" 
						class="btn bg-grey lbh menu-button btn-menu btn-menu-notif tooltips text-white" 
			            data-toggle="tooltip" data-placement="left" title="Signaler un bug">
				        <i class="fa fa-bullhorn"></i> 
				        <br/>Signaler un bug
				    </a>
			    </div>
			    <?php //} ?>

				<?php if(isset(Yii::app()->session['userId'])){ ?>
				<div class="col-xs-12  no-padding">
					<hr style="border-top: 1px solid transparent; margin:7px;">
					<h2 class="homestead text-white">
						Mes Collections
						<i class="fa fa-angle-down"></i> 
					</h2>
				</div>

			    <div class="col-xs-6 center padding-5">
					<a href="javascript:collection.crud()" 
						class="btn bg-grey menu-button btn-menu btn-menu-notif tooltips text-white" 
			            data-toggle="tooltip" data-placement="left" title="Ajouter une collection">
				        <i class="fa fa-plus"></i> 
				        <br/>Ajouter une collection
				    </a>
			    </div>

			    <?php 
			    if (@$me["collections"])
			    {
			    foreach (@$me["collections"] as $col => $list) 
			    	{ ?>
					<div class="col-xs-6 center padding-5 collection">
						<a href="javascript:smallMenu.openAjax(baseUrl+'/'+moduleId+'/collections/list/col/<?php echo $col ?>','<?php echo $col ?>','fa-folder-open','yellow',null,null,function(){ $('.menuSmallTools').removeClass('hide');})" 
							class="btn bg-grey menu-button btn-menu btn-menu-notif tooltips text-white" 
				            data-toggle="tooltip" data-placement="left" title="<?php echo $col ?>">
					        <i class="fa fa-folder-open  text-yellow"></i> 
					        <br/><?php echo $col." (".count($list).")" ?>
					    </a>
				    </div>
			    <?php } 
			    } } ?>

			    
			</div>
			
	  	</div>

	  	<?php if(isset(Yii::app()->session['userId'])){ ?>
	  	<div class="col-top-xs visible-xs">
			<a class="btn bg-red padding-5 pull-right" 
		    	href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>">
		        <i class="fa fa-sign-out"></i>
		    </a> 
			<!-- <a class="btn bg-white padding-5 pull-right" 
		    	href="">
		        <i class="fa fa-bell"></i>
		    </a>  -->
		</div>		
		<?php } ?>

		</div>
	</div>
</div>