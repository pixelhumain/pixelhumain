<?php
class GetPeopleByAction extends CAction
{
    public function run($count=null)
    {
        $where = array();
        if( isset( $_POST["name"] ) ){
            $group = Yii::app()->mongodb->groups->findOne ( array( "name" => $_POST["name"] ) );
            $where = array( Citoyen::$types2Nodes[$group["type"]] => (string)$group['_id']);
        } else if( isset( $_POST["cp"] ) ){
            $where = array( "cp" => $_POST["cp"] );
            
        } else if( isset( $_POST["app"] ) ){
            $where  = array( "applications.".$_POST["app"].".usertype" => $_POST["app"] );
        }

        if(!$count)
            $res = iterator_to_array(Yii::app()->mongodb->citoyens->find ( $where ));
        else
            $res = array('count' => Yii::app()->mongodb->citoyens->count ( $where ));

        Rest::json( $res );
        Yii::app()->end();
    }
}