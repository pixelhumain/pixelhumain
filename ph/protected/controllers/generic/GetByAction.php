<?php
class GetByAction extends CAction
{
    public function run()
    {
        $params =  $_POST;
        $where = (isset($params["where"])) ? $params["where"] : array();
        $fields = ( isset($params["fields"]) ) ? $params["fields"] : null;

        if(isset($where["_id"]))
            $where["_id"] = new MongoId($where["_id"]);
        if( !isset($params["count"]) ) {
            if($fields)
                $res = PHDB::find($_POST['collection'],$where,$fields );
            else
                $res = PHDB::find($_POST['collection'] );
        } else
            $res = array('count' => PHDB::countWFileds($_POST['collection'],$where,$fields ));
        //$res["where"]=$where;
        Rest::json( $res );
        Yii::app()->end();
    }
    
}