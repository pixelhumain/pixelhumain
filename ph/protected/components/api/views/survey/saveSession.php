<div class="fss">
	url : /ph/<?php echo $this::$moduleKey?>/api/saveSession<br/>
	method type : POST <br/>
	Form inputs : email,postalcode,pwd,phoneNumber(is optional)<br/>
	return json object {"result":true || false}
</div>
<div class="apiForm saveSession">
	name : <input type="text" name="namesaveSession" id="namesaveSession" value="<?php echo $this::$moduleKey?>1" /><br/>
	admin email* : <input type="text" name="emailsaveSession" id="emailsaveSession" value="magninpierre@wanadoo.fr" /><br/>
	tags : <input type="text" name="tagssaveSession" id="tagssaveSession" value="lois,anonymat,vote" placeholder="ex:social,solidaire...etc"/>(comma seperated)<br/>
	scope* : cp ou quartier : <input type="text" name="postalcodesaveSession" id="postalcodesaveSession" value="97421" />(comma seperated)<br/>
		
	<a href="javascript:saveSession()">Test it</a><br/>
	<a href="javascript:getSession()">Get it</a><br/>
	<div id="saveSessionResult" class="result fss"></div>
	<script>
		function saveSession(){
			params = { "email" : $("#emailsaveSession").val() , 
			    	   "name" : $("#namesaveSession").val() , 
			    	   "tags" : $("#tagssaveSession").val(),
			    	   "cp" : $("#postalcodesaveSession").val(),
			    	   "type" : "survey",
			    	   "app" : "survey" };
			testitpost("saveSessionResult",baseUrl+'/<?php echo $this::$moduleKey?>/api/saveSession',params);
		}
		function getSession(){
			params = { "where" : { 
						   "email" : $("#emailsaveSession").val() , 
				    	   "name" : $("#namesaveSession").val() ,
				    	   "type" : "survey"
			    	   	},
			    	   	"collection":"surveys"
			    	};
			testitpost("saveSessionResult",baseUrl+'/<?php echo $this::$moduleKey?>/api/getby',params);
		}
	</script>
</div>