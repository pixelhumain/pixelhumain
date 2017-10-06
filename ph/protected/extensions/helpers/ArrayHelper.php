<?php
class ArrayHelper {
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Array Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Element
 *
 * Lets you determine whether an array index is set and whether it has a value.
 * If the element is empty it returns FALSE (or whatever you specify as the default value.)
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	mixed
 * @return	mixed	depends on what the array contains
 */
	public static function element($item, $array, $default = FALSE)
	{
		if ( ! isset($array[$item]) OR $array[$item] == "")
		{
			return $default;
		}

		return $array[$item];
	}

// ------------------------------------------------------------------------

/**
 * Random Element - Takes an array as input and returns a random element
 *
 * @access	public
 * @param	array
 * @return	mixed	depends on what the array contains
 */
	public static function random_element($array)
	{
		if ( ! is_array($array))
		{
			return $array;
		}

		return $array[array_rand($array)];
	}

// --------------------------------------------------------------------

/**
 * Elements
 *
 * Returns only the array items specified.  Will return a default value if
 * it is not set.
 *
 * @access	public
 * @param	array
 * @param	array
 * @param	mixed
 * @return	mixed	depends on what the array contains
 */
	public static function elements($items, $array, $default = FALSE)
	{
		$return = array();

		if ( ! is_array($items))
		{
			$items = array($items);
		}

		foreach ($items as $item)
		{
			if (isset($array[$item]))
			{
				$return[$item] = $array[$item];
			}
			else
			{
				$return[$item] = $default;
			}
		}

		return $return;
	}

// --------------------------------------------------------------------

/**
 * buildAssocfromStringList 
 * 
 * transforms a string List into a associative array  
 * 
 * @access	public
 * @param	string comma seperated list 
 * @return	associative array 
 */
	public static function buildAssocfromStringList($vals) {
	    $assocArray = array();
	    foreach(explode(',',$vals) as $v)
	        $assocArray[$v]=$v;
	        
	    return $assocArray;
	}

	//return the diff between 2 classes
 	public static function array_diff_assoc_recursive($array1, $array2) 
 	{
        $difference=array();
        foreach($array1 as $key => $value) {
            if( is_array($value) ) {
                if( !isset($array2[$key]) || !is_array($array2[$key]) ) {
                    $difference[$key] = $value;
                } else {
                    $new_diff = self::array_diff_assoc_recursive($value, $array2[$key]);
                    if( !empty($new_diff) )
                        $difference[$key] = $new_diff;
                }
            } else if( !array_key_exists($key,$array2) || $array2[$key] !== $value ) {
                $difference[$key] = $value;
            }
        }
        return $difference;
    }
/**
 * getValueByDotPath 
 * 
 * Json like syntaxe to retreive values in an associative array 
 * ex 
 * 
 * @access	public
 * @param	assocArray
 * @param	string path can be dot seperated , ex : address.streetAddress
 * @return	value
 * @author : tka 
 */
    public static function getValueByDotPath($assocArray , $path) {

	    $split = explode(".", $path);
	    for ($i=0; $i < count($split) ; $i++) 
	    { 
	    	$key = $split[$i];
	    	if( isset( $assocArray[  $key ] ) )
				$assocArray = $assocArray[ $key ];
			else
				$assocArray = "";//"<span class='text-red'>error in path : $path </span>";
		}
		return $assocArray;
	}

	public static function setValueByDotPath($assocArray , $path, $value, $typeValue = null) {
		if(!is_array($path))
	    	$path = explode(".", $path);

	    if(count($path) == 1){
	    	if($typeValue == "INT")
	    		$assocArray[$path[0]] = intval($value);
	    	else if($typeValue == "FLOAT")
	    		$assocArray[$path[0]] = floatval($value);
	    	else if($typeValue == "JSON")
                $assocArray[$path[0]] = json_decode($value, true);
	    	else
	    		$assocArray[$path[0]] = trim($value) ;
	    }
	    else{
	    	$newPath = array_splice($path, 1);
	    	if(empty($assocArray[$path[0]]))
	    		$assocArray[$path[0]] = array();
	    	$assocArray[$path[0]] = self::setValueByDotPath($assocArray[$path[0]] , $newPath, $value, $typeValue);
	    }

		return $assocArray;
	}







/**
 * getAllBranchsJSON
 *
 * Return all branchs of a JSON(array) separed by ";" 
 * For Exemple  : $json = { "name" : "toto", "tel" : { "fixe" : "0000" , "mobile" : "00000"} }
 * return $chaine = "name;tel.fixe;tel.mobile" ;
 * @access	public
 * @param	Array $json
 * @param	String $chaine 
 * @param	Array $pere 
 * @return	string
 * @author : Raphael RIVIERE 
 */

	public static function getAllPath($json, $chaine=null, $pere=null){
        if($chaine==null)
        	$chaine = "" ;
        foreach ($json as $key => $value){
        	if(is_array($value)==true){

            	if($pere == null)
            		$newpere =  $key ;
            	else
            		$newpere =  $pere . "." . $key ;
            	
            	$chaine = self::getAllPath($value, $chaine, $newpere);

            }else{
            	
            	if($pere == null)
            		$chaine = $chaine . $key .  ";";
            	else
            		$chaine = $chaine . $pere . "." . $key .  ";";
            }	
        }
        
        return $chaine ;
    }


     public static function getAllPathJson($json, $attributesElt=null){
        $arrayJson = json_decode($json, true);
        if($attributesElt==null)
            $attributesElt = array() ;
        $arrayPathMapping = explode(";", self::getAllPath($arrayJson));
        foreach ($arrayPathMapping as $keyPathMapping => $valuePathMapping){
            if(!empty($valuePathMapping) && !in_array($valuePathMapping, $attributesElt))
                $attributesElt[] =  $valuePathMapping;
        }
        return $attributesElt ;
    }

    public static function arrayToString($array, $separator = ", ") {
		$str = "";
		foreach ($array as $key => $val) {
			$str .= ($str != "") ? $separator.trim($val) : trim($val);
		}
		return $str ;
	}
}



/* End of file array_helper.php */
/* Location: ./system/helpers/array_helper.php */