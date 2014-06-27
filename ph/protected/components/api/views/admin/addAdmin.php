<div class="apiForm addAdminEntry">
	<select id="citizenaddAdmin">
		<option></option>
		<?php 
		
			$users = PHDB::find( PHType::TYPE_CITOYEN, array( "applications.".$this->module->id => array('$exists'=>true) ) );
			foreach ($users as $u) {
				echo '<option value="'.$u["_id"].'">'.(( isset( $u["email"] ) ) ? $u["email"] : $u["_id"])." ".'</option>';
			}
		?>
	</select><br/>
	<select id="rightaddAdmin">
		<option></option>
		<option value="admin">admin</option>
	</select><br/>
	<a href="javascript:addAdminEntry()">Test it</a><br/>
	<div id="addAdminEntryResult" class="result fss"></div>
	<script>
		function addAdminEntry(){
			params = {  "id" : $("#citizenaddAdminEntry").val() , 
			    		"app" : "<?php echo $this->module->id?>"};
			testitpost("addAdminEntryResult",baseUrl+'/<?php echo $this::$moduleKey?>/api/addappadmin',params);
		}
		
	</script>
</div>