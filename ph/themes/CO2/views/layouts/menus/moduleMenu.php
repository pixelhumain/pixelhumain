<?php //if($subdomainName != "web" && $subdomainName != "referencement") 
        foreach ($params["pages"] as $key => $value) {
            if(@$value["inMenu"]==true && @$value["open"]==true){ ?>
                <a  class="lbh text-red link-submenu-header margin-right-25 
                            <?php if("#".$subdomain == $key) echo "active"; ?>" 
                    href="<?php echo $key; ?>">
                    <i class="fa fa-<?php echo $value["icon"]; ?>"></i>
                    <span class=""> <?php echo $value["subdomainName"]; ?></span>
                </a>    
<?php       }
        }  
?>

<?php if(Yii::app()->params["CO2DomainName"] != "kgougle" && Yii::app()->params["CO2DomainName"] != "BCH"){ ?>
    <a href="#default.view.page.links" class="lbhp text-red link-submenu-header margin-right-25" >
        <i class="fa fa-life-ring"></i> Aide
    </a>
    <a href="default/view/page/kickerFunding/dir/docs|panels" class="lbhp text-red link-submenu-header margin-right-25" >
        <i class="fa fa-heart"></i> Contribuer
    </a>
<?php } ?>