
<?php HtmlHelper::registerCssAndScriptsFiles( array('/css/radioplayer.css', ) , Yii::app()->theme->baseUrl. '/assets'); ?>

<style>

    .btn-radioplay img{
        height: 100px;
    }

    .btn-radio-cntr{
        margin-top:20px;
        padding:20px;
    }

    .radio-name{
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.3);
        border-radius: 100px;
    }

    @media screen and (max-width: 1024px) {
        .btn-radio-cntr{
            margin-top:70px;
        }
    }

    @media (max-width: 768px) {
        .btn-radio-cntr{
            margin-top:0px;
        }
        .btn-radioplay img{
            height: 65px;
        }
        .portfolio-modal .modal-content h2.poste {
            font-size: 1.7em;
            margin-top:0px;
        }
        .radio-name{
            padding-top: 0px;
        }
    }

</style> 

<div class="portfolio-modal modal fade" id="modalRadioTool" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <!-- <span class="name font-blackoutM" >
                        <span class="letter letter-blue font-ZILAP letter-k">K</span>
                        <span class="letter letter-yellow">G</span>
                        <span class="letter letter-yellow font-ZILAP">O</span>
                        <span class="letter letter-yellow">U</span>
                        <span class="letter letter-green">G</span>
                        <span class="letter letter-green">L</span>
                        <span class="letter letter-green">E</span>
                    </span> -->
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" height="45" class="inline margin-bottom-15">
                    <!-- <i class="letter-red fa fa-microphone-slash fa-3x visible-xs fa-micro"></i> --> 
                    <br class="visible-xs">
                    <i class="letter-red fa fa-microphone-slash fa-3x hidden-x padding-15 fa-micro"></i>
                    <button class="btn btn-success btn-lg margin-bottom-5 btn-radio-play hidden"><i class="fa fa-play"></i></button>
                     <button class="btn btn-success btn-lg margin-bottom-5 btn-radio-pause hidden"><i class="fa fa-pause"></i></button>
                        
                    <br>
                
                    <h2 class="letter-red font-blackoutT poste">
                        LE POSTE DE RADIO
                    </h2>

                    <br>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12 no-padding row-radio" >

                        <div class="col-md-12 col-sm-12 no-padding" id="cntr-radio">
                            <!-- <div class="col-md-12">
                                <button class=""><i class="fa fa-microphone"></i> Écouter la radio</button>
                            </div> -->
                                <div class="col-md-12 col-sm-12 col-xs-12 no-padding text-center text-white">

                                    
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

                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    <h3 class="radio-name letter-green inline-block hidden" aria-label="title"></h3>
                                </div>


                                <div class="col-md-12 col-sm-12 col-xs-12 text-center btn-radio-cntr" style="">
                                <!-- <h3 id="timeline"><i class="fa fa-microphone"></i> Web radios</h3> -->

                                    <h3 class="text-white">Local</h3>

                                    <button class="btn-radioplay" data-src="http://radiodjiido.nc:8002/;stream.mp3?_=1" data-src-title="Djiido">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/djiido.png">
                                    </button>
                                    <button class="btn-radioplay" data-src="http://radio.oceanefm.nc:8000/oceanenc" data-src-title="OceaneFM">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/oceanefm.png"">
                                    </button>
                                    <button class="btn-radioplay" data-src="http://radio.lagoon.nc/nrj" data-src-title="NRJ">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/nrj.png">
                                    </button>
                                    <button class="btn-radioplay" data-src="http://radio.lagoon.nc/rrb?time=13026" data-src-title="RRB">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/rrb.png">
                                    </button>
                                    <button class="btn-radioplay" data-src="http://radios.la1ere.fr/nouvellecaledonie" data-src-title="NC1ere">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/nc1ere.png">
                                    </button>
                                    
                                    <br><hr><h3 class="text-white">Divers</h3>

                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/1000hitscountry?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="1000 hits country">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/1000hitscountry.png">
                                    </button>
                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/1950sradio?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="1950's radio">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/1950sradio.jpg">
                                    </button>
                                    <button class="btn-radioplay" data-src="http://www.beatlesradio.com:8000/stream/1/;?d=" data-src-title="beatles radio">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/beatlesradio.png">
                                    </button>
                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/elium-rock?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="elium rock">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/elium-rock.png">
                                    </button>
                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/abc-jazz?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="ABC Jazz">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/abc-jazz.jpeg">
                                    </button>
                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/2rock?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="2 ROCK">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/2ROCK.png">
                                    </button>
                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/made-in-zouk?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="Made In Zouk">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/madeinzouk.png">
                                    </button>
                                    <button class="btn-radioplay" data-src="http://streams.calmradio.com/api/307/128/stream/;?d=" data-src-title="Calm Radio">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/CalmRadio.jpg">
                                    </button>
                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/radio-wassoulou-internationale?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="Radio Wassoulou Internationale">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/radiowassoulou.jpg">
                                    </button>
                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/radiosky-music?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="radiosky-music">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/radioskymusic.jpg">
                                    </button>
                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/fd-lounge-radio?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="FD LOUNGE RADIO">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/fd-loung-radio.jpg">
                                    </button>
                                    <button class="btn-radioplay" data-src="http://streams.calmradio.com/api/51/128/stream/;?d=" data-src-title="Classical Piano">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/classicalpiano.jpg">
                                    </button>

                                    <br><hr><h3 class="text-white">Reggae</h3>

                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/ledjamradio.mp3?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="Ledjam Radio">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/ledjam.jpg">
                                    </button>
                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/reggaenation?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="Reggae Nation">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/reggaenation.png">
                                    </button>
                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/rootsyard?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="Roots Yard">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/rootsyard.png">
                                    </button>
                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/surfroots?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="Surf Roots">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/surfroots.png">
                                    </button>
                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/one-hundread-locks?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="One Hundread Locks">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/onehundreadlocks.jpg">
                                    </button>
                                    <button class="btn-radioplay" data-src="https://listen.radionomy.com/kyak106?d=YXBwTmFtZT13ZWJzaXRlJmFkPXJhZGlvbm93ZWI=" data-src-title="kyak106">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/kyak106.jpg">
                                    </button>
                                    <!-- <br>
                                    <button class="btn-radioplay" data-src="http://185.52.127.155/fr/30401/mp3_128.mp3" data-src-title="Rire & chanson">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/rireetchanson.jpeg">
                                    </button>
                                    <button class="btn-radioplay" data-src="http://france1.coollabel-productions.com:8142/;" data-src-title="Reggae Mix Station">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/ReggaeMixStation.png">
                                    </button>
                                    <button class="btn-radioplay" data-src="http://str45.streamakaci.com:8014/;" data-src-title="Radio Flemme">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/flemme.png">
                                    </button> -->
                                </div>                                         

                            </div>

                    </div>
                </div>
               
            </div>

        </div>
    </div>
</div>



<script>
jQuery(document).ready(function() {
    initRadioplayer();
});

</script>


