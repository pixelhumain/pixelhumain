
<div class="portfolio-modal modal fade" id="invite-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row links-create-element">
                <div class="col-lg-12">
                    <div id="" class="modal-body">
                        <form class="form-invite" autocomplete="off">
                            <div class="col-xs-12">
                                <div class="modal-body text-center">

                                    <h2 class="text-green">
                                        <i class="fa fa-plus-circle padding-bottom-10"></i>
                                        <span class="font-light"> Inviter quelqu'un</span>
                                    </h2>
                                    
                                    <div class="row margin-bottom-10">
                                        <div class="col-md-1 col-md-offset-1" id="iconUser">    
                                            <i class="fa fa-user fa-2x"></i>
                                        </div>
                                        <div class="col-md-9">
                                            <input class="invite-name form-control" placeholder="<?php echo Yii::t("common", "Name");?>" id="inviteName" name="inviteName" value="" />
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-10">
                                        <div class="col-md-1 col-md-offset-1">  
                                            <i class="fa fa-envelope-o fa-2x"></i>
                                        </div>
                                        <div class="col-md-9">
                                            <input class="invite-email form-control" placeholder="<?php echo Yii::t("common", "Email");?>" id="inviteEmail" name="inviteEmail" value="" />
                                        </div>
                                    </div>
                                    <div class="row margin-bottom-10">
                                        <div class="col-md-1 col-md-offset-1">  
                                            <i class="fa fa-align-justify fa-2x"></i>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="invite-text form-control" id="inviteText" name="inviteText" rows="4" />Bonjour, J'ai découvert un réseau sociétal citoyen appelé "Communecter - être connecter à sa commune". 
Tu peux agir concrétement autour de chez toi et découvrir ce qui s'y passe. Viens rejoindre le réseau sur communecter.org.</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                <hr>
                                <a href="javascript:;" style="font-size: 13px;" class="btn btn-danger btnCancel" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Retour</a> 
                                <button class="btn bg-dark " id="btnInviteNew" >Inviter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

jQuery(document).ready(function() {
    runinviteFormValidation();
});
  
function runinviteFormValidation(el) {
    var forminvite = $('.form-invite');
    var errorHandler2 = $('.errorHandler', forminvite);
    var successHandler2 = $('.successHandler', forminvite);

    forminvite.validate({
        errorElement : "span", // contain the error msg in a span tag
        errorClass : 'help-block',
        errorPlacement : function(error, element) {// render error placement for each input type
            if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
                error.insertAfter($(element).closest('.form-group').children('div').children().last());
            } else if (element.parent().hasClass("input-icon")) {

                error.insertAfter($(element).parent());
            } else {
                error.insertAfter(element);
                // for other inputs, just perform default behavior
            }
        },
        ignore : "",
        rules : {
            inviteName : {
                required : true,
                minlength : 2
                
            },
            inviteEmail : {
                required : true
            }
        },
        messages : {
            inviteName : "* "+trad["Please specify a name"],
            inviteSearch : "* "+trad["Please specify a email"]
        },
        invalidHandler : function(invite, validator) {//display error alert on form submit
            successHandler2.hide();
            errorHandler2.show();
        },
        highlight : function(element) {
            $(element).closest('.help-block').removeClass('valid');
            // display OK icon
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
            // add the Bootstrap error class to the control group
        },
        unhighlight : function(element) {// revert the change done by hightlight
            $(element).closest('.form-group').removeClass('has-error');
            // set error class to the control group
        },
        success : function(label, element) {
            label.addClass('help-block valid');
            // mark the current input as valid and display OK icon
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
        },
        submitHandler : function(form) {
            mylog.log("submit handler");
            successHandler2.show();
            errorHandler2.hide();
            var parentId = $(".form-invite .invite-parentId").val();
            var invitedUserName = $("#inviteName").val();
            var invitedUserEmail = $("#inviteEmail").val();
            $.blockUI({
                message : '<span class="homestead"><i class="fa fa-spin fa-circle-o-noch"></i> Merci de patienter ...</span>'
            });
            $.ajax({
                type: "POST",
                url: baseUrl+"/"+moduleId+'/person/follows',
                dataType : "json",
                data: {
                    parentId : parentId,
                    invitedUserName : invitedUserName,
                    invitedUserEmail : invitedUserEmail,
                    msgEmail : $("#inviteText").val()
                }
            })
            .done(function (data) {
                $.unblockUI();
                if (data &&  data.result) {               
                    toastr.success('L\'invitation a été envoyée avec succès!');
                    $("#inviteName").val("");
                    $("#inviteEmail").val("");
                    $("#inviteText").val('Bonjour, J\'ai découvert un réseau sociétal citoyen appelé "Communecter - être connecter à sa commune".\nTu peux agir concrétement autour de chez toi et découvrir ce qui s\'y passe. Viens rejoindre le réseau sur communecter.org."');
                    $('#invite-modal').modal('hide');
                    
                } else {
                    $.unblockUI();
                    toastr.error(data.msg);
                }
            });
        }
    });
};


</script>