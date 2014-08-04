<?php
/**
 * [actionAddWatcher 
 * create or update a user account
 * if the email doesn't exist creates a new citizens with corresponding data 
 * else simply adds the watcher app the users profile ]
 * @return [json] 
 */
class GetNewsStreamAction extends CAction
{
    public function run()
    {
    	 /*
        	var params = { "tags" : $("#tagsSaveNews").val() ,
			    	   "nature":$("#natureSaveNews").val(),
			    	   "scopeType" : scopeTypeNewsStream
			    	};
			    	
			if(scopeTypeNewsStream == "geoArea"){
				var bounds = mapClusters.getBounds();
				params["latMinScope"] = bounds.getSouthWest().lat;
				params["lngMinScope"] = bounds.getSouthWest().lng;
				params["latMaxScope"] = bounds.getNorthEast().lat;
				params["lngMaxScope"] = bounds.getNorthEast().lng;
			}
			if(scopeTypeNewsStream == "cp")			{ params["cpScope"] = $("#cpScopeNewsStream").val(); }
			if(scopeTypeNewsStream == "departement"){ params["depScope"] = $("#depScopeNewsStream").val(); }
			if(scopeTypeNewsStream == "groups")		{ params["groupScope"] = $("#groupsListScopeNewsStream").val(); }
		
        */
       
        if( Yii::app()->request->isAjaxRequest )
        {
        		//recupere le CP de l'utilisateur connecté
        		$myEmail =  Yii::app()->session["userEmail"];
     			$result = PHDB::find( PHType::TYPE_CITOYEN, array( "email" => $myEmail ) );
     			$myCp = 0;
     			foreach($result as $me)
    			$myCp = $me['cp'];
    			
            	$where = array();
                //if( isset($_POST['nature']) ) 	$where[] = array('nature' => $_POST['nature']);
               /*
                if($newsData['scope']['scopeType'] == "geoArea"){
                	if( isset($_POST['latMinScope']) ) $newsData['scope']['geoArea']['latMinScope'] = $_POST['latMinScope'];
                	if( isset($_POST['lngMinScope']) ) $newsData['scope']['geoArea']['lngMinScope'] = $_POST['lngMinScope'];
                	if( isset($_POST['latMaxScope']) ) $newsData['scope']['geoArea']['latMaxScope'] = $_POST['latMaxScope'];
                	if( isset($_POST['lngMaxScope']) ) $newsData['scope']['geoArea']['lngMaxScope'] = $_POST['lngMaxScope'];          	
                }
                */
                //WHERE : les publications publiées pour MON departement
               /* if(isset($where['scopeType']) && $where['scopeType'] == "cp"){
                	$where[] = array('scope.cpScope' => $myCp);    	
                }*/
                /*
                if($newsData['scope']['scopeType'] == "groups"){
                	if( isset($_POST['groupScope']) ) $newsData['scope']['groupScope'] = $_POST['groupScope']; 
                }
                
                if($newsData['scope']['scopeType'] == "departement"){
                	if( isset($_POST['depScope']) ) $newsData['scope']['depScope'] = $_POST['depScope']; 
                }
                */
                
                $where = array('$and' => array());
                $where['$and'][] = array('nature' => $_POST['nature']);
                if( isset($_POST['scopeType']) ) 
                {
                 	$where['$and'][] = array('scope.scopeType' => $_POST['scopeType']);
               
                	if($_POST['scopeType'] == "cp")
                		$where['$and'][] = array('scope.cpScope' => $myCp);    	
                }
               /* if( isset($_POST['tags']) ) 
                	$where['$and'][] = array('tags' => array('$in' => explode(" ",$_POST['tags'])));
				if( isset($_POST['nature']) ) 	
					$where['$and'][] = array('nature' => $_POST['nature']);
				*/	
                $newsStream = PHDB::find( PHType::TYPE_NEWS, $where );

				$streamHtml = ""; $nbNews = 0;
				foreach($newsStream as $news){
					$streamHtml .= $news['title']." - cp : ".$news['scope']['cpScope']."</br>";
					$nbNews++;
				}
				
				$streamHtml .= $nbNews;
				$res = array($_POST, "<br><br>", $where, "<br><br>", $newsStream);
        		Rest::json($streamHtml);  
        		Yii::app()->end();
    	}
    }
}