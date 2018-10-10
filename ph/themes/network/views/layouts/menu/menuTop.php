<?php 
if( !empty($me) )
	$profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);

$cssAnsScriptFilesTheme = array(
		// SHOWDOWN
		'/plugins/showdown/showdown.min.js',
		//MARKDOWN
		'/plugins/to-markdown/to-markdown.js',
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme, Yii::app()->request->baseUrl);

$enSavoirPlus = "";
if(  	@$params['enSavoirPlus'] && 
		( 	stripos($params['enSavoirPlus'], "http") !== false || 
			stripos($params['enSavoirPlus'], "https") !== false ) ) 
	$enSavoirPlus = file_get_contents($params["enSavoirPlus"]);

?>
  <style>

#titleMapTop{
	position: fixed;
	top: -20px;
	right: 0px;
	left: 0px;
	height: 0px;
	text-align: center;
	text-align: -webkit-center;
	text-align: -moz-center;
}

#titleMapTop .contentTitleMap{
	width: 500px;
	border-radius: 0px 0px 50px 50px;
	color: white;
	background-color: rgba(40,40,40,0.9)!important;
}

#titleMapTop .contentTitleMap h1{
	font-size: 18px;
	display: inline-block;
}

#titleMapTop .contentTitleLogo{
	height: 65px;
	padding: 10px 0px 0px 0px;
}

#titleMapTop .contentShortInformationMap{
	display:none;
	padding: 10px 20px 1px 20px;
}

#titleMapTop .showHideMoreTitleMap{	
	color: white;
	position: relative;
	bottom: 0px;
	left:-5px;
	width: 55px;
	height: 25px;
	font-size: 35px;
	border-radius: 0px 0px 70px 70px;
	background-color: rgba(40,40,40,0.9) !important;
	cursor: pointer;
}
#titleMapTop .showHideMoreTitleMap i{
	position: relative;
	top: -15px;	
}

.menu-name-profil{
	font-size: 15px;
	font-weight: 300;
	background: transparent;
	border: none;
	height:40px;
  }

.main-top-menu .notifications-count{
	position: absolute;
	left: 46%;
	top: 0px;
	background-color: rgb(217, 83, 79);
}


#breadcrum{
	height: 50px;
	line-height: 30px;
	padding: 10px;
}
.breadcrumAnchor{
	font-size: 16px;
}

.logoMap{
	width: 40px;
	height: 40px;
	margin-top: -5px;
	border-radius: 20px;
	margin-right: 5px;
	display: -webkit-inline-box;
	background-color: white;
}

.logoMapOrigine{
	width: 60px;
	height: 40px;
	margin-top: -5px;
	margin-right: 5px;
	background-color: white;
}

.poweredBy{
	margin-top: 5px;
	font-size: 11px;
	font-weight: 200;
}

</style>

<div class="portfolio-modal modal fade" id="openModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="col-sm-12 container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="modal-header text-dark">
                        <h3 class="modal-title text-center" id="ajax-modal-modal-title">
                            <i class="fa fa-angle-down"></i> <i class="fa " id="ajax-modal-icon"></i> 
                        </h3>
                    </div>
                    
                    <div id="ajax-modal-modal-body" class="modal-body">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 text-center" style="margin-top:50px;margin-bottom:50px;">
            <hr>
            <a href="javascript:" style="font-size: 13px;" type="button" class="" data-dismiss="modal">
            <i class="fa fa-times"></i> <?php echo Yii::t("common","Back") ?>
            </a>
        </div>
    </div>
</div>

<div class="col-xs-12 main-top-menu no-padding"  data-tpl="default.menu.menuTop">
	<?php if(!empty($params['filter'])) { ?>
		<a class="pull-left text-azure"  id="btn-menu-launch">
			<i class="fa fa-filter firstIcon"></i>
			<span style="display:none;float:right;"> <i class="fa fa-filter"></i> <?php echo Yii::t("common","Filters"); ?></span>
		</a>
	<?php } ?>
	<?php if(@$params['skin']["title"]){ ?>
	<div id="titleMapTop">
		<div class="contentTitleMap">
			<div class="contentTitleLogo">
				<h1>
				<?php 
					if(@$params['skin']["logo"]){ 
						if( stripos($params['skin']["logo"], "http") === false)
							$logoURL = $this->module->assetsUrl.'/images/'.$params['skin']["logo"];
						else 
							$logoURL = $params['skin']["logo"];
				?>
					<img src="<?php echo $logoURL ?>"  class="<?php echo (!empty($params['skin']['paramsLogo']['origin']) ? 'logoMapOrigine' : 'logoMap' )?>"/>
				<?php } 
					echo $params['skin']["title"] ?>
				</h1>
			</div>
			<br/>
			<div class="contentShortInformationMap">
				<?php if(!empty($params['skin']["shortDescription"]) && $params['skin']["shortDescription"] != "false"){ ?>
					<span class="shortDescriptionMap padding-10"> 
						<?php echo $params['skin']["shortDescription"]; ?>
					</span>
				<?php } ?>
				<?php if (!empty($params['skin']["docs"]) && !empty($enSavoirPlus) ) { ?><br/>
					<a href="javascript:;" class="tooltips" id="btn-documentation" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("home","More informations"); ?>" alt="<?php echo Yii::t("home","More informations"); ?>" style="color:lightblue;">
						<i class="fa fa-info-circle"></i> <?php echo Yii::t("home","More informations"); ?>
					</a>
				<?php } 

				if (@$params['skin']["displayCommunexion"] && $params['skin']["displayCommunexion"]){ ?>
					<br/>
					<div class="centerButton">
						<?php if (!@Yii::app()->session["userId"]){ ?>
						<button class="btn-top btn btn-default hidden-xs" onclick="showPanel('box-register');">
							<i class="fa fa-plus-circle"></i> 
							<span class="hidden-xs"><?php echo Yii::t("login","Sign Up"); ?></span>
						</button>
						<button class="btn-top btn btn-success hidden-xs" style="margin-right:10px;" onclick="showPanel('box-login');">
							<i class="fa fa-sign-in"></i> 
							<span class="hidden-xs"><?php echo Yii::t("login","Login"); ?></span>
						</button>
						<?php } else { ?>
							<a class="btn-top btn bg-red hidden-xs" href="<?php echo Yii::app()->createUrl('/co2/person/logout?network='.Yii::app()->params['networkParams']); ?>" style="margin-right:10px;" onclick="">
								<i class="fa fa-sign-out"></i> 
								<span class="hidden-xs"><?php echo Yii::t("common","Log Out"); ?></span>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="poweredBy">
					<span>Powered by</span> <a href="https://www.communecter.org" target="_blank" style="color:#0078A8;">@Communecter</a>
				</div>
			</div>
		</div> 
		<div class="showHideMoreTitleMap"><i class="fa fa-angle-down"></i></div>
	</div>
	<?php } ?>

	<button class="btn-menu btn-menu-top bg-white text-azure tooltips pull-right hidden-xs" id="btn-toogle-map"
	data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("common","Map"); ?>" alt="<?php echo Yii::t("common","Map"); ?>">
		<i class="fa fa-map-marker"></i>
	</button>

	<div id="menuTopList">
		<div class="pull-left" style="display:inline-block;">
			<?php if(isset($params['skin']['breadcrum']) && $params['skin']['breadcrum']) { ?>
				<div id="breadcrum">
					<a href="javascript:;" onclick="breadcrumGuide(0)" class="breadcrumAnchor text-dark" style="font-size:20px !important;"><?php echo Yii::t("common","List"); ?></a>
				</div>
		  <?php } ?>
		</div>

		<div class="hidden menu-info-profil">
			<div class="pull-right">
			<?php 
			if(isset($params["skin"]['displayCommunexion']) && $params["skin"]['displayCommunexion']){
				if( isset( Yii::app()->session['userId']) ){ ?>
					<div class="dropdown pull-right hidden-xs">
						<button class="dropdown-toggle menu-name-profil text-dark" data-toggle="dropdown" onclick="javascript:openMenuSmall();">
							<img class="img-circle" id="menu-thumb-profil" width="34" height="34" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
						</button>
					</div>          
				<?php 
				}else{ ?>
					<button class="btn-top btn btn-success  hidden-xs" onclick="showPanel('box-register');"><i class="fa fa-plus-circle"></i> <span class="hidden-sm hidden-md hidden-xs"><?php echo Yii::t("login","Sign Up"); ?></span></button>
					<button class="btn-top btn bg-red  hidden-xs" style="margin-right:15px;" onclick="showPanel('box-login');"><i class="fa fa-sign-in"></i> <span class="hidden-sm hidden-md hidden-xs"><?php echo Yii::t("login","Login"); ?></span></button> <?php echo Yii::t("common","Notifications"); ?>
			<?php } 
			} 

			/*if(isset($params["skin"]['displayNotifications']) && $params["skin"]['displayNotifications'] && @Yii::app()->session['userId']){ ?>
				<button class="menu-button btn-menu btn-menu-notif tooltips text-dark hidden-xs" 
				data-toggle="tooltip" data-placement="left" title="<?php echo Yii::t("common","Notifications"); ?>" alt="<?php echo Yii::t("common","Notifications"); ?>">
					<i class="fa fa-bell"></i>
					<span class="notifications-count topbar-badge badge badge-danger animated bounceIn"><?php count($this->notifications); ?></span>
				</button>
			<?php }*/ ?>
			</div>
		</div>

		<div class="pull-right navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php 
                    if( isset( Yii::app()->session['userId']) ){
                      $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
                      $countNotifElement = ActivityStream::countUnseenNotifications(Yii::app()->session["userId"], Person::COLLECTION, Yii::app()->session["userId"]);
                ?> 
                     <!-- #page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?> -->
                    <a  href="#page.type.citoyens.id.<?php echo Yii::app()->session['userId']; ?>"
                        class="menu-name-profil lbh text-dark pull-right" 
                        data-toggle="dropdown">
                            <small class="hidden-xs hidden-sm margin-left-10" id="menu-name-profil">
                                <?php echo @$me["name"] ? $me["name"] : @$me["username"]; ?>
                            </small> 
                            <img class="img-circle" id="menu-thumb-profil" 
                                 width="40" height="40" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
                    </a>

                    <div class="dropdown pull-right" id="dropdown-user">
                        <div class="dropdown-main-menu">
                            <ul class="dropdown-menu arrow_box">
                                <li class="text-left">
                                    <a href="#page.type.<?php echo Person::COLLECTION ?>.id.<?php echo Yii::app()->session["userId"] ?>" class="lbh bg-white">
                                        <i class="fa fa-home"></i> <?php echo Yii::t("common","My page") ?>
                                    </a>
                                </li>
                                <?php if(isset($params["skin"]['displayNotifications']) && $params["skin"]['displayNotifications'] && @Yii::app()->session['userId']){ ?>
                                <li class="text-admin visible-xs">
                                    <a href="#page.type.<?php echo Person::COLLECTION ?>.id.<?php echo Yii::app()->session["userId"] ?>.view.notifications" class="lbh bg-white">
                                        <i class="fa fa-bell"></i> <?php echo Yii::t("common", "My notifications") ; ?>
                                        <span class="notifications-count topbar-badge badge animated bounceIn 
                                            <?php if(!@$countNotifElement || (@$countNotifElement && $countNotifElement=="0")) 
                                            echo 'badge-transparent hide'; else echo 'badge-success'; ?>"
                                        >
                                        <?php echo @$countNotifElement ?>
                                        </span>
                                    </a>
                                </li>
                                <?php } ?>
                                <li class="text-admin">
                                    <a href="#page.type.<?php echo Person::COLLECTION ?>.id.<?php echo Yii::app()->session["userId"] ?>.view.settings" class="lbh bg-white">
                                        <i class="fa fa-cogs"></i> <?php echo Yii::t("common", "My parameters") ; ?>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li class="text-admin dropdown-submenu dropdown-menu-left">
                                    <a href="javascript:;" class="bg-white">
                                        <i class="fa fa-language"></i> <?php echo Yii::t("common", "Languages") ; ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                      <li><a href="javascript:;" onclick="setLanguage('en')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/en.png"/><?php echo Yii::t("common","English") ?></a></li>
                                      <li><a href="javascript:;" onclick="setLanguage('fr')"><img src="<?php echo Yii::app()->getRequest()->getBaseUrl(true); ?>/images/flags/fr.png"/><?php echo Yii::t("common","French") ?></a></li>
                                    </ul>
                                </li>
                                <?php if( Yii::app()->session["userIsAdmin"] ) { ?>
                                    <li class="text-admin">
                                        <a href="#admin" class="lbh bg-white">
                                            <i class="fa fa-user-secret"></i> <?php echo Yii::t("common", "Admin") ; ?>
                                        </a>
                                    </li>
                                <?php }else if( Yii::app()->session[ "userIsAdminPublic" ] ) { ?>
                                    <li class="text-admin">
                                        <a href="#adminpublic" class="lbh bg-white">
                                            <i class="fa fa-user-secret"></i> <?php echo Yii::t("common", "Admin public") ; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li role="separator" class="divider visible-xs"></li>
                                <li class="text-left">
                                    <a href="<?php echo Yii::app()->createUrl('/co2/person/logout'); ?>" 
                                        class="bg-white letter-red logout">
                                        <i class="fa fa-sign-out"></i> <?php echo Yii::t("common", "Log Out") ; ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <?php if(isset($params["skin"]['displayNotifications']) && $params["skin"]['displayNotifications'] && @Yii::app()->session['userId']){ ?>
                    <!-- <button class="menu-button btn-menu btn-menu-notif text-dark pull-right hidden-xs" 
                          data-toggle="tooltip" data-placement="bottom" title="Notifications" alt="Notifications">
                      <i class="fa fa-bell"></i>
                      <span class="notifications-count topbar-badge badge animated bounceIn 
                              <?php if(!@$countNotifElement || (@$countNotifElement && $countNotifElement=="0")) 
                              //echo 'badge-transparent hide'; else echo 'badge-success'; ?>">
                            <?php echo @$countNotifElement ?>
                        </span>
                    </button> -->
                    <?php } ?>
                <?php } else { ?>
                    
                    <li class="pull-right">
                        <button class="letter-green font-montserrat btn-menu-connect margin-left-10" 
                                    data-toggle="modal" data-target="#modalLogin">
                                <span><i class="fa fa-sign-in"></i> <span class="hidden-xs hidden-sm"><?php echo Yii::t("login", "LOG IN") ?></span>
                            </button>
                    </li>

                <?php } ?>
            </ul>

        </div>
	</div>
	<div class="dropdown pull-left hidden-xs"></div>
</div>


<div class="modal fade" role="dialog" id="modal-confidentiality">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-cog"></i> <?php echo Yii::t("home","More informations"); ?></h4>
			</div>
			<div class="modal-body" id="savoirBody"><?php echo $enSavoirPlus ; ?></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-confidentialitySettings" data-dismiss="modal" aria-label="Close" >OK</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	jQuery(document).ready(function() {
		$("#btn-documentation").on("click", function(){
	        enSavoirPlus();
	        mylog.log("confidentiality");
	        $("#modal-confidentiality").modal("show");        
	    });
	});

	function enSavoirPlus(){
		mylog.log("enSavoirPlus");
		var text = $("#savoirBody").html();
		mylog.log("text",text);
		var res = dataHelper.markdownToHtml(text);
		mylog.log("res",res);
		$("#savoirBody").html(res);
	}
</script>

