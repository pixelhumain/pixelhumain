<a href="/ph/<?php echo $this->module->id?>/api/getpeopleby" >Get People by codepostal </a><br/>
<div class="fss">
	url : /ph/<?php echo $this->module->id?>/api/getpeopleby<br/>
	method type : POST <br/>
	cp* : <input type="text" name="postalcodegetPeople" id="postalcodegetPeople" value="97421" /><br/>
	<a href="javascript:getpeopleby()">Test it</a><br/>
	<a href="javascript:countpeopleby()">Count it</a><br/>
	<div id="getPeopleResult" class="result fss"></div>
	<script>
		function getpeopleby(){
			params = { "cp" : $("#postalcodegetPeople").val() };
			testitpost("getPeopleResult",baseUrl+'/<?php echo $this->module->id?>/api/getpeopleby',params);
		}
		function countpeopleby(){
			params = { "cp" : $("#postalcodegetPeople").val() };
			testitpost("getPeopleResult",baseUrl+'/<?php echo $this->module->id?>/api/getpeopleby/count/1',params);
		}
	</script>
</div>