<style>
    .pastille-subdomain {
        font-size: 19px;
        position: relative;
        margin-left: 59.3%;
        margin-top: -26px;
        cursor: pointer;
        margin-bottom: -10px;

    }
    #main-scope-name{
        font-size:40px;
    }

    #btn-my-co{
        border-radius: 50px;
        margin-top: 21px;
        margin-left: 5px;
        border: 1px solid #e6344d !important;
        padding: 7px 9px;
    }

    header .btn-decommunecter{
        border-radius: 50px;
        background-color: white;
        padding: 0px 0px 0px 0px;
        height: 75px;
        width: 75px;
        margin-bottom: 10px;
        box-shadow: 0px 0px 3px -1px grey;
    }

    .moduleTitle{
        /*font-size: 15px;*/
        margin-bottom: 10px;
        /*text-transform: uppercase;*/

    }


    @media (max-width: 768px) {
        .link-submenu-header span{
            display: none;
        }
    }

</style>
<h1 class="text-red homestead margin-bottom-15">
    <span id="main-scope-namea">
    <span class="menu-btn-back-category">
    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGOS/<?php echo Yii::app()->params["CO2DomainName"]; ?>/logo.png"
         height="60" class="inline">
    </span>
    </span>
</h1>

<span class="pastille-subdomain font-blackoutT text-red"><?php echo @$subdomainName; ?></span>


<div class="text-dark moduleTitle font-montserrat">
    <i class="fa fa-<?php echo @$icon; ?>"></i>
    <?php echo @$mainTitle; ?>     
</div>

