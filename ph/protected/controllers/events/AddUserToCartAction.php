<?php
/*
- validate Ajax request
- check refred email user exists
- set group specific information
- add application / module specific information 
- insert or update group
- TODO : add event to cart
 */
class AddUserToCartAction extends CAction
{
    public function run()
    {
       
		if( $_POST['email'] ){
			
			$checkout = Yii::app()->session['checkout'];
			$person = $_POST;
			Yii::app()->session['personMap'] = $person;
			Yii::app()->session['event'] = $checkout["events"];
			
		}
		
		
		$res = "Added to session";
        Rest::json( $res );
        Yii::app()->end();
    }
}