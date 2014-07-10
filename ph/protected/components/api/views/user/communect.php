<div class="apiForm communect">
	email : <input type="text" name="emailCommunect" id="emailCommunect" value="<?php echo $this->module->id?>@<?php echo $this->module->id?>.com" /><br/>
	code postal  : <input type="text" name="cpCommunect" id="cpCommunect" value="97421" /><br/>
	<a class="btn" href="javascript:communect()">Communect</a><br/>
	<br/><div id="communectResult" class="result fss"></div>
	<script>
		function communect(){
			params = { "email" : $("#emailCommunect").val() , 
			    	   "cp" : $("#cpCommunect").val()
			    	};
			testitpost("communectResult",baseUrl+'/<?php echo $this->module->id?>/api/communect',params);
		}
	</script>
	
</div>