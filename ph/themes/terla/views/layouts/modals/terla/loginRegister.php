
<?php HtmlHelper::registerCssAndScriptsFiles( array('/js/default/loginRegister.js') , $this->module->assetsUrl); ?>

<style>
    .no-display {
        display: none;
    }
    .help-block{
        color:red;
    }
    .topLogoAnim{
      background-color: rgba(255, 255, 255, 0);
      position: absolute;
      z-index: 10;
      top: 65px !important;
      right: 13%;
      width: 400px;
      padding-left: 10px;
    }
    .topLogoAnim .homestead{
      font-size:41px !important;
      font-weight: 100 !important;
    }
    .titleWhite, .subTitle {
    color: #3C5665 !important;
    }
    .subTitle {
        font-weight: 300;
        font-size: 13px;
        margin-top: -15px !important;
    }
@media (min-width: 768px) and (max-width: 1200px) {
    .topLogoAnim{
        top: 40px !important;
        right: 6%;
    }
    .topLogoAnim .homestead{
      font-size:32px !important;
    }   
    .subTitle {
        font-size: 10px;
    }
}
@media (max-width: 768px){
    .topLogoAnim{
        top: 31% !important;
        right: 0% !important;
        width: 100%;
          
     }
     .topLogoAnim .homestead{
      font-size:18px !important;
    }   
    .subTitle {
        font-size: 9px;
        margin-top: -3px !important;
    }
    .portfolio-modal.modal .name{
        letter-spacing: 2px;
    }
}
</style>

<?php if(false){ ?>
<form class="portfolio-modal modal fade form-login" id="modalLogin" 
        tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content shadow2 padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <span class="name" >
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGOS/BCH/logo.png" height="100" class="inline margin-bottom-15">
                    </span><br>

                    <a href="javascript:;" class="btn btn-default bg-orange" data-toggle="modal" data-target="#modalRegister">
                            <i class="fa fa-sign-in"></i> Je veux m'inscrire
                    </a> 
                    <hr>
                    <h2 class="letter-orange">Se connecter</h2>
                    <hr>
                    <!--<h3 class="letter-red no-margin" style="margin-top:-15px!important;">se connecter</h3><br>-->
                   
                    
                </div>
                <div class="col-lg-12">
                    <p></p>
                </div>
            </div>
            <!-- <div class="col-md-8 col-md-offset-2 text-left">
                <label><i class="fa fa-envelope"></i> Un e-mail</label><br>
                <input class="form-control" name="email" id="email-login" type="text" placeholder="e-mail"><br>
                
                <label><i class="fa fa-key"></i> Un mot de passe</label><br>
                <input class="form-control" name="password" id="password-login" type="password" placeholder="mot de passe"><br>
                
                

                <label for="remember" class="checkbox-inline">
                    <input type="checkbox" id="remember" name="remember">
                    Se souvenir de moi
                </label>

                <button class="btn btn-success pull-right loginBtn" type="submit"><i class="fa fa-sign-in"></i> Se connecter</button><br><br>
  
                <div class="form-actions col-md-12 no-padding" style="margin-top:20px;">
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
                                    $('#email3').val($('#email-login').val());
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
                </div>

                <div class="col-md-12 no-padding text-center">
                    <hr>
                    <a href="javascript:;" class="btn bg-white pull-right" data-toggle="modal" data-target="#modalForgot">
                        <!-- <i class="fa fa-s"></i> - ->J'ai perdu mon mot de passe
                    </a>
                </div>

            </div>     -->  
        </div>
    </div>
</form>
<?php } ?>

<div class="portfolio-modal modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content shadow2 padding-top-15"  >
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="col-md-12 padding-top-50">

            <form class="col-sm-7 padding-50 form-register box-register">
                
                <h4 class="letter-lightgray">Pas encore membre ?</h4>
                <h2 class="letter-lightgray text-lightweight">Inscrivez-vous gratuitement</h2><br><br><br>

                <div class="col-xs-6" style="border-right: 2px solid lightgrey;">
                    <input type="radio" value="homme" class="pull-right margin-10">
                    <h4 class="pull-right text-lightweight letter-lightgray">Homme</h4>
                </div>
                <div class="col-xs-6">
                    <h4 class="pull-left text-lightweight letter-lightgray">Femme</h4>
                    <input type="radio" value="femme" class="pull-left margin-10">
                </div>

                <br><br><br>
                <div class="col-sm-10 col-sm-offset-1">
                    <!-- <label class="letter-black"><i class="fa fa-address-book-o"></i> Nom et prénom</label> -->
                    <input class="form-control" id="registerName" name="name" type="text" placeholder="Nom et prénom"><br/>
                    
                    <!-- <label class="letter-black"><i class="fa fa-user-circle-o"></i> Nom d'utilisateur</label><br> -->
                    <input class="form-control" id="username" name="username" type="text" placeholder="Nom d'utilisateur"><br/>
                    
                    <!-- <label class="letter-black"><i class="fa fa-envelope"></i> E-mail</label><br> -->
                    <input class="form-control" id="email3" name="email3" type="text" placeholder="e-mail"><br/>
                    
                    <!-- <label class="letter-black"><i class="fa fa-key"></i> Mot de passe</label><br/> -->
                    <input class="form-control" id="password3" name="password3" type="password" placeholder="mot de passe"><br/>
                    
                    <!-- <label class="letter-black"><i class="fa fa-key"></i> Répétez le mot de passe</label><br/> -->
                    <input class="form-control" id="passwordAgain" name="passwordAgain" type="password" placeholder="mot de passe (confirmation)">
                    <input class="form-control" id="isInvitation" name="isInvitation" type="hidden" value="false">
                    
                    <div class="form-group text-left pull-left margin-top-15 padding-top-10" style="width:100%;">
                        <label for="agree" class="checkbox-inline letter-red">
                            <input type="checkbox" class="grey agree" id="agree" name="agree">
                            <?php echo Yii::t("login","I agree to the Terms of") ?> 
                            <a href="https://www.communecter.org/doc/Conditions Générales d'Utilisation.pdf" 
                                target="_blank" class="bootbox-spp text-dark">
                                <?php echo Yii::t("login","our chart") ?> (! url)
                            </a>
                        </label>
                    </div>


                    <div class="col-xs-12 no-padding">
                        <a href="#" class="btn btn-link letter-lightgray pull-left "><small>Conditions générales</small></a>
                    </div>

                    <br>

                    <div class="pull-left form-actions no-margin" style="width:100%; padding:10px;">
                        <div class="errorHandler alert alert-danger no-display registerResult pull-left " style="width:100%;">
                            <i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Please verify your entries.") ?>
                        </div>
                        <div class="alert alert-success no-display pendingProcess" style="width:100%;">
                            <i class="fa fa-check"></i> <?php echo Yii::t("login","You've been invited : please resume the registration process in order to log in.") ?>
                        </div>
                    </div>

                    <button class="btn btn-link bg-orange text-white pull-right createBtn" style="font-size:20px;">
                        <i class="fa fa-sign-in"></i> Valider
                    </button>

                    <a href="javascript:" class="btn btn-link letter-lightgray pull-right padding-top-10 margin-right-10" 
                       data-dismiss="modal">
                        <i class="fa fa-times"></i> annuler
                    </a>  

                </div>   

            </form> 

            <div class="col-sm-5 margin-bottom-50" style="border-left: 2px solid lightgray;">
                Déjà membre ?<br>
                <button id="btn-open-formlogin" class="btn btn-link bg-orange margin-top-15">
                    Connectez-vous
                </button>

                <br>
                
                <a href="javascript:;" class="btn bg-white box-login" data-toggle="modal" data-target="#modalForgot">
                    <!-- <i class="fa fa-s"></i> --><small>J'ai perdu mon mot de passe</small>
                </a>            

                <form class="hidden col-md-12 margin-top-25 margin-bottom-25 form-login" id="formLogin">
                    <!-- <label><i class="fa fa-envelope"></i> Un e-mail</label><br> -->
                    <input class="form-control" name="email" id="email-login" type="text" placeholder="e-mail"><br>
                    
                    <!-- <label><i class="fa fa-key"></i> Un mot de passe</label><br> -->
                    <input class="form-control" name="password" id="password-login" type="password" placeholder="mot de passe">
                    <br>
                    
                    <label for="remember" class="col-xs-12 col-sm-6 col-md-6 checkbox-inline">
                        <input type="checkbox" id="remember" name="remember">
                        Se souvenir de moi
                    </label>

                    <button class="btn btn-link bg-orange pull-right col-xs-12 col-sm-6 col-md-6 loginBtn" type="submit">
                        <i class="fa fa-sign-in"></i> Connecter
                    </button><br><br>
      
                    <div class="form-actions col-md-12 no-padding" style="margin-top:20px;">
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
                                        $('#email3').val($('#email-login').val());
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
                    </div>

                    <div class="col-md-12 no-padding text-center">
                        <hr>
                    </div>
                </form>



                <br><br><br>

                <h4 class="letter-lightgray text-center">Comment ça marche ?</h4>

               <!--  <iframe width="280" height="155" src="https://www.youtube.com/embed/pIxoM8tkms8?rel=0&amp;showinfo=0" 
                        frameborder="0" allowfullscreen>
                </iframe> -->
                <div class="bg-dark" style="width:280px; height:155px;margin:auto">
                    <i class="fa fa-play bg-white text-dark" 
                        style="margin-top: 60px;padding: 10px 15px;border-radius: 4px;"></i>
                </div>
                <br>
                <div class="col-xs-6">
                    <hr>
                    <div class="padding-25 margin-top-50 bg-blue text-white">
                        SHARE ON FACEBOOK
                        <br><br><i class="fa fa-facebook fa-2x"></i>
                    </div>
                </div>
                <div class="col-xs-6">
                    <hr>
                    <div class="padding-25 margin-top-50 bg-red text-white">
                        SHARE ON COMMUNECTER
                        <br><br><i class="fa fa-connectdevelop fa-2x"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" role="dialog" id="modalRegisterSuccess">
    <div class="modal-dialog">
        <div class="modal-content shadow2">
            <div class="modal-header bg-green text-white">
                <h4 class="modal-title"><i class="fa fa-check"></i> <?php echo Yii::t("login","Account Created!!") ?></h4>
            </div>
            <div class="modal-body center text-dark hidden" id="modalRegisterSuccessContent"></div>
            <div class="modal-body center text-dark">
                
                <h4 class="letter-green no-margin"><i class="fa fa-check-circle"></i> Confirmez votre adresse e-mail</h4>
                <h4 class="no-margin">
                    <small>afin d'accéder à votre compte</small>
                </h4>
                <small class="no-margin">
                    <i class="fa fa-lock"></i> Pour des raisons de sécurité, vous devez confirmer votre adresse e-mail avant de pouvoir vous connecter.
                </small>
                <br><br>
                <h5><i class="fa fa-angle-down"></i> Comment faire ?</h5>
                <i class="fa fa-envelope-open" style="width:20px;"></i> <b>Vérifiez votre boîte e-mails</b><br>
                <i class="fa fa-hand-o-up" style="width:20px;"></i> <b>Cliquez sur le lien d'activation</b> que nous vous avons envoyé.</br>
                <hr>
                <i class="fa fa-unlock" style="width:20px;"></i> Vous serez <b class="letter-green">connecté automatiquement</b> et redirigé vers votre page perso.
                    
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-default letter-green" data-dismiss="modal"><i class="fa fa-check"></i> J'ai compris</button>
            </div>
        </div>
    </div>
</div>

<div class="portfolio-modal modal fade" id="modalForgot" tabindex="-1" role="dialog" aria-hidden="true">
    <form class="modal-content shadow2 form-email box-email padding-top-15"  >
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <span class="name" >
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGOS/BCH/logo.png" height="100" class="inline margin-bottom-15">
                    </span><br>
                    <hr>
                    <h2 class="letter-orange">Mot de passe perdu ?</h2><br>
                    <p>Indiquez l'addresse e-mail liée à votre compte afin de récupérer votre mot de passe.<hr></p>
                </div>
                <div class="col-lg-12">
                    <p></p>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2 text-left">
                
                <label class="letter-black"><i class="fa fa-envelope"></i> E-mail</label><br>
                <input class="form-control" id="email2" name="email2" type="text" placeholder="E-mail"><br/>
                
                <hr>

                <div class="pull-left form-actions no-margin" style="width:100%; padding:10px;">
                    <div class="errorHandler alert alert-danger no-display registerResult pull-left " style="width:100%;">
                        <i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
                    </div>
                </div>

                <!-- <div class="form-actions">
                     <button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="forgotBtn ladda-button center center-block">
                        <span class="ladda-label">XXXXXXXX</span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
                    </button>
                </div> -->

                <button class="btn btn-success text-white pull-right forgotBtn"><i class="fa fa-sign-in"></i> Envoyer</button>
                <a href="javascript:" class="btn btn-danger pull-right margin-right-10" data-dismiss="modal">
                    <i class="fa fa-times"></i> Retour
                </a>
                
                <div class="col-md-12 margin-top-50"></div>
            </div>      
        </div>
    </form>
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
};

var buttonLabel = {
    "password" : '<?php echo Yii::t("login","Get my password") ?>',
    "validateEmail" : "<?php echo Yii::t("login","Send me validation email") ?>"
};

var timeout;
var emailType;


var requestedUrl = "<?php echo (isset(Yii::app()->session["requestedUrl"])) ? Yii::app()->session["requestedUrl"] : null; ?>";
var REGISTER_MODE_TWO_STEPS = "<?php echo Person::REGISTER_MODE_TWO_STEPS ?>";

jQuery(document).ready(function() {

    //$('#email3').filter_input({regex:'/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/'});
    //$('#registerName').filter_input({regex:'[^@#&\'\"\`\\\\]'});
    //$('#username').filter_input({regex:'[^@#&\'\"\`\\\\]'});


    //Remove parameters from URLs in case of invitation without reloading the page
    <?php if(@$_GET["email"]){ ?>
        removeParametersWithoutReloading();
    <?php } ?>
    
    //$(".box").hide();
    Login.init();
    //titleAnim();

    $('.form-register #username').keyup(function(e) { 
        validateUserName();
    });

    if(email != ''){
        $('#email-login').val(email);
        $('#email-login').prop('disabled', true);
        $('#email2').val(email);
        $('#email2').prop('disabled', true);
        $('#email3').val(email);
        $('#email3').prop('disabled', true);
    }

    //Validation of the user (invitation or validation)
    userValidatedActions();

    if (error != "") {
        $(".custom-msg").show();
        $(".custom-msg").text(msgError[error]);
    }

    $("#username").change(function(){
        $("#registerName").val($(this).val());
    });

    $("#btn-open-formlogin").click(function(){
        $("form#formLogin").removeClass("hidden");
    });

});


</script>