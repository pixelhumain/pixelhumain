<?php
class ActivityStream {

	/**
   *
   * @return [json Map] list
   */
  public static function addEntry($param)
  {
    $param["timestamp"] = time();
    
    PHDB::insert(PHType::TYPE_ACTIVITYSTREAM, $param);
  }

  public static function getNotifications($param)
  {
    return PHDB::find(PHType::TYPE_ACTIVITYSTREAM, $param);
  }

  public static function removeNotifications($id)
  {
    $notif = PHDB::findOne(PHType::TYPE_ACTIVITYSTREAM, $id);
    if( count($notif["id"]) > 1 )
    	//remove userid from array
    	unset($notif["notify"]);
    else
    	unset($notif["notify"]);
    PHDB::update( DB::TYPE_ACTIVITYSTREAM,
                  array("_id" => new MongoId($id)), 
                  array('$set' => $notif) );
  }


}