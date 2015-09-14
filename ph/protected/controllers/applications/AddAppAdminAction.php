<?php
/**
 * [add admin credentials to an application, 
 * the user submitting must be an admin himself of the same application
 * the user receiving the rights must at least be a user of the application
 * this add citoyens.applications.appKey.isAdmin : true
 * also adds the user to the application admin collection
 * ]
 * @param  [string] $email   email connected to the citizen account
 * @return [type] [description]
 */
class AddAppAdminAction extends CAction
{
    public function run()
    {
        //TODO $res = Citoyen::addNode( "applications.".$_POST['app'].".isAdmin" ,true , $_POST['id']  );
        
        //TODO update application sadmin array

        $res = array('result' => true );
        Rest::json( $res );
        Yii::app()->end();
    }
}