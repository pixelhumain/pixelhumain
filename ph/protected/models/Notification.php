<?php
class Notification 
{ 
    
    // A Citizen Notificaiton is saved in the Citizen Collection
    public static function saveCitizenNotification($params) {
        // TODO : je comprends pas comment le citoyen en cours est positionné dans la requete ?
        Yii::app()->mongodb->citoyens->update(array("_id" => new MongoId($params['notifyUser'])), 
                                                  array('$push' => array( Citoyen::NODE_NOTIFICATIONS => $notification )));
    }

    // An Admin Notification is saved in the Notifications collection
    public static function saveAdministratorNotification($params) {
        Yii::app()->mongodb->notifications->insert($params); 
    }
}