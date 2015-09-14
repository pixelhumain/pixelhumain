<div class="fss">
	
	type : <input type="text" name="getnodebyType" id="getnodebyType" value="friends" /><br/>
	<a class="btn" href="javascript:getnodeby()">Test it</a><br/>
	<a class="btn" href="javascript:countgetnodeby()">Count it</a><br/>
	<br/><div id="getnodebyResult" class="result fss"></div>
	<script>
		function getnodeby(){
			testitget("getnodebyResult",baseUrl+'/<?php echo $this->module->id?>/api/getnodeby/type/'+$("#getnodebyType").val());
		}
		function countgetnodeby(){
			testitget("getnodebyResult",baseUrl+'/<?php echo $this->module->id?>/api/getnodeby/type/'+$("#getnodebyType").val()+'/count/1');
		}
	</script>
</div>