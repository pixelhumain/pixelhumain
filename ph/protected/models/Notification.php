<?php

class Notification
{
    const NOTIFICATION_LOGIN	   = "citizenLogin";
    const NOTIFICATION_REGISTER	   = "citizenRegister";
    const NOTIFICATION_ACTIVATED	   = "citizenActivated";
    const NOTIFICATION_INVITATION	   = "citizenInvitation";
    
    const NOTIFICATION_SWE_COACH_REQUEST	   = "startUpWeekendCoachRequest";
    
    public static function add($params){
        $params["created"] = time();
        Yii::app()->mongodb->notifications->insert($params); 
    }
    
}