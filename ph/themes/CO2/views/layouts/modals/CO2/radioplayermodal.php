
<?php HtmlHelper::registerCssAndScriptsFiles( array('/css/radioplayer.css', ) , Yii::app()->theme->baseUrl. '/assets'); ?>

<div class="radio-ph-tools">
    <iframe id="radio-ph" src=""></iframe><br>
    <button class="btn btn-default" id="btn-reload-radio"><i class="fa fa-refresh"></i></button>
</div>
                          
<style>
    #radio-ph{
        position: fixed;
        bottom: 0px;
        right:150px;
        height: 44px;
        border: none;
        width: 200px;
    }
    #btn-open-radio{
        position: fixed;
        bottom: -1px;
        right:70px;
    }
</style>


<script>
jQuery(document).ready(function() {
    // initRadioplayer();
    $("#radio-ph-tools").hide();
    $("#radio-ph").attr("src", "");
    $("#btn-reload-radio, #btn-open-radio").click(function(){
        $("#radio-ph").attr("src", "http://34.253.15.201:8000/radio-pixel-humain.ogg");
    });
});

</script>


