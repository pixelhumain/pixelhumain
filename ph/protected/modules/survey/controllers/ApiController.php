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

    const moduleTitle = "API Sondage";
    public static $moduleKey = "survey";
    
    public $sidebar1 = array(
            array('label' => "Scenario", "key"=>"scenario","onclick"=>"toggle('scenario')","hide"=>true, "iconClass"=>"fa fa-list","generate"=>true),
            array('label' => "User", "key"=>"user", "iconClass"=>"fa fa-user", 
                "children"=> array(
                    array( "label"=>"Login","href"=>"javascript:;","onclick"=>"scrollTo('#blockLogin')",),
                    array( "label"=>"Save User","href"=>"javascript:;","onclick"=>"scrollTo('#blockSaveUser')"),
                    array( "label"=>"Get User","href"=>"javascript:;","onclick"=>"scrollTo('#blockGetUser')"),
                    array( "label"=>"ConfirmUserRegistration","href"=>"javascript:;","onclick"=>"scrollTo('#blockGetUser')"),
                    array( "label"=>"GetPeople","href"=>"javascript:;","onclick"=>"scrollTo('#blockgetPeople')"),
                    array( "label"=>"InvitePeople","href"=>"javascript:;","onclick"=>"scrollTo('#blockinviteUser')")
                )),
            array('label' => "Survey", "key"=>"survey", "iconClass"=>"fa fa-thumbs-up", 
                "children"=> array(
                    array( "label"=>"Create Session", "desc"=>"a session is a container will contain entries and be linked to people",
                        "href"=>"javascript:;","onclick"=>"scrollTo('#blocksaveSession')"),
                    array( "label"=>"Add Entry","desc"=>"an entry, is a text, law, idea, things to vote on",
                        "href"=>"javascript:;","onclick"=>"scrollTo('#blockaddEntry')"),
                    array( "label"=>"Vote on an Entry","desc"=>"votes help decision making and give orientations",
                        "href"=>"javascript:;","onclick"=>"scrollTo('#blockvoteEntry')"),
                    array( "label"=>"Admin confirm Entry","desc"=>"session can be moderated if specified",
                        "href"=>"javascript:;","onclick"=>"scrollTo('#blockadminConfirmFeed')"),
                )),
            array('label' => "Administration", "key"=>"adminSurvey", "iconClass"=>"fa fa-cog", 
                "children"=> array(
                    array( "label"=>"Get Quartier","href"=>"javascript:;","onclick"=>"scrollTo('#blockGetDatesBy')"),
                    array( "label"=>"Set Admin Quartier","href"=>"javascript:;","onclick"=>"scrollTo('#blockadminQuartier')"),
                )),
            array('label' => "Administration PH", "key"=>"adminPH", "iconClass"=>"fa fa-cogs", 
                "children"=> array(
                    array( "label"=>"Set Admin Quartier","href"=>"javascript:;","onclick"=>"scrollTo('#blockadminQuartier')"),
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
            'login'             =>'application.controllers.user.LoginAction',
            'saveuser'          =>'application.controllers.user.SaveUserAction',
            'communect'         => 'application.controllers.user.CommunectAction',
            'getuser'           => 'application.controllers.user.GetUserAction',
            'getpeopleby'       => 'application.controllers.user.GetPeopleByAction',
            'inviteuser'        => 'application.controllers.user.InviteUserAction',
            'addaction'         => 'application.controllers.action.AddActionAction',
            "getactionvalue"    => 'application.controllers.generic.GetFromCollectionAction',

            'savesession'       => 'application.controllers.survey.SaveSessionAction',  
            'getby'             => 'application.controllers.generic.GetByAction',  

            'sendmessage'       => 'application.controllers.messages.SendMessageAction',  
        );
    }
}