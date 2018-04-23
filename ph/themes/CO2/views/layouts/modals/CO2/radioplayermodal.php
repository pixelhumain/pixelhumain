
<?php HtmlHelper::registerCssAndScriptsFiles( array('/css/radioplayer.css', ) , Yii::app()->theme->baseUrl. '/assets'); ?>

<div id="radio-ph-tools">
    <iframe id="radio-ph" src=""></iframe>
    <button class="btn btn-link" id="btn-close-radio"><i class="fa fa-times"></i></button>
    <button class="btn btn-link" id="btn-reload-radio"><i class="fa fa-refresh"></i></button>
</div>
                          
<style>
    #radio-ph-tools{
        position: fixed;
        bottom: 0px;
        right: 160px;
        height: 60px;
        border: none;
        width: 310px;
        background-color: #171616;
        padding: 10px;
        border-radius: 5px 5px 0 0;
    }
    #radio-ph{
        height: 44px;
        width: 200px;
        border: none;
        float:right;
    }
    #btn-open-radio{
        position: fixed;
        bottom: -1px;
        right:70px;
    }
    #btn-reload-radio, #btn-close-radio{
        margin-top: 5px;
        background-color: black;
        color: white;
        border: 2px solid #55a1b6;
        border-radius: 35px;
        width: 35px;
        font-size: 13px;
        padding: 6px;
        margin-left: 5px;
    }
</style>


<script>

var ready = true;
jQuery(document).ready(function() {
    // initRadioplayer();
    $("#radio-ph-tools").hide();
    $("#radio-ph").attr("src", "");
    $("#btn-open-radio, #btn-reload-radio").click(function(){
       loadRadio();
    });
    $("#btn-close-radio").click(function(){
       $("#radio-ph-tools").hide();
       $("#radio-ph").attr("src", ""); 
    });
});

function loadRadio(){
     console.log("TEST RADIO : send data");
     toastr.info("searching radio signal");
     ready = true;
        $.ajax({ 
            type: "GET",
            url: "http://34.253.15.201:8000/radio-pixel-humain.ogg",
            dataType: "jsonp",
            success:
                function(data) {
                },
            statusCode:{
                    404: function(){
                     console.log("TEST RADIO : 404");
                     toastr.error("no radio signal found");
                     $("#radio-ph-tools").hide();
                     $("#radio-ph").attr("src", "");
                     ready = false;
                }
            },
            error:function(xhr, status, error){
                console.log("TEST RADIO : ERROR", status, error);
                //toastr.error("no radio signal found");
                $("#radio-ph-tools").hide();
                $("#radio-ph").attr("src", ""); 
                ready = false;
            },
        });

        setTimeout(function(){ 
            if(ready == true)
                startRadio();
        }, 3000);
}

function startRadio(){
    console.log("TEST RADIO : success 1");
    toastr.success("radio signal found !");
    $("#radio-ph-tools").show(200);                
    $("#radio-ph").attr("src", "http://34.253.15.201:8000/radio-pixel-humain.ogg?_=1");     
                   
}
</script>


