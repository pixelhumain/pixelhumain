<?php 
    $params = CO2::getThemeParams();
    $multiscopes = (empty($me) && isset( Yii::app()->request->cookies['multiscopes'] )) ? 
                            Yii::app()->request->cookies['multiscopes']->value : "{}";
    $preferences = Preference::getPreferencesByTypeId(@Yii::app()->session["userId"], Person::COLLECTION);
?>
<script>
    var themeUrl = "<?php echo Yii::app()->theme->baseUrl;?>";
    var domainName = "<?php echo Yii::app()->params["CO2DomainName"];?>";
    var userId = "<?php echo Yii::app()->session['userId']?>";
    var uploadUrl = "<?php echo Yii::app()->params['uploadUrl'] ?>";
    var mainLanguage = "<?php echo Yii::app()->language ?>";
    var debug = <?php echo (YII_DEBUG) ? "true" : "false" ?>;
    var currentUrl = "<?php echo "#".Yii::app()->controller->id.".".Yii::app()->controller->action->id ?>";
    var debugMap = [
        <?php if(YII_DEBUG) { ?>
           { "userId":"<?php echo Yii::app()->session['userId']?>"},
           { "userEmail":"<?php echo Yii::app()->session['userEmail']?>"}
        <?php } ?>
        ];

    var baseUrl = "<?php echo Yii::app()->getRequest()->getBaseUrl(true);?>";
    var ctrlId = "<?php echo Yii::app()->controller->id;?>";
    var actionId = "<?php echo Yii::app()->controller->action->id ;?>";
    var moduleId = "<?php echo $parentModuleId?>";
    var parentModuleUrl = "<?php echo ( @Yii::app()->params["module"]["parent"] )  ? Yii::app()->getModule( Yii::app()->params["module"]["parent"] )->getAssetsUrl() : Yii::app()->controller->module->assetsUrl ?>";
    var moduleUrl = "<?php echo Yii::app()->controller->module->assetsUrl;?>";
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
        "cotools" : <?php echo json_encode( array(
            "module"        => "cotools",
            "init"          => Yii::app()->getModule( "cotools" )->assetsUrl."/js/init.js" ,
            "form"          => Yii::app()->getModule( "cotools" )->assetsUrl."/js/dynForm.js" ,
        )); ?>
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

    

    var currentScrollTop = 0;
    var isMapEnd = false;
	//used in communecter.js dynforms
    var tagsList = <?php echo json_encode(Tags::getActiveTags()) ?>;
    //var countryList = <?php //echo json_encode(Zone::getListCountry()) ?>;
    var eventTypes = <?php asort(Event::$types); echo json_encode(Event::$types) ?>;
    var organizationTypes = <?php echo json_encode( Organization::$types ) ?>;
    var avancementProject = <?php echo json_encode( Project::$avancement ) ?>;
    var currentUser = <?php echo isset($me) ? json_encode(Yii::app()->session["user"]) : "null"?>;
    var rawOrganizerList = <?php echo json_encode(Authorisation::listUserOrganizationAdmin(Yii::app() ->session["userId"])) ?>;
    var organizerList = {}; 
    var poiTypes = <?php echo json_encode( Poi::$types ) ?>;
    var poi = <?php echo json_encode( CO2::getContextList("poi") ) ?>;
    
    var myContacts = <?php echo (@$myFormContact != null) ? json_encode($myFormContact) : "null"; ?>;
    var myContactsById =<?php echo (@$myFormContact != null) ? json_encode($myFormContact) : "null"; ?>;
    var userConnected = <?php echo isset($me) ? json_encode($me) : "null"; ?>;
    var mentionsContact=[];
    var prestation = <?php echo json_encode( CO2::getContextList("prestation") ) ?>;
    var prestationList = prestation.categories;
    
    var roomList = <?php echo json_encode( CO2::getContextList("room") ) ?>;
    
    var directoryViewMode="<?php echo "block" ?>";
    //var classifiedSubTypes = <?php //echo json_encode( Classified::$classifiedSubTypes ) ?>;
    var urlTypes = <?php asort(Element::$urlTypes); echo json_encode(Element::$urlTypes) ?>;
    
    var globalTheme = "<?php echo Yii::app()->theme->name;?>";

    var deviseTheme = <?php echo json_encode(@$params["devises"]) ?>;
    var deviseDefault = <?php echo json_encode(@$params["deviseDefault"]) ?>;

    var rolesList=[ tradCategory.financier, tradCategory.partner, tradCategory.sponsor, tradCategory.organizor, tradCategory.president, tradCategory.director, tradCategory.speaker, tradCategory.intervener];
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
    var headerParams = {
        "persons"       : { color: "yellow",  icon: "user",         name: trad.people },
        "organizations" : { color: "green",   icon: "group",        name: trad.organizations },
        "NGO"           : { color: "green-k",   icon: "group",      name: trad.NGOs },
        "LocalBusiness" : { color: "azure",   icon: "industry",     name: trad.LocalBusiness },
        "Group"         : { color: "turq",   icon: "circle-o",      name: trad.groups },
        "projects"      : { color: "purple",  icon: "lightbulb-o",  name: trad.projects },
        "events"        : { color: "orange",  icon: "calendar",     name: trad.events },
        "vote"          : { color: "azure",   icon: "gavel",        name: "Propositions, Questions, Votes" },
        "actions"       : { color: "lightblue2", icon: "cogs",      name: "actions" },
        "cities"        : { color: "red",        icon: "university",name: trad.municipalities },
        "poi"           : { color: "green-poi",  icon: "map-marker",name: trad.pointsinterests },
        "place"           : { color: "brown",    icon: "map-marker", name: trad.pointsinterests },
        "wikidata"    : { color: "lightblue2",   icon: "group",      name: "Wikidata" },
        "datagouv"    : { color: "lightblue2",   icon: "bullhorn",   name: "DataGouv" },
        "osm"         : { color: "lightblue2",   icon: "bullhorn",   name: "Open Street Map" },
        "ods"         : { color: "lightblue2",   icon: "bullhorn",   name: "OpenDatasoft" },
        "places"      : { color: "brown",        icon: "map-marker", name: trad.places },
        "classifieds"  : { color: "azure",        icon: "bullhorn",   name: trad.classifieds },
        "GovernmentOrganization" : { color: "red",   icon: "university", name: "services publics" },
        "ressources"  : { color: "vine",   icon: "cubes",   name: "Ressource" },
        "news"        : { color: "blue-k",   icon: "newspaper-o",   name: "news" },
        "products"    : { color: "orange",   icon: "shopping-basket",   name: trad.products },
        "services"    : { color: "orange",   icon: "sun-o",   name: trad.services },
        "circuits"    : { color: "orange",   icon: "ravelry",   name: trad.circuits },
    }
    var mapColorIconTop = {
        "default" : "dark",
        "citoyen":"yellow", 
        "citoyens":"yellow", 
        "person":"yellow", 
        "people":"yellow", 
        "NGO":"green",
        "LocalBusiness" : "azure",
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
        "classified" : "azure"
    };
    var onchangeClick=true;
    var lastWindowUrl = location.hash;
    var urlBackDocs = location.hash;
    var allReadyLoadWindow=false;
    var navInSlug=false;
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
    var myScopes = {};
    
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
            initFloopDrawer();
            resizeInterface();
            initMyScopes();
            //if(typeof localStorage != "undefined" && typeof localStorage.circuit != "undefined")
              //  circuit.obj = JSON.parse(localStorage.getItem("circuit"));
            //Init mentions contact
            if(myContacts != null){
                $.each(myContacts["people"], function (key,value){
                    if(typeof(value) != "undefined" ){
                        avatar="";
                        console.log(value);
                        if(value.profilThumbImageUrl!="")
                            avatar = baseUrl+value.profilThumbImageUrl;
                        object = new Object;
                        object.id = value._id.$id;
                        object.name = value.name;
                        object.slug = value.slug;
                        object.avatar = avatar;
                        object.type = "citoyens";
                        mentionsContact.push(object);
                    }
                });
                $.each(myContacts["organizations"], function (key,value){
                    if(typeof(value) != "undefined" ){
                    avatar="";
                    if(value.profilThumbImageUrl!="")
                        avatar = baseUrl+value.profilThumbImageUrl;
                    object = new Object;
                    object.id = value._id.$id;
                    object.name = value.name;
                    object.slug = value.slug;
                    object.avatar = avatar;
                    object.type = "organizations";
                    mentionsContact.push(object);
                    }
                });
                $.each(myContacts["projects"], function (key,value){
                    if(typeof(value) != "undefined" ){
                    avatar="";
                    if(value.profilThumbImageUrl!="")
                        avatar = baseUrl+value.profilThumbImageUrl;
                    object = new Object;
                    object.id = value._id.$id;
                    object.name = value.name;
                    object.slug = value.slug;
                    object.avatar = avatar;
                    object.type = "projects";
                    mentionsContact.push(object);
                    }
                });
            }
            window.onhashchange = function() {
                mylog.warn("popstate history.state",history.state);
                if( lastWindowUrl && "onhashchange" in window){
                    console.log("history",history);
                    if( allReadyLoadWindow == false && onchangeClick){
                        lastSplit=lastWindowUrl.split(".");
                        currentSplit=location.hash.split(".");    
                        if(navInSlug || lastWindowUrl.indexOf("#page")>=0 && location.hash.indexOf("#page")>=0){
                            if(navInSlug){
                                if(lastSplit[0]==currentSplit[0]){
                                    if(location.hash.indexOf("view")>=0){
                                        dir="";
                                        if(typeof currentSplit[4] != "undefined")
                                            dir=currentSplit[4];

                                        if(currentSplit[2] != "coop")
                                        getProfilSubview(currentSplit[2],dir);
                                    }
                                    else
                                        getProfilSubview("");

                                }else
                                    urlCtrl.loadByHash(location.hash,true);
                            }else{
                                if(lastSplit[2]==currentSplit[2] && lastSplit[4]==currentSplit[4]){
                                    if(location.hash.indexOf("view")>=0){
                                        dir="";
                                        if(typeof currentSplit[8] != "undefined")
                                            dir=currentSplit[8];

                                        if(currentSplit[6] != "coop")
                                        getProfilSubview(currentSplit[6],dir);
                                    }
                                    else
                                        getProfilSubview("");

                                }else
                                    urlCtrl.loadByHash(location.hash,true);
                            }
                        }else if(lastWindowUrl.indexOf("#admin")>=0 && location.hash.indexOf("#admin")>=0){
                           if(lastSplit[0]==currentSplit[0]){
                                if(location.hash.indexOf("view")>=0){
                                    getAdminSubview(currentSplit[2]);
                                }
                                else
                                    getAdminSubview("");

                            }else
                                urlCtrl.loadByHash(location.hash,true);
                        }else if(lastWindowUrl.indexOf("#docs")>=0 && location.hash.indexOf("#docs")>=0){
                           if(lastSplit[0]==currentSplit[0]){
                                page = (location.hash.indexOf("page")>=0) ? currentSplit[2] : "welcome";
                                dir = (location.hash.indexOf("dir")>=0) ? currentSplit[4] : mainLanguage;
                                navInDocs(page, dir);
                            }else
                                urlCtrl.loadByHash(location.hash,true);
                        }else{
                            urlCtrl.loadByHash(location.hash,true);
                        }
                    } 
                    allReadyLoadWindow = false;
                    onchangeClick=true;
                }
                urlBackDocs=lastWindowUrl;
                lastWindowUrl = location.hash;
            }
        },
        firstLoad:true,
        imgLoad : "CO2r.png" ,
        mainContainer : ".main-container",
        blockUi : {
            processingMsg :'<div class="lds-css ng-scope">'+
                    '<div style="width:100%;height:100%" class="lds-dual-ring">'+
                        '<img src="'+themeUrl+'/assets/img/LOGOS/'+domainName+'/logo.png" class="" height=80>'+
                        '<div></div>'+
                        '<div></div>'+
                    '</div>'+
                '</div>', 
            errorMsg : '<img src="'+themeUrl+'/assets/img/LOGOS/'+domainName+'/logo.png" class="logo-menutop" height=80>'+
              '<i class="fa fa-times"></i><br>'+
               '<span class="col-md-12 text-center font-blackoutM text-left">'+
                '<span class="letter letter-red font-blackoutT" style="font-size:40px;">404</span>'+
               '</span>'+

              '<h4 style="font-weight:300" class=" text-dark padding-10">'+
                'Oups ! Une erreur s\'est produite'+
              '</h4>'+
              '<span style="font-weight:300" class=" text-dark">'+
                'Vous allez être redirigé vers la page d\'accueil'+
              '</span>'
        },
        dynForm : {
            onLoadPanel : function (elementObj) { 
                //console.log("onLoadPanel currentKFormType", currentKFormType);
                mylog.log("elementObj",elementObj);
                var typeName = (typeof currentKFormType != "undefined" && currentKFormType!=null && currentKFormType!="") ? 
                    trad["add"+currentKFormType] : elementObj.dynForm.jsonSchema.title;
                var typeIcon = (typeof currentKFormType != "undefined" && currentKFormType!=null && currentKFormType!="") ? dyFInputs.get(currentKFormType).icon : elementObj.dynForm.jsonSchema.icon;

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
                /***************
                **TODO BOUBOULE QUESTION ---- WHYYYYYYY THAT ?????
                if(typeof currentKFormType != "undefined")
                    $("#ajaxFormModal #type").val(currentKFormType); **/
            }
        }
    };

function initMyScopes(){
    //if(typeof localStorage != "undefined" && typeof localStorage.myScopes != "undefined" && typeof localStorage.userId != "undefined"){ 
    //var myScopes={};
    if( notNull(localStorage) && notNull(localStorage.myScopes) )
        myScopes = JSON.parse(localStorage.getItem("myScopes"));

    if( notNull(myScopes) && myScopes.userId == userId )  {
        myScopes.open={};
        myScopes.search = {};
        myScopes.openNews={};
        if(myScopes.multiscopes==null)
            myScopes.multiscopes={};
        console.log("init scope", myScopes);
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
        console.log("init scope", myScopes);
        localStorage.setItem("myScopes",JSON.stringify(myScopes));
    }
    //return myScopes;
}

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
    expireAllCookies('communexionActivated', ['/','/ph', '/ph/co2', 'co2']);
    expireAllCookies('inseeCommunexion', ['/','/ph', '/ph/co2', 'co2']);
    expireAllCookies('cpCommunexion', ['/','/ph', '/ph/co2', 'co2']);
    expireAllCookies('cityNameCommunexion', ['/','/ph', '/ph/co2', 'co2']);
    expireAllCookies('communexionType', ['/','/ph', '/ph/co2', 'co2']);
    expireAllCookies('communexionValue', ['/','/ph', '/ph/co2', 'co2']);
    expireAllCookies('communexionName', ['/','/ph', '/ph/co2', 'co2']);
    expireAllCookies('communexionLevel', ['/','/ph', '/ph/co2', 'co2']);
    expireAllCookies('multiscopes', ['/','/ph', '/ph/co2', 'co2']);
    expireAllCookies('communexion', ['/','/ph', '/ph/co2', 'co2']);
}

removeCookies();
</script>