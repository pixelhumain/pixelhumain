<div class="fss">
	cp* : <input type="text" name="postalcodegetPeople" id="postalcodegetPeople" value="97421" /><br/>
	<a href="javascript:getpeopleby()">Test it</a><br/>
	<a href="javascript:countpeopleby()">Count it</a><br/>
	<div id="getPeopleResult" class="result fss"></div>
	<script>
		function getpeopleby(){
			params = { 
				"cp" : $("#postalcodegetPeople").val(),
				"app" : "<?php echo $this->module->id?>"
			 };
			testitpost("getPeopleResult",baseUrl+'/<?php echo $this->module->id?>/api/getpeopleby',params);
		}
		function countpeopleby(){
			params = { 
				"cp" : $("#postalcodegetPeople").val(),
				"app" : "<?php echo $this->module->id?>",
				"count" : 1
			};
			testitpost("getPeopleResult",baseUrl+'/<?php echo $this->module->id?>/api/getpeopleby/count/1',params);
		}
	</script>
</div>