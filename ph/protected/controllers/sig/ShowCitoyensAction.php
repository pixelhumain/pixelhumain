<?php
/**
 * [get all user from "citoyens" collection]
 * @param 
 * @return [user iterator]
 */
class ShowCitoyensAction extends CAction
{
    public function run()
    {
    	//récupère seulement les citoyens qui ont un nom et une position géo
    	$users = PHDB::find(PHType::TYPE_CITOYEN);
        Rest::json( $users );
        Yii::app()->end();
    }
}