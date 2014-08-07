<?php
/**
 * [actionGetWatcher get all cities]
 * @param 
 * @return [cities iterator]
 */
class ShowCitiesAction extends CAction
{
    public function run() 
    {
    	//affiche les villes de plus de 100 000 habitants
    	$query = array('habitants' => array( '$gt' => 100000 ));
    	$cities = iterator_to_array(Yii::app()->mongodb->cities->find($query));
        
        Rest::json( $cities );
        Yii::app()->end();
    }
}