<!-- Modal -->
<div id="participer" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Inscription Réussit, Étape suivante ?</h3>
  </div>
  <div class="modal-body">
    <form id="register2">
        <section>
          <p> Un mail de validation vous a été envoyé
            <br/>En attendant vous pouvez compléter votre inscription ci-dessous</p>
            
          <p>
          	<?php 
          	    $account = (isset(Yii::app()->session["userId"])) ? Yii::app()->mongodb->pixelsactifs->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"]))) : null;
          	?>
          	Je m'appel <input id="registerName" value="<?php if($account && isset($account['name']) )echo $account['name'] ?>"/>, <br/>
          	<?php 
                  $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                    'asDropDownList' => true,
                    'name' => 'typePA',
                  	'id' => 'typePA',
                    'value'=>($account && isset($account['type']) ) ? $account['type'] : "citoyen",
                    'pluginOptions' => array(
                        'tags' => array("citoyen","association","entreprise","collectivité"),
                        'placeholder' => "Vous êtes ?",
                        'width' => '40%',
                        'tokenSeparators' => array(',', ' ')
                    )));
    		    ?><br> 
          	j'habite au code postal  <input id="registerCP"  value="<?php if($account && isset($account['cp']) )echo $account['cp'] ?>"><br> 
            J'aimerais aussi vous aider sur le projet <input type="checkbox" id="registerHelpout" <?php if($account && isset($account['activeOnProject']) )echo "checked" ?>>
            <div <?php if($account && (!isset($account['activeOnProject']) || !$account['activeOnProject']) ){ ?>class="hidden" <?php }?> id="registerHelpoutWhat">
                <?php 
                  $cursor = Yii::app()->mongodb->jobTypes->findOne( array(), array('list'));
                  $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                    'asDropDownList' => false,
                    'name' => 'helpJob',
                  	'id' => 'helpJob',
                    'value'=>($account && isset($account['positions']) ) ? implode(" ", $account['positions']) : "",
                    'pluginOptions' => array(
                        'tags' => $cursor['list'],
                        'placeholder' => "Qu'aimeriez vous faire ?",
                        'width' => '40%',
                        'tokenSeparators' => array(',', ' ')
                    )));
    		    ?>
		    </div>
           </p>
            
           <p>Toute l'équipe du Pixel Humain vous remercie et vous souhaites la bienvenue.</p> 
        </section>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button class="btn btn-primary" id="submitAccount" onclick="$('#register2').submit();">Enregistrer</button>
  </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div id="flashInfo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Flash information :</h3>
  </div>
  <div class="modal-body">
    
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
  </div>
</div>
<!-- Modal -->