<div class="fss">

message  : <textarea name="sendMessagemsg" id="sendMessagemsg"></textarea> <br/>
email(s) : <textarea type="text" name="sendMessageemail" id="sendMessageemail"><?php echo $this->module->id?>@<?php echo $this->module->id?>.com</textarea><br/>
séparé par des virgules<br/>
<input type="checkbox" id="emailCopy"/>send email copy <br/>
<a class="btn" href="javascript:sendMessage()">Send it</a><br/>
<select id="sendMessagePeople">
	<option></option>
	<?php 
	$groups = Yii::app()->mongodb->groups->find( array( "type" => new MongoRegex("/.*/") ));
	foreach ($groups as $value) {
		echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
	}
	?>
</select>
<a class="btn" href="javascript:setPeople()">Get People </a><br/>
<div id="sendMessageResult" class="result fss"></div>
<script>
	function sendMessage(){
		params = { 
    	   "email" : $("#sendMessageemail").val() , 
    	   "emailCopy" : $("#emailCopy").val() , 
    	   "msg" : $("#sendMessagemsg").val() 
    	   };
		ajaxPost("sendMessageResult",baseUrl+'/egpc/api/sendMessage',params);
	}
	function setPeople(){
		$("#sendMessageemail").val("");
		$.ajax({
		    url:baseUrl+'/egpc/api/getPeopleBy',
		    type:"POST",
		    data:{ "groupname":$("#sendMessagePeople").val()},
		    datatype : "json",
		    success:function(data) {
		    	list = "";
			    $.each(data,function(k,v){
			      	list += (list == "") ? v.email : ","+v.email ;
			    })
		      	console.log(list);
		      	$("#sendMessageemail").val(list);
			      	
		    },
		    error:function (xhr, ajaxOptions, thrownError){
		      $("#"+id).html(data);
		    } 
		  });
	}
</script>
</div>