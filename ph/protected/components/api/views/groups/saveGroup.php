<div class="apiForm saveGroup">
	name : <input type="text" name="namesaveGroup" id="namesaveGroup" value="Asso1" /><br/>
	email* : <input type="text" name="emailsaveGroup" id="emailsaveGroup" value="<?php echo $this->module->id?>@<?php echo $this->module->id?>.com" /> (personne physique responsable )<br/>
	cp* : <input type="text" name="postalcodesaveGroup" id="postalcodesaveGroup" value="97421" /><br/>
	phoneNumber : <input type="text" name="phoneNumbersaveGroup" id="phoneNumbersaveGroup" value="1234" />(for SMS)<br/>
	tags : <input type="text" name="tagssaveGroup" id="tagssaveGroup" value="" placeholder="ex:social,solidaire...etc"/><br/>
	type : <select name="typesaveGroup" id="typesaveGroup" onchange="typeChanged()">
				<option value="association">Association</option>
				<option value="entreprise">Entreprise</option>
				<option value="group">Groupe de personne</option>
				<option value="event">Evenement</option>
			</select><br/>
	<span class="whensaveGroup">
	when : <input type="text" name="whensaveGroup" id="whensaveGroup" value="" /><br/>
	where : <input  type="text" name="wheresaveGroup" id="wheresaveGroup" value="" /><br/>
	participant : <input  type="text" name="whosaveGroup" id="whosaveGroup" value="5370b477f6b95c280a00390c" /><br/>
	</span>
	<a href="javascript:saveGroup()">Test it</a><br/>
	<div id="saveGroupResult" class="result fss"></div>
	<script>
		function saveGroup(){
			params = { "email" : $("#emailsaveGroup").val() , 
			    	   "name" : $("#namesaveGroup").val() , 
			    	   "cp" : $("#postalcodesaveGroup").val() , 
			    	   "pwd" : $("#pwdsaveGroup").val(),
			    	   "type" : $("#typesaveGroup").val(),
			    	   "phoneNumber" : $("#phoneNumbersaveGroup").val(),
			    	   "tags" : $("#tagssaveGroup").val(),
			    	   "app":"<?php echo $this->module->id?>",
			    	};
			if( $("#whensaveGroup").val() )
				params["when"] = $("#whensaveGroup").val();
			if( $("#wheresaveGroup").val() )
				params["where"] = $("#wheresaveGroup").val();
			if( $("#whosaveGroup").val() )
				params["group"] = $("#whosaveGroup").val();
			
			testitpost("saveGroupResult", baseUrl+'/<?php echo $this->module->id?>/api/saveGroup',params);
		}
		function typeChanged(){
			console.log( $("#typesaveGroup").val() );
			if ($("#typesaveGroup").val() == "event") {
				$(".whensaveGroup").show();
			} else {
				$(".whensaveGroup").hide();
			}
		}
		initT['datepickerInit'] = function(){
			$("#whensaveGroup").datepicker();
			typeChanged();
		};
	</script>
</div>