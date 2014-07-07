<?php
/*
- validate Ajax request
- check refred email user exists
- set group specific information
- add application / module specific information 
- insert or update group
- TODO : confirmation email / notification
 */
class SaveEventAction extends CAction
{
    public function run()
    {
        $res = Event::save($_POST);
        Rest::json( $res );
        Yii::app()->end();
    }
}