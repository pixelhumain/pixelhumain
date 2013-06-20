<!-- Modal addCommune-->
<div id="addCommune" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="true">
  <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 id="myModalLabel">Ajouter une Commune </h4>
  </div>
  
	
  <div class="modal-body">
				
	<div class="tab-content">
	  <div class="tab-pane active" id="you">
		<h6>Ouvrez votre commune</h6>
		<form id="communeForm" action="saveCommune.php" method="POST">
			
			<div class="controls">
				<div class="controls controls-row">
					<input type="text" class="span3" id="name" placeholder="Nom"/> 
					<input type="text" class="span2" id="pilot" placeholder="Représentant"/>
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


