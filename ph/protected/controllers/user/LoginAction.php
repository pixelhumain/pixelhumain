<?php
class LoginAction extends CAction
{
    public function run()
    {
        $email = $_POST["email"];
        $res = Citoyen::login( $email , $_POST["pwd"] ); 
        if( isset( $_POST["app"] ) )
			$res = array_merge($res, Citoyen::applicationRegistered($_POST["app"],$email));

        Rest::json($res);
        Yii::app()->end();
    }
}