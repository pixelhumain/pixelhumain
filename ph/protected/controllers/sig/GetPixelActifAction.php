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
    
    	$where = array(	//'tag'  => "",
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
        $users["origine"] = "getPixelActif";
    	
    	
    	Rest::json( $users );
        Yii::app()->end();
    }
}
