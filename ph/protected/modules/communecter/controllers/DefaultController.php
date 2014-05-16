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

    const moduleTitle = "Communecter";
    public static $moduleKey = "communecter";
    
    public $sidebar1 = array(
            
            array('label' => "Scenario", "key"=>"scenario","onclick"=>"toggle('scenario')","hide"=>true, "iconClass"=>"fa fa-list",
                "blocks"=>array(
                    array("label"=>"Inscription / Creation","iconClass"=>"fa fa-user",
                        "children"=>array(
                            "se communecter == remplir un email + cp = referencement mais pas de zone privée ",
                            "creer son compte privé = personnalisation",
                            "parrainage :: inviter un voisin ou une connaissance ou une entité, creer du lien",
                            "boule de neige social = utiliser les reseau sociau pour inviter ",
                            "un citoyen peut creer une entité (Gpe. , Ass. , Ent., Cit. )",
                        )),
                    array("label"=>"Administration","iconClass"=>"fa fa-cogs",
                        "children"=>array(
                            "Voir le nombres de citoyen",
                            "Voir le temps de frequentation",
                            ""
                            )),
                    array("label"=>"Visualisation","iconClass"=>"fa fa-eye",
                        "children"=>array(
                            "Voir l'activité de ma commune",
                            "Voir l'activité de ma region",

                            )),
                    array("label"=>"Communication","iconClass"=>"fa fa-bullhorn",
                        "children"=>array(
                            "System de notification PH > tout le monde",
                            "System de notification PH > une commune",
                            "Citoyen to Commune",
                            "Citoyen to Entity, Citoyen doit appartenir a l'entité",
                        )),
                )),
            array('label' => "User", "key"=>"user", "iconClass"=>"fa fa-user", 
                "children"=> array(
                    array( "label"=>"se Communecter","href"=>"javascript:;","onclick"=>"scrollTo('#blockCommunect')",),
                    array( "label"=>"Login","href"=>"javascript:;","onclick"=>"scrollTo('#blockLogin')",),
                    array( "label"=>"Save User","href"=>"javascript:;","onclick"=>"scrollTo('#blockSaveUser')"),
                    array( "label"=>"Get User","href"=>"javascript:;","onclick"=>"scrollTo('#blockGetUser')"),
                    array( "label"=>"ConfirmUserRegistration","href"=>"javascript:;","onclick"=>"scrollTo('#blockGetUser')"),
                    array( "label"=>"GetPeople","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetPeople')")
                )),
            array('label' => "Entities", "key"=>"entities", "iconClass"=>"fa fa-group",
                "children"=> array(
                    array( "label"=>"Save Group","href"=>"javascript:;","onclick"=>"scrollTo('#blocksaveGroup')"),
                    array( "label"=>"GetGroup","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetgroup')"),
                    array( "label"=>"linkUser2Group","href"=>"javascript:;","onclick"=>"scrollTo('#blocklinkUser2Group')"),
                    array( "label"=>"unlinkUser2Group","href"=>"javascript:;","onclick"=>"scrollTo('#blocklinkUser2Group')"),
                    array( "label"=>"getGroups","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetGroups')")
                )),
            array('label' => "Communication", "key"=>"communications", "iconClass"=>"fa fa-bullhorn", 
                "children"=> array(
                    array( "label"=>"sendMessage","href"=>"javascript:;","onclick"=>"scrollTo('#blocksendMessage')")
                )),
        );
    public $percent = 60; //TODO link it to unit test
    protected function beforeAction($action)
  {
    array_push($this->sidebar1, array('label' => "All Modules", "key"=>"modules","iconClass"=>"fa fa-th", "menuOnly"=>true,"children"=>PixelHumain::buildMenuChildren("applications") ));
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
    public function actions()
    {
        return array(
            'login'     =>'application.controllers.user.LoginAction',
            'saveuser'  =>'application.controllers.user.SaveUserAction',
            'communect' => 'application.controllers.user.CommunectAction',
            'getuser'   => 'application.controllers.user.GetUserAction',
        );
    }
    //********************************************************************************
    //          USERS
    //********************************************************************************


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
    //          ASSOCIATION
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