<?php
/**
 * [actionAddWatcher 
 * create all data needed for SIG module (=> collection "cities")
 * if the collection doesn't exist creates the collection and import data from json file
 * else simply send alert and exit ]
 * @return [string] 
 */
class ImportDataAction extends CAction
{
    public function run()
    {
    	//$result = $this->createPartners();			//créé des citoyens Partenaires et PixelActif
        //$result = $this->importFromJson();			//importe les cities depuis fichier .json vers dbb
        //$result .= $this->checkPositionCitoyens();	//update la position geo des citoyens
     	//$result = $this->updateGeoPositionCitoyens();
    	//$result = $this->updateGeoPositionCities();
    	
    	$result = "Par sécurité, l'execution de ce script est désactivé. Merci de choisir une action (->contrll ImportDataAction) avant d'executer ce script";
		Rest::json($result);  
		Yii::app()->end();
	}
	
	  public function createPartners()
	  {
	  	//augmente la limite de la mémoire pour charger tout le fichier json
		ini_set("memory_limit","100M"); 
		
		//charge le fichier json en memoire
		$fp = fopen ("../../modules/sig/data/_partners_.json", "r");  	
		$contenu_du_fichier = fread ($fp, filesize('../../modules/sig/data/_partners_.json')); //charge le contenu du fichier
		fclose ($fp);
		//transforme le flux en structure json   
		$partnersJson = json_decode ($contenu_du_fichier); 
		
		$result = "loading _partners_.json file ok<br/>";
		$result .= $partnersJson->type;
		foreach($partnersJson->features as $partner) {
				
			$citoyen = array(	'name' => $partner->properties->name,
								'tag' => $partner->properties->tag,
                                'created' => time(),
                                'geo' => array("type" => $partner->geometry->type,	
                                			   "coordinates" => array( $partner->geometry->coordinates[1],
                                			   						   $partner->geometry->coordinates[0] )
                                		 )
								);
			$result .= " name : ".$partner->properties->name;
			Yii::app()->mongodb->citoyens->insert($citoyen);
		}	
		return $result;
	  }
	  
	  
	  public function importFromJson()
	  {	
	  	//augmente la limite de la mémoire pour charger tout le fichier json
		ini_set("memory_limit","300M"); 
		
		//charge le fichier json en memoire
		$fp = fopen ("../../modules/sig/data/_cities_geok_.json", "r");  	
		$contenu_du_fichier = fread ($fp, filesize('../../modules/sig/data/_cities_geok_.json')); //charge le contenu du fichier
		fclose ($fp);
		
		
		//transforme le flux en structure json   
		$json = json_decode ($contenu_du_fichier); 
		$result = "loading json file ok<br/>";
		$mongo = new MongoClient();
		$db = $mongo->selectDB($_POST['dbName']);

		$result .= "database found<br/>".$_POST['dbName'];
		
		$collectionName = "cities_geok";
		
		foreach($json as $city) {
				$result .= " - ".$city["name"];
				$i++;
				if($i > 10) break;
				//Yii::app()->mongodb->cities_geok->insert($city);
			}

		if(!$this->collection_exists($collectionName, $db)) { 			//si la collection n'existe pas 
			$result .= "creating collection '".$collectionName."'<br/>";//on la créé
			$db->createCollection ($collectionName); 
		
			$result .= "importing data<br/>";	
			// $i=0;						//puis on importe les données
// 			foreach($json as $city) {
// 				$result .= " - ".$city["name"];
// 				$i++;
// 				if($i > 10) break;
// 				//Yii::app()->mongodb->cities_geok->insert($city);
// 			}	
			$result .= "<br/><h4>Les données semblent avoir été importées avec succès !</h4>";
		}
		else {															//si la collection existe
			$result .= "<br/><h5>La collection existe déjà dans votre base de données. Supprimez la collection avant d'importer les données.</h5>";
		}
		
		return $result;
	  }
	
			  public function collection_exists($newCollectionName, $db){  
				$collections = $db->listCollections();
				$collectionNames = array();
				foreach ($collections as $collection) {
					$collectionNames[] = $collection->getName();
				}
				return in_array($newCollectionName, $collectionNames);
			 }	
		
	
	
	
	 /* REFACTOR */	
	 
	 
	 public function updateGeoPositionCitoyens()
	 {
     	
     	//augmente la limite de la mémoire pour charger tout le fichier json
		ini_set("memory_limit","100M"); 
		
		$query = array( 'cp' => array( '$exists' => true ),
						'geo' => array( '$exists' => false )
					  );
	 	
	 	$citoyens =  iterator_to_array(Yii::app()->mongodb->citoyens->find($query)); //->limit(1)
     	$result = "deb";
     	$i=0;
     	foreach ($citoyens as $citoyen)
     	{
     		
			//trouve la ville qui correspond au cp                    
			$queryCity = array( "cp" => strval(intval($citoyen["cp"])),
								"geo" => array('$exists' => true) ); 
			$city =  Yii::app()->mongodb->cities->findOne($queryCity); //->limit(1)
			if($city!=null){ $i++;
     		
			$newPos = array('geo' => array("@type" => "GeoCoordinates",	
									   "longitude" => floatval($city['geo']['coordinates'][0]),
									   "latitude"  => floatval($city['geo']['coordinates'][1]) ),
							'geoPosition' => $city['geo']
						  );
			
			//rajoute le nom de la ville
			if(!isset($citoyen["city"]))	$newPos["city"] = $city['name'];
																	
			$result .= " <".$i.">newPos : ".$city['geo']['coordinates'][0];// CPcitoyen |".$citoyen["cp"]."| - newPos : ".json_encode($newPos).$city['name']."> ";
			Yii::app()->mongodb->citoyens->update(  array("_id" => $citoyen["_id"]), array('$set' => $newPos ) );
            }                                         	 	
     	}
     	$result .= " - count : ".count($citoyens);
     	
     	return $result;  	
	 	
	 }
	 
	 
	 
	 public function updateGeoPositionCities()
	 {
	 	//augmente la limite de la mémoire pour charger tout le fichier json
		ini_set("memory_limit","300M"); 
		
		//toutes les villes qui ont les data geo
		$query = array( 'geo.latitude' => array( '$exists' => true ) );
	 	
	 	$cities =  iterator_to_array(Yii::app()->mongodb->cities->find($query)->limit(1)); //->limit(1)
     	$result = "deb";
     	$i=0;
     	foreach ($cities as $city)
     	{
     		$i++;
     		if(!isset($city['geo']["coordinates"]) && isset($city['geo']["longitude"])){
         		
     				$newPos = array('geo' => array("type" => "Point",	
                                			   "coordinates" => array( $city['geo']["longitude"],
                                			   						   $city['geo']["latitude"] )
                                		 		  ));
                    
                    $result .= " <".$i."> ";
     				Yii::app()->mongodb->cities->update( array("_id" => $city["_id"]), 
                                                       	 array('$set' => $newPos ) );
            }
     	}
     	$result .= " - count : ".count($cities);
     	
     	return $result;  	
	 }
	
	

}