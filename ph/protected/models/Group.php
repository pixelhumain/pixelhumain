<?php

class Group
{
	const TYPE_ASSOCIATION		   = 'association';
	const TYPE_ENTREPRISE		   = 'entreprise';
	const TYPE_EVENT		       = 'event';
	const TYPE_PROJECT		       = 'projet';

	//list of participants of a group contains a list of Ids
	const NODE_PARTICIPANTS		   = 'participants';
	//defines that this group is used in an application
	const NODE_APPLICATIONS        = 'applications';

	
	public static function addMember( $email, $name, $type )
	{
		$user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) );
		$group = Yii::app()->mongodb->groups->findOne( array( "name" => $name,"type"=>$type ) );
        if( $user && $group )
        {
        	//check if user is allready linked to this group
        	if( !Group::isGroupMember((string)$user["_id"],$group["_id"]) ){
        		Yii::app()->mongodb->citoyens->update(array("_id" => new MongoId($user["_id"])), array('$push' => array( Citoyen::$types2Nodes[ $type ] => (string)$group["_id"] )));
        		Yii::app()->mongodb->groups->update(array("_id" => new MongoId($group["_id"])), array('$push' => array( self::NODE_PARTICIPANTS => (string)$user["_id"])));
        		$res = array( "result" => true,  "userConnected2Group" => true );
        	}else
        		$res = array( "result" => true,  "userAllreadyConnected2Group" => true );
        } else
       		$res = array('result' => false , 'msg'=>'something somewhere went terribly wrong'); //,'u'=>$user,"g"=>$group
        return $res;
    }

    public static function removeMember( $email, $name, $type )
    {
		$user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) );
		$group = Yii::app()->mongodb->groups->findOne( array( "name" => $name,"type"=>$type ) );
        if( isset( $user ) && isset( $group ) )
        {
        	Yii::app()->mongodb->citoyens->update(array("_id" => new MongoId($user["_id"])), array('$pull' => array( Citoyen::$types2Nodes[ $type ] => (string)$group["_id"] )));
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

}
?>