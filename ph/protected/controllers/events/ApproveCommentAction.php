<?php
/**
 * [actionAddWatcher 
 * create or update a user account
 * if the email doesn't exist creates a new citizens with corresponding data 
 * else simply adds the watcher app the users profile ]
 * @return [json] 
 */
class ApproveCommentAction extends CAction
{
    public function run()
    {
		$id = $_POST["comment"];
	   
		if( $comment = PHDB::findOne( PHType::TYPE_COMMENTS, array( "_id" => new MongoId( $id ) ) ) )
            { 
			PHDB::update(PHType::TYPE_COMMENTS,array("_id"=> new MongoId($id)), array('$set' => array("approve"=>1)));
			$res = array('result' => true , 'msg'=>'Comment Approved');
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong' , 'comment'=>$id);
            
        Rest::json($res);  
        Yii::app()->end();
    }
 	    
}