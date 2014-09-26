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
    	//récupère seulement les citoyens qui sont pixelActif ou partnerPH (et ont une position géo)
    	$where = array(	'geo'  => array( '$exists' => true ), 
    					'name' => array( '$exists' => true ), 
    					//'tags' => "pixelActif",
	 					//'tags' => "partnerPH",
	 					);
    	$users = PHDB::find(PHType::TYPE_CITOYEN, $where);
        Rest::json( $users );
        Yii::app()->end();
    }
}