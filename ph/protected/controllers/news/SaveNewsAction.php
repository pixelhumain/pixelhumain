<?php
/**
 * [actionAddWatcher 
 * create or update a user account
 * if the email doesn't exist creates a new citizens with corresponding data 
 * else simply adds the watcher app the users profile ]
 * @return [json] 
 */
class SaveNewsAction extends CAction
{
    public function run()
    {
    	 /*
        	params = { "title" : $("#titleSaveNews").val() , 
			    	   "msg" : $("#contentSaveNews").val() , 
			    	   "tags" : $("#tagsSaveNews").val() ,
			    	   "nature":$("#natureSaveNews").val(),
			    	   "scopeType" : scopeType
			    	};
			    	
			if(scopeType == "geoArea"){
				var bounds = getBoundsValue();
				params["latMinScope"] = bounds.getSouthWest().lat;
				params["lngMinScope"] = bounds.getSouthWest().lng;
				params["latMaxScope"] = bounds.getNorthEast().lat;
				params["lngMaxScope"] = bounds.getNorthEast().lng;
			}
			if(scopeType == "cp")			{ params["cpScope"] = $("#cpScope").val(); }
			if(scopeType == "departement")	{ params["depScope"] = $("#depScope").val(); }
			if(scopeType == "groups")		{ params["groupScope"] = $("#groupsListScope").val(); }
			
        */
        
        if( Yii::app()->request->isAjaxRequest )
        {
            	$newsData = array();
                if( isset($_POST['title']) ) 	 $newsData['title'] = $_POST['title'];
                if( isset($_POST['msg']) ) 	 	 $newsData['msg'] 	= $_POST['msg'];
                if( isset($_POST['tags']) ) 	 $newsData['tags'] 	= explode(",",$_POST['tags']);
				if( isset($_POST['nature']) ) 	 $newsData['nature'] = $_POST['nature'];
                if( isset($_POST['scopeType']) ) $newsData['scope']['scopeType'] = $_POST['scopeType'];
                
                if($newsData['scope']['scopeType'] == "geoArea"){
                	if( isset($_POST['latMinScope']) ) $newsData['scope']['geoArea']['latMinScope'] = $_POST['latMinScope'];
                	if( isset($_POST['lngMinScope']) ) $newsData['scope']['geoArea']['lngMinScope'] = $_POST['lngMinScope'];
                	if( isset($_POST['latMaxScope']) ) $newsData['scope']['geoArea']['latMaxScope'] = $_POST['latMaxScope'];
                	if( isset($_POST['lngMaxScope']) ) $newsData['scope']['geoArea']['lngMaxScope'] = $_POST['lngMaxScope'];          	
                }
                
                if($newsData['scope']['scopeType'] == "cp"){
                	if( isset($_POST['cpScope']) ) $newsData['scope']['cpScope'] = $_POST['cpScope'];    	
                }
                
                if($newsData['scope']['scopeType'] == "groups"){
                	if( isset($_POST['groupScope']) ) $newsData['scope']['groupScope'] = $_POST['groupScope']; 
                }
                
                if($newsData['scope']['scopeType'] == "departement"){
                	if( isset($_POST['depScope']) ) $newsData['scope']['depScope'] = $_POST['depScope']; 
                }
                
                PHDB::insert( PHType::TYPE_NEWS, $newsData );
		     				//	array("_id"=>new MongoId($_POST["_id"])),
		     				//	array('$set' => $newsData)
		     				//);

        		Rest::json($newsData);  
        		Yii::app()->end();
    	}
    }
}