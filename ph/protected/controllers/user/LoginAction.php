<?php
class LoginAction extends CAction
{
    public function run()
    {
        $email = $_POST["email"];
        $loginRegister = (isset($_POST["loginRegister"]) && $_POST["loginRegister"] ) ? true : null ; 
        $res = Citoyen::login( $email , $_POST["pwd"], $loginRegister); 
        if( isset( $_POST["app"] ) )
			$res = array_merge($res, Citoyen::applicationRegistered($_POST["app"],$email));

        Rest::json($res);
        Yii::app()->end();
    }
}