	<ul>
	<li class="block">
		<a href="/ph/<?php echo $this::$moduleKey?>/default/sendMessage"  id="blocksendMessage">Send a Message to people</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/default/sendMessage<br/>
			method type : POST <br/>
			params : <br/>
			message  : <textarea name="sendMessagemsg" id="sendMessagemsg"></textarea> <br/>
			email(s) : <textarea type="text" name="sendMessageemail" id="sendMessageemail"><?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com</textarea><br/>
			séparé par des virgules<br/>
			<a href="javascript:sendMessage()">Send it</a><br/>
			<select id="sendMessagePeople">
				<option></option>
				<?php 
				$groups = Yii::app()->mongodb->groups->find( array( "applications.".$this::$moduleKey.".usertype" => Group::TYPE_ASSOCIATION ));
				foreach ($groups as $value) {
					echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
				}
				?>
			</select>
			<a href="javascript:setPeople()">Get People </a><br/>
			<div id="sendMessageResult" class="result fss"></div>
			<script>
				function sendMessage(){
					params = { 
			    	   "email" : $("#sendMessageemail").val() , 
			    	   "msg" : $("#sendMessagemsg").val(),
			    	   "app":"<?php echo $this::$moduleKey?>"
			    	   };
					testitpost("sendMessageResult",'/ph/<?php echo $this::$moduleKey?>/default/sendMessage',params);
				}
				function setPeople(){
					$("#sendMessageemail").val("");
					$.ajax({
					    url:'/ph/<?php echo $this::$moduleKey?>/default/getPeopleBy',
					    type:"POST",
					    data:{ "name":$("#sendMessagePeople").val()},
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
	</li>
	</ul>