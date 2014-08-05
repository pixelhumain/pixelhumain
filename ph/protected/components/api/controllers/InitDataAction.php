<?php
/*
Initialising data for a module
will import all needed datasets to get a module working properly 
 */
class InitDataAction extends CAction
{
    public function run()
    {
    	//TODO :: isLoggedIn and is (Module) Admin 
        $moduleId=Yii::app()->controller->module->id;
        $res = array("module"=>$moduleId, "imported"=>array());

        if(file_exists(Yii::getPathOfAlias(Yii::app()->params["modulePath"].$moduleId.".data" )))
		{
			foreach( CFileHelper::findFiles(Yii::getPathOfAlias(Yii::app()->params["modulePath"].$moduleId.".data" )) as $f)
			{
				//todo : if csv 
				//if json
				$json = json_decode( file_get_contents($f), true);
				$fn = pathinfo($f, PATHINFO_FILENAME);
				//PHDB::batchInsert( $fn , $json );
				foreach ( $json as $row ) 
		        {
		        	if(isset($row["_id"]) && isset($row["_id"]['$oid']) && PHDB::isValidMongoId($row["_id"]['$oid']) ){
		        		$id = $row["_id"]['$oid'];
		        		try {
					    	$id = new MongoId($id);
						} catch (MongoException $ex) {
						    $id = new MongoId();
						}
						//echo gettype($id)."=".$id;
			        } else
			        	$id = new MongoId();
			        $row["_id"] = $id;
		            PHDB::insert( $fn, $row );
		        }
				array_push( $res["imported"], array( "file"=>$fn,"count"=>count($json)));
			}
		} else 
			$res["msg"] = "Nothing to import";
        echo json_encode($res);
    }
}