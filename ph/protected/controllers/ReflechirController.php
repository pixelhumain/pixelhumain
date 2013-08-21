<?php
/**
 * ReflechirController.php
 *
 * contribution reflexion collective 
 * organiser des reflexions des groupe 
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class ReflechirController extends Controller {

	public function actionIndex() {
	    $this->render("index");
	}
	
}