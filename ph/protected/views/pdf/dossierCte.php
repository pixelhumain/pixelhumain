<?php

Yii::import("parsedown.Parsedown", true);
$Parsedown = new Parsedown();

?>
<style type="text/css">
	
h1 {
	font-size: 16px;
}

.blue{
	color : #195391;
}

.lightgreen{
	color : #a9ce3f;
}

.darkgreen{
	color : #4db88c;
}

.body { 
	font-family: Arial,Helvetica Neue,Helvetica,sans-serif; 
}

table.first {
        color: #003300;
        font-family: helvetica;
        border: 3px solid black;
    }

table.first td {
        border: 1px solid black;
        font-size: 8pt;
    }

table.first td .entete {
         font-size: 10pt;
         font-weight: bold;
    }

</style>

<div class="body">
	<span style="text-align: center;">
		<img src="http://www.tco.re/wp-content/uploads/2018/07/slide-ppt_contrats-de-transition-ecologique-768x74.jpg">
		<h1 class="blue"> CONTRAT DE TRANSITION ECOLOGIQUE </h1>
		<span class="darkgreen">FICHE ACTION :</span><br/>
		<span class="lightgreen"><?php 
			if( !empty($answers["cte2"]["answers"]["project"]) && !empty($answers["cte2"]["answers"]["project"]["name"]) ) { 
				echo $answers["cte2"]["answers"]["project"]["name"];
			} ?>
		</span>

	</span>


	<div class='col-xs-12'>
		<h4 class="padding-20 blue" style="">Orientation stratégique</h4>
		<span> <?php
			if(!empty($answer["answers"]["cte3"]["answers"]["objectif"]["usagers"])){
				echo $Parsedown->text($answer["answers"]["cte3"]["answers"]["objectif"]["usagers"]);
			}else
				echo "<i> Pas renseigner </i>";
		?> </span> 
		<br/>

		<h4 class="padding-20 blue" style="">Objectifs</h4>
		<span> <?php
			if(!empty($answer["answers"]["cte3"]["answers"]["objectif"]["objectif"])){
				echo $Parsedown->text($answer["answers"]["cte3"]["answers"]["objectif"]["objectif"]);
			}else
				echo "<i> Pas renseigner </i>";
		?> </span> 
		<br/>

		<h4 class="padding-20 blue" style="">Description de l'action</h4>
		<span> <?php
			
			if(!empty($answer["answers"]["cte3"]["answers"]["objectif"]["description"])){
				echo $Parsedown->text($answer["answers"]["cte3"]["answers"]["objectif"]["description"]);
			}else
				echo "<i> Pas renseigner </i>";
		?> </span> 
		<br/>

		<h4 class="padding-20 blue" style="">Maitre d'ouvrage/pilote de l'action</h4>
		<span> <?php
			if(!empty($answer["answers"]["cte1"]["answers"]["organization"]["name"])){
				echo $Parsedown->text($answer["answers"]["cte1"]["answers"]["organization"]["name"]);
			}else
				echo "<i> Pas renseigner </i>";
		?> </span> 
		<br/>

		<h4 class="padding-20 blue" style="">Partenaires (actés et potentiels)</h4>
		<span> <?php
			if(!empty($answer["answers"]["cte3"]["answers"]["objectif"]["cooperations"])){
				echo $Parsedown->text($answer["answers"]["cte3"]["answers"]["objectif"]["cooperations"]);
			}else
				echo "<i> Pas renseigner </i>";
		?> </span> 
		<br/>

		<h4 class="padding-20 blue" style="">Modalités de mise en oeuvre</h4>
		<span> <?php
			if(!empty($answer["answers"]["cte3"]["answers"]["objectif"]["gouvernances"])){
				echo $Parsedown->text($answer["answers"]["cte3"]["answers"]["objectif"]["gouvernances"]);
			}else
				echo "<i> Pas renseigner </i>";
		?> </span> 
		<br/>

		<h4 class="padding-20 blue" style="">Calendrier</h4>
		<span> <?php
			if(!empty($answer["answers"]["cte2"]["answers"]["maturity"])){
				$m = $answer["answers"]["cte2"]["answers"]["maturity"];
				if(!empty($m["state"]))
					echo "<span>Etat actuel : ".$m["state"]."</span><br/>";
				if(!empty($m["description"]))
					echo $Parsedown->text($m["description"]);
				if(!empty($m["dateConcept"]))
					echo "<span>Date de l'idée ou du concept : ".$m["dateConcept"]."</span><br/>";
				if(!empty($m["dateCahier"]))
					echo "<span>Date pour le cahier des charges detaillé : ".$m["dateCahier"]."</span><br/>";
				if(!empty($m["datePrototype"]))
					echo "<span>Date de réalisation du prototype : ".$m["datePrototype"]."</span><br/>";
				if(!empty($m["dateDeveloppement"]))
					echo "<span>Date de début de développement : ".$m["dateDeveloppement"]."</span><br/>";
				if(!empty($m["dateTest"]))
					echo "<span>Date des tests : ".$m["dateTest"]."</span><br/>";
				if(!empty($m["dateProduction"]))
					echo "<span>Date de mise en production : ".$m["dateProduction"]."</span><br/>";
			}else
				echo "<i> Pas renseigner </i>";
		?> </span> 
		<br/>

		<h4 class="padding-20 blue" style="">Evaluation</h4>
		<span> <?php
			if(isset($answer["answers"]["cte2"]["answers"]["risk"]["description"])){
				echo $Parsedown->text($answer["answers"]["cte2"]["answers"]["risk"]["description"]);
			}else
				echo "<i> Pas renseigner </i>";
		?> </span> 
		<br/>

		<h4 class="padding-20 blue" style="">Plan de financement</h4>
		<span> <?php
			if(!isset($answer["answers"]["cte3"]["answers"]["previsionel"]["previsionel"]) && !isset($answer["answers"]["cte3"]["answers"]["planFinancement"]["planFinancement"])){
				echo "<i> Pas renseigner </i>";
			}

			if(isset($answer["answers"]["cte3"]["answers"]["planFinancement"]["planFinancement"])){
				echo '<br/><br/> <table  class="first"  cellspacing="0" >';

				if(!empty($forms["cte3"]["scenario"]["planFinancement"]["json"]["jsonSchema"]["properties"]["planFinancement"]["properties"])){
					$l = $forms["cte3"]["scenario"]["planFinancement"]["json"]["jsonSchema"]["properties"]["planFinancement"]["properties"];

					echo "<tr><td class='entete'>".@$l["type"]["label"]."</td>";
					echo "<td>".@$l["title"]["label"]."</td>";
					echo "<td>".@$l["porteur"]["label"]."</td>";
					echo "<td>".@$l["state"]["label"]."</td>";
					echo "<td>".@$l["position"]["label"]."</td>";
					echo "<td>".@$l["followup"]["label"]."</td>";
					echo "<td>".@$l["financer"]["label"]."</td>";
					echo "<td>".@$l["amountTotal"]["label"]."</td></tr>"; 


				}

				foreach ($answer["answers"]["cte3"]["answers"]["planFinancement"]["planFinancement"] as $key => $value) {
					echo "<tr><td>".$value["type"]."</td>";
					echo "<td>".$value["title"]."</td>";
					echo "<td>".$value["porteur"]."</td>";
					echo "<td>".$value["state"]."</td>";
					echo "<td>".$value["position"]."</td>";
					echo "<td>".$value["followup"]."</td>";
					echo "<td>".$value["financer"]."</td>";
					echo "<td>".$value["amountTotal"]."</td></tr>";
				}
				echo "</table>";
			}

			if( isset($answer["answers"]["cte3"]["answers"]["previsionnel"]["previsionel"]["id"])) {
				echo "<br/><br/> <i>Voir Annexe</i>";
			}

		?> </span> 
		<br/>		
	</div>
</div>