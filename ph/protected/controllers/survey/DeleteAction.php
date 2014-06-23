<?php
class DeleteAction extends CAction
{
    public function run()
    {
        $res = Survey::deleteEntry( $_POST );
        Rest::json( $res );
        Yii::app()->end();
    }
    
}