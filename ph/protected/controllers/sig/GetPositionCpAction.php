<?php
/**
 * [actionAddWatcher 
 * get position (lat, lng) from cities based on code postal (CP)
 * @return [data] 
 */
class GetPositionCpAction extends CAction
{
    public function run($cp)
    {
    	$city = Yii::app()->mongodb->cities->findOne( array( "cp" => $cp ) );
     	
     	if($city != null){
	 	Rest::json( array( 'lat' => $city['geo']['latitude'], 'lng' => $city['geo']['longitude'] ) );      	
      	}
      	
      	Yii::app()->end();
    	
	 }
	
}