<div class="fss">

	Todo : collection List as parameter<br/>
	Todo : build available fields list dynamically<br/>
	collections : 
	<select id="getbyCollection" onchange="$('#getbyMicroformat').val(collection2Microformat[$(this).val()])">
		<option value="<?php echo Survey::COLLECTION?>"><?php echo Survey::COLLECTION ?></option>
		<option value="<?php echo Event::COLLECTION?>"><?php echo Event::COLLECTION ?></option>
		<option value="<?php echo CitoyenType::COLLECTION?>"><?php echo CitoyenType::COLLECTION ?></option>
		<option value="<?php echo Group::COLLECTION?>"><?php echo Group::COLLECTION ?></option>
	</select><br/>

	type : 
	<select id="getbyType">
		<option></option>
		<option value="<?php echo Survey::TYPE_SURVEY?>">Survey : <?php echo Survey::TYPE_SURVEY?></option>
		<option value="<?php echo Survey::TYPE_ENTRY?>">Survey : <?php echo Survey::TYPE_ENTRY?></option>
	</select><br/>


	fields : <input type="text" name="getbyFilter" id="getbyFilter" value="email" />(comma seperated)<br/>
	tags : <input type="text" name="getbyTags" id="getbyTags" value="social" />(comma seperated for or operator, + for and operator )<br/>
	cp : <input type="text" name="getbyCP" id="getbyCP" value="97421" /><br/>
	microformat : <input type="text" name="getbyMicroformat" id="getbyMicroformat" /><br/>
	application : <input type="text" name="getbyApplication" id="getbyApplication" value="<?php echo $this->module->id?>" /><br/>
	<a class="btn" href="javascript:getby()">Test it</a> <a class="btn" href="javascript:getby(1)">as Json</a><br/>
	<br/><div id="getbyResult" class="result fss"></div>
	<script>
		var collection2Microformat = {
			"<?php echo Event::COLLECTION?>":"eventFormRDF",
			"<?php echo Survey::COLLECTION?>":"<?php echo Survey::COLLECTION?>",
			"<?php echo CitoyenType::COLLECTION?>":"personFormRDF",
			"<?php echo Group::COLLECTION?>":"<?php echo Group::COLLECTION?>"
		}
		function getby(asjson){
			fields = $("#getbyFilter").val(); 
			tags   = $("#getbyTags").val(); 
			type   = $("#getbyType").val(); 

			params = {
				"collection":$("#getbyCollection").val(),
				"where":{}
			}; 
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
				
			}
			ands = [];
			if($("#getbyType").val())
				ands.push({"type":$("#getbyType").val()});
			
			if($("#getbyCP").val())
				ands.push({"cp":$("#getbyCP").val()});

			if($("#getbyApplication").val()){
				appKey = "applications."+$("#getbyApplication").val();
				appMap = {};
				appMap[appKey] = {'$exists':true};
				ands.push(appMap);
			}

			params.where["$and"] = ands;

			callback = (!asjson) ? showAsColumn : null ;
			testitpost("getbyResult",baseUrl+'/<?php echo $this->module->id?>/api/getby',params,callback);
		}
	</script>
</div>