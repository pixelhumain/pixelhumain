<style>
    .label-qdj{
        font-size:30px;
        margin-top:-45px;
        margin-bottom:5px;
        padding:25px 0 0 0;
        border:5px solid black;
    }
    .label-qdj h1{
        font-size:40px;
        margin-bottom:25px;
        background-color: rgba(53, 168, 222, 0.8);
    }
    .label-qdj .dayQuestion{
        background-color: rgba(53, 168, 222, 0.9);
        color:white;
        font-weight:800;
    }
    .label-qdj .dayAuthor{
        font-size:15px;
        background-color: rgba(255, 255, 255, 0.9);
        padding:5px;
        margin:10px;
        border-radius:5px;
    }
    .label-qdj .btn-learn-dayQuestion{
        background-color: rgba(255, 255, 255, 0.9);
        color:black!important;
        font-size:16px;
    }

    .label-qdj .btn-learn-dayQuestion:hover{
        /*background: rgba(50, 69, 75, 0.5);*/
        color:#4285f4!important;
        text-decoration: none;
    }

    .label-introQ{
        font-size:30px;
    }

    .btn-introQ{
        font-size:20px;
        border:3px solid #fbbc05;
        border-radius: 40px;
        margin-top: -30px;
        height: 70px;
        width: 70px;
    }
    .btn-introQ:hover{
        border:3px solid #fbbc05;
    }

    #modalDayQuestion p{
        text-align: left;
        font-size:14px;
    }

@media (max-width: 768px) {
    .label-qdj{
        font-size:16px;
        margin-top:-25px;
        margin-bottom:5px;
    }
    .label-qdj h1{
        font-size:28px;
    }

    .label-introQ{
        font-size:20px;
    }
}

</style>
<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 shadow2 label-qdj">
    <h1 class="label text-white no-padding font-blackoutT">
        La kestion du jour
    </h1>
    <br>
    <div class="margin-top-10 padding-15 dayQuestion">
        <i class="fa fa-quote-left"></i>
        Kel est ton souhait, ton rêve, ta promesse pour l'année 2018 ? 
        <i class="fa fa-quote-right"></i> 
    </div>
    <button class="btn btn-sm btn-link btn-learn-dayQuestion font-blackoutM text-white bold pull-left margin-left-10 margin-top-10"
            data-toggle="modal" data-target="#modalDayQuestion">
        <i class="fa fa-cog"></i> regle du jeu
    </button>
    <span class="margin-top-10 text-dark pull-right dayAuthor">
        question posée par <b>AlphaTango</b>
    </span>
</div>


<h2 class="col-xs-12  bg-white no-padding letter-yellow no-margin font-blackoutM label-introQ">
    <button class="btn btn-default letter-yellow btn-introQ">
        <i class="fa fa-pencil padding-10"></i>
    </button>
    <br>
    <br>
    Donnes ta reponse<br>
    <span class="margin-5 letter-green inline-block">
        dans le fil de discussion !!!
        <br>
        <i class="fa fa-chevron-down"></i>
        <br>
        <hr>
        <button class="btn btn-link bg-red font-montserrat tooltips" id="btn-start-filter-qdj"
                data-original-title="Cliquez pour activer le filtre par tag" data-tag="#moiKgou2018"
                style="text-transform: none!important;">
                <i class="fa fa-hashtag"></i>moiKgou2018
        </button>
        <button class="btn btn-link bg-white letter-red font-montserrat tooltips" id="btn-clear-search-tag" 
                data-original-title="Désactiver le filtre par tag"
                >
            <i class="fa fa-times"></i>
        </button>
    </span>
    <br><hr>
</h2>




<div class="portfolio-modal modal fade" id="modalDayQuestion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <div class="row">
                <div class="col-xs-12 font-montserrat">
                    
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" 
                         height="50" class="inline margin-top-25 margin-bottom-5"><br>
                    <h2 class="font-blackoutT letter-red">FREEDOM</h2>
                    <br>

                    <hr>

                    <h2 class="font-blackoutT letter-red text-left">FREEDOM ?</h2>
                    <br>
                    <p>
                        <span class="letter-red">Freedom</span> 
                        est un fil de discussion public, partagé par l'ensemble des membres du réseau Kgougle.<br>
                        Chacun est libre d'y contribuer à sa manière en publiant des messages.
                        <br><br>
                        C'est l'endroit approprié pour s'exprimer publiquement (dans le respect des autres utilisateurs), et aborder tout sujet de société digne d'intérêt.
                        <br><br>
                        Vous pouvez y parler de l'actualité, passer un coup de coeur ou un coup de gueule, poser une question,
                        lancer un débat, souhaiter un aniversaire, ou simplement partager une émotion, etc, etc...
                        <br><br>
                        Les possibilités sont infinies !
                        <br><br>
                        <i class="fa fa-flag letter-red"></i> La modération des publications se fait par les utilisateurs eux-mêmes, 
                        via un système de 
                        <button class="btn btn-link letter-blue no-padding btn-howitworkmoderation">
                            modération collective
                        </button>.
                    </p>

                    <?php $this->renderPartial('../cooperation/pod/explain_moderation'); ?>

                     <br>
                     <hr>

                    <h2 class="letter-blue no-margin text-left font-blackoutT" style="">
                        La kestion du jour
                    </h2>
                    <br>
                    <p>
                        <b class="letter-blue"><i>La Kestion du jour</i></b> 
                        est un jeu destiné à animer cet espace de discussion en ce début d'année 2018 !
                        <br><br>
                        La toute première question est posé par 
                        <a href="#info.p.alphatango" class="btn btn-link letter-azure no-padding">Alpha Tango</a>, 
                        une question simple et ouverte pour vous donner envie de vous exprimer, et facilité votre découverte de l'application <span class="letter-red">Freedom</span>.
                        <br><br>
                        Mais <b>dès le 1er février</b>, <i><b>VOUS</b></i> pourrez poser vos propres questions !
                    </p>
                    
                     <br>
                     <hr>

                    <h2 class="letter-green no-margin text-left font-blackoutT" style="">
                        Regle du jeu
                    </h2>
                    <br>
                    <p>
                        <b class="letter-green">
                            <i class="fa fa-angle-right"></i> <i class="fa fa-calendar"></i>
                            Du 15 au 31 Janvier
                        </b>
                             , pour le lancement du jeu <b class="letter-blue"><i>La Kestion du jour</i></b>, 
                             vous êtes invité à répondre à la question suivante : <br>
                        <b>Kel est ton souhait, ton rêve, ta promesse pour l'année 2018 ?</b>
                        <br><br>
                        <b class="letter-green">
                            <i class="fa fa-angle-right"></i> <i class="fa fa-calendar"></i>
                            A partir du 29 janvier
                        </b>
                        , vous pourrez proposer vos propres questions, et voter pour votre question préférée jusqu'au 31 janvier, minuit. 
                        <br><br>
                        <b class="letter-green">
                            <i class="fa fa-angle-right"></i> <i class="fa fa-calendar"></i>
                            A partir du 1er février
                        </b>
                        <br>
                        <b class="letter-blue"><i>La Kestion du jour</i></b> <b>changera tous les jours</b>.
                        <br> 
                        Vous pourrez quotidiennement proposer vos propres questions et voter pour la prochaine 
                        <b class="letter-blue"><i>Kestion du jour</i></b> !
                    </p>

                     <br>
                     <hr>

                    <h2 class="letter-yellow no-margin text-left font-blackoutT" style="">
                        COMMENT PARTICIPER ?
                    </h2>
                    <br>
                    <p>
                        La seule condition pour participer à <b class="letter-blue"><i>La Kestion du jour</i></b> 
                        est d'être inscrit sur KGOUGLE.nc

                    <?php if(isset(Yii::app()->session['userId'])){ ?><p class="font-montserrat">
                        <hr>
                        <h5 class="text-left letter-green">
                          <i class="fa fa-check"></i> Vous êtes déjà connecté<br>
                          <small>Vous pouvez participer dès maintenant</small>
                        </h5>
                    <?php }else{ ?>
                      <p class="font-montserrat">
                        <hr>
                        <h5 class="text-left letter-red">
                          <i class="fa fa-ban"></i> Vous n'êtes pas connecté<br>
                          <small>Connectez-vous pour participer !</small>
                          <br><br>

                          <button class="btn btn-link bg-green-k margin-top-5 margin-right-10" data-toggle="modal" data-target="#modalLogin">
                            <i class="fa fa-sign-in"></i> Je me connecte
                          </button>
                          <button class="btn btn-link bg-blue-k margin-top-5" data-toggle="modal" data-target="#modalRegister">
                            <i class="fa fa-plus-circle"></i> Je créé mon compte
                          </button> 
                          <br><br>
                          <small class="letter-blue"><i class="fa fa-check"></i> inscription gratuite</small>
                        </h5>
                        <hr>
                      </p>
                    <?php } ?>
                    </p>

                    <br>
                    <br>
                    <br>

                </div>
            </div>
            <div class="row">
            </div>
        </div>
    </div>
</div>

<script>

var tagQDJ = null;

jQuery(document).ready(function() {
    $(".btn-introQ").click(function(){
        showFormBlock(false);
        KScrollTo("#container-scope-filter");
        showFormBlock(true);
        $("#form-news #tags").select2("val",new Array($("#btn-start-filter-qdj").data("tag")));
    });

    $("#btn-clear-search-tag").addClass("hidden");

    $("#btn-start-filter-qdj").click(function(){
        //$(".tooltips").tooltip();  
        $(".tooltip.fade.in").remove();
        $("#btn-clear-search-tag").removeClass("hidden");
        var tag = $(this).data("tag");
        $("#second-search-bar, #main-search-bar").val(tag);
        tagQDJ = $("#btn-start-filter-qdj").data("tag");
        startNewsSearch(true);
        KScrollTo("#container-scope-filter");

        // setTimeout(function(){
        //     $("#form-news #tags").select2("val",new Array(tag));
        // } , 4000);
    });

    $("#btn-clear-search-tag").show().click(function(){
        $("#second-search-bar, #main-search-bar").val("");
        $("#btn-clear-search-tag").addClass("hidden");
        $("#tags").val("");
        tagQDJ = null;
        startNewsSearch(true);
        KScrollTo("#container-scope-filter");
    });

    $(".btn-howitworkmoderation").click(function(){
        if($("#howitworkmoderation").hasClass("hidden"))
            $("#howitworkmoderation").removeClass("hidden");
        else
            $("#howitworkmoderation").addClass("hidden");
    });


});
   
</script>