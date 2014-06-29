<?php
/*
Initialising data for a module
will import all needed datasets to get a module working properly 
 */
class InitDataAction extends CAction
{
    public function run()
    {

        $controller=$this->getController();
        $res = array("module"=>Yii::app()->controller->module->id, "imported"=>array());

        if(file_exists(Yii::getPathOfAlias(Yii::app()->params["modulePath"].Yii::app()->controller->module->id.".data" )))
		{
			foreach( CFileHelper::findFiles(Yii::getPathOfAlias(Yii::app()->params["modulePath"].Yii::app()->controller->module->id.".data" )) as $f)
			{
				//todo : if csv 
				//if json
				$json = json_decode( file_get_contents($f), true);
				$fn = pathinfo($f, PATHINFO_FILENAME);
				PHDB::batchInsert( $fn , $json );
				array_push( $res["imported"], array( "file"=>$fn,"count"=>count($json)));
			}
		} else 
			$res["msg"] = "Nothing to import";
        echo json_encode($res);
    }
}