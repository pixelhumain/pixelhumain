<?php
/**
 * [actionGetWatcher get the user data based on his id]
 * @param  [string] $email   email connected to the citizen account
 * @return [type] [description]
 */
class GetUserAction extends CAction
{
    public function run($email)
    {
        $user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) );
        Rest::json( $user );
        Yii::app()->end();
    }
}