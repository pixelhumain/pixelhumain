<?php
/**
 * [actionGetWatcher get the user data based on his id]
 * @param  [string] $email   email connected to the citizen account
 * @return [type] [description]
 */
class AddActionAction extends CAction
{
    public function run()
    {
        $res = Citoyen::addAction($_POST['email'] , $_POST['id'], $_POST['collection'],$_POST['action'], isset( $_POST['unset'] ) );
        Rest::json( $res );
        Yii::app()->end();
    }
}