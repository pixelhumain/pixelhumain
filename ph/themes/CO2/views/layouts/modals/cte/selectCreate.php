<style>
    
    #div-select-create button i.fa{
        width:50px;
        height:50px;
        text-align: center;
        border-radius: 50px;
        color:white!important;
        padding-top:12px;
        margin-bottom: 6px;

    }

    #div-select-create button:hover{
        border: 1px solid #e3e3e3;
        border-radius: 0px;
    }
    #div-select-create small{
        text-transform: uppercase;
    }
    .btn-open-form:hover,
    .btn-open-form:active{
        text-decoration: none;
    }


@media (max-width: 768px) {
    #div-select-create small{
        font-size: 9px;
        text-transform: none !important;
        font-weight: bold;
    }
}
    /*#selectCreate.portfolio-modal.modal {
        overflow-x: hidden !important;
        overflow-y: auto !important;
        width: 90%;
        margin-left: 5%;
        bottom: 3%;
        top: 11%;
        -webkit-box-shadow: 0px 1px 5px -2px rgba(0,0,0,0.5);
        -moz-box-shadow: 0px 1px 5px -2px rgba(0,0,0,0.5);
        box-shadow: 0px 0px 11px 4px rgba(0,0,0,0.5);
    }*/

</style>
<div class="portfolio-modal modal fade" id="selectCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-lg-12 text-center">
                    <img src="<?php Yii::app()->getModule("eco")->assetsUrl; ?>/images/custom/leport/tco.png" 
                         style="margin-top:20px;margin-bottom:10px;" 
                         class="nc_map" height=50><hr>
                </div>
               
            </div>

            <div class="row links-main-menu" id="div-select-create">
               
               <h4 class="text-center" style="padding-left:0px;"><i class="fa fa-angle-down"></i> Publier quelque chose</h4>
                <div class="col-md-12 col-sm-12 col-xs-12"><hr></div>

                <button data-form-type="event"  data-dismiss="modal"
                        class="btn btn-link btn-open-form col-xs-6 col-sm-6 col-md-3 col-lg-3 text-orange">
                    <h6><i class="fa fa-calendar fa-2x bg-orange"></i><br> Événement</h6>
                    <small>Faire connaitre votre événement<br>Inviter des participants<br>Informer en direct</small>
                </button>
                <button data-form-type="classified"  data-dismiss="modal"
                        class="btn btn-link btn-open-form col-xs-6 col-sm-6 col-md-3 col-lg-3 text-azure hide-event">
                    <h6><i class="fa fa-bullhorn fa-2x bg-azure"></i><br> Annonce</h6>
                    <small>Publier une petite annonce<br>Partager Donner Vendre Louer<br>Matériel Immobilier Emploi</small>
                </button>

                <button data-form-type="project"  data-dismiss="modal"
                        class="btn btn-link btn-open-form col-xs-6 col-sm-6 col-md-3 col-lg-3 text-purple hide-event">
                    <h6><i class="fa fa-lightbulb-o fa-2x bg-purple"></i><br> Projet</h6>
                    <small>Faire connaitre votre projet<br>Trouver du soutien<br>Construire une communauté</small>
                </button>

                <button data-form-type="poi"  data-dismiss="modal"
                        class="btn btn-link btn-open-form col-xs-6 col-sm-6 col-md-3 col-lg-3 text-green">
                    <h6><i class="fa fa-map-marker fa-2x bg-green"></i><br> Point d'intérêt</h6>
                    <small>Faire connaître un lieu intéressant<br>Contribuer à la carte collaborative<br>Connecter son territoire</small>
                </button>

                <div class="section-create-page">
                    <div class="col-md-12 col-sm-12 col-xs-12"><hr></div>
                    <h4 class="text-center no-margin" style="padding-left:0px;"><i class="fa fa-angle-down"></i> Créer une page</h4>
                    <div class="col-md-12 col-sm-12 col-xs-12"><hr></div>
                    
                    <!--
                    <button data-form-type="entry"  data-dismiss="modal"
                            class="btn btn-link btn-open-form col-xs-6 col-sm-6 col-md-3 col-lg-3 letter-yellow">
                        <h6><i class="fa fa-gavel fa-2x bg-yellow-k"></i><br> Proposition</h6>
                        <small>Faire une proposition citoyenne<br>Participer à la démocratie locale<br>Être un citoyen actif</small>
                    </button>
                    -->
                    <button data-form-type="organization" data-form-subtype="<?php echo Organization::TYPE_NGO; ?>"  data-dismiss="modal"
                            class="btn btn-link btn-open-form col-xs-6 col-sm-6 col-md-3 col-lg-3 text-green">
                        <h6><i class="fa fa-group fa-2x bg-green"></i><br> Association</h6>
                        <small>Faire connaitre votre association<br>Gérer les adhérents<br>Partager votre actualité</small>
                    </button>
                    
                    <button data-form-type="organization" data-form-subtype="<?php echo Organization::TYPE_BUSINESS; ?>"  data-dismiss="modal"
                            class="btn btn-link btn-open-form col-xs-6 col-sm-6 col-md-3 col-lg-3 text-azure">
                        <h6><i class="fa fa-industry fa-2x bg-azure"></i><br> Entreprise</h6>
                        <small>Faire connaitre votre entreprise<br>Trouver de nouveaux clients<br>Gérer vos contacts</small>
                    </button>
                    
                    <button data-form-type="organization" data-form-subtype="<?php echo Organization::TYPE_GROUP; ?>"  data-dismiss="modal"
                            class="btn btn-link btn-open-form col-xs-6 col-sm-6 col-md-3 col-lg-3 letter-turq">
                        <h6><i class="fa fa-group fa-2x bg-turq"></i><br> Groupe</h6>
                        <small>Créer un groupe<br>Partager vos centres d'intêrets<br>Discuter Communiquer S'amuser</small>
                    </button>

                    <button data-form-type="organization" data-form-subtype="<?php echo Organization::TYPE_GOV; ?>"  
                            data-dismiss="modal"
                            class="btn btn-link btn-open-form col-xs-6 col-sm-6 col-md-3 col-lg-3 text-red">
                        <h6><i class="fa fa-university fa-2x bg-red"></i><br> Service public</h6>
                        <small>Mairies, scolaires, etc...<br>Partager votre actualité<br>Partager des événements</small>
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() { 
    $(".btn-open-form").click(function(){
        var typeForm = $(this).data("form-type");
        mylog.log("test", $(this).data("form-subtype")),
        currentKFormType = ($(this).data("form-subtype")) ? $(this).data("form-subtype") : null;
        //alert(contextData.type+" && "+contextData.id+" : "+typeForm);
        if(contextData && contextData.type && contextData.id )
            dyFObj.openForm(typeForm,"sub");
        else
            dyFObj.openForm(typeForm);
    });
});
</script>