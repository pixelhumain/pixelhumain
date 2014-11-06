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
            $res = !self::checkMongoDbPhpDriverInstalled()?null:iterator_to_array(Yii::app()->mongodb->selectCollection($collection)->find($where));
        else
            $res = !self::checkMongoDbPhpDriverInstalled()?null:iterator_to_array(Yii::app()->mongodb->selectCollection($collection)->find( $where , $fields));
        return $res;
    }
    public static function count( $collection, $where=array() )
    {    	
        return !self::checkMongoDbPhpDriverInstalled()?null:Yii::app()->mongodb->selectCollection($collection)->count($where);
    }
    public static function countWFileds( $collection, $where=array(),$fields=array() )
    {    	
        return !self::checkMongoDbPhpDriverInstalled()?null:Yii::app()->mongodb->selectCollection($collection)->count($where,$fields);
    }
    public static function findOne( $collection, $where )
    {    	
        return !self::checkMongoDbPhpDriverInstalled()?null:Yii::app()->mongodb->selectCollection($collection)->findOne($where);
    }
    
    public static function update( $collection, $where, $action )
    {    	
        return !self::checkMongoDbPhpDriverInstalled()?null:Yii::app()->mongodb->selectCollection($collection)->update($where,$action);
    }
     public static function updateWithOptions( $collection, $where, $action,$options )
    {
        return !self::checkMongoDbPhpDriverInstalled()?null:Yii::app()->mongodb->selectCollection($collection)->update($where,$action,$options);
    }
    public static function insert( $collection, $info )
    {    	
        return !self::checkMongoDbPhpDriverInstalled()?null:Yii::app()->mongodb->selectCollection($collection)->insert($info);
    }
    public static function remove( $collection, $where )
    {    	
        return !self::checkMongoDbPhpDriverInstalled()?null:Yii::app()->mongodb->selectCollection($collection)->remove($where);
    }
    public static function batchInsert($collection,$rows){
        return !self::checkMongoDbPhpDriverInstalled()?null:Yii::app()->mongodb->selectCollection($collection)->batchInsert($rows);   
    }
    /*
    $params is the POST array 
    $key is the microformat that  should contain 
    uses https://github.com/hasbridge/php-json-schema
    based on json schema rules
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
    /**
     * Validate the given ID from the __construct
     *
     * @return boolean true for valid / false for invalid.
     */
    public static function isValidMongoId($id)
    {
        $regex = '/^[0-9a-z]{24}$/';
        if (class_exists("MongoId"))
        {
            $tmp = new MongoId($id);
            if ($tmp->{'$id'} == $id)
            {
                return true;
            }
            return false;
        }

        if (preg_match($regex, $id))
        {
            return true;
        }
        return false;
    }
    public static function noAdminExist($moduleId)
    {
        return PHDB::find(PHType::TYPE_CITOYEN, array("applications.".$moduleId.".isAdmin"=>true));
    }
    /**
     * Will check if Mongo class exists (id est mongo php driver is installed : mongo.so or mongo.dll).
     * Then will check that Yii::ap()->mongdb is correctly instanciated
     * @param bool $bThrowExceptionIfFailed By default FALSE. If true and if verification failed, will throw exception
     * @return boolean TRUE if ok, else will return false if $bThrowExceptionIfFailed==false or throw CHttpException either
     * @throws CHttpException : Will throw CHttpException(500) if verification failed and $bThrowExceptionIfFailed==true
     */
    public static function checkMongoDbPhpDriverInstalled($bThrowExceptionIfFailed=false)
    {
    	if(!isset(Yii::app()->mongdb))
    	{
    		if($bThrowExceptionIfFailed)
    			throw new CHttpException(500,"It seems that your apache/PHP/MongoDb server is not correctly set up. This app need an apache/php server set up with mongo extension. Fix it and retry".print_r(debug_backtrace(),true));
    		else 
    			return false;
    	}
    	else
    		return true;    	
    }
}