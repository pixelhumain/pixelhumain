<?php 

	//$newsToModerate = count(News::getNewsToModerate());

	$cssAnsScriptFilesModule = array(
		'/assets/css/default/menu.css',
		//'/assets/css/menus/menuLeft.css'
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);

	// $cssAnsScriptFilesModule = array(
	// 	'/js/default/menu.js',
	// );
	// HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<style>
	.btn-disable{
		font-size: medium;
	}
</style>
<?php if(!empty($params['filter'])) { ?>
<div class="hidden-xs main-menu-left col-md-2 col-sm-3 menu-col-search no-padding"  data-tpl="menuLeft" style="display:none;">
	<div  class="col-md-12 no-padding" id="dropdown_params" style="height: 100%;">
		<div class="panel-group">
			<div id="divFiltre" class="panel panel-default">
				<div id="divTagsMenu"></div>
				<div id="divTypesMenu"></div>
				<div id="divRolesMenu" class="hidden">
					<div class="panel-heading" style="background-color: #f5f5f5;">
						<h4 class="left-title-menu" onclick="manageCollapse('roles', 'false')">
							<a data-toggle="collapse" href="#roles" style="color:#719FAB" data-label="roles">
								<?php echo Yii::t("common","All functions") ?>
								<i class="fa fa-chevron-right right" aria-hidden="true" id="fa_roles"></i>
							</a>
						</h4>
					</div>
					<div id="list_roles" class="panel-collapse collapse">
						<ul class="list-group">
							<li class="list-group-item"><input type="checkbox" class="checkbox rolesFilterAuto" value="creator" data-parent="roles" data-label="creator"/><?php echo Yii::t("common","Creator") ?></li>
							<li class="list-group-item"><input type="checkbox" class="checkbox rolesFilterAuto" value="members" data-parent="roles" data-label="members"/><?php echo Yii::t("common","Member") ?></li>
							<li class="list-group-item"><input type="checkbox" class="checkbox rolesFilterAuto" value="admin" data-parent="roles" data-label="admin"/><?php echo Yii::t("common","Administrator") ?></li>
						</ul>
					</div>
				</div>

				<?php if (!empty($params['request']['searchType']) && in_array(Classified::COLLECTION, $params['request']['searchType']) ){ ?>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding text-left subsub" id="sub-menu-left">
						
						<a href="javascript:;" class="btn btn-default text-dark margin-bottom-5 tagParent titleTag" style="margin-left:-5px;" data-keycat="classifieds">
							<i class="fa fa-chevron-circle-down hidden-xs"></i> Type Annonces
						</a><br>

						<a href="javascript:;" class="btn btn-default text-azure margin-bottom-5 hidden classifiedsFilterAuto keycat-classifieds" data-filtre="classifieds" data-parent="classifieds">
							<i class="fa fa-angle-right"></i> <?php echo Yii::t("common","Offer") ?>
						</a><br class="hidden">

						<a href="javascript:;" class="btn btn-default text-azure margin-bottom-5 hidden classifiedsFilterAuto keycat-classifieds" data-filtre="ressources" data-parent="classifieds">
							<i class="fa fa-angle-right"></i> <?php echo Yii::t("common","Formation") ?>
						</a><br class="hidden">

						<a href="javascript:;" class="btn btn-default text-azure margin-bottom-5 hidden classifiedsFilterAuto keycat-classifieds" data-filtre="jobs" data-parent="classifieds">
							<i class="fa fa-angle-right"></i> <?php echo Yii::t("common","Annonce") ?>
						</a><br class="hidden">
						
					</div>
				<?php } ?>
				
	
				
		
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding text-left subsub" id="sub-menu-left">
					<?php
						if(isset($params['filter']['linksTag']) && is_array($params['filter']['linksTag'])){ 
						foreach($params['filter']['linksTag'] as $category => $listTag){ ?>

						
							<a href="javascript:;" class="btn btn-default text-dark margin-bottom-5 tagParent titleTag" style="margin-left:-5px;" data-keycat="<?php echo $listTag['tagParent']; ?>">
								<?php if(isset($listTag['image'])){
										echo "<img src='".$this->module->assetsUrl."/images/network/".$listTag['image']."' width='20px'/> ";
									} else 
										echo '<i class="fa fa-chevron-circle-down hidden-xs"></i> ';
									echo $category; ?> 
							</a><br>
							
							<?php foreach($listTag['tags'] as $label => $tag){ ?>
								<a href="javascript:;" class="btn btn-default text-azure margin-bottom-5 hidden tagFilter keycat-<?php echo $listTag['tagParent']; ?>" data-filtre="<?php echo $label ; ?>" data-parent="<?php echo $listTag['tagParent']; ?>">
									<i class="fa fa-angle-right"></i> <?php echo $label; ?>
								</a><br class="hidden">
							<?php } ?>
					<?php } 
						}
					if(isset($params['request']['searchLocalityNAME'])){ ?> 
								<a href="javascript:;" class="btn btn-default text-dark margin-bottom-5 tagParent titleTag" style="margin-left:-5px;" data-keycat="Localities">
									<?php if(isset($params['request']['searchLocalityNAME'])){
								echo "<img src='".$this->module->assetsUrl."/images/network/Logement.png' width='20px'/>";
								} ?>
									Villes
									<i class="fa fa-chevron-right right" aria-hidden="true" id="fa_villes"></i>
								</a><br>
								
								<?php foreach($params['request']['searchLocalityNAME'] as $key => $label){ ?>
									<a href="javascript:;" class="btn btn-default text-azure margin-bottom-5 hidden villeFilter keycat-Localities active" data-value="<?php echo $label ; ?>" >
										<i class="fa fa-angle-right"></i> <?php echo $label; ?>
									</a><br class="hidden">
								<?php } ?>
		<?php   } ?>
						</div>
		<?php 		
				

				$roles = Role::getRolesUserId(Yii::app()->session["userId"]);
				if(@$roles["superAdmin"] == true){?>
					<div>
						<label class="col-md-12 col-sm-12 btn-disable text-blue" >
							<input type="checkbox" class="checkbox disableCheckbox pull-left" value="disable" data-label="<?php echo Yii::t("common","Disable"); ?>"/><?php echo Yii::t("common","Disable")." "; ?> 
						</label>
					</div>
	<?php 		} ?>
				
				<div>
					<a id="reset" class="reset" href="javascript:;" style="cursor:pointer;">
						<h4 class="panel-title">
							<center><i class="fa fa-refresh"></i> <?php echo Yii::t("common","Reset"); ?></center>
						</h4>
					</a>
				</div>
				<div class="endFilterPanel"></div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<script type="text/javascript">


function manageCollapse(div, forcer){
	var div = div.replace(/'/g, "\\'");
	if(forcer == true){
		$("#list_"+div).show();
	}else{
		$("#list_"+div).toggle();
	}
	if($("#list_"+div).is(":visible")){
		$("#fa_"+div).addClass('fa-chevron-down');
		$("#fa_"+div).removeClass('fa-chevron-right');
	}
	else{
		$("#fa_"+div).removeClass('fa-chevron-down');
		$("#fa_"+div).addClass('fa-chevron-right');
	}
}


jQuery(document).ready(function() {

	$(".tagParent").click(function(){
		if($(this).hasClass( "active" ) == false){
			$(this).addClass("active");
			$(".keycat-"+$(this).data("keycat")).removeClass("hidden");	
		}else{
			$(this).removeClass("active");
			$(".keycat-"+$(this).data("keycat")).addClass("hidden");
		}
	});
});

</script>