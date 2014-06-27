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
	public static $userMap = array('label' => "User ", "key"=>"user", "iconClass"=>"fa fa-user","generate"=>true,
                "children"=> array(
                    array( "label"=>"se Communecter", "key"=>"communect","actions"=>array('communect' => 'application.controllers.user.CommunectAction')),
                    array( "label"=>"Login", "key"=>"login", 
                    		"actions"=>array('login' => 'application.controllers.user.LoginAction',
                    						 'sendemailpwd' => 'application.controllers.user.SendEmailPwdAction',)),
                    array( "label"=>"Save User", "key"=>"saveUser", "actions"=>array('saveuser' => 'application.controllers.user.SaveUserAction')),
                    array( "label"=>"Get User", "key"=>"getUser","actions"=>array('getuser' => 'application.controllers.user.GetUserAction')),
                    array( "label"=>"ConfirmUserRegistration"),
                    array( "label"=>"GetPeople","key"=>"getPeople","actions"=>array('getpeopleby' => 'application.controllers.user.GetPeopleByAction')),
                    array( "label"=>"InvitePeople", "key"=>"inviteUser","actions"=>array('inviteuser' => 'application.controllers.user.InviteUserAction'))
                ));

	public static $surveyMap = array('label' => "Survey", "key"=>"survey", "iconClass"=>"fa fa-thumbs-up", "generate"=>true,
                "children"=> array(
                    array( "label"=>"Create Session", "key"=>"saveSession", "actions"=>array('savesession' => 'application.controllers.survey.SaveSessionAction',  ),
                    		"desc"=>"a session is a container will contain entries and be linked to people"),
                    array( "label"=>"Add Entry", "key"=>"addEntry", "actions"=>array(),
                    		"desc"=>"an entry, is a text, law, idea, things to vote on"),
                    array( "label"=>"Vote on an Entry","key"=>"addaction",
                    		"actions"=>array('addaction' => 'application.controllers.action.AddActionAction',
                    						"getactionvalue" => 'application.controllers.generic.GetFromCollectionAction'),
                    		"desc"=>"votes help decision making and give orientations"),
                    array( "label"=>"get a Node By","key"=>"getby","actions"=>array('getby' => 'application.controllers.generic.GetByAction'),
                    		"desc"=>"get a Node from an entry corresponding to a certain criteria"),
                ));

	public static $adminMap = array('label' => "Administration", "key"=>"admin", "iconClass"=>"fa fa-cog", "generate"=>true,
                "children"=> array(
                    array( "label"=>"Moderation Settings","key"=>"moderationSettings","actions"=>array()),
                    array( "label"=>"Add an admin","key"=>"addAdmin","actions"=>array('addappadmin'       => 'application.controllers.applications.AddAppAdminAction')),
                    array( "label"=>"Moderate an entry","key"=>"moderate","actions"=>array('moderateentry' => 'application.controllers.survey.ModerateAction')),
                    array( "label"=>"Delete a Survey","key"=>"deleteSurvey","actions"=>array('deletesurvey'     => 'application.controllers.survey.DeleteAction')),
                    array( "label"=>"Delete a Entry","key"=>"deleteEntry","actions"=>array('deletesurvey'     => 'application.controllers.survey.DeleteAction')),
                    array( "label"=>"Delete a User","key"=>"deleteUser","actions"=>array())
                ));

	public static $adminPHMap = array('label' => "Administration PH", "key"=>"adminPH", "iconClass"=>"fa fa-cogs", "generate"=>true,
                "children"=> array(
                    array( "label"=>"Set Admin Quartier","key"=>"adminQuartier","actions"=>array()),
                ));

	public static $communicatoinMap = array('label' => "Communication", "key"=>"communication", "iconClass"=>"fa fa-bullhorn", "generate"=>true,
                "children"=> array(
                    array( "label"=>"sendMessage","key"=>"sendMessage","actions"=>array('sendmessage' => 'application.controllers.messages.SendMessageAction'))
                ));	
}
?>