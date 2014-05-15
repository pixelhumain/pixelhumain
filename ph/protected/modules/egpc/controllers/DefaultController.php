<?php
/**
 * DefaultController.php
 *
 * API REST pour géré l'application EGPC
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class DefaultController extends Controller {

    const moduleTitle = "Etat Généraux des pouvoirs citoyens";
    public static $moduleKey = "egpc";
    
    public $sidebar1 = array(
            
            array('label' => "Scenario", "key"=>"scenario","onclick"=>"toggleScenario('scenario')","hide"=>true,
                "blocks"=>array(
                    array("label"=>"Inscription / Creation",
                        "children"=>array(
                            "EGPC envoie une invitation par campagne mail contenant un lien d'inscription",
                            "Le nouveau venu s'inscrit en citoyen : email + cp ",
                            "peut creer une association + mot clef",
                            "peut creer une entreprise + mot clef",
                            "peut creer un groupe + mot clef",
                            "peut inviter qlq'un dans chacune de ces entités",
                            "peut creer un evenement en tant que citoyen ou pour son entité",
                            "peut inviter qlq'un à un evenement",
                        )),
                    array("label"=>"Visualisation",
                        "children"=>array(
                            "Tout le monde peut visualiser l'organisation de EGPC",
                            "Voir un listing de chaque entité  (Gpe. , Ass. , Ent., Cit. )",
                            "Voir tout les evenements",
                            "Filtrer par mots clefs",
                            "Ouvrir une entité (Gpe. , Ass. , Ent., Cit. )",
                            "Ouvrir un evenement"
                            )),
                    array("label"=>"Communication",
                        "children"=>array(
                            "Send a message to list of people",
                        )),
                )),
            array('label' => "User", "key"=>"user", 
                "children"=> array(
                    array( "label"=>"Login","href"=>"#blockLogin"),
                    array( "label"=>"Save User","href"=>"#blockSaveUser"),
                    array( "label"=>"Get User","href"=>"#blockGetUser"),
                    array( "label"=>"ConfirmUserRegistration","href"=>"#blockGetUser"),
                    array( "label"=>"GetPeople","href"=>"#blockgetPeople")
                )),
            array('label' => "Entities", "key"=>"entities",
                "children"=> array(
                    array( "label"=>"Save Group","href"=>"#blocksaveGroup"),
                    array( "label"=>"GetGroup","href"=>"#blockgetgroup"),
                    array( "label"=>"linkUser2Group","href"=>"#blocklinkUser2Group"),
                    array( "label"=>"unlinkUser2Group","href"=>"#blocklinkUser2Group"),
                    array( "label"=>"getGroups","href"=>"#blockgetGroups")
                )),
            array('label' => "Communication", "key"=>"communications", 
                "children"=> array(
                    array( "label"=>"sendMessage","href"=>"#blocksendMessage")
                )),
        );
    public $percent = 60; //TODO link it to unit test

    protected function beforeAction($action)
    {
        array_push($this->sidebar1, array('label' => "All Modules", "key"=>"modules", "menuOnly"=>true,"children"=>PixelHumain::buildMenuChildren("applications") ));
        return parent::beforeAction($action);
    }
    /**
     * List all the latest observations
     * @return [json Map] list
     */
	public function actionIndex() 
	{
	    $this->render("index");
	}

    //********************************************************************************
    //          USERS
    //********************************************************************************
    

    /**
     * actionLogin 
     * Login to open a session
     * uses the generic Citoyens login system 
     * @return [type] [description]
     */
    public function actionLogin() 
    {
        $email = $_POST["email"];
        $res = Citoyen::login( $email , $_POST["pwd"]); 
        $res = array_merge($res, Citoyen::applicationRegistered($this::$moduleKey,$email));

        Rest::json($res);
        Yii::app()->end();
    }
    /**
     * [actionAddWatcher 
     * create or update a user account
     * if the email doesn't exist creates a new citizens with corresponding data 
     * else simply adds the watcher app the users profile ]
     * @return [json] 
     */
    public function actionSaveUser() 
    {
        $email = $_POST["email"];
        if( isset( Yii::app()->session["userId"] ) && Yii::app()->request->isAjaxRequest){
            //if exists login else create the new user
            $res = Citoyen::register( $email, $_POST["pwd"]);
            if(Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) )){
                //udate the new app specific fields
                $newInfos = array();
                if( isset($_POST['cp']) )
                    $newInfos['cp'] = $_POST['cp'];
                if( isset($_POST['name']) )
                    $newInfos['name'] = $_POST['name'];
                if( isset($_POST['phoneNumber']) )
                    $newInfos['phoneNumber'] = $_POST['phoneNumber'];
                if( isset($_POST['when']) )
                    $newInfos['when'] = $_POST['when'];
                if( isset($_POST['where']) )
                    $newInfos['where'] = $_POST['where'];

                $newInfos['applications'] = array( $this::$moduleKey => array( "usertype"=>$_POST['type'] ,"registrationConfirmed" => false ));
                
                Yii::app()->mongodb->citoyens->update( array("email" => $email), 
                                                       array('$set' => $newInfos ) 
                                                      );
            }
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
        Rest::json($res);  
        Yii::app()->end();
    }
    /**
     * [actionGetWatcher get the user data based on his id]
     * @param  [string] $email   email connected to the citizen account
     * @return [type] [description]
     */
    public function actionGetUser($email) 
    {
       $user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) );
        Rest::json( $user );
        Yii::app()->end();
    }

    public function actionConfirmUserRegistration($email) 
    {
        //TODO : add a test adminUser
        //isAppAdminUser
        if( isset( Yii::app()->session["userId"]  ) ) { 
            $user = Yii::app()->mongodb->citoyens->findAndModify( array("email" => $email), 
                                                                  array('$set' => array("applications.egpc.registrationConfirmed"=>true) ) );
            $user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) );
            Rest::json( $user );
        }
        Yii::app()->end();
    }

    public function actionGetPeople() 
    {
        
        if( isset( $_POST["name"] ) ){
            $where["name"] = $_POST["name"];
            $group = Yii::app()->mongodb->group->findOne ( array( "name" => $_POST["name"] ) );
            $users = Yii::app()->mongodb->citoyens->find ( array( "associations" => (string)$group['_id']) );
        } else {
            $users = Yii::app()->mongodb->citoyens->find ( array( "applications.egpc.usertype" => $this::$moduleKey ) );
        }
        Rest::json( iterator_to_array($users) );
        Yii::app()->end();
    }

    //********************************************************************************
    //          ENTITIES
    //********************************************************************************
    public function actionSaveGroup() 
    {
        $email = $_POST["email"];

        if( isset( Yii::app()->session["userId"] ) && Yii::app()->request->isAjaxRequest){
            //creating user must exist
            if($user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) )) 
            {
                //udate the new app specific fields
                $newInfos = array();
                if( isset($_POST['email']) )
                    $newInfos['email'] = $_POST['email'];
                if( isset($_POST['cp']) )
                    $newInfos['cp'] = $_POST['cp'];
                if( isset($_POST['name']) )
                    $newInfos['name'] = $_POST['name'];
                if( isset($_POST['phoneNumber']) )
                    $newInfos['phoneNumber'] = $_POST['phoneNumber'];
                if( isset($_POST['type']) )
                    $newInfos['type'] = $_POST['type'];
                $newInfos['applications'] = array( $this::$moduleKey => array( "usertype"=>$_POST['type'],"registrationConfirmed" => false ));
                    
                //if exists login else create the new group
                if(!Yii::app()->mongodb->group->findOne( array( "type"=>$_POST['type'],"name"=>$_POST['name'] ) ))
                {
                    Yii::app()->mongodb->group->insert( $newInfos);
                    $res = array("result" => true, 
                                 "msg"    => $_POST['type']." has be created or updated");
                } else {
                    //if there's an email change 
                    Yii::app()->mongodb->group->update( array("name" => $_POST['name']), 
                                                        array('$set' => $newInfos ) 
                                                      );
                }
            } else 
                $res = array('result' => false, "msg"=>"Connected user must exist");
         } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');

        Rest::json($res);  
        Yii::app()->end();
    }
    public function actionGetGroup($email) 
    {
       $res = Yii::app()->mongodb->group->find( array( "email" => $email ) );
        Rest::json( iterator_to_array($res) );
        Yii::app()->end();
    }

    public function actionGetGroups() 
    {
        //TODO : other fgroup types
       $res = Yii::app()->mongodb->group->find( array( "applications.egpc.usertype" => Group::TYPE_ASSOCIATION ));
        Rest::json( iterator_to_array($res) );
        Yii::app()->end();
    }
    public function actionLinkUser2Group() 
    {
        if( isset( Yii::app()->session["userId"] ) && Yii::app()->request->isAjaxRequest && isset( $_POST['email'] ) && isset( $_POST['name'] ) )
        {
            $emails = explode(",",$_POST['email'] );
            $res = array(); 
            foreach ($emails as $email) {
                $res = array_merge($res, Group::addMember($email  , $_POST['name'], Group::TYPE_ASSOCIATION ));
            }
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
        Rest::json($res);
        Yii::app()->end();
    }
    public function actionUnLinkUser2Group() 
    {
        if( isset( Yii::app()->session["userId"] ) && Yii::app()->request->isAjaxRequest && isset( $_POST['email'] ) && isset( $_POST['name'] ) )
        {
            $emails = explode(",",$_POST['email'] );
            $res = array(); 
            foreach ($emails as $email) {
                $res = array_merge($res, Group::removeMember($email  , $_POST['name'], Group::TYPE_ASSOCIATION ));
            }
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
        Rest::json($res);
        Yii::app()->end();
    }
    //********************************************************************************
    //          COMMUNICATIONS
    //********************************************************************************
    public function actionSendMessage() 
    {
        if( isset( Yii::app()->session["userId"] ) && Yii::app()->request->isAjaxRequest && isset( $_POST['email'] ) && isset( $_POST['msg'] ) )
        {
            $res = Message::createMessage($_POST['email']  , $_POST['msg'], self::$moduleKey );
        } else
            $res = array('result' => false , 'msg'=>'something somewhere went terribly wrong');
        Rest::json($res);
        Yii::app()->end();
    }

}