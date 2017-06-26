<style>
    .pastille-subdomain {
        font-size: 20px;
        float: left;
        margin-left: 58.3%;
        margin-top: -37px;
        cursor:pointer;
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


    @media (max-width: 768px) {
        .link-submenu-header span{
            display: none;
        }
    }

</style>
<h1 class="text-red homestead">
    <span id="main-scope-name">
    <a href="#web" class="menu-btn-back-category" data-target="#modalMainMenu" data-toggle="modal">
    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGOS/<?php echo Yii::app()->params["CO2DomainName"]; ?>/logo.png"
         height="60" class="inline margin-bottom-15">
    </a>
    <br>
    </span>
</h1>


<div class="text-dark moduleTitle" style="font-size:20px; margin-bottom:10px;">
    <i class="fa fa-<?php echo @$icon; ?>"></i>
    <?php echo @$mainTitle; ?> 
    
    
</div>

