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
<div class="hidden-xs main-menu-left col-md-2 col-sm-3 menu-col-search no-padding"  data-tpl="menuLeft">
	<div  class="col-md-12 no-padding" id="dropdown_params">
		<div class="panel-group">
			<div id="divFiltre" class="panel panel-default" style="height: 100%;">
				<div id="divTagsMenu"></div>
				<div id="divTypesMenu"></div>
				<div id="divRolesMenu" class="hidden">
					<div class="panel-heading" style="background-color: #f5f5f5;">
						<h4 class="left-title-menu" onclick="manageCollapse('roles', 'false')">
							<a data-toggle="collapse" href="#roles" style="color:#719FAB" data-label="roles">
								Tous les rôles
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


		<?php 		
				
		if(isset($params['filter']['linksTag']) && is_array($params['filter']['linksTag'])){ ?> 
					<div class="col-lg-12 text-left subsub" id="sub-menu-left">
					<?php
						foreach($params['filter']['linksTag'] as $category => $listTag){ ?>

						
							<a href="javascript:;" class="btn btn-default text-dark margin-bottom-5 tagParent titleTag" style="margin-left:-5px;" data-keycat="<?php echo $listTag['tagParent']; ?>">
								<?php if(isset($listTag['image'])){
										echo "<img src='".$this->module->assetsUrl."/images/network/".$listTag['image']."' width='20px'/> ";
									} else 
										echo '<i class="fa fa-chevron-circle-down hidden-xs"></i> ';
									echo $category; ?> 
							</a><br>
							
							<?php foreach($listTag['tags'] as $label => $tag){ ?>
								<a href="javascript:;" class="btn btn-default text-azure margin-bottom-5 margin-left-15 hidden tagFilter keycat-<?php echo $listTag['tagParent']; ?>" data-filtre="<?php echo $label ; ?>" data-parent="<?php echo $listTag['tagParent']; ?>">
									<i class="fa fa-angle-right"></i> <?php echo $label; ?>
								</a><br class="hidden">
							<?php } ?>
					<?php } ?>
						</div>
		<?php 		
				}
			
				/*if(isset($params['filter']['tags']) && isset($params['filter']['tags']['activate']) && $params['filter']['tags']['activate']){ ?>
					<div class="panel-heading">
						<h4 class="panel-title" onclick="manageCollapse('tags', 'false')">
							<a data-toggle="collapse" href="#tags" style="color:#719FAB" data-label="tags">
							<?php if(isset($params['filter']['tags'])){
								echo "<img src='".$this->module->assetsUrl."/images/network/".$params['filter']['tags']['image']."' width='20px'/>";
								}
								echo $params['filter']['tags']['title']; ?>
								<i class="fa fa-chevron-right right" aria-hidden="true" id="fa_tags"></i>
							</a>
						</h4>
					</div>
					<div id="list_tags" class="panel-collapse collapse">
						<ul class="list-group no-margin">
						<!-- Tags -->
						<?php if(isset($params['filter']['tags']['tagsAdditional']) && is_array($params['filter']['tags']['tagsAdditional']))foreach($params['filter']['tags']['tagsAdditional'] as $label => $tag) { ?>
							<li class="list-group-item"><input type="checkbox" class="checkbox tagFilter" value="<?php echo $tag; ?>" data-parent="tags" data-label="<?php echo $label; ?>"/><?php echo $label; ?></li>
						<?php } ?>
						</ul>
					</div>
		  <?php }*/


		  	if(isset($params['request']['searchLocalityNAME'])){ ?> 
					<div class="col-lg-12 text-left subsub" id="sub-menu-left">
							<a href="javascript:;" class="btn btn-default text-dark margin-bottom-5 tagParent titleTag" style="margin-left:-5px;" data-keycat="Localities">
								<?php if(isset($params['request']['searchLocalityNAME'])){
							echo "<img src='".$this->module->assetsUrl."/images/network/Logement.png' width='20px'/>";
							} ?>
								Villes
								<i class="fa fa-chevron-right right" aria-hidden="true" id="fa_villes"></i>
							</a><br>
							
							<?php foreach($params['request']['searchLocalityNAME'] as $key => $label){ ?>
								<a href="javascript:;" class="btn btn-default text-azure margin-bottom-5 margin-left-15 hidden villeFilter keycat-Localities active" data-value="<?php echo $label ; ?>" >
									<i class="fa fa-angle-right"></i> <?php echo $label; ?>
								</a><br class="hidden">
							<?php } ?>
					</div>
		<?php   }

				/*if(isset($params['request']['searchLocalityNAME'])){ ?>
					<div class="panel-heading">
						<h4 class="panel-title" onclick="manageCollapse('villes', 'false')">
							<a data-toggle="collapse" href="#villes" style="color:#719FAB" data-label="villes">
							<?php if(isset($params['request']['searchLocalityNAME'])){
							echo "<img src='".$this->module->assetsUrl."/images/network/Logement.png' width='20px'/>";
							} ?>
								Villes
								<i class="fa fa-chevron-right right" aria-hidden="true" id="fa_villes"></i>
							</a>
						</h4>
					</div>
					<div id="list_villes" class="panel-collapse collapse">
						<ul class="list-group no-margin">
							<?php foreach($params['request']['searchLocalityNAME'] as $label){?>
								<li class="list-group-item"><input type="checkbox" class="checkbox villeFilter" value="<?php echo $label; ?>" data-parent="villes" data-label="<?php echo $label; ?>"/><?php echo $label; ?></li>
							<?php } ?>
						</ul>
					</div>
				<?php } */
				$roles = Role::getRolesUserId(Yii::app()->session["userId"]);
				if(@$roles["superAdmin"] == true){?>
					<div class="panel-heading">
						<label class="btn-disable text-blue" >
							<?php echo Yii::t("common","Disable")." "; ?> 
							<input type="checkbox" class="checkbox disableCheckbox" value="disable" data-label="<?php echo Yii::t("common","Disable"); ?>" style="float: right; " />
						</label>
					</div>
	<?php 		} ?>
				
				<div class="panel-heading">
					<a id="reset" class="reset" href="javascript:;">
						<h4 class="panel-title">
							<center><i class="fa fa-refresh"></i>Réinitialiser</center>
						</h4>
					</a>
				</div>
				<div class="panel-heading endFilterPanel"></div>
			</div>
		</div>
	</div>
</div>
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
	// $('#btn-menu-launch').click(function(){

	// 	if(!$('.menu-col-search').is(":visible")){
	// 		$(".bgpixeltree").removeClass("col-md-12 col-sm-12 col-xs-12").addClass("col-md-10 col-sm-10 col-xs-10");
	// 		showAfter=false;
	// 	}else{
	// 		showAfter=true;
	// 	}

	// 	$('.menu-col-search').toggle("slow");
	// 	if(showAfter){
	// 		$(".bgpixeltree").removeClass("col-md-10 col-sm-10 col-xs-10").addClass("col-md-12 col-sm-12 col-xs-12");
	// 	}
	// });


	$(".tagParent").click(function(){
		if($(this).hasClass( "active" ) == false){
			$(this).addClass("active");
			$(".keycat-"+$(this).data("keycat")).removeClass("hidden");	
		}else{
			$(this).removeClass("active");
			$(".keycat-"+$(this).data("keycat")).addClass("hidden");
		}
	});


	// $('#searchClientBarText').keyup(function(e){
	// 	// console.log($('#searchClientBarText').val());
	// 	$('#input_name_filter').val($('#searchClientBarText').val());
	// 	Sig.checkListElementMap(Sig.map);
	// });

	// $('#input_name_filter').keyup(function(e){
	// 	// console.log($('#searchClientBarText').val());
	// 	$('#searchClientBarText').val($('#input_name_filter').val());
	// });
});

</script>