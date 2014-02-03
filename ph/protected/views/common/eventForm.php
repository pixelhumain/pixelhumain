<!-- Simple Node element requesting only a name to create a node  -->
<p> <?php if(isset($txt))echo $txt?></p>
    <form id="flashForm" action="">
    	<section>
            desc : <input type="text" name='description' value=""></input>
            <br/>
            toto : <input type="text" name='toto' value=""></input>
            <br/>
            koko : <input type="text" name='kok' value=""></input>
            
            <input type="hidden" name='collection' value="group"></input>
            <input type="hidden" name='id' value="<?php echo $id?>"></input>
            <br/>
            <a class="btn btn-warning " href="javascript:;" onclick="$('#flashForm').submit(); return false;"  >Enregistrer</a>
		</section>
	</form>
<script type="text/javascript">

	$("#flashForm").submit( function(event){
    	log($(this).serialize());
    	event.preventDefault();
    	toggleSpinner();

    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/common/save/",
    	  data: $(this).serialize(),
    	  success: function(data){
    		  $("#flashInfoContent").html(data.msg);
    		  toggleSpinner();
    	  },
    	  dataType: "json"
    	});
    
    });
</script>  
   

    