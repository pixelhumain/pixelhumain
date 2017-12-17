<style>
    .label-qdj{
        font-size:35px;
        margin-top:-45px;
        margin-bottom:5px;
        padding:25px 0 0 0;
        border:5px solid black;
    }
    .label-qdj h1{
        font-size:55px;
        margin-bottom:25px;
        background-color: rgba(53, 168, 222, 0.8);
    }
    .label-qdj h1{
        font-size:55px;
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
        background: rgba(50, 69, 75, 0.5);
        font-size:16px;
    }

    .label-qdj .btn-learn-dayQuestion:hover{
        background-color: rgba(255, 255, 255, 0.9);
        color:black!important;
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
<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 shadow2 label-qdj">
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

        <div class="col-lg-6 col-lg-offset-3">
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
                        est un fil de discussion citoyen, partagé par l'ensemble des membres du réseau Kgougle.<br>
                        Chacun est libre d'y contribuer à sa manière en publiant des messages.
                        <br><br>
                        <i class="fa fa-flag letter-red"></i> La modération des publications se fait par les utilisateurs eux-mêmes, 
                        via un système de <a href="" class="btn btn-link letter-azure no-padding">modération collective</a>.
                    </p>

                    <hr>

                    <h2 class="letter-blue no-margin text-left font-blackoutT" style="">
                        La kestion du jour
                    </h2>
                    <br>
                    <p>
                        <b class="letter-blue"><i>La Kestion du jour</i></b> 
                        est un jeu destiné à animer cet espace de discussion en ce début d'année 2018.
                        <br><br>
                        La toute première question vous est proposé par 
                        <a href="#info.p.alphatango" class="btn btn-link letter-azure no-padding">Alpha Tango</a>, 
                        une question simple et ouverte pour vous donner envie de vous exprimer.
                        <br><br>
                        Mais <b>dès le 15 janvier</b>, <i><b>VOUS</b></i> pourrez poser vos propres questions !
                    </p>

                    <hr>

                    <h2 class="letter-green no-margin text-left font-blackoutT" style="">
                        Regle du jeu
                    </h2>
                    <br>
                    <p>
                        <b class="letter-green">
                            <i class="fa fa-angle-right"></i> <i class="fa fa-calendar"></i>
                            Du 1er au 15 Janvier
                        </b>
                             , pour le lancement du jeu <b class="letter-blue"><i>La Kestion du jour</i></b>, 
                             vous êtes invité à répondre à la question suivante : <br>
                        <b>Kel est ton souhait, ton rêve, ta promesse pour l'année 2018 ?</b>
                        <br><br>
                        <b class="letter-green">
                            <i class="fa fa-angle-right"></i> <i class="fa fa-calendar"></i>
                            A partir du 10 janvier
                        </b>
                        , vous pourrez proposer vos propres questions, et participer au tirage au sort qui aura lieu le 15 Janvier à 7h du matin. 
                        <br><br>
                        <b class="letter-green">
                            <i class="fa fa-angle-right"></i> <i class="fa fa-calendar"></i>
                            A partir du 16 janvier</b><br>
                        <b class="letter-blue"><i>La Kestion du jour</i></b> <b>changera tous les jours</b>.
                        <br> 
                        Une question sera tirée au sort chaque jour parmis vos propositions quotidiennes.
                        </b>
                    </p>

                </div>
            </div>
            <div class="row">
                
            </div>
        </div>
    </div>
</div>

<script>
    
jQuery(document).ready(function() {
    $(".btn-introQ").click(function(){
        KScrollTo("#container-scope-filter");
    });

    $("#btn-start-filter-qdj").click(function(){
        var tag = $(this).data("tag");
        $("#second-search-bar").val(tag);
        startNewsSearch(true);
        KScrollTo("#container-scope-filter");
    });


});
   
</script>