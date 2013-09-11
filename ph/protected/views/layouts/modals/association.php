
<!-- Modal -->
<style>
#myAssoList ul{list-style:none}
#myAssoList li{display:inline;margin:5px;padding:10px;border:3px solid #fff;}
#myAssoList li a{color:#eee;}
#myAssoList li.created{background-color:#427FB4; border:3px solid #f5e414;}
#myAssoList li.member{background-color:#427FB4}
</style>
<div id="association" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Vie associative ?</h3>
  </div>
  <div class="modal-body" style="max-height:550px" >
  <p> si vous gérer une ou plusieurs associations ou etes simplement membre
   <br/>Vous etes au bon endroit pour la valorisé, la diffuser et plus si affinité</p>
    <form id="associationForm" style="line-height:40px;">
        <section>
          	<?php 
          	    $asso = (isset(Yii::app()->session["userId"])) ? Yii::app()->mongodb->group->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"]))) : null;
          	?>
          	<ul id="myAssoList">
          		<li class="created"><a href="javascript:;" onclick="$('#assoCreate').slideToggle();return false;">Open Atlas</a></li>
          		<li class="member">Unit et Metis</li>
          		<li class="member">Bleu Ocean</li>
          		<li class="member">Globice</li>
          	</ul>
          	<br/>
          	<p><a class="btn btn-warning fb" href="javascript:;" onclick="$('#assoCreate').slideToggle();return false;"  >Je gère une association</a></p>
          	<div  id="assoCreate" class="hide">
              	<table>
                  	<tr>
                      	<td class="txtright">Email</td>
                      	<td> <input id="assoEmail" name="assoEmail" value="<?php if($asso && isset($asso['email']) ) echo $asso['email']; else $account["email"]; ?>"/></td>
                  	</tr>
                  	<tr>
                      	<td class="txtright">Nom(Raison Sociale)</td>
                      	<td> <input id="assoName" name="assoName" value="<?php if($asso && isset($asso['name']) )echo $asso['name'] ?>"/></td>
                  	</tr>
            		<tr>
                      	<td class="txtright">Pays  </td>
                      	<td>
            		<?php 
                              $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                                'data' => OpenData::$phCountries, 
                                'name' => 'countryAsso',
                              	'id' => 'countryAsso',
                                'value'=>($asso && isset($asso['country']) ) ? $asso['country'] : "Réunion",
                                'pluginOptions' => array('width' => '150px')
                              ));
                		    ?></td>
                	</tr> 
            		<tr>
                		<td class="txtright">au code postal</td>  
                		<td><input id="assoCP" name="assoCP" class="span2" value="<?php if($asso && isset($asso['cp']) )echo $asso['cp'] ?>"></td>
            		</tr>
        		    <tr >
                        <td class="txtright">Centre d'interet </td>
                        <td>
                            <?php 
                              $cursor = Yii::app()->mongodb->tags->findOne( array(), array('list'));
                              $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                                'asDropDownList' => false,
                                'name' => 'tagsAsso',
                              	'id' => 'tagsAsso',
                                'value'=>($asso && isset($asso['tags']) ) ? implode(",", $asso['tags']) : "",
                                'pluginOptions' => array(
                                    'tags' => $cursor['list'],
                                    'placeholder' => "Mots clefs descriptifs",
                                    'width' => '100%',
                                    'tokenSeparators' => array(',', ' ')
                                )));
                		    ?>
            		    </td>
        		    </tr>
        		    
        		    <tr>
                		<td class="txtright">Connecter vos membres</td>  
                		<td><input type="checkbox" id="assoMembers" name="assoMembers" <?php if($asso && isset($asso['membres']) )echo "checked" ?>></td>
            		</tr>
            		
              </table>
          </div>
          
          	<p> <a class="btn btn-warning fb" href="javascript:;" onclick="$('#assoMember').slideToggle();return false;"  >Je suis membre d'association(s)</a></p>
          	<div  id="assoMember" class="hide">
              	<table>
                  	<tr <?php if($asso && (!isset($asso['associations']) || !$asso['associations']) ){ ?>class="hidden"  <?php }?>  id="registerVieAssociativeWhat">
                        <td class="txtright">La(Les)quelle(s) </td>
                        <td>
                            <?php 
                            //TODO ajax request as you type
                              $names = array();
                              foreach(iterator_to_array(Yii::app()->mongodb->group->find( array("type"=>"association"), array("name" => 1) )) as $a)
                                  array_push($names, $a['name']);
                                  //$assoNames[$a['name']] = $a['name'] ;
                              
                              $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                                'asDropDownList' => false,
                                'name' => 'listAssociation',
                              	'id' => 'listAssociation',
                                'value'=>($account && isset($account['associations']) ) ? implode(",", $account['associations']) : "",
                                'pluginOptions' => array(
                                    'tags' => $names,
                                    'placeholder' => "Nom(s) d'association(s)",
                                    'width' => '100%',
                                    'tokenSeparators' => array(',', ' ')
                                )));
                		    ?>
            		    </td>
        		    </tr>
                    <p>Si vous ajouté une association qui n'existe pas <br/>
                    Merci d'inviter le président a rajouter son association au PH</p>
              </table>
             </div>
        </section>
        
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button class="btn btn-primary" id="submitAccount" onclick="$('#register2').submit();">Enregistrer</button>
  </div>
</div>
<!-- Modal -->

<script type="text/javascript">
initT['assoModalsInit'] = function(){
    showEvent("registerVieAssociative");
};
</script>