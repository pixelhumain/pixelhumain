
<?php
    $communexion = CO2::getCommunexionCookies();  
    if($communexion["state"] == false)
    {
?>
        <?php 
        if($communexion["state"] == false && @$type != "cities" ) { 
            $tooltip = Yii::t("common", "Connect to your city"); 
            //var_dump($communexion["currentName"]);
            if(!empty($communexion["currentName"])){ 
                $tooltip = "Communecter avec ".$communexion["currentName"]; 
            }
        ?>
            <button class="pull-left btn btn-link bg-white text-red tooltips item-globalscope-checker start-new-communexion"
                    data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip ; ?>"
                    data-scope-value='<?php echo @$communexion["currentValue"]; ?>'
                    data-scope-name='<?php echo @$communexion["currentName"]; ?>'
                    data-scope-level='<?php echo @$communexion["levelMinCommunexion"]; ?>'
                    data-scope-type='<?php echo @$communexion["currentLevel"]; ?>'
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
                if(!empty($communexion["values"]["cities"])){
                    foreach(@$communexion["values"]["cities"] as $city){
                        $tips.=$city." / ";
                    }
                }

            if(@$communexion["levelMinCommunexion"]=="inseeCommunexion"){ ?> 
            <button data-toggle='dropdown' data-target='dropdown-multi-scope'
                class='btn btn-link text-red item-globalscope-checker homestead tooltips
                      <?php if(@$communexion["currentName"]!=@$communexion["values"]["cityCp"]) echo "inactive"; ?>' 
                data-scope-value='<?php echo @$communexion["values"]["cityCp"]; ?>'
                data-scope-name='<?php echo @$communexion["values"]["cityCp"]; ?>'
                data-scope-type='cp'
                data-scope-level='<?php echo @$communexion["levelMinCommunexion"]; ?>'
                data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $tips ?>">
                <i class='fa fa-angle-right'></i>  <?php echo @$communexion["values"]["cityCp"]; ?>
            </button> 
            <button data-toggle='dropdown' data-target='dropdown-multi-scope'
                class='btn btn-link text-red item-globalscope-checker homestead
                      <?php if(@$communexion["currentName"]!=@$communexion["values"]["cityName"]) echo "inactive"; ?>'
                data-scope-value='<?php echo @$communexion["values"]["cityKey"]; ?>'
                data-scope-name='<?php echo @$communexion["values"]["cityName"]; ?>'
                data-scope-type='city'
                data-scope-level='<?php echo @$communexion["levelMinCommunexion"]; ?>'>
                <i class='fa fa-angle-right'></i>  <?php echo @$communexion["values"]["cityName"]; ?>
            </button> 
            <?php }else{ ?>
            <button data-toggle='dropdown' data-target='dropdown-multi-scope'
                class='btn btn-link text-red item-globalscope-checker homestead tooltips
                      <?php if(@$communexion["currentName"]!=@$communexion["values"]["inseeName"]) echo "inactive"; ?>'
                data-scope-value='<?php echo @$communexion["values"]["cityKey"]; ?>'
                data-scope-name='<?php echo @$communexion["values"]["inseeName"]; ?>'
                data-scope-type='city'
                data-scope-level='<?php echo @$communexion["levelMinCommunexion"]; ?>'
                data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $tips ?>">
                <i class='fa fa-angle-right'></i>  <?php echo @$communexion["values"]["inseeName"]." (".Yii::t("common","all city").")"; ?>
            </button> 
           <button data-toggle='dropdown' data-target='dropdown-multi-scope'
                class='btn btn-link text-red item-globalscope-checker homestead
                      <?php if(@$communexion["currentName"]!=@$communexion["values"]["cityName"]) echo "inactive"; ?>' 
                data-scope-value='<?php echo @$communexion["values"]["cityKey"]; ?>'
                data-scope-name='<?php echo @$communexion["values"]["cityName"]; ?>'
                data-scope-type='cp'
                data-scope-level='<?php echo @$communexion["levelMinCommunexion"]; ?>'>
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
console.log("communexion bread",communexion);
jQuery(document).ready(function() {
    loadMultiScopes();
    if(typeof communexion.currentName != "undefined" && communexion.currentName!=""){
        $.cookie('communexionType', communexion.currentLevel, { expires: 365, path: "/" });
        $.cookie('communexionValue', communexion.currentValue, { expires: 365, path: "/" });
        $.cookie('communexionName', communexion.currentName, { expires: 365, path: "/" });
        $.cookie('communexionLevel', communexion.levelMinCommunexion, { expires: 365, path: "/" });
        //$.cookie('communexionActivated', communexion.communexionActivated, { expires: 365, path: "/" });
    }   
    if($.cookie('communexionActivated') == "true"){
        console.log("communexionActivated ok", $.cookie('communexionValue'));
        activateGlobalCommunexion(true);
        //setGlobalScope($.cookie('communexionValue'), $.cookie('communexionName'), $.cookie('communexionType'), $.cookie('communexionLevel'));
        //bindCommunexionScopeEvents();
    }else{
        activateGlobalCommunexion(false);
        //showTagsScopesMin();
    }
    $(".tooltips").tooltip();
});

</script>