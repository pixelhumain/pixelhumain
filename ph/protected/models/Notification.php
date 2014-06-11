<?php
/*
- system notifications are saved in the notification collection
- citizen Notifications are saved in the citizen collection under the notification node
 */
class Notification 
{

    private $notificationDAO;
    
    public function __construct() {
        $this->notificationDAO = new NotificationDAO();
    }

     /*
     * Save a certain Notification to the notification table
     * if notifyUser param is set, an entry is added to the citizen collection for the front end to pick up
     * 
     * */

    public static function saveNotification($params) {
        
         $params["created"] = time();
        
        if(isset($params['notifyUser'])){
            
            //insert in citoyen collection
            Notification::saveCitizenNotification($params);
            unset($params['notifyUser']);
        }

        if(self::isAdminNotificationActivated())
            Notification::saveAdminNotification($params);

    }

    //The administrators are notified if the parameter 'adminNotification' is set in the phConfig.php file
    private static function isAdminNotificationActivated() {
        if(Yii::app()->params[$adminNotification] == "true") {
            return true;
        } else {
            return false;
        }

    }
}