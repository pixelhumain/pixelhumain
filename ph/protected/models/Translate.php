<?php 

class Translate {
	public static $translate = array( 
		"fr" => array( 
			"name" => "Nom",
			"location[name]" => "Lieu",
		),
		"en" => array( 
			"name" => "Name",
			"location[name]" => "Place" 
		),
	);

	public static function key($key,$lang="fr")
	{
		$lang = (isset(Yii::app()->session["userLang"])) ? Yii::app()->session["userLang"] : $lang;
		if(isset(self::$translate[$lang][$key]))
			return self::$translate[$lang][$key];
		else
			return $key;
	}
}