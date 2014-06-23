<?php

class Citoyen
{
    public static function isCommunected()
    {
        $user = PHDB::findOne(PHType::TYPE_CITOYEN,array("_id"=>new MongoId(Yii::app()->session["userId"]))); 
        return (isset($user["cp"])) ? $user["cp"] : null;
    }
    public static function isAdminUser()
    {
        return ( isset(Yii::app()->session["userIsAdmin"]) && Yii::app()->session["userIsAdmin"] ) ;  
    }
    public static function isAppAdmin($userId,$app) 
    {
        $user = PHDB::findOne(PHType::TYPE_CITOYEN,array("_id"=>new MongoId($userId))); 
        return (isset($user["applications"]) && isset($user["applications"][$app]) && isset($user["applications"][$app]["isAdmin"])) ;
    }
    public static function isAppUser($userId,$app) 
    {
        $user = PHDB::findOne(PHType::TYPE_CITOYEN,array("_id"=>new MongoId($userId))); 
        return (isset($user["applications"]) && isset($user["applications"][$app]));
     }

    /**
     * Register or Login
     * on PH registration requires only an email 
     * test exists 
     * if exists > request pwd
     * otherwise add to DB 
     * send validation mail 
     * @param  [string] $email   email connected to the citizen account
     * @param  [string] $pwd   pwd connected to the citizen account
     * @param  [boolean] $loginRegister   loginRegister defines if login fails this creates automatically a new account
     * @return [type] [description]
     */
    public static function login($email,$pwd,$loginRegister=null)
    {
        if(Yii::app()->request->isAjaxRequest && isset($email) && !empty($email))
        {
            Yii::app()->session["userId"] = null;
            Yii::app()->session["userEmail"] = null; 
            $account = PHDB::findOne(PHType::TYPE_CITOYEN,array("email"=>$email));
            if($account){
                if( empty( $account["pwd"] ) )
                {
                    if(empty($pwd)){
                        //send email to reset password
                        $pwd = uniqid('', true);
                        PHDB::update(PHType::TYPE_CITOYEN,array("email"=>$email), 
                                                          array('$set' => array("pwd"=>hash('sha256', $email.$pwd) )));
                        $message = new YiiMailMessage;
                        $message->view = 'validation';
                        $message->setSubject('Set your password - Pixel Humain');
                        $message->setBody(array("user"=>$account["_id"],
                                                "pwd"=>$pwd), 'text/html');
                        $message->addTo($email);
                        $message->from = Yii::app()->params['adminEmail'];
                        Yii::app()->mail->send($message);
                        
                        $res =  array("result"=>false, 
                                                "msg"=>"Vous n'aviez pas creer de mot de passe, un mot de passe temporaire vous a été envoyé par mail.") ;
                    } else {
                        //if a pwd was typed 
                        //it will be set as pwd and will login the person 
                        
                        PHDB::update(PHType::TYPE_CITOYEN,array("email"=>$email), 
                                                          array('$set' => array("pwd"=>hash('sha256', $email.$pwd) )));
                        
                        Yii::app()->session["userId"] = (string)$account["_id"];
                        Yii::app()->session["userEmail"] = $account["email"]; 
                        if( isset($account["isAdmin"]) && $account["isAdmin"] )
                            Yii::app()->session["userIsAdmin"] = $account["isAdmin"]; 
                            
                        /*Notification::saveNotification(array("type" => NotificationType::NOTIFICATION_LOGIN,
                                                "user" => $account["_id"]));*/
                        
                        $res = array("result"=>true,  "id"=>$account["_id"],"isCommunected"=>isset($account["cp"]));
                    }
                } 
                //if a pwd isn't set
                //but one is filled in the login field that will be the pwd
                elseif ( !empty($pwd) && $account["pwd"] == hash('sha256', $email.$pwd))
                {
                    Yii::app()->session["userId"] = (string)$account["_id"];
                    Yii::app()->session["userEmail"] = $account["email"]; 
                    
                    if( isset($account["isAdmin"]) && $account["isAdmin"] )
                        Yii::app()->session["userIsAdmin"] = $account["isAdmin"]; 
                        
                    /*Notification::saveNotification(array("type" => NotificationType::NOTIFICATION_LOGIN,
                                            "user" => $account["_id"]));*/
                    
                    $res = array("result"=>true,  "id"=>$account["_id"],"isCommunected"=>isset($account["cp"]));
                } else 
                    $res = array("result"=>false, "msg"=>"Email ou Mot de Passe ne correspondent pas, rééssayez.");
            } else if($loginRegister){
                $res = self::register( $email, $pwd );
            } else
                $res = array("result"=>false, "msg"=>"Merci de saisir un email valide et un mot de passe");
            
        } else
            $res = array("result"=>false, "msg"=>"Cette requête ne peut aboutir. Merci de bien vouloir réessayer en complétant les champs nécessaires");
        return $res;
    }

    /*
    a user registers with an email and a pwd minimum
    - check existance 
    - check email is valide
    - check pwd is filled 
    - insert to ciotyens collection
    - send validation Email 
    - add a system Notification for stats
     */
    public static function register( $email, $pwd )
    {
        if(Yii::app()->request->isAjaxRequest && isset($email) && !empty($email))
        {
            Yii::app()->session["userId"] = null;
            Yii::app()->session["userEmail"] = null; 
            $account = PHDB::findOne(PHType::TYPE_CITOYEN,array("email"=>$email));
            if(!$account)
            {
                //validate isEmail
                $name = "";
               if(preg_match('#^([\w.-])/<([\w.-]+@[\w.-]+\.[a-zA-Z]{2,6})/>$#',$email, $matches)) 
               {
                  $name = $matches[0];
                  $email = $matches[1];
               }
               
               if(!empty($pwd) && preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$email)) 
               { 
                   
                   //new user is creating account 
                   $newAccount = array(
                                'email'=>$email,
                                'pwd' => hash('sha256', $email.$pwd),
                                CitoyenType::NODE_TOBEACTIVATED => true,
                                'adminNotified' => false,
                                'created' => time()
                                );
                    if(!empty($name))
                        $newAccount["name"] = $name;
                    //add to DB
                    PHDB::insert(PHType::TYPE_CITOYEN,$newAccount);
                   
                    //set session elements for global credentials
                    Yii::app()->session["userId"] = (string)$newAccount["_id"]; 
                    Yii::app()->session["userEmail"] = $newAccount["email"];
                    
                    //send validation mail
                    //TODO : make emails as cron jobs
                    $message = new YiiMailMessage;
                    $message->view = 'validation';
                    $app = new Application($_POST["app"]);
                    $message->setSubject('Confirmer votre compte  pour le site '.$app->name);
                    $message->setBody(array( "user"=>$newAccount["_id"] ,
                                             "title" => $app->name ,
                                             "logo"  => $app->logoUrl ), 'text/html');
                    if(!PH::notlocalServer())
                        $message->addTo(Yii::app()->params['adminEmail']);
                    else
                        $message->addTo($email);
                    $message->from = Yii::app()->params['adminEmail'];
                    Yii::app()->mail->send($message);
                    
                    //TODO : add an admin notification
                    /*Notification::saveNotification(array("type"=>NotificationType::NOTIFICATION_REGISTER,
                                            "user"=>$newAccount["_id"]));*/
                    
                    $res = array("result"=>true, "id"=>$newAccount);
               } else
                        $res = array("result"=>false, "msg"=>"Vous devez remplir un email valide et un mot de passe .");
            } else
                $res = array("result"=>true, "id"=>$account["_id"]);
        } else
            $res = array("result"=>false, "msg"=>"Cette requete ne peut aboutir.");

        return $res;
    }
/*
    a user communects with an email and a postal code
    - check existance 
    - check email is valide
    - check pwd is filled 
    - insert to ciotyens collection
    - send validation Email 
    - add a system Notification for stats
     */
    public static function communect( $email, $cp)
    {
        if(Yii::app()->request->isAjaxRequest && isset($email) && !empty($email))
        {
            $account = PHDB::findOne(PHType::TYPE_CITOYEN,array("email"=>$email));
            if(!$account)
            {
                //validate isEmail
                $name = "";
               if(preg_match('#^([\w.-])/<([\w.-]+@[\w.-]+\.[a-zA-Z]{2,6})/>$#',$email, $matches)) 
               {
                  $name = $matches[0];
                  $email = $matches[1];
               }
               
               if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$email)) 
               { 
                   //new user is creating account 
                   $newAccount = array(
                                'email'=>$email,
                                CitoyenType::NODE_TOBEACTIVATED => true,
                                'adminNotified' => false,
                                'created' => time()
                                );
                    if(!empty($cp))
                        $newAccount["cp"] = $cp;
                    if(!empty($name))
                        $newAccount["name"] = $name;
                    //add to DB
                    PHDB::insert(PHType::TYPE_CITOYEN,$newAccount);

                    //set session elements for global credentials
                    Yii::app()->session["userId"] = (string)$newAccount["_id"]; 
                    Yii::app()->session["userEmail"] = $newAccount["email"];
                    
                    //send validation mail
                    //TODO : make emails as cron jobs
                    /*$message = new YiiMailMessage;
                    $message->view = 'validation';
                    $message->setSubject('Confirmer votre compte Pixel Humain');
                    $message->setBody(array("user"=>$newAccount["_id"]), 'text/html');
                    $message->addTo($email);
                    $message->from = Yii::app()->params['adminEmail'];
                    Yii::app()->mail->send($message);*/
                    
                    //TODO : add an admin notification
                    /*Notification::saveNotification(array("type"=>NotificationType::NOTIFICATION_COMMUNECTED,
                                            "user"=>$newAccount["_id"]));*/
                    
                    $res = array("result"=>true, "id"=>$newAccount,"isNewUser"=>true);
               } else
                        $res = array("result"=>false, "msg"=>"Vous devez remplir un email valide.");
            } else
                $res = array("result"=>true, "id"=>$account["_id"]);
        } else
            $res = array("result"=>false, "msg"=>"Cette requete ne peut aboutir.");

        return $res;
    }

    //Registers a user into an application
    //by adding "applications":{"appKey":{appData}}
    //an application is defined in the application collection
    //if appkey is null no need to regiser any application
    public static function applicationRegistered($appKey, $email){
        $res = array();
        if( isset( Yii::app()->session["userId"]) && $appKey != null  ){
            //TODO : test application exists
            $application = PHDB::findOne(PHType::TYPE_APPLICATIONS, array( "key" => $appKey ) );  
            //check if application is registered on user account
            $account = PHDB::findOne(PHType::TYPE_CITOYEN, array( "email" => $email ) ); 
            //if not add it 
            if( isset( $application ) && !isset( $account["applications"][$appKey] ) )
            {
                $newInfos = array();
                if( !isset( $account[ 'applications' ] ))
                    $newInfos['applications'] = array( $appKey => array( "usertype" => $appKey)  );
                else {
                    $newInfos['applications'] = $account[ 'applications' ];
                    $newInfos['applications'] [$appKey] = array( "usertype" => $appKey)  ;
                }
                //if application requires rgistration confirmation or moderation
                if( isset( $application["registration"] ) && $application["registration"] == "mustBeConfirmed"  ){
                    $newInfos['applications'][$appKey]["registrationConfirmed"] = false ;
                    $res["addedRegistrationConfirmationRequest"] = true;
                }
                PHDB::update(PHType::TYPE_CITOYEN, array("email" => $email), 
                                                       array('$set' => $newInfos ) 
                                                      );
                $res["addedRegistration"] = $appKey;
            } else
                $res["isRegister".$appKey] = true;
        }
        return $res;
    }
    /*
    - email must be valid
     */
     public static function createUser($email){
        //new user is creating account 
        $newAccount = array(
                    'email'=>$email,
                    'created' => time()
                    );
        
        PHDB::insert(PHType::TYPE_CITOYEN,$newAccount);
        //send validation mail
        //TODO : make emails as cron jobs
        $message = new YiiMailMessage;
        $message->view = 'validation';
        $message->setSubject('Confirmer votre compte Pixel Humain');
        $message->setBody(array("user"=>$newAccount["_id"]), 'text/html');
        $message->addTo("oceatoon@gmail.com");//$email
        $message->from = Yii::app()->params['adminEmail'];
        Yii::app()->mail->send($message);

        return array("userAdded"=>true,"id"=>(string)$newAccount["_id"]);
    }

    /*
    -check email is valid
    -new user is creating account 
    -link both users together
     */
    public static function inviteUser($invitedEmail)
    {
        //check email is valid
        if( preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$invitedEmail) ) 
        { 
            $res = Citoyen::createUser($invitedEmail);
           
            //link both users together
            if(Yii::app()->session["userId"])
                $res["link2Users_Call"] = Citoyen::link2Users( (string)Yii::app()->session["userId"] , (string)$res["id"] );
        } else  
            $res = array("result"=>false,"msg"=>"submited email is not valid");
        return $res;
    }

    /*
    - make sure both users exist and aren't the same id
    - add a relation link on the inviter
    - add invited to inviter friends
    - add inviter to invited friends
    - notify the invited user for validation
    - return true or false
     */
    public static function link2Users($inviterId, $invitedId)
    {
        //make sure both users exist
        $inviter = PHDB::findOne(PHType::TYPE_CITOYEN, array("_id" => new MongoId($inviterId) )); 
        $invited = PHDB::findOne(PHType::TYPE_CITOYEN, array("_id" => new MongoId($invitedId) ));
        $res = array("result" => false);
        if($inviter && $invited && $inviter != $invited)
        {
            //check if not allready linked
            if( !isset($inviter[CitoyenType::NODE_FRIENDS]) || ( isset($inviter[CitoyenType::NODE_FRIENDS]) && !isset( $inviter[CitoyenType::NODE_FRIENDS][$invitedId] ) ) )
            {
                //add a relation link on the inviter
                //add invited to inviter friends
                PHDB::update(PHType::TYPE_CITOYEN,array("_id"   => new MongoId($inviterId)), 
                                                      array('$set' => array( CitoyenType::NODE_FRIENDS.".".$invitedId => array( "since"=>time()))));
                //add inviter to invited friends
                if( !isset($invited[CitoyenType::NODE_FRIENDS]) || ( isset($invited[CitoyenType::NODE_FRIENDS]) && !isset( $invited[CitoyenType::NODE_FRIENDS][$inviterId] ) ) )
                    PHDB::update(PHType::TYPE_CITOYEN,array("_id"   => new MongoId($invitedId)), 
                                                          array('$set' => array( CitoyenType::NODE_FRIENDS.".".$inviterId => array( "since"=>time() ))));

                //notify the invited user for validation
                Notification::saveNotification (
                    array(  "type" => NotificationType::NOTIFICATION_LINK_REQUEST,
                            "notifyUser"    => $invitedId,
                            "inviter"       => $inviterId,
                            "invited"       => $invitedId ));
                $res = array("result" => true,
                             "invitationRequestSaved"=>true,
                             "inviterId"=>$inviterId,
                             "invitedId"=>$invitedId);
            } else 
                $res = array("result" => false,
                             "msg"=>"users are allready connected",
                             "inviterId"=>$inviterId,
                             "invitedId"=>$invitedId);
        } else
            $res = array("result" => false,
                             "msg"=>"users must be different",
                             "inviterId"=>$inviterId,
                             "invitedId"=>$invitedId);
        return $res;
    }
    /*
    Gets all users corresponding to a certain request
    - set the where clause according to POST parameters
    - a fields can be added to the selection clause, in order to retreive only certain fields from DB
     */
    public static function getPeopleBy($params)
    {
        $where = (isset($params["where"])) ? $params["where"] : array();
        $fields = ( isset($params["fields"]) ) ? $params["fields"] : array();
        
        if( isset( $params["groupname"] ) ){
            $group = PHDB::findOne(PHType::TYPE_GROUPS,  array( "name" => $params["groupname"] ) );
            $where = array( Citoyen::$types2Nodes[$group["type"]] => (string)$group['_id']);
        } else if( isset( $params["cp"] ) ){
            $where = array( "cp" => $params["cp"] );
        } else if( isset( $params["app"] ) ){
            $where  = array( "applications.".$params["app"].".usertype" => $params["app"] );
        }

        if( !isset($params["count"]) ) 
            $res = PHDB::find(PHType::TYPE_CITOYEN,  $where,$fields );
        else
            $res = array('count' => PHDB::count(PHType::TYPE_CITOYEN,  $where,$fields ));
        return $res;
    }
    
}