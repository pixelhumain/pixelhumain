<?php

class Message
{
    /*
    - check users existant for each email
    - insert into message collection with a userId array
    - the message is stored for the connected user
     */
	public static function createMessage( $emails, $msg, $module )
	{
		//run through emails and validate existing accounts
    	$userids = array();
    	$inexistantUsers = array(); 
    	$emails = explode(",", $emails);
    	foreach ($emails as $email) 
    	{
    		//QUESTION : should we validate that a user is registered to the module
    		if($user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) ))
    			array_push($userids, $user["_id"]);
    		else
    			array_push($inexistantUsers, $user["_id"]);
    	}
    	//save message to DB
    	if( count($userids) )
    	{
    		array_push($userids, Yii::app()->session["userId"]);
        	$newInfos = array();
        	$newInfos['from'] = Yii::app()->session["userId"];
        	$newInfos['to'] = $userids;
        	$newInfos['msg'] = $msg;
        	Yii::app()->mongodb->messages->insert( $newInfos);
        	$res = array("result" => true, 
                      	 "msg" => "message send to ".count($userids)." users" );
        	if( count($inexistantUsers) )
        		$res["error"] = count($inexistantUsers)." user doesn't have a PH account.";
        } else
        	$res = array("result" => false, 
                      	 "msg"   => "no valid user accounts " );
    
        return $res;
    }
}
?>