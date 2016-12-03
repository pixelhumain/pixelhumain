
<style>
    .jp-audio, .jp-audio-stream, .jp-video{
        border: 0px solid #009be3;
    }
    .jp-audio-stream {
        width:100%;
    }
    /*.jp-interface{
        background-color: transparent;
    }
    .jp-controls button{
        background:none;
        text-indent:0;
    }
    .jp-play{
        background:none;
    }*/

    .btn-radioplay{
        background-color: transparent;
        border:none;
    }
    .btn-radioplay img{
        border:4px solid white;
        height: 70px;
        background-color: white;
    }

    .btn-radioplay:hover img{
        border:4px solid  #34a853;
    }

    .btn-radioplay.selected img{
        border:4px solid #34a853;
    }

    #cntr-radio{
        margin-top:-35px;
        min-height:110px;
    }

    .jp-audio .jp-interface, .jp-audio-stream .jp-interface {
        height: 24px;
    }
    .jp-volume-controls {
        top: 5px;
    }

@media (max-width: 1000px) {
  .btn-radioplay img{
    height: 50px;
  }
  #cntr-radio{
    background-color: #f8f8f8;
    margin-top:-20px;
  }


}

</style>


<div class="col-md-12 col-sm-12 no-padding" id="cntr-radio">
    <!-- <div class="col-md-12">
        <button class=""><i class="fa fa-microphone"></i> Écouter la radio</button>
    </div> -->
        <div class="col-md-5 col-sm-5 col-xs-5 text-right">
        <!-- <h3 id="timeline"><i class="fa fa-microphone"></i> Web radios</h3> -->
            <button class="btn-radioplay" data-src="http://radiodjiido.nc:8002/;stream.mp3?_=1" data-src-title="Djiido">
                <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/djiido.png">
            </button>
            <button class="btn-radioplay" data-src="http://radio.oceanefm.nc:8000/oceanenc" data-src-title="OceaneFM">
                <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/oceanefm.png"">
            </button>
            <button class="btn-radioplay" data-src="http://radio.lagoon.nc/nrj" data-src-title="NRJ">
                <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/nrj.png">
            </button>
            <button class="btn-radioplay" data-src="http://france1.coollabel-productions.com:8142/;" data-src-title="Reggae Mix Station">
                <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/ReggaeMixStation.png">
            </button>

            
        </div>

        <div class="col-md-2 col-sm-2 col-xs-2 no-padding text-center text-black">

            <i class="fa fa-microphone-slash fa-3x hidden-xs padding-15 fa-micro"></i>
            <i class="fa fa-microphone-slash fa-2x visible-xs fa-micro"></i><br>
            <h4 style="margin-top:-10px;">lE POSTE DE RADIO</h4>
            <button class="btn btn-default margin-bottom-5 btn-radio-play hidden"><i class="fa fa-play"></i></button>
            <button class="btn btn-default margin-bottom-5 btn-radio-pause hidden"><i class="fa fa-pause"></i></button>
            <h4 class="radio-name letter-green" aria-label="title"></h4>

            <div class="hidden" id="radioplayer">
                <div id="jquery_jplayer_1" class="jp-jplayer hidden"></div>
                <div id="jp_container_1" class="jp-audio-stream" role="application" aria-label="media player">
                    <div class="jp-type-single">
                        <div class="jp-gui jp-interface">
                            <div class="jp-controls">
                                <button class="jp-play hidden" role="button" tabindex="0"><i class="fa fa-play"></i></button>
                            </div>
                            <div class="jp-volume-controls">
                                <button class="jp-mute" role="button" tabindex="0">mute</button>
                                <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                <div class="jp-volume-bar">
                                    <div class="jp-volume-bar-value"></div>
                                </div>
                            </div>
                        </div>
                        <div class="jp-details hidden">
                            <div class="jp-title" aria-label="title"></div>
                        </div>
                        <div class="jp-no-solution hidden">
                            <span>Update Required</span>
                            To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-5 col-sm-5 col-xs-5 text-left ">
            

            <button class="btn-radioplay" data-src="http://str45.streamakaci.com:8014/;" data-src-title="Radio Flemme">
                <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/flemme.png">
            </button>
            <button class="btn-radioplay" data-src="http://radio.lagoon.nc/rrb?time=13026" data-src-title="RRB">
                <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/rrb.png">
            </button>
            <button class="btn-radioplay" data-src="http://radios.la1ere.fr/nouvellecaledonie" data-src-title="NC1ere">
                <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/nc1ere.png">
            </button>
            <button class="btn-radioplay" data-src="http://185.52.127.155/fr/30401/mp3_128.mp3" data-src-title="Rire & chanson">
                <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/rireetchanson.jpeg">
            </button>
        </div>
    </div>




<script>
jQuery(document).ready(function() {
    initRadioplayer();
});

var stream = {
    title: "Radio Djiido",
    mp3: "http://radiodjiido.nc:8002/;stream.mp3?_=1"
},
ready = false;

function initRadioplayer(){

    $(".btn-radioplay").click(function(){
        //var src = $(this).data("src");
        stream.mp3 = $(this).data("src");
        stream.title = $(this).data("src-title");

        if(ready)
        $("#jquery_jplayer_1").jPlayer("clearMedia");
        
        initRadio(stream);

        $("#jquery_jplayer_1").jPlayer("play");
        $(".radio-name").html("<span class='text-dark'>vous écoutez</span><br>" + stream.title);

        $(".btn-radioplay").removeClass("selected");
        $(this).addClass("selected");

        $(".btn-radio-play, .btn-radio-pause").removeClass("hidden");
        $(".btn-radio-play").hide();
        $(".btn-radio-pause").show();
    });

    $(".btn-radio-play").click(function(){
        $("#jquery_jplayer_1").jPlayer("play");
        $(".btn-radio-play").hide();
        $(".btn-radio-pause").show();
        $(".fa-micro").removeClass("fa-microphone-slash").addClass("fa-microphone");
    });
    $(".btn-radio-pause").click(function(){
        $("#jquery_jplayer_1").jPlayer("pause");
        $(".btn-radio-pause").hide();
        $(".btn-radio-play").show();
        $(".fa-micro").removeClass("fa-microphone").addClass("fa-microphone-slash");
    });

}

function initRadio(stream){
    $("#jquery_jplayer_1").jPlayer({
        ready: function (event) {
            ready = true;
            $(this).jPlayer("setMedia", stream);
            $("#jquery_jplayer_1").jPlayer("play");
            $(".jp-title").html(stream.title);
        },
        pause: function() {
            $(this).jPlayer("clearMedia");
        },
        error: function(event) {
            if(ready && event.jPlayer.error.type === $.jPlayer.error.URL_NOT_SET) {
                // Setup the media stream again and play it.
                $(this).jPlayer("setMedia", stream).jPlayer("play");
            }
        },
        swfPath: "../../dist/jplayer",
        supplied: "mp3",
        preload: "none",
        wmode: "window",
        useStateClassSkin: true,
        autoBlur: false,
        keyEnabled: true,
        backgroundColor:"#FFFFF"
    });

}
</script>


