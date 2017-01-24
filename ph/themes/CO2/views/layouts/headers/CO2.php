<style>
.pastille-subdomain {
    font-size: 20px;
    float: left;
    margin-left: 58.3%;
    margin-top: -37px;
    cursor:pointer;
}
</style>

<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="100" class="inline margin-bottom-15"><br>
<small class="text-dark homestead pastille-subdomain hidden"><?php echo @$subdomainName; ?> <i class="fa fa-<?php echo @$icon; ?>"></i></small>

<small data-target="#modalMainMenu" data-toggle="modal" class="letter-red font-blackoutT pastille-subdomain inline"><i class="fa fa-<?php echo @$icon; ?>"></i> en construction</small>

<br>
<small class="text-dark pastille block" style="font-size:20px; margin-top:-30px;"><?php echo $mainTitle; ?></small><br>
