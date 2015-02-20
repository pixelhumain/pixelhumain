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
		if(isset($_POST['types']))
		//TAG = TYPE = "citoyen,pixelActif,partnerPH,commune,association,projectLeader
		$where['type'] = array('$in' => $_POST['types']);
    	//si aucun filtre n'est selectionné, on ne fait pas la recherche
    	else { 
    		Rest::json( array("result" => "Aucun résultat") );
        	Yii::app()->end();
    	}
    	
    								  
    	$users = PHDB::find(PHType::TYPE_CITOYEN, $where);
        $users["origine"] = "getPixelActif";
    	
    	
    	Rest::json( $users );
        Yii::app()->end();
    }
}
