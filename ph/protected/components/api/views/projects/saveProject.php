<div class="fss">
	url : /ph/<?php echo $this::$moduleKey?>/api/saveProject<br/>
	method type : POST <br/>
	Form inputs : email,postalcode,pwd,phoneNumber(is optional)<br/>
	return json object {"result":true || false}
</div>
<div class="apiForm saveProject">
	name : <input type="text" name="namesaveProject" id="namesaveProject" value="<?php echo $this::$moduleKey?>1" /><br/>
	admin email* : <input type="text" name="emailsaveProject" id="emailsaveProject" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /><br/>
	tags : <input type="text" name="tagssaveProject" id="tagssaveProject" value="lois,anonymat,vote" placeholder="ex:social,solidaire...etc"/>(comma seperated)<br/>
	scope* : cp ou quartier : <input type="text" name="postalcodesaveProject" id="postalcodesaveProject" value="97421" />(comma seperated)<br/>
		
	<a href="javascript:saveProject()">Test it</a><br/>
	<a href="javascript:getSession()">Get it</a><br/>
	<div id="saveProjectResult" class="result fss"></div>
	<script>
		function saveProject(){
			params = { "email" : $("#emailsaveProject").val() , 
			    	   "name" : $("#namesaveProject").val() , 
			    	   "tags" : $("#tagssaveProject").val(),
			    	   "cp" : $("#postalcodesaveProject").val(),
			    	   "type" : "project",
			    	   "app" : "<?php echo $this::$moduleKey?>" };
			testitpost("saveProjectResult",baseUrl+'/<?php echo $this::$moduleKey?>/api/saveProject',params);
		}
		function getSession(){
			params = { "where" : { 
						   "email" : $("#emailsaveProject").val() , 
				    	   "name" : $("#namesaveProject").val() ,
				    	   "type" : "project"
			    	   	},
			    	   	"collection":"projects"
			    	};
			testitpost("saveProjectResult",baseUrl+'/<?php echo $this::$moduleKey?>/api/getby',params);
		}
	</script>
</div>