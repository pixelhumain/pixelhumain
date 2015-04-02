<?php
/**
 * DataController.php
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class DataController extends Controller {

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
                  /*$myOrganizations = Authorisation::listUserOrganizationAdmin( Yii::app()->session["userId"] );
                  if($myOrganizations){
                    $exportInitData[PHType::TYPE_ORGANIZATIONS] = $myOrganizations;
                  }*/
                  echo Rest::json($exportInitData);
              } else 
                    echo Rest::json(array("result"=>false,"msg"=>"Cette requete ne peut aboutir."));
  		} else
  		    echo Rest::json(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
	}
}