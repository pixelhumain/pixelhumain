<?php
/**
 * [actionGetWatcher get the user data based on his id]
 * @param  [string] $email   email connected to the citizen account
 * @return [type] [description]
 */
class GetCitoyenConnectedAction extends CAction
{
    public function run()
    {
    	$email =  Yii::app()->session["userEmail"];
     	//$cp =  	  Yii::app()->session["cp"];
     	//if($email == null) $email = "tristan.goguet@gmail.com"; //Rest::json( null );
    	//else {
    		$user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) );
    		$city = Yii::app()->mongodb->CitiesLD->findOne( array( "cp" => $user['cp'] ) );
       
        	Rest::json( array( 'user' => $user, 'city' => $city ) );
      //  }
      	
      	Yii::app()->end();
    }
}