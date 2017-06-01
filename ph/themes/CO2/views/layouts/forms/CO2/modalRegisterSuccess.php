<div class="modal fade" role="dialog" id="modalRegisterSuccess">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green-k text-white">
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