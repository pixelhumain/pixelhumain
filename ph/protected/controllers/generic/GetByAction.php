<?php
class GetByAction extends CAction
{
    public function run()
    {
        $params =  $_POST;
        $where = (isset($params["where"])) ? $params["where"] : array();
        $fields = ( isset($params["fields"]) ) ? $params["fields"] : "";

        if( !isset($params["count"]) ) 
            $res = iterator_to_array(Yii::app()->mongodb->selectCollection($_POST['collection'])->find ( $where ));
        else
            $res = array('count' => Yii::app()->mongodb->selectCollection($_POST['collection'])->count ( $where,$fields ));
        //$res["where"]=$where;
        Rest::json( $res );
        Yii::app()->end();
    }
    
}