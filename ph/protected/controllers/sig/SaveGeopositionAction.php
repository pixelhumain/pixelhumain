<?php
/**
 * save geoposition on object PHType
 * @return [json] 
 */
class SaveGeopositionAction extends CAction
{
    public function run()
    {
       	$id = $_POST["_id"];
        $type = $_POST["type"];
        
        	$res = array( "result" => false );
        	$res["msg"] = "debut proc - ";
        	if(PHDB::findOne( $_POST["type"], array("_id"=>new MongoId($_POST["_id"]))) )
            {
            	$res["msg"] .= "type et id ok - ";
            	$newInfos = array();
                if( isset($_POST['geo']) )
                    $newInfos['geo'] = $_POST['geo'];
                $res["newInfos"] = $newInfos;
			//	Yii::app()->mongodb->citoyens->update( array("_id" => $id), 
             //                                          array('$set' => $newInfos ));
                
                PHDB::update( 	$_POST["type"], 
		     					array("_id"=>new MongoId($_POST["_id"])),
		     					array('$set' => $newInfos)
		     				);

		     	$res["result"] = true;
           }
           
        Rest::json($res);  
        Yii::app()->end();
    }
}