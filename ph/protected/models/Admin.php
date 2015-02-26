<?php
/**
 * contains all sorts of Admin methods like
 * - initData
 * @package default
 */
class Admin
{
	/**
   * if $type is empty the script will scann and import the whole data folder (limited control)
   * if type is given this is a name of a file inside /data  
   * if collection is empty , data will be stored in file name colelction
   * 
   * @return [json Map] list
   */
	public static function initModuleData( $moduleId, $type=null, $collection = null,$isDummy=false )
	{
		$res = array("module"=>$moduleId, "collection"=>$collection, "imported"=>array(),"errors"=>0);
	    if( file_exists( Yii::getPathOfAlias( Yii::app()->params["modulePath"].$moduleId.".data" ) ) )
		{
			if( !$type )
			{
				foreach( CFileHelper::findFiles(Yii::getPathOfAlias(Yii::app()->params["modulePath"].$moduleId.".data" )) as $f)
				{
					//todo : if csv 
					//if json
					$importRes = self::insertDataFromFile($f,$collection,$type,$isDummy);
					array_push( $res["imported"], $importRes);
				}
			} else {
				$file = null;
				foreach( CFileHelper::findFiles(Yii::getPathOfAlias(Yii::app()->params["modulePath"].$moduleId.".data" )) as $f)
				{
					//echo pathinfo($f, PATHINFO_FILENAME)."<br/>";
					if( pathinfo($f, PATHINFO_FILENAME) == $type){
						$file = $f;
						break;
					}
				}
				$importRes = self::insertDataFromFile($file,$collection,$type,$isDummy);
				array_push( $res["imported"], $importRes);
				$res["errors"] += count($importRes["errors"]);
			}
		} else 
			$res["msg"] = "Nothing to import";
        return $res;
	}

	/**
	 * is a clone of initModuleData the differnece is this import files can contain 
	 * multiple destination dataset in one single file, the key being the destignation collection 
	 * @param type $moduleId 
	 * @param type $type 
	 * @param type $collection 
	 * @param type $isDummy 
	 * @return type
	 */
	public static function initMultipleModuleData( $moduleId, $type=null, $isDummy=false )
	{
		$res = array("module"=>$moduleId, "imported"=>array(),"errors"=>0);
	    if( file_exists( Yii::getPathOfAlias( Yii::app()->params["modulePath"].$moduleId.".data" ) ) )
		{
			$file = null;
			foreach( CFileHelper::findFiles(Yii::getPathOfAlias(Yii::app()->params["modulePath"].$moduleId.".data" )) as $f)
			{
				//echo pathinfo($f, PATHINFO_FILENAME)."<br/>";
				if( pathinfo($f, PATHINFO_FILENAME) == $type){
					$file = $f;
					break;
				}
			}
			$jsonAll = json_decode( file_get_contents($file), true);
			$importRes = array( "file"=> $type,  "isDummy"=>$isDummy , "imports"=>array(),"count"=>0,"errors"=>0  );
			foreach ($jsonAll as $col => $data) {
				$importRes['imports'][$col] = array();
				$importRes['imports'][$col]["count"] = count($data);
				$importRes["count"] += count($data);
				$importRes['imports'][$col]["collection"] = $col;
				$errors = array();
				$infos = array();
				foreach ($data as $row) {
					$infosRes = self::insertData($row,$col,$type,$isDummy);
		        	if($infosRes["error"])
		        		array_push( $errors, $infosRes["error"] );
					array_push( $infos, $infosRes["info"] );
				}
				$importRes['imports'][$col]["infos"] = $infos;
				$importRes['imports'][$col]["errors"] = $errors;
			}
			array_push( $res["imported"], $importRes);

		} else 
			$res["msg"] = "Nothing to import";
        return $res;
	}

	/**
	 * runs through a json file and inserts the data 
	 * checks if an id exists if it does the data is remove and inserted again 
	 * when dummyData is set , it is added onto the inserted entity for easy cleaning
	 * @param type $file 
	 * @param type $collection 
	 * @return type
	 */
	public static function insertDataFromFile($file, $collection = null,$type=null,$isDummy=false)
	{
		$json = json_decode( file_get_contents($file), true);
		$fn = pathinfo($file, PATHINFO_FILENAME);
		$errors = array();
		$infos = array();
		//PHDB::batchInsert( $fn , $json );
		foreach ( $json as $row ) 
        {
        	$infosRes = self::insertData($row,$collection,$type,$isDummy);
        	if($infosRes["error"])
        		array_push( $errors, $infosRes["error"] );
			array_push( $infos, $infosRes["info"] );
        }
		return array( "file"=> $fn, "collection"=>$collection, "isDummy"=>$isDummy,"count"=>count($json), "infos"=>$infos, "errors"=>$errors);
			
	}

	/**
   *
   * @return [json Map] list
   */
	public static function insertData($row, $collection,$type,$isDummy)
	{
		$error = null;
    	if(isset($row["_id"]) && isset($row["_id"]['$oid']) && PHDB::isValidMongoId($row["_id"]['$oid']) ){
    		$id = $row["_id"]['$oid'];
    		unset($row["_id"]);
    		try {
		    	$id = new MongoId($id);
			} catch (MongoException $ex) {
			    $id = new MongoId();
			}
        } else
        	$id = new MongoId();

        $row["_id"] = $id;
        if($isDummy)
        	$row["dummyData"] = $type;

        if(!$collection)
        	$collection = $fn;
        
        $where = array("_id"=>new MongoId((string)$row["_id"]));
        $exist = (PHDB::findOne( $collection, $where ) ) ? true : false ;
        $info = array( "collection"=>$collection, "id"=>(string)$row["_id"], "exist"=>$exist, "msg"=>"" );
        
        if( $exist )
        {
        	PHDB::remove( $collection, $where );
        	$info["msg"] .= "remove";
        }

        try {
		    PHDB::insert( $collection, $row );
		    $info["msg"] .= " - inserted";
		} catch (MongoException $ex) {
		    $error = array( "id"=>(string)$row["_id"],"exist"=>$exist,"msg"=>$ex->getMessage());
		}
		return array( "info" => $info ,
					  "error" => $error );
	}
	/**
   *
   * @return [json Map] list
   */
	public static function checkInitData($where,$key)
	{
	    $res = PHDB::find($where, array( "dummyData" => $key ));
	    return count($res);
	}
}