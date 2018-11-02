<div id="territorial-menu" class="col-md-12 col-sm-12 col-xs-12 margin-bottom-10">
    <button class="btn visible-xs pull-left menu-btn-scope-filter text-red elipsis"
        data-type="<?php echo @$type; ?>">
        <i class="fa fa-map-marker"></i> <span class="header-label-scope"><?php echo Yii::t("common","where ?") ?></span>
    </button>
    <?php //if(false){
        $params = CO2::getThemeParams();
        foreach ($params["pages"] as $key => $value) {
            if(@$value["inMenu"]==true && @$value["open"]==true){ ?>
                <a href="javascript:;" data-hash="<?php echo $key; ?>" 
                class="<?php echo $key; ?>ModBtn lbh-menu-app btn btn-link pull-left btn-menu-to-app hidden-xs hidden-top link-submenu-header <?php if($subdomainName==$value["subdomainName"]) echo 'active'; ?>">
                        
                <i class="fa fa-<?php echo $value["icon"]; ?>"></i>
                <span class="<?php echo str_replace("#","",$key); ?>ModSpan"><?php echo Yii::t("common", $value["subdomainName"]); ?></span>
                <span class="<?php echo @$value["notif"]; ?> topbar-badge badge animated bounceIn badge-warning"></span>
            </a>  
        <?php   }
        } ?>
        <button class="btn btn-show-filters"><?php echo Yii::t("common", "Filters") ?> <span class="topbar-badge badge animated bounceIn badge-warning bg-green"></span> <i class="fa fa-angle-down"></i></button>
</div>