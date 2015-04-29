<?php
/*
Contains anything generix for the site 
 */
class SIG
{
    const CITIES_COLLECTION_NAME = "cities";

    public static function clientScripts()
    {
        $cs = Yii::app()->getClientScript();
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/sig.css');
		$cs->registerCssFile("http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css");
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/leaflet.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/leaflet.draw.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/leaflet.draw.ie.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/MarkerCluster.css');
		$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/css/MarkerCluster.Default.css');

		$cs->registerScriptFile('http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js');
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/leaflet.draw-src.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/leaflet.draw.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/leaflet.markercluster-src.js' , CClientScript::POS_END);
		return $cs;
    }
    
	
	//ajoute la position géographique d'une donnée si elle contient un Code Postal
	//add geographical position to a data if it contains Postal Code
	public static function addGeoPositionToEntity($entity){
		if(empty($entity["geo"]) && !empty($entity["address"]["postalCode"])){
			$geoPos = self::getPositionByCp($entity["address"]["postalCode"]);
			if($geoPos != false){
				$entity["geo"] = $geoPos;
			}
			
		}return $entity;
	}
  	//récupère la position géographique depuis les Cities
  	//get geo position from Cities collection in data base
	public static function getPositionByCp($cp){
  		$city = PHDB::findOne ( 'cities', array("cp"=>$cp) );
		if(!empty($city)){
			return array( 	"@type" => "GeoCoordinates",
							"latitude" => $city["geo"]["latitude"],
							"longitude" => $city["geo"]["longitude"]);
		} return false;
		
	}

	/**
	 * Get the city by insee code. Can throw Exception if the city is unknown.
	 * @param String $codeInsee the code insee of the city
	 * @return Array With all the field as the cities collection
	 */
	public static function getCityByCodeInsee($codeInsee) {
		if (empty($codeInsee)) {
			throw new InvalidArgumentException("The Insee Code is mandatory");
		}

		$city = PHDB::findOne(SIG::CITIES_COLLECTION_NAME, array("insee" => $codeInsee));
		if (empty($city)) {
			throw new CTKException("Impossible to find the city with the insee code : ".$codeInsee);
		} else {
			return $city;
		}
	}

	/**
	 * Get the city label by insee code. Can throw Exception if the city is unknown.
	 * @param String $codeInsee the code insee of the city
	 * @return Array With all the field as the cities collection
	 */
	public static function getCitiesByPostalCode($postalCode) {
		if (empty($postalCode)) {
			throw new InvalidArgumentException("The postal Code is mandatory");
		}

		$city = PHDB::findAndSort(SIG::CITIES_COLLECTION_NAME, array("cp" => $postalCode), array("name" => -1));
		if (empty($city)) {
			throw new CTKException("Impossible to find the city with the postal code : ".$postalCode);
		} else {
			return $city;
		}
	}    
}