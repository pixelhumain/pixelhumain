<?php
/*
- system notifications are saved in the notification collection
- citizen Notifications are saved in the citizen collection under the notification node
 */
class Action
{
   /*
    - can only vote , purchase, .. once
    - check user and element existance 
    - QUESTION : should actions be application inside
     */
    public static function addAction( $email=null , $id=null, $collection=null, $action=null, $unset=false  )
    {
        $res = array("result" => false);
        //TODO : should be the loggued user
        $user = PHDB::findOne (PHType::TYPE_CITOYEN, array("email" => $email ));
        //TODO : generic not only groups
        $element = ($id) ? PHDB::findOne ($collection, array("_id" => new MongoId($id) )) : null;
        $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
        if($user && $element)
        {
            //check user hasn't allready done the action
            
            if( $unset 
                || !isset( $element[ $action ] ) 
                || ( isset( $element[ $action ] ) && !in_array( (string)$user["_id"] , $element[ $action ] ) ) )
            {
                if($unset)
                    $dbMethod = '$unset';
                else
                    $dbMethod = '$set';

                // "actions": { "groups": { "538c5918f6b95c800400083f": { "voted": "voteUp" }, "538cb7f5f6b95c80040018b1": { "voted": "voteUp" } } } }
                $map[ActionType::NODE_ACTIONS.".".$collection.".".(string)$element["_id"].".".$action ] = $action ;
                //update the user table 
                //adds or removes an action
                PHDB::update (PHType::TYPE_CITOYEN, array( "_id" => $user["_id"]), 
                                                       array( $dbMethod => $map));
                if($unset){
                    $dbMethod = '$pull';
                    //decrement when removing an action instance
                    $inc = -1;
                }
                else 
                {
                    //push unique user Ids into action node list
                    $dbMethod = '$addToSet';
                    //increment according to specifications
                    $inc = 1;
                }
                
                PHDB::update ($collection, array("_id" => new MongoId($element["_id"])), 
                                                                            array($dbMethod => array( $action => (string)$user["_id"]),
                                                                              '$inc'=>array( $action."Count" => $inc)));
                self::addActionHistory( $email , $id, $collection, $action);
                
                $res = array( "result"          => true,  
                              "userActionSaved" => true,
                              "user"            => PHDB::findOne (PHType::TYPE_CITOYEN,array("email" => $email ),array("actions")),
                              "element"         => PHDB::findOne ($collection,array("_id" => new MongoId($id) ),array( $action))
                               );
            } else
                $res = array( "result" => true,  "userAllreadyDidAction" => true );
        }
        return $res;
    }

    /*
    The Action History colelction helps build timeline and historical visualisations 
    on a given item
    in time we could also use it as a base for undoing tasks
     */
    public static function addActionHistory($email=null , $id=null, $collection=null, $action=null){
    	$currentAction = array( "who"=> $email,
                						"actionType" => $action,
                						"collection" => $collection,
                						"ojectId" => $id,
                						"created"=>time()
                					);
        PHDB::insert( PHType::TYPE_ACTION_HISTORY, $currentAction );
    }
    

}