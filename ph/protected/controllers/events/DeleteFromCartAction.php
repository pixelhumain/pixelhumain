<?php
/*
- validate Ajax request
- check refred email user exists
- set group specific information
- add application / module specific information 
- insert or update group
- TODO : add event to cart
 */
class DeleteFromCartAction extends CAction
{
    public function run()
    {
        $id = $_POST['id'];
	
		$data = Yii::app()->session['cart'];
		unset($data['cart'][$id]);
		 Yii::app()->session['cart'] = $data;
		$res = "Deleted From Cart";
        Rest::json( $res );
        Yii::app()->end();
    }
}