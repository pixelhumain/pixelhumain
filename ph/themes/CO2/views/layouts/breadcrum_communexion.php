<?php
    $communexion = CO2::getCommunexionCookies();  
    if($communexion["state"] == false){
?>

<?php if($communexion["state"] == false && @$type != "cities"){ ?>
<button class="pull-left btn btn-link bg-white text-red tooltips item-globalscope-checker start-new-communexion"
        data-toggle="tooltip" data-placement="top" title="Communecter avec <?php echo @$communexion["currentName"]; ?>" 
        data-scope-value='<?php echo @$communexion["values"]["cityKey"]; ?>'
        data-scope-name='<?php echo @$communexion["values"]["cityName"]; ?>'
        data-scope-type='city'
        id="btn-my-co">
        <i class="fa fa-university"></i>
</button>
<?php } ?>
<?php if(@$explain && !empty($explain)){ ?>
    </br><i class="fa fa-info-circle"></i> 
    <span id='msg_live_type'><?php echo $explain ?></span>
<?php } ?>



    <?php if($type != "cities"){ ?>            
        <h5 class="pull-left letter-red" style="margin-bottom: -8px;margin-top: 14px;">
            <button class="btn btn-default main-btn-scopes text-white tooltips margin-bottom-5 margin-left-10 margin-right-10" 
                data-target="#modalScopes" data-toggle="modal"
                data-toggle="tooltip" data-placement="top" 
                                    title="Sélectionner des lieux de recherche">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/cible3.png" height=25>
            </button> 
            recherche ciblée <i class="fa fa-angle-right"></i> 
        </h5>
     
        <div class="scope-min-header list_tags_scopes hidden-xs text-left ellipsis">
        </div>
    <?php } ?> 

<?php }else{ ?>
    <div class="breadcrum-communexion hidden-xs col-md-12">
        <button class="btn btn-link text-red btn-decommunecter tooltips"
                data-toggle="tooltip" data-placement="top" 
                title="Quitter la communexion">
            <i class="fa fa-times"></i>
        </button>

        <i class="fa fa-university fa-2x text-red"></i> 
        <div class="getFormLive" style="display:inline-block;">
        <button data-toggle='dropdown' data-target='dropdown-multi-scope'
            class='btn btn-link text-red item-globalscope-checker homestead 
                  <?php if(@$communexion["currentName"]!=@$communexion["values"]["regionName"]) echo "inactive"; ?>' 
            data-scope-value='<?php echo @$communexion["values"]["regionName"]; ?>'
            data-scope-name='<?php echo @$communexion["values"]["regionName"]; ?>'
            data-scope-type='region'>
            <i class='fa fa-angle-right'></i>  <?php echo @$communexion["values"]["regionName"]; ?>
        </button> 
        <button data-toggle='dropdown' data-target='dropdown-multi-scope'
            class='btn btn-link text-red item-globalscope-checker homestead
                  <?php if(@$communexion["currentName"]!=@$communexion["values"]["depName"]) echo "inactive"; ?>' 
            data-scope-value='<?php echo @$communexion["values"]["depName"]; ?>'
            data-scope-name='<?php echo @$communexion["values"]["depName"]; ?>'
            data-scope-type='dep'>
            <i class='fa fa-angle-right'></i>  <?php echo @$communexion["values"]["depName"]; ?>
        </button> 
        <?php 
            $tips="";
            foreach(@$communexion["values"]["cities"] as $city){
                $tips.=$city." / ";
            } ?>
        <?php if($communexion["currentLevel"]=="inseeCommunexion"){ ?> 
        <button data-toggle='dropdown' data-target='dropdown-multi-scope'
            class='btn btn-link text-red item-globalscope-checker homestead tooltips
                  <?php if(@$communexion["currentName"]!=@$communexion["values"]["cityCp"]) echo "inactive"; ?>' 
            data-scope-value='<?php echo @$communexion["values"]["cityCp"]; ?>'
            data-scope-name='<?php echo @$communexion["values"]["cityCp"]; ?>'
            data-scope-type='cp'
            data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $tip ?>">
            <i class='fa fa-angle-right'></i>  <?php echo @$communexion["values"]["cityCp"]; ?>
        </button> 
        <button data-toggle='dropdown' data-target='dropdown-multi-scope'
            class='btn btn-link text-red item-globalscope-checker homestead
                  <?php if(@$communexion["currentName"]!=@$communexion["values"]["cityName"]) echo "inactive"; ?>'
            data-scope-value='<?php echo @$communexion["values"]["cityKey"]; ?>'
            data-scope-name='<?php echo @$communexion["values"]["cityName"]; ?>'
            data-scope-type='city'>
            <i class='fa fa-angle-right'></i>  <?php echo @$communexion["values"]["cityName"]; ?>
        </button> 
        <?php }else{ ?>
        <button data-toggle='dropdown' data-target='dropdown-multi-scope'
            class='btn btn-link text-red item-globalscope-checker homestead tooltips
                  <?php if(@$communexion["currentName"]!=@$communexion["values"]["inseeName"]) echo "inactive"; ?>'
            data-scope-value='<?php echo @$communexion["values"]["cityKey"]; ?>'
            data-scope-name='<?php echo @$communexion["values"]["inseeName"]." (".Yii::t("common","all city").")"; ?>'
            data-scope-type='city'
            data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $tips ?>">
            <i class='fa fa-angle-right'></i>  <?php echo @$communexion["values"]["inseeName"]." (".Yii::t("common","all city").")"; ?>
        </button> 
       <button data-toggle='dropdown' data-target='dropdown-multi-scope'
            class='btn btn-link text-red item-globalscope-checker homestead
                  <?php if(@$communexion["currentName"]!=@$communexion["values"]["cityCp"]) echo "inactive"; ?>' 
            data-scope-value='<?php echo @$communexion["values"]["cityCp"]; ?>'
            data-scope-name='<?php echo @$communexion["values"]["cityName"]; ?>'
            data-scope-type='cp'>
            <i class='fa fa-angle-right'></i>  <?php echo @$communexion["values"]["cityName"]; ?>
        </button> 
        <?php } ?>

       </div>
       <!--  <span class="pull-right">
            <span class="font-blackoutM text-red"> <?php //echo $subdomainName; ?></span>
            <i class="fa fa-<?php //echo $icon; ?> fa-2x text-red"></i> 
        </span> -->
    </div>
<?php } ?>
<script type="text/javascript">

var globalCommunexion="<?php echo $communexion["state"] ?>";
var communexion=<?php echo json_encode($communexion) ?>;
jQuery(document).ready(function() {
    bindCommunexionScopeEvents();
    loadMultiScopes();
});

function bindCommunexionScopeEvents(){
    $(".btn-decommunecter").click(function(){
        activateGlobalCommunexion(false); 
    });
    $(".item-globalscope-checker").off().click(function(){  
            $(".item-globalscope-checker").addClass("inactive");
            $(this).removeClass("inactive");

            mylog.log("globalscope-checker",  $(this).data("scope-name"), $(this).data("scope-type"));
            setGlobalScope( $(this).data("scope-value"), $(this).data("scope-name"), $(this).data("scope-type"),
                             $(this).data("insee-communexion"), $(this).data("name-communexion"), $(this).data("cp-communexion"), 
                             $(this).data("region-communexion"), $(this).data("country-communexion"), actionOnSetGlobalScope ) ;
    });

    $(".start-new-communexion").click(function(){  
        alert();
        activateGlobalCommunexion(true); 
    });
}
function activateGlobalCommunexion(active){  mylog.log("activateGlobalCommunexion", active);
    $.cookie('communexionActivated', active, { expires: 365, path: location.pathname });
    globalCommunexion=active;
    if(active){
        if(actionOnSetGlobalScope=="save")
            $("#scopeListContainer").html(scopeHtml);
        $("#container-scope-filter").html(getBreadcrumCommunexion());
    }
    else
        showTagsScopesMin();
    bindCommunexionScopeEvents();
    rebuildSearchScopeInput();
    $('.tooltips').tooltip();
    /*if(typeof actionOnSetGlobalScope == "undefined" || actionOnSetGlobalScope != "save"){
        alert("nononono");
        if(location.hash == "#search.type.cities")
            url.loadByHash("#search");
        else
            url.loadByHash(location.hash);
    }*/
    /*if(location.hash.indexOf("#city.detail")==0)
        loadByHash("#default.live");*/
}
function getBreadcrumCommunexion(){
    tips="";
    $.each(communexion["values"]["cities"],function(e,v){
        tips+=v+" / ";
    });
    htmlCommunexion='<div class="breadcrum-communexion hidden-xs col-md-12">';
    if(actionOnSetGlobalScope=="filter"){
        htmlCommunexion+='<button class="btn btn-link text-red btn-decommunecter tooltips" data-toggle="tooltip" data-placement="top" title="Quitter la communexion">'+
            '<i class="fa fa-times"></i>'+
        '</button>';
    }else{
        htmlCommunexion+='<a class="btn btn-link text-red btn-decommunecter tooltips" data-toggle="tooltip" data-placement="top" title="Quitter la communexion">'+
            '<i class="fa fa-times"></i>'+
        '</a>';
    }
        htmlCommunexion+='<i class="fa fa-university fa-2x text-red"></i>'+ 
        '<div class="getFormLive" style="display:inline-block;">'+
            '<button data-toggle="dropdown" data-target="dropdown-multi-scope" '+
                'class="btn btn-link text-red item-globalscope-checker homestead '; 
    if(communexion.currentName!=communexion.values.regionName)
                    htmlCommunexion+="inactive";
    htmlCommunexion+= 'data-scope-value="'+communexion.values.regionName+'" '+
                'data-scope-name="'+communexion.values.regionName+'" '+
                'data-scope-type="region">'+
                '<i class="fa fa-angle-right"></i>  '+communexion.values.regionName+
            '</button>'+ 
            '<button data-toggle="dropdown" data-target="dropdown-multi-scope" '+
                'class="btn btn-link text-red item-globalscope-checker homestead ';
                if(communexion.currentName!=communexion.values.depName)
                    htmlCommunexion+="inactive";
    htmlCommunexion+= 'data-scope-value="'+communexion.values.depName+'" '+
                'data-scope-name="'+communexion.values.depName+'" '+
                'data-scope-type="dep">'+
                '<i class="fa fa-angle-right"></i>  '+communexion.values.depName+
            '</button>';
    if(communexion.currentLevel=="inseeCommunexion"){
        htmlCommunexion+= '<button data-toggle="dropdown" data-target="dropdown-multi-scope" '+
                    'class="btn btn-link text-red item-globalscope-checker homestead tooltips ';
                    if(communexion.currentName!=communexion.values.cityCp)
                        htmlCommunexion+="inactive";
        htmlCommunexion+= 'data-scope-value="'+communexion.values.cityCp+'" '+
                    'data-scope-name="'+communexion.values.cityCp+'" '+
                    'data-scope-type="cp" '+
                    'data-toggle="tooltip" data-placement="bottom" data-original-title="'+tips+'">'+
                    '<i class="fa fa-angle-right"></i>  '+communexion.values.cityCp+
                '</button>'+
                '<button data-toggle="dropdown" data-target="dropdown-multi-scope" '+
                    'class="btn btn-link text-red item-globalscope-checker homestead ';
                    if(communexion.currentName!=communexion.values.cityName)
                        htmlCommunexion+="inactive";
        htmlCommunexion+= 'data-scope-value="'+communexion.values.cityKey+'" '+
                    'data-scope-name="'+communexion.values.cityName+'" '+
                    'data-scope-type="city">'+
                    '<i class="fa fa-angle-right"></i>  '+communexion.values.cityName+
                '</button>';
    }else{
        htmlCommunexion+= '<button data-toggle="dropdown" data-target="dropdown-multi-scope" '+
                    'class="btn btn-link text-red item-globalscope-checker homestead tooltips ';
                    if(communexion.currentName!=communexion.values.inseeName)
                        htmlCommunexion+="inactive";
        htmlCommunexion+= 'data-scope-value="'+communexion.values.cityKey+'" '+
                    'data-scope-name="'+communexion.values.inseeName+' (<?php echo Yii::t("common","all city") ?>)" '+
                    'data-scope-type="city" '+
                    'data-toggle="tooltip" data-placement="bottom" data-original-title="'+tips+'"'+'>'+
                    '<i class="fa fa-angle-right"></i>  '+communexion.values.inseeName+' (<?php echo Yii::t("common","all city") ?>)'+
                '</button>'+
                '<button data-toggle="dropdown" data-target="dropdown-multi-scope" '+
                    'class="btn btn-link text-red item-globalscope-checker homestead ';
                    if(communexion.currentName!=communexion.values.cityCp)
                        htmlCommunexion+="inactive";
        htmlCommunexion+= 'data-scope-value="'+communexion.values.cityCp+'" '+
                    'data-scope-name="'+communexion.values.cityName+'" '+
                    'data-scope-type="cp">'+
                    '<i class="fa fa-angle-right"></i>  '+communexion.values.cityName+
                '</button>';
    }
    htmlCommunexion+= '</div>'+
        '</div>';
    return htmlCommunexion;
}
</script>