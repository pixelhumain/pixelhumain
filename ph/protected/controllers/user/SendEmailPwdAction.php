<?php
/**
 * 
 * @return [json] 
 */
class SendEmailPwdAction extends CAction
{
    public function run()
    {
       $email = $_POST["email"];
        if($user = PHDB::findOne(PHType::TYPE_CITOYEN,array( "email" => $email ) ))
        {
            //reset password 
            $pwd = self::random_password(8);
            //TODO SBAR : Call the model
            PHDB::update( PHType::TYPE_CITOYEN,
                            array("email" => $email), 
                            array('$set' => array("pwd"=>hash('sha256', $email.$pwd))));

            //TODO SBAR : Application - how does it work exactly ?
            //Same user for different application ? Application = Granddir ? Larges ? Communecter ?
            if (empty($_POST["app"])) {
                $app = new Application("");
            } else {
                $app = new Application($_POST["app"]);    
            }
            
            //send validation mail
            //TODO : make emails as cron jobs
            Mail::send(array("tpl"=>'passwordRetreive',
                             "subject" => 'Réinitialisation du mot de passe pour le site '.$app->name,
                             "from"=>Yii::app()->params['adminEmail'],
                             "to" => (!PH::notlocalServer())? Yii::app()->params['adminEmail']: $email,
                             "tplParams" => array( "pwd"   => $pwd ,
                                                 "title" => $app->name ,
                                                 "logo"  => $app->logoUrl )
                                             ));
            $res = array("result"=>true,"msg"=>"Un mail avec un nouveau mot de passe vous a été envoyé à votre adresse email. Merci.");
        } else {
            //TODO evoyer un email de presentation 
            $res = array("result"=>false,"errId" => "UNKNOWN_ACCOUNT_ID", 
               "msg"=>"Cet email n'existe pas dans notre base. Voulez vous créer un compte ?");
        }
        Rest::json($res);  
        Yii::app()->end();
    }

    //TODO SBAR : Move to the person model
    public function random_password( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }
}