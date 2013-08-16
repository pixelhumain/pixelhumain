<?php
/**
 * StatisticsController.php
 *
 * Contains all the methods and visualisations synthesising the content of the project
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class StatisticsController extends Controller {

	public function actionIndex() {
	    $this->render("index");
	}
	public function actionGraph($type) {
	   switch ($type) {
	       case "thematique":
	           $page = "thematique";
	           break;
	       case "cp":
	          $page = "cp";
	           break;
	       case "metier":
	          $page = "metier";
	           break;
	       default:
	          $page = "cp";
	   }
	   $this->render($page);
	}
    
}