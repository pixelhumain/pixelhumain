<h1> Dossier N° : <?php echo (string)@$adminAnswers["_id"] ?></h1>

<div class='col-xs-12' onclick="$('#by').toggle();">
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
<?php
if(!isset($adminForm["scenarioAdmin"]))
	$adminForm["scenarioAdmin"] = array("dossier"=>[]);
$pageParams = array(
	"adminAnswers"=>$adminAnswers,
	"adminForm"=>$adminForm,
	"answers" => $answers,
	"form" => $form,
	"user" => $user,
	"prioKey" => @$adminForm['key'],
	"canAdmin" => $canAdmin,
	"canSuperAdmin" => $canSuperAdmin,
	"steps" => array_keys($adminForm["scenarioAdmin"])
); 

$ct = 0;
$showHide = "";
foreach ( @$adminForm["scenarioAdmin"] as $k => $v ) {
	
	if( in_array( @$adminAnswers["step"] , array( "risk","ficheAction" ) ) ){
		$pageParams["riskTypes"] = @$riskTypes;
		$pageParams["riskCatalog" ] = @$riskCatalog;
	}
	
	echo "<div id='".$k."' class='section".$ct." ".$showHide."'>";
	echo $this->renderPartial( $k , $pageParams ); 
	echo "</div>";

	$ct++;
	$showHide = "hide";
}
?>