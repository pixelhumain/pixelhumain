<a href="/ph/<?php echo $this->module->id?>/api/communect">se Comunecter</a><br/>
<div class="fss">
	se communecter c'est juste suivre l'activité d'un CP <br/>
	Il suffit d'un email et d'un CP<br/>
	method type : POST <br/>
</div>
<div class="apiForm communect">
	email : <input type="text" name="emailCommunect" id="emailCommunect" value="<?php echo $this->module->id?>@<?php echo $this->module->id?>.com" /><br/>
	code postal  : <input type="text" name="cpCommunect" id="cpCommunect" value="97421" /><br/>
	<a href="javascript:communect()">Communect</a><br/>
	<div id="communectResult" class="result fss"></div>
	<script>
		function communect(){
			params = { "email" : $("#emailCommunect").val() , 
			    	   "cp" : $("#cpCommunect").val()
			    	};
			testitpost("communectResult",baseUrl+'/<?php echo $this->module->id?>/api/communect',params);
		}
	</script>
	
</div>