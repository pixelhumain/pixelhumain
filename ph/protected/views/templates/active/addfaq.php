
<!-- Modal -->
<div id="addFaqForm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Proposer votre idée</h3>
  </div>
  <div class="modal-body">
    <p> Ce projet est un réseau social ouvert, un squelette de module d'interet general, qui accueillera </p>
    <form id="faqForm" style="line-height:40px;">
        <section>
        	<table>
              	<tr>
                  	<td class="txtright">Titre</td>
                  	<td> <input id="question" name="question" value=""/></td>
              	</tr>
          	</table>
          	<textarea name="answer" style="width:95%" rows=9></textarea>
        </section>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
    <button class="btn btn-primary" id="submitFaq" onclick="$('#faqForm').submit();">Enregistrer</button>
  </div>
</div>
<!-- Modal -->

<script type="text/javascript">
var qa = null;
initT['FaqModalsInit'] = function(){
    $("#faqForm").submit( function(event){
    	event.preventDefault();
    	$("#addFaqForm").modal('hide');
    	toggleSpinner();
    	qa = $("#faqForm").serialize();
    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/index.php/data/faq",
    	  data: $("#faqForm").serialize(),
    	  success: function(data){
    			  $("#flashInfo .modal-body").html(data.msg);
    			  toggleSpinner();
    		  	  $("#flashInfo").modal('show');
    		  	  $( ".acc-container" ).append( '<div class="acc-btn"><h1 class="selected">'+qa.question+'</h1></div><div class="acc-content"><div class="acc-content-inner"><p>'+qa.answer+'</p></div></div>' );
    	  },
    	  dataType: "json"
    	});
    });

    showEvent("registerHelpout");
};

</script>