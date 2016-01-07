<?php
/**
 * [get all user from "citoyens" collection]
 * @param 
 * @return [user iterator]
 */
class GetCommunectedAction extends CAction
{
    public function run()
    {
    	//récupère seulement les citoyens qui ont un code postal (et une position geo)
    	$where = array(	'cp'  => array( '$exists' => true ),
    					'geo'  => array( '$exists' => true ),
    					'geo.latitude' => array('$gt' => floatval($_POST['latMinScope']), '$lt' => floatval($_POST['latMaxScope'])),
						'geo.longitude' => array('$gt' => floatval($_POST['lngMinScope']), '$lt' => floatval($_POST['lngMaxScope']))
					  
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
	 					
    	$users = PHDB::find(PHType::TYPE_CITOYEN, $where);
    	$users["origine"] = "getCommunected";
    	
    	
        Rest::json( $users );
        Yii::app()->end();
    }
}