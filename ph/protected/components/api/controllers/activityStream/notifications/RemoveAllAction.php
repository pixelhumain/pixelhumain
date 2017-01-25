<?php
/**
 * a notification has been read by a user
 * remove it's entry in the notify node on an activity Stream for the current user
 * @return [json] 
 */
class RemoveAllAction extends CAction
{
    public function run()
    {
        $res = array();
        if( Yii::app()->session["userId"] )
        {
            $res = ActivityStream::removeNotificationsByUser();
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
            
        Rest::json($res);  
        Yii::app()->end();
    }
}