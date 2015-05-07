<?php
/**
 * DataController.php
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class DataController extends Controller {

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

  public function actionPersons() {
        $data = PHDB::find( PHType::TYPE_CITOYEN ,array('isOpendata'=>true ) ); 
      echo Rest::json($data);
  }
  
  /**
   * Page de démo pour le concours etalab : dataconnexion
   */
  public function actionDataConnexion() {
     // $this->layout = "swe";
      $this->render("dataconnexion");
  }
	/**
	 * Delete an entry from the data table using the id
	 */
    public function actionExportInitData($id) {
	    if( isset(Yii::app()->session["userId"]) && $id == Yii::app()->session["userId"])
  		{
              $account = PHDB::findOne(PHType::TYPE_CITOYEN,array("_id"=>new MongoId(Yii::app()->session["userId"])));
              if( $account  )
              {
                  $account["_id"] = array('$oid'=>(string)$account["_id"]);
                  unset( $account["_id"]['$id'] );

                  /* **************************************
                  * CITOYENS MAP
                  ***************************************** */
                  $exportInitData = array( 
                    PHType::TYPE_CITOYEN=>array($account) 
                  );

                  /* **************************************
                  * ORGANIZATIONS MAP
                  ***************************************** */
                  $myOrganizations = Organization::getWhere( array("creator"=>Yii::app()->session["userId"]) );
                  if($myOrganizations){
                    $exportInitData[ PHType::TYPE_ORGANIZATIONS ] = $myOrganizations;
                  }

                  /* **************************************
                  * ORGANIZATIONS MAP
                  ***************************************** */
                  $myOrganizations = Event::getWhere( array("creator"=>Yii::app()->session["userId"]) );
                  if($myOrganizations){
                    $exportInitData[ PHType::TYPE_ORGANIZATIONS ] = $myOrganizations;
                  }


                  $res = json_encode( $exportInitData );
                  file_put_contents("upload/".Yii::app()->session["userId"].".json", $res, FILE_APPEND | LOCK_EX);
                  echo "<a href='".Yii::app()->createUrl("/upload/".Yii::app()->session["userId"].".json")."' target='_blank'>See your Exported data</a>"; 
              } else 
                    echo Rest::json(array("result"=>false,"msg"=>"Cette requete ne peut aboutir."));
  		} else
  		    echo Rest::json(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
	}
}