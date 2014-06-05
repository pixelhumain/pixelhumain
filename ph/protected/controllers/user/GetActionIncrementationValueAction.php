<?php
class GetActionIncrementationValueAction extends CAction
{
    public function run()
    {
        $element = Yii::app()->mongodb->selectCollection($_POST['collection'])->findOne( array("_id" => new MongoId( $_POST['id'] ) ),array($_POST['action']));
        Rest::json( $element );
        Yii::app()->end();
    }
}