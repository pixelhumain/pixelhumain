
<?php
    HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/multi_tags_scopes.css'), Yii::app()->theme->baseUrl); 
    HtmlHelper::registerCssAndScriptsFiles(array('/js/menus/multi_tags_scopes.js'), $this->module->assetsUrl); 
    
    HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/multiscopes.css'), Yii::app()->theme->baseUrl );
    HtmlHelper::registerCssAndScriptsFiles(array( '/js/menus/multitags.js'), $this->module->assetsUrl);
    HtmlHelper::registerCssAndScriptsFiles(array( '/js/menus/multiscopes.js'), $this->module->assetsUrl);

    $cities = CO2::getCitiesNewCaledonia();

    $multiscopes = "{}";
    if(@$me["multiscopes"]){
        $multiscopes = @$me["multiscopes"] ? @$me["multiscopes"] : "{}";
    }else{
        $multiscopes = (empty($me) && isset( Yii::app()->request->cookies['multiscopes'] )) ? 
                        json_decode(Yii::app()->request->cookies['multiscopes']->value) : "{}";

        $multiscopesStr = (empty($me) && isset( Yii::app()->request->cookies['multiscopes'] )) ? 
                        Yii::app()->request->cookies['multiscopes']->value : "{}";  
    }
    //var_dump($multiscopes); exit;
?>
<style>
    .modal-content{
        padding-top:15px!important;
    }


    h4.title-scope{
        background-color: #EAE7E7;
        padding: 8px;
        border-radius: 50px;
    }

    .item-scope-select.disabled{
       cursor:pointer;
       opacity:1;
    }
    .item-scope-select.disabled.selected{
        opacity:0.5;
    }
    .btn-scope:hover{
        background-color: #e77e75;
    }
    .kanakName{
        text-transform: uppercase;
        margin-top: 4px;
        display: inline-block;
    }

    .aireKanakName{
        font-size:10px;
    }

   .item-scope-city.selected .kanakName,
   .item-scope-city:hover .kanakName{
     color:white;
   }
   .item-scope-city.selected .aireKanakName,
   .item-scope-city:hover .aireKanakName{
     color:white;
   }
    
    @media (max-width: 768px) {
        .portfolio-modal .modal-content h2 {
            font-size: 1em;
        }
        .btn-scope h5,
        .btn-scope h4{
            font-size: 0.8em;
        }
        .btn-scope h4{
           margin: 0px;
        }

        h4.title-scope{
            font-size: 0.8em;
        }
    }    
</style>
<div class="portfolio-modal modal fade" id="modalScopes" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl"></div>
            </div>
        </div>
        <div class="">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="modal-body text-center">
                        <h2 class="text-red"><!-- <i class="fa fa-bullseye fa-2x"></i> -->
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/cible3.png" height=70><br>
                        <span class="text-dark">Recherche </span>ciblée</h2>
                        <h5 class="text-dark">Sélectionnez des zones de recherche</h5>
                        <div class="col-md-12  col-sm-12 col-xs-12 text-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <i class="fa fa-times"></i> Annuler
                            </button>
                            <button type="button" class="btn btn-success" id="btn-validate-scope" data-dismiss="modal">
                                <i class="fa fa-check"></i> Valider
                            </button>
                            <hr>
                            
                        </div>
                        
                        <!-- <div class="col-md-12 ">
                            <hr>
                            <button class="btn btn-scope item-scope-select item-scope-dep disabled" data-dismiss="modal"
                                    data-scope-value="Province Sud"
                                    data-scope-name="Province Sud">
                                <h4><i class="fa fa-bullseye"></i> Province Sud</h4>
                            </button> 
                            <button class="btn btn-scope item-scope-select item-scope-dep disabled" data-dismiss="modal"
                                    data-scope-value="Province Nord"
                                    data-scope-name="Province Nord">
                                <h4><i class="fa fa-bullseye"></i> Province Nord</h4>
                            </button> 
                            <button class="btn btn-scope item-scope-select item-scope-dep disabled" data-dismiss="modal"
                                    data-scope-value="Province Des Iles"
                                    data-scope-name="Province Des Iles">
                                <h4><i class="fa fa-bullseye"></i> Province des Îles</h4>
                            </button>
                        </div>  -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <h4 class="title-scope"><i class="fa fa-angle-down"></i> Grand Nouméa</h4>
                            <?php foreach($cities["GN"] as $city){ ?>
                                <?php 
                                    $city["cp"] = $city["postalCodes"][0]["postalCode"];
                                    $selected=""; $active=false;
                                    if(!empty($multiscopes) && $multiscopes!="{}")
                                    foreach($multiscopes as $key=>$scope) {
                                        //var_dump($scope);
                                        if($key == $city["_id"]) {
                                            $selected="selected";

                                            if(is_array($scope)){ $active = @$scope["active"]==true ? "" : "disabled"; }
                                            else{ $active = @$scope->active==true ? "" : "disabled"; }
                                        }
                                    }
                                ?>
                                <div class="inline-block margin-bottom-15">
                                    <button class="btn btn-scope item-scope-select item-scope-city <?php echo $active." ".$selected; ?>" 
                                            data-scope-value="<?php echo $city["_id"]; ?>"
                                            data-scope-name="<?php echo $city["name"]; ?>"
                                            >
                                        <h5 class="margin-5">
                                            <i class="fa fa-bullseye"></i> 
                                            <?php echo $city["name"]; ?><br>
                                            <small class="kanakName"><i><?php echo @$city["kanakName"]; ?></i></small><br>
                                            <small class="aireKanakName"><i><?php echo @$city["level4Name"]; ?></i></small>
                                        </h5>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            
                            <h4 class="title-scope"><i class="fa fa-angle-down"></i> Les îles</h4>
                            <?php foreach($cities["Iles"] as $city){  ?>
                                <?php 
                                    $city["cp"] = $city["postalCodes"][0]["postalCode"];
                                    $selected="";
                                    if(!empty($multiscopes) && $multiscopes!="{}")
                                    foreach($multiscopes as $key=>$scope) {
                                        if($key == $city["_id"]) $selected="selected";
                                        if(is_array($scope)){ $active = @$scope["active"]==true ? "" : "disabled"; }
                                        else{ $active = @$scope->active==true ? "" : "disabled"; }
                                    }
                                ?>
                                <div class="inline-block margin-bottom-15">
                                    <button class="btn btn-scope item-scope-select item-scope-city <?php echo $active." ".$selected; ?>" 
                                            data-scope-value="<?php echo $city["_id"]; ?>"
                                            data-scope-name="<?php echo $city["name"]; ?>"
                                            >
                                        <h5 class="margin-5">
                                            <i class="fa fa-bullseye"></i> 
                                            <?php echo $city["name"]; ?><br>
                                            <small class="kanakName"><i><?php echo @$city["kanakName"]; ?></i></small><br>
                                            <small class="aireKanakName"><i><?php echo @$city["level4Name"]; ?></i></small>
                                        </h5>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>                       
                    </div>
                </div>
            </div>
            <div class="row ">
                <!-- <h4>Grande Terre<br><i class="fa fa-angle-down"></i></h4> -->
                
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="modal-body text-left no-padding">
                        <!-- <h2 class="text-red"><i class="fa fa-bullseye fa-2x"></i><br>
                        <span class="text-dark">Filtrer par</span> commune</h2> -->
                        
                        <?php foreach(array("Sud", "Nord") as $province){ ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 padding-50">
                            <h4 class="text-center title-scope">
                                <i class="fa fa-angle-down"></i> Province <?php echo $province; ?>
                            </h4>
                            <?php foreach($cities[$province] as $city){ ?>
                                <?php 
                                    $city["cp"] = $city["postalCodes"][0]["postalCode"];
                                    $selected="";
                                    if(!empty($multiscopes) && $multiscopes!="{}")
                                    foreach($multiscopes as $key=>$scope) {
                                        if($key == $city["_id"]) $selected="selected";
                                        if(is_array($scope)){ $active = @$scope["active"]==true ? "" : "disabled"; }
                                        else{ $active = @$scope->active==true ? "" : "disabled"; }
                                    }
                                ?>
                                <div class="col-md-3 col-sm-6 col-xs-6 text-center margin-bottom-15">
                                    <div class="inline-block">
                                        <button class="btn btn-scope item-scope-select item-scope-city <?php echo $active." ".$selected; ?>" 
                                                data-scope-value="<?php echo $city["_id"]; ?>"
                                                data-scope-name="<?php echo $city["name"]; ?>"
                                                >
                                            <h5 class="margin-5">
                                                <i class="fa fa-bullseye"></i> 
                                                <?php echo $city["name"]; ?><br>
                                                <small class="kanakName"><i><?php echo @$city["kanakName"]; ?></i></small><br>
                                                <small class="aireKanakName"><i><?php echo @$city["level4Name"]; ?></i></small>
                                            </h5>
                                        </button>
                                </div>
                                </div>
                            <?php } ?>
                            </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input id="searchLocalityCITYKEY" type="hidden" />
<input id="searchLocalityCODE_POSTAL" type="hidden" />
<input id="searchLocalityDEPARTEMENT" type="hidden"/>
<input id="searchLocalityREGION" type="hidden" />
<input id="searchTags" type="hidden" />

<div class="item-scope-region hidden" id="scope-max-dep" data-scope-value="Nouvelle-Calédonie"></div>

<style>
    .item-scope-dep.disabled{
        color:red;
    }
    .modal{
        z-index:1100;
    }
</style>

<script type="text/javascript">
    var actionOnSetGlobalScope="filter";
    var myMultiTags = {};
    var myMultiScopes = <?php echo isset($me) && isset($me["multiscopes"]) ? 
                                json_encode($me["multiscopes"]) :  
                                $multiscopesStr; 
                    ?>;

    var actionOnSetGlobalScope="filter";                
    var loadingScope = true;
    jQuery(document).ready(function() {

        $("#dropdown-multi-scope-found").hide();

        $('ul.dropdown-menu').click(function(){ return false });


        /*$.each(myMultiScopes, function(key, val){
            myMultiScopes[key]["active"] = false;
        });*/

       $(".item-scope-select").off().click(function(){
            currentScopeType = "city";

            if($(this).hasClass("selected")){
                var scopeValue = $(this).data("scope-value");
                if(scopeExists(scopeValue)){
                    delete myMultiScopes[scopeValue];
                    $(this).removeClass("selected");
                    $(this).addClass("disabled");
                }
            }else{
                addScopeToMultiscope( $(this).data("scope-value"), $(this).data("scope-name"));
                $(this).addClass("selected");
                $(this).removeClass("disabled");
                toastr.success('Nouvelle cible de recherche ajoutée : ' + $(this).data("scope-name"));
            }
            checkScopeMax();            
            
            mylog.log("toogle");//, $(this).data("scope-value"));
            showTagsScopesMin(".scope-min-header");
            bindCommunexionScopeEvents();
        });
       

        $("#btn-validate-scope").click(function(){
            startSearch(0, indexStepInit);
        });

        
        loadMultiScopes();

      
        mylog.log("communexionActivated cookie", $.cookie('communexionActivated'), typeof $.cookie('communexionActivated'));
       
        loadingScope = false;
    });


function toogleScopeMultiscope(scopeValue, selected){ mylog.log("toogleScopeMultiscope(scopeValue)", scopeValue);
    if(scopeExists(scopeValue)){
        myMultiScopes[scopeValue].active = !myMultiScopes[scopeValue].active;
        
        if(typeof selected == "undefined") saveMultiScope();
        else myMultiScopes[scopeValue].active = selected;
        
        if(myMultiScopes[scopeValue].active){
            $("[data-scope-value='"+scopeValue+"'] .item-scope-checker i.fa").removeClass("fa-circle-o");
            $("[data-scope-value='"+scopeValue+"'] .item-scope-checker i.fa").addClass("fa-check-circle");
            $("[data-scope-value='"+scopeValue+"'].item-scope-input").removeClass("disabled");
            $("[data-scope-value='"+scopeValue+"'].item-scope-select").removeClass("disabled");
        }else{
            $("[data-scope-value='"+scopeValue+"'] .item-scope-checker i.fa").addClass("fa-circle-o");
            $("[data-scope-value='"+scopeValue+"'] .item-scope-checker i.fa").removeClass("fa-check-circle");
            $("[data-scope-value='"+scopeValue+"'].item-scope-input").addClass("disabled");
            $("[data-scope-value='"+scopeValue+"'].item-scope-select").addClass("disabled");
        }
        console.log("before rebuildSearchScopeInput from toogleScope");
        rebuildSearchScopeInput();
    }else{
        //showMsgInfoMultiScope("Ce scope n'existe pas", "danger");
    }
}

    function checkScopeMax(){
        var empty = true;
        $.each(myMultiScopes, function(key, val){
            if(val.active == true) empty = false;
        });

        if(empty){ $("#scope-max-dep").removeClass("disabled"); }
        else { $("#scope-max-dep").addClass("disabled"); }
    }

</script>