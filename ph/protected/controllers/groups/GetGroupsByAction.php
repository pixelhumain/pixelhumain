<?php
class GetGroupsByAction extends CAction
{
    public function run($count=null,$filter="")
    {
        $where = array();
        $filter = ( $filter != "" ) ? explode(",", $filter) : array();
        if( isset( $_POST["name"] ) ){
            $where = array( "name" => $_POST["name"] ) ;
        } else if( isset( $_POST["email"] ) ){
            $where = array( "email" => $_POST["email"] ) ;
        }else if( isset( $_POST["cp"] ) ){
            $where = array( "cp" => $_POST["cp"] );
        } else if( isset( $_POST["app"] )){
            $groupType = (isset($_POST["groupType"])) ? $_POST["groupType"] : new MongoRegex("/.*/") ;
            $where = array( "applications.".$_POST["app"].".usertype" => $groupType );
        }

        if(!$count)
            $res = iterator_to_array(Yii::app()->mongodb->groups->find ( $where,$filter ));
        else
            $res = array('count' => Yii::app()->mongodb->groups->count ( $where,$filter ));
        Rest::json( $res );
        Yii::app()->end();
    }
}