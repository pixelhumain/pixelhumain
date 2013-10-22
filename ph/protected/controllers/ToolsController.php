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

    /**
     * Runs through a tab seperated CSV file
     * saves to table citoyen or group 
     */
	public function actionIndex($process=0) {
	    $this->render("readCSV",array("process"=>$process));
	}
	/* Import les colonne des données insee*/
    public function actionPopulation($process=0) {
	    $this->render("popCSV",array("process"=>$process));
	}
}