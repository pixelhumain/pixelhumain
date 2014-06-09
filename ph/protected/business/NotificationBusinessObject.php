<?php
/*
- system notifications are saved in the notification collection
- citizen Notifications are saved in the citizen collection under the notification node
 */
class NotificationBusinessObject 
{
     /*
     * Save a certain Norification to the notification table
     * if notifyUser param is set, an entry is added to the citizen collection for the front end to pick up
     * 
     * */
     
    public static function saveNotification($params) {
        
         $params["created"] = time();
        
        if(isset($params['notifyUser'])){
            
            //TODO is this line used ?
            //set teh type of citizen notification
            if($params["type"] == NotificationType::NOTIFICATION_LINK_REQUEST)
                $notification = array( Citoyen::NOTIFICATION_FRIEND_REQUEST => $params["inviter"]);

            //insert in citoyen collection
            Notification::saveCitizenNotification($params);
            unset($params['notifyUser']);
        }

        if(self::isAdminNotificationActivated())
            Notification::saveAdminNotification($params);

    }

    //TODO - Add a parameter to activate or not the Admin Notification
    private static function isAdminNotificationActivated() {
        if(!in_array($_SERVER['SERVER_NAME'], array('127.0.0.1',"localhost"))) {
            return true;
        } else {
            return false;
        }

    }
}