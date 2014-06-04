<?php
/**
 * [actionGetWatcher get the user data based on his id]
 * @param 
 * @return [type] [description]
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