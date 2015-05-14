<?php 
class Organization {

	const COLLECTION = "organizations";
	
	//From Post/Form name to database field name
	private static $dataBinding = array(
	    "name" => array("name" => "name", "rules" => array("required", "organizationSameName")),
	    "email" => array("name" => "email", "rules" => array("email")),
	    "created" => array("name" => "created"),
	    "creator" => array("name" => "creator"),
	    "type" => array("name" => "type"),
	    "shortDescription" => array("name" => "shortDescription"),
	    "description" => array("name" => "description"),
	    "address" => array("name" => "address"),
	    "streetAddress" => array("name" => "address.streetAddress"),
	    "postalCode" => array("name" => "address.postalCode"),
	    "city" => array("name" => "address.codeInsee"),
	    "addressLocality" => array("name" => "address.addressLocality"),
	    "addressCountry" => array("name" => "address.addressCountry"),
	    "tags" => array("name" => "tags"),
	    "typeIntervention" => array("name" => "typeIntervention"),
	    "typeOfPublic" => array("name" => "typeOfPublic"),
	    "url"=>array("name" => "url"),
	    "telephone" => array("name" => "telephone"),
	    "video" => array("name" => "video")
	);
	
	//See findOrganizationByCriterias...
	public static function getWhere($params) {
	  	return PHDB::find( self::COLLECTION,$params);
	}

	//TODO SBAR - First test to validate data. Move it to DataValidator
  	private static function getCollectionFieldNameAndValidate($organizationFieldName, $organizationFieldValue) {
		$res = "";
		if (isset(self::$dataBinding["$organizationFieldName"])) {
			$data = self::$dataBinding["$organizationFieldName"];
			$name = $data["name"];
			//Validate field
			if (isset($data["rules"])) {
				$rules = $data["rules"];
				foreach ($rules as $rule) {
					$isDataValidated = DataValidator::$rule($organizationFieldValue);
					if ($isDataValidated != "") {
						throw new CTKException($isDataValidated);
					}
				}	
			}
		} else {
			throw new CTKException("Unknown field :".$organizationFieldName);
		}
		return $name;
	}

	/**
	 * insert a new organization in database
	 * @param array A well format organization 
	 * @return a json result as an array. 
	 */
	public static function insert($organization, $userId) {
	    
		$newOrganization = Organization::getAndCheckOrganization($organization);
		
		//Manage tags : save any inexistant tag to DB 
		if (isset($newOrganization["tags"]))
			$newOrganization["tags"] = Tags::filterAndSaveNewTags($newOrganization["tags"]);

		//Add the user creator of the organization in the system
		$newOrganization["creator"] = $userId;

		//fonction générique de SIG, à utiliser pour n'importe quelle entité
		//si l'entité contient un champs address => postalCode, on trouve la position dans les Cites
		//$newOrganization = SIG::addGeoPositionToEntity($organization);
	
		//Insert the organization
	    PHDB::insert( Organization::COLLECTION, $newOrganization);
		
	    if (isset($newOrganization["_id"])) {
	    	$newOrganizationId = (String) $newOrganization["_id"];
	    } else {
	    	throw new CommunecterException("Problem inserting the new organization");
	    }
		
		//Add the creator as the first member and admin of the organization
	    Link::addMember($newOrganizationId, Organization::COLLECTION, $userId, PHType::TYPE_CITOYEN, $userId, true);

	    //TODO ???? : add an admin notification
	    Notification::saveNotification(array("type"=>"Created",
	    						"user"=>$newOrganizationId));
	                  
	    $newOrganization = Organization::getById($newOrganizationId);
	    return array("result"=>true, "msg"=>"Votre organisation est communectée.", 
	    	"id"=>$newOrganizationId, "newOrganization"=> $newOrganization);
	}

	/* TODO Ajouter la position geo sur l'orga */
	public static function addGeoPos($organization){
		/*rechercher position par cp dans collec Cities
		si on trouve
		on recopie geo dans geoPos et on créé geo aussi
		s */
	}
	
	public static function newOrganizationFromPost($organization) {
		$newOrganization = array();
		$newOrganization["email"] = empty($organization['organizationEmail']) ? "" : $organization['organizationEmail'];
		$newOrganization["country"] = empty($organization['organizationCountry']) ? "" : $organization['organizationCountry'];
		$newOrganization["name"] = empty($organization['organizationName']) ? "" : $organization['organizationName'];
		$newOrganization["type"] = empty($organization['type']) ? "" : $organization['type'];
		$newOrganization["postalCode"] = empty($organization['postalCode']) ? "" : $organization['postalCode'];
		$newOrganization["city"] = empty($organization['city']) ? "" : $organization['city'];
		$newOrganization["description"] = empty($organization['description']) ? "" : $organization['description'];
		$newOrganization["tags"] = empty($organization['tagsOrganization']) ? "" : $organization['tagsOrganization'];
		$newOrganization["typeIntervention"] = empty($organization['typeIntervention']) ? "" : $organization['typeIntervention'];
		$newOrganization["typeOfPublic"] = empty($organization['public']) ? "" : $organization['public'];

		return $newOrganization;
	}

	/**
	 * Apply organization checks and business rules before inserting
	 * @param array $organization : array with the data of the organization to check
	 * @return array Organization well format : ready to be inserted
	 */
	public static function getAndCheckOrganization($organization) {
		//email : mandotory 
		if(empty($organization['email'])) {
			throw new CTKException("Vous devez remplir un email.");
		} else {
			//validate Email
			$email = $organization['email'];
			if (! preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$email)) { 
				throw new CTKException("Vous devez remplir un email valide.");
			}
		}

		if (empty($organization['name'])) {
			throw new CTKException("Vous devez remplir un nom pour votre organization.");
		}
		
		// Is There a association with the same name ?
	    $organizationSameName = PHDB::findOne( Organization::COLLECTION,array( "name" => $organization["name"]));      
	    if($organizationSameName) { 
	      throw new CTKException("An organization with the same name already exist in the plateform");
	    }

		$newOrganization = array(
			'email'=>$email,
			"name" => $organization['name'],
			'created' => time()
		);
		
		if (empty($organization['type'])) {
			throw new CTKException("Vous devez remplir le type de votre organization.");
		}
		$newOrganization["type"] = $organization['type'];
				  
		if(!empty($organization['postalCode'])) {
			if (!empty($organization['city'])) {
				$insee = $organization['city'];
				$address = SIG::getAdressSchemaLikeByCodeInsee($insee);
				$newOrganization["address"] = $address;
			}
		}
				  
		if (!empty($organization['description']))
			$newOrganization["description"] = $organization['description'];
				  
		//Tags
		if (isset($organization['tags'])) {
			if ( gettype($organization['tags']) == "array" ) {
				$tags = $organization['tags'];
			} else if ( gettype($organization['tags']) == "string" ) {
				$tags = explode(",", $organization['tags']);
			}
			$newOrganization["tags"] = $tags;
		}
		
		//************************ Spécifique Granddir ********************/
		//TODO SBAR : A sortir du CTK. Prévoir une méthode populateSpecific() à appeler ici
		//Cette méthode sera implémenté dans le Modèle Organization spécifique de Granddir
		//Type of Intervention
		if (!empty($organization["typeIntervention"])) {
			$newOrganization["typeIntervention"] = $organization["typeIntervention"];
		}
	
		//Type of Intervention
		if (!empty($organization["typeOfPublic"])) {
			$newOrganization["typeOfPublic"] = $organization["typeOfPublic"];
		}

		return $newOrganization;
	}

	/**
	 * get an Organisation By Id
	 * @param type $id : is the mongoId of the organisation
	 * @return type
	 */
	public static function getById($id) {

	  	$organization = PHDB::findOne(Organization::COLLECTION,array("_id"=>new MongoId($id)));
	  	
	  	if (empty($organization)) {
            //TODO Sylvain - Find a way to manage inconsistent data
            //throw new CommunecterException("The organization id ".$id." is unkown : contact your admin");
        } else {
			//add the public URL to the data structure
	  		$organization["publicURL"] = '/organization/public/id/'.$id;
        }

	  	return $organization;
	}

	/**
	 * get members an Organization By an organization Id
	 * @param String $id : is the mongoId (String) of the organization
	 * @param String $type : can be use to filter the member by type (all (default), person, organization)
	 * @return arrays of members (links.members)
	 */
	public static function getMembersByOrganizationId($id, $type="all") {
	  	$res = array();
	  	$organization = Organization::getById($id);
	  	
	  	if (empty($organization)) {
            throw new CommunecterException("The organization id is unkown : contact your admin");
        }
	  	if (isset($organization) && isset($organization["links"]) && isset($organization["links"]["members"])) {
	  		$members = $organization["links"]["members"];
	  		//No filter needed
	  		if ($type == "all") {
	  			return $members;
	  		} else {
	  			foreach ($organization["links"]["members"] as $key => $member) {
		            if ($member['type'] == $type ) {
		                $res[$key] = $member;
		            }
	        	}
	  		}
	  	}
	  	return $res;
	}

	/*
	 * Save an organization in database
	 * @param array A well format organization 
	 * @return a json result as an array. 
	 */
	//TODO SBAR => deprecated and not used
	public static function update($organizationId, $organization, $userId) {
		
		//Check if user is authorized to update
		if (! Authorisation::isOrganizationAdmin($userId, $organizationId)) {
			return Rest::json(array("result"=>false, "msg"=>"Unauthorized Access."));
		}

		//Manage tags : save any inexistant tag to DB 
		if(isset($organization["tags"]))
			$organization["tags"] = Tags::filterAndSaveNewTags($organization["tags"]);
	    
	    //update the organization
	    PHDB::update( Organization::COLLECTION,array("_id" => new MongoId($organizationId)), 
	                                          array('$set' => $organization));
    
	    //TODO ???? : add an admin notification
	    Notification::saveNotification(array("type"=>"Updated",
	    						"user"=>$organizationId));
	                  
	    return array("result"=>true, "msg"=>"Votre organisation a été mise à jour.", "id"=>$organizationId);
		
	}
	
	/**
	 * Happens when an Organisation is invited or linked as a member and doesn't exist in the system
	 * It is created in a temporary state
	 * This creates and invites the email to fill extra information 
	 * into the Organisation profile 
	 * @param array $param minimal information in order to create the organization
	 * @return type
	 */
	public static function createAndInvite($param) {
	  	try {
	  		$res = self::insert($param, $param["invitedBy"]);
	  	} catch (CTKException $e) {
	  		$res = array("result"=>false, "msg"=> $e->getMessage());
	  	}
        //TODO TIB : mail Notification 
        //for the organisation owner to subscribe to the network 
        //and complete the Organisation Profile
        
        return $res;
	}

	/**
	 * Get an organization from an id and return filter data in order to return only public data
	 * @param type $id 
	 * @return organization structure
	 */
	public static function getPublicData($id) {
		//Public datas 
		$publicData = array (
			"imagePath",
			"name",
			"city",
			"socialAccounts",
			"url",
			"coi"
		);

		//TODO SBAR = filter data to retrieve only public data	
		$organization = Organization::getById($id);
		if (empty($organization)) {
			throw new CommunecterException("The organization id is unknown ! Check your URL");
		}

		return $organization;
	}

	/**
	 * When an initation to join an organization network is sent :
	 * this method will :
	 * 1. Create a new person and organization.
	 * 2. Make the new person a member and admin of the organization
	 * 3. Join the network of the organization inviting
	 * @param type $person the minimal data to create a person
	 * @param type $organization the minimal data to create an organization
	 * @param type $parentOrganizationId the organization Id to join the network of
	 * @return newPersonId ans newOrganizationId
	 */
	public static function createPersonOrganizationAndAddMember($person, $organization, $parentOrganizationId) {
		//The data check is normaly done before inserting but the both data (organization and person)  
		//must be ok before inserting
		//Check person datas 
		Person::getAndcheckPersonData($person, false);
		//Check organization datas 
		Organization::getAndCheckOrganization($organization);
		
		//Create a new person
		$newPerson = Person::insert($person);

		//Create a new organization
		$newOrganization = Organization::insert($organization, $newPerson["id"]);

		//Link the person as an admin
		Link::addMember($newOrganization["id"], Organization::COLLECTION, $newPerson["id"], PHType::TYPE_CITOYEN, $newPerson["id"], true);

		//Link the organization as a member of the invitor
		
		//TODO SBAR - On GRANDDIR case, the parent organization can manage (data, event, project...) their organization members. 
		//Should be a parameter of the application.
		$isParentOrganizationAdmin = true;
		
		Link::addMember($parentOrganizationId, Organization::COLLECTION, $newOrganization["id"], Organization::COLLECTION, 
						$newPerson["id"], $isParentOrganizationAdmin);
		
		return array("result"=>true, "msg"=>"The invitation process completed with success", "id"=>$newOrganization["id"]);;
	}


	/**
	 * List all the event of an organization and his members
	 * @param String $organisationId : is the mongoId of the organisation
	 * @return all the event link with the organization
	 */
	public static function listEventsPublicAgenda($organizationId){
		$events = array();
		$organization = Organization::getById($organizationId);
		$subOrganization = Organization::getMembersByOrganizationId($organizationId, Organization::COLLECTION);
		if(isset($organization["links"]["events"])){
			foreach ($organization["links"]["events"] as $keyEv => $valueEv) {
				 $event = Event::getPublicData($keyEv);
           		 $events[$keyEv] = $event;
			}
		}
		if(Authorisation::canEditMembersData($organizationId)){
			foreach ($subOrganization as $key => $value) {
				 $newOrganization = Organization::getById($key);
				 if(!empty($newOrganization)&& isset($newOrganization["links"]["events"])){
				 	foreach ($newOrganization["links"]["events"] as $keyEv => $valueEv) {
				 		$event = Event::getPublicData($keyEv);
           		 		$events[$keyEv] = $event;
				 	}
				 }	 
			}
		}
		foreach ($events as $key => $value) {
        	$profil = Document::getLastImageByKey($key, PHType::TYPE_EVENTS, Document::IMG_PROFIL);
        	if($profil!="")
        		$value['imagePath']=$profil;
        }
		return $events;
	}

	/**
	 * Update the roles' list of an organization
	 * @param $roleTab is an array with all the roles
	 * @param type $organisationId : is the mongoId of the organisation
	 */
	public static function setRoles($roleTab, $organizationId){
		PHDB::update( Organization::COLLECTION,
						array("_id" => new MongoId($organizationId)), 
                        array('$set' => array( 'roles' => $roleTab))
                    );
	}

	 /**
	 * Update an organization field value
	 * @param String $organisationId The organization Id to update
	 * @param String $organizationFieldName The name of the field to update
	 * @param String $organizationFieldValue 
	 * @param String $userId 
	 * @return boolean True if the update has been done correctly. Can throw CommunecterException on error.
	 */
	 public static function updateOrganizationField($organizationId, $organizationFieldName, $organizationFieldValue, $userId){
	 	if (!Authorisation::isOrganizationAdmin($userId, $organizationId)) {
			throw new CTKException("Can not update this organization : you are not authorized to update that organization !");	
		}
		$dataFieldName = Organization::getCollectionFieldNameAndValidate($organizationFieldName, $organizationFieldValue);
	
		//Specific case : 
		//Tags
		if ($dataFieldName == "tags") {
			$organizationFieldValue = Tags::filterAndSaveNewTags($organizationFieldValue, $organizationFieldValue);
		}
		//address
		if ($dataFieldName == "address") {
			if(!empty($organizationFieldValue["postalCode"]) && !empty($organizationFieldValue["codeInsee"])) {
				$insee = $organizationFieldValue["codeInsee"];
				$address = SIG::getAdressSchemaLikeByCodeInsee($insee);
				$organization = array("address" => $address);
			} else {
				throw new CTKException("Error updating the Organization : address is not well formated !");			
			}
		} else {
			$organization = array($dataFieldName => $organizationFieldValue);	
		}

		//update the organization
		PHDB::update( Organization::COLLECTION, array("_id" => new MongoId($organizationId)), 
		                          array('$set' => $organization));
	                  
	    return true;
	 }
}
?>