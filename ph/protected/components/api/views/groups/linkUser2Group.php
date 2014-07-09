<div class="fss">
	all <?php echo $this->module->id?> groups  : 
	<select id="linkUser2GroupGroup">
		<option></option>
		<?php 
		$groups = Yii::app()->mongodb->groups->find( array( "applications.".$this->module->id.".usertype" => Group::TYPE_EVENT ));
		foreach ($groups as $value) {
			echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
		}
		?>
		
	</select><br/>
	email(s) : <textarea type="text" name="linkUser2Groupemail" id="linkUser2Groupemail"><?php echo $this->module->id?>@<?php echo $this->module->id?>.com</textarea><br/>
	séparé par des virgules<br/>
	<span style="color:red">(TODO : link as followers)</span>
	<a class="btn" href="javascript:linkUser2Group()">Link it</a><br/>
	<a class="btn" href="javascript:unlinkUser2Group()">Unlink it</a><br/>
	<div id="linkUser2GroupResult" class="result fss"></div>
	<script>
		function linkUser2Group(){
			params = { 
	    	   "email" : $("#linkUser2Groupemail").val() , 
	    	   "name" : $("#linkUser2GroupGroup").val() ,
	    	   "type":"<?php echo Group::TYPE_EVENT?>"
	    	   };
			testitpost("linkUser2GroupResult", baseUrl+'/<?php echo $this->module->id?>/api/linkUser2Group',params);
		}
		function unlinkUser2Group(){
			params = { 
	    	   "email" : $("#linkUser2Groupemail").val() , 
	    	   "name" : $("#linkUser2GroupGroup").val(),
	    	   "type":"<?php echo Group::TYPE_EVENT?>",
	    	   "unlink" : true,
	    	   };
			testitpost("linkUser2GroupResult", baseUrl+'/<?php echo $this->module->id?>/api/linkUser2Group',params);
		}
	</script>
</div>