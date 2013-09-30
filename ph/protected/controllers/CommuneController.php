<?php
/**
 * CommuneController.php
 *
 * tous ce que propose le PH pour les associations
 * comment agir localeement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class CommuneController extends Controller {
    const moduleTitle = "Commune";
    public $showSidebar1 = true;
    
	public function actionIndex() {
	    $this->layout = "swe";
	    
	    $this->render("index");
	}
    public function actionView($cp) 
    {
        $this->layout = "swe";
        $this->render("view",array('cp'=>$cp));
	}
}