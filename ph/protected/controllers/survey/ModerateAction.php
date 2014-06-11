<?php
class ModerateAction extends CAction
{
    public function run()
    {
        $res = Survey::moderateEntry( $_POST );
        Rest::json( $res );
        Yii::app()->end();
    }
    
}