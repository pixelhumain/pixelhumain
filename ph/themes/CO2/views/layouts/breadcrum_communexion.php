
<?php
   // $communexion = CO2::getCommunexionCookies();
?>

<script type="text/javascript">

//globalCommunexion="<?php //echo $communexion["state"] ?>";
//communexion=<?php //echo json_encode($communexion) ?>;
//var communexion=$.cookie('communexion');
console.log("communexion bread",communexion);
jQuery(document).ready(function() {
    loadMultiScopes();
    /*if(typeof communexion.currentName != "undefined" && communexion.currentName!=""){
        $.cookie('communexionType', communexion.currentLevel, { expires: 365, path: "/" });
        $.cookie('communexionValue', communexion.currentValue, { expires: 365, path: "/" });
        $.cookie('communexionName', communexion.currentName, { expires: 365, path: "/" });
        $.cookie('communexionLevel', communexion.levelMinCommunexion, { expires: 365, path: "/" });
        //$.cookie('communexionActivated', communexion.communexionActivated, { expires: 365, path: "/" });
    }*/
    mylog.log("communexionActivated ok", communexion, communexion.state);
    if(communexion.state){
        mylog.log("communexionActivated ok", communexion);
        activateGlobalCommunexion(true);
        //setGlobalScope($.cookie('communexionValue'), $.cookie('communexionName'), $.cookie('communexionType'), $.cookie('communexionLevel'));
        //bindCommunexionScopeEvents();
    }else{
        activateGlobalCommunexion(false,true);
        //showTagsScopesMin();
    }
    $(".tooltips").tooltip();
});


</script>
