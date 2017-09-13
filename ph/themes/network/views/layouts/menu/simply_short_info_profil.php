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
?>
  <style>

#titleMapTop{
	position: fixed;
	top: -20px;
	right: 0px;
	left: 0px;
	height: 50px;
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

<div class="col-xs-12 main-top-menu no-padding"  data-tpl="default.menu.menuTop">

	<a class="pull-left text-white"  id="btn-menu-launch">
		<i class="fa fa-filter firstIcon"></i>
		<span style="display:none;float:right;"> <i class="fa fa-filter"></i> Filtres</span>
	</a>
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
			<div class="contentShortInformationMap">
				<?php if(@$params['skin']["shortDescription"]){ ?>
					<span class="shortDescriptionMap padding-10"> 
						<?php echo $params['skin']["shortDescription"]; ?>
					</span>
				<?php } ?>
				<?php if (@$params['skin']["docs"] && $params['skin']["docs"]){ ?><br/>
					<a href="javascript:;" class="tooltips" id="btn-documentation" data-toggle="tooltip" data-placement="bottom" title="Lire la documentation" alt="Lire la documentation" style="color:lightblue;">
						<i class="fa fa-info-circle"></i> En savoir plus
					</a>
				<?php } 

				if (@$params['skin']["displayCommunexion"] && $params['skin']["displayCommunexion"]){ ?>
					<br/>
					<div class="centerButton">
						<?php if (!@Yii::app()->session["userId"]){ ?>
						<button class="btn-top btn btn-default hidden-xs" onclick="showPanel('box-register');">
							<i class="fa fa-plus-circle"></i> 
							<span class="hidden-sm hidden-md hidden-xs">S'inscrire</span>
						</button>
						<button class="btn-top btn btn-success hidden-xs" style="margin-right:10px;" onclick="showPanel('box-login');">
							<i class="fa fa-sign-in"></i> 
							<span class="hidden-sm hidden-md hidden-xs">Se connecter</span>
						</button>
						<?php } else { ?>
							<a class="btn-top btn bg-red hidden-xs" href="/pixelhumain/ph/co2/person/logout?network=<?php echo $params["name"] ?>" style="margin-right:10px;" onclick="">
								<i class="fa fa-sign-out"></i> 
								<span class="hidden-sm hidden-md hidden-xs">Déconnexion</span>
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

	<button class="btn-menu btn-menu-top bg-white text-azure tooltips pull-right" id="btn-toogle-map"
	data-toggle="tooltip" data-placement="bottom" title="Carte" alt="Carte">
		<i class="fa fa-map-marker"></i>
	</button>

	<div id="menuTopList">
		<div class="pull-left" style="display:inline-block;">
			<?php if(isset($params['skin']['breadcrum']) && $params['skin']['breadcrum']) { ?>
				<div id="breadcrum">
					<a href="javascript:;" onclick="breadcrumGuide(0)" class="breadcrumAnchor text-dark" style="font-size:20px !important;">Liste</a>
				</div>
		  <?php } ?>
		</div>

		<div class="menu-info-profil">
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
					<button class="btn-top btn btn-success  hidden-xs" onclick="showPanel('box-register');"><i class="fa fa-plus-circle"></i> <span class="hidden-sm hidden-md hidden-xs">S'inscrire</span></button>
					<button class="btn-top btn bg-red  hidden-xs" style="margin-right:15px;" onclick="showPanel('box-login');"><i class="fa fa-sign-in"></i> <span class="hidden-sm hidden-md hidden-xs">Se connecter</span></button> 
			<?php } 
			}

			if(isset($params["skin"]['displayNotifications']) && $params["skin"]['displayNotifications'] && @Yii::app()->session['userId']){ ?>
				<button class="menu-button btn-menu btn-menu-notif tooltips text-dark hidden-xs" 
				data-toggle="tooltip" data-placement="left" title="Notifications" alt="Notifications">
					<i class="fa fa-bell"></i>
					<span class="notifications-count topbar-badge badge badge-danger animated bounceIn"><?php count($this->notifications); ?></span>
				</button>
			<?php } ?>
			</div>
		</div>
	</div>
	<div class="dropdown pull-left hidden-xs"></div>
</div>
<?php 
$enSavoirPlus = "";
if(  	@$params['enSavoirPlus'] && 
		( 	stripos($params['enSavoirPlus'], "http") !== false || 
			stripos($params['enSavoirPlus'], "https") !== false ) ) 
	$enSavoirPlus = file_get_contents($params["enSavoirPlus"]);

?>

<div class="modal fade" role="dialog" id="modal-confidentiality">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-cog"></i> En savoir plus</h4>
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

