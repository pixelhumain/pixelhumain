<?php
class XmlHelper {

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
 * CodeIgniter XML Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/xml_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Convert Reserved XML characters to Entities
 *
 * @access	public
 * @param	string
 * @return	string
 */
	public static function xml_convert($str, $protect_all = FALSE)
	{
		$temp = '__TEMP_AMPERSANDS__';

		// Replace entities to temporary markers so that
		// ampersands won't get messed up
		$str = preg_replace("/&#(\d+);/", "$temp\\1;", $str);

		if ($protect_all === TRUE)
		{
			$str = preg_replace("/&(\w+);/",  "$temp\\1;", $str);
		}

		$str = str_replace(array("&","<",">","\"", "'", "-"),
							array("&amp;", "&lt;", "&gt;", "&quot;", "&apos;", "&#45;"),
							$str);

		// Decode the temp markers back to entities
		$str = preg_replace("/$temp(\d+);/","&#\\1;",$str);

		if ($protect_all === TRUE)
		{
			$str = preg_replace("/$temp(\w+);/","&\\1;", $str);
		}

		return $str;
	}
}

/**
 * Convert an XML into an array
 *
 * @access	public
 * @param	string
 * @return	string
 */
public static function amstore_xmlobj2array($obj, $level=0) 
{
    
    $items = array();
    
    if(!is_object($obj)) return $items;
        
    $child = (array)$obj;
    $nodeId = null;
    if(sizeof($child)>1) 
    {
        foreach($child as $aa=>$bb) 
        {
            if(is_array($bb)) {
                if(isset($bb["nodeId"]))
                  	$nodeId = "node".$bb["nodeId"];
                foreach($bb as $ee=>$ff) 
                {
                    if(!is_object($ff)) 
                    {
                        $items[$nodeId][$ee] = $ff;
                    } 
                    elseif(get_class($ff)=='SimpleXMLElement') 
                    {
                        if(!isset( $items[$nodeId]["children"] ))
                          $items[$nodeId]["children"] = array();
                        $items[$nodeId]["children"][$ee] = self::amstore_xmlobj2array($ff,$level+1);
                    }
                }
            } 
            elseif(!is_object($bb)) 
            {
                $items[$aa] = $bb;
            } 
            elseif(get_class($bb)=='SimpleXMLElement') 
            {
                if(!isset( $items[$nodeId]["children"] ))
                  $items[$nodeId]["children"] = array();
                $items[$nodeId]["children"] = self::amstore_xmlobj2array($bb,$level+1);
            }
        }
    } else
    if(sizeof($child)>0) {
        foreach($child as $aa=>$bb) {
            if(!is_array($bb)&&!is_object($bb)) {
                $items[$aa."OOOOO"] = $bb;
            } else
            if(is_object($bb)) {
                $items[$aa] = self::amstore_xmlobj2array($bb,$level+1);
            } else {
                foreach($bb as $cc=>$dd) {
                    if(!is_object($dd)) {
                        $items[$obj->getName()][$cc] = $dd;
                    } else
                    if(get_class($dd)=='SimpleXMLElement') {
                        $items[$obj->getName()."ZZZZZZ"][$cc] = self::amstore_xmlobj2array($dd,$level+1);
                    }
                }
            }
        }
    }

    return $items;
}

// ------------------------------------------------------------------------

/* End of file xml_helper.php */
/* Location: ./system/helpers/xml_helper.php */