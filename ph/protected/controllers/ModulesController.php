<?php
/**
 * View and Manage all external Modules
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class ModulesController extends Controller {
    const moduleTitle = "Modules";
    
	public function actionIndex($process=0) {
	    $this->render("index");
	}
	
}