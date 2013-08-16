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
	public function actionGraph() {
	   //$this->layout='content';
	    $this->render("graph".$_GET['num']);
	}
    public function actionData() {
	   $pixelsactifs = Yii::app()->mongodb->pixelsactifs->find();
	   $parent = array(); 
	   $children = array();
	   foreach ($pixelsactifs as $pa){
	       $cp = (isset($pa["cp"])) ? $pa["cp"] : "none" ;
	       if(!in_array($cp, $parent)){
	           array_push($parent, $cp);
	           echo $cp."<br/>";
	       }
	   }
	}
}