<?php
/*
- system notifications are saved in the notification collection
- citizen Notifications are saved in the citizen collection under the notification node
 */
class Notification
{
    const NOTIFICATION_LOGIN	               = "citizenLogin";
    const NOTIFICATION_REGISTER	               = "citizenRegister";
    const NOTIFICATION_COMMUNECTED             = "citizenCommunected";
    const NOTIFICATION_ACTIVATED	           = "citizenActivated";
    const NOTIFICATION_INVITATION	           = "citizenInvitation";
    const NOTIFICATION_LINK_REQUEST            = "citizenLinkRequest";
    const NOTIFICATION_LINK_CONFIRMATION       = "citizenLinkConfirmation";
    
    const ASSOCIATION_SAVED	                   = "associationSaved";
    const ENTREPRISE_SAVED	                   = "entrepriseSaved";
    const COLLECTIVITE_SAVED	               = "collectiviteSaved";
    
    const NOTIFICATION_SWE_COACH_REQUEST	   = "startUpWeekendCoachRequest";
    const NOTIFICATION_SWE_SAVED_INFOS	       = "sweSavedInfos";
    const NOTIFICATION_SWE_SAVED_FEEDBACK      = "sweSavedFeedback";
    
    const LOGIN_FACEBOOK                       = "LoginFaceBook";
    const LOGIN_TWITTER                        = "LoginTwitter";
    const LOGIN_LINKEDIN                       = "LoginLinkedIn";
    const LOGIN_GOOGLE                         = "LoginGoogle";
    
    /*
     * Save a certain Norification to the notification table
     * if notifyUser param is set, an entry is added to the citizen collection for the front end to pick up
     * 
     * */
    public static function add($params){
        $params["created"] = time();
        
        if(isset($params['notifyUser'])){
            
            //set teh type of citizen notification
            if($params["type"] == Notification::NOTIFICATION_LINK_REQUEST)
                $notification = array( Citoyen::NOTIFICATION_FRIEND_REQUEST => $params["inviter"]);

            //insert in citoyen collection
            Yii::app()->mongodb->citoyens->update(array("_id" => new MongoId($params['notifyUser'])), 
                                                  array('$push' => array( Citoyen::NODE_NOTIFICATIONS => $notification )));
            unset($params['notifyUser']);
        }

        if(!in_array($_SERVER['SERVER_NAME'], array('127.0.0.1',"localhost")))
            Yii::app()->mongodb->notifications->insert($params); 

    }

}