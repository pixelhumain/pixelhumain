<?php
/**
 * DefaultController.php
 *
 * API REST pour géré l'application AzotLive
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class DefaultController extends Controller {

    const moduleTitle = "AzotLive";
    /**
     * List all the latest observations
     * @return [json Map] list
     */
	public function actionIndex() 
	{
	    $this->render("index");
	}
}