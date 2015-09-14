<?php
/*
- check if invited user exists
- if exist then if someone loggued in , then link the 2 people together
- else only invite the new user by notification 
- if not exist > create a new entry and link it to the loggue in user > sendmail
 */
class InviteUserAction extends CAction
{
    public function run()
    {	
        //check if invited user exists
        if(isset($_POST["email"]) && preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$_POST["email"])){
            if($user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $_POST["email"] ) ))
            {
            	$res = array('userAllreadyExists' => true );
            	if( Yii::app()->session["userId"] )
            		$res["link2Users_Call"] = Citoyen::link2Users((string)Yii::app()->session["userId"] , (string)$user["_id"] );
            	else
    	    		$res["invitedButNotLinked"] = "noUserLogguedin";
            } else
            	$res = Citoyen::inviteUser( $_POST["email"] ); 
	    } else 
            $res = array("result"=>false,"msg"=> "bad or no email");
        Rest::json($res);
        Yii::app()->end();
    }
}