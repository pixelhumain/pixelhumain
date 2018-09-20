<div class="toolbar-bottom bottom-left font-montserrat">
    <a href="https://www.helloasso.com/associations/open-atlas/collectes/communecter/don" target="_blank" id="donation-btn" class="btn btn-default donation-btn">
        <i class="fa fa-heart"></i> 
    </a>
</div>


<button class="btn btn-link btn-sm letter-red tooltips font-montserrat no-padding hidden" 
    id="btn-open-radio" 
    data-placement="top" title="Radio-Pixel-Humain is on air, listen now !">
    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/radios/radio-ico-close.png" height="60">
</button>

<div class="toolbar-bottom bottom-right font-montserrat">

    <!--<button class="btn btn-default lbh tooltips" data-hash="#welcome"
            data-placement="top" data-original-title="Page d'accueil">
        <i class="fa fa-home" style="font-size: 19px;"></i>
    </button>
    
    <button class="btn btn-default tooltips letter-red" id="show-bottom-app">
        <i class="fa fa-th" style="font-size: 17px;"></i>
    </button>-->
    

    <?php if(@Yii::app()->session["userId"]) { ?>
    <button class="btn btn-default bg-green-k text-white no-padding" id="show-bottom-add">
        <i class="fa fa-plus-circle"></i> 
        <!-- <span class="hidden-xs"><?php echo Yii::t("common", "add") ?> </span>-->
    </button>
    <?php } ?>


    <!--<button class="btn btn-default letter-blue btn-show-map">
        <i class="fa fa-map-marker" style="font-size: 15px;"></i> 
         <span class="hidden-xs"><?php echo Yii::t("common", "map") ?></span> 
    </button>-->
    <!-- <button class="btn btn-default">
        <i class="fa fa-comments"></i> messagerie
    </button>
    <button class="btn btn-default">
        <i class="fa fa-connectdevelop"></i> contacts
    </button> -->
    <!-- <button class="btn btn-default">
        <i class="fa fa-cogs"></i> 
    </button> -->

    <!--<a class="btn btn-default tooltips lbh" href="#info.p.stats"
             data-placement="top" data-original-title="Statistiques : visualiser la fréquentation quotidienne du réseau">
        <i class="fa fa-bar-chart"></i>
    </a>
    <a class="btn btn-default tooltips lbh" href="#coBugs"
             data-placement="top" data-original-title="Déclarer un bug">
        <i class="fa fa-bug"></i>
    </a>
    <a class="btn btn-default lbhp tooltips" href="#default.view.page.index.dir.docs" 
             data-placement="top" data-original-title="Documentation : en savoir + sur Communecter !">
        <i class="fa fa-book"></i>
    </a>

    <a href="https://www.helloasso.com/associations/open-atlas/collectes/communecter/don" target="_blank"
            data-placement="top" data-original-title="Participer au financement du réseau"
            class="btn btn-default letter-pink tooltips">
            <i class="fa fa-chain" data-alt="eye-dropper"></i>
            <i class="fa fa-gift" style="font-size: 15px;"></i> <span class="hidden-xs"><?php echo Yii::t("common", "co-tribuer") ?></span>
    </a>-->
    
    <!-- <button class="btn btn-default"  id="show-bottom-quickaxe" style="width:50px;">
        <img src="<?php echo $this->module->assetsUrl."/images/thumb/run.png"?>" width=20/>
    </button> -->

    <!--<button class="btn btn-default bg-blue-k" style="width:50px;" onclick="KScrollTo('.main-container')">
        <i class="fa fa-chevron-up"></i>
    </button>-->

</div>

<!--<div class="toolbar-bottom-apps shadow2 font-montserrat hidden">

    <a class="btn btn-default lbh letter-red" href="#search">
        <i class="fa <?php echo Search::ICON; ?>"></i> 
        <span class="hidden-xs"><?php echo Yii::t("common", "Search") ?></span> 
    </a>
    <a class="btn btn-default lbh letter-red" href="#live">
        <i class="fa <?php echo News::ICON2; ?>"></i> 
        <span class="hidden-xs"><?php echo Yii::t("common", "In live") ?></span> 
    </a>
    <a class="btn btn-default lbh letter-red" href="#agenda">
        <i class="fa <?php echo Event::ICON; ?>"></i> 
        <span class="hidden-xs"><?php echo Yii::t("common", "Agenda") ?></span> 
    </a>
    <a class="btn btn-default lbh letter-red" href="#annonces">
        <i class="fa <?php echo Classified::ICON; ?>"></i> 
        <span class="hidden-xs"><?php echo Yii::t("common", "Market place") ?></span> 
    </a>
    <a class="btn btn-default lbh letter-red" href="#ressources">
        <i class="fa <?php echo Ressource::ICON; ?>"></i> 
        <span class="hidden-xs"><?php echo Yii::t("common", "Sharing") ?></span> 
    </a>

</div>-->

<!-- <div class="toolbar-bottom-quickaccess toolbar-bottom-fullwidth shadow2 font-montserrat hidden"></div> -->

<div class="toolbar-bottom-adds toolbar-bottom-fullwidth font-montserrat hidden">
    <!--<h5 class="col-xs-12"><small class="letter-green" id="addFootTitle">
        <i class="fa fa-plus-circle"></i> <?php echo Yii::t("common", "Add something") ?> : </small>
    </h5>
    <hr class="col-xs-12 margin-bottom-5 margin-top-5">-->
    <a href="#element.invite" class="addBtnFoot btn-open-form btn btn-default bg-yellow lbhp margin-bottom-10"> 
        <i class="fa fa-user"></i> 
        <span><?php echo Yii::t("common","Invite someone") ?></span>
    </a><br/>
    <a href="javascript:;" data-form-type="organization" class="addBtnFoot btn-open-form btn btn-default bg-green inline-block margin-bottom-10"> 
        <i class="fa <?php echo Organization::ICON; ?>"></i> 
        <span><?php echo Yii::t("common","Organizations") ?></span>
    </a><br/>
    <a href="javascript:;" data-form-type="project" class="addBtnFoot addBtnFoot_orga addBtnFoot_project btn-open-form btn btn-default bg-purple inline-block margin-bottom-10"> 
        <i class="fa <?php echo  Project::ICON;?>"></i> 
        <span><?php echo Yii::t("common","Project") ?></span>
    </a><br/>
    <a href="javascript:;" data-form-type="event" class="addBtnFoot addBtnAll btn-open-form btn btn-default bg-orange margin-bottom-10"> 
        <i class="fa fa-calendar"></i> 
        <span><?php echo Yii::t("common","Event") ?></span>
    </a><br/>
    <a href="javascript:;" data-form-type="classifieds" class="addBtnFoot  addBtnFoot_orga addBtnFoot_project btn-open-form btn btn-default bg-azure margin-bottom-10"> 
        <i class="fa fa-bullhorn"></i> 
        <span><?php echo Yii::t("common","Classified") ?></span>
    </a><br/>
    <a href="javascript:;" data-form-type="ressources" class="addBtnFoot addBtnAll btn-open-form btn btn-default bg-vine margin-bottom-10"> 
        <i class="fa fa-cubes"></i> 
        <span><?php echo Yii::t("common","Ressource") ?></span>
    </a><br/>
    <a href="javascript:;" data-form-type="jobs" class="addBtnFoot hideBtnFoot_person addBtnFoot_orga addBtnFoot_project btn-open-form btn btn-default bg-yellow-k margin-bottom-10"> 
        <i class="fa fa-briefcase"></i> 
        <span><?php echo Yii::t("common","Jobs") ?></span>
    </a><br/>
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
    <?php } ?>
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