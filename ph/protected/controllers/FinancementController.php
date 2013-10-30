<?php
/**
 * SiteController.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/23/12
 * Time: 12:25 AM
 */
class FinancementController extends Controller {
 const moduleTitle = "Templates";
	public function accessRules() {
		return array(
			// not logged in users should be able to login and view captcha images as well as errors
			array('allow', 'actions' => array('index')),
			// logged in users can do whatever they want to
			array('allow', 'users' => array('@')),
			// not logged in users can't do anything except above
			array('deny'),
		);
	}

	public function actionIndex() {
	    $this->render("index");
	}
public function actionPixelfunding() {
	    $this->render("pixelfunding");
	}
}