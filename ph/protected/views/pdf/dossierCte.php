<h1> Dossier N° : <?php echo (string)@$adminAnswers["_id"] ?></h1>

<div class='col-xs-12'>
	<h4 class="padding-20" style=""> Réponse par :</h4>
	<span> Name : <?php echo $user["name"]; ?> </span> <br/>
	<span> Email : <?php echo @$answers["cte1"]["answers"]["email"]; ?> </span><br/>
	<span> Organisations :
		<?php if( @$answers["cte1"]["answers"]["organization"]  ){ ?>
			<a href="<?php echo Yii::app()->createUrl( "#page.type.organizations.id.".$answers["cte1"]["answers"]["organization"]["id"]); ?>" target="_blank"><?php echo $answers["cte1"]["answers"]["organization"]["name"]; ?></a>
		<?php } ?>
	</span><br/>
	<span> Projet :
		<?php if( @$answers["cte2"]["answers"]["project"]  ) { ?>
			<a href="<?php echo Yii::app()->createUrl( "#page.type.projects.id.".$answers["cte2"]["answers"]["project"]["id"]); ?>" target="_blank"><?php echo $answers["cte2"]["answers"]["project"]["name"]; ?></a>
		<?php } ?>
	</span><br/>		
</div>

<div class='col-xs-12'>
	<?php
		foreach ($form["scenario"] as $k => $v) {
			echo '<h4 class="padding-20" style="">'.$v["title"].'</h4>';
			if(@$answers[$k]){
				echo '<span class="text-dark">'.date("d/m/Y h:i", $answers[$k]["created"]).'</span>';
				?>
				<div class='col-xs-12'>
					<?php 
						foreach ( $answers[$k]["answers"] as $key => $value) {
							$editBtn = "";
							if( (string)$user["_id"] == Yii::app()->session["userId"] && !Form::isFinish($form )) {
								if(@$v["form"]["scenario"][$key]["saveElement"]) 
									$editBtn = "<a href='javascript:'  data-form='".$k."' data-step='".$key."' data-type='".$value["type"]."' data-id='".$value["id"]."' class='editStep btn btn-default'><i class='fa fa-pencil'></i></a>";
								else 
									$editBtn = "<a href='javascript:'  data-form='".$k."' data-step='".$key."' class='editStep btn btn-default'><i class='fa fa-pencil'></i></a>";
							}
							echo "<div class='col-xs-12'>".
									"<h2> [ étape ] ".@$v["form"]["scenario"][$key]["title"]." ".$editBtn."</h2>"; 

						} ?>

				</div>

			<?php
			}else{
				echo '<span class="padding-20" style="">Pas encore renseigné</h4>';
			}
		}

	?>	
</div>
<?php
// if(!isset($adminForm["scenarioAdmin"]))
// 	$adminForm["scenarioAdmin"] = array("dossier"=>[]);
// $pageParams = array(
// 	"adminAnswers"=>$adminAnswers,
// 	"adminForm"=>$adminForm,
// 	"answers" => $answers,
// 	"form" => $form,
// 	"user" => $user,
// 	"prioKey" => @$adminForm['key'],
// 	"canAdmin" => $canAdmin,
// 	"canSuperAdmin" => $canSuperAdmin,
// 	"steps" => array_keys($adminForm["scenarioAdmin"])
// ); 

// $ct = 0;
// $showHide = "";
// foreach ( @$adminForm["scenarioAdmin"] as $k => $v ) {
	
// 	if( in_array( @$adminAnswers["step"] , array( "risk","ficheAction" ) ) ){
// 		$pageParams["riskTypes"] = @$riskTypes;
// 		$pageParams["riskCatalog" ] = @$riskCatalog;
// 	}
	
// 	echo "<div id='".$k."' class='section".$ct." ".$showHide."'>";
// 	echo $this->renderPartial( $k , $pageParams ); 
// 	echo "</div>";

// 	$ct++;
// 	$showHide = "hide";
// }
?>