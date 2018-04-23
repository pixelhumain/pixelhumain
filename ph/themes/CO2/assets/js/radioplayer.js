
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
        $(".radio-name").html("<span class='text-white'>vous écoutez</span> " + stream.title);

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
    console.log("initRadio", stream);
    $("#jquery_jplayer_1").jPlayer({
        ready: function (event) {
            console.log("initRadio", "ready");
            ready = true;
            $(this).jPlayer("setMedia", stream);
            $("#jquery_jplayer_1").jPlayer("play");
            $(".fa-micro").removeClass("fa-microphone-slash").addClass("fa-microphone");
            $(".jp-title").html(stream.title);
        },
        pause: function() {
            $(this).jPlayer("clearMedia");
        },
        error: function(event) {
            console.log("initRadio", "error");
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