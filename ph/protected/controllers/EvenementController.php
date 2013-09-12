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
    public function actionCreer() {
	    $this->render("new");
	}
    public function actionStartupWeekEnd() {
	    $this->render("swe");
	}
	public function actionSwegraph() {
	    $this->layout = "swe";
	    if(!isset(Yii::app()->session["userId"]))
	        $this->render("sweLogin");
	    else
	        $this->render("swegraph");
	}
}