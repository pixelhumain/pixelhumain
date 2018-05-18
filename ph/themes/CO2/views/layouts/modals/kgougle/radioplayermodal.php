
<?php HtmlHelper::registerCssAndScriptsFiles( array('/css/radioplayer.css', ) , Yii::app()->theme->baseUrl. '/assets'); ?>


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
                                    <h3 class="radio-name letter-green" aria-label="title"></h3>
                                </div>


                                <div class="col-md-12 col-sm-12 col-xs-12 text-center btn-radio-cntr" style="">
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
                                    <button class="btn-radioplay" data-src="http://radio.lagoon.nc/rrb?time=13026" data-src-title="RRB">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/rrb.png">
                                    </button>
                                    <button class="btn-radioplay" data-src="http://radios.la1ere.fr/nouvellecaledonie" data-src-title="NC1ere">
                                        <img class="img-circle" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/nc1ere.png">
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


