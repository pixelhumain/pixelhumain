<?php
/**
 * DataController.php
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class DataController extends Controller {

    /**
     * Add a new FAQ entry into the "data" table
     */
	public function actionFaq() {
	    if(Yii::app()->request->isAjaxRequest && isset(Yii::app()->session["userId"]))
		{
            $account = Yii::app()->mongodb->citoyens->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"])));
            if( $account && Citoyen::isAdminUser() )
            {
                  $data = $_POST;
                  $data["key"] = "faq";
                  $data["type"] = "qa";
                  
                  Yii::app()->mongodb->data->insert($data);
                  $result = array("result"=>true,"msg"=>"Donnée enregistrée.");
                  echo json_encode($result); 
            } else 
                  echo json_encode(array("result"=>false,"msg"=>"Cette requete ne peut aboutir."));
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}
	/**
	 * Delete an entry from the data table using the id
	 */
    public function actionDelete() {
	    if(Yii::app()->request->isAjaxRequest && isset(Yii::app()->session["userId"]))
		{
            $account = Yii::app()->mongodb->citoyens->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"])));
            if( $account && Citoyen::isAdminUser() )
            {
                  $data = $_POST;
                  $data["key"] = "faq";
                  $data["type"] = "qa";
                  
                  Yii::app()->mongodb->data->insert($data);
                  $result = array("result"=>true,"msg"=>"Donnée enregistrée.");
                  echo json_encode($result); 
            } else 
                  echo json_encode(array("result"=>false,"msg"=>"Cette requete ne peut aboutir."));
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}
}