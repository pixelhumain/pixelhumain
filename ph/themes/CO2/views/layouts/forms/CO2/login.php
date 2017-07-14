
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
@media (min-width: 768px) and (max-width: 991px) {
 .topLogoAnim{
        top: 40px !important;
          right: 6%;
          
     }
     .topLogoAnim .homestead{
      font-size:25px !important;
    }   
    .subTitle {
        font-size: 10px;
    }
}
@media (max-width: 768px){
    .topLogoAnim{
        top: 75px !important;
          right: 1%;
          
     }
     .topLogoAnim .homestead{
      font-size:23px !important;
    }   
    .subTitle {
        font-size: 9px;
    margin-top: 7px !important;
    }
}
</style>

<style>
    .box-login{
        width:400px;
        display: inline-block;
        border-left:1px solid #CCC !important;
    }
    .box-login label{
        font-size:9px;
        margin-bottom: 2px;
    }
    .box-login .form-control{
        font-weight: 300;
        padding: 3px 10px;
        height:27px;
    }
    .loginBtn{
        height:27px;
        font-size:11px;
        margin-top:7px;
    }

    .help-block{
        font-size:10px;
        font-size: 9px;
        font-weight: 100;
    }

    @media screen and (max-width: 992px) {
        .box-login{
            width:300px;
        }
    } 

    @media (max-width: 767px) {
        .box-login{
            width:100%;
            border-left:0px solid #CCC !important;
        }
    }

</style>

<form class="form-login box-login hidden-xs">
    <div class="col-md-12 col-sm-12 col-xs-12 no-padding text-left pull-right" style="margin-top: -5px; margin-bottom: -5px;">

         <div class="col-md-4 col-sm-4 text-left pull-right hidden-xs ">          
            <button class="btn btn-success loginBtn bg-green-k" type="submit" style="margin-top: 18px;">
                <i class="fa fa-sign-in"></i> <span class="hidden-xs"><?php echo Yii::t("login","Log in") ?></span>
            </button><br><br>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-6 no-padding text-left pull-right">
            <label><i class="fa fa-key"></i> <?php echo Yii::t("login","A password") ?></label> 
            <input class="form-control" name="password" id="password-login" type="password" placeholder="<?php echo Yii::t("login","password") ?>" tabindex="2">
             <a href="javascript:" class="btn btn-link no-margin btn-sm" data-toggle="modal" data-target="#modalForgot" 
                style="font-size: 10px;text-transform: none!important;color:inherit;">
               <?php echo Yii::t("login","I forgot my password") ?>
            </a>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-6 text-left pull-right">
            <label><i class="fa fa-envelope"></i> <?php echo Yii::t("login","An email") ?></label> 
            <input class="form-control" name="email" id="email-login" type="text" placeholder="<?php echo Yii::t("login","email") ?>" tabindex="1">
            <label for="remember" class="checkbox-inline" style="text-transform: none!important;">
                <input type="checkbox" id="remember" name="remember" style="margin-top: 2px;" tabindex="3">
                <?php echo Yii::t("login","Keep me signed in") ?>
            </label>
        </div>

        <div class="visible-xs col-xs-12 text-left pull-right">          
            <button class="btn btn-success loginBtn bg-green-k" type="submit" tabindex="10">
                <i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Log in") ?>
            </button><br><br>
        </div>     
        

        <div class="form-actions col-md-12 col-sm-12" style="margin-top:5px;">
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

    </div>      
</form>
<!-- <button class="visible-xs letter-green font-montserrat btn-menu-connect margin-left-10" 
        data-toggle="modal" data-target="#modalLogin" style="font-size: 20px;">
    <span><i class="fa fa-sign-in"></i></span>
</button> -->
<button class="visible-xs letter-green font-montserrat btn-menu-connect margin-left-10" 
        data-toggle="modal" id="open-login-xs" style="font-size: 20px;">
    <span><i class="fa fa-sign-in"></i></span>
</button>
                            


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

jQuery(document).ready(function() {
    
   /*jQuery.extend(jQuery.expr[':'], {
  focus: "a == document.activeElement"
}); *///$('#email3').filter_input({regex:'/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/'});
    //$('#registerName').filter_input({regex:'[^@#&\'\"\`\\\\]'});
    //$('#username').filter_input({regex:'[^@#&\'\"\`\\\\]'});
    /*$('#email-login').focus(function() {
       // alert();
         $(document).keydown(function (e) {
            if (e.keyCode == 9) {
                alert();
                //$("#password-login").focusin();
            }
        });
   //             
    });*/
   
    //Remove parameters from URLs in case of invitation without reloading the page
    <?php if(@$_GET["email"]){ ?>
        removeParametersWithoutReloading();
    <?php } ?>
    
    //$(".box").hide();
    Login.init();
    titleAnim();

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

    $("#open-login-xs").click(function(){
        if($(".box-login").hasClass("hidden-xs")){
            $(".box-login").removeClass("hidden-xs").show();
        }else{
            $(".box-login").addClass("hidden-xs").hide();
        }
    });

});


</script>