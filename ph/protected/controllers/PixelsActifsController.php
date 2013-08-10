<?php
/**
 * SiteController.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/23/12
 * Time: 12:25 AM
 */
class PixelsActifsController extends Controller {

	public function accessRules() {
		return array(
			// not logged in users should be able to login and view captcha images as well as errors
			array('allow', 'actions' => array('index','graph','register','register2')),
			// logged in users can do whatever they want to
			array('allow', 'users' => array('@')),
			// not logged in users can't do anything except above
			array('deny'),
		);
	}

	public function actionIndex() {
	    $this->render("index");
	}
	public function actionGraph() {
	    
	}
/**
	 * Register
	 * on PH we registration requires only an email 
	 * test exists 
	 * otherwise add the DB 
	 * send validation mail 
	 */
	public function actionRegister()
	{
	    if(Yii::app()->request->isAjaxRequest && isset($_POST['registerEmail']) && !empty($_POST['registerEmail']))
		{
            $account = Yii::app()->mongodb->pixelsactifs->findOne(array("email"=>$_POST['registerEmail']));
            if($account)
                echo json_encode(array("result"=>false, "id"=>"accountExist","msg"=>"Ce compte existe déjà."));
            else {
                //validate isEmail
               if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$_POST['registerEmail'])) { 
                    $newAccount = array(
                    			'email'=>$_POST['registerEmail'],
                                'tobeactivated' => true,
                                'adminNotified' => false
                                );
                    Yii::app()->mongodb->pixelsactifs->insert($newAccount);
                    Yii::app()->session["userId"] = $newAccount["_id"]; 
                    //TODO : send validation mail
                    $headers="From: Pixel Humain <contact@pixelhumain.com>\r\n".
    					"Reply-To: contact@pixelhumain.com\r\n".
    					"MIME-Version: 1.0\r\n".
    					"Content-type: text/plain; charset=UTF-8";
                    $body = "Bienvenue au Pixel Humain<br/>Merci de Valider votre inscription en cliquant le ien ci desous<br/>".
                            "<a href='http://pixelhumain.com'>pixelhumain.com</a>";
                    mail($_POST['registerEmail'],"Pixel Humain : Valider votre inscription",$body,$headers);
                    //TODO : add an admin notification
                    echo json_encode(array("result"=>true, "id"=>$newAccount["_id"]));
               }else
                   echo json_encode(array("result"=>false, "msg"=>"Vous devez remplir un email valide."));
            }
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}
	/**
	 * More details added to the user s registration account
	 */
    public function actionRegister2()
	{
	    if(Yii::app()->request->isAjaxRequest && isset(Yii::app()->session["userId"]))
		{
            $account = Yii::app()->mongodb->pixelsactifs->findOne(array("_id"=>Yii::app()->session["userId"]));
            if($account)
            {
                  $newInfos = array();
                  if( isset($_POST['registerName']) )
                      $newInfos['name'] = $_POST['registerName'];
                  if( isset($_POST['registerCP']) )
                      $newInfos['cp'] = $_POST['registerCP'];
                  if( isset($_POST['registerHelpout']) )
                  	  $newInfos['activeOnProject'] = $_POST['registerHelpout'];
                  if( isset($_POST['helpJob']) )
                  	  $newInfos['positions'] = explode(",", $_POST['helpJob']);
                  
                  //if a job in the list doesn't is new , add it to the jobType collection
                  $jobList = Yii::app()->mongodb->jobTypes->findOne(array("_id"=>new MongoId("5202375bc073efb084a9d2aa")));
                  foreach( explode(",", $_POST['helpJob']) as $job){
                      if(!in_array($job, $jobList['list'])){
                          array_push($jobList['list'], $job);
                          Yii::app()->mongodb->jobTypes->update(array("_id"=>new MongoId("5202375bc073efb084a9d2aa")), array('$set' => array("list"=>$jobList['list'])));
                      }
                  }
                  $where = array("_id" => new MongoId(Yii::app()->session["userId"]));	
                  Yii::app()->mongodb->pixelsactifs->update($where, array('$set' => $newInfos));
                  echo json_encode(array("result"=>true,"msg"=>"Vos Données ont bien été enregistrées.")); 
            } else 
                  echo json_encode(array("result"=>false, "id"=>"accountNotExist","msg"=>"Ce compte n'existe plus."));
                
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}
	/**
	 * upon Registration a email is send to the new user's email 
	 * he must click it to activate his account
	 * This is cleared by removing the tobeactivated field in the pixelactifs collection
	 */
    public function actionValidation()
	{
	    //validate the activation code 
	    //redirect to home page as a connected user 
	    
	}
}