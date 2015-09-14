<?php
/**
 * OpenDataController.php
 *
 * Contains all the REST accessible methods building Renders of DAta 
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 16/08/13
 */
class OpendataController extends Controller {
    
    const moduleTitle = "OpenData";
    
    /**
	 * Listing des Urls open data accessible 
	 * avec la description des varialbes
	 */
	public function actionIndex() {
	    $this->render("index");
	}
	
	/**
	 * Listing de la structure de Base de données 
	 * toute les tables 
	 * et tout les documents
	 */
	public function actionMicroformats() {
	    array_push( $this->sidebar1, array( "label"=>"Creer", "onclick"=>"alert('TODO : microformat builder using drag and drop ')","iconClass"=>"icon-plus"));
	    $this->render("microformats");
	}
	
	/**
	 * Retourne les données open data relative à un code postale 
	 */
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
	
	/**
	 * Retourne les données open data relative à une commune 
	 */
    public function actionCommune($ci) {
        $commune = Yii::app()->mongodb->codespostaux->findOne(array('codeinsee'=>$ci,"type"=>"commune" ),array("annuaireElu") ); 
	    header('Content-Type: application/json');
    	echo json_encode($commune);
	}
	
	/**
	 * Page de démo pour le concours etalab : dataconnexion
	 */
	public function actionDataConnexion() {
	   // $this->layout = "swe";
	    $this->render("dataconnexion");
	}
	
}