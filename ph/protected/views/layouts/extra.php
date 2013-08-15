<!-- Modal -->
<div id="participer" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Inscription Réussit, Étape suivante ?</h3>
  </div>
  <div class="modal-body" style="max-height:500px" >
  <p> Un mail de validation vous a été envoyé
   <br/>En attendant vous pouvez compléter votre inscription ci-dessous</p>
    <form id="register2" style="line-height:40px;">
        <section>
          
          	<?php 
          	    $account = (isset(Yii::app()->session["userId"])) ? Yii::app()->mongodb->pixelsactifs->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"]))) : null;
          	?>
          	<table>
          	<tr>
              	<td class="txtright">Je m'appel</td>
              	<td> <input id="registerName" name="registerName" value="<?php if($account && isset($account['name']) )echo $account['name'] ?>"/></td>
          	</tr>
          	<tr>
              	<td class="txtright">Je m'inscrit en tant que  </td>
              	<td>
              	<?php 
                      $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                        'data' => array("citoyen"=>"citoyen","association"=>"association","entreprise"=>"entreprise","collectivité"=>"collectivité"), 
                        'name' => 'typePA',
                      	'id' => 'typePA',
                        'value'=>($account && isset($account['type']) ) ? $account['type'] : "citoyen",
                        'pluginOptions' => array('width' => '150px')
                      ));
        		    ?></td>
    		</tr>    
    		<tr>
        		<td class="txtright">j'habite au code postal</td>  
        		<td><input id="registerCP" name="registerCP" class="span2" value="<?php if($account && isset($account['cp']) )echo $account['cp'] ?>"></td>
    		</tr>
    		<tr> 
                <td class="txtright">J'aimerais aider le projet</td>
                <td> <input type="checkbox" id="registerHelpout" name="registerHelpout" <?php if($account && isset($account['activeOnProject']) )echo "checked" ?>></td>
            </tr>
            <tr <?php if($account && (!isset($account['activeOnProject']) || !$account['activeOnProject']) ){ ?>class="hidden" <?php }?> id="registerHelpoutWhat">
                <td class="txtright">en tant que </td>
                <td>
                    <?php 
                      $cursor = Yii::app()->mongodb->jobTypes->findOne( array(), array('list'));
                      $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                        'asDropDownList' => false,
                        'name' => 'helpJob',
                      	'id' => 'helpJob',
                        'value'=>($account && isset($account['positions']) ) ? implode(",", $account['positions']) : "",
                        'pluginOptions' => array(
                            'tags' => $cursor['list'],
                            'placeholder' => "Qu'aimeriez vous faire ?",
                            'width' => '100%',
                            'tokenSeparators' => array(',', ' ')
                        )));
        		    ?>
    		    </td>
		    </tr>
		    <tr >
                <td class="txtright">Mots clefs vous décrivant </td>
                <td>
                    <?php 
                      $cursor = Yii::app()->mongodb->tags->findOne( array(), array('list'));
                      $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                        'asDropDownList' => false,
                        'name' => 'tagsPA',
                      	'id' => 'tagsPA',
                        'value'=>($account && isset($account['tags']) ) ? implode(",", $account['tags']) : "",
                        'pluginOptions' => array(
                            'tags' => $cursor['list'],
                            'placeholder' => "Mots clefs ?",
                            'width' => '100%',
                            'tokenSeparators' => array(',', ' ')
                        )));
        		    ?>
    		    </td>
		    </tr>
          </table>
             
        </section>
        
    </form>
    <p>Toute l'équipe du Pixel Humain vous remercie et vous souhaites la bienvenue.</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button class="btn btn-primary" id="submitAccount" onclick="$('#register2').submit();">Enregistrer</button>
  </div>
</div>
<!-- Modal -->

<!-- Modal -->
<div id="invitation" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Parainer ou Inviter Quelqu'un</h3>
  </div>
  <div class="modal-body">
    <p> Le mail d'invitation ci-dessous sera envoyé a votre filleul</p>
    <form id="inviteForm" style="line-height:40px;">
        <section>
          	<input type="hidden" id="sponsorPA" name="sponsorPA" value="<?php echo Yii::app()->session["userId"]; ?>"/>
          	<table>
          	<tr>
              	<td class="txtright">Un Email</td>
              	<td> <input id="inviteEmail" name="inviteEmail" value=""/></td>
          	</tr>
          	<tr>
              	<td class="txtright">Un nom </td>
              	<td> <input id="inviteName" name="inviteName" value=""/></td>
          	</tr>
          	<tr>
              	<td class="txtright">sera inscrit en tant que  </td>
              	<td>
              	<?php 
                      $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                        'data' => array("citoyen"=>"citoyen","association"=>"association","entreprise"=>"entreprise","collectivité"=>"collectivité"), 
                        'name' => 'typeInvite',
                      	'id' => 'typeInvite',
                        'pluginOptions' => array('width' => '150px')
                      ));
        		    ?></td>
    		</tr>
          </table>
             
        </section>
        
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button class="btn btn-primary" id="submitInvite" onclick="$('#inviteForm').submit();">Enregistrer</button>
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