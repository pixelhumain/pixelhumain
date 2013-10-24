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
    const moduleTitle = "OpenData";
	public function actionIndex() {
	    $this->render("index");
	}
	
    public function actionCP() {
       $format = (isset($_GET["format"])) ? $_GET["format"] : "json" ;
	   $citoyens = Yii::app()->mongodb->citoyens->find();
	   
	   if($format == "csv"){
	       header('Content-Type: application/tsv');
	       
    	   foreach ($citoyens as $pa){
    	       $cp = (isset($pa["cp"])) ? $pa["cp"] : "none" ;
    	       if(!isset($children[$cp])){
    	           $children[$cp]=array("name"=>$cp,
    	           								"children"=>array());
    	       } 
    	       $name = (isset($pa["name"])) ? $pa["name"] : "no Name" ;
    	       array_push($children[$cp]["children"], array("name"=>$name,"size"=>1));
    	   }
    	   $ct = .0022;
    	   $c = 1;
    	   echo "letters\tfrequency\n";
    	   foreach ($children as $c=>$v){
    	       //echo $c."\t".count($v["children"])."\n";
    	       echo $c."\t".$ct."\n";
    	       $c++;
    	       $ct = $ct *2;  
    	   }
    	   echo "\n";
	   }
	   else 
	   {
    	   $children = array();
    	   $json = array("name"=>"Pixel Humain",
    	   				 "children"=>array());
    	   foreach ($citoyens as $pa){
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
    public function actionCommune($ci) {
        $commune = Yii::app()->mongodb->codespostaux->findOne(array('codeinsee'=>$ci,"type"=>"commune" ),array("annuaireElu") ); 
	    header('Content-Type: application/json');
    	echo json_encode($commune);
	}
	public function actionDataConnexion() {
	    $this->layout = "swe";
	    $this->render("dataconnexion");
	}
}