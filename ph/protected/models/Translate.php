<?php 

class Translate {
	public static $translate = array( 
		"fr" => array( 
			"name" => "Nom",
			"location[name]" => "Lieu",
			"location[address][addressLocality]"=>"Ville",
			"location[address][streetAddress]" => "Address",
			"location[address][postalCode]"=>"Code Postal",
			"eventStatus[additionalType]"=>"Status",
			"offers[price]"=>"Prix",
			"offers[inventoryLevel][value]"=>"Place Restante",
			"offers[inventoryLevel][maxValue]"=>"Nb de Place Max",
			"offers[inventoryLevel][minValue]"=>"Nb de Place Min",
			"image"=>"Image",
			"gender"=>"Genre",
			"email"=>"Email",
			"address[postalCode]"=>"Code Postal", 
			"address[addressLocality]"=>"Ville", 	
			"address[streetAddress]"=>"Address", 	
			"birthDate"=>"Date de naissance", 	 
			"description"=>"Description", 	
			"familyName"=>"Nom de Famille" 
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