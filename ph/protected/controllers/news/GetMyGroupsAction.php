<?php
class GetMyGroupsAction extends CAction
{
    public function run()
    {
        $res = Group::getGroupsBy(Yii::app()->session["userEmail"]);
        Rest::json( $res );
        Yii::app()->end();
    }
    
}