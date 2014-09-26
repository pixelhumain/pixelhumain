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
    	$where = array(	'geo' => array( '$exists' => true ), 
    					'cp'  => array( '$exists' => true )
	 					);
    	$users = PHDB::find(PHType::TYPE_CITOYEN, $where);
        Rest::json( $users );
        Yii::app()->end();
    }
}