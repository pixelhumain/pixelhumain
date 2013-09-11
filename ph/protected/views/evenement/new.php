<style>
h2 {
    font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
} 
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2>Creer un évènement</h2>
    <p>Tous le monde peut déposé un évennement local si celui ci est d'interet général </p>
 <form id="eventForm" style="line-height:40px;">
        <section>
        	<?php 
        	$event = (isset(Yii::app()->session["userId"])) ? Yii::app()->mongodb->group->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"]))) : null;
        	?>
          	<table>
              	<tr>
                  	<td class="txtright">Nom </td>
                  	<td> <input id="eventName" name="eventName" value="<?php if($event && isset($event['name']) )echo $event['name'] ?>"/></td>
              	</tr>
              	<tr>
                  	<td class="txtright">Contact </td>
                  	<td> <input id="eventContact" name="eventContact" value="<?php if($event && isset($event['contact']) )echo $event['contact'] ?>"/></td>
              	</tr>
              	<tr>
                  	<td class="txtright">Site Web</td>
                  	<td> <input id="eventSite" name="eventSite" value="<?php if($event && isset($event['site']) )echo $event['site'] ?>"/></td>
              	</tr>
        		<tr>
                  	<td class="txtright">Quand </td>
                  	<td> 
                      	<div class="input-append">
                            <?php $this->widget(
                                        'yiiwheels.widgets.daterangepicker.WhDateRangePicker',
                                        array(
                                            'name' => 'eventWhen',
                                            'htmlOptions' => array(
                                                'placeholder' => 'Select date'
                                            )
                                        )
                                    );
                            ?>
                            <span class="add-on" style="color:black"><icon class="icon-calendar"></icon></span>
    					</div>
                  	</td>
              	</tr>
              	<tr>
                  	<td class="txtright">Où </td>
                  	<td> <input id="eventWhere" name="eventWhere" value="<?php if($event && isset($event['where']) )echo $event['where'] ?>"/></td>
              	</tr>
        		<tr>
            		<td class="txtright">code postal</td>  
            		<td><input id="eventCP" name="eventCP" class="span2" value="<?php if($event && isset($event['cp']) )echo $event['cp'] ?>"></td>
        		</tr>
        		<tr>
                  	<td class="txtright">Pays  </td>
                  	<td>
        		<?php 
                         $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'data' => OpenData::$phCountries, 
                            'name' => 'countryEvent',
                          	'id' => 'countryEvent',
                            'value'=>($event && isset($event['country']) ) ? $event['country'] : "Réunion",
                            'pluginOptions' => array('width' => '150px')
                          ));
            		    ?></td>
            	</tr> 
    		    <tr >
                    <td class="txtright">Centre d'interet </td>
                    <td>
                        <?php 
                          $cursor = Yii::app()->mongodb->tags->findOne( array(), array('list'));
                          $this->widget('yiiwheels.widgets.select2.WhSelect2', array(
                            'asDropDownList' => false,
                            'name' => 'tagsEvent',
                          	'id' => 'tagsEvent',
                            'value'=>($event && isset($event['tags']) ) ? implode(",", $event['tags']) : "",
                            'pluginOptions' => array(
                                'tags' => $cursor['list'],
                                'placeholder' => "Mots clefs descriptifs",
                                'tokenSeparators' => array(',', ' ')
                            )));
            		    ?>
        		    </td>
    		    </tr>
    		    
    		    <tr>
            		<td class="txtright">Envoyer des invitations</td>  
            		<td>
            		<?php $this->widget('yiiwheels.widgets.switch.WhSwitch', array(
                        'name' => 'eventMembers',
            		    //'value'=>true
                    ));?>
            		</td>
        		</tr>
        		<tr>
        		<td></td>
        		<td>Partager votre evenement depuis le PH, lui permettra de se développer localement.</td>
        		</tr>
          </table>
             
        </section>
        
    </form>
</div></div>
<script type="text/javascript"        >
initT['animInit'] = function(){
(function ani(){
      TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
})();
};
</script>

            