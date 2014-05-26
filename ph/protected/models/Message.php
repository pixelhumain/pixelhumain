<?php

class Message
{
    /*
    - check user existance for each email
    - insert into message collection with a userId array
    - the message is also stored for the connected user
    - if an application has a $app["messages"] == "mustBeConfirmed" then the new message will carry messageConfirmed property
     */
	public static function createMessage( $emails, $msg, $module=null )
	{
		//run through emails and validate existing accounts
    	$userids = array();
    	$inexistantUsers = array(); 
    	$emails = explode(",", $emails);
    	foreach ($emails as $email) 
    	{
    		//QUESTION : should we validate that a user is registered to the module
    		if($user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) ))
    			array_push($userids, (string)$user["_id"]);
    		else
    			array_push($inexistantUsers, (string)$user["_id"]);
    	}
    	//save message to DB
    	if( count($userids) )
    	{
    		array_push($userids, Yii::app()->session["userId"]);
        	$newInfos = array();
        	$newInfos['from'] = Yii::app()->session["userId"];
        	$newInfos['to'] = $userids;
        	$newInfos['msg'] = $msg;
            $newInfos['created'] = time();
            if( isset( $_POST["app"] ) )
                {
                    $appKey = $_POST["app"];
                    $newInfos['applications'] = array( $appKey => array( "usertype"=>"message" ));
                    $app = Yii::app()->mongodb->applications->findOne( array( "key"=> $appKey ) );
                    //check for application specifics defined in DBs application entry
                    if( isset( $app["messages"] ) && $app["messages"] == "mustBeConfirmed")
                        $newInfos['applications'][$appKey]["messageConfirmed"] = false;
                }

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
    /*
    get Messages according to certain parameters
    simply add a email, app to the params entry
     */
    public static function getMessagesBy($params){
        $where = (isset($params["where"])) ? $params["where"] : array();
        $fields = ( isset($params["fields"]) ) ? $params["fields"] : array();

        
       if( !isset($params["count"]) ) 
            if( isset($params["limit"]) ) 
                $res = iterator_to_array(Yii::app()->mongodb->messages->find ( $where,$fields )->limit($params["limit"]));
            else
                $res = iterator_to_array(Yii::app()->mongodb->messages->find ( $where,$fields ));
        else
            $res = array('count' => Yii::app()->mongodb->messages->count ( $where,$fields ));
        //$res["count"]=count($res);
        return $res;
    }
}
?>