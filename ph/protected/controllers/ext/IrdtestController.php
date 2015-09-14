<?php
/**
 * IRDController.php
 *
 * tous ce que propose le PH en terme d'action citoyenne
 * comment agir localeement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class IrdtestController extends Controller {
    
    const moduleTitle = "IRD test";
    
	public function actionIndex() {
		Yii::app()->theme  = "empty";
	    $attacks = Yii::app()->mongodb->ird->find(); 
	    $this->render("/ird/index",array("attacks"=>$attacks));
	}
	
    public function actionView($id) {

        $this->render("view");
	}
	
}