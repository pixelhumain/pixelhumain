<!-- Modal addCommune-->
<div id="addCommune" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="true">
  <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 id="myModalLabel">Ajouter une Commune </h4>
  </div>
  
	
  <div class="modal-body">
				
	<div class="tab-content">
	  <div class="tab-pane active" id="you">
		<div class="p10 step-by-step">
			<ul class="unstyled clearfix">
				<li class="step-current"><span>Details</span></li>
				<li class=""><span>Nature*</span></li>
				<li class="last-step"><span>Activité*</span></li>
			</ul>
		</div>
		<br/>
		<h6> Objectif : Construction participative, partage et collaboration</h6>
		<form id="register1" action="save.php" method="POST">
			
			
			<div class="controls">
				<div class="controls controls-row">
					<select id="genreType" class="span3">
						<option value="">Sélectionner un type</option>
						<?php
						// curseur de type tableau de valeurs avec 1 clé (findOne)  where array() (je prends tout) qui a plusieurs valeurs array('list')
						$cursorTypes = $connection->pixelhumain->types->findOne( array(), array('list'));
						
						// Affichage d'un curseur de type tableau de valeurs. Je parcours le cursor, la clé est $c et la valeur est $type
						foreach ($cursorTypes['list'] as $c=>$type):
						?>
							<option value="<?php echo $c ?>" ><?php echo $type ?></option>
						<?php endforeach;?>
					</select>
				</div>						
				<div class="controls controls-row">
					<input type="text" class="span3" id="name" placeholder="Nom"/> 
					<input type="text" class="span2" id="pilot" placeholder="Représentant"/>
				</div>
				<div class="controls controls-row">
					<textarea id = "objet" placeholder="objet" class="span5"></textarea>
				</div>
			</div>
		</form>
		</div>
	</div>
  </div>
  <div class="modal-footer">
	<button id="modal1Close" class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
	<a href="#activité" class="modalNext btn btn-primary" data-toggle="modal">Suivant<i class="icon-forward "></i></a>
	<a href="#submit" class="modalNext btn btn-primary" data-toggle="modal">S'inscrire<i class="icon-forward "></i></a>
  </div>
  
</div>
<!-- Modal addCommune -->


