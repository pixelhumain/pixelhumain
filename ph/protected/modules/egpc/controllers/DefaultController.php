<?php
/**
 * DefaultController.php
 *
 * API REST pour géré l'application EGPC
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class DefaultController extends Controller {

    const moduleTitle = "Etat Généraux des pouvoirs citoyens";
    public static $moduleKey = "waterwatcher";
    /**
     * List all the latest observations
     * @return [json Map] list
     */
	public function actionIndex() 
	{
	    $this->render("index");
	}


}