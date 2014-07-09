<div class="apiForm saveSession">
	name : <input type="text" name="namesaveSession" id="namesaveSession" value="<?php echo $this->module->id?>1" /><br/>
	admin email* : <input type="text" name="emailsaveSession" id="emailsaveSession" value="magninpierre@wanadoo.fr" /><br/>
	tags : <input type="text" name="tagssaveSession" id="tagssaveSession" value="lois,anonymat,vote" placeholder="ex:social,solidaire...etc"/>(comma seperated)<br/>
	scope* : cp ou quartier : <input type="text" name="postalcodesaveSession" id="postalcodesaveSession" value="97421" />(comma seperated)<br/>
		
	<a class="btn" href="javascript:saveSession()">Test it</a><br/>
	<a class="btn" href="javascript:getSession()">Get it</a><br/>
	<div id="saveSessionResult" class="result fss"></div>
	<script>
		function saveSession(){
			params = { "email" : $("#emailsaveSession").val() , 
			    	   "name" : $("#namesaveSession").val() , 
			    	   "tags" : $("#tagssaveSession").val(),
			    	   "cp" : $("#postalcodesaveSession").val(),
			    	   "type" : "survey",
			    	   "app" : "survey" };
			testitpost("saveSessionResult",baseUrl+'/<?php echo $this->module->id?>/api/saveSession',params);
		}
		function getSession(){
			params = { "where" : { 
						   "email" : $("#emailsaveSession").val() , 
				    	   "name" : $("#namesaveSession").val() ,
				    	   "type" : "survey"
			    	   	},
			    	   	"collection":"surveys"
			    	};
			testitpost("saveSessionResult",baseUrl+'/<?php echo $this->module->id?>/api/getby',params);
		}
	</script>
</div>