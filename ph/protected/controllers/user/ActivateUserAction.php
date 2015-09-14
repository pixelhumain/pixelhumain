<?php
class ActivateUserAction extends CAction
{
    public function run()
    {
        $id = $_REQUEST["id"];
		$user = Yii::app()->mongodb->citoyens->findAndModify( array("_id" => new MongoId( $id )), 
                                                              array('$set' => array("status"=>1) ) );
        //$user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) );
        Rest::json( $user );
        Yii::app()->end();
    }
}