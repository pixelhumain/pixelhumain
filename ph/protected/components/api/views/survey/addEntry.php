<div class="fss">
	url : /ph/<?php echo $this::$moduleKey?>/api/addEntry<br/>
	method type : POST <br/>
	Form inputs : email,postalcode,pwd,phoneNumber(is optional)<br/>
	return json object {"result":true || false}
</div>
<div class="apiForm addEntry">
	<select id="sessionaddEntry">
		<option></option>
		<?php 
			$Surveys = Yii::app()->mongodb->surveys->find( array("type"=>"survey") );
			foreach ($Surveys as $value) {
				echo '<option value="'.$value["_id"].'">'.$value["name"]." ".$value["_id"].'</option>';
			}
		?>
	</select><br/>
	name : <input type="text" name="nameaddEntry" id="nameaddEntry" value="test1" /><br/>
	message  : <textarea name="entryaddEntry" id="entryaddEntry">this is test, can contain links</textarea> <br/>
	tags : <input type="text" name="tagsaddEntry" id="tagsaddEntry" value="" placeholder="ex:social,solidaire...etc"/>(comma seperated)<br/>
	admin email* : <input type="text" name="emailaddEntry" id="emailaddEntry" value="magninpierre@wanadoo.fr" /><br/>
	<a href="javascript:addEntry()">Test it</a><br/>
	<a href="javascript:getEntry()">Get it</a><br/>
	<div id="addEntryResult" class="result fss"></div>
	<script>
		function addEntry(){
			params = { "survey" : $("#sessionaddEntry").val() , 
					   "email" : $("#emailaddEntry").val() , 
			    	   "name" : $("#nameaddEntry").val() , 
			    	   "tags" : $("#tagsaddEntry").val() ,
			    	   "message":$("#entryaddEntry").val(),
			    	   "cp" : $("#postalcodesaveGroup").val() , 
			    	   "type" : "entry",
			    	   "app" : "survey"};
			testitpost("addEntryResult",baseUrl+'/<?php echo $this::$moduleKey?>/api/saveSession',params);
		}
		function getEntry(){
			params = { "where" : { 
						   "email" : $("#emailaddEntry").val() , 
			    	   	   "name" : $("#nameaddEntry").val() , 
				    	   "type" : "entry"
			    	   	},
			    	   	"collection":"surveys"
			    	};
			testitpost("addEntryResult",baseUrl+'/<?php echo $this::$moduleKey?>/api/getby',params);
		}
	</script>
</div>