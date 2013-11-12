<?php

class Citoyen
{
    const GAME_REZOTAGE	   = 10;
    
    public static function isCommunected(){
        $user = Yii::app()->mongodb->citoyens->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"]))); 
        return (isset($user["cp"])) ? $user["cp"] : null;
    }
    public static function isAdminUser(){
        return ( isset(Yii::app()->session["userIsAdmin"]) && Yii::app()->session["userIsAdmin"] ) ;  
    }
}