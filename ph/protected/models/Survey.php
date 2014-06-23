<?php

class Survey
{
	const TYPE_SURVEY = 'survey';
	const TYPE_ENTRY  = 'entry';
	
     public static function moderateEntry($params) {
     	$res = array( "result" => false );
     	//check if user is set as admin
     	if( isset( Yii::app()->session["userId"] ))
     	{ 
     		if(self::isModerator(Yii::app()->session["userId"],$params["app"]))
     		{
		     	$survey = PHDB::findOne( PHType::TYPE_SURVEYS, array("_id"=>new MongoId($params["survey"])) );
		     	if( isset($survey["applications"][$params["app"]]["cleared"] ))
		     	{
		     		if($params["action"]){
		     			PHDB::update( PHType::TYPE_SURVEYS, 
		     									array("_id"=>new MongoId($params["survey"])),
		     									array('$unset' => array('applications.survey.cleared' => true))
		     								);
		     			$res["msg"] = "EntryCleared";
		     			$res["result"] = true;
		     		} else {
		     			PHDB::update(  PHType::TYPE_SURVEYS, 
		     								    array("_id"=>new MongoId($params["survey"])),
		     									array('$set' => array('applications.survey.cleared' => "refused"))
		     								);
		     			$res["msg"] = "EntryRefused";
		     		}
		     	} else {
		     		$res["msg"] = "Nothing to clear on this entry";
		     	}

		     	$res["survey"] = PHDB::findOne( PHType::TYPE_SURVEYS, array("_id"=>new MongoId($params["survey"])) );
		     } else 
		     	$res["msg"] = "mustBeModerator";
	     } else 
	     	$res["msg"] = "mustBeLoggued";
	     
     	return $res;
     }
     public static function isModerator($userId,$app) {
     	$app = Yii::app()->mongodb->selectCollection(PHType::TYPE_APPLICATIONS)->findOne(array("key"=> $app ) );
    	return ( isset( $userId ) && in_array(Yii::app()->session["userId"], $app["moderator"]) ) ? true : false;
     }

     public static function deleteEntry($params){
     	$res = array( "result" => false );
     	if( isset( Yii::app()->session["userId"] ))
     	{ 
     		if( $survey = PHDB::findOne( PHType::TYPE_SURVEYS, array("_id"=>new MongoId($params["survey"])) ) ) 
     		{
	     		if(Citoyen::isAppAdmin( Yii::app()->session["userId"] , $params["app"] ))
	     		{
			     	
			     	/*if( isset($survey["applications"][$params["app"]] ))
			     	{*/

	     			//first remove all children 
			     	$count = PHDB::count( PHType::TYPE_SURVEYS , array("survey" => $params["survey"]) );
			     	if( $count > 0){
				     	PHDB::remove( PHType::TYPE_SURVEYS, array("survey"=>$params["survey"]));
				     	$res["msg2"] = "Deleted ".$count." children entries" ;
					}

			     	//then remove the parent survey
	     			PHDB::remove( PHType::TYPE_SURVEYS,array("_id"=>new MongoId($params["survey"])));
	     			$res["msg"] = "Deleted";
	     			$res["result"] = true;

			     	/*} else {
			     		$res["msg"] = "Nothing to clear on this entry";
			     	}*/
			     } else 
			     	$res["msg"] = "restrictedAccess";
		     } else
		     	$res["msg"] = "SurveydoesntExist";
	     } else 
	     	$res["msg"] = "mustBeLoggued";
		return $res;
     }
}
?>