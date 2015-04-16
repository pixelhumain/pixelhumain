<div class="apiForm saveProject">
	name : <input type="text" name="namesaveProject" id="namesaveProject" value="<?php echo $this->module->id?>1" /><br/>
	admin email* : <input type="text" name="emailsaveProject" id="emailsaveProject" value="<?php echo $this->module->id?>@<?php echo $this->module->id?>.com" /><br/>
	tags : <input type="text" name="tagssaveProject" id="tagssaveProject" value="lois,anonymat,vote" placeholder="ex:social,solidaire...etc"/>(comma seperated)<br/>
	scope* : cp ou quartier : <input type="text" name="postalcodesaveProject" id="postalcodesaveProject" value="97421" />(comma seperated)<br/>
		
	<a class="btn" href="javascript:saveProject()">Test it</a><br/>
	<a class="btn" href="javascript:getSession()">Get it</a><br/>
	<div id="saveProjectResult" class="result fss"></div>
	<script>
		function saveProject(){
			params = { "email" : $("#emailsaveProject").val() , 
			    	   "name" : $("#namesaveProject").val() , 
			    	   "tags" : $("#tagssaveProject").val(),
			    	   "cp" : $("#postalcodesaveProject").val(),
			    	   "type" : "project",
			    	   "app" : "<?php echo $this->module->id?>" };
			ajaxPost("saveProjectResult",baseUrl+'/<?php echo $this->module->id?>/api/saveProject',params);
		}
		function getSession(){
			params = { "where" : { 
						   "email" : $("#emailsaveProject").val() , 
				    	   "name" : $("#namesaveProject").val() ,
				    	   "type" : "project"
			    	   	},
			    	   	"collection":"projects"
			    	};
			ajaxPost("saveProjectResult",baseUrl+'/<?php echo $this->module->id?>/api/getby',params);
		}
	</script>
</div>