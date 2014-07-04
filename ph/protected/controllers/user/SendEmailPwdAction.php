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
            PHDB::update( PHType::TYPE_CITOYEN,
                            array("email" => $email), 
                            array('$set' => array("pwd"=>hash('sha256', $email.$pwd))));

            //send validation mail
            //TODO : make emails as cron jobs
            $app = new Application($_POST["app"]);
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
            $res = array("result"=>false,"msg"=>"Cet email n'existe pas, vous pouvez le creer par contre.");
        }
        Rest::json($res);  
        Yii::app()->end();
    }
    public function random_password( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }
}