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
    	$users = PHDB::find(PHType::TYPE_CITOYEN);
        Rest::json( $users );
        Yii::app()->end();
    }
}