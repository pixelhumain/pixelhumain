<?php
/*
- validate Ajax request
- check refred email user exists
- set group specific information
- add application / module specific information 
- insert or update group
- TODO : confirmation email / notification
 */
class SearchEventAction extends CAction
{
	public function run()
	{
		$name_startsWith = $_GET['name_startsWith'];
		$events = PHDB::find( PHType::TYPE_EVENTS, array( "name" => array('$regex' => $name_startsWith) ));
		$data = array('-- résultat --');
		foreach ($events as $key => $value){
			$event_id = $key;
			$event_name = $value['name'];
			$newdata = trim($event_name).'|'.$event_id;
			array_push($data, $newdata);
		}
		Rest::json( $data );
		Yii::app()->end();
	}
}