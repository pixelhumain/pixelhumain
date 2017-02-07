<style>
    header .intro-text .name, .header .intro-text .name {
    font-size: 60px;
    letter-spacing: 4px;
    margin-bottom: -5px;
}
.name .pastille{
    letter-spacing: 0px;
}

header .intro-text .skills{
    font-size: 15px !important;
}
</style>

<!-- <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/logocagou-<?php echo $subdomainName; ?>.png" class="nc_map"><br> -->
<span class="name font-blackoutM">
    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" height="60" class="inline margin-bottom-15"><br>

    <!-- <span class="letter letter-blue font-ZILAP letter-k">K</span>
    <span class="letter letter-yellow">G</span>
    <span class="letter letter-yellow font-ZILAP letter-k">O</span>
    <span class="letter letter-yellow margin-left-5">U</span>
    <span class="letter letter-green font-blackoutT">L</span>
    <span class="letter letter-green font-blackoutT">A</span>
    <span class="letter letter-green font-blackoutT">N</span>
    <span class="letter letter-green font-blackoutT">D</span> <br> -->
    <?php if(true){ ?>
        <small class="letter letter-red pastille font-blackoutT"><?php echo $subdomainName; ?></small>
    <?php } ?>
</span>

<div class="inline-block hidden-xs margin-top-15" id="subtitle">
    <span class="skills font-montserrat "><?php echo $mainTitle; ?></span>
</div>      



 <!-- <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/coconet.png" class="nc_map"><br>
    <span class="name font-blackoutM">
        <span class="letter letter-blue">C</span>
        <span class="letter letter-blue font-ZILAP">O</span>
        <span class="letter letter-yellow">C</span>
        <span class="letter letter-yellow font-ZILAP">O</span>
        <span class="letter letter-green">N</span>
        <span class="letter letter-green">E</span>
        <span class="letter letter-green">T</span><br>
        <small class="letter letter-red pastille font-blackoutT"><?php echo $subdomain; ?></small>
    </span> -->