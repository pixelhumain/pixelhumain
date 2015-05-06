<?php 
/**
 * DataValidator.php
 *
 * DataValidator class help Validates the 
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 27/06/2014
 */

class DataValidator {

	public static function required($toValidate) {
		$res = "";
		if (empty($toValidate)) {
			$res = "The Field is required";
		}
		return $res;
	}

	public static function email($toValidate) {
		$res = "";
		if (! preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$toValidate)) { 
			$res = "The email is not well formated";
		}
		return $res;
	}
	
	public static function organizationSameName($toValidate) {
		// Is There a association with the same name ?
	    $res = "";
	    $organizationSameName = PHDB::findOne(Organization::COLLECTION,array( "name" => $toValidate));      
	    if ($organizationSameName) { 
	    	$res = "An organization with the same name allready exists";
	    }
	    return $res;
	}

}