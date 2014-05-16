<?php
class GetGroupsByAction extends CAction
{
    public function run()
    {
       if( isset( $_POST["name"] ) ){
            $groups = Yii::app()->mongodb->groups->findOne ( array( "name" => $_POST["name"] ) );
        } else if( isset( $_POST["email"] ) ){
            $groups = iterator_to_array(Yii::app()->mongodb->groups->find ( array( "email" => $_POST["email"] ) ));
        }else if( isset( $_POST["cp"] ) ){
            $groups = iterator_to_array(Yii::app()->mongodb->groups->find ( array( "cp" => $_POST["cp"] ) ));
        } else if( isset( $_POST["app"] )){
            $groupType = (isset($_POST["groupType"])) ? $_POST["groupType"] : new MongoRegex("/.*/") ;
            $groups = iterator_to_array(Yii::app()->mongodb->groups->find ( array( "applications.".$_POST["app"].".usertype" => $groupType ) ));
        }
        Rest::json( $groups );
        Yii::app()->end();
    }
}