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
	        $this->render("swe/view");
	}
    public function actionCreer() {
	    $this->render("new");
	}
	
	/**
	 * Start Up Week End
	 */
    public function actionStartupWeekEnd2012() {
	    $this->layout = "swe";
	    $event = Yii::app()->mongodb->group->findOne(array("key"=>"StartupWeekEnd2012"));
	    // for this event that is private 
	    // user must be loggued 
	    // and exist in the event user particpant list
	    if( !isset(Yii::app()->session["userId"]) || !self::isParticipant($event,"participants"))
	        $this->render("swe/sweLogin");
	    else {
	        $sweThings = Yii::app()->mongodb->startupweekend->find(); 
	        $this->render("swe/swegraph",array("sweThings"=>$sweThings));
	    }
	}
	/**
	 * 
	 * Enter description here ...
	 * @param  $event
	 * @param  $type : participants, organisateurs, projects,jurys,coaches
	 */
	public function isParticipant($event,$type){
	    return in_array( new MongoId(Yii::app()->session["userId"]) , $event[$type] );
	}
    public function actionSweAdmin() {
	    $this->layout = "swe";
	    $this->render("swe/sweAdmin");
	}
    public function actionSweImport() {
	    $this->layout = "swe";
	    $this->render("swe/import");
	}
    public function actionSweInfos() 
    { 
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
    public function actionSweImageUpload() {
        $demo_mode = false;
        $upload_dir = 'upload/';
        $allowed_ext = array('jpg','jpeg','png','gif');
        
        
        if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
        	exit_status('Error! Wrong HTTP method!');
        }
        
        
        if(array_key_exists('pic',$_FILES) && $_FILES['pic']['error'] == 0 ){
        	
        	$pic = $_FILES['pic'];
        	if(!in_array(pathinfo($pic['name'], PATHINFO_EXTENSION),$allowed_ext)){
        		exit_status('Only '.implode(',',$allowed_ext).' files are allowed!');
        	}	
        
        	if($demo_mode){
        		
        		// File uploads are ignored. We only log them.
        		
        		$line = implode('		', array( date('r'), $_SERVER['REMOTE_ADDR'], $pic['size'], $pic['name']));
        		file_put_contents('log.txt', $line.PHP_EOL, FILE_APPEND);
        		
        		exit_status('Uploads are ignored in demo mode.');
        	}
        	
        	
        	// Move the uploaded file from the temporary 
        	// directory to the uploads folder:
        	
        	if(move_uploaded_file($pic['tmp_name'], $upload_dir.$pic['name'])){
        		exit_status('File was uploaded successfuly!');
        	}
        	
        }
        
        exit_status('Something went wrong with your upload!');
	}
    public function actionSweCoachRequest() {
	    if(Yii::app()->request->isAjaxRequest && isset(Yii::app()->session["userId"]))
		{
            $account = Yii::app()->mongodb->startupweekend->findOne(array("email"=>Yii::app()->session["userEmail"]));
            if($account)
            {
                  $notification = array( "projet" => $_POST["coachProject"],
                                          "coach" => $_POST["coachRequested"],
                                          "read" => false,
                                          "type"=>"startUpWeekendCoachRequest");
                  if(!empty($_POST["coachQuestion"]))
                      $notification["question"] = $_POST["coachQuestion"];
                  Yii::app()->mongodb->notifications->insert($notification);
                  $result = array("result"=>true,"msg"=>"Un Coach sera bientot avec vous.");
                  
                  echo json_encode($result); 
            } else 
                  echo json_encode(array("result"=>false, "id"=>"accountNotExist ".Yii::app()->session["userId"],"msg"=>"Ce compte n'existe plus."));        
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}
	public function actionSweNotifications() {
	    
	    $coaches = array();
	    $projects = array();
	    $ids = array();
	    foreach(Yii::app()->mongodb->notifications->find(array("read"=>false,"type"=>"startUpWeekendCoachRequest"),array("coach","projet")) as $k=>$c){
	        array_push($coaches, $c["coach"]);
	        array_push($projects, $c["projet"]);
	        array_push($ids, $k);
	    }
        $result = array("count"=>Yii::app()->mongodb->notifications->count(array("read"=>false,"type"=>"startUpWeekendCoachRequest")),
                        "coaches"=>$coaches,
                        "projects"=>$projects,
                        "ids"=>$ids
                       );
        echo json_encode($result); 
        exit;
	}
    public function actionSweCoachingDone() {
	   if(Yii::app()->request->isAjaxRequest && isset(Yii::app()->session["userId"]))
		{
            $account = Yii::app()->mongodb->startupweekend->findOne(array("email"=>Yii::app()->session["userEmail"]));
            $notification = Yii::app()->mongodb->notifications->findOne(array("_id"=>new MongoId($_POST["id"])));
            if($account && $notification)
            {
                  $notification["read"]=true;	
                  Yii::app()->mongodb->notifications->save($notification);
                  
                  $result = array("result"=>true,"msg"=>"Vos Données ont bien été enregistrées.","not"=>$notification["read"]);
                  
                  echo json_encode($result); 
            } else 
                  echo json_encode(array("result"=>false, "id"=>"accountNotExist ".Yii::app()->session["userId"],"msg"=>"Ce compte n'existe plus."));
                
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}
}