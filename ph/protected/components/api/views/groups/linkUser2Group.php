<div class="fss">
	url : /ph/<?php echo $this::$moduleKey?>/api/linkUser2Group/email/<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com<br/>
	method type : POST <br/>
	param : <br/>
	all <?php echo $this::$moduleKey?> groups  : 
	<select id="linkUser2GroupGroup">
		<option></option>
		<?php 
		$groups = Yii::app()->mongodb->groups->find( array( "applications.".$this::$moduleKey.".usertype" => Group::TYPE_EVENT ));
		foreach ($groups as $value) {
			echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
		}
		?>
		
	</select><br/>
	email(s) : <textarea type="text" name="linkUser2Groupemail" id="linkUser2Groupemail"><?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com</textarea><br/>
	séparé par des virgules<br/>
	<span style="color:red">(TODO : link as followers)</span>
	<a href="javascript:linkUser2Group()">Link it</a><br/>
	<a href="javascript:unlinkUser2Group()">Unlink it</a><br/>
	<div id="linkUser2GroupResult" class="result fss"></div>
	<script>
		function linkUser2Group(){
			params = { 
	    	   "email" : $("#linkUser2Groupemail").val() , 
	    	   "name" : $("#linkUser2GroupGroup").val() ,
	    	   "type":"<?php echo Group::TYPE_EVENT?>"
	    	   };
			testitpost("linkUser2GroupResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/linkUser2Group',params);
		}
		function unlinkUser2Group(){
			params = { 
	    	   "email" : $("#linkUser2Groupemail").val() , 
	    	   "name" : $("#linkUser2GroupGroup").val(),
	    	   "type":"<?php echo Group::TYPE_EVENT?>",
	    	   "unlink" : true,
	    	   };
			testitpost("linkUser2GroupResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/linkUser2Group',params);
		}
	</script>
</div>