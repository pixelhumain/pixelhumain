<div class="modal fade" role="dialog" id="modalRegisterSuccess">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green-k text-white">
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