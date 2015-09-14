<?php
/**
 * [actionAddWatcher 
 * create or update a user account
 * if the email doesn't exist creates a new citizens with corresponding data 
 * else simply adds the watcher app the users profile ]
 * @return [json] 
 */
class DeleteEventAction extends CAction
{
    public function run()
    {
		$id = $_POST["event"];
	   
		if( $event = PHDB::findOne( PHType::TYPE_EVENTS, array( "_id" => new MongoId( $id ) ) ) )
            { 
            PHDB::remove(PHType::TYPE_EVENTS,array("_id"=> new MongoId($id)));
			$res = array('result' => true , 'msg'=>'Event Deleted');
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong' , 'event'=>$id);
            
        Rest::json($res);  
        Yii::app()->end();
    }
 	    
}