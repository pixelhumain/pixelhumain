<div class="fss">
	cp* : <input type="text" name="postalcodegetPeople" id="postalcodegetPeople" placeholder="97421" /><br/>
	<br/>
	<a class="btn" href="javascript:getpeopleby(1)">Test it</a> <a class="btn" href="javascript:getpeopleby(0)">as Json</a> <a class="btn" href="javascript:countpeopleby()">Count it</a><br/>
	<div id="getPeopleResult" class="result fss"></div>
	<script>
		function getpeopleby(asjson){
			params = { 
				"cp" : $("#postalcodegetPeople").val(),
				"app" : "<?php echo $this->module->id?>"
			};
			callback = (asjson) ? showAsColumn : null ;
			testitpost("getPeopleResult",baseUrl+'/<?php echo $this->module->id?>/api/getpeopleby',params,callback);
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
