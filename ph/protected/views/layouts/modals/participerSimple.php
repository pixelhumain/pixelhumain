
<!-- Modal -->
<div class="modal  fade" id="participer"  tabindex="-1" role="dialog" aria-labelledby="participerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="participerLabel">Information utilisateur</h3>
  </div>
  <div class="modal-body" style="max-height:550px" >
  <p></p>
    <form id="register2" style="line-height:40px;">
        <section>
          	<table>
              	<tr>
                  	<td class="txtright"></td>
                  	<td> <?php if($account && isset($account['email']) )echo $account['email'] ?></td>
              	</tr>
              	<tr>
                  	<td class="txtright">Je m'appelle</td>
                  	<td> <input id="registerName" name="registerName" value="<?php if($account && isset($account['name']) )echo $account['name'] ?>"/></td>
              	</tr>
              	
        		<input id="typePA" name="typePA" type="hidden" value="citoyen"/>
        		<tr>
                  	<td class="txtright">j'habite </td>
                  	<td>
        		<?php 
                          $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => OpenData::$phCountries, 
                            'name' => 'countryPA',
                          	'id' => 'countryPA',
                            'value'=>($account && isset($account['country']) ) ? $account['country'] : "Réunion",
                            'pluginOptions' => array('width' => '150px')
                          ));
            		    ?></td>
            	</tr> 
        		<tr>
            		<td class="txtright">au code postal</td>  
            		<td><input id="registerCP" name="registerCP" class="span2" value="<?php if($account && isset($account['cp']) )echo $account['cp'] ?>"></td>
        		</tr>
            <tr>
                <td class="txtright">Ancien mot de passe</td>  
                <td><input type="password" id="registeroldpwd" name="registeroldpwd" class="span2"></td>
            </tr>
            <tr>
                <td class="txtright">Nouveau mot de passe</td>  
                <td><input type="password" id="registernewpwd" name="registernewpwd" class="span2" ></td>
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
</div>
</div>
<!-- Modal -->
<script type="text/javascript">
initT['AccountModalsInit'] = function(){
    $("#register2").submit( function(event){
    	event.preventDefault();
    	$("#participer").modal('hide');
    	NProgress.start();
    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/citoyens/register2",
    	  data: $("#register2").serialize(),
    	  success: function(data){
    			  $("#flashInfo .modal-body").html(data.msg);
    			  
    		  	  
    		  	  if(data.newAsso){
        		  	  alert("L'association "+data.newAsso+" a été créé pour vous, merci d'inviter le président pour confirmer.");
    		  		  $("#invitation").modal('show');
    		  	  } else
    		  		$("#flashInfo").modal('show');
              NProgress.done();
    	  },
    	  dataType: "json"
    	});
    });

    //showEvent("registerHelpout");
};

</script>