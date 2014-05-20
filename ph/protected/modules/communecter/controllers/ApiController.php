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
                    array( "label"=>"GetPeople","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetPeople')"),
                    array( "label"=>"InvitePeople","href"=>"javascript:;","onclick"=>"scrollTo('#blockinviteUser')"),
                    array( "label"=>"GetNodeByType","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetnodeby')")
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
	    $this->render("../../../../modules/api/views/index", array("path"=>'application.modules.'.$this::$moduleKey.'.views.api.') );
	}
    public function actions()
    {
        return array(
            'login'     =>'application.controllers.user.LoginAction',
            'saveuser'  =>'application.controllers.user.SaveUserAction',
            'communect' => 'application.controllers.user.CommunectAction',
            'getuser'   => 'application.controllers.user.GetUserAction',
            'getpeopleby'   => 'application.controllers.user.GetPeopleByAction',
            'inviteuser'   => 'application.controllers.user.InviteUserAction',
            'getnodeby'   => 'application.controllers.user.GetNodeByAction',

            'savegroup'   => 'application.controllers.groups.SaveGroupAction',  
            'getgroupsby'   => 'application.controllers.groups.GetGroupsByAction',  

            'sendmessage'   => 'application.controllers.messages.SendMessageAction',  
        );
    }
    


}