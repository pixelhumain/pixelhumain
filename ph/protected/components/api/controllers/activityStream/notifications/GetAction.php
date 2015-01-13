<?php
/**
 * a notification has been read by a user
 * remove it's entry in the notify node on an activity Stream for the current user
 * @return [json] 
 */
class GetAction extends CAction
{
    public function run()
    {
        $res = array();
        if( Yii::app()->session["userId"] )
        {
        	$params = array("notify.id"=>Yii::app()->session["userId"]);
            if( isset($_GET["ts"])) 
            	$params["timestamp"] = array('$gt'=>(int)$_GET["ts"]);

            $res = ActivityStream::getNotifications($params);
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
            
        Rest::json($res);  
        Yii::app()->end();
    }
}