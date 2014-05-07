
<!-- Modal -->
<div class="modal fade" id="entreprise" tabindex="-1" role="dialog" aria-labelledby="entrepriseLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="entrepriseLabel">Monde de l'entreprise ?</h3>
  </div>
  <div class="modal-body" style="max-height:550px" >
  <p> si vous gérer une ou plusieurs entreprises ou voulez simplement partager une entreprise qui offres un services de qualité
   <br/>Vous etes au bon endroit pour la valorisé, la diffuser et plus si affinité</p>
    <form id="entrepriseForm" style="line-height:40px;">
        <section>
          	<?php 
          	    $entreprise = (isset(Yii::app()->session["userId"])) ? Yii::app()->mongodb->group->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"]))) : null;
          	?>
          	<table>
              	<tr>
                  	<td class="txtright"></td>
                  	<td> <?php if($entreprise && isset($entreprise['email']) )echo $entreprise['email'] ?></td>
              	</tr>
              	
                <tr <?php if($entreprise && (!isset($entreprise['entreprises']) || !$entreprise['entreprises']) ){ ?>class="hidden"  <?php }?>  id="registerVieEntrepriseWhat">
                    <td class="txtright">La(Les)quelle(s) </td>
                    <td>
                        <?php 
                        //TODO ajax request as you type
                          $names = array();
                          foreach(iterator_to_array(Yii::app()->mongodb->group->find( array("type"=>"entreprise"), array("name" => 1) )) as $a)
                              array_push($names, $a['name']);
                              //$assoNames[$a['name']] = $a['name'] ;
                          
                          $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'asDropDownList' => false,
                            'name' => 'listEntreprise',
                          	'id' => 'listEntreprise',
                            'value'=>($entreprise && isset($entreprise['entreprises']) ) ? implode(",", $entreprise['entreprises']) : "",
                            'pluginOptions' => array(
                                'tags' => $names,
                                'placeholder' => "Nom(s) d'association(s)",
                                'width' => '100%',
                                'tokenSeparators' => array(',', ' ')
                            )));
            		    ?>
        		    </td>
    		    </tr>
                
    		    <tr >
                    <td class="txtright">Type d'action </td>
                    <td>
                        <?php 
                          $cursor = Yii::app()->mongodb->lists->findOne( array("name"=>"tags"), array('list'));
                          $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'asDropDownList' => false,
                            'name' => 'tagsEntreprise',
                          	'id' => 'tagsEntreprise',
                            'value'=>($entreprise && isset($entreprise['tags']) ) ? implode(",", $entreprise['tags']) : "",
                            'pluginOptions' => array(
                                'tags' => $cursor['list'],
                                'placeholder' => "Mots clefs descriptif",
                                'width' => '100%',
                                'tokenSeparators' => array(',', ' ')
                            )));
            		    ?>
        		    </td>
    		    </tr>
          </table>
             
        </section>
        
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button class="btn btn-primary" id="submitAccount" onclick="$('#register2').submit();">Enregistrer</button>
  </div>
</div>
  </div>
</div>
<!-- Modal -->