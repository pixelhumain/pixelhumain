<?php
/*
- validate Ajax request
- check refred email user exists
- set group specific information
- add application / module specific information 
- insert or update group
- TODO : add event to cart
 */
class AddToCartAction extends CAction
{
    public function run()
    {
        $event = $_POST['event'];
		$price = $_POST['price'];
		$qtyCat1 = $_POST['qtyCat1'];
		$qtyCat2 = $_POST['qtyCat2'];
		$qtyCat3 = $_POST['qtyCat3'];
		$price1 = $_POST['price1'];
		$price2 = $_POST['price2'];
		$price3 = $_POST['price3'];
		if( $_POST['quantity'] ){ $quantity = $_POST['quantity']; } else{ $quantity = 1; }
		
	
		Yii::app()->session['checkout'] = array( 
										'qtyCat1' => $qtyCat1,
										'qtyCat2' => $qtyCat2,
										'qtyCat3' => $qtyCat3,
										'price1'  => $price1,
										'price2'  => $price2,
										'price3'  => $price3
									);

		
		
		$addItem = array(
						"event_id" => $event,
						"quantity" => $quantity,
						"qtyCat1"  => $qtyCat1,
						"qtyCat2"  => $qtyCat2,
						"qtyCat3"  => $qtyCat3,
						"price"    => $price,
						'price1'  => $price1,
						'price2'  => $price2,
						'price3'  => $price3
					);
		
		if( Yii::app()->session['cart'] == '' ){
			
			$data =  Yii::app()->session['cart'];
			$data['cart'][$event] =  $addItem;
			Yii::app()->session['cart'] = $data;
			
		}	
		else{
			
			$data =  Yii::app()->session['cart'];
			$data['cart'][$event] =  $addItem;
			Yii::app()->session['cart'] = $data; 
				
		}
		
		
		
		
		$res = "Added to session";
        Rest::json( $res );
        Yii::app()->end();
    }
}