<?php
/**
 * DefaultController.php
 *
 * API REST pour géré l'application EGPC
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class ApiController extends Controller {

    const moduleTitle = "API EGPC";
    public static $moduleKey = "egpc";
    public $sidebar1 = array(
            
            array('label' => "Scenario", "key"=>"scenario","onclick"=>"toggle('scenario')","hide"=>true,"iconClass"=>"fa fa-list",
                "blocks"=>array(
                    array("label"=>"Inscription / Creation ","iconClass"=>"fa fa-cogs",
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
                    array("label"=>"Visualisation","iconClass"=>"fa fa-eye",
                        "children"=>array(
                            "Tout le monde peut visualiser l'organisation de EGPC",
                            "Voir un listing de chaque entité  (Gpe. , Ass. , Ent., Cit. )",
                            "Voir tout les evenements",
                            "Filtrer par mots clefs",
                            "Ouvrir une entité (Gpe. , Ass. , Ent., Cit., Event )"
                            )),
                    array("label"=>"Communication","iconClass"=>"fa fa-bullhorn",
                        "children"=>array(
                            "Send a message to list of people",
                        )),
                )),
            array('label' => "User", "key"=>"user", "iconClass"=>"fa fa-user", 
                "children"=> array(
                    array( "label"=>"Login","href"=>"javascript:;","onclick"=>"scrollTo('#blockLogin')"),
                    array( "label"=>"Save User","href"=>"javascript:;","onclick"=>"scrollTo('#blockSaveUser')"),
                    array( "label"=>"Get User","href"=>"javascript:;","onclick"=>"scrollTo('#blockGetUser')"),
                    array( "label"=>"ConfirmUserRegistration","href"=>"javascript:;","onclick"=>"scrollTo('#blockGetUser')"),
                    array( "label"=>"GetPeople","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetPeople')")
                )),
            array('label' => "Entities", "key"=>"entities","iconClass"=>"fa fa-group",
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
            array('label' => "Views", "key"=>"views", "iconClass"=>"fa fa-eye", 'menuOnly'=>true,
                "children"=> array(
                    array( "label" => "Graph", "href" => "/ph/egpc","iconClass"=>"fa fa-sitemap", )
                )),
        );
    public $percent = 60; //TODO link it to unit test

    protected function beforeAction($action)
    {
        array_push($this->sidebar1, array('label' => "All Modules", "key"=>"modules","iconClass"=>"fa fa-th",  "menuOnly"=>true,"children"=>PixelHumain::buildMenuChildren("applications") ));
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return array(
            //********************************************************************************
            //          USERS
            //********************************************************************************
            'login'                     =>'application.controllers.user.LoginAction',
            'saveuser'                  =>'application.controllers.user.SaveUserAction',
            'getuser'                   => 'application.controllers.user.GetUserAction',
            'confirmgroupregistration'  => 'application.controllers.user.ConfirmUserRegistrationAction',
            'getpeopleby'               => 'application.controllers.user.GetPeopleByAction',

            'savegroup'                 => 'application.controllers.groups.SaveGroupAction',  
            'getgroupsby'               => 'application.controllers.groups.GetGroupsByAction',  
            
            'sendmessage'               => 'application.controllers.messages.SendMessageAction',  
        );
    }
    /**
     * List all the latest observations
     * @return [json Map] list
     */
	public function actionIndex() 
	{
	    $this->render("../../../../modules/api/views/index", array("path"=>'application.modules.'.$this::$moduleKey.'.views.api.') );
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


}