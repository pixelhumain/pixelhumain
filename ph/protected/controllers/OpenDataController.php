<?php
/**
 * OpenDataController.php
 *
 * Contains all the REST accessible methods building Renders of DAta 
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 16/08/13
 */
class OpenDataController extends Controller {

	public function actionIndex() {
	    $this->render("index");
	}
	
    public function actionData() {
	   $pixelsactifs = Yii::app()->mongodb->pixelsactifs->find();
	   $children = array();
	   $json = array("name"=>"Pixel Humain",
	   				 "children"=>array());
	   foreach ($pixelsactifs as $pa){
	       $cp = (isset($pa["cp"])) ? $pa["cp"] : "none" ;
	       if(!isset($children[$cp])){
	           $children[$cp]=array("name"=>$cp,
	           								"children"=>array());
	       } 
	       $name = (isset($pa["name"])) ? $pa["name"] : "no Name" ;
	       array_push($children[$cp]["children"], array("name"=>$name,"size"=>1));
	   }
	   
	   foreach ($children as $c)
	       array_push($json["children"], $c);
	       
	   header('Content-Type: application/json');
	   echo json_encode($json);
	}
}