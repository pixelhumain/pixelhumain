<?php
/**
 * [actionAddWatcher 
 * create or update a user account
 * if the email doesn't exist creates a new citizens with corresponding data 
 * else simply adds the watcher app the users profile ]
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
            $message = new YiiMailMessage;
            $message->view = 'passwordRetreive';
            $app = ( isset($_POST["app"])) ? PHDB::findOne(PHType::TYPE_APPLICATIONS,array( "key" => $_POST["app"] ) ) : null;
            $title = ( $app && isset($app["name"]) ) ? $app["name"] : "Pixel Humain";
            $logo = ( $app && isset($app["logo"]) ) ? Yii::app()->getModule($app["key"])->assetsUrl.$app["logo"] : Yii::app()->getRequest()->getBaseUrl(true).'/images/logo/logo144.png';
            $message->setSubject('Votre Mot de passe '.$title);
            $message->setBody(array( "pwd"   => $pwd ,
                                     "title" => $title ,
                                     "logo"  => $logo ), 'text/html');
            if(!PH::notlocalServer())
                $message->addTo(Yii::app()->params['adminEmail']);
            else
                $message->addTo($email);
            $message->from = Yii::app()->params['adminEmail'];
            Yii::app()->mail->send($message);

            $res = array("result"=>true,"msg"=>"Veuillez vérifier votre boite Email, vous y trouverez votre mot de passe.");
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