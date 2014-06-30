<div class="fss">
	url : /ph/<?php echo $this::$moduleKey?>/api/getby<br/>
	method type : POST <br/>
	type : <select id="getbyType">
		<option value="survey">Surveys</option>
		<option value="entry">Entries</option>
	</select><br/>
	fields : <input type="text" name="getbyFilter" id="getbyFilter" value="email" />(comma seperated)<br/>
	tags : <input type="text" name="getbyTags" id="getbyTags" value="social" />(comma seperated)<br/>
	<a href="javascript:getby()">Test it</a><br/>
	<div id="getbyResult" class="result fss"></div>
	<script>
		function getby(){
			fields = $("#getbyFilter").val(); 
			tags = $("#getbyTags").val(); 
			type = $("#getbyType").val(); 
			params = {"collection":"surveys","where":{}}; 
			params.fields = fields.split(",");
			if(tags){
				tagList = [];
				sep = ",";
				op = "$or"
				if(tags.indexOf("+")>0){
					sep = "+";
					op = "$and"
				}
				$.each(tags.split(sep), function(i,v){7
					tagList.push({'tags':v});
				});
				params.where[op] = tagList;
				params.where["$and"] = [{"type":type}];
			}
			testitpost("getbyResult",baseUrl+'/<?php echo $this::$moduleKey?>/api/getby',params);
		}
	</script>
</div>