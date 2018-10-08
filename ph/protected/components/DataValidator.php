<?php 
/**
 * DataValidator.php
 *
 * DataValidator class help Validates the data of objects
 * @author: Sylvain Barbot <sylvain@pixelhumain.com>
 * Date: 27/06/2014
 */

class DataValidator {

	public static function required($toValidate, $object=null, $objectId=null) {
		$res = "";
		if (empty($toValidate)) {
			$res = "The Field is required";
		}
		return $res;
	}

	public static function notexist($toValidate, $object=null, $objectId=null) {
		$res = "";
		$query = array("url"=>@$toValidate);
        $siteurl = PHDB::findOne("url", $query);

        if(isset($siteurl["_id"]))
        	$res = "This url already exists";

		return $res;
	}

	public static function email($toValidate, $object=null, $objectId=null) {
		$res = "";
		if (! preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$toValidate) && !empty($toValidate)) { 
			$res = Yii::t("common", "The email is not well formated");
		} else {
			$domain = explode("@",$toValidate);
        	$domain = array_pop($domain); 
        	//check dns
        	// idn_to_ascii comment because of undefined function depending on php version and intl extension
        	//if(! checkdnsrr(idn_to_ascii($domain),"MX")){

	  		if(!empty($domain) && ! checkdnsrr($domain,"MX")){
				$res = Yii::t("common", "Unknown domain : please check your email !");
			}
		}
		return $res;
	}
	
	public static function organizationSameName($toValidate, $object=null, $objectId=null) {
		// Is There a association with the same name && it is not the current organization ?
		$res = "";

	    if(!empty($object["address"]))
	    	$organizationSameName = PHDB::findOne(Organization::COLLECTION,
	    										array( 	"name" => $toValidate, 
	    												"address.postalCode" => $object["address"]["postalCode"],
	    												"address.addressLocality" => $object["address"]["addressLocality"]));      
	    else
	    	$organizationSameName = null ;
	    if ($organizationSameName && !empty($objectId) && $objectId !=  (String) $organizationSameName["_id"]){ 
	    	$res = "An organization with the same name allready exists";
	    }
	    return $res;
	}

	public static function checkUsername($toValidate, $object=null, $objectId=null) {
		// Is There a user with the same username ?
	    $res = "";
	    if (strlen($toValidate) < 4 || strlen($toValidate) > 32) {
		  	$res = "The username length should be between 4 and 32 characters";
		} 
	    $uniqueUsername = PHDB::findOne(Person::COLLECTION,array( "username" => $toValidate));      
	    if ($uniqueUsername) { 
	    	$res = "A user with the same username allready exists";
	    }
	    return $res;
	}
	public static function checkSlug($toValidate, $object=null, $objectId=null) {
		// Is There a user with the same username ?
	    $res = "";
	    if (strlen($toValidate) < 3 || strlen($toValidate) > 100) {
		  	$res = "The slug length should be between 3 and 50 characters";
		}
		if(! preg_match('/^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$/ ', $toValidate)) {
			$res = "Not valid slug : content accent or space or not finish by letter or number";	
		}
	    /*$notExist = Slug::check($toValidate);      
	    if (! $notExist) { 
	    	$res = "This slug allready exists";
	    }*/
	    return $res;
	}

	/**
	 * Check if an event has a well formated startDate and if the start date is well formated
	 * @param String $toValidate the string representation of the startdate. could be 'Y-m-d H:i:s' or 'Y-m-d H:i' or 'Y-m-d'
	 * @param String or array $object 
	 * 		if is a string it represent the event id and it will be retrieve from the db (update process). 
	 * 		Else if it's an array it is already the object (creation process)
	 * @return String : if empty : no problemo else the error message
	 */
	public static function eventStartDate($toValidate, $object, $objectId) {
		if (is_string($object)) { 
			$event = Event::getById($object);
		} else if (is_array($object)){
			$event = $object;
		}
		return self::startDate($toValidate, $event);
	}

	public static function eventEndDate($toValidate, $object, $objectId) {
		if (is_string($object)) { 
			$event = Event::getById($object);
		} else if (is_array($object)){
			$event = $object;
		}
		return self::endDate($toValidate, $event);
	}

	/*public static function projectStartDate($toValidate, $object, $objectId) {
		$project = Project::getById($objectId);
		return self::startDate($toValidate, $project);
	}

	public static function projectEndDate($toValidate, $object, $objectId) {
		$project = Project::getById($objectId);
		return self::endDate($toValidate, $project);
	}*/

	public static function getCollectionFieldNameAndValidate($dataBinding, $fieldName, $fieldValue, $object = null, $import=null, $id=null) {
		// var_dump($fieldName);
		// var_dump($dataBinding);
		if (isset($dataBinding[$fieldName])) {
			$data = $dataBinding[$fieldName];
			$name = $data["name"];
			//Validate field
			if (isset($data["rules"])) {
				$rules = $data["rules"];
				$functionImport = array("organizationSameName") ;
				
				foreach ($rules as $rule) {
					if( empty($import) || !in_array($rule, $functionImport) ){
						$isDataValidated = DataValidator::$rule($fieldValue, $object, $id);
						if ($isDataValidated != "") {
							throw new CTKException($isDataValidated);
						}
					}	
				}	
			}
		} else {
			throw new CTKException("Unknown field :".$fieldName);
		}
		return $name;
	}

	/*
	validates each field existance, type is respected and if any rules 
	*/
	public static function validate( $type, $values, $import = null, $id=null ) 
	{
		
		$dataBinding = $type::$dataBinding;
		//var_dump($dataBinding); return;
		//var_dump($values); return;

		$res = array("result"=>true);
		foreach ( $values as $key => $value ) 
		{
			try{
				
				if ( isset( $dataBinding[$key]) ) {
					self::getCollectionFieldNameAndValidate( $dataBinding, $key, $value, $values, $import, $id);
				} else {
					error_log("error : ".$key);
					$res["result"] = false;
					$res["msg"] = "Contenu Invalide ".$key;
				}
			} catch( Exception $e ) {
				error_log("error : ".$key);
				$res["result"] = false;
				$res["msg"] = $e->getMessage();
			}
		}
		return $res;
	}	

	/**
	 * Check the format of the startDate
	 * compare the startDate to the endDate that is contained in the object
	 * @param String $toValidate the startDate to validate. 
	 * @param array $object containing the endDate value to compare with the start date
	 * @return empty or an error message
	 */
	private static function startDate($toValidate, $object=null, $objectId=null) {
		// Is the start Date before endDate
	    error_log("Validate start Date : ".$toValidate." compare to endDate ".$object["endDate"] );
	    $res = "";
	    
	    $startDate = self::getDateTimeFromString($toValidate, "start date");
	    $endDate = self::getDateTimeFromString(@$object["endDate"], "end date");
	    
	    if ($startDate > $endDate) { 
	    	$res = "The start date must be before the end date";
	    }
	    return $res;
	}

	private static function endDate($toValidate, $object=null, $objectId=null) {
		// Is the end Date after start Date
	    $res = "";
	    $startDate = self::getDateTimeFromString(@$object["startDate"], "start date");
	    $endDate = self::getDateTimeFromString($toValidate, "end date");
	    
	    if ($startDate > $endDate) { 
	    	$res = "The end date must be after the start date";
	    }
	    return $res;
	}

	public static function getDateTimeFromString($myDate, $label) {


		$result = DateTime::createFromFormat('Y-m-d H:i', $myDate);
	    if (empty($result)) {
			$result = DateTime::createFromFormat('Y-m-d', $myDate);
		}

		if (empty($result)) {
			$result = DateTime::createFromFormat('Y-m-d H:i:s', $myDate);
		}

		if (empty($result)) {
			$result = DateTime::createFromFormat(DateTime::ISO8601, $myDate);
		}

	    if (empty($result)) {
			error_log("Error formation : ".$myDate." (".$label.")");
	    	throw new CTKException("The ".$label." is not well formated");
		}
		
		return $result;
	}

	/*
	validates each field existance, type is respected and if any rules 
	*/
	public static function validateImport( $type, $values ) 
	{
		//var_dump($type); return;
		$dataBinding = $type::$dataBinding;
		//var_dump($dataBinding); return;
		$res = array("result"=>true,
						"msg"=>"");
		foreach ( $values as $key => $value ) 
		{
			try{
			  self::getCollectionFieldNameAndValidate( $dataBinding, $key, $value );
			} catch( Exception $e ) {
				$res["result"] = false;
				$res["msg"] .= $e."</br>";
			}
		}
		return $res;
	}

	public static function source($toValidate, $object=null, $objectId=null) {
		$res = "";
		$strings = array("key", "url");
		$allKeysSource = array('id', "key", "keys", "url", "update", "insertOrign");
		if(!empty($toValidate)){
			foreach ($toValidate as $key => $value) {
				if($key == "keys" && !is_array($value))
					$res .= "Keys is not array !";
				if(in_array($key, $strings) && !is_string($value))
					$res .= $key." is not string !";
				if(!in_array($key, $allKeysSource))
					$res .= "This ".$key." is not a Source !";
			}
		}
		return $res;
	}


	public static function typeOrganization($toValidate) {
		$result = (Organization::checkType($toValidate)?"":"Le type de l'organisation n'est pas conforme.");
		return $result;
	}

	/**
	 * Check if the adress is well formated
	 * An adress is an array and is valid with the format :
	 *     - Country : mandatory
	 *     - 
	 * @param array $toValidate the adresse to validate
	 * @return type
	 */
	public static function addressValid($toValidate) {
		$res = "";
		error_log("AddressValid = ".json_encode($toValidate));
		//Check country => Mandatory
		if (empty($toValidate["addressCountry"])) return "Country missing in the address !";
		//Check country => Mandatory
		if (empty($toValidate["addressLocality"])) return "City name missing in the address !";
		//Check insee => Mandatory
		if (empty($toValidate["osmID"]) && empty($toValidate["localityId"])) return "CityId missing in the address !";
		//Check insee => Mandatory
		//if (empty($toValidate["codeInsee"])) return "CityId missing in the address !";
		//Check cp => Mandotory
		//if (empty($toValidate["postalCode"])) return "Postal Code missing in the address !";
		
		//Check country, cp and insee are coherent in bd
		
		if(!empty($toValidate["localityId"])){
			$city = City::getById($toValidate["localityId"]);
			if ($city["country"] != $toValidate["addressCountry"]) return "Invalid CityId with that country !";
			// $postalCodeOk = false;
			// foreach ($city["postalCodes"] as $postalCode) {
			// 	if ($postalCode["postalCode"] == $toValidate["postalCode"]) {
			// 		$postalCodeOk = true;
			// 		break;
			// 	}
			// }
			// if (! $postalCodeOk) return "Invalid postal code and insee code";
		}
		

		return $res;
	}

	/**
	 * Check if the geo is well formated
	 * An geo is an array and is valid with the format :
	 * @param array $toValidate the geo to validate
	 * @return type
	 */
	public static function geoValid($toValidate) {
		$res = "";
		error_log("geoValid = ".json_encode($toValidate));
		if(!empty($toValidate["addressesIndex"]))
			unset($toValidate["addressesIndex"]);

		if(!empty($toValidate)){
			//Check type 
			if (empty($toValidate["@type"])) return "Type missing in the geo !";
			if ($toValidate["@type"] != "GeoCoordinates") return "Type missing in the geo !";
			//Check latitude
			if (empty($toValidate["latitude"])) return "latitude missing in the geo !";
			if (!is_string($toValidate["latitude"])) return "latitude is not a string in the geo !";
			//Check longitude
			if (empty($toValidate["longitude"])) return "longitude Code missing in the geo !";
			if (!is_string($toValidate["longitude"])) return "longitude is not a string in the geo !";
		}
		return $res;
	}

	/**
	 * Check if the geo is well formated
	 * An geo is an array and is valid with the format :
	 * @param array $toValidate the geo to validate
	 * @return type
	 */
	public static function geoPositionValid($toValidate) {
		$res = "";
		error_log("geoPosition = ".json_encode($toValidate));
		if(!empty($toValidate["addressesIndex"]))
			unset($toValidate["addressesIndex"]);

		if(!empty($toValidate)){
			//Check type 
			if (empty($toValidate["type"])) return "Type missing in the geoPosition !";
			if ($toValidate["type"] != "Point") return "Type missing in the geoPosition !";
			//Check longitude
			if (empty($toValidate["coordinates"][0])) return "longitude Code missing in the geoPosition !";
			if (!is_float($toValidate["coordinates"][0])) return "longitude is not a float in the geoPosition !";
			//Check latitude
			if (empty($toValidate["coordinates"][1])) return "latitude missing in the geoPosition !";
			if (!is_float($toValidate["coordinates"][1])) return "latitude is not a float in the geoPosition !";
		}

		return $res;
	}


	public static function geoShapeValid($toValidate) {
		$res = "";
		if(!empty($toValidate)){
			//Check type 
			if (empty($toValidate["type"])) return "Type missing in the geoShape !";
			if ($toValidate["type"] != "Polygon") return "Type missing in the geoShape !";
			//Check coordinates
			if (empty($toValidate["coordinates"])) return "Value missing in the geoShape !";
		}

		return $res;
	}

	public static function boolean($toValidate) {
		if (!is_bool($toValidate)) 
			return "Invalid boolean";
	}
	
	/**
	 * Check the organizer
	 * @param array $toValidate array with organizerId and organizerType
	 * @return string empty if the organizer is valid, the error message else
	 */
	public static function validOrganizer($toValidate) {
		return "";
	}


	public static function postalCodesValid($toValidate, $object=null, $objectId=null) {
		$res = "";
		$strings = array("key", "url", "id");
		$allKeysSource = array('id', "key", "keys", "url", "update", "insertOrign");
		if(!empty($toValidate)){
			foreach ($toValidate as $key => $value) {
				if(empty($value["name"]))
					$res .= "Il manque le nom associer au code postal !";
				if(empty($value["postalCode"]))
					$res .= "Il manque le code postal !";
				if(empty($value["geo"]))
					$res .= "Il manque la geo associer au code postal !";
				else
					$res .= geoValid($value["geo"]);
				$res .= (!empty($value["geo"])?geoValid($value["geo"]):"Il manque la geo associer au code postal !");
				$res .= (!empty($value["geoPosition"])?geoPositionValid($value["geo"]):"Il manque la geoPosition associer au code postal !");
			}
		}
		return $res;
	}

	/*public static function contact($toValidate) {

		return $res;
	}*/

}