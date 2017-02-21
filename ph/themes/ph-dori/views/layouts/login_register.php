<?php HtmlHelper::registerCssAndScriptsFiles( array('/js/default/loginRegister.js') , $this->module->assetsUrl); ?>

<style>
	.main-login{
		position:absolute;
		top:20px;
	}
	@media screen and (min-width: 1025px) {
		.box-login, .box-register, .box-email{
			left: unset !important;
			right: 0% !important;
			border-radius:15px;
			display:none;
		}
	}
	/**/
	.form-login, .form-register, .form-email{
		left: unset !important;
		right: 0% !important;
		border-radius:15px;
	}
	.btn-round{
		border-radius:0px 0px 15px 15px !important;
	}

	.btn-close-box{
		position:absolute;
		right:0px;
		top:0px;
		border-radius: 0px 10px 0px 0px;
		border: 0px;
		height:35px;
		background-color: transparent;
	}
</style>
	
	<div class="main-login col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-2 col-xs-10 col-xs-offset-1">


	<div class="modal fade" role="dialog" id="modalRegisterSuccess">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-dark">
					<h4 class="modal-title"><i class="fa fa-check"></i> <?php echo Yii::t("login","Account Created!!") ?></h4>
				</div>
				<div class="modal-body center text-dark" id="modalRegisterSuccessContent"></div>
				<div class="modal-footer">
					 <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
				</div>
			</div>
		</div>
	</div>

		<!-- <a class="byPHRight" href="#"><img style="" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/byPH.png"/></a> -->
		
			<div class="box-login box box-white-round no-padding pull-right">
				<button class="btn btn-default btn-close-box" id=""><i class="fa fa-times"></i></button>
				<?php 
					$this->renderPartial('webroot.themes.'.Yii::app()->theme->name.'.views.layouts.default.menuTitle');
				?>
				<form class="form-login box-white-round" action="" method="POST">
					<img style="width:100%; border: 10px solid white; border-bottom-width:0px;" class="pull-right hidden-xs" src="<?php echo $this->module->assetsUrl?>/images/logoL.jpg"/>
					<!-- <img style="width:100%; border: 10px solid white; border-bottom-width:0px;" class="pull-right visible-xs box-white-round" src="<?php echo $this->module->assetsUrl?>/images/logoLTxt.jpg"/> -->
					<br/>
					<?php //echo Yii::app()->session["requestedUrl"]." - ".Yii::app()->request->url; ?>
					<fieldset>
						<h2 class="text-red margin-bottom-10 text-center"><i class="fa fa-angle-down"></i> Je me connecte</h2>
						<div class="form-group">
							<span class="input-icon">		
								<input type="text" class="form-control radius-10" name="email" id="email-login" placeholder="<?php echo Yii::t("login","E-mail / nom d'utilisateur") ?>" >
								<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-group form-actions">
							
							<span class="input-icon">
								<input type="password" class="form-control password"  name="password" id="password-login" placeholder="<?php echo Yii::t("login","Password") ?>">
								
								<label for="remember" class="checkbox-inline">
									<input type="checkbox" class="grey remember" id="remember" name="remember">
									<?php echo Yii::t("login","Keep me signed in") ?>
								</label>

								<i class="fa fa-lock"></i>
								<a class="forgot pull-right padding-5" href="javascript:" 
								onclick="showPanel('box-email', 
									function() {
										emailType = 'password';
										$('#email2').val($('#email-login').val());
										$('.forgotBtn .ladda-label').text(buttonLabel[emailType])});">
								<?php echo Yii::t("login","I forgot my password") ?></a> 
							</span>
						</div>
						<div class="form-actions" style="margin-top:-20px;">
							<div class="errorHandler alert alert-danger no-display loginResult">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Please verify your entries.") ?>
							</div>
							<div class="alert alert-danger no-display notValidatedEmailResult">
								<i class="fa fa-remove-sign"></i><?php echo Yii::t("login","Your account is not validated : please check your mailbox to validate your email address.") ?>
								      <?php echo Yii::t("login","If you didn't receive it or lost it, click") ?>
								      <a class="validate" href="#" 
								      onclick="showPanel('box-email', 
								      	function() {
								      		emailType = 'validateEmail';
								      		$('#email2').val($('#email-login').val());
								      		$('.forgotBtn .ladda-label').text(buttonLabel[emailType])});">
								      <?php echo Yii::t("login","here") ?></a> <?php echo Yii::t("login","to receive it again.") ?> 
							</div>
							<div class="alert alert-info no-display betaTestNotOpenResult">
								<i class="fa fa-remove-sign"></i><?php echo Yii::t("login","Our developpers are fighting to open soon ! Check your mail that will happen soon !")?>
							</div>
							<div class="alert alert-success no-display emailValidated">
								<i class="fa fa-check"></i> <?php echo Yii::t("login","Your account is now validated ! Please try to login.") ?>
							</div>
							<div class="alert alert-danger no-display custom-msg">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
							</div>
							<div class="alert alert-danger no-display emailAndPassNotMatchResult">
								<i class="fa fa-remove-sign"></i><?php echo Yii::t("login","Email or password does not match. Please try again !")?>
							</div>
							<div class="alert alert-danger no-display emailNotFoundResult">
								<i class="fa fa-remove-sign"></i><?php echo Yii::t("login","Impossible to find an account for this username or password.")?>
							</div>
							
							<br/>
							<div class="col-xs-12">
								<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="loginBtn ladda-button center-block">
									<span class="ladda-label"><i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Login") ?></span>
								</button>
							</div>
						</div>
						
					</fieldset>
					<div class="new-account">
						<!-- <h2 class="text-red  no-margin padding-bottom-5 text-center bg-white"><i class="fa fa-angle-down"></i> Je m'inscris</h2> -->
						<?php //echo Yii::t("login","Don't have an account yet?") ?>
						<a href="javascript:" onclick="showPanel('box-register');" class="btn btn-default btn-sm register btn-round text-dark">
							<i class="fa fa-plus"></i> <i class="fa fa-user"></i> <?php echo Yii::t("login", "Create an account") ?>
						</a>
						
					</div>
				</form>
			</div>


			<!-- end: LOGIN BOX -->
			<!-- start: FORGOT BOX -->
			<div class="box-email box box-white-round">
				<button class="btn btn-default btn-close-box" id=""><i class="fa fa-times"></i></button>
				<form class="form-email box-white-round">
					<img style="width:100%; border: 10px solid white;" class="pull-right box-white-round" src="<?php echo $this->module->assetsUrl?>/images/logoLTxt.jpg"/>
					<br/>
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" id="email2" placeholder="E-mail / nom d'utilisateur">
								<i class="fa fa-envelope"></i> </span>
						</div>
						<div class="form-actions">
							<div class="errorHandler alert alert-danger no-display">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
							</div>
							
							<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="forgotBtn ladda-button center center-block">
								<span class="ladda-label">XXXXXXXX</span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
							</button>
						</div>
					</fieldset>
					<div class="new-account">
						<a href="javascript:" onclick="showPanel('box-login');" class="text-dark btn go-back btn-round">
							<i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Login") ?>
						</a>	
					</div>
				</form>
			</div>
			<!-- end: FORGOT BOX -->
			<!-- start: REGISTER BOX -->
			<div class="box-register box box-white-round no-padding" style=" margin-top:-25px !important;">
				<button class="btn btn-default btn-close-box" id=""><i class="fa fa-times"></i></button>
				<form class="form-register center box-white-round" style="background-color:white !important;">
					<img style="width:0%; border: 10px solid white;" class="" src="<?php echo $this->module->assetsUrl?>/images/logoLTxt.jpg"/>
					
					<fieldset>
						<h2 class="text-red margin-bottom-10 text-center"><i class="fa fa-angle-down"></i> <?php echo Yii::t("login","I create my account") ?></h2>
						<div class="col-md-12 padding-5">
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" id="registerName" name="name" placeholder="<?php echo Yii::t("login","Firstname Lastname") ?>">
									<i class="fa fa-user"></i> </span>
							</div>
						</div>
						<div class="col-md-6 padding-5">
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" id="username" name="username" placeholder="<?php echo Yii::t("login","Username") ?>">
									<i class="fa fa-user-secret"></i> </span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" id="email3" name="email3" placeholder="<?php echo Yii::t("login","E-mail") ?>">
									<i class="fa fa-envelope"></i> </span>
							</div>
						</div>
						<div class="col-md-6 padding-5">
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" id="password3" name="password3" placeholder="<?php echo Yii::t("login","Password") ?>">
									<i class="fa fa-lock"></i> </span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" id="passwordAgain" name="passwordAgain" placeholder="<?php echo Yii::t("login","Password again") ?>">
									<i class="fa fa-lock"></i> </span>
							</div>
						</div>
						<?php if(@Yii::app()->params["betaTest"]){ ?>
						<div class="col-md-12 padding-5">
							<a href="javascript:;"  id="inviteCodeLink" onclick="$(this).addClass('hide');$('.inviteCodeForm').removeClass('hide')"><?php echo Yii::t("login","Add invitation code")?></a>
							<div class="form-group hide inviteCodeForm">
								<span class="input-icon">
									<input type="text" class="form-control" id="inviteCode" name="inviteCode" placeholder="<?php echo Yii::t("login","Invitation Code") ?>">
									<i class="fa fa-barcode  "></i> </span>
							</div>
						</div>
						<?php } ?>
						<div class="col-md-12 no-padding no-margin">
							<hr style="margin-top: 0px; margin-bottom: 15px;">
						</div>
						
						<div class="form-group pull-left no-margin" style="width:100%;">
							<div>
								<label for="agree" class="checkbox-inline">
									<input type="checkbox" class="grey agree" id="agree" name="agree">
									<?php echo Yii::t("login","I agree to the Terms of") ?> <a href="https://www.communecter.org/doc/Conditions Générales d'Utilisation.pdf" target="_blank" class="bootbox-spp"><?php echo Yii::t("login","Service and Privacy Policy") ?></a>
								</label>
							</div>
						</div>			

						<div class="pull-left" style="width:100%;">
							<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="createBtn ladda-button center-block">
								<span class="ladda-label"><i class="fa fa-plus"></i><i class="fa fa-user"></i>  <?php echo Yii::t("login","Submit") ?></span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
							</button>
						</div>
						<div class="space20"></div>
						<div class="pull-left form-actions no-margin" style="width:100%; padding:10px;">
							<div class="errorHandler alert alert-danger no-display registerResult pull-left " style="width:100%;">
								<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Please verify your entries.") ?>
							</div>
							<div class="alert alert-success no-display pendingProcess" style="width:100%;">
								<i class="fa fa-check"></i> <?php echo Yii::t("login","You've been invited : please resume the registration process in order to log in.") ?>
							</div>
						</div>
					</fieldset>
					<div class="new-account">
						<a href="javascript:" onclick="showPanel('box-login');" class="text-dark btn go-back btn-round">
							<i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Login") ?>
						</a>	
					</div>	
				</form>
				<!-- end: COPYRIGHT -->
			</div>
	</div>


<script>

var email = '<?php echo @$_GET["email"]; ?>';
var userValidated = '<?php echo @$_GET["userValidated"]; ?>';
var pendingUserId = '<?php echo @$_GET["pendingUserId"]; ?>';
var name = '<?php echo @$_GET["name"]; ?>';
var error = '<?php echo @$_GET["error"]; ?>';
var invitor = "<?php echo @$_GET["invitor"]?>";

var msgError = {
	"accountAlreadyExists" : "<?php echo Yii::t("login","Your account already exists on the plateform : please try to login.") ?>",
	"unknwonInvitor" : "<?php echo Yii::t("login","Something went wrong ! Impossible to retrieve your invitor.") ?>",
	"somethingWrong" : "<?php echo Yii::t("login","Something went wrong !") ?>",
}

var buttonLabel = {
	"password" : '<?php echo Yii::t("login","Get my password") ?>',
	"validateEmail" : "<?php echo Yii::t("login","Send me validation email") ?>"
}

var timeout;
var emailType;

var requestedUrl = "<?php echo (isset(Yii::app()->session["requestedUrl"])) ? Yii::app()->session["requestedUrl"] : null; ?>";
var REGISTER_MODE_TWO_STEPS = "<?php echo Person::REGISTER_MODE_TWO_STEPS ?>";


jQuery(document).ready(function() {
	//Remove parameters from URLs in case of invitation without reloading the page
	removeParametersWithoutReloading();
	
	$(".box").hide();
	Login.init();
	titleAnim();

	$('.form-register #username').keyup(function(e) {
		//validateUserName();
	});

	if(email != ''){
		$('#email-login').val(email);
		$('#email-login').prop('disabled', true);
		$('#email3').val(email);
		$('#email3').prop('disabled', true);
	}

	//Validation of the user (invitation or validation)
	userValidatedActions();

	if (error != "") {
		$(".custom-msg").show();
		$(".custom-msg").text(msgError[error]);
	}

	$(".btn-close-box").click(function(){
		$(".box").hide(400);
		$(".main-col-search").animate({ top: 0, opacity:1 }, 800 );
	});

});

</script>