<?php

class GetGroupsByAction extends CAction
{
    public function run($count=null,$fields="")
    {
        $where = (isset($_POST["where"])) ? $_POST["where"] : array();
        $fields = ( $fields != "" ) ? explode(",", $fields) : array();

        if( isset( $_POST["name"] ) ){
            $where["name"] = $_POST["name"] ;
        } else if( isset( $_POST["email"] ) ){
            $where["email"] = $_POST["email"]  ;
        }else if( isset( $_POST["cp"] ) ){
            $where["cp"] = $_POST["cp"] ;
        }else if( isset( $_POST["tags"] ) ){
            $where["tags"] = $_POST["tags"] ;
        } else if( isset( $_POST["app"] )){
            $groupType = (isset($_POST["groupType"])) ? $_POST["groupType"] : new MongoRegex("/.*/") ;
            $where["applications.".$_POST["app"].".usertype"] = $groupType ;
        }


        if(!$count)
            $res = iterator_to_array(Yii::app()->mongodb->groups->find ( $where,$fields ));
        else
            $res = array('count' => Yii::app()->mongodb->groups->count ( $where,$fields ));

        Rest::json( $res );
        Yii::app()->end();
    }
}