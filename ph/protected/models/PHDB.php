<?php
/*
Generic Database Method shared Throught the project
*
 * Librairies et Methodes Transversales 
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 01/06/14
 */
class PHDB
{
    public static function find( $collection, $where=array(),$fields=null )
    {
        if(!$fields)
            $res = iterator_to_array(Yii::app()->mongodb->selectCollection($collection)->find($where));
        else
            $res = iterator_to_array(Yii::app()->mongodb->selectCollection($collection)->find( $where , $fields));
        return $res;
    }
    public static function count( $collection, $where=array() )
    {
        return Yii::app()->mongodb->selectCollection($collection)->count($where);
    }
    public static function countWFileds( $collection, $where=array(),$fields=array() )
    {
        return Yii::app()->mongodb->selectCollection($collection)->count($where,$fields);
    }
    public static function findOne( $collection, $where )
    {
        return Yii::app()->mongodb->selectCollection($collection)->findOne($where);
    }
    
    public static function update( $collection, $where, $action )
    {
        return Yii::app()->mongodb->selectCollection($collection)->update($where,$action);
    }
    public static function insert( $collection, $info )
    {
        return Yii::app()->mongodb->selectCollection($collection)->insert($info);
    }
    public static function remove( $collection, $where )
    {
        return Yii::app()->mongodb->selectCollection($collection)->remove($where);
    }
    public static function batchInsert($collection,$a){
        return Yii::app()->mongodb->selectCollection($collection)->batchInsert($a);   
    }
    /*
    $params is the POST array 
    $key is the microformat that  should contain 
     */
    public static function validate($key,$params)
    {
        $res = array("result"=>false);
        if( $jsonSchema = PHDB::findOne( PHType::TYPE_MICROFORMATS , array("key"=>$key) ) )
        {
            //hack to convert array cast into object stdClass : json_decode (json_encode ( $jsonSchema["jsonSchema"] ), FALSE)
            $validator = new Json\Validator(json_decode (json_encode ( $jsonSchema["jsonSchema"] ), FALSE) );
            try{
                $validator->validate( $params );
                $res = array("result"=>true);
            } catch(Exception $e){
                $res["msg"] = $e->getMessage();
            }
        } else 
            $res["msg"] = "no json Schema found.";
        return $res; 
    }
}