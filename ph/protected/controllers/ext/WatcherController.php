<?php
/**
 * WatcherController.php
 *
 * API REST pour géré l'application mobile Water Watecher
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class WatcherController extends Controller {

    const moduleTitle = "Water Watcher App";
    
    /**
     * List all the latest observations
     * @return [json Map] list
     */
	public function actionIndex() 
	{
	    $this->render("/watcher/index");
	}

	
	//********************************************************************************
	//			USERS
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
			if( !empty($_POST['cp']) )
				$newInfos['cp'] = $_POST['cp'];
			if( isset($_POST['name']) )
				$newInfos['name'] = $_POST['name'];
			if( !empty($_POST['phoneNumber']) )
				$newInfos['phoneNumber'] = $_POST['phoneNumber'];
			
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
	//			OBSERVATIONS
	//********************************************************************************
	
	/**
	 * List all observations based on type
	 * TODO : limit to 10 observations
	 * @param  [type] is the observation type 
	 * @return [json] list of observations
	 */
	public function actionObservations( $type ) 
	{
	    echo json_encode( iterator_to_array( Yii::app()->mongodb->observations->find( array( "type" => $type ) ) ) ) ;
	    Yii::app()->end();
	}

	/**
	 * Add a new observation to the the collection "observations"
	 * @return [json] result, id(newly created)
	 */
	public function actionAddObservation() 
	{
	   if( Yii::app()->request->isAjaxRequest  && isset( $_POST["who"] ) )
		{
			//TODO : validate POST data to an observation model 
			$newObservation = array(
                "type" => $_POST["type"] , 
		    	"who" => $_POST["who"] , //'who' => Yii::app()->session["userId"],
	    	    "when" => $_POST["when"] , 
	    	    "where" => $_POST["where"],
	    	    "what" => $_POST["what"],
	    	    "description" => $_POST["description"]
            );
              
            Yii::app()->mongodb->observations->insert( $newObservation );
	    	echo json_encode( array( "result"=>true,  
	    							 "id"=>$newObservation["_id"] ) );
		} else 
			echo json_encode(array("result"=>false, "msg"=>"Something went wrong."));
	    Yii::app()->end();
	}
	/**
	 * return a given observation based on given id 
	 * @param  [type] $id corresponds to a given observation id
	 * @return [json] detail of an observation 
	 */
	public function actionGetObservation( $id ) 
	{
	    echo json_encode( Yii::app()->mongodb->observations->findOne( array( "_id" => new MongoId($id) ) ) )  ;
	    Yii::app()->end();
	}
	/**
	 * retreive all observations for a given citizen id
	 * @param  [type] $id a given citezens unique mongo identifier
	 * @return [json]     
	 */
	public function actionMyObservation($id) 
	{
	    echo json_encode( iterator_to_array( Yii::app()->mongodb->observations->find( array( "who" => $id ) ) ) ) ;
	    Yii::app()->end();
	}
	/**
	 * 
	 * @param  [type] $key [description]
	 * @return [json]      [description]
	 */
	public function actionGetObservationForm($key) 
	{
		$form = array();
		
		$where = Yii::app()->mongodb->lists->findOne( array( "name" => "surfSpotReunion" ),array("list") ) ;
		$form["where"] = $where["list"];
		
		$what = Yii::app()->mongodb->lists->findOne( array( "name" => "typeObservationReunion" ),array("list") ) ;
		$form["what"] = $what["list"];
	 	
	 	echo json_encode( $form ) ;
	    Yii::app()->end();   
	}
	//********************************************************************************
	//			TOOLS
	//********************************************************************************
	
	public function actionGetClosestLocation($type,$lat,$lon)
	{
		echo "TODO";
	}
}