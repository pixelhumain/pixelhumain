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
    private static function beforeCall()
    {
      Yii::app()->session["dbAccess"] = Yii::app()->session["dbAccess"]+1;
    }
    public static function find( $collection, $where=array(),$fields=null )
    {    	
        self::beforeCall();
        if(!$fields)
            $res = !self::checkMongoDbPhpDriverInstalled() ? null : iterator_to_array(Yii::app()->mongodb->selectCollection($collection)->find($where));
        else
            $res = !self::checkMongoDbPhpDriverInstalled() ? null : iterator_to_array(Yii::app()->mongodb->selectCollection($collection)->find( $where , $fields));
        return $res;
    }

    public static function findAndSort( $collection, $where=array(), $sortCriteria, $limit=0, $fields=null)
    {  
      self::beforeCall();
        if (!self::checkMongoDbPhpDriverInstalled()) return null;
          if ($fields) {
            $res = Yii::app()->mongodb->selectCollection($collection)->find($where, $fields)->sort($sortCriteria);
          } else {
            $res = Yii::app()->mongodb->selectCollection($collection)->find($where)->sort($sortCriteria);
          }
        
        if($limit)
          $res = $res->limit($limit);
        
        return iterator_to_array($res);
    }

    public static function findAndModify( $collection, $where, $action, $options=null )
    {       
      self::beforeCall();
        return !self::checkMongoDbPhpDriverInstalled() ? null : 
            Yii::app()->mongodb->selectCollection($collection)->findAndModify($where, $action, null, $options);

    }
    public static function distinct( $collection, $key, $where=array() )
    {   
      self::beforeCall();  
        return !self::checkMongoDbPhpDriverInstalled() ? null : Yii::app()->mongodb->selectCollection($collection)->distinct($key,$where);
    }
    public static function count( $collection, $where=array() )
    {    	
      self::beforeCall();
        return !self::checkMongoDbPhpDriverInstalled() ? null : Yii::app()->mongodb->selectCollection($collection)->count($where);
    }
    public static function countWFields( $collection, $where=array(),$fields=array() )
    {    	
      self::beforeCall();
        return !self::checkMongoDbPhpDriverInstalled() ? null : Yii::app()->mongodb->selectCollection($collection)->count($where,$fields);
    }
    public static function findOne( $collection, $where ,$fields=null)
    {    	
      self::beforeCall();
        if($fields)
          return !self::checkMongoDbPhpDriverInstalled() ? null : Yii::app()->mongodb->selectCollection($collection)->findOne($where,$fields);
        else  
          return !self::checkMongoDbPhpDriverInstalled() ? null : Yii::app()->mongodb->selectCollection($collection)->findOne($where);
    }
    
    public static function findOneById( $collection, $id, $fields=null )
    {   
        self::beforeCall();
        return self::findOne( $collection, array("_id"=>new MongoId($id)), $fields);
    }
    public static function update( $collection, $where, $action )
    {    	
      self::beforeCall();
        return !self::checkMongoDbPhpDriverInstalled() ? null : Yii::app()->mongodb->selectCollection($collection)->update($where,$action);
    }
     public static function updateWithOptions( $collection, $where, $action,$options )
    {
      self::beforeCall();
        return !self::checkMongoDbPhpDriverInstalled() ? null : Yii::app()->mongodb->selectCollection($collection)->update($where,$action,$options);
    }
    public static function insert( $collection, $info )
    {    	
      self::beforeCall();
        return !self::checkMongoDbPhpDriverInstalled() ? null : Yii::app()->mongodb->selectCollection($collection)->insert($info);
    }
    public static function remove( $collection, $where )
    {    	
      self::beforeCall();
        return !self::checkMongoDbPhpDriverInstalled()? null :Yii::app()->mongodb->selectCollection($collection)->remove($where);
    }
    public static function batchInsert($collection,$rows){
      self::beforeCall();
        return !self::checkMongoDbPhpDriverInstalled() ? null : Yii::app()->mongodb->selectCollection($collection)->batchInsert($rows);   
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
    	if(!extension_loaded("mongo") || !isset(Yii::app()->mongodb))
    	{
    		if($bThrowExceptionIfFailed)
    			throw new CHttpException(500,"It seems that your apache/PHP/MongoDb server is not correctly set up. This app need an apache/php server set up with mongo extension. Fix it and retry".print_r(debug_backtrace(),true));
    		else 
    			return false;
    	}
    	else
    		return true;    	
    }

    /**
     * Retreives from the data folder the $file 
     * and returns the node corresponding to the where clause
     * @return array containing a element of a json file.
     */
    public static function getArrayFromDataFolder($file=null,$where=null)
    {
        $moduleId=Yii::app()->controller->module->id;
        $actionId = Yii::app()->controller->action->id;
        $res = null;

        if(file_exists(Yii::getPathOfAlias(Yii::app()->params["modulePath"].$moduleId.".data" )))
        {
          foreach( CFileHelper::findFiles(Yii::getPathOfAlias(Yii::app()->params["modulePath"].$moduleId.".data" )) as $f)
          {
            $fn = pathinfo($f, PATHINFO_FILENAME);
            //echo "<br/>".$fn;
            if( $file == $fn )
            {
                //echo "<br/> found file ".$file;
                $json = json_decode( file_get_contents($f), true);
                
                //var_dump($json);
                foreach ( $json as $i=>$row ) 
                {
                    
                    if( ( isset($row[ $where["key"] ]) &&  $row[ $where["key"] ] == $where["value"] ) )
                    {    
                        //echo "<br/> found document name ".$row[ $where["key"] ];
                        return $row;
                    }
                }
            }
          }
        } 
         return $res;
      }

    /**
     * Gives status messages about the difference between 2 array elements
     * correponding to a collection entry in the database 
     *
     * @return array of message with their types
     */
    public static function compareEntries($entries, $type, $file,$where, $autoApply=false)
    {
        $msg = array();
        $arrayFromDataFolder = PHDB::getArrayFromDataFolder($file,$where);
        if(isset($entries[$type]["_id"]))
            unset($entries[$type]["_id"]);
        
        //testing existence
        if( !isset($entries[$type]) ){
          array_push($msg, array("type"=>"error","msg"=>"no $type in DB"));
          if( $autoApply)
          {
            PHDB::insert($file,$arrayFromDataFolder);
            array_push($msg, array("type"=>"action","msg"=>"new $type inserted DB"));
            array_push($msg, array("type"=>"ok","msg"=>"$type entry has been updated in Database, <br/>"));
          }
        }
        //compare one way
        else if ($diff = ArrayHelper::array_diff_assoc_recursive( $arrayFromDataFolder , $entries[$type] ) ){
          array_push($msg, array("type"=>"error","msg"=>"$type entry isn't up to date , some data has been 'added' to current content <br/>"));
          //var_dump($arrayFromDataFolder);
          //var_dump($entries[$type]);
          var_dump($diff);
          if( !empty($diff) && $autoApply)
          {
            PHDB::remove($file,array($where["key"]=>$where["value"]));
            array_push($msg, array("type"=>"action","msg"=>"old $type removed DB"));
            PHDB::insert($file,$arrayFromDataFolder);
            array_push($msg, array("type"=>"action","msg"=>"new $type inserted DB"));
            array_push($msg, array("type"=>"ok","msg"=>"$type entry has been updated in Database, <br/>"));
          }
        }
        //compare other way
        else if ($diff = ArrayHelper::array_diff_assoc_recursive( $entries[$type] , $arrayFromDataFolder ) ){
          array_push($msg, array("type"=>"error","msg"=>"$type entry isn't up to date , some data has been 'removed' from current content  <br/>"));
          //var_dump($arrayFromDataFolder);
          //var_dump($entries[$type]);
          var_dump($diff);
          if( !empty($diff) && $autoApply)
          {
            PHDB::remove($file,array($where["key"]=>$where["value"]));
            array_push($msg, array("type"=>"action","msg"=>"old $type removed DB"));
            PHDB::insert($file,$arrayFromDataFolder);
            array_push($msg, array("type"=>"action","msg"=>"new $type inserted DB"));
            array_push($msg, array("type"=>"ok","msg"=>"$type entry has been updated in Database, <br/>"));
          }
        }
        //nothing has changed
        else {
          array_push($msg, array("type"=>"ok","msg"=>"nothing to update on $type"));
        }
        return $msg;
    }

    public static function getIdFromUpsertResult($result) {
      //Trick for windows : the upserted does not have the same return value
      if (isset($result["upserted"])) {
        if (is_array($result["upserted"])) {
          $id = (String) $result["upserted"][0]["_id"];
        } else {
          $id = (String) $result["upserted"];
        }
      } else {
        throw new CTKException("Problem getting the result of the upsert ! ");
      }
      return $id;
    }

    //supprime les accens d'une chaine de caractere
    //utile pour les regex
    public static  function wd_remove_accents($str, $charset='utf-8')
    {
        $str = htmlentities($str, ENT_NOQUOTES, $charset);
        
        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
        
        return $str;
    }

    public static function findAndLimitAndIndex( $collection, $where=array(), $limit=0, $index=0 )
    {     
        $res = !self::checkMongoDbPhpDriverInstalled() ? 
                null : iterator_to_array(Yii::app()->mongodb->selectCollection($collection)
                                                                              ->find($where)
                                                                              ->skip($index)
                                                                              ->limit($limit));

        return $res;
    }
    
    public static function findAndSortAndLimitAndIndex( $collection, $where=array(), $sortCriteria=array(), $limit=0, $index=0 )
    {           
        $res = !self::checkMongoDbPhpDriverInstalled() ? 
                null : iterator_to_array(Yii::app()->mongodb->selectCollection($collection)
                                                                              ->find($where)
                                                                              ->sort($sortCriteria)
                                                                              ->skip($index)
                                                                              ->limit($limit));
        return $res;
    }

}