<form class="form-register box-register"> 
    <div class="col-md-12 no-padding text-left">
        
        <h4 class="margin-top-10 text-red"><i class="fa fa-plus"></i> <?php echo Yii::t("login","Create an account") ?></h4>
        <label class="letter-black"><i class="fa fa-address-book-o"></i> <?php echo Yii::t("login","Name and surname") ?></label>
        <input class="form-control" id="registerName" name="name" type="text" placeholder="<?php echo Yii::t("login","name and surname") ?>" tabindex="5"><br/>
        
        <label class="letter-black"><i class="fa fa-user-circle-o"></i> <?php echo Yii::t("login","User name") ?></label><br>
        <input class="form-control" id="username" name="username" type="text" placeholder="<?php echo Yii::t("login","user name") ?>" tabindex="6"><br/>
        
        <label class="letter-black"><i class="fa fa-envelope"></i> <?php echo Yii::t("login","Email") ?></label><br>
        <input class="form-control" id="email3" name="email3" type="email" placeholder="<?php echo Yii::t("login","email") ?>" tabindex="7"><br/>
        
        <label class="letter-black"><i class="fa fa-key"></i> <?php echo Yii::t("login","Password") ?></label><br/>
        <input class="form-control" id="password3" name="password3" type="password" placeholder="<?php echo Yii::t("login","password") ?>" tabindex="8"><br/>
        
        <label class="letter-black"><i class="fa fa-key"></i> <?php echo Yii::t("login","Password again") ?></label><br/>
        <input class="form-control" id="passwordAgain" name="passwordAgain" type="password" placeholder="<?php echo Yii::t("login","password (confirmation)") ?>" tabindex="9">
        <div class="form-group pull-left no-margin padding-top-10" style="width:100%;">
            <div>
                <label for="agree" class="checkbox-inline letter-red">    
                    <input class="grey agree" id="agree" type="checkbox" name="agree" tabindex="10">
                    <?php echo Yii::t("login","I agree to the Terms of") ?><br>
                    <a href="https://www.communecter.org/doc/Conditions Générales d'Utilisation.pdf" target="_blank" class="bootbox-spp text-dark">
                        <?php echo Yii::t("login","Service and Privacy Policy") ?>
                    </a>
                </label>
                <!-- <a href="javascript:" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Retour</a> -->
                <button class="btn btn-success text-white pull-right createBtn"><i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Create account") ?></button>
            </div>
        </div>
        <div class="pull-left form-actions no-margin" style="width:100%; padding:10px;">
            <div class="errorHandler alert alert-danger no-display registerResult pull-left " style="width:100%;">
                <i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Please verify your entries.") ?>
            </div>
            <div class="alert alert-success no-display pendingProcess" style="width:100%;">
                <i class="fa fa-check"></i> <?php echo Yii::t("login","You've been invited : please resume the registration process in order to log in.") ?>
            </div>
        </div>
        
        <!-- <br>         -->
        
    </div>      
</form>