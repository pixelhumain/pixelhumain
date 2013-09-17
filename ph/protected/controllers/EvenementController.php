<?php
/**
 * ActionLocaleController.php
 *
 * tous ce que propose le PH en terme de gestion d'evennement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class EvenementController extends Controller {

	public function actionIndex() {
	    $this->render("index");
	}
    public function actionView($id) {
        $event = Yii::app()->mongodb->group->findOne(array("_id"=>new MongoId($id)));
        if(isset($event["key"]) )
            $this->redirect(Yii::app()->createUrl('index.php/evenement/'.$event["key"]));
        else    
	        $this->render("view");
	}
    public function actionCreer() {
	    $this->render("new");
	}
	
	/**
	 * Start Up Week End
	 */
    public function actionStartupWeekEnd2012() {
	    $this->layout = "swe";
	    if(!isset(Yii::app()->session["userId"]))
	        $this->render("swe/sweLogin");
	    else {
	        $sweThings = Yii::app()->mongodb->startupweekend->find(); 
	        $this->render("swe/swegraph",array("sweThings"=>$sweThings));
	    }
	}
    public function actionSweAdmin() {
	    $this->layout = "swe";
	    $this->render("swe/sweAdmin");
	}
    public function actionSweImport() {
	    $this->layout = "swe";
	    $this->render("swe/import");
	}
    public function actionSweInfos() {
	    if(Yii::app()->request->isAjaxRequest && isset(Yii::app()->session["userId"]))
		{
            $account = Yii::app()->mongodb->startupweekend->findOne(array("email"=>Yii::app()->session["userEmail"]));
            if($account)
            {
                  $newInfos = $_POST;
                  $where = array("_id" => new MongoId(Yii::app()->session["userId"]));	
                  Yii::app()->mongodb->startupweekend->update($where, array('$set' => $newInfos));
                  $result = array("result"=>true,"msg"=>"Vos Données ont bien été enregistrées.");
                  
                  echo json_encode($result); 
            } else 
                  echo json_encode(array("result"=>false, "id"=>"accountNotExist ".Yii::app()->session["userId"],"msg"=>"Ce compte n'existe plus."));
                
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}
    public function actionSweRejoindreProjet() {
	    if(Yii::app()->request->isAjaxRequest && isset(Yii::app()->session["userId"]))
		{
            $account = Yii::app()->mongodb->startupweekend->findOne(array("email"=>Yii::app()->session["userEmail"]));
            if($account)
            {
                  $newInfos = array("projet"=>$_POST["projet"]);
                  $where = array("_id" => new MongoId(Yii::app()->session["userId"]));	
                  Yii::app()->mongodb->startupweekend->update($where, array('$set' => $newInfos));
                  $result = array("result"=>true,"msg"=>"Vos Données ont bien été enregistrées.");
                  
                  echo json_encode($result); 
            } else 
                  echo json_encode(array("result"=>false, "id"=>"accountNotExist ".Yii::app()->session["userId"],"msg"=>"Ce compte n'existe plus."));
                
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}
}