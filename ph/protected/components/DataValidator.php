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
		return (! isEmpty($toValidate));
	}

	public static function email($toValidate) {
		if (! preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$toValidate)) { 
			return false;
		} else {
			return true;
		}
	}
}