<?php 
class Document {

	const COLLECTION = "documents";

	const IMG_BANNIERE 			= "banniere";
	const IMG_PROFIL 			= "profil";
	const IMG_PROFIL_RESIZED 	= "profil-resized";
	const IMG_PROFIL_MARKER 	= "profil-marker";
	const IMG_LOGO 				= "logo";
	const IMG_SLIDER 			= "slider";
	const IMG_MEDIA 			= "media";

	const CATEGORY_PLAQUETTE = "Plaquette";

	const DOC_TYPE_IMAGE = "image";

	/**
	 * get an project By Id
	 * @param type $id : is the mongoId of the project
	 * @return type
	 */
	public static function getById($id) {
	  	return PHDB::findOne( self::COLLECTION,array("_id"=>new MongoId($id)));
	}

	public static function getWhere($params) {
	  	return PHDB::find( self::COLLECTION,$params);
	}

	protected static function listMyDocumentByType($userId, $type, $contentKey, $sort=null){
		$params = array("id"=> $userId,
						"type" => $type,
						"contentKey" => new MongoRegex("/".$contentKey."/i"));
		$listDocuments = PHDB::findAndSort( self::COLLECTION,$params, $sort);
		return $listDocuments;
	}

	protected static function listMyDocumentByContentKey($userId, $contentKey, $docType = null, $sort=null){		
		$params = array("id"=> $userId,
						"contentKey" => new MongoRegex("/".$contentKey."/i"));
		
		if (isset($docType)) {
			$params["doctype"] = $docType;
		}

		$listDocuments = PHDB::findAndSort( self::COLLECTION,$params, $sort);
		return $listDocuments;
	}

	public static function listDocumentByCategory($collectionId, $type, $category, $sort=null) {
		$params = array("id"=> $collectionId,
						"type" => $type,
						"category" => new MongoRegex("/".$category."/i"));
		$listDocuments = PHDB::findAndSort( self::COLLECTION,$params, $sort);
		return $listDocuments;	
	}
	
	/**
	 * save document information
	 * @param $params : a set of information for the document (?to define)
	*/
	public static function save($params){
		//$id = Yii::app()->session["userId"];
		if(!isset($params["contentKey"])){
			$params["contentKey"] = "";
		}

	    $new = array(
			"id" => $params['id'],
	  		"type" => $params['type'],
	  		"folder" => $params['folder'],
	  		"moduleId" => $params['moduleId'],
	  		"doctype" => Document::getDoctype($params['name']),	
	  		"author" => $params['author'],
	  		"name" => $params['name'],
	  		"size" => $params['size'],
	  		'created' => time()
	    );

	    if(isset($params["category"]) && !empty($params["category"]))
	    	$new["category"] = $params["category"];
	    if(isset($params["contentKey"]) && !empty($params["contentKey"])){
	    	$new["contentKey"] = $params["contentKey"];
	    }

	    PHDB::insert(self::COLLECTION,$new);
	    //Link::connect($id, $type, $new["_id"], PHType::TYPE_PROJECTS, $id, "projects" );
	    return array("result"=>true, "msg"=>Yii::t('document','Document saved successfully',null,Yii::app()->controller->module->id), "id"=>$new["_id"]);	
	}

	/**
	* get the type of a document
	* @param strname : the name of the document
	*/
	public static function getDoctype($strname){

		$supported_image = array(
		    'gif',
		    'jpg',
		    'jpeg',
		    'png'
		);

		$doctype = "";
		$ext = strtolower(pathinfo($strname, PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
		if (in_array($ext, $supported_image)) {
			$doctype = "image";
		}else{
			$doctype = $ext;
		}
		return $doctype;
	}

	/**
	 * get the list of documents depending on the id of the owner, the contentKey and the docType
	 * @param String $id The id of the owner of the image could be an organization, an event, a person, a project... 
	 * @param String $contentKey The content key is composed with the controllerId, the action where the document is used and a type
	 * @param String $docType The docType represent the type of document (see DOC_TYPE_* constant)
	 * @param array $limit represent the number of document by type that will be return. If not set, everything will be return
	 * @return array a list of documents + URL sorted by contentkey type (IMG_PROFIL...)
	 */
	public static function getListDocumentsByContentKey($id, $contentKey, $docType=null, $limit=null){
		$listDocuments = array();
		$sort = array( 'created' => -1 );
		$explodeContentKey = explode(".", $contentKey);
		$listDocumentsofType = Document::listMyDocumentByContentKey($id, $explodeContentKey[0], $docType, $sort);
		foreach ($listDocumentsofType as $key => $value) {
			$toPush = false;
			if(isset($value["contentKey"]) && $value["contentKey"] != ""){
				$explodeValueContentKey = explode(".", $value["contentKey"]);
				$currentType = (string) $explodeValueContentKey[2];
				if (isset($explodeContentKey[1])) {
					if($explodeContentKey[1] == $explodeValueContentKey[1]){
						if (! isset($limit)) {
							$toPush = true;
						} else {
							if (isset($limit[$currentType])) {
								$limitByType = $limit[$currentType];
								$actuelNbCurrentType = isset($listDocuments[$currentType]) ? count($listDocuments[$currentType]) : 0;
								if ($actuelNbCurrentType < $limitByType) {
									$toPush = true;
								}
							} else {
								$toPush = true;
							}
						}
					}
				} else {
					$toPush = true;
				}
			}
			if ($toPush) {
				$imageUrl = Document::getDocumentUrl($value);
				if (! isset($listDocuments[$currentType])) {
					$listDocuments[$currentType] = array();
				} 
				$value['imageUrl'] = $imageUrl;
				array_push($listDocuments[$currentType], $value);
			}
		}

		return $listDocuments;
	}

	/**
	 * @See getListDocumentsByContentKey. 
	 * @return array Return only the Url of the documents ordered by contentkey type
	 */
	public static function getListDocumentsURLByContentKey($id, $contentKey, $docType=null, $limit=null){
		$res = array();
		$listDocuments = self::getListDocumentsByContentKey($id, $contentKey, $docType, $limit);

		foreach ($listDocuments as $contentKey => $documents) {
			foreach ($documents as $document) {
				if (! isset($res[$contentKey])) {
					$res[$contentKey] = array();
				} 
				array_push($res[$contentKey],$document["imageUrl"]);
			}
		}
		return $res;
	}
	
	/**
	* remove a document by id
	* @return
	*/
	public static function removeDocumentById($id){
		return PHDB::remove(self::COLLECTION, array("_id"=>new MongoId($id)));
	}

	/**
	* upload the path of an image
	* @param itemId is the id of the item that we want to update
	* @param itemType is the type of the item that we want to update
	* @param path is the new path of the image
	* @return
	*/
	public static function setImagePath($itemId, $itemType, $path, $contentKey){
		$tabImage = explode('.', $contentKey);

		if(in_array(Document::IMG_PROFIL, $tabImage)){
			return PHDB::update($itemType,
	    					array("_id" => new MongoId($itemId)),
	                        array('$set' => array("imagePath"=> $path))
	                    );
		}
	}

	/**
	* get the last images with a key
	* @param itemId is the id of the item that we want to get images
	* @param itemType is the type of the item that we want to get images
	* @param key is the type of image we want to get
	* @return return the url of a document
	*/
	public static function getLastImageByKey($itemId, $itemType, $key){
		$imageUrl = "";
		$sort = array( 'created' => -1 );
		$params = array("id"=> $itemId,
						"type" => $itemType,
						"contentKey" => new MongoRegex("/".$key."/i"));
		$listImagesofType = PHDB::findAndSort( self::COLLECTION,$params, $sort, 1);
		
		foreach ($listImagesofType as $key => $value) {
			//$imagePath = DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR.Yii::app()->controller->module->id.DIRECTORY_SEPARATOR.$value["folder"].DIRECTORY_SEPARATOR.$value["name"];
    		//$imagePath = str_replace(DIRECTORY_SEPARATOR, "/", $imagePath);
    		$imageUrl = Document::getDocumentUrl($value);
		}
		return $imageUrl;
	}

	/**
	 * Get the list of categories available for the id and the type (Person, Organization, Event..)
	 * @param String $id Id to search the categories for
	 * @param String $type Collection Type 
	 * @return array of available categories (String)
	 */
	public static function getAvailableCategories($id, $type) {
		$params = array("id"=> $id,
						"type" => $type);
		$sort = array("category" => -1);
		$listCategory = PHDB::distinct(self::COLLECTION, "category", $params);
		
		return $listCategory;

	}

	public static function getHumanFileSize($bytes, $decimals = 2) {
      $sz = 'BKMGTP';
      $factor = floor((strlen($bytes) - 1) / 3);
      return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }

    public static function clean($string) {
       $string = preg_replace('/  */', '-', $string);
       $string = strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'); // Replaces all spaces with hyphens.
       return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public static function getDocumentUrl($document){
    	return "/".Yii::app()->params['uploadUrl'].$document["moduleId"]."/".$document["folder"]."/".$document["name"];
    }

}
?>