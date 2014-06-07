<?php
/*
- system notifications are saved in the notification collection
- citizen Notifications are saved in the citizen collection under the notification node
 */
class Action
{

    const NODE_ACTIONS          = "actions";

    const ACTION_VOTE_UP        = "voteUp";
    const ACTION_VOTE_DOWN      = "voteDown";
    const ACTION_VOTE_ABSTAIN   = "voteAbstain";
    //const ACTION_VOTE_BLOCK     = "voteBlock";
    const ACTION_PURCHASE       = "purchase";
    /*const ACTION_INFORM = "inform";
    const ACTION_ASK_EXPERTISE = "expertiseRequest";*/
    const ACTION_COMMENT = "comment";
    const ACTION_FOLLOW = "follow";

    public static $action2Nodes = array( self::ACTION_VOTE_UP        => array("value"=>1),
                                         self::ACTION_VOTE_DOWN      => array("value"=>-1),
                                         self::ACTION_VOTE_ABSTAIN   => array("value"=>0),
                                         //self::ACTION_VOTE_BLOCK     => array("node"=>"voted","value"=>-2),
                                         self::ACTION_PURCHASE       => array("value"=>1),
                                         /*self::ACTION_INFORM         => "informed",
                                         self::ACTION_REQUEST_EXPERTISE  => "request",*/
                                         self::ACTION_COMMENT  => array("value"=>1),
                                         self::ACTION_FOLLOW  => array("value"=>1),
                                        );
    
   /*
    - can only vote , purchase, .. once
    - check user and element existance 
    - QUESTION : should actions be application inside
     */
    public static function addAction( $email=null , $id=null, $collection=null, $action=null, $unset=false  )
    {
        $res = array("result" => false);
        //TODO : should be the loggued user
        $user = Yii::app()->mongodb->citoyens->findOne( array("email" => $email ));
        //TODO : generic not only groups
        $element = ($id) ? Yii::app()->mongodb->selectCollection($collection)->findOne( array("_id" => new MongoId($id) )) : null;
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
                $map[self::NODE_ACTIONS.".".$collection.".".(string)$element["_id"].".".$action ] = $action ;
                //update the user table 
                //adds or removes an action
                Yii::app()->mongodb->citoyens->update( array( "_id" => $user["_id"]), 
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
                    $inc = self::$action2Nodes[ $action ]["value"];
                }
                
                Yii::app()->mongodb->selectCollection($collection)->update( array("_id" => new MongoId($element["_id"])), 
                                                                            array($dbMethod => array( $action => (string)$user["_id"]),
                                                                              '$inc'=>array( $action."Count" => $inc)));
                self::addActionHistory( $email , $id, $collection, $action);
                
                $res = array( "result"          => true,  
                              "userActionSaved" => true,
                              "user"            => $user = Yii::app()->mongodb->citoyens->findOne( array("email" => $email ),array("actions")),
                              "element"         => Yii::app()->mongodb->selectCollection($collection)->findOne( array("_id" => new MongoId($id) ),array( $action))
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
        Yii::app()->mongodb->actionHistory->insert( $currentAction );
    }
    

}