<?php
/**
 * [actionGetWatcher get the user data based on his id]
 * @param 
 * @return [type] [description]
 */
class ShowCitiesAction extends CAction
{
    public function run()
    {
    	//affiche les villes de plus de 100 000 habitants
    	$query = array('habitants' => array( '$gt' => 100000 )); //filtre les villes de + de 300 000 habitants
    	$cities = iterator_to_array(Yii::app()->mongodb->CitiesLD->find($query));
        //$cities = iterator_to_array(Yii::app()->mongodb->CitiesLD->find()->limit(1500)); //$query)); //pour afficher toutes les villes
        
        Rest::json( $cities );
        Yii::app()->end();
    }
}