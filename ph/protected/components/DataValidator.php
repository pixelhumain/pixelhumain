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
		if (! isEmpty($toValidate))	return "The Field is required";
	}

	public static function email($toValidate) {
		if (! preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$toValidate)) { 
			return "The email is not well formated";
		} else {
			return "";
		}
	}
	
	public static function organizationSameName($toValidate) {
		// Is There a association with the same name ?
	    $organizationSameName = PHDB::findOne( Organization::COLLECTION,array( "name" => $toValidate);      
	    if($organizationSameName) { 
	    	return false;
	    } else {
	    	return true;
	    }
	}

}