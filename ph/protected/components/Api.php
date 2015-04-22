<?php 
/**
 * Api.php
 *
 * API class containing generic maps of reusable 
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 27/06/2014
 */

class Api {
	//container of all existing api definitions
	//to be used to build maps for any module or application
	//ex : userMap is a sample composition of a standard user Map = list of methods or definitions needed to define a user process
	public static $apis = array(

		/* -----------------------------------------------
		USER Section
		 ------------------------------------------------ */
		"communect" => array( "label"=>"se Communecter", "key"=>"communect",
			"desc"=>"An email and Postal Code is all a user needs to connect to his city",
			"actions"=>array('communect' => 'application.controllers.user.CommunectAction')),
		"login" => array( "label"=>"Login", "key"=>"login", 
			"desc"=>"classic login feature email + pwd",
        	"actions"=>array('login' => 'application.controllers.user.LoginAction',
        					 'sendemailpwd' => 'application.controllers.user.SendEmailPwdAction',)),
        "saveUserRDF" => array( "label"=>"Save User", "key"=>"saveUserRDF",
            "microformat"=>"personFormRDF", 
        	"desc"=>"create a new user",
        	"actions"=>array('saveuser' => 'application.controllers.user.SaveUserAction')),
        "saveUser" => array( "label"=>"Save User", "key"=>"saveUser",
            "desc"=>"create a new user",
            "actions"=>array('saveuser' => 'application.controllers.user.SaveUserAction')),
        "getUser" => array( "label"=>"Get User", "key"=>"getUser",
        	"desc"=>"Get a user Entry by email",
        	"actions"=>array('getuser' => 'application.controllers.user.GetUserAction')),
        "getPeople" => array( "label"=>"GetPeople","key"=>"getPeople",
        	"desc"=>"get all people register as users of an application",
        	"actions"=>array('getpeopleby' => 'application.controllers.user.GetPeopleByAction')),
        "inviteUser" => array( "label"=>"Invite People", "key"=>"inviteUser",
        	"desc"=>"people networking is based on invitations",
        	"actions"=>array('inviteuser' => 'application.controllers.user.InviteUserAction')),
        "confirmUserRegistration" => array( "label"=>"Confirm User Registration","key"=>"confirmUserRegistration", "parent"=>"user",
        	"desc"=>"some applications will need user's to register their accounts",
        	"actions"=>array('confirmgroupregistration' => 'application.controllers.user.ConfirmUserRegistrationAction')),

        /* -----------------------------------------------
		GROUP Section
		 ------------------------------------------------ */
        "saveGroup" => array( "label"=>"Save Group", "key"=>"saveGroup",
        	"desc"=>"save a Group or an entity ",
        	"actions"=>array('savegroup'=> 'application.controllers.groups.SaveGroupAction')),
        "getgroupsby" => array( "label"=>"GetGroup","key"=>"getgroupsby",
        	"desc"=>"get a Group or an entity based on criterias",
        	"actions"=>array(
        		'getgroupsby' => 'application.controllers.groups.GetGroupsByAction',
        		'confirmgroupregistration' => 'application.controllers.user.ConfirmUserRegistrationAction'
        		)),
        'linkUser2Group' => array( "label"=>"Link User to a group","key"=>"linkUser2Group",
        	"desc"=>"Linking a user to a group gives him access to group rights and group credentials",
        	"actions"=>array(
        		'linkUser2Group' => 'application.controllers.groups.LinkUser2GroupAction'
        		)),

         /* -----------------------------------------------
		SIG Section
		 ------------------------------------------------ */
        "initMap" => array( "label"=>"InitMap", "key"=>"initMap",
        	"desc"=>"init the map",
        	"actions"=>array()),
        	
        "showCities" => array( "label"=>"Show Cities", "key"=>"showCities",
        	"desc"=>"show all cities on the map",
        	"actions"=>array('showcities'=> 'application.controllers.sig.ShowCitiesAction')),
        	
        "saveGeoposition" => array( "label"=>"Save Geoposition", "key"=>"saveGeoposition",
        	"desc"=>"save geoposition on every PHType in DB",
        	"actions"=>array('savegeoposition'=> 'application.controllers.sig.SaveGeopositionAction')),
        	
       	"saveGroupsGeoposition" => array( "label"=>"Save Group Geoposition", "key"=>"saveGroupsGeoposition",
        	"desc"=>"save group geoposition in DB",
        	"actions"=>array('savegroupsgeoposition'=> 'application.controllers.sig.SaveGroupsGeopositionAction',
        					 'getcpobject'=> 'application.controllers.sig.GetCpObjectAction',
        					 'getpositioncp'=> 'application.controllers.sig.GetPositionCpAction')),
        	
       	"showCitoyens" => array( "label"=>"Show citoyens clustered", "key"=>"showCitoyens",
        	"desc"=>"show every citoyens on the map",
        	"actions"=>array('showcitoyens'=> 'application.controllers.sig.ShowCitoyensAction')),
        	
        "getCommunected" => array( "label"=>"Get all citoyens communected (CP)", "key"=>"getCommunected",
        	"desc"=>"show every citoyens with CP on the map",
        	"actions"=>array('getcommunected'=> 'application.controllers.sig.GetCommunectedAction')),
        	
        "getPixelActif" => array( "label"=>"Get Pixel Actif", "key"=>"getPixelActif",
        	"desc"=>"show every Pixel Actif on the map",
        	"actions"=>array('getpixelactif'=> 'application.controllers.sig.GetPixelActifAction')),
        	
        "showRectangleArea" => array( "label"=>"Show rectangle area", "key"=>"showRectangleArea",
        	"desc"=>"show rectangle area",
        	"actions"=>array()),
        
		 "importData" => array( "label"=>"Import data", "key"=>"importData",
        	"desc"=>"Import data from json & check Citoyens geoPosition whith CP",
        	"actions"=>array('importdata'=> 'application.controllers.sig.ImportDataAction')),
        	

        /* -----------------------------------------------
        Event Section
         ------------------------------------------------ */
        "saveEvent" => array( "label"=>"Create Event", "key"=>"saveEvent", 
                "microformat"=>"eventFormRDF",
                "desc"=>"an Event is a date with something happening ",
                "actions" => array( 'saveevent' => 'application.controllers.events.SaveEventAction' )),

        /* -----------------------------------------------
		SURVEY Section
		 ------------------------------------------------ */
        "saveSession" => array( "label"=>"Create Session", "key"=>"saveSession", 
        		"desc"=>"a session is a container will contains entries and be linked to people",
        		"actions" => array( 'savesession' => 'application.controllers.survey.SaveSessionAction' )),
        "addEntry" => array( "label"=>"Add Entry", "key"=>"addEntry", 
        		"desc"=>"an entry, is a text, law, idea, things to vote on",
        		"actions"=>array()),
        "addaction" => array( "label"=>"Vote on an Entry","key"=>"addaction",
        		"desc"=>"votes help decision making and give orientations",
        		"actions"=>array('addaction' => 'application.controllers.action.AddActionAction',
        						"getactionvalue" => 'application.controllers.generic.GetFromCollectionAction')),
        "deleteSurvey" => array( "label"=>"Delete a Survey","key"=>"deleteSurvey",
        	"desc"=>"Delete a Survey and all it's children",
        	"actions"=>array('deletesurvey' => 'application.controllers.survey.DeleteAction')),
        "deleteEntry" => array( "label"=>"Delete an Entry","key"=>"deleteEntry",
        	"desc"=>"Delete a single Entry ",
        	"actions"=>array('deletesurvey' => 'application.controllers.survey.DeleteAction')),
        
        /* -----------------------------------------------
		COMMUNICATION Section
		 ------------------------------------------------ */
        "sendMessage" => array( "label"=>"Send Message","key"=>"sendMessage",
        	"desc"=>"Send a Message a preson or to a list of people",
        	"actions"=>array('sendmessage' => 'application.controllers.messages.SendMessageAction')),
        "getmessageby" => array( "label"=>"Get Message By","key"=>"getmessageby",
        	"desc"=>"Get all messages based on criterias",
        	"actions"=>array('getmessageby' => 'application.controllers.messages.GetMessageByAction',)),
        "sendMessageVitrine" => array("label"=>"Send Message Vitrine", "key" =>"sendMessageVitrine",
        	"desc"=>"Send a Message a preson or to a list of people",
        	"actions"=>array('sendmessagevitrine' => 'application.controllers.messages.SendMessageVitrineAction')),
          "getmessagevitby" => array( "label"=>"Get Message By","key"=>"getmessagevitby",
        	"desc"=>"Get all messages based on criterias",
        	"actions"=>array('getmessagevitby' => 'application.controllers.messages.GetMessageVitByAction',)),
        /* -----------------------------------------------
        PROJECT Section
         ------------------------------------------------ */
        "saveProject" => array( "label"=>"Save Project", "key"=>"saveProject",
            "desc"=>"save a Project or an entity ",
            "actions"=>array('saveproject'=> 'application.components.api.controllers.projects.SaveAction')),
        
        /* -----------------------------------------------
        NOTIFICATIONS Section
         ------------------------------------------------ */
        "markNotificationAsRead" => array( "label"=>"Mark Notification As Read", "key"=>"markNotificationAsRead",
            "desc"=>"Mark a Notification as Read and remove",
            "process"=>array(
            	"when a user clicks a notification",
            	"an ajax event is launched",
            	"get the activity Stream Entry related to the notification",
            	"remove the user Id from the notify.id array",
            	"if only one user in the array remove the notify node from the AS entry"
            ),
            "actions"=>array('marknotificationasread'=> 'application.components.api.controllers.activityStream.notifications.RemoveAction')),
        "markallnotificationasread" => array( "label"=>"Mark All Notification As Read", "key"=>"markallnotificationasread",
            "desc"=>"Mark all Notifications as Read and remove",
            "actions"=>array('markallnotificationasread'=> 'application.components.api.controllers.activityStream.notifications.RemoveAllAction')),
        "getNotifications" => array( "label"=>"Get Notifications", "key"=>"getNotifications",
            "desc"=>"Get Notifications",
            "actions"=>array('getnotifications'=> 'application.components.api.controllers.activityStream.notifications.GetAction')),

       	/* -----------------------------------------------
        NEWS Section
         ------------------------------------------------ */
        "formCreateNews" => array( "label"=>"Form Create News", "key"=>"formCreateNews",
            "desc"=>"form to create a News ",
            "actions"=>array('savenews'=> 'application.controllers.news.SaveNewsAction')),
        "newsStream" => array( "label"=>"News Stream", "key"=>"newsStream",
            "desc"=>"stream of latest News send for me",
            "actions"=>array('getnewsstream'=> 'application.controllers.news.getNewsStreamAction')),
        

        /* -----------------------------------------------
		GENERIC Section
		 ------------------------------------------------ */
        "getby" => array( "label"=>"get a Node By","key"=>"getby", "parent"=>"generic",
        		"desc"=>"get a Node from an entry corresponding to a certain criteria",
        		"actions"=>array('getby' => 'application.controllers.generic.GetByAction')),
        "image" => array( "label"=>"Image","key"=>"image", "parent"=>"generic",
                "desc"=>"add an image to any element and upload it"),
        /* -----------------------------------------------
		ADMIN Section (these methods are only accessible by initialy defined APP ADMIN USER)
		 ------------------------------------------------ */
        "moderationSettings" => array( "label"=>"Moderation Settings","key"=>"moderationSettings",
        	"desc"=>"Modify and Manage an applications moderation settings",
        	"actions"=>array()),
        "addAdmin" => array( "label"=>"Add an admin","key"=>"addAdmin",
        	"desc"=>"Give admin credentials to a user",
        	"actions"=>array('addappadmin' => 'application.controllers.applications.AddAppAdminAction')),
        "moderate" => array( "label"=>"Moderate an entry","key"=>"moderate",
        	"desc"=>"Moderate an entry for an application",
        	"actions"=>array('moderateentry' => 'application.controllers.survey.ModerateAction')),
        "deleteUser" => array( "label"=>"Delete a User","key"=>"deleteUser",
        	"desc"=>"Delete a User's access to an app",
        	"actions"=>array()),

        /* -----------------------------------------------
		ADMIN PH Section (these methods are only accessible by initialy defined PH ADMIN USER)
		 ------------------------------------------------ */
        "initData" => array( "label"=>"Data Initialising","key"=>"initData",
        	"desc"=>"Imports a list of files in the 'data' folder, containing the datasets to get this module up and running",
        	"actions"=>array('initdata' => 'application.components.api.controllers.InitDataAction',)),
        
        /* -----------------------------------------------
        Open Data Section
         ------------------------------------------------ */
        "openData" => array( "label"=>"Open Data","key"=>"openData",
            "desc"=>"All the open data used like countries, cities...",
            "actions"=>array('getcountries' => 'application.components.api.controllers.openData.GetCountriesAction',
                             'getcitiesbypostalcode' => 'application.components.api.controllers.openData.GetCitiesByPostalCodeAction',)),
	);

	public static function getUserMap(){
		return array( 'label' => "User ", "key"=>"user", "iconClass"=>"fa fa-user","generate"=>true,
                "children"=> array(
                    self::$apis["communect"],
                    self::$apis["login"],
                    self::$apis["saveUser"],
                    self::$apis["getUser"],
                    self::$apis["getPeople"],                    
                    self::$apis["inviteUser"],
                    //self::$apis["image"],
                    ));
	}
	public static function getGroupMap(){
		return array('label' => "Groups", "key"=>"groups","iconClass"=>"fa fa-group","generate"=>true,
                "children"=> array(
                    self::$apis["saveGroup"],
                    self::$apis["getgroupsby"]
                    ));
	}
    public static function getEventMap(){
        return array('label' => "Events", "key"=>"event","iconClass"=>"fa fa-calendar","generate"=>true,
                "children"=> array(
                    self::$apis["saveEvent"],
                    self::$apis["getby"],
                    ));
    }
	public static function getSurveyMap(){
		return array( 'label' => "Survey", "key"=>"survey", "iconClass"=>"fa fa-thumbs-up", "generate"=>true,
                "children"=> array(
                    self::$apis["saveSession"],
                    self::$apis["addAdmin"],
                    self::$apis["addaction"],
                    self::$apis["getby"],
                ));
	}
	public static function getAdminMap(){
		return array( 'label' => "Administration", "key"=>"admin", "iconClass"=>"fa fa-cog", "generate"=>true,
                "children"=> array(
                    self::$apis["moderationSettings"],
                    self::$apis["addEntry"],
                    self::$apis["moderate"],
                    self::$apis["deleteUser"],
                    self::$apis["deleteSurvey"],
                    self::$apis["deleteEntry"]
                ));
	}
	public static function getAdminPHMap(){
		return array( 'label' => "Administration PH", "key"=>"adminPH", "iconClass"=>"fa fa-cogs", "generate"=>true,
                "children"=> array(
                    self::$apis["initData"]
                ));
	}
	public static function getCommunicationMap(){
		return array( 'label' => "Communication", "key"=>"communication", "iconClass"=>"fa fa-bullhorn", "generate"=>true,
                "children"=> array(
                    self::$apis["sendMessage"],
                    self::$apis["getmessageby"],
                    self::$apis["sendMessageVitrine"],
                    self::$apis["getmessagevitby"],
                ));	
	}
    public static function getProjectMap(){
        return array( 'label' => "Project", "key"=>"projects", "iconClass"=>"fa fa-list", "generate"=>true,
                "children"=> array(
                    self::$apis["saveProject"]
                )); 
    }
    public static function getNotificationActions(){
        return array( 'label' => "Notification", "key"=>"notifications", "iconClass"=>"fa fa-info", "generate"=>true,
                      "children"=> array(
                        self::$apis[ "markNotificationAsRead" ] ,
                        self::$apis[ "markallnotificationasread" ] ,
                        self::$apis[ "getNotifications" ] ,
                    )); 
    }
	public static function getSigMap(){
        return array( 'label' => "Sig", "key"=>"sig", "iconClass"=>"fa fa-list", "generate"=>true,
                "children"=> array(
                    self::$apis["initMap"],
                    self::$apis["saveGeoposition"],
                    self::$apis["saveGroupsGeoposition"],
                    self::$apis["showCities"],
                    self::$apis["getCommunected"],
                    self::$apis["getPixelActif"],
                    self::$apis["showCitoyens"],
                    self::$apis["showRectangleArea"],
                    self::$apis["importData"]
                                       
                )); 
    }
	public static function getNewsMap(){
        return array( 'label' => "News", "key"=>"news", "iconClass"=>"fa fa-list", "generate"=>true,
                "children"=> array(
                    self::$apis["formCreateNews"],
                	self::$apis["newsStream"]
                	
                )); 
    }
	public static function buildActionMap( $context ){
		//index is the main page of all api interfaces
		$actions = array( 
			'index' => 'application.components.api.controllers.IndexAction',
		);
		//array_push(Yii::app()->controller->sidebar1, Api::getAdminPHMap());
		array_push($context, Api::getAdminPHMap());

        //the context is buildin the sidemenu1 object and can contain a map of needed action controllers
        foreach ($context as  $e) 
        { 
            if(isset($e["children"]))
            {
                foreach ($e["children"] as $key => $child) 
                {
                    if( isset($child["actions"]) )
                    {
                        foreach ($child["actions"] as $k => $v) 
                        {
                            $actions[$k] = $v;
                            //echo $k."<br/>";
                        }
                    }
                }
            }
        }
        return $actions;
	}
}
?>