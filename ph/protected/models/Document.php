<?php 
class Document {

	const COLLECTION = "documents";

	const IMG_BANNIERE = "banniere";
	const IMG_PROFIL = "profil";
	const IMG_SLIDER = "slider";
	const IMG_MEDIA = "media";

	const CATEGORY_PLAQUETTE = "Plaquette";

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

	public static function listMyDocumentByType($userId, $type, $contentKey, $sort=null){
		$params = array("id"=> $userId,
						"type" => $type,
						"contentKey" => new MongoRegex("/".$contentKey."/i"));
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

	//TODO SBAR - get the moduleid
	public static function getDocumentLink($document, $text) {
		$module = /*$this->module->id*/"communecter";
		$baseURL = Yii::app()->request->baseUrl;
		$link = "";
		if (isset($document) && isset($document['name']) && isset($document['folder'])) {
        	$name = strtolower($document['name']);
        	if(strrpos($name, ".pdf") != false)
				$link = '<a href="'.$baseURL."/upload/".$module."/".$document['folder']."/".$document['name'].'" target="_blank">'.
							'<i class="fa fa-file-pdf-o fa-3x icon-big"></i>'.$text.'</a>';	
			else if( strrpos( $name, ".jpg" ) != false || strrpos($name, ".jpeg") != false || strrpos($name, ".gif")  != false || strrpos($name, ".png")  != false  )
				$link = '<a href="'.$baseURL."/upload/".$module."/".$document['folder']."/".$document['name'].'" data-lightbox="docs">'.
							'<img width="50" class="" src="'.Yii::app()->request->baseUrl."/upload/".$this->module->id."/".$document['folder']."/".$document['name'].'"/>'.
							$text.'</a>';	
			else
				$link = '<a href="'.$baseURL."/upload/".$module."/".$document['folder']."/".$document['name'].'" target="_blank">'.
							'<i class="fa fa-file fa-3x icon-big"></i>'.$text.'</a>';
		} else {
			throw new CTKException("The document is not well formated");
		}
		return $link;
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
	    	$pathImg = "/upload/".$params['moduleId']."/".$params['type']."/".$params["id"]."/".$params["name"];
	    	Document::setImagePath( $params['id'], $params['type'], $pathImg ,$params["contentKey"]);
	    }


	    PHDB::insert(self::COLLECTION,$new);
	    //Link::connect($id, $type, $new["_id"], PHType::TYPE_PROJECTS, $id, "projects" );
	    return array("result"=>true, "msg"=>"Votre document est enregistré.", "id"=>$new["_id"]);	
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
	* get a list of a image 
	* @return return a list of image
	*/
	public static function getListImagesByKey($id, $contentKey){
		$listImages= array();
		$sort = array( 'created' => 1 );
		$explodeContentKey = explode(".", $contentKey);
		$listImagesofType = Document::listMyDocumentByType($id, $explodeContentKey[0], "image", $sort);
		foreach ($listImagesofType as $key => $value) {
			if(isset($value["contentKey"]) && $value["contentKey"] != ""){
				$explodeValueContentKey = explode(".", $value["contentKey"]);
				if($explodeContentKey[1] == $explodeValueContentKey[1]){
					$imagePath = "upload".DIRECTORY_SEPARATOR.Yii::app()->controller->module->id.$value["folder"].$value["name"];
    				$imagePath = Yii::app()->getRequest()->getBaseUrl(true).DIRECTORY_SEPARATOR.$imagePath;
    				$imagePath = str_replace(DIRECTORY_SEPARATOR, "/", $imagePath);
					$listImages[(string) $explodeValueContentKey[2]] = $imagePath;
				}
			}
		}
		return $listImages;
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

}
?>