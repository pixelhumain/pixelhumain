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

  .add-title{
    margin-left:20px;
  }

  .menu-info-simply{
    /*margin-top: 8px;*/
    padding-right: 0px;
    position: relative;
    float: right;
    width:100%;
    margin-right: 5px;
  }

  .menu-info-simply.main{
    right:60px;
    top:10px;
    position: absolute;

    width: 100%;
  }
  /*.menu-info-simply.main{
    right:65px;
  }*/
  .menu-icon-profil{
    padding: 2px 15px 0px 7px;
  }
  .menu-name-profil{
    font-size: 15px;
    font-weight: 300;
    background: transparent;
    border: none;
    height:40px;
  }

  .main-top-menu .menu-info-simply{
    margin-top: 8px;
    padding-right: 0px;
    position: relative;
    float: right;
  }

  .menu-info-simply .dropdown-menu{
    top: 114%;
    margin-right: -15px;
    border-radius: 0px 0px 4px 4px;
    /*border-top-color: transparent;*/
  }
  .menu-info-simply.main .dropdown-menu{
    top: 114%;
    margin-right: -5px;
    border-radius: 0px 0px 4px 4px;
    /*border-top-color: transparent;*/
  }

  .main-top-menu .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus{
    background-color: #d2e7f2;
  }
  .main-top-menu .dropdown-menu .fa{
    width:20px;
    text-align: center;
  }

  .main-top-menu .notifications-count{
    position: absolute;
    left: 46%;
    top: 0px;
    background-color: rgb(217, 83, 79);
  }

  .main-top-menu .input-global-search{
    /*float: right;*/
    margin-top: -2px;
    margin-right: 9px;
    width: 240px;
    height: 38px;
    border: 1px solid rgba(128, 128, 128, 0.46) !important;
    /*box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    -webkit-box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    -o-box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    box-shadow: 0px 3px 10px 0px rgba(66, 66, 66, 0.37) !important;*/
    padding: 3px 20px;
    font-size: 16px;
    border-radius: 0px !important;
    background-color: #FFF;
  }
  .main-top-menu .input-global-search:focus{
    box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    -webkit-box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    -o-box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    box-shadow: 0px 3px 10px 0px rgba(66, 66, 66, 0.37) !important;
  } 

  .main-top-menu .dropdown-result-global-search{
    position: fixed;
    top: 51px;
    right: 9.2%;
    width: 350px;
    max-height: 80%;
    overflow-y: auto;
    background-color: white;
    padding-top:10px;
    padding-bottom:10px;
    border-radius: 0px 0px 10px 10px;
    box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    -webkit-box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    -o-box-shadow: 2px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
    box-shadow: 0px 9px 12px 3px rgba(66, 66, 66, 0.37) !important;
    /*overflow-x: hidden;*/
  }

  .main-top-menu .dropdown-result-global-search #footerDropdownGS{
    padding-bottom:10px;
  }


@media screen and (max-width: 767px) {
  .main-top-menu .input-global-search{
    width: 50px;
    padding-left:10px;
    font-size:13px;
  }

  .dropdown-result-global-search .entityRight{
    text-align: left !important;
  }
}

.row-height {
  display: table;
  table-layout: fixed;
  height: 100%;
  width: 100%;
}
.col-height {
  display: table-cell;
  float: none;
  height: 100%;
}

.dropdown-toggle i{
  padding-right:10px;
  padding-left:10px;
}
.contentTitleMap{
    width: 500px;
    border-radius: 0px 0px 50px 50px;
    color: white;
    background-color: rgba(40,40,40,0.9)!important;
}
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
.showHideMoreTitleMap{	
	color: white;
    position: relative;
    bottom: 0px;
    left:-5px;
    width: 55px;
    height: 25px;
    font-size: 35px;
    /* padding-top: 10px; */
    border-radius: 0px 0px 70px 70px;
    background-color: rgba(40,40,40,0.9) !important;
}
.showHideMoreTitleMap i{
    position: relative;
    top: -15px;	
}
.contentTitleMap h1{
	font-size: 18px;
    display: inline-block;
}
.contentShortInformationMap{
	display:none;
	padding: 10px 20px 1px 20px;
}
.contentTitleLogo{
	height: 65px;
    padding: 10px 0px 0px 0px;
}
#menuTopList{
	display:none;
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

	<div class="dropdown-result-global-search"></div>
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
				<?php if (@$params['skin']["docs"] && $params['skin']["docs"]){ ?>
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
							<a class="btn-top btn bg-red hidden-xs" href="/pixelhumain/ph/communecter/person/logout?network=<?php echo $params["name"] ?>" style="margin-right:10px;" onclick="">
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
			<div class="dropdown pull-right hidden-xs">
				<?php if(isset($params['skin']['displayButtonGridList']) && $params['skin']['displayButtonGridList']) { ?>
					<button id="grid" class="dropdown-toggle menu-name-profil text-dark" style="display:none">
						<i class="fa fa-th-large fa-2x"></i>
					</button>
					<button id="list" class="dropdown-toggle menu-name-profil text-dark">
						<i class="fa fa-align-justify fa-2x"></i>
					</button>
				<?php } ?>
			</div>
		</div>

		<div class="menu-info-profil">
			<div class="topMenuButtons pull-right">
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
	<div class="pull-left">
		<div class="dropdown pull-right hidden-xs">
			<?php if(isset($params['skin']['iconeSearchPlus']) && $params['skin']['iconeSearchPlus']) { ?>
				<button id="dropdown_paramsBtn hide" class="menu-name-profil text-dark">
				<i class="fa fa-search-plus fa-2x"></i>
				</button>
			<?php }
			if(isset($params['skin']['iconeAdd']) && $params['skin']['iconeAdd']) { ?>
				<button class="dropdown-toggle menu-name-profil btn-menu-global-search text-dark" data-toggle="dropdown">
					<i class="fa fa-plus fa-2x"></i>
				</button>
				<ul class="dropdown-menu dropdown-menu-right">
			<?php if(isset($params['add']['organization']) && $params['add']['organization']) { ?>
				<li>
					<a onclick="urlCtrl.loadByHash('#organization.addorganizationform');">
						<i class="fa fa-group fa-2x text-green"></i>
						<span class="add-title">une organisation</span>
					</a>
				</li>
			<?php } ?>
			<?php if(isset($params['add']['project']) && $params['add']['project']) { ?>
				<li>
					<a onclick="urlCtrl.loadByHash('#project.projectsv');">
						<i class="fa fa-lightbulb-o fa-2x text-purple"></i>
						<span class="add-title">un projet</span>
					</a>
				</li>
			<?php } ?>
			<?php if(isset($params['add']['event']) && $params['add']['event']) { ?>
				<li>
					<a onclick="urlCtrl.loadByHash('#event.eventsv');">
						<i class="fa fa-calendar fa-2x text-orange"></i>
						<span class="add-title">un événement</span>
					</a>
				</li>
			<?php } ?>
			</ul>
			<!-- </div> -->
			<?php } ?>
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

