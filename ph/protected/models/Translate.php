<?php 

class Translate {
	const FORMAT_SCHEMA = "schema";
	const FORMAT_PLP = "plp";

	public static function schema($data)
	{
		$newData = array();
		foreach ($data as $key => $value) {
			$newData[$key] = array();
			if ( isset($value) ) {
				$newData["name"] = $value["name"];
			}
		}
		return $newData;
	}

	public static function plp($data)
	{
		$newData = array();
		foreach ($data as $key => $value) {
			$newData[$key] = array();
			if ( isset($value) ) {
				$newData["name"] = $value["name"];
			}
		}
		return $newData;
	}
}