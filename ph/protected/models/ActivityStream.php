<?php
/*
Activity Streams are made to keep track of activity inside any environment 

ACtivity stream sample
{
    "_id" : ObjectId("54b2a914f6b95c500b005f1f"),
    "type" : "esoModified",
    "groupId" : "126",
    "perimeterId" : "54895c3cf6b95c6c17003cd7",
    "verb" : "update",
    "date" : "2015-01-11 17:47:16",
    "timestamp" : 1420994836,
    "actor" : {
        "objectType" : "persons",
        "id" : "520931e2f6b95c5cd3003d6c"
    },
    "object" : {
        "objectType" : "eso",
        "displayName" : "Création d'un rapport SIGE automatisé"
    },
    "target" : {
        "objectType" : "perimeter",
        "id" : "54895c3cf6b95c6c17003cd7"
    },
    "notify" : {
        "objectType" : "persons",
        "id" : [ 
            "548ec7bbf6b95c8c23004b44"
        ],
        "displayName" : "Project Modified",
        "icon" : "fa-file",
        "url" : "javascript:editProject( projects[ \"548eb4c4f6b95c8823004296\" ] );"
    }
}

 */
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

	public static function getNotifications($param,$sort=array("timestamp"=>-1))
	{
	    return PHDB::findAndSort(PHType::TYPE_ACTIVITYSTREAM, $param,$sort);
	}
	public static function getActivtyForObjectId($param,$sort=array("timestamp"=>-1))
	{
	    return PHDB::findAndSort(PHType::TYPE_ACTIVITYSTREAM, $param,$sort);
	}
	
	public static function removeNotifications($id)
	{
	    $notif = PHDB::findOne(PHType::TYPE_ACTIVITYSTREAM, array("_id"=> new MongoId($id) ) );
	    $res = array( "result"=>false,"msg"=>"Something went wrong : Activty Stream Not Found","id"=>$id );
	    if( isset($notif) && isset( $notif["notify"] ) && isset( $notif["notify"]["id"]) )
	    {
		    if( count($notif["notify"]["id"]) > 1 )
		    	//remove userid from array
		    	unset($notif["notify"]);
		    else
		    	unset($notif["notify"]);

			try{
			    unset($notif["_id"]);
			    PHDB::update( PHType::TYPE_ACTIVITYSTREAM,
			                  array("_id"  => new MongoId($id) ), 
			                  array('$unset' => array("notify"=>true) ) );

			    $res = array( "result"=>true,"msg"=>"Removed succesfully" );
		    }
		    catch (Exception $e) {  
		          $res = array( "result"=>false,"msg"=>"Something went wrong :".$e->getMessage() );
		    } 
		}

		return Rest::json($res);
	}

	public static function removeNotificationsByUser()
	{
		try{
		    //TODO : check 
		    PHDB::update( PHType::TYPE_ACTIVITYSTREAM,
		                  array("notify.id"  => Yii::app()->session["userId"] ), 
		                  array('$unset' => array("notify"=>true) ) );

		    $res = array( "result"=>true,"msg"=>"Removed succesfully" );
	    }
	    catch (Exception $e) {  
	          $res = array( "result"=>false,"msg"=>"Something went wrong :".$e->getMessage() );
	    } 
	

		return Rest::json($res);
	}
}