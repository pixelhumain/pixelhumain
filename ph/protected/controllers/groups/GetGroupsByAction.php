<?php
class GetGroupsByAction extends CAction
{
    public function run()
    {
        $res = Group::getGroupsBy( $_POST );
        Rest::json( $res );
        Yii::app()->end();
    }
    
}