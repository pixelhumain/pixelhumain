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
			"desc"=>"an email and Postal Code is all a user needs to connect to his city",
			"actions"=>array('communect' => 'application.controllers.user.CommunectAction')),
		"login" => array( "label"=>"Login", "key"=>"login", 
			"desc"=>"classic login feature email + pwd",
        	"actions"=>array('login' => 'application.controllers.user.LoginAction',
        					 'sendemailpwd' => 'application.controllers.user.SendEmailPwdAction',)),
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
        
        /* -----------------------------------------------
        PROJECT Section
         ------------------------------------------------ */
        "saveProject" => array( "label"=>"Save Project", "key"=>"saveProject",
            "desc"=>"save a Project or an entity ",
            "actions"=>array('saveproject'=> 'application.components.api.controllers.projects.SaveAction')),
        

        /* -----------------------------------------------
		GENERIC Section
		 ------------------------------------------------ */
        "getby" => array( "label"=>"get a Node By","key"=>"getby", "parent"=>"generic",
        		"desc"=>"get a Node from an entry corresponding to a certain criteria",
        		"actions"=>array('getby' => 'application.controllers.generic.GetByAction')),

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
        	"actions"=>array('initdata' => 'application.components.api.controllers.InitDataAction',))
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
                    ));
	}
	public static function getGroupMap(){
		return array('label' => "Groups", "key"=>"groups","iconClass"=>"fa fa-group","generate"=>true,
                "children"=> array(
                    self::$apis["saveGroup"],
                    self::$apis["getgroupsby"]
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
                ));	
	}
    public static function getProjectMap(){
        return array( 'label' => "Project", "key"=>"projects", "iconClass"=>"fa fa-list", "generate"=>true,
                "children"=> array(
                    self::$apis["saveProject"]
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