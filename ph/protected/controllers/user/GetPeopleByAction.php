<?php
/*
Gets all users corresponding to a certain request
- set the where clause according to POST parameters
- a filter can be added to the selection clause, in order to retreive only certain fields from DB
 */
class GetPeopleByAction extends CAction
{
    public function run($count=null,$filter="")
    {

        $where = array();
        $filter = ( $filter != "" ) ? explode(",", $filter) : array();

        if( isset( $_POST["groupname"] ) ){
            $group = Yii::app()->mongodb->groups->findOne ( array( "name" => $_POST["name"] ) );
            $where = array( Citoyen::$types2Nodes[$group["type"]] => (string)$group['_id']);
        } else if( isset( $_POST["cp"] ) ){
            $where = array( "cp" => $_POST["cp"] );
        } else if( isset( $_POST["app"] ) ){
            $where  = array( "applications.".$_POST["app"].".usertype" => $_POST["app"] );
        }

        if(!$count)
            $res = iterator_to_array(Yii::app()->mongodb->citoyens->find ( $where,$filter ));
        else
            $res = array('count' => Yii::app()->mongodb->citoyens->count ( $where,$filter ));

        Rest::json( $res );
        Yii::app()->end();
    }
}