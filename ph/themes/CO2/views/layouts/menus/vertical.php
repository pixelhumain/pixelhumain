<style type="text/css">
    #territorial-menu.vertical{
        position: fixed;
        top:  65px;
        left:0px;
        width: 65px;
    }
</style>
<div id="territorial-menu" class="">
    <button class="btn visible-xs pull-left menu-btn-scope-filter text-red elipsis"
        data-type="<?php echo @$type; ?>">
        <i class="fa fa-map-marker"></i> <span class="header-label-scope"><?php echo Yii::t("common","where ?") ?></span>
    </button>
    <?php
        foreach ($params["pages"] as $key => $value) {
            if(@$value["inMenu"]==true && @$value["open"]==true){ ?>
                <a href="javascript:;" data-hash="<?php echo $key; ?>" 
                class="<?php echo $key; ?>ModBtn lbh-menu-app btn btn-link pull-left btn-menu-to-app hidden-xs hidden-top link-submenu-header <?php if(@$subdomainName==$value["subdomainName"]) echo 'active'; ?>">
                        
                <i class="fa fa-<?php echo $value["icon"]; ?>"></i>
                <!--<span class="<?php echo str_replace("#","",$key); ?>ModSpan"><?php echo Yii::t("common", @$value["subdomainName"]); ?></span>
                <span class="<?php echo @$value["notif"]; ?> topbar-badge badge animated bounceIn badge-warning"></span>-->
            </a>  
        <?php   }
        } ?>
</div>