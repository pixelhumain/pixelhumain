<form class="form-register box-register" id="register-welcome">  
    <div class="col-md-12 no-padding text-left">
        
        <h3 class="text-dark"><i class="fa fa-plus"></i> Créer un compte </h3>
        <label class="letter-black"><i class="fa fa-address-book-o"></i> Nom et prénom</label>
        <input class="form-control" id="registerName-welcome" name="name" type="text" placeholder="Nom et prénom" tabindex="5"><br/>
        
        <label class="letter-black"><i class="fa fa-user-circle-o"></i> Nom d'utilisateur</label><br>
        <input class="form-control" id="username-welcome" name="username" type="text" placeholder="Nom d'utilisateur" tabindex="6"><br/>
        
        <label class="letter-black"><i class="fa fa-envelope"></i> E-mail</label><br>
        <input class="form-control" id="email3-welcome" name="email3" type="text" placeholder="e-mail" tabindex="7"><br/>
        
        <label class="letter-black"><i class="fa fa-key"></i> Mot de passe</label><br/>
        <input class="form-control" id="password3-welcome" name="password3" type="password" placeholder="mot de passe" tabindex="8"><br/>
        
        <label class="letter-black"><i class="fa fa-key"></i> Répétez le mot de passe</label><br/>
        <input class="form-control" id="passwordAgain-welcome" name="passwordAgain" type="password" placeholder="mot de passe (confirmation)" tabindex="9">
        
        <div class="pull-left form-actions no-margin" style="width:100%; padding:10px;">
            <div class="errorHandler alert alert-danger no-display registerResult pull-left " style="width:100%;">
                <i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Please verify your entries.") ?>
            </div>
            <div class="alert alert-success no-display pendingProcess" style="width:100%;">
                <i class="fa fa-check"></i> <?php echo Yii::t("login","You've been invited : please resume the registration process in order to log in.") ?>
            </div>
        </div>

        <!-- <a href="javascript:" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Retour</a> -->
        <label for="agree-welcome" class="checkbox-inline letter-red">
            <input type="checkbox" class="grey agree" id="agree-welcome" name="agree" tabindex="10">
            <?php echo Yii::t("login","I agree to the Terms of") ?><br> 
            <a href="https://www.communecter.org/doc/Conditions Générales d'Utilisation.pdf" target="_blank" class="bootbox-spp text-dark">
                <?php echo Yii::t("login","Service and Privacy Policy") ?>
            </a>
        </label>
        <button class="btn btn-success text-white pull-right createBtn"><i class="fa fa-sign-in"></i> S'inscrire</button>
        
        <!-- <br>         -->
        
    </div>      
</form>
<script type="text/javascript">
jQuery(document).ready(function() {
   // var errorHandler3 = $('.errorHandler', $("#register-welcome"));
    $("#register-welcome").validate();
    $("#email3-welcome").rules('add', {
        required : { 
            depends:function(){
                $(this).val($.trim($(this).val()));
                return true;
            }
        },
        email : true
    });
    $("#registerName-welcome").rules('add', {
        required : true,
        minlength : 4
    });
    $("#username-welcome").rules('add', { 
        required : true,
        validUserName : true,
        rangelength : [4, 32]
    });
    $("#password3-welcome").rules('add', {
        minlength : 8,
        required : true
    });
    $("#passwordAgain-welcome").rules('add', {
        equalTo : "#password3-welcome"
    });
    $("#agree-welcome").rules('add', {
        minlength : 1,
        required : true,
        message:"<?php echo Yii::t("login","You must validate the CGU to sign up.") ?>",
    });
});
</script>