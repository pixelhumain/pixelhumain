<?php 
$preferences = Preference::getPreferencesByTypeId(@Yii::app()->session["userId"], Person::COLLECTION);
$multiscopes = (empty($me) && isset( Yii::app()->request->cookies['multiscopes'] )) ? 
                            Yii::app()->request->cookies['multiscopes']->value : "{}";
?>
<script>

    var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
    var moduleUrl = "<?php echo Yii::app()->controller->module->assetsUrl;?>";
    var moduleId = "<?php echo $parentModuleId?>";
    var activeModuleId = "<?php echo $this->module->id?>";


    var modules = {
        //Configure here eco
        "classifieds":<?php echo json_encode( Classified::getConfig("classifieds") ) ?>,
        "jobs":<?php echo json_encode( Classified::getConfig("jobs") ) ?>,
        "ressources":<?php echo json_encode( Classified::getConfig("ressources") ) ?>,
        "places": <?php echo json_encode( Place::getConfig() ) ?>,
        "poi": <?php echo json_encode( Poi::getConfig() ) ?>,
        "chat": <?php echo json_encode( Chat::getConfig() ) ?>,
        "interop": <?php echo json_encode( Interop::getConfig() ) ?>,
        "eco" : <?php echo json_encode( array(
            "module" => "eco",
            "url"    => Yii::app()->getModule( "eco" )->assetsUrl
        )); ?>,
        "survey" : <?php echo json_encode( array(
            "url"    => Yii::app()->getModule( "survey" )->assetsUrl
        )); ?>,
        "co2" : <?php echo json_encode( array(
            "url"    => Yii::app()->getModule( "co2" )->assetsUrl
        )); ?>,
        "cotools" : <?php echo json_encode( array(
            "module" => "cotools",
            "init"   => Yii::app()->getModule( "cotools" )->assetsUrl."/js/init.js" ,
            "form"   => Yii::app()->getModule( "cotools" )->assetsUrl."/js/dynForm.js" ,
        )); ?>
    };

    var themeUrl = "<?php echo Yii::app()->theme->baseUrl;?>";
    var userId = "<?php echo Yii::app()->session['userId']?>";
    var mainLanguage = "<?php echo Yii::app()->language ?>";
    var debug = <?php echo (YII_DEBUG) ? "true" : "false" ?>;
    var currentUrl = "<?php echo "#".Yii::app()->controller->id.".".Yii::app()->controller->action->id ?>";
    var debugMap = [
        <?php if(YII_DEBUG) { ?>
           { "userId":"<?php echo Yii::app()->session['userId']?>"},
           { "userEmail":"<?php echo Yii::app()->session['userEmail']?>"}
        <?php } ?>
        ];

    var myScopes={};

    var currentScrollTop = 0;
    var isMapEnd = false;
	//used in communecter.js dynforms
    var tagsList = <?php echo json_encode(Tags::getActiveTags()) ?>;
    var eventTypes = <?php asort(Event::$types); echo json_encode(Event::$types) ?>;
    var organizationTypes = <?php echo json_encode( Organization::$types ) ?>;
    var avancementProject = <?php echo json_encode( Project::$avancement ) ?>;
    var currentUser = <?php echo isset($me) ? json_encode(Yii::app()->session["user"]) : "null"?>;
    var rawOrganizerList = <?php echo json_encode(Authorisation::listUserOrganizationAdmin(Yii::app() ->session["userId"])) ?>;
    var organizerList = {}; 
    var poiTypes = <?php echo json_encode( Poi::$types ) ?>;
    //var rolesList=[ tradCategory.financier, tradCategory.partner, tradCategory.sponsor, tradCategory.organizor, tradCategory.president, tradCategory.director, tradCategory.speaker, tradCategory.intervener];

    var rolesList=[ { id : tradCategory.financier, text : tradCategory.financier}, 
                    { id : tradCategory.partner , text : tradCategory.partner } ];

    var myContacts = <?php echo (@$myFormContact != null) ? json_encode($myFormContact) : "null"; ?>;
    var myContactsById =<?php echo (@$myFormContact != null) ? json_encode($myFormContact) : "null"; ?>;
    var userConnected = <?php echo isset($me) ? json_encode($me) : "null"; ?>;

    var poi = <?php echo json_encode( CO2::getContextList("poi") ) ?>;

    //var classifiedSubTypes = <?php //echo json_encode( Classified::$classifiedSubTypes ) ?>;
    var urlTypes = <?php asort(Element::$urlTypes); echo json_encode(Element::$urlTypes) ?>;
    
    var globalTheme = "<?php echo Yii::app()->theme->name;?>";

    var deviseTheme = <?php echo json_encode(@$params["devises"]) ?>;
    var deviseDefault = <?php echo json_encode(@$params["deviseDefault"]) ?>;

    var search={
        value:"",
        page:0,
        count:true,
        app:"search",
        type:"<?php echo Organization::COLLECTION ?>"
    };

    var mapIconTop = {
        "default" : "fa-arrow-circle-right",
        "citoyen":"<?php echo Person::ICON ?>", 
        "citoyens":"<?php echo Person::ICON ?>", 
        "person":"<?php echo Person::ICON ?>", 
        "people":"<?php echo Person::ICON ?>", 
        "NGO":"<?php echo Organization::ICON ?>",
        "LocalBusiness" :"<?php echo Organization::ICON_BIZ ?>",
        "Group" : "<?php echo Organization::ICON_GROUP ?>",
        "group" : "<?php echo Organization::ICON ?>",
        "association" : "<?php echo Organization::ICON ?>",
        "organization" : "<?php echo Organization::ICON ?>",
        "organizations" : "<?php echo Organization::ICON ?>",
        "GovernmentOrganization" : "<?php echo Organization::ICON_GOV ?>",
        "event":"<?php echo Event::ICON ?>",
        "events":"<?php echo Event::ICON ?>",
        "project":"<?php echo Project::ICON ?>",
        "projects":"<?php echo Project::ICON ?>",
        "city": "<?php echo City::ICON ?>",
        "entry": "fa-gavel",
        "action": "fa-cogs",
        "actions": "fa-cogs",
        "poi": "fa-info-circle",
        "video": "fa-video-camera",
        "classified" : "fa-bullhorn"
    };
    
    var mapColorIconTop = {
        "default" : "dark",
        "citoyen":"yellow", 
        "citoyens":"yellow", 
        "person":"yellow", 
        "people":"yellow", 
        "NGO":"green",
        "LocalBusiness" :"azure",
        "Group" : "white",
        "group" : "green",
        "association" : "green",
        "organization" : "green",
        "organizations" : "green",
        "GovernmentOrganization" : "green",
        "event":"orange",
        "events":"orange",
        "project":"purple",
        "projects":"purple",
        "city": "red",
        "entry": "azure",
        "action": "lightblue2",
        "actions": "lightblue2",
        "poi": "dark",
        "video":"dark",
        "classified" : "yellow"
    };

    var searchObject={
        text:"",
        page:0,
        indexMin:0,
        indexStep:30,
        count:true,
        tags:[],
        initType : "",
        types:[],
        countType:[],
        locality:{}
    };

    var typeObj = {
        addPhoto:{ titleClass : "bg-dark", color : "bg-dark" },
        addFile:{ titleClass : "bg-dark", color : "bg-dark" },
        person : { col : "citoyens" ,ctrl : "person",titleClass : "bg-yellow",bgClass : "bgPerson",color:"yellow",icon:"user",lbh : "#person.invite",   },
        persons : { sameAs:"person" },
        people : { sameAs:"person" },
        citoyen : { sameAs:"person" },
        citoyens : { sameAs:"person" },
        
        poi:{  col:"poi",ctrl:"poi",color:"green-poi", titleClass : "bg-green-poi", icon:"map-marker",
            subTypes:["link" ,"tool","machine","software","rh","RessourceMaterielle","RessourceFinanciere",
                   "ficheBlanche","geoJson","compostPickup","video","sharedLibrary","artPiece","recoveryCenter",
                   "trash","history","something2See","funPlace","place","streetArts","openScene","stand","parking","other" ] },
        
        
        siteurl:{ col:"siteurl",ctrl:"siteurl"},
        organization : { col:"organizations", ctrl:"organization", icon : "group",titleClass : "bg-green",color:"green",bgClass : "bgOrga"},
        organizations : {sameAs:"organization"},
        LocalBusiness : {col:"organizations",color: "azure",icon: "industry"},
        NGO : {sameAs:"organization", color:"green", icon:"users"},
        Association : {sameAs:"organization", color:"green", icon: "group"},
        GovernmentOrganization : {col:"organization", color: "red",icon: "university"},
        Group : {   col:"organizations",color: "turq",icon: "circle-o"},
        event : {col:"events",ctrl:"event",icon : "calendar",titleClass : "bg-orange", color:"orange",bgClass : "bgEvent"},
        events : {sameAs:"event"},
        project : {col:"projects",ctrl:"project",   icon : "lightbulb-o",color : "purple",titleClass : "bg-purple", bgClass : "bgProject"},
        projects : {sameAs:"project"},
        city : {sameAs:"cities"},
        cities : {col:"cities",ctrl:"city", titleClass : "bg-red", icon : "university",color:"red"},
        
        entry : {   col:"surveys",  ctrl:"survey",  titleClass : "bg-dark",bgClass : "bgDDA",   icon : "gavel", color : "azure", 
            saveUrl : baseUrl+"/" + moduleId + "/survey/saveSession"},
        vote : {col:"actionRooms",ctrl:"survey"},
        survey : {col:"proposals",ctrl:"proposal", color:"dark",icon:"hashtag", titleClass : "bg-turq" }, 
        surveys : {sameAs:"survey"},
        proposal : { col:"proposals", ctrl:"proposal", color:"dark",icon:"hashtag", titleClass : "bg-turq" }, 
        proposals : { sameAs : "proposal" },
        resolutions : { col:"resolutions", ctrl:"resolution", titleClass : "bg-turq", bgClass : "bgDDA", icon : "certificate", color : "turq" },
        action : {col:"actions", ctrl:"action", titleClass : "bg-turq", bgClass : "bgDDA", icon : "cogs", color : "dark" },
        actions : { sameAs : "action" },
        actionRooms : {sameAs:"room"},
        rooms : {sameAs:"room"},
        room : {col:"rooms",ctrl:"room",color:"azure",icon:"connectdevelop",titleClass : "bg-turq"},
        discuss : {col:"actionRooms",ctrl:"room"},

        contactPoint : {col : "contact" , ctrl : "person",titleClass : "bg-blue",bgClass : "bgPerson",color:"blue",icon:"user", 
            saveUrl : baseUrl+"/" + moduleId + "/element/saveContact"},
        product:{ col:"products",ctrl:"product", titleClass : "bg-orange", color:"orange",  icon:"shopping-basket"},
        products : {sameAs:"product"},
        service:{ col:"services",ctrl:"service", titleClass : "bg-green", color:"green",    icon:"sun-o"},
        services : {sameAs:"service"},
        circuit:{ col:"circuits",ctrl:"circuit", titleClass : "bg-orange", color:"green",   icon:"ravelry"},
        circuits : {sameAs:"circuit"},
        
        url : {col : "url" , ctrl : "url",titleClass : "bg-blue",bgClass : "bgPerson",color:"blue",icon:"user",saveUrl : baseUrl+"/" + moduleId + "/element/saveurl",   },
        bookmark : {col : "bookmarks" , ctrl : "bookmark",titleClass : "bg-dark",bgClass : "bgPerson",color:"blue",icon:"bookmark"},
        document : {col : "document" , ctrl : "document",titleClass : "bg-dark",bgClass : "bgPerson",color:"dark",icon:"upload",saveUrl : baseUrl+"/" + moduleId + "/element/savedocument", },
        default : {icon:"arrow-circle-right",color:"dark"},
        //"video" : {icon:"video-camera",color:"dark"},
        formContact : { titleClass : "bg-yellow",bgClass : "bgPerson",color:"yellow",icon:"user", saveUrl : baseUrl+"/"+moduleId+"/app/sendmailformcontact"},
        news : { col : "news", ctrl:"news", titleClass : "bg-dark", color:"dark",   icon:"newspaper-o"},
        //news : { col : "news" }, 
        config : { col:"config",color:"azure",icon:"cogs",titleClass : "bg-azure", title : tradDynForm.addconfig,
                    sections : {
                        network : { label: "Network Config",key:"network",icon:"map-marker"}
                    }},
        network : { col:"network",color:"azure",icon:"map-o",titleClass : "bg-turq"},
        networks : {sameAs:"network"},
        inputs : { color:"red",icon:"address-card-o",titleClass : "bg-phink", title : "All inputs"},
        addAny : { color:"pink",icon:"plus",titleClass : "bg-phink",title : tradDynForm.wantToAddSomething,
                    sections : {
                        person : { label: trad["Invite your contacts"],key:"person",icon:"user"},
                        organization : { label: trad.organization,key:"organization",icon:"group"},
                        event : { label: trad.event,key:"event",icon:"calendar"},
                        project : { label: trad.project ,key:"project",icon:"lightbulb-o"},
                    }},
        apps : { color:"pink",icon:"cubes",titleClass : "bg-phink",title : tradDynForm.appList,
                    sections : {
                        search : { label: "SEARCH",key:"#search",icon:"search fa-2x text-red"},
                        agenda : { label: "AGENDA",key:"#agenda",icon:"group fa-2x text-red"},
                        news : { label: "NEWS",key:"#news",icon:"newspaper-o fa-2x text-red"},
                        classifieds : { label: "ANNONCEs",key:"#classifieds",icon:"bullhorn fa-2x text-red"},
                        dda : { label: "DISCUSS DECIDE ACT" ,key:"#dda",icon:"gavel fa-2x text-red"},
                        chat : { label: "CHAT" ,key:"#chat",icon:"comments fa-2x text-red"},
                    }},
        filter : { color:"azure",icon:"list",titleClass : "bg-turq",title : "Nouveau Filtre"}
    };

    var directoryViewMode="block";
    var themeObj = {
        init : function(){
            toastr.options = {
              "closeButton": false,
              "positionClass": "toast-bottom-right",
              "onclick": null,
              "showDuration": "1000",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };

            if( notNull(localStorage) && notNull(localStorage.myScopes) )
                myScopes = JSON.parse(localStorage.getItem("myScopes"));

            if( notNull(myScopes) && myScopes.userId == userId )  {
                myScopes.open={};
                myScopes.search = {};
                myScopes.openNews={};
                if(myScopes.multiscopes==null)
                    myScopes.multiscopes={};
            } else {
                myScopes={
                    type:"open",
                    typeNews:"open",
                    userId: userId,
                    open : {},
                    openNews : {},
                    search : {},
                    communexion : <?php echo json_encode(CO2::getCommunexionUser()) ?>,
                    multiscopes : <?php echo isset($me) && isset($me["multiscopes"]) ? 
                                    json_encode($me["multiscopes"]) :
                                    $multiscopes; ?>
                };

                if( myScopes.communexion != false)
                    myScopes.communexion=scopeObject(myScopes.communexion);
                else
                    myScopes.communexion={};
                localStorage.setItem("myScopes",JSON.stringify(myScopes));
            }

            initFloopDrawer();
            resizeInterface();
        },
        imgLoad : "CO2r.png" ,
        mainContainer : ".main-container",
        blockUi : {
            processingMsg : //'<img src="'+themeUrl+'/assets/img/CO2r.png" class="nc_map" height=80>'+
                  '<i class="fa fa-spin fa-circle-o-notch"></i>'+
                  '<h4 style="font-weight:300" class=" text-dark padding-10">'+
                    'Chargement en cours...'+
                  '</h4>'+
                  '<span style="font-weight:300" class=" text-dark">'+
                    'Merci de patienter quelques instants'+
                  '</span>',
                  //'<br><br><br>'+
                  //'<a href="#" class="btn btn-default btn-sm lbh">'+
                  //  "c'est trop long !"+
                  //'</a>', 
            errorMsg : //'<img src="'+themeUrl+'/assets/img/CO2r.png" class="nc_map" height=80>'+
              '<i class="fa fa-times"></i><br>'+
               '<span class="col-md-12 text-center font-blackoutM text-left">'+
                '<span class="letter letter-red font-blackoutT" style="font-size:40px;">404</span>'+
               '</span>'+

              '<h4 style="font-weight:300" class=" text-dark padding-10">'+
                'Oups ! Une erreur s\'est produite'+
              '</h4>'
              //'<span style="font-weight:300" class=" text-dark">'+
                //'Vous allez être redirigé vers la page d\'accueil'+
              //'</span>'
        },
        dynForm : {
            onLoadPanel : function (elementObj) { 
                //console.log("onLoadPanel currentKFormType", currentKFormType);
                var typeName = (typeof currentKFormType != "undefined" && currentKFormType!=null) ? 
                    trad["add"+currentKFormType] : elementObj.dynForm.jsonSchema.title;
                
                var typeIcon = (typeof currentKFormType != "undefined" && currentKFormType!=null) ? 
                    typeObj[currentKFormType].icon : elementObj.dynForm.jsonSchema.icon;


                $("#ajax-modal-modal-title").html(
                        "<i class='fa fa-"+typeIcon+"'></i> "+typeName);
                
                $("#ajax-modal .modal-header").removeClass("bg-dark bg-red bg-purple bg-green bg-green-poi bg-orange bg-turq bg-yellow bg-url");
                $("#ajax-modal .infocustom p").removeClass("text-dark text-red text-purple text-green text-green-poi text-orange text-turq text-yellow text-url");
                
                if(typeof currentKFormType != "undefined" && typeObj[currentKFormType] && typeObj[currentKFormType].color){
                    $("#ajax-modal .modal-header").addClass("bg-"+typeObj[currentKFormType].color);
                    $("#ajax-modal .infocustom p").addClass("text-"+typeObj[currentKFormType].color);
                }
                
                <?php if(Yii::app()->params["CO2DomainName"] == "kgougle"){ ?>
                $(".locationBtn").on( "click", function(){
                     setTimeout(function(){
                        $('[name="newElement_country"]').val("NC");
                        $('[name="newElement_country"]').trigger("change");
                     },1000); 
                });
                <?php } ?>
                
                $(".locationBtn").html("<i class='fa fa-home'></i> <?php echo Yii::t("common","Main locality") ?>")
                $(".locationBtn").addClass("letter-red bold");
                $("#btn-submit-form").removeClass("text-azure").addClass("letter-green");
                if(typeof currentKFormType != "undefined")
                    $("#ajaxFormModal #type").val(currentKFormType);
            }
        }
    };

function expireAllCookies(name, paths) {
    var expires = new Date(0).toUTCString();
    document.cookie = name + '=; expires=' + expires;
    for (var i = 0, l = paths.length; i < l; i++) {
        document.cookie = name + '=; path=' + paths[i] + '; expires=' + expires;
    }
};

function removeCookies() {
    expireAllCookies('cityInseeCommunexion', ['/', '/ph', '/ph/co2', 'co2']);
    expireAllCookies('regionNameCommunexion', ['/', '/ph', '/ph/co2', 'co2']);
    expireAllCookies('nbCpbyInseeCommunexion', ['/', '/ph', '/ph/co2', 'co2']);
    expireAllCookies('countryCommunexion', ['/', '/ph', '/ph/co2']);
    expireAllCookies('cityName', ['/', '/ph', '/ph/co2', 'co2']);
    expireAllCookies('insee', ['/', '/ph', '/ph/co2', 'co2']);    
    expireAllCookies('inseeCommunexion', ['/','/ph', '/ph/co2', 'co2']);
    expireAllCookies('cpCommunexion', ['/','/ph', '/ph/co2', 'co2']);
    expireAllCookies('cityNameCommunexion', ['/','/ph', '/ph/co2', 'co2']);
    expireAllCookies('communexionType', ['/ph', '/ph/co2', 'co2']);
    expireAllCookies('communexionValue', ['/ph', '/ph/co2', 'co2']);
    expireAllCookies('communexionName', ['/ph', '/ph/co2', 'co2']);
    expireAllCookies('communexionLevel', ['/ph', '/ph/co2', 'co2']);
    expireAllCookies('communexionActivated', ['/ph', '/ph/co2', 'co2']);
    //expireAllCookies('multiscopes', ['/ph', '/ph/co2', 'co2']);

}

removeCookies();
    
</script>