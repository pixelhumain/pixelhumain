<!-- Simple Node element requesting only a name to create a node  -->
<p> <?php if(isset($txt))echo $txt?></p>
    <form id="flashForm" action="">
    	<section>
            <?php echo $key?> : <input type="text" name='<?php echo $key?>' value=""></input>
            <input type="hidden" name='key' value="<?php echo $key?>"></input>
            <input type="hidden" name='collection' value="<?php echo $collection?>"></input>
            <input type="hidden" name='id' value="<?php echo $id?>"></input>
            <br/>
            <a class="btn btn-warning " href="javascript:;" onclick="$('#flashForm').submit(); return false;"  >Enregistrer</a>
		</section>
	</form>
<script type="text/javascript">

	$("#flashForm").submit( function(event){
    	log($(this).serialize());
    	event.preventDefault();
    	//$("#flashInfo").modal('hide');
    	toggleSpinner();

    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/common/save/",
    	  data: $(this).serialize(),
    	  success: function(data){
    		  $("#flashInfoContent").html(data.msg);
        	  //$("#flashInfo").modal('show');
				
    		  toggleSpinner();
    	  },
    	  dataType: "json"
    	});
    
    });
</script>  
   

    