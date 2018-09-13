<?php

Yii::import("parsedown.Parsedown", true);


?>
<style type="text/css">
	
h1 {
	font-size: 16px;
	
}

</style>

<span style="text-align: center;">
	<img src="http://www.tco.re/wp-content/uploads/2018/07/slide-ppt_contrats-de-transition-ecologique-768x74.jpg">
	<h1> CONTRAT DE TRANSITION ECOLOGIQUE </h1>
	<span>FICHE ACTION :</span><br/>
	<span><?php 
		if( @$answers["cte2"]["answers"]["project"]  ) { 
			echo $answers["cte2"]["answers"]["project"]["name"];
		} ?>
	</span>

</span>


<div class='col-xs-12'>
	<h4 class="padding-20" style="">Orientation stratégique</h4>
	<span> <?php
		if(!empty($answers["cte3"]["answers"]["objectif"]["usagers"])){
			echo $answers["cte3"]["answers"]["objectif"]["usagers"];
		}else
			echo "<i> Pas renseigner </i>";
	?> </span> 
	<br/>

	<h4 class="padding-20" style="">Objectifs</h4>
	<span> <?php
		if(!empty($answers["cte3"]["answers"]["objectif"]["objectif"])){
			echo $answers["cte3"]["answers"]["objectif"]["objectif"];
		}else
			echo "<i> Pas renseigner </i>";
	?> </span> 
	<br/>

	<h4 class="padding-20" style="">Description de l'action</h4>
	<span> <?php
		$Parsedown = new Parsedown();
		if(!empty($answers["cte3"]["answers"]["objectif"]["description"])){
			echo $Parsedown->text($answers["cte3"]["answers"]["objectif"]["description"]);
		}else
			echo "<i> Pas renseigner </i>";
	?> </span> 
	<br/>

	<h4 class="padding-20" style="">Maitre d'ouvrage/pilote de l'action</h4>
	<span> <?php
		if(!empty($answers["cte3"]["answers"]["objectif"]["description"])){
			echo $answers["cte3"]["answers"]["objectif"]["description"];
		}else
			echo "<i> Pas renseigner </i>";
	?> </span> 
	<br/>

	<h4 class="padding-20" style="">Partenaires (actés et potentiels)</h4>
	<span> <?php
		if(!empty($answers["cte3"]["answers"]["objectif"]["cooperations"])){
			echo $answers["cte3"]["answers"]["objectif"]["cooperations"];
		}else
			echo "<i> Pas renseigner </i>";
	?> </span> 
	<br/>

	<h4 class="padding-20" style="">Modalités de mise en oeuvre</h4>
	<span> <?php
		if(!empty($answers["cte3"]["answers"]["objectif"]["gouvernances"])){
			echo $answers["cte3"]["answers"]["objectif"]["gouvernances"];
		}else
			echo "<i> Pas renseigner </i>";
	?> </span> 
	<br/>

	<h4 class="padding-20" style="">Calendrier</h4>
	<span> <?php
	// "maturity" : {
 //            "state" : "",
 //            "description" : "",
 //            "dateConcept" : "",
 //            "dateCahier" : "",
 //            "datePrototype" : "",
 //            "dateDeveloppement" : "",
 //            "dateTest" : "22/03/2019",
 //            "dateProduction" : ""
		if(!empty($answers["cte2"]["answers"]["maturity"])){
			$m = $answers["cte2"]["answers"]["maturity"];
			if(!empty($m["state"]))
				echo "<span>Etat actuel : ".$m["state"]."</span><br/>";
			if(!empty($m["description"]))
				echo $m["description"];
			if(!empty($m["dateConcept"]))
				echo "<span>Date : ".$m["dateConcept"]."</span><br/>";
			if(!empty($m["dateCahier"]))
				echo "<span>Date : ".$m["dateCahier"]."</span><br/>";
			if(!empty($m["datePrototype"]))
				echo "<span>Date : ".$m["datePrototype"]."</span><br/>";
			if(!empty($m["dateConcept"]))
				echo "<span>Date : ".$m["dateConcept"]."</span><br/>";
			if(!empty($m["dateDeveloppement"]))
				echo "<span>Date : ".$m["dateDeveloppement"]."</span><br/>";
			if(!empty($m["dateTest"]))
				echo "<span>Date : ".$m["dateTest"]."</span><br/>";
			if(!empty($m["dateProduction"]))
				echo "<span>Date : ".$m["dateProduction"]."</span><br/>";
		}else
			echo "<i> Pas renseigner </i>";
	?> </span> 
	<br/>

	<h4 class="padding-20" style="">Plan de financement</h4>
	<span> <?php
		if(isset($answers["cte3"]["answers"]["previsionel"]["previsionel"])){
			echo "Voir Annexe";
		}else
			echo "<i> Pas renseigner </i>";
	?> </span> 
	<br/>


	<h4 class="padding-20" style="">Evaluation</h4>
	<span> <?php
		if(isset($answers["cte2"]["answers"]["risk"]["description"])){
			echo $answers["cte2"]["answers"]["risk"]["description"];
		}else
			echo "<i> Pas renseigner </i>";
	?> </span> 
	<br/>		
</div>