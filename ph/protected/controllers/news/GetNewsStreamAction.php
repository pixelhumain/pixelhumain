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
    	Sont pris en compte : le code postal & departement de l'utilisateur connecté
    						+ la Nature des publications
    	
    	Reste : tags, syncMap, groups 
    */
    
    
        		//recupere le CP de l'utilisateur connecté
        		$myEmail =  Yii::app()->session["userEmail"];
     			$result = PHDB::find( PHType::TYPE_CITOYEN, array( "email" => $myEmail ) );
     			$myCp = 0;
     			foreach($result as $me)
    			$myCp = $me['cp'];
    			
    			//recupere le departement de l'utilisateur connecté
    			if(intval($myCp) > 9999) $myDep = substr($myCp, 0, 2);
    			else 			 $myDep = substr($myCp, 0, 1);
                
                
                //debut de la requete
                $where = array();               
               	$where['nature'] = $_POST['nature'];
               	
             	if($_POST['geoAreaScope'] == true){
             		/*
             		$where['scope.scopeType'] = 'geoArea'; 		
             		$latMax = floatval($_POST['latMaxScope']); //converti strinf en float
             		$latMin = floatval($_POST['latMinScope']);
             		$lngMax = floatval($_POST['lngMaxScope']);
             		$lngMin = floatval($_POST['lngMinScope']);
             		
             		//$where['from.latitude']  = array('$lt'=>$latMax, '$gt'=>$latMin);
             		//$where['from.longitude'] = array('$lt'=>$lngMax, '$gt'=>$lngMin);
             		
             		$where['from.latitude']  = array('$gt'=>38.272688535980976, '$lt'=>58.35563036280964 );
             		$where['from.longitude'] = array('$gt'=> -40.95703125, //nombre négatif ne marche pas		 
             										 '$lt'=>18.28125);
             		
             		
             		/* modele opérateur geoWithin	
             		<location field> :
                         { $geoWithin :
                            { $geometry :
                               { type : "Polygon" ,
                                 coordinates : [ [ [ <lng1>, <lat1> ] , [ <lng2>, <lat2> ] ... ] ]
                      } } } }* / */
             		/* 
             		$where['from'] = 
             		array("$geoWithin" => 
								array("$geometry" => 
									array("type" => "Polygon", "coordinates" => 
																array(array($_POST['lngMinScope'], 
																			$_POST['latMinScope']),
																
																	  array($_POST['lngMaxScope'], 
																			$_POST['latMinScope']),
																
																	  array($_POST['lngMaxScope'], 
																			$_POST['latMaxScope']),
																		
																	  array($_POST['lngMinScope'], 
																			$_POST['latMaxScope']),
																		
																	  array($_POST['lngMinScope'], 
																			$_POST['latMinScope']))
									)
								)
							);
             	*/	
             	}
             	
             	$where['$or'] = array();
             	$where['$or'][] = array( '$and' => array( array('scope.scopeType' => 'cp', 'scope.cpScope' => $myCp) ) );
             	$where['$or'][] = array( '$and' => array( array('scope.scopeType' => 'departement', 'scope.depScope' => $myDep) ) );
             	            	         	
             	
                $newsStream = PHDB::find( PHType::TYPE_NEWS, $where );
				
				$streamHtml = "</br></br>RESULTAT HTML : </br>"; $nbNews = 0;
				foreach($newsStream as $news){
					$streamHtml .= " _id : ".$news['_id']." - title : ".$news['title']." - cp : ".$news['scope']['cpScope']."</br>";
					$nbNews++;
				}
				
				$streamHtml .= $nbNews;
				$res = array("_POST : ", $_POST, "<br><br>WHERE : ", $where, "<br><br>RESULTAT JSON :", $newsStream, $streamHtml);
        		Rest::json($res);  
        		Yii::app()->end();
    }
}