<?php
class NotificationDAO 
{ 
    
    // A Citizen Notificaiton is saved in the Citizen Collection
    public static function saveCitizenNotification($params) {
        Yii::app()->mongodb->citoyens->update(array("_id" => new MongoId($params['notifyUser'])), 
                                                  array('$push' => array( Citoyen::NODE_NOTIFICATIONS => $notification )));
    }

    // An Admin Notification is saved in the Notifications collection
    public static function saveAdminNotification($params) {
        Yii::app()->mongodb->notifications->insert($params); 
    }
}