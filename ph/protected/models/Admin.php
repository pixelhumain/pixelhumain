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
   * @param type $moduleId 
	 * @param type $type , is the file type when wanting to load only one file at a time
	 * @param type $collection , is the destinating collection
	 * @param type $isDummy , if is true, often associated with the type , on each dummy data inserted will be added dummyData:$type
	 * @return type
   */
	public static function initModuleData( $moduleId, $type=null, $collection = null,$isDummy=false,$linkAllToActiveUser=false )
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
					$importRes = self::insertDataFromFile($f,$collection,$type,$isDummy,$linkAllToActiveUser);
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
				$importRes = self::insertDataFromFile($file,$collection,$type,$isDummy,$linkAllToActiveUser);
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
	 * tool mongo query :: db.citoyens.find({email:/oceat/},{email:1,events:1,links:1,projects:1})
	 * @param type $moduleId 
	 * @param type $type , is the file type when wanting to load only one file at a time
	 * @param type $isDummy , if is true, often associated with the type , on each dummy data inserted will be added dummyData:$type
	 * @return type
	 */
	public static function initMultipleModuleData( $moduleId, $type=null, $isDummy=false,$linkAllToActiveUser=false,$reverse=false )
	{
		$res = array("module"=>$moduleId, "imported"=>array(),"errors"=>0,"linkAllToActiveUser"=>$linkAllToActiveUser);
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
			foreach ($jsonAll as $col => $data) 
			{
				if(!$reverse)
				{
					if( $col != "linkAllToActiveUser")
					{
						$importRes['imports'][$col] = array();
						$importRes['imports'][$col]["count"] = count($data);
						$importRes["count"] += count($data);
						$importRes['imports'][$col]["collection"] = $col;
						$errors = array();
						$infos = array();
						foreach ($data as $row) 
						{
							$infosRes = self::insertData($row,$col,$type,$isDummy,$linkAllToActiveUser);
							if($infosRes["error"])
				        		array_push( $errors, $infosRes["error"] );
							array_push( $infos, $infosRes["info"] );
						}
						$importRes['imports'][$col]["infos"] = $infos;
						$importRes['imports'][$col]["errors"] = $errors;
					} 
					else 
					{
						$linkAllToActiveUser = true;
						$res["linkAllToActiveUser"] = true;
					}
				} 
				else
				{
					$infosRes = self::removeData($col,$type,$isDummy,$linkAllToActiveUser);
					$importRes["count"] += $infosRes["count"];
				}
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
	public static function insertDataFromFile($file, $collection ,$type,$isDummy,$linkAllToActiveUser)
	{
		$json = json_decode( file_get_contents($file), true);
		$fn = pathinfo($file, PATHINFO_FILENAME);
		$errors = array();
		$infos = array();
		//PHDB::batchInsert( $fn , $json );
		foreach ( $json as $row ) 
        {
        	$infosRes = self::insertData($row,$collection,$type,$isDummy,$linkAllToActiveUser);
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
	public static function insertData($row, $collection,$type,$isDummy,$linkAllToActiveUser)
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
        $info = array( "collection"=>$collection, "id"=>(string)$row["_id"], "exist"=>$exist, "msg"=>array() );
        $userId = Yii::app()->session["userId"];
        if($linkAllToActiveUser){
        	if( $collection == PHType::TYPE_CITOYEN ){
        		$person = array("type"=>$collection);
        		if(isset($row["links"])){
        			if( isset( $row["links"]["knows"] ) )
        				$row["links"]["knows"][$userId] = $person;
        			else {
	        			$knows = array();
	        			$knows[$userId] = $person;
	        			$row["links"]["knows"] = $knows ;
	        		}

        		}
        		else {
        			$knows = array();
        			$knows[$userId] = $person;
        			$row["links"] = array("knows"=>$knows) ;
        		}
        		PHDB::update( PHType::TYPE_CITOYEN, 
        					  array("_id" => new MongoId($userId)), 
        					  array('$set' => array("links.knows.".(string)$row["_id"] =>array("type"=>$collection))));
        		array_push($info["msg"],"added links.knows activeUser");
        	}
        	elseif ( $collection == PHType::TYPE_ORGANIZATIONS ) 
        	{
        		$person = array("type"=>PHType::TYPE_CITOYEN);
        		if(isset($row["links"])  ){
        			if( isset( $row["links"]["members"] ) )
        				$row["links"]["members"][$userId] = $person;
        			else
        			{
        				$members = array();
        				$members[$userId] = $person;
        				$row["links"]["members"] = $members;
        			}
        		}
        		else {
        			$members = array();
        			$members[$userId] = $person;
        			$row["links"] = array("members"=>$members) ;
        		}
        		PHDB::update( PHType::TYPE_CITOYEN, 
        					  array("_id" => new MongoId($userId)), 
        					  array('$set' => array("links.memberOf.".(string)$row["_id"]=>array( "type"=>$collection ))));
        		array_push($info["msg"],"added links.members and memberOf for activeUser");
        	}
        	elseif ( $collection == PHType::TYPE_EVENTS ) 
        	{
        		$person = array("id"=>$userId,"type"=>PHType::TYPE_CITOYEN);
        		if(isset($row["attendees"])) 
        			array_push($row["attendees"], $person);
        		else {
        			$attendees = array();
        			$attendees[$userId] = $person;
        			$row["attendees"] = $attendees ;
        		}	
        		PHDB::update( PHType::TYPE_CITOYEN, 
        					  array("_id" => new MongoId($userId)), 
        					  array('$addToSet' => array("events"=>(string)$row["_id"]  )));
        		array_push($info["msg"],"added attendees and events.attendee for activeUser");
        	}
        	elseif ( $collection == PHType::TYPE_PROJECTS ) 
        	{
        		$person = array("id"=>$userId,"type"=>PHType::TYPE_CITOYEN);
        		if(isset($row["contributors"])) 
        			array_push($row["contributors"], $person);
        		else {
        			$contributors = array();
        			$contributors[$userId] = $person;
        			$row["contributors"] = $contributors ;
        		}
        		PHDB::update( PHType::TYPE_CITOYEN, 
        					  array("_id" => new MongoId($userId)), 
        					  array('$addToSet' => array("projects"=>(string)$row["_id"]  )));
        		array_push($info["msg"],"added contributors and projects for activeUser");
        	}

        }

        if( $exist )
        {
        	PHDB::remove( $collection, $where );
        	array_push($info["msg"],"existed removed");
        }

        try {
		    PHDB::insert( $collection, $row );
		    array_push($info["msg"],"inserted");
		} catch (MongoException $ex) {
		    $error = array( "id"=>(string)$row["_id"],"exist"=>$exist,"msg"=>$ex->getMessage());
		}
		return array( "info" => $info ,
					  "error" => $error );
	}

	public static function removeData($collection,$type,$isDummy,$linkAllToActiveUser)
	{
		$error = null;
		if($isDummy)
			$rows = PHDB::find($collection,array("dummyData"=>$type));
    	$info = array( "collection"=>$collection,   );
    	$userId = Yii::app()->session["userId"];
    	foreach ($rows as $key => $value) 
    	{
    		if( $linkAllToActiveUser )
    		{
	    		if( $collection == PHType::TYPE_CITOYEN )
		        	PHDB::update( PHType::TYPE_CITOYEN, 
		        					  array("_id" => new MongoId($userId)), 
		        					  array('$unset' => array("links.knows.".$key=>1)));
		        elseif( $collection == PHType::TYPE_ORGANIZATIONS )
		        	PHDB::update( PHType::TYPE_CITOYEN, 
	        					  array("_id" => new MongoId($userId)), 
	        					  array('$unset' => array("links.memberOf.".$key=>1)));
		        elseif( $collection == PHType::TYPE_EVENTS )
		        	PHDB::update( PHType::TYPE_CITOYEN, 
	        					  array("_id" => new MongoId($userId)), 
	        					  array('$pull' => array("events"=>$key)));
		        elseif( $collection == PHType::TYPE_PROJECTS )
		        	PHDB::update( PHType::TYPE_CITOYEN, 
	        					  array("_id" => new MongoId($userId)), 
	        					  array('$pull' => array("projects"=>$key)));
		    }

        	PHDB::remove( $collection, array("_id" => new MongoId( $key )) );
    	}
		return array( "count"=>count($rows) );
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