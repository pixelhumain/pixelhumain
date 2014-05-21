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
            array('label' => "Votes", "key"=>"votes", "iconClass"=>"fa fa-thumbs-up", 
                "children"=> array(
                    array( "label"=>"sendMessage","href"=>"javascript:;","onclick"=>"scrollTo('#blocksendMessage')")
                )),
            array('label' => "Ventes", "key"=>"ventes", "iconClass"=>"fa fa-euro", 
                "children"=> array(
                    array( "label"=>"sendMessage","href"=>"javascript:;","onclick"=>"scrollTo('#blocksendMessage')")
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
	    $this->render("../../../../modules/api/views/index", array("path"=>'application.modules.'.$this::$moduleKey.'.views.api.') );
	}

    //********************************************************************************
    //          USERS (PEOPLE, PRODUCER)
    //********************************************************************************
    

    /**
     * actionLogin 
     * Login to open a session
     * uses the generic Citoyens login system 
     * @return [type] [description]
     */
    public function actionLogin() 
    {
        echo Citoyen::login( $_POST["email"] , $_POST["pwd"]);      
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

        //if exists login else create the new user
        echo Citoyen::login( $email, $_POST["pwd"]);
        if(Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) )){
            //udate the new app specific fields
            $newInfos = array();
            if( isset($_POST['cp']) )
                $newInfos['cp'] = $_POST['cp'];
            if( isset($_POST['name']) )
                $newInfos['name'] = $_POST['name'];
            if( isset($_POST['phoneNumber']) )
                $newInfos['phoneNumber'] = $_POST['phoneNumber'];

            $newInfos['applications'] = array( "key"=> "waterwatcher", "usertype" => $_POST['type']  );
            //$newInfos['lang'] = $_POST['lang'];
            
            Yii::app()->mongodb->citoyens->update(array("email" => $email), 
                                                  array('$set' => $newInfos ) 
                                                  );
        }
        Yii::app()->end();
    }
    /**
     * [actionGetWatcher get the user data based on his id]
     * @param  [string] $email   email connected to the citizen account
     * @return [type] [description]
     */
    public function actionGetUser($email) 
    {
        $res = true;
        $user = Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) );
        echo json_encode( $user );
        Yii::app()->end();
    }

    //********************************************************************************
    //          EVENTS
    //********************************************************************************
    
    //********************************************************************************
    //          VOTES
    //********************************************************************************
	
    //********************************************************************************
    //          SALES (BILLETERIE)
    //********************************************************************************
        
}