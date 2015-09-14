<?php
/*
- validate Ajax request
- check refred email user exists
- set group specific information
- add application / module specific information 
- insert or update group
- TODO : confirmation email / notification
 */
class VoteEventAction extends CAction
{
	public function run()
	{
		$event = $_POST['event'];
		$userId = $_POST['userId'];
		
		$votes = PHDB::findOne(PHType::TYPE_VOTES,array( "userId" => $userId, "event" => $event ) );
		
			$newInfos = array(
							"@Type"    =>  "Vote",
							"@context" =>  "http://schema.org"
						);
			if( isset($_POST['event']) )
                $newInfos['event'] = $_POST['event'];
			if( isset($_POST['userId']) )
                $newInfos['userId'] = $_POST['userId'];
			if( isset($_POST['created']) )
                $newInfos['created'] = $_POST['created'];
			
		if( $votes == ''){
			PHDB::update(PHType::TYPE_EVENTS,array("_id"=> new MongoId($event)), array('$inc' => array("voteUp"=>1)));
			PHDB::insert(PHType::TYPE_VOTES,$newInfos);
			$events = PHDB::findOne(PHType::TYPE_EVENTS,array( "_id" => new MongoId($event) ) );			
			$res = array("result" => true, "votes" => $events['voteUp']);	
		}
		elseif( $votes != ''){
		
			$res = array("result" => false, 'msg'=>'Vous avez déjà soumis Vote');
		}
		else{
			$res = array("result" => false, 'msg'=>'Quelque chose se est mal passé');
		}
		Rest::json( $res );
		Yii::app()->end();
	}
}