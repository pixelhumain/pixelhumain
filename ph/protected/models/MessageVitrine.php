<?php

class MessageVitrine
{
    /*
    - check user existance for each email
    - insert into message collection with a userId array
    - the message is also stored for the connected user
    - if an application has a $app["messages"] == "mustBeConfirmed" then the new message will carry messageConfirmed property
     */
	public static function createMessage( $emails, $msg, $cp, $module=null )
	{
		//run through emails and validate existing accounts
    	$userids = array();
        $messageVit = "messagevitrine";
    	$inexistantUsers = array(); 
    	$emails = explode(",", $emails);
    	foreach ($emails as $email) 
    	{
    		//QUESTION : should we validate that a user is registered to the module
    		if($user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) )){
    			array_push($userids, (string)$user["_id"]);
    			$name = $user["name"];
    			$image= "";
    		}else{
    			array_push($inexistantUsers, (string)$user["_id"]);
    		}
    	}
    	//save message to DB
    	if( count($userids) )
    	{
        	$newInfos = array();
        	$comment = array();
        	$image = array();
        	$image["url"] ="";
        	$comment['comment'] = $msg;
        	$newInfos['name'] = $name;
        	$newInfos['comment'] = $comment;
        	$newInfos['image'] = $image;
            //$newInfos['cp'] = $cp;
            $newInfos['created'] = time();
            if( isset( $_POST["app"] ) )
                {
                    $appKey = $_POST["app"];
                    $newInfos['applications'] = array( $appKey => array( "usertype"=>"message" ));
                    $app = Yii::app()->mongodb->applications->findOne( array( "key"=> $appKey ) );
                    //check for application specifics defined in DBs application entry
                    if( isset( $app["messagesVitrine"] ) && $app["messagesVitrine"] == "mustBeConfirmed")
                        $newInfos['applications'][$appKey]["messageConfirmed"] = false;
                }

        	PHDB::insert($messageVit, $newInfos);
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
    public static function getMessagesVitBy($params){
        $where = (isset($params["where"])) ? $params["where"] : array();
        $fields = ( isset($params["fields"]) ) ? $params["fields"] : array();
        $sort=array("_id"=>-1);
        
       if( !isset($params["count"]) )

            if( isset($params["limit"]) )

            	$res == PHDB::findAndSort("messagevitrine", $fields,$sort, $params["limit"] ); 
                //$res = iterator_to_array(Yii::app()->mongodb->messagevitrine->find ( $where,$fields )->sort(array('_id' => -1))->limit($params["limit"]));
            else
                $res =  PHDB::findAndSort("messagevitrine", $fields,$sort); 
        else
            $res = array('count' => Yii::app()->mongodb->messagevitrine->count ( $where,$fields ));
        //$res["count"]=count($res);
        return $res;
    }
}
?>