<?php
/**
 * [actionGetWatcher get all user from "citoyens" collection]
 * @param 
 * @return [user iterator]
 */
class ShowCitoyensAction extends CAction
{
    public function run()
    {
    	$users = iterator_to_array(Yii::app()->mongodb->citoyens->find());
        
        Rest::json( $users );
        Yii::app()->end();
    }
}