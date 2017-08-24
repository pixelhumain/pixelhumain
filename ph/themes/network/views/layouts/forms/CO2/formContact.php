<?php 
	$cssAnsScriptFiles = array(
    '/assets/vendor/jquery_realperson_captcha/jquery.realperson.css',
    '/assets/vendor/jquery_realperson_captcha/jquery.plugin.js',
    '/assets/vendor/jquery_realperson_captcha/jquery.realperson.min.js'
  //  '/assets/css/referencement.css'
    );
    HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFiles, Yii::app()->theme->baseUrl); 
?>

<div class="portfolio-modal modal fade" id="formContact" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>

        <div class="container bg-white">

			<div id="form-group-contact">
				<div class="col-md-10 text-left padding-top-60 form-group">
					<h3>
						<i class="fa fa-send letter-blue"></i> 
						<small class="letter-blue">
						Envoyer un e-mail à : </small>
						<span id="contact-name" style="text-transform: none!important;"></span>
						<?php echo @$element["organizer"]["name"]; //var_dump($element); ?><br>
						<small class="">
							<small class="">Ce message sera envoyé à 
							</small>
							<b><span class="contact-email"></span></b>
						</small>
						<!-- <small>(ce formulaire de contact n'est pas encore opérationnel, merci de patienter encore quelques jours)</small> -->
					</h3>
					<hr><br>
					<div class="col-md-6">
						<label for="email"><i class="fa fa-angle-down"></i> Votre addresse e-mail*</label>
							<input class="form-control" placeholder="votre addresse e-mail : exemple@mail.com" id="emailSender">
						<br>
					</div>
					<div class="col-md-6">
						<label for="name"><i class="fa fa-angle-down"></i> Nom / Prénom</label>
							<input class="form-control" placeholder="comment vous appelez-vous ?" id="name">
						<br>
					</div>
					<div class="col-md-12">
						<label for="objet"><i class="fa fa-angle-down"></i> Objet de votre message</label>
							<input class="form-control" placeholder="c'est à quel sujet ?" id="subject">
					</div>
				</div>
				<div class="col-md-12 text-left form-group">
					<div class="col-md-12">
						<label for="message"><i class="fa fa-angle-down"></i> Votre message</label>
						<textarea placeholder="Votre message..." class="form-control txt-mail" 
								  id="message" style="min-height: 200px;"></textarea>
						<br>
						<div class="col-md-8 pull-right text-right">
							<h5 for="message" class="letter-green margin-bottom-25">
								<span class="letter-red"><i class="fa fa-lock fa-2x"></i> sécurité</span><br> merci de recopier le code ci-dessous<br>afin de valider votre message <i class="fa fa-chevron-down"></i>
							</h5>
							<input placeholder="taper le code ici" class="col-md-6 txt-captcha text-right pull-right" 
									id="captcha">

							<input value="" id="idReceiver" type="hidden">
							<input value="" id="idReceiverParent" type="hidden">
							<input value="" id="typeReceiverParent" type="hidden">
						</div>

						<div class="col-md-12 margin-top-15 pull-left">
						<hr>
						<h4 class="text-right letter-red hidden" id="conf-code-fail">
							<i class="fa fa-lock"></i> Code de sécurité incorrecte <i class="fa fa-thumbs-down"></i>
						</h4>
						<h4 class="text-right letter-red hidden" id="form-fail">
							<i class="fa fa-thumbs-down"></i>
						</h4>
						<button type="submit" class="btn btn-success pull-right" id="btn-send-mail">
							<i class="fa fa-send"></i> Envoyer le message
						</button>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12 text-center hidden" id="conf-send-mail">
				<h2 class="letter-green margin-top-50">
					<i class="fa fa-thumbs-up"></i> Votre message a bien été envoyé<br>
					<small>A l'addresse suivante : 
						<b><span class="contact-email" style="text-transform: none!important"></span></b>
					</small>
				</h2>
				<h5 class="text-center">
					Merci pour votre message
				</h5><br>
				<button class="lbh btn btn-success tooltips"
					data-dismiss="modal" data-target="formContact">
					<b><i class="fa fa-check"></i> OK</b>
				</button>
				<hr style="margin-bottom: 350px;">
			</div>

			<div class="col-md-12 hidden" id="conf-fail-mail">
				<h4 class="text-center letter-red">
					<i class="fa fa-thumbs-down"></i><br>Suite à une erreur technique<br>votre message n'a pas pu être envoyé.
				</h4>
				<h5 class="text-center">
					Veuillez nous en excuser
				</h5>
				<hr style="margin-bottom: 350px;">
			</div>
		</div>
	</div>
</div>

<script>

var currentCategory = "";

jQuery(document).ready(function() {
    
	$("#btn-send-mail").click(function(){
		sendEmail();
	});

	$('#emailSender').filter_input({regex:'[^<>#\"\`/\(|\)/\\\\]'});
	$('#name').filter_input({regex:'[^<>#\"\`/\(|\)/\\\\]'});
	$('#message').filter_input({regex:'[^<>#\"\`/\(|\)/\\\\]'});
	$('#subject').filter_input({regex:'[^<>#\"\`/\(|\)/\\\\]'});

	$("#captcha").realperson({length: 4});
});


function sendEmail(){
	var emailSender = $("#emailSender").val();
	var subject = $("#subject").val();
	var name = $("#name").val();
	var message = $("#message").val();

	var idReceiver = $("#idReceiver").val();
	var idReceiverParent = $("#idReceiverParent").val();
	var typeReceiverParent = $("#typeReceiverParent").val();
	
	$("#form-fail").html("");

	if(emailSender == "") 	$("#form-fail").append("<br>Merci d'indiquer votre addresse e-mail <i class='fa fa-thumbs-down'></i>");
	if(name == "") 			$("#form-fail").append("<br>Merci d'indiquer votre nom <i class='fa fa-thumbs-down'></i>");
	if(message == "") 		$("#form-fail").append("<br>Votre message est vide ! <i class='fa fa-thumbs-down'></i>");

	if($("#form-fail").html()!="") { $("#form-fail").removeClass("hidden"); return }
	else $("#form-fail").addClass("hidden");

	var params = { 	idReceiver: idReceiver,
					idReceiverParent: idReceiverParent,
					typeReceiverParent: typeReceiverParent,

					emailSender: emailSender, 
	        		subject:subject, 
	        		names:name,
	        		contentMsg	: message,
	        		captchaUserVal: $("#captcha").val(),
	        		captchaHash: $("#captcha").realperson('getHash')
	        	};

	console.log("sendMail", params);
	//toastr.error("L'envoie d'email est désactivé pour l'instant, retentez votre chance dans quelques jours !");
	//return;

	$.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+"/app/sendmailformcontactprivate",
        data: params,
        success:
            function(data) {
                if(data.res == true){
                	toastr.success("Votre message a bien été envoyé");
                	$("#conf-send-mail").removeClass("hidden");
                	$("#conf-code-fail, #conf-fail-mail, #form-group-contact").addClass("hidden");
                	$("#subject").val("");
					$("#message").val("");
					$("#captcha").val("");
                	KScrollTo("#conf-send-mail");
                }else{
                	if(typeof data.captcha != "undefined" && data.captcha == false){
                		toastr.error("Code de sécurité invalide");   	
	                	$("#conf-code-fail").removeClass("hidden");
	                	$("#conf-fail-mail, #conf-send-mail").addClass("hidden");
                	}else{
	                	toastr.error("Une erreur est survenue pendant l'envoie de votre message");   	
	                	$("#conf-fail-mail").removeClass("hidden");
	                	$("#conf-send-mail, #form-group-contact").addClass("hidden");

	                	if(typeof data.telalpha!="undefined")
	                		$("#telalpha").html(data.telalpha);

	                	KScrollTo("#conf-fail-mail");
	                }
                } 				 
            },
        error:function(xhr, status, error){
            toastr.error("Une erreur est survenue pendant l'envoie de votre message - error");
            $("#conf-fail-mail").removeClass("hidden");
        	$("#conf-send-mail, #form-group-contact").addClass("hidden");
        	KScrollTo("#conf-fail-mail");
        },
        statusCode:{
                404: function(){
                	toastr.error("Une erreur est survenue pendant l'envoie de votre message - 404");
                	$("#conf-fail-mail").removeClass("hidden");
	            	$("#conf-send-mail, #form-group-contact").addClass("hidden");
	            	KScrollTo("#conf-fail-mail");
            }
        }
    });
}

</script>