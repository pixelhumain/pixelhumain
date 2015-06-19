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
		if (! preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$toValidate)) { 
			$res = "The email is not well formated";
		}
		return $res;
	}
	
	public static function organizationSameName($toValidate, $objectId=null) {
		// Is There a association with the same name ?
	    $res = "";
	    $organizationSameName = PHDB::findOne(Organization::COLLECTION,array( "name" => $toValidate));      
	    if ($organizationSameName) { 
	    	$res = "An organization with the same name allready exists";
	    }
	    return $res;
	}

	public static function eventStartDate($toValidate, $objectId) {
		// Is the start Date before endDate
	    $res = "";
	    $event = Event::getById($objectId);
	    $endDate = DateTime::createFromFormat('Y-m-d H:i:s', $event["endDate"]);
	    $startDate = DateTime::createFromFormat('Y-m-d H:i', $toValidate);

	    if ($startDate > $endDate) { 
	    	$res = "The start date of the event must be before the end date";
	    }
	    return $res;
	}

	public static function eventEndDate($toValidate, $objectId) {
		// Is the end Date after start Date
	    $res = "";
	    $event = Event::getById($objectId);
	    $startDate = DateTime::createFromFormat('Y-m-d H:i:s', $event["startDate"]);
	    $endDate = DateTime::createFromFormat('Y-m-d H:i', $toValidate);
	    if ($startDate > $endDate) { 
	    	$res = "The end date of the event must be after the start date";
	    }
	    return $res;
	}

	public static function getCollectionFieldNameAndValidate($dataBinding, $fieldName, $fieldValue) {
		$res = "";
		if (isset($dataBinding["$fieldName"])) {
			$data = $dataBinding["$fieldName"];
			$name = $data["name"];
			//Validate field
			if (isset($data["rules"])) {
				$rules = $data["rules"];
				foreach ($rules as $rule) {
					$isDataValidated = DataValidator::$rule($fieldValue);
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

}