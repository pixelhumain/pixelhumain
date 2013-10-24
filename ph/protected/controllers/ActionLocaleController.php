<?php
/**
 * ActionLocaleController.php
 *
 * tous ce que propose le PH en terme d'action citoyenne
 * comment agir localeement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class ActionlocaleController extends Controller {

	public function actionIndex() {
	    $this->render("index");
	}
	
}