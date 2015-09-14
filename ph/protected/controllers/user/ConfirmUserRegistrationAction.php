<?php
class ConfirmUserRegistrationAction extends CAction
{
    public function run($email,$app)
    {
        //TODO : add a test adminUser
        //isAppAdminUser
        $user = Yii::app()->mongodb->citoyens->findAndModify( array("email" => $email), 
                                                              array('$set' => array("applications.".$app.".registrationConfirmed"=>true) ) );
        $user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) );
        Rest::json( $user );
        Yii::app()->end();
    }
}