

<?php  
HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/menuSmall.css'), Yii::app()->theme->baseUrl); 

if (isset(Yii::app()->session['userId']) ) {
		$me = Person::getById(Yii::app()->session['userId']);
          $profilMediumImageUrl = Element::getImgProfil($me, "profilMediumImageUrl", $this->module->assetsUrl);
      }
?>

<div class="hide menuSmall">
	<div class="menuSmallMenu">
		<div class="col-md-3 col-sm-3 col-xs-12 center no-padding margin-bottom-15">
		<?php	if(!isset(Yii::app()->session['userId'])){ ?>
			<?php if(@$params["displayCommunexion"] && $params["displayCommunexion"]){ ?>
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
			<?php } ?>
		<?php }  else { ?>
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
		    <?php if(isset($me)) if(Role::isSuperAdmin($me['roles'])){?>
			<div class="col-xs-12 center no-padding">
			    <a class="btn bg-dark-red lbh padding-5" href="#admin.index">
			        <i class="fa fa-user-secret" style="font-size: 1em!important;"></i> 
			        Admin
			    </a>
		    </div>
			<?php } ?>	
			<?php if(isset($params["skin"]['displayNotifications']) && $params["skin"]['displayNotifications']){ ?>
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
			<?php } ?>
			<?php if(@$params["skin"]["displayCommunexion"] && $params["skin"]["displayCommunexion"]){ ?>
		    <div class="col-xs-12 hidden-xs center no-padding">
			    <a class="btn bg-red padding-5" 
			    	href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout?network='.$params["name"]); ?>">
			        <i class="fa fa-sign-out"></i>
			        <br><?php echo Yii::t("person","Sign out"); ?>
			    </a>
		    </div>
		    <?php } ?>
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
		<?php }  ?>	
			<div class="col-xs-12 hidden-xs center no-padding">
			    <a class="btn bg-white padding-5" 
			    	href="<?php echo Yii::app()->createUrl('/'.$this->module->id); ?>" target="_blank">
			        <i class="fa fa-sign-out"></i>
			        <br><span class="text-red">Commune<span class="text-dark">cter</span></span>
			    </a>
		    </div>
		</div>
	  	<div class="col-md-9 col-sm-9 col-xs-12 no-padding">			

			<div class="col-md-12 col-sm-12 padding-15">
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
				<?php if(isset(Yii::app()->session['userId'])){ ?>
					<div class="col-md-12 col-sm-12  col-xs-12 no-padding">
						<hr style="border-top: 1px solid transparent; margin:7px;">
						<h2 class="homestead text-white">
							<!-- <i class="fa fa-plus-circle"></i>  -->Explorer et contribuer 
							<i class="fa fa-angle-down"></i> 
						</h2>
					</div>
					<?php if(isset($params['add']['person']) && $params['add']['person']) { ?>
					<div class="col-xs-6 col-sm-6 col-md-6 center padding-5">
						<a href="#person.invite" class="lbh btn bg-yellow btn-element">

							<i class="fa fa-user"></i><br>
							<span class="lbl-btn-menu-name-add">Citoyens</span>
						</a>						
					</div>
					<?php } ?>
					<?php if(isset($params['add']['organization']) && $params['add']['organization']) { ?>
					<div class="col-xs-6 col-sm-6 col-md-6 center padding-5">

						<a href="javascript:dyFObj.openForm('organization')" class="btn bg-green btn-element">

							<i class="fa fa-group"></i><br>
							<span class="lbl-btn-menu-name-add">
								Organisations
							</span>
						</a>
					</div>
					<?php } ?>
					<?php if(isset($params['add']['project']) && $params['add']['project']) { ?>
					<div class="col-xs-6 col-sm-6 col-md-6 center padding-5">
						<a href="javascript:dyFObj.openForm('project')" class="btn bg-purple btn-element">
							<i class="fa fa-lightbulb-o"></i><br>
							<span class="lbl-btn-menu-name-add">
								Projets
							</span>
						</a>
					</div>
					<?php } ?>
					<?php if(isset($params['add']['event']) && $params['add']['event']) { ?>
					<div class="col-xs-6 col-sm-6 col-md-6 center padding-5">
						<a href="javascript:dyFObj.openForm('event')" class="btn bg-orange btn-element">
							<i class="fa fa-calendar"></i><br>
							<span class="lbl-btn-menu-name-add">
								Événements
							</span>
						</a>
					</div>
					<?php } ?>
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
					<a href="#default.view.page.index.dir.docs?network=<?php echo $params["name"]; ?>" 
						class="btn bg-grey lbh menu-button btn-menu btn-menu-notif tooltips text-white" 
			            data-toggle="tooltip" data-placement="left" title="Documentation">
				        <i class="fa fa-file"></i> 
				        <br/>Documentation
				    </a>
			    </div>
			    
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