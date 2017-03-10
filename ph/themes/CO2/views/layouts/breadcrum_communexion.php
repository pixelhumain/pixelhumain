<?php
        $communexion = CO2::getCommunexionCookies();  
        if($communexion["state"] == false){
    ?>

        <?php if($type != "cities"){ ?>            
            <h5 class="pull-left letter-red" style="margin-bottom: -8px;">
                    <button class="btn btn-default main-btn-scopes text-white tooltips margin-bottom-5 margin-left-25 margin-right-10" 
                        data-target="#modalScopes" data-toggle="modal"
                        data-toggle="tooltip" data-placement="top" 
                                            title="Sélectionner des lieux de recherche">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/cible3.png" height=32>
                    </button> 
                    recherche ciblée <i class="fa fa-angle-right"></i> 
            </h5>
         
            <div class="scope-min-header list_tags_scopes hidden-xs text-left">
            </div>
        <?php } ?> 

    <?php }else{ ?>
        <div class="breadcrum-communexion hidden-xs col-md-12">
            <button class="btn btn-link text-red btn-decommunecter tooltips"
                    data-toggle="tooltip" data-placement="right" 
                    title="Quitter la communexion">
                <i class="fa fa-times"></i>
            </button>

            <i class="fa fa-university fa-2x text-red"></i> 
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
            <button data-toggle='dropdown' data-target='dropdown-multi-scope'
                class='btn btn-link text-red item-globalscope-checker homestead
                      <?php if(@$communexion["currentName"]!=@$communexion["values"]["cityCp"]) echo "inactive"; ?>' 
                data-scope-value='<?php echo @$communexion["values"]["cityCp"]; ?>'
                data-scope-name='<?php echo @$communexion["values"]["cityCp"]; ?>'
                data-scope-type='cp'>
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
            <?php //echo @$communexion["currentName"]." != ".@$communexion["values"]["cityName"]; ?>
             
            <?php   //$icon = @$params["pages"]["#".$page]["icon"]; 
                    //$subdomainName = $params["pages"]["#".$page]["subdomainName"];
            ?>
           <!--  <span class="pull-right">
                <span class="font-blackoutM text-red"> <?php //echo $subdomainName; ?></span>
                <i class="fa fa-<?php //echo $icon; ?> fa-2x text-red"></i> 
            </span> -->
        </div>
    <?php } ?>