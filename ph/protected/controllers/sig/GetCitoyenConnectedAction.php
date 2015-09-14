<?php
/**
 * [actionGetWatcher get the user connected]
 * @param  [string] $userMmail   email connected to the citizen account
 * @return  array([user] [city])
 */
class GetCitoyenConnectedAction extends CAction
{
    public function run()
    {
    	$email =  Yii::app()->session["userEmail"];
     	$user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) );
    	$city = Yii::app()->mongodb->cities->findOne( array( "cp" => $user['cp'] ) );
       
        Rest::json( array( 'user' => $user, 'city' => $city ) );
      	
      	Yii::app()->end();
    }
}