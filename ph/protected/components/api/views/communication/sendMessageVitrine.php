<div class="fss">

commentaire  : <textarea name="sendCommentmsg" id="sendCommentmsg"></textarea> <br/>
email(s) : <textarea type="text" name="sendCommentemail" id="sendCommentemail"><?php echo $this->module->id?>@<?php echo $this->module->id?>.com</textarea><br/>
séparé par des virgules<br/>
code postal : <textarea type="number" name="cpComment" id="cpComment"></textarea><br/>

<a class="btn" href="javascript:sendCommentVitrine()">Send it</a><br/>

<div id="sendCommentResult" class="result fss"></div>
<script>
	function sendCommentVitrine(){
		params = { 
    	   "email" : $("#sendCommentemail").val() , 
    	   "msg" : $("#sendCommentmsg").val(),
    	   "cp" : $("#cpComment").val(),
    	   };
		ajaxPost("sendCommentResult",baseUrl+'/<?php echo $this->module->id?>/api/sendmessagevitrine',params);
	}
</script>
</div>