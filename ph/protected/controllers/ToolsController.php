<?php
/**
 * ActionLocaleController.php
 *
 * tout une liste d'outils
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class ToolsController extends Controller {

	public function actionIndex($process=0) {
	    $this->render("readCSV",array("process"=>$process));
	}
	
}