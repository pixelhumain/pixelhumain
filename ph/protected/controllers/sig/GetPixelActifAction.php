<?php
/**
 * [get all user from "citoyens" collection]
 * @param 
 * @return [user iterator]
 */
class GetPixelActifAction extends CAction
{
    public function run()
    {
    	//début de la requete => scope geographique
    	$where = array(	'geo'  => array( '$exists' => true ),
//     					'geo.latitude' => array('$gt' => floatval($_POST['latMinScope']), '$lt' => floatval($_POST['latMaxScope'])),
// 						'geo.longitude' => array('$gt' => floatval($_POST['lngMinScope']), '$lt' => floatval($_POST['lngMaxScope']))
					  
					  	//version $geoWithin (à conserver en attendant la maj de version de mongo)
					  	/*'geoPosition' =>  array('$geoWithin' => 
									array( '$box' => array(array(floatval($_POST['lngMinScope']), 
															  	 floatval($_POST['latMinScope']) 
															 ),
																
														array(floatval($_POST['lngMaxScope']), 
															  floatval($_POST['latMaxScope']) 
															 ),
												 		),
										)
									),
					  */
					  
					  );
		
		//rajoute les filtres choisi dans le panel (seulement s'il y a au moins 1 filtre selectionné)
		
		if(isset($_POST['types'])) {
			$types = $_POST['types'];
			$users = array();
		} else { 
    		Rest::json( array("result" => "Aucun résultat") );
        	Yii::app()->end();
    	}

		foreach ($types as $type) {
			if ($type == "pixelActif" || $type == "projectLeader") {
				$collection = Person::COLLECTION;
				$where['type'] = $type;
			} else if ($type == "association") {
				$collection = Organization::COLLECTION;
				$where['type'] = $type;
			} else if ($type == "commune") {
				$collection = City::COLLECTION;
				$where['communected'] = true;
			} else if ($type == "none" || $type == "all" || $type == "citoyen") {
				$collection = Person::COLLECTION;
				unset($where['type']);
			} else {
				error_log("Unknown type in getPixelActifAction : ".$type);
				Rest::json( array("result" => "Unknown type in getPixelActifAction : ".$type) );
        		Yii::app()->end();
			}
			$currentSearch = PHDB::find($collection, $where);
			$users = array_merge($users, $currentSearch);
		}
		
        $users["origine"] = "getPixelActif";
    	
    	Rest::json( $users );
        Yii::app()->end();
    }
}
