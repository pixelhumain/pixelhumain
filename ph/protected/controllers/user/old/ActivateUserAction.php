<?php
class ActivateUserAction extends CAction
{
    public function run()
    {
        $controller=$this->getController();
        $id = $_REQUEST["id"];
		$user = Yii::app()->mongodb->citoyens->findAndModify( array("_id" => new MongoId( $id )), 
                                                              array('$set' => array("status"=>1) ) );
        
        if (!$user) {
        	//Unknown user
        	$params=array("/azotlive?userValidated=0");
        } else {
        	//User validated
        	$params=array("/azotlive?userValidated=1");
        }
        
        $controller->redirect($params);
    }
}