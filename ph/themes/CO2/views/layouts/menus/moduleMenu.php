<?php //if($subdomainName != "web" && $subdomainName != "referencement") 
        foreach ($params["pages"] as $key => $value) {
            if(@$value["inMenu"]==true && @$value["open"]==true){ ?>
                <a  class="lbh text-dark link-submenu-header margin-right-15 
                            <?php if("#".$subdomain == $key) echo "active"; ?>" 
                    href="<?php echo $key; ?>">
                    <i class="fa fa-<?php echo $value["icon"]; ?>"></i>
                    <span class=""> <?php echo Yii::t("common",$value["subdomainName"]); ?></span>
                </a>    
<?php       }
        }  
?>

<?php if(Yii::app()->params["CO2DomainName"] != "kgougle" && Yii::app()->params["CO2DomainName"] != "BCH"){ ?>
<a href="#default.view.page.links" class="lbhp text-dark link-submenu-header margin-right-15" >
    <i class="fa fa-life-ring"></i> <span class=""><?php echo Yii::t("common","Help") ?></span>
</a>

<a href="https://www.helloasso.com/associations/open-atlas/collectes/communecter" class="text-dark link-submenu-header margin-right-15" target="_blank">
    <i class="fa fa-heart"></i> <span class=""><?php echo Yii::t("loader", "Make a donation") ?></span>
</a>

<!-- <a href="default/view/page/kickerFunding/dir/docs|panels" class="lbhp text-dark link-submenu-header margin-right-15" >
    <i class="fa fa-heart"></i> <span class=""><?php //echo Yii::t("common", "Contribute") ?></span>
</a> -->
<?php } ?>