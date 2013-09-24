<?php
/**
 * ActionLocaleController.php
 *
 * tous ce que propose le PH pour les associations
 * comment agir localeement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class AssociationController extends Controller {
    const moduleTitle = "Association";
    
	public function actionIndex() {
	    $this->layout = "swe";
	    $this->render("index");
	}
    public function actionView($id) {
        $this->layout = "swe";
        $asso = Yii::app()->mongodb->group->findOne(array("_id"=>new MongoId($id)));
        if(isset($asso["key"]) )
            $this->redirect(Yii::app()->createUrl('index.php/assocation/'.$asso["key"]));
        else    
	        $this->render("view",array('asso'=>$asso));
	}
    public function actionCreer() {
	    $this->render("new");
	}
}