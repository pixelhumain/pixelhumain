<?php

/*
Is a bunch of simple tools to help the DEv process 
- Timetrack you work
- manage bugs,a nd client request

 */

class CornerDev{
	const ACTION_WORKLOG = "addWorkLog";
	
	/*
	on each page update
	This updates or creates the timespend on a feature 
	 */
	public static function addWorkLog($project, $userEmail, $controller,$action){
		if(stripos($_SERVER['SERVER_NAME'], "127.0.0.1") >=0 || stripos($_SERVER['SERVER_NAME'], "localhost:8080") >=0 ){
			$lastUpdate = PHDB::findOne( "cornerDev", 
				        				array( "project"=>$project, 
				        						"person"=>$userEmail,
				        						"controller"=>$controller,
				        						"action"=>$action,
				        						//"desc" => "",
				        						//"commit"=>"",
				        						//"url"=>"",
				        						"type"=> self::ACTION_WORKLOG,
				        						"date"=>date("d/m/y")));
			$timespend = 0;
			if($lastUpdate){
				$timespend = time() - $lastUpdate["lastUpdate"];
				//if($timespend > ) //seesion closer , maybe should be a button
				$timespend = ($timespend + $lastUpdate["timespend"]*60)/60;

			}
	        $entry = array( "project"=>$project, 
				"person"=>$userEmail,
				"controller"=>$controller,
				"action"=>$action,
				"date"=>date("d/m/y"),
				"timespend"=>$timespend,
				"lastUpdate"=>time()
				);
	        PHDB::updateWithOptions( "cornerDev", 
	        				array( "project"=>$project, "person"=>$userEmail,"controller"=>$controller,"action"=>$action,"date"=>date("d/m/y"),"type"=> self::ACTION_WORKLOG) ,
	        				array('$set' => $entry ) ,
                            array("upsert"=>true) );
	    }
	}
} 