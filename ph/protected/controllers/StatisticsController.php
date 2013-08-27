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
	           $this->layout = "blanck";
	           $page = "thematique";
	           break;
	       case "cpCount":
	           $this->layout = "blanck";
	          $page = "cpCount";
	           break;
	       case "metier":
	          $this->layout = "blanck";
	          $page = "metier";
	           break;
	       case "groups":
	          $this->layout = "blanck";
	          $page = "groups";
	           break;
	       case "interactions":
	          $this->layout = "blanck";
	          $page = "interactions";
	           break;
	       case "3dsurface":
	          $this->layout = "blanck";
	          $page = "3dsurface";
	           break;
	       default:
	          $page = "cp";
	   }
	   $this->render($page);
	}
    
}