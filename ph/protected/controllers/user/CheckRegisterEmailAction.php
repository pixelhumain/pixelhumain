<?php
/**
 * 
 * @return [json] 
 */
class CheckRegisterEmailAction extends CAction
{
    public function run()
    {
        $email = $_POST["email"];
        if($user = PHDB::findOne(PHType::TYPE_CITOYEN,array( "email" => $email ) ))
        {
           $res = array("result"=>true,"msg"=>"Déjà inscrit.");
        
		}
        Rest::json($res);  
        Yii::app()->end();
    }
   
}