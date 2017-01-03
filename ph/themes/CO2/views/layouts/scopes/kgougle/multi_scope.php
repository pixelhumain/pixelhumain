
<?php
    HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/multi_tags_scopes.css'), Yii::app()->theme->baseUrl); 
    HtmlHelper::registerCssAndScriptsFiles(array('/js/menus/multi_tags_scopes.js'), $this->module->assetsUrl); 
    
    HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/multiscopes.css'), Yii::app()->theme->baseUrl );
    HtmlHelper::registerCssAndScriptsFiles(array( '/js/menus/multitags.js'), $this->module->assetsUrl);
    HtmlHelper::registerCssAndScriptsFiles(array( '/js/menus/multiscopes.js'), $this->module->assetsUrl);

    $cities = CO2::getCitiesNewCaledonia();

    // $multiscopes = (empty($me) && isset( Yii::app()->request->cookies['multiscopes'] )) ? 
    //                 Yii::app()->request->cookies['multiscopes']->value : "{}";  

    $multiscopes = @$me["multiscopes"] ? @$me["multiscopes"] : "{}";
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
                        <h2 class="text-red"><i class="fa fa-bullseye fa-2x"></i><br>
                        <span class="text-dark">Filtrer par </span>lieux</h2>
                        <h5 class="text-dark">Clickez pour sélectionner des zones de recherche</h5>
                        <div class="col-md-12  col-sm-12 col-xs-12 text-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <i class="fa fa-times"></i> Annuler
                            </button>
                            <button type="button" class="btn btn-success" id="btn-validate-scope" data-dismiss="modal">
                                <i class="fa fa-check"></i> Valider
                            </button>
                        </div>
                        
                        <div class="col-md-12">
                            <hr>
                            <button class="btn btn-scope item-scope-dep" data-dismiss="modal"
                                    data-scope-value="Province Sud"
                                    data-scope-name="Province Sud">
                                <h4><i class="fa fa-bullseye"></i> Province Sud</h4>
                            </button> 
                            <button class="btn btn-scope item-scope-dep" data-dismiss="modal"
                                    data-scope-value="Province Nord"
                                    data-scope-name="Province Nord">
                                <h4><i class="fa fa-bullseye"></i> Province Nord</h4>
                            </button> 
                            <button class="btn btn-scope item-scope-dep" data-dismiss="modal"
                                    data-scope-value="Province Des Iles"
                                    data-scope-name="Province Des Iles">
                                <h4><i class="fa fa-bullseye"></i> Province des Îles</h4>
                            </button> 
                        </div> <hr>
                        <div class="col-md-6">
                            <hr>
                            <h4 class="title-scope"><i class="fa fa-angle-down"></i> Grand Nouméa</h4>
                            <?php foreach($cities["GN"] as $city){ ?>
                                <?php 
                                    $city["cp"] = $city["postalCodes"][0]["postalCode"];
                                    $selected="";
                                    if(!empty($multiscopes) && $multiscopes!="{}")
                                    foreach($multiscopes as $key=>$scope) {
                                        if($key == City::getUnikey($city)) $selected="selected";
                                    }
                                ?>
                                <button class="btn btn-scope item-scope-select margin-bottom-5 <?php echo $selected; ?>" 
                                        data-scope-value="<?php echo City::getUnikey($city); ?>"
                                        data-scope-name="<?php echo $city["name"]; ?>"
                                        >
                                    <h5 class="margin-5"><i class="fa fa-bullseye"></i> <?php echo $city["name"]; ?></h5>
                                </button> 
                            <?php } ?>
                        </div>
                        <div class="col-md-6">
                            <hr>
                            <h4 class="title-scope"><i class="fa fa-angle-down"></i> Les îles</h4>
                            <?php foreach($cities["Iles"] as $city){ ?>
                                <?php 
                                    $city["cp"] = $city["postalCodes"][0]["postalCode"];
                                    $selected="";
                                    if(!empty($multiscopes) && $multiscopes!="{}")
                                    foreach($multiscopes as $key=>$scope) {
                                        if($key == City::getUnikey($city)) $selected="selected";
                                    }
                                ?>
                                <button class="btn btn-scope item-scope-select margin-bottom-5 <?php echo $selected; ?>" 
                                        data-scope-value="<?php echo City::getUnikey($city); ?>"
                                        data-scope-name="<?php echo $city["name"]; ?>"
                                        >
                                    <h5 class="margin-5"><i class="fa fa-bullseye"></i> <?php echo $city["name"]; ?></h5>
                                </button> 
                            <?php } ?>
                        </div>                       
                    </div>
                </div>
            </div>
            <div class="row ">
                <hr>
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
                                        if($key == City::getUnikey($city)) $selected="selected";
                                    }
                                ?>
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <button class="btn btn-scope item-scope-select margin-bottom-5 <?php echo $selected; ?>" 
                                            data-scope-value="<?php echo City::getUnikey($city); ?>"
                                            data-scope-name="<?php echo $city["name"]; ?>"
                                            >
                                        <h5 class="margin-5"><i class="fa fa-bullseye"></i> <?php echo $city["name"]; ?></h5>
                                    </button> 
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
    #modalScopes{
        z-index:1100;
    }
</style>

<script type="text/javascript">
    var myMultiTags = {};
    var myMultiScopes = <?php echo isset($me) && isset($me["multiscopes"]) ? 
                                json_encode($me["multiscopes"]) :  
                                $multiscopes; 
                    ?>;

    var loadingScope = true;
    jQuery(document).ready(function() {

        $.each(myMultiScopes, function(key, val){
            myMultiScopes[key]["active"] = false;
        });

        $(".item-scope-select").off().click(function(){
            currentScopeType = "city";

            if($(this).hasClass("selected")){
                var scopeValue = $(this).data("scope-value");
                if(scopeExists(scopeValue)){
                    delete myMultiScopes[scopeValue];
                    $(this).removeClass("selected");
                }
            }else{
                addScopeToMultiscope( $(this).data("scope-value"), $(this).data("scope-name"));
                $(this).addClass("selected");
            }
            checkScopeMax();            
            
            mylog.log("toogle");//, $(this).data("scope-value"));
            showTagsScopesMin(".scope-min-header");
        });

        $("#btn-validate-scope").click(function(){
            startSearch(0, indexStepInit);
        });

        rebuildSearchScopeInput();

        showTagsScopesMin(".scope-min-header");
        loadingScope = false;
    });

    function showTagsScopesMin(htmlId){
        htmlId=".scope-min-header";

        /************** SCOPES **************/
        var iconSelectScope = "<i class='fa fa-circle-o'></i>";
        var scopeSelected = false;

        
        html = "<div class='list-select-scopes'>";
        
        var numberOfScope = 0;
        if(typeof myMultiScopes != "undefined")
        $.each(myMultiScopes, function(key, value){
            numberOfScope++;
            var disabled = value.active == false ? "disabled" : "";
            if(typeof value.name == "undefined") value.name = key;
            html +=     "<span data-toggle='dropdown' data-target='dropdown-multi-scope' "+
                            "class='text-red "+disabled+" item-scope-checker  item-scope-city margin-right-10' data-scope-value='"+ key + "'>" + 
                            "<i class='fa fa-bullseye'></i> " + value.name + 
                        "</span> ";
        });
        // if (numberOfScope == 0) {
        //     html +=     '<span id="helpMultiScope" class="toggle-scope-dropdown" style="padding-left:0px">'+
        //                     '<a href="javascript:"> Ajouter des filtres géographiques ?</a>'+
        //                 '</span>';
        // }
        html +=     "</span>";
        html += "</div>";

        $(htmlId).html(html);
        multiTagScopeLbl();

        $(".item-scope-checker").off().click(function(){ 
            toogleScopeMultiscope( $(this).data("scope-value") );

            checkScopeMax();
        });
        
        $(".toggle-scope-dropdown").click(function(){ //mylog.log("toogle");
            if(!$("#dropdown-content-multi-scope").hasClass('open'))
            setTimeout(function(){ $("#dropdown-content-multi-scope").addClass('open'); }, 300);
        });

        
        if(scopeSelected){ $(".btnShowAllScope").hide(); $(".btnHideAllScope").show(); } 
        else             { $(".btnShowAllScope").show(); $(".btnHideAllScope").hide(); }

        checkScopeMax();
        rebuildSearchScopeInput();


        if(!loadingScope)
        startSearch(0, indexStepInit);
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