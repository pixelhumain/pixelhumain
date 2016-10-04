<?php 
/**
 * DataValidator.php
 *
 * DataValidator class help Validates the data of objects
 * @author: Sylvain Barbot <sylvain@pixelhumain.com>
 * Date: 27/06/2014
 */

class DataValidator {

	public static function required($toValidate, $objectId=null) {
		$res = "";
		if (empty($toValidate)) {
			$res = "The Field is required";
		}
		return $res;
	}

	public static function email($toValidate, $objectId=null) {
		$res = "";
		if (! preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$toValidate) && !empty($toValidate)) { 
			$res = "The email is not well formated";
		} else {
			$domain = explode("@",$toValidate);
        	$domain = array_pop($domain); 
        	//check dns
        	// idn_to_ascii comment because of undefined function depending on php version and intl extension
        	//if(! checkdnsrr(idn_to_ascii($domain),"MX")){

	  		if(!empty($domain) && ! checkdnsrr($domain,"MX")){
				$res = "Unknown domain : please check your email !";
			}
		}
		return $res;
	}
	
	public static function organizationSameName($toValidate, $objectId=null) {
		// Is There a association with the same name && it is not the current organization ?
	    $res = "";
	    $organizationSameName = PHDB::findOne(Organization::COLLECTION,array( "name" => $toValidate));      
	    if ($organizationSameName && isset($objectId) && $objectId !=  (String) $organizationSameName["_id"]){ 
	    	$res = "An organization with the same name allready exists";
	    }
	    return $res;
	}

	public static function checkUsername($toValidate, $objectId=null) {
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

	public static function eventStartDate($toValidate, $objectId) {
		$event = Event::getById($objectId);
		return self::startDate($toValidate, $event);
	}

	public static function eventEndDate($toValidate, $objectId) {
		$event = Event::getById($objectId);
		return self::endDate($toValidate, $event);
	}

	public static function projectStartDate($toValidate, $objectId) {
		$project = Project::getById($objectId);
		return self::startDate($toValidate, $project);
	}

	public static function projectEndDate($toValidate, $objectId) {
		$project = Project::getById($objectId);
		return self::endDate($toValidate, $project);
	}

	public static function getCollectionFieldNameAndValidate($dataBinding, $fieldName, $fieldValue, $objectId = null) {
		
		if (isset($dataBinding[$fieldName])) {
			$data = $dataBinding[$fieldName];
			$name = $data["name"];
			//Validate field
			if (isset($data["rules"])) {
				$rules = $data["rules"];
				foreach ($rules as $rule) {
					$isDataValidated = DataValidator::$rule($fieldValue, $objectId);
					if ($isDataValidated != "") {
						throw new CTKException($isDataValidated);
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
	public static function validate( $type, $values ) 
	{
		//var_dump($type); return;
		$dataBinding = $type::$dataBinding;
		//var_dump($dataBinding); return;
		//var_dump($values); return;
		$res = array("result"=>true);
		foreach ( $values as $key => $value ) 
		{
			try{
				if ( isset( $dataBinding[$key]) ) 
					self::getCollectionFieldNameAndValidate( $dataBinding, $key, $value );
				else {
					$res["result"] = false;
					$res["msg"] = $key;
				}
			} catch( Exception $e ) {
				$res["result"] = false;
				$res["msg"] = $e;
			}
		}
		return $res;
	}	

	private static function startDate($toValidate, $object) {
		// Is the start Date before endDate
	    $res = "";
	    $endDate = DateTime::createFromFormat('Y-m-d H:i:s', $object["endDate"]);
	    $startDate = DateTime::createFromFormat('Y-m-d H:i', $toValidate);
	    
		//Try to convert the startDate
		if (empty($startDate)) {
			$startDate = DateTime::createFromFormat('Y-m-d', $toValidate);
		} 
	    if (empty($startDate)) {
			throw new CTKException("The start date is not well formated");
		}

	    if ($startDate > $endDate) { 
	    	$res = "The start date must be before the end date";
	    }
	    return $res;
	}

	private static function endDate($toValidate, $object) {
		// Is the end Date after start Date
	    $res = "";
	    $startDate = DateTime::createFromFormat('Y-m-d H:i:s', $object["startDate"]);
	    
	    //Try to convert the endDate
	    $endDate = DateTime::createFromFormat('Y-m-d H:i', $toValidate);
	    if (empty($endDate)) {
			$endDate = DateTime::createFromFormat('Y-m-d', $toValidate);
		} 
	    if (empty($endDate)) {
			throw new CTKException("The end date is not well formated");
		}

	    if ($startDate > $endDate) { 
	    	$res = "The end date must be after the start date";
	    }
	    return $res;
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

	public static function source($toValidate, $objectId=null) {
		$res = "";
		$strings = array("key", "url", "id");
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

	

}