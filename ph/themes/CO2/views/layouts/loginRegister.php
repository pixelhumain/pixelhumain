
<?php HtmlHelper::registerCssAndScriptsFiles( array('/js/default/loginRegister.js') , $this->module->getParentAssetsUrl()); ?>

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

<?php //if($subdomain != "welcome"){ ?>
<form class="portfolio-modal modal fade form-login box-login" id="modalLogin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="name" >
                        <?php if(Yii::app()->params["CO2DomainName"] == "kgougle"){ ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" height="60" class="inline margin-bottom-15">
                        <?php } else if(Yii::app()->params["CO2DomainName"] == "FI"){ ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/FI-logo.png" height="90" class="inline margin-bottom-15">
                        <?php } else { ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                                <div class="loginLogo col-md-offset-3 col-sm-offset-2 col-md-6 col-sm-8 col-xs-12">
                                <?php  
                                $nameTheme = ( (Yii::app()->theme->name == "network") ? "CO2" : Yii::app()->theme->name );
                                $this->renderPartial('webroot.themes.'.$nameTheme.'.views.layouts.forms.CO2.menuTitle'); ?>
                                     <img style="width:100%; border: 10px solid white; border-bottom-width:0px;max-height: inherit;" class="pull-right" src="<?php echo $this->module->getParentAssetsUrl()?>/images/logoL.jpg"/>
                                <!--<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="100" class="inline margin-bottom-15">-->
                                </div>
                            </div>
                            <!-- <h4 class="text-dark col-md-12 margin-top-5 homestead">
                                <!-- Bienvenue sur la version CO.2 - ->
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="35" 
                                     class="inline margin-left-10">
                                <!-- <br/>Le commun avance <span class="text-red">montez à bord !</span>  - ->
                                <hr>
                            </h4> -->
                        <?php } ?>
                    </span>
                    <!--<h3 class="letter-red no-margin" style="margin-top:-15px!important;">se connecter</h3><br>-->
                   
                    
                </div>
                <div class="col-lg-12">
                    <p></p>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-4 text-left">
                <label><i class="fa fa-envelope"></i> <?php echo Yii::t("login","Email") ?></label><br>
                <input class="form-control" name="email" id="email-login" type="text" placeholder="<?php echo Yii::t("login","An email") ?>"><br>
                
                <label><i class="fa fa-key"></i> <?php echo Yii::t("login","Password") ?></label><br>
                <input class="form-control" name="password" id="password-login" type="password" placeholder="<?php echo Yii::t("login","A password") ?>"><br>
                
                

                <label for="remember" class="checkbox-inline">
                    <input type="checkbox" id="remember" name="remember" checked="checked">
                    <?php echo Yii::t("login","Keep me signed in") ?>
                </label><br>
                <small><i class="fa fa-lock"></i> <?php echo Yii::t("login","password saved securely in your cookies") ?>.</small>
                <br><br>

                <button class="btn btn-success pull-right loginBtn" type="submit"><i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Log in") ?></button>
  
                <div class="form-actions col-xs-12 no-padding" style="margin-top:20px;">
                    <div class="errorHandler alert alert-danger no-display loginResult">
                        <i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Please verify your entries.") ?>
                    </div>
                    <div class="alert alert-danger no-display notValidatedEmailResult text-center">
                        <i class="fa fa-remove-sign"></i><?php echo Yii::t("login","Your account <b>is not validated</b>: please check your mailbox to validate your email address.") ?><br/>
                              <?php echo Yii::t("login","If you <b>didn't receive it or lost it</b>, click on the <b>following button</b> to receive it <b>again</b>") ?><br/>
                            <a class="btn btn-default bg-white letter-blue bold margin-top-10" href="javascript:;" data-toggle="modal" data-target="#modalSendActivation" 
                              onclick="$('#modalSendActivation #email2').val($('#email-login').val());">
                                <i class="fa fa-envelope"></i> <?php echo Yii::t("login","Receive another validation email") ?>
                            </a> 
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

                <div class="col-xs-12 no-padding text-center">
                    <hr>
                    <a href="javascript:;" class="btn bg-white" data-toggle="modal" data-target="#modalForgot">
                        <!-- <i class="fa fa-s"></i> --><?php echo Yii::t("login","I forgot my password") ?>
                    </a>
                    <?php //if($subdomain != "welcome"){ ?>
                        <a href="javascript:;" class="btn btn-default bg-white letter-blue bold" 
                            data-toggle="modal" data-target="#modalRegister">
                                 <i class="fa fa-plus-circle bold"></i> 
                                 <?php echo Yii::t("login", "I create my account") ?>
                        </a>
                    <?php //}else{ ?>
                        <!-- <a href="javascript:;" class="btn btn-default bg-white letter-blue bold" data-dismiss="modal">
                                <i class="fa fa-plus-circle"></i> 
                                <?php echo Yii::t("login", "I create my account") ?>
                        </a> -->
                    <?php //} ?>
                </div>

                <br><hr>

                <div class="col-xs-12 text-center">
                    <br><hr>
                    <a href="javascript:" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo Yii::t("common","Back") ?></a>
                </div>

            </div>      
        </div>
    </div>
</form>
<?php //} ?>

<?php if(Yii::app()->params["CO2DomainName"] != "kgougle"){ //bloquage des inscriptions ?>
<?php //if($subdomain != "welcome"){ ?>
<div class="portfolio-modal modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-hidden="true">
    <form class="modal-content form-register box-register padding-top-15"  >
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="name" >
                        <?php if(Yii::app()->params["CO2DomainName"] == "kgougle"){ ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" height="60" class="inline margin-bottom-15">
                       <?php } else if(Yii::app()->params["CO2DomainName"] == "FI"){ ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/FI-logo.png" height="60" class="inline margin-bottom-15">
                       <?php } else { ?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="loginLogo col-md-offset-3 col-sm-offset-2 col-md-6 col-sm-8 col-xs-12">
                                <?php  $this->renderPartial('webroot.themes.'.$nameTheme.'.views.layouts.forms.CO2.menuTitle'); ?>
                                     <img style="width:100%; border: 10px solid white; border-bottom-width:0px;max-height: inherit;" class="pull-right" src="<?php echo $this->module->getParentAssetsUrl()?>/images/logoL.jpg"/>
                                <!--<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="100" class="inline margin-bottom-15">-->
                                </div>
                            </div>
                        <?php } ?>
                    </span>
                    <!--<h3 class="letter-red no-margin" style="margin-top:-15px!important;">se connecter</h3><br>-->
                    <!-- <p>Rejoindre la version co2<br/>Le commun avance, montez à bord !!<hr></p> -->
                </div>
                <div class="col-lg-12">
                    <p></p>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-4 text-left">
                
                <label class="letter-black"><i class="fa fa-address-book-o"></i> <?php echo Yii::t("login","Name and surname") ?></label>
                <input class="form-control" id="registerName" name="name" type="text" placeholder="<?php echo Yii::t("login","name and surname") ?>"><br/>
                
                <label class="letter-black"><i class="fa fa-user-circle-o"></i> <?php echo Yii::t("login","User name") ?></label><br>
                <input class="form-control" id="username" name="username" type="text" placeholder="<?php echo Yii::t("login","user name") ?>"><br/>
                
                <label class="letter-black"><i class="fa fa-envelope"></i> <?php echo Yii::t("login","Email") ?></label><br>
                <input class="form-control" id="email3" name="email3" type="text" placeholder="<?php echo Yii::t("login","email") ?>"><br/>
                
                <label class="letter-black"><i class="fa fa-key"></i> <?php echo Yii::t("login","Password") ?></label><br/>
                <input class="form-control" id="password3" name="password3" type="password" placeholder="<?php echo Yii::t("login","password") ?>"><br/>
                
                <label class="letter-black"><i class="fa fa-key"></i> <?php echo Yii::t("login","Password again") ?></label><br/>
                <input class="form-control" id="passwordAgain" name="passwordAgain" type="password" placeholder="<?php echo Yii::t("login","password (confirmation)") ?>">
                <input class="form-control" id="isInvitation" name="isInvitation" type="hidden" value="false">
                <hr>
                <div class="form-group pull-left no-margin padding-top-10" style="width:100%;">
                    <div>
                        <label for="agree" class="checkbox-inline letter-red">
                            <input type="checkbox" class="grey agree" id="agree" name="agree">
                            <?php echo Yii::t("login","I agree to the Terms of") ?> 
                            <a href="https://www.communecter.org/doc/Conditions Générales d'Utilisation.pdf" target="_blank" class="bootbox-spp text-dark">
                                <?php echo Yii::t("login","Service and Privacy Policy") ?>
                            </a>
                        </label>
                    </div>
                </div>

                <br><hr>

                <div class="pull-left form-actions no-margin" style="width:100%; padding:10px;">
                    <div class="errorHandler alert alert-danger no-display registerResult pull-left " style="width:100%;">
                        <i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Please verify your entries.") ?>
                    </div>
                    <div class="alert alert-success no-display pendingProcess" style="width:100%;">
                        <i class="fa fa-check"></i> <?php echo Yii::t("login","You've been invited : please resume the registration process in order to log in.") ?>
                    </div>
                </div>

                <a href="javascript:" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo Yii::t("common","Back") ?></a>
                <button class="btn btn-success text-white pull-right createBtn"><i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Create account") ?></button>
                
                
                <div class="col-md-12 margin-top-50 margin-bottom-50"></div>
            </div>      
        </div>
    </form>
</div>
<?php //} ?>

<div class="modal fade" role="dialog" id="modalRegisterSuccess">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green text-white">
                <h4 class="modal-title"><i class="fa fa-check"></i> <?php echo Yii::t("login","Account Created!!") ?></h4>
            </div>
            <div class="modal-body center text-dark hidden" id="modalRegisterSuccessContent"></div>
            <div class="modal-body center text-dark">
                <h4 class="letter-green no-margin"><i class="fa fa-check-circle"></i> <?php echo Yii::t("login","Confirm your email address")?></h4>
                <h4 class="no-margin">
                    <small><?php echo Yii::t("login","in order to attain your account") ?></small>
                </h4>
                <small class="no-margin">
                    <i class="fa fa-lock"></i> <?php echo Yii::t("login","For security reasons, you have to comfirm your email address to be connected") ?>.
                </small>
                <br><br>
                <h5><i class="fa fa-angle-down"></i> <?php echo Yii::t("login", "How can it be done")?> ?</h5>
                <i class="fa fa-envelope-open" style="width:20px;"></i> <b><?php echo Yii::t("login","Verify your emails and your spams") ?></b><br>
                <i class="fa fa-hand-o-up" style="width:20px;"></i> <b><?php echo Yii::t("login","Click on the activating link") ?></b> <?php echo Yii::t("login","which we sent to you") ?>.</br>
                <hr>
                <i class="fa fa-unlock" style="width:20px;"></i> <?php echo Yii::t("login","You will be <b class='letter-green'>automatically connected</b> and redirect on your page") ?>.
                    
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-default letter-green" data-dismiss="modal"><i class="fa fa-check"></i> <?php Yii::t("login","I understand") ?></button>
            </div>
        </div>
    </div>
</div>


<?php } ?>
<div class="modal fade" role="dialog" id="modalNewPasswordSuccess" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green text-white">
                <h4 class="modal-title"><i class="fa fa-check"></i> <?php echo Yii::t("login","A new password has been sent to your email box !!") ?></h4>
            </div>
            <div class="modal-body center text-dark hidden" id="modalNewPasswordSuccessContent"></div>
            <div class="modal-body center text-dark">
                <h4 class="letter-green no-margin"><i class="fa fa-check-circle"></i> <?php echo Yii::t("login","Please, you will find a temporaly password")?></h4>
                <h4 class="no-margin">
                    <small><?php echo Yii::t("login","in order to connect you") ?></small>
                </h4>
                <small class="no-margin">
                    <i class="fa fa-lock"></i> <?php echo Yii::t("login","Then, you will be free to change your password on your profil page") ?>.
                </small>
                <br><br>
                <h5><i class="fa fa-angle-down"></i> <?php echo Yii::t("login", "How can it be done")?> ?</h5>
                <i class="fa fa-link" style="width:20px;"></i> <b><?php echo Yii::t("login","Go to your profil page") ?></b><br>
                <i class="fa fa-hand-o-up" style="width:20px;"></i> <?php echo Yii::t("login","Click on parameters button in the menu under your header section") ?>.</br>
                <hr>
                <i class="fa fa-list" style="width:20px;"></i> <b><?php echo Yii::t("login","Then click on the tab 'Change your password'") ?></b>.</br>
                <hr>
                <i class="fa fa-unlock" style="width:20px;"></i> <?php echo Yii::t("login","In few seconds, you will be <b class='letter-green'>enjoying your new login password</b>") ?>.
                    
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-default letter-green" data-dismiss="modal"><i class="fa fa-check"></i> <?php Yii::t("login","I understand") ?></button>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="modalForgot" tabindex="-1" role="dialog" aria-hidden="true">
    <form class="modal-content form-email box-email padding-top-15"  >
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="name" >
                        <?php if(Yii::app()->params["CO2DomainName"] == "kgougle"){ ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" height="60" class="inline margin-bottom-15">
                       <?php } else if(Yii::app()->params["CO2DomainName"] == "FI"){ ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/FI-logo.png" height="60" class="inline margin-bottom-15">
                       <?php } else { ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="100" class="inline margin-bottom-15">
                        <?php } ?>
                    </span>
                    <h3 class="letter-red no-margin" style="margin-top:-15px!important;"><?php echo Yii::t("login", "Forget password ?") ?></h3><br>
                    <p><?php echo Yii::t("login","Indicate your email link to your account to recover a password") ?>.<hr></p>
                </div>
                <div class="col-lg-12">
                    <p></p>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-4 text-left">
                
                <label class="letter-black"><i class="fa fa-envelope"></i> <?php echo Yii::t("login","Email") ?></label><br>
                <input class="form-control" id="email2" name="email2" type="text" placeholder="<?php echo Yii::t("login","Email") ?>"><br/>
                
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

                <a href="javascript:" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo Yii::t("common", "Back") ?></a>
                <button class="btn btn-success text-white pull-right forgotBtn"><i class="fa fa-sign-in"></i> <?php echo Yii::t("common","Validate") ?></button>
                
                
                <div class="col-md-12 margin-top-50 margin-bottom-50"></div>
            </div>      
        </div>
    </form>
</div>
<div class="modal fade" role="dialog" id="modalSendAgainSuccess" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green text-white">
                <h4 class="modal-title"><i class="fa fa-check"></i> <?php echo Yii::t("login","New email validation succesfully sent !!") ?></h4>
            </div>
            <div class="modal-body center text-dark hidden" id="modalSendAgainSuccessContent"></div>
            <div class="modal-body center text-dark">
                <h4 class="letter-green no-margin"><i class="fa fa-check-circle"></i> <?php echo Yii::t("login","Confirm your email address")?></h4>
                <h4 class="no-margin">
                    <small><?php echo Yii::t("login","in order to attain your account") ?></small>
                </h4>
                <small class="no-margin">
                    <i class="fa fa-lock"></i> <?php echo Yii::t("login","For security reasons, you have to comfirm your email address to be connected") ?>.
                </small>
                <br><br>
                <h5><i class="fa fa-angle-down"></i> <?php echo Yii::t("login", "How can it be done")?> ?</h5>
                <i class="fa fa-envelope-open" style="width:20px;"></i> <b><?php echo Yii::t("login","Verify your emails and your spams") ?></b><br>
                <i class="fa fa-hand-o-up" style="width:20px;"></i> <b><?php echo Yii::t("login","Click on the activating link") ?></b> <?php echo Yii::t("login","which we sent to you") ?>.</br>
                <hr>
                <i class="fa fa-unlock" style="width:20px;"></i> <?php echo Yii::t("login","You will be <b class='letter-green'>automatically connected</b> and redirect on your page") ?>.
                    
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-default letter-green" data-dismiss="modal"><i class="fa fa-check"></i> <?php Yii::t("login","I understand") ?></button>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="modalSendActivation" tabindex="-1" role="dialog" aria-hidden="true">
    <form class="modal-content form-email-activation box-email padding-top-15"  >
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="name" >
                        <?php if(Yii::app()->params["CO2DomainName"] == "kgougle"){ ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" height="60" class="inline margin-bottom-15">
                       <?php } else if(Yii::app()->params["CO2DomainName"] == "FI"){ ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/FI-logo.png" height="60" class="inline margin-bottom-15">
                       <?php } else { ?>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="100" class="inline margin-bottom-15">
                        <?php } ?>
                    </span>
                    <h3 class="letter-red no-margin" style="margin-top:-15px!important;"><?php echo Yii::t("login", "You didn't receive the validation email ?") ?></h3><br>
                    <p><?php echo Yii::t("login","Indicate your email link to your account to receive a new validation") ?>.<hr></p>
                </div>
                <div class="col-lg-12">
                    <p></p>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-4 text-left">
                
                <label class="letter-black"><i class="fa fa-envelope"></i> <?php echo Yii::t("login","Email") ?></label><br>
                <input class="form-control" id="email2" name="email2" type="text" placeholder="<?php echo Yii::t("login","Email") ?>"><br/>
                
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

                <a href="javascript:" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo Yii::t("common", "Back") ?></a>
                <button class="btn btn-success text-white pull-right sendValidateEmailBtn"><i class="fa fa-sign-in"></i> <?php echo Yii::t("common","Validate") ?></button>
                
                
                <div class="col-md-12 margin-top-50 margin-bottom-50"></div>
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
    
    if(!userConnected)
        Login.init();
    else
        addCustomValidators(); 

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

    /*$("#username").change(function(){
        $("#registerName").val($(this).val());
    });*/

});


</script>