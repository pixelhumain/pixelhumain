<?php
/*
Contains anything generix for the site 
 */
class SIG
{
    
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
	public function addGeoPositionToEntity($entity){
		if(empty($entity["geo"]) && !empty($entity["address"]["postalCode"])){
			$geoPos = $this->getPositionByCp($entity["address"]["postalCode"]);
			if($geoPos != false){
				$entity["geo"] = $geoPos;
			}
			
		}return $entity;
	}
  	//récupère la position géographique depuis les Cities
  	//get geo position from Cities collection in data base
	private function getPositionByCp($cp){
  		$city = PHDB::findOne ( 'cities', array("cp"=>$cp) );
		if(!empty($city)){
			return array( 	"@type" => "GeoCoordinates",
							"latitude" => $city["geo"]["coordinates"][1],
							"longitude" => $city["geo"]["coordinates"][0]);
		} return false;
		
	}
    
}