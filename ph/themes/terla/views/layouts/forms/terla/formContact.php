<?php 
	$cssAnsScriptFiles = array(
    '/assets/vendor/jquery_realperson_captcha/jquery.realperson.css',
    '/assets/vendor/jquery_realperson_captcha/jquery.plugin.js',
    '/assets/vendor/jquery_realperson_captcha/jquery.realperson.min.js'
  //  '/assets/css/referencement.css'
    );
    HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFiles, Yii::app()->theme->baseUrl); 
?>

<style>
	.titleContact{
		color:grey;
		text-transform: none;
	}
	#form-group-contact label{
		color:grey;
		margin-top:8px;
	}

	#form-group-contact .form-control{
		background-color: #f0eded;
		color: #6c6c6c;
		border: 0px;
	}

	.realperson-text{
		text-align: right;
	}

	.colAddress{
		border-right: 3px solid #e0e0e0;
		min-height:500px;
		margin-top:50px;
		color:grey;
		font-weight: bold;
	}
</style>

<div class="col-xs-12 col-sm-3 col-md-3 colAddress">

	<h3 class="titleContact">ADDRESS</h3>
	<hr>
	<i class="fa fa-map-marker fa-2x letter-orange"></i> 18 chemin des lilas
	<br><br>
	<i class="fa fa-phone"></i> 00 00 00 00 00
	<br><br>
	<i class="fa fa-envelope"></i> <span class="letter-orange">contact@mail.com</span>
	<br>

</div>

<div class="col-xs-12 col-sm-9 col-md-9">
	<div id="form-group-contact">
		<div class="col-md-10 text-left padding-top-60 form-group">
			<h3 class="titleContact" style="margin-top: 70px;">
				<?php echo Yii::t("terla", "Contact us"); ?>
			</h3>
			<br><br>

			<div class="col-xs-8">
				<input class="form-control" placeholder="what's your name ?" id="name">
				<br>
			</div>
			<div class="col-xs-4 no-padding">
				<label for="name"><?php echo Yii::t("terla", "Name"); ?></label>
			</div>

			<div class="col-xs-8">
				<input class="form-control" placeholder="<?php echo Yii::t("terla", "your mail address : exemple@mail.com"); ?>"
						id="emailSender">
				<br>
			</div>
			<div class="col-xs-4 no-padding">
				<label for="email"><?php echo Yii::t("terla", "E-mail *"); ?></label>
			</div>

			<div class="col-xs-8">
				<input class="form-control" placeholder="<?php echo Yii::t("terla", "tourist or professional ?"); ?>" id="situation">
				<br>
			</div>
			<div class="col-xs-4 no-padding">
				<label for="email"><?php echo Yii::t("terla", "Your situation"); ?></label>
			</div>

			<div class="col-xs-8">
				<input class="form-control" placeholder="<?php echo Yii::t("terla", "what's about ?"); ?>" id="subject">
				<br>
			</div>

			<div class="col-xs-4 no-padding">
				<label for="objet"><?php echo Yii::t("terla", "Object"); ?></label>
			</div>

		</div>


		<div class="col-xs-12 text-left form-group">
			<div class="col-md-12">
				<label for="message">
					<i class="fa fa-angle-down"></i> <?php echo Yii::t("terla", "Your message"); ?>
				</label>

				<textarea placeholder="Your message..." class="form-control txt-mail" id="message"></textarea>
				
				<div class="col-md-12">
					<small for="message" class="margin-bottom-25">
						<span class="letter-red"><i class="fa fa-lock fa-2x"></i> 
							<?php echo Yii::t("terla", "security"); ?>
						</span> 
						<?php echo Yii::t("terla", "thanks to copy the code below to be able to send your message"); ?> 
						<!-- merci de recopier le code suivant afin de valider votre message -->
					</small>
				</div>

				<div class="col-md-6 pull-right">
					<input placeholder="taper le code ici" class="col-md-8 txt-captcha text-right pull-right" id="captcha">
				</div>

				<div class="col-md-12 margin-top-15 pull-left">
					<hr>
					<h4 class="letter-red hidden" id="conf-code-fail">
						<i class="fa fa-lock"></i> <?php echo Yii::t("terla", "Security code is not correct"); ?> 
						<i class="fa fa-thumbs-down"></i>
					</h4>
					<h4 class="letter-red hidden" id="form-fail">
						<i class="fa fa-thumbs-down"></i>
					</h4>
					<button type="submit" class="btn btn-link bg-orange pull-right" id="btn-send-mail">
						<b><?php echo Yii::t("terla", "SEND"); ?></b>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-xs-9 pull-right text-center hidden margin-top-50" id="conf-send-mail">
	<h2 class="letter-green">
		<i class="fa fa-thumbs-up"></i> <?php echo Yii::t("terla", "Your message has been sent."); ?>
	</h2>
	<h4 class="text-center">
		<span class=""><?php echo Yii::t("terla", "We answer as soon as possible"); ?>
	</h4>
	<h5 class="text-center">
		<?php echo Yii::t("terla", "Thanks for your message"); ?>
	</h5><br>
	<a href="#activities" class="lbh btn btn-link bg-red tooltips"
		data-toggle="tooltip" data-placement="top" title='Retourner vers le moteur de recherche'>
		<b><i class="fa fa-arrow-left"></i> <?php echo Yii::t("terla", "Back"); ?></b>
	</a>
	<hr style="margin-bottom: 350px;">
</div>

<div class="col-xs-12 margin-top-50 hidden" id="conf-fail-mail">
	<h4 class="text-center letter-red">
		<i class="fa fa-thumbs-down"></i><br>
		<?php echo Yii::t("terla", "Suite à une erreur technique<br>votre message n'a pas pu être envoyé."); ?>
	</h4>
	<h5 class="text-center">
		<?php echo Yii::t("terla", "Veuillez nous en excuser"); ?>
	</h5>
	<hr style="margin-bottom: 350px;">
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
	var situation = $("#situation").val();

	 $("#form-fail").html("");

	if(emailSender == "") 	$("#form-fail").append("<br>Merci d'indiquer votre addresse e-mail <i class='fa fa-thumbs-down'></i>");
	if(name == "") 			$("#form-fail").append("<br>Merci d'indiquer votre nom <i class='fa fa-thumbs-down'></i>");
	if(message == "") 		$("#form-fail").append("<br>Votre message est vide ! <i class='fa fa-thumbs-down'></i>");

	if($("#form-fail").html()!="") { $("#form-fail").removeClass("hidden"); return }
	else $("#form-fail").addClass("hidden");

	var params = { 	emailSender: emailSender, 
	        		subject:subject, 
	        		names:name,
	        		situation:situation,
	        		contentMsg	: message,
	        		captchaUserVal: $("#captcha").val(),
	        		captchaHash: $("#captcha").realperson('getHash')
	        	};

	console.log("sendMail", params);
	//toastr.error("L'envoie d'email est désactivé pour l'instant, retentez votre chance dans quelques jours !");
	//return;

	$.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+"/app/sendmailformcontact",
        data: params,
        success:
            function(data) {
                if(data.res == true){
                	toastr.success("Votre message a bien été envoyé");
                	$("#conf-send-mail").removeClass("hidden");
                	$("#conf-code-fail, #conf-fail-mail, #form-group-contact").addClass("hidden");
                	KScrollTo(".main-apropos");
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