<?php
class GetPeopleBy extends CAction
{
    public function run()
    {
       if( isset( $_POST["name"] ) ){
            $group = Yii::app()->mongodb->groups->findOne ( array( "name" => $_POST["name"] ) );
            $users = Yii::app()->mongodb->citoyens->find ( array( Citoyen::$types2Nodes[$group["type"]] => (string)$group['_id']) );
        } else if( isset( $_POST["cp"] ) ){
            $users = Yii::app()->mongodb->citoyens->find ( array( "cp" => $_POST["cp"] ) );
        } else if( isset( $_POST["app"] ) ){
            $users = Yii::app()->mongodb->citoyens->find ( array( "applications.".$_POST["app"].".usertype" => $_POST["app"] ) );
        }
        Rest::json( iterator_to_array($users) );
        Yii::app()->end();
    }
}