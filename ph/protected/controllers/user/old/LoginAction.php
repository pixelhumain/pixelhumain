<?php
class LoginAction extends CAction
{
    public function run()
    {
        $email = $_POST["email"];
		$pwd = $_POST["pwd"];
		
		$user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) );
		
		$userEmail = $user['email'];
		$userPwd = $user['pwd'];
		$userId = (string)$user['_id'];
		$userName = $user['firstname'];
		$status = $user['status'];
		$userIsAdmin = $user['isAdmin'];
		$userIsOrganiser = $user['isOrganiser'];
		
		if( $userEmail && $userPwd == hash('sha256', $email.$pwd) && $status == 1 )
        {
			
			Yii::app()->session["userId"] = $userId;
            Yii::app()->session["userEmail"] = $userEmail; 
            Yii::app()->session["user"] = $userName; 
            if($userIsAdmin)Yii::app()->session["userIsAdmin"] = $userIsAdmin;
            if($userIsAdmin)Yii::app()->session["userIsOrganiser"] = $userIsOrganiser; 
			
			if($_POST['remember'] == 1) {
				$res = array("result"=>true, "id"=>$userId, "password"=>$pwd, "email"=>$userEmail, "name"=>$userName, "userIsAdmin" => $userIsAdmin, "userIsOrganiser" => $userIsOrganiser, "remember"=>1);
			}
			else{
				$res = array("result"=>true, "id"=>$userId, "name"=>$userName);
			}
			
			
			/* $loginRegister = (isset($_POST["loginRegister"]) && $_POST["loginRegister"] ) ? true : null ; 
			$res = Citoyen::login( $userEmail , $userPwd, $loginRegister); 
			if( isset( $_POST["app"] ) )
				$res = array_merge($res, Citoyen::applicationRegistered($_POST["app"],$userEmail)); */
			
			
			Rest::json($res);
			Yii::app()->end();
        
		}
		elseif( $userEmail && $userPwd == hash('sha256', $email.$pwd) && $status == 0 )
        {
			
			$res = array('result' => false , 'msg'=>"Désolé, votre compte est pas encore actif. Après inscription, vous auriez reçu un email d'activation, s'il vous plaît cliquez sur ce lien pour activer votre compte. Merci");
				
			Rest::json($res);  
			Yii::app()->end();
        
		}
		else{
			$res = array('result' => false , 'msg'=>"Vous n'êtes pas un utilisateur enregistré");
				
			Rest::json($res);  
			Yii::app()->end();
		}
		
       
    }
}