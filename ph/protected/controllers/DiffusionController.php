<?php
/**
 * DiffusionController.php
 *
 * tous les flux Live du PH 
 * Audio
 * Hangout ...etc
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 21/08/13
 */
class DiffusionController extends Controller {

	public function actionIndex() {
	    $this->render("index");
	}
    public function actionHangout() {
	    $this->render("hangout");
	}
    public function actionAudio() {
	    $this->render("audio");
	}
}