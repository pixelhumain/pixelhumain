<?php

class Group
{
	const TYPE_ASSOCIATION		   = 'association';
	const TYPE_ENTREPRISE		   = 'entreprise';
	const TYPE_EVENT		       = 'event';
	const TYPE_PROJECT		       = 'projet';
    const ACTION_VOTE_UP        = "voteUp";
	//list of participants of a group contains a list of Ids
	const NODE_PARTICIPANTS		   = 'participants';
	//defines that this group is used in an application
	const NODE_APPLICATIONS        = 'applications';

	/*
    - check : user and group must exist
    - check if user isn't allready connected
    - add link both in group entry as participant and citizen  
     */
	public static function addMember( $email, $name, $type )
	{
		$user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) );
		$group = Yii::app()->mongodb->groups->findOne( array( "name" => $name,"type"=>$type ) );
        if( $user && $group )
        {
        	//check if user is allready linked to this group
        	if( !Group::isGroupMember((string)$user["_id"],$group["_id"]) ){
        		Yii::app()->mongodb->citoyens->update(array("_id" => new MongoId($user["_id"])), array('$push' => array( CitoyenType::$types2Nodes[ $type ] => (string)$group["_id"] )));
        		Yii::app()->mongodb->groups->update(array("_id" => new MongoId($group["_id"])), array('$push' => array( self::NODE_PARTICIPANTS => (string)$user["_id"])));
        		$res = array( "result" => true,  "userConnected2Group" => true );
        	}else
        		$res = array( "result" => true,  "userAllreadyConnected2Group" => true );
        } else
       		$res = array('result' => false , 'msg'=>'User and group must exist'); //,'u'=>$user,"g"=>$group
        return $res;
    }

    public static function removeMember( $email, $name, $type )
    {
		$user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) );
		$group = Yii::app()->mongodb->groups->findOne( array( "name" => $name,"type"=>$type ) );
        if( isset( $user ) && isset( $group ) )
        {
        	Yii::app()->mongodb->citoyens->update(array("_id" => new MongoId($user["_id"])), array('$pull' => array( CitoyenType::$types2Nodes[ $type ] => (string)$group["_id"] )));
        	Yii::app()->mongodb->groups->update(array("_id" => new MongoId($group["_id"])), array('$pull' => array( self::NODE_PARTICIPANTS => (string)$user["_id"])));
        	$res = array( "result" => true,  "userDisonnected2Group" => true );
        } else
       		$res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
        return $res;
    }

    public static function isGroupMember($userId, $groupId) 
    {
    	$group = Yii::app()->mongodb->groups->findOne( array("_id" => new MongoId($groupId), self::NODE_PARTICIPANTS => $userId  ) );
     	return   $group;
    }
    /*
    - where can be like this array('$or'=>array( array("tags"=>"social"), array("tags"=>"recherche")))
     */
    public static function getGroupsBy( $params ){
        $where = (isset($params["where"])) ? $params["where"] : array();
        $fields = ( isset($params["fields"]) ) ? $params["fields"] : array();

        if( isset( $params["name"] ) ) {
            $where["name"] = $params["name"] ;
        } else if( isset( $params["email"] ) ) {
            $where["email"] = $params["email"]  ;
        }else if( isset( $params["cp"] ) ) {
            $where["cp"] = $params["cp"] ;
        }else if( isset( $params["tags"] ) ) {
            if(isset($params["tags"]['$or']))
                $where['$or'] = $params["tags"]['$or'] ; //TODO : foreach et mettre ajouté REgEx
            else    
                $where["tags"] = $params["tags"] ;
        } else if( isset( $params["app"] )) {
            $groupType = (isset($params["groupType"])) ? $params["groupType"] : new MongoRegex("/.*/") ;
            $where["applications.".$params["app"].".usertype"] = $groupType ;
        }

       if( !isset($params["count"]) ) 
            $res = iterator_to_array(Yii::app()->mongodb->groups->find ( $where,$fields ));
        else
            $res = array('count' => Yii::app()->mongodb->groups->count ( $where,$fields ));
        //var_dump($where);
        return $res;
    }
}
?>