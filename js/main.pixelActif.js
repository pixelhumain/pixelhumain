function stepperPixelsActifs(id){
	$('#pixelsactifs1').modal('hide');
	$('#pixelsactifs2').modal('hide');
	$('#pixelsactifs3').modal('hide');
}

$(document).ready(function() {  alert();
	$("#tags,#actionType").select2(); 
	//$("#type").select2({ allowClear : true }); 
	/* l'appel direct � la fonction stepperPixelsActifs via un bouton ne marche pas, il faut passer par l'�v�nement d'abord */
	$('.modalNext').click(function(){
		stepperPixelsActifs(this.href);
	});
	
	/* Cacher la combo Repr�sentant si citoyen est s�lectionn� */
	$('#genreType').change(function(){
		if($(this).val()=="citizen")
			$('#pilot').hide();
		else
			$('#pilot').show();
	});
	/* Appel depuis le bouton filtrer ListePixelsActifs.php : passe en url les param�tres du filtre */
	$('#filtrer').click(function(){
		var urldeb =window.location.pathname;
		
		var param='?';
		if($('#cpFilter').val()!='' ) /*  && isNumber($('#cpFilter').val()) */
			param += 'cp=' + $('#cpFilter').val();
		
		if($('#tags').val()!='' && $('#tags').val()!=null) 
		{	if (param !='?')
				param += '&';
			param += 'tags=' + $('#tags').val();
		}
		/* alert( "toto" +$('#tags').val()); */
		if($('#type').val()!='')
		{	if (param !='?')
				param += '&';
			param += 'type=' + $('#type').val();
		}

		window.location.pathname += param;
		//alert("window.location.href ="+ urldeb + param);
	});
	
	$(".btnArea .btn").click(function(){
		$("#area").val($(this).text());
	});
	
	/* Pr�parer envoi de la sauvegarde en BD  avec appel � save.php  */
	
	$("#newPA").click(function(){
		var pixelActifData = "";
		var inputs = $("#register1 :input");
		inputs.each(function(){
			if(pixelActifData!="")pixelActifData += "&";
			pixelActifData += this.id+"="+this.value;
		});
		inputs = $("#register2 :input");
		inputs.each(function(){
			if(pixelActifData!="")pixelActifData += "&";
			pixelActifData += this.id+"="+this.value;
		});
		inputs = $("#register3 :input");
		inputs.each(function(){
			if(pixelActifData!="")pixelActifData += "&";
			pixelActifData += this.id+"="+this.value;
		});
		
		alert("newPA " +pixelActifData );
		 $.ajax({
		  type: "POST",
		  url: "save.php",
		  data: pixelActifData,
		  success: function(data){
			if(data.result==true)
				window.location.reload();
			else
				alert("ERROR");
		  },
		  dataType: 'json'
		});
	});	
	
	/* D�finition des �l�m�nts obligatoires */
	$('#register').validate(
			 {
		  rules: {
			name: {
			  minlength: 2,
			  required: true
				}
			},
		   highlight: function(element) {
				$(element).removeClass('success').addClass('error');
			},
		   success: function(element) {
				element
				.text('OK!').addClass('valid')
				.removeClass('error').addClass('success');
			}
	});
		
});