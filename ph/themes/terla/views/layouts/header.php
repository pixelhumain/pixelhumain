<style>
    .pastille-subdomain {
        font-size: 20px;
        float: left;
        margin-left: 55.3%;
        margin-top: -41px;
    }
    .pastille-subdomain-icon {
        font-size: 24px;
        float: right;
        margin-right: 57%;
        margin-top: -73px;
    }
    a.link-submenu-header{
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 10px;
        padding: 6px 8px;
        font-size: 11px;
    }
    a.link-submenu-header.active, 
    a.link-submenu-header:hover, 
    a.link-submenu-header:active{  
        border-bottom: 2px solid #ea4335;
        background-color: rgba(255, 255, 255, 1);
        color:#ea4335 !important;
        text-decoration: none;
    }

    @media (max-width: 767px) {
        #main-input-group{
            margin-top:10px;
        }
    }
</style>

    <?php 
        $params = CO2::getThemeParams();
        
        if(@$type=="cities")    { 
            $lblCreate = "";
            $params["pages"]["#".$page]["mainTitle"] = "Rechercher une commune"; 
            $params["pages"]["#".$page]["placeholderMainSearch"] = "Rechercher une commune"; 
        }

        $useHeader              = $params["pages"]["#".$page]["useHeader"];
        $subdomain              = $params["pages"]["#".$page]["subdomain"];
        $subdomainName          = $params["pages"]["#".$page]["subdomainName"];
        $icon                   = $params["pages"]["#".$page]["icon"];
        $mainTitle              = $params["pages"]["#".$page]["mainTitle"];
        $placeholderMainSearch  = $params["pages"]["#".$page]["placeholderMainSearch"];


        $cssAnsScriptFilesModule = array(
        '/js/default/search.js',
        );
        HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
    ?>

    <!-- Header -->
    <header>
        <?php if(@$useHeader != false){ ?>
            <div class="container">
                <div class="headerTitle"> <?php echo $mainTitle; ?></div>
                <div class="headerImg"></div>
            </div>
        <?php } ?>
    </header>

    <?php
            $CO2DomainName = Yii::app()->params["CO2DomainName"];
            $me = isset(Yii::app()->session['userId']) ? Person::getById(Yii::app()->session['userId']) : null;
            $this->renderPartial($layoutPath.'menus/'.$CO2DomainName, 
                                                    array( "layoutPath"=>$layoutPath , 
                                                            "subdomain"=>$subdomain,
                                                            "subdomainName"=>$subdomainName,
                                                            "mainTitle"=>$mainTitle,
                                                            "placeholderMainSearch"=>$placeholderMainSearch,
                                                            "type"=>@$type,
                                                            "me" => $me) ); ?>   

    
    <div class="portfolio-modal modal fade" id="openModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 container"></div>
        <div class="col-xs-12 text-center modal-open-footer" style="margin-top:50px;margin-bottom:50px;">
            <hr>
            <a href="javascript:" style="font-size: 13px;" type="button" class="" data-dismiss="modal">
            <i class="fa fa-times"></i> Retour
            </a>
        </div>
    </div>
</div>


<script type="text/javascript" >

    var type = "<?php echo @$type ? $type : 'services'; ?>";
    var typeInit = "<?php echo @$type ? $type : 'services'; ?>";
    var myMultiTags = new Array();
    var indexStepInit = 5;

jQuery(document).ready(function() {
    $(".menu-btn-start-search").click(function(){
        
        loadingData = false;
        startSearchTerla(0, indexStepInit);

    });
});

</script>