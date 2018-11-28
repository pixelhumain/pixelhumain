<style type="text/css">
    .footer-menu-vertical{
        z-index:200000;
    }

    .footer-menu-vertical .toolbar-bottom.bottom-left{
        bottom:10px;
        left: 1px;
    }
    .footer-menu-vertical .toolbar-bottom{
        z-index: 10000;
    }
    .footer-menu-vertical .toolbar-bottom.bottom-left #donation-btn{
        background-color: white !important;
        color:#E5344D !important;
    }
    .footer-menu-vertical .toolbar-bottom.bottom-right{
        bottom:60px;
        left: 1px;
        right: inherit;
    }

    .footer-menu-vertical .toolbar-bottom.bottom-right #show-bottom-add{
        background-color: white !important;
        color:#34a853 !important;
    }
    .footer-menu-vertical .toolbar-bottom.bottom-right #show-bottom-add:hover, .footer-menu-vertical .toolbar-bottom.bottom-left #donation-btn:hover{
        box-shadow: none;
    }
    .footer-menu-vertical .toolbar-bottom.bottom-right #show-bottom-add i{
        font-size: 28px;
    }
    .footer-menu-vertical .toolbar-bottom.bottom-right #show-bottom-add:hover i{
        font-size: 30px;
    }
    .footer-menu-vertical .toolbar-bottom.bottom-left #donation-btn:hover i{
        font-size: 25px;
    }
    .footer-menu-vertical .toolbar-bottom-adds{
        bottom: 68px;
        left: 53px;
    }
    .footer-menu-vertical .toolbar-bottom-adds a.addBtnFoot{
        margin-bottom: 0px !important;
        border-radius: 0px;
    }

    .footer-menu-vertical .toolbar-bottom-adds a.addBtnFoot{
        margin-bottom: 0px !important;
        border-radius: 0px;
    }
    .footer-menu-vertical .toolbar-bottom-adds a:first-child{
        border-radius: 0px 10px 0px 0px;
    }

    .footer-menu-vertical .toolbar-bottom-adds a:last-child{
        border-radius: 0px 0px 10px 0px;
    }
    .footer-menu-vertical .toolbar-bottom-adds a:hover{
        box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.3);
        font-size: 16px;
    }
</style>
<?php 
    $menuApp=(@$themeParams["appRendering"]) ? $themeParams["appRendering"] : "horizontal"; 
    $addElement=array(
        Person::COLLECTION => array(
            "label"=>Yii::t("common","Invite someone"),
            "icon"=>Person::ICON,
            "addClass"=> "bg-yellow lbhp",
            "href"=>"#element.invite"
        ),
        Organization::COLLECTION => array(
            "label"=>Yii::t("common","Organizations"),
            "icon"=>Organization::ICON,
            "formType"=>"organization",
            "addClass"=> "bg-green",
            "href"=>"javascript:;"
        ),
        Project::COLLECTION => array(
            "label"=>Yii::t("common","Project"),
            "icon"=>Project::ICON,
            "formType"=>"project",
            "addClass"=> "addBtnFoot_orga addBtnFoot_project bg-purple",
            "href"=>"javascript:;"
        ),
        Event::COLLECTION => array(
            "label"=>Yii::t("common","Event"),
            "icon"=>Event::ICON,
            "formType"=>"event",
            "addClass"=> "addBtnAll bg-orange",
            "href"=>"javascript:;"
        ),
        Classified::COLLECTION => array(
            "label"=>Yii::t("common","Classified"),
            "icon"=>Classified::ICON,
            "formType"=>"classifieds",
            "addClass"=> "addBtnFoot_orga addBtnFoot_project bg-azure",
            "href"=>"javascript:;"
        ),
        Classified::TYPE_RESSOURCES => array(
            "label"=>Yii::t("common","Ressource"),
            "icon"=>Classified::ICON_RESSOURCES,
            "formType"=>"ressources",
            "addClass"=> "addBtnAll bg-vine",
            "href"=>"javascript:;"
        ),
        Classified::TYPE_JOBS => array(
            "label"=>Yii::t("common","Jobs"),
            "icon"=>Classified::ICON_JOBS,
            "formType"=>"jobs",
            "addClass"=> "hideBtnFoot_person addBtnFoot_orga addBtnFoot_project bg-yellow-k",
            "href"=>"javascript:;"
        ),
        Poi::COLLECTION => array(
            "label"=>Yii::t("common","Point of interest"),
            "icon"=>Poi::ICON,
            "formType"=>"poi",
            "addClass"=> "addBtnAll bg-green-k",
            "href"=>"javascript:;"
        )
    );
    if( Yii::app()->params['rocketchatMultiEnabled'] ){
        $addElement["chat"] = array(
            "label"=>Yii::t("common","Chat"),
            "icon"=>"fa-comments",
            "formType"=>"chat",
            "addClass"=> "addBtnFootChat addBtnFoot_orga addBtnFoot_project addBtnFoot_event bg-red-k",
            "href"=>"javascript:;"
        );
    }
    //Filtering button add element if custom
    if(@$themeParams["add"]){
        foreach($addElement as $key=>$v)
            if(!@$themeParams["add"][$key]) unset($addElement[$key]);
    }
?>
<div class="footer-menu-<?php echo $menuApp ?>">
    <div class="toolbar-bottom bottom-left font-montserrat">
        <a href="https://www.helloasso.com/associations/open-atlas/collectes/communecter/don" target="_blank" id="donation-btn" class="btn btn-default donation-btn btn-menu-vertical">
            <i class="fa fa-heart"></i> 
            <span class="tooltips-menu-btn"><?php echo Yii::t("common","Be aCOeur") ?></span>
        </a>
    </div>


    <button class="btn btn-link btn-sm letter-red tooltips font-montserrat no-padding hidden" 
        id="btn-open-radio" 
        data-placement="top" title="Radio-Pixel-Humain is on air, listen now !">
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/radio-ico-close.png" height="60">
    </button>

    <div class="toolbar-bottom bottom-right font-montserrat">

        <?php if(@Yii::app()->session["userId"]) { ?>
        <button class="btn btn-default bg-green-k text-white no-padding btn-menu-vertical" id="show-bottom-add">
            <i class="fa fa-plus-circle"></i>
            <span class="tooltips-menu-btn"><?php echo Yii::t("common","Add something") ?></span>
        </button>
        <?php } ?>

    </div>


    <div class="toolbar-bottom-adds toolbar-bottom-fullwidth font-montserrat hidden">
        <?php foreach($addElement as $key => $v){ ?>
            <a href="<?php echo $v["href"] ?>" 
                <?php if(@$v["formType"]) echo 'data-form-type="'.$v["formType"].'"' ?> 
                class="addBtnFoot btn-open-form btn btn-default <?php echo $v["addClass"] ?> margin-bottom-10"> 
                <i class="fa <?php echo $v["icon"] ?>"></i> 
                <span><?php echo $v["label"] ?></span>
            </a>
        <?php } ?>
        <!--<a href="javascript:;" data-form-type="organization" class="addBtnFoot btn-open-form btn btn-default bg-green inline-block margin-bottom-10"> 
            <i class="fa <?php echo Organization::ICON; ?>"></i> 
            <span><?php echo Yii::t("common","Organizations") ?></span>
        </a>
        <a href="javascript:;" data-form-type="project" class="addBtnFoot addBtnFoot_orga addBtnFoot_project btn-open-form btn btn-default bg-purple inline-block margin-bottom-10"> 
            <i class="fa <?php echo  Project::ICON;?>"></i> 
            <span><?php echo Yii::t("common","Project") ?></span>
        </a>
        <a href="javascript:;" data-form-type="event" class="addBtnFoot addBtnAll btn-open-form btn btn-default bg-orange margin-bottom-10"> 
            <i class="fa fa-calendar"></i> 
            <span><?php echo Yii::t("common","Event") ?></span>
        </a>
        <a href="javascript:;" data-form-type="classifieds" class="addBtnFoot addBtnFoot_orga addBtnFoot_project btn-open-form btn btn-default bg-azure margin-bottom-10"> 
            <i class="fa fa-bullhorn"></i> 
            <span><?php echo Yii::t("common","Classified") ?></span>
        </a>
        <a href="javascript:;" data-form-type="ressources" class="addBtnFoot addBtnAll btn-open-form btn btn-default bg-vine margin-bottom-10"> 
            <i class="fa fa-cubes"></i> 
            <span><?php echo Yii::t("common","Ressource") ?></span>
        </a>
        <a href="javascript:;" data-form-type="jobs" class="addBtnFoot hideBtnFoot_person addBtnFoot_orga addBtnFoot_project btn-open-form btn btn-default bg-yellow-k margin-bottom-10"> 
            <i class="fa fa-briefcase"></i> 
            <span><?php echo Yii::t("common","Jobs") ?></span>
        </a>
        <a href="javascript:;" data-form-type="poi" class="addBtnFoot addBtnAll btn-open-form btn btn-default bg-green-k margin-bottom-10"> 
            <i class="fa fa-map-marker"></i> 
            <span><?php echo Yii::t("common","Point of interest") ?></span>
        </a>
        <?php 
        if( Yii::app()->params['rocketchatMultiEnabled'] )
        {
        ?>
        <a href="javascript:;" data-form-type="chat" class="addBtnFoot addBtnFootChat addBtnFoot_orga addBtnFoot_project addBtnFoot_event btn-open-form btn btn-default bg-red-k margin-bottom-10"> 
            <i class="fa fa-comments"></i> 
            <span><?php echo Yii::t("common","Chat") ?></span>
        </a>
        <?php } ?>-->
    </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {

    $(".toolbar-bottom-adds").hide().removeClass("hidden");
    $('#show-bottom-add').off().click(function(){
        if(!$(this).hasClass("opened")){
            $(this).addClass("opened");
            $(".toolbar-bottom-apps").hide(200);
            $(".toolbar-bottom-adds").toggle(100);
            $('.toolbar-bottom-adds .btn').click(function(){
                $(".toolbar-bottom-adds").hide(200);
                $(this).removeClass("opened");
            });
        }else{
            $(".toolbar-bottom-adds").hide(200);
            $(this).removeClass("opened");
        }
    });
    $('.toolbar-bottom-adds').unbind("mouseleave").mouseleave(function(){
        console.log(".toolbar-bottom-adds mouseleave");
        $('#show-bottom-add').removeClass("opened");
        $(".toolbar-bottom-adds").hide(200);

    });
})

function addBtnSwitch(){ 
    $(".addBtnFoot").addClass("hidden");
    $(".addBtnAll").removeClass("hidden");
    

    var fname = "<?php echo Yii::t("common", "as") ?> ";
    if ( contextData != null && contextData.type && inArray( contextData.type,[ "organizations","citoyens","events","projects" ] ) )
        fname += contextData.name;
    else if(userConnected) {
        fname += userConnected.name;
    }

    $("#addFootTitle").html('<i class="fa fa-plus-circle"></i> <?php echo Yii::t("common", "Add something") ?> '+fname);

    if( (contextData != null && contextData.type == "citoyens") || contextData == null){
        $(".addBtnFoot").removeClass("hidden");
        $(".addBtnFootChat").addClass("hidden");
        $(".hideBtnFoot_person").addClass("hidden");
    }
    else if(contextData.type == "organizations" )
        $(".addBtnFoot_orga").removeClass("hidden");
    else if(contextData.type == "projects" )
        $(".addBtnFoot_project").removeClass("hidden");
    else if(contextData.type == "events" )
        $(".addBtnFoot_event").removeClass("hidden");

}

</script>