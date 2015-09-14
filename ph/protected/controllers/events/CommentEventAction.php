<?php
/*
- validate Ajax request
- check refred email user exists
- set group specific information
- add application / module specific information 
- insert or update group
- TODO : confirmation email / notification
 */
class CommentEventAction extends CAction
{
	public function run()
	{
		$event = $_POST['event'];
		$userId = $_POST['userId'];
		$comment = $_POST['comment'];
		
		$citoyen = PHDB::findOne(PHType::TYPE_CITOYEN,array( "_id" => new MongoId($userId) ) );
		
		if( $citoyen !== ''){
				//new comment is creating  
                $newInfos = array(
							"@Ttpe"=>  "Comment",
							"@context"=>  "http://schema.org",
							'created' => date("m/d/Y H:i:s"),
							'approve' => 0,
						);
					$newInfos['event'] = $_POST['event'];
					$newInfos['userId'] = $_POST['userId'];
                    $newInfos['comment'] = $_POST['comment'];
				
			PHDB::insert(PHType::TYPE_COMMENTS,$newInfos);
		
			$res = array("result" => true, 'msg'=>'Vous avez déjà soumis Vote');
		}
		else{
			$res = array("result" => false, 'msg'=>'Quelque chose se est mal passé');
		}
		Rest::json( $res );
		Yii::app()->end();
	}
}