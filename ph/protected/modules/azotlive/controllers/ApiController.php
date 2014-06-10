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

    const moduleTitle = "API Azot Live";
    public static $moduleKey = "azotlive";

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
                    array( "label"=>"GetPeople","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetPeople')"),
                    array( "label"=>"InvitePeople","href"=>"javascript:;","onclick"=>"scrollTo('#blockinviteUser')"),
                    array( "label"=>"GetNodeByType","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetnodeby')")
                )),
            array('label' => "Evenement", "key"=>"evenement", "iconClass"=>"fa fa-microphone",
                "children"=> array(
                    array( "label"=>"Save Group","href"=>"javascript:;","onclick"=>"scrollTo('#blocksaveGroup')"),
                    array( "label"=>"GetGroup","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetgroup')"),
                    array( "label"=>"linkUser2Group","href"=>"javascript:;","onclick"=>"scrollTo('#blocklinkUser2Group')"),
                    array( "label"=>"unlinkUser2Group","href"=>"javascript:;","onclick"=>"scrollTo('#blocklinkUser2Group')"),
                    array( "label"=>"getGroups","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetGroups')")
                )),
            array('label' => "Actions : Votes, Purchase", "key"=>"votes", "iconClass"=>"fa fa-thumbs-up", 
                "children"=> array(
                    array( "label"=>"sendMessage","href"=>"javascript:;","onclick"=>"scrollTo('#blocksendMessage')")
                )),
        );

    public $percent = 60; //TODO link it to unit test

    protected function beforeAction($action)
    {
        array_push($this->sidebar1, array('label' => "All Modules", "key"=>"modules","iconClass"=>"fa fa-th",  "menuOnly"=>true,"children"=>PH::buildMenuChildren("applications") ));
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
            'addaction'                 => 'application.controllers.action.AddActionAction',
            "getactionvalue"            => 'application.controllers.generic.GetFromCollectionAction',

            'savegroup'                 => 'application.controllers.groups.SaveGroupAction',  
            'getgroupsby'               => 'application.controllers.groups.GetGroupsByAction',  
            'linkuser2group'            => 'application.controllers.groups.LinkUser2GroupAction',
            
            'sendmessage'               => 'application.controllers.messages.SendMessageAction',  
            'getmessageby'              => 'application.controllers.messages.GetMessageByAction',  
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

        
}