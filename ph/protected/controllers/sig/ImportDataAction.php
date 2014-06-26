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
        $result = $this->importFromJson();
        $result = $this->checkPositionCitoyens();
     	
		Rest::json($result);  
		Yii::app()->end();
	}
	
	  public function importFromJson()
	  {
	  	//augmente la limite de la mémoire pour charger tout le fichier json
		ini_set("memory_limit","300M"); 
		
		$fp = fopen ("../../modules/sig/data/_cities_.json", "r");  	
		$contenu_du_fichier = fread ($fp, filesize('../../modules/sig/data/_cities_.json')); //charge le contenu du fichier
		fclose ($fp);   
		$json = json_decode ($contenu_du_fichier); //convertit en json
		
		$result = "loading json file ok<br/>";
		
		$mongo = new MongoClient();
		$db = $mongo->selectDB($_POST['dbName']);

		$result .= "database found<br/>";
		
		$collectionName = "cities";
		
		if(!$this->collection_exists($collectionName, $db)) { 			//si la collection n'existe pas 
			$result .= "creating collection '".$collectionName."'<br/>";//on la créé
			$db->createCollection ($collectionName); 
		
			$result .= "importing data<br/>";							//puis on importe les données
			foreach($json as $city) {
				Yii::app()->mongodb->cities->insert($city);
			}	
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
		
	 public function checkPositionCitoyens()
	 {
	 	$citoyens =  iterator_to_array(Yii::app()->mongodb->citoyens->find());
     	$result = "";
     	$i=0;
     	foreach ($citoyens as $users)
     	{
     		//récupère les valeurs des attributs
     		$cp = ""; $geo = false; $email = "";
     		foreach ($users as $key => $value)	{
     			if($key == 'cp') $cp = $value;
     			if($key == 'geo') $geo = true;  
     			if($key == 'email') $email = $value;  
     			   			
     		}
     		
     		//si l'utilisateur n'a pas de position geo
     		//on lui rajoute
     		if($geo == false){
     			$city = Yii::app()->mongodb->cities->findOne( array( "cp" => $cp ) );
     			if($city != null){
     				$newPos = array(); 
     				$newPos['geo'] = $city['geo'];
     				$result .= "nouvelle position pour -> ".$email." : cp =".$cp;
     			Yii::app()->mongodb->citoyens->update( array("email" => $email), 
                                                       array('$set' => $newPos ) );
                }
     		} 
     		
     	}
     	
     	return $result;
    	
	 }
	
}