<?php
/*
Generic Database Method shared Throught the project
 */
class PHDB
{
    public static function find( $collection, $where=array() )
    {
        return iterator_to_array(Yii::app()->mongodb->selectCollection($collection)->find($where));
    }

    public static function findOne( $collection, $where )
    {
        return Yii::app()->mongodb->selectCollection($collection)->findOne($where);
    }
    
    public static function update( $collection, $where, $action )
    {
        return Yii::app()->mongodb->selectCollection($collection)->update($where,$action);
    }
}