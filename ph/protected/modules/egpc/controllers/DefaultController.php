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

    protected function beforeAction($action)
  {
    
    array_push( $this->sidebar1, array( "label"=>"Login","href"=>"#blockLogin"));
    array_push( $this->sidebar1, array( "label"=>"Save User","href"=>"#blockSaveUser"));
    array_push( $this->sidebar1, array( "label"=>"Get User","href"=>"#blockGetUser"));
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
        echo Citoyen::register( $email, $_POST["pwd"]);
        if(Yii::app()->mongodb->citoyens->findOne( array( "email" => $email ) )){
            //udate the new app specific fields
            $newInfos = array();
            if( isset($_POST['cp']) )
                $newInfos['cp'] = $_POST['cp'];
            if( isset($_POST['name']) )
                $newInfos['name'] = $_POST['name'];
            if( isset($_POST['phoneNumber']) )
                $newInfos['phoneNumber'] = $_POST['phoneNumber'];

            $newInfos['applications'] = array( "key"=> $this->moduleKey, "usertype" => $_POST['type']  );
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
    //          ASSOCIATION
    //********************************************************************************
    
    //********************************************************************************
    //          GROUPS
    //********************************************************************************
    
    //********************************************************************************
    //          EVENTS
    //********************************************************************************
}