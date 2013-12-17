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
    const moduleTitle = "Évènement";
    
	public function actionIndex() {
	    $this->render("index");
	}
    public function actionView($id) {
        $event = Yii::app()->mongodb->group->findOne(array("_id"=>new MongoId($id)));
        if(isset($event["key"]) )
            $this->redirect(Yii::app()->createUrl('index.php/evenement/key/id/'.$event["key"]));
        else
	        $this->render("view");
	}
    public function actionCreer() {
	    $this->render("new");
	}
	
	public function checkParticipation($event){
	    $res = false; 
	    foreach ($event["participantTypes"] as $t){
	        $res = self::isParticipant($event,$t);
	        if($res)break;
	    }
	    return $res;
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
    public function isParticipantEmail($event,$type){
	    return in_array( Yii::app()->session["userEmail"] , $event[$type] );
	}
	
}